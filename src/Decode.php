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
     * @var Key
     */
    private Key $key;

    /**
     * Jwt to decode
     *
     * @var string
     */
    private string $jwt;

    /**
     * JWT header
     *
     * @var string
     */
    private string $header;

    /**
     * JWT payload
     *
     * @var string
     */
    private string $payload;

    /**
     * JWT signature
     *
     * @var string
     */
    private string $providedSignature;

    public function __construct(string $jwt, Algorithm $algorithm, Key $key)
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
        $signature = (new Signature($this->algorithm, $this->key))->instance();

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
