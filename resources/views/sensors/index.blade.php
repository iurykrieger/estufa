<!-- resources/views/sensors/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Sensores')

@section('page_heading','Sensores')

@section('content')

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
                <!-- Show Button -->
                <a href="{{ url('admin/sensor/'.$sensor->id_sensor) }}"><button type="button" class="btn btn-primary">@include('widgets.icon',['class'=>'eye']) Visualizar</button></a>

                <!-- Edit Button -->
                <a href="{{ url('admin/sensor/'.$sensor->id_sensor.'/edit') }}"><button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'pencil']) Editar</button></a>
                
                <!-- Destroy Form Button -->
                {!! Form::open(['method' => 'DELETE','url' => 'admin/sensor/'.$sensor->id_sensor, 'class' => 'action-form', 'id' => 'form-delete']) !!}
                {!! csrf_field() !!}
                {!! Form::button('<i class="fa fa-times"></i> Remover', ['class' => 'btn btn-danger', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $sensors->render() !!}

@endsection

@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

@endsection