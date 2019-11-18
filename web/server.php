<?php
/**
 *
 * Created by xiaoxinyi_wechat.
 * User: wuzz
 * Date: 2019/11/18
 * Time: 11:01 PM
 */


use EasyWeChat\Factory;

$config = [
    'app_id' => 'wxc4d225cdc68bab01',
    'secret' => 'c772e094ab6d7091db037573394920b4',
    'token' => 'X9VfZef6ntpPySDT',
    'response_type' => 'array',
    //...
];

var_dump($config);

$app = Factory::officialAccount($config);

var_dump($app);

$response = $app->server->serve();

var_dump($response);
// 将响应输出
$response->send();exit;