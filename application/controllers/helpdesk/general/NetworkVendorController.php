<?php

    Class NetworkVendorController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/general/networkvendor';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('helpdesk/general/NetworkVendorModel');
     
    }

    Public Function Index()
    {
        
        $data = $this->data;     

        $data['networkvendor'] = $this->NetworkVendorModel->get_network_vendor();        

        $this->layouts->set_description('Network Vendor');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/general/networkvendor/list'),$data);

    }//index

}
