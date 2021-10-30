<?php

    Class SubCategoryController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/subcategory';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/SubCategoryModel');
        $this->load->model('helpdesk/general/CategoryModel');

    }

    Public Function Get_Sub_Category()
    {
        $category_id=$this->input->post('category_id');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->SubCategoryModel->Get_Sub_Category(null,$category_id)));
    }
    
    Public Function Index()
    {
        
        $data = $this->data;     
        
        $data['sub_category'] = $this->SubCategoryModel->get_Sub_Category();        

        $this->layouts->set_description('Sub Category');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/subcategory/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('sub_category_id', 'Sub Category ID', 'numeric|trim|required');
            $this->form_validation->set_rules('sub_category_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('category', 'Category', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a>', '</div>');
      
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {

                    $data_to_store = array(
                    'sub_category_id' => $this->input->post('sub_category_id'),
                    'sub_category_description' => $this->input->post('sub_category_description'),
                    'category_id' => $this->input->post('category'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->SubCategoryModel->Insert_Sub_Category($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
            
        $data['sub_category'] = $this->SubCategoryModel->Get_Next_Sub_Category_ID();
        $data['category'] = $this->CategoryModel->Get_Category();
        
        $this->layouts->set_description('Adding Sub Category');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/subcategory/add'),$data);
        
    }       

    Public Function Update()
    {

        $sub_category_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('sub_category_id', 'Sub Category ID', 'numeric|trim|required');
            $this->form_validation->set_rules('sub_category_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('category', 'Category', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'sub_category_id' => $this->input->post('sub_category_id'),
                'sub_category_description' => $this->input->post('sub_category_description'),
                'category_id' => $this->input->post('category'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->SubCategoryModel->update_Sub_Category($sub_category_id, $data_to_store) == TRUE){
                            $this->session->set_flashdata('flash_message', 'updated');
                        }else{
                            $this->session->set_flashdata('flash_message', 'not_updated');
                        }
                    
                redirect('helpdesk/general/subcategory/update/'.$sub_category_id.'');

            }//validation run

        }
        
        $data = $this->data;     
        
        $data['sub_category'] = $this->SubCategoryModel->Get_Sub_Category($sub_category_id);
        $data['category'] = $this->CategoryModel->Get_Category();

        $this->layouts->set_description('Editing Sub Category');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/subcategory/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $sub_category_id = $this->uri->segment(5);  
        
        $this->SubCategoryModel->delete_Sub_Category($sub_category_id);
        redirect('helpdesk/general/subcategory');
        
    }

}
