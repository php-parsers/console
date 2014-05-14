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
        return $this->replaceWhiteSpaces(
            $this->openCollapsedOptions($command)
        );
    }

    /**
     * Convert collapsed options to normal ones.
     *
     * @param string $string
     * @return string
     */
    protected function openCollapsedOptions($string)
    {
        $callback = function(array $matches)
        {
            $collapsed = end($matches);
            $result = '';

            foreach (str_split($collapsed) as $option)
            {
                $result .= " -$option";
            }

            return $result;
        };

        $string = preg_replace_callback('/\s\-([a-z]{2,})/i', $callback, $string);

        return preg_replace('/\-([a-z]{1})([^\sa-z]+)/i', '-$1=$2', $string);
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
                return "-$key $value";
            }

            return "-$key=$value";
        };

        return preg_replace_callback(
            '/\-([\-a-z]+)\s([^\s]+)/i', $callback, $string
        );
    }

}
