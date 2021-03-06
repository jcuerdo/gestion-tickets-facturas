{% extends 'common/layout.tpl' %}
{% set active = 'ticket_add' %}

{% block header %}
    {% include 'common/datepicker.tpl' %}
{% endblock %}

{% block content %}
<h2 class="sub-header">Nuevo ticket</h2>
<form action = "{{path('ticket_create')}}">
    <div class="input-group">
        <span class="input-group-addon">Fecha</span>
        <input type="text" name="date" class="form-control datepicker" value="{{date | date("d-m-Y")}}"/>
    </div>
    <br/>
    <div class="input-group">
        <input type="submit" class="btn btn-default btn-lg" value="Nuevo ticket"/>
    </div>
</form>
{% endblock %}
