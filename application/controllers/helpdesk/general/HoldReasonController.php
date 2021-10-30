<?php

    Class HoldReasonController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/holdreason';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/HoldReasonModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['hold_reason'] = $this->HoldReasonModel->get_hold_reason();        

        $this->layouts->set_description('Hold Reason');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/holdreason/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('hold_reason_id', 'Hold Reason ID', 'numeric|trim|required');
            $this->form_validation->set_rules('hold_reason_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');


                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                       
                    $data_to_store = array(
                    'hold_reason_id' => $this->input->post('hold_reason_id'),
                    'hold_reason_description' => $this->input->post('hold_reason_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->HoldReasonModel->Insert_Hold_Reason($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     

        $data['hold_reason'] = $this->HoldReasonModel->Get_Next_Hold_Reason_ID();
                
        $this->layouts->set_description('Adding Hold Reason');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/holdreason/add'),$data);
        
    }       

    Public Function Update()
    {

        $hold_reason_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('hold_reason_id', 'hold_reason_id', 'numeric|trim|required');
            $this->form_validation->set_rules('hold_reason_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'hold_reason_id' => $this->input->post('hold_reason_id'),
                'hold_reason_description' => $this->input->post('hold_reason_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                
                //if the insert has returned true then we show the flash message
                if($this->HoldReasonModel->update_hold_reason($hold_reason_id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                    
                redirect('helpdesk/general/holdreason/update/'.$hold_reason_id.'');

            }//validation run

        }
        
        $data = $this->data;     
      
        $data['hold_reason'] = $this->HoldReasonModel->get_hold_reason($hold_reason_id);

        $this->layouts->set_description('Editing Hold Reason');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/holdreason/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $hold_reason_id = $this->uri->segment(5);  
        
        $this->HoldReasonModel->delete_hold_reason($hold_reason_id);
        redirect('helpdesk/general/holdreason');
        
    }

}
