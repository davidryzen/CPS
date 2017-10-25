<?php
    //处理问题类
    class ProblemModel extends Model{
        //获取所有的用户
        public function  getUsers(){
           //拼接SQL语句查询出所有为解决的问题的数据

            $sql="select userName,id from {$this->table} ";
            //调用父父类的方法,得到一个关联的二维数组
            return $this->db->getAll($sql);
        }

        //向问题类型表中插入数据
        public function addProblemType($typeName){
             $listArray=array('typeName'=>$typeName);
             $result=$this->insert($listArray);//调用父类的方法执行插入;
             return $result;
        }

        //前台获取问题的类型
        public function getProblemTypes(){
            //拼接SQL语句查询出所有为解决的问题的数据

            $sql="select * from {$this->table} ";
            //调用父父类的方法,得到一个关联的二维数组
            return $this->db->getAll($sql);
        }
        //管理员答复更新问题表
        public function updatePro($answer,$proNum,$solver){
            $list=array("answer"=>$answer,"state"=>1,"solver"=>$solver,'updateTime'=>time());
            //更新的条件
            $where="id = '$proNum'";
            //调用父类更新的方法,并返回结果
            return $this->update($list,$where);
        }
        //管理员通过problemId获取问题的详细情况
        public function getProblemDetail($problemId){
           //拼接SQL语句
           $sql="select * from {$this->table} where  id= '$problemId'";
           //调用父父类的方法 并返回结果
          return $this->db->getRow($sql);
        }
    	public function storeSubmitData($list){
           //调用父类的插入数据到数据库的方法,并返回结果
           return $this->insert($list);
    	}

    	//用户获取尚未解决的问题的数据
    	public function unsolvedProblem(){
    		//拼接SQL语句查询出所有为解决的问题的数据
    		$curentUser=$_SESSION['currentUser'];
    		$sql="select * from {$this->table} where state=0 and subUser='$curentUser' order by id";
    		//调用父父类的方法,得到一个关联的二维数组
    		return $this->db->getAll($sql);
    	}

        //管理员获取尚未解决的问题的数据
        public function unsolvedProblemAdmin(){
            //拼接SQL语句查询出所有为解决的问题的数据

            $sql="select * from {$this->table} where state=0  order by id desc";
            //调用父父类的方法,得到一个关联的二维数组
            return $this->db->getAll($sql);
        }
        //管理员获取解决的问题的数据
        public function solvedProblemAdmin(){
            //拼接SQL语句查询出所有为解决的问题的数据

            $sql="select * from {$this->table} where state=1  order by id ";
            //调用父父类的方法,得到一个关联的二维数组
            return $this->db->getAll($sql);
        }

    	//用户查询所有的问题
        public function allProblems(){
            //拼接SQL语句查询出所有为解决的问题的数据
            $curentUser=$_SESSION['currentUser'];
            $sql="select * from {$this->table} where subUser='$curentUser' order by id";
            //调用父父类的方法,得到一个关联的二维数组
            return $this->db->getAll($sql);
        }
        //管理员查询所有的问题
    	public function allProblemsAdmin(){
    		//拼接SQL语句查询出所有为解决的问题的数据
    		$sql="select * from {$this->table}  order by id";
    		//调用父父类的方法,得到一个关联的二维数组
    		return $this->db->getAll($sql);
    	}

        //用户显示解决问题的数据
        public function solvedProblem(){
            //拼接SQL语句查询出所有为解决的问题的数据
            $curentUser=$_SESSION['currentUser'];
            $sql="select * from {$this->table} where state=1 and subUser='$curentUser' order by id";
            //调用父父类的方法,得到一个关联的二维数组
            return $this->db->getAll($sql);
        }
    }