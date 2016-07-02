<!-- resources/views/ambients/index.blade.php -->
@extends('layouts.dashboard')

@section('title','Ambientes')

@section('page_title','Ambientes')

@section('page_subtitle','Todos os Ambientes')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-tree"></i> Ambientes</li>
    <li class="active">Lista de Ambientes</li>
@endsection

@section('content')

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tree"></i> Lista de Ambientes</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        
      </div>
    </div>
    <div class="box-body">
        <table id="ambients" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Temperatura Máx</th>
                    <th>Temperatura Min</th>
                    <th>Umidade Ar Máx</th>
                    <th>Umidade Ar Min</th>
                    <th>Umidade Solo Máx</th>
                    <th>Umidade Solo Min</th>
                    <th>Última Alteração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot> 
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Temperatura Máx</th>
                    <th>Temperatura Min</th>
                    <th>Umidade Ar Máx</th>
                    <th>Umidade Ar Min</th>
                    <th>Umidade Solo Máx</th>
                    <th>Umidade Solo Min</th>
                    <th>Última Alteração</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($ambients as $ambient)
                <tr>
                    <td>{{ $ambient->id_ambient }}</td>
                    <td>{{ $ambient->description }}</td>
                    <td>{{ $ambient->max_temperature }}</a></td>
                    <td>{{ $ambient->min_temperature }}</td>
                    <td>{{ $ambient->max_air_humidity }}</td>
                    <td>{{ $ambient->min_air_humidity }}</td>
                    <td>{{ $ambient->max_ground_humidity }}</td>
                    <td>{{ $ambient->min_ground_humidity }}</td>
                    <td>{{ $ambient->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ url('admin/ambient/'.$ambient->id_ambient) }}"><button type="button" class="btn btn-primary btn-flat"><i class="fa fa-eye"></i> Visualizar</button></a>

                        <!-- Edit Button -->
                        <a href="{{ url('admin/ambient/'.$ambient->id_ambient.'/edit') }}"><button type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Editar</button></a>
                        
                        <!-- Sensors Button -->
                        <a href="{{ url('admin/sensor/ambient/'.$ambient->id_ambient) }}"><button type="button" class="btn btn-flat"><i class="fa fa-sitemap"></i> Sensores</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $ambients->render() !!}
    </div>
    <!-- /.box-body -->
    
  </div>
  <!-- /.box -->

@endsection

<!-- Scripts -->
@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

@endsection