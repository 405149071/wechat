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

        $menu = new wechat\WxMenu();
        $menu->createMenu();

    }

}
