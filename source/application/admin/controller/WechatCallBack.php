<?php

namespace app\admin\controller;

use app\common\library\wechat;
/**
 * 微信测试
 * Class Index
 * @package app\admin\controller
 */
class WechatCallBack extends \think\Controller
{
    private $config = [
        'app_id' => 'wxc4d225cdc68bab01',
        'secret' => 'c772e094ab6d7091db037573394920b4',
        'token' => 'X9VfZef6ntpPySDT',
        'response_type' => 'array',
        //...
    ];

    public function callback(){
        $wx = new wechat\WxSdk(
            $this->config['app_id'],
            $this->config['secret'],
            $this->config['token']);

        if (isset($_GET['echostr'])) {
            $wx->valid();
        }else{
            $wx->responseMsg();
        }
    }
    /**
     * 验证签名
     * @return mixed
     */
    public function valid()
    {
        $wx = new wechat\WxSdk(
            $this->config['app_id'],
            $this->config['secret'],
            $this->config['token']);
        $wx->valid();
    }

    // 响应文本消息
    public function responseMsg()
    {
//        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents("php://input");

        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if($keyword == "?" || $keyword == "？")
            {
                $msgType = "text";
                $contentStr = date("Y-m-d H:i:s",time());
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                //file_put_contents("log.txt",date('Y-m-d H:i:s').var_export($resultStr,true). "\n",FILE_APPEND);
                echo $resultStr;
            }
        }else{
            echo "";
            exit;
        }
    }




}
