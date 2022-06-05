<?php

namespace Basic\Jwt;

class Encode
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
     * Time in seconds to expire the token
     *
     * @var integer|null
     */
    private ?int $expiresIn;

    public function __construct(
        Algorithm $algorithm,
        string $key,
        ?int $expiresIn = null
    ) {
        $this->algorithm = $algorithm;
        $this->key = $key;
        $this->expiresIn = $expiresIn;
    }

    public function get(array $payload): array
    {
        $signature = new Signature($this->algorithm, $this->key);
        $header    = new Header($this->algorithm);
        $payload   = new Payload($payload, $this->expiresIn);
        $signature = $signature->sign((string) $header, (string) $payload);

        return [
            "jwt" => (string) $header
                . "."
                . (string) $payload
                . "."
                . (string) $signature,
            "exp" => $payload->exp()
        ];
    }
}
