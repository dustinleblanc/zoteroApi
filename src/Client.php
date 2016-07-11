<?php

namespace DustinLeblanc\Zotero;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class Client
 * @package DustinLeblanc\Zotero
 */
class Client extends GuzzleClient
{

    /**
     * @var string Zotero API key.
     */
    protected $apiKey;

    /**
     * @var string User or Group Identifier associated with API key.
     */
    protected $identity;

    /**
     * @inheritdoc
     */
    public function __construct(array $config = [])
    {
        $fullConfig = array_merge($config, [
            'base_uri' => 'https://api.zotero.org'
        ]);
        if (isset($fullConfig['apiKey'])) {
            $this->apiKey = $fullConfig['apiKey'];
        } else {
            throw new \InvalidArgumentException();
        }
        parent::__construct($fullConfig);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Client
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Create and send an HTTP request.
     *
     * Use an absolute path to override the base path of the client, or a
     * relative path to append to the base path of the client. The URL can
     * contain the query string as well.
     *
     * @param string $method HTTP method.
     * @param string|UriInterface|null $uri URI object or string (default null).
     * @param array $options Request options to apply.
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function request($method, $uri = null, array $options = [])
    {
        return $this->send(
          new Request(
            $method,
            $uri,
            $options,
            $this->getApiKey()
          )
        );
    }

    /**
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param string $identity
     * @return Client
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }
}
