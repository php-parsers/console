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
        $chunks = explode(' ', $command);

        return [
            'name' => array_shift($chunks) ?: null,
            'arguments' => $chunks,
            'options' => []
        ];
    }

}

