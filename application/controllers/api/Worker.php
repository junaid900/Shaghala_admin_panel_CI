<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Worker extends MJ_Controller
{    
    
    public $religion;
    
      public function __construct()
    {
        $this->table = WORKER_TABLE;
        $this->alias = WORKER_ALS;
        parent::__construct();    
        $this->religion = [
                "Muslim",
                "Cristian",
                "Jew",
                "Hindu",
                "Other"
              ];
        
    }

    /*****  INDEX *********/
    
     public function index(){
        echo WORKER_TABLE . WORKER_ALS;
        exit;
     }
     public function getSingle($id){
         return $this->db->get_where($this->table, ["worker_id"=>$id])->first_row();
     }
   
    public function add(){
         if (!isset($_REQUEST['user_id'])) {
            response(0, "Missing params", []);
        }
        $arr = array();
        if(isset($_REQUEST['image'])){
            $arr["image"] = $this->uploadDirBase64Image($_REQUEST['image'],"worker");
        }
        if(isset($_REQUEST['en_name'])){
            $arr["en_name"] = $_REQUEST['en_name'];
        }
        if(isset($_REQUEST['ar_name'])){
            $arr["ar_name"] = $_REQUEST['ar_name'];
        }
        if(isset($_REQUEST['phone'])){
            $arr["phone"] = $_REQUEST['phone'];
        }
        if(isset($_REQUEST['en_religion'])){
            $arr["en_religion"] = $_REQUEST['en_religion'];
        }
        if(isset($_REQUEST['ar_religion'])){
            $arr["ar_religion"] = $_REQUEST['ar_religion'];
        }
        if(isset($_REQUEST['arabic_level'])){
            $arr["arabic_level"] = $_REQUEST['arabic_level'];
        }
        if(isset($_REQUEST['age'])){
            $arr["age"] = $_REQUEST['age'];
        }
        if(isset($_REQUEST['is_married'])){
            $arr["is_married"] = $_REQUEST['is_married'];
        }
        if(isset($_REQUEST['have_childs'])){
            $arr["have_childs"] = $_REQUEST['have_childs'];
        }
        if(isset($_REQUEST['no_of_childs'])){
            $arr["no_of_childs"] = $_REQUEST['no_of_childs'];
        }
        if(isset($_REQUEST['experience'])){
            $arr["experience"] = $_REQUEST['experience'];
        }
        if(isset($_REQUEST['edu_id'])){
            $arr["edu_id"] = $_REQUEST['edu_id'];
        }
        if(isset($_REQUEST['skin_color'])){
            $arr["skin_color"] = $_REQUEST['skin_color'];
        }
        if(isset($_REQUEST['height'])){
            $arr["height"] = $_REQUEST['height'];
        }
        if(isset($_REQUEST['weight'])){
            $arr["weight"] = $_REQUEST['weight'];
        }
        if(isset($_REQUEST['salary'])){
            $arr["salary"] = $_REQUEST['salary'];
        }
        if(isset($_REQUEST['place_of_birth_id'])){
            $arr["place_of_birth_id"] = $_REQUEST['place_of_birth_id'];
        }
        if(isset($_REQUEST['place_of_living_id'])){
            $arr["place_of_living_id"] = $_REQUEST['place_of_living_id'];
        }
        if(isset($_REQUEST['skill_id'])){
            $arr["skill_id"] = $_REQUEST['skill_id'];
        }
        if(isset($_REQUEST['remarks'])){
            $arr["remarks"] = $_REQUEST['remarks'];
        }
        if(isset($_REQUEST['advs_type'])){
            $arr["advs_type"] = $_REQUEST['advs_type'];
        }
        if(isset($_REQUEST['cv'])){
            $arr["cv"] = $_REQUEST['cv'];
        }
        if(isset($_REQUEST['position'])){
            $arr["position"] = $_REQUEST['position'];
        }
        if(isset($_REQUEST['is_featured'])){
            $arr["is_featured"] = $_REQUEST['is_featured'];
        }
        if(isset($_REQUEST['status'])){
            $arr["status"] = $_REQUEST['status'];
        }
         if(isset($_REQUEST['user_id'])){
            $arr["user_id"] = $_REQUEST['user_id'];
        }
       
        $user = $this->db->get_where(USER_TABLE,["user_id"=>$_REQUEST['user_id']])->first_row();
        //  if(!$this->checkUserSub($_REQUEST['user_id']) && $user->type == 'Company'){
        //     response(4,"Please subscribe and try to publish ad again",[]);
        // }
        if($user->type == "Individual"){
            if($user->ind_post_count < 1){
                 response(0,"Need subscription before posting",[]);
            }
            // $user = $this->db->get_where($this->table,["user_id"=>$_REQUEST['user_id'],"is_deleted"=>0])->result();
            $workers = $this->db->get_where($this->table,["user_id"=>$_REQUEST['user_id'],"is_deleted"=>0])->result();
            if(count($workers) > 0){
                response(0,"with individual account you can only add one ad",[]);
            }
        }
        
        $res = $this->db->insert($this->table,$arr);
        if($res){
            $id = $this->db->insert_id();
            if($user->type == "Individual"){
                // $this->db->update(USER_TABLE,["ind_post_count"=>0],["user_id"=>$_REQUEST['user_id']]);
            }
            response(1,"Success",$this->getSingle($id));
        }else{
            response(0,"Failed",[]);
        }
        
        
        
    }
     public function edit(){
         
        if(!isset($_REQUEST['worker_id'])){
            response(0, "missing params", []);
        }
        $id = $_REQUEST['worker_id'];
        $arr = array();
        if(!empty($_REQUEST['image'])){
            $arr["image"] = $this->uploadDirBase64Image($_REQUEST['image'],"worker");
        }
        if(isset($_REQUEST['en_name'])){
            $arr["en_name"] = $_REQUEST['en_name'];
        }
        if(isset($_REQUEST['ar_name'])){
            $arr["ar_name"] = $_REQUEST['ar_name'];
        }
        if(isset($_REQUEST['phone'])){
            $arr["phone"] = $_REQUEST['phone'];
        }
        if(isset($_REQUEST['en_religion'])){
            $arr["en_religion"] = $_REQUEST['en_religion'];
        }
        if(isset($_REQUEST['ar_religion'])){
            $arr["ar_religion"] = $_REQUEST['ar_religion'];
        }
        if(isset($_REQUEST['arabic_level'])){
            $arr["arabic_level"] = $_REQUEST['arabic_level'];
        }
        if(isset($_REQUEST['age'])){
            $arr["age"] = $_REQUEST['age'];
        }
        if(isset($_REQUEST['is_married'])){
            $arr["is_married"] = $_REQUEST['is_married'];
        }
        if(isset($_REQUEST['have_childs'])){
            $arr["have_childs"] = $_REQUEST['have_childs'];
        }
        if(isset($_REQUEST['no_of_childs'])){
            $arr["no_of_childs"] = $_REQUEST['no_of_childs'];
        }
        if(isset($_REQUEST['experience'])){
            $arr["experience"] = $_REQUEST['experience'];
        }
        if(isset($_REQUEST['edu_id'])){
            $arr["edu_id"] = $_REQUEST['edu_id'];
        }
        if(isset($_REQUEST['skin_color'])){
            $arr["skin_color"] = $_REQUEST['skin_color'];
        }
        if(isset($_REQUEST['height'])){
            $arr["height"] = $_REQUEST['height'];
        }
        if(isset($_REQUEST['weight'])){
            $arr["weight"] = $_REQUEST['weight'];
        }
        if(isset($_REQUEST['salary'])){
            $arr["salary"] = $_REQUEST['salary'];
        }
        if(isset($_REQUEST['place_of_birth_id'])){
            $arr["place_of_birth_id"] = $_REQUEST['place_of_birth_id'];
        }
        if(isset($_REQUEST['place_of_living_id'])){
            $arr["place_of_living_id"] = $_REQUEST['place_of_living_id'];
        }
        if(isset($_REQUEST['skill_id'])){
            $arr["skill_id"] = $_REQUEST['skill_id'];
        }
        if(isset($_REQUEST['remarks'])){
            $arr["remarks"] = $_REQUEST['remarks'];
        }
        if(isset($_REQUEST['advs_type'])){
            $arr["advs_type"] = $_REQUEST['advs_type'];
        }
        if(isset($_REQUEST['cv'])){
            $arr["cv"] = $_REQUEST['cv'];
        }
        if(isset($_REQUEST['position'])){
            $arr["position"] = $_REQUEST['position'];
        }
        
        if(isset($_REQUEST['is_featured'])){
            $arr["is_featured"] = $_REQUEST['is_featured'];
        }
        if(isset($_REQUEST['status'])){
            $arr["status"] = $_REQUEST['status'];
        }
        if(isset($_REQUEST['user_id'])){
            $arr["user_id"] = $_REQUEST['user_id'];
        }
        $res = $this->db->update($this->table,$arr,[$this->alias."_id"=>$id]);
        if($res){
            response(1,"Success",$this->getSingle($id));
        }else{
            response(0,"Failed",[]);
        }
     }
      public function active($id,$status){
         $res = $this->db->update($this->table , ["status" => $status], [$this->alias . "_id"=>$id]);
         if($res){
             response(1,"Success",[]);
         }else{
             response(0,"Failed",[]);
         }
     }
     public function get_info(){
         
          $data["countries"] = $this->db->get_where(COUNTRIES_TABLE , ["status"=>"Active"])->result();
          $data["education"] = $this->db->get_where(EDUCATION_TABLE , ["status"=>"Active"])->result();
          $data["skills"] = $this->db->get_where(SKILL_TABLE , ["status"=>"Active"])->result();
          $data["religion"] = $this->religion;
          if($data){
         return response(1,"Success",$data);
          }
         else{
             response(0,"Failed",[]);
         }
     }
     public function uploadCv(){
        // //  print_r($_FILES);
        // //  print_r($_POST);
        // //  print_r($_REQUEST);
        //  print_r($this->input->get_post('name'));
        if(!isset($_FILES['file'])){
            response(0,"File not found",[]);
        }
        if(!isset($_REQUEST['id'])){
            response(0,"Cannot find worker to upload cv",[]);
        }
        
        $res = $this->uploadDirFile($_FILES['file'],'cv');
        
         if($res){
             $id = $_REQUEST['id'];
             $dd = $this->db->update(WORKER_TABLE,['cv'=>$res],['worker_id'=>$id]);
             if($dd){
                 response(1,"Success",["data"=>$res]);
             }else{
                 response(0,"Cannot upload cv",[]);
             }
         }
         return response(1,"Success",["user"=>$res]);
     }
       public function worker_data($advs_type){
         
           $this->table = WORKER_TABLE;
           $this->alias = WORKER_ALS;
           
           $data = $this->db->query('select *,a.'.$this->language.'_name as lang_name,b.name as place_of_birth,c.name as place_of_living  from '.$this->table.
           ' as a '.' LEFT JOIN '. COUNTRIES_TABLE .' as b on b.country_id = a.place_of_birth_id LEFT JOIN '.COUNTRIES_TABLE.
           ' as c ON c.country_id = a.place_of_living_id where a.advs_type = "'. $advs_type.'" and a.is_deleted = 0')->result();
           if($data){
               return response(1,"Success",$data);
                    }else{
            
                   return response(0,"Failed",[]);
              }
        
    //      $this->db->select('*')->from($this->table);
    //      $this->db->where("advs_type",$advs_type);
    //      return $data = $this->db->get()->result();
    // //     // $data = $this->db->select('*')->from($this->table . " as a")->join(USER_TABLE . " as b",'user_id' ,'=', 'user_id')->get()->result();
    //       return response(1,"Success",$data);
      }
      
       public function get_worker_by_user($id){
         
           $this->table = WORKER_TABLE;
           $this->alias = WORKER_ALS;
           
           $data = $this->db->query('select *,a.'.$this->language.
           '_name as lang_name,c.name as place_of_birth,d.name as place_of_living'.
           ',a.admin_status as admin_status, a.en_name as en_name, a.ar_name as ar_name,a.phone as phone,(select count(reservation_id) from '
           .RESERVATION_TABLE.' where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count  from '
           .$this->table.' as a left join '. USER_TABLE.' as b on a.user_id = b.user_id '.' LEFT JOIN '. COUNTRIES_TABLE .
           ' as c on c.country_id = a.place_of_birth_id LEFT JOIN '
           .COUNTRIES_TABLE.' as d ON d.country_id = a.place_of_living_id where a.user_id = "'. $id.'" and a.is_deleted = 0 ')->result();
           if($data){
                return response(1,"Success",$data);
            }else{
                return response(0,"Failed",[]);
            }
      }
     public function get_by_company($company_id){
          $this->table = WORKER_TABLE;
           $this->alias = WORKER_ALS;
        if(!isset($_REQUEST['id'])){
            response(0,"missing params",[]);
        }
       
        $ref = $_REQUEST['id'];
         $data = $this->db->select('a.*,c.name as place_of_birth,d.name as place_of_living, a.'.$this->language.'_name as lang_name,(select count(favourite_id) from '
        .FAVOURITE_TABLE.' where reference="'.$ref.'" and worker_id = a.worker_id ) as fav,(select count(reservation_id) from '.RESERVATION_TABLE.
        ' where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count')
        ->from($this->table . " as a")->join(USER_TABLE . " as b",'a.user_id' .'='. 'b.user_id','left')
        ->join(COUNTRIES_TABLE . " as c","c.country_id" . " = ". "a.place_of_birth_id",'left')->
        join(COUNTRIES_TABLE . " as d","d.country_id" ." = ". "a.place_of_living_id",'left')
        // ->where("a.advs_type","$type")
        // ->where("b.type","$account_type")
        ->where('a.admin_status',"Active")
        ->where('a.status','Active')
        ->where('a.is_deleted',0)
        ->where('a.user_id',$company_id);
         
         $sub_query = $this->db->get_compiled_select();
         $this->db->select("*")->from("($sub_query) as x")->where("x.reserved_count < 1");
         $data = $this->db->get()->result();
         if($data)
         return response(1,"Success",$data);
         else
         response(1,"No data found",[]);
    }
    public function get_by_adv_type($type, $ac_type){
          $this->table = WORKER_TABLE;
           $this->alias = WORKER_ALS;
        if(!isset($_REQUEST['id'])){
            response(0,"missing params",[]);
        }
        $account_type = "Individual";
        if($ac_type == "company"){
         $account_type = "Company";   
        }
        $ref = $_REQUEST['id'];
         $this->db->select('a.*,c.name as place_of_birth,d.name as place_of_living, a.'.$this->language.'_name as lang_name,(select count(favourite_id) from '
        .FAVOURITE_TABLE.' where reference="'.$ref.'" and worker_id = a.worker_id ) as fav,(select count(reservation_id) from '.RESERVATION_TABLE.
        ' where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count')
        ->from($this->table . " as a")->join(USER_TABLE . " as b",'a.user_id' .'='. 'b.user_id','left')
        ->join(COUNTRIES_TABLE . " as c","c.country_id" . " = ". "a.place_of_birth_id",'left')->
        join(COUNTRIES_TABLE . " as d","d.country_id" ." = ". "a.place_of_living_id",'left')
        ->where("a.advs_type","$type")
        ->where("b.type","$account_type")
        ->where('a.admin_status',"Active")
        ->where('a.status','Active')
        ->where('a.is_deleted',0);
         
         $sub_query = $this->db->get_compiled_select();
         $this->db->select("*")->from("($sub_query) as x")->where("x.reserved_count < 1");
         $data = $this->db->get()->result();
         
         if($data)
         return response(1,"Success",$data);
         else
         response(1,"No data found",[]);
    }
      
    public function get_all_workers(){
        
           $this->table = WORKER_TABLE;
           $this->alias = WORKER_ALS;
        if(!isset($_REQUEST['id'])){
            response(0,"missing params",[]);
        }
        $ref = $_REQUEST['id'];
         $this->db->select('a.*,c.name as place_of_birth,d.name as place_of_living, a.'.$this->language.'_name as lang_name,(select count(favourite_id) from '
        .FAVOURITE_TABLE.' where reference="'.$ref.'" and worker_id = a.worker_id ) as fav,(select count(reservation_id) from '.RESERVATION_TABLE.
        ' where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count')
        ->from($this->table . " as a")->join(USER_TABLE . " as b",'a.user_id' .'='. 'b.user_id','left')
        ->join(COUNTRIES_TABLE . " as c","c.country_id" . " = ". "a.place_of_birth_id",'left')->
        join(COUNTRIES_TABLE . " as d","d.country_id" ." = ". "a.place_of_living_id",'left')
        ->where('a.admin_status',"Active")
        ->where('a.status','Active')
        ->where('a.is_deleted',0);
         $sub_query = $this->db->get_compiled_select();
         $this->db->select("*")->from("($sub_query) as x")->where("x.reserved_count < 1");
         $data = $this->db->get()->result();
         if($data)
         return response(1,"Success",$data);
         else
         response(1,"No data found",[]);
    }
    
    
     public function details($id){
         
           $this->table = WORKER_TABLE;
           $this->alias = WORKER_ALS;
          // select *,a.'.$this->language.'_name as lang_name,c.name as place_of_birth,d.name as place_of_living,a.admin_status as admin_status, a.en_name as en_name, a.ar_name as ar_name,a.phone as phone
           $data = $this->db->query('select *,a.'.$this->language.'_name as lang_name,f.'.$this->language.
           '_degree as lang_degree,c.name as place_of_birth,d.name as place_of_living, a.en_name as en_name, a.ar_name as ar_name,a.phone as phone,(select count(reservation_id) from '
           .RESERVATION_TABLE.
        ' where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count  from '.$this->table.
           ' as a left join '. USER_TABLE.' as b on a.user_id = b.user_id '.' LEFT JOIN '. COUNTRIES_TABLE .
           ' as c on c.country_id = a.place_of_birth_id LEFT JOIN '.COUNTRIES_TABLE.
           ' as d ON d.country_id = a.place_of_living_id LEFT JOIN '.EDUCATION_TABLE.
           ' as f ON f.edu_id = a.edu_id where a.is_deleted = 0 and a.worker_id="'. $id.'"')->row();
           
           if($data){
               return response(1,"Success",$data);
                    }else{
            
                   return response(0,"Failed",[]);
              }
      }
      public function getFilterData(){
          $data["countries"] = $this->db->get(COUNTRIES_TABLE)->result();
          $data["religion"] = $this->religion;
      }
      public function filter(){
          $condition = "where a.is_deleted = 0 AND a.admin_status = 'Active' And a.status = 'Active' ";
          $orderBy = '';
           if(!isset($_REQUEST['id'])){
            response(0,"missing params",[]);
            }
            $ref = $_REQUEST['id'];
            
        if(isset($_REQUEST['type'])){
            $type = '';
            if($_REQUEST['type'] == 'indiv'){
                $type = 'Individual';
            }else{
                $type = 'Company';
            }
            if(!empty($type)) $condition .= " and b.type = '$type'";
        }   
        if(isset($_REQUEST['ac_type'])){
             $type_id = $_REQUEST['ac_type'];
             $condition .= " and b.type_id = $type_id";
        }
        
          if(isset($_REQUEST['query'])){
              $query = $_REQUEST['query'];
              $condition .= " and (a.en_name LIKE '%$query%' or a.ar_name LIKE '%$query%' or a.en_religion LIKE '%$query%')";
          }
          if(isset($_REQUEST['country'])){
              $country = $_REQUEST['country'];
              $condition .= " and place_of_living_id = $country";
          }
          if(isset($_REQUEST['age'])){
              $ages = explode(' - ',$_REQUEST['age']);
              if(count($ages) > 1){
                $condition .= " and (age >= ".$ages[0]." and age <= ".$ages[1].")";
              }
          }
        if(isset($_REQUEST['religion'])){
            $religion = $_REQUEST['religion'];
            $condition .= " and en_religion = '$religion'";
        }
        if(isset($_REQUEST['salaryFrom']) && isset($_REQUEST['salaryTo'])){
            $salaryFrom = $_REQUEST['salaryFrom'];
            $salaryTo = $_REQUEST['salaryTo'];
            $condition .= " and salary >= $salaryFrom and salary <= $salaryTo";
        }
        
         if(isset($_REQUEST['sort_by'])){
             $sby = $_REQUEST['sort_by'];
             $oby =  isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "ASC";
             if($sby == 'age'){
                 $orderBy = "order by a.age";
             }
             if($sby == 'salary'){
                 $orderBy = "order by a.salary";
             }
             if($sby == 'country_id'){
                 $orderBy = "order by d.name";
             }
            if($sby == 'advs_type'){
                 $orderBy = "order by d.advs_type";
             }
            if($sby == 'name'){
                 $orderBy = "order by a.".$this->language."_name";
            }
            if($sby == 'created_at'){
                 $orderBy = "order by a.worker_created_at";
            }
            $orderBy .= " ".$oby;
         }
        
          
          $data = $this->db->query('SELECT * FROM (SELECT a.*,c.name as place_of_birth,d.name as place_of_living, a.'.$this->language.'_name as lang_name,(select count(favourite_id) from '
        .FAVOURITE_TABLE.' where reference="'.$ref.'" and worker_id = a.worker_id ) as fav,(select count(reservation_id) from '.RESERVATION_TABLE.
        ' where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count  from '.$this->table.
           ' as a left join '. USER_TABLE.' as b on a.user_id = b.user_id '.' LEFT JOIN '. COUNTRIES_TABLE .
           ' as c on c.country_id = a.place_of_birth_id LEFT JOIN '.COUNTRIES_TABLE.
           ' as d ON d.country_id = a.place_of_living_id LEFT JOIN '.SKILL_TABLE.
           ' as e ON e.skill_id = a.skill_id LEFT JOIN '.EDUCATION_TABLE.
           ' as f ON f.edu_id = a.edu_id '.$condition. " $orderBy ) as x where x.reserved_count < 1")->result();
          if($data){
               return response(1,"Success",$data);
            }else{
                   return response(0,"No data found",[]);
            }
      }
      
      public function delete($id){
          $res = $this->db->update($this->table ,["is_deleted"=>1], [$this->alias."_id"=>$id]);
          if($res){
              return response(1,"Success",[]);
          }else{
              return response(0,"Failed",[]);
          }
      }
   
     
}
?>