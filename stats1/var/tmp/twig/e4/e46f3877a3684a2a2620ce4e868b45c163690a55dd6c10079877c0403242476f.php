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

/* MauticUserBundle:Profile:index.html.twig */
class __TwigTemplate_e31c4190f6b9e197989d634824bb8c9a45088adbe6cf3ac753a7a155005c2783 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'headerTitle' => [$this, 'block_headerTitle'],
            'mauticContent' => [$this, 'block_mauticContent'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "MauticCoreBundle:Default:content.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("MauticCoreBundle:Default:content.html.twig", "MauticUserBundle:Profile:index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_headerTitle($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.user.account.settings", [], "messages");
    }

    // line 4
    public function block_mauticContent($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "user";
    }

    // line 6
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        echo "
<!-- start: box layout -->
<div class=\"box-layout\">
    <!-- step container -->
    <div class=\"col-md-3 bg-white height-auto\">
        <div class=\"pr-lg pl-lg pt-md pb-md\">
            ";
        // line 13
        if (twig_get_attribute($this->env, $this->source, ($context["me"] ?? null), "getId", [], "method", false, false, false, 13)) {
            // line 14
            echo "            <div class=\"media\">
                <div class=\"pull-left\">
                    <img class=\"img-rounded img-bordered media-object\" src=\"";
            // line 16
            echo $this->extensions['Mautic\CoreBundle\Templating\Twig\Extension\GravatarExtension']->getImage(twig_get_attribute($this->env, $this->source, ($context["me"] ?? null), "getEmail", [], "method", false, false, false, 16));
            echo "\" alt=\"\" width=\"65px\">
                </div>
                <div class=\"media-body\">
                    <h4>";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["me"] ?? null), "getName", [], "method", false, false, false, 19), "html", null, true);
            echo "</h4>
                    <h5>";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["me"] ?? null), "getPosition", [], "method", false, false, false, 20), "html", null, true);
            echo "</h5>
                </div>
            </div>
            <hr />
            ";
        }
        // line 25
        echo "
            <ul class=\"list-group list-group-tabs\">
                <li class=\"list-group-item active\">
                    <a href=\"#profile\" class=\"steps\" data-toggle=\"tab\">
                        ";
        // line 29
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.user.account.header.details", [], "messages");
        // line 30
        echo "                    </a>
                </li>

                ";
        // line 33
        if ((($__internal_compile_0 = ($context["permissions"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["apiAccess"] ?? null) : null)) {
            // line 34
            echo "                <li class=\"list-group-item\">
                    <a href=\"#clients\" class=\"steps\" data-toggle=\"tab\">
                        ";
            // line 36
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.user.account.header.authorizedclients", [], "messages");
            // line 37
            echo "                    </a>
                </li>
                ";
        }
        // line 40
        echo "            </ul>
        </div>
    </div>
    <!--/ step container -->

    <!-- container -->
    <div class=\"col-md-9 bg-auto height-auto bdr-l\">
        <div class=\"tab-content\">
            <div class=\"tab-pane fade in active bdr-rds-0 bdr-w-0\" id=\"profile\">
                ";
        // line 49
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["userForm"] ?? null), 'form_start');
        echo "
                <div class=\"pa-md bg-auto bg-light-xs bdr-b\">
                    <h4 class=\"fw-sb\">";
        // line 51
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.user.account.header.details", [], "messages");
        echo "</h4>
                </div>
                <div class=\"pa-md\">
                    <div class=\"col-md-6\">
                        ";
        // line 55
        echo ((twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "editUsername", [], "any", false, false, false, 55)) ? ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "username", [], "any", false, false, false, 55), 'row')) : ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "username_unbound", [], "any", false, false, false, 55), 'row')));
        echo "
                        ";
        // line 56
        echo ((twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "editName", [], "any", false, false, false, 56)) ? ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "firstName", [], "any", false, false, false, 56), 'row')) : ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "firstName_unbound", [], "any", false, false, false, 56), 'row')));
        echo "
                        ";
        // line 57
        echo ((twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "editName", [], "any", false, false, false, 57)) ? ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "lastName", [], "any", false, false, false, 57), 'row')) : ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "lastName_unbound", [], "any", false, false, false, 57), 'row')));
        echo "
                        ";
        // line 58
        echo ((twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "editPosition", [], "any", false, false, false, 58)) ? ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "position", [], "any", false, false, false, 58), 'row')) : ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "position_unbound", [], "any", false, false, false, 58), 'row')));
        echo "
                        ";
        // line 59
        echo ((twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "editEmail", [], "any", false, false, false, 59)) ? ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "email", [], "any", false, false, false, 59), 'row')) : ($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "email_unbound", [], "any", false, false, false, 59), 'row')));
        echo "
                    </div>
                    <div class=\"col-md-6\">
                        ";
        // line 62
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "timezone", [], "any", false, false, false, 62), 'row');
        echo "
                        ";
        // line 63
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "locale", [], "any", false, false, false, 63), 'row');
        echo "
                        ";
        // line 64
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "plainPassword", [], "any", false, false, false, 64), "password", [], "any", false, false, false, 64), 'row');
        echo "
                        ";
        // line 65
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "plainPassword", [], "any", false, false, false, 65), "confirm", [], "any", false, false, false, 65), 'row');
        echo "
                        ";
        // line 66
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["userForm"] ?? null), "signature", [], "any", false, false, false, 66), 'row');
        echo "
                    </div>
                </div>
                ";
        // line 69
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["userForm"] ?? null), 'form_end');
        echo "
            </div>

            ";
        // line 72
        if ((twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "apiAccess", [], "any", true, true, false, 72) && twig_get_attribute($this->env, $this->source, ($context["permissions"] ?? null), "apiAccess", [], "any", false, false, false, 72))) {
            // line 73
            echo "                <div class=\"tab-pane fade bdr-rds-0 bdr-w-0\" id=\"clients\">
                    <div class=\"pa-md bg-auto bg-light-xs bdr-b\">
                        <h4 class=\"fw-sb\">";
            // line 75
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.user.account.header.authorizedclients", [], "messages");
            echo "</h4>
                    </div>
                    <div class=\"pa-md\">
                        ";
            // line 78
            echo ($context["authorizedClients"] ?? null);
            echo "
                    </div>
                </div>
            ";
        }
        // line 82
        echo "        </div>
    </div>
    <!--/ end: container -->
</div>
";
    }

    public function getTemplateName()
    {
        return "MauticUserBundle:Profile:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 82,  209 => 78,  203 => 75,  199 => 73,  197 => 72,  191 => 69,  185 => 66,  181 => 65,  177 => 64,  173 => 63,  169 => 62,  163 => 59,  159 => 58,  155 => 57,  151 => 56,  147 => 55,  140 => 51,  135 => 49,  124 => 40,  119 => 37,  117 => 36,  113 => 34,  111 => 33,  106 => 30,  104 => 29,  98 => 25,  90 => 20,  86 => 19,  80 => 16,  76 => 14,  74 => 13,  66 => 7,  62 => 6,  55 => 4,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticUserBundle:Profile:index.html.twig", "/home/tianwing/public_html/stats1/app/bundles/UserBundle/Views/Profile/index.html.twig");
    }
}
