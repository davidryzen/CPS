<?php
    //显示前台登录页类
    class IndexController extends Controller{
    	//显示登录页面
    	public function indexAction(){
          //载入登录界面
          include_once CUR_VIEW_PATH.'login.html';
    	}
    }