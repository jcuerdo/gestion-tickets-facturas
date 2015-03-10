{% extends 'common/layout.tpl' %}
{% set active = 'services_show' %}
{% block header %}
    {% include 'common/datepicker.tpl' %}
{% endblock %}


{% block content %}
<h2 class="sub-header">
  Servicios disponibles
</h2>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre del servicio</th>
                  <th>Precio base</th>
                  <th>Precio con IVA</th>
                </tr>
              </thead>
              <tbody>
{% for service in services %}
                  <tr>
                  <td>{{service.name}}</td>
                  <td>{{service.base_price | number_format( 2, ',', '.' ) }}€</td>
                  <td>{{service.price | number_format( 2, ',', '.' )}}€</td>
                </tr>
{% endfor %}
              </tbody>
            </table>
{% endblock %}