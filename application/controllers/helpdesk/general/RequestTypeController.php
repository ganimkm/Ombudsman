<?php

    Class RequestTypeController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/requesttype';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/RequestTypeModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['request_type'] = $this->RequestTypeModel->get_Request_Type();        

        $this->layouts->set_description('Request Type');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/requesttype/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('request_type_id', 'Request Type ID', 'numeric|trim|required');
            $this->form_validation->set_rules('request_type_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a>', '</div>');
      
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {

                    $data_to_store = array(
                    'request_type_id' => $this->input->post('request_type_id'),
                    'request_type_description' => $this->input->post('request_type_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->RequestTypeModel->Insert_Request_Type($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
            
        $data['request_type'] = $this->RequestTypeModel->Get_Next_Request_Type_ID();
        
        $this->layouts->set_description('Adding Request Type');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/requesttype/add'),$data);
        
    }       

    Public Function Update()
    {

        $request_type_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('request_type_id', 'Request Type ID', 'numeric|trim|required');
            $this->form_validation->set_rules('request_type_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'request_type_id' => $this->input->post('request_type_id'),
                'request_type_description' => $this->input->post('request_type_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->RequestTypeModel->update_Request_Type($request_type_id, $data_to_store) == TRUE){
                            $this->session->set_flashdata('flash_message', 'updated');
                        }else{
                            $this->session->set_flashdata('flash_message', 'not_updated');
                        }
                    
                redirect('helpdesk/general/requesttype/update/'.$request_type_id.'');

            }//validation run

        }
        
        $data = $this->data;     
        
        $data['request_type'] = $this->RequestTypeModel->Get_Request_Type($request_type_id);

        $this->layouts->set_description('Editing Request Type');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/requesttype/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $request_type_id = $this->uri->segment(5);  
        
        $this->RequestTypeModel->delete_Request_Type($request_type_id);
        redirect('helpdesk/general/requesttype');
        
    }

}
