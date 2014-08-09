<?php

namespace Asapo\Bundle\TidyBundle\Wrapper;

use Asapo\Bundle\TidyBundle\Factory\TidyFactoryInterface;

/**
 * Wraps tidy instances and provides information for clean up runs
 * @package Asapo\Bundle\TidyBundle\Wrapper
 */
class TidyWrapper implements TidyWrapperInterface
{
    /**
     * instance of tidy
     * @var TidyFactoryInterface
     */
    private $tidyFactory;

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
     * @var TidyData[]
     */
    private $data = array();

    public function __construct($options, $encoding, TidyFactoryInterface $tidyFactory)
    {
        $this->options = $options;
        $this->encoding = $encoding;
        $this->tidyFactory = $tidyFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function cleanUp($html)
    {
        /** @var \tidy $tidy */
        $tidy = $this->tidyFactory->create();

        // repair
        $tidy->parseString($html, $this->options, $this->encoding);
        $tidy->cleanRepair();

        // save data
        $this->data[] = new TidyData($tidy->root()->value, $html, $tidy->errorBuffer);

        return $tidy->root()->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastErrorBuffer()
    {
        if (sizeof($this->data) > 0) {
            return $this->data[sizeof($this->data) - 1]->getErrors();
        } else {
            return null;
        }
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
