<?php

namespace DustinLeblanc\Zotero;

use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request extends GuzzleRequest
{

    public function __construct($method, $uri, array $headers = [], $body, $apiKey)
    {
        parent::__construct(
          $method,
          $uri,
          array_merge(
            [
              'Authorization' => "Bearer " . $apiKey,
              'Zotero-API-Version' => 3
            ],
            $headers
          ),
          $body,
          "2.0"
        );
    }

    /**
     * Append "/items" to the uri path.
     *
     * @return $this|\GuzzleHttp\Psr7\Request|static
     */
    public function items() : Request
    {
        $uri = $this->getUri();
        $uri = $uri->withPath($uri->getPath() . "/items");

        return $this->withUri($uri);
    }
}
