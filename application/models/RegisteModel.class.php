<?php
 class RegisteModel extends Model{
 	//调取注册的用户名
 	public function queryRepeatedName($name){
        //编写sql语句
        $sql="select id from {$this->table} where userName='$name'";
        //调用父父类的方法,返回结果
        return $this->db->getOne($sql);
 	}
 	public function registe($name,$pass){
      //编写SQL语句
      // $sql="insert into {$this->table}(userName,password) values($name,$pass)";

      $listArray=array('userName'=>$name,'password'=>$pass);
      $result=$this->insert($listArray);//调用父类的方法执行插入;

      //返回插入结果
      return  $result;

 	}
 }