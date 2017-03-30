<?php

//导航管理

namespace app\controllers\api;

use Yii;
use app\common\InstanceFactory;
use app\controllers\CommonInterface;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class UserController extends CommonController implements CommonInterface {
    
    public function init() {
        parent::init();
        //注册服务
        //$this->registService("UserService");//注册用户服务
        //注册对象
        $this->registObj("Wechat", Yii::$app->params['wechat']); //注册微信对象
    }

   
    public function actionIndex() {
        return;
    }
    
    public function actionInfo(){
        $resultArray=array(
            "result"=> 0,
            "msg"=> "用户 oL8b5wuyRyzs8vKX9dMlfMkUQ4C0 信息获取成功！",
            "mobile"=> "18739178207",
            "userid"=> "12",
            "display_name"=> "小影",
            "avatar_url"=> "http://wx.qlogo.cn/mmopen/vLWNVXrbnRPwJg8BGBRicXE9bIWB6GNC4HhCibY4vTibm86X9NZygMCtOYwfXREdKa2HPFA9UCYe2pibYy9sNdLJ7p6MgCMTNrBj/0",
            "gender"=> "0",
            "address"=> "111",
            "real_name"=> "",
            "collectionids"=> "XKTV01158,XKTV00776,XKTV00741",
            "giftorders"=> "",
            "giftordernum"=> 2,
            "collectionnum"=> 3,
            "sname"=> "小影",
            "stel"=> "13666666666",
            "order"=> 4,
            "favorites"=> 0,
            "points"=> 1300,
            "prov"=> "天津市",
            "city"=> "县",
            "county"=> "蓟　县",
            "city_status"=> 310000,
            "openid"=> "oL8b5wuyRyzs8vKX9dMlfMkUQ4C0",
            "lng"=> -1,
            "lat"=> -1,
            "couponnum"=> 0
         );
        return $this->asJson($resultArray);
    }

    //获取参数规则
    public function getRulesArray($ruleIndex) {
        $result['add'] = array(
            array('status', 'in', 'range' => array(1, 2), 'message' => '状态码错误.'),
        );

        return $result[$ruleIndex];
    }

}
