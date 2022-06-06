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
     * @var Key
     */
    private Key $key;

    /**
     * Time in seconds to expire the token
     *
     * @var integer
     */
    private int $expiresIn;

    public function __construct(
        Algorithm $algorithm,
        Key $key,
        int $expiresIn
    ) {
        $this->algorithm = $algorithm;
        $this->key = $key;
        $this->expiresIn = $expiresIn;
    }

    /**
     * Create a JWT
     *
     * @param array $payload
     * @return array
     */
    public function get(array $payload): array
    {
        $header    = new Header($this->algorithm, $this->key);
        $payload   = new Payload($payload, $this->expiresIn);
        $signature = (new Signature($this->algorithm, $this->key))->instance();

        return [
            "jwt" => $header
                . "."
                .  $payload
                . "."
                . $signature->sign($header, $payload),
            "exp" => $payload->exp()
        ];
    }
}
