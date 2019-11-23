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
     * 创建菜单
     * http://wx.me/admin/weixin/createmenu
     */
    public function createMenu(){
        $wx = new wechat\WxMenu();
        $menu = $wx->createMenu();
        var_dump($menu);
        //'{"errcode":0,"errmsg":"ok"}'
    }

    /**
     * 取得个人信息
     * http://wx.me/admin/weixin/getuserinfo
     */
    public function getUserInfo(){
        $openid = 'o1R_7twuqjK_GR5pVo6Rrn2p_U0o';
        $wx = new wechat\WxUser();
        $user = $wx->getUserInfo($openid);
        var_dump($user);
        // {"subscribe":1,"openid":"o1R_7twuqjK_GR5pVo6Rrn2p_U0o","nickname":"中中","sex":1,"language":"zh_CN","city":"大连","province":"辽宁","country":"中国","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/6YibWqA7MSCg90rMWaJTSvpn3rqUib8Y9YxpbWLyLftk8icYyJbPrgIFrL2ublaM45N1ia2BK5YKnibDkqmqGg7mGaUVjdu6R5HJic\/132","subscribe_time":1574396535,"remark":"","groupid":0,"tagid_list":[],"subscribe_scene":"ADD_SCENE_QR_CODE","qr_scene":0,"qr_scene_str":""}
    }

    /**
     * 创建永久场景二维码
     * http://wx.me/admin/weixin/createqr
     */
    public function createQR(){
        $sceneid = '123';
        $wx = new wechat\WxScene();
        $scene = $wx->createQR($sceneid);
        var_dump($scene);
        // https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGj8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAycXBBZmQ0bHZiWFQxMDAwMGcwM1EAAgRV4dddAwQAAAAA
        // 关注后处理在callback中
    }

    /**
     * 长链接转短链接
     * http://wx.me/admin/weixin/long2short
     */
    public function long2short(){
        $longurl = 'http://wap.koudaitong.com/v2/showcase/goods?alias=128wi9shh&spm=h56083&redirect_count=1';
        $wx = new wechat\WxShortUrl();
        $shorturl = $wx->long2short($longurl);
        var_dump($shorturl);
        // '{"errcode":0,"errmsg":"ok","short_url":"https:\/\/w.url.cn\/s\/AmJVFId"}'
    }

    /**
     * 分享
     */
    public function share(){
        $wx = new wechat\WxJsSdk();
        $data = $wx->getSignPackage();
//        var_dump($data);
        $this->assign('sign',$data);
//        var_dump('bbbbb');

        $this->view->engine->layout(false);
        return $this->fetch('share');
    }

}
