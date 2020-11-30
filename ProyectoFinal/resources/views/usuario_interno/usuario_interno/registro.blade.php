@extends('usuario_interno.includes.index')

@section('content')
    <div class="main-content container">
        <section class="section">
            <div class="card card-primary">
                <div class="card-header"><h4>Registrar Usuario Interno</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{route('usuario_interno_registrado')}}">
                        @include('errores.errores')
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" name="nombre" autofocus required value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" type="text" class="form-control" name="apellidos" required value="{{ old('apellidos') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <label for="sexo">
                                    Sexo
                                    <select class="form-control selectric" name="sexo" required>
                                        <option value="0">Hombre</option>
                                        <option value="1">Mujer</option>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group col-3">
                                <label for="tipo_usuario">
                                    Rol
                                    <select class="form-control selectric" name="tipo_usuario" required>
                                        <option value="1">Doctor</option>
                                        <option value="2">Enfermero</option>
                                        <option value="3">Personal Auxiliar</option>
                                        <option value="4">No Catálogo</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" required value="{{old('correo')}}">
                        </div>

                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input id="usuario" type="text" class="form-control" name="usuario" required value="{{old('usuario')}}">
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Contraseña</label>
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="contrasena-confirmada" class="d-block">Confirmación de contraseña</label>
                                <input id="contrasena-confirmada" type="password" class="form-control" name="contrasena-confirmada" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
