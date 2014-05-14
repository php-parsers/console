<?php namespace Spec\Parser\Console;

use PhpSpec\ObjectBehavior;

class TransformerSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Parser\Console\Transformer');
    }

    function it_transforms_a_command()
    {
        $this->transform('foo --bar "baz" --wow=such -f "amaze"')
             ->shouldBe('foo --bar="baz" --wow=such -f="amaze"');

        $this->transform('foo -vv -abc')
             ->shouldBe('foo -v -v -a -b -c');

        $this->transform('foo -abc10')
             ->shouldBe('foo -a -b -c=10');
    }

}
