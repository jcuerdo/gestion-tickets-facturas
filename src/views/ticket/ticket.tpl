{% extends 'common/layout.tpl' %}
{% set active = 'tickets_show' %}
{% block content %}
{% if ticket %}
<h2 class="sub-header">
Ticket: {{ticket.id_ticket}}
Fecha: {{ticket.date | date("d/m/Y")}}
</h2>
<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
  <div class="panel-heading">Añadir nuevo servicio al ticket</div>
  <div class="panel-body">
    <form action="{{path('service_create')}}">
		<div class="input-group">
			<input type="hidden" name="id_ticket" value="{{ticket.id_ticket}}">
			<select class="form-control" name='id_service'>
				{% for service_option in services_list %}
				<option  value="{{service_option.id_service}}">{{service_option.name}} ( {{service_option.price  | number_format( 2, ',', '.' ) }}€ )</option>
				{% endfor %}
			</select>
		</div>
		<input type="submit" class="btn btn-default btn-lg" value="Añadir Servicio">
	</form>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-default">
  <div class="panel-heading">Servicios</div>
	  <div class="panel-body">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th>Nombre del servicio</th>
		      <th>Precio</th>
		      <th></th>
		    </tr>
		  </thead>
		  <tbody>
		{% for service in services %}
		      <tr>
		      <td>{{service.name}}</td>
		      <td>{{service.price | number_format( 2, ',', '.' ) }}</td>
		      <td>
		      <form action="{{path('delete_service')}}">
					<input type="hidden" name="id_ticket" value="{{ticket.id_ticket}}">
					<input type="hidden" name="id_ticket_service" value="{{service.id_ticket_service}}">
					<input type="submit" class="btn btn-default btn-xs" value="Eliminar">
				</form>
		      </td>
		    </tr>
		  	</tbody>
		  </div>
		</div>
	</div>	
 </div>
</div>
{% endfor %}
{% endif %}

{% endblock %}