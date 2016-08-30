<?php

namespace Framework\Contracts;

interface Arrayable
{
    /**
     * Transforms object to array
     *
     * @return array
     */
    public function toArray();
}