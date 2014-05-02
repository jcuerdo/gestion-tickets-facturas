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
<div class=\"panel panel-default\">
  <div class=\"panel-heading\">Añadir nuevo servicio al ticket</div>
  <div class=\"panel-body\">
    <form action=\"";
            // line 12
            echo $this->env->getExtension('routing')->getPath("service_create");
            echo "\">
\t\t<div class=\"input-group\">
\t\t\t<input type=\"hidden\" name=\"id_ticket\" value=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"), "html", null, true);
            echo "\">
\t\t\t<select class=\"form-control\" name='id_service'>
\t\t\t\t";
            // line 16
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "services_list"));
            foreach ($context['_seq'] as $context["_key"] => $context["service_option"]) {
                // line 17
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
            // line 19
            echo "\t\t\t</select>
\t\t</div>
\t\t<input type=\"submit\" class=\"btn btn-default btn-lg\" value=\"Añadir Servicio\">
\t</form>
  </div>
</div>

<table class=\"table table-striped\">
  <thead>
    <tr>
      <th>Nombre del servicio</th>
      <th>Precio</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
";
            // line 35
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "services"));
            foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
                // line 36
                echo "      <tr>
      <td>";
                // line 37
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service"), "name"), "html", null, true);
                echo "</td>
      <td>";
                // line 38
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service"), "base_price"), "html", null, true);
                echo "</td>
      <td>
      <form action=\"";
                // line 40
                echo $this->env->getExtension('routing')->getPath("delete_service");
                echo "\">
\t\t\t<input type=\"hidden\" name=\"id_ticket\" value=\"";
                // line 41
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"), "html", null, true);
                echo "\">
\t\t\t<input type=\"hidden\" name=\"id_ticket_service\" value=\"";
                // line 42
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "service"), "id_ticket_service"), "html", null, true);
                echo "\">
\t\t\t<input type=\"submit\" class=\"btn btn-default btn-xs\" value=\"Eliminar\">
\t\t</form>
      </td>
    </tr>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 49
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
        return array (  130 => 49,  117 => 42,  113 => 41,  109 => 40,  104 => 38,  100 => 37,  97 => 36,  93 => 35,  75 => 19,  64 => 17,  60 => 16,  55 => 14,  50 => 12,  42 => 7,  38 => 6,  35 => 5,  33 => 4,  30 => 3,  25 => 2,);
    }
}
