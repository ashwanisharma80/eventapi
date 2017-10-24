<?php

/* base.html.twig */
class __TwigTemplate_592f47877f16632f10fac22250aa6a1a973f752db3884422e6cf2b170d94f764 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a0829de6199e5f3b58342ec4f2eb5974ab6b8549236dd59b822b247144ef26d5 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a0829de6199e5f3b58342ec4f2eb5974ab6b8549236dd59b822b247144ef26d5->enter($__internal_a0829de6199e5f3b58342ec4f2eb5974ab6b8549236dd59b822b247144ef26d5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

  <head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>";
        // line 12
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
   
    <!-- Bootstrap Core CSS -->
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/css/dashboard.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/font-awesome/css/font-awesome.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
    <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/js/jquery-ui-themes/themes/smoothness/jquery-ui.css"), "html", null, true);
        echo "\">
 
    <script src=\"http://code.jquery.com/jquery-1.8.2.js\"></script>
    <script src=\"http://code.jquery.com/ui/1.9.0/jquery-ui.js\"></script>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css\"/>

<script src=\"https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js\"></script>
<script src=\"https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/js/jquery.datetimepicker.full.js"), "html", null, true);
        echo "\"></script>
    <link rel=\"stylesheet\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/css/jquery.datetimepicker.css"), "html", null, true);
        echo "\" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
    
    

  ";
        // line 40
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 41
        echo "  <script>

    \$(function () {
      \$(\"li a\").each(function (i) {
        var href = \$(this).attr('href');
        \$(this).removeClass(\"activetab\");

        if (\"http://localhost\" + href == window.location.href) {
          \$(this).addClass(\"activetab\");

        }
      });

    });
 

  </script>
</head>

<body>


<body>

  <div id=\"wrapper\">

    <!-- Navigation -->
    <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class=\"navbar-header\">
        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-ex1-collapse\">
          <span class=\"sr-only\">Toggle navigation</span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
        </button>
        
        <a class=\"navbar-brand\" href=\"#\">SB Admin</a>

      </div>
      <!-- Top Menu Items-->
      <ul class=\"nav navbar-right top-nav\">

        <li>
          <img src=\"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/images/user.png"), "html", null, true);
        echo "\" class=\"cls\">
        </li>
        <li>
          <a href=\"#\">Welcome<br>";
        // line 88
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "token"), "method", false, true), "email", array(), "any", true, true)) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "get", array(0 => "token"), "method"), "email", array()), "html", null, true);
        }
        echo "</a>
        </li>
      </ul>


      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
        <ul class=\"nav navbar-nav side-nav\">
          <li>
            <a  href=\"";
        // line 97
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("dashboard_page");
        echo "\"><i class=\"fa fa-fw fa-dashboard\"></i><h4>Dashboard</h4></a>
          </li>
          <!--li>
              <a href=\"";
        // line 100
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("events_index");
        echo "\"><i class=\"fa fa-fw fa-home\" aria-hidden=\"true\"></i><h4>Home</h4></a>
          </li-->
          <li>
            <a href=\"";
        // line 103
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_index");
        echo "\"><i class=\"fa fa-fw fa-user\" aria-hidden=\"true\"></i><h4>User Manager</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 106
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_app");
        echo "\"><i class=\"fa fa-fw fa-user\" aria-hidden=\"true\"></i><h4>APP Users</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 109
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("events_index");
        echo "\"><i class=\"fa fa-fw fa-calendar-check-o\" aria-hidden=\"true\"></i><h4>Events Manager</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 112
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("category_index");
        echo "\"><i class=\"fa fa-fw fa-pencil-square-o\" aria-hidden=\"true\"></i><h4>Category Manager</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 115
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("exhibitor_index");
        echo "\"><i class=\"fa fa-fw fa-archive\" aria-hidden=\"true\"></i><h4>Exhibitor Info</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 118
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_index");
        echo "\"><span class=\"glyphicon glyphicon-th-list  fa-fw\"></span><h4>Survey</h4></a>
          </li>
            <li>
            <a href=\"";
        // line 121
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("survey_results");
        echo "\"><span class=\"glyphicon glyphicon-thumbs-up  fa-fw\"></span><h4>Survey Results</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 124
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("maps_index");
        echo "\"><i class=\"fa fa-fw fa-map-marker\" aria-hidden=\"true\"></i><h4>Show Maps</h4></a>
          </li>
          <li>
            <a href=\"";
        // line 127
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("notification_message_index");
        echo "\"><i class=\"fa fa-fw fa-question-circle\" aria-hidden=\"true\"></i><h4>Notification Messages</h4></a>
          </li>

          <li>
            <a href=\"";
        // line 131
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_updatepassword");
        echo "\"><i class=\"fa fa-fw fa-key\" aria-hidden=\"true\"></i><h4>Change Password</h4></a>
          </li>
          ";
        // line 133
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 134
            echo "            <li>
              <a href=\"";
            // line 135
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_adduser");
            echo "\"><i class=\"fa fa-fw fa-user-plus\" aria-hidden=\"true\"></i><h4>Add User</h4></a>
            </li>
          ";
        }
        // line 138
        echo "          <li>

          </li>
          <li><a href=\"";
        // line 141
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("logout_check");
        echo "\"><i class=\"fa fa-fw fa-sign-out\" aria-hidden=\"true\"></i><h4>Logout</h4></a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>
    <!------------------------------------panel start----------------------------------->
    <div id=\"page-wrapper\">
      ";
        // line 149
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashBag", array()), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flash_message"]) {
            // line 150
            echo "        <div class=\"flash-notice\">
          ";
            // line 151
            echo twig_escape_filter($this->env, $context["flash_message"], "html", null, true);
            echo "
        </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flash_message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 154
        echo "
      <!-- /.row -->
    ";
        // line 156
        $this->displayBlock('body', $context, $blocks);
        // line 157
        echo "  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

";
        // line 166
        $this->displayBlock('javascripts', $context, $blocks);
        // line 167
        echo "<!-- jQuery -->
<script src=\"";
        // line 168
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/js/jquery.js"), "html", null, true);
        echo "\"></script>

<!-- Bootstrap Core JavaScript -->
<script src=\"";
        // line 171
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>


</body>

</html>
";
        
        $__internal_a0829de6199e5f3b58342ec4f2eb5974ab6b8549236dd59b822b247144ef26d5->leave($__internal_a0829de6199e5f3b58342ec4f2eb5974ab6b8549236dd59b822b247144ef26d5_prof);

    }

    // line 12
    public function block_title($context, array $blocks = array())
    {
        $__internal_dc90a67d5e915578cddc7ece7b88a61a28a45d3c509e3a3849212a7cf001db75 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_dc90a67d5e915578cddc7ece7b88a61a28a45d3c509e3a3849212a7cf001db75->enter($__internal_dc90a67d5e915578cddc7ece7b88a61a28a45d3c509e3a3849212a7cf001db75_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Admin Panel";
        
        $__internal_dc90a67d5e915578cddc7ece7b88a61a28a45d3c509e3a3849212a7cf001db75->leave($__internal_dc90a67d5e915578cddc7ece7b88a61a28a45d3c509e3a3849212a7cf001db75_prof);

    }

    // line 40
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_4bfae334a1102623216aec47e575e06bd17604a09638e3ab5a114ed3cb9f5515 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_4bfae334a1102623216aec47e575e06bd17604a09638e3ab5a114ed3cb9f5515->enter($__internal_4bfae334a1102623216aec47e575e06bd17604a09638e3ab5a114ed3cb9f5515_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_4bfae334a1102623216aec47e575e06bd17604a09638e3ab5a114ed3cb9f5515->leave($__internal_4bfae334a1102623216aec47e575e06bd17604a09638e3ab5a114ed3cb9f5515_prof);

    }

    // line 156
    public function block_body($context, array $blocks = array())
    {
        $__internal_83da387b2aa02a42904715208efb7f3e0d29c6fd48197400a454e909f0807dfd = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_83da387b2aa02a42904715208efb7f3e0d29c6fd48197400a454e909f0807dfd->enter($__internal_83da387b2aa02a42904715208efb7f3e0d29c6fd48197400a454e909f0807dfd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_83da387b2aa02a42904715208efb7f3e0d29c6fd48197400a454e909f0807dfd->leave($__internal_83da387b2aa02a42904715208efb7f3e0d29c6fd48197400a454e909f0807dfd_prof);

    }

    // line 166
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_8d176142cb44fd42e0db6e776745402323d901136c35d1107d0f6b95e416c692 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8d176142cb44fd42e0db6e776745402323d901136c35d1107d0f6b95e416c692->enter($__internal_8d176142cb44fd42e0db6e776745402323d901136c35d1107d0f6b95e416c692_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_8d176142cb44fd42e0db6e776745402323d901136c35d1107d0f6b95e416c692->leave($__internal_8d176142cb44fd42e0db6e776745402323d901136c35d1107d0f6b95e416c692_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  348 => 166,  337 => 156,  326 => 40,  314 => 12,  300 => 171,  294 => 168,  291 => 167,  289 => 166,  278 => 157,  276 => 156,  272 => 154,  263 => 151,  260 => 150,  256 => 149,  245 => 141,  240 => 138,  234 => 135,  231 => 134,  229 => 133,  224 => 131,  217 => 127,  211 => 124,  205 => 121,  199 => 118,  193 => 115,  187 => 112,  181 => 109,  175 => 106,  169 => 103,  163 => 100,  157 => 97,  142 => 88,  136 => 85,  90 => 41,  88 => 40,  75 => 30,  71 => 29,  60 => 21,  56 => 20,  51 => 18,  45 => 15,  39 => 12,  26 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">

  <head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>{% block title %}Admin Panel{% endblock %}</title>
   
    <!-- Bootstrap Core CSS -->
    <link href=\"{{asset('assets/css/bootstrap.min.css')}}\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"{{asset('assets/css/dashboard.css')}}\" rel=\"stylesheet\">
    <!-- Custom Fonts -->
    <link href=\"{{asset('assets/font-awesome/css/font-awesome.min.css')}}\" rel=\"stylesheet\" type=\"text/css\">
    <link rel=\"stylesheet\" href=\"{{asset('assets/js/jquery-ui-themes/themes/smoothness/jquery-ui.css')}}\">
 
    <script src=\"http://code.jquery.com/jquery-1.8.2.js\"></script>
    <script src=\"http://code.jquery.com/ui/1.9.0/jquery-ui.js\"></script>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css\"/>

<script src=\"https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js\"></script>
<script src=\"https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js\"></script>
    <script type=\"text/javascript\" src=\"{{asset('assets/js/jquery.datetimepicker.full.js')}}\"></script>
    <link rel=\"stylesheet\" href=\"{{asset('assets/css/jquery.datetimepicker.css')}}\" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
    
    

  {% block stylesheets %}{% endblock %}
  <script>

    \$(function () {
      \$(\"li a\").each(function (i) {
        var href = \$(this).attr('href');
        \$(this).removeClass(\"activetab\");

        if (\"http://localhost\" + href == window.location.href) {
          \$(this).addClass(\"activetab\");

        }
      });

    });
 

  </script>
</head>

<body>


<body>

  <div id=\"wrapper\">

    <!-- Navigation -->
    <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class=\"navbar-header\">
        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-ex1-collapse\">
          <span class=\"sr-only\">Toggle navigation</span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
        </button>
        
        <a class=\"navbar-brand\" href=\"#\">SB Admin</a>

      </div>
      <!-- Top Menu Items-->
      <ul class=\"nav navbar-right top-nav\">

        <li>
          <img src=\"{{asset('assets/images/user.png')}}\" class=\"cls\">
        </li>
        <li>
          <a href=\"#\">Welcome<br>{% if app.session.get('token').email is defined %} {{ app.session.get('token').email}}{% endif %}</a>
        </li>
      </ul>


      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
        <ul class=\"nav navbar-nav side-nav\">
          <li>
            <a  href=\"{{ path('dashboard_page') }}\"><i class=\"fa fa-fw fa-dashboard\"></i><h4>Dashboard</h4></a>
          </li>
          <!--li>
              <a href=\"{{ path('events_index') }}\"><i class=\"fa fa-fw fa-home\" aria-hidden=\"true\"></i><h4>Home</h4></a>
          </li-->
          <li>
            <a href=\"{{ path('user_index') }}\"><i class=\"fa fa-fw fa-user\" aria-hidden=\"true\"></i><h4>User Manager</h4></a>
          </li>
          <li>
            <a href=\"{{ path('user_app') }}\"><i class=\"fa fa-fw fa-user\" aria-hidden=\"true\"></i><h4>APP Users</h4></a>
          </li>
          <li>
            <a href=\"{{ path('events_index') }}\"><i class=\"fa fa-fw fa-calendar-check-o\" aria-hidden=\"true\"></i><h4>Events Manager</h4></a>
          </li>
          <li>
            <a href=\"{{ path('category_index') }}\"><i class=\"fa fa-fw fa-pencil-square-o\" aria-hidden=\"true\"></i><h4>Category Manager</h4></a>
          </li>
          <li>
            <a href=\"{{path('exhibitor_index')}}\"><i class=\"fa fa-fw fa-archive\" aria-hidden=\"true\"></i><h4>Exhibitor Info</h4></a>
          </li>
          <li>
            <a href=\"{{path('survey_index')}}\"><span class=\"glyphicon glyphicon-th-list  fa-fw\"></span><h4>Survey</h4></a>
          </li>
            <li>
            <a href=\"{{path('survey_results')}}\"><span class=\"glyphicon glyphicon-thumbs-up  fa-fw\"></span><h4>Survey Results</h4></a>
          </li>
          <li>
            <a href=\"{{path('maps_index')}}\"><i class=\"fa fa-fw fa-map-marker\" aria-hidden=\"true\"></i><h4>Show Maps</h4></a>
          </li>
          <li>
            <a href=\"{{path('notification_message_index')}}\"><i class=\"fa fa-fw fa-question-circle\" aria-hidden=\"true\"></i><h4>Notification Messages</h4></a>
          </li>

          <li>
            <a href=\"{{path('user_updatepassword')}}\"><i class=\"fa fa-fw fa-key\" aria-hidden=\"true\"></i><h4>Change Password</h4></a>
          </li>
          {% if is_granted('ROLE_ADMIN') %}
            <li>
              <a href=\"{{path('user_adduser')}}\"><i class=\"fa fa-fw fa-user-plus\" aria-hidden=\"true\"></i><h4>Add User</h4></a>
            </li>
          {% endif %}
          <li>

          </li>
          <li><a href=\"{{path('logout_check')}}\"><i class=\"fa fa-fw fa-sign-out\" aria-hidden=\"true\"></i><h4>Logout</h4></a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>
    <!------------------------------------panel start----------------------------------->
    <div id=\"page-wrapper\">
      {% for flash_message in app.session.flashBag.get('notice') %}
        <div class=\"flash-notice\">
          {{ flash_message }}
        </div>
      {% endfor %}

      <!-- /.row -->
    {% block body %}{% endblock %}
  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

{% block javascripts %}{% endblock %}
<!-- jQuery -->
<script src=\"{{asset('assets/js/jquery.js')}}\"></script>

<!-- Bootstrap Core JavaScript -->
<script src=\"{{asset('assets/js/bootstrap.min.js')}}\"></script>


</body>

</html>
", "base.html.twig", "/var/www/html/eventapi/app/Resources/views/base.html.twig");
    }
}
