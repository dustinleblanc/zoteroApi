<?php

namespace DustinLeblanc\Zotero;

class Client
{
    protected $apiKey;

    public function __construct($apiKey = null)
    {
        if ($apiKey) {
            $this->apiKey = $apiKey;
        } else {
            throw new \InvalidArgumentException;
        }

    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function request($method = '', $uri = '')
    {
        return new Request(
          $method,
          $uri,
          ['authorization' => $this->getApiKey()]
        );
    }
}
