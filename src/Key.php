<?php

namespace Basic\Jwt;

use DomainException;

class Key
{
    /**
     * Signature key
     *
     * @var string|resource|OpenSSLAsymmetricKey
     */
    private $key;

    /**
     * TRUE if signature key is a private key
     *
     * @var boolean
     */
    private bool $isAsymmetric;

    public function __construct($key)
    {
        $this->setIsAsymmetric($key);
        $this->setKey($key);
    }

    public function get()
    {
        return $this->key;
    }

    public function isAsymmetric()
    {
        return $this->isAsymmetric;
    }

    public function isSymmetric()
    {
        return !$this->isAsymmetric;
    }

    private function setIsAsymmetric($key)
    {
        $this->isAsymmetric = false;

        if (is_string($key)) {
            $this->isAsymmetric = strpos($key, 'BEGIN RSA PRIVATE KEY') !== false;
            return;
        }

        $this->isAsymmetric = true;
    }

    private function setKey($key)
    {
        $this->key = $key;
        if ($this->isAsymmetric) {
            $this->key = openssl_pkey_get_private($this->key);

            if ($this->key === false) {
                throw new DomainException("Invalid private key");
            }
        }
    }
}
