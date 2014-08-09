<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Asapo\Bundle\TidyBundle\Listener;

use Symfony\Component\HttpFoundation\Response;

/**
 * Indicates a response that should be cleaned up before sending
 * @package Asapo\Bundle\TidyBundle\Listener
 */
class TidyResponse extends Response
{
    /**
     * alias of clean up
     * @var string
     */
    private $alias;

    /**
     * {@inheritdoc}
     */
    public function __construct($alias, $content = '', $status = 200, $headers = array())
    {
        parent::__construct($content, $status, $headers);

        $this->alias = $alias;
    }

    /**
     * Returns alias
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

} 
