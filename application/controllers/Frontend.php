<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $userData = ["directory" => "frontend"];
        $this->session->set_userdata($userData);
        
    }
    public function index(){
        // $result = $this->db->get_where('slider' , array('status' => 'Active'))->result_array();
        // $team_record = $this->db->get_where('team' , array('status' => 'Active'))->result_array();
        // $reviews = $this->db->get_where('reviews', array('status'=>'Active'))->result_array();
        // $clients = $this->db->get_where('clients', array('status'=>'Active'))->result_array();
        // $projects = $this->db->get_where('projects', array('status'=>'Active'))->result_array();
        // $goals = $this->db->get_where('brinkman_system_settings', array('type'=>'goal'))->row()->description;
        // $grow = $this->db->get_where('brinkman_system_settings', array('type'=>'grow'))->row()->description;
        // $footer = $this->db->get_where('brinkman_system_settings', array('type'=>'footer_text'))->row()->description;
        // $twitter = $this->db->get_where('brinkman_system_settings', array('type'=>'twitter'))->row()->description;
        // $insta = $this->db->get_where('brinkman_system_settings', array('type'=>'instagram'))->row()->description;
        // $linkdin = $this->db->get_where('brinkman_system_settings', array('type'=>'linkdin'))->row()->description;
        // $facebook = $this->db->get_where('brinkman_system_settings', array('type'=>'facebook'))->row()->description;
        //  $data=["slider"=>$result , "team"=>$team_record , "reviews"=>$reviews , "clients"=>$clients , "projects"=>$projects , "goals"=>$goals ,"grow"=>$grow ,"footer_txt"=>$footer , "twitter"=>$twitter , "insta"=>$insta ,"linkdin"=>$linkdin , "facebook"=>$facebook];
        // $this->load->view('frontend/index', $data);

    }
    public function privacy(){
        // echo "here";
        $this->load->view('frontend/privacy_policy');
    }
    public function send_email(){

        $data['name']             = $this->input->post('name');
        $data['email']             = $this->input->post('email');
        $data['details']              = $this->input->post('details');

        $result = $this->Email_model->admin_message($data);

        
    }
}
?>