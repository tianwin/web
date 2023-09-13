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

/* MauticCoreBundle:GlobalSearch:globalsearch.html.twig */
class __TwigTemplate_f145eafb4524ac0637fa78d504286807cae2f8729301ab405430e536858c2096 extends Template
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
        echo "<li class=\"dropdown dropdown-custom\" id=\"globalSearchDropdown\">
    <div class=\"dropdown-menu\">
        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <div class=\"panel-title\">
                    <h6 class=\"fw-sb\">";
        // line 6
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.core.search.results", [], "messages");
        echo "</h6>
                </div>
            </div>
            <div class=\"pt-0 pb-xs pl-0 pr-0\">
                <div class=\"scroll-content slimscroll\" style=\"height:250px;\" id=\"globalSearchResults\">
                    ";
        // line 11
        echo twig_include($this->env, $context, "MauticCoreBundle:GlobalSearch:results.html.twig", ["results" => ($context["results"] ?? null)]);
        echo "
                </div>
            </div>
        </div>
    </div>
</li>
<li>
    <div class=\"search-container\" id=\"globalSearchContainer\">
        <a href=\"javascript: void(0);\" class=\"search-button\">
            <i class=\"fa fa-search fs-16\"></i>
        </a>
        <input
            type=\"search\"
            value=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["searchString"] ?? null));
        echo "\"
            class=\"form-control search\"
            id=\"globalSearchInput\"
            name=\"global_search\"
            placeholder=\"";
        // line 28
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.core.search.everything.placeholder", [], "messages");
        echo "\"
            value=\"\"
            autocomplete=\"false\"
            data-toggle=\"livesearch\"
            data-target=\"#globalSearchResults\"
            data-action=\"";
        // line 33
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("mautic_core_ajax", ["action" => "globalSearch"]);
        echo "\"
            data-overlay=\"true\"
            data-overlay-text=\"";
        // line 35
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.core.search.livesearch", [], "messages");
        echo "\" />
    </div>
</li>
";
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:GlobalSearch:globalsearch.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 35,  83 => 33,  75 => 28,  68 => 24,  52 => 11,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:GlobalSearch:globalsearch.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/GlobalSearch/globalsearch.html.twig");
    }
}
