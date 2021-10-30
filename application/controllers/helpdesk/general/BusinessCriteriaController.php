<?php

    Class BusinessCriteriaController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/businesscriteria';

    Public Function __construct()
    {
        
        parent::__construct();
          
        $this->load->model('helpdesk/general/BusinessCriteriaModel');
        
    }

    Public Function Index()
    {
        
        $data = $this->data;     
 
        $data['business_criteria'] = $this->BusinessCriteriaModel->Get_Business_Criteria();        
         
        $this->layouts->set_description('Business Criteria');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/businesscriteria/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('business_criteria_id', 'Business Criteria ID', 'numeric|trim|required');
            $this->form_validation->set_rules('business_criteria_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');

                //if the form has passed through the validation
                if ($this->form_validation->run())
                {

                    $data_to_store = array(
                    'business_criteria_id' => $this->input->post('business_criteria_id'),
                    'business_criteria_description' => $this->input->post('business_criteria_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->BusinessCriteriaModel->Insert_Business_Criteria($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['business_criteria'] = $this->BusinessCriteriaModel->Get_Next_Business_Criteria_ID();
        
        $this->layouts->set_description('Adding Business Criteria');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/businesscriteria/add'),$data);
        
    }       

    Public Function Update()
    {

        $business_criteria_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('business_criteria_id', 'Business Criteria ID', 'numeric|trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'business_criteria_id' => $this->input->post('business_criteria_id'),
                'business_criteria_description' => $this->input->post('description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->BusinessCriteriaModel->update_Business_Criteria($business_criteria_id, $data_to_store) == TRUE){
                            $this->session->set_flashdata('flash_message', 'updated');
                        }else{
                            $this->session->set_flashdata('flash_message', 'not_updated');
                        }
                    
                redirect('helpdesk/general/businesscriteria/update/'.$business_criteria_id.'');

            }//validation run

        }
        
        $data = $this->data;     
        
        $data['business_criteria'] = $this->BusinessCriteriaModel->Get_Business_Criteria($business_criteria_id);

        $this->layouts->set_description('Editing Business Criteria');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/businesscriteria/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $business_criteria_id = $this->uri->segment(5);    
        
        $this->BusinessCriteriaModel->Delete_Business_Criteria($business_criteria_id);
        redirect('helpdesk/general/businesscriteria');
        
    }

}
