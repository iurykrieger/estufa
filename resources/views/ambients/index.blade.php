<!-- resources/views/ambients/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Ambientes')

@section('page_heading','Ambientes')

@section('content')

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
                <a href="{{ url('admin/ambient/'.$ambient->id_ambient) }}"><button type="button" class="btn btn-primary">@include('widgets.icon',['class'=>'eye']) Visualizar</button></a>

                <!-- Edit Button -->
                <a href="{{ url('admin/ambient/'.$ambient->id_ambient.'/edit') }}"><button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'pencil']) Editar</button></a>
                
                <!-- Sensors Button -->
                <a href="{{ url('admin/ambient/sensors/'.$ambient->id_ambient) }}"><button type="button" class="btn btn-info">@include('widgets.icon',['class'=>'sitemap']) Sensores</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $ambients->render() !!}

@endsection

@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

@endsection