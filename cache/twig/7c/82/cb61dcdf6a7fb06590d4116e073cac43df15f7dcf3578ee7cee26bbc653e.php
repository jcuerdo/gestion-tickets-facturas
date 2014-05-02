<?php

/* home/home.tpl */
class __TwigTemplate_7c82cb61dcdf6a7fb06590d4116e073cac43df15f7dcf3578ee7cee26bbc653e extends Twig_Template
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
        $context["active"] = "homepage";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "
\t<h1>Inicio</h1>
Gestion de tickets y facturas para comercios.
";
    }

    public function getTemplateName()
    {
        return "home/home.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 5,  30 => 4,  25 => 2,);
    }
}
