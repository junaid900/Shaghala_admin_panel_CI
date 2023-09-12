<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MJ_Controller
{   
    
      public function __construct()
    {
        parent::__construct();    
        
    }
    public function checkUser($user_id){
        if(empty($user_id)){
             response(0, "missing params", []);
        }
        $user = $this->getUser($user_id);
        if(!empty($user->user_id)){
            response(1, "Success", $user);
        }else{
            response(0, "Cannot find user try to signin again", []);
        }
    }
    public function getUser($id){
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        $user = $this->db->get_where($this->table, [$this->alias."_id"=>$id])->first_row();
        $user->is_subscribed = $this->checkUserSub($id);
        return $user;
    }
     public function edit()
    {
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        
        if(!isset($_REQUEST['user_id'])){
            response(0, "missing params", []);
        }
        $id = $_REQUEST['user_id'];
        $arr = array();
        if(!empty($_REQUEST['email'])){
            $arr['email'] = $_REQUEST['email'];
        }
        if(!empty($_REQUEST['password'])){
            $arr['password'] = md5($_REQUEST['password']);
        }
        if(!empty($_REQUEST['name'])){
            $arr['name'] = $_REQUEST['name'];
        }
        if(!empty($_REQUEST['phone'])){
            $arr['phone'] = $_REQUEST['phone'];
        }
        if(!empty($_REQUEST['type'])){
            $arr['type'] = $_REQUEST['type'];
        }
        if(!empty($_REQUEST['address'])){
            $arr['address'] = $_REQUEST['address'];
        }
        if(!empty($_REQUEST['country_id'])){
            $arr['country_id'] = $_REQUEST['country_id'];
        }
        $res = $this->db->update($this->table,$arr,[$this->alias."_id"=>$id]);
        if($res){
            response(1,"success",$this->getUser($id));
        }else{
            response(0,"failed",[]);
        }
        
    }
    public function upload_image()
    {
      $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        
        if(!isset($_REQUEST['user_id'])){
            response(0, "missing params", []);
        }
         $id = $_REQUEST['user_id'];
         if(!empty($_REQUEST['user_image'])){
            $img = $this->uploadDirBase64Image($_REQUEST['user_image'],"users");
        }
        $res = $this->db->update($this->table,['user_image'=>$img],[$this->alias."_id"=>$id]);
        if($res){
            response(1,"success",$this->getUser($id));
        }else{
            response(0,"failed",[]);
        }
    }
     public function profile_slider(){
        
        $this->table = PROFILE_SLIDER_TABLE;
        $this->alias = PROFILE_SLIDER_ALS;
        
        $data = $this->db->get_where($this->table,["status"=>"Active"])->result();
        if($data){
            return response(1,"Success",$data);
        }else{
            return response(0,"Failed",[]);
        }
    }
    public function get_companies(){
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        $whereArr = ["type"=>"Company","admin_status"=>"Active"];
        if(isset($_REQUEST['ac_type'])){
            $id = $_REQUEST['ac_type'];
            $whereArr['type_id'] = $id;
        }
        $users = $this->db->get_where($this->table, $whereArr)->result();
        // echo $this->db->last_query();
        if($users){
            return response(1,"Success",$users);
        }else{
            return response(0,"No company found",[]);
        }
        // $user->is_subscribed = $this->checkUserSub($id);
        // return $user;
    }
}
?>