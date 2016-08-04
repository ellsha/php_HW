<?php

/* articles.html */
class __TwigTemplate_60b535fabe8577fa8859336549673c27 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Серия романов о Гарри Поттере";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "<h1>Записи в таблице</h1>

<div id=\"wrapper-rows\">
    ";
        // line 9
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["rows"]) ? $context["rows"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 10
            echo "    <div class=\"row\">
    \t<strong>";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "number"), "html", null, true);
            echo "</strong>. \"<em>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "title"), "html", null, true);
            echo "\"</em> - ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "date"), "html", null, true);
            echo "
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 14
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "articles.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 14,  50 => 11,  47 => 10,  43 => 9,  38 => 6,  35 => 5,  29 => 3,);
    }
}
