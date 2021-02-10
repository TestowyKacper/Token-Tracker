<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 @include('nawigacja')

        <main class="py-4">
           
                @yield('content')
           
            
        </main>
    </div>
</body>
</html>
