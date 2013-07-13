<?php

namespace spec\Gear\Routing\Parser;

use PhpSpec\ObjectBehavior;

class YamlParserSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\Routing\Parser\YamlParser');
    }

    function it_should_be_a_valid_routing_parser()
    {
        $this->shouldHaveType('Gear\Routing\Parser\ParserInterface');
    }
}
