<?php namespace Spec\Parser\Console;

use PhpSpec\ObjectBehavior;

class ParserSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Parser\Console\Parser');
    }

    function it_parses_a_console_command_into_an_array()
    {
        $this->parse('')->shouldBe($this->merge());

        $this->parse('foo')->shouldBe($this->merge([
            'name' => 'foo'
        ]));
    }

    protected function merge(array $data = [])
    {
        $structure = [
            'name' => null,
            'arguments' => [],
            'options' => []
        ];

        return array_merge($structure, $data);
    }

}

