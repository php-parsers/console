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
        $command = $this->replaceWhiteSpaces($command);

        return $command;
    }

    /**
     * Replace white space between a key-value pair with the equal sign.
     *
     * @param string $string
     * @return string
     */
    protected function replaceWhiteSpaces($string)
    {
        return preg_replace('/\-([\-a-z]+)\s([^\s]+)/i', '-$1=$2', $string);
    }

}

