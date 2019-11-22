<?php

namespace app\common\library\wechat;

/**
 * 场景二维码管理类
 * Class WxUser
 * @package app\common\library\wechat
 */
class WxScene extends WxBase
{
    /**
     *
     * 永久二维码
     */
    public function createQR($scene)
    {
        $access_token = $this->getAccessToken();
        $data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}';
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $result = $this->post($url,$data);
//        array (size=2)
//              'ticket' => string 'gQGj8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAycXBBZmQ0bHZiWFQxMDAwMGcwM1EAAgRV4dddAwQAAAAA' (length=96)
//              'url' => string 'http://weixin.qq.com/q/02qpAfd4lvbXT10000g03Q'
        $data = json_decode($result, true);
//        return $data;
        $imgurl = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$data['ticket'];
//        https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGj8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAycXBBZmQ0bHZiWFQxMDAwMGcwM1EAAgRV4dddAwQAAAAA
        return $imgurl;
    }

}