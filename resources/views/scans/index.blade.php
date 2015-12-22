<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('title','Home')

@section('page_heading','Home')

@section('content')

<table id="scans" class="table table-striped table-bordered" cellspacing="0" width="90%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Data</th>
			<th>Hora</th>
			<th>Temperatura</th>
			<th>Umidade do Ar</th>
			<th>Umidade do Solo</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>Data</th>
			<th>Hora</th>
			<th>Temperatura</th>
			<th>Umidade do Ar</th>
			<th>Umidade do Solo</th>
		</tr>
	</tfoot>
	<tbody>
		@foreach ($scans as $scan)
			<tr>
				<td>{{ $scan->id_scan }}</td>
				<td>{{ $scan->date }}</td>
				<td>{{ $scan->time }}</td>
				<td>{{ $scan->temperature }}</td>
				<td>{{ $scan->air_humidity }}</td>
				<td>{{ $scan->ground_humidity }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection

@section('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#scans').DataTable();
	} );
</script>

@endsection