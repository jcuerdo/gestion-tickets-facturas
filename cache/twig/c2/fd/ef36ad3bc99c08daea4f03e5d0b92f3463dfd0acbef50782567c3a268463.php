<?php

/* ticket/ticket.tpl */
class __TwigTemplate_c2fdef36ad3bc99c08daea4f03e5d0b92f3463dfd0acbef50782567c3a268463 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("common/layout.tpl");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "common/layout.tpl";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["active"] = "tickets_show";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        if ($this->getContext($context, "ticket")) {
            // line 5
            echo "<h2 class=\"sub-header\">
Ticket: ";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"), "html", null, true);
            echo "
Fecha: ";
            // line 7
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "date"), "d/m/Y"), "html", null, true);
            echo "
</h2>
<div class=\"row\">
<div class=\"col-md-6\">
<div class=\"panel panel-default\">
  <div class=\"panel-heading\">Añadir nuevo servicio al ticket</div>
  <div class=\"panel-body\">
    <form action=\"";
            // line 14
            echo $this->env->getExtension('routing')->getPath("service_create");
            echo "\">
\t\t<div class=\"input-group\">
\t\t\t<input type=\"hidden\" name=\"id_ticket\" value=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"), "html", null, true);
            echo "\">
\t\t\t<select class=\"form-control\" name='id_service'>
\t\t\t\t";
            // line 18
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "services_list"));
            foreach ($context['_seq'] as $context["_key"] => $context["service_option"]) {
                // line 19
                echo "\t\t\t\t<option  value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service_option"), "id_service"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service_option"), "name"), "html", null, true);
                echo "</option>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service_option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "\t\t\t</select>
\t\t</div>
\t\t<input type=\"submit\" class=\"btn btn-default btn-lg\" value=\"Añadir Servicio\">
\t</form>
  </div>
</div>
</div>
<div class=\"col-md-6\">
<div class=\"panel panel-default\">
  <div class=\"panel-heading\">Servicios</div>
\t  <div class=\"panel-body\">
\t\t<table class=\"table table-striped\">
\t\t  <thead>
\t\t    <tr>
\t\t      <th>Nombre del servicio</th>
\t\t      <th>Precio</th>
\t\t      <th></th>
\t\t    </tr>
\t\t  </thead>
\t\t  <tbody>
\t\t";
            // line 41
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "services"));
            foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
                // line 42
                echo "\t\t      <tr>
\t\t      <td>";
                // line 43
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service"), "name"), "html", null, true);
                echo "</td>
\t\t      <td>";
                // line 44
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service"), "base_price"), "html", null, true);
                echo "</td>
\t\t      <td>
\t\t      <form action=\"";
                // line 46
                echo $this->env->getExtension('routing')->getPath("delete_service");
                echo "\">
\t\t\t\t\t<input type=\"hidden\" name=\"id_ticket\" value=\"";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"), "html", null, true);
                echo "\">
\t\t\t\t\t<input type=\"hidden\" name=\"id_ticket_service\" value=\"";
                // line 48
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service"), "id_ticket_service"), "html", null, true);
                echo "\">
\t\t\t\t\t<input type=\"submit\" class=\"btn btn-default btn-xs\" value=\"Eliminar\">
\t\t\t\t</form>
\t\t      </td>
\t\t    </tr>
\t\t  \t</tbody>
\t\t  </div>
\t\t</div>
\t</div>\t
 </div>
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 61
        echo "
";
    }

    public function getTemplateName()
    {
        return "ticket/ticket.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 61,  123 => 48,  119 => 47,  115 => 46,  110 => 44,  106 => 43,  103 => 42,  99 => 41,  77 => 21,  66 => 19,  62 => 18,  57 => 16,  52 => 14,  42 => 7,  38 => 6,  35 => 5,  33 => 4,  30 => 3,  25 => 2,);
    }
}
