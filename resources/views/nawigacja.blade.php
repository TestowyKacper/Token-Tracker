<meta charset="utf-8">
@yield('refresh')
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('tittle')</title>

<!-- Scripts -->
<script src="{{ asset('js/test.js') }}" defer></script>
<script src="{{ asset('js/portfel.js') }}" defer></script>
<script src="{{ asset('js/token.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<!-- CSS -->
<link href="{{ asset('css/token.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> <!--bootstrap zapisany w pliku -->
<link href="{{ asset('css/portfel.css') }}" rel="stylesheet">

<!-- jQuery do wysuwanego formularza zakończenia edycji -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!--BOOTSTRAP css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Skrypy do select search -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
 <script src="{{ asset('js/token.js') }}" defer></script>



 
</head>
<body>

    <nav id='nav' class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Token Tracker
            </a>
          
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                  @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          Sygnały
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('sygnaly') }}"> Dodaj sygnał </a>
                            <a class="dropdown-item" href="{{ route('pokaz-sygnaly') }}"> Pokaż sygnały </a>
                           
                        </div>
                     </li>
                     @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                            </li>
                        @endif
                        
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Zarejestruj') }}</a>
                            </li>
                        @endif
                    @else
                            
                    @if (Auth::user()->status !=1)
                    <li class="nav-item dropdown">
                       <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                         Panel administracyjny
                       </a>
                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="{{ route('sprawdz-sygnaly') }}"> Sprawdź sygnały </a>
                           <a class="dropdown-item" href="{{ route('uzytkownicy') }}"> Użytkownicy </a>
                          
                       </div>
                    </li>
                   @endif

                     <li class="nav-item dropdown">
                            
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           Portfel
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('portfel') }}"> Otwórz portfel </a>
                            <a class="dropdown-item" href="{{ route('kup') }}"> Dodaj transakcje </a>
                            <a class="dropdown-item" href="{{ route('zamkniete') }}"> Zamknięte transakcje </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                     </li>
                  



                        <li class="nav-item dropdown">
                            
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>