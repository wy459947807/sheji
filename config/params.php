<?php

return [
    'adminEmail' => 'admin@example.com',
    'navIcon' => array(//后台菜单图标
        1 => "&#xe616;",
        2 => "&#xe613;",
        3 => "&#xe620;",
        4 => "&#xe622;",
        5 => "&#xe60d;",
        6 => "&#xe62d;",
        7 => "&#xe61a;",
        8 => "&#xe62e;"),
    'host' => array(
        "localhost" => "http://www.huishi.dev/",
    ),
    "map" => array(
        "url" => "http://api.map.baidu.com/geocoder/v2/",
        "ak" => "jG4ALZ3Pvnhqrd0OKFubUyWg"
    ),
    "apiKey" => "666777",
    /*
      "wechat"=>array(
      'token'=>'weixin', //填写你设定的key
      'encodingaeskey'=>'RhcO2E1a66hOOrx9zGzEqfyMRd9RRCMj0vmXpnxDoEn', //填写加密用的EncodingAESKey
      'appid'=>'wx50724f717813ccbe', //填写高级调用功能的app id
      'appsecret'=>'8487f3029ee406c552be49735b1cb6d8' //填写高级调用功能的密钥
      ), */
    "wechat" => array(
        'token' => 'weixin', //填写你设定的key
        'encodingaeskey' => '', //填写加密用的EncodingAESKey
        'appid' => 'wx331379438369d4e7', //填写高级调用功能的app id
        'appsecret' => '6c5758bf36f5fab392ff045395ceb4e2' //填写高级调用功能的密钥
    ),
    //微信菜单
    "wechatMenu" => array(
        "button" => array(
            array('type' => 'view', 'name' => '测试菜单1', 'url' => 'http://www.baidu.com'),
            array('name' => '测试菜单2', 'sub_button' => array(
                    array('type' => 'view', 'name' => '测试菜单2-1', 'url' => 'http://www.baidu.com'),
                    array('type' => 'view', 'name' => '测试菜单2-1', 'url' => 'http://www.baidu.com'),
                )),
            array('type' => 'click', 'name' => '测试菜单3', 'key' => 'Contactus'),
        ),
    ),
];
