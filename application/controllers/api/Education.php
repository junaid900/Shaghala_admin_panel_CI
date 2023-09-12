<?php
 class Education extends MJ_Controller{
     
       public function __construct()
    {
         $this->table = EDUCATION_TABLE;
         $this->alias = EDUCATION_ALS;
        parent::__construct();    
        
    }

     /*****  INDEX *********/
    
     public function index(){
        echo EDUCATION_TABLE . EDUCATION_ALS;
        exit;
     }
 }
?>