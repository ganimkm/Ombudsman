<?php

Class IncidentModel extends CI_Model {
    
    public $sql="select inh.incident_number,inh.logged_on,inh.logged_description,um1.user_name as logged_by_user,
                inh.actual_description,
                ifnull(inh.respond_on,'') as respond_on,
                inh.resolved_on,inh.resolved_description,um2.user_name as resolved_by_user,
                inh.user_id,inh.email_address,um5.user_name,
                inh.location_id,lm.location_name,
                inh.department_id,dm.department_name,
                inh.request_type_id,rtm.request_type_description,
                inh.category_id,cm.category_description,
                inh.sub_category_id,scm.sub_category_description,
                inh.impact_id,im.impact_description,
                inh.call_mode_id,cmm.call_mode_description,
                inh.business_criteria_id,bcm.business_criteria_description,
                inh.resolution_id,rm.resolution_description,
                ifnull(inh.rack_number,'') as rack_number,ifnull(inh.room_number,'') as room_number,ifnull(inh.extension_number,'') as extension_number,ifnull(inh.reference_number,'') as reference_number,
                inh.assigned_to,um.user_name as assigned_to_user,
                ifnull(inh.transfered_on,'') as transfered_on,ifnull(inh.transfer_description,'') as transfer_description,ifnull(um3.user_name,'') as transfered_by_user,
                ifnull(inh.hold_on,'') as hold_on,ifnull(inh.hold_description,'') as hold_description,ifnull(hrm.hold_reason_description,'') as hold_reason_description,ifnull(um4.user_name,'') as hold_by_user,
                (case when inh.resolved_on is null and inh.hold_on is not null then 'hold' 
                when inh.resolved_on is null and inh.hold_on is null then 'pending'
                when inh.resolved_on is null then 'holdandpending'
                when inh.resolved_on is not null then 'resolved' else 'nothing' end) as on_status
                from incident_header inh 
                inner join user_master um5 on inh.user_id=um5.user_id
                inner join category_master cm on cm.category_id = inh.category_id
                inner join sub_category_master scm on scm.sub_category_id = inh.sub_category_id
                inner join call_mode_master cmm on cmm.call_mode_id = inh.call_mode_id
                inner join location_master lm on lm.location_id = inh.location_id
                inner join department_master dm on dm.department_id = inh.department_id
                inner join impact_master im on im.impact_id = inh.impact_id
                inner join user_master um on um.user_id = inh.assigned_to  
                inner join user_master um1 on um1.user_id = inh.logged_by
                left join user_master um2 on um2.user_id = inh.resolved_by
                left join user_master um3 on um3.user_id = inh.transfered_by
                left join user_master um4 on um4.user_id = inh.hold_by
                inner join business_criteria_master bcm on bcm.business_criteria_id = inh.business_criteria_id
                inner join request_type_master rtm on rtm.request_type_id = inh.request_type_id
                left join hold_reason_master hrm on hrm.hold_reason_id = inh.hold_reason_id
                left join resolution_master rm on rm.resolution_id = inh.resolution_id";
            
    public function get_incident($incident_number = null,$logged_on = null)
    {   
        
        $wherecluase = "";

        if ($incident_number != null or $incident_number != ""){

            if ($wherecluase != ""){ 
                $wherecluase = $wherecluase . " and ";
            }

            $wherecluase=$wherecluase ." inh.incident_number = '". $incident_number ."'";

        }

        if ($logged_on != null or $logged_on != ""){

            if ($wherecluase != ""){ 
                $wherecluase = $wherecluase . " and ";
            }

            $wherecluase=$wherecluase ." date(inh.logged_on) = '". $logged_on ."'";

        }

        if ($wherecluase != "")
        { 
            $wherecluase = " where " . $wherecluase ;
        }
         
            
        $sql= $this->sql . $wherecluase . " order by inh.incident_number desc";
       
        $query = $this->db->query($sql);
        return $query->result_array();  
        
    }    
    public function get_incident_status($incident_number = null,$status_number = null)
    {   
        
        $sql="select isd.incident_number,isd.incident_status_number,isd.status_on_date,isd.status_on_time,isd.status_by,um.user_name as status_by_user,isd.status_description from incident_status_detail isd inner join user_master um on isd.status_by=um.user_id";
        $wherecluase = "";
          
        if ($incident_number != null or $incident_number != ""){

            if ($wherecluase != ""){ 
                $wherecluase = $wherecluase . " and ";
            }

            $wherecluase=$wherecluase ." incident_number = '". $incident_number ."'";

        }

        if ($status_number != null or $status_number != ""){

            if ($wherecluase != ""){ 
                $wherecluase = $wherecluase . " and ";
            }

            $wherecluase=$wherecluase ." incident_status_number = '". $status_number ."'";

        }

        if ($wherecluase != "")
        { 
            $wherecluase = " where " . $wherecluase ;
        }
         
            
        $sql= $sql . $wherecluase . " order by isd.incident_number,isd.incident_status_number desc";
       
        $query = $this->db->query($sql);
        return $query->result_array();  
        
    }    
    
    public function get_assigned_incidents($user_id = null)
    {    
        $wherecluase = " inh.respond_on is null ";
        
        if ($user_id != null){

            if ($wherecluase != ""){ 
                $wherecluase = $wherecluase . " and ";
            }

            $wherecluase=$wherecluase ." inh.assigned_to='" . $user_id . "'" ;

        }
        
       if ($wherecluase != "")
        { 
            $wherecluase = " where " . $wherecluase ;
        }
         
            
        $sql= $this->sql . $wherecluase . " order by inh.incident_number desc";
       
        $query = $this->db->query($sql);
        return $query->result_array();  
        
    }    
    
    public function get_accepted_incidents($user_id = null)
    { 
        
        $wherecluase = " inh.respond_on is not null and inh.resolved_on is null ";
               
        if ($user_id != null){

            if ($wherecluase != ""){ 
                $wherecluase = $wherecluase . " and ";
            }

            $wherecluase=$wherecluase ." inh.assigned_to='" . $user_id . "'" ;

        }
        
       if ($wherecluase != "")
        { 
            $wherecluase = " where " . $wherecluase ;
        }
         
            
        $sql= $this->sql . $wherecluase . " order by inh.incident_number desc";
       
        $query = $this->db->query($sql);
        return $query->result_array();
         
    }
    
    public function get_next_incident_number()
    {
        $query = $this->db->query("select ifnull(max(incident_number),0) + 1 as next_incident_number from incident_header");
        return $query->result_array(); 
    }
    
    public function get_next_incident_status_number($incident_number)
    {
        $query = $this->db->query("select ifnull(max(incident_status_number),0) + 1 as next_incident_status_number from incident_status_detail where incident_number='" . $incident_number . "'");
        return $query->result_array(); 
    }
    
    public function get_todo_incidents($incident_ref_number=null)
    { 
       
        $this->db->select("todoi.incident_ref_number,todoi.incident_date,todoi.incident_description,ins.scheduler_name,itm.incident_type_description,"
                . "ifnull(sci.default_user,'') as default_user,ifnull(sci.default_owner,'') as default_owner,ifnull(additional_parameters, '') as additional_parameters",false);
        
        $this->db->from("todo_incidents todoi");
        $this->db->join("scheduled_incidents sci", "sci.scheduled_incident_id=todoi.scheduled_incident_id");
        $this->db->join("incident_type_master itm", "itm.incident_type_id = sci.incident_type_id");
        $this->db->join("incident_scheduler ins", "sci.scheduler_id=ins.scheduler_id");
        
        $this->db->where('todoi.incident_number is null');
        
         if ($incident_ref_number != null or $incident_ref_number != ""){
            $this->db->where('todoi.incident_ref_number',$incident_ref_number, false);
         }
        
        $this->db->order_by("todoi.incident_ref_number", "asc");
         
        $query = $this->db->get();
       
        //echo $this->db->last_query();
        
        return $query->result_array();
        
    }
    
    public function get_networkdown_incidents($incident_ref_number=null)
    { 
       
        $this->db->select("nwdi.incident_ref_number,nwdi.incident_date,nwdi.incident_description,nwdi.start_time,nwdi.end_time,itm.incident_type_description",false);
        
        $this->db->from("network_down_incidents nwdi");
        $this->db->join("incident_type_master itm", "itm.incident_type_id = nwdi.incident_type_id");
        
        $this->db->where('nwdi.incident_number is null');
        
         if ($incident_ref_number != null or $incident_ref_number != ""){
            $this->db->where('nwdi.incident_ref_number',$incident_ref_number, false);
         }
        
        $this->db->order_by("nwdi.incident_ref_number", "asc");
         
        $query = $this->db->get();
       
        //echo $this->db->last_query();
        
        return $query->result_array();
        
    }

    public function get_incident_mail($mail_sent)
    { 
       
        $this->db->select("incident_number,date_on,to_email_address,subject,message",false);
        $this->db->from("incident_mail_alert");
        $this->db->where('mail_sent',$mail_sent,false);
        $this->db->order_by("date_on", "asc");
         
        $query = $this->db->get();
       
        //echo $this->db->last_query();
        
        return $query->result_array();
        
    }
    
    public function insert_incident($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('incident_header', $data);
        return $insert;
    }

    public function insert_incident_mail($data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->set('date_on', 'now()', false);
        $insert = $this->db->insert('incident_mail_alert', $data);
        return $insert;
    }

    public function update_incident_mail($incident_number, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('incident_number', $incident_number);
        $this->db->update('incident_mail_alert', $data);
    }

    public function accept_incident($incident_number)
    {   
        $this->db->set('respond_on','now()',false);
        $this->db->set('last_update', 'now()', false);
        
        $incident_number = explode(',', $incident_number);
        $this->db->where_in('incident_number', $incident_number);

        $update = $this->db->update('incident_header');
        
        return $update;

    }
    
    public function close_incident($incident_number, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('incident_number', $incident_number);
        $this->db->update('incident_header', $data);
    }
    
    public function insert_incident_status($incident_number, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('incident_status_detail', $data);
        return $insert;
    }
    
    public function transfer_incident($incident_number, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('incident_number', $incident_number);
        $this->db->update('incident_header', $data);
    }
    
    public function delete_incident($incident_number)
    {
        $this->db->where('incident_number', $incident_number);
        $this->db->delete('incident_header'); 
    }
    
    public function ignore_todo_incident($incident_ref_number)
    {
        $this->db->where('incident_ref_number', $incident_ref_number);
        $this->db->delete('todo_incidents'); 
    }
    
   /* public function ignore_networkdown_incident($incident_ref_number)
    {
        $this->db->where('incident_ref_number', $incident_ref_number);
        $this->db->delete('network_down_incidents'); 
    }*/
    
    public function ignore_networkdown_incident($incident_ref_numbers)
    {   
       
        $incident_ref_numbers = explode(',', $incident_ref_numbers);
        
        $this->db->where_in('incident_ref_number', $incident_ref_numbers);
        $this->db->delete('network_down_incidents'); 

    }
    
    public function update_todo_incident($incident_ref_number, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('incident_ref_number', $incident_ref_number);
        $this->db->update('todo_incidents', $data);
    }
    
    public function update_networkdown_incident($incident_ref_number, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('incident_ref_number', $incident_ref_number);
        $this->db->update('network_down_incidents', $data);
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
     
}
