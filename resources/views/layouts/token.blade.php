<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('tittle','Kup')
    @include('nawigacja')
</head>
<body>
    <div id="app">
        

      <div id=kontener>          
                @yield('content')
         </div>   
     
    </div>
    <div id='stopka' class="footer">
        <p>Kacper Bury</p>
      </div>

</body>
</html>
