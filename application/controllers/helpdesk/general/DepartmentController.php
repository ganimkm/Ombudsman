<?php

    Class DepartmentController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/department';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/DepartmentModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['department'] = $this->DepartmentModel->get_department();        

        $this->layouts->set_description('Department');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/department/list'),$data);

    }

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('department_id', 'Department ID', 'numeric|trim|required');
            $this->form_validation->set_rules('department_name', 'Department Name', 'trim|required');
      
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');

                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                    
                    $data_to_store = array(
                        'department_id' => $this->input->post('department_id'),
                        'department_name' => $this->input->post('department_name'),                  
                        'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->DepartmentModel->Insert_Department($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     

        $data['department'] = $this->DepartmentModel->Get_Next_Department_ID();
        
        $this->layouts->set_description('Adding Department');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/department/add'),$data);
        
    }       

    Public Function Update()
    {

        $department_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('department_id', 'Department ID', 'numeric|trim|required');
            $this->form_validation->set_rules('department_name', 'Department Name', 'trim|required');         
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                
                
                $data_to_store = array(
                    'department_id' => $this->input->post('department_id'),
                    'department_name' => $this->input->post('department_name'),
                    'last_update_user_id' => $this->data['user_id']    
                );
                
                //if the insert has returned true then we show the flash message
                if($this->DepartmentModel->update_department($department_id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                    
                redirect('helpdesk/general/department/update/'.$department_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['department'] = $this->DepartmentModel->get_department($department_id);
        
        $this->layouts->set_description('Editing Department');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/department/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $department_id = $this->uri->segment(5); 
        
        $this->DepartmentModel->delete_department($department_id);
        redirect('helpdesk/general/department');
        
    }
    
    Public Function Get_Department()
    {
        
        $location_id=$this->input->post('location_id');
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->DepartmentModel->Get_Department(Null,$location_id)));
    }
    
    
}
