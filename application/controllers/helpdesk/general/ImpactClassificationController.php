<?php

    Class ImpactClassificationController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/impactclassification';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/ImpactClassificationModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['impact_classification'] = $this->ImpactClassificationModel->get_Impact_Classification();        

        $this->layouts->set_description('Impact Classification');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/impactclassification/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('impact_classification_id', 'Impact Classification ID', 'numeric|trim|required');
            $this->form_validation->set_rules('impact_classification_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a>', '</div>');
      
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {

                    $data_to_store = array(
                    'impact_classification_id' => $this->input->post('impact_classification_id'),
                    'impact_classification_description' => $this->input->post('impact_classification_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->ImpactClassificationModel->Insert_Impact_Classification($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
            
        $data['impact_classification'] = $this->ImpactClassificationModel->Get_Next_Impact_Classification_ID();
        
        $this->layouts->set_description('Adding Impact Classification');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/impactclassification/add'),$data);
        
    }       

    Public Function Update()
    {

        $impact_classification_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('impact_classification_id', 'Impact Classification ID', 'numeric|trim|required');
            $this->form_validation->set_rules('impact_classification_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'impact_classification_id' => $this->input->post('impact_classification_id'),
                'impact_classification_description' => $this->input->post('impact_classification_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->ImpactClassificationModel->update_Impact_Classification($impact_classification_id, $data_to_store) == TRUE){
                            $this->session->set_flashdata('flash_message', 'updated');
                        }else{
                            $this->session->set_flashdata('flash_message', 'not_updated');
                        }
                    
                redirect('helpdesk/general/impactclassification/update/'.$impact_classification_id.'');

            }//validation run

        }
        
        $data = $this->data;     
        
        $data['impact_classification'] = $this->ImpactClassificationModel->Get_Impact_Classification($impact_classification_id);

        $this->layouts->set_description('Editing Impact Classification');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/impactclassification/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $impact_classification_id = $this->uri->segment(5);  
        
        $this->ImpactClassificationModel->delete_Impact_Classification($impact_classification_id);
        redirect('helpdesk/general/impactclassification');
        
    }

}
