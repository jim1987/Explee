<?php

/* FOSTwitterBundle::setup.html.twig */
class __TwigTemplate_d6f3ecc856019552e60f0e6e32a7cb34aae8bb21e4b149137732c88eb6b96a02 extends Twig_Template
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
        // line 1
        echo "<script src=\"http://platform.twitter.com/anywhere.js?id=";
        echo twig_escape_filter($this->env, (isset($context["apiKey"]) ? $context["apiKey"] : $this->getContext($context, "apiKey")), "html", null, true);
        echo "&v=";
        echo twig_escape_filter($this->env, (isset($context["version"]) ? $context["version"] : $this->getContext($context, "version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
";
    }

    public function getTemplateName()
    {
        return "FOSTwitterBundle::setup.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 3,  19 => 1,);
    }
}
