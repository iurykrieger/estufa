<!-- resources/views/users/index.blade.php -->
@extends('layouts.dashboard')

@section('title','Usuários')

@section('page_title','Usuários')

@section('page_subtitle','Todos os Usuários')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-user"></i> Usuários</li>
    <li class="active">Lista de Usuários</li>
@endsection

@section('content')

<!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-user"></i> Lista de Usuários</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
        <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                    <th>Data de Ingresso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot> 
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                    <th>Data de Ingresso</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id_user }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->description }}</td>
                    <td>{{ ($user->active == 1 ? "Sim" : "Não")  }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ url('admin/user/account/'.$user->id_user) }}"><button type="button" class="btn btn-primary btn-flat"><i class="fa fa-eye"></i> Visualizar</button></a>

                        <!-- Edit Button -->
                        <a href="{{ url('admin/user/account/'.$user->id_user.'/edit') }}"><button type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Editar</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->render() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection

@section('scripts')

<!-- DataTables -->
@include('common.dataTables')

@endsection