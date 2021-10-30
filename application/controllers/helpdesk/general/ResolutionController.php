<?php

    Class ResolutionController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/resolution';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/ResolutionModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['resolution'] = $this->ResolutionModel->get_resolution();        

        $this->layouts->set_description('Resolution');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/resolution/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('resolution_id', 'Resolution ID', 'numeric|trim|required');
            $this->form_validation->set_rules('resolution_description', 'Description', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'resolution_id' => $this->input->post('resolution_id'),
                    'resolution_description' => $this->input->post('resolution_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->ResolutionModel->Insert_Resolution($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['resolution'] = $this->ResolutionModel->Get_Next_Resolution_ID();
        
        $this->layouts->set_description('Adding Resolution');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/resolution/add'),$data);
        
    }       

    Public Function Update()
    {

        $resolution_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('resolution_id', 'resolution_id', 'numeric|trim|required');
            $this->form_validation->set_rules('resolution_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'resolution_id' => $this->input->post('resolution_id'),
                'resolution_description' => $this->input->post('resolution_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->ResolutionModel->update_resolution($resolution_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('helpdesk/general/resolution/update/'.$resolution_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['resolution'] = $this->ResolutionModel->get_resolution($resolution_id);

        $this->layouts->set_description('Editing Resolution');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/resolution/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $resolution_id = $this->uri->segment(5);  
        
        $this->ResolutionModel->delete_resolution($resolution_id);
        redirect('helpdesk/general/resolution');
        
    }

}
