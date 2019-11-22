<?php

namespace app\common\library\wechat;

/**
 * 微信菜单类
 * Class WxUser
 * @package app\common\library\wechat
 */
class WxMenu extends WxBase
{

    public function createMenu()
    {
        $access_token = $this->getAccessToken();
//        $this->doLogs("access_token=".$access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $menuJson = ' {
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲11",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索11",
               "url":"http://www.soso.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们11",
               "key":"V1001_GOOD"
            }]
       }]
 }
';
        $result = $this->post($url, $menuJson);
        return $result;

    }

}