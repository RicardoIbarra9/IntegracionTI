@extends('usuario_externo.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content container">
    <section class="section">
        <div class="section-header">
            <h1>Notificacion</h1>
        </div>

        {{--                Inicio del cuerpo--}}
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <p>{{$notificacion->fecha}}</p>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre del Paciente</label>
                            <p>
                                {{$notificacion->paciente->nombre . ' ' .
                                       $notificacion->paciente->apellidos
                                   }}
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="title">Título</label>
                            <p>{{$notificacion->titulo}}</p>
                        </div>

                        <div class="form-group">
                            <label for="detail">Detalle</label>
                            <p>{{$notificacion->detalle}}</p>
                        </div>

                        <div class="form-group">
                            <label for="atendido">Atendido por</label>
                            <p>{{$notificacion->usuarioInterno->nombre . ' ' .
                                 $notificacion->usuarioInterno->apellidos
                                }}
                            </p>
                        </div>

                        <div class="form-group">
                            <a href="{{route('inicio_usuario_externo')}}" class="btn btn-primary">
                                Regresar
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
