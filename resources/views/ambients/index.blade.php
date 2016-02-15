<!-- resources/views/ambients/index.blade.php -->
@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
@endsection

@section('title','Ambientes')

@section('page_heading','Ambientes')

@section('content')

@include('common.messages')

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
                
                <!-- Destroy Form Button -->
                {!! Form::open(['method' => 'DELETE','url' => 'admin/ambient/'.$ambient->id_ambient, 'class' => 'action-form', 'id' => 'form-delete']) !!}
                {!! csrf_field() !!}
                {!! Form::button('<i class="fa fa-times"></i> Remover', ['class' => 'btn btn-danger', 'id' => 'btn-delete', 'type' => 'submit', 'onClick' => 'confirmDelete()']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $ambients->render() !!}

@endsection

@section('scripts')

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ambients').DataTable({
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
            title: "Você tem certeza que deseja deletar este ambiente?",   
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