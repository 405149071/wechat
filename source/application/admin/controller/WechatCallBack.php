<?php

namespace app\admin\controller;

use app\common\library\wechat;
/**
 * 微信测试
 * Class Index
 * @package app\admin\controller
 */
class WechatCallBack extends \think\Controller
{
    private $config = [
        'app_id' => 'wxc4d225cdc68bab01',
        'secret' => 'c772e094ab6d7091db037573394920b4',
        'token' => 'X9VfZef6ntpPySDT',
        'response_type' => 'array',
        //...
    ];

    public function callback(){
        $wx = new wechat\WxSdk(
            $this->config['app_id'],
            $this->config['secret'],
            $this->config['token']);

        if (isset($_GET['echostr'])) {
            $wx->valid();
        }else{
            $wx->responseMsg();
        }
    }

}
