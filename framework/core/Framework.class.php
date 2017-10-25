<?php

   //核心启动类
   class Framework{
   	 public static function run(){
   	 	// echo "hello!!";
   	 	// 初始化数据
   	 	self::init();
   	 	//调用注册方法
   	 	self::autoLoad();
   	 	//调用路由方法
   	 	self::dispatch();
   	 	// echo getcwd();
   	 }

    //初始化数据的私有方法
    private static function init(){
         //定义路径常量
		define("DS", DIRECTORY_SEPARATOR);
		define("ROOT", getcwd() . DS ); //根目录
		define("APP_PATH", ROOT . 'application' . DS);
		define("FRAMEWORK_PATH", ROOT . "framework" .DS);
		define("PUBLIC_PATH", ROOT . "public" .DS);
		define("CONFIG_PATH", APP_PATH . "config" .DS);
		define("CONTROLLER_PATH", APP_PATH . "controllers" .DS);
		define("MODEL_PATH", APP_PATH . "models" .DS);
		define("VIEW_PATH", APP_PATH . "views" .DS);
		define("CORE_PATH", FRAMEWORK_PATH . "core" .DS);
		define("DB_PATH", FRAMEWORK_PATH . "databases" .DS);
		define("LIB_PATH", FRAMEWORK_PATH . "libraries" .DS);
		// define("HELPER_PATH", FRAMEWORK_PATH . "helpers" .DS);
		// define("UPLOAD_PATH", PUBLIC_PATH . "uploads" .DS);
		//获取参数p、c、a,index.php?p=admin&c=goods&a=add GoodsController中的addAction
		 //获取平台参数，并定义为常量
		define('PLATFORM',isset($_GET['p']) ?  $_GET['p'] : "home");
		 //获取控制器，并定义为常量
		define('CONTROLLER',isset($_GET['c']) ?  ucfirst($_GET['c']) : "Index");
		 //获取方法，并定义为常量
		define('ACTION',isset($_GET['a']) ?  $_GET['a'] : "index");
		//设置当前控制器和视图目录 CUR-- current
		define("CUR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
		define("CUR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);
     // var_dump(CUR_CONTROLLER_PATH);die;
		//载入配置文件
		$GLOBALS['config'] = include CONFIG_PATH . "config.php";

		//载入核心类
		include CORE_PATH . "Controller.class.php";
		include CORE_PATH . "Model.class.php";
		include DB_PATH . "Mysql.class.php";
    }
    //自定义自动注册类
    private static function autoload(){
    	spl_autoload_register('self::load');
    }

     //实现控制器和模型的自动加载
    private static function load($className){
          if (substr($className,-10)=="Controller") {
            // var_dump(CUR_CONTROLLER_PATH.$className.".class.php");die;
          	 //载入控制器类
          	 include CUR_CONTROLLER_PATH.$className.".class.php";
          }else if(substr($className,-5)=="Model"){
             //载入模型类
             include MODEL_PATH.$className.".class.php";
          }else{
          	//以后有需要添加
          }


    }

    //路由 创建需要的控制器类和模型实例，并调用相应的方法
    private static function dispatch(){
       //获取控制器的名称
       $controllerName=CONTROLLER."Controller";
       //获取方法名称
       $functionName=ACTION."Action";

       //创建控制器实例化对象
       $controllerObj=new $controllerName();
        // var_dump($controllerObj);die;
       //并地调用相应的方法
       $controllerObj->$functionName();
    }


   }