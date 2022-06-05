<?php

namespace Basic\Jwt;

interface Algorithm
{
    public function name(): string;

    public function headerName(): string;
}