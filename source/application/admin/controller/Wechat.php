<?php

namespace app\admin\controller;

use EasyWeChat\Factory;
/**
 * 微信测试
 * Class Index
 * @package app\admin\controller
 */
class Wechat extends Controller
{
    /**
     * 后台首页
     * @return mixed
     */
    public function index()
    {


        $config = [
            'app_id' => 'wxc4d225cdc68bab01',
            'secret' => 'c772e094ab6d7091db037573394920b4',
            'token' => 'X9VfZef6ntpPySDT',
            'response_type' => 'array',
            //...
        ];

        var_dump($config);

        $app = Factory::officialAccount($config);

        var_dump($app);

        $response = $app->server->serve();

        var_dump($response);
// 将响应输出
        $response->send();exit;
    }

}
