<?php

/* Bacardi55CvgeneratorBundle:Default:index.html.twig */
class __TwigTemplate_15692890bf10d1b3a2344ec5b80ebdca extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "Hello ";
        echo twig_escape_filter($this->env, $this->getContext($context, 'name'), "html");
        echo "!
";
    }

    public function getTemplateName()
    {
        return "Bacardi55CvgeneratorBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
