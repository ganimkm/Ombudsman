<?php

    Class LocationController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/location';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/LocationModel');
        $this->load->model('helpdesk/general/RegionModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['location'] = $this->LocationModel->get_location();        

        $this->layouts->set_description('Location');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/location/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('location_id', 'Location ID', 'numeric|trim|required');
            $this->form_validation->set_rules('location_name', 'Location Name', 'trim|required');
            $this->form_validation->set_rules('region', 'Region', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'location_id' => $this->input->post('location_id'),
                    'location_name' => $this->input->post('location_name'),
                    'region_id' => $this->input->post('region'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->LocationModel->Insert_Location($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['location'] = $this->LocationModel->Get_Next_Location_ID();
        $data['region'] = $this->RegionModel->Get_Region();
        
        $this->layouts->set_description('Adding Location');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/location/add'),$data);
        
    }       

    Public Function Update()
    {

        $location_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('location_id', 'location_id', 'numeric|trim|required');
            $this->form_validation->set_rules('location_name', 'Location Name', 'trim|required');
            $this->form_validation->set_rules('region', 'Region', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'location_id' => $this->input->post('location_id'),
                'location_name' => $this->input->post('location_name'),
                'region_id' => $this->input->post('region'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->LocationModel->update_location($location_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('helpdesk/general/location/update/'.$location_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['location'] = $this->LocationModel->get_location($location_id);
        $data['region'] = $this->RegionModel->get_region();

        $this->layouts->set_description('Editing Location');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/location/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $location_id = $this->uri->segment(5);  
        
        $this->LocationModel->delete_location($location_id);
        redirect('helpdesk/general/location');
        
    }

}
