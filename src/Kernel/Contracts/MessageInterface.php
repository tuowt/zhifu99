<?php

/*
 * This file is part of the tuowt/Zhifu99\.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhifu99\Kernel\Contracts;

/**
 * Interface MessageInterface.
 */
interface MessageInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return mixed
     */
    public function transformForJsonRequest();

    /**
     * @return string
     */
    public function transformToXml();
}
