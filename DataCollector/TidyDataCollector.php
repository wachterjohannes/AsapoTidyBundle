<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Asapo\Bundle\TidyBundle\DataCollector;

use Asapo\Bundle\TidyBundle\Wrapper\TidyWrapperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/**
 * DataCollector for tidy service
 * @package Asapo\Bundle\TidyBundle\DataCollector
 */
class TidyDataCollector extends DataCollector
{
    /**
     * @var TidyWrapperInterface
     */
    private $tidy;

    function __construct(TidyWrapperInterface $tidy)
    {
        $this->tidy = $tidy;
    }

    /**
     * Errors of tidy
     * @return string[]
     */
    public function getData()
    {
        return $this->data['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['data'] = $this->tidy->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'asapo_tidy';
    }
}
