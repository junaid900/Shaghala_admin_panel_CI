<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $app_setting;
    public function __construct()
    {
        
        parent::__construct();
        $this->load->library('session');
        
        $userData = ["directory" => "madmin"];
        $this->session->set_userdata($userData);
        // echo "<span style='display:none'>here</span>";
        $settingResponse = $this->db->get(SYSTEM_SETTINGS_TABLE)->result();
        foreach($settingResponse as $setting){
            $this->app_setting[$setting->type] = $setting->description;    
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
    public function manage_complain(){
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        } 
        $data['complain_data'] = $this->db->query("Select a.*,b.dept_name,c.name from " . COMPLAIN_TABLE . " a left join ".DEPARTMENT_TABLE." b ON b.dept_id = a.dept_id left join ".USER_TABLE." c on c.user_id = a.user_id order by a.complain_id DESC")->result_array();
        $data['page_title'] = get_phrase('manage_complain');
        $data['page_sub_title'] = get_phrase('manage_complain');
        $data['page_name'] = 'manage_complain';
        $data['actor'] = 'manage_complain';
        $data['main_page_name'] = 'manage_complain';
        $data["htmlPage"] = "manage_complain";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    

    /***** ADMIN INDEX *********/
    public function index()
    {
        if ($this->session->userdata('login') == 1) {
            redirect(base_url().admin_ctrl(). '/dashboard', 'refresh');
        }
        $this->load->view('madmin/login');
    }
    /***** ADMIN INDEX *********/
    /* VERIFY ACCOUNT */
    public function login()
    {
        // Validate the user can login
        $result = $this->Db_model->login_varify_accounts();
       
        if ($result) {
            if ($result->status == 'Inactive') {
//                echo "here";
//                exit();
                $this->session->set_flashdata('msg_error', 'your account is Inactive!');
                redirect(base_url() .admin_ctrl(), 'refresh');
            }
        
            $this->session->set_userdata('user_name', $result->name);
            $this->session->set_userdata('users_id', $result->user_id);
            $this->session->set_userdata('users_email', $result->email);
            $this->session->set_userdata('user_roles_id', $result->users_roles_id);
            $this->session->set_userdata('directory', 'madmin');
            $this->session->set_userdata('login', 1);
            $this->session->set_flashdata('msg_success', 'Login Successfully.');
            redirect(base_url() .admin_ctrl(). '/dashboard', 'refresh');
        } else {

            $this->session->set_flashdata('msg_error', 'Email or password not correct!');
            redirect(base_url() .admin_ctrl(), 'refresh');
        }
    }


    public function forgot_password()
    {
        $this->load->view('admin/forgot_password');
    }

    public function CheckEmail($param1 = '', $param2 = '')
    {
        $email = $this->input->post('email');
        $db_val = $this->db->get_where('brinkman_user_accounts', array('email' => $email))->num_rows();
        if ($db_val > 0) {
            echo 'email already exist';
        } else {
            echo 'notexist';
        }
        exit;
    }

    public function retrieve_password($param1 = '', $param2 = '')
    {
        $user_email = $this->input->post('retrive_email');
        $response = $this->Db_model->retrieve_password($user_email);
        if ($response == 'Mail Sent') {
            $this->session->set_flashdata('msg_success', ' Password Reset Link Sent To Your Email Successfully');
        } else if ($response == 'Mail Not Sent') {
            $this->session->set_flashdata('msg_error', ' Error In Sending Mail. Try Again.');
        } else if ($response == 'Email Not Found') {
            $this->session->set_flashdata('msg_error', ' Email Not Found, Please Check Your Email');
        }
        $this->load->view('admin/login');
    }
   
    public function manage_reservation($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
		 if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where(RESERVATION_ALS.'_id', $id);
            $result = $this->db->update(RESERVATION_TABLE, $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if($param1=='delete'){
            $this->db->where(RESERVATION_ALS.'_id', $param2);
            $result = $this->db->delete(RESERVATION_TABLE);
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_reservation', 'refresh');
        }
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
		
	    $data['table_data']     = $this->db->query("SELECT ".RESERVATION_TABLE.".*,".USER_TABLE.".name as user_name ,".WORKER_TABLE.".en_name as worker_name FROM ".RESERVATION_TABLE." LEFT JOIN ".WORKER_TABLE." ON ".RESERVATION_TABLE.".worker_id = ".WORKER_TABLE.".worker_id 
		LEFT JOIN ".USER_TABLE." ON ".RESERVATION_TABLE.".user_id = ".USER_TABLE.".user_id")->result_array();
		$data['page_title'] 	= get_phrase("reservation");
		$data['page_sub_title'] = get_phrase("Dashboard");
		$data['page_name'] 		= 'manage_reservation';
		$data['actor']          = 'manage_reservation';
        $data['main_page_name'] = 'manage_reservation';
        $data["htmlPage"]       = "manage_reservation";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
		
    }
    
    public function manage_notification($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	    $data['table_data']     = $this->db->get(NOTIFICATION_TABLE)->result_array();
		$data['page_title'] 	= get_phrase("notification");
		$data['page_sub_title'] = get_phrase("Dashboard");
		$data['page_name'] 		= 'manage_notification';
		$data['actor']          = 'manage_notification';
        $data['main_page_name'] = 'manage_notification';
        $data["htmlPage"]       = "manage_notification";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
		
    }
    public function add_notification($param1=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		} 
		if($param1 == 'save'){
		    $user_id  = $this->input->post('user_id');
		    if($user_id !='all'){
    		    $data['receiver_id']        = $this->input->post('user_id');
    		    $data['notification_title'] = $this->input->post('title');
    		    $data['image']              = !empty($this->input->post('image'))? $this->input->post('image'):'';
    		    $data['description']        = $this->input->post('description');
    		    $result = $this->db->insert(NOTIFICATION_TABLE,$data);
		    }else{
		        $user_list = $this->db->get_where(USER_TABLE,array('admin_status'=>'Active','users_roles_id!='=>'1'))->result_array();
		        foreach($user_list as $data){
		            $data['receiver_id']        = $data['user_id'];
        		    $data['notification_title'] = $this->input->post('title');
        		    $data['image']              = !empty($this->input->post('image'))? $this->input->post('image'):'';
        		    $data['description']        = $this->input->post('description');
        		    $data['type']               =  'All';
        		    
        		    $result = $this->db->insert(NOTIFICATION_TABLE,$data);
		        }
		    }
		    
		    
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/add_notification', 'refresh');
		}
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
		
		$data['user_data'] 	    = $this->db->get_where(USER_TABLE,array('admin_status'=>'Active','users_roles_id!='=>'1'))->result_array();
		
	   	$data['page_title'] 	= get_phrase("notification");
		$data['page_sub_title'] = get_phrase("manage_notification");
		$data['page_name'] 		= 'add_notification';
		$data['actor']          = 'add_notification';
        $data['main_page_name'] = 'manage_notification';
        $data["htmlPage"]       = "add_notification";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    
   
// 	********* Department
	public function manage_dept($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
		if ($param1 == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update ".DEPARTMENT_TABLE." SET position_order=" . $i . " WHERE edu_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
            echo "success";
            exit();
        }
        if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where(DEPARTMENT_ALS.'_id', $id);
            $result = $this->db->update(DEPARTMENT_TABLE, $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if($param1=='delete'){
            $this->db->where('dept_id', $param2);
            $result = $this->db->delete(DEPARTMENT_TABLE);
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_dept', 'refresh');
        }
        // if($param1=='sub'){
        //     $result = $this->db->get_where('brinkman_products_sub_category',array('products_category_id'=>$_POST['id']))->result_array();
        //     $div='';
        //     $div.='<option value = "" disabled selected>Please select Sub Category</option>';  
        //     foreach($result as $r){
        //       $div.='<option value="'.$r['products_sub_category_id'].'">'.$r['en_name'].'</option>';  
        //     }
        //     echo $div;
        //     exit;
        // }
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	    $data['table_data']     = $this->db->get(DEPARTMENT_TABLE)->result_array();
		$data['page_title'] 	= get_phrase("department");
		$data['page_sub_title'] = get_phrase("Dashboard");
		$data['page_name'] 		= 'manage_dept';
		$data['actor']          = 'manage_dept';
        $data['main_page_name'] = 'manage_dept';
        $data["htmlPage"]       = "manage_dept";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    public function add_dept($param1=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		} 
		if($param1 == 'save'){
		    $data['dept_name']             = $this->input->post('name');
		    $status = !empty($this->input->post('status'))? $this->input->post('status'):'Inactive';
            $data['status']              = $status;
            
		    $result = $this->db->insert(DEPARTMENT_TABLE,$data);
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_dept', 'refresh');
		}
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	   	$data['page_title'] 	= get_phrase("department");
		$data['page_sub_title'] = get_phrase("manage_department");
		$data['page_name'] 		= 'add_dept';
		$data['actor']          = 'add_dept';
        $data['main_page_name'] = 'manage_dept';
        $data["htmlPage"]       = "add_dept";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    public function edit_dept($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
       
		if($param1 == 'update'){
            $data['dept_name']             = $this->input->post('en_degree');
		    $data['status']              = $this->input->post('status');
		    $this->db->where(DEPARTMENT_ALS.'_id',$param2);
            $result = $this->db->update(DEPARTMENT_TABLE,$data);
           
		    if($result){
		       $this->session->set_flashdata('msg_success', ' Data Updated Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_dept', 'refresh');
		}
       	$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
		$data['edit_data']      = $this->db->get_where(DEPARTMENT_TABLE,array('dept_id'=>$param1))->row_array();
		$data['param1']         = $param1;
	    $data['page_title'] 	= get_phrase("department");
		$data['page_sub_title'] = get_phrase("manage_department");
		$data['page_name'] 		= 'edit_dept';
		$data['actor']          = 'edit_dept';
        $data['main_page_name'] = 'manage_education';
        $data["htmlPage"]       = "edit_dept";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}

    /***** Education *********/
	public function manage_education($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
		if ($param1 == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update shkalah_education SET position_order=" . $i . " WHERE edu_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
            echo "success";
            exit();
        }
        if ($param1 == 'update_status') {
            $brands_id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('edu_id', $brands_id);
            $result = $this->db->update('shkalah_education', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if($param1=='delete'){
            $this->db->where('edu_id', $param2);
            $result = $this->db->delete('shkalah_education');
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_education', 'refresh');
        }
        // if($param1=='sub'){
        //     $result = $this->db->get_where('brinkman_products_sub_category',array('products_category_id'=>$_POST['id']))->result_array();
        //     $div='';
        //     $div.='<option value = "" disabled selected>Please select Sub Category</option>';  
        //     foreach($result as $r){
        //       $div.='<option value="'.$r['products_sub_category_id'].'">'.$r['en_name'].'</option>';  
        //     }
        //     echo $div;
        //     exit;
        // }
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	    $data['table_data']     = $this->db->get('shkalah_education')->result_array();
		$data['page_title'] 	= get_phrase('education');
		$data['page_sub_title'] = get_phrase('Dashboard');
		$data['page_name'] 		= 'manage_education';
		$data['actor']          = 'manage_education';
        $data['main_page_name'] = 'manage_education';
        $data["htmlPage"]       = "manage_education";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    public function add_education($param1=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		} 
		if($param1 == 'save'){
		    $data['en_degree']             = $this->input->post('en_degree');
		    $data['ar_degree']             = $this->input->post('ar_degree');
		    $status = !empty($this->input->post('status'))? $this->input->post('status'):'Inactive';
            $data['status']              = $status;
            
		    $result = $this->db->insert('shkalah_education',$data);
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_education', 'refresh');
		}
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	   	$data['page_title'] 	=  get_phrase('education');
		$data['page_sub_title'] =  get_phrase('manage_education');
		$data['page_name'] 		= 'add_education';
		$data['actor']          = 'add_education';
        $data['main_page_name'] = 'manage_education';
        $data["htmlPage"]       = "add_education";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    public function edit_education($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
       
		if($param1 == 'update'){
            $data['en_degree']             = $this->input->post('en_degree');
		    $data['ar_degree']             = $this->input->post('ar_degree');
		    $data['status']              = $this->input->post('status');
		    $this->db->where('edu_id',$param2);
            $result = $this->db->update('shkalah_education',$data);
            $last_id = $this->db->insert_id();
           
		    if($result){
		       $this->session->set_flashdata('msg_success', ' Data Updated Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_education', 'refresh');
		}
       	$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
		$data['edit_data']      = $this->db->get_where('shkalah_education',array('edu_id'=>$param1))->row_array();
		$data['param1']         = $param1;
	    $data['page_title'] 	=  get_phrase('education');
		$data['page_sub_title'] =  get_phrase('manage_education');
		$data['page_name'] 		= 'edit_education';
		$data['actor']          = 'edit_education';
        $data['main_page_name'] = 'manage_education';
        $data["htmlPage"]       = "edit_education";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}

     /***** Skills *********/
	public function manage_skills($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
		if ($param1 == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update shkalah_skill SET position_order=" . $i . " WHERE skill_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
            echo "success";
            exit();
        }
        if ($param1 == 'update_status') {
            $brands_id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('skill_id', $brands_id);
            $result = $this->db->update('shkalah_skill', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if($param1=='delete'){
            $this->db->where('skill_id', $param2);
            $result = $this->db->delete('shkalah_skill');
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_skills', 'refresh');
        }
        // if($param1=='sub'){
        //     $result = $this->db->get_where('brinkman_products_sub_category',array('products_category_id'=>$_POST['id']))->result_array();
        //     $div='';
        //     $div.='<option value = "" disabled selected>Please select Sub Category</option>';  
        //     foreach($result as $r){
        //       $div.='<option value="'.$r['products_sub_category_id'].'">'.$r['en_name'].'</option>';  
        //     }
        //     echo $div;
        //     exit;
        // }
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	    $data['table_data']     = $this->db->get('shkalah_skill')->result_array();
		$data['page_title'] 	= get_phrase('skills');
		$data['page_sub_title'] =  get_phrase('Dashboard');
		$data['page_name'] 		= 'manage_skills';
		$data['actor']          = 'manage_skills';
        $data['main_page_name'] = 'manage_skills';
        $data["htmlPage"]       = "manage_skills";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    public function add_skills($param1=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		} 
		if($param1 == 'save'){
		    $data['en_name']             = $this->input->post('en_name');
		    $data['ar_name']             = $this->input->post('ar_name');
		    $status = !empty($this->input->post('status'))? $this->input->post('status'):'Inactive';
            $data['status']              = $status;
            
		    $result = $this->db->insert('shkalah_skill',$data);
            if($result){
		       $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_skills', 'refresh');
		}
		$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
	   	$data['page_title'] 	= get_phrase('skills');
		$data['page_sub_title'] = get_phrase('manage_skills');
		$data['page_name'] 		= 'add_skills';
		$data['actor']          = 'add_skills';
        $data['main_page_name'] = 'manage_skills';
        $data["htmlPage"]       = "add_skills";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
    public function edit_skills($param1='',$param2=''){
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
       
		if($param1 == 'update'){
            $data['en_name']             = $this->input->post('en_name');
		    $data['ar_name']             = $this->input->post('ar_name');
		    $data['status']              = $this->input->post('status');
		    $this->db->where('skill_id',$param2);
            $result = $this->db->update('shkalah_skill',$data);
            $last_id = $this->db->insert_id();
           
		    if($result){
		       $this->session->set_flashdata('msg_success', ' Data Updated Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() . admin_ctrl() . '/manage_skills', 'refresh');
		}
       	$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
		$data['edit_data']      = $this->db->get_where('shkalah_skill',array('skill_id'=>$param1))->row_array();
		$data['param1']         = $param1;
	    $data['page_title'] 	= get_phrase('skills');
		$data['page_sub_title'] = get_phrase('manage_skills');
		$data['page_name'] 		= 'edit_skills';
		$data['actor']          = 'edit_skills';
        $data['main_page_name'] = 'manage_skills';
        $data["htmlPage"]       = "edit_skills";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
     /***** Users *********/

     
     public function manage_user_system($param1 = '', $param2 = '')
     {
        //  echo "";
         if ($this->session->userdata('login') != 1) {
             redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
         }
         if ($param1 == 'sort') {
             $position = $_POST['position'];
             $i = count($position);
             foreach ($position as $k => $v) {
                 $sql = "Update shkalah_user SET position_order=" . $i . " WHERE user_id=" . $v . " ORDER BY position_order desc";
                 $this->db->query($sql);
                 $i--;
             }
             echo "success";
             exit();
         }
         
         if ($param1 == 'update_status') {
             $user_id = $this->input->post('id');
             $updateData['admin_status'] = $this->input->post('status');
             $this->db->where('user_id', $user_id);
             $result = $this->db->update('shkalah_user', $updateData);
             
             if ($result) {
                 echo 'success';
             } else {
                 echo 'fail';
             }
             exit;
         }
         if($param1 == 'update_admin_status'){
             $id = $this->input->post('id');
             $status = $this->input->post('status');
             
             $update_data['admin_status'] = $status;
             $comments ='';
             if(!empty($this->input->post('comments'))){
                $comments = $this->input->post('comments');
                $update_data['comments'] = $this->input->post('comments');
             }
             $this->db->where(USER_ALS.'_id',$id);
             $res = $this->db->update(USER_TABLE,$update_data);
             if($res){
                $this->Db_model->save_notification($id,'User Verify',$comments,'');
                $sub = "User Verify";
				$get_user_data = $this->db->get_where(USER_TABLE, array(USER_ALS.'_id'=>$id))->row();
					$message = "<b>Dear ".$get_user_data->name." </b><br>Status: $status <br> Remarks: ".$comments." ";
				$user_email = $get_user_data->email;
			    $this->Email_model->do_email($message, $sub, $user_email);
                 
                 echo "success";
             }else{
                 echo "fail";
             }
             exit;
         }
         if ($param1 == 'delete') {
             $this->db->where('id', $param2);
             $result = $this->db->delete('shkalah_user');
             if ($result) {
                 $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
             } else {
                 $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
             }
             redirect(base_url() . admin_ctrl() . '/manage_user_system', 'refresh');
         }
 
         $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
         $data['table_data']     = $this->db->get('shkalah_user')->result_array();
         $data['page_title']     = get_phrase('users');
         $data['page_sub_title'] = get_phrase('Dashboard');
         $data['page_name']         = 'manage_user_system';
         $data['actor']          = 'manage_user_system';
         $data['main_page_name'] = 'manage_user_system';
         $data["htmlPage"]       = "manage_user_system";
         $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
     }
     
     public function view_user($param1 = '',$param2 = '',$param3 = ''){
          if($param1 == 'update_admin_status'){
              $id = $param2;
              $status = $param3 == "Active" ? "Reject": "Active";
        
             $update_data['admin_status'] = $status;
         
             $this->db->where(USER_ALS.'_id',$id);
             $res = $this->db->update(USER_TABLE,$update_data);
             if($res){
                $this->session->set_flashdata('msg_success', 'Successfully Updated');
                redirect(base_url() . admin_ctrl() . '/view_user/'.$param2, 'refresh');
            //  exit;
             }else{
                $this->session->set_flashdata('msg_error', 'Cannot update status');
                redirect(base_url() . admin_ctrl() . '/view_user/'.$param2, 'refresh');
             }
             
         }
         $check = false;
             $userRes = $this->db->get_where(USER_TABLE , [USER_ALS."_id"=>$param1]);
             if($userRes){
                 if(count($userRes->result()) > 0){
                     $user = $userRes->result()[0];
                     $check = true;
                     $user->is_subscribe = $this->checkUserSub($user->user_id);
                     $user->no_of_workers = $this->db->query("SELECT count(worker_id) as val from ".WORKER_TABLE." where user_id = ".$user->user_id)->first_row();
                     $user->live_workers = $this->db->query("SELECT count(worker_id) as val from ".WORKER_TABLE." where user_id = ".$user->user_id." and admin_status = 'Active'")->first_row();
                     $data['view_data'] = $user;
                    $trData = $this->db->get_where(TRANSACTION_TABLE,["user_id"=>$user->user_id])->result();
                    $data["tr_data"] = $trData;
                     
                 }
             }
             if(!$check){
                $this->session->set_flashdata('msg_error', 'Oops! no user found');
                redirect(base_url() . admin_ctrl() . '/manage_user_system', 'refresh');
             }
         
        //  print_r($data);
         $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
      //   $data['table_data']     = $this->db->get('shkalah_user')->result_array();
         $data['page_title']     = get_phrase('user_detail');
         $data['page_sub_title'] = get_phrase('Dashboard');
         $data['page_name']         = 'manage_user_system';
         $data['actor']          = 'view_user';
         $data['main_page_name'] = 'manage_user_system';
         $data["htmlPage"]       = "view_user";
         
         $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
     }
      /***** Workers *********/

     
     public function manage_worker($param1 = '', $param2 = '')
     {
         if ($this->session->userdata('login') != 1) {
             redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
         }
         if ($param1 == 'sort') {
             $position = $_POST['position'];
             $i = count($position);
             foreach ($position as $k => $v) {
                 $sql = "Update shkalah_worker SET position_order=" . $i . " WHERE worker_id=" . $v . " ORDER BY position_order desc";
                 $this->db->query($sql);
                 $i--;
             }
             echo "success";
             exit();
         }
         if($param1 == 'update_admin_status'){
             $id = $this->input->post('id');
             $status = $this->input->post('status');
            // $res = $this->db->update(WORKER_TABLE , ["admin_status"=>$status],[WORKER_ALS."_id"=>$id]);
            //  print_r($_POST); 
             
             $update_data['admin_status'] = $status;
             $comments ='';
             if(!empty($this->input->post('comments'))){
                $update_data['comments'] = $this->input->post('comments');
                $comments = $this->input->post('comments');
             }
             
           /*  $get_user_data = $this->db->query("SELECT ".USER_TABLE.".* FROM ".USER_TABLE." LEFT JOIN ".WORKER_TABLE." ON ".USER_TABLE.".user_id = ".WORKER_TABLE.".user_id where ".WORKER_ALS."_id=$id ")->row();
			print_r($get_user_data);	
			exit; */
             
             $this->db->where(WORKER_ALS.'_id',$id);
             $res = $this->db->update(WORKER_TABLE,$update_data);
            
             if($res){
                $this->Db_model->save_notification($id,'User Verify',$comments,'');
                $sub = "Worker Verify";
				//$get_user_data = $this->db->get_where(WORKER_TABLE, array(WORKER_ALS.'_id'=>$id))->row();
				$get_user_data = $this->db->query("SELECT ".USER_TABLE.".* FROM ".USER_TABLE." LEFT JOIN ".WORKER_TABLE." ON ".USER_TABLE.".user_id = ".WORKER_TABLE.".user_id where ".WORKER_ALS."_id=$id ")->row();
				// print_r($get_user_data);
				if($get_user_data){
    				$message = "<b>Dear ".$get_user_data->name." </b><br>Status: $status <br> Remarks: ".$comments." ";
    				
    				$user_email = $get_user_data->email;
    			    $this->Email_model->do_email($message, $sub, $user_email);
				}
                 
                 echo "success";
             }else{
                 echo "fail";
             }
             exit;
         }
         if ($param1 == 'update_status') {
             $worker_id = $this->input->post('id');
             $updateData['admin_status'] = $this->input->post('status');
             $this->db->where('worker_id', $worker_id);
             $result = $this->db->update('shkalah_worker', $updateData);
            // echo $this->db->last_query();
          //   exit;
             if ($result) {
                 echo 'success';
             } else {
                 echo 'fail';
             }
             exit;
         }
         
 
         $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
        //  manage_company_worker
        
         $data['table_data']     = $param1 == 'company' ? $this->db->select('a.* ,b.name as user_name')->from("shkalah_worker as a")->join("shkalah_user as b",'user_id' ,'=', 'user_id')->where("b.type","Company")->get()->result_array() : $this->db->select('a.* ,b.name as user_name')->from("shkalah_worker as a")->join("shkalah_user as b",'user_id' ,'=', 'user_id')->where("b.type","Individual")->get()->result_array(); 
         
         $data['page_title']     = get_phrase('worker');
         $data['page_sub_title'] = get_phrase('Dashboard');
         $data['page_name']         = 'manage_worker';
         if($param1 == 'company'){
            $data['page_name']         = 'manage_company_worker';
         }
         $data['actor']          = 'manage_worker';
         $data['main_page_name'] = 'manage_worker';
         $data["htmlPage"]       = "manage_worker";
         $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
     }
      public function view_details($param1='',$param2='',$param3=''){
          
		if($this->session->userdata('login') != 1){
			redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
		}
		 if($param1 == 'update_admin_status'){
              $id = $param2;
              $status = $param3 == "Active" ? "Reject": "Active";
        
             $update_data['admin_status'] = $status;
         
             $this->db->where(WORKER_ALS.'_id',$id);
             $res = $this->db->update(WORKER_TABLE,$update_data);
             if($res){
                $this->session->set_flashdata('msg_success', 'Successfully Updated');
                redirect(base_url() . admin_ctrl() . '/view_details/'.$param2, 'refresh');
            //  exit;
             }else{
                $this->session->set_flashdata('msg_error', 'Cannot update status');
                redirect(base_url() . admin_ctrl() . '/view_details/'.$param2, 'refresh');
             }
             
         }
          //  redirect(base_url() . admin_ctrl() . '/manage_worker', 'refresh');
		

       	$data['system_data'] 	= $this->db->get('shkalah_system_settings')->result();
		$data['view_data']      =  $this->db->query('select a.* ,b.name as user_name,c.en_degree as degree_name,d.en_name as work,e.name as place_of_birth,f.name as place_of_living from shkalah_worker as a left join shkalah_user as b on a.user_id = b.user_id left join shkalah_education as c on a.edu_id = c.edu_id
        LEFT JOIN shkalah_skill as d on a.skill_id = d.skill_id LEFT JOIN shkalah_countries as e ON e.country_id = a.place_of_birth_id LEFT JOIN shkalah_countries as f ON f.country_id = a.place_of_living_id  where a.worker_id ="'. $param1.'"')->row_array();
// 		$this->db->select('* ,b.name as user_name ,c.en_degree as degree_name ,d.en_name as work ,e.name as birth_place ,f.name as living_place')->from("shkalah_worker as a")->join("shkalah_user as b",'user_id' ,'=', 'user_id')->join("shkalah_education as c",'edu_id','=','edu_id')->join("shkalah_skill as d",'skill_id','=','skill_id')->join("shkalah_countries as e",'country_id','=','place_of_birth_id')->join("shkalah_countries as f",'place_of_living_id','=','country_id')->get()->row_array();
// 		$this->db->get_where('shkalah_worker',array('worker_id'=>$param1))->row_array();
		$data['param1']         = $param1;
	    $data['page_title'] 	= get_phrase('worker_details');
		$data['page_sub_title'] = get_phrase('manage_worker');
		$data['page_name'] 		= 'worker_details';
		$data['actor']          = 'worker_details';
        $data['main_page_name'] = 'manage_worker';
        $data["htmlPage"]       = "worker_details";
		$this->load->view(strtolower($this->session->userdata('directory')) .'/index', $data);
	}
	
	/***** Slider *********/

    public function upload_slider_image()
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        $img = $_POST['img'];
        $data = base64_decode($img);
        $image_name = 'products_' . time() . '.png';
        $upload_image = file_put_contents('uploads/slider/' . $image_name, $data);
        if ($upload_image) {
            $save_image = 'uploads/slider/' . $image_name;

            $save['image'] = $save_image;

            echo $save_image;
        } else {
            echo 'error';
        }
        exit;
    }
    public function manage_slider($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if ($param1 == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update shkalah_slider SET position_order=" . $i . " WHERE slider_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
            echo "success";
            exit();
        }
        if ($param1 == 'update_status') {
            $slider_id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('slider_id', $slider_id);
            $result = $this->db->update('shkalah_slider', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if ($param1 == 'delete') {
            $this->db->where('slider_id', $param2);
            $result = $this->db->delete('shkalah_slider');
            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_slider', 'refresh');
        }

        $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
        $data['table_data']     = $this->db->get('shkalah_slider')->result_array();
        $data['page_title']     = get_phrase('slider');
        $data['page_sub_title'] = get_phrase('Dashboard');
        $data['page_name']         = 'manage_slider';
        $data['actor']          = 'manage_slider';
        $data['main_page_name'] = 'manage_slider';
        $data["htmlPage"]       = "manage_slider";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    public function add_slider($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if ($param1 == 'save') {
            
            if (!empty($_FILES['img']['name'])) {
                $file_name = time() . '_mimage.jpg';
                $path_to_file = 'uploads/slider/' . $file_name;
                move_uploaded_file($_FILES['img']['tmp_name'], $path_to_file);
                $data['image'] = $path_to_file;
            }
            $data['title']             = $this->input->post('title');
            $data['hyperlink']         = $this->input->post('hyperlink');
            $status = !empty($this->input->post('status'))? $this->input->post('status'):'Inactive';
            $data['status']              = $status;
            // $data['picture']               = json_encode($this->input->post('image_array'));

            
            $result = $this->db->insert('shkalah_slider', $data);
            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_slider', 'refresh');
        }
        $data['system_data']     = $this->db->get('shkalah_system_settings')->result();

        $data['page_title']     = get_phrase('add_slider');
        $data['page_sub_title'] = get_phrase('manage_slider');
        $data['page_name']         = 'add_slider';
        $data['actor']          = 'add_slider';
        $data['main_page_name'] = 'manage_slider';
        $data["htmlPage"]       = "add_slider";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    public function edit_slider($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }

        if ($param1 == 'update') {
            if (!empty($_FILES['img']['name'])) {
                $file_name = time() . '_mimage.jpg';
                $path_to_file = 'uploads/slider/' . $file_name;
                move_uploaded_file($_FILES['img']['tmp_name'], $path_to_file);
                $data['image'] = $path_to_file;
            }
            $data['hyperlink']         = $this->input->post('hyperlink');
            $data['title']             = $this->input->post('title');
            $data['status']              = $this->input->post('status');

            $this->db->where('slider_id', $param2);
            $result = $this->db->update('shkalah_slider', $data);
         /*  echo $this->db->last_query();
           exit; */

            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_slider', 'refresh');
        }
        $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
        $data['edit_data']      = $this->db->get_where('shkalah_slider', array('slider_id' => $param1))->row_array();
        $data['param1']         = $param1;
        $data['page_title']     = get_phrase('edit_slider');
        $data['page_sub_title'] = get_phrase('manage_slider');
        $data['page_name']         = 'edit_slider';
        $data['actor']          = 'edit_slider';
        $data['main_page_name'] = 'manage_slider';
        $data["htmlPage"]       = "edit_slider";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    /*****Profile Slider *********/

    public function upload_profile_slider_image()
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        $img = $_POST['img'];
        $data = base64_decode($img);
        $image_name = 'products_' . time() . '.png';
        $upload_image = file_put_contents('uploads/slider/' . $image_name, $data);
        if ($upload_image) {
            $save_image = 'uploads/slider/' . $image_name;

            $save['image'] = $save_image;

            echo $save_image;
        } else {
            echo 'error';
        }
        exit;
    }
    public function manage_profile_slider($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if ($param1 == 'sort') {
            $position = $_POST['position'];
            $i = count($position);
            foreach ($position as $k => $v) {
                $sql = "Update shkalah_profile_slider SET position_order=" . $i . " WHERE slider_profile_id=" . $v . " ORDER BY position_order desc";
                $this->db->query($sql);
                $i--;
            }
            echo "success";
            exit();
        }
        if ($param1 == 'update_status') {
            $slider_profile_id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('slider_profile_id', $slider_profile_id);
            $result = $this->db->update('shkalah_profile_slider', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if ($param1 == 'delete') {
            $this->db->where('slider_profile_id', $param2);
            $result = $this->db->delete('shkalah_profile_slider');
            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_profile_slider', 'refresh');
        }

        $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
        $data['table_data']     = $this->db->get('shkalah_profile_slider')->result_array();
        $data['page_title']     = get_phrase("profile_slider");
        $data['page_sub_title'] = get_phrase("Dashboard");
        $data['page_name']         = 'manage_profile_slider';
        $data['actor']          = 'manage_profile_slider';
        $data['main_page_name'] = 'manage_profile_slider';
        $data["htmlPage"]       = "manage_profile_slider";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    public function add_profile_slider($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if ($param1 == 'save') {
            
            if (!empty($_FILES['img']['name'])) {
                $file_name = time() . '_mimage.jpg';
                $path_to_file = 'uploads/slider/' . $file_name;
                move_uploaded_file($_FILES['img']['tmp_name'], $path_to_file);
                $data['image'] = $path_to_file;
            }
            $data['title']             = $this->input->post('title');
            $status = !empty($this->input->post('status'))? $this->input->post('status'):'Inactive';
            $data['status']              = $status;
            
            
            $result = $this->db->insert('shkalah_profile_slider', $data);
            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_profile_slider', 'refresh');
        }
        $data['system_data']     = $this->db->get('shkalah_system_settings')->result();

        $data['page_title']     = 'Profile Slider';
        $data['page_sub_title'] = 'Manage Profile Slider';
        $data['page_name']         = 'add_profile_slider';
        $data['actor']          = 'add_profile_slider';
        $data['main_page_name'] = 'manage_profile_slider';
        $data["htmlPage"]       = "add_profile_slider";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    public function edit_profile_slider($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }

        if ($param1 == 'update') {
            if (!empty($_FILES['img']['name'])) {
                $file_name = time() . '_mimage.jpg';
                $path_to_file = 'uploads/slider/' . $file_name;
                move_uploaded_file($_FILES['img']['tmp_name'], $path_to_file);
                $data['image'] = $path_to_file;
            }
            $data['title']             = $this->input->post('title');
            $data['status']              = $this->input->post('status');

            $this->db->where('slider_profile_id', $param2);
            $result = $this->db->update('shkalah_profile_slider', $data);
           

            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_profile_slider', 'refresh');
        }
        $data['system_data']     = $this->db->get('shkalah_system_settings')->result();
        $data['edit_data']      = $this->db->get_where('shkalah_profile_slider', array('slider_profile_id' => $param1))->row_array();
        $data['param1']         = $param1;
        $data['page_title']     = 'Profile Slider';
        $data['page_sub_title'] = 'Manage Profile Slider';
        $data['page_name']         = 'edit_profile_slider';
        $data['actor']          = 'edit_profile_slider';
        $data['main_page_name'] = 'manage_profile_slider';
        $data["htmlPage"]       = "edit_profile_slider";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
	
   
    /***** Language *********/
    public function change_language()
    {
        $lang = $this->input->post('lang');

        if ($lang == 'english') {
            $this->session->set_userdata('current_language', 'english');
            $this->session->set_userdata('language_country', 'english');
            $this->session->set_userdata('controller_name', 'en');
            
        } else {
            $this->session->set_userdata('current_language', 'arb');
            $this->session->set_userdata('language_country', 'arabic');
            $this->session->set_userdata('controller_name', 'ar');
        }
        echo "success";

        exit;

    }

    public function language($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['profile_data'] = $this->db->get_where('shkalah_user', array('user_id' => '1'))->row();
        $data['page_title'] = get_phrase('manage_language');
        $data['page_sub_title'] = 'Manage Language';
        $data['page_name'] = 'manage_language';
        $data['actor'] = 'manage_language';
        $data['main_page_name'] = 'manage_language';
        $data["htmlPage"] = "manage_language";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function edit_language($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            $phrase_id = $this->input->post('phrase_id');
            $lang = $this->input->post('lang');
            $data[$lang] = $this->input->post('phrase_value');
            //$this->db->where('Spainish',$this->input->post('phrase_value'));
            $this->db->where('phrase_id', $phrase_id);
            $result = $this->db->update('shkalah_language', $data);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        $data['profile_data'] = $this->db->get_where('shkalah_user', array('user_id' => '1'))->row();
        $data['param1'] = $param1;
        $data['page_title'] = get_phrase('edit_language');
        $data['page_sub_title'] = 'Edit Language';
        $data['page_name'] = 'edit_language';
        $data['actor'] = 'edit_language';
        $data['main_page_name'] = 'edit_language';
        $data["htmlPage"] = "edit_language";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** Language *********/

    /***** DASBOARD *********/
    public function dashboard()
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $no_of_user = $this->db->select("count(".USER_ALS."_id) as count")
        ->from(USER_TABLE)->where("users_roles_id","0")->get()->row_array();
        $no_of_workers = $this->db->select("count(".WORKER_ALS."_id) as count")
        ->from(WORKER_TABLE)->where("is_deleted","0")->get()->row_array();
        $no_of_active_workers = $this->db->select("count(".WORKER_ALS."_id) as count")
        ->from(WORKER_TABLE)->where("is_deleted","0")->where('admin_status',"Active")->get()->row_array();
        $date = date('Y-m-d h:i:s', strtotime('-1 year'));;
        $total_sub_amount = $this->db->query("SELECT sum(amount) as amount FROM ".TRANSACTION_TABLE." WHERE created_at >= '".$date."'")->row_array();
        
        $workerAdvTypeGraph =$this->db->query("select count(worker_id) as count , advs_type from ".WORKER_TABLE." group by advs_type")->result();
        
         $workerCityGraph =$this->db->query("select count(worker_id) as count , c.name as country_name from ".WORKER_TABLE." a left join ".COUNTRIES_TABLE.
         " c on a.place_of_living_id = c.country_id  group by place_of_living_id")->result();
         
         $workerindGraph =$this->db->query("select count(worker_id) as count , MAX(a.worker_created_at) as date from ".WORKER_TABLE." a left join ".USER_TABLE." b on a.user_id = b.user_id where b.type = 'Individual' GROUP BY DATE_FORMAT(a.worker_created_at, '%Y%m')")->result(); 
        
        $monIndWok = [];
        $monthArr = [];
        foreach($workerindGraph as $dg){
           $monIndWok[] = $mon = [
                    "month"=> date("Y F", strtotime($dg->date)),
                    "count"=>$dg->count
                ];
                $monthArr[$mon["month"]]["ind"] = $mon["count"];
        }
        
        $workerCompGraph =$this->db->query("select count(worker_id) as count , MAX(a.worker_created_at) as date from ".WORKER_TABLE." a left join ".USER_TABLE." b on a.user_id = b.user_id where b.type = 'Company' GROUP BY DATE_FORMAT(a.worker_created_at, '%Y%m')")->result(); 
        
        $monCompWorker = [];
        foreach($workerCompGraph as $dg){
           $monCompWorker[] = $mon = [
                    "month"=> date("Y F", strtotime($dg->date)),
                    "count"=>$dg->count
                ];
                $monthArr[$mon["month"]]["comp"] = $mon["count"];

        }
        
        // echo "<pre>";
        // print_r($monthArr);
        // print_r($monIndWok);
        $pageD = [
            'no_of_users'=>$no_of_user['count'],
            'no_of_workers'=>$no_of_workers['count'],
            'no_of_active_workers'=>$no_of_active_workers['count'],
            'total_sub_amount'=>$total_sub_amount['amount'],
            'advs_type' => $workerAdvTypeGraph,
            'place_of_living' => $workerCityGraph,
            'monlinedata' => $monthArr,
            //'type' => $usertypegraph,
            ];
            // print_r($pageD);
        //print_r($no_of_user);
        $data['user_table_data'] = $this->db->get_where(USER_TABLE,["admin_status"=>"Inactive"])->result_array();
        $data['worker_table_data']  = $this->db->query("SELECT a.*,b.name as user_name  from " . WORKER_TABLE . " as a left join ".USER_TABLE." as b on a.user_id = b.user_id where a.admin_status = 'Inactive'")->result_array();
        
        // print_r( $data);
        $data['page_data'] = $pageD;
        $data['actor'] = 'dashboard';
        $data['main_page_name'] = 'dashboard';
        $data["htmlPage"] = "dashboard";
        $data['page_title'] = get_phrase("Dashboard");
        $data['page_sub_title'] = get_phrase("Dashboard");
        $data['page_name'] = 'dashboard';
        $this->load->view(strtolower($this->session->userdata('directory')) . '/dashboard', $data);
    }
    /***** DASBOARD *********/
    
    /**** customer list *****/
    public function customer_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == "get_ajax") {
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            if ($columnName == "name") {
                $columnName = "first_name";
            }
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value

            ## Search 
            $searchQuery = " ";
            if ($searchValue != '') {
                $searchQuery = " and (first_name like '%" . $searchValue . "%' or last_name like '%" . $searchValue . "%' or 
                    email like '%" . $searchValue . "%' or sp_points like '%" . $searchValue . "%' or 
                    mobile like'%" . $searchValue . "%' ) ";
            }
            $totalRecords = $this->db->count_all("users_system");
            $res = $this->db->query("select count(user_id) as c from shkalah_user where user_id != '-1' $searchQuery")->first_row();
            // echo $this->db->last_query();
            $totalRecordwithFilter = $res->c;
            $query = "select * from shkalah_user WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
            // echo $query;
            $users = $this->db->query($query)->result();
            $tabledata = [];
            foreach ($users as $user) {
                $data = [];
                $data["user_id"] = $user->user_id;
                $data["name"] = $user->first_name . " " . $user->last_name;
                $data["sp_points"] = $user->sp_points;
                $data["email"] = $user->email;
                $data["mobile"] = $user->mobile;
                $status = '<div class="toggle-btn1 ';
                if ($user->status == 'Active') {
                    $status .= 'active"';
                }
                $status .= ">";
                $status .= '<input type="checkbox"   class="cb-value" value="' . $user->user_id . '"';
                if ($user->status == 'Active') {
                    $status .= ' checked';
                }
                $status .= "/>";
                $status .= '<span class="round-btn"></span></div>';

                $data["status"] = $status;
                $action = "<a href='" . base_url() . "admin/edit_user/" . $user->user_id . "'>
                                            <i class='fa fa-pencil'></i>
                                        </a>";
                // $user['user_id']
                // $count;

                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->user_id ."')><i class='fa fa-trash-o'></i></a>";
                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->user_id ."')><i class='fa fa-trash-o'></i></a>";
                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->user_id ."')><i class='fa fa-trash-o'></i></a>";
                $d["user"] = ["user_id" => $user->user_id];
                $d["count"] = $user->user_id;
                $data["action"] = $this->load->view(strtolower($this->session->userdata('directory')) . '/manage_user_actions', $d, true);
                $tabledata[] = $data;
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $tabledata
            );

            echo json_encode($response);
            exit();
        }
        if ($param1 == 'get_logs') {
            $id = $_REQUEST['id'];
            $this->db->order_by("points_log_id", "DESC");
            $res = $this->db->get_where("points_log", ["user_id" => $id]);
            $data = [];
            if ($res) {
                $data["result"] = $res->result();
                $data["status"] = 1;

            } else {
                //   $data["result"] = $res->result();
                $data["status"] = 1;
            }
            echo json_encode($data);

            exit;
        }
        if ($param1 == 'delete') {
            $this->db->where('user_id', $param2);
            $this->db->delete('users_system');
            $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }
        if ($param1 == 'update_status') {
            $user_id = $this->input->post('user_id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('user_id', $user_id);
            $result = $this->db->update('shkalah_user', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
       
        // $this->db->limit($limit, $start);
        // $this->db->limit(300);  
        // $data['customer_list'] = $this->db->get_where('users_system')->result_array();
        $data['page_title'] = 'Manage Users';
        $data['page_sub_title'] = 'manage_users';
        $data['page_name'] = 'manage_users';
        $data['actor'] = 'manage_users';
        $data['main_page_name'] = 'manage_users';
        $data["htmlPage"] = "manage_users";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function add_user($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'add') {
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/users/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $saveData['user_image'] = $file_name;
            }
            $saveData['first_name'] = $this->input->post('name');
            $saveData['email'] = $this->input->post('email');
            $saveData['mobile'] = $this->input->post('mobile');
            $saveData['password'] = $this->input->post('password');
            $saveData['city'] = $this->input->post('city');
            $saveData['address'] = $this->input->post('address');
            $sp_points = $this->input->post('sp_points');
            if (!empty($sp_points)) {
                $saveData['sp_points'] = $sp_points;
            }
            $saveData['users_roles_id'] = $this->input->post('roles');
            $saveData['status'] = 'Active';
            $result = $this->db->insert('shkalah_user', $saveData);
            if (!empty($saveData['sp_points'])) {
                $id = $this->db->insert_id();
                $saveData2 = ["user_id" => $id, "type" => "Increment", "description" => "Added from admin panel", "points" => $saveData['sp_points'], "current_points" => $saveData['sp_points']];
                $result2 = $this->db->insert('brinkman_points_log', $saveData2);
            }
            if ($result) {
                $this->session->set_flashdata('msg_success', ' User Added Successfully');
            }
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }

        $data['page_title'] = 'Add User';
        $data['page_sub_title'] = 'add_user';
        $data['page_name'] = 'add_user';
        $data['actor'] = 'add_user';
        $data['main_page_name'] = 'add_user';
        $data["htmlPage"] = "add_user";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function edit_user($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/users/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $saveData['user_image'] = $file_name;
            }
            $muser = $this->db->get_where('shkalah_user', array('user_id' => $param2))->first_row();
            $saveData['first_name'] = $this->input->post('name');
            $saveData['email'] = $this->input->post('email');
            $saveData['mobile'] = $this->input->post('mobile');
//            $saveData['password'] = $this->input->post('password');
            $saveData['city'] = $this->input->post('city');
            $saveData['address'] = $this->input->post('address');
            $saveData['users_roles_id'] = $this->input->post('roles');
            $saveData['status'] = 'Active';
            $sp_type = $this->input->post("sp_points_type");
            $sp_points = $this->input->post('sp_points');
            if (!empty($sp_points)) {
                if ($sp_type == "increase") {
                    $saveData['sp_points'] = $sp_points + $muser->sp_points;
                } else if ($sp_type == "decrease") {
                    $saveData['sp_points'] = $muser->sp_points - $sp_points;
                }
            }

            $this->db->where('user_id', $param2);
            $result = $this->db->update('shkalah_user', $saveData);
            if (!empty($sp_points)) {
                $id = $param2;
                $type = $sp_type == "increase" ? "Increment" : "Decrement";
                $points = $sp_points;
                $saveData2 = ["user_id" => $id, "type" => $type, "description" => "Added from admin panel", "points" => $points, "current_points" => $saveData['sp_points']];
                $result2 = $this->db->insert('brinkman_points_log', $saveData2);

            }
            if ($result) {
                $this->session->set_flashdata('msg_success', ' User Added Successfully');
            }
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }
        $data['page_data'] = $this->db->get_where('shkalah_user', array('user_id' => $param1))->row();
        $data['page_title'] = 'Edit User';
        $data['page_sub_title'] = 'edit_user';
        $data['page_name'] = 'edit_user';
        $data['actor'] = 'edit_user';
        $data['main_page_name'] = 'edit_user';
        $data["htmlPage"] = "edit_user";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** customer list ****/
    
    /***** MY PROFILE *********/
    public function myprofile($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        // exit;
        /*	if($this->session->userdata('login') != 1){
                redirect(base_url().strtolower($this->session->userdata('directory')), 'refresh');
            } */

        if ($param1 == 'update') {
            $response = $this->Db_model->update_admin_profile();

            $this->session->set_flashdata('msg_success', ' Updated Successfully');
            redirect(base_url() . admin_ctrl() . '/myprofile', 'refresh');
        }

        $data['profile_data'] = $this->db->get_where('shkalah_user', array('user_id' => $this->session->userdata('users_id')))->row();
        $data['actor'] = 'profile';
        $data['main_page_name'] = 'profile';
        $data['page_title'] = 'Update Your Profile';
        $data['page_sub_title'] = 'Profile';
        $data['page_name'] = 'myprofile';
        $data["htmlPage"] = "myprofile";

        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** MY PROFILE *********/

    /***** SYSTEM SETTINGS *********/
    public function system_settings($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        if ($param1 == 'update') {
            $response = $this->Db_model->update_system_settings();
            $this->session->set_flashdata('msg_success', ' Updated Successfully');
            redirect(base_url() . admin_ctrl() . '/system_settings', 'refresh');
        }
        $settingResponse = $this->db->get('shkalah_system_settings')->result();
        $app_setting = [];
        foreach($settingResponse as $setting){
            $app_setting[$setting->type] = $setting->description;    
        }
        $data['system_data'] = $app_setting;
        $data['actor'] = 'system_settings';
        $data['main_page_name'] = 'system_settings';
        $data['page_title'] = 'Update Your System Settings';
        $data['page_sub_title'] = 'Dashboard';
        $data['page_name'] = 'system_settings';
        $data["htmlPage"] = "system_settings";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    /***** SYSTEM SETTINGS *********/


    public function resetpassword($verification_code = '')
    {
        $decoded_code = base64_decode($verification_code);
        $code_array = explode("_", $decoded_code);
        $user_id = $code_array[0];
        $data['user_id'] = $user_id;
        $this->load->view('admin/reset_password', $data);
    }

    public function reset_password($verification_code = '', $user_id = '')
    {
        if ($verification_code == 'update_password') {
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            if ($new_password != $confirm_password) {
                $this->session->set_flashdata('msg_error', ' Your password did not match, try again.');
                redirect(base_url() . 'admin', 'refresh');
            } else if ($new_password == $confirm_password) {
                $this->db->query("UPDATE brinkman_user_accounts SET password = '" . $new_password . "', reset_password_code = ''  WHERE user_accounts_id = '" . $user_id . "'  ");
                $this->session->set_flashdata('msg_success', ' Password Updated Successfully.');
                redirect(base_url() . 'admin', 'refresh');
            }
        }
    }

    /***** Retrieve Password Page *********/
    public function logout()
    {
        /*  $s_update['status']  = 'Inactive';
          $this->db->where('user_accounts_id',$this->session->userdata('users_id'));
          $this->db->update('user_login',$s_update);*/
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg_error', 'logout Successfully!.');
        redirect(base_url() .admin_ctrl() , 'refresh');
    }

    /* VERIFY ACCOUNT */

   
    /**** manage roles *****/
    public function manage_roles($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        if ($param1 == 'edit') {
            $updateData['confirmation_number'] = $this->input->post('confirmation_number');
            $this->db->where('user_id', $param2);
            $result = $this->db->update('shkalah_user', $updateData);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Govt Number Assigned Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }

        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('shkalah_user_roles', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Role Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }
        $data['user_roles'] = $this->db->get('brinkman_user_roles')->result_array();
        $data['page_title'] = get_phrase('manage_roles');
        $data['page_sub_title'] = get_phrase('manage_roles');
        $data['page_name'] = 'manage_roles';
        $data['actor'] = 'manage_roles';
        $data['main_page_name'] = 'manage_roles';
        $data["htmlPage"] = "manage_roles";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    // Manage SUGGESTED PRODUCT

    /**** manage roles *****/
    /**** manage permission ****/
    public function manage_permissions($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data_per['account_setting'] = $this->check_value($this->input->post('account_setting'));
            $data_per['system_setting'] = $this->check_value($this->input->post('system_setting'));
            $data_per['dashboard'] = $this->check_value($this->input->post('dashboard'));
            $data_per['manage_pages'] = $this->check_value($this->input->post('manage_pages'));
            $data_per['manage_news'] = $this->check_value($this->input->post('manage_news'));
            $data_per['manage_campus_life'] = $this->check_value($this->input->post('manage_campus_life'));
            $data_per['manage_department'] = $this->check_value($this->input->post('manage_department'));
            $data_per['manage_news_letter'] = $this->check_value($this->input->post('manage_news_letter'));
            $data_per['manage_general_setting'] = $this->check_value($this->input->post('manage_general_setting'));
            $this->db->where('user_roles_id', $param2);
            $result = $this->db->update('brinkman_user_privileges', $data_per);

            if ($result == 'success') {
                $this->session->set_flashdata('msg_success', 'Permissions Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'oops!Permissions not updated! try again.');
            }
            redirect(base_url() . 'admin/manage_roles/', 'refresh');
        }
        $data['param1'] = $param1;
        $data['roles'] = $this->db->get_where('brinkman_user_roles', array('user_roles_id' => $param1))->result_array();
        $data['page_title'] = get_phrase('brinkman_manage_permissions');
        $data['page_sub_title'] = '';
        $data['page_name'] = 'manage_permissions';
        $data['main_page_name'] = 'manage_permissions';
        
        $data['htmlPage'] = 'edit_roles';
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

   

    function check_value($check_box_value)
    {
        if ($check_box_value == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    /**** manage permission ****/
    public function replace_underscore($string)
    {
        $replaced = str_replace(' ', '_', $string);
        return $replaced;
    }

    public function check_null($param)
    {
        if ($param) {
            return $param;
        } else {
            return '0';
        }
    }

    public function getSortNumber($table)
    {
        $count = $this->db->get($table)->num_rows();
        $count = $count + 1;
        return $count;
    }

    public function redirect_me($path, $controller = "admin")
    {
        echo "<script>location.href = '" . base_url() . $controller . "/" . $path . "'; </script>";
//        redirect(strtolower($this->session->userdata('directory')) . '/' . $controller . "/".$path);
    }
    
}