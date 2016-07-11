<?php

namespace DustinLeblanc\Zotero;

use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request extends GuzzleRequest
{
    protected $format = 'json';

    public function __construct($method, $uri, array $headers = [], $body, $apiKey)
    {
        parent::__construct(
          $method,
          $uri,
          array_merge(
            [
              'authorization' => $apiKey,
              'Zotero-API-Version' => 3
            ],
            $headers
          ),
          $body,
          "2.0"
        );
    }

    /**
     * @param string $format
     * @return Request
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
}
