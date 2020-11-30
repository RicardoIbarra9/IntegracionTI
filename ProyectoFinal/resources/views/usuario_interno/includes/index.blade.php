<!DOCTYPE html>
<html lang="es">
@include('usuario_interno.includes.head')
<body>
<div id="app">
    <div class="main-wrapper">

        @include('usuario_interno.includes.navbar')

        @yield('content')
    </div>
</div>
@include('usuario_interno.includes.footer')
@include('usuario_interno.includes.js')
</body>
</html>
