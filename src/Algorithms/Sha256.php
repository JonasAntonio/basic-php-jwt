<?php

namespace Basic\Jwt\Algorithms;

use Basic\Jwt\Algorithm;

class Sha256 implements Algorithm
{
    public function name(): string
    {
        return "Sha256";
    }

    public function headerName(): string
    {
        return "HS256";
    }
}