<?php

namespace app\admin\controller;


/**
 * 微信测试
 * Class Index
 * @package app\admin\controller
 */
class Wechat extends Controller
{
    /**
     * 后台首页
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('index');
    }

}
