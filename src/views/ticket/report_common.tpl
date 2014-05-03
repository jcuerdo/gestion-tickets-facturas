{% for id_ticket,ticket in report.tickets %}
    <h3>
    ID Ticket : {{ id_ticket }}
    Fecha Ticket : {{ ticket.date }}
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
        <td>{{ service.date }}</td>
        <td>{{ service.name }}</td>
        <td>{{ service.base_price }}€</td>
        <td>{{ iva }}%</td>
        <td>{{ service.price }}€</td>
      </tr>
    {% endfor %}
  </tbody>
</table>
{% endfor %}
<h3>Total</h3>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
    <div class="panel-body">
          <strong>Precio base total:</strong> {{report.base_total}}€
  </div>
</div>
  </div>
  <div class="col-md-4">
        <div class="panel panel-default">
    <div class="panel-body">
          <strong>IVA:</strong> {{iva}}%
  </div>
</div>
  </div>
  <div class="col-md-4">
        <div class="panel panel-default">
    <div class="panel-body">
          <strong>Precio total:</strong> {{report.total}}€
  </div>
</div>
  </div>
</div>
