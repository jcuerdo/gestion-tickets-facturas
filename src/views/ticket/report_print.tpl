{% extends 'common/layout_print.tpl' %}
{% block content %}
<h1>{{shop.name}}</h1>
<ul>
  <li> <strong>Dirección:</strong> {{shop.address}}</li>
  <li> <strong>Teléfono:</strong> {{shop.phone}}</li>
  <li> <strong>Email:</strong> {{shop.email}}</li>
  <li> <strong>CIF:</strong> {{shop.cif}}</li>
</ul>
{% include 'ticket/report_common.tpl' %}

{% endblock %}