<?php

namespace Asapo\Bundle\TidyBundle\Wrapper;

use tidy;

class TidyWrapper implements TidyWrapperInterface
{
    /**
     * instance of tidy
     * @var tidy
     */
    private $tidy;

    /**
     * config array of tidy
     * @var array
     */
    private $options;

    /**
     * encoding to read html
     * @var string
     */
    private $encoding;

    public function __construct($options, $encoding, tidy $tidy)
    {
        $this->options = $options;
        $this->encoding = $encoding;
        $this->tidy = $tidy;
    }

    /**
     * {@inheritdoc}
     */
    public function cleanUp($html)
    {
        $this->tidy->parseString($html, $this->options, $this->encoding);
        $this->tidy->cleanRepair();

        return $this->tidy->root()->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorBuffer()
    {
        // TODO exctract info in own class
        return explode("\n", $this->tidy->errorBuffer);
    }

}
