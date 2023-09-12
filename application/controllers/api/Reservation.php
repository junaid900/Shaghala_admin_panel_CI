<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation extends MJ_Controller
{   
    
      public function __construct()
    {
        parent::__construct();    
        $this->table = RESERVATION_TABLE;
        $this->alias = RESERVATION_ALS;
        // $this->sendNotification($receiver_id,$title,$message,$image,$type,$data);
        
    }
    public function get_by_user(){
          if (!isset($_REQUEST['user'])) {
            response(0, "Missing params", []);
        }
        $userId = $_REQUEST['user'];
        $reservations = $this->db->query("SELECT a.*,a.".$this->language."_name as lang_name,a.en_name as en_name, a.ar_name as ar_name FROM " . $this->table.
           " r left join ".WORKER_TABLE." a on a.worker_id = r.worker_id where r.user_id = '".$_REQUEST['user'].
           "' and r.reserve_exp_date >= '".date('Y-m-d h:i:s')."' and r.status = 'Active'")->result();
        //   echo $this->db->last_query();
        if($reservations){
            response(1, "Success", $reservations);
        }else{
             response(1, "Cannot load reservations", []);
        }

    }
    public function check_reservation(){
        if (!isset($_REQUEST['user']) || !isset($_REQUEST['worker_id'])) {
            response(0, "Missing params", []);
        }
        $this->db->order_by("reservation_id","DESC");
        $reservations = $this->db->query("SELECT * FROM " . $this->table. " where worker_id = '".$_REQUEST['worker_id']."' and reserve_exp_date >= '".date('Y-m-d h:i:s')."' and status = 'Active'")->result();
        if(count($reservations) > 0){
            response(0, "This worker already reserved.", []);
        }
        // $count = 0;$check = false;
        // foreach($reservations as $r){
        //     if($this->checkReservation($r->reservation_id)){
        //         $check = true;
        //     }
        //     if($count > 10){
        //         break;
        //     }
        //     $count++;
        // }
        // if($check){
        //     response(0, "This worker already reserved by you", []);
        // }
        response(1, "Not reserved", []);
    }
     public function fatora_add(){
        if (!isset($_REQUEST['user']) || !isset($_REQUEST['token']) || !isset($_REQUEST['amount']) || !isset($_REQUEST['tr_id']) || !isset($_REQUEST['worker_id'])) {
            response(0, "Missing params", []);
        }
        $users = $this->db->get_where(USER_TABLE,["user_id"=>$_REQUEST['user']])->result();
        if(count($users) < 1){
            response(0, "Invalid Request", []);
        }
        $user = $users[0];
        $workers = $this->db->get_where(WORKER_TABLE,["worker_id"=>$_REQUEST['worker_id']])->result();
        if(count($workers) < 1){
            response(0, "Invalid Request", []);
        }
        $worker = $workers[0];
        
        $worker_owners = $this->db->get_where(USER_TABLE,["user_id"=>$worker->user_id])->result();
        if(count($worker_owners) < 1){
            response(0, "Invalid Request", []);
        }
        $worker_owner = $worker_owners[0];
        $reserve_date = date('Y-m-d h:i:s');
        $reserve_days = $this->app_setting['reservation_days'];
        $reserve_exp_date = $this->reserveExpDate();
        // $user,$worker,$worker_owner
        // tr_id
        $arr = ["user_id"=>$user->user_id,"worker_id"=>$worker->worker_id,"referance_id"=>$worker_owner->user_id,
        "type"=>$worker_owner->type,"status"=>"Active","days"=>$reserve_days,"reserve_data"=>$reserve_date,"reserve_exp_date"=>$reserve_exp_date];
        
        $data = [];
        $data['user_id'] = $_REQUEST['user'];
        $data['token'] = $_REQUEST['token'];
        $data['amount'] = $_REQUEST['amount'];
        $data['tr_id'] = $_REQUEST['tr_id'];
        $data['description'] = "Reservation Made By ".$user->name;
        $data['type'] = "Fatora";
        $res = $this->db->insert(TRANSACTION_TABLE,$data);
        if($res){
            $tr_id = $this->db->insert_id();
            $arr["transaction_id"] = $tr_id;
            $reservation = $this->db->insert($this->table,$arr);
            $this->sendNotification($user->user_id,"Reservation Made Successfully","Your reservation for ".$worker->en_name ." has been made successfully",NOTIFY_IMGS."check.png","Single");
            $this->sendNotification($worker_owner->user_id,"Reservation Made","Your CV reservation for ".$worker->en_name ." has been made mode by ".$user->name,NOTIFY_IMGS."info.png","Single");
            
            $this->sendMail("Your reservation for ".$worker->en_name ." has been made successfully","Reservation Made Successfully",$user->email);
            $this->sendMail("Your CV reservation for ".$worker->en_name ." has been made mode by ".$user->name,"Reservation Made",$worker_owner->email);
            
            if($reservation){
                response(1, "Successfully reserved", $worker);
            }else{
                response(0, "Cannot made reservation contact support", []);
            }
        }else{
             response(0, "Invalid Request", []);
        }
    }
      public function paypal_add(){
        if (!isset($_REQUEST['user']) || !isset($_REQUEST['token']) || !isset($_REQUEST['amount']) || !isset($_REQUEST['tr_id']) || !isset($_REQUEST['worker_id'])) {
            response(0, "Missing params", []);
        }
        $users = $this->db->get_where(USER_TABLE,["user_id"=>$_REQUEST['user']])->result();
        if(count($users) < 1){
            response(0, "Invalid Request", []);
        }
        $user = $users[0];
        $workers = $this->db->get_where(WORKER_TABLE,["worker_id"=>$_REQUEST['worker_id']])->result();
        if(count($workers) < 1){
            response(0, "Invalid Request", []);
        }
        $worker = $workers[0];
        
        $worker_owners = $this->db->get_where(USER_TABLE,["user_id"=>$worker->user_id])->result();
        if(count($worker_owners) < 1){
            response(0, "Invalid Request", []);
        }
        $worker_owner = $worker_owners[0];
        $reserve_date = date('Y-m-d h:i:s');
        $reserve_days = $this->app_setting['reservation_days'];
        $reserve_exp_date = $this->reserveExpDate();
        // $user,$worker,$worker_owner
        // tr_id
        $arr = ["user_id"=>$user->user_id,"worker_id"=>$worker->worker_id,"referance_id"=>$worker_owner->user_id,
        "type"=>$worker_owner->type,"status"=>"Active","days"=>$reserve_days,"reserve_data"=>$reserve_date,"reserve_exp_date"=>$reserve_exp_date];
        
        $data = [];
        $data['user_id'] = $_REQUEST['user'];
        $data['token'] = $_REQUEST['token'];
        $data['amount'] = $_REQUEST['amount'];
        $data['tr_id'] = $_REQUEST['tr_id'];
        $data['description'] = "Reservation Made By ".$user->name;
        $data['type'] = "Paypal";
        $res = $this->db->insert(TRANSACTION_TABLE,$data);
        if($res){
            $tr_id = $this->db->insert_id();
            $arr["transaction_id"] = $tr_id;
            $reservation = $this->db->insert($this->table,$arr);
            if($reservation){
                $this->sendNotification($user->user_id,"Reservation Made Successfully","Your reservation for ".$worker->en_name ." has been made successfully",NOTIFY_IMGS."check.png","Single");
                $this->sendNotification($worker_owner->user_id,"Reservation Made","Your CV reservation for ".$worker->en_name ." has been made mode by ".$user->name,NOTIFY_IMGS."info.png","Single");
                
                $this->sendMail("Your reservation for ".$worker->en_name ." has been made successfully","Reservation Made Successfully",$user->email);
                $this->sendMail("Your CV reservation for ".$worker->en_name ." has been made mode by ".$user->name,"Reservation Made",$worker_owner->email);
                response(1, "Successfully reserved", $worker);
            }else{
                response(0, "Cannot made reservation contact support", []);
            }
        }else{
             response(0, "Invalid Request", []);
        }
    }
}
?>