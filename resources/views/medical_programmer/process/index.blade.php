@extends('layouts.app')

@section('content')

@include('medical_programmer.nav')

<h2 class="mb-3">Listado de Procesos</h2>
<a class="btn btn-primary mb-2" href="{{ route('medical_programmer.process.create') }}">
    <i class="fas fa-plus"></i> Agregar
</a>


<table class="table table-sm table-borderer table-responsive-xl">
    <thead>
        <tr>
            <th>Id</th>
            <th>Actividad Madre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $processes as $process )
        <tr>
            <td>{{ $process->id }}</td>
            <td>{{ $process->name }}</td>
            <td>
      				<a href="{{ route('medical_programmer.process.edit', $process) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('medical_programmer.process.destroy', $process) }}" class="d-inline">
      					@csrf
      					@method('DELETE')
      					<button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Está seguro de eliminar la información?');">
      						<span class="fas fa-trash-alt" aria-hidden="true"></span>
      					</button>
      				</form>
      			</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection