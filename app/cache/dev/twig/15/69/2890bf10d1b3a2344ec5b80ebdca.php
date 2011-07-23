<?php

/* Bacardi55CvgeneratorBundle:Default:index.html.twig */
class __TwigTemplate_15692890bf10d1b3a2344ec5b80ebdca extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("::base.html.twig");
        }

        return $this->parent;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "default
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
