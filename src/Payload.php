<?php

namespace Basic\Jwt;

class Payload
{
    private array $data;
    private int $exp;

    public function __construct(array $data, int $exp)
    {
        $iat = time();
        $this->exp = $iat + $exp;
        $this->data = array_merge([
            'iat' => $iat,
            'exp' => $this->exp
        ], $data);
    }

    public function __toString(): string
    {
        return Base64::urlEncode(json_encode($this->data));
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function exp(): int
    {
        return $this->exp;
    }
}
