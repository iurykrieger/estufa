<!DOCTYPE html>
<html>
<head>
    <title>Ops! Algo saiu errado</title>
    <meta charset="utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            padding: 5%;
        }

        .content{
            margin: 0 auto;
            overflow: auto;
            padding-top: 5%;
        }

        .title{
            font-size: 4em;
            text-align: center;
            color: #888888;
        }

        .left{
            float: left;
            width: 60%;
        }

        .right{
            width: 40%;
            float: right;
            margin-top: 5%;
        }

        .image{
            margin: 0 auto;
            width: 80%;
            padding-top: 4%;
        }

        p{
            text-align: left;
            font-size: 3em;
            font-weight: 550;
        }

        img{
            width: 100%;
            margin-bottom: 10px;
            box-shadow: 10px 10px 5px #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="left">
                <div class="title">Erro 404</div>
                <div class="image">
                    <img src="{{ url('img/404.jpg') }}" alt="">
                </div>
            </div>
            <div class="right">
                <p>Ops! Parece que trocamos nossa política de privacidade denovo. Melhor voltar e procurar outra página.</p> 
            </div>
        </div>
    </div>
</body>
</html>
