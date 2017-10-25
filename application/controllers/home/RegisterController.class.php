<?php
   //用户注册类
   class RegisterController extends Controller{
       //判断注册的用户名是否存在
       public function repeatedNameAction(){
          //获取要1注册的用户名
          $userName=$_GET['userName'];
          //创建registeModel对象
          $registModelObj=new RegisteModel("user");
          $result=$registModelObj->queryRepeatedName($userName);
          if (!empty($result)) {
             echo "<font color='red' size='2'>此用户名已经被注册了<font>";
          }else{
            echo "<font color='lightgreen' size='2'>此用户名可用</font>";
          }
       }
   	   //载入注册
   	   public function registPageAction(){
   	   	  //载入注册页面
   	   include_once CUR_VIEW_PATH.'register.html';
   	   }

       //执行注册操作
       public function registeAction(){
           //收集用户信息
             //用户名
           $userName=$_POST["username"];
           //密码
           $password=$_POST["password"];

        //创建registeModel对象
        $registModelObj=new RegisteModel("user");

        //调用插入数据的方法
        $result=$registModelObj->registe($userName,$password);
        if($result){
        	$this->jump("index.php?p=home&c=index&a=index","注册成功,3秒钟跳转到登录页面",3);
        }else{
        	$this->jump("index.php?p=home&c=register&a=registPage","注册失败,您可以重新注册",2);
        }

       }
   }