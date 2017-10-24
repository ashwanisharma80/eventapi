<?php

/* events/new.html.twig */
class __TwigTemplate_259267c8683be4b190807ab03fb04aa810cfe1079def93f6c975181e19e1a798 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("base.html.twig", "events/new.html.twig", 2);
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
        $__internal_2bdef1cac752c704e0539e901e97f89f146251055f7a3f18da3ed8449b24c8ed = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_2bdef1cac752c704e0539e901e97f89f146251055f7a3f18da3ed8449b24c8ed->enter($__internal_2bdef1cac752c704e0539e901e97f89f146251055f7a3f18da3ed8449b24c8ed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "events/new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2bdef1cac752c704e0539e901e97f89f146251055f7a3f18da3ed8449b24c8ed->leave($__internal_2bdef1cac752c704e0539e901e97f89f146251055f7a3f18da3ed8449b24c8ed_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_27bdccddc1ccaba43d4f9485f87adfc2ae56badc366b2189b0252463a693d104 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_27bdccddc1ccaba43d4f9485f87adfc2ae56badc366b2189b0252463a693d104->enter($__internal_27bdccddc1ccaba43d4f9485f87adfc2ae56badc366b2189b0252463a693d104_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "  ";
        echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "html", null, true);
        echo "

  <h1 style=\"margin-right:100px;\">Events Creation</h1>

  ";
        // line 9
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
  <div>";
        // line 10
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "title", array()), 'label');
        echo "
    ";
        // line 11
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "title", array()), 'errors');
        echo "
    ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "title", array()), 'widget');
        echo "</div>
  <div>";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "description", array()), 'label');
        echo "
    ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "description", array()), 'errors');
        echo "
    ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "description", array()), 'widget');
        echo "</div><br>
\t\t<div id=\"start\"><h6>StartTime</h6></div><div id=\"end\"><h6>EndTime</h6></div>
  <div><label for=\"events_event_schedule\" class=\"required\">Event Schedule</label>

   <input id=\"events_event_schedule\" name=\"events[event_schedule]\" required=\"required\" class=\"datepicker\" type=\"text\">
   <input id=\"events_event_schedule1\" name=\"events[event_endschedule]\" required=\"required\" class=\"datepicker\" type=\"text\">
    <a href=\"javascript:void(0);\" id=\"add\" class=\"add_button\" style=\"color:#000;position:relative;top:4px;\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></a>
    <div id=\"event_Schedule\" class=\"event_Schedule\">
    </div>
  </div>
  <div>";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "logo", array()), 'label');
        echo "
    ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "logo", array()), 'errors');
        echo "
    ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "logo", array()), 'widget');
        echo "</div>
  <div>";
        // line 28
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "event_Image", array()), 'label');
        echo "
    ";
        // line 29
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "event_Image", array()), 'errors');
        echo "
    ";
        // line 30
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "event_Image", array()), 'widget');
        echo "<a href=\"javascript:void(0);\" id=\"add1\" ><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\" style=\"color:#000;position:relative;top:10px;\"></i></a></div>
  <div id=\"event_Image\" class=\"event_Image\">
  </div>
  <div>";
        // line 33
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "location", array()), 'label');
        echo "
    ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "location", array()), 'errors');
        echo "
    ";
        // line 35
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "location", array()), 'widget');
        echo "</div>
  <div>";
        // line 36
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'label');
        echo "
    ";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'errors');
        echo "
    ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "address", array()), 'widget');
        echo "</div>

  <div>";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'label');
        echo "
    ";
        // line 41
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'errors');
        echo "
    ";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "website", array()), 'widget');
        echo "</div>

  <div>";
        // line 44
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "faqslink", array()), 'label');
        echo "
    ";
        // line 45
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "faqslink", array()), 'errors');
        echo "
    ";
        // line 46
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "faqslink", array()), 'widget');
        echo "</div>
  <div>";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "schedulelink", array()), 'label');
        echo "
    ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "schedulelink", array()), 'errors');
        echo "
    ";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "schedulelink", array()), 'widget');
        echo "</div>
  <div>";
        // line 50
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "exhibitorIds", array()), 'label');
        echo "
    ";
        // line 51
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "exhibitorIds", array()), 'errors');
        echo "
    ";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "exhibitorIds", array()), 'widget');
        echo "</div>
  <div>";
        // line 53
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "active", array()), 'label');
        echo "
    ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "active", array()), 'errors');
        echo "
    ";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "active", array()), 'widget');
        echo "</div>
  <input type=\"submit\" name=\"create\" value=\"Create\" />
  ";
        // line 57
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

  <ul>
    <li>
      <a href=\"";
        // line 61
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("events_index");
        echo "\">Back to the list</a>
    </li>
  </ul>


  <script type=\"text/javascript\">
    \$(function () {
      jQuery.noConflict();
      //fadeout selected item and remove
      \$('.remove').live('click', function () {
        \$(this).parent().fadeOut(300, function () {
          \$(this).empty();
          return false;
        });
      });
      var options = '<p><input type=\"text\" class=\"datepicker\" name=\"event_schedules[]\" id=\"eventSch\" value=\"\" size=\"10\" style=\"margin-left:250px;\"/><input type=\"text\" class=\"datepicker\" name=\"event_endschedules[]\" id=\"eventSch\" value=\"\" size=\"10\" /><i class=\"remove fa fa-minus-circle fa-2x\" aria-hidden=\"true\" style=\"display: inline; position: relative; top: 4px; margin-left:4px;\"></i></p>';

      //add input
      \$('a#add').click(function () {
        if (\$('.datepicker').length < 4) {
          \$(options).fadeIn(\"slow\").appendTo('#event_Schedule');
          i++;
          return false;
        }else{
          alert(\"Maximum two dates range allowed\");
        }
      });

      \$('.datepicker').live('click', function () {
        \$(this).datetimepicker({
          format:'Y-m-d H:i', //D, l, M, F, Y-m-d H:i:s
        }).focus();
       // \$(this).datepicker('destroy').datepicker({changeMonth: true, changeYear: true, dateFormat: \"yy-mm-dd\", yearRange: \"1900:+10\", showOn: 'focus'}).focus();
      });
      var options2 = '<p><input type=\"file\" name=\"event_Image[]\" id=\"eventImg\" value=\"\" size=\"10\" />  <i class=\"remove fa fa-minus-circle fa-2x\" aria-hidden=\"true\" style=\"color:#000;position:relative;top:10px;\"></i></p>';

      //add input
      \$('a#add1').click(function () {
        \$(options2).fadeIn(\"slow\").appendTo('#event_Image');
        i++;
        return false;
      });

    });
  </script>
";
        
        $__internal_27bdccddc1ccaba43d4f9485f87adfc2ae56badc366b2189b0252463a693d104->leave($__internal_27bdccddc1ccaba43d4f9485f87adfc2ae56badc366b2189b0252463a693d104_prof);

    }

    public function getTemplateName()
    {
        return "events/new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 61,  198 => 57,  193 => 55,  189 => 54,  185 => 53,  181 => 52,  177 => 51,  173 => 50,  169 => 49,  165 => 48,  161 => 47,  157 => 46,  153 => 45,  149 => 44,  144 => 42,  140 => 41,  136 => 40,  131 => 38,  127 => 37,  123 => 36,  119 => 35,  115 => 34,  111 => 33,  105 => 30,  101 => 29,  97 => 28,  93 => 27,  89 => 26,  85 => 25,  72 => 15,  68 => 14,  64 => 13,  60 => 12,  56 => 11,  52 => 10,  48 => 9,  40 => 5,  34 => 4,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
{% extends 'base.html.twig' %}

{% block body %}
  {{error}}

  <h1 style=\"margin-right:100px;\">Events Creation</h1>

  {{ form_start(form) }}
  <div>{{ form_label(form.title) }}
    {{ form_errors(form.title) }}
    {{ form_widget(form.title) }}</div>
  <div>{{ form_label(form.description) }}
    {{ form_errors(form.description) }}
    {{ form_widget(form.description) }}</div><br>
\t\t<div id=\"start\"><h6>StartTime</h6></div><div id=\"end\"><h6>EndTime</h6></div>
  <div><label for=\"events_event_schedule\" class=\"required\">Event Schedule</label>

   <input id=\"events_event_schedule\" name=\"events[event_schedule]\" required=\"required\" class=\"datepicker\" type=\"text\">
   <input id=\"events_event_schedule1\" name=\"events[event_endschedule]\" required=\"required\" class=\"datepicker\" type=\"text\">
    <a href=\"javascript:void(0);\" id=\"add\" class=\"add_button\" style=\"color:#000;position:relative;top:4px;\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></a>
    <div id=\"event_Schedule\" class=\"event_Schedule\">
    </div>
  </div>
  <div>{{ form_label(form.logo) }}
    {{ form_errors(form.logo) }}
    {{ form_widget(form.logo) }}</div>
  <div>{{ form_label(form.event_Image) }}
    {{ form_errors(form.event_Image) }}
    {{ form_widget(form.event_Image) }}<a href=\"javascript:void(0);\" id=\"add1\" ><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\" style=\"color:#000;position:relative;top:10px;\"></i></a></div>
  <div id=\"event_Image\" class=\"event_Image\">
  </div>
  <div>{{ form_label(form.location) }}
    {{ form_errors(form.location) }}
    {{ form_widget(form.location) }}</div>
  <div>{{ form_label(form.address) }}
    {{ form_errors(form.address) }}
    {{ form_widget(form.address) }}</div>

  <div>{{ form_label(form.website) }}
    {{ form_errors(form.website) }}
    {{ form_widget(form.website) }}</div>

  <div>{{ form_label(form.faqslink) }}
    {{ form_errors(form.faqslink) }}
    {{ form_widget(form.faqslink) }}</div>
  <div>{{ form_label(form.schedulelink) }}
    {{ form_errors(form.schedulelink) }}
    {{ form_widget(form.schedulelink) }}</div>
  <div>{{ form_label(form.exhibitorIds) }}
    {{ form_errors(form.exhibitorIds) }}
    {{ form_widget(form.exhibitorIds) }}</div>
  <div>{{ form_label(form.active) }}
    {{ form_errors(form.active) }}
    {{ form_widget(form.active) }}</div>
  <input type=\"submit\" name=\"create\" value=\"Create\" />
  {{ form_end(form) }}

  <ul>
    <li>
      <a href=\"{{ path('events_index') }}\">Back to the list</a>
    </li>
  </ul>


  <script type=\"text/javascript\">
    \$(function () {
      jQuery.noConflict();
      //fadeout selected item and remove
      \$('.remove').live('click', function () {
        \$(this).parent().fadeOut(300, function () {
          \$(this).empty();
          return false;
        });
      });
      var options = '<p><input type=\"text\" class=\"datepicker\" name=\"event_schedules[]\" id=\"eventSch\" value=\"\" size=\"10\" style=\"margin-left:250px;\"/><input type=\"text\" class=\"datepicker\" name=\"event_endschedules[]\" id=\"eventSch\" value=\"\" size=\"10\" /><i class=\"remove fa fa-minus-circle fa-2x\" aria-hidden=\"true\" style=\"display: inline; position: relative; top: 4px; margin-left:4px;\"></i></p>';

      //add input
      \$('a#add').click(function () {
        if (\$('.datepicker').length < 4) {
          \$(options).fadeIn(\"slow\").appendTo('#event_Schedule');
          i++;
          return false;
        }else{
          alert(\"Maximum two dates range allowed\");
        }
      });

      \$('.datepicker').live('click', function () {
        \$(this).datetimepicker({
          format:'Y-m-d H:i', //D, l, M, F, Y-m-d H:i:s
        }).focus();
       // \$(this).datepicker('destroy').datepicker({changeMonth: true, changeYear: true, dateFormat: \"yy-mm-dd\", yearRange: \"1900:+10\", showOn: 'focus'}).focus();
      });
      var options2 = '<p><input type=\"file\" name=\"event_Image[]\" id=\"eventImg\" value=\"\" size=\"10\" />  <i class=\"remove fa fa-minus-circle fa-2x\" aria-hidden=\"true\" style=\"color:#000;position:relative;top:10px;\"></i></p>';

      //add input
      \$('a#add1').click(function () {
        \$(options2).fadeIn(\"slow\").appendTo('#event_Image');
        i++;
        return false;
      });

    });
  </script>
{% endblock %}

", "events/new.html.twig", "/var/www/html/eventapi/app/Resources/views/events/new.html.twig");
    }
}
