<?php

    Class CallModeController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/callmode';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/CallModeModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['call_mode'] = $this->CallModeModel->get_Call_Mode();        

        $this->layouts->set_description('Call Mode');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/callmode/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('call_mode_id', 'Call Mode ID', 'numeric|trim|required');
            $this->form_validation->set_rules('call_mode_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a>', '</div>');
      
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {

                    $data_to_store = array(
                    'call_mode_id' => $this->input->post('call_mode_id'),
                    'call_mode_description' => $this->input->post('call_mode_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->CallModeModel->Insert_Call_Mode($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
            
        $data['call_mode'] = $this->CallModeModel->Get_Next_Call_Mode_ID();
        
        $this->layouts->set_description('Adding Call Mode');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/callmode/add'),$data);
        
    }       

    Public Function Update()
    {

        $call_mode_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('call_mode_id', 'Call Mode ID', 'numeric|trim|required');
            $this->form_validation->set_rules('call_mode_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'call_mode_id' => $this->input->post('call_mode_id'),
                'call_mode_description' => $this->input->post('call_mode_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->CallModeModel->update_Call_Mode($call_mode_id, $data_to_store) == TRUE){
                            $this->session->set_flashdata('flash_message', 'updated');
                        }else{
                            $this->session->set_flashdata('flash_message', 'not_updated');
                        }
                    
                redirect('helpdesk/general/callmode/update/'.$call_mode_id.'');

            }//validation run

        }
        
        $data = $this->data;     
        
        $data['call_mode'] = $this->CallModeModel->Get_Call_Mode($call_mode_id);

        $this->layouts->set_description('Editing Call Mode');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/callmode/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $call_mode_id = $this->uri->segment(5);  
        
        $this->CallModeModel->delete_Call_Mode($call_mode_id);
        redirect('helpdesk/general/callmode');
        
    }

}
