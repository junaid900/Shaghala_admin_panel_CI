<?php
  class Skill extends MJ_Controller{
      
        public function __construct()
    {
         $this->table = SKILL_TABLE;
         $this->alias = SKILL_ALS;
        parent::__construct();    
        
    }

     /*****  INDEX *********/
    
     public function index(){
        echo SKILL_TABLE . SKILL_ALS;
        exit;
     }
   

     
     
    
    
} 
?>