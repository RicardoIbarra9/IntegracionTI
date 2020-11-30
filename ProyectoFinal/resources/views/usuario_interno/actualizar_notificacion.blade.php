@extends('usuario_interno.includes.index')

@section('content')
<!-- Main Content -->
<div class="main-content container">
    <section class="section">
        <div class="card card-primary">
            <div class="card-header"><h4>Actualizar Notificación</h4></div>

            <div class="card-body">
                <form action="{{route('notificacion_actualizada', $notificacion->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    @include('errores.errores')
                    <div class="form-group">
                        <label for="name">Nombre del Paciente</label>
                        <input type="number" hidden value="{{$notificacion->paciente->id}}" name="id_paciente">
                        <p>{{$notificacion->paciente->nombre . ' ' . $notificacion->paciente->apellidos}}</p>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input id="titulo" type="text" class="form-control" name="titulo" value="{{$notificacion->titulo}}">
                    </div>

                    <div class="form-group">
                        <label for="detalle">Detalle</label>
                        <textarea class="form-control" name="detalle" id="detalle" cols="30" rows="10">{{$notificacion->detalle}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="atendido">Atendido por</label>
{{--                        actualizar el value de este input con el del usuario logeado--}}
                        <input type="number" name="id_usuario_interno" hidden value="{{$notificacion->id_usuario_interno}}">
                        <p>{{$notificacion->usuarioInterno->nombre.' '.$notificacion->usuarioInterno->apellidos}}</p>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha - Hora</label>
                        <input id="fecha" type="datetime-local" class="form-control" name="fecha" value="{{date('Y-m-d\TH:i', strtotime($notificacion->fecha))}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Actualizar Notificación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
<!-- Page Specific JS File -->
{{--<script src="{{asset('js/page/auth-register.js')}}"></script>--}}
