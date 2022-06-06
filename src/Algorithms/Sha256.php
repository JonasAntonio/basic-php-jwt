<?php

namespace Basic\Jwt\Algorithms;

use Basic\Jwt\Algorithm;

class Sha256 implements Algorithm
{
    public function name(): string
    {
        return "sha256";
    }

    public function symmetricHeader(): string
    {
        return "HS256";
    }

    public function asymmetricHeader(): string
    {
        return "RS256";
    }
}
