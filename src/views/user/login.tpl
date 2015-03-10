
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Acceder al sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background: #dfdfdf !important;
      }

      .form-signin {
        max-width: 350px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        width: 100%;
        height: auto;
        margin-bottom: 15px;
        padding: 10px 9px;
      }

    </style>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <!-- Custom styles for this template -->
  <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
	<h1 class="text-center">{{ 'Gestión de tickets y facturas'|trans }}</h1>
	<form action="{{ path('login_check') }}" method="post" novalidate class="form-signin">
	<h2 class="form-signin-heading">{{ 'Iniciar sesión'|trans }}</h2>
	{% if error %}
		<div class="alert alert-info">
			Introduce tu usuario y clave para entrar en el sistema de gestión.
		</div>
	{% endif %}
		<div class="form-actions">
			<input placeholder="Introduce tu email" type="text" name="form[username]"/>
			<input placeholder="Introduce tu contraseña" type="password" name="form[password]"/>
			<button type="submit" class="btn btn-primary">{{ 'Iniciar Sesión'|trans }}</button>
		</div>
	</form>
    </div> <!-- /container -->

  </body>
</html>
