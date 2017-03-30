<?php

//导航管理

namespace app\controllers\api;

use Yii;
use app\common\InstanceFactory;
use app\controllers\CommonInterface;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class IndexController extends CommonController implements CommonInterface {
    
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
    
    public function actionBaseinfo(){
        $resultArray=array(
            "result"=> 0,
            "msg"=> "get base info success",
            "baseinfo"=>array(
                "christmas"=> array(
                    "status"=> 0,
                    "list_banner"=> "/uploads/img/christmas_list_banner_big.jpg"
                ),
                
                "banner"=>array(
                    "count"=> 1,
                    "lists"=>array( 
                        "name"=> "夜点介绍",
                        "link"=> "http://yddev.ye-dian.com/1.html",
                        "pic" => "/uploads/image/20161205/20161205121034_33356.jpg",
                        "desc"=> "http://mp.weixin.qq.com/s/TdigZeoPr5LuoeXfjnHT-g",
                        "area"=> array(
                          440100,
                          440600,
                          440300,
                          310000
                        )
                    )
                ),
                
                
                "poster"=> array(
                    "count"=> 11,
                    "lists"=> array(
                        array(
                          "name"=> "goldpkg",
                          "link"=> "#!/ktv?event=goldpkg",
                          "pic"=> "/uploads/event_img/poster/post4.png",
                          "desc"=> "周杰伦上传了小周周影片，只见她戴着猫咪草帽，紧紧牵着旁边大人的手、大步大步地向前走，喊着“爸爸、爸爸爸”，声音超可爱。",
                          "area"=> array(
                            440100,
                            440600,
                            440300,
                            310000
                          )
                        ),
                        array(
                          "name"=> "oneyuan",
                          "link"=> "/dist/oneyuan",
                          "pic" => "/uploads/event_img/poster/post3.png",
                          "desc"=> "周杰伦上传了小周周影片，只见她戴着猫咪草帽，紧紧牵着旁边大人的手、大步大步地向前走，喊着“爸爸、爸爸爸”，声音超可爱。",
                          "area"=> array(
                            440100
                          )
                        ),
                    ),
                ),    
                    
                "musics"=> array(
                "count"=> 5,
                "lists"=> array(
                      array(
                        "name"=> "维密秀不只有模特和天价Bra",
                        "link"=> "http://mp.weixin.qq.com/s/YFXx78f-5vFUGpK9KhADBQ",
                        "pic"=> "/uploads/image/20161203/20161203001140_48549.jpg",
                        "desc"=> "它火爆至极的原因还有...\r\n",
                        "area"=> array(
                          440100,
                          440600,
                          440300,
                          310000
                        ),
                        "position"=> "top"
                      ),
                      array(
                        "name"=> "Juicy M：明明能靠脸，却偏要靠才华",
                        "link"=> "http://mp.weixin.qq.com/s/sxi46WYLv2UHWX-b7k9gig",
                        "pic"=> "/uploads/image/20161203/20161203001352_51888.jpg",
                        "desc"=> "全球百大的美女DJ有何不同？",
                        "area"=> array(
                          440100,
                          440600,
                          440300,
                          310000
                        ),
                        "position"=> "bottom"
                      ),
                  )
                ),
                "lifestyles"=> array(
                "count"=> 5,
                "lists"=> array(
                      array(
                        "name"=> "维密秀不只有模特和天价Bra",
                        "link"=> "http://mp.weixin.qq.com/s/YFXx78f-5vFUGpK9KhADBQ",
                        "pic"=> "/uploads/image/20161203/20161203001140_48549.jpg",
                        "desc"=> "它火爆至极的原因还有...\r\n",
                        "area"=> array(
                          440100,
                          440600,
                          440300,
                          310000
                        ),
                        "position"=> "top"
                      ),
                      array(
                        "name"=> "Juicy M：明明能靠脸，却偏要靠才华",
                        "link"=> "http://mp.weixin.qq.com/s/sxi46WYLv2UHWX-b7k9gig",
                        "pic"=> "/uploads/image/20161203/20161203001352_51888.jpg",
                        "desc"=> "全球百大的美女DJ有何不同？",
                        "area"=> array(
                          440100,
                          440600,
                          440300,
                          310000
                        ),
                        "position"=> "bottom"
                      ),
                  )
                ),
                    
                "splash"=> "",
                "callcenter_worktime"=> array(
                  "starttime"=> "16:00",
                  "endtime"=> "23:59"
                )
                
            ),
          
        );

        return $this->asJson($resultArray);
 
    }
    
    
    public function actionCitylist(){
        $resultArray=array(
            "result"=> 0,
            "msg"=> "get city list success",
            "lists"=> array(
                array(
                  "name"=> "广州市",
                  "area_id"=> 440100
                ),
                array(
                  "name"=> "佛山市",
                  "area_id"=> 440600
                ),
                array(
                  "name"=> "东莞市",
                  "area_id"=> 441900
                ),
                array(
                  "name"=> "深圳市",
                  "area_id"=> 440300
                ),
                array(
                  "name"=> "上海市",
                  "area_id"=> 310000
                ),
                array(
                  "name"=> "重庆市",
                  "area_id"=> 500000
                ),
                array(
                  "name"=> "成都市",
                  "area_id"=> 510100
                )
            )
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
