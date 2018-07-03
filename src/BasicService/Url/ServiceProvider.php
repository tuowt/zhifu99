<?php

/*
 * This file is part of the tuowt/Zhifu99\.
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhifu99\BasicService\Url;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['url'] = function ($app) {
            return new Client($app);
        };
    }
}