<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Asapo\Bundle\TidyBundle\Factory;

/**
 * Creates tidy instances
 * @package Asapo\Bundle\TidyBundle\Factory
 */
class TidyFactory implements TidyFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new \tidy();
    }
} 
