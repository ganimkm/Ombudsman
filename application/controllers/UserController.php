<?php

    Class UserController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/user';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/LocationModel');
        $this->load->model('helpdesk/general/DepartmentModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['user'] = $this->UserModel->get_user();        

        $this->layouts->set_description('User');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'user/list'),$data);
        
       

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'numeric|trim|required');
            $this->form_validation->set_rules('department', 'Department', 'numeric|trim|required');            
            $this->form_validation->set_rules('is_active', 'IS Active', 'trim|required');
            $this->form_validation->set_rules('is_admin', 'IS Admin', 'trim|required');
            $this->form_validation->set_rules('is_ticket_resolver', 'IS Ticket Resolver', 'trim|required');
           
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
           
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                    
                    
                    $data_to_store = array(
                    'user_id' => $this->input->post('user_id'),
                    'user_name' => $this->input->post('user_name'),
                    'password' => $this->encrypt->encode($this->input->post('password')),
                    'email_address' => $this->input->post('email'),
                    'mobile_number' => $this->input->post('mobile_number'),
                    'designation' => $this->input->post('designation'),
                    'location_id' => $this->input->post('location'),
                    'department_id' => $this->input->post('department'),
                    'is_active' => $this->input->post('is_active'),
                    'is_admin' => $this->input->post('is_admin'),  
                    'is_ticket_resolver' => $this->input->post('is_ticket_resolver'),  
    
                    );
                    
                    if($this->UserModel->Insert_User($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     

        $data['location'] = $this->LocationModel->Get_Location();
        $data['department'] = $this->DepartmentModel->Get_Department();
                        
        $this->layouts->set_description('Adding User');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'user/add'),$data);
        
    }       

    Public Function Update()
    {
        
        $user_id = $this->uri->segment(3);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'numeric|trim|required');
            $this->form_validation->set_rules('department', 'Department', 'numeric|trim|required');            
            $this->form_validation->set_rules('is_active', 'IS Active', 'trim|required');
            $this->form_validation->set_rules('is_admin', 'IS Admin', 'trim|required');
            $this->form_validation->set_rules('is_ticket_resolver', 'IS Ticket Resolver', 'trim|required');  
 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                    $data_to_store = array(
                    'user_id' => $this->input->post('user_id'),
                    'user_name' => $this->input->post('user_name'),
                    'password' => $this->encrypt->encode($this->input->post('password')),
                    'email_address' => $this->input->post('email'),
                    'mobile_number' => $this->input->post('mobile_number'),
                    'designation' => $this->input->post('designation'),
                    'location_id' => $this->input->post('location'),
                    'department_id' => $this->input->post('department'),
                    'is_active' => $this->input->post('is_active'),
                    'is_admin' => $this->input->post('is_admin'),  
                    'is_ticket_resolver' => $this->input->post('is_ticket_resolver'), 
                        
                );
                    //if the insert has returned true then we show the flash message
                    if($this->UserModel->update_user($user_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('user/update/'.$user_id.'');

            }//validation run

        }
        
        $data = $this->data;  
        
        $data['user'] = $this->UserModel->Get_User($user_id);
        $data['location'] = $this->LocationModel->Get_Location();
        $data['department'] = $this->DepartmentModel->Get_Department();
        
        $this->layouts->set_description('Editing User');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'user/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $user_id = $this->uri->segment(3);  
        
        $this->UserModel->delete_user($user_id);
        redirect('user');
        
    }

}
