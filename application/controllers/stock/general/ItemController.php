<?php

    Class ItemController extends MY_Controller {

    const VIEW_FOLDER = 'stock/general/item';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('stock/general/ItemModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['item'] = $this->ItemModel->get_item();        

        $this->layouts->set_description('Item');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/general/item/list'),$data);

    }//index

    Public Function Add()
    {

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('item_id', 'Item ID', 'numeric|trim|required');
            $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
            $this->form_validation->set_rules('reorder_level_qty', 'Reorder Level Qty', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $data_to_store = array(
                    'item_id' => $this->input->post('item_id'),
                    'item_name' => strtoupper($this->input->post('item_name')),
                    'reorder_level_qty' => $this->input->post('reorder_level_qty'),
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->ItemModel->Insert_Item($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                }
        }
        
        $data = $this->data;     
        
        $data['item'] = $this->ItemModel->Get_Next_Item_ID();
        
        $this->layouts->set_description('Adding Item');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/general/item/add'),$data);
        
    }       

    Public Function Update()
    {

        $item_id = $this->uri->segment(5);

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('item_id', 'item_id', 'numeric|trim|required');
            $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
            $this->form_validation->set_rules('reorder_level_qty', 'Reorder Level Qty', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
                $data_to_store = array(
                'item_id' => $this->input->post('item_id'),
                'item_name' => strtoupper($this->input->post('item_name')),
                'reorder_level_qty' => $this->input->post('reorder_level_qty'),
                'last_update_user_id' => $this->data['user_id']
                );
                    //if the insert has returned true then we show the flash message
                    if($this->ItemModel->update_item($item_id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                    
                redirect('stock/general/item/update/'.$item_id.'');

            }//validation run

        }
        
        $data = $this->data;     

        $data['item'] = $this->ItemModel->get_item($item_id);

        $this->layouts->set_description('Editing Item');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/general/item/edit'),$data);

    }
    
    Public Function Delete()
    {
        
        $item_id = $this->uri->segment(5);  
        
        $this->ItemModel->delete_item($item_id);
        redirect('stock/general/item');
        
    }

}
