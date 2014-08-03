<?php

namespace Asapo\Bundle\TidyBundle\Wrapper;

interface TidyWrapperInterface
{
    /**
     * clean up html string
     * @param string $html dirty html
     * @return string
     */
    public function cleanUp($html);

    /**
     * returns parsed error buffer
     * @return string[]
     */
    public function getErrorBuffer();

    /**
     * returns data of tidy object
     * @return array
     */
    public function getData();

    /**
     * returns encoding
     * @return string
     */
    public function getEncoding();

    /**
     * returns options of tidy objects
     * @return array
     */
    public function getOptions();
}
