<?php

namespace app\common\library\wechat;

/**
 * 微信用户管理类
 * Class WxUser
 * @package app\common\library\wechat
 */
class WxUser extends WxBase
{

    public function getUserInfo($openid)
    {
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $result = $this->get($url);
        return $result;
    }

}