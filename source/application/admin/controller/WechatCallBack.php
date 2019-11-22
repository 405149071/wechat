<?php

namespace app\admin\controller;

use app\common\library\wechat;
/**
 * 微信回调地址的回复消息
 * Class Index
 * @package app\admin\controller
 */
class WechatCallBack extends \think\Controller
{

    public function callback(){

        $wx = new wechat\WxSdk(
            config('wechat.appid'),
            config('wechat.secret'),
            config('wechat.token')
        );

        if (isset($_GET['echostr'])) {
            $wx->valid();
        }else{
            $wx->responseMsg();
        }
    }

}
