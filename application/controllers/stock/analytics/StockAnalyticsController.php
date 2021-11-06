<?php

    Class StockAnalyticsController extends MY_Controller {

    const VIEW_FOLDER = 'callreport/dailyreport';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('stock/analytics/StockAnalyticsModel');
        $this->load->model('stock/general/ItemModel');

    }

    public function stockregister()
    {
        
        $data = $this->data;     
        
        $from_date = @date('Y-m-d', @strtotime(date('01-m-Y'))); // Month First day
        $to_date  = @date('Y-m-d', @strtotime(date('t-m-Y')));  // Month Last day
        $item_id="ALL";
     
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $from_date=@date('Y-m-d', @strtotime($this->input->post('from_date')));
            $to_date=@date('Y-m-d', @strtotime($this->input->post('to_date')));
            $item_id = $this->input->post('stock_item');

            $data['stock_single_item'] = $this->ItemModel->get_item($item_id);

        }
     
        $data['stock_item'] = $this->ItemModel->get_item();
        $data['stock'] = $this->StockAnalyticsModel->get_stock_register($from_date,$to_date,$item_id);
        
        $data['from_date']=$from_date;
        $data['to_date']=$to_date;
                
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'stock/analytics/stockregister'),$data);
            
    }
    

    
}