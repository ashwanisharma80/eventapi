<?php

/* exhibitor/new.html.twig */
class __TwigTemplate_20d69440a92905d11f79dba499c3d985a9a441254e3d656b90c08e05ea7c6551 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "exhibitor/new.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7542424e23261ce0328ffc3dd99fef0e6498634b46f75462fcbdcdd432a55fef = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_7542424e23261ce0328ffc3dd99fef0e6498634b46f75462fcbdcdd432a55fef->enter($__internal_7542424e23261ce0328ffc3dd99fef0e6498634b46f75462fcbdcdd432a55fef_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "exhibitor/new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7542424e23261ce0328ffc3dd99fef0e6498634b46f75462fcbdcdd432a55fef->leave($__internal_7542424e23261ce0328ffc3dd99fef0e6498634b46f75462fcbdcdd432a55fef_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_c2d312739d917c6dee52d934a06b559458e29188338ce190576e1cddd758f138 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c2d312739d917c6dee52d934a06b559458e29188338ce190576e1cddd758f138->enter($__internal_c2d312739d917c6dee52d934a06b559458e29188338ce190576e1cddd758f138_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <h1 style=\"margin-right:100px;\">Exhibitor Creation</h1>
";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "html", null, true);
        echo "
    ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
      <div>";
        // line 7
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'label');
        echo "
        ";
        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'errors');
        echo "
        ";
        // line 9
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'widget');
        echo "</div>
          <div>";
        // line 10
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "boothno", array()), 'label');
        echo "
        ";
        // line 11
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "boothno", array()), 'errors');
        echo "
        ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "boothno", array()), 'widget');
        echo "</div>
          <div>";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "location", array()), 'label');
        echo "
        ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "location", array()), 'errors');
        echo "
        ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "location", array()), 'widget');
        echo "</div>
          <div>";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "logo", array()), 'label');
        echo "
        ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "logo", array()), 'errors');
        echo "
        ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "logo", array()), 'widget');
        echo "</div>
          <div>";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "image", array()), 'label');
        echo "
        ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "image", array()), 'errors');
        echo "
        ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "image", array()), 'widget');
        echo "</div>
          <div>";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "contactNumber", array()), 'label');
        echo "
        ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "contactNumber", array()), 'errors');
        echo "
        ";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "contactNumber", array()), 'widget');
        echo "</div>
          <div>";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "emailAdd", array()), 'label');
        echo "
        ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "emailAdd", array()), 'errors');
        echo "
        ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "emailAdd", array()), 'widget');
        echo "</div>
          <div>";
        // line 28
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "url", array()), 'label');
        echo "
        ";
        // line 29
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "url", array()), 'errors');
        echo "
        ";
        // line 30
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "url", array()), 'widget');
        echo "</div>
        
          <div>";
        // line 32
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "categoryIds", array()), 'label');
        echo "
        ";
        // line 33
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "categoryIds", array()), 'errors');
        echo "
        ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "categoryIds", array()), 'widget');
        echo "</div>
          <div>";
        // line 35
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "productDesc", array()), 'label');
        echo "
        ";
        // line 36
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "productDesc", array()), 'errors');
        echo "
        ";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "productDesc", array()), 'widget');
        echo "</div>
          <div>";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventShowcase", array()), 'label');
        echo "
        ";
        // line 39
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventShowcase", array()), 'errors');
        echo "
        ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventShowcase", array()), 'widget');
        echo "</div>
          <div>";
        // line 41
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventshowcaseInfo", array()), 'label');
        echo "
        ";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventshowcaseInfo", array()), 'errors');
        echo "
        ";
        // line 43
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventshowcaseInfo", array()), 'widget');
        echo "</div>
          <div>";
        // line 44
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventshowcaseimage", array()), 'label');
        echo "
        ";
        // line 45
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventshowcaseimage", array()), 'errors');
        echo "
        ";
        // line 46
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "eventshowcaseimage", array()), 'widget');
        echo "</div>
          <div>";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Facebooklink", array()), 'label');
        echo "
        ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Facebooklink", array()), 'errors');
        echo "
        ";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Facebooklink", array()), 'widget');
        echo "</div>
          <div>";
        // line 50
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Youtubelink", array()), 'label');
        echo "
        ";
        // line 51
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Youtubelink", array()), 'errors');
        echo "
        ";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Youtubelink", array()), 'widget');
        echo "</div>
          <div>";
        // line 53
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Instagram", array()), 'label');
        echo "
        ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Instagram", array()), 'errors');
        echo "
        ";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Instagram", array()), 'widget');
        echo "</div>
          <div>";
        // line 56
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Twiterlink", array()), 'label');
        echo "
        ";
        // line 57
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Twiterlink", array()), 'errors');
        echo "
        ";
        // line 58
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Twiterlink", array()), 'widget');
        echo "</div>
          <div>";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "active", array()), 'label');
        echo "
        ";
        // line 60
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "active", array()), 'errors');
        echo "
        ";
        // line 61
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "active", array()), 'widget');
        echo "</div>
         
    ";
        // line 63
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "


    <input type=\"submit\" value=\"Create\" />
    ";
        // line 67
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

    <ul>
        <li>
            <a href=\"";
        // line 71
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_index");
        echo "\">Back to the list</a>
        </li>
    </ul>
    <script type = \"text/javascript\" >
        \$(function () {
            jQuery.noConflict();
            \$('#exhibitor_eventshowcaseInfo').hide();
            \$('#exhibitor_eventshowcaseimage').hide();
            if (\$('#exhibitor_eventShowcase_0').is(':checked')) {
                \$('#exhibitor_eventshowcaseInfo').show();
                \$('#exhibitor_eventshowcaseimage').show();
            }
            if (\$('#exhibitor_eventShowcase_1').is(':checked')) {
                \$('#exhibitor_eventshowcaseInfo').hide();
                \$('#exhibitor_eventshowcaseimage').hide();
            }
            \$('#exhibitor_eventShowcase_0').click(function () {
                \$('#exhibitor_eventshowcaseInfo').show();
                \$('#exhibitor_eventshowcaseimage').show();
            });
            \$('#exhibitor_eventShowcase_1').click(function () {
                \$('#exhibitor_eventshowcaseInfo').hide();
                \$('#exhibitor_eventshowcaseimage').hide();
            });
        });
    </script>
";
        
        $__internal_c2d312739d917c6dee52d934a06b559458e29188338ce190576e1cddd758f138->leave($__internal_c2d312739d917c6dee52d934a06b559458e29188338ce190576e1cddd758f138_prof);

    }

    public function getTemplateName()
    {
        return "exhibitor/new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  283 => 71,  276 => 67,  269 => 63,  264 => 61,  260 => 60,  256 => 59,  252 => 58,  248 => 57,  244 => 56,  240 => 55,  236 => 54,  232 => 53,  228 => 52,  224 => 51,  220 => 50,  216 => 49,  212 => 48,  208 => 47,  204 => 46,  200 => 45,  196 => 44,  192 => 43,  188 => 42,  184 => 41,  180 => 40,  176 => 39,  172 => 38,  168 => 37,  164 => 36,  160 => 35,  156 => 34,  152 => 33,  148 => 32,  143 => 30,  139 => 29,  135 => 28,  131 => 27,  127 => 26,  123 => 25,  119 => 24,  115 => 23,  111 => 22,  107 => 21,  103 => 20,  99 => 19,  95 => 18,  91 => 17,  87 => 16,  83 => 15,  79 => 14,  75 => 13,  71 => 12,  67 => 11,  63 => 10,  59 => 9,  55 => 8,  51 => 7,  47 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}

{% block body %}
    <h1 style=\"margin-right:100px;\">Exhibitor Creation</h1>
{{error}}
    {{ form_start(form) }}
      <div>{{ form_label(form.name) }}
        {{ form_errors(form.name) }}
        {{ form_widget(form.name) }}</div>
          <div>{{ form_label(form.boothno) }}
        {{ form_errors(form.boothno) }}
        {{ form_widget(form.boothno) }}</div>
          <div>{{ form_label(form.location) }}
        {{ form_errors(form.location) }}
        {{ form_widget(form.location) }}</div>
          <div>{{ form_label(form.logo) }}
        {{ form_errors(form.logo) }}
        {{ form_widget(form.logo) }}</div>
          <div>{{ form_label(form.image) }}
        {{ form_errors(form.image) }}
        {{ form_widget(form.image) }}</div>
          <div>{{ form_label(form.contactNumber) }}
        {{ form_errors(form.contactNumber) }}
        {{ form_widget(form.contactNumber) }}</div>
          <div>{{ form_label(form.emailAdd) }}
        {{ form_errors(form.emailAdd) }}
        {{ form_widget(form.emailAdd) }}</div>
          <div>{{ form_label(form.url) }}
        {{ form_errors(form.url) }}
        {{ form_widget(form.url) }}</div>
        
          <div>{{ form_label(form.categoryIds) }}
        {{ form_errors(form.categoryIds) }}
        {{ form_widget(form.categoryIds) }}</div>
          <div>{{ form_label(form.productDesc) }}
        {{ form_errors(form.productDesc) }}
        {{ form_widget(form.productDesc) }}</div>
          <div>{{ form_label(form.eventShowcase) }}
        {{ form_errors(form.eventShowcase) }}
        {{ form_widget(form.eventShowcase) }}</div>
          <div>{{ form_label(form.eventshowcaseInfo) }}
        {{ form_errors(form.eventshowcaseInfo) }}
        {{ form_widget(form.eventshowcaseInfo) }}</div>
          <div>{{ form_label(form.eventshowcaseimage) }}
        {{ form_errors(form.eventshowcaseimage) }}
        {{ form_widget(form.eventshowcaseimage) }}</div>
          <div>{{ form_label(form.Facebooklink) }}
        {{ form_errors(form.Facebooklink) }}
        {{ form_widget(form.Facebooklink) }}</div>
          <div>{{ form_label(form.Youtubelink) }}
        {{ form_errors(form.Youtubelink) }}
        {{ form_widget(form.Youtubelink) }}</div>
          <div>{{ form_label(form.Instagram) }}
        {{ form_errors(form.Instagram) }}
        {{ form_widget(form.Instagram) }}</div>
          <div>{{ form_label(form.Twiterlink) }}
        {{ form_errors(form.Twiterlink) }}
        {{ form_widget(form.Twiterlink) }}</div>
          <div>{{ form_label(form.active) }}
        {{ form_errors(form.active) }}
        {{ form_widget(form.active) }}</div>
         
    {{ form_widget(form) }}


    <input type=\"submit\" value=\"Create\" />
    {{ form_end(form) }}

    <ul>
        <li>
            <a href=\"{{ path('exhibitor_index') }}\">Back to the list</a>
        </li>
    </ul>
    <script type = \"text/javascript\" >
        \$(function () {
            jQuery.noConflict();
            \$('#exhibitor_eventshowcaseInfo').hide();
            \$('#exhibitor_eventshowcaseimage').hide();
            if (\$('#exhibitor_eventShowcase_0').is(':checked')) {
                \$('#exhibitor_eventshowcaseInfo').show();
                \$('#exhibitor_eventshowcaseimage').show();
            }
            if (\$('#exhibitor_eventShowcase_1').is(':checked')) {
                \$('#exhibitor_eventshowcaseInfo').hide();
                \$('#exhibitor_eventshowcaseimage').hide();
            }
            \$('#exhibitor_eventShowcase_0').click(function () {
                \$('#exhibitor_eventshowcaseInfo').show();
                \$('#exhibitor_eventshowcaseimage').show();
            });
            \$('#exhibitor_eventShowcase_1').click(function () {
                \$('#exhibitor_eventshowcaseInfo').hide();
                \$('#exhibitor_eventshowcaseimage').hide();
            });
        });
    </script>
{% endblock %}
", "exhibitor/new.html.twig", "/var/www/html/eventapi/app/Resources/views/exhibitor/new.html.twig");
    }
}
