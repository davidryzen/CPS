<?php

   class problemController extends Controller{

      //获取所有的用户名称

      public function getUserAction(){
        //得到Problem对象
          $proModelObj=new ProblemModel("user");
        //调用查询问题类型的方法
        $result=$proModelObj->getUsers();
         if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=admin&c=Login&a=showPage","数据库查询问题类型失败，请重试！",3);
        }else{
          echo json_encode($result);
        }
      }

       //添加用户
       public function addUserAction(){
           //收集用户信息
             //用户名
           $userName=$_POST["userName"];
           //密码
           $password=$_POST["password"];

        //创建registeModel对象
        $registModelObj=new RegisteModel("user");

        //调用插入数据的方法
        $result=$registModelObj->registe($userName,$password);
        if(isset($result)){
          $this->jump("index.php?p=admin&c=problem&a=addUserPage","添加成功！",3);
        }else{
          $this->jump("index.php?p=admin&c=problem&a=addUserPage","添加失败,您可以重新添加",2);
        }

       }

       //显示添加用户页面
      public function addUserPageAction(){
          include_once CUR_VIEW_PATH.'addUser.html';
      }

      //添加问题类型
      public function addProblemTypeAction(){
        if(isset($_POST)){

         $problemName=$_POST['problemType'];
         //得到Problem对象
          $proModelObj=new ProblemModel("problemtype");
           $result=$proModelObj->addProblemType($problemName);
                  if(!isset($result)){
                 //借用父类的方法跳转
                     $this->jump("index.php?p=admin&c=problem&a=addProbleTypePage","添加问题类型失败，请重试！",3);
                   }else{
                     //借用父类的方法跳转
                     $this->jump("index.php?p=admin&c=problem&a=addProbleTypePage","添加问题类型成功！",3);

                  }
        }else{
           $this->jump("index.php?p=admin&c=problem&a=addProbleTypePage","请输入问题类型！",3);
        }
      }
      //显示添加问题类型页面
      public function addProbleTypePageAction(){
          include_once CUR_VIEW_PATH.'problemTypePage.html';
      }
       //显示答复问题的页面
       public function showAnswerPageAction(){
           //得到问题id
           $proNum=$_GET['problemId'];
           //得到Problem对象
          $proModelObj=new ProblemModel("userproblem");
           $result=$proModelObj->getProblemDetail($proNum);
            if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
        }else{
           include_once CUR_VIEW_PATH.'showUnsolvedPageAdmin.html';
            // echo json_encode($result);
            // var_dump($result);

        }
       }

    //管理员显示未解决的问题
    public function showUnsolvedAdminAction(){
        //得到Problem对象
          $proModelObj=new ProblemModel("userproblem");
        //调用查询未解决的问题的方法
        $result=$proModelObj->unsolvedProblemAdmin();
        if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
        }else{
          // include_once CUR_VIEW_PATH.'adminShowProblemPage.html';
            echo json_encode($result);

        }
    }
    public function showUnsolvedPageAction(){
      include_once CUR_VIEW_PATH.'projects.html';
    }

       //驳回用户的问题
       public function rejectAction(){
           //获取问题id
           $proNum=$_GET['problemId'];
           $answer="驳回！";

            //得到Problem对象
      $proModelObj=new ProblemModel("userproblem");
      //调用更新的方法
      $result=$proModelObj->updatePro($answer,$proNum);
      if(!isset($result)){
           //借用父类的方法跳转
               $this->jump("index.php?p=home&c=problem&a=showDetailPro&problemId=$proNum","更新问题失败，请重试！",3);
        }else{
          //借用父类的方法跳转
               $this->jump("index.php?p=admin&c=problem&a=showUnsolvedPage","驳回问题成功！",1);
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
     			include_once CUR_VIEW_PATH.'showOneDetailPage.html';
     		}
   	  }

   	  //显示解决的问题
   	  public function showSolvedProAction(){
        //得到Problem对象
     		  $proModelObj=new ProblemModel("userproblem");
     		//调用查询解决的问题的方法
     		$result=$proModelObj->solvedProblemAdmin();
     		if(!isset($result)){
     			 //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
     		}else{
     			// include_once CUR_VIEW_PATH.'adminShowaSolvedProblemPage.html';
          echo json_encode($result);
     		}
   	  }

   	  //保存解决问题的数据
   	  public function solvedProblemAction(){
   	  	 // var_dump($_POST);
   	  	 //得到问题的编号
   	  	 $proNum=$_POST['proNumber'];
   	  	 //得到解决问题的答案
   	  	 $answer=$_POST['answer'];
         $solver=$_POST['solver'];
       //得到Problem对象
     	$proModelObj=new ProblemModel("userproblem");
     	//调用更新的方法
     	$result=$proModelObj->updatePro($answer,$proNum,$solver);
     	if(!isset($result)){
     			 //借用父类的方法跳转
               $this->jump("index.php?p=home&c=problem&a=showDetailPro&problemId=$proNum","更新问题失败，请重试！",3);
     		}else{
     			//借用父类的方法跳转
               $this->jump("index.php?p=admin&c=problem&a=showSolvingPage","答复问题成功！",3);
     		}
   	  }
      //显示正在解决的问题的页面
      public function showSolvingPageAction(){
          include_once CUR_VIEW_PATH.'projects.html';
      }
   	  //管理员显示所有的问题
   		public function showAllProAction(){
   			//得到查询所有问题的标志
   			// $mark=$_GET["mark"];
     		//得到Problem对象
     		  $proModelObj=new ProblemModel("userproblem");
     		//调用查询未解决的问题的方法
     		$result=$proModelObj->allProblemsAdmin();
     		if(!isset($result)){
     			 //借用父类的方法跳转
               $this->jump("index.php?p=home&c=Login&a=showPage","查询问题失败，请重试！",3);
     		}else{
     			// include_once CUR_VIEW_PATH.'adminShowProblemPage.html';
           echo json_encode($result);
     		}
     	}
   	   public function showDetailProAction(){
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
     			include_once CUR_VIEW_PATH.'showOneDetailPage.html';
     		}
   	   }
   }