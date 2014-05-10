<?php namespace Spec\Parser\Console;

use PhpSpec\ObjectBehavior;

class ParserSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Parser\Console\Parser');
    }

}

