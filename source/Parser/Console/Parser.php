<?php namespace Parser\Console;

class Parser {

    /**
     * Each command gets splitted into chunks.
     *
     * @var array
     */
    protected $chunks = [];

    /**
     * Parse a console command into an array.
     *
     * @param string $command
     * @return array
     */
    public function parse($command)
    {
        $this->splitIntoChunks($command);

        return [
            'name'      => $this->extractName(),
            'arguments' => $this->extractArguments(),
            'options'   => []
        ];
    }

    /**
     * Split the given string into "chunks".
     *
     * @param string $string
     * @return void
     */
    protected function splitIntoChunks($string)
    {
        $this->chunks = [];

        $quote  = false;
        $buffer = '';

        foreach (str_split($string) as $character)
        {
            if (in_array($character, ['\'', "\""]))
            {
                $qoute = ! $qoute;
            }

            if ($quote or $character != ' ')
            {
                $buffer .= $character;
            }
            else
            {
                $this->chunks[] = $buffer.$character;

                $buffer = '';
            }
        }
    }

    /**
     * Extract a command name from the list of chunks.
     *
     * @return string|null
     */
    protected function extractName()
    {
        return array_shift($this->chunks);
    }

    /**
     * Extract a list of arguments from the chunks list.
     *
     * @return array
     */
    protected function extractArguments()
    {
        return array_map([$this, 'cleanChunk'], $this->chunks);
    }

    /**
     * Clean a chunk.
     *
     * @param string $chunk
     * @return string
     */
    protected function cleanChunk($chunk)
    {
        return str_replace(['\'', "\""], '', $chunk);
    }

}

