<?php

    Class IncidentController extends MY_Controller {

    const VIEW_FOLDER = 'helpdesk/ticket/incident';

    public function __construct()
    { 
        parent::__construct();

        $this->load->model('helpdesk/general/LocationModel');
        $this->load->model('helpdesk/general/DepartmentModel');
        $this->load->model('helpdesk/general/RequestTypeModel');
        $this->load->model('helpdesk/general/CategoryModel');
        $this->load->model('helpdesk/general/SubCategoryModel');
        $this->load->model('helpdesk/general/ImpactModel');
        $this->load->model('helpdesk/general/ImpactClassificationModel');
        $this->load->model('helpdesk/general/CallModeModel');
        $this->load->model('helpdesk/general/BusinessCriteriaModel');
        $this->load->model('helpdesk/general/BusinessClassificationModel');
        $this->load->model('helpdesk/general/ResolutionModel');
        $this->load->model('helpdesk/general/ImpactSLAModel');
        $this->load->model('helpdesk/general/HoldReasonModel');      
        $this->load->model('helpdesk/ticket/IncidentModel');
        $this->load->model('stock/general/ItemModel');
        $this->load->model('stock/entry/StockModel');
        $this->load->model('UserModel');    
       
    }

    public function Index()
    {
        
        $data = $this->data;     

        $data['incident'] = $this->IncidentModel->Get_Incident();        
         
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/list'),$data);

    }

    public function log()
    {
        $data = $this->data;     
       
        $data['incident'] = $this->IncidentModel->Get_Incident(null,date("Y/m/d")); 
        $data['user'] = $this->UserModel->Get_User();        

        $data['is_admin'] = $this->data['is_admin'];
        
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/log'),$data);

    }
    
    public function respond()
    {
        
        $data = $this->data;     
        
        $data['incident'] = $this->IncidentModel->Get_Assigned_Incidents($this->data['user_id']);        
         
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/respond'),$data);

    }
    
    public function assigned()
    {
        
        $data = $this->data;     

        $data['incident'] = $this->IncidentModel->Get_Assigned_Incidents($this->data['user_id']);        

        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/assigned'),$data);

    }
    
    public function accept()
    {
        
        $incident_number = $this->uri->segment(4);  
        
        $this->IncidentModel->Accept_Incident($incident_number);
        redirect('helpdesk/ticket/respond');

    }
    
    public function accept_incident()
    {
        
        $incident_number=$this->input->post('incident_number');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->IncidentModel->accept_incident($incident_number)));
         
    }
    
    public function resolve()
    {
        
        $data = $this->data;     
        
        $data['incident'] = $this->IncidentModel->Get_Accepted_Incidents($this->data['user_id']);        
         
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/resolve'),$data);

    }
    
    public function status()
    {
        
        $data = $this->data;     

        $data['incident'] = $this->IncidentModel->Get_Accepted_Incidents($this->data['user_id']);        
         
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/status'),$data);

    }
    
    public function todo()
    {
        
        $data = $this->data;     

        $data['todo_incidents'] = $this->IncidentModel->get_todo_incidents();        
         
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/todo'),$data);

    }
    
    public function todolog()
    {
        $data = $this->data;     
       
        $incident_ref_number = $this->uri->segment(4);
        
        $data['todo_incidents'] = $this->IncidentModel->get_todo_incidents($incident_ref_number);
        $data['user'] = $this->UserModel->get_user();        
        $data['incident_ref_number'] = $incident_ref_number;
        
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/todolog'),$data);

    }
    
        public function networkdown()
    {
        
        $data = $this->data;     

        $data['networkdown_incidents'] = $this->IncidentModel->get_networkdown_incidents();        
         
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/networkdown'),$data);

    }
    
    public function networkdownlog()
    {
        $data = $this->data;     
       
        $incident_ref_number = $this->uri->segment(4);
        
        $data['networkdown_incidents'] = $this->IncidentModel->get_networkdown_incidents($incident_ref_number);
        $data['user'] = $this->UserModel->get_user();        
        $data['incident_ref_number'] = $incident_ref_number;
        
        $this->layouts->set_description('Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/networkdownlog'),$data);

    }
    
    public function add()
    {
        
        $user_id = $this->uri->segment(4);

        //echo $user_id;
        //print_r($planned_sla_time);
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('incident_number', 'Ticket Number', 'numeric|trim|required');
            $this->form_validation->set_rules('logged_on_date', 'Logged On Date', 'trim|required');
            $this->form_validation->set_rules('logged_on_time', 'Logged On Time', 'trim|required');
            $this->form_validation->set_rules('logged_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('user_id', 'User', 'trim|required');
            $this->form_validation->set_rules('department', 'Department', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('request_type', 'Request Type', 'trim|required');
            $this->form_validation->set_rules('business_classification', 'Business Classification', 'trim|required');
            $this->form_validation->set_rules('category', 'Category', 'trim|required');
            $this->form_validation->set_rules('sub_category', 'Sub Category', 'trim|required');
            $this->form_validation->set_rules('impact', 'Impact', 'trim|required');
            $this->form_validation->set_rules('impact_classification', 'Impact Classification', 'trim|required');
            $this->form_validation->set_rules('call_mode', 'Call Mode', 'trim|required');
            $this->form_validation->set_rules('business_criteria', 'Business Criteria', 'trim|required');
            $this->form_validation->set_rules('rack_number', 'Rack Number','trim');
            $this->form_validation->set_rules('room_number', 'Room Number','trim');
            $this->form_validation->set_rules('refrence_number', 'Ref Number','trim');
            $this->form_validation->set_rules('extension_number', 'Extension','trim');
            $this->form_validation->set_rules('assigned_to', 'Assigned to','trim|required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                     
                    $incident = $this->IncidentModel->Get_Next_Incident_Number();

                    $impact_id = $this->input->post('impact');
                    $impact_classification_id = $this->input->post('impact_classification');
                    
                    $logged_on = @date('Y-m-d H:i:s', @strtotime($this->input->post('logged_on_date') . $this->input->post('logged_on_time')));        
                    $planned_sla_time = $this->ImpactSLAModel->get_planned_sla_time($impact_id,$impact_classification_id,$logged_on);
                     
                    //echo $planned_sla_time['planned_respond_sla_time'];
                    //echo $planned_sla_time['planned_resolution_sla_time'];
                    
                    $data_to_store = array(
                        'incident_number' => $incident[0]['next_incident_number'],
                        'logged_on' => $logged_on,
                        'logged_description' => $this->input->post('logged_description'),
                        'logged_by' => $this->data['user_id'],
                        'planned_respond_on' => $planned_sla_time['planned_respond_sla_time'],   
                        'planned_resolve_on' => $planned_sla_time['planned_resolution_sla_time'], 
                        'actual_description' => $this->input->post('logged_description'),
                        'user_id' => $this->input->post('user_id'),
                        'email_address' => $this->input->post('email_address'),
                        'department_id' => $this->input->post('department'),
                        'location_id' => $this->input->post('location'),
                        'request_type_id' => $this->input->post('request_type'),
                        'business_classification_id' => $this->input->post('business_classification'),
                        'category_id' => $this->input->post('category'),
                        'sub_category_id' => $this->input->post('sub_category'),
                        'impact_id' => $impact_id,
                        'impact_classification_id' => $impact_classification_id,
                        'call_mode_id' => $this->input->post('call_mode'),
                        'business_criteria_id' => $this->input->post('business_criteria'),
                        'rack_number' => $this->input->post('rack_number'),
                        'room_number' => $this->input->post('room_number'),
                        'room_number' => $this->input->post('room_number'),
                        'reference_number' => $this->input->post('reference_number'),
                        'extension_number' => $this->input->post('extension_number'),
                        'assigned_to' => $this->input->post('assigned_to'),   
                        'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->IncidentModel->Insert_Incident($data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }

                    //if($this->data['user_id'] == '3100002'){

                        if($this->input->post('email_address') != ''){

                            $user_data = $this->UserModel->Get_User($this->input->post('user_id'));
                            $engineer_data = $this->UserModel->Get_User($this->input->post('assigned_to'));
                    
                            $message = str_replace("##TICKET_NUMBER##",$incident[0]['next_incident_number'],$this->load->get_var('email_template'));
                            $message = str_replace("##CREATED_DATE##",$logged_on,$message);
                            $message = str_replace("##ESTIMATED_RESOLVED_DATE##",$planned_sla_time['planned_resolution_sla_time'],$message);
                            $message = str_replace("##USER_NAME##",$user_data[0]['user_name'],$message);
                            $message = str_replace("##PROBLEM_DESCRIPTION##",$this->input->post('logged_description'),$message);
                            $message = str_replace("##CALL_ASSIGNED_TO##",$engineer_data[0]['user_name'],$message);
                            $message = str_replace("##CURRENT_STATUS##","PENDING",$message);

                            $data_to_store = array(
                                'incident_number' => $incident[0]['next_incident_number'],
                                'to_email_address' => $this->input->post('email_address'),
                                'subject' => "Ticket # - ".$incident[0]['next_incident_number'],
                                'message' => $message,
                                'mail_sent' => '0',
                                'last_update_user_id' => $this->data['user_id']
                            );

                            if($this->IncidentModel->insert_incident_mail($data_to_store))
                            {
                                $data['flash_message'] = TRUE; 
                            }else{
                                $data['flash_message'] = FALSE; 
                            }

                        }

                    //}
                    
                    if($this->input->post('reference_number') != ""){
                        
                        $todo_incidents = $this->IncidentModel->get_todo_incidents($this->input->post('reference_number'));      
                    
                        if(!empty($todo_incidents))
                        {
                            $incident_ref_number = $todo_incidents[0]['incident_ref_number'];

                            $data_todo_update = array(
                                'incident_number' => $incident[0]['next_incident_number'],
                                'last_update_user_id' => $this->data['user_id']
                            );
                        
                            if($this->IncidentModel->update_todo_incident($incident_ref_number,$data_todo_update))
                            {
                                $data['flash_message'] = TRUE; 
                            }else{
                                $data['flash_message'] = FALSE; 
                            } 
                        
                            redirect('helpdesk/ticket/todo');
                            
                        }    
                        
                    }else{
                        
                        redirect('helpdesk/ticket/log');
                    }
                                 
                }
        }
        
        $data = $this->data;     

        $data['incident'] = $this->IncidentModel->Get_Next_Incident_Number();
        $data['user'] = $this->UserModel->Get_User($user_id);
        $data['category'] = $this->CategoryModel->Get_Category();
        $data['location'] = $this->LocationModel->Get_Location();
        $data['department'] = $this->DepartmentModel->Get_Department();
        $data['request_type'] = $this->RequestTypeModel->Get_Request_Type();
        $data['impact'] = $this->ImpactModel->Get_Impact();
        $data['impact_classification'] = $this->ImpactClassificationModel->Get_Impact_Classification();
        $data['call_mode'] = $this->CallModeModel->Get_Call_Mode();
        $data['business_criteria'] = $this->BusinessCriteriaModel->Get_Business_Criteria();
        $data['business_classification'] = $this->BusinessClassificationModel->Get_Business_Classification();
        $data['assigned_to'] = $this->UserModel->Get_Ticket_Resolver_User();
               

        $this->layouts->set_description('Adding Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/add'),$data);
        
    } 
    
    public function networkdownsave()
    {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('incident_number', 'Ticket Number', 'numeric|trim|required');
            $this->form_validation->set_rules('logged_on_date', 'Logged On Date', 'trim|required');
            $this->form_validation->set_rules('logged_on_time', 'Logged On Time', 'trim|required');
            $this->form_validation->set_rules('logged_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('user_id', 'User', 'trim|required');
            $this->form_validation->set_rules('department', 'Department', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('request_type', 'Request Type', 'trim|required');
            $this->form_validation->set_rules('business_classification', 'Business Classification', 'trim|required');
            $this->form_validation->set_rules('category', 'Category', 'trim|required');
            $this->form_validation->set_rules('sub_category', 'Sub Category', 'trim|required');
            $this->form_validation->set_rules('impact', 'Impact', 'trim|required');
            $this->form_validation->set_rules('impact_classification', 'Impact Classification', 'trim|required');
            $this->form_validation->set_rules('call_mode', 'Call Mode', 'trim|required');
            $this->form_validation->set_rules('business_criteria', 'Business Criteria', 'trim|required');
            $this->form_validation->set_rules('rack_number', 'Rack Number','trim');
            $this->form_validation->set_rules('room_number', 'Room Number','trim');
            $this->form_validation->set_rules('refrence_number', 'Ref Number','trim');
            $this->form_validation->set_rules('extension_number', 'Extension','trim');
            $this->form_validation->set_rules('assigned_to', 'Assigned to','trim|required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
            if ($this->form_validation->run()){

                $incident = $this->IncidentModel->Get_Next_Incident_Number();

                $impact_id = $this->input->post('impact');
                $impact_classification_id = $this->input->post('impact_classification');

                $logged_on = @date('Y-m-d H:i:s', @strtotime($this->input->post('logged_on_date') . $this->input->post('logged_on_time')));        
                $planned_sla_time = $this->ImpactSLAModel->get_planned_sla_time($impact_id,$impact_classification_id,$logged_on);

                //echo $planned_sla_time['planned_respond_sla_time'];
                //echo $planned_sla_time['planned_resolution_sla_time'];

                $data_to_store = array(
                'incident_number' => $incident[0]['next_incident_number'],
                'logged_on' => $logged_on,
                'logged_description' => $this->input->post('logged_description'),
                'logged_by' => $this->data['user_id'],
                'planned_respond_on' => $planned_sla_time['planned_respond_sla_time'],   
                'planned_resolve_on' => $planned_sla_time['planned_resolution_sla_time'], 
                'actual_description' => $this->input->post('logged_description'),
                'user_id' => $this->input->post('user_id'),
                'department_id' => $this->input->post('department'),
                'location_id' => $this->input->post('location'),
                'request_type_id' => $this->input->post('request_type'),
                'business_classification_id' => $this->input->post('business_classification'),
                'category_id' => $this->input->post('category'),
                'sub_category_id' => $this->input->post('sub_category'),
                'impact_id' => $impact_id,
                'impact_classification_id' => $impact_classification_id,
                'call_mode_id' => $this->input->post('call_mode'),
                'business_criteria_id' => $this->input->post('business_criteria'),
                'rack_number' => $this->input->post('rack_number'),
                'room_number' => $this->input->post('room_number'),
                'room_number' => $this->input->post('room_number'),
                'reference_number' => $this->input->post('reference_number'),
                'extension_number' => $this->input->post('extension_number'),
                'assigned_to' => $this->input->post('assigned_to'),   
                'last_update_user_id' => $this->data['user_id']
                );

                if($this->IncidentModel->Insert_Incident($data_to_store))
                {
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

                if($this->input->post('reference_number') != ""){

                    $networkdown_incidents = $this->IncidentModel->get_networkdown_incidents($this->input->post('reference_number'));      

                    if(!empty($networkdown_incidents))
                    {
                        $incident_ref_number = $networkdown_incidents[0]['incident_ref_number'];

                        echo $incident_ref_number;
                        
                        $data_networkdown_update = array(
                            'incident_number' => $incident[0]['next_incident_number'],
                            'last_update_user_id' => $this->data['user_id']
                        );

                        if($this->IncidentModel->update_networkdown_incident($incident_ref_number,$data_networkdown_update))
                        {
                            $data['flash_message'] = TRUE; 
                        }else{
                            $data['flash_message'] = FALSE; 
                        } 

                    }    
                }
            }
            
            redirect('helpdesk/ticket/networkdown');
            
        }      
    } 
    
    public function todoadd()
    {
        
        $incident_ref_number = $this->uri->segment(4);
        $user_id = $this->uri->segment(5);
       
        $data = $this->data;     

        $data['incident'] = $this->IncidentModel->Get_Next_Incident_Number();
        $data['user'] = $this->UserModel->Get_User($user_id);
        $data['category'] = $this->CategoryModel->Get_Category();
        $data['sub_category'] = $this->SubCategoryModel->Get_Sub_Category();
        $data['location'] = $this->LocationModel->Get_Location();
        $data['department'] = $this->DepartmentModel->Get_Department();
        $data['request_type'] = $this->RequestTypeModel->Get_Request_Type();
        $data['impact'] = $this->ImpactModel->Get_Impact();
        $data['impact_classification'] = $this->ImpactClassificationModel->Get_Impact_Classification();
        $data['call_mode'] = $this->CallModeModel->Get_Call_Mode();
        $data['business_criteria'] = $this->BusinessCriteriaModel->Get_Business_Criteria();
        $data['business_classification'] = $this->BusinessClassificationModel->Get_Business_Classification();
        $data['assigned_to'] = $this->UserModel->Get_Ticket_Resolver_User();
        
        $data['auto_log_incidents'] = $this->IncidentModel->get_todo_incidents($incident_ref_number);       

        $this->layouts->set_description('Adding Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/add'),$data);
        
    }
    
    public function networkdownadd()
    {
        
        $incident_ref_number = $this->uri->segment(4);
        $user_id = $this->uri->segment(5);
       
        $data = $this->data;     

        $data['incident'] = $this->IncidentModel->Get_Next_Incident_Number();
        $data['user'] = $this->UserModel->Get_User($user_id);
        $data['category'] = $this->CategoryModel->Get_Category();
        $data['location'] = $this->LocationModel->Get_Location();
        $data['department'] = $this->DepartmentModel->Get_Department();
        $data['request_type'] = $this->RequestTypeModel->Get_Request_Type();
        $data['impact'] = $this->ImpactModel->Get_Impact();
        $data['impact_classification'] = $this->ImpactClassificationModel->Get_Impact_Classification();
        $data['call_mode'] = $this->CallModeModel->Get_Call_Mode();
        $data['business_criteria'] = $this->BusinessCriteriaModel->Get_Business_Criteria();
        $data['business_classification'] = $this->BusinessClassificationModel->Get_Business_Classification();
        $data['assigned_to'] = $this->UserModel->Get_Ticket_Resolver_User();
        
        $data['auto_log_incidents'] = $this->IncidentModel->get_networkdown_incidents($incident_ref_number);       

        $this->layouts->set_description('Adding Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/networkdownsave'),$data);
        
    }
    
    public function close()
            
    {
        $incident_number = $this->uri->segment(4);
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            $this->form_validation->set_rules('resolution', 'Resolution Code', 'trim|required');
            $this->form_validation->set_rules('asset_change_description', 'Asset Change Description', 'trim|required');
            $this->form_validation->set_rules('actual_description', 'Actual Problem', 'trim|required');
            $this->form_validation->set_rules('resolved_on_date', 'Resolved On Date', 'trim|required');
            $this->form_validation->set_rules('resolved_on_time', 'Resolved On Time', 'trim|required');
            $this->form_validation->set_rules('resolved_description', 'Resolved Description', 'trim|required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                                        
                    $data_to_store = array(
                        'resolution_id' => $this->input->post('resolution'),
                        'asset_change_description' => $this->input->post('asset_change_description'),
                        'actual_description' => $this->input->post('actual_description'), 
                        'resolved_on' => @date('Y-m-d H:i:s', @strtotime($this->input->post('resolved_on_date') . $this->input->post('resolved_on_time'))),
                        'resolved_description' => $this->input->post('resolved_description'),
                        'resolved_by' => $this->data['user_id'],
                        'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->IncidentModel->Close_Incident($incident_number,$data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }

                    //if($this->data['user_id'] == '3100002'){

                        $incident_data = $this->IncidentModel->Get_Incident($incident_number);

                        if($incident_data[0]['email_address'] != ''){

                            $user_data = $this->UserModel->Get_User($incident_data[0]['user_id']);
                            $engineer_data = $this->UserModel->Get_User($incident_data[0]['assigned_to']);
                    
                            $message = str_replace("##TICKET_NUMBER##",$incident_number,$this->load->get_var('closed_email_template'));
                            $message = str_replace("##CREATED_DATE##",$incident_data[0]['logged_on'],$message);
                            $message = str_replace("##USER_NAME##",$user_data[0]['user_name'],$message);
                            $message = str_replace("##PROBLEM_DESCRIPTION##",$incident_data[0]['logged_description'],$message);
                            $message = str_replace("##CALL_RESOLVED_BY##",$engineer_data[0]['user_name'],$message);
                            $message = str_replace("##CURRENT_STATUS##","CLOSED",$message);

                            $data_to_store = array(
                                'incident_number' => $incident_number,
                                'to_email_address' => $incident_data[0]['email_address'],
                                'subject' => "Ticket # - ".$incident_number,
                                'message' => $message,
                                'mail_sent' => '0',
                                'last_update_user_id' => $this->data['user_id']
                            );

                            if($this->IncidentModel->insert_incident_mail($data_to_store))
                            {
                                $data['flash_message'] = TRUE; 
                            }else{
                                $data['flash_message'] = FALSE; 
                            }

                        }

                    //}
                          
                    if($this->input->post('asset_change_description') == 1){

                        $issue = $this->StockModel->get_next_issue_number();

                        $issue_on = @date('Y-m-d H:i:s', @strtotime($this->input->post('resolved_on_date') . $this->input->post('resolved_on_time')));        
                    
                        $data_to_store = array(
                            'issue_number' => $issue[0]['next_issue_number'],
                            'issue_date' => $issue_on,
                            'item_id' =>  $this->input->post('issued_item'),
                            'issue_qty' => $this->input->post('issued_qty'),
                            'ref_number' => strtoupper($incident_number), 
                            'last_update_user_id' => $this->data['user_id']
                        );
                    
                        $stock_register_data = array(
                            'item_id' => $this->input->post('issued_item'),
                            'date_on' => $issue_on,
                            'item_qty' => $this->input->post('issued_qty') * -1 ,
                            'issue_number' => $issue[0]['next_issue_number'],
                            'ref_number' => strtoupper($incident_number),
                        );
                    
                        if($this->StockModel->Insert_Issue($data_to_store,$stock_register_data))
                        {
                            $data['flash_message'] = TRUE; 
                        }else{
                            $data['flash_message'] = FALSE; 
                        }

                    }

                    redirect('helpdesk/ticket/resolve');                  
                }
        }
        
        $data = $this->data;     
         
        $data['resolution'] = $this->ResolutionModel->Get_Resolution();
        $data['incident_status'] = $this->IncidentModel->Get_Incident_Status($incident_number);
        $data['incident'] = $this->IncidentModel->Get_Incident($incident_number);
        $data['stock_item'] = $this->ItemModel->get_item();

        $this->layouts->set_description('Close Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/close'),$data);
        
    }
    
    public function Hold()
            
    {
        $incident_number = $this->uri->segment(4);
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('hold_on_date', 'Hold On Date', 'trim|required');
            $this->form_validation->set_rules('hold_on_time', 'Hold On Time', 'trim|required');
            $this->form_validation->set_rules('hold_reason', 'Hold Reason', 'trim|required');
            $this->form_validation->set_rules('hold_description', 'Hold Description', 'trim|required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            

                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                    
                    
                    $data_to_store = array(
                    'hold_on' => @date('Y-m-d H:i:s', @strtotime($this->input->post('hold_on_date') . $this->input->post('hold_on_time'))),    
                    'hold_reason_id' => $this->input->post('hold_reason'),
                    'hold_description' => $this->input->post('hold_description'),
                    'hold_by' => $this->data['user_id'],
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->IncidentModel->Close_Incident($incident_number,$data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                    
                    redirect('helpdesk/ticket/status');           
                }
        }
        
        $data = $this->data;     
         
      
        $data['incident'] = $this->IncidentModel->Get_Incident($incident_number);
        $data['incident_status'] = $this->IncidentModel->Get_Incident_Status($incident_number);
        $data['holdreason'] = $this->HoldReasonModel->Get_Hold_Reason();
                
        $this->layouts->set_description('Hold Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/hold'),$data);
        
    }
    
    public function Transfer()
            
    {
        $incident_number = $this->uri->segment(4);
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('transfered_to', 'Transfer To', 'trim|required');
            $this->form_validation->set_rules('transfered_on_date', 'Transfer On Date', 'trim|required');
            $this->form_validation->set_rules('transfered_on_time', 'Transfer On Time', 'trim|required');
            $this->form_validation->set_rules('transfer_description', 'Transfer Description', 'trim|required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            

                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                     
                    $data_to_store = array(
                    'assigned_to' => $this->input->post('transfered_to'),  
                    'transfered_on' => @date('Y-m-d H:i:s', @strtotime($this->input->post('transfered_on_date') . $this->input->post('transfered_on_time'))),    
                    'transfer_description' => $this->input->post('transfer_description'),
                    'transfered_by' => $this->data['user_id'],
                    'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->IncidentModel->Transfer_Incident($incident_number,$data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                    
                    redirect('helpdesk/ticket/status');                  
                }
        }
        
        $data = $this->data;     
          
        $data['incident'] = $this->IncidentModel->Get_Incident($incident_number);
        $data['incident_status'] = $this->IncidentModel->Get_Incident_Status($incident_number);
        $data['transfered_to'] = $this->UserModel->Get_Ticket_Resolver_User();
        

        $this->layouts->set_description('Transfer Incident');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/transfer'),$data);
        
    }
    
    public function updatestatus()
            
    {
        $incident_number = $this->uri->segment(4);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
            
            $this->form_validation->set_rules('status_number', 'Status Number', 'trim|required');
            $this->form_validation->set_rules('status_on_date', 'Status On Date', 'trim|required');
            $this->form_validation->set_rules('status_on_time', 'Status On Time', 'trim|required');
            $this->form_validation->set_rules('status_description', 'Status Description', 'trim|required');
                        
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
            

                //if the form has passed through the validation
                if ($this->form_validation->run())
                {
                      
                    $next_status_number = $this->IncidentModel->Get_Next_Incident_Status_Number($incident_number);;
                    
                    $data_to_store = array(
                        'incident_number' => $incident_number,
                        'incident_status_number' => $next_status_number[0]['next_incident_status_number'],
                        'status_on_date' => @date('Y-m-d', @strtotime($this->input->post('status_on_date'))),
                        'status_on_time' => $this->input->post('status_on_time'),
                        'status_description' => $this->input->post('status_description'),
                        'status_by' => $this->data['user_id'],
                        'last_update_user_id' => $this->data['user_id']
                    );
                    
                    if($this->IncidentModel->Insert_Incident_Status($incident_number,$data_to_store))
                    {
                        $data['flash_message'] = TRUE; 
                    }else{
                        $data['flash_message'] = FALSE; 
                    }
                    
                    redirect('helpdesk/ticket/status');                  
                }
        }
        
        $data = $this->data;     
         
        $data['incident'] = $this->IncidentModel->Get_Incident($incident_number,Null);
        $data['incident_status'] = $this->IncidentModel->Get_Incident_Status($incident_number);
        $data['next_status_number'] = $this->IncidentModel->Get_Next_Incident_Status_Number($incident_number);

        $this->layouts->set_description('Incident Status');
        $this->layouts->view('home',array('sidebar'=> 'layouts/sidebar','main'=> 'helpdesk/ticket/updatestatus'),$data);
        
    }
    
    public function incident_mail_alert(){

        $incident_mail = $this->IncidentModel->get_incident_mail('0');

        foreach( $incident_mail as $counter => $row ){

            $from = $this->config->item('smtp_user');
            $to = $row['to_email_address'];
            $subject = $row['subject'];
            $message = $row['message'];

            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {

                $data_to_store = array(
                    'mail_sent' => '1',
                    'last_update_user_id' => $this->data['user_id']
                );
                
                if($this->IncidentModel->update_incident_mail($row['incident_number'],$data_to_store))
                {
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            } else {
                show_error($this->email->print_debugger());
            }

        }
    }

    public function Delete()
    {
        
        $incident_number = $this->uri->segment(4);  
        
        $this->IncidentModel->delete_incident($incident_number);
        redirect('helpdesk/ticket/incident');
        
    }
    
    Public Function todoignore()
    {
        
        $incident_ref_number = $this->uri->segment(4); 
        
        $this->IncidentModel->ignore_todo_incident($incident_ref_number);
        redirect('helpdesk/ticket/todo');
        
    }
    

    Public Function netwokdownignore()
    {
        
        $incident_ref_number = $this->uri->segment(4); 
        
        $this->IncidentModel->ignore_networkdown_incident($incident_ref_number);
        redirect('helpdesk/ticket/networkdown');
        
    }
    
    public function ignore_netwok_down()
    {
        
        $incident_ref_numbers=$this->input->post('incident_ref_numbers');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->IncidentModel->ignore_networkdown_incident($incident_ref_numbers)));
         
    }
    
    public function Get_Incident()
    {
        $incident_number=$this->input->post('incident_number');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->IncidentModel->Get_Incident($incident_number)));
    }
    
    public function Get_Incident_Status()
    {
        $incident_number=$this->input->post('incident_number');

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->IncidentModel->Get_Incident_Status($incident_number)));
    }
    

}
