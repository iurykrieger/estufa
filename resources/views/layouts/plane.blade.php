<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Estufa | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/plugins/iCheck/flat/blue.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/plugins/morris/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('/vendor/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Dat Tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
  <!-- PACE -->
  <link rel="stylesheet" href="{{ asset('css/pace.css') }}">
  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @yield('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-green sidebar-mini">
	
	<!-- Body of Dashboard -->
	@yield('body')
	<!-- /.Body of Dashboard -->

	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>$.widget.bridge('uibutton', $.ui.button);</script>
	<!-- Bootstrap 3.3.5 -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/morris/morris.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<!-- jvectormap -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/knob/jquery.knob.js') }}"></script>
	<!-- daterangepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- datepicker -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('/vendor/bower_components/AdminLTE/dist/js/app.min.js') }}"></script>
	<!-- SweetAlert -->
	<script src="{{ asset('js/sweetalert.js') }}"></script>
	<!-- PACE -->
	<script src="{{ asset('js/pace.js') }}"></script>
	<!-- CSRF -->
	<script type="text/javascript">
	    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	</script>

    @include('common.messages')

	@yield('scripts')

</body>
</html>