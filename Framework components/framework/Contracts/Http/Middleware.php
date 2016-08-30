<?php

namespace Framework\Contracts\Http;

interface Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     *
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, callable $next);
}