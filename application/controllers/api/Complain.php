<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Complain extends MJ_Controller
{   
    
      public function __construct()
    {
        $this->table = COMPLAIN_TABLE;
        $this->alias = COMPLAIN_ALS;
        parent::__construct();    
        
    }
    
    public function dept(){
        
         $this->table = DEPARTMENT_TABLE;
         $this->alias = DEPARTMENT_ALS;
       
       $data = $this->db->get_where($this->table ,["status"=>"Active"])->result();
       if($data){
            return response(1,"Success",$data);
        }else{
            return response(0,"failed",[]);
        }
    }
     public function add(){
        
        $this->table = COMPLAIN_TABLE;
        $this->alias = COMPLAIN_ALS;
        if(!isset($_REQUEST['user_id'])){
            response(0,"mission params",[]);
        }
       $arr = array();
       $arr["user_id"] = $_REQUEST['user_id'];
        if(isset($_REQUEST['message'])){
            $arr["message"] = $_REQUEST['message'];
        }
        if(isset($_REQUEST['dept_id'])){
            $arr["dept_id"] = $_REQUEST['dept_id'];
        }
        if(isset($_REQUEST['status'])){
            $arr["status"] = $_REQUEST['status'];
        }
        if(isset($_REQUEST['type'])){
            $arr["type"] = $_REQUEST['type'];
        }
        $res = $this->db->insert($this->table,$arr);
        if($res){
            $id = $this->db->insert_id();
            
            response(1,"success",$this->return_all());
        }else{
            response(0,"failed",[]);
        }
        
    }
    public function edit(){
        
        $this->table = COMPLAIN_TABLE;
        $this->alias = COMPLAIN_ALS;
        
        if(!isset($_REQUEST['complain_id'])){
             response(0, "missing params", []);
        }
        $id = $_REQUEST['complain_id'];
       $arr = array();
        if(isset($_REQUEST['message'])){
            $arr["message"] = $_REQUEST['message'];
        }
        if(isset($_REQUEST['dept_id'])){
            $arr["dept_id"] = $_REQUEST['dept_id'];
        }
        // if(isset($_REQUEST['status'])){
        //     $arr["status"] = $_REQUEST['status'];
        // }
        if(isset($_REQUEST['type'])){
            $arr["type"] = $_REQUEST['type'];
        }
        if(isset($_REQUEST['user_id'])){
            $arr["user_id"] = $_REQUEST['user_id'];
        }
        $res = $this->db->update($this->table,$arr,[$this->alias."_id"=>$id]);
        if($res){
            response(1,"success",$this->return_all());
        }else{
            response(0,"failed",[]);
        }
     
}
}
?>