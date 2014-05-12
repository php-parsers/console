<?php namespace Parser\Console;

class Parser {

    /**
     * Each command gets splitted into chunks.
     *
     * @var array
     */
    protected $chunks = [];

    /**
     * The Transformer instance.
     *
     * @var Transformer
     */
    protected $transformer;

    /**
     * The constructor.
     *
     * @param Transformer|null $transformer
     * @return Parser
     */
    public function __construct(Transformer $transformer = null)
    {
        $this->transformer = $transformer ?: new Transformer;
    }

    /**
     * Parse a console command into an array.
     *
     * @param string $command
     * @return array
     */
    public function parse($command)
    {
        $command = $this->transformer->transform($command);

        $this->splitIntoChunks($command);

        return [
            'name'      => $this->extractName(),
            'arguments' => $this->extractArguments(),
            'options'   => $this->extractOptions()
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
                $quote = ! $quote;
            }

            if ($quote or $character != ' ')
            {
                $buffer .= $character;
            }
            elseif ($buffer !== '')
            {
                $this->chunks[] = $buffer;

                $buffer = '';
            }
        }

        if ($buffer !== '')
        {
            $this->chunks[] = $buffer;
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
        $chunks = array_filter($this->chunks, [$this, 'isArgument']);

        return array_map([$this, 'cleanChunk'], $chunks);
    }

    /**
     * Extract a list of options from the chunks list.
     *
     * @return array
     */
    protected function extractOptions()
    {
        $chunks  = array_filter($this->chunks, [$this, 'isOption']);
        $options = [];

        foreach ($chunks as $chunk)
        {
            list($name, $value) = $this->prepareOption($chunk);

            if (isset ($options[$name]))
            {
                $options[$name]['volume'] += 1;

                continue;
            }

            $options[$name] = $value;
        }

        return $options;
    }

    /**
     * Prepare an option.
     *
     * @param string $option
     * @return array
     */
    protected function prepareOption($option)
    {
        $value  = null;
        $volume = 1;

        $chunks = explode('=', $option);

        if (count($chunks) == 2)
        {
            $value = $chunks[1];
        }

        $name = str_replace('-', '', $chunks[0]);

        return [
            $name, [
                'value'  => ($value ? $this->cleanChunk($value) : null),
                'volume' => 1
            ]
        ];
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

    /**
     * Determine whether the given chunk is a valid option.
     *
     * @param string $chunk
     * @return boolean
     */
    protected function isOption($chunk)
    {
        return strpos($chunk, '-') === 0;
    }

    /**
     * Determine whether the given chunk is a valid argument.
     *
     * @param string $chunk
     * @return boolean
     */
    protected function isArgument($chunk)
    {
        return ! $this->isOption($chunk);
    }

}

