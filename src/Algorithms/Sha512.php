<?php

namespace Basic\Jwt\Algorithms;

use Basic\Jwt\Algorithm;

class Sha512 implements Algorithm
{
    public function name(): string
    {
        return "Sha512";
    }

    public function headerName(): string
    {
        return "HS512";
    }
}