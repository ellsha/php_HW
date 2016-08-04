<?php

/* articles.html */
class __TwigTemplate_2464d0938569339ee478520f68fc4ad2 extends Twig_Template
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

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "Записи в таблице";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div id=\"wrapper-articles\">
        ";
        // line 6
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) ? $context["articles"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 7
            echo "        <div class=\"article\">
            <div class=\"article-border\"></div>
            <div class=\"article-inner-wrapper\">
                <div>#";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : null), "id"), "html", null, true);
            echo "</div>
                <div>Date: ";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : null), "date"), "html", null, true);
            echo "</div>
                <div>Title: ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : null), "title"), "html", null, true);
            echo "</div>
                <div>Content: ";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : null), "content"), "html", null, true);
            echo "</div>
            </div>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 17
        echo "
        <div id=\"pagination\">
            ";
        // line 19
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["pageCount"]) ? $context["pageCount"] : null)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 20
            echo "            <a href=\"?page=";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
            echo "</a>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 22
        echo "        </div>

    </div>
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
        return array (  91 => 22,  80 => 20,  76 => 19,  72 => 17,  62 => 13,  58 => 12,  54 => 11,  50 => 10,  45 => 7,  41 => 6,  38 => 5,  35 => 4,  29 => 2,);
    }
}
