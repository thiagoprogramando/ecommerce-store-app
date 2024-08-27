<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Discount;
use App\Models\Order;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {

    public function myOrders() {

        return view('Cart.order', [
            'orders' => Order::orderBy('status', 'asc')->get()
        ]);
    }
    
    public function createOrder(Request $request) {

        if(empty(Auth::user()->name) || empty(Auth::user()->cpfcnpj) || empty(Auth::user()->email) || empty(Auth::user()->phone)) {
            return redirect()->back()->with('error', 'Verique seus dados!');
        }

        if(Auth::user()->customer) {
            $customer = Auth::user()->customer;
        } else {
            $customer = $this->createCustomer(Auth::user()->name, Auth::user()->cpfcnpj, Auth::user()->phone, Auth::user()->email);
        }

        if(empty($customer)) {
            return redirect()->back()->with('error', 'Verique seus dados!');
        }

        $invoice = $this->createInvoice($customer, $request->value, $request->name, $request->method, $request->installments);
        if($invoice == null) {
            return redirect()->back()->with('error', 'Não foi possível concluir a operação!');
        }
        
        $order                  = new Order();
        $order->name            = $request->name;
        $order->value           = $request->value;
        $order->payment_token   = $invoice['id'];
        $order->license         = env('APP_KEY');
        if($order->save()) {

            Cart::where('customer_id', Auth::user()->id)
                ->whereNull('token_pay')
                ->update(['token_pay' => $invoice['id']]);

            Discount::where('customer_id', Auth::user()->id)
                ->whereNull('token_pay')
                ->update(['token_pay' => $invoice['id']]);

            return redirect($invoice['invoiceUrl']);
        }

        return redirect()->back()->with('error', 'Não foi possível finalizar o carrinho!');
    }

    private function createCustomer($name, $cpfcnpj, $mobilePhone, $email) {
        
        $client = new Client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('API_KEY'),
                'User-Agent'   => env('APP_NAME')
            ],
            'json' => [
                'name'          => $name,
                'cpfCnpj'       => $cpfcnpj,
                'mobilePhone'   => $mobilePhone,
                'email'         => $email,
                'notificationDisabled' => true
            ],
            'verify' => false
        ];

        $response = $client->post(env('API_URL_ASSAS') . 'v3/customers', $options);
        $body = (string) $response->getBody();
        
        if ($response->getStatusCode() === 200) {
            $data = json_decode($body, true);
            return $data['id'];
        } else {
            return false;
        }
    }

    private function createInvoice($customer, $value, $description, $method, $installments) {
        	
        $client = new Client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('API_KEY'),
                'User-Agent'   => env('APP_NAME')
            ],
            'json' => [
                'customer'          => $customer,
                'billingType'       => $method,
                'value'             => number_format($value, 2, '.', ''),
                'dueDate'           => now()->addDay(),
                'description'       => $description,
                'installmentCount'  => $installments != null ? $installments : 1,
                'installmentValue'  => $installments != null ? number_format(($value / intval($installments)), 2, '.', '') : $value,
                // 'callback'          => [
                //     'successUrl'    => env('APP_URL'),
                //     'autoRedirect'  => true
                // ]
            ],
            'verify' => false
        ];

        $response = $client->post(env('API_URL_ASSAS') . 'v3/payments', $options);
        $body = (string) $response->getBody();

        if ($response->getStatusCode() === 200) {
            $data = json_decode($body, true);
            return $dados['json'] = [
                'id'            => $data['id'],
                'invoiceUrl'    => $data['invoiceUrl'],
            ];
        } else {
            return false;
        }

    }

}
