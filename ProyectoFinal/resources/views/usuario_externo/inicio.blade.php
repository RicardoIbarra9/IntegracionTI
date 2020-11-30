@extends('usuario_externo.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content container">
            <section class="section">
                {{--                Inicio del cuerpo--}}
                <div class="section-body">

                    {{--                    Notificaciones nuevas--}}
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Notificaciones Nuevas</h4>
                                    <div class="card-header-action">
                                        <form action="{{route('marcar_notificaciones_vistas')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="submit" value="Marcar como leídas" class="btn btn-primary">
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Nombre del Paciente</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($notificaciones as $notificacion)
                                                @if($notificacion->visto == false)
                                                    <tr>
                                                        <th scope="row">{{$notificacion->fecha}}</th>
                                                        <td>
                                                            {{$notificacion->paciente->nombre . ' ' .
                                                                $notificacion->paciente->apellidos
                                                            }}
                                                        </td>
                                                        <td>{{$notificacion->titulo}}</td>
                                                        <td>
                                                            {{--ver norificacion--}}
                                                            <a href="{{route('ver_notificacion_usuario_externo', $notificacion->id)}}" class="btn btn-icon btn-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                    Notificaciones vistas--}}
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Notificaciones Vistas</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Nombre del Paciente</th>
                                            <th scope="col">Título</th>
                                            <th scope="col">Ver</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($notificaciones as $notificacion)
                                               @if($notificacion->visto == true)
                                                   <tr>
                                                       <th scope="row">{{$notificacion->fecha}}</th>
                                                       <td>
                                                           {{$notificacion->paciente->nombre . ' ' .
                                                                $notificacion->paciente->apellidos
                                                            }}
                                                       </td>
                                                       <td>{{$notificacion->titulo}}</td>
                                                       <td>
                                                           <a href="{{route('ver_notificacion_usuario_externo', $notificacion->id)}}" class="btn btn-icon btn-primary">
                                                               <i class="fas fa-eye"></i>
                                                           </a>
                                                       </td>
                                                   </tr>
                                               @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
