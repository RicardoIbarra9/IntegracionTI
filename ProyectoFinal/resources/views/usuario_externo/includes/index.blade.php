<!DOCTYPE html>
<html lang="es">
@include('usuario_externo.includes.head')
<body>
    <div id="app">
        <div class="main-wrapper">
            @include('usuario_externo.includes.navbar')

            @yield('content')
        </div>
    </div>
    @include('usuario_externo.includes.footer')
    @include('usuario_externo.includes.js')
</body>
</html>
