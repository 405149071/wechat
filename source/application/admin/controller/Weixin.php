<?php

namespace app\admin\controller;

use app\common\library\wechat;
/**
 * 微信测试
 * Class Index
 * @package app\admin\controller
 */
class Weixin extends \think\Controller
{
    /**
     * 后台首页
     * @return mixed
     */
    public function valid()
    {

        $config = [
            'app_id' => 'wxc4d225cdc68bab01',
            'secret' => 'c772e094ab6d7091db037573394920b4',
            'token' => 'X9VfZef6ntpPySDT',
            'response_type' => 'array',
            //...
        ];

        $wx = new wechat\WxBase($config['app_id'],$config['secret'],$config['token']);

        $wx->valid();

    }

}
