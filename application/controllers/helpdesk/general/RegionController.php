<?php

    Class RegionController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/region';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/RegionModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['region'] = $this->RegionModel->get_region();        

        $this->layouts->set_description('Region');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/region/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('region_id', 'Region ID', 'numeric|trim|required');
            $this->form_validation->set_rules('region_name', 'Region Name', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'region_id' => $this->input->post('region_id'),
                    'region_name' => $this->input->post('region_name'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->RegionModel->Insert_Region($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['region'] = $this->RegionModel->Get_Next_Region_ID();
        
        $this->layouts->set_description('Adding Region');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/region/add'),$data);
        
    }       

    Public Function Update()
    {

        $region_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('region_id', 'region_id', 'numeric|trim|required');
            $this->form_validation->set_rules('region_name', 'Region Name', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'region_id' => $this->input->post('region_id'),
                'region_name' => $this->input->post('region_name'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->RegionModel->update_region($region_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('helpdesk/general/region/update/'.$region_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['region'] = $this->RegionModel->get_region($region_id);

        $this->layouts->set_description('Editing Region');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/region/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $region_id = $this->uri->segment(5);  
        
        $this->RegionModel->delete_region($region_id);
        redirect('helpdesk/general/region');
        
    }

}
