@extends('layouts.ssi')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Crear nuevo paciente FHIR</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
        </div>
    </div>
</div>

<form method="POST" class="form-horizontal" action="{{ route('patient.store') }}">
    @csrf
    @method('POST')

    <div class="form-row">
        <fieldset class="form-group col-2">
            <label for="for_id_type">Tipo de identificación</label>
            <select name="id_type" id="for_id_type" class="form-control">
                <option value="PN">RUN</option>
                <option value="PPN">Pasaporte</option>
                <option value="MR">N° ficha</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_identifier">Identificador</label>
            <input type="text" class="form-control" name="identifier"
                id="for_identifier" required>
        </fieldset>

    </div>

    <div class="form-row">

        <fieldset class="form-group col-2">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" name="name"
                id="for_name" required value="{{ substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 7) }}">
        </fieldset>


        <fieldset class="form-group col-2">
            <label for="for_fathers_family">Apellido Paterno</label>
            <input type="text" class="form-control" name="fathers_family"
                id="for_fathers_family" required value="{{ substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 7) }}">
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_mothers_family">Apellido Materno</label>
            <input type="text" class="form-control" name="mothers_family"
                id="for_mothers_family" required value="{{ substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 7) }}">
        </fieldset>

    </div>

    <div class="form-row">
        <fieldset class="form-group col-2">
            <label for="for_birthdate">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="birthdate"
                id="for_birthdate" value="{{ rand(1900, 2021) }}-{{ rand(10, 12) }}-{{ rand(10, 30) }}">
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_gender">Sexo</label>
            <select name="gender" id="for_gender" class="form-control">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="unknown">Unknown</option>
                <option value="other">Other</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_gender_identity">Identidad de Genero</label>
            <select name="gender_identity" id="for_gender_identity" class="form-control">
                <option value="male">male</option>
                <option value="female">female</option>
                @foreach ($genderIdentities as $identity)
                    <option value="{{ $identity['code'] }}">{{ $identity['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

        {{-- <fieldset class="form-group col-2">
            <label for="for_birth_place">País de nacimeinto</label>
            <select name="birth_place" id="for_birth_place" class="form-control">
                <option value=""></option>
            </select>
        </fieldset> --}}

        <fieldset class="form-group col-2">
            <label for="for_nacionality">Nacionalidad</label>
            <select name="nacionality" id="for_nacionality" class="form-control">
                <option value="CL-Chile">Chile</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_ethnicity">Pueblo originario</label>
            <select name="ethnicity" id="for_ethnicity" class="form-control">
                <option value=""></option>
                @foreach($aboriginals as $aboriginal)
                    <option value="{{ $aboriginal['code'] }}">{{ $aboriginal['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

    </div>

    <div class="border-bottom mt-3 mb-3"></div>

    <div class="form-row">
        <fieldset class="form-group col-2">
            <label for="for_marital_status">Estado Civil</label>
            <select name="marital_status" id="for_marital_status" class="form-control" required>
                <option value=""></option>
                @foreach($maritalStatus as $status)
                    <option value="{{ $status['code'] }}">{{ $status['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_instrucionLevel">Nivel de Instrucción</label>
            <select name="instrucionLevel" id="for_instrucionLevel" class="form-control">
                @foreach($instructionLevel as $level)
                    <option value="{{ $level['code'] }}">{{ $level['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_prevision">Previsión</label>
            <select name="prevision" id="for_prevision" class="form-control">
                @foreach($previciones as $previcion)
                    <option value="{{ $previcion['code'] }}">{{ $previcion['display'] }}</option>
                @endforeach
            </select>
        </fieldset>
    </div>

    <div class="border-bottom mt-3 mb-3"></div>

    <div class="form-row">
        <fieldset class="form-group col-1">
            <label for="for_addressType">Tipo de dirección</label>
            <select name="addressType" id="for_addressType" class="form-control">
                <option value="particular">Particular</option>
                <option value="work">Trabajo</option>
            </select>
        </fieldset>


        <fieldset class="form-group col-1">
            <label for="for_streeNameType">Via de acceso</label>
            <select name="streeNameType" id="for_streeNameType" class="form-control">
                @foreach($streetTypes as $type)
                    <option value="{{ $type['code'] }}">{{ $type['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_streetName">Calle</label>
            <input type="text" class="form-control" name="streetName"
                id="for_streetName" required value="{{ substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 10) }}">
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_addressNumber">Número</label>
            <input type="text" class="form-control" name="addressNumber"
                id="for_addressNumber" required value="{{ substr(str_shuffle('0123456789'), 0, 4) }}">
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_addressApartament">Depto</label>
            <input type="text" class="form-control" name="addressApartament"
                id="for_addressApartament" required value="{{ substr(str_shuffle('0123456789'), 0, 2) }}">
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_poblacion">Población/Villa/Condominio</label>
            <input type="text" class="form-control" name="poblacion"
                id="for_poblacion" required value="{{ substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 10) }}">
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_district">Comuna</label>
            <select name="district" id="for_district" class="form-control">
                @foreach($communes as $commune)
                    <option value="{{ $commune['code'] }}">{{ $commune['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_state">Región</label>
            <select name="state" id="for_state" class="form-control">
                @foreach($regions as $region)
                    <option value="{{ $region['code'] }}">{{ $region['display'] }}</option>
                @endforeach
            </select>
        </fieldset>

    </div>


    <div class="form-row">
        <fieldset class="form-group col-1">
            <label for="for_latitud">Latitud</label>
            <input type="text" class="form-control" name="latitud"
                id="for_latitud" required value="{{ substr(str_shuffle('0123456789'), 0, 8) }}">
        </fieldset>
        <fieldset class="form-group col-1">
            <label for="for_longitud">Longitud</label>
            <input type="text" class="form-control" name="longitud"
                id="for_longitud" required value="{{ substr(str_shuffle('0123456789'), 0, 8) }}">
        </fieldset>
        <fieldset class="form-group col-2">
            <label for="for_city">Ciudad</label>
            <input type="text" class="form-control" name="city"
                id="for_city" required value="Iquique">
        </fieldset>
        <fieldset class="form-group col-2">
            <label for="for_conutry">País</label>
            <select name="conutry" id="for_conutry" class="form-control">
                <option value="01">Chile</option>
            </select>
        </fieldset>

    </div>

    <div class="border-bottom mt-3 mb-3"></div>

    <div class="form-row">

        <fieldset class="form-group col-1">
            <label for="for_phone1System">System</label>
            <select name="phone1System" id="for_phone1System" class="form-control">
                <option value="phone">Telefono</option>
                <option value="mobile">Móvil</option>
                <option value="email">Email</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_phone1">Teléfono 1</label>
            <input type="text" class="form-control" name="phone1"
                id="for_phone1" required value="9{{ substr(str_shuffle('0123456789'), 0, 8) }}">
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_phone2System">System</label>
            <select name="phone2System" id="for_phone2System" class="form-control" readonly>
                <option value="phone">Telefono</option>
                <option value="mobile">Móvil</option>
                <option value="email">Email</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_phone2">Teléfono 2</label>
            <input type="text" class="form-control" name="phone2"
                id="for_phone2" readonly>
        </fieldset>

        <fieldset class="form-group col-2">
            <label for="for_email">Correo Electrónico</label>
            <input type="text" class="form-control" name="email"
                id="for_email" required value="{{ substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 5) }}@gmail.com">
        </fieldset>


    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>
@endsection
