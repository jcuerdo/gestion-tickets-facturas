{% extends 'common/layout.tpl' %}
{% set active = 'tickets_show' %}
{% block header %}
    {% include 'common/datepicker.tpl' %}
{% endblock %}


{% block content %}
<h2 class="sub-header">
Fecha: {{date | date("d/m/Y")}}
</h2>

<form action = "{{path('tickets_show')}}">
    <div class="input-group">
        <span class="input-group-addon">Fecha</span><input  class="form-control datepicker" type="text" name="date" value="{{date | date("d-m-Y")}}"/>
     </div>
     <br/>
     <input type="submit" class="btn btn-default btn-lg" value="Cambiar Fecha"/>
</form>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Número de Ticket</th>
                  <th>Fecha</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
{% for ticket in tickets %}
                  <tr>
                  <td>{{ticket.id_ticket}}</td>
                  <td>{{ticket.date}}</td>
                  <td><a class="btn btn-default btn-xs" href="{{path('ticket_show',{id_ticket:ticket.id_ticket})}}">Ver ticket</a></td>
                  <td><a class="btn btn-default btn-xs" href="{{path('ticket_delete',{id_ticket:ticket.id_ticket})}}">Eliminar ticket</a></td>
                </tr>
{% endfor %}
              </tbody>
            </table>
{% endblock %}