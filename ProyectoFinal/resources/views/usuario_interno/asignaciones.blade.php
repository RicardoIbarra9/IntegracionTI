@extends('usuario_interno.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="card card-primary">
            <div class="card-header">
                <h4>Asignaciones Creadas</h4>
                <div class="card-header-action">
                    <a href="{{route('crear_una_asignacion')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Crear Asignación
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form method="POST" action="{{route('buscar_paciente_asignaciones')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-3">
                                <label for="fecha_ingreso">Buscar por fecha de ingreso</label>
                                <input id="fecha_ingreso" type="date" class="form-control" name="fecha_ingreso">
                            </div>
                            <div class="col-9">
                                <label for="buscar_nombre_paciente">Buscar por fecha de ingreso</label>
                                <div class="input-group">
                                    <input id="buscar_nombre_paciente" name="buscar_nombre_paciente" type="text" class="form-control" placeholder="" aria-label="" autofocus>
                                    <div class="input-group-append">
                                        <button id="buscarPacienteBtn" class="btn btn-primary" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-hover">
                    @include('errores.errores')
                    <thead>
                    <tr>
                        <th scope="col">Nombre del paciente</th>
                        <th scope="col">Usuario externo</th>
                        <th scope="col">Parentesco</th>
                        <th scope="col">Borrar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($relaciones as $relacion)
                            <tr>
                                <td>{{$relacion->pacientes->nombre .' '. $relacion->pacientes->apellidos}}</td>
                                <td>{{$relacion->usuarioExterno->nombre .' '. $relacion->usuarioExterno->apellidos}}</td>
                                <td>{{$relacion->parentesco}}</td>
                                <td>
                                    <form action="{{route('borrar_asignacion', $relacion->id)}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-outline-danger btn-icon icon-left" type="submit">
                                            <i class="fas fa-unlink"></i> Borrar Asignación
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        </section>
    </div>
@endsection
<!-- Page Specific JS File -->
{{--<script src="{{asset('js/page/auth-register.js')}}"></script>--}}
