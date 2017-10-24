<?php

/* exhibitor/index.html.twig */
class __TwigTemplate_d6e90053933af8e776bca1d2acdf204e0b7dca1f336168c537afc03c5f1bd214 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "exhibitor/index.html.twig", 1);
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
        $__internal_f06906567b32bf7932f2721df7d79800bcae0daa61b4c586cda6c583976f7415 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f06906567b32bf7932f2721df7d79800bcae0daa61b4c586cda6c583976f7415->enter($__internal_f06906567b32bf7932f2721df7d79800bcae0daa61b4c586cda6c583976f7415_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "exhibitor/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f06906567b32bf7932f2721df7d79800bcae0daa61b4c586cda6c583976f7415->leave($__internal_f06906567b32bf7932f2721df7d79800bcae0daa61b4c586cda6c583976f7415_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_5c0ca08c4228b1c1d361700547ca2bea4e88920ab86a227b778d9e679c330106 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_5c0ca08c4228b1c1d361700547ca2bea4e88920ab86a227b778d9e679c330106->enter($__internal_5c0ca08c4228b1c1d361700547ca2bea4e88920ab86a227b778d9e679c330106_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <div class=\"table-responsive\">
        <div style=\"text-align: center\">
            <h1>Exhibitors List</h1>

            <table class=\"table table-bordered table-hover\">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th";
        // line 12
        if ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")), "isSorted", array(0 => "a.name"), "method")) {
            echo " class=\"sorted\"";
        }
        echo ">";
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->sortable($this->env, (isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")), "Name", "a.name");
        echo "</th>
                        <th";
        // line 13
        if ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")), "isSorted", array(0 => "a.boothno"), "method")) {
            echo " class=\"sorted\"";
        }
        echo ">";
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->sortable($this->env, (isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")), "Boothno", "a.boothno");
        echo "</th>
                        <th";
        // line 14
        if ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")), "isSorted", array(0 => "a.location"), "method")) {
            echo " class=\"sorted\"";
        }
        echo ">";
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->sortable($this->env, (isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")), "Location", "a.location");
        echo "</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 21
        $context["cntr"] = 0;
        // line 22
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")));
        foreach ($context['_seq'] as $context["_key"] => $context["exhibitor"]) {
            // line 23
            echo "                        ";
            $context["cntr"] = ((isset($context["cntr"]) ? $context["cntr"] : $this->getContext($context, "cntr")) + 1);
            // line 24
            echo "                        <tr>
                            <td>";
            // line 25
            echo twig_escape_filter($this->env, (isset($context["cntr"]) ? $context["cntr"] : $this->getContext($context, "cntr")), "html", null, true);
            echo "</td>    <td>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["exhibitor"], "name", array()), "html", null, true);
            echo "</td>
                            <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["exhibitor"], "boothno", array()), "html", null, true);
            echo "</td>
                            <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["exhibitor"], "location", array()), "html", null, true);
            echo "</td>
                            <td>";
            // line 28
            if ($this->getAttribute($context["exhibitor"], "createdOn", array())) {
                echo "<img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl(twig_replace_filter($this->getAttribute($context["exhibitor"], "image", array()), array("web/" => ""))), "html", null, true);
                echo "\" width=\"100\" height=\"100\" />";
            }
            echo "</td>
                            <td>";
            // line 29
            echo twig_escape_filter($this->env, twig_join_filter($this->getAttribute($context["exhibitor"], "categoryIds", array()), ","), "html", null, true);
            echo "</td>
                            <td>

                                <ul>
                                    <li>
                                        <a href=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_edit", array("id" => $this->getAttribute($context["exhibitor"], "id", array()))), "html", null, true);
            echo "\">Edit</a> |

                                        <a href=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_delete", array("id" => $this->getAttribute($context["exhibitor"], "id", array()))), "html", null, true);
            echo "\">Remove</a>
                                    </li>

                                </ul>
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exhibitor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "                </tbody>
            </table>
        </div></div>
    <div class=\"navigation\">
        ";
        // line 47
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->render($this->env, (isset($context["pagination"]) ? $context["pagination"] : $this->getContext($context, "pagination")));
        echo "
    </div>
    <ul>
        <li>
            <a href=\"";
        // line 51
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_new");
        echo "\" style=\"text-decoration: underline;\">Create a new exhibitor</a>
        </li>
    </ul>
";
        
        $__internal_5c0ca08c4228b1c1d361700547ca2bea4e88920ab86a227b778d9e679c330106->leave($__internal_5c0ca08c4228b1c1d361700547ca2bea4e88920ab86a227b778d9e679c330106_prof);

    }

    public function getTemplateName()
    {
        return "exhibitor/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 51,  147 => 47,  141 => 43,  128 => 36,  123 => 34,  115 => 29,  107 => 28,  103 => 27,  99 => 26,  93 => 25,  90 => 24,  87 => 23,  82 => 22,  80 => 21,  66 => 14,  58 => 13,  50 => 12,  40 => 4,  34 => 3,  11 => 1,);
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
            <h1>Exhibitors List</h1>

            <table class=\"table table-bordered table-hover\">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th{% if pagination.isSorted('a.name') %} class=\"sorted\"{% endif %}>{{ knp_pagination_sortable(pagination, 'Name', 'a.name') }}</th>
                        <th{% if pagination.isSorted('a.boothno') %} class=\"sorted\"{% endif %}>{{ knp_pagination_sortable(pagination, 'Boothno', 'a.boothno') }}</th>
                        <th{% if pagination.isSorted('a.location') %} class=\"sorted\"{% endif %}>{{ knp_pagination_sortable(pagination, 'Location', 'a.location') }}</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {% set cntr=0 %}
                    {% for exhibitor in pagination %}
                        {% set cntr=cntr+1 %}
                        <tr>
                            <td>{{cntr}}</td>    <td>{{ exhibitor.name }}</td>
                            <td>{{ exhibitor.boothno }}</td>
                            <td>{{ exhibitor.location }}</td>
                            <td>{% if exhibitor.createdOn %}<img src=\"{{asset(exhibitor.image|replace({\"web/\":\"\"}))}}\" width=\"100\" height=\"100\" />{% endif %}</td>
                            <td>{{exhibitor.categoryIds|join(',')}}</td>
                            <td>

                                <ul>
                                    <li>
                                        <a href=\"{{ path('exhibitor_edit', { 'id': exhibitor.id }) }}\">Edit</a> |

                                        <a href=\"{{ path('exhibitor_delete', { 'id': exhibitor.id }) }}\">Remove</a>
                                    </li>

                                </ul>
                            </td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div></div>
    <div class=\"navigation\">
        {{ knp_pagination_render(pagination) }}
    </div>
    <ul>
        <li>
            <a href=\"{{ path('exhibitor_new') }}\" style=\"text-decoration: underline;\">Create a new exhibitor</a>
        </li>
    </ul>
{% endblock %}
", "exhibitor/index.html.twig", "/var/www/html/eventapi/app/Resources/views/exhibitor/index.html.twig");
    }
}
