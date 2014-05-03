<?php

/* ticket/tickets.tpl */
class __TwigTemplate_ebdde36e7f3b5863c6ca4e43438b12dbdaf89e893a91f93e2d2944be70164bbf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("common/layout.tpl");

        $this->blocks = array(
            'header' => array($this, 'block_header'),
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
    public function block_header($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->env->loadTemplate("common/datepicker.tpl")->display($context);
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "<h2 class=\"sub-header\">
Fecha: ";
        // line 10
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getContext($context, "date"), "d/m/Y"), "html", null, true);
        echo "
</h2>

<form action = \"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("tickets_show");
        echo "\">
    <div class=\"input-group\">
        <span class=\"input-group-addon\">Fecha</span><input  class=\"form-control datepicker\" type=\"text\" name=\"date\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getContext($context, "date"), "d-m-Y"), "html", null, true);
        echo "\"/>
     </div>
     <br/>
     <input type=\"submit\" class=\"btn btn-default btn-lg\" value=\"Cambiar Fecha\"/>
</form>

            <table class=\"table table-striped\">
              <thead>
                <tr>
                  <th>Número de Ticket</th>
                  <th>Fecha</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
";
        // line 31
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "tickets"));
        foreach ($context['_seq'] as $context["_key"] => $context["ticket"]) {
            // line 32
            echo "                  <tr>
                  <td>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"), "html", null, true);
            echo "</td>
                  <td>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "ticket"), "date"), "html", null, true);
            echo "</td>
                  <td><a class=\"btn btn-default btn-xs\" href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ticket_show", array("id_ticket" => $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"))), "html", null, true);
            echo "\">Ver ticket</a></td>
                  <td><a class=\"btn btn-default btn-xs\" href=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ticket_delete", array("id_ticket" => $this->getAttribute($this->getContext($context, "ticket"), "id_ticket"))), "html", null, true);
            echo "\">Eliminar ticket</a></td>
                </tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ticket'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "              </tbody>
            </table>
";
    }

    public function getTemplateName()
    {
        return "ticket/tickets.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 39,  94 => 36,  90 => 35,  86 => 34,  82 => 33,  79 => 32,  75 => 31,  56 => 15,  51 => 13,  45 => 10,  42 => 9,  39 => 8,  34 => 4,  31 => 3,  26 => 2,);
    }
}
