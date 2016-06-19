<!-- resources/views/sensors/index.blade.php -->
@extends('layouts.dashboard')

@section('title','Sensores')

@section('page_title','Sensores')

@section('page_subtitle','Todos os Sensores')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-sitemap"></i> Sensores</li>
    <li class="active">Lista de Sensores</li>
@endsection

@section('content')

<!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-sitemap"></i> Lista de Sensores</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
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
                    <td>
                        @if(is_null($sensor->ambient))
                            <a href="{{url('admin/sensor/'.$sensor->id_sensor.'/edit')}}"><i class="fa fa-plus"></i> Adicionar Ambiente</a>
                        @else
                            <a href="{{url('admin/ambient/'.$sensor->ambient->id_ambient)}}">{{ $sensor->ambient->id_ambient." - ".$sensor->ambient->description}}</a>
                        @endif
                    </td>
                    <td>{{ ($sensor->active == 1 ? "Sim" : "Não") }}</td>
                    <td>{{ $sensor->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ url('admin/sensor/'.$sensor->id_sensor) }}"><button type="button" class="btn btn-primary btn-flat"><i class="fa fa-eye"></i> Visualizar</button></a>

                        <!-- Edit Button -->
                        <a href="{{ url('admin/sensor/'.$sensor->id_sensor.'/edit') }}"><button type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Editar</button></a>
                        
                        @if($sensor->active)
                            <!-- Deactivate Button -->
                            <a href="{{ url('admin/sensor/'.$sensor->id_sensor.'/deactivate') }}"><button type="button" class="btn btn-danger btn-flat"><i class="fa fa-toggle-on"></i> Desativar</button></a>
                        @else
                            <!-- Activate Button -->
                            <a href="{{ url('admin/sensor/'.$sensor->id_sensor.'/activate') }}"><button type="button" class="btn btn-success btn-flat"><i class="fa fa-toggle-off"></i> Ativar</button></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $sensors->render() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection

@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

@endsection