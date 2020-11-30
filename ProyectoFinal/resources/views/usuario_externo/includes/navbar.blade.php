<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{asset('img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{\Illuminate\Support\Facades\Auth::user()->nombre .' '. \Illuminate\Support\Facades\Auth::user()->apellidos}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Configuraciones
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('logout_usuario_externo')}}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('inicio_usuario_externo')}}">Hospital</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('inicio_usuario_externo')}}">H</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Tablero</li>
            <li class="active"><a class="nav-link" href="{{route('inicio_usuario_externo')}}"><i class="far fa-bell"></i> <span>Notificaciones</span></a></li>
            {{--                    <li class=""><a class="nav-link" href="blank.html"><i class="far fa-user"></i> <span>Pacientes</span></a></li>--}}
        </ul>
    </aside>
</div>
