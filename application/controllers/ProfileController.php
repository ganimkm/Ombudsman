<?php

    Class ProfileController extends MY_Controller {

    Public Function __construct()
    {
        
        parent::__construct();
        
        $this->load->model('MenuModel');
        $this->load->model('PageModel');
        $this->load->model('UserModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['user_id'] = $this->data['user_id'];
        $data['user_name'] = $this->data['user_name'];
        $data['designation'] = $this->data['designation'];       

        $data['profile'] = $this->UserModel->get_user($this->data['user_id']);       
        
        $this->layouts->set_description('Profile');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'profile'),$data);
          
    }//index  
    
    Public Function Update()
    {
        
        $data = $this->data;
        
        $user_id = $this->data['user_id'];

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){

                if($_FILES['uploadfile']['name']!="")
                    {
                        //load library
                        $this->load->library('upload');

                        //Set the config
                        $config['upload_path'] = './images/'; //Use relative or absolute path
                        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
                        $config['max_size'] = '10240';
                        $config['overwrite'] = false; //If the file exists it will be saved with a progressive number appended

                        //Initialize
                        $this->upload->initialize($config);

                        //Upload file
                        if(!$this->upload->do_upload('uploadfile')){
                            //echo the errors
                            echo $this->upload->display_errors();
                        }

                        //If the upload success
                        $file_name = $this->upload->file_name;

                        $data_to_store = array(
                            'user_id' => $this->input->post('user_id'),
                            'user_name' => $this->input->post('user_name'),
                            'password' => $this->encrypt->encode($this->input->post('password')),
                            'email_address' => $this->input->post('email'),
                            'mobile_number' => $this->input->post('mobile_number'),
                            'designation' => $this->input->post('designation'),
                            'profile_picture' => $file_name,
                        );
                        
                    }else{
                        
                        $data_to_store = array(
                            'user_id' => $this->input->post('user_id'),
                            'user_name' => $this->input->post('user_name'),
                            'password' => $this->encrypt->encode($this->input->post('password')),
                            'email_address' => $this->input->post('email'),
                            'mobile_number' => $this->input->post('mobile_number'),
                            'designation' => $this->input->post('designation'),
                        );
                        
                    }
 
                    //if the insert has returned true then we show the flash message
                    if($this->UserModel->update_user($user_id, $data_to_store) == TRUE)
                    {
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('profile');

            }//validation run
        } 
    }
}    