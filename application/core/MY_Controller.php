<?php

class MY_Controller Extends CI_Controller
{

    public function __construct()
    {
        
        parent::__construct();
      
        $this->load->model('UserModel');
        $this->load->model('MenuModel');
        
        $this->load->library('layouts');
        
//        $user = $this->UserModel->get_all_user();    
//        
//        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
//        
//        foreach($user as $row)
//        {
//            
//              $data_to_store = array(
//                    'password' => $this->encrypt->encode($row['user_id']),   
//                );
//            
//              $this->UserModel->update_user($row['user_id'], $data_to_store);
//            
//        }
        
        if(!$this->session->userdata('logged_in')){
            redirect('login','refresh');
        }
        
        $session_data = $this->session->userdata('logged_in');
        $this->session->set_userdata("verified", $session_data);        
        $session = $this->session->userdata("verified");
        
        $this->data = array(
            'user_id' => $session['user_id'],
            'user_name' => $session['user_name'],
            'is_admin' => $session['is_admin'],
            'is_active' => $session['is_active'],
            'is_ticket_resolver' => $session['is_ticket_resolver'],
            'designation' => $session['designation']
        );
        

        $this->data['profile'] = $this->UserModel->Get_User($session['user_id']); 
        $this->data['menus'] = $this->MenuModel->Get_HTML_Menu($session['user_id'],$session['is_admin']); 
           
    }
    
}