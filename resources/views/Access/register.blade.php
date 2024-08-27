@extends('layout')
@section('content')
  <section class="container-fluid">
    
    <div class="row bg-light p-5">     
      <div class="col-12 col-sm-12 col-md-12 offset-lg-3 col-lg-6 d-flex justify-content-center align-items-center h-100">
        <div class="tab-content w-75">
          <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="{{ route('registrer') }}" method="POST">
              @csrf

              <div class="text-center mb-3">
                <h1 class="display-4">Faça parte!</h1>
                {{-- <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1"> <i class="fab fa-facebook-f"></i> </button>
                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1"> <i class="fab fa-google"></i> </button>
                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1"> <i class="fab fa-github"></i> </button> --}}
              </div>

              <div data-mdb-input-init class="form-outline mb-2">
                <input type="text" name="name" id="name" class="form-control" required/>
                <label class="form-label" for="name">Nome</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="text" name="phone" id="phone" class="form-control" required/>
                <label class="form-label" for="phone">Whatsapp ou Telefone</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="email" name="email" id="email" class="form-control" required/>
                <label class="form-label" for="email">Email</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="password" name="password" id="password" class="form-control" required/>
                <label class="form-label" for="password">Senha</label>
              </div>

              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" name="term" value="1" id="term" checked/>
                <label class="form-check-label" for="term">
                  Termos de política e privacidade
                </label>
              </div>

              <button type="submit" class="btn btn-dark btn-block mb-2">Cadastrar-me</button>
              <a href="{{ route('login') }}" class="btn btn-link btn-block mb-2 text-dark">Já possuo conta!</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
