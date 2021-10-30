<?php

    Class MenuController extends CI_Controller {

    const VIEW_FOLDER = 'settings/menu';

    Public Function __construct()
    {
        
        parent::__construct();
        //$this->load->model('SideBarModel');
        $this->load->model('MenuModel');

        if(!$this->session->userdata('logged_in')){
            redirect('login','refresh');
        }
    }

    Public Function Index()
    {
        
        $session_data = $this->session->userdata('logged_in');
        $data['user_id'] = $session_data['user_id'];
        $data['user_name'] = $session_data['user_name'];
        $data['designation'] = $session_data['designation'];
        $this->session->set_userdata("verified", $session_data);
        
        $session = $this->session->userdata("verified");
        //$data['user_menu'] = $this->SideBarModel->Get_Menu($session['user_id']);
 
        $data['menu'] = $this->MenuModel->get_menu();        

        $this->load->library('layouts');

        $this->layouts->set_description('Menu');

        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'settings/menu/list'),$data);
        
        //echo $this->MenuModel->Get_Menu_Levels_Below(22);
        //echo $this->MenuModel->Get_Menu_Items4User('3100002',-1);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('menu_id', 'Menu ID', 'numeric|trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('menu_group', 'Menu Group ID');
            $this->form_validation->set_rules('page_link', 'Page Link');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            

                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                    $session = $this->session->userdata("verified");
                    
                    $data_to_store = array(
                    'menu_id' => $this->input->post('menu_id'),
                    'description' => $this->input->post('description'),
                    'menu_group_id' => $this->input->post('menu_group'),
                    'page_link' => $this->input->post('page_link'),
                    'last_update_user_id' => $session['user_id']
                    );
                    
                    if($this->MenuModel->Insert_Menu($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        //$data['user_menu'] = $this->SideBarModel->Get_Menu($session['user_id']);
         
        $data['menu'] = $this->MenuModel->Get_Next_Menu_ID();
        $data['menu_group'] = $this->MenuModel->Get_Menu_Group();
        
        $this->load->library('layouts');

        

        $this->layouts->set_description('Adding Menu');

        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'settings/menu/add'),$data);
        
    }       

    Public Function Update()
    {

        $menu_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('menu_id', 'menu_id', 'numeric|trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $session = $this->session->userdata("verified");
                
                $data_to_store = array(
                'menu_id' => $this->input->post('menu_id'),
                'description' => $this->input->post('description'),
                'last_update_user_id' => $session['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->MenuModel->update_menu($menu_id, $data_to_store) == TRUE){
                            $this->session->set_flashdata('flash_message', 'updated');
                        }else{
                            $this->session->set_flashdata('flash_message', 'not_updated');
                        }
                    
                redirect('settings/menu/update/'.$menu_id.'');

            }//validation run

        }
        
        //$data['user_menu'] = $this->SideBarModel->Get_Menu($session['user_id']);
          
        $data['menu'] = $this->MenuModel->get_menu($menu_id);

        $this->load->library('layouts');

        

        $this->layouts->set_description('Editing Menu');

        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'settings/menu/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $menu_id = $this->uri->segment(5);    
        $this->MenuModel->delete_menu($menu_id);
        redirect('settings/menu');
        
    }

}
