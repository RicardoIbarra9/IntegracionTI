@extends('usuario_interno.includes.index')

@section('content')
        <!-- Main Content -->
        <div class="main-content container">
            <section class="section">
                <div class="section-header">
                    <h1>
                       Notificaciones de {{$paciente->nombre . ' ' . $paciente->apellidos}}
                    </h1>
                </div>

                <div class="section-body">
                    @include('errores.errores')
                    @foreach($paciente->notificaciones as $notificacionPaciente)
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="date">Fecha</label>
                                    <p>{{$notificacionPaciente->fecha}}</p>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nombre del Paciente</label>
                                    <p>{{$paciente->nombre . ' ' . $paciente->apellidos}}</p>
                                </div>

                                <div class="form-group">
                                    <label for="title">Título</label>
                                    <p>{{$notificacionPaciente->titulo}}</p>
                                </div>

                                <div class="form-group">
                                    <label for="detail">Detalle</label>
                                    <p>{{$notificacionPaciente->detalle}}</p>
                                </div>

                                <div class="form-group">
                                    <label for="atendido">Atendido por</label>
                                    <p>{{$notificacionPaciente->usuarioInterno->nombre . ' ' .
                                         $notificacionPaciente->usuarioInterno->apellidos}}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label for="atendido">Rol</label>
                                    <p>
                                        {{$notificacionPaciente->usuarioInterno->rol->rol                                           }}
                                    </p>
                                </div>

                                <div class="form-row">
{{--                                    No se muestran las opciones de actualizar o borrar al menos que sea el usuario que creeo la notificacion--}}
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $notificacionPaciente->id_usuario_interno)
                                        <div class="form-group col-2">
                                            <a href="{{route('actualizar_notificacion', $notificacionPaciente->id)}}" class="btn btn-outline-success btn-icon icon-left">
                                                <i class="fas fa-edit"></i>
                                                Actualizar
                                            </a>
                                        </div>

                                        <div class="form-group col-2">
                                            <form action="{{route('borrar_notificacion', $notificacionPaciente->id)}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-outline-danger btn-icon icon-left" type="submit"><i class="fas fa-trash"></i>Borrar</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
@endsection
