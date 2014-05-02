<?php

/* common/datepicker.tpl */
class __TwigTemplate_a7ecfd8fe4d48c56040c3f59540c28b0398614fe1a4213243439766defeefbcb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "  <link rel=\"stylesheet\" href=\"http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css\">
  <script>
  \$(function() {
    \$( \"#datepicker\" ).datepicker();
    \$.datepicker.regional['es'] = 
    {
        closeText: 'Cerrar',
        prevText: '&#x3c;Ant',
        nextText: 'Sig&#x3e;',
        currentText: 'Hoy',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
        'Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
        dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
\t\$.datepicker.setDefaults(\$.datepicker.regional['es']);
\t});
  </script>";
    }

    public function getTemplateName()
    {
        return "common/datepicker.tpl";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,  47 => 10,  42 => 9,  39 => 8,  34 => 5,  31 => 4,  26 => 2,);
    }
}
