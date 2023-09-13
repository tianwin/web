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

/* @MauticCore/FormTheme/mautic_form_layout.html.twig */
class __TwigTemplate_e1106bfcdc04e62146cde30dcfed6505c60099ac7688ebe22a83a272a21f6a06 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'button_attributes' => [$this, 'block_button_attributes'],
            'button_group_row' => [$this, 'block_button_group_row'],
            'button_group_widget' => [$this, 'block_button_group_widget'],
            'button_row' => [$this, 'block_button_row'],
            'button_widget' => [$this, 'block_button_widget'],
            'checkbox_row' => [$this, 'block_checkbox_row'],
            'choice_attributes' => [$this, 'block_choice_attributes'],
            'choice_row' => [$this, 'block_choice_row'],
            'dynamiclist_entry_row' => [$this, 'block_dynamiclist_entry_row'],
            'dynamiclist_row' => [$this, 'block_dynamiclist_row'],
            'form_buttons_row' => [$this, 'block_form_buttons_row'],
            'form_errors' => [$this, 'block_form_errors'],
            'form_label' => [$this, 'block_form_label'],
            'form_row' => [$this, 'block_form_row'],
            'form_start' => [$this, 'block_form_start'],
            'form_widget_compound' => [$this, 'block_form_widget_compound'],
            'form_widget_simple' => [$this, 'block_form_widget_simple'],
            'sortable_value_label_list_widget' => [$this, 'block_sortable_value_label_list_widget'],
            'sortablelist_entry_row' => [$this, 'block_sortablelist_entry_row'],
            'sortablelist_errors' => [$this, 'block_sortablelist_errors'],
            'sortablelist_row' => [$this, 'block_sortablelist_row'],
            'standalone_button_row' => [$this, 'block_standalone_button_row'],
            'standalone_button_widget' => [$this, 'block_standalone_button_widget'],
            'tel_widget' => [$this, 'block_tel_widget'],
            'time_widget' => [$this, 'block_time_widget'],
            'widget_attributes' => [$this, 'block_widget_attributes'],
            'yesno_button_group_widget' => [$this, 'block_yesno_button_group_widget'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        $this->displayBlock('button_attributes', $context, $blocks);
        // line 18
        echo "
";
        // line 20
        $this->displayBlock('button_group_row', $context, $blocks);
        // line 33
        echo "
";
        // line 35
        $this->displayBlock('button_group_widget', $context, $blocks);
        // line 48
        echo "
";
        // line 50
        $this->displayBlock('button_row', $context, $blocks);
        // line 53
        echo "
";
        // line 55
        $this->displayBlock('button_widget', $context, $blocks);
        // line 67
        echo "
";
        // line 69
        $this->displayBlock('checkbox_row', $context, $blocks);
        // line 84
        echo "
";
        // line 86
        $this->displayBlock('choice_attributes', $context, $blocks);
        // line 95
        echo "
";
        // line 97
        $this->displayBlock('choice_row', $context, $blocks);
        // line 123
        echo "
";
        // line 125
        $this->displayBlock('dynamiclist_entry_row', $context, $blocks);
        // line 131
        echo "
";
        // line 133
        $this->displayBlock('dynamiclist_row', $context, $blocks);
        // line 159
        echo "
";
        // line 161
        $this->displayBlock('form_buttons_row', $context, $blocks);
        // line 172
        echo "
";
        // line 174
        $this->displayBlock('form_errors', $context, $blocks);
        // line 189
        echo "
";
        // line 191
        $this->displayBlock('form_label', $context, $blocks);
        // line 209
        echo "
";
        // line 211
        $this->displayBlock('form_row', $context, $blocks);
        // line 222
        echo "
";
        // line 224
        $this->displayBlock('form_start', $context, $blocks);
        // line 239
        echo "
";
        // line 241
        $this->displayBlock('form_widget_compound', $context, $blocks);
        // line 252
        echo "
";
        // line 254
        $this->displayBlock('form_widget_simple', $context, $blocks);
        // line 302
        echo "
";
        // line 304
        $this->displayBlock('sortable_value_label_list_widget', $context, $blocks);
        // line 334
        echo "
";
        // line 336
        $this->displayBlock('sortablelist_entry_row', $context, $blocks);
        // line 342
        echo "
";
        // line 344
        $this->displayBlock('sortablelist_errors', $context, $blocks);
        // line 366
        echo "
";
        // line 368
        $this->displayBlock('sortablelist_row', $context, $blocks);
        // line 399
        echo "
";
        // line 401
        $this->displayBlock('standalone_button_row', $context, $blocks);
        // line 408
        echo "
";
        // line 410
        $this->displayBlock('standalone_button_widget', $context, $blocks);
        // line 422
        echo "
";
        // line 424
        $this->displayBlock('tel_widget', $context, $blocks);
        // line 427
        echo "
";
        // line 429
        $this->displayBlock('time_widget', $context, $blocks);
        // line 455
        echo "
";
        // line 457
        $this->displayBlock('widget_attributes', $context, $blocks);
        // line 478
        echo "
";
        // line 480
        $this->displayBlock('yesno_button_group_widget', $context, $blocks);
    }

    // line 6
    public function block_button_attributes($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        echo "id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null));
        echo "\" name=\"";
        echo twig_escape_filter($this->env, ($context["full_name"] ?? null));
        echo "\" ";
        echo ((($context["disabled"] ?? null)) ? ("disabled=\"disabled\"") : (""));
        echo "
";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, ($context["attr"] ?? null), function ($__v__, $__k__) use ($context, $macros) { $context["v"] = $__v__; $context["k"] = $__k__; return !twig_in_filter($context["k"], [0 => "icon"]); }));
        foreach ($context['_seq'] as $context["k"] => $context["v"]) {
            // line 9
            if (twig_in_filter($context["v"], [0 => "placeholder", 1 => "title"])) {
                // line 10
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($context["v"], [], ($context["translation_domain"] ?? null))));
                echo "
";
            } elseif ((            // line 11
$context["v"] === true)) {
                // line 12
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["k"]));
                echo "
";
            } elseif ( !(            // line 13
$context["v"] === false)) {
                // line 14
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                echo "
";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 20
    public function block_button_group_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        $context["hasErrors"] = twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 21), "errors", [], "any", false, false, false, 21));
        // line 22
        $context["feedbackClass"] = ((((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 22), "getMethod", [], "method", false, false, false, 22) === "POST") && (($context["hasErrors"] ?? null) > 0))) ? (" has-error") : (""));
        // line 23
        echo "<div class=\"row\">
    <div class=\"form-group col-xs-12";
        // line 24
        echo twig_escape_filter($this->env, ($context["feedbackClass"] ?? null), "html", null, true);
        echo "\">
        ";
        // line 25
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label', (twig_test_empty($_label_ = ($context["label"] ?? null)) ? [] : ["label" => $_label_]));
        echo "
        <div class=\"choice-wrapper\">
            ";
        // line 27
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
            ";
        // line 28
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
        </div>
    </div>
</div>
";
    }

    // line 35
    public function block_button_group_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 37
        $context["attr"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 37), "attr", [], "any", false, false, false, 37);
        // line 38
        echo "<div class=\"btn-group ";
        echo twig_escape_filter($this->env, ($context["buttonBlockClass"] ?? null), "html", null, true);
        echo "\" data-toggle=\"buttons\">
    ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["form"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 40
            echo "        ";
            $context["class"] = ((( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 40), "checked", [], "any", false, false, false, 40))) ? (" active") : ("")) . ((( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 40), "disabled", [], "any", false, false, false, 40)) ||  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "readonly", [], "any", false, false, false, 40)))) ? (" disabled") : ("")));
            // line 41
            echo "        <label class=\"btn btn-default";
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            echo "\">
            ";
            // line 42
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($context["child"], 'widget', ["attr" => ($context["attr"] ?? null)]);
            echo "
            ";
            // line 43
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("child.vars.label", [], "messages");
            // line 44
            echo "        </label>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "</div>
";
    }

    // line 50
    public function block_button_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 51
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
";
    }

    // line 55
    public function block_button_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 56
        if ( !($context["label"] ?? null)) {
            // line 57
            $context["label"] = $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->humanize(($context["name"] ?? null));
        }
        // line 59
        echo "<button type=\"";
        echo ((array_key_exists("type", $context)) ? (twig_escape_filter($this->env, ($context["type"] ?? null))) : ("button"));
        echo "\"
    ";
        // line 60
        $this->displayBlock("button_attributes", $context, $blocks);
        echo ">
    ";
        // line 61
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 61), "attr", [], "any", false, false, false, 61), "icon", [], "any", false, false, false, 61))) {
            // line 62
            echo "    <i class=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 62), "attr", [], "any", false, false, false, 62), "icon", [], "any", false, false, false, 62), "html", null, true);
            echo " \"></i>
    ";
        }
        // line 64
        echo "    ";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(($context["label"] ?? null), [], ($context["translation_domain"] ?? null)));
        echo "
</button>
";
    }

    // line 69
    public function block_checkbox_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 70
        $context["hasErrors"] = twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 70), "errors", [], "any", false, false, false, 70));
        // line 71
        $context["feedbackClass"] = (( !twig_test_empty(($context["hasErrors"] ?? null))) ? (" has-error") : (""));
        // line 72
        echo "<div class=\"row\">
    <div class=\"form-group col-xs-12";
        // line 73
        echo twig_escape_filter($this->env, ($context["feedbackClass"] ?? null), "html", null, true);
        echo "\">
        <div class=\"checkbox\">
            <label>
                ";
        // line 76
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
                ";
        // line 77
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 77), "label", [], "any", false, false, false, 77)), "html", null, true);
        echo "
            </label>
        </div>
        ";
        // line 80
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
    </div>
</div>
";
    }

    // line 86
    public function block_choice_attributes($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 87
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["choice_attr"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["v"]) {
            // line 88
            if (($context["v"] === true)) {
                // line 89
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["k"]));
                echo "
";
            } elseif ( !(            // line 90
$context["v"] === false)) {
                // line 91
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                echo "
";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 97
    public function block_choice_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 98
        $context["hasErrors"] = twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 98), "errors", [], "any", false, false, false, 98));
        // line 99
        $context["feedbackClass"] = (( !twig_test_empty(($context["hasErrors"] ?? null))) ? (" has-error") : (""));
        // line 101
        $context["attr"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 101), "attr", [], "any", false, false, false, 101);
        // line 102
        echo "<div class=\"row\">
    <div class=\"form-group col-xs-12 ";
        // line 103
        echo twig_escape_filter($this->env, ($context["feedbackClass"] ?? null), "html", null, true);
        echo ">\">
        ";
        // line 104
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label', (twig_test_empty($_label_ = ($context["label"] ?? null)) ? [] : ["label" => $_label_]));
        echo "
        <div class=\"choice-wrapper\">
            ";
        // line 106
        if ((($context["expanded"] ?? null) && ($context["multiple"] ?? null))) {
            // line 107
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "children", [], "any", false, false, false, 107));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 108
                echo "                <div class=\"checkbox\">
                    <label>
                        ";
                // line 110
                echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($context["child"], 'widget', ["attr" => ($context["attr"] ?? null)]);
                echo "
                        ";
                // line 111
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 111), "label", [], "any", false, false, false, 111)), "html", null, true);
                echo "
                    </label>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 115
            echo "            ";
        } else {
            // line 116
            echo "            ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
            echo "
            ";
        }
        // line 118
        echo "            ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
        </div>
    </div>
</div>
";
    }

    // line 125
    public function block_dynamiclist_entry_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 126
        echo "<div class=\"sortable\">
    ";
        // line 127
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        // line 128
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
</div>
";
    }

    // line 133
    public function block_dynamiclist_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 134
        $context["list"] = twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "children", [], "any", false, false, false, 134);
        // line 135
        $context["hasErrors"] = twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 135), "errors", [], "any", false, false, false, 135));
        // line 136
        $context["feedbackClass"] = (( !twig_test_empty(($context["hasErrors"] ?? null))) ? (" has-error") : (""));
        // line 137
        $context["datePrototype"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "vars", [], "any", false, true, false, 137), "prototype", [], "any", true, true, false, 137)) ? (twig_escape_filter($this->env, (("<div class=\"sortable\">" . $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "vars", [], "any", false, false, false, 137), "prototype", [], "any", false, false, false, 137), 'widget')) . "</div>"))) : (""));
        // line 138
        echo "<div class=\"row\">
    <div data-toggle=\"sortablelist\" data-prefix=\"";
        // line 139
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 139), "id", [], "any", false, false, false, 139), "html", null, true);
        echo "\" class=\"form-group col-xs-12 ";
        echo twig_escape_filter($this->env, ($context["feedbackClass"] ?? null), "html", null, true);
        echo "\" id=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 139), "id", [], "any", false, false, false, 139), "html", null, true);
        echo "_list\">
        ";
        // line 140
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label', (twig_test_empty($_label_ = ($context["label"] ?? null)) ? [] : ["label" => $_label_]));
        echo "
        <a  data-prototype=\"";
        // line 141
        echo twig_escape_filter($this->env, ($context["datePrototype"] ?? null), "html", null, true);
        echo "\"
           class=\"btn btn-warning btn-xs btn-add-item\" href=\"#\" id=\"";
        // line 142
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 142), "id", [], "any", false, false, false, 142), "html", null, true);
        echo "_additem\">
            ";
        // line 143
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("mautic.core.form.list.additem"), "html", null, true);
        echo "
        </a>
        ";
        // line 145
        if (($context["isSortable"] ?? null)) {
            // line 146
            echo "        <div class=\"list-sortable\">
        ";
        }
        // line 148
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "children", [], "any", false, false, false, 148));
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 149
            echo "            ";
            $this->displayBlock("sortablelist_entry_row", $context, $blocks);
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        echo "        </div>
        ";
        // line 152
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["list"] ?? null), 'errors');
        echo "
        ";
        // line 153
        if (($context["isSortable"] ?? null)) {
            // line 154
            echo "        <input type=\"hidden\" class=\"sortable-itemcount\" id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 154), "id", [], "any", false, false, false, 154), "html", null, true);
            echo "_itemcount\" value=\"";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["list"] ?? null)), "html", null, true);
            echo "\" />
        ";
        }
        // line 156
        echo "    </div>
</div>
";
    }

    // line 161
    public function block_form_buttons_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 162
        echo "<div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo " class=\"";
        echo twig_escape_filter($this->env, ($context["containerClass"] ?? null), "html", null, true);
        echo "\">
    ";
        // line 163
        if (( !twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 163) && ($context["errors"] ?? null))) {
            // line 164
            echo "        <div class=\"has-error\">
            ";
            // line 165
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
            echo "
        </div>
    ";
        }
        // line 168
        $this->displayBlock("form_rows", $context, $blocks);
        // line 169
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'rest');
        echo "
</div>
";
    }

    // line 174
    public function block_form_errors($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 175
        if ((twig_length_filter($this->env, ($context["errors"] ?? null)) > 0)) {
            // line 176
            echo "    <div class=\"help-block\">
    ";
            // line 177
            if ((twig_length_filter($this->env, ($context["errors"] ?? null)) > 1)) {
                // line 178
                echo "        <ul>
            ";
                // line 179
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 180
                    echo "                <li>";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["error"], "getMessage", [], "method", false, false, false, 180));
                    echo "</li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 182
                echo "        </ul>
    ";
            } else {
                // line 184
                echo "        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_first($this->env, ($context["errors"] ?? null)), "getMessage", [], "method", false, false, false, 184));
                echo "
    ";
            }
            // line 186
            echo "    </div>
";
        }
    }

    // line 191
    public function block_form_label($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 192
        if ( !(($context["label"] ?? null) === false)) {
            // line 193
            if (($context["required"] ?? null)) {
                // line 194
                echo "    ";
                $context["label_attr"] = twig_array_merge(($context["label_attr"] ?? null), ["class" => (twig_trim_filter(((twig_get_attribute($this->env, $this->source, ($context["label_attr"] ?? null), "class", [], "any", true, true, false, 194)) ? (twig_get_attribute($this->env, $this->source, ($context["label_attr"] ?? null), "class", [], "any", false, false, false, 194)) : (""))) . " required")]);
            }
            // line 196
            if ( !($context["compound"] ?? null)) {
                // line 197
                echo "    ";
                $context["label_attr"] = twig_array_merge(($context["label_attr"] ?? null), ["for" => ($context["id"] ?? null)]);
            }
            // line 199
            if ( !($context["label"] ?? null)) {
                // line 200
                echo "    ";
                $context["label"] = $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->humanize(($context["name"] ?? null));
            }
            // line 202
            $context["tooltip"] = (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, true, false, 202), "attr", [], "any", false, true, false, 202), "tooltip", [], "any", true, true, false, 202) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 202), "attr", [], "any", false, false, false, 202), "tooltip", [], "any", false, false, false, 202)))) ? ($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 202), "attr", [], "any", false, false, false, 202), "tooltip", [], "any", false, false, false, 202))) : (false));
            // line 203
            echo "<label ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["label_attr"] ?? null));
            foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                // line 204
                echo "    ";
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                echo "
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 205
            echo ((($context["tooltip"] ?? null)) ? (twig_sprintf("data-toggle=\"tooltip\" data-container=\"body\" data-placement=\"top\" title=\"%s\"", ($context["tooltip"] ?? null))) : (""));
            echo ">
";
            // line 206
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(($context["label"] ?? null), [], ($context["translation_domain"] ?? null)));
            echo ((($context["tooltip"] ?? null)) ? (" <i class=\"fa fa-question-circle\"></i>") : (""));
            echo "</label>
";
        }
    }

    // line 211
    public function block_form_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 212
        $context["hasErrors"] = twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 212), "errors", [], "any", false, false, false, 212));
        // line 213
        $context["feedbackClass"] = (((($context["hasErrors"] ?? null) > 0)) ? (" has-error") : (""));
        // line 214
        echo "<div class=\"row\">
    <div class=\"form-group col-xs-12";
        // line 215
        echo twig_escape_filter($this->env, ($context["feedbackClass"] ?? null), "html", null, true);
        echo "\">
        ";
        // line 216
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label', (twig_test_empty($_label_ = ($context["label"] ?? null)) ? [] : ["label" => $_label_]));
        echo "
        ";
        // line 217
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
        ";
        // line 218
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
    </div>
 </div>
";
    }

    // line 224
    public function block_form_start($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 225
        $context["method"] = twig_upper_filter($this->env, ($context["method"] ?? null));
        // line 226
        $context["form_method"] = ((((($context["method"] ?? null) === "GET") || (($context["method"] ?? null) === "POST"))) ? (($context["method"] ?? null)) : ("POST"));
        // line 227
        echo "<form novalidate autocomplete=\"false\" data-toggle=\"ajax\" role=\"form\" name=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 227), "name", [], "any", false, false, false, 227), "html", null, true);
        echo "\" method=\"";
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["method"] ?? null)), "html", null, true);
        echo "\" action=\"";
        echo twig_escape_filter($this->env, ($context["action"] ?? null), "html", null, true);
        echo "\"";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["attr"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["v"]) {
            // line 228
            echo "    ";
            echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 229
        echo ((($context["multipart"] ?? null)) ? (" enctype=\"multipart/form-data\"") : (""));
        echo ">
";
        // line 230
        if ( !(($context["form_method"] ?? null) === ($context["method"] ?? null))) {
            // line 231
            echo "    <input type=\"hidden\" name=\"_method\" value=\"";
            echo twig_escape_filter($this->env, ($context["method"] ?? null));
            echo "\" />
";
        }
        // line 233
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 233), "errors", [], "any", false, false, false, 233)) > 0)) {
            // line 234
            echo "<div class=\"has-error pa-10\">
    ";
            // line 235
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
            echo "
</div>
";
        }
    }

    // line 241
    public function block_form_widget_compound($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 242
        echo "<div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
    ";
        // line 243
        if (( !twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 243) && ($context["errors"] ?? null))) {
            // line 244
            echo "    <div class=\"has-error\">
        ";
            // line 245
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
            echo "
    </div>
    ";
        }
        // line 248
        echo "    ";
        $this->displayBlock("form_rows", $context, $blocks);
        echo "
    ";
        // line 249
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'rest');
        echo "
</div>
";
    }

    // line 254
    public function block_form_widget_simple($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 255
        $context["preaddonAttr"] = ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon_attr", [], "any", true, true, false, 255)) ? (twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon_attr", [], "any", false, false, false, 255)) : ([]));
        // line 256
        $context["postaddonAttr"] = ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon_attr", [], "any", true, true, false, 256)) ? (twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon_attr", [], "any", false, false, false, 256)) : ([]));
        // line 257
        echo "
";
        // line 258
        if (((((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon", [], "any", true, true, false, 258) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon", [], "any", false, false, false, 258))) || (twig_get_attribute($this->env, $this->source,         // line 259
($context["attr"] ?? null), "postaddon", [], "any", true, true, false, 259) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon", [], "any", false, false, false, 259)))) || (twig_get_attribute($this->env, $this->source,         // line 260
($context["attr"] ?? null), "preaddon_text", [], "any", true, true, false, 260) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon_text", [], "any", false, false, false, 260)))) || (twig_get_attribute($this->env, $this->source,         // line 261
($context["attr"] ?? null), "postaddon_text", [], "any", true, true, false, 261) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon_text", [], "any", false, false, false, 261))))) {
            // line 262
            echo "    <div class=\"input-group\">
        ";
            // line 263
            if ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon", [], "any", true, true, false, 263) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon", [], "any", false, false, false, 263)))) {
                // line 264
                echo "        <span class=\"input-group-addon preaddon\" ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["preaddonAttr"] ?? null));
                foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                    // line 265
                    echo "            ";
                    echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                    echo "
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 266
                echo ">
            <i class=\"";
                // line 267
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon", [], "any", false, false, false, 267), "html", null, true);
                echo "\"></i>
        </span>
        ";
            }
            // line 270
            echo "        ";
            if ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon_text", [], "any", true, true, false, 270) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon_text", [], "any", false, false, false, 270)))) {
                // line 271
                echo "        <span class=\"input-group-addon preaddon\" ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["preaddonAttr"] ?? null));
                foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                    // line 272
                    echo "            ";
                    echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                    echo "
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 273
                echo ">
            <span>";
                // line 274
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "preaddon_text", [], "any", false, false, false, 274), "html", null, true);
                echo "</span>
        </span>
        ";
            }
            // line 277
            echo "        <input autocomplete=\"false\" type=\"";
            echo ((array_key_exists("type", $context)) ? (twig_escape_filter($this->env, ($context["type"] ?? null))) : ("text"));
            echo "\"
            ";
            // line 278
            $this->displayBlock("widget_attributes", $context, $blocks);
            if (( !twig_test_empty(($context["value"] ?? null)) || call_user_func_array($this->env->getTest('numeric')->getCallable(), [($context["value"] ?? null)]))) {
                // line 279
                echo "            value=\"";
                echo twig_escape_filter($this->env, ($context["value"] ?? null));
                echo "\"";
            }
            echo " />

        ";
            // line 281
            if ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon", [], "any", true, true, false, 281) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon", [], "any", false, false, false, 281)))) {
                // line 282
                echo "        <span class=\"input-group-addon postaddon\" ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["postaddonAttr"] ?? null));
                foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                    // line 283
                    echo "            ";
                    echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                    echo "
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 284
                echo ">
            <i class=\"";
                // line 285
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon", [], "any", false, false, false, 285), "html", null, true);
                echo "\"></i>
        </span>
        ";
            }
            // line 288
            echo "        ";
            if ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon_text", [], "any", true, true, false, 288) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon_text", [], "any", false, false, false, 288)))) {
                // line 289
                echo "        <span class=\"input-group-addon postaddon\" ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["postaddonAttr"] ?? null));
                foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                    // line 290
                    echo "            ";
                    echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                    echo "
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 291
                echo ">
            <span>";
                // line 292
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "postaddon_text", [], "any", false, false, false, 292), "html", null, true);
                echo "</span>
        </span>
        ";
            }
            // line 295
            echo "    </div>
";
        } else {
            // line 297
            echo "    <input type=\"";
            echo ((array_key_exists("type", $context)) ? (twig_escape_filter($this->env, ($context["type"] ?? null))) : ("text"));
            echo "\"
        ";
            // line 298
            $this->displayBlock("widget_attributes", $context, $blocks);
            if (( !twig_test_empty(($context["value"] ?? null)) || call_user_func_array($this->env->getTest('numeric')->getCallable(), [($context["value"] ?? null)]))) {
                // line 299
                echo "        value=\"";
                echo twig_escape_filter($this->env, ($context["value"] ?? null));
                echo "\"";
            }
            echo " />
";
        }
    }

    // line 304
    public function block_sortable_value_label_list_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 305
        if (( !twig_test_iterable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "label", [], "any", false, false, false, 305), "vars", [], "any", false, false, false, 305), "value", [], "any", false, false, false, 305)) &&  !twig_test_iterable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "value", [], "any", false, false, false, 305), "vars", [], "any", false, false, false, 305), "vale", [], "any", false, false, false, 305)))) {
            // line 306
            echo "<div class=\"input-group sortable-no-reorder\">
    ";
            // line 307
            if ( !twig_test_empty(($context["preaddon"] ?? null))) {
                // line 308
                echo "    <span class=\"input-group-addon preaddon\" ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["preaddonAttr"] ?? null));
                foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                    // line 309
                    echo "    ";
                    echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                    echo "
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 310
                echo ">
    <i class=\"";
                // line 311
                echo twig_escape_filter($this->env, ($context["preaddon"] ?? null), "html", null, true);
                echo "\"></i>
    </span>
    ";
            }
            // line 314
            echo "    <div>
        <div class=\"row\">
            <div class=\"col-xs-6 mr-0 pr-0 bdr-r-wdh-0\">
            ";
            // line 317
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "label", [], "any", false, false, false, 317), 'widget', ["attr" => ["class" => "form-control sortable-label", "placeholder" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "label", [], "any", false, false, false, 317), "vars", [], "any", false, false, false, 317), "label", [], "any", false, false, false, 317)]]);
            echo "
            </div>
            <div class=\"col-xs-6 ml-0 pl-0\">
            ";
            // line 320
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "value", [], "any", false, false, false, 320), 'widget', ["attr" => ["class" => "form-control sortable-value", "placeholder" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "value", [], "any", false, false, false, 320), "vars", [], "any", false, false, false, 320), "label", [], "any", false, false, false, 320)]]);
            echo "
            </div>
        </div>
    </div>
    ";
            // line 324
            if ( !twig_test_empty(($context["postaddon"] ?? null))) {
                // line 325
                echo "    <span class=\"input-group-addon postaddon\" ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["postaddonAttr"] ?? null));
                foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                    // line 326
                    echo "    ";
                    echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                    echo "
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 327
                echo ">
        <i class=\"";
                // line 328
                echo twig_escape_filter($this->env, ($context["postaddon"] ?? null), "html", null, true);
                echo "\"></i>
    </span>
    ";
            }
            // line 331
            echo "</div>
";
        }
    }

    // line 336
    public function block_sortablelist_entry_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 337
        echo "<div class=\"sortable\">
    ";
        // line 338
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
    ";
        // line 339
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'errors');
        echo "
</div>
";
    }

    // line 344
    public function block_sortablelist_errors($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 345
        $context["errorMessages"] = [];
        // line 346
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 347
            echo "    ";
            if (!twig_in_filter(twig_get_attribute($this->env, $this->source, $context["error"], "getMessage", [], "method", false, false, false, 347), ($context["errorMessages"] ?? null))) {
                // line 348
                echo "        ";
                $context["errorMessages"] = twig_array_merge(($context["errorMessages"] ?? null), [0 => twig_get_attribute($this->env, $this->source, $context["error"], "getMessage", [], "method", false, false, false, 348)]);
                // line 349
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 351
        echo "
";
        // line 352
        if ((twig_length_filter($this->env, ($context["errorMessages"] ?? null)) > 0)) {
            // line 353
            echo "    <div class=\"help-block\">
        ";
            // line 354
            if ((twig_length_filter($this->env, ($context["errorMessages"] ?? null)) > 1)) {
                // line 355
                echo "            <ul>
                ";
                // line 356
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["errorMessages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["errorMessage"]) {
                    // line 357
                    echo "                    <li>";
                    echo twig_escape_filter($this->env, $context["errorMessage"]);
                    echo "</li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['errorMessage'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 359
                echo "            </ul>
        ";
            } else {
                // line 361
                echo "            ";
                echo twig_escape_filter($this->env, twig_first($this->env, ($context["errorMessages"] ?? null)));
                echo "
        ";
            }
            // line 363
            echo "    </div>
";
        }
    }

    // line 368
    public function block_sortablelist_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 369
        $context["list"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "children", [], "any", false, false, false, 369), "list", [], "any", false, false, false, 369);
        // line 370
        if (((($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 370), 'errors') && twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "vars", [], "any", false, false, false, 370), "value", [], "any", false, false, false, 370))) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, true, false, 370), "children", [], "any", false, true, false, 370), "properties", [], "any", false, true, false, 370), "list", [], "any", true, true, false, 370)) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 370), "vars", [], "any", false, false, false, 370), "data", [], "any", false, false, false, 370), "getId", [], "method", false, false, false, 370) === null))) {
            // line 371
            echo "    ";
            // line 372
            echo "    ";
            $context["list"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "parent", [], "any", false, false, false, 372), "children", [], "any", false, false, false, 372), "properties", [], "any", false, false, false, 372), "list", [], "any", false, false, false, 372);
        }
        // line 374
        $context["feedbackClass"] = (($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["list"] ?? null), 'errors')) ? (" has-error") : (""));
        // line 375
        $context["datePrototype"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "vars", [], "any", false, true, false, 375), "prototype", [], "any", true, true, false, 375)) ? (twig_escape_filter($this->env, (("<div class=\"sortable\">" . $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "vars", [], "any", false, false, false, 375), "prototype", [], "any", false, false, false, 375), 'widget')) . "</div>"))) : (""));
        // line 376
        echo "<div class=\"row\">
    <div data-toggle=\"sortablelist\" data-prefix=\"";
        // line 377
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 377), "id", [], "any", false, false, false, 377), "html", null, true);
        echo "\" class=\"form-group col-xs-12 ";
        echo twig_escape_filter($this->env, ($context["feedbackClass"] ?? null), "html", null, true);
        echo "\" id=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 377), "is", [], "any", false, false, false, 377), "html", null, true);
        echo "_list\" style=\"overflow:auto\">
        ";
        // line 378
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'label', (twig_test_empty($_label_ = ($context["label"] ?? null)) ? [] : ["label" => $_label_]));
        echo "
        <a  data-prototype=\"";
        // line 379
        echo twig_escape_filter($this->env, ($context["datePrototype"] ?? null), "html", null, true);
        echo "\"
           class=\"btn btn-warning btn-xs btn-add-item\" href=\"#\" id=\"";
        // line 380
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 380), "id", [], "any", false, false, false, 380), "html", null, true);
        echo "_additem\">
            ";
        // line 381
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(($context["addValueButton"] ?? null)), "html", null, true);
        echo "
        </a>
        ";
        // line 383
        $this->displayBlock("sortablelist_errors", $context, $blocks);
        echo "
        ";
        // line 384
        if (($context["isSortable"] ?? null)) {
            // line 385
            echo "        <div id=\"sortable-";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 385), "id", [], "any", false, false, false, 385), "html", null, true);
            echo "\" class=\"list-sortable\" ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attr"] ?? null));
            foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                // line 386
                echo "        ";
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 387
            echo ">
        ";
        }
        // line 389
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["list"] ?? null), "children", [], "any", false, false, false, 389));
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
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 390
            echo "            ";
            $this->displayBlock("sortablelist_entry_row", $context, $blocks);
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
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 392
        echo "        </div>
        ";
        // line 393
        if (($context["isSortable"] ?? null)) {
            // line 394
            echo "        <input type=\"hidden\" class=\"sortable-itemcount\" id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 394), "id", [], "any", false, false, false, 394), "html", null, true);
            echo "_itemcount\" value=\"";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["list"] ?? null)), "html", null, true);
            echo "\" />
        ";
        }
        // line 396
        echo "    </div>
</div>
";
    }

    // line 401
    public function block_standalone_button_row($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 402
        echo "<div class=\"row\">
    <div class=\"form-group col-xs-12 col-sm-8 col-md-6\">
        ";
        // line 404
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["form"] ?? null), 'widget');
        echo "
    </div>
</div>
";
    }

    // line 410
    public function block_standalone_button_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 411
        if ( !($context["label"] ?? null)) {
            // line 412
            $context["label"] = $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->humanize(($context["name"] ?? null));
        }
        // line 414
        echo "<button type=\"";
        echo ((array_key_exists("type", $context)) ? (twig_escape_filter($this->env, ($context["type"] ?? null))) : ("button"));
        echo "\"
    ";
        // line 415
        $this->displayBlock("button_attributes", $context, $blocks);
        echo ">
    ";
        // line 416
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 416), "attr", [], "any", false, false, false, 416), "icon", [], "any", false, false, false, 416))) {
            // line 417
            echo "    <i class=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 417), "attr", [], "any", false, false, false, 417), "icon", [], "any", false, false, false, 417), "html", null, true);
            echo " \"></i>
    ";
        }
        // line 419
        echo "    ";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(($context["label"] ?? null), [], ($context["translation_domain"] ?? null)));
        echo "
</button>
";
    }

    // line 424
    public function block_tel_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 425
        $this->loadTemplate(["type" => ((array_key_exists("type", $context)) ? (($context["type"] ?? null)) : (call_user_func_array($this->env->getFunction('get_class')->getCallable(), ["Mautic\\CoreBundle\\Form\\Type\\TelType"])))], "@MauticCore/FormTheme/mautic_form_layout.html.twig", 425)->displayBlock("form_widget_simple", $context);
        echo "
";
    }

    // line 429
    public function block_time_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 430
        if ((($context["widget"] ?? null) === "single_text")) {
            // line 431
            echo "    ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
";
        } else {
            // line 433
            echo "    ";
            $context["size"] = 4;
            // line 434
            echo "    ";
            if (( !($context["with_minutes"] ?? null) &&  !($context["with_seconds"] ?? null))) {
                // line 435
                echo "        ";
                $context["size"] = 12;
                // line 436
                echo "    ";
            } elseif (( !($context["with_minutes"] ?? null) ||  !($context["with_seconds"] ?? null))) {
                // line 437
                echo "        ";
                $context["size"] = 6;
                // line 438
                echo "    ";
            }
            // line 439
            echo "    ";
            $context["vars"] = (((($context["widget"] ?? null) === "text")) ? (["attr" => ["size" => 1, "class" => "not-chosen"]]) : (["attr" => ["class" => "not-chosen"]]));
            // line 440
            echo "    <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
        ";
            // line 443
            echo "        ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "hour", [], "any", false, false, false, 443), 'widget', ($context["vars"] ?? null));
            echo "

        ";
            // line 445
            if (($context["with_minutes"] ?? null)) {
                // line 446
                echo "            ";
                echo twig_escape_filter($this->env, (":" . $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "minute", [], "any", false, false, false, 446), 'widget', ($context["vars"] ?? null))), "html", null, true);
                echo "
        ";
            }
            // line 448
            echo "
        ";
            // line 449
            if (($context["with_seconds"] ?? null)) {
                // line 450
                echo "            ";
                echo twig_escape_filter($this->env, (":" . $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "second", [], "any", false, false, false, 450), 'widget', ($context["vars"] ?? null))), "html", null, true);
                echo "
        ";
            }
            // line 452
            echo "    </div>
";
        }
    }

    // line 457
    public function block_widget_attributes($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 458
        echo "id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null));
        echo "\" name=\"";
        echo twig_escape_filter($this->env, ($context["full_name"] ?? null));
        echo "\"
";
        // line 459
        echo ((((array_key_exists("disabled", $context)) ? (_twig_default_filter(($context["disabled"] ?? null), false)) : (false))) ? ("disabled=\"disabled\"") : (""));
        echo "
";
        // line 460
        echo ((((array_key_exists("required", $context)) ? (_twig_default_filter(($context["required"] ?? null), false)) : (false))) ? ("required=\"required\"") : (""));
        echo "

";
        // line 462
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, ($context["attr"] ?? null), function ($__v__, $__k__) use ($context, $macros) { $context["v"] = $__v__; $context["k"] = $__k__; return !twig_in_filter($context["k"], [0 => "tooltip", 1 => "preaddon", 2 => "preaddon_attr", 3 => "postaddon_attr"]); }));
        foreach ($context['_seq'] as $context["k"] => $context["v"]) {
            // line 463
            echo "    ";
            if (twig_in_filter($context["k"], [0 => "placeholder", 1 => "title"])) {
                // line 464
                echo "        ";
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans($context["v"], [], ($context["translation_domain"] ?? null))));
                echo "
    ";
            } elseif ((            // line 465
$context["v"] === true)) {
                // line 466
                echo "        ";
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["k"]));
                echo "
    ";
            } elseif (twig_test_iterable(            // line 467
$context["v"])) {
                // line 468
                echo "        ";
                $context["v"] = $this->extensions['Mautic\CoreBundle\Templating\Twig\Extension\FormExtension']->formatList(twig_constant("Mautic\\FormBundle\\Helper\\FormFieldHelper::FORMAT_BAR"), $context["v"]);
                // line 469
                echo "        ";
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                echo "
    ";
            } elseif ( !(            // line 470
$context["v"] === false)) {
                // line 471
                echo "        ";
                echo twig_sprintf("%s=\"%s\" ", twig_escape_filter($this->env, $context["k"]), twig_escape_filter($this->env, $context["v"]));
                echo "
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 474
        echo "
";
        // line 476
        echo (( !twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "autocomplete", [], "any", true, true, false, 476)) ? ("autocomplete=\"false\" ") : (""));
        echo "
";
    }

    // line 480
    public function block_yesno_button_group_widget($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 482
        $context["attr"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "vars", [], "any", false, false, false, 482), "attr", [], "any", false, false, false, 482);
        // line 483
        $context["onchange"] = "Mautic.toggleYesNoButtonClass(mQuery(this).attr('id'));";
        // line 484
        echo "
";
        // line 485
        if (twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "onchange", [], "any", true, true, false, 485)) {
            // line 486
            echo "    ";
            if ( !(is_string($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "onchange", [], "any", false, false, false, 486)) && is_string($__internal_compile_1 = ";") && ('' === $__internal_compile_1 || $__internal_compile_1 === substr($__internal_compile_0, -strlen($__internal_compile_1))))) {
                // line 487
                echo "        ";
                $context["attr"] = twig_array_merge(($context["attr"] ?? null), ["onchange" => (twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "onchange", [], "any", false, false, false, 487) . ";")]);
                // line 488
                echo "    ";
            }
            // line 489
            echo "    ";
            $context["attr"] = twig_array_merge(($context["attr"] ?? null), ["onchange" => ((twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "onchange", [], "any", false, false, false, 489) . " ") . ($context["onchange"] ?? null))]);
        } else {
            // line 491
            echo "    ";
            $context["attr"] = twig_array_merge(($context["attr"] ?? null), ["onchange" => ($context["onchange"] ?? null)]);
        }
        // line 493
        echo "
";
        // line 494
        $context["attr"] = twig_array_merge(($context["attr"] ?? null), ["style" => "width: 1px; height: 1px; top: 0; left: 0; margin-top: 0;"]);
        // line 495
        echo "<div class=\"btn-group btn-block\" data-toggle=\"buttons\">
    ";
        // line 496
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["form"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 497
            echo "        ";
            $context["class"] = (( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 498
$context["child"], "vars", [], "any", false, false, false, 498), "checked", [], "any", false, false, false, 498))) ? (" active") : (((("" . ( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 499
$context["child"], "vars", [], "any", false, false, false, 499), "disabled", [], "any", false, false, false, 499)) ||  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["attr"] ?? null), "readonly", [], "any", false, false, false, 499))))) ? (" disabled") : (((("" . (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 500
$context["child"], "vars", [], "any", false, false, false, 500), "name", [], "any", false, false, false, 500) === "0"))) ? (" btn-no") : (((((((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 500), "name", [], "any", false, false, false, 500) === "1")) ? (" btn-yes") : (" btn-extra")) . ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 501
$context["child"], "vars", [], "any", false, false, false, 501), "name", [], "any", false, false, false, 501) === "0") &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 501), "checked", [], "any", false, false, false, 501))))) ? (" btn-danger") : (((("" . ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 502
$context["child"], "vars", [], "any", false, false, false, 502), "name", [], "any", false, false, false, 502) === "1") &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 502), "checked", [], "any", false, false, false, 502))))) ? (" btn-success") : (""))))))))));
            // line 504
            echo "        <label class=\"btn btn-default ";
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            echo "\">
            ";
            // line 505
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($context["child"], 'widget', ["attr" => ($context["attr"] ?? null)]);
            echo "
            <span>";
            // line 506
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 506), "label", [], "any", false, false, false, 506)), "html", null, true);
            echo "</span>
        </label>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 509
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "@MauticCore/FormTheme/mautic_form_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  1568 => 509,  1559 => 506,  1555 => 505,  1550 => 504,  1548 => 502,  1547 => 501,  1546 => 500,  1545 => 499,  1544 => 498,  1542 => 497,  1538 => 496,  1535 => 495,  1533 => 494,  1530 => 493,  1526 => 491,  1522 => 489,  1519 => 488,  1516 => 487,  1513 => 486,  1511 => 485,  1508 => 484,  1506 => 483,  1504 => 482,  1500 => 480,  1494 => 476,  1491 => 474,  1481 => 471,  1479 => 470,  1474 => 469,  1471 => 468,  1469 => 467,  1464 => 466,  1462 => 465,  1457 => 464,  1454 => 463,  1450 => 462,  1445 => 460,  1441 => 459,  1434 => 458,  1430 => 457,  1424 => 452,  1418 => 450,  1416 => 449,  1413 => 448,  1407 => 446,  1405 => 445,  1399 => 443,  1394 => 440,  1391 => 439,  1388 => 438,  1385 => 437,  1382 => 436,  1379 => 435,  1376 => 434,  1373 => 433,  1367 => 431,  1365 => 430,  1361 => 429,  1355 => 425,  1351 => 424,  1343 => 419,  1337 => 417,  1335 => 416,  1331 => 415,  1326 => 414,  1323 => 412,  1321 => 411,  1317 => 410,  1309 => 404,  1305 => 402,  1301 => 401,  1295 => 396,  1287 => 394,  1285 => 393,  1282 => 392,  1265 => 390,  1247 => 389,  1243 => 387,  1234 => 386,  1227 => 385,  1225 => 384,  1221 => 383,  1216 => 381,  1212 => 380,  1208 => 379,  1204 => 378,  1196 => 377,  1193 => 376,  1191 => 375,  1189 => 374,  1185 => 372,  1183 => 371,  1181 => 370,  1179 => 369,  1175 => 368,  1169 => 363,  1163 => 361,  1159 => 359,  1150 => 357,  1146 => 356,  1143 => 355,  1141 => 354,  1138 => 353,  1136 => 352,  1133 => 351,  1126 => 349,  1123 => 348,  1120 => 347,  1116 => 346,  1114 => 345,  1110 => 344,  1103 => 339,  1099 => 338,  1096 => 337,  1092 => 336,  1086 => 331,  1080 => 328,  1077 => 327,  1068 => 326,  1063 => 325,  1061 => 324,  1054 => 320,  1048 => 317,  1043 => 314,  1037 => 311,  1034 => 310,  1025 => 309,  1020 => 308,  1018 => 307,  1015 => 306,  1013 => 305,  1009 => 304,  999 => 299,  996 => 298,  991 => 297,  987 => 295,  981 => 292,  978 => 291,  969 => 290,  964 => 289,  961 => 288,  955 => 285,  952 => 284,  943 => 283,  938 => 282,  936 => 281,  928 => 279,  925 => 278,  920 => 277,  914 => 274,  911 => 273,  902 => 272,  897 => 271,  894 => 270,  888 => 267,  885 => 266,  876 => 265,  871 => 264,  869 => 263,  866 => 262,  864 => 261,  863 => 260,  862 => 259,  861 => 258,  858 => 257,  856 => 256,  854 => 255,  850 => 254,  843 => 249,  838 => 248,  832 => 245,  829 => 244,  827 => 243,  822 => 242,  818 => 241,  810 => 235,  807 => 234,  805 => 233,  799 => 231,  797 => 230,  793 => 229,  784 => 228,  773 => 227,  771 => 226,  769 => 225,  765 => 224,  757 => 218,  753 => 217,  749 => 216,  745 => 215,  742 => 214,  740 => 213,  738 => 212,  734 => 211,  726 => 206,  722 => 205,  713 => 204,  708 => 203,  706 => 202,  702 => 200,  700 => 199,  696 => 197,  694 => 196,  690 => 194,  688 => 193,  686 => 192,  682 => 191,  676 => 186,  670 => 184,  666 => 182,  657 => 180,  653 => 179,  650 => 178,  648 => 177,  645 => 176,  643 => 175,  639 => 174,  632 => 169,  630 => 168,  624 => 165,  621 => 164,  619 => 163,  612 => 162,  608 => 161,  602 => 156,  594 => 154,  592 => 153,  588 => 152,  585 => 151,  568 => 149,  550 => 148,  546 => 146,  544 => 145,  539 => 143,  535 => 142,  531 => 141,  527 => 140,  519 => 139,  516 => 138,  514 => 137,  512 => 136,  510 => 135,  508 => 134,  504 => 133,  497 => 128,  493 => 127,  490 => 126,  486 => 125,  476 => 118,  470 => 116,  467 => 115,  457 => 111,  453 => 110,  449 => 108,  444 => 107,  442 => 106,  437 => 104,  433 => 103,  430 => 102,  428 => 101,  426 => 99,  424 => 98,  420 => 97,  409 => 91,  407 => 90,  403 => 89,  401 => 88,  397 => 87,  393 => 86,  385 => 80,  379 => 77,  375 => 76,  369 => 73,  366 => 72,  364 => 71,  362 => 70,  358 => 69,  350 => 64,  344 => 62,  342 => 61,  338 => 60,  333 => 59,  330 => 57,  328 => 56,  324 => 55,  318 => 51,  314 => 50,  309 => 46,  302 => 44,  300 => 43,  296 => 42,  291 => 41,  288 => 40,  284 => 39,  279 => 38,  277 => 37,  273 => 35,  264 => 28,  260 => 27,  255 => 25,  251 => 24,  248 => 23,  246 => 22,  244 => 21,  240 => 20,  229 => 14,  227 => 13,  223 => 12,  221 => 11,  217 => 10,  215 => 9,  211 => 8,  202 => 7,  198 => 6,  194 => 480,  191 => 478,  189 => 457,  186 => 455,  184 => 429,  181 => 427,  179 => 424,  176 => 422,  174 => 410,  171 => 408,  169 => 401,  166 => 399,  164 => 368,  161 => 366,  159 => 344,  156 => 342,  154 => 336,  151 => 334,  149 => 304,  146 => 302,  144 => 254,  141 => 252,  139 => 241,  136 => 239,  134 => 224,  131 => 222,  129 => 211,  126 => 209,  124 => 191,  121 => 189,  119 => 174,  116 => 172,  114 => 161,  111 => 159,  109 => 133,  106 => 131,  104 => 125,  101 => 123,  99 => 97,  96 => 95,  94 => 86,  91 => 84,  89 => 69,  86 => 67,  84 => 55,  81 => 53,  79 => 50,  76 => 48,  74 => 35,  71 => 33,  69 => 20,  66 => 18,  64 => 6,);
    }

    public function getSourceContext()
    {
        return new Source("", "@MauticCore/FormTheme/mautic_form_layout.html.twig", "/home/tianwing/public_html/stats1/app/bundles/CoreBundle/Resources/views/FormTheme/mautic_form_layout.html.twig");
    }
}
