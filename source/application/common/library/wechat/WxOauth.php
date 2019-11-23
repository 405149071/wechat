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
//        $this->doLogs('result=' . $result);
        // {"access_token":"27_2XrIMFKKaMuCAauFpk5UNZ-qH_xxMN2wSZP78fBrc0p7UFoAW15-znBwGDN_72ayEFILWnba3u-Oyh4aQsmlHMUFvb2-jA_J_-PFMhrx8rk","expires_in":7200,"refresh_token":"
        // 27_jBlhBCgaWjIYQD5QTZ1wpdhL2BYLx246Wtjsmdy9HBY9THiVgWhDt7IGRBBn8NSbK_87TNh9tX60rVzYmsLWfm4TjDoa2MJ9d7FhdV_zBXc","openid":"o1R_7twuqjK_GR5pVo6Rrn2p_U0o","scope":"snsapi_base"}^M
        $data = json_decode($result, true);
        // 网页授权acess_token (不同于全局的基础access——token,即wxbase里的）
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        // 开始取用户信息
        $infoUrl = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        $userInfo = $this->get($infoUrl);
//        $this->doLogs('userinfo=' . $userInfo);
        return $userInfo;
    }

}