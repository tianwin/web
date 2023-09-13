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

/* MauticCoreBundle:Notification:notification_messages.html.twig */
class __TwigTemplate_427befc4f9721700d679758dce980e32bf7c21acf2cdaf8fd2fd2f19a7b90f91 extends Template
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
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["updateMessage"] ?? null), "message", [], "any", false, false, false, 1))) {
            // line 2
            echo "<div class=\"media pt-sm pb-sm pr-md pl-md nm bdr-b alert-mautic mautic-update\">
    <h4 class=\"pull-left\">";
            // line 3
            echo twig_get_attribute($this->env, $this->source, ($context["updateMessage"] ?? null), "message", [], "any", false, false, false, 3);
            echo "</h4>
    <div class=\"pull-right\">
        <a class=\"btn btn-danger\" href=\"";
            // line 5
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("mautic_core_update");
            echo "\" data-toggle=\"ajax\">";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.core.update.now", [], "messages");
            echo "</a>
    </div>
    <div class=\"clearfix\"></div>
</div>
";
        }
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["notifications"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["n"]) {
            // line 11
            echo "    ";
            echo twig_include($this->env, $context, "MauticCoreBundle:Notification:notification.html.twig", ["n" => $context["n"]]);
            echo "
";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['n'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:Notification:notification_messages.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 11,  57 => 10,  47 => 5,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:Notification:notification_messages.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/Notification/notification_messages.html.twig");
    }
}
