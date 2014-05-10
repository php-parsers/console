<?php namespace Parser\Console;

class Transformer {

    /**
     * Transform a command so it can be parsed.
     *
     * @param string $command
     * @return string
     */
    public function transform($command)
    {
        return preg_replace('/\-([\-a-z]+)\s([^\s]+)/i', '-$1=$2', $command);
    }

}

