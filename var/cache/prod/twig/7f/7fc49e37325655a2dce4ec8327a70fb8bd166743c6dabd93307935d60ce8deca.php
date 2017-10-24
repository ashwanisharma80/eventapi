<?php

/* default/index.html.twig */
class __TwigTemplate_0bbea68ae53252979ddf21c00d9c7b4c3ee1912ba32bb4afd6025d43baf427d7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "default/index.html.twig", 1);
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
        $__internal_dda9ba2dce7cc8c92a013e06157e403f1f9dbcc6e275d8d6ccf1ccff36bbb6a7 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_dda9ba2dce7cc8c92a013e06157e403f1f9dbcc6e275d8d6ccf1ccff36bbb6a7->enter($__internal_dda9ba2dce7cc8c92a013e06157e403f1f9dbcc6e275d8d6ccf1ccff36bbb6a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_dda9ba2dce7cc8c92a013e06157e403f1f9dbcc6e275d8d6ccf1ccff36bbb6a7->leave($__internal_dda9ba2dce7cc8c92a013e06157e403f1f9dbcc6e275d8d6ccf1ccff36bbb6a7_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_fbd3c72657eb98df1fbaa8c963d9fd93316727153831e0dc401dfac652f64fc6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_fbd3c72657eb98df1fbaa8c963d9fd93316727153831e0dc401dfac652f64fc6->enter($__internal_fbd3c72657eb98df1fbaa8c963d9fd93316727153831e0dc401dfac652f64fc6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"fa fa-home fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div  class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">EVENTS MANAGER</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"";
        // line 18
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("events_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 25
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("events_new");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 32
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("events_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>



            <!---------------------------------------- Second panel----------------------------------------------->
            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"fa fa-building fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">EXHIBITOR INFO</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"";
        // line 57
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 64
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_new");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 71
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>

            <!---------------------------------------- Third panel-------------------------------------------------->


            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"fa fa-map-marker fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">SHOW MAPS</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"";
        // line 96
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("maps_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 103
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("maps_new");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 110
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("maps_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!--------------------------------------- Fourth panel---------------------------------------------------------->

            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"glyphicon glyphicon-list-alt fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">SURVEY</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"";
        // line 135
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 142
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_new");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"";
        // line 149
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_index");
        echo "\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>
           \t\t
        </div>
        <!-- /.row -->

    </div>
";
        
        $__internal_fbd3c72657eb98df1fbaa8c963d9fd93316727153831e0dc401dfac652f64fc6->leave($__internal_fbd3c72657eb98df1fbaa8c963d9fd93316727153831e0dc401dfac652f64fc6_prof);

    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 149,  210 => 142,  200 => 135,  172 => 110,  162 => 103,  152 => 96,  124 => 71,  114 => 64,  104 => 57,  76 => 32,  66 => 25,  56 => 18,  40 => 4,  34 => 3,  11 => 1,);
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
    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"fa fa-home fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div  class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">EVENTS MANAGER</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"{{path('events_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{ path('events_new') }}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{path('events_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>



            <!---------------------------------------- Second panel----------------------------------------------->
            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"fa fa-building fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">EXHIBITOR INFO</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"{{path('exhibitor_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{ path('exhibitor_new') }}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{path('exhibitor_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>

            <!---------------------------------------- Third panel-------------------------------------------------->


            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"fa fa-map-marker fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">SHOW MAPS</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"{{path('maps_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{path('maps_new')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{path('maps_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>


            <!--------------------------------------- Fourth panel---------------------------------------------------------->

            <div class=\"col-lg-6 col-md-6\">
                <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                        <div class=\"row\">
                            <div class=\"col-xs-3 text-center\">
                                <i class=\"glyphicon glyphicon-list-alt fa-2x\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"col-xs-6 text-center\">
                                <div class=\"desgin\">SURVEY</div>
                            </div>
                        </div>
                    </div>
                    <a href=\"{{path('survey_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Show</span>
                            <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right fa-2x\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{path('survey_new')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Add</span>
                            <span class=\"pull-right\"><i class=\"fa fa-plus-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                    <a href=\"{{path('survey_index')}}\">
                        <div class=\"panel-heading\">
                            <span class=\"pull-left\">Delete</span>
                            <span class=\"pull-right\"><i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></span>
                            <div class=\"clearfix\"></div>
                        </div>
                    </a>
                </div>
            </div>
           \t\t
        </div>
        <!-- /.row -->

    </div>
{% endblock %}
", "default/index.html.twig", "/var/www/html/eventapi/app/Resources/views/default/index.html.twig");
    }
}
