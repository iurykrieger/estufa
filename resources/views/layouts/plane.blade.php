<!DOCTYPE html>
<!--[if IE 8]> <html lang="pt-br" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="pt-br" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Estufa | @yield('title')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />
	@yield('css')
</head>
<body>
	@yield('body')
	<script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
	@yield('scripts')
</body>
</html>