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

        $this->parse('foo bar baz')->shouldBe($this->merge([
            'name'      => 'foo',
            'arguments' => ['bar', 'baz']
        ]));

        $this->parse('  foo    bar  baz  ')->shouldBe($this->merge([
            'name'      => 'foo',
            'arguments' => ['bar', 'baz']
        ]));

        $this->parse('foo bar "baz" \'wow\'')->shouldBe($this->merge([
            'name'      => 'foo',
            'arguments' => ['bar', 'baz', 'wow']
        ]));

        $this->parse('foo "bar baz" \'wow such\'')->shouldBe($this->merge([
            'name'      => 'foo',
            'arguments' => ['bar baz', 'wow such']
        ]));

        $this->parse('foo --bar "baz" --wow=such')->shouldBe($this->merge([
            'name'    => 'foo',
            'options' => [
                'bar' => [
                    'value'  => 'baz',
                    'volume' => 1
                ],
                'wow' => [
                    'value'  => 'such',
                    'volume' => 1
                ]
            ]
        ]));

        $this->parse('foo --bar -f -ab10')->shouldBe($this->merge([
            'name'    => 'foo',
            'options' => [
                'bar' => [
                    'value'  => null,
                    'volume' => 1
                ],
                'f'   => [
                    'value'  => null,
                    'volume' => 1
                ],
                'a'   => [
                    'value'  => null,
                    'volume' => 1
                ],
                'b'   => [
                    'value'  => '10',
                    'volume' => 1
                ]
            ]
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

