<?php

namespace Framework\Contracts\Http;

use Framework\Collection;

interface Request
{
    /**
     * Return uri from request
     *
     * @return string
     */
    public function path();

    /**
     * Return HTTP method from request
     *
     * @return string
     */
    public function method();

    /**
     * Get value from input array
     * Returns $default if key not found
     *
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Checks for the parameter in the request
     *
     * @param string $key
     * @return bool
     */
    public function has($key);

    /**
     * Return HTTP headers collection
     *
     * @return Collection
     */
    public function headers();

    /**
     * Return cookies collection
     *
     * @return Collection
     */
    public function cookies();

    /**
     * Return parameters collection
     *
     * @return Collection
     */
    public function input();
}