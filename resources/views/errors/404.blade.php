<html>
<head>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <title>Page introuvable</title>

    <style>
        body {margin: 0;padding: 0;width: 100%;height: 100%;color: #B0BEC5;display: table;font-weight: 100;font-family: 'Lato';}

        .container {text-align: center;display: table-cell; vertical-align: middle; }

        .content {text-align: center; display: inline-block;  }

        .title { font-size: 200px; margin-bottom: 40px;      }
        .sub a{   color: #1b767a;    font-weight: bold;     text-decoration: none;     font-size: 20px;font-family: monospace;}
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">404</div>
        <div class="logo">
            <h1>Page introuvable.</h1>

            <div class="sub">
                <p><a href="{{ url('/') }}">Retour à {{ config('application.name') }}</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>