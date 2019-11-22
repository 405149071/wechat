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
     */
    public function createMenu(){
        $wx = new wechat\WxMenu();
        $menu = $wx->createMenu();
        var_dump($menu);
        //'{"errcode":0,"errmsg":"ok"}'
    }

    /**
     * 取得个人信息
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
     */
    public function createQR(){
        $sceneid = '123';
        $wx = new wechat\WxScene();
        $scene = $wx->createQR($sceneid);
        var_dump($scene);
        // https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGj8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAycXBBZmQ0bHZiWFQxMDAwMGcwM1EAAgRV4dddAwQAAAAA
        // 关注后处理在callback中
    }

}
