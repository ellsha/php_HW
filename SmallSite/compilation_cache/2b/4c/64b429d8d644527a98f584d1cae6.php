<?php

/* sign-up.html */
class __TwigTemplate_2b4c64b429d8d644527a98f584d1cae6 extends Twig_Template
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
        echo "Регистрация";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div id=\"wrapper-articles\">
        <div class=\"article\">
            <div class=\"article-border\"></div>
            <div class=\"article-inner-wrapper\">
                <h1>Регистрация</h1>

                <form method=\"post\" action=\"/registration\">
                    <p>
                        <input type=\"text\" placeholder=\"login\" name=\"login\"><br>
                        <input type=\"password\" placeholder=\"password\" name=\"password\"><br>
                        <input type=\"submit\" name=\"Зарегистрироваться\">
                    </p>
                </form>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "sign-up.html";
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
