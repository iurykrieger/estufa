<!-- resources/views/ambients/ambientSensors.blade.php -->
@extends('layouts.dashboard')

@section('title','Sensores do Ambiente - '.$selectedAmbient->description)

@section('page_title','Sensores por Ambiente')

@section('page_subtitle',$selectedAmbient->description)

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-sitemap"></i> Sensores</li>
    <li class="active">Lista de Sensores</li>
@endsection

@section('content')

<!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-sitemap"></i> Sensores por Ambiente</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
       <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="col-sm-6">
                <div class="dataTables_length" id="scans_length">
                    Mostrando Sensores do ambiente
                    <select id="dropdown" name="paginate" aria-controls="scans" class="form-control input-sm" style="width: 150px">
                        @foreach ($ambients as $ambient)
                        <option value="{{ $ambient->id_ambient }}" {{ ($ambient == $selectedAmbient ? "selected":"") }}>{{ $ambient->id_ambient . " - " . $ambient->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                {!! Form::open(['method' => 'DELETE','url' => 'admin/sensor/multipleDestroy', 'class' => 'action-form inline', 'id' => 'form-delete']) !!}
                {!! csrf_field() !!}
                {!! Form::button('<i class="fa fa-trash"></i> Remover Sensores', ['class' => 'btn btn-danger btn-flat pull-right', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
            </div>
        </div>
        <hr>
        <hr>
        <table id="sensors" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><i class="fa fa-trash"></i> Remover</th>
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
                    <td>{!! Form::checkbox('sensors[]', $sensor->id_sensor, null, ['style' => 'margin: 0; padding: 0;']) !!}</td>
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
    </div>
    <!-- /.box-body -->
    
  </div>
  <!-- /.box -->

@endsection

@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

<!-- Ambient Dropdown -->
@include('common.dynamicDropdown',['baseRoute' => 'admin/sensor/ambient'])

@endsection