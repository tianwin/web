<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* MauticCoreBundle:Default:pageheader.html.twig */
class __TwigTemplate_1b012d950c5d172e7ddad5e8b692142be32a3c3cb4b91dd73ac30db740c5b781 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"page-header\">
\t<div class=\"box-layout\">
\t\t<div class=\"col-xs-5 col-sm-6 col-md-5 va-m\">
\t\t\t<h3 class=\"pull-left\">";
        // line 4
        echo twig_escape_filter($this->env, ($context["headerTitle"] ?? null), "html", null, true);
        echo "</h3>
\t\t\t<div class=\"col-xs-2 text-right pull-left\">
                ";
        // line 6
        echo twig_escape_filter($this->env, ($context["publishStatus"] ?? null), "html", null, true);
        echo "
\t\t\t</div>
\t\t\t";
        // line 8
        echo $this->extensions['Mautic\CoreBundle\Templating\Twig\Extension\ContentExtension']->getCustomContent("page.header.left", ((array_key_exists("mauticTemplateVars", $context)) ? (($context["mauticTemplateVars"] ?? null)) : ([])));
        echo "
\t\t</div>
\t\t<div class=\"col-xs-7 col-sm-6 col-md-7 va-m\">
\t\t\t<div class=\"toolbar text-right\" id=\"toolbar\">
                ";
        // line 12
        echo twig_escape_filter($this->env, ($context["actions"] ?? null), "html", null, true);
        echo "
                
                <div class=\"toolbar-bundle-buttons pull-left\">";
        // line 14
        echo twig_escape_filter($this->env, ($context["toolbar"] ?? null), "html", null, true);
        echo "</div>
\t\t\t\t<div class=\"toolbar-form-buttons hide pull-right\">
\t\t\t\t\t<div class=\"btn-group toolbar-standard hidden-xs hidden-sm \"></div>
\t\t\t\t\t<div class=\"btn-group toolbar-dropdown hidden-md hidden-lg\">
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default btn-main\"></button>
\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default btn-nospin  dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
\t\t\t\t\t\t\t<i class=\"fa fa-caret-down\"></i>
\t\t\t\t\t\t</button>
\t\t\t\t\t\t<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\"></ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t";
        // line 25
        echo $this->extensions['Mautic\CoreBundle\Templating\Twig\Extension\ContentExtension']->getCustomContent("page.header.right", ((array_key_exists("mauticTemplateVars", $context)) ? (($context["mauticTemplateVars"] ?? null)) : ([])));
        echo "
\t\t\t</div>
\t\t\t<div class=\"clearfix\"></div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:Default:pageheader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 25,  64 => 14,  59 => 12,  52 => 8,  47 => 6,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:Default:pageheader.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/Default/pageheader.html.twig");
    }
}
