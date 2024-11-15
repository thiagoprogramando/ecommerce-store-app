@extends('layout')
@section('content')
  <section class="container-fluid">
    
    <div class="row p-5">
      <div class="col-12 col-sm-12 col-md-12 offset-lg-3 col-lg-6 d-flex justify-content-center align-items-center h-100">
        <div class="tab-content w-100">
          <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="{{ route('logon') }}" method="POST">
              @csrf
              
              <div class="text-center mb-3">
                <h1 class="display-3">Acesse</h1>
                {{-- <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1"> <i class="fab fa-facebook-f"></i> </button>
                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1"> <i class="fab fa-google"></i> </button>
                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1"> <i class="fab fa-github"></i> </button> --}}
              </div>

              <div data-mdb-input-init class="form-outline mb-2">
                <input type="email" name="email" id="email" class="form-control"/>
                <label class="form-label" for="email">Email</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="password" name="password" id="password" class="form-control"/>
                <label class="form-label" for="password">Senha</label>
              </div>

              <button type="submit" class="btn btn-dark btn-block mb-2">Acessar</button>
              <a href="{{ route('register') }}" class="btn btn-link btn-block mb-2 text-dark">Cadastrar-me</a>
              {{-- <button type="button" class="btn btn-outline-dark btn-block mb-2">Recuperar dados</button> --}}
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
