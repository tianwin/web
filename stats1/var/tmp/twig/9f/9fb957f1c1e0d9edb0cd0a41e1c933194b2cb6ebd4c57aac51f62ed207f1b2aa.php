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

/* MauticCoreBundle:Notification:notifications.html.twig */
class __TwigTemplate_23e1235d3de9e91e4c8bde9553703dfd45fc384f1848c35b24467e833c8bfdff extends Template
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
        echo "<li class=\"dropdown dropdown-custom\" id=\"notificationsDropdown\">
    <a href=\"javascript: void(0);\" onclick=\"Mautic.showNotifications();\" class=\"dropdown-toggle dropdown-notification\" data-toggle=\"dropdown\">
        ";
        // line 3
        $context["hideClass"] = (((twig_get_attribute($this->env, $this->source, ($context["updateMessage"] ?? null), "isNew", [], "any", false, false, false, 3) || ($context["showNewIndicator"] ?? null))) ? ("") : (" hide"));
        // line 4
        echo "        <span class=\"label label-danger";
        echo twig_escape_filter($this->env, ($context["hideClass"] ?? null), "html", null, true);
        echo "\" id=\"newNotificationIndicator\"><i class=\"fa fa-asterisk\"></i></span>
        <span class=\"fa fa-bell fs-16\"></span>
    </a>
    <div class=\"dropdown-menu\">
        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <div class=\"panel-title\">
                    <h6 class=\"fw-sb\">";
        // line 11
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.core.notifications", [], "messages");
        // line 12
        echo "                        <a href=\"javascript:void(0);\" class=\"btn btn-default btn-xs btn-nospin pull-right text-danger\" data-toggle=\"tooltip\" title=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mautic.core.notifications.clearall", [], "messages");
        echo "\" onclick=\"Mautic.clearNotification(0);\"><i class=\"fa fa-times\"></i></a>
                    </h6>
                </div>
            </div>
            <div class=\"pt-0 pb-xs pl-0 pr-0\">
                <div class=\"scroll-content slimscroll\" style=\"height:250px;\" id=\"notifications\">
                    ";
        // line 18
        echo twig_include($this->env, $context, "MauticCoreBundle:Notification:notification_messages.html.twig", ["notifications" =>         // line 19
($context["notifications"] ?? null), "updateMessage" =>         // line 20
($context["updateMessage"] ?? null)]);
        // line 21
        echo "
                    ";
        // line 22
        $context["class"] = (( !twig_test_empty(($context["notifications"] ?? null))) ? (" hide") : (""));
        // line 23
        echo "                    <div style=\"width: 100px; margin: 75px auto 0 auto;\" class=\"";
        echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
        echo " mautibot-image\" id=\"notificationMautibot\">
                        <img class=\"img img-responsive\" src=\"";
        // line 24
        echo $this->extensions['Mautic\CoreBundle\Templating\Twig\Extension\MautibotExtension']->getImage("wave");
        echo "\" />
                    </div>
                </div>
            </div>
            ";
        // line 28
        $context["lastNotification"] = twig_first($this->env, ($context["notifications"] ?? null));
        // line 29
        echo "            <input id=\"mauticLastNotificationId\" type=\"hidden\" value=\"";
        echo ((twig_get_attribute($this->env, $this->source, ($context["lastNotification"] ?? null), "id", [], "any", true, true, false, 29)) ? (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["lastNotification"] ?? null), "id", [], "any", false, false, false, 29))) : (""));
        echo "\" />
        </div>
    </div>
</li>
";
    }

    public function getTemplateName()
    {
        return "MauticCoreBundle:Notification:notifications.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 29,  87 => 28,  80 => 24,  75 => 23,  73 => 22,  70 => 21,  68 => 20,  67 => 19,  66 => 18,  56 => 12,  54 => 11,  43 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "MauticCoreBundle:Notification:notifications.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Views/Notification/notifications.html.twig");
    }
}
