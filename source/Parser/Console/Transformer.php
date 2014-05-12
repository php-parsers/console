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
        $callback = function(array $matches)
        {
            array_shift($matches);

            list($key, $value) = $matches;

            if (strpos($value, '-') === 0)
            {
                return "$key $value";
            }


            return "-$key=$value";
        };

        return preg_replace_callback(
            '/\-([\-a-z]+)\s([^\s]+)/i', $callback, $string
        );
    }

}

