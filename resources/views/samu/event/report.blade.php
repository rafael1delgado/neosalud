<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte Cometido</title>
        <meta name="description" content="Reporte de cometido">
        <meta name="author" content="Servicio de Salud Iquique">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="content">
            <img style="padding-bottom: 4px;" src="{{ asset('images/logo_samu.png') }}"
                width="120" alt="Logo Servicio de Salud Tarapacá"><br>


        <div class="titulo">INFORME DE COMETIDO {{ $event->id }}</div>

        <b>Fecha:</b> {{ $event->date->format('Y-m-d') }}

        <h4>Registro de la(s) llamadas:</h4>

        <table class="ocho">
            <thead>
                <tr>
                    <th style="width: 50px;">Hora</th>
                    <th>Solicitante</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>OPT</th>
                    <th>BLS</th>
                    <th>OP ID</th>
                </tr>
            </thead>
            <tbody>
                @if($event->call)
                    <tr>
                        <td class="center">{{ $event->call->hour->format('H:i') }}</td>
                        <td>{{ $event->call->applicant }}</td>
                        <td>{{ $event->call->full_address }} {{ optional($event->call->commune)->name }}</td>
                        <td class="right">{{ $event->call->telephone }}</td>
                        <td class="center">{{ $event->call->classification }}</td>
                        <td class="center">{{ optional($event->call->bls)->format('i:s') }}</td>
                        <td class="center">{{ $event->call->receptor_id }}</td>
                    </tr>
                    <tr>
                        <td colspan="6">{{ $event->call->sex_abbr }} {{ $event->call->age_format }} {{ $event->call->information }}</td>
                    </tr>
                    @foreach($event->call->associatedCalls as $associatedCall)
                    <tr>
                        <td colspan="6" style="border-left-style: hidden;border-right-style: hidden;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="center">{{ $associatedCall->hour->format('H:i') }}</td>
                        <td>{{ $associatedCall->applicant }}</td>
                        <td>{{ $associatedCall->full_address }} {{ optional($associatedCall->commune)->name }}</td>
                        <td class="right">{{ $associatedCall->telephone }}</td>
                        <td class="center">{{ $associatedCall->classification }}</td>
                        <td class="center">{{ $associatedCall->receptor_id }}</td>
                    </tr>
                    <tr>
                        <td colspan="6">{{ $associatedCall->sex_abbr }} {{ $associatedCall->age_format }} {{ $associatedCall->information }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td class="center" colspan="6">
                        No hay llamadas
                    </td>
                </tr>
                @endif
                {{-- @if(!$loop->last)
                    <tr><td colspan="6" style="border-left: 1px solid white; border-right: 1px solid white;">&nbsp;</td></tr>
                    @endif
                --}}
            </tbody>
        </table>


        <h4>Marcas de tiempo:</h4>

        <table class="ocho">
            <thead>
                <tr>
                    <th>Aviso de salida</th>
                    <th>Salida de móvil</th>
                    <th>Llegada al lugar</th>
                    <th>Ruta centro asistencial</th>
                    <th>En centro asistencial</th>
                    <th>Recepción paciente</th>
                    <th>Retorno a base</th>
                    <th>Móvil en base</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->departure_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->mobile_departure_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->mobile_arrival_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->route_to_healtcenter_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->healthcenter_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->patient_reception_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->return_base_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($event->on_base_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                </tr>
            </tbody>
        </table>

        <h4>Registros del cometido:</h4>

        <table class="ocho">
            <thead>
                <tr>
                    <th>C.I.</th>
                    <th>C.E.</th>
                    <th>QTC</th>
                    <th>MOVIL</th>
                    <th>TIPO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">{{ $event->key->key }}</td>
                    <td class="center">{{ optional($event->returnKey)->key }}</td>
                    <td class="center">{{ $event->counter }}</td>
                    <td class="center">
                        @if($event->mobileInService)
                            {{ optional($event->mobileInService)->mobile->code }} -
                            {{ optional($event->mobileInService)->mobile->name }}
                        @else
                            {{ optional($event->mobile)->code }} -
                            {{ optional($event->mobile)->name }}
                        @endif
                    </td>
                    <td class="center">
                        @if($event->mobileInService)
                            {{ optional(optional($event->mobileInService)->type)->name }}
                        @else
                            {{ optional(optional($event->mobile)->type)->name }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <h4>Información del paciente:</h4>

        <table class="ocho">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Tipo de identificación</th>
                    <th>Identificación</th>
                </tr>
            </thead>
            <tbody>
                <tr class="center">
                    <td>{{ $event->patient_name }}</td>
                    <td>{{ optional($event->identifierType)->text }}</td>
                    <td>{{ $event->patient_identification }}</td>
                </tr>
            </tbody>
        </table>

        <p><b>Clínico:</b> {{ $event->reception_detail }}</p>
        <p><b>Tratamiento:</b> {{ $event->treatment }}</p>

        <h4>Signos Vitales:</h4>

        <table class="vital-signs ocho">
            <thead>
                <tr>
                    <th>Fecha Hora</th>
                    <th>Frecuencia cardíaca</th>
                    <th>Frecuencia respiratoria</th>
                    <th>Presión arterial</th>
                    <th>Presión arterial media</th>
                    <th>Glasgow</th>
                    <th>% Saturación Oxig/Ambi</th>
                    <th>% Saturación Oxig/Apoyo</th>
                    <th>HGT mg/dl</th>
                    <th>Llene Capilar</th>
                    <th>Temperatura ºC</th>
                </tr>
            </thead>
            <tbody>
                @forelse($event->vitalSigns as $vitalSign)
                <tr>
                    <td class="center">
                        <small class="seis nowrap">
                            {{ optional($vitalSign->registered_at)->format('Y-m-d H:i') }}
                        </small>
                    </td>
                    <td class="center">{{ $vitalSign->fc ? $vitalSign->fc : '-' }}</td>
                    <td class="center">{{ $vitalSign->fr ? $vitalSign->fr : '-' }}</td>
                    <td class="center">{{ $vitalSign->pa ? $vitalSign->pa : '-' }}</td>
                    <td class="center">{{ $vitalSign->pam ? $vitalSign->pam : '-' }}</td>
                    <td class="center">{{ $vitalSign->gl ? $vitalSign->gl : '-' }}</td>
                    <td class="center">{{ $vitalSign->soam ? $vitalSign->soam : '-'}}</td>
                    <td class="center">{{ $vitalSign->soap ? $vitalSign->soap : '-'}}</td>
                    <td class="center">{{ $vitalSign->hgt ? $vitalSign->hgt : '-' }}</td>
                    <td class="center">{{ $vitalSign->fill_capillary ? $vitalSign->fill_capillary : '-' }}</td>
                    <td class="center">{{ $vitalSign->t ? $vitalSign->t : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td class="center" colspan="11">
                        <em>
                            No hay signos vitales
                        </em>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </ul>

    <h4>Información establecimiento o lugar de recepción:</h4>

    <table class="ocho">
        <thead>
            <tr>
                <th>Establecimiento o lugar</th>
                <th>Quien recepciona</th>
                <th>Registro Atención Urgencia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">
                    {{ optional($event->establishment)->name }}
                    {{ optional($event->receptionPlace)->name }}
                    {{ $event->establishment_details }}
                </td>
                <td class="center">{{ $event->reception_person }}</td>
                <td class="center">{{ $event->rau }}&nbsp;</td>
            </tr>
        </tbody>
    </table>

    <h4>Tripulación móvil:</h4>

    @if($event->mobileInService)
    <table class="ocho">
        <thead>
            <tr>
                <th style="width: 200px;">Función</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->crew as $user)
            <tr>
                <td>{{ optional($user->pivot)->JobType->name }}</td>
                <td>{{ optional($user)->officialFullName }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        {{ $event->external_crew }}
    @endif

    <h4>Centro Regulador:</h4>

    <table class="ocho">
        <thead>
            <tr>
                <th style="width: 200px;">Función</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event->jobs as $job)
                <tr>
                    <td>{{ optional($job->pivot)->JobType->name }}</td>
                    <td>{{ optional($job)->officialFullName }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pie_pagina seis center">
        <span class="uppercase">Servicio de Salud Tarapacá</span><br>
        Anibal Pinto #815, Iquique -
        Fono: 572409495 -
        www.saludiquique.cl
    </div>
</div>

</body>
</html>
