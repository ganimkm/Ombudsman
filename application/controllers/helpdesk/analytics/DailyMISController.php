<?php

    Class DailyMISController extends CI_Controller {

    const VIEW_FOLDER = 'callreport/dailyreport';

    Public Function __construct()
    {
        
        parent::__construct();
        //$this->load->model('SideBarModel');
        $this->load->model('HelpdeskModel');

        if(!$this->session->userdata('logged_in')){
            redirect('login','refresh');
        }
        
        $session_data = $this->session->userdata('logged_in');
        $this->session->set_userdata("verified", $session_data);        
        $session = $this->session->userdata("verified");
        
        $this->data = array(
            'user_id' => $session['user_id'],
            'user_name' => $session['user_name'],
            'designation' => $session['designation']
        );
        
    }

    Public Function Index()
    {
        
        $data = $this->data;     
        $session = $this->session->userdata("verified");

        //$data['user_menu'] = $this->SideBarModel->Get_Menu($session['user_id']);
        
        $todate=date('Y-m-d', strtotime('-1 day'));
        
            if ($this->input->server('REQUEST_METHOD') === 'POST'){

                $todate=@date('Y-m-d', @strtotime($this->input->post('to_date')));

            }

        $data['todate'] = $todate;   
        
        $data['locationsummary'] = $this->HelpdeskModel->DMIS_Location_Wise_Calls($todate); 
        $data['departmentsummary'] = $this->HelpdeskModel->DMIS_Department_Wise_Calls($todate); 
        $data['categorysummary'] = $this->HelpdeskModel->DMIS_Category_Wise_Calls($todate); 
        $data['impactsummary'] = $this->HelpdeskModel->DMIS_Impact_Wise_Calls($todate); 
        
        $data['incident'] = $this->HelpdeskModel->Get_Incidents(null,$session['user_id'],$session['is_admin'],$todate,$todate); 
        $data['pendingincident'] = $this->HelpdeskModel->Get_Incidents('Pending',$session['user_id'],$session['is_admin'],null,null);
        $data['holdincident'] = $this->HelpdeskModel->Get_Incidents('Hold',$session['user_id'],$session['is_admin'],null,null);

        $this->load->library('layouts');

        $this->layouts->set_description('Daily MIS');

        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/analytics/dailymis'),$data);

    }
    
//    Public Function ViewReport()
//    {
//        
//        $data = $this->data;     
//        $session = $this->session->userdata("verified");
//
//        //$data['user_menu'] = $this->SideBarModel->Get_Menu($session['user_id']);
//        
//        if ($this->input->server('REQUEST_METHOD') === 'POST'){
//           
//            $todate=@date('Y-m-d', @strtotime($this->input->post('to_date')));
//        
//            $data['todate'] = $todate;   
//
//            $data['locationsummary'] = $this->HelpdeskModel->DMIS_Location_Wise_Calls($todate); 
//            $data['departmentsummary'] = $this->HelpdeskModel->DMIS_Department_Wise_Calls($todate); 
//            $data['categorysummary'] = $this->HelpdeskModel->DMIS_Category_Wise_Calls($todate); 
//            $data['impactsummary'] = $this->HelpdeskModel->DMIS_Impact_Wise_Calls($todate); 
//
//            $data['incident'] = $this->HelpdeskModel->Get_Incidents(null,$session['user_id'],$session['is_admin'],$todate,$todate); 
//            $data['pendingincident'] = $this->HelpdeskModel->Get_Incidents('Pending',$session['user_id'],$session['is_admin'],null,null);
//            $data['holdincident'] = $this->HelpdeskModel->Get_Incidents('Hold',$session['user_id'],$session['is_admin'],null,null);
//
//            $this->load->library('layouts');
//
//            $this->layouts->set_description('Daily MIS');
//
//            $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/analytics/dailymis'),$data);
//        
//        }
//
//    }
  
}