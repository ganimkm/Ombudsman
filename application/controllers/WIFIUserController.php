<?php

    Class WIFIUserController extends MY_Controller {

    const VIEW_FOLDER = '';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('WIFIUserModel');
 

    }

    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['user'] = $this->WIFIUserModel->get_wifi_users();        

        $this->layouts->set_description('Wifi Users');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'wifi/list'),$data);
        
       

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('wifi_user_id', 'ID', 'numeric|trim|required');
            $this->form_validation->set_rules('mac_address', 'MAC Address', 'trim|required');
            $this->form_validation->set_rules('employee_id', 'Employee ID', 'trim|required');
            $this->form_validation->set_rules('employee_name', 'Employee Name', 'trim|required');
            $this->form_validation->set_rules('wifi_name', 'Wifi Name', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'wifi_user_id' => $this->input->post('wifi_user_id'),
                    'mac_address' => $this->input->post('mac_address'),
                    'employee_id' => $this->input->post('employee_id'),
                    'employee_name' => $this->input->post('employee_name'),
                    'location' => $this->input->post('location'),
                    'department' => $this->input->post('department'),
                    'wifi_name' => $this->input->post('wifi_name'),
                    'remarks' => $this->input->post('remarks'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->WIFIUserModel->insert_wifi_user($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                        redirect('wifiuser');

                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['wifiuser'] = $this->WIFIUserModel->get_next_wifiuser_id();
        
        $this->layouts->set_description('Adding Wifi User');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'wifi/add'),$data);
        
    }

    Public Function Update()
    {

        $wifi_user_id = $this->uri->segment(3);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

        //form validation
        $this->form_validation->set_rules('wifi_user_id', 'ID', 'numeric|trim|required');
        $this->form_validation->set_rules('mac_address', 'MAC Address', 'trim|required');
        $this->form_validation->set_rules('employee_id', 'Employee ID', 'trim|required');
        $this->form_validation->set_rules('employee_name', 'Employee Name', 'trim|required');
        $this->form_validation->set_rules('wifi_name', 'Wifi Name', 'trim|required');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'wifi_user_id' => $this->input->post('wifi_user_id'),
                'mac_address' => $this->input->post('mac_address'),
                'employee_id' => $this->input->post('employee_id'),
                'employee_name' => $this->input->post('employee_name'),
                'location' => $this->input->post('location'),
                'department' => $this->input->post('department'),
                'wifi_name' => $this->input->post('wifi_name'),
                'remarks' => $this->input->post('remarks'),
                'last_update_user_id' => $this->data['user_id']
                );

                    //if the insert has returned true then we show the flash message
                    if($this->WIFIUserModel->update_wifi_user($wifi_user_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('wifiuser/update/'.$wifi_user_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['wifiuser'] = $this->WIFIUserModel->get_wifi_users($wifi_user_id); 

        $this->layouts->set_description('Editing Wifi User');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'wifi/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $wifi_user_id = $this->uri->segment(3);  
        
        $this->WIFIUserModel->delete_wifi_user($wifi_user_id);
        redirect('wifiuser');
        
    }

}
