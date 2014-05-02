
<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>{{ 'Gestion de Tickets'|trans }}</title>

	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">

	{% block header %}
	{% endblock %}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	{% set active = active|default(null) %}
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</button>	
          <a class="navbar-brand" href="#">Gestión de Tickets</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<li {% if 'homepage' == active %}class="active"{% endif %}><a href="{{ path('homepage') }}">Inicio</a></li>
			</li>
			<li {% if 'ticket_add' == active %}class="active"{% endif %}><a href="{{ path('ticket_add') }}">Nuevo ticket</a></li>
			<li {% if 'tickets_show' == active %}class="active"{% endif %}><a href="{{ path('tickets_show') }}">Ver Tickets</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
	        <li {% if 'homepage' == active %}class="active"{% endif %}><a href="{{ path('homepage') }}">Inicio</a></li>
			</li>
			<li {% if 'ticket_add' == active %}class="active"{% endif %}><a href="{{ path('ticket_add') }}">Nuevo ticket</a></li>
			<li {% if 'tickets_show' == active %}class="active"{% endif %}><a href="{{ path('tickets_show') }}">Ver Tickets</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Gestión de Tickets</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <span class="glyphicon glyphicon-plus"></span>
              <h4><a href="{{ path('ticket_add') }}">Nuevo ticket</a></h4>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <span class="glyphicon glyphicon-th-list"></span>
              <h4><a href="{{ path('tickets_show') }}">Ver tickets</a></h4>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">

            </div>
            <div class="col-xs-6 col-sm-3 placeholder">

            </div>
          </div>
          <div class="table-responsive">
         	{% block content %}
			{% endblock %}
          </div>
        </div>
      </div>
    </div>
  </body>
</html>