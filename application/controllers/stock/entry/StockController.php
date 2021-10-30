<?php

    Class StockController extends MY_Controller {

    const VIEW_FOLDER = 'stock/entry/stock';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('stock/entry/StockModel');
        $this->load->model('stock/general/ItemModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['stock'] = $this->StockModel->get_current_stock();        

        $this->layouts->set_description('Stock');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/entry/stock'),$data);

    }//index

    Public Function issue_delete()
    {
        
        $data = $this->data;     

        $data['issue_data'] = $this->StockModel->get_issue_detail();        

        $this->layouts->set_description('Stock');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/entry/issue_delete'),$data);

    }//index
    
    public function inward()
    {
        
        $item_id = $this->uri->segment(4);
        
        //echo $user_id;
        //print_r($planned_sla_time);
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('inward_number', 'Inward Number', 'numeric|trim|required');
            $this->form_validation->set_rules('inward_date', 'Inward Date', 'trim|required');
            $this->form_validation->set_rules('inward_time', 'Inward Time', 'trim|required');
            $this->form_validation->set_rules('inward_qty', 'Inward Qty', 'numeric|trim|required');
            $this->form_validation->set_rules('ref_number', 'Ref Number', 'trim');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                     
                    $inward = $this->StockModel->get_next_inward_number();

                    $inward_on = @date('Y-m-d H:i:s', @strtotime($this->input->post('inward_date') . $this->input->post('inward_time')));        
                    
                    $data_to_store = array(
                        'inward_number' => $inward[0]['next_inward_number'],
                        'inward_date' => $inward_on,
                        'item_id' => $item_id,
                        'inward_qty' => $this->input->post('inward_qty'),
                        'ref_number' => strtoupper($this->input->post('ref_number')), 
                        'last_update_user_id' => $this->data['user_id']
                    );
                    
                    $stock_register_data = array(
                        'item_id' => $item_id,
                        'date_on' => $inward_on,
                        'item_qty' => $this->input->post('inward_qty'),
                        'inward_number' => $inward[0]['next_inward_number'],
                        'ref_number' => $this->input->post('ref_number')
                    );
                    
                    if($this->StockModel->Insert_Inward($data_to_store,$stock_register_data))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }

                    redirect('stock/entry');
                                            
                }
        }
        
        $data = $this->data;     

        $data['inward'] = $this->StockModel->get_next_inward_number();
        $data['item'] = $this->ItemModel->get_item($item_id);
               
        $this->layouts->set_description('Item Inward');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/entry/inward'),$data);
        
    } 
    
    public function issue()
    {
        
        $item_id = $this->uri->segment(4);
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('issue_number', 'Issue Number', 'numeric|trim|required');
            $this->form_validation->set_rules('issue_date', 'Issue Date', 'trim|required');
            $this->form_validation->set_rules('issue_time', 'Issue Time', 'trim|required');
            $this->form_validation->set_rules('issue_qty', 'Issue Qty', 'numeric|trim|required');
            $this->form_validation->set_rules('ref_number', 'Ref Number', 'trim');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
            
            $item_stock = $this->StockModel->get_current_stock($item_id);  
     
            if ($item_stock[0]['item_stock'] < $this->input->post('issue_qty')){
                $this->session->set_flashdata('err_message', 'Issue Qty should not exceed with Stock, Current Stock of this item '.$item_stock[0]['item_stock']);
                redirect('stock/entry/issue/'.$item_id);
            }
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                     
                    $issue = $this->StockModel->get_next_issue_number();

                    $issue_on = @date('Y-m-d H:i:s', @strtotime($this->input->post('issue_date') . $this->input->post('issue_time')));        
                    
                    $data_to_store = array(
                        'issue_number' => $issue[0]['next_issue_number'],
                        'issue_date' => $issue_on,
                        'item_id' => $item_id,
                        'issue_qty' => $this->input->post('issue_qty'),
                        'ref_number' => strtoupper($this->input->post('ref_number')), 
                        'last_update_user_id' => $this->data['user_id']
                    );
                    
                    $stock_register_data = array(
                        'item_id' => $item_id,
                        'date_on' => $issue_on,
                        'item_qty' => $this->input->post('issue_qty') * -1 ,
                        'issue_number' => $issue[0]['next_issue_number'],
                        'ref_number' => strtoupper($this->input->post('ref_number'))
                    );
                    
                    if($this->StockModel->Insert_Issue($data_to_store,$stock_register_data))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }

                    redirect('stock/entry');
                                            
                }
        }
        
        $data = $this->data;     

        $data['issue'] = $this->StockModel->get_next_issue_number();
        $data['item'] = $this->ItemModel->get_item($item_id);
               
        $this->layouts->set_description('Item Issue');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/entry/issue'),$data);
        
    } 
         
    Public Function delete_issue()
    {
        
        $issue_number = $this->uri->segment(5);  
        
        $this->StockModel->delete_issue($issue_number);
        redirect('stock/entry/issue_delete');
        
    }
   
}
