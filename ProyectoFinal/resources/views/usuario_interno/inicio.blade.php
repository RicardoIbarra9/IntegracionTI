@extends('usuario_interno.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
            <section class="section">
                {{--                Inicio del cuerpo--}}
                <div class="section-body">
                    {{--                    Notificaciones nuevas--}}
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Pacientes</h4>
                                    <div class="card-header-action">
                                        <a href="{{route('pacientes')}}" class="btn btn-primary btn-icon icon-left">
                                            <i class="fas fa-user-plus"></i>
                                            Registrar Paciente
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('errores.errores')
                                    <div class="form-group">
                                        <form action="{{route('buscarNombrePaciente')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="input-group mb-3">
                                                <input id="buscar_nombre_paciente" name="buscar_nombre_paciente" type="text" class="form-control" placeholder="Buscar nombre del paciente" aria-label="" autofocus>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nombre del Paciente</th>
                                            <th scope="col">Notificaciones</th>
                                            <th scope="col">Notificaciones</th>
                                            <th scope="col">Alta/Defunción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pacientes as $paciente)
                                                <tr>
                                                    <td>{{$paciente->nombre .' '. $paciente->apellidos}}</td>
                                                    <td>
                                                    @if(count($paciente->notificaciones) > 0)
                                                        <a href="{{route('ver_notificaciones_paciente', $paciente->id)}}" class="btn btn-primary btn-icon icon-left">
                                                            <i class="fas fa-bell"></i> Ver Notificaciones
                                                            <span class="badge badge-transparent">
                                                                {{count($paciente->notificaciones)}}
                                                            </span>
                                                        </a>
                                                    @else
                                                        <p>No hay notifiaciones</p>
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('crear_notificacion', $paciente->id)}}" class="btn btn-outline-primary btn-icon icon-left">
                                                            <i class="fas fa-bell"></i> Crear Notificación
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('alta_o_defuncion_del_paciente', $paciente->id)}}" class="btn btn-outline-success btn-icon icon-left">
                                                            <i class="far fa-file-alt"></i>
                                                            Alta o Defunción
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
    </div>
@endsection
