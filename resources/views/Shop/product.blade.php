@extends('layout')
@section('content')
<div class="row mt-5">

  <div class="col-12 col-sm-12 col-md-5 col-lg-4 mb-3">
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
      <div class="carousel-inner">
        @foreach ($images as $key => $image)
          <div class="carousel-item @if($key == 0) active @endif">
            <img src="{{ env('APP_URL_SERVER') }}storage/products/images/{{ $image->file }}" class="d-block img-thumbnail w-100 rounded" alt="Imagens do produto" style="object-fit: contain; max-height: 800px; width: auto;"/>
          </div>
        @endforeach
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
  </div>

  <div class="col-12 col-sm-12 col-md-7 col-lg-8">
    <h4 class="fw-light"><b>{{ $product->name }}</b></h4>
    <div class="row mt-4">
      <div class="col-6">
        <ul class="list-group list-group-light">
          @if(!empty($product->mark))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">Marca</div>
                <div class="text-muted">{{ $product->mark }}</div>
              </div>
            </li>
          @endif

          @if(!empty($product->size))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">Tamanho</div>
                <div class="text-muted">{{ $product->size }}</div>
              </div>
            </li>
          @endif

          @if(!empty($product->color))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">Cor</div>
                <div class="text-muted">{{ $product->color }}</div>
              </div>
            </li>
          @endif

          @if(!empty($product->unit))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">Unidade</div>
                <div class="text-muted">{{ $product->unit }}</div>
              </div>
            </li>
          @endif
        </ul>
      </div>
      <div class="col-6">
        <ul class="list-group list-group-light">
          @if(!empty($product->ean))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">EAN</div>
                <div class="text-muted">{{ $product->ean }}</div>
              </div>
            </li>
          @endif

          @if(!empty($product->categories->count() > 0))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">Categorias</div>
                <div class="text-muted"> 
                  @foreach ($product->categories as $category)
                      @if($category)
                          <a href="">{{ $category->name }} -</a> 
                      @endif
                  @endforeach
                </div>
              </div>
            </li>
          @endif

          @if(!empty($product->relatedProducts()->count() > 0))
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-bold">Produtos semelhantes</div>
                <div class="text-muted">
                  @foreach ($product->relatedProducts() as $product)
                      @if($product)
                          <a href="">{{ $product->name }}</a> <br>
                      @endif
                  @endforeach
                </div>
              </div>
            </li>
          @endif
        </ul>
      </div>
    </div>

    <h3 class="fw-light mt-3"><b>R$ {{ number_format($product->value, 2, ',', '.') }}</b></h3>
    <form action="{{ route('add-cart') }}" method="POST">
      <div class="input-group input-group-lg mb-3">
        @csrf
        <input type="hidden" value="{{ $product->id }}" name="product_id">
        <input type="hidden" value="{{ $product->name }}" name="name">
        <input type="hidden" value="{{ $product->value }}" name="value">
        <input type="number" name="qtd" class="form-control" placeholder="Quantidade" style="max-width: 200px;" required/>
        <button class="btn btn-dark" type="submit">
          <i class="fas fa-cart-shopping"></i> Adicionar
        </button>
      </div>
    </form>
    
    <p class="lead mt-3">
      <b>Descrição</b> <br>
      {!! $product->description !!}
    </p>
  </div>
</div>
@endsection

    
