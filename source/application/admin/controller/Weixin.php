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
     * 取得个人信息（关注用户的信息，未关注用户取不到，需要利用授权接口才行）
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
     * 取得个人信息（关注用户的信息，未关注用户需要显示授权，已关注用户静默授权即可）
     * http://wx.me/admin/weixin/getuserinfo
     */
    public function oauth(){
        $code = input('get.code/s');
        if($code){
            // 1。 引导用户打开这个页面
            // 1.1 静默授权
            // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxc4d225cdc68bab01&redirect_uri=http://wx.ixzy.xyz/admin/weixin/oauth&response_type=code&scope=snsapi_base&state=123456#wechat_redirect
            // 1.2 显示授权
            // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxc4d225cdc68bab01&redirect_uri=http://wx.ixzy.xyz/admin/weixin/oauth&response_type=code&scope=snsapi_userinfo&state=123456#wechat_redirect

            $wx = new wechat\WxOauth();
            $userinfo = $wx->oauth($code);

            $this->view->engine->layout(false);
            $this->assign('info',$userinfo);
            return $this->fetch('oauth');
            // 关注的用户信息
            // {"openid":"o1R_7twuqjK_GR5pVo6Rrn2p_U0o","nickname":"中中","sex":1,"language":"zh_CN","city":"大连","province":"辽宁","country":"中国","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/vi_32\/Q0j4TwGTfTK2B2lS6OYAVW78j8bBfBVydqso3wgy4TEoaxcg3coj5MhdI3yVmqGG3A82mtDfHt3eWZYyS0hf8A\/132","privilege":[]}^M
            // 测试号必须关注才能生效，无法测试不关注的情况，正式服务号应该没有此问题
        } else {
            echo "nocode ,调用方式错误";
        }

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
     * 发送模版消息
     */
    public function sendTplMsg(){
        $openid = 'o1R_7twuqjK_GR5pVo6Rrn2p_U0o';
        $template_id = 'CAXp3cm9RwlWtOhvYIn-WJ67xpD_Qh5Nv3ik7_6Zxko';
        $wx = new wechat\WxTplMsg();
        $param = [
            'touser' => $openid,
            'template_id' => $template_id,
            "url" => 'http://www.baidu.com',
            'data' => [
                'first' => '张三',
                'keyword1' => '新浪俱乐部',
                'keyword2' => '中关村海龙大礼堂',
                ]
        ];
        $result = $wx->sendTemplateMessage($param);
        var_dump($result);
    }



    /**
     * 分享
     * http://wx.me/index.php?s=/admin/weixin/share
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
