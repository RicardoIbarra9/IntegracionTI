@extends('usuario_interno.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content container">
        <section class="section">
            <div class="card card-primary">
                        <div class="card-header"><h4>Alta o Defunción</h4></div>

                        <div class="card-body">
                            <form action="{{route('alta_o_defuncion_del_paciente_guardar', $paciente->id)}}" method="post">
                                @include('errores.errores')
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Nombre del Paciente</label>
                                    <p>{{$paciente->nombre . ' ' . $paciente->apellidos}}</p>
                                </div>

                                <div class="form-group">
                                    <label>Seleccionar Alta o Defunción</label>
                                    <select class="form-control selectric" name="alta_defuncion">
                                        <option value="1">Alta</option>
                                        <option value="0">Defunción</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input id="fecha" type="datetime-local" class="form-control" name="fecha">
                                </div>

                                <div class="form-group">
                                    <label for="motivo">Motivo</label>
                                    <textarea class="form-control" name="motivo" id="motivo" cols="30" rows="10"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Guardar
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
