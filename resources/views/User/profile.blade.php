@extends('layout')
@section('content')

<section class="mt-5">

    <h4 class="display-6">Perfil</h4>
    <small class="lead">Mantenha seus dados atualizados.</small>

    <div class="row mt-5">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 mt-3 text-center">
            <div class="profile-photo">
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="img-thumbnail w-50">
                @else
                    <img src="{{ asset('assets/img/components/profile.png') }}" class="img-thumbnail w-50">
                @endif
            </div>

            <button class="btn btn-dark mt-3" id="change-photo-button">Trocar foto de perfil</button>

            <form action="{{ route('update-user') }}" method="POST" enctype="multipart/form-data" id="photo-upload-form" class="d-none">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <input type="file" name="photo" id="photo-input" accept="image/*" onchange="document.getElementById('photo-upload-form').submit();">
            </form>
        </div>

        <div class="col-12 col-sm-12 col-md-8 col-lg-9 card p-5 mt-3">
            <div class="row">
                <form action="{{ route('update-user') }}" method="POST" class="col-12 col-sm-12 col-md-8 col-lg-8 row">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-outline mb-3" data-mdb-input-init>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" value="{{ Auth::user()->name }}"/>
                            <label class="form-label" for="name">Nome</label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-outline mb-3" data-mdb-input-init>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ Auth::user()->email }}"/>
                            <label class="form-label" for="email">E-mail</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-outline mb-3" data-mdb-input-init>
                            <input type="text" id="phone" name="phone" class="form-control form-control-lg" value="{{ Auth::user()->phone }}"/>
                            <label class="form-label" for="phone">Telefone</label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-outline mb-3" data-mdb-input-init>
                            <input type="number" id="cpfcnpj" name="cpfcnpj" class="form-control form-control-lg" value="{{ Auth::user()->cpfcnpj }}"/>
                            <label class="form-label" for="cpfcnpj">CPF ou CNPJ</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-outline mb-3" data-mdb-input-init>
                            <input type="password" id="password" name="password" class="form-control form-control-lg"/>
                            <label class="form-label" for="password">Senha</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 offset-md-6 col-lg-6 offset-lg-6 d-grid gap-2 mb-2">
                        <button type="submit" class="btn btn-dark" type="button">Atualizar</button>
                    </div>
                </form>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3">
                    <div class="card border border-dark mb-3">
                        <div class="card-header d-flex justify-content-between">Endereço <i class="fas fa-pen mt-2"></i></div>
                        <div class="card-body">
                          <p class="card-text">
                            <b>59012-060</b> <br>
                            Rua Pereira Simões, 47 Natal/RN
                          </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</section>

<script>
    document.getElementById('change-photo-button').addEventListener('click', function() {
        document.getElementById('photo-input').click();
    });
</script>
@endsection

    
