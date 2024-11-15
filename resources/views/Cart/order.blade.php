@extends('layout')
@section('content')

<section class="mt-5">

    <h4 class="display-6">Meus Pedidos</h4>
    <small class="lead">Acompanhe a situação dos seus pedidos.</small>

    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card p-5">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produtos</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col">Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td scope="row">{{$order->id }} - {{ $order->name }}</td>
                                    <td>
                                        <small> 
                                            @foreach ($order->carts as $key => $cart)
                                                <span class="badge rounded-pill bg-dark">{{ $cart->qtd }}x {{ $cart->name }}</span>
                                                @if(($key + 1) % 3 == 0)
                                                    <br>
                                                @endif
                                            @endforeach
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        {{$order->labelStatus() }} <br>
                                        @if ($order->tracking_code)
                                            <span class="badge rounded-pill bg-dark">Código de Rastreamento: {{ $order->tracking_code }}</span>
                                        @endif 
                                    </td>
                                    <td><b>R$ {{ number_format($order->value, 2, ',', '.') }}</b><br>
                                        <a href="{{ $order->payment_url }}" target="_blank" class="text-danger">Link de Pagamento</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

    
