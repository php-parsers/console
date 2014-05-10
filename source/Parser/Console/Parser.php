<?php namespace Parser\Console;

class Parser {

    /**
     * Parse a console command into an array.
     *
     * @param string $command
     * @return array
     */
    public function parse($command)
    {
        return [
            'name' => null,
            'arguments' => [],
            'options' => []
        ];
    }

}

