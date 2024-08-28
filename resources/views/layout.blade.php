<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>

    <title>{{ env('APP_NAME') }} - {{ env('APP_DESCRIPTION') }}</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}"/>

    <script src="{{ asset('assets/js/sweetalert.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
  </head>
  <body class="container-md container-lg container-xl container-xxl" style="background-color: #F3F3F3;">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
          <div class="container-fluid">
            
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
  
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
                <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('ecommerce') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" height="30" alt="MDB Logo" loading="lazy"/>
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('ecommerce') }}">Página Inicial</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('shop') }}">Produtos</a> </li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="#">Sobre</a> </li> --}}
                </ul>
            </div>
  
            <div class="d-flex align-items-center me-2">
              <a class="text-reset me-2" href="{{ route('cart') }}">
                <i class="fas fa-shopping-cart"></i>
              </a>
              
              @if (Auth::check())
                {{-- <div class="dropdown">
                  <a data-mdb-dropdown-init class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li> <a class="dropdown-item" href="#">Some news</a> </li>
                    <li> <a class="dropdown-item" href="#">Another news</a> </li>
                    <li> <a class="dropdown-item" href="#">Something else here</a> </li>
                  </ul>
                </div> --}}
    
                <div class="dropdown">
                  <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                    @if(Auth::user()->photo)
                      <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
                    @else
                        <img src="{{ asset('assets/img/components/profile.png') }}" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
                    @endif
                  </a>
                  
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li> <a class="dropdown-item" href="{{ route('profile') }}">Meus dados</a> </li>
                    <li> <a class="dropdown-item" href="{{ route('my-orders') }}">Meus Pedidos</a> </li>
                    {{-- <li> <a class="dropdown-item" href="#">Faq</a> </li> --}}
                    <li> <a class="dropdown-item" href="{{ route('logout') }}">Sair</a> </li>
                  </ul>
                </div>
              @else
                <a class="text-reset me-2" href="#">
                  <a href="{{ route('register') }}" class="btn btn-link btn-rounded text-dark">Cadastre-se</a>
                  <a href="{{ route('login') }}" class="btn btn-dark btn-rounded" data-mdb-ripple-init>Acessar</a>
                </a>
              @endif
            </div>
          </div>
        </nav>
    </header>

    @yield('content')
      
    <div class="fixed-action-btn" id="fixed1" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true" style="height: 80px;">
        <a class="btn btn-floating btn-dark btn-lg text-white" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true" aria-pressed="false"> <i class="fas fa-filter"></i> </a>
        <ul class="list-unstyled" style="margin-bottom: 80px; transform: translateY(368px);">
            <li>
                <a href="{{ $link->url_whatsapp }}" class="btn btn-success btn-floating btn-lg text-white" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"><i class="fab fa-whatsapp"></i></a>
            </li>
            <li>
                <a href="{{ $link->url_instagram }}" class="btn btn-danger btn-floating btn-lg text-white" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"><i class="fab fa-instagram"></i></a>
            </li>
            <li>
                <a href="{{ $link->url_maps }}" class="btn btn-primary btn-floating btn-lg" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"><i class="fas fa-map-location-dot"></i></a>
            </li>
        </ul>
    </div>

    <footer class="text-center text-lg-start bg-body-tertiary text-muted border-top border-3 mt-5">
        {{-- <section class="p-5">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-robot me-3"></i>{{ env('APP_NAME') }}
                        </h6>
                        <p>
                            {{ env('APP_DESCRIPTION') }}
                        </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4"> Atalhos </h6>
                        <p> <a href="#!" class="text-reset">Trabalhe conosco</a> </p>
                        <p> <a href="#!" class="text-reset">FAQ</a> </p>
                        <p> <a href="#!" class="text-reset">Produtos</a> </p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contato & endereço</h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p> <i class="fas fa-envelope me-3"></i> info@example.com </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section> --}}
  
      <div class="bg-dark text-center text-white p-4">
        © {{ date('Y') }} Copyright: <a class="text-reset fw-bold" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
      </div>
    </footer>

    <script type="text/javascript" src="{{ asset('assets/js/mdb.umd.min.js') }}"></script>
    <script type="text/javascript">
      @if(session('error'))
          Swal.fire({
              title: 'Erro!',
              text: '{{ session('error') }}',
              icon: 'error',
              timer: 5000
          })
      @endif
      
      @if(session('success'))
          Swal.fire({
              title: 'Sucesso!',
              text: '{{ session('success') }}',
              icon: 'success',
              timer: 5000
          })
      @endif
    </script>
  </body>
</html>