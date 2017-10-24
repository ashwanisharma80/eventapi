<?php

/* user/adduser.html.twig */
class __TwigTemplate_c8a2405209e526dd34540757385e38a2fbbb493145642e00a6452bc19e5237e1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "user/adduser.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_07d5cc4a74e064c38f8dd14e70d7ddb96e74f4f7d358f468694dd23b9bfc38ba = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_07d5cc4a74e064c38f8dd14e70d7ddb96e74f4f7d358f468694dd23b9bfc38ba->enter($__internal_07d5cc4a74e064c38f8dd14e70d7ddb96e74f4f7d358f468694dd23b9bfc38ba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "user/adduser.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_07d5cc4a74e064c38f8dd14e70d7ddb96e74f4f7d358f468694dd23b9bfc38ba->leave($__internal_07d5cc4a74e064c38f8dd14e70d7ddb96e74f4f7d358f468694dd23b9bfc38ba_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_3910e47de5eea9820aea4523ae7d7130ef25f0de8bc49fda84568e916fc6b68c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3910e47de5eea9820aea4523ae7d7130ef25f0de8bc49fda84568e916fc6b68c->enter($__internal_3910e47de5eea9820aea4523ae7d7130ef25f0de8bc49fda84568e916fc6b68c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Add User";
        
        $__internal_3910e47de5eea9820aea4523ae7d7130ef25f0de8bc49fda84568e916fc6b68c->leave($__internal_3910e47de5eea9820aea4523ae7d7130ef25f0de8bc49fda84568e916fc6b68c_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_001a9dc510947a2c6c407227a52d6ae173393327266f83229c4ef591e4bb8d2f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_001a9dc510947a2c6c407227a52d6ae173393327266f83229c4ef591e4bb8d2f->enter($__internal_001a9dc510947a2c6c407227a52d6ae173393327266f83229c4ef591e4bb8d2f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <h1 style=\"margin-right:100px;\">Add User</h1>
    <div id=\"error_mess\">";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "html", null, true);
        echo "</div>
    <div id=\"success_mess\">";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message")), "html", null, true);
        echo "</div>
    <form name=\"addemail\" method=\"post\" action=\"\" onsubmit=\"javascript:return checkform();\">
        <div><label for=\"name\" class=\"required\">First Name</label>
            <input type=\"text\" id=\"name\" name=\"name\" required=\"required\" maxlength=\"255\"/>
        </div>
        <div><label for=\"name\" class=\"required\">Last Name</label>
            <input type=\"text\" id=\"lname\" name=\"lname\" required=\"required\" maxlength=\"255\"/>
        </div>
        <div><label for=\"email\" class=\"required\">Email Address</label>
            <input type=\"email\" id=\"email\" name=\"email\" required=\"required\" maxlength=\"255\"/>
        </div>
        <div><label for=\"role\" class=\"required\">Roles</label>
            <input type=\"radio\" id=\"roles\" name=\"roles[]\" value=\"ROLE_ADMIN\" />&nbsp&nbspAdmin
            <input type=\"radio\" id=\"roles\" name=\"roles[]\" value=\"ROLE_USER\" checked=\"checked\" />&nbsp&nbspUser
        </div>
        <input type=\"submit\" value=\"Add User\" />
    </form>
    <script type = \"text/javascript\" >
        \$(function () {
            jQuery.noConflict();

        });
        function checkform() {
            if (\$('#email').val() ==\"\") {
                alert(\"Enter email address\");
                return false;
            }
            return true;
        }
    </script>

";
        
        $__internal_001a9dc510947a2c6c407227a52d6ae173393327266f83229c4ef591e4bb8d2f->leave($__internal_001a9dc510947a2c6c407227a52d6ae173393327266f83229c4ef591e4bb8d2f_prof);

    }

    public function getTemplateName()
    {
        return "user/adduser.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 6,  56 => 5,  53 => 4,  47 => 3,  35 => 2,  11 => 1,);
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
{% block title %}Add User{% endblock %}
{% block body %}
    <h1 style=\"margin-right:100px;\">Add User</h1>
    <div id=\"error_mess\">{{error}}</div>
    <div id=\"success_mess\">{{message}}</div>
    <form name=\"addemail\" method=\"post\" action=\"\" onsubmit=\"javascript:return checkform();\">
        <div><label for=\"name\" class=\"required\">First Name</label>
            <input type=\"text\" id=\"name\" name=\"name\" required=\"required\" maxlength=\"255\"/>
        </div>
        <div><label for=\"name\" class=\"required\">Last Name</label>
            <input type=\"text\" id=\"lname\" name=\"lname\" required=\"required\" maxlength=\"255\"/>
        </div>
        <div><label for=\"email\" class=\"required\">Email Address</label>
            <input type=\"email\" id=\"email\" name=\"email\" required=\"required\" maxlength=\"255\"/>
        </div>
        <div><label for=\"role\" class=\"required\">Roles</label>
            <input type=\"radio\" id=\"roles\" name=\"roles[]\" value=\"ROLE_ADMIN\" />&nbsp&nbspAdmin
            <input type=\"radio\" id=\"roles\" name=\"roles[]\" value=\"ROLE_USER\" checked=\"checked\" />&nbsp&nbspUser
        </div>
        <input type=\"submit\" value=\"Add User\" />
    </form>
    <script type = \"text/javascript\" >
        \$(function () {
            jQuery.noConflict();

        });
        function checkform() {
            if (\$('#email').val() ==\"\") {
                alert(\"Enter email address\");
                return false;
            }
            return true;
        }
    </script>

{% endblock %}
", "user/adduser.html.twig", "/var/www/html/eventapi/app/Resources/views/user/adduser.html.twig");
    }
}
