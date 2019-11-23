<?php

namespace app\common\library\wechat;

/**
 * 网页授权管理类
 * Class WxScene
 * @package app\common\library\wechat
 */
class WxOauth extends WxBase
{
    /**
     *
     * 永久二维码
     */
    public function oauth($code)
    {
        // 根据code换取网页授权access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appId}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code";
        $result = $this->get($url);
        $this->doLogs('result=' . $result);
//        array (size=2)
//              'ticket' => string 'gQGj8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAycXBBZmQ0bHZiWFQxMDAwMGcwM1EAAgRV4dddAwQAAAAA' (length=96)
//              'url' => string 'http://weixin.qq.com/q/02qpAfd4lvbXT10000g03Q'
        $data = json_decode($result, true);
        return true;
    }

}