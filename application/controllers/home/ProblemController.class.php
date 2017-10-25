<?php
     class ProblemController extends Controller{

      //获得问题类型
      public function getProblemTypeAction(){
        //得到Problem对象
          $proModelObj=new ProblemModel("problemtype");
        //调用查询问题类型的方法
        $result=$proModelObj->getProblemTypes();
         if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=admin&c=Login&a=showPage","数据库查询问题类型失败，请重试！",3);
        }else{
          echo json_encode($result);
        }
      }


        //在页面显示答复的数据
      public function showAnswerForPageAction(){
         //通过post携带的problemId,查询到这个问题的详细情况
          $proId=$_GET['problemId'];
          //得到Problem对象
          $proModelObj=new ProblemModel("userproblem");
        //调用查询未解决的问题的方法
        $result=$proModelObj->getProblemDetail($proId);
        if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=admin&c=Login&a=showPage","查询问题失败，请重试！",3);
        }else{
          include_once CUR_VIEW_PATH.'savedForm_basic.html';
        }
      }
       //在页面显示未答复的数据
      public function showUnAnswerForPageAction(){
         //通过post携带的problemId,查询到这个问题的详细情况
          $proId=$_GET['problemId'];
          //得到Problem对象
          $proModelObj=new ProblemModel("userproblem");
        //调用查询未解决的问题的方法
        $result=$proModelObj->getProblemDetail($proId);
        if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=admin&c=Login&a=showPage","查询问题失败，请重试！",3);
        }else{
          include_once CUR_VIEW_PATH.'showUnanswerPageForm_basic.html';
        }
      }

      //显示已经答复的问题
      public function showSolvedProAction(){
        //得到Problem对象
          $proModelObj=new ProblemModel("userproblem");
        //调用查询未解决的问题的方法
        $result=$proModelObj->solvedProblem();

        if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
        }else{
          // include_once CUR_VIEW_PATH.'showSolvedPage.html';
           echo json_encode($result);//相应ajax请求
        }
      }

     	public function showAllProAction(){
     		//得到Problem对象
     		  $proModelObj=new ProblemModel("userproblem");
     		//调用查询未解决的问题的方法
     		$result=$proModelObj->allProblems();

     		if(!isset($result)){
     			 //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
     		}else{
          // date("Y-m-d H:i",$v['subTime'])
     			// include_once CUR_VIEW_PATH.'showAllProblemPage.html';
          echo json_encode($result);//相应ajax请求
     		}
     	}
     	public function showUnsolvedProAction(){
     		//得到Problem对象
     		  $proModelObj=new ProblemModel("userproblem");
     		//调用查询未解决的问题的方法
     		$result=$proModelObj->unsolvedProblem();
     		if(!isset($result)){
     			 //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
     		}else{
     			 // include_once CUR_VIEW_PATH.'showUnsolvedPage.html';
           echo json_encode($result);
     		}
     	}
      //显示未解决问题页面
      public function showSavingProPageAction(){
          
        // echo "&lt;script&gt; window.location.href="+CUR_VIEW_PATH+"</script>"
        // echo CUR_VIEW_PATH;die;
          include_once CUR_VIEW_PATH."savingProjects.html";
      }
     	public function submitProblemAction(){

            // var_dump($_SESSION);
            //获取用户数据
            $submitUser=$_SESSION["currentUser"];
            //问题题目
            $problemTitle=$_POST['subject'];
            //问题类别
            $problemType=$_POST['type'];
            //问题关键字
            $probleKeyWords=$_POST['keyword'];
            //问题描述
            $problemDescription=$_POST['content'];
            // var_dump($_POST);die;
            //数据存放在关联数组中
            $list=array("subUser"=>$submitUser,"proTitle"=>$problemTitle,"proType"=>$problemType,"proKW"=>$probleKeyWords,"proDescription"=>$problemDescription,"subTime"=>time());
           //创建probleModel对象
           $proModelObj=new ProblemModel("userproblem");
           //调用储存数据的方法
           $result=$proModelObj->storeSubmitData($list);

           if($result){

               //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Problem&a=showSavingProPage","发布问题成功,后台管理员正在帮您解决！",2);
           }else{
           	   //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","发布问题失败,请再重新发布一次！",3);
           }

     	}
     }