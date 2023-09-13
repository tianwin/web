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

/* MauticCoreBundle:Default:content.html.twig */
class __TwigTemplate_8307a631adb6720b6b598f25bf78fb58cca09a54b86ddd81c3681b19abfb834d extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'modal' => [$this, 'block_modal'],
            'pageTitle' => [$this, 'block_pageTitle'],
            'publishStatus' => [$this, 'block_publishStatus'],
            'actions' => [$this, 'block_actions'],
            'toolbar' => [$this, 'block_toolbar'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $context["request"] = twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 1);
        // line 2
        $context["contentOnly"] = (twig_get_attribute($this->env, $this->source, ($context["request"] ?? null), "get", [0 => "contentOnly", 1 => false], "method", false, false, false, 2) || (array_key_exists("contentOnly", $context) &&  !twig_test_empty(($context["contentOnly"] ?? null))));
        // line 3
        $context["modalView"] = (twig_get_attribute($this->env, $this->source, ($context["request"] ?? null), "get", [0 => "modal", 1 => false], "method", false, false, false, 3) || (array_key_exists("modalView", $context) &&  !twig_test_empty(($context["modalView"] ?? null))));
        // line 4
        echo "";
        // line 6
        $this->displayBlock('modal', $context, $blocks);
        // line 7
        $this->displayBlock('pageTitle', $context, $blocks);
        // line 8
        $this->displayBlock('publishStatus', $context, $blocks);
        // line 9
        $this->displayBlock('actions', $context, $blocks);
        // line 10
        $this->displayBlock('toolbar', $context, $blocks);
        // line 11
        echo "";
        // line 13
        $context["template"] = null;
        // line 14
        if (( !twig_get_attribute($this->env, $this->source, ($context["request"] ?? null), "isXmlHttpRequest", [], "method", false, false, false, 14) &&  !($context["modalView"] ?? null))) {
            // line 15
            echo "    ";
            $context["template"] = ((($context["contentOnly"] ?? null)) ? ("MauticCoreBundle:Default:slim.html.twig") : ("MauticCoreBundle:Default:base.html.twig"));
        } elseif ( !        // line 16
($context["modalView"] ?? null)) {
            // line 17
            echo "    ";
            $context["template"] = "MauticCoreBundle:Default:output.html.twig";
        }
        // line 19
        echo "";
        // line 20
        if ( !twig_test_empty(($context["template"] ?? null))) {
            // line 21
            echo twig_include($this->env, $context, ($context["template"] ?? null), ["content" =>             $this->renderBlock("content", $context, $blocks), "modal" =>             $this->renderBlock("modal", $context, $blocks), "headerTitle" =>             $this->renderBlock("headerTitle", $context, $blocks), "pageTitle" =>             $this->renderBlock("pageTitle", $context, $blocks), "publishStatus" =>             $this->renderBlock("publishStatus", $context, $blocks), "actions" =>             $this->renderBlock("actions", $context, $blocks), "toolbar" =>             $this->renderBlock("toolbar", $context, $blocks)]);
        } else {
            // line 31
            echo "    ";
            $this->displayBlock("content", $context, $blocks);
            echo "
";
        }
    }

    // line 6
    public function block_modal($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 7
    public function block_pageTitle($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 8
    public function block_publishStatus($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 9
    public function block_actions($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 10
    public function block_toolbar($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:Default:content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 10,  108 => 9,  102 => 8,  96 => 7,  90 => 6,  82 => 31,  79 => 21,  77 => 20,  75 => 19,  71 => 17,  69 => 16,  66 => 15,  64 => 14,  62 => 13,  60 => 11,  58 => 10,  56 => 9,  54 => 8,  52 => 7,  50 => 6,  48 => 4,  46 => 3,  44 => 2,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:Default:content.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/Default/content.html.twig");
    }
}
