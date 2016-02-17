<ul class="nav" id="side-menu">
    <li class="sidebar-search">
        <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Procurar...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        <!-- /input-group -->
    </li>
    <li>
        <a href="{{ url ('') }}"><i class="fa fa-dashboard fa-fw"></i> Home</a>
    </li>
    <li>
        <a href="#">@include('widgets.icon',['class'=>'sitemap']) Sensores <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ url ('admin/sensor/create') }}">Novo Sensor</a>
            </li>
            <li>
                <a href="{{ url ('admin/sensor') }}">Lista de Sensores</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">@include('widgets.icon',['class'=>'tree']) Ambientes <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ url ('admin/ambient/create') }}">Novo Ambiente</a>
            </li>
            <li>
                <a href="{{ url ('admin/ambient') }}">Lista de Ambientes</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">@include('widgets.icon',['class'=>'tasks']) Leituras<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ url ('admin/scan') }}">Últimas Leituras</a>
            </li>
            <li>
                <a href="{{ url ('admin/scan/all') }}">Todas as Leituras</a>
            </li>
            <li>
                <a href="{{ url ('admin/scan/sensor') }}">Leituras por Sensor</a>
            </li>
            <li>
                <a href="{{ url ('admin/scan/ambient') }}">Leituras por Ambiente</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">@include('widgets.icon',['class'=>'bar-chart']) Gráficos<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ url ('admin/chart/sensor') }}">Sensor</a>
            </li>
           <li>
                <a href="{{ url ('admin/chart/ambient') }}">Ambiente</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">@include('widgets.icon',['class'=>'file-pdf-o']) Relatórios<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="{{ url ('panels') }}">Panels and Collapsibles</a>
            </li>
            <li>
                <a href="{{ url ('buttons' ) }}">Buttons</a>
            </li>
            <li>
                <a href="{{ url('notifications') }}">Alerts</a>
            </li>
            <li>
                <a href="{{ url ('typography') }}">Typography</a>
            </li>
            <li>
                <a href="{{ url ('icons') }}"> Icons</a>
            </li>
            <li>
                <a href="{{ url ('grid') }}">Grid</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
</ul>