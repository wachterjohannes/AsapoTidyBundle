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
 * Interface for tidy factory
 * @package Asapo\Bundle\TidyBundle\Factory
 */
interface TidyFactoryInterface
{
    /**
     * Returns new tidy instance
     * @return \tidy
     */
    public function create();
} 
