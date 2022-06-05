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

    public function __toString()
    {
        return Base64::urlEncode(json_encode($this->data));
    }

    public function toArray()
    {
        return $this->data;
    }

    public function exp()
    {
        return $this->exp;
    }
}
