<!-- resources/views/ambients/ambientSensors.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Ambiente - Sensores')

@section('page_heading')
	Sensores do ambiente {{ $selectedAmbient->description }}
@endsection

@section('content')

<div class="dataTables_wrapper form-inline dt-bootstrap">
	<div class="col-sm-6">
		<div class="dataTables_length" id="scans_length">
			<label>
				Mostrando Sensores do ambiente 
				<select id="dropdown" name="paginate" aria-controls="scans" class="form-control input-sm" style="width: 150px">
					@foreach ($ambients as $ambient)
					<option value="{{ $ambient->id_ambient }}" {{ ($ambient == $selectedAmbient ? "selected":"") }}>{{ $ambient->id_ambient . " - " . $ambient->description }}</option>
					@endforeach
				</select>
			</label>
		</div>
	</div>
</div>

{!! Form::open(['url' => 'admin/ambient']) !!}
{!! Form::submit('Salvar Novo Ambiente', ['class' => 'btn btn-primary']) !!}

<table id="sensors" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Remover</th>
            <th>ID</th>
            <th>Descrição</th>
            <th>Ambiente</th>
            <th>Ativo</th>
            <th>Última Alteração</th>
        </tr>
    </thead>
    <tfoot> 
        <tr>
            <th>Remover</th>
            <th>ID</th>
            <th>Descrição</th>
            <th>Ambiente</th>
            <th>Ativo</th>
            <th>Última Alteração</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach ($sensors as $sensor)
        <tr>
            <td>{!! Form::checkbox('options['.$sensor->id_sensor.']', $sensor->id_sensor, null, ['style' => 'margin: 0; padding: 0;']) !!}</td>
            <td>{{ $sensor->id_sensor }}</td>
            <td>{{ $sensor->description }}</td>
            <td><a href="{{url('admin/ambient/'.$sensor->ambient->id_ambient)}}">{{ $sensor->ambient->id_ambient." - ".$sensor->ambient->description}}</a></td>
            <td>{{ ($sensor->active == 1 ? "Sim" : "Não") }}</td>
            <td>{{ $sensor->updated_at->format('d/m/Y H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $sensors->render() !!}
{!! Form::close() !!}

@endsection

@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

<!-- Ambient Dropdown -->
@include('common.dynamicDropdown',['baseRoute' => 'admin/ambient/sensors'])

@endsection