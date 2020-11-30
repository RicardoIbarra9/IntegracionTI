@extends('usuario_interno.includes.index')
@section('css_asignacion')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content container">
    <section class="section">
        <div class="card card-primary">
            <div class="card-header"><h4>Asignación de Usuario Externo con Paciente</h4></div>

            <div class="card-body">
                @include('errores.errores')
                <div class="row">
                    <div class="form-group col-12">
                        <div class="row">
                            <div class="col-4">
                                <label for="" class="">Buscar por fecha de ingreso</label>
                            </div>
                            <div class="col-4">
                                <label for="">Buscar nombre del paciente</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                {{csrf_field()}}
                                <input id="fecha_ingreso" type="date" class="form-control" name="fecha_ingreso">
                            </div>
                            <div class="col-8">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <input id="buscar_nombre_paciente" name="buscar_nombre_paciente" type="text" class="form-control" placeholder="" aria-label="" autofocus>
                                    <div class="input-group-append">
                                        <button id="buscarPacienteBtn" class="btn btn-primary" type="button">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{route('asignacion_creada')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>
                                    Paciente seleccionado
                                    <select id="selectPacientes" class="form-control selectric" name="id_paciente" required>

                                        @if(isset($pacientes))
                                            @foreach($pacientes as $paciente)
                                                <option value="{{$paciente->id}}">{{$paciente->nombre.' '.$paciente->apellidos}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label>
                                Buscar usuario externo por nombre, correo electrónico o usuario
                                <select class="js-example-basic-single" name="id_usuario_externo">
                                    @if(isset($usuariosExternos))
                                        @foreach($usuariosExternos as $usuarioExterno)
                                            <option value="{{$usuarioExterno->id}}">
                                                {{$usuarioExterno->nombre.' '.$usuarioExterno->apellidos}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="parentesco">Parentesco con el paciente</label>
                            <input value="{{old('parentesco')}}" id="parentesco" type="text" class="form-control" name="parentesco" placeholder="esposo(a), hijo(a), sobrino(a), abuelo(a), primo(a)" autofocus required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Crear Asignación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js_asignacion')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script>
        const $btnBuscarPaciente = $('#buscarPacienteBtn');
        const $selectPacientes = $('#selectPacientes');;

        const $txt_buscar_nombre_paciente = $('#buscar_nombre_paciente');
        const $inputFechaIngreso = $('#fecha_ingreso');

        function buscarPaciente_click(e) {
            $btnBuscarPaciente.prop('disabled', true);

            let datos = {
                buscar_nombre_paciente : $txt_buscar_nombre_paciente.val(),
                fecha_ingreso : $inputFechaIngreso.val(),
                _token : $("input[name=_token]").val(),
            };

            //Si el campo del nombre esta vacio o la fecha esta vacia parar la funcion
            if(!$txt_buscar_nombre_paciente.val() && !$inputFechaIngreso.val()){
                $btnBuscarPaciente.prop('disabled', false);
                return;
            }

            $.ajax({
                url:"{{route('buscar_paciente_asignacion')}}",
                data: datos,
                type: 'POST',
                dataType:'json',
                success: function (d) {
                    console.log(d)
                    //Si no retorna nada parar la funcion
                    if (d.length <= 0){
                        $btnBuscarPaciente.prop('disabled', false);
                        return ;
                    }
                    $selectPacientes.html('');
                    //Se recorre cada registro del json
                    for (key in d) {
                        //Se crea una etiqueta <option>
                        let opcion = document.createElement('option');
                        //Se obtiene el id del registro
                        var key = Object.keys(d)[key];
                        //Se obtiene el valor del registro
                        var value = d[key];
                        // console.log(value.id);

                        //Se llena el value y text de la etiqueta <option>
                        opcion.value = value.id;
                        opcion.text = value.nombre +' ' + value.apellidos;

                        //Se agrega el <select> un nuevo <option>
                        selectPacientes.appendChild(opcion);
                    }
                    $btnBuscarPaciente.prop('disabled', false);
                },
                error: function (err) {
                    $btnBuscarPaciente.prop('disabled', false);
                    console.log('error en la busqueda de paciente');
                    $selectPacientes.html('');
                }
            })
        }

        $btnBuscarPaciente.on('click', buscarPaciente_click);
    </script>
@endsection
<!-- Page Specific JS File -->
{{--<script src="{{asset('js/page/auth-register.js')}}"></script>--}}
