<?php

/* base.html */
class __TwigTemplate_8944b57466f08564caa53a1988261ae0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"ru\">
<head>
    <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"./templates/css/style.css\">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,500,700,900,400italic,100,500italic,700italic,900italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>

    <div id=\"header\">
        <div id=\"header-inner-wrapper\">
            <a href=\"/\">
                <div id=\"bold\">SITE</div>
                <div id=\"light\">in creating</div>
            </a>
        </div>
    </div>

    <div id=\"menu\">
        <div id=\"menu-inner-wrapper\">
            <a href=\"/form\">Добавить запись</a>
            <a href=\"/\">Просмотреть записи</a>
            <a href=\"/sign-in\">Войти</a>
            <a href=\"/sign-out\">Выйти</a>
            <a href=\"/sign-up\">Зарегистрироваться</a>
        </div>
    </div>

    <div id=\"main-block-wrapper\">

        <div id=\"content\">
            ";
        // line 34
        $this->displayBlock('content', $context, $blocks);
        // line 36
        echo "        </div>

        <div id=\"sidebar\">
            <div id=\"inner-sidebar\">
                <div id=\"sidebar-title\">
                    Меню
                </div>
                <div class=\"sidebar-block\">
                    <div class=\"sidebar-block-title\">Название</div>
                    <div class=\"sidebar-block-content\">Описание</div>
                </div>
            </div>
        </div>

        <div class=\"clearfix\"></div>

    </div>



</body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
    }

    // line 34
    public function block_content($context, array $blocks = array())
    {
        // line 35
        echo "            ";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  94 => 35,  91 => 34,  86 => 4,  61 => 36,  59 => 34,  26 => 4,  21 => 1,);
    }
}
