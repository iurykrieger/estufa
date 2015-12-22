<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Estufa | @yield('title')</title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Flat UI -->
        <link rel="stylesheet" type="text/css" href="../css/flat-ui.min.css">

        <!-- Awsome Icons -->
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

        <!-- Application Style -->
        <link rel="stylesheet" type="text/css" href="../css/app.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="login">
                <div class="login-screen">
                    <div class="login-icon">
                        <i class="fa fa-leaf"></i>
                        <h4>Bem vindo ao <small>Projeto Estufa</small></h4>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>