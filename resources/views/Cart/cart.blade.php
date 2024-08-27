@extends('layout')
@section('content')

<section class="mt-5">

    <h4 class="display-6">Carrinho</h4>
    <small class="lead">Você pode remover ou adicionar itens sempre que quiser.</small>

    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card p-5">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col" class="text-center">Preço</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itens as $item)
                                <tr>
                                    <th scope="row">{{$item->id }}</th>
                                    <td>{{ $item->product->name }} <br>
                                        <span class="badge rounded-pill bg-dark">{{ \Illuminate\Support\Str::limit($item->product->description, 40) }}</span>
                                    </td>
                                    <td class="text-center">{{ $item->qtd }}</td>
                                    <td class="text-center"> <b>R$ {{ number_format($item->value, 2, ',', '.') }}</b> </td>
                                    <td class="text-center">
                                        <form action="{{ route('delete-cart') }}" method="POST" class="delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="submit" class="btn btn-danger" title="Excluir item"><i class="far fa-trash-can"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($discounts as $discount)
                                <tr>
                                    <th scope="row">{{$discount->id }}</th>
                                    <td>CUPOM {{ $discount->coupon->name }}<br>
                                        <span class="badge rounded-pill bg-dark">{{ \Illuminate\Support\Str::limit($discount->coupon->description, 40) }}</span>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-center"> <b>R$ - {{ number_format($discount->value, 2, ',', '.') }}</b> </td>
                                    <td class="text-center">
                                        <form action="{{ route('remove-discount') }}" method="POST" class="delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $discount->id }}">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="submit" class="btn btn-danger" title="Excluir item"><i class="far fa-trash-can"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card p-5">
                <h6 class="display-6">Total</h6>
                <hr>
                <p>
                    <b>Produtos:</b> R$ {{ number_format($valueProduct, 2, ',', '.') }} <br>
                    <b>Descontos:</b> R$ {{ number_format($discounts->sum('value'), 2, ',', '.') }} <br>
                    <b>Total: R$ {{ number_format($valueProduct - $discounts->sum('value'), 2, ',', '.') }} </b>
                </p>

                <form action="{{ route('create-order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="PEDIDO{{ date('d') }}{{ date('m') }}{{ date('Y') }}">
                    <input type="hidden" name="value" value="{{ $valueProduct - $discounts->sum('value') }}">
                    <div class="input-group mb-3">
                        <select name="method" class="form-select" id="paymentMethod">
                            <option value="PIX" selected>Forma de pagamento</option>
                            <option value="PIX">PIX</option>
                            <option value="CREDIT_CARD">Cartão de Crédito</option>
                        </select>
                        <select name="installments" class="form-select" id="installments">
                            <option value="1" selected>Parcelas</option>
                            <option value="1">1x</option>
                            <option value="2">2x</option>
                            <option value="3">3x</option>
                            <option value="4">4x</option>
                            <option value="5">5x</option>
                            <option value="6">6x</option>
                            <option value="7">7x</option>
                            <option value="8">8x</option>
                            <option value="9">9x</option>
                            <option value="10">10x</option>
                            <option value="11">11x</option>
                            <option value="12">12x</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">FINALIZAR</button>
                </form>
                <form action="{{ route('create-discount') }}" method="POST">
                    @csrf
                    <div class="input-group mt-3 mb-3">
                      <input type="text" name="name" class="form-control" placeholder="Cupom" required/>
                      <button class="btn btn-dark" type="submit"> Adicionar </button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('paymentMethod').addEventListener('change', function() {
        const paymentMethod = this.value;
        const installmentsSelect = document.getElementById('installments');
        const options = installmentsSelect.options;

        if (paymentMethod === 'PIX') {

            for (let i = 0; i < options.length; i++) {
                if (options[i].value !== "1") {
                    options[i].disabled = true;
                } else {
                    options[i].selected = true;
                }
            }
        } else {
            
            for (let i = 0; i < options.length; i++) {
                options[i].disabled = false;
            }
        }
    });
</script>
@endsection

    
