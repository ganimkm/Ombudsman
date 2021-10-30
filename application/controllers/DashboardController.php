<?php

Class DashboardController extends MY_Controller{
    
    Public Function __construct()
    {        
        parent::__construct();

        $this->load->model('HelpdeskModel');
        $this->load->model('UserModel');
        $this->load->model('stock/entry/StockModel');
        
    }
    
    public function index(){  
        
        $data = $this->data;     
        
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'dashboard/dashboard'),$data);
        
        //$result=$this->HelpdeskModel->get_pending_call_details($this->data['user_id']);
        
    }
    
    public function get_pending_incidents()
    {
        
        $data = $this->data;  
         
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->get_pending_incidents($this->data['user_id'])));
         
    }
    
    public function get_hold_incidents()
    {
        
        $data = $this->data;  
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->get_hold_incidents($this->data['user_id'])));
         
    }
    
   public function get_items_stock()
    {
        
        $data = $this->data;  
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->StockModel->get_current_stock()));
         
    }
    
}

?>

