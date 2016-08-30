<?php

/* form.html */
class __TwigTemplate_7b087be0fb384791b4526496c92c6eb7 extends Twig_Template
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
        echo "Добавить запись";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div id=\"wrapper-articles\">
        <div class=\"article\">
            <div class=\"article-border\"></div>
            <div class=\"article-inner-wrapper\">
                <h1>Добавить запись в таблицу</h1>

                <form method=\"post\" action=\"/add-post\">
                    <p>
                        <input type=\"text\" placeholder=\"Заголовок\" name=\"title\"></br>
                        <input type=\"text\" name=\"content\" placeholder=\"Описание\">
                    </p>
                    <p><input name=\"OK\" type=\"submit\"></p>
                </form>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "form.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 5,  35 => 4,  29 => 2,);
    }
}
