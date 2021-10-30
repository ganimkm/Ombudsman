<?php

    Class AssignMenuController extends CI_Controller {

    const VIEW_FOLDER = 'helpdesk/general/impact';

    Public Function __construct()
    {
        
        parent::__construct();
        //$this->load->model('SideBarModel');
        $this->load->model('AssignMenuModel');
        $this->load->model('MenuModel');
        
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
        $data['rootmenu'] = $this->MenuModel->Get_Root_Menu();        

        $this->load->library('layouts');

        $this->layouts->set_description('Assign Menu To User');

        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'settings/assignmenu/assignmenutouser'),$data);

    }//index
   
    Public Function Get_Menu_Items()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->MenuModel->Get_Menu_Items()));
         
    }
    
}