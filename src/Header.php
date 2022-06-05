<?php

namespace Basic\Jwt;

class Header
{
    private Algorithm $algorithm;
    private array $data;

    public function __construct(Algorithm $algorithm)
    {
        $this->algorithm = $algorithm;
        $this->data = [
            'typ' => 'JWT',
            'alg' => $this->algorithm->headerName()
        ];
    }

    public function __toString()
    {
        return Base64::urlEncode(json_encode($this->data));
    }

    public function toArray()
    {
        return $this->data;
    }
}
