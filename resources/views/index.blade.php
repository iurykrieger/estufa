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
        <section class="col-lg-7 connectedSortable">
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
        <!-- Right Col -->
        <section class="col-lg-5 connectedSortable">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Últimos Sensores Ativos</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <!-- /.item -->
                @for ($i = 0; $i < count($lastSensors); $i++)
                  <li class="item">
                    <div class="product-img">
                      <i class="fa fa-sitemap fa-2x"></i>
                    </div>
                     <div class="product-info">
                      <a href="{{ url('/admin/sensor/'.$lastSensors[$i]->id_sensor) }}" class="product-title">{{ $lastSensors[$i]->description}} <span class="label label-success pull-right">{{ $lastAmbients[$i]->description}}</span></a>
                    </div>
                  </li>
                @endfor
          <!-- /.item -->
            </ul>
          </div><!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{ url('/admin/sensor') }}" class="uppercase">Ver Todos os Sensores</a>
          </div><!-- /.box-footer -->
        </div><!-- /.box -->

        <!-- AMBIENTS AVG -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Média Ambientes</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <!-- /.item -->
                @for ($i = 0; $i < count($avgAmbients); $i++)
                  <li class="item">
                    <div class="product-img">
                      <i class="fa fa-tree fa-2x"></i>
                    </div>
                     <div class="product-info">
                      <a href="{{ url('/admin/ambient/'.$avgAmbients[$i]->id_ambient) }}" class="product-title">{{ $avgAmbients[$i]->description}} 
                        <span class="label label-warning pull-right" style="margin-right: 5px;" data-toggle="tooltip" title="Umidade Solo">{{ $avgAmbients[$i]->ground_humidity}}</span>
                        <span class="label label-danger pull-right" style="margin-right: 5px;" data-toggle="tooltip" title="Umidade Ar">{{ $avgAmbients[$i]->air_humidity}}</span>
                        <span class="label label-info pull-right" style="margin-right: 5px;" data-toggle="tooltip" title="Temperatura">{{ $avgAmbients[$i]->temperature}}</span>
                      </a>
                    </div>
                  </li>
                @endfor
          <!-- /.item -->
            </ul>
          </div>
          <div class="box-footer text-center">
            <a href="{{ url('/admin/ambient') }}" class="uppercase">Ver Todos os Ambientes</a>
          </div>

          <!-- /.box-footer -->
        </div><!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
@endsection