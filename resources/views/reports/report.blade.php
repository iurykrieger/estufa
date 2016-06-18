<!-- resources/views/reports/reporting.blade.php -->
@extends('layouts.dashboard')

@section('title','Relatórios')

@section('page_title','Relatório Teste')

@section('page_subtitle','Relatório Teste')

@section('breadcrumb')
    <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-tree"></i> Relatórios</li>
    <li class="active">Vizualisar Relatório</li>
@endsection

@section('content')

<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-tree"></i> Vizualização do Relatório</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="box-header">
			<h3 class="box-title">RELATÓRIO TESTE</h3><br>
		</div>
		<div class="box-body">
		    <form class="form-horizontal" role="form" method="POST" action="/reporting">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-primary">GERAR</button>
                    </div>
                </div>
        	</form>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

@endsection