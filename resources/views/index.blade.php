@extends('layout')
@section('content')
  <section>
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
        <div class="carousel-inner" style="max-height: 400px !important;">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/banners/1.png') }}" class="d-block w-100" alt="Wild Landscape"/>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/banners/2.png') }}" class="d-block w-100" alt="Camera"/>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/banners/3.png') }}" class="d-block w-100" alt="Exotic Fruits"/>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
  </section>

  <section id="search-product" class="mt-5 mb-5">
    <div class="row">
      <div class="col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
        <form action="{{ route('ecommerce') }}" method="GET">
          @csrf
          <div class="input-group input-group-lg">
              <input type="search" name="name" class="form-control" placeholder="Pesquisar produtos"/>
              <button type="submit" class="btn btn-dark"> <i class="fas fa-search"></i> </button>
          </div>
        </form>
      </div>

      <div class="col-sm-12 col-md-12 col-lg-12 mt-3 text-center">
        <a href="{{ route('ecommerce') }}#search-product" class="btn btn-rounded btn-outline-dark m-1" data-mdb-ripple-init data-mdb-ripple-color="dark">Todos</a>
        @foreach ($categories as $category)
          <a href="{{ route('ecommerce') }}?category={{ $category->id }}#search-product" class="btn btn-rounded btn-outline-dark m-1" data-mdb-ripple-init data-mdb-ripple-color="dark">{{ $category->name }}</a>
        @endforeach
      </div>
    </div>
  </section>

  <section class="mt-5 mb-5">
    <div class="row">
      @foreach ($products as $product)
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-3">
          <div class="card">
            <img src="{{ $product->getMainImage() }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100%; height: auto; max-height: 200px; object-fit: contain;"/>
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

    
