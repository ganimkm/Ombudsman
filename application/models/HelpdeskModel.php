<?php

Class HelpdeskModel extends CI_Model {

    Public $sql="select isdvt.incident_status_number,isdvt.status_on_date,isdvt.status_on_time,ifnull(isdvt.status_description,ifnull(inh.hold_description,'')) as status_description,isdvt.status_by, 
                inh.incident_number,inh.logged_on,inh.logged_description,um1.user_name as logged_by_user,
                inh.actual_description,
                ifnull(inh.respond_on,'') as respond_on,
                inh.resolved_on,inh.resolved_description,um2.user_name as resolved_by_user,
                inh.user_id,um5.user_name,
                inh.location_id,lm.location_name,
                inh.department_id,dm.department_name,
                inh.request_type_id,rtm.request_type_description,
                inh.category_id,cm.category_description,
                inh.sub_category_id,scm.sub_category_description ,
                inh.impact_id,im.impact_description,
                inh.call_mode_id,cmm.call_mode_description,
                inh.business_criteria_id,bcm.business_criteria_description,
                inh.resolution_id,rm.resolution_description,
                ifnull(inh.rack_number,'') as rack_number,ifnull(inh.room_number,'') as room_number,ifnull(inh.extension_number,'') as extension_number,ifnull(inh.reference_number,'') as reference_number,
                inh.assigned_to,um.user_name as assigned_to_user,
                ifnull(inh.transfered_on,'') as transfered_on,ifnull(inh.transfer_description,'') as transfer_description,ifnull(um3.user_name,'') as transfered_by_user,
                ifnull(inh.hold_on,'') as hold_on,ifnull(inh.hold_description,'') as hold_description,ifnull(hrm.hold_reason_description,'') as hold_reason_description,ifnull(um4.user_name,'') as hold_by_user,
                (case when inh.resolved_on is null and inh.hold_on is not null then 'Hold' 
                when inh.resolved_on is null and inh.hold_on is null then 'Pending'
                when inh.resolved_on is not null then 'Resolved' else 'Nothing' end) as on_status
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
                left join resolution_master rm on rm.resolution_id = inh.resolution_id
                 left join 
                (
                select * from incident_status_detail isd inner join (select max(incident_status_number) as incident_status_number1,incident_number as incident_number1
                from incident_status_detail group by incident_number) isdv on isd.incident_status_number=isdv.incident_status_number1 and isd.incident_number=isdv.incident_number1
                )

                isdvt on isdvt.incident_number = inh.incident_number";
    
    
    Public Function Get_Incidents($callstats=null,$userid=null,$isadmin=null,$isticketresolver=null,$fromdate=null,$todate=null)
    {   
        
        $WhereClause="";
        
        if (strtoupper($callstats) == "PENDING")
            { 
                $WhereClause=" INH.Hold_On Is Null And INH.Resolved_On Is Null ";
            }
        
        if (strtoupper($callstats) == "HOLDANDPENDING")
            {
                $WhereClause=" INH.Resolved_On Is Null ";
            }
            
        if (strtoupper($callstats) == "RESOLVED")
            {
                $WhereClause=" INH.Resolved_On Is Not Null ";
            }
            
        if (strtoupper($callstats) == "HOLD")
            {
                $WhereClause=" INH.Hold_On Is Not Null And INH.Resolved_On Is Null ";
            }    
        
         if ($isadmin != null){
             
             if ($isadmin == 0){
                
                if ($WhereClause != ""){ 
                    $WhereClause = $WhereClause . " And ";
                }
                
                if ($this->user_has_team_members($userid)){
                    $WhereClause=$WhereClause ." INH.Assigned_To in (select engineer_id from team_lead_engineer_detail where team_leader_id= '". $userid ."' union all select '". $userid ."')";   
                }else{
                    $WhereClause=$WhereClause ." INH.Assigned_To = '". $userid ."'";   
                }
                  
            }
        
         }
       
        if ($fromdate != null){
            
            if ($WhereClause != ""){ 
                $WhereClause = $WhereClause . " And ";
            }
            
            $WhereClause=$WhereClause ." date(INH.Logged_On) >= '". $fromdate ."'";
            
        }
        
        if ($todate != null){
            
            if ($WhereClause != ""){ 
                $WhereClause = $WhereClause . " And ";
            }
            
            $WhereClause=$WhereClause ." date(INH.Logged_On) <= '". $todate ."'";
            
        }
        
        if ($WhereClause != "")
            { 
                $WhereClause = " Where " . $WhereClause ;
            }
         
            
        $sql= $this->sql . $WhereClause . " Order By INH.Incident_Number";

        //echo $sql;
        
        $query = $this->db->query($sql);
        return $query->result_array();  
        
    }   
  
    public function user_has_team_members($team_leader_id)
    { 
        
        $this->db->select('engineer_id');
        $this->db->from('team_lead_engineer_detail');
        $this->db->where('team_leader_id', $team_leader_id);
        $query = $this->db->get();
    
        if($query->num_rows() != 0)
        {
            return true;
        }
        else
        {
            return false;
        } 
        
    }
    
    Public Function DMIS_Impact_Wise_Calls($todate=null)
    {
      
        $sql="";
        $sqlheading="";        
                
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
        
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
  
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
         
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
        
        $sql = "Select IM.Impact_ID,IM.Description As Impact_Description," . $sqlheading . " from Impact_Master IM Left Join (Select Impact_ID," .  $sql . " from View_Impact Group by Impact_ID,Logged_On)V on IM.Impact_ID = V.Impact_ID Group by IM.Impact_ID WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array();
        
    }
    
    Public Function DMIS_Category_Wise_Calls($todate=null)
    {
      
        $sql="";
        $sqlheading="";        
                
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
        
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
  
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
         
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
      
        $sql = "Select CM.Category_ID,CM.Description As Category_Description," . $sqlheading . " from Category_Master CM Left Join (Select Category_ID," .  $sql . " from View_Category Group by Category_ID,Logged_On)V on CM.Category_ID = V.Category_ID Group by CM.Category_ID WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array();
        
    }
    
    Public Function DMIS_Location_Wise_Calls($todate=null)
    {
      
        $sql="";
        $sqlheading="";        
                
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
        
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
  
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
         
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
      
        $sql = "Select LM.Location_ID,LM.Description As Location_Description," . $sqlheading . " from Location_Master LM Left Join (Select Location_ID," .  $sql . " from View_Location Group by Location_ID,Logged_On)V on LM.Location_ID = V.Location_ID Group by LM.Location_ID WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array();
        
    }
    
    Public Function DMIS_Department_Wise_Calls($todate=null)
    {
      
        $sql="";
        $sqlheading="";        
                
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On between CONCAT(year('$todate'),'-',month('". @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) ."'),'-','01') And '" . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
        
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($todate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
  
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime("-1 day", strtotime($todate)))) . "_Calls_Closed',";
         
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Received',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Pending',";
        $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . "_Calls_Closed'";
      
        $sql = "Select DM.Department_ID,DM.Description As Department_Description," . $sqlheading . " from Department_Master DM Inner Join (Select Department_ID," .  $sql . " from View_Department Group by Department_ID,Logged_On)V on DM.Department_ID = V.Department_ID Group by DM.Department_ID WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array();
        
    }
    
    Public Function Get_Impact_Wise_Calls($fromdate=null,$todate=null)
    { 
        
        $sql="";
        $sqlheading="";
                
        while (strtotime($fromdate) <= strtotime($todate)) 
        {
            
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
            
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
                    
            $fromdate = date("Y-m-d", strtotime("+1 day", strtotime($fromdate)));
        }
        
        $sql = "Select IM.Impact_ID,IM.Description As Impact_Description," . $this->utility->Chop_Last_Char($sqlheading) . " from Impact_Master IM Left Join (Select Impact_ID," .  $this->utility->Chop_Last_Char($sql) . " from View_Impact Group by Impact_ID,Logged_On)V on IM.Impact_ID = V.Impact_ID Group by IM.Impact_ID Order By IM.Impact_ID";
        
        $query = $this->db->query($sql);
        return $query->result_array();  
             
    }
    
    Public Function Get_Category_Wise_Calls($fromdate=null,$todate=null)
    { 
        
        $sql="";
        $sqlheading="";
                
        while (strtotime($fromdate) <= strtotime($todate)) 
        {
            
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
            
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
                    
            $fromdate = date("Y-m-d", strtotime("+1 day", strtotime($fromdate)));
        }
        
        $sql = "Select CM.Category_ID,CM.Description As Category_Description," . $this->utility->Chop_Last_Char($sqlheading) . " from Category_Master CM Left Join (Select Category_ID," .  $this->utility->Chop_Last_Char($sql) . " from View_Category Group by Category_ID,Logged_On)V on CM.Category_ID = V.Category_ID Group by CM.Category_ID Order By CM.Category_ID";
        
        $query = $this->db->query($sql);
        return $query->result_array();  
             
    }
    
    Public Function Get_Location_Wise_Calls($fromdate=null,$todate=null)      
    { 
        
        $sql="";
        $sqlheading="";
                
        while (strtotime($fromdate) <= strtotime($todate)) 
        {
            
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
            
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
                    
            $fromdate = date("Y-m-d", strtotime("+1 day", strtotime($fromdate)));
        }
        
        $sql = "Select LM.Location_ID,LM.Description," . $this->utility->Chop_Last_Char($sqlheading) . " from Location_Master LM Left Join (Select Location_ID," .  $this->utility->Chop_Last_Char($sql) . " from View_Location Group by Location_ID,Logged_On)V on LM.Location_ID = V.Location_ID Group by LM.Location_ID Order By LM.Location_ID";

        $query = $this->db->query($sql);
        return $query->result_array();  
             
    }

    Public Function Get_Department_Wise_Calls($fromdate=null,$todate=null)
    { 
        
        $sql="";
        $sqlheading="";
                
        while (strtotime($fromdate) <= strtotime($todate)) 
        {
            
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Received Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Pending Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sql = $sql . "(Case When Logged_On='" . @date('Y-m-d', @strtotime($fromdate)) . "' Then Calls_Closed Else 0 End) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
            
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Received',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Pending',";
            $sqlheading = $sqlheading . "Sum(Ifnull(" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed,0)) as '" . str_replace("-","_",@date('Y-m-d', @strtotime($fromdate))) . "_Calls_Closed',";
                    
            $fromdate = date("Y-m-d", strtotime("+1 day", strtotime($fromdate)));
        }
        
        $sql = "Select DM.Department_ID,DM.Description," . $this->utility->Chop_Last_Char($sqlheading) . " from Department_Master DM Left Join (Select Department_ID," .  $this->utility->Chop_Last_Char($sql) . " from View_Department Group by Department_ID,Logged_On)V on DM.Department_ID = V.Department_ID Group by DM.Department_ID Order By DM.Department_ID";
        
        $query = $this->db->query($sql);
        return $query->result_array();  
             
    }

    Public Function Get_Call_Status_Summary()
    { 
        
       $sql="Select MonthName(Curdate()) as Month,Year(Curdate()) as Year,Count(1) As Total_Tickets,
            Ifnull(Sum(Case When INH.Resolved_On Is Null And INH.Hold_On Is Null Then 1 Else 0 End),0) As Pending_Tickets, 
            Ifnull(Sum(Case When INH.Resolved_On Is Null And INH.Hold_On Is Not Null Then 1 Else 0 End),0) As Hold_Tickets,
            Ifnull(Sum(Case When INH.Resolved_On Is Not Null Then 1 Else 0 End),0) As Resolved_Tickets,
            (Select IfNull(count(1),0) from Incident_Header Where date(Logged_On) = Curdate()) As Today_Total_Tickets,
            (Select IfNull(count(1),0) from Incident_Header Where date(Logged_On) = Curdate() and Resolved_On is null) As Today_Pending_Tickets
            From Incident_Header INH 
            Where Month(INH.Logged_On) = Month(Curdate()) and Year(INH.Logged_On) =  Year(Curdate())";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
        
    }
    
    Public Function get_todo_count()
    { 
        
       $sql="select count(1) as todocount from todo_incidents where incident_number is null";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
        
    }
    
    Public Function get_networkdown_count()
    { 
        
       $sql="select count(1) as networkdowncount from network_down_incidents where incident_number is null";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
        
    }
    
    public function get_pending_incidents($user_id=null)
    { 
       
        $this->db->select("isdvt.incident_status_number,isdvt.status_on_date,isdvt.status_on_time,ifnull(isdvt.status_description,ifnull(inh.hold_description,'')) as status_description,"
                . "isdvt.status_by,inh.incident_number,logged_on,logged_description,inh.assigned_to,inh.user_id,um5.user_name,inh.location_id,lm.location_name,"
                . "inh.department_id,dm.department_name,inh.impact_id,im.impact_description,um.user_name as assigned_to_user,datediff(curdate(),logged_on) as status_duration,'Pending' as status,ifnull(planned_respond_on,'') as planned_respond_on,ifnull(planned_resolve_on,'') as planned_resolve_on,ifnull(breached_on,'') as breached_on",false);
        
        $this->db->from("incident_header inh");
        $this->db->join("user_master um5", "inh.user_id = um5.user_id");
        $this->db->join("impact_master im", "im.impact_id = inh.impact_id");
        $this->db->join("category_master cm", "cm.category_id = inh.category_id");
        $this->db->join("sub_category_master scm", "scm.sub_category_id = inh.sub_category_id");
        $this->db->join("location_master lm", "lm.location_id = inh.location_id");
        $this->db->join("department_master dm", "dm.department_id = inh.department_id");
        $this->db->join("user_master um", "um.user_id = inh.assigned_to");
        $this->db->join("(select * from incident_status_detail isd inner join (select max(incident_status_number) as incident_status_number1,incident_number as incident_number1
            from incident_status_detail group by incident_number) isdv on isd.incident_status_number=isdv.incident_status_number1 and isd.incident_number=isdv.incident_number1) isdvt","isdvt.incident_number = inh.incident_number","left");
          
        $this->db->where("inh.resolved_on is null", null, false);
        $this->db->where("inh.hold_on is null", null, false);

        if ($user_id != null or $user_id != ""){
            if (!$this->UserModel->is_admin_user($user_id)){
                $this->db->where('inh.assigned_to',$user_id, false);
            }
        }
 
        $this->db->order_by("datediff(curdate(),logged_on) desc",null,false); 
        
        $query = $this->db->get();
       
        //echo $this->db->last_query();
        
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
       
    Public Function get_hold_incidents($user_id=null)
    { 
        
        $this->db->select("isdvt.incident_status_number,isdvt.status_on_date,isdvt.status_on_time,ifnull(isdvt.status_description,ifnull(inh.hold_description,'')) as status_description,"
                . "isdvt.status_by,inh.incident_number,logged_on,logged_description,inh.assigned_to,inh.user_id,um5.user_name,inh.location_id,lm.location_name,"
                . "inh.department_id,dm.department_name,inh.impact_id,im.impact_description,um.user_name as assigned_to_user,datediff(curdate(),logged_on) as status_duration,'Hold' as status,ifnull(planned_respond_on,'') as planned_respond_on,ifnull(planned_resolve_on,'') as planned_resolve_on,ifnull(breached_on,'') as breached_on",false);
        
        $this->db->from("incident_header inh");
        $this->db->join("user_master um5", "inh.user_id = um5.user_id");
        $this->db->join("impact_master im", "im.impact_id = inh.impact_id");
        $this->db->join("category_master cm", "cm.category_id = inh.category_id");
        $this->db->join("sub_category_master scm", "scm.sub_category_id = inh.sub_category_id");
        $this->db->join("location_master lm", "lm.location_id = inh.location_id");
        $this->db->join("department_master dm", "dm.department_id = inh.department_id");
        $this->db->join("user_master um", "um.user_id = inh.assigned_to");
        $this->db->join("(select * from incident_status_detail isd inner join (select max(incident_status_number) as incident_status_number1,incident_number as incident_number1
            from incident_status_detail group by incident_number) isdv on isd.incident_status_number=isdv.incident_status_number1 and isd.incident_number=isdv.incident_number1) isdvt","isdvt.incident_number = inh.incident_number","left");
          
        $this->db->where("inh.resolved_on is null", null, false);
        $this->db->where("inh.hold_on is not null", null, false);

        if ($user_id != null or $user_id != ""){
             if (!$this->UserModel->is_admin_user($user_id)){
                $this->db->where('inh.assigned_to',$user_id, false);
            }
        }
 
        $this->db->order_by("datediff(curdate(),logged_on) desc",null,false); 
        
        $query = $this->db->get();
      
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        } 
        
    }
    
    Public Function Get_Category_Wise_Incident_Summary()
    {
      
        $sql="Select CM.Category_ID,CM.Category_description as Category_Name,Count(1) as Total_Incidents,Sum(Case When INH.Resolved_On Is Null Then 1 Else 0 END) As Pending_Incidents
            From Incident_Header INH Inner Join Category_Master CM On INH.Category_ID = CM.Category_ID
            Group By INH.Category_ID
            Order By CM.Category_ID";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
        
        
    }
    
	Public Function Get_Engineers_Incident_Summary()
	{
		
		 $sql="Select assigned_to,assign_to_user_name,sum(total_incidents) as total_incidents,
				sum(pending_incidents) as pending_incidents,sum(yesterday) as yesterday,sum(today) as today,sum(last_month) as last_month,sum(this_month) as this_month from (select PENT.assigned_to,PENT.assign_to_user_name,total_incidents,pending_incidents,yesterday,today,last_month,this_month from 

				(select Assigned_To,Assign_To_User_Name,Sum(Total_Incidents) as Total_Incidents,Sum(Pending_Incidents) As Pending_Incidents  From (
				Select INH.Assigned_To,UM.User_Name as Assign_To_User_Name ,Count(1) as Total_Incidents,
				Sum(Case When INH.Resolved_On Is Null Then 1 Else 0 END) As Pending_Incidents
				From Incident_Header INH Inner Join User_Master UM On INH.Assigned_To=UM.User_ID and um.is_active=1 and um.is_ticket_resolver=1
				Group By INH.Assigned_To
				)EV GROUP BY assigned_to) PENT inner join
							
				(select assigned_to,user_name,sum(yesterday) as yesterday,sum(today) as today from (
				select v.assigned_to,um.user_name,
				sum(case when date(logged_on)=date_sub(current_date, INTERVAL 1 DAY) then total else 0 end) yesterday,
				sum(case when date(logged_on)=current_date then total else 0 end) today
				from (
				select assigned_to,logged_on,count(1) as total from 
				incident_header group by assigned_to,logged_on
				)v inner join user_master um on v.assigned_to=um.user_id and um.is_active=1 and um.is_ticket_resolver=1 group by assigned_to)ecal 
				GROUP BY assigned_to) DAILYT on PENT.Assigned_To = DAILYT.Assigned_To inner join
						   
				(select assigned_to,user_name,sum(last_month) as last_month,sum(this_month) as this_month from (select v.assigned_to,um.user_name,
				sum(case when year=year(date_sub(current_date, INTERVAL 1 MONTH)) and month=month(date_sub(current_date, INTERVAL 1 MONTH)) then total else 0 end) last_month,
				sum(case when year=year(current_date) and month=month(current_date) then total else 0 end) this_month
				from (
				select assigned_to,year(logged_on) year,month(logged_on) month,count(1) as total from 
				incident_header group by assigned_to,year(logged_on),month(logged_on)
				)v inner join user_master um on v.assigned_to=um.user_id  and um.is_active=1 and um.is_ticket_resolver=1 group by assigned_to)ecal
				GROUP BY assigned_to) MONTHT on DAILYT.Assigned_To = MONTHT.Assigned_To ) VET GROUP BY assigned_to WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
	}
	
    Public Function Get_Engineer_Wise_Incident_Summary()
    {
      
        $sql="select Assigned_To,Assign_To_User_Name,Sum(Total_Incidents) as Total_Incidents,Sum(Pending_Incidents) As Pending_Incidents  From (
            Select INH.Assigned_To,UM.User_Name as Assign_To_User_Name ,Count(1) as Total_Incidents,
            Sum(Case When INH.Resolved_On Is Null Then 1 Else 0 END) As Pending_Incidents
            From Incident_Header INH Inner Join User_Master UM On INH.Assigned_To=UM.User_ID and um.is_active=1 and um.is_ticket_resolver=1
            Group By INH.Assigned_To
            )EV GROUP BY assigned_to WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
           
    }
    
    Public Function Get_Engineer_Logged_Incidents($dtdate)
    {
      
        $sql="select assigned_to,user_name,sum(yesterday) as yesterday,sum(today) as today from (
            select v.assigned_to,um.user_name,
            sum(case when date(logged_on)=date_sub(current_date, INTERVAL 1 DAY) then total else 0 end) yesterday,
            sum(case when date(logged_on)=current_date then total else 0 end) today
            from (
            select assigned_to,logged_on,count(1) as total from 
            incident_header group by assigned_to,logged_on
            )v inner join user_master um on v.assigned_to=um.user_id and um.is_active=1 and um.is_ticket_resolver=1 group by assigned_to)ecal 
            
           GROUP BY assigned_to WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
           
    }
    
    Public Function Last_Month_Engineer_Logged_Incidents()
    {
      
        $sql="select assigned_to,user_name,sum(last_month) as last_month,sum(this_month) as this_month from (select v.assigned_to,um.user_name,
                sum(case when year=year(date_sub(current_date, INTERVAL 1 MONTH)) and month=month(date_sub(current_date, INTERVAL 1 MONTH)) then total else 0 end) last_month,
                sum(case when year=year(current_date) and month=month(current_date) then total else 0 end) this_month
                from (
                select assigned_to,year(logged_on) year,month(logged_on) month,count(1) as total from 
                incident_header group by assigned_to,year(logged_on),month(logged_on)
                )v inner join user_master um on v.assigned_to=um.user_id  and um.is_active=1 and um.is_ticket_resolver=1 group by assigned_to)ecal
                
                GROUP BY assigned_to WITH ROLLUP";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
           
    }
    
    Public Function Get_Month_Wise_Incident_Summary()
    {
        
        $sql="Select CONCAT_WS('-',MonthName(INH.Logged_On),Year(INH.Logged_On)) as Month,Count(1) as Total_Incidents From Incident_Header INH
              Group By CONCAT_WS('-',MonthName(INH.Logged_On),Year(INH.Logged_On)) Order By INH.Logged_On Desc Limit 12";
        
        $query = $this->db->query($sql);
        return $query->result_array();    
        
    }
    
    Public Function Day_Wise_Incident_Summary()
    {
        
        $sql="Select INH.Logged_On,Count(1) as Day_Count,Sum(Case When INH.Logged_On <> INH.Resolved_On Or INH.Resolved_On Is Null Then 1 Else 0 End) As Pending_Count
              From Incident_Header INH Group By INH.Logged_On Order By INH.Logged_On";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
        
        
    }

        
    
}

