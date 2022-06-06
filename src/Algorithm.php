<?php

namespace Basic\Jwt;

interface Algorithm
{
    public function name(): string;
    public function symmetricHeader(): string;
    public function asymmetricHeader(): string;
}
