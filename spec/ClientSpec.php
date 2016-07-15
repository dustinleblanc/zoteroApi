<?php

namespace spec\DustinLeblanc\Zotero;

use Dotenv\Dotenv;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use VCR\VCR;

class ClientSpec extends ObjectBehavior
{
    protected $apiKey;
    protected $userId;

    /**
     * ClientSpec constructor.
     */
    public function __construct()
    {
        $dotenv = new Dotenv(__DIR__ . "/../");
        $dotenv->load();
        $this->apiKey = getenv('API_KEY') ?: 'apikey';
        $this->userId = getenv('USER_ID') ?: 'userId';
    }

    public function let()
    {
        VCR::configure()->setCassettePath('spec/fixtures');
        VCR::turnOn();
        VCR::insertCassette('ZoteroV3ApiClient');

        $this->beConstructedWith(['apiKey' => $this->apiKey]);
    }

    function it_accepts_an_api_key()
    {
        $this->getApiKey()->shouldReturn($this->apiKey);
    }

    function it_must_have_an_api_key()
    {
        $this->shouldThrow('InvalidArgumentException')->during('__construct', [['foo' => 'bar']]);
    }

    function it_composes_library_requests()
    {
        $this->library('users', $this->userId)
             ->items()
             ->getUri()
             ->getPath()
             ->shouldReturn("users/$this->userId/items");
    }

    function it_retrieves_all_items_in_library()
    {
        $this->library('users', $this->userId)->send()->shouldReturn()
    }
}
