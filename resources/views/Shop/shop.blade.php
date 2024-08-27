@extends('layout')
@section('content')

  <section id="search-product" class="mt-5 mb-5">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 mt-3 text-center">
        <button type="button" class="btn btn-rounded btn-dark m-1" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#filterModal">Filtros</button>
        <a href="{{ route('shop') }}" class="btn btn-rounded btn-outline-dark m-1" data-mdb-ripple-init data-mdb-ripple-color="dark">Todos</a>
        @foreach ($categories as $category)
          <a href="{{ route('shop') }}?category={{ $category->id }}" class="btn btn-rounded btn-outline-dark m-1" data-mdb-ripple-init data-mdb-ripple-color="dark">{{ $category->name }}</a>
        @endforeach
      </div>
    </div>

    <form action="{{ route('shop') }}" method="GET">
      <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="filterModalLabel">Filtrar Pesquisa</h5>
              <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-outline mb-2" data-mdb-input-init>
                    <input type="text" name="search" id="search" class="form-control"/>
                    <label class="form-label" for="search">Título, Nome, descrição...</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-outline mb-2" data-mdb-input-init>
                    <input type="text" name="min_value" id="min_value" class="form-control"/>
                    <label class="form-label" for="min_value">Valor Mínimo</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-outline mb-2" data-mdb-input-init>
                    <input type="text" name="max_value" id="max_value" class="form-control"/>
                    <label class="form-label" for="max_value">Valor Máximo</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-outline mb-2" data-mdb-input-init>
                    <input type="text" name="ean" id="ean" class="form-control"/>
                    <label class="form-label" for="ean">EAN</label>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                  <div class="form-floating mb-3">
                      <select name="size" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                          <option value="" selected>Tamanho</option>
                          <option value="RN">RN</option>
                          <option value="P">P</option>
                          <option value="M">M</option>
                          <option value="G">G</option>
                          <option value="GG">GG</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="12">12</option>
                          <option value="14">14</option>
                          <option value="16">16</option>
                          <option disabled>-- Tamanhos de Calçados Infantis --</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                          <option value="32">32</option>
                          <option value="33">33</option>
                          <option value="34">34</option>
                          <option value="35">35</option>
                          <option disabled>Tamanhos Adultos</option>
                          <option value="PP">PP (Extra Pequeno)</option>
                          <option value="P">P (Pequeno)</option>
                          <option value="M">M (Médio)</option>
                          <option value="G">G (Grande)</option>
                          <option value="GG">GG (Extra Grande)</option>
                          <option value="XG">XG (Extra Grande)</option>
                          <option value="XGG">XGG (Extra Extra Grande)</option>
                          <option disabled>Tamanhos de Roupas Adultos (Números)</option>
                          <option value="36">36</option>
                          <option value="38">38</option>
                          <option value="40">40</option>
                          <option value="42">42</option>
                          <option value="44">44</option>
                          <option value="46">46</option>
                          <option value="48">48</option>
                          <option value="50">50</option>
                          <option value="52">52</option>
                          <option value="54">54</option>
                          <option value="56">56</option>
                          <option disabled>Tamanhos de Calçados Adultos</option>
                          <option value="34">34</option>
                          <option value="35">35</option>
                          <option value="36">36</option>
                          <option value="37">37</option>
                          <option value="38">38</option>
                          <option value="39">39</option>
                          <option value="40">40</option>
                          <option value="41">41</option>
                          <option value="42">42</option>
                          <option value="43">43</option>
                          <option value="44">44</option>
                          <option value="45">45</option>
                          <option value="46">46</option>
                          <option value="47">47</option>
                      </select>
                      <label for="floatingSelect">Tamanho</label>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-floating mb-3">
                        <select name="type" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option value="" selected>Tipo</option>
                            <option value="0">Físico</option>
                            <option value="1">Digital</option>
                            <option value="2">Serviço</option>
                        </select>
                        <label for="floatingSelect">Tipo</label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                  <div class="form-floating mb-3">
                      <select name="unit" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                          <option value="" selected>Unidade</option>
                          <option value="KM">KM</option>
                          <option value="MT">MT</option>
                          <option value="CM">CM</option>
                          <option value="KG">KG</option>
                          <option value="G">G</option>
                      </select>
                      <label for="floatingSelect">Unidade</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="button" class="btn btn-outline-danger" data-mdb-ripple-init data-mdb-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-dark" data-mdb-ripple-init>Filtrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>

  <section class="mt-5 mb-5">
    <div class="row">
      @foreach ($products as $product)
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-3">
          <div class="card">
            <img src="{{ $product->getMainImage() }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100%; height: auto; max-height: 300px; object-fit: contain;"/>
            <div class="card-body">
              <p class="card-text mb-2">{{ $product->name }}</p>
              <h5 class="card-title mb-3">R$ {{ number_format($product->value, 2, ',', '.') }}</h5>
              <form action="{{ route('add-cart') }}" method="POST" class="text-center">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="product_id">
                <input type="hidden" value="{{ $product->name }}" name="name">
                <input type="hidden" value="{{ $product->value }}" name="value">
                <input type="hidden" value="1" name="qtd"/>
                <button type="submit" class="btn btn-rounded btn-dark w-100 mb-3">ADICIONAR AO CARRINHO</button>
                <a href="{{ route('product', ['id' => $product->id]) }}" class="text-dark"><b>Mais informações</b></a>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endsection

    
