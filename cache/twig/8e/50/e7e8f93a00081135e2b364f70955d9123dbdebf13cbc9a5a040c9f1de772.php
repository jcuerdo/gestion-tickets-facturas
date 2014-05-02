<?php

/* common/layout.tpl */
class __TwigTemplate_8e50e7e8f93a00081135e2b364f70955d9123dbdebf13cbc9a5a040c9f1de772 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<!DOCTYPE html>
<html lang=\"en\">
   <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    \t<title>";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Gestion de Tickets"), "html", null, true);
        echo "</title>

\t<script src=\"http://code.jquery.com/jquery-1.10.2.js\"></script>
\t<script src=\"http://code.jquery.com/ui/1.10.4/jquery-ui.js\"></script>
\t<!-- Latest compiled and minified CSS -->
\t<link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css\">

\t<!-- Optional theme -->
\t<link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css\">

\t<!-- Latest compiled and minified JavaScript -->
\t<script src=\"//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js\"></script>

    <!-- Custom styles for this template -->
    <link href=\"http://getbootstrap.com/examples/dashboard/dashboard.css\" rel=\"stylesheet\">

\t";
        // line 24
        $this->displayBlock('header', $context, $blocks);
        // line 26
        echo "
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
      <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
  </head>

  <body>
\t";
        // line 36
        $context["active"] = ((array_key_exists("active", $context)) ? (_twig_default_filter($this->getContext($context, "active"), null)) : (null));
        // line 37
        echo "    <div class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
      <div class=\"container-fluid\">
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
            \t<span class=\"sr-only\">Toggle navigation</span>
            \t<span class=\"icon-bar\"></span>
            \t<span class=\"icon-bar\"></span>
            \t<span class=\"icon-bar\"></span>
          \t</button>\t
          <a class=\"navbar-brand\" href=\"#\">Gestión de Tickets</a>
        </div>
        <div class=\"navbar-collapse collapse\">
          <ul class=\"nav navbar-nav navbar-right\">
\t\t\t<li ";
        // line 50
        if (("homepage" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\">Inicio</a></li>
\t\t\t</li>
\t\t\t<li ";
        // line 52
        if (("ticket_add" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("ticket_add");
        echo "\">Nuevo ticket</a></li>
\t\t\t<li ";
        // line 53
        if (("tickets_show" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("tickets_show");
        echo "\">Ver Tickets</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class=\"container-fluid\">
      <div class=\"row\">
        <div class=\"col-sm-3 col-md-2 sidebar\">
          <ul class=\"nav nav-sidebar\">
\t        <li ";
        // line 63
        if (("homepage" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\">Inicio</a></li>
\t\t\t</li>
\t\t\t<li ";
        // line 65
        if (("ticket_add" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("ticket_add");
        echo "\">Nuevo ticket</a></li>
\t\t\t<li ";
        // line 66
        if (("tickets_show" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("tickets_show");
        echo "\">Ver Tickets</a></li>
          </ul>
        </div>
        <div class=\"col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main\">
          <h1 class=\"page-header\">Gestión de Tickets</h1>

          <div class=\"row placeholders\">
            <div class=\"col-xs-6 col-sm-3 placeholder\">
              <span class=\"glyphicon glyphicon-plus\"></span>
              <h4><a href=\"";
        // line 75
        echo $this->env->getExtension('routing')->getPath("ticket_add");
        echo "\">Nuevo ticket</a></h4>
            </div>
            <div class=\"col-xs-6 col-sm-3 placeholder\">
              <span class=\"glyphicon glyphicon-th-list\"></span>
              <h4><a href=\"";
        // line 79
        echo $this->env->getExtension('routing')->getPath("tickets_show");
        echo "\">Ver tickets</a></h4>
            </div>
            <div class=\"col-xs-6 col-sm-3 placeholder\">

            </div>
            <div class=\"col-xs-6 col-sm-3 placeholder\">

            </div>
          </div>
          <div class=\"table-responsive\">
         \t";
        // line 89
        $this->displayBlock('content', $context, $blocks);
        // line 91
        echo "          </div>
        </div>
      </div>
    </div>
  </body>
</html>";
    }

    // line 24
    public function block_header($context, array $blocks = array())
    {
        // line 25
        echo "\t";
    }

    // line 89
    public function block_content($context, array $blocks = array())
    {
        // line 90
        echo "\t\t\t";
    }

    public function getTemplateName()
    {
        return "common/layout.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 90,  185 => 89,  181 => 25,  178 => 24,  169 => 91,  167 => 89,  154 => 79,  147 => 75,  131 => 66,  123 => 65,  114 => 63,  97 => 53,  89 => 52,  80 => 50,  65 => 37,  63 => 36,  51 => 26,  49 => 24,  30 => 8,  21 => 1,);
    }
}
