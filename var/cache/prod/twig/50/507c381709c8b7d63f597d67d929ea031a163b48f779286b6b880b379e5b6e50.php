<?php

/* survey/index.html.twig */
class __TwigTemplate_aa2851863399f0c48d55d8d6a4dd7c2e5776facd0339e4caca477354b8097377 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "survey/index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'my_javascripts' => array($this, 'block_my_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f876485facce74063a13b7b10f7feaa45b51e404ad75413037c9268b786a1e48 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f876485facce74063a13b7b10f7feaa45b51e404ad75413037c9268b786a1e48->enter($__internal_f876485facce74063a13b7b10f7feaa45b51e404ad75413037c9268b786a1e48_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "survey/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f876485facce74063a13b7b10f7feaa45b51e404ad75413037c9268b786a1e48->leave($__internal_f876485facce74063a13b7b10f7feaa45b51e404ad75413037c9268b786a1e48_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_42b7ccea1656bcb9336d49d863d89116725084fdc3fa5d722c2112d8f61dc70a = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_42b7ccea1656bcb9336d49d863d89116725084fdc3fa5d722c2112d8f61dc70a->enter($__internal_42b7ccea1656bcb9336d49d863d89116725084fdc3fa5d722c2112d8f61dc70a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "   <div class=\"table-responsive\">
      <div style=\"text-align: center\">
         <h1>Surveys  List</h1>

         <table class=\"table table-bordered table-hover\">
            <thead>
               <tr>
                  <th>Sr.</th>
                  <th>Event Name</th>
                  <th>Survey Name</th>
                  <th>Descriptions</th>
                  <th>Active</th>
                  <th>Created On</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody> ";
        // line 20
        $context["cntr"] = 0;
        // line 21
        echo "               ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["surveys"]) ? $context["surveys"] : $this->getContext($context, "surveys")));
        foreach ($context['_seq'] as $context["_key"] => $context["survey"]) {
            // line 22
            echo "                  ";
            $context["cntr"] = ((isset($context["cntr"]) ? $context["cntr"] : $this->getContext($context, "cntr")) + 1);
            // line 23
            echo "                  <tr>
                     <td>";
            // line 24
            echo twig_escape_filter($this->env, (isset($context["cntr"]) ? $context["cntr"] : $this->getContext($context, "cntr")), "html", null, true);
            echo "</td>
                     <td>";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["survey"], "event_title", array()), "html", null, true);
            echo "</td>
                     <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["survey"], "title", array()), "html", null, true);
            echo "</td>
                     <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["survey"], "descriptions", array()), "html", null, true);
            echo "</td>
                     <td>";
            // line 28
            if ($this->getAttribute($context["survey"], "active", array())) {
                echo "Yes";
            } else {
                echo "No";
            }
            echo "</td>
                     <td>";
            // line 29
            if ($this->getAttribute($context["survey"], "createdOn", array())) {
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["survey"], "createdOn", array()), "Y-m-d H:i:s"), "html", null, true);
            }
            echo "</td>
                     <td>
                        <ul>
                           <li>
                              <a onclick=\"javascript:if (!confirm('All previous data related to this survey will be deleted.Please export the data before editing.'))
                                       return false;\"  href=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_edit", array("id" => $this->getAttribute($context["survey"], "id", array()))), "html", null, true);
            echo "\">Edit</a>
                              | ";
            // line 37
            echo "                              <a class='anc_delete'  
                                 data-method=\"DELETE\"
                                 data-csrf=\"_token:";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderCsrfToken("authenticate"), "html", null, true);
            echo "\"
                                 href=\"";
            // line 40
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_delete", array("id" => $this->getAttribute($context["survey"], "id", array()))), "html", null, true);
            echo " \"
                                 data-confirm = \"All previous data related to this survey will be deleted.Please export the data before deleting\"
                                 >";
            // line 42
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Remove", array(), "button"), "html", null, true);
            echo "                      
                              </a>
                        </ul>
                        </li>
                        </ul>
                     </td>
                  </tr>
               ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['survey'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "            </tbody>
         </table></div></div>

   <ul>
      <li>
         <a href=\"";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_new");
        echo "\" style=\"text-decoration: underline;\">Create a new survey</a>
      </li>
   </ul>
   ";
        // line 58
        $this->displayBlock('my_javascripts', $context, $blocks);
        
        $__internal_42b7ccea1656bcb9336d49d863d89116725084fdc3fa5d722c2112d8f61dc70a->leave($__internal_42b7ccea1656bcb9336d49d863d89116725084fdc3fa5d722c2112d8f61dc70a_prof);

    }

    public function block_my_javascripts($context, array $blocks = array())
    {
        $__internal_e2f31adca0291bc636360f29798c143edc0230104267d4f6c14fd4037808652f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e2f31adca0291bc636360f29798c143edc0230104267d4f6c14fd4037808652f->enter($__internal_e2f31adca0291bc636360f29798c143edc0230104267d4f6c14fd4037808652f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "my_javascripts"));

        // line 59
        echo "      <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/js/common.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
   ";
        
        $__internal_e2f31adca0291bc636360f29798c143edc0230104267d4f6c14fd4037808652f->leave($__internal_e2f31adca0291bc636360f29798c143edc0230104267d4f6c14fd4037808652f_prof);

    }

    public function getTemplateName()
    {
        return "survey/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 59,  150 => 58,  144 => 55,  137 => 50,  123 => 42,  118 => 40,  114 => 39,  110 => 37,  106 => 34,  96 => 29,  88 => 28,  84 => 27,  80 => 26,  76 => 25,  72 => 24,  69 => 23,  66 => 22,  61 => 21,  59 => 20,  41 => 4,  35 => 3,  11 => 1,);
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
   <div class=\"table-responsive\">
      <div style=\"text-align: center\">
         <h1>Surveys  List</h1>

         <table class=\"table table-bordered table-hover\">
            <thead>
               <tr>
                  <th>Sr.</th>
                  <th>Event Name</th>
                  <th>Survey Name</th>
                  <th>Descriptions</th>
                  <th>Active</th>
                  <th>Created On</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody> {% set cntr=0 %}
               {% for survey in surveys %}
                  {% set cntr=cntr+1 %}
                  <tr>
                     <td>{{cntr}}</td>
                     <td>{{survey.event_title}}</td>
                     <td>{{ survey.title }}</td>
                     <td>{{ survey.descriptions }}</td>
                     <td>{% if survey.active %}Yes{% else %}No{% endif %}</td>
                     <td>{% if survey.createdOn %}{{ survey.createdOn|date('Y-m-d H:i:s') }}{% endif %}</td>
                     <td>
                        <ul>
                           <li>
                              <a onclick=\"javascript:if (!confirm('All previous data related to this survey will be deleted.Please export the data before editing.'))
                                       return false;\"  href=\"{{ path('survey_edit', { 'id': survey.id }) }}\">Edit</a>
                              | {#<a onclick=\"javascript:if (!confirm('All previous data related to this survey will be deleted.Please export the data before deleting. '))
                                      return false;\" href=\"{{ path('survey_delete', { 'id': survey.id }) }}\">Remove</a>#}
                              <a class='anc_delete'  
                                 data-method=\"DELETE\"
                                 data-csrf=\"_token:{{csrf_token('authenticate') }}\"
                                 href=\"{{ path('survey_delete', { 'id': survey.id }) }} \"
                                 data-confirm = \"All previous data related to this survey will be deleted.Please export the data before deleting\"
                                 >{{ 'Remove'|trans({}, 'button') }}                      
                              </a>
                        </ul>
                        </li>
                        </ul>
                     </td>
                  </tr>
               {% endfor %}
            </tbody>
         </table></div></div>

   <ul>
      <li>
         <a href=\"{{ path('survey_new') }}\" style=\"text-decoration: underline;\">Create a new survey</a>
      </li>
   </ul>
   {% block my_javascripts %}
      <script src=\"{{asset('assets/js/common.js')}}\" type=\"text/javascript\"></script>
   {% endblock %}
{% endblock %}
", "survey/index.html.twig", "/var/www/html/eventapi/app/Resources/views/survey/index.html.twig");
    }
}
