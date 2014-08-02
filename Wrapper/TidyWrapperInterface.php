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
}
