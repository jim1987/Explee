<?php

/* FOSTwitterBundle::initialize.html.twig */
class __TwigTemplate_0879b8a6e03da1fcd13fdbb9971e96430d88ec28722125dbfb21ba1cb1cc06fa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<script type=\"text/javascript\">
    ";
        // line 3
        if ((!twig_test_empty((isset($context["configMap"]) ? $context["configMap"] : $this->getContext($context, "configMap"))))) {
            // line 4
            echo "        twttr.anywhere.config(";
            echo twig_jsonencode_filter((isset($context["configMap"]) ? $context["configMap"] : $this->getContext($context, "configMap")));
            echo ");
    ";
        }
        // line 6
        echo "
    twttr.anywhere(function (T) {
        ";
        // line 8
        echo (isset($context["scripts"]) ? $context["scripts"] : $this->getContext($context, "scripts"));
        echo "
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "FOSTwitterBundle::initialize.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 8,  30 => 6,  24 => 4,  22 => 3,  41 => 10,  36 => 8,  32 => 7,  26 => 4,  19 => 2,);
    }
}
