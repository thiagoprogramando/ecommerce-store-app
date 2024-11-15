<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>

    <title>{{ env('APP_NAME') }} - {{ env('APP_DESCRIPTION') }}</title>
    <link rel="icon" href="{{ asset('assets/img/icon.png') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>

    <script src="{{ asset('assets/js/sweetalert.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
  </head>
  <body class="container-md container-lg container-xl container-xxl d-flex flex-column min-vh-100" style="background-color: #F3F3F3;">
    
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
                      <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle" height="25" alt="{{ Auth::user()->name }}" loading="lazy"/> {{ Auth::user()->firstName() }}
                    @else
                        <img src="{{ asset('assets/img/components/profile.png') }}" class="rounded-circle" height="25" alt="{{ Auth::user()->name }}" loading="lazy"/> {{ Auth::user()->firstName() }}
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

    <main class="flex-grow-1">
      @yield('content')
    </main>
      
    @if(!empty($link->url_whatsapp))
      <div class="whatsapp-btn" id="whatsappBtn">
        <a href="{{ $link->url_whatsapp ?: '' }}" target="_blank"><i class="fab fa-whatsapp text-white"></i></a>
      </div>
    @endif

    <footer class="text-center text-lg-start bg-dark text-muted border-top border-3 mt-5">
      <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
       
        <div class="me-5 d-none d-lg-block">
          <span class="text-white">{{ env('APP_NAME') }}</span>
        </div>
  
        <div>
          @if(!empty($link->url_whatsapp))
            <a href="{{ $link->url_whatsapp }}" class="me-4 text-white">
              <i class="fab fa-whatsapp"></i>
            </a>
          @endif
          @if(!empty($link->url_facebook))
            <a href="{{ $link->url_facebook }}" class="me-4 text-white">
              <i class="fab fa-facebook-f"></i>
            </a>
          @endif
          @if(!empty($link->url_instagram))
            <a href="{{ $link->url_instagram }}" class="me-4 text-white">
              <i class="fab fa-instagram"></i>
            </a>
          @endif
          @if(!empty($link->url_linkedin))
            <a href="{{ $link->url_linkedin }}" class="me-4 text-white">
              <i class="fab fa-linkedin"></i>
            </a>
          @endif
          @if(!empty($link->url_github))
            <a href="{{ $link->url_github }}" class="me-4 text-white">
              <i class="fab fa-github"></i>
            </a>
          @endif
          @if(!empty($link->url_maps))
            <a href="{{ $link->url_maps }}" class="me-4 text-white">
              <i class="fas fa-map-location-dot"></i>
            </a>
          @endif
        </div>
      </section>
  
      <div class="bg-dark text-center text-white p-4">
        © {{ date('Y') }} Copyright: <a class="text-reset fw-bold" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a> <br>
         <a href="https://expressoftwareclub.com/" class="text-white">Desenvolvido por Express Software Club</a>
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