<?php

namespace app\common\library\wechat;


use think\Cache;
use app\common\exception\BaseException;

/**
 * 微信jsSDK
 * Class wechat
 * @package app\library
 */
class WxJsSdk extends WxBase
{
    //验证签名
    public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "jsapiTicket" =>$jsapiTicket,
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket()
    {
        $cacheKey = $this->appId . '@JsApiTicket';
//        $this->doLogs('cachkeh1111='.$cacheKey);
        if (!Cache::get($cacheKey)) {
//            $this->doLogs('1111111111');
            $access_token = $this->getAccessToken();
            // 请求API获取 jsapiticket
//            var_dump($access_token);
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$access_token}";
            $data = json_decode($this->get($url), true);
//            var_dump($data);
            if ($data['errcode']) {
                throw new BaseException(['msg' => "jsapiticket获取失败，错误信息：{$data}"]);
            }
            // 记录日志
            log_write([
                'describe' => '获取jstokenticket',
                'appId' => $this->appId,
                'result' => $data
            ]);
            // 写入缓存
            Cache::set($cacheKey, $data['ticket'], 6000);    // 100分钟
        }
        return Cache::get($cacheKey);
    }


}
