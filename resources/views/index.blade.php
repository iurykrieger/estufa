<!-- resources/views/index.blade.php -->
@extends('layouts.dashboard')

@section('title','Home')

@section('page_title','Projeto<b>ESTUFA</b>')

@section('page_subtitle','Home')

@section('parent_breadcrumb','Home')

@section('content')
	<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $todayScanCount }}</h3>

              <p>Novas Leituras Hoje</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="{{ url('admin/scan') }}" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $todayScanAvgs['temperature'] }}<sup style="font-size: 20px">ºC</sup></h3>

              <p>Média de Temperatura Hoje</p>
            </div>
            <div class="icon">
              <i class="fa fa-sun-o"></i>
            </div>
            <a href="#" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $todayScanAvgs['air_humidity'] }}<sup style="font-size: 20px">%</sup></h3>

              <p>Média de Umidade do Ar Hoje</p>
            </div>
            <div class="icon">
              <i class="fa fa-cloud"></i>
            </div>
            <a href="#" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $todayScanAvgs['ground_humidity'] }}<sup style="font-size: 20px">%</sup></h3>

              <p>Média de Umidade do Solo Hoje</p>
            </div>
            <div class="icon">
              <i class="fa fa-area-chart"></i>
            </div>
            <a href="#" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Today Scans -->
          <div class="box box-success">
            <div class="box-header with-border">
              <i class="fa fa-line-chart"></i>
              <h3 class="box-title">Resumo de Hoje</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body chat" id="chat-box">
              <div id="todayScans" class=""></div>
              @linechart('todayScans', 'todayScans')
            </div>
          </div>
         
        </section>
        <!-- /.Left col -->

      </div>
      <!-- /.row (main row) -->

    </section>
@endsection