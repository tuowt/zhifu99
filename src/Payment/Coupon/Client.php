<?php

/*
 * This file is part of the tuowt/Zhifu99\.
 *

 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhifu99\Payment\Coupon;

use Zhifu99\Payment\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author tianyong90 <412039588@qq.com>
 */
class Client extends BaseClient
{
    /**
     * send a cash coupon.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Zhifu99\Kernel\Support\Collection|array|object|string
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidConfigException
     */
    public function send(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;
        $params['openid_count'] = 1;

        return $this->safeRequest('mmpaymkttransfers/send_coupon', $params);
    }

    /**
     * query a coupon stock.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Zhifu99\Kernel\Support\Collection|array|object|string
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidConfigException
     */
    public function stock(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->request('mmpaymkttransfers/query_coupon_stock', $params);
    }

    /**
     * query a info of coupon.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Zhifu99\Kernel\Support\Collection|array|object|string
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidConfigException
     */
    public function info(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->request('mmpaymkttransfers/querycouponsinfo', $params);
    }
}
