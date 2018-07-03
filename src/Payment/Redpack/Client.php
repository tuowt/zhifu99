<?php

/*
 * This file is part of the tuowt/Zhifu99\.
 *

 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhifu99\Payment\Redpack;

use Zhifu99\Kernel\Support;
use Zhifu99\Payment\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author tianyong90 <412039588@qq.com>
 */
class Client extends BaseClient
{
    /**
     * Query redpack.
     *
     * @param mixed $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Zhifu99\Kernel\Support\Collection|array|object|string
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidConfigException
     */
    public function info($mchBillno)
    {
        $params = is_array($mchBillno) ? $mchBillno : ['mch_billno' => $mchBillno];
        $base = [
            'appid' => $this->app['config']->app_id,
            'bill_type' => 'MCHT',
        ];

        return $this->safeRequest('mmpaymkttransfers/gethbinfo', array_merge($base, $params));
    }

    /**
     * Send normal redpack.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Zhifu99\Kernel\Support\Collection|array|object|string
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidConfigException
     */
    public function sendNormal(array $params)
    {
        $base = [
            'total_num' => 1,
            'client_ip' => $params['client_ip'] ?? Support\get_server_ip(),
            'wxappid' => $this->app['config']->app_id,
        ];

        return $this->safeRequest('mmpaymkttransfers/sendredpack', array_merge($base, $params));
    }

    /**
     * Send group redpack.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Zhifu99\Kernel\Support\Collection|array|object|string
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidConfigException
     */
    public function sendGroup(array $params)
    {
        $base = [
            'amt_type' => 'ALL_RAND',
            'wxappid' => $this->app['config']->app_id,
        ];

        return $this->safeRequest('mmpaymkttransfers/sendgroupredpack', array_merge($base, $params));
    }
}
