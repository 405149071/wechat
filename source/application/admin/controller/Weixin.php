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
    }

    /**
     * 取得个人信息
     */
    public function getUserInfo(){
        $openid = 'o1R_7twuqjK_GR5pVo6Rrn2p_U0o';
        $wx = new wechat\WxUser();
        $user = $wx->getUserInfo($openid);
        var_dump($user);
    }

}
