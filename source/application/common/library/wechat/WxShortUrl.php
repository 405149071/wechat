<?php

namespace app\common\library\wechat;

/**
 * 短链接类
 * Class WxShortUrl
 * @package app\common\library\wechat
 */
class WxShortUrl extends WxBase
{
    /**
     *
     * 短链接类
     */
    public function long2short($longurl)
    {
        $access_token = $this->getAccessToken();
        $data = '{"action":"long2short","long_url":"'.$longurl.'"}';
        $url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=".$access_token;
        $result = $this->post($url,$data);
        return $result;
    }

}