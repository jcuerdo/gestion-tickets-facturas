{% extends 'common/layout.tpl' %}
{% set active = 'tickets_report' %}
{% block header %}
    {% include 'common/datepicker.tpl' %}
{% endblock %}


{% block content %}
<h2 class="sub-header">
Fecha Inicio: {{start_date | date("d/m/Y")}}
Fecha Fin: {{end_date | date("d/m/Y")}}
</h2>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
    <div class="panel-body">
          <form action = "{{path('tickets_report')}}">
    <div class="input-group">
        <span class="input-group-addon">Fecha Inicio</span><input  class="form-control datepicker" type="text" name="start_date" value="{{start_date | date("d-m-Y") }}"/>
     </div>
         <div class="input-group">
        <span class="input-group-addon">Fecha Final</span><input  class="form-control datepicker" type="text" name="end_date" value="{{end_date | date("d-m-Y") }}"/>
     </div>
     <br/>
     <input type="hidden" name="version" value="normal"/>
     <input type="submit" class="btn btn-default btn-lg" value="Ver Informe"/>
</form>
  </div>
</div>
  </div>
  <div class="col-md-4">
        <div class="panel panel-default">
    <div class="panel-body">
         <form action = "{{path('tickets_report')}}" target="_blank">
    <div class="input-group">
        <span class="input-group-addon">Fecha Inicio</span><input  class="form-control datepicker" type="text" name="start_date" value="{{start_date | date("d-m-Y") }}"/>
     </div>
         <div class="input-group">
        <span class="input-group-addon">Fecha Final</span><input  class="form-control datepicker" type="text" name="end_date" value="{{end_date | date("d-m-Y") }}"/>
     </div>
     <br/>
     <input type="hidden" name="version" value="print"/>
     <input type="submit" class="btn btn-default btn-lg" value="Imprimir Informe"/>
</form>
  </div>
</div>
  </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action = "{{path('tickets_report')}}">
                    <div class="input-group">
                        <span class="input-group-addon">Fecha Inicio</span><input  class="form-control datepicker" type="text" name="start_date" value="{{start_date | date("d-m-Y") }}"/>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Fecha Final</span><input  class="form-control datepicker" type="text" name="end_date" value="{{end_date | date("d-m-Y") }}"/>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Email</span><input  required alt="Email" class="form-control" type="email" name="email" value="" />
                    </div>
                    <br/>
                    <input type="hidden" name="version" value="email"/>
                    <input type="submit" class="btn btn-default btn-lg" value="Enviar Informe"/>
                </form>
            </div>
        </div>
    </div>
</div>
{% include 'ticket/report_common.tpl' %}

{% endblock %}