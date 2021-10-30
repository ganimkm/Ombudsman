<?php

    Class ImpactController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/impact';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/ImpactModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['impact'] = $this->ImpactModel->get_impact();        

        $this->layouts->set_description('Impact');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/impact/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('impact_id', 'Impact ID', 'numeric|trim|required');
            $this->form_validation->set_rules('impact_description', 'Description', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'impact_id' => $this->input->post('impact_id'),
                    'impact_description' => $this->input->post('impact_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->ImpactModel->Insert_Impact($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['impact'] = $this->ImpactModel->Get_Next_Impact_ID();
        
        $this->layouts->set_description('Adding Impact');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/impact/add'),$data);
        
    }       

    Public Function Update()
    {

        $impact_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('impact_id', 'impact_id', 'numeric|trim|required');
            $this->form_validation->set_rules('impact_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'impact_id' => $this->input->post('impact_id'),
                'impact_description' => $this->input->post('impact_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->ImpactModel->update_impact($impact_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('helpdesk/general/impact/update/'.$impact_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['impact'] = $this->ImpactModel->get_impact($impact_id);

        $this->layouts->set_description('Editing Impact');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/impact/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $impact_id = $this->uri->segment(5);  
        
        $this->ImpactModel->delete_impact($impact_id);
        redirect('helpdesk/general/impact');
        
    }

}
