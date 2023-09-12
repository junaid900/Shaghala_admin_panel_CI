<?php
require_once __DIR__ . '/stripe/vendor/autoload.php';
// require_once __DIR__ . '/../Config.php';
class MJ_Controller extends MJ_Fire_Controller{
  public $language = 'en';
    public $offset = '0';
    public $limit = '1000';
    public $table = '';
    public $alias = '';
    public $orderBy = NULL;
    public $app_setting;
   public function __construct(){
        // print_r($_FILES);
        parent::__construct();
        $this->app_setting = [];
        // echo PHP_VERSION;        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, *');     
        $this->output->set_header('Content-Type : application/json; charset=UTF-8');
        
        $postdata = file_get_contents("php://input"); 
        // print_r($postdata);
         if (isset($postdata)) {
            //   print_r($postdata);
            if (!empty($postdata)) {
                // echo "here";
                $post_data = json_decode($postdata, true);
                //  print_r($post_data);
                $_REQUEST = $post_data;
//                  print_r($_REQUEST);
            }
        }
        
        // print_r($_REQUEST);
        
        if($_REQUEST == null){
            $_REQUEST = [];
        }
        if(count($_POST) > 0){
            // array_push($_REQUEST,$_POST);
            foreach($_POST as $k => $v){
                $_REQUEST[$k] = $v;
            }
        }

        if(count($_GET) > 0){
            foreach($_GET as $k => $v){
                $_REQUEST[$k] = $v;
            }
        }
      
        if (isset($_POST["lang"])) {
            $this->language = $_POST["lang"];
        }
        if (isset($_GET["lang"])) {
            $this->language = $_GET["lang"];
        }
        if (isset($_REQUEST["lang"])) {
            $this->language = $_REQUEST["lang"];
        }
        
        if (isset($_REQUEST["limit"])) {
            $this->limit = $_REQUEST["limit"];
        }
        if (isset($_REQUEST["offset"])) {
            $this->offset = $_REQUEST["offset"];
        }
          if (isset($_REQUEST["order_by"])) {
            $this->orderBy = $_REQUEST["order_by"];
        }
        $settingResponse = $this->db->get(SYSTEM_SETTINGS_TABLE)->result();
        foreach($settingResponse as $setting){
            $this->app_setting[$setting->type] = $setting->description;    
        }
        // print_r($this->app_setting);
        // public $limit = '10';
    }
     public function sendNotification($receiver_id,$title,$message,$image,$type = 'Single',$data = []){
        $click = '';
        if(isset($data['click'])){
            $click = $data['click'];
        }
        $this->db->insert(NOTIFICATION_TABLE,[
            "receiver_id"=>$receiver_id,
            "notification_title"=>$title,
            "description"=>$message,
            "image"=>$image,
            "type"=>$type,
            "data"=> json_encode($data),
            ]);
        if($type != "Admin"){
            $ref = $this->database
            ->getReference("notification/$receiver_id");
            $values = $ref->getValue();
            // print_r($values);
            if(!empty($values)){
                $count = $values['count'];
                $ref->set([
                    'count' => $count+1,
                ]);
            }else{
                $ref->set([
                    'count' => 1,
                ]);
            }
        }else{
            $ref = $this->database
            ->getReference("notification/admin");
            $values = $ref->getValue();
            // print_r($values);
            if(!empty($values)){
                $count = $values['count'];
                $ref->set([
                    'count' => $count+1,
                ]);
            }else{
                $ref->set([
                    'count' => 1,
                ]);
            }
        }
    }
    public function sendMail($message,$sub,$email){
        // $email = "junaidaliansaree@gmail.com";
        if(!empty($email))
            $this->Email_model->do_email("<div>".$message."</div>", $sub, $email);
    }
   
       public function get(){
        $this->db->limit($this->limit,$this->offset);
        if($this->orderBy){
            $this->db->order_by($this->alias."_id",$this->orderBy);
        }
        // $this->db->join("categ");
         $data = $this->db->get($this->table)->result();
         return response(1,"Success",$data);
    }
    public function get_with_status(){
       $this->db->limit($this->limit,$this->offset);
        // $this->db->join("categ");
        if($this->orderBy){
            $this->db->order_by($this->alias."_id",$this->orderBy);
        }
         $data = $this->db->get_where($this->table,["status"=>"Active"])->result();
         return response(1,"Success",$data);
    }
    public function return_with_id($id){
        return $this->db->get_where($this->table , [$this->alias."_id" => $id])->result();
    }
    public function return_all(){
        $this->db->limit(2000);
        if($this->orderBy){
            $this->db->order_by($this->alias."_id",$this->orderBy);
        }
        return $this->db->get($this->table)->result();
    }
    public function getOne($tbl, $key,$val){ 
        return $this->db->get_where($tbl,[$key=>$val])->first_row();
    }
    public function uploadDirBase64Image($img,$dir){
       
        // $img = $_REQUEST['img'];
        $data = base64_decode($img);
        $file = "uploads/$dir/" . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        if($success)
        return $file;
        else
        return NULL;
    }
    public function stripePayment($token,$user){
        try{
            // echo $this->app_setting['stripe_secret_key'];
        \Stripe\Stripe::setApiKey($this->app_setting['stripe_secret_key']);

       $customer = \Stripe\Customer::create(array(
            'name' => $user->username,
            'description' => 'subscription plan bought',
            'email' => $user->email,
            'source' => $token,
            "address" => ["city" => "hyd", "country" => "india", "line1" => "adsafd werew", "postal_code" => "500090", "state" => "telangana"]
        ));
       
        $response = $charge = \Stripe\Charge::create([
        'customer' => $customer->id, 
          'amount' => $this->app_setting['sub_amount'] * 100,
          'currency' => 'inr',
          'description' => 'subscription plan charge',
        ]);
        return $response;
        }catch(Exception $e){
            // echo $e->getMessage();
            response(0,$e->getMessage(),[]);
            exit();
        }
    }
     public function uploadDirFile($file,$dir){
        $data = $file;
        $fileUrl = "uploads/$dir/" . uniqid() . $file['name'];
        $mfile = $file['tmp_name'];
        if(move_uploaded_file($mfile,$fileUrl)){
            return $fileUrl;
        }else{
            return $success;
        }
    }
    public function checkUserSub($user_id){
        $user = $this->db->get_where(USER_TABLE,["user_id"=>$user_id])->first_row();
        if(is_null($user->sub_exp_date)){
            return false;
        }
        if(date('Y-m-d h:i:s') > $user->sub_exp_date){
            return false;
        }else{
            return true;
        }
    }
    public function oneYear(){
        return $oneYearLaterFromNow = date('Y-m-d h:i:s', strtotime('+1 year'));
    }
    public function samiYear(){
        return $oneYearLaterFromNow = date('Y-m-d h:i:s', strtotime('+6 month'));
    }
    public function reserveExpDate(){
        $days = $this->app_setting['reservation_days'];
        return $oneYearLaterFromNow = date('Y-m-d h:i:s', strtotime("+$days days"));
    }
    public function checkReservation($reservation_id){
        $reserve = $this->db->get_where(RESERVATION_TABLE,["reservation_id"=>$reservation_id])->first_row();
        if(is_null($reserve->reserve_exp_date)){
            return false;
        }
        if(date('Y-m-d h:i:s') > $reserve->reserve_exp_date){
            return false;
        }else{
            return true;
        }
    }
    public function getUser($id){
        $user = $this->db->get_where(USER_TABLE, [USER_ALS."_id"=>$id])->first_row();
        $user->is_subscribed = $this->checkUserSub($id);
        return $user;
    }
    
    
    
    
    
    
    
    
    
    
    
}
?>