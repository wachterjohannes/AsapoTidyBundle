<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Asapo\Bundle\TidyBundle\Wrapper;

/**
 * Data Container for one clean up run
 * @package Asapo\Bundle\TidyBundle\Wrapper
 */
class Container
{
    /**
     * dirty html lines
     * @var string[]
     */
    private $dirty;

    /**
     * clean html lines
     * @var string[]
     */
    private $clean;

    /**
     * errors of clean up
     * @var array
     */
    private $errors;

    function __construct($clean, $dirty, $errors)
    {
        $this->clean = explode("\n", $clean);
        $this->dirty = explode("\n", $dirty);

        $this->errors = array();
        foreach (explode("\n", $errors) as $line) {
            preg_match("/line ([0-9]*) column ([0-9]*) - ([a-zA-z]*): (.*)/", $line, $output);
            $this->errors[] = array(
                'full' => $output[0],
                'line' => $output[1],
                'column' => $output[2],
                'type' => $output[3],
                'message' => $output[4]
            );
        }
    }

    /**
     * @return string[]
     */
    public function getClean()
    {
        return $this->clean;
    }

    /**
     * @return string[]
     */
    public function getDirty()
    {
        return $this->dirty;
    }

    /**
     * Returns dirty line specified by middle line number and length
     * @param $middle
     * @param $length
     * @return array
     */
    public function getDirtyLines($middle, $length)
    {
        $result = array();
        $upper = $middle + round($length / 2);
        $smaller = $middle - round($length / 2)-1;
        for ($i = $smaller; $i < $upper; $i++) {
            $result[$i] = $this->dirty[$i];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}
