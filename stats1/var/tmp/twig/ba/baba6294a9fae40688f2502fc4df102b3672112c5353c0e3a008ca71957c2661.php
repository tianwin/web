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

/* MauticCoreBundle:Default:output.html.twig */
class __TwigTemplate_f7bebba70fd721614da170598ad86df4bdcda02e4a2b88321c24558dd748e1eb extends Template
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
        echo "<div class=\"content-body\">
    ";
        // line 2
        echo twig_include($this->env, $context, "MauticCoreBundle:Default:pageheader.html.twig");
        echo "
    ";
        // line 3
        echo ($context["content"] ?? null);
        echo "
</div>
";
        // line 5
        echo ($context["modal"] ?? null);
        echo "
";
        // line 6
        echo twig_escape_filter($this->env, $this->extensions['Mautic\CoreBundle\Templating\Twig\Extension\SecurityExtension']->getContext(), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:Default:output.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 6,  49 => 5,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:Default:output.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/Default/output.html.twig");
    }
}
