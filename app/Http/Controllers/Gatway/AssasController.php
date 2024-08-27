<?php

namespace App\Http\Controllers\Gatway;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AssasController extends Controller {
    
    public function webhook(Request $request) {

        $jsonData = $request->json()->all();
        $token = $jsonData['payment']['id'];

        if ($jsonData['event'] === 'PAYMENT_CONFIRMED' || $jsonData['event'] === 'PAYMENT_RECEIVED') {

            $order = Order::where('payment_token', $token)->where('status', 0)->first();
            if($order) {

                $order->status = 2;
                if($order->save()) {

                    Cart::where('payment_token', $token)
                    ->update(['status' => 1]);

                    Discount::where('payment_token', $token)
                        ->update(['status' => 1]);

                    return response()->json(['status' => 'success', 'message' => 'Pedido processado!']);
                }
                
                return response()->json(['status' => 'success', 'message' => 'Não foi possível processar o Pedido!']);
            }
        }

        if($jsonData['event'] === 'PAYMENT_OVERDUE') {

            $order = Order::where('payment_token', $token)->where('status', 0)->first();
            if($order) {
                
                $order->status = 4;
                if($order->save()) {

                    $cancel = $this->cancelInvoice($token);
                    if($cancel) {

                        foreach ($order->carts as $cart) {
                            $product = Product::find($cart->product_id);
                            if ($product) {
                                $product->stock += $cart->quantity;
                                $product->save();
                            }
                        }

                        foreach ($order->discounts as $discount) {
                            $discount->status = 0;
                            $discount->save();
        
                            $coupon = $discount->coupon;
                            if ($coupon) {
                                $coupon->qtd += 1;
                                $coupon->save();
                            }
                        }

                        return response()->json(['status' => 'success', 'message' => 'Pedido Cancelado!']);
                    }

                    return response()->json(['status' => 'success', 'message' => 'Não foi possível cancelar o Pedido!']);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Webhook não utilizado!']);

    }

    private function cancelInvoice($token) {

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('api_key'),
                'User-Agent'   => env('APP_NAME')
            ],
            'verify' => false
        ];

        $response = $client->delete(env('API_URL_ASSAS') . 'v3/payments/'.$token, $options);
        $body = (string) $response->getBody();
        
        if ($response->getStatusCode() === 200) {
            $data = json_decode($body, true);
    
            if(isset($data['deleted']) && $data['deleted'] == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
