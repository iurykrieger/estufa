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
            <div class="box-body">
              <div class="col-xs-2">
                {!! Form::label('initialDate', ' De ', ['class' => 'control-label']) !!}
                {!! Form::input('date','initialDate', null, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
              </div>

                <div class="col-xs-2">
                  {!! Form::label('endDate', ' até ', ['class' => 'control-label']) !!}
                  {!! Form::input('date','endDate', null, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
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
