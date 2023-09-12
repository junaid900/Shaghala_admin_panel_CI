<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General extends MJ_Controller
{   
    
      public function __construct()
    {
        parent::__construct();    
        
    }

    /*****  INDEX *********/
    public function get_setting(){
        response(1,"Success",$this->app_setting);
    }
    public function signinByType(){
        //  $input = $_REQUEST;
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        // print_r($_POST);
        
         if(!isset($_REQUEST['type']) || !isset($_REQUEST['id']) || !isset($_REQUEST['email'])) {
            response(0, "Missing params", []);
        }
        
        $type = $_REQUEST['type'];
        $id = $_REQUEST["id"];
        $email = $_REQUEST['email'];
        $cond['email'] = $_REQUEST['email'];
        // $tokenId = generateToken();
        $sessionId = generateSession();
        $arr = array();
        if($type == 'facebook'){
            $arr['facebook_id'] = $id;
            // $this->db->update();
        }else if($type == 'gmail'){
            $arr['google_id'] = $id;
        }else{
            response(0, "Invalid request", []);
        }
        
        $user = $this->db->get_where($this->table, $cond);
        if (!$user) {
            response(0, "Unable to get response", []);
        }
        
        $data = $user->result();
        if (count($data) != 1) {
            response(0, "Invalid credentials signup first", []);
        }
        $userData = $user->first_row();
        $arr = [];
        if($type == 'facebook'){
            $arr['facebook_id'] = $id;
            $arr['is_fb_verified'] = "Yes";
            // $this->db->update();
        }else if($type == 'gmail'){
            $arr['google_id'] = $id;
            $arr['is_email_verified'] = "Yes";
        }
        if(count($arr) > 0){
            $this->db->update(USER_TABLE,$arr,["email"=>$email]);
        }
       
        
        // $date = date("Y-m-d h:i:s", strtotime($date . ' +2 day'));
        $this->db->update($this->table, ["session_id" => $sessionId], [$this->alias."_id" => $userData->user_id]);
        $userData->session_id = $sessionId;
        $userData->is_subscribed = $this->checkUserSub($userData->user_id);
        response(1, "Successfully loggedIn", $userData);
        
     }
     public function getTypes(){
        $this->table = ACCOUNT_TYPE_TABLE;
        $this->alias = ACCOUNT_TYPE_ALS;
        $res = $this->db->get_where($this->table , ["status"=> "Active"])->result();
         if($res)
          response(1, "Successful", $res);
         else
          response(0, "No data found", []);
     }
     public function myTransaction($userId){
         $data = $this->db->get_where(TRANSACTION_TABLE, ["user_id" => $userId]);
         if($data)
          response(1, "Successful", $data);
         else
          response(0, "No data found", []);
     }
     public function signin(){
        //  $input = $_REQUEST;
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        // print_r($_POST);
        
         if(!isset($_REQUEST['email']) || !isset($_REQUEST['password'])) {
            response(0, "Missing params", []);
        }
        
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST["password"]);
        
        // $tokenId = generateToken();
        $sessionId = generateSession();
        
        $user = $this->db->get_where($this->table, ["email" => $email, "password" => $password]);
        if (!$user) {
            response(0, "Unable to get response", []);
        }
        $data = $user->result();
        if (count($data) != 1) {
            response(0, "Invalid credentials", []);
        }
        $userData = $user->first_row();
        
       
        
        // $date = date("Y-m-d h:i:s", strtotime($date . ' +2 day'));
        $this->db->update($this->table, ["session_id" => $sessionId], [$this->alias."_id" => $userData->user_id]);
        $userData->session_id = $sessionId;
        $userData->is_subscribed = $this->checkUserSub($userData->user_id);
        response(1, "Successfully loggedIn", $userData);
        
     }
      public function signup()
    {
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        if (!isset($_REQUEST['email']) || !isset($_REQUEST['password']) || !isset($_REQUEST["name"]) || !isset($_REQUEST['phone']) || !isset($_REQUEST["type"]) || !isset($_REQUEST["login_type"])) {
            response(0, "Missing params", []);
        }
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $phoneCon = '';
        if(!empty($phone)){
            $phoneCon = "OR phone = '$phone'";
        }
        $checkUser = $this->db->query("SELECT * FROM ".$this->table." where email = '$email'  $phoneCon");
        // $checkUser = $this->db->get_where($this->table, ["email" => $email]);
         if ($checkUser) {
            if (count($checkUser->result()) > 0) {
                response(0, "Email or phone is already in use! if you already have account please try to login.");
            }
        }
        if($checkUser){
            if($checkUser->first_row()->is_phone_verified == 'No'){
                response(4, "Phone verification needed",$checkUser->first_row());
            }
        }
      
        
        
        $name = $_REQUEST['name'];
        if(!empty($_REQUEST["password"]))
            $password = md5($_REQUEST["password"]);
        else
            $password = '';
        $type = $_REQUEST["type"];
        $login_type = $_REQUEST["login_type"];
        $type_id = $_REQUEST["account_id"];
        
        $userArray = ["email" => $email, "password" => $password, "name" => $name, "type" => $type,"phone"=>$phone, "login_type"=>$login_type,'type_id'=>$type_id];
        if(!empty($_REQUEST["google_id"])){
            $userArray['google_id'] = $_REQUEST["google_id"];
            $userArray['is_email_verified'] = "Yes";
        }
        if(!empty($_REQUEST["facebook_id"])){
            $userArray['facebook_id'] = $_REQUEST["facebook_id"];
            $userArray['is_fb_verified'] = "Yes";
        }
        if(!empty($_REQUEST["country_id"])){
            $userArray['country_id'] = $_REQUEST["country_id"];
        }
        if(!empty($_REQUEST["docUrl"])){
            $userArray['company_doc_url'] = $_REQUEST["docUrl"];
        }
       if(isset($_REQUEST['ac_type'])){
            if($_REQUEST['ac_type'] == "gmail"){
                $userArray['is_email_verified'] = "Yes";
            }
        }
        $sessionId = generateSession();
        $userArray["session_id"] = $sessionId;
        $userArray['name'] = $name;
        
        $user = $this->db->insert($this->table, $userArray);
        $id = $this->db->insert_id();
        if (!$user) {
            response(0, "Unable to get response", []);
        }
       // $userId = $this->db->insert_id();
        $user = $this->db->get_where($this->table, [$this->alias."_id" => $id])->first_row();
        $user->is_subscribed = $this->checkUserSub($id);
        response(1, "Successfully signned up", $user);
    }
    public function sendMailOtp(){
         if (!isset($_REQUEST['email']) || !isset($_REQUEST["user_id"])) {
            response(0, "Missing params", []);
        }
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        
        $email = $_REQUEST['email'];
        $user_id = $_REQUEST["user_id"];
        $code = rand(100000,999999);
        $users = $this->db->get_where($this->table,["user_id"=>$user_id])->result();
        if(count($users) != 1){
            response(0, "Invalid user", []);
        }
        $emailUsers = $this->db->query("select * from " . $this->table . " where email = '$email' and user_id != $user_id")->result();
            if(count($emailUsers) > 0){
                response(0, "Email is already in use try an other email", []);
            }
        
        $res = $this->db->update($this->table,["verification_code"=>$code],["user_id"=>$user_id]);
        if($res){
            $msg = "Your verification code for Shkalah is ".$code;
            $sub = "Account Verification";
            $this->Email_model->do_email($msg, $sub, $email, 'no-reply.shkalah.com');
            response(1, "Successfully signned up", ["otp_code"=>$code]);
        }else{
            response(0, "Cannot send email code", []);
        }
    }
    // public function 
    public function verify($userId,$phone = '',$type = 'phone'){
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        if (empty($userId)) {
            response(0, "Missing params", []);
        }
        $users = $this->db->get_where($this->table,["user_id"=>$userId])->result();
        if(count($users) != 1){
            response(0, "Invalid user", []);
        }
        // if($users[0]->phone != $phone){
            $emailUsers = $this->db->query("select * from " . $this->table . " where phone = '$phone' and user_id != $userId")->result();
            if(count($emailUsers) > 0){
                response(0, "Phone number is already in use try an other number", []);
            }
        // }
        $data['is_phone_verified'] = "Yes";
        
        if(!empty($phone)){
            $data['phone'] = $phone;
        }
        $res = $this->db->update($this->table,$data, [$this->alias."_id" => $userId]);
        if($res){
            $user = $this->db->get_where($this->table, [$this->alias."_id" => $userId])->first_row();
            $user->is_subscribed = $this->checkUserSub($userId);
            response(1, "Successfully verified", $user);
        }else{
             response(0, "Invalid verification attempt", []);
        }
    }
      public function verifyEmail(){
        $this->table = USER_TABLE;
        $this->alias = USER_ALS;
        if (!isset($_REQUEST['email']) || !isset($_REQUEST["user_id"])) {
            response(0, "Missing params", []);
        }
       
        $data['is_email_verified'] = "Yes";
        $userId = $_REQUEST["user_id"];
        $email = $_REQUEST['email'];
        // if(!empty($email)){
        $data['email'] = $email;
        // }
        $res = $this->db->update($this->table,$data, [$this->alias."_id" => $userId]);
        if($res){
            $user = $this->db->get_where($this->table, [$this->alias."_id" => $userId])->first_row();
            $user->is_subscribed = $this->checkUserSub($userId);
            response(1, "Successfully verified", $user);
        }else{
             response(0, "Invalid verification attempt", []);
        }
    }
    
    
    public function recharge_stripe(){
        if (!isset($_REQUEST['user']) || !isset($_REQUEST['token'])) {
            response(0, "Missing params", []);
        }
        $user_id = $_REQUEST['user'];
        $token = $_REQUEST['token'];
        $user = $this->db->get_where(USER_TABLE,["user_id"=>$user_id])->first_row();
        $stripe = $this->stripePayment($_REQUEST['token'],$user);
        if($stripe){
            if(isset($stripe['id'])){
                $data = [
                    "description"=>"Successful annual subscription",
                    "amount"=> $stripe['amount']/100,
                    "token" => $token,
                    "tr_id" => $stripe['id'],
                    "type" => "Stripe",
                    "user_id" => $user->user_id
                    ];
                $this->db->insert(TRANSACTION_TABLE,$data);
                $this->db->update(USER_TABLE,["sub_date"=>date('Y-m-d h:i:s'),"sub_exp_date"=>$this->oneYear()],["user_id"=>$user->user_id]);
                response(1, "Successfully verified", $stripe);
            }else{
                response(0, "Invalid verification attempt", []);
            }
            
        }else{
             response(0, "Invalid verification attempt", []);
        }
        
    }
    public function reset_password($type = ''){
        if($type == "check"){
            if (!isset($_REQUEST['phone']) || !isset($_REQUEST['code'])) {
                response(0, "Missing params", []);
            }
            $phone = $_REQUEST['code'] ."-". $_REQUEST['phone'];
            $phoneWithOutCode = $_REQUEST['phone'];
            $res = $this->db->query("select * from " . USER_TABLE . " where phone = '$phone' OR phone = '$phoneWithOutCode'")->result();
            if(count($res) > 0){
                $user = $res[0];
                response(1, "Success!", ["name"=>$user->name,"email"=>$user->email,"user_id"=>$user->user_id]);
            }else{
                response(0, "Cannot find number", []);
            }
            // $this->   
        }
        if (!isset($_REQUEST['user_id']) || !isset($_REQUEST['password'])) {
                response(0, "Missing params", []);
        }
        $user = $_REQUEST['user_id'];
        $password = md5($_REQUEST['password']);
        $res = $this->db->update(USER_TABLE , ["password"=>$password] , ['user_id'=>$user]);
        if($res){
            response(1, "Success!", []);
        }else{
             response(0, "Failed to reset password", []);
        }
        
        
        
    }
     public function recharge_paypal($type = 'simple'){
        if (!isset($_REQUEST['user']) || !isset($_REQUEST['token']) || !isset($_REQUEST['amount']) || !isset($_REQUEST['tr_id'])) {
            response(0, "Missing params", []);
        }
        $data = [];
        $data['user_id'] = $_REQUEST['user'];
        $data['token'] = $_REQUEST['token'];
        $data['amount'] = $_REQUEST['amount'];
        $data['tr_id'] = $_REQUEST['tr_id'];
        if($type == 'Individual'){
            $data['description'] = "Successful individual subscription";
        }else{
            $data['description'] = "Successful annual subscription";
        }
       
        $data['type'] = "Paypal";
        $this->db->insert(TRANSACTION_TABLE,$data);
        $tr_id = $this->db->insert_id();
        $user = $this->getUser($data['user_id']);
        // $stripe = $this->stripePayment($_REQUEST['token'],$user);
        if($user){
            if($type == 'Individual'){
                $this->db->update(USER_TABLE,["ind_post_count"=>1],["user_id"=>$user->user_id]);
            }else{
                $this->db->update(USER_TABLE,["sub_date"=>date('Y-m-d h:i:s'),"sub_exp_date"=>$this->oneYear()],["user_id"=>$user->user_id]);
            }
            $this->sendNotification($user->user_id,"Successfully payment","Your transaction have been made successfully tr_id is ".$tr_id,NOTIFY_IMGS."check.png","Single");
            
            $this->sendMail("Your transaction have been made successfully tr_id is ".$tr_id,"Successfully payment",$user->email);

            response(1, "Successfully verified", $user);
        }else{
             response(0, "Invalid verification attempt", []);
        }
        
    }
    public function recharge_fatora($type = 'simple'){
        if (!isset($_REQUEST['user']) || !isset($_REQUEST['token']) || !isset($_REQUEST['amount']) || !isset($_REQUEST['tr_id']) || !isset($_REQUEST['sub_type']) ) {
            response(0, "Missing params", []);
        }
        $data = [];
        $data['user_id'] = $_REQUEST['user'];
        $data['token'] = $_REQUEST['token'];
        $data['amount'] = $_REQUEST['amount'];
        $data['tr_id'] = $_REQUEST['tr_id'];
        $data['sub_type'] = $_REQUEST['sub_type'];
         if($type == 'Individual'){
            $data['description'] = "Successful individual subscription";
        }else{
            $data['description'] = "Successful annual subscription";
        }
        // $data['description'] = "Successful annual subscription";
        $data['type'] = "Fatora";
        $this->db->insert(TRANSACTION_TABLE,$data);
        $tr_id = $this->db->insert_id();
        $user = $this->getUser($data['user_id']);
        // $stripe = $this->stripePayment($_REQUEST['token'],$user);
        if($user){
            $subType = $_REQUEST['sub_type'];
            $expData = $this->oneYear();
            if($subType == 'sami_annual'){
                $expData = $this->samiYear();
            }
            if($type == 'Individual'){
                $this->db->update(USER_TABLE,["sub_date"=>date('Y-m-d h:i:s'),"sub_exp_date"=>$expData,"ind_post_count"=>1],["user_id"=>$user->user_id]);
            }else{
                $this->db->update(USER_TABLE,["sub_date"=>date('Y-m-d h:i:s'),"sub_exp_date"=>$expData],["user_id"=>$user->user_id]);
            }
            $this->sendNotification($user->user_id,"Successfully payment","Your transaction have been made successfully tr_id is ".$tr_id,NOTIFY_IMGS."check.png","Single");
            $this->sendMail("Your transaction have been made successfully tr_id is ".$tr_id,"Successfully payment",$user->email);

            response(1, "Successfully verified", $user);
        }else{
             response(0, "Invalid verification attempt", []);
        }
        
    }
    public function get_countries(){
        $countries = $this->db->get(COUNTRIES_TABLE)->result();
        response(1, "Successfully loaded", $countries);
    }
    public function uploadDoc(){
        if(!isset($_FILES['file'])){
            response(0,"File not found",[]);
        }
        if(!isset($_REQUEST['id'])){
            response(0,"Cannot find user to upload document",[]);
        }
        
        $res = $this->uploadDirFile($_FILES['file'],'documents');
        
         if($res){
             $id = $_REQUEST['id'];
             $dd = $this->db->update(USER_TABLE,['company_doc_url'=>$res],['user_id'=>$id]);
             if($dd){
                 response(1,"Success",["url"=>$res]);
             }else{
                 response(0,"Cannot upload cv",[]);
             }
         }
         return response(0,"Cannot upload document",[]);
    }
    
}
?>