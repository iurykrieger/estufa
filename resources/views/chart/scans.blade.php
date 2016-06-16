<!-- resources/views/chart/scans.blade.php -->
@extends('layouts.dashboard')

@section('title','Gráfico')
@section('page_title','Gráfico')
@section('page_subtitle','Leituras')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-bar-chart"></i> Gráficos</li>
    <li class="active"> Leituras</li>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-bar-chart"></i> Gráfico Leituras</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
        {!! Form::open(['url' => 'admin/chart/scans']) !!}
        {!! csrf_field() !!}

        <form class="form-inline"> 

            <div class="col-xs-2">
              {!! Form::label('dataInicial', 'Data Inicial:', ['class' => 'control-label']) !!}
              {!! Form::text('dataInicial', null, ['class' => 'form-control','placeholder'=> 'Data Inicial']) !!}
            </div>
            <div class="col-xs-2">
              {!! Form::label('dataFinal', 'Data Final:', ['class' => 'control-label']) !!}
              {!! Form::text('dataFinal', null, ['class' => 'form-control','placeholder'=> 'Data Final']) !!}
            </div>

            <div class="col-xs-2">
            {!! Form::label('id_sensor', 'Sensor:', ['class' => 'control-label']) !!}
            {!! Form::select('description', $sensores, null, ['class' => 'form form-control']) !!}
            </div>
            <div class="col-xs-2">
              {!! Form::label('id_ambient', 'Ambientes:', ['class' => 'control-label']) !!}
              {!! Form::select('id_ambient', $ambientes, null, ['class' => 'form form-control']) !!}
            </div>  

            <div class="col-xs-2">                
            {!!Form::button('<i class="fa fa-save"></i> Consultar', array('type' => 'submit', 'class' => 'btn btn-primary btn-flat'))!!}
            </div> 

            <div>                
              <label class="checkbox-inline"><input type="checkbox" value="">Limite Máximo</label>
              <label class="checkbox-inline"><input type="checkbox" value="">Limite Mínimo</label>
            </div> 

              
          </div>
              
                <div id="temps_div" class=""></div>

            
        </form>

    {!! Form::close() !!}
    </div>
    <!-- /.box-body -->    
  </div>
  <!-- /.box -->
@endsection

@section('scripts')
   @linechart('grafico', 'temps_div') 
@endsection
