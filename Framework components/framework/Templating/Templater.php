<?php

namespace Framework\Templating;

class Templater
{
    /**
     * Base path for templates
     *
     * @var string $path
     */
    private $path;

    /**
     * Templater constructor
     *
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param string $file
     * @param string[] $parameters
     *
     * @return string
     */
    public function parse($file, $parameters)
    {
        $page = file_get_contents($this->path . $file);

        return $this->match($page, $parameters);
    }

    /**
     * @param string $page
     * @param string[] $parameters
     *
     * @return string
     */
    private function match($page, $parameters)
    {
        foreach ($parameters as $key => $value) {
            $pattern = '/{{\s*\$(' . $key . ')\s*}}/';
            $page = preg_replace($pattern, $value, $page);
        }

        return $page;
    }
}