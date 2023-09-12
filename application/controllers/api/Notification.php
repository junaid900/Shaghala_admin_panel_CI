<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends  MJ_Controller
{   
    
      public function __construct()
    {
        $this->table = NOTIFICATION_TABLE;
        $this->alias = NOTIFICATION_ALS;
        parent::__construct();    
        
    }

    /*****  INDEX *********/
    
     public function index(){
        
     }
     public function get_notification_count($userid){
         $data = $this->db->query("select count(notification_id) as count from ".$this->table." where receiver_id = $userid and read_status = 'Unread'")->first_row();
          response(1, "Success", $data);
     }
     public function read_notification($userid){
         $data = $this->db->update($this->table, ["read_status"=>"Read"] ,["receiver_id" => $userid]);
          response(1, "Success", []);
     }
     public function get(){
        if(!isset($_REQUEST['user_id'])) {
            response(0, "Don't have any notifications, if you are not logged in login first", []);
        }
        $user_id = $_REQUEST['user_id'];
        $data = $this->db->query("select * from ".$this->table." where receiver_id = $user_id OR type = 'All'")->result();
        response(1, "success", $data);
     }
     public function get_admin(){
         
        // $user_id = $_REQUEST['user_id'];
        $data = $this->db->query("select * from ".$this->table." where type = 'Admin'")->result();
        response(1, "success", $data);
     }
     
     public function send(){
         $this->table = NOTIFICATION_TABLE;
        $this->alias = NOTIFICATION_ALS;
     ;
        if (!isset($_REQUEST['receiver_id']) || !isset($_REQUEST['notification_title']) || !isset($_REQUEST["description"]) || !isset($_REQUEST['image']) || !isset($_REQUEST["type"]) || !isset($_REQUEST["data"])) {
            response(0, "missing params", []);
        }
           print_r($_REQUEST);
        
         $receiver_id =$_REQUEST['receiver_id'];
         $title =$_REQUEST['notification_title'];
         $message =$_REQUEST['description'];
         $image ="";
         $type =$_REQUEST['type'];
         $data =$_REQUEST['data'];
          
          $this->sendNotification($receiver_id,$title,$message,$image,$type,$data);
     }
    
    
}
?>