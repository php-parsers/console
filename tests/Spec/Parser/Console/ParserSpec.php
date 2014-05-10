<?php namespace Spec\Parser\Console;

use PhpSpec\ObjectBehavior;

class ParserSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Parser\Console\Parser');
    }

    function it_parses_a_console_command_into_an_array()
    {
        $this->parse('')->shouldBe([
            'name' => null,
            'arguments' => [],
            'options' => []
        ]);

        $this->parse('foo')->shouldBe([
            'name' => 'foo',
            'arguments' => [],
            'options' => []
        ]);
    }

}

