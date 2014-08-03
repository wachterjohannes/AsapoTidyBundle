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

    /**
     * each cleanUp call create an entry
     * @var array
     */
    private $data = array();

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
        // reset tidy
        $this->tidy->errorBuffer = null;

        // repair
        $this->tidy->parseString($html, $this->options, $this->encoding);
        $this->tidy->cleanRepair();

        // save data
        $this->data[] = new Container($this->tidy->root()->value, $html, $this->getErrorBuffer());

        return $this->tidy->root()->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorBuffer()
    {
        return $this->tidy->errorBuffer;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }
}
