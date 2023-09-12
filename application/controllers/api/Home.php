<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MJ_Controller
{   
    
      public function __construct()
    {
        parent::__construct();    
    }
    public function Indi_worker(){
        
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
        join(COUNTRIES_TABLE . " as d","d.country_id" ." = ". "a.place_of_living_id",'left');
        $this->db->where('type','Individual');
        $this->db->where('a.admin_status', 'Active');
        $this->db->where('a.is_deleted',0);
        if(isset($_REQUEST['type'])){
            if(!empty($_REQUEST['type'])){
                $this->db->where("advs_type",$_REQUEST['type']);
            }
        }
        $sub_query = $this->db->get_compiled_select();
        $this->db->select("*")->from("($sub_query) as x")->where("x.reserved_count < 1");
        $data = $this->db->get()->result();
        // echo $this->db->last_query();
        if($data){
             return response(1,"Success",$data);
        }else{
            
            return response(1,"No workers data found",[]);
        } 
    }
  
     public function comp_worker(){
        
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
        join(COUNTRIES_TABLE . " as d","d.country_id" ." = ". "a.place_of_living_id",'left');
        $this->db->where('type','Company');
        $this->db->where('a.admin_status', 'Active');
        //  $this->db->where('reserved_count <', '1');
        $this->db->where('a.is_deleted',0);
        if(isset($_REQUEST['type'])){
            if(!empty($_REQUEST['type'])){
                $this->db->where("advs_type",$_REQUEST['type']);
            }
        }
        $sub_query = $this->db->get_compiled_select();
        $this->db->select("*")->from("($sub_query) as x")->where("x.reserved_count < 1");

        
         
        $data = $this->db->get()->result();
        // echo $this->db->last_query();
        if($data){
        return response(1,"Success",$data);
    }else{
        
        return response(1,"No company workers data found",[]);
    } 
    }
}
?>