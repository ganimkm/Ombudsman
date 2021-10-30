<?php

    Class CategoryController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/category';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/CategoryModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['category'] = $this->CategoryModel->get_category();        

        $this->layouts->set_description('Category');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/category/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('category_id', 'Category ID', 'numeric|trim|required');
            $this->form_validation->set_rules('category_description', 'Description', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'category_id' => $this->input->post('category_id'),
                    'category_description' => $this->input->post('category_description'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->CategoryModel->Insert_Category($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['category'] = $this->CategoryModel->Get_Next_Category_ID();
        
        $this->layouts->set_description('Adding Category');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/category/add'),$data);
        
    }       

    Public Function Update()
    {

        $category_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('category_id', 'category_id', 'numeric|trim|required');
            $this->form_validation->set_rules('category_description', 'Description', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'category_id' => $this->input->post('category_id'),
                'category_description' => $this->input->post('category_description'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->CategoryModel->update_category($category_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('helpdesk/general/category/update/'.$category_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['category'] = $this->CategoryModel->get_category($category_id);

        $this->layouts->set_description('Editing Category');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/category/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $category_id = $this->uri->segment(5);  
        
        $this->CategoryModel->delete_category($category_id);
        redirect('helpdesk/general/category');
        
    }

}
