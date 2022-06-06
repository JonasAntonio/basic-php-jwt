<?php

namespace Basic\Jwt\Algorithms;

use Basic\Jwt\Algorithm;

class Sha512 implements Algorithm
{
    public function name(): string
    {
        return "sha512";
    }

    public function symmetricHeader(): string
    {
        return "HS512";
    }

    public function asymmetricHeader(): string
    {
        return "RS512";
    }
}
