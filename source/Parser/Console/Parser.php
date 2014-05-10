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
            'arguments' => $this->chunks,
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
        $this->chunks = array_filter(explode(' ', $string));
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

}

