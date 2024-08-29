@extends('layout')
@section('content')

<section class="mt-5">

    <h4 class="display-6">Perfil</h4>
    <small class="lead">Mantenha seus dados atualizados.</small>

    <div class="row mt-5">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 mt-3 mb-3 text-center">
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
                        <div class="card-header d-flex justify-content-between">Endereço <i data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#filterModal" class="fas fa-pen mt-2"></i></div>
                        <div class="card-body">
                          <p class="card-text">
                            {{ Auth::user()->address }}
                          </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('update-address') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Dados do Endereço</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-outline mb-2" data-mdb-input-init>
                                    <input type="number" name="postal_code" onblur="consultaCEP()" id="postal_code" class="form-control"/>
                                    <label class="form-label" for="postal_code">CEP</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-outline mb-2" data-mdb-input-init>
                                    <input type="text" name="address" id="address" class="form-control"/>
                                    <label class="form-label" for="address">Logradouro</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-outline mb-2" data-mdb-input-init>
                                    <input type="text" name="city" id="city" class="form-control"/>
                                    <label class="form-label" for="city">Cidade</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-outline mb-2" data-mdb-input-init>
                                    <input type="text" name="state" id="state" class="form-control"/>
                                    <label class="form-label" for="state">Estado</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-outline mb-2" data-mdb-input-init>
                                    <input type="text" name="num" id="num" class="form-control"/>
                                    <label class="form-label" for="num">Número</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-outline mb-2" data-mdb-input-init>
                                    <input type="text" name="complement" id="complement" class="form-control"/>
                                    <label class="form-label" for="complement">Complemento</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-danger" data-mdb-ripple-init data-mdb-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-dark" data-mdb-ripple-init>Atualizar Endereço</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
</section>

<script>
    document.getElementById('change-photo-button').addEventListener('click', function() {
        document.getElementById('photo-input').click();
    });

    function consultaCEP() {
        var cep = $('[name="postal_code"]').val();

        cep = cep.replace(/\D/g, '');

        if (/^\d{8}$/.test(cep)) {

            cep = cep.replace(/(\d{5})(\d{3})/, '$1-$2');
            $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                $('[name="address"]').val(data.logradouro);
                $('[name="complement"]').val(data.bairro);
                $('[name="city"]').val(data.localidade);
                $('[name="state"]').val(data.uf);
            })
            .fail(function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'CEP não localizado!',
                    icon: 'error',
                    timer: 1500
                })
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'CEP inválido!',
                icon: 'error',
                timer: 1500
            })
        }
    }
</script>
@endsection

    
