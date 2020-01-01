{% extends 'common/layout.tpl' %}
{% set active = 'services_show' %}
{% block header %}
    {% include 'common/datepicker.tpl' %}

    <script>
    $(document).ready(function(){
      $('#service_price').keyup (function(){
        var service_price = parseFloat($('#service_price').val());
        var service_base_price = (service_price / (1 + {{app.iva}} / 100)  ).toFixed(2)
        $('#service_base_price').val(service_base_price);

    });
});
</script> 

{% endblock %}


{% block content %}
<h2 class="sub-header">
  Servicios disponibles
</h2>


  <div class="card card-body">
<form action = "{{path('services_update')}}">
  <input type="hidden" id="id_service" name="id_service" value="{{service.id_service}}"/>
  <div class="form-group row">
    <label for="service_name" class="col-sm-2 col-form-label">Nombre del servicio</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="service_name" name="service_name" value="{{service.name}}" placeholder="Nombre del servicio" readonly>
    </div>
  </div>

    <div class="form-group row">
    <label for="service_price" class="col-sm-2 col-form-label">Precio con IVA</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="service_price" name="service_price" value="{{service.price | number_format( 2 ) }}" placeholder="Precio con IVA">
    </div>
  </div>

    <div class="form-group row">
    <label for="service_base_price" class="col-sm-2 col-form-label">Precio sin IVA</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="service_base_price" name="service_base_price" value="{{service.base_price | number_format( 2 ) }}" placeholder="Precio sin IVA" readonly>
    </div>
  </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
  </div>
</div>
{% endblock %}