<?php

namespace Basic\Jwt;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class Decode
{
    /**
     * Signature algorithm
     *
     * @var Algorithm
     */
    private Algorithm $algorithm;

    /**
     * Signature key
     *
     * @var string
     */
    private string $key;

    /**
     * Jwt to decode
     *
     * @var string
     */
    private string $jwt;

    private string $header;
    private string $payload;
    private string $providedSignature;

    public function __construct(string $jwt, Algorithm $algorithm, string $key)
    {
        $this->jwt = $jwt;
        $this->algorithm = $algorithm;
        $this->key = $key;
        $this->decode();
    }

    public function decode(): void
    {
        $tokenParts = explode('.', $this->jwt);
        $this->header            = Base64::urlDecode($tokenParts[0]);
        $this->payload           = Base64::urlDecode($tokenParts[1]);
        $this->providedSignature = $tokenParts[2];
    }

    public function get(): array
    {
        return [
            "header"    => json_decode($this->header, true),
            "payload"   => json_decode($this->payload, true),
            "signature" => $this->providedSignature,
        ];
    }

    public function isValid(): bool
    {
        $signature = new Signature($this->algorithm, $this->key);

        if ($this->isExpired()) return false;

        return
            $signature->sign(
                Base64::urlEncode($this->header),
                Base64::urlEncode($this->payload)
            ) === $this->providedSignature;
    }

    private function isExpired(): bool
    {
        $payload = json_decode($this->payload);
        return time() > $payload->exp;
    }
}
