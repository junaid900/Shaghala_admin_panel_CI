<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Favourite extends MJ_Controller
{   
    
      public function __construct()
    {
        $this->table = FAVOURITE_TABLE;
        $this->alias = FAVOURITE_ALS;
        parent::__construct();    
        
    }
     public function add(){
         
         if (!isset($_REQUEST['worker_id']) ||  
         !isset($_REQUEST['reference'])) {
            response(0, "Missing params", []);
        }
        $arr = array();
        $arr["worker_id"] = $_REQUEST['worker_id'];
        $arr["reference"] = $_REQUEST['reference'];
        $d = $this->db->get_where($this->table,$arr)->result();
        if(count($d) > 0){
            $res = $this->db->delete($this->table,$arr);
             if($res){
                response(1,"Successfully removed",$this->get_single($_REQUEST['reference']));
            }else{
                response(0,"Failed",[]);
            }
        }
        $res = $this->db->insert($this->table,$arr);
        if($res){
            $id = $this->db->insert_id();
            
            response(1,"Success",$this->get_single($_REQUEST['reference']));
        }else{
            response(0,"Failed",[]);
        }
     }
     public function get(){
        
        //  $data = $this->db->select('*')->from($this->table . " as a")->join(WORKER_TABLE . " as b",'worker_id' ,'=', 'worker_id')->get()->result();
        //  return response(1,"Success",$data);
    }
    public function get_by_ref($id){
        $data = $this->get_single($id);
        if($data){
             response(1,"Success",$data);
        }else{
            response(0,"Failed",[]);
        }
    }
    public function get_single($id){
          $this->db->select('*')->from($this->table . " as a")->join(WORKER_TABLE . " as b",'worker_id' ,'=', 'worker_id');
          $this->db->where("a.reference",$id);
          return $data = $this->db->get()->result();
        //  return response(1,"Success",$data);
    }
     public function company_worker($ref){
        
        $this->table = FAVOURITE_TABLE;
        $this->alias = FAVOURITE_ALS;
        // Need to implement select sub query
        $data = $this->db->query('Select * from ( select b.*,a.favourite_id,a.reference ,b.'.$this->language.
        '_name as lang_name,d.name as place_of_birth,f.name as place_of_living, (select count(reservation_id) from '.RESERVATION_TABLE.
        ' rr where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count from '.$this->table.
        ' as a left join '. WORKER_TABLE.' as b on a.worker_id = b.worker_id left join '.USER_TABLE.' as c on b.user_id = c.user_id'.
        ' LEFT JOIN '. COUNTRIES_TABLE .' as d on d.country_id = b.place_of_birth_id LEFT JOIN '.COUNTRIES_TABLE.
        ' as f ON f.country_id = b.place_of_living_id  where c.type = "Company" and a.reference="'. $ref.'" ) as x where x.reserved_count < 1  ')->result();

        //$this->db->select('*')->from($this->table . " as a")->join(WORKER_TABLE . " as b",'worker_id' ,'=', 'worker_id')->join(USER_TABLE . " as c",'user_id' ,'=', 'user_id');
        //$this->db->where('type','Company');
//        $data = ;//$this->db->get()->result();
        
         //echo $this->db->last_query();
        if($data){
        return response(1,"Success",$data);
        }else{
            
            return response(0,"Failed",[]);
        } 
    }
       public function ind_worker($ref){
        
        $this->table = FAVOURITE_TABLE;
        $this->alias = FAVOURITE_ALS;
        
        $data = $this->db->query('Select * from (select b.*,a.favourite_id,a.reference ,b.'.$this->language.
        '_name as lang_name,d.name as place_of_birth,f.name as place_of_living,(select count(reservation_id) from '.RESERVATION_TABLE.
        ' rr where worker_id = a.worker_id and status = "Active" and reserve_exp_date >= "'.date('Y-m-d h:i:s').'") as reserved_count from '.
        $this->table.' as a left join '. WORKER_TABLE.' as b on a.worker_id = b.worker_id left join '.USER_TABLE.' as c on b.user_id = c.user_id'.
        ' LEFT JOIN '. COUNTRIES_TABLE .' as d on d.country_id = b.place_of_birth_id LEFT JOIN '.COUNTRIES_TABLE.
        ' as f ON f.country_id = b.place_of_living_id  where c.type = "Individual" and a.reference="'. $ref.
        '" and b.is_deleted = 0 and b.admin_status = "Active") as x where x.reserved_count < 1')->result();

        
         //echo $this->db->last_query();
        if($data){
        return response(1,"Success",$data);
        }else{
            
            return response(0,"Failed",[]);
        } 
    }
}
?>
