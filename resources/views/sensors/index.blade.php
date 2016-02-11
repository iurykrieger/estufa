<!-- resources/views/sensors/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Sensores')

@section('page_heading','Sensores')

@section('content')

@include('common.messages')

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
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sensors').DataTable({
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
            order: [[ 4, "desc" ]],
            responsive: true,
            pageLength: 50,
            paging:false,
        });
    } );

    function confirmDelete(){
        event.preventDefault();
        swal({   
            title: "Você tem certeza que deseja deletar este sensor?",   
            text: "Você não poderá recuperar este registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",  
            confirmButtonText: "Sim, remover!",   
            cancelButtonText: "Não, cancelar!",   
            closeOnConfirm: false,
         }, 
         function(isConfirm){   
            if (isConfirm) {    
                $("#form-delete").submit();
            }
        });
    };
</script>

@append