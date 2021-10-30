<?php

    Class HelpdeskController extends MY_Controller {

    const VIEW_FOLDER = 'callreport/dailyreport';

    Public Function __construct()
    {
        
        parent::__construct();

        $this->load->model('HelpdeskModel');

    }

    Public Function Index()
    {
        
        $data = $this->data;   
           
        $data['incident4'] = $this->HelpdeskModel->DMIS_Impact_Wise_Calls('2015-07-14'); 
        $data['incident'] = $this->HelpdeskModel->Get_Incidents('Pending',$session['user_id'],$session['is_admin']);  

        $this->layouts->set_description('Call Status');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'callreport/callstatus/list'),$data);

    }
    
    public function callreport()
    {
        
        $data = $this->data;     
        
        //$from_date = @date('Y-m-d', @strtotime(date('01-m-Y'))); // Month First day
        //$to_date  = @date('Y-m-d', @strtotime(date('t-m-Y')));  // Month Last day
        
        $from_date = @date('Y-m-d', @strtotime(date('d-m-Y'))); // Today
        $to_date  = @date('Y-m-d', @strtotime(date('d-m-Y')));  // Today
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $from_date=@date('Y-m-d', @strtotime($this->input->post('from_date')));
            $to_date=@date('Y-m-d', @strtotime($this->input->post('to_date')));

        }
     
        $data['incident'] = $this->HelpdeskModel->Get_Incidents(NULL,$this->data['user_id'],$this->data['is_admin'],$this->data['is_ticket_resolver'],$from_date,$to_date);
        
        $data['from_date']=$from_date;
        $data['to_date']=$to_date;
                
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/analytics/callreport'),$data);
            
    }
    
    Public Function Get_Incidents()
    {
        
        $session_data = $this->session->userdata('logged_in');
        $this->session->set_userdata("verified", $session_data);
        
        $session = $this->session->userdata("verified");
        
        $callstats=$this->input->post('call_status');
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Incidents($callstats,$session['user_id'],$session['is_admin'])));
         
    }
    
    Public Function Get_Call_Status_Summary()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Call_Status_Summary()));
         
    }
    
    Public Function Get_TODO_Count()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->get_todo_count()));
         
    }
    
    Public Function Get_NetworkDown_Count()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->get_networkdown_count()));
         
    }
    
    Public Function Get_Category_Wise_Incident_Summary()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Category_Wise_Incident_Summary()));
         
    }
    
	Public Function Get_Engineers_Incident_Summary()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Engineers_Incident_Summary()));
         
    }
	
    Public Function Get_Engineer_Wise_Incident_Summary()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Engineer_Wise_Incident_Summary()));
         
    }
    
    Public Function Get_Engineer_Logged_Incidents()
    {
        
        $dt_date=$this->input->post('dt_date');
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Engineer_Logged_Incidents($dt_date)));
         
    }
    
    Public Function Last_Month_Engineer_Logged_Incidents()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Last_Month_Engineer_Logged_Incidents()));
         
    }
    
    Public Function Day_Wise_Incident_Summary()
    {
        
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Day_Wise_Incident_Summary()));
         
    }
    
    Public Function Get_Month_Wise_Incident_Summary()
    {
 
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->HelpdeskModel->Get_Month_Wise_Incident_Summary()));
         
    }
    
    
    
}