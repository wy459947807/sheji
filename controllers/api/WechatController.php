<?php

//导航管理

namespace app\controllers\api;

use Yii;
use app\common\InstanceFactory;
use app\controllers\CommonInterface;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class WechatController extends CommonController implements CommonInterface {
    
    public function init() { 
        parent::init();
        //注册服务
        //$this->registService("UserService");//注册用户服务
        //注册对象
        $this->registObj("Wechat", Yii::$app->params['wechat']); //注册微信对象
    }

    //微信自动回复
    public function actionIndex() {
        $wechat = $this->getObj("Wechat");
        //$this->getObj("Wechat")->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
        $type = $wechat->getRev()->getRevType();
        switch ($type) {
            case $wechat::MSGTYPE_TEXT:
                //$word=$wechat->getRevContent();//获取接收文字
                $wechat->text("hello, I'm wechat")->reply();
                exit;
                break;
            case $wechat::MSGTYPE_EVENT:
                break;
            case $wechat::MSGTYPE_IMAGE:
                break;
            default:
                $wechat->text("help info")->reply();
        }
    }

    //设置菜单
    public function actionCreatemenu() {
        $newmenu =  Yii::$app->params['wechatMenu'];
        $result = $this->getObj("Wechat")->createMenu($newmenu);
        var_dump($result);
    }

    //获取JS配置信息
    public function actionJsbaseinfo() {
        $wechatConfig = Yii::$app->params['wechat'];
        $resultArray = array(
            "result" => 0,
            "msg" => "get js base info success",
            "jsinfo" => array(
                "appid" => $wechatConfig['appid'],
                "domain" => YII::$app->request->getHostName(),
            ),
        );
        return $this->asJson($resultArray);
    }

    //获取微信认证连接
    public function actionGetoauthurl() {
        // $callback='http://'.getenv('SERVER_PUB_DOMAIN').'/wechatshangjia/Index/bind';
        // $callback='http://'.getenv('SERVER_PUB_DOMAIN').'/wechatshangjia/Index/ktvmanage';
        $callback = YII::$app->request->getHostInfo() . '/api/wechat/getopenid';
        $state = 'OK';
        $scope = 'snsapi_base';
        $res = $this->getObj("Wechat")->getOauthRedirect($callback, $state, $scope);
        var_dump($res);
    }

    //微信用户认证回调页面
    public function actionGetopenid() {
        if (Yii::$app->request->isGet) {
            $token = $this->getObj("Wechat")->getOauthAccessToken();
            //var_dump($token);
            if ($token == false) {
                return $this->asJson(array('msg' => 'get openid failed', 'result' => '400'));
            } else {
                $openid = $token['openid'];
                $userinfo = $this->getObj("Wechat")->getUserInfo($openid);
                //var_dump($userinfo);die();
                //echo json_encode($userinfo);die();
                $openid_info = array(
                    'msg' => 'get openid success',
                    'result' => 0,
                    'openid' => $openid,
                    'display_name' => isset($userinfo['nickname']) ? $userinfo['nickname'] : '',
                    'avatar_url' => isset($userinfo['headimgurl']) ? $userinfo['headimgurl'] : '',
                    'sex' => isset($userinfo['sex']) ? $userinfo['sex'] : '',
                );

                return $this->asJson($openid_info);
            }
        }
    }
    
    //微信用户认证回调页面
    public function actionDynamicoauth() {
        $params=$this->getParams();
        $this->redirect($params['wechat']."?code=".$params['code']);
    }
    
    public function actionGetsign() {
            $resultArray = array();
            $params=$this->getParams();
            if (!Yii::$app->request->isGet && !Yii::$app->request->isAjax) {
                $resultArray['status'] = 0;
                $resultArray['msg'] = '方法错误';
                return $this->asJson($resultArray);
            }
           
            $url = $params['url'];
            $sign = $this->getObj("Wechat")->getJsSign(htmlspecialchars_decode($url), 0, '',Yii::$app->params['wechat']['appid']);
            $resultArray['status'] = 1;
            $resultArray['msg'] = '成功';
            $resultArray['sign'] = $sign;
            return $this->asJson($resultArray);
    }

    //微信用户登录
    public function actionOauthlogin() {
        /*
          OpenLoginRequest {
          avatar_url (string, optional):

          用户头像的URL stringDefault:http://wx.qlogo.cn/mmopen/JQpUg1oh5adIwByjCjRaibQku0dXIOAWt6dBbUibDV3QrHNFQzwZ5GTQoKbsHoHD3Zq35ibNCxlsG3s3IwUbuOhHw/0,
          cid (string, optional):

          getui notify client ID ,
          display_name (string, optional):

          用户的昵称 stringDefault:Lincoln,
          openid (string, optional):

          微信用户的OPENID或者授权的用户名字 stringDefault:okwyOwpvP0WJfi0GhGxzQ5sDJMCY,
          type (string, optional):

          Oauth authorize type, eg 1 – Wechat, 2 - SINA, 3 - QQ , .. stringDefault:wehcat
          } */
        //header('Access-Control-Allow-Origin:*');
        if (Yii::$app->request->isPost) {
            $resultArray=array("result" => 0,
                    "msg" => "用户登录成功",
                    "token" =>"aaeeffe",
                    "display_name" => "aaa",);
            $params=$this->getParams();
            $userInfo = $this->getObj("Wechat")->getUserInfo($params['openid']);
            if(!empty($userInfo)){
                $resultArray = array(
                    "result" => 0,
                    "msg" => "用户登录成功",
                    "token" => "dddffffee",
                    "display_name" => "aaa",
                );
            }
            return $this->asJson($resultArray);
        }
    }
    
    
    

    
   
    
    
    public function actionTest(){
      
        echo json_encode($_POST);
    }
    //获取参数规则
    public function getRulesArray($ruleIndex) {
        $result['add'] = array(
            array('status', 'in', 'range' => array(1, 2), 'message' => '状态码错误.'),
        );

        return $result[$ruleIndex];
    }

}
