<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="header">NAVEGAÇÃO PRINCIPAL</li>
    <li >
      <a href="{{ url('admin') }}">
        <i class="fa fa-dashboard"></i> <span>Home</span>
    </a>
</li>
<!-- Sensors Menu Item -->
<li class="treeview">
    <a href="#">
        <i class="fa fa-sitemap"></i>
        <span>Sensores</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url ('admin/sensor/create') }}"><i class="fa fa-circle-o"></i> Novo Sensor</a></li>
        <li><a href="{{ url ('admin/sensor') }}"><i class="fa fa-circle-o"></i> Lista de Sensores</a></li>
        <li><a href="{{ url ('admin/sensor/ambient/') }}"><i class="fa fa-circle-o"></i> Sensores por Ambiente</a></li>
    </ul>
</li>

<!-- Ambients Menu Item -->
<li class="treeview">
    <a href="#">
        <i class="fa fa-tree"></i>
        <span>Ambientes</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url ('admin/ambient/create') }}"><i class="fa fa-circle-o"></i> Novo Ambiente</a></li>
        <li><a href="{{ url ('admin/ambient') }}"><i class="fa fa-circle-o"></i> Lista de Ambientes</a></li>
    </ul>
</li>

<!-- Scans Menu Item -->
<li class="treeview">
    <a href="#">
        <i class="fa fa-tasks"></i>
        <span>Leituras</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url ('admin/scan') }}"><i class="fa fa-circle-o"></i> Últimas Leituras</a></li>
        <li><a href="{{ url ('admin/scan/all') }}"><i class="fa fa-circle-o"></i> Todas as Leituras</a></li>
        <li><a href="{{ url ('admin/scan/sensor') }}"><i class="fa fa-circle-o"></i> Leituras por Sensor</a></li>
        <li><a href="{{ url ('admin/scan/ambient') }}"><i class="fa fa-circle-o"></i> Leituras por Ambiente</a></li>
    </ul>
</li>

<!-- Charts Menu Item -->
<li class="treeview">
    <a href="#">
        <i class="fa fa-bar-chart"></i>
        <span>Gráficos</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url ('admin/chart/scans') }}"><i class="fa fa-circle-o"></i>Leituras</a></li>
    </ul>
</li>

<!-- Reports Menu Item -->
<li class="treeview">
    <a href="#">
        <i class="fa fa-file-pdf-o"></i>
        <span>Relatórios</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url ('/admin/report/scan') }}"><i class="fa fa-circle-o"></i> Leituras</a></li>
    </ul>
</li>

<li class="header">OPÇÕES DE ADMINISTRADOR</li>
<!-- Sensors Menu Item -->
<li class="treeview">
    <a href="#">
        <i class="fa fa-sitemap"></i>
        <span>Usuário</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url ('admin/sensor/create') }}"><i class="fa fa-circle-o"></i> Registrar Usuário</a></li>
        <li><a href="{{ url ('admin/sensor') }}"><i class="fa fa-circle-o"></i> Lista de Usuários</a></li>
    </ul>
</li>
</ul>