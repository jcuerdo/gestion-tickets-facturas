<?php

/* ticket/add.tpl */
class __TwigTemplate_ada9b79684137f1c964246b294eba17bd2a18c651602b0d334a18113fd92c3df extends Twig_Template
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
        $context["active"] = "ticket_add";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_header($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->env->loadTemplate("common/datepicker.tpl")->display($context);
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "<h2 class=\"sub-header\">Nuevo ticket</h2>
<form action = \"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("ticket_create");
        echo "\">
    <div class=\"input-group\">
        <span class=\"input-group-addon\">Fecha</span>
        <input type=\"text\" name=\"date\" class=\"form-control datepicker\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getContext($context, "date"), "d-m-Y"), "html", null, true);
        echo "\"/>
    </div>
    <br/>
    <div class=\"input-group\">
        <input type=\"submit\" class=\"btn btn-default btn-lg\" value=\"Nuevo ticket\"/>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "ticket/add.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 13,  45 => 10,  42 => 9,  39 => 8,  34 => 5,  31 => 4,  26 => 2,);
    }
}
