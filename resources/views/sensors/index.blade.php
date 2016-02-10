<!-- resources/views/sensors/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Sensores')

@section('page_heading','Sensores')

@section('content')

<div class="dataTables_wrapper form-inline dt-bootstrap">
	<div class="col-sm-6">
		<div class="dataTables_length" id="scans_length">
			<label>
				Mostrando 
				<select id="paginator" name="paginate" aria-controls="scans" class="form-control input-sm">
					@foreach ($sizes as $value)
					<option value="{{ $value }}" {{ ($value == $sensors->perPage() ? "selected":"") }}>{{ $value }}</option>
					@endforeach
				</select>
				sensores por página
			</label>
		</div>
	</div>
</div>

<table id="sensors" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Descrição</th>
			<th>Ambiente</th>
			<th>Ativo</th>
			<th>Última Alteração</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>Descrição</th>
			<th>Ambiente</th>
			<th>Ativo</th>
			<th>Última Alteração</th>
			<th>Ações</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach ($sensors as $sensor)
		<tr>
			<td>{{ $sensor->id_sensor }}</td>
			<td>{{ $sensor->description }}</td>
			<td><a href="{{url('admin/ambient/'.$sensor->ambient->id_ambient)}}">{{ $sensor->ambient->id_ambient." - ".$sensor->ambient->description}}</a></td>
			<td>{{ ($sensor->active == 1 ? "Sim" : "Não") }}</td>
			<td>{{ $sensor->updated_at->format('d/m/Y H:i:s') }}</td>
			<td>
				<button>@include('widgets.icon',['class'=>'times'])</button>
				<button>@include('widgets.icon',['class'=>'pencil'])</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $sensors->render() !!}

@endsection

@section('scripts')

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		$('#scans').DataTable({
			language: {
				"lengthMenu": "Mostrando _MENU_ leituras por página",
				"zeroRecords": "Nada encontrado",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Sem registros",
				"infoFiltered": "(Filtrado de _MAX_ registros totais)",
				"search": "Buscar:",
				"paginate": {
					"first":      "Primeiro",
					"last":       "Último",
					"next":       "Próximo",
					"previous":   "Anterior"
				},
			},
			order: [[ 1, "desc" ],[2 , "desc"]],
			responsive: true,
			pageLength: 50,
			paging:false,
		});
		$('#paginator').bind('change', function () {
			var path = '/admin/';
			var pathname = window.location.pathname.split( '/' );
			var url = path + pathname[2] + '/' +$(this).val(); 
			if (url) {
				window.location = url; 
			}
			return false;
		});
	} );
</script>

@endsection