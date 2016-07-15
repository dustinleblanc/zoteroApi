<?php

namespace spec\DustinLeblanc\Zotero;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('get', 'foo', [], 'bar', 'apiKey');
    }
    function it_passes_key_in_authorization_header()
    {
        $this->getHeaderLine('Authorization')->shouldReturn('Bearer apiKey');
    }

    function it_uses_version_3_of_the_api()
    {
        $this->getHeaderLine('Zotero-API-Version')->shouldReturn("3");
    }

    function it_appends_items_to_the_uri()
    {
        $this->beConstructedWith('get', 'users/123', [], '', 'apiKey');
        $this->items()->getUri()->getPath()->shouldReturn('users/123/items');
    }
}
