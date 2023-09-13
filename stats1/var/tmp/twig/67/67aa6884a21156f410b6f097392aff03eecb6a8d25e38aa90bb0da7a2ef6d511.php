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

/* MauticCoreBundle:GlobalSearch:results.html.twig */
class __TwigTemplate_d0de0ee1973b6b9c4b70cafbd942e56e2364a65383fb7df51c41110a047f9f6e extends Template
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
        echo "<div class=\"panel-group\" id=\"globalSearchPanel\">
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["results"] ?? null));
        foreach ($context['_seq'] as $context["header"] => $context["result"]) {
            // line 3
            echo "    <div class=\"panel panel-info\">
        <div class=\"panel-heading\">
            <h4 class=\"panel-title\">
                ";
            // line 6
            echo twig_escape_filter($this->env, $context["header"], "html", null, true);
            echo "
                ";
            // line 7
            if ((twig_get_attribute($this->env, $this->source, $context["result"], "count", [], "any", true, true, false, 7) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["result"], "count", [], "any", false, false, false, 7)))) {
                // line 8
                echo "                <span class=\"badge pull-right gs-count-badge\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["result"], "count", [], "any", false, false, false, 8), "html", null, true);
                echo "</span>
                ";
            }
            // line 10
            echo "            </h4>
        </div>
        <div class=\"panel-body np\">
            <ul class=\"list-group\">
                ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["result"]);
            foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
                // line 15
                echo "                <li class=\"list-group-item\">
                    ";
                // line 16
                echo $context["r"];
                echo "
                </li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "            </ul>
        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['header'], $context['result'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:GlobalSearch:results.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 23,  83 => 19,  74 => 16,  71 => 15,  67 => 14,  61 => 10,  55 => 8,  53 => 7,  49 => 6,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:GlobalSearch:results.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/GlobalSearch/results.html.twig");
    }
}
