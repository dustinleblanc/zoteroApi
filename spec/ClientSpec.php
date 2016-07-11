<?php

namespace spec\DustinLeblanc\Zotero;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    protected $apiKey;

    /**
     * ClientSpec constructor.
     */
    public function __construct()
    {
        $this->apiKey = getenv('API_KEY') ?: 'apikey';
    }

    public function let()
    {
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

    

    function it_fetches_all_items_in_library()
    {

    }
}
