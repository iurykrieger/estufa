<!-- resources/views/reports/scan.blade.php -->
@extends('layouts.dashboard')

@section('title','Relatórios de Leituras')

@section('page_title','Relatórios')

@section('page_subtitle','Leituras')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-file-pdf-o"></i> Relatórios</li>
    <li class="active">Leituras</li>
@endsection

@section('content')

<!-- Filter Box -->
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-search"></i> Filtros</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
    	{!! Form::open(['method' => 'POST','url' => 'admin/report/scan', 'class' => 'action-form form-inline', 'id' => 'form-dates']) !!}
    	<div class="box-header">
			<h3 class="box-title">PERÍODO</h3><br>
		</div>
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('initialDate', ' De ', ['class' => 'control-label']) !!}
				{!! Form::input('date','initialDate', null, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('endDate', ' até ', ['class' => 'control-label']) !!}
				{!! Form::input('date','endDate', null, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
				{!! Form::input('time','initialTime', null, ['class' => 'form-control', 'placeholder' => 'Time']) !!}
				{!! Form::input('time','endTime', null, ['class' => 'form-control', 'placeholder' => 'Time']) !!}
			</div> 
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">AMBIENTE</h3><br>
		</div>
		<div class="box-body">
			<div class="form-group">
				<select id="dropdown" name="ambient" aria-controls="ambient" class="form-control input-sm" style="width: 150px">
					<option value="">-- TODOS --</option>
					@foreach ($ambients as $ambient)
					<option value="{{ $ambient->id_ambient }}">{{ $ambient->id_ambient . " - " . $ambient->description }}</option>
					@endforeach
				</select>
			</div>    
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">SENSOR</h3><br>
		</div>
		<div class="box-body">
			<div class="form-group">
				<select id="dropdown" name="sensor" aria-controls="sensor" class="form-control input-sm" style="width: 150px">
					<option value="">-- TODOS --</option>
					@foreach ($sensors as $sensor)
					<option value="{{ $sensor->id_sensor }}">{{ $sensor->id_sensor . " - " . $sensor->description }}</option>
					@endforeach
				</select>
			</div>    
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">LIMITE DE REGISTROS</h3><br>
		</div>
		<div class="box-body">
			<div class="form-group">
				<select id="dropdown" name="limit" aria-controls="limit" class="form-control input-sm" style="width: 150px">
					<option value="">-- ILIMITADO --</option>
					@for ($i = 3000; $i >= 50; $i = $i - 50)
					<option value="{{ $i }}">{{ $i }}</option>
					@endfor 
				</select>
			</div>    
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title">AGRUPAMENTO</h3><br>
		</div>
		<div class="box-body">
			<div class="form-group">
				<select id="dropdown" name="group" aria-controls="limit" class="form-control input-sm" style="width: 150px">
					<option value="id_scan">LEITURA</option>
					<option value="id_sensor">SENSOR</option>
					<option value="id_ambient">AMBIENTE</option>
					<option value="date">DATA</option>
					<option value="time">HORA</option>
					<option value="day">DIA</option>
				</select>
			</div>    
		</div>
		<hr>
		{!! Form::button('<i class="fa fa-file-pdf-o"></i> Gerar Relatório', ['class' => 'btn btn-primary btn-flat pull-right', 'id' => 'btn-search', 'type' => 'submit']) !!}
		{!! Form::close() !!}
    </div>

    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection

@section('scripts')

@endsection
