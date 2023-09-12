<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends MJ_Controller
{   
    
      public function __construct()
    {
        parent::__construct();    
        
    }
     public function home_slider(){
        
        $this->table = SLIDER_TABLE;
        $this->alias = SLIDER_ALS;
        
        $data = $this->db->get_where($this->table,["status"=>"Active"])->result();
        if($data){
            return response(1,"Success",$data);
        }else{
            return response(0,"Failed",[]);
        }
    }
}
?>