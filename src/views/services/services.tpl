{% extends 'common/layout.tpl' %}
{% set active = 'services_show' %}
{% block header %}
    {% include 'common/datepicker.tpl' %}

    <script>
    $(document).ready(function(){
      $('#service_price').keyup (function(){
        var service_price = parseFloat($('#service_price').val());
        var service_base_price = (service_price / (1 + {{app.iva}} / 100)  )
        $('#service_base_price').val(service_base_price);

    });
});
</script> 

{% endblock %}


{% block content %}
<h2 class="sub-header">
  Servicios disponibles
</h2>

<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Nuevo servicio
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
<form action = "{{path('services_add')}}">
  <div class="form-group row">
    <label for="service_name" class="col-sm-2 col-form-label">Nombre del servicio</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Nombre del servicio">
    </div>
  </div>

    <div class="form-group row">
    <label for="service_price" class="col-sm-2 col-form-label">Precio con IVA</label>
    <div class="col-sm-10">
        <input type="number" value="0" class="form-control" id="service_price" name="service_price" placeholder="Precio con IVA">
    </div>
  </div>

    <div class="form-group row">
    <label for="service_base_price" class="col-sm-2 col-form-label">Precio sin IVA</label>
    <div class="col-sm-10">
        <input type="number" value="0"  class="form-control" id="service_base_price" name="service_base_price" placeholder="Precio sin IVA" readonly>
    </div>
  </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
  </div>
</div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre del servicio</th>
                  <th>Precio base</th>
                  <th>Precio con IVA</th>
                  <th>Operaciones</th>
                </tr>
              </thead>
              <tbody>
{% for service in services %}
                  <tr>
                  <td>{{service.name}}</td>
                  <td>{{service.base_price | number_format( 2, ',', '.' ) }}€</td>
                  <td>{{service.price | number_format( 2, ',', '.' )}}€</td>
                  <td>
                    <form action = "{{path('services_edit')}}">
                            <input type="hidden" value="{{service.id_service}}" id="id_service" name="id_service"/>
                            <button type="submit" class="btn btn-primary">Editar</button>
                    </form>

                           <form action = "{{path('services_delete')}}">
                            <input type="hidden" value="{{service.id_service}}" id="id_service" name="id_service"/>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>
{% endfor %}
              </tbody>
            </table>
{% endblock %}