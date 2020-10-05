{% if report %}
{% if report.tickets %}
{% for id_ticket,ticket in report.tickets %}
    <h3>
    ID Ticket : {{ id_ticket }}
    Fecha Ticket : {{ ticket.date | date("d/m/Y") }}
    </h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Servicio</th>
          <th>Precio Base</th>
          <th>IVA</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
    {% for service in ticket.services %}
      <tr>
        <td>{{ service.date | date("d/m/Y") }}</td>
        <td>{{ service.name }}</td>
        <td>{{ service.base_price | number_format( 2, ',', '.' ) }}&euro;</td>
        <td>{{ service.iva }}%</td>
        <td>{{ service.price | number_format( 2, ',', '.' ) }}&euro;</td>
      </tr>
    {% endfor %}
  </tbody>
</table>
{% endfor %}
<h3>Total</h3>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
    <div class="panel-body">
          <strong>Precio base total:</strong> {{report.base_total | number_format( 2, ',', '.' ) }}&euro;
  </div>
</div>
  </div>
  <div class="col-md-6">
        <div class="panel panel-default">
    <div class="panel-body">
          <strong>Precio total:</strong> {{report.total | number_format( 2, ',', '.' ) }}&euro;
  </div>
</div>
  </div>
</div>
{% endif %}
{% endif %}
