@extends('usuario_interno.includes.index')

@section('content')
    <!-- Main Content -->
    <div class="main-content container">
        <section class="section">
            <div class="card card-primary">
                <div class="card-header"><h4>Registrar Paciente</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{route('registrar_paciente')}}">
                        @include('errores.errores')
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" name="nombre" autofocus value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Sexo</label>
                                <select class="form-control selectric" name="sexo">
                                    <option value="1">Hombre</option>
                                    <option value="0">Mujer</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="fecha_ingreso">Fecha de Ingreso</label>
                                <input id="fecha_ingreso" type="datetime-local" class="form-control" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="detail">Motivo Ingreso</label>
                                <textarea class="form-control" name="motivo_ingreso" id="motivo_ingreso" cols="30" rows="10"></textarea>
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="form-group col-6">--}}
{{--                                <label>Fecha de Alta</label>--}}
{{--                                <input id="fecha_alta" type="datetime-local" class="form-control" name="fecha_alta">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <div class="form-group col-12">--}}
{{--                                <label for="detail">Motivo Alta</label>--}}
{{--                                <textarea class="form-control" name="motivo_alta" id="motivo_alta" cols="30" rows="10"></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <div class="form-group col-6">--}}
{{--                                <label>Fecha de Muerte</label>--}}
{{--                                <input id="fecha_muerte" type="datetime-local" class="form-control" name="fecha_muerte">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="detail">Diagnostico</label>
                                <textarea class="form-control" name="diagnostico" id="diagnostico" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Registrar Paciente
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
