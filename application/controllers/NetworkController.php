<?php

    Class NetworkController extends CI_Controller {
        
    Public Function __construct()
    {
        
        parent::__construct();
        //$this->load->model('SideBarModel');
        $this->load->model('NetworkModel');

        if(!$this->session->userdata('logged_in')){
            redirect('login','refresh');
        }
    }

    Public Function Index()
    {
        
        $session_data = $this->session->userdata('logged_in');
        $this->session->set_userdata("verified", $session_data);        
        $session = $this->session->userdata("verified");
        
        $data['user_id'] = $session['user_id'];
        $data['user_name'] = $session['user_name'];
        $data['designation'] = $session['designation'];  
        
        //$data['user_menu'] = $this->SideBarModel->Get_Menu($session['user_id']); 
        $data['ip_interface'] = $this->NetworkModel->Get_IP_Interface();        

        $this->load->library('layouts');

        $this->layouts->set_description('Network Traffic');

        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'network/monitor/traffic/interfacetraffic'),$data);

    }//index
    
    Public Function Get_Network_Device_Current_Status()
    {
        
        $ipstatus=$this->input->post('ip_status');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->NetworkModel->Get_Network_Device_Current_Status($ipstatus)));
         
    }   
          
}
