@extends('usuario_interno.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content container">
        <section class="section">
            <div class="card card-primary">
                <div class="card-header"><h4>Crear Notificación</h4></div>

                <div class="card-body">
                    <form action="{{route('notificacion_creada')}}" method="post">
                        {{csrf_field()}}
                        @include('errores.errores')
                        <div class="form-group">
                            <label for="name">Nombre del Paciente</label>
                            <input type="number" hidden value="{{$paciente->id}}" name="id_paciente">
                            <p>{{$paciente->nombre . ' ' . $paciente->apellidos}}</p>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input id="titulo" type="text" class="form-control" name="titulo">
                        </div>

                        <div class="form-group">
                            <label for="detalle">Detalle</label>
                            <textarea class="form-control" name="detalle" id="detalle" cols="10" rows="50"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="atendido">Atendido por</label>
                            <input type="number" name="id_usuario_interno" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" hidden>
                            <p>
                                {{\Illuminate\Support\Facades\Auth::user()->nombre .' '. \Illuminate\Support\Facades\Auth::user()->apellidos}}
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha - Hora</label>
                            <input id="fecha" type="datetime-local" class="form-control" name="fecha">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Crear Notificación
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
