<?php

Class ImpactSLAModel extends CI_Model {
 
    public function get_impact_sla($impact_id = null,$impact_classification_id = null)
    {   
        
        $this->db->select('im.impact_id,im.impact_description,icm.impact_classification_id,icm.impact_classification_description,ifnull(islam.response_sla_duration,"NBD") response_sla_duration,ifnull(islam.resolution_sla_duration,"NBD") resolution_sla_duration');
        $this->db->from('impact_sla_master islam');
        $this->db->join('impact_master im', 'im.impact_id = islam.impact_id' );
        $this->db->join('impact_classification_master icm', 'icm.impact_classification_id = islam.impact_classification_id');
          
        if ($impact_id != null){
            $this->db->where('im.impact_id', $impact_id);     
        }
        
        if ($impact_classification_id != null){
            $this->db->where('icm.impact_classification_id', $impact_classification_id);    
        }
        
        $query = $this->db->get();
        
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
            
       //echo $this->db->last_query();

    }   

    public function is_date_sla_xclude($xclude_date)
    {       
        $this->db->select('xclude_date,description');
        $this->db->from('impact_sla_xclude_details');
        $this->db->where('date(xclude_date)', $xclude_date);
        
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
    
    public function get_impact_sla_applicable_duration($impact_application_duration_id)
    {   
        
        $this->db->select('impact_application_duration_id,start_time,end_time,description');
        $this->db->from('impact_applicable_duration_details');
        $this->db->where('impact_application_duration_id', $impact_application_duration_id);
        
        $query = $this->db->get();
        
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
            
       //echo $this->db->last_query();

    } 
    
    public function get_planned_sla_time($impact_id,$impact_classification_id,$logged_on){
        
        $impact_sla=$this->get_impact_sla($impact_id,$impact_classification_id);
        $impact_sla_applicable_duration=$this->get_impact_sla_applicable_duration(1);
        
        $response_sla_duration = $impact_sla[0]['response_sla_duration'];
        $resolution_sla_duration = $impact_sla[0]['resolution_sla_duration'];
        
        $applicable_sla_begin_time = date('H:i:s', strtotime($impact_sla_applicable_duration[0]['start_time']));
        $applicable_sla_end_time = date('H:i:s', strtotime($impact_sla_applicable_duration[0]['end_time']));
        
//        $applicable_sla_begin_time = date('H:i:s', strtotime("06:30:00"));
//        $applicable_sla_end_time = date('H:i:s', strtotime("21:30:00"));
 
/*====================================================================================================================//   
 *          If SLA NBD(Next Business Day)then Add One More day with end time of application SLA Duration     
//====================================================================================================================*/
        
        if ($response_sla_duration == "NBD") {            
            $respond_on = date('Y-m-d ' . $applicable_sla_end_time,strtotime("+1 days", strtotime($logged_on))); 
        }else{
            $respond_on = date('Y-m-d H:i:s',strtotime("+" . $response_sla_duration . " minutes", strtotime($logged_on)));
        }
        
        if ($resolution_sla_duration == "NBD") {            
            $resolution_on = date('Y-m-d ' . $applicable_sla_end_time,strtotime("+1 days", strtotime($logged_on))); 
        }else{
            $resolution_on = date('Y-m-d H:i:s',strtotime("+" . $resolution_sla_duration . " minutes", strtotime($logged_on))); 
        }
        
/*====================================================================================================================//   
 *          If Planned SLA Time Exceed Application SLA Duration Remaining Time Add to Next Day 
//====================================================================================================================*/
        
         $respond_on_time=date('H:i:s', strtotime($respond_on));
    
        if (($respond_on_time >= $applicable_sla_begin_time) && ($respond_on_time <= $applicable_sla_end_time))
        {
          //echo "is between";
        }
        else
        {
          $non_business_hours  = 1440 -  (abs(strtotime($applicable_sla_end_time) - strtotime($applicable_sla_begin_time))/60);
          $respond_on = date('Y-m-d H:i:s',strtotime("+" . $non_business_hours . " minutes", strtotime($respond_on))); 
        }
        
//************************************************************************************************************************//
        
        $resolution_on_time=date('H:i:s', strtotime($resolution_on));
    
        if (($resolution_on_time >= $applicable_sla_begin_time) && ($resolution_on_time <= $applicable_sla_end_time))
        {
          //echo "is between";
        }
        else
        {
          $non_business_hours  = 1440 -  (abs(strtotime($applicable_sla_end_time) - strtotime($applicable_sla_begin_time))/60);
          $resolution_on = date('Y-m-d H:i:s',strtotime("+" . $non_business_hours . " minutes", strtotime($resolution_on))); 
        }

/*====================================================================================================================//   
 *                                If Planned SLA Time is Sunday then Add One More day 
//====================================================================================================================*/
        
        if(date('w', strtotime($respond_on)) == 0) {
            $respond_on = date('Y-m-d H:i:s',strtotime("+1 days", strtotime($respond_on))); 
        }
        
        if(date('w', strtotime($resolution_on)) == 0) {
            $resolution_on = date('Y-m-d H:i:s',strtotime("+1 days", strtotime($resolution_on))); 
        }

/*====================================================================================================================//   
 *                       If Planned SLA Time Occurs SLA Exclude Date List the Add the duration to Planned SLA Time
//====================================================================================================================*/
        
        $bool_xclude_impact_sla_date = $this->is_date_sla_xclude(date('Y-m-d',strtotime($respond_on)));
              
        while ($bool_xclude_impact_sla_date) {
            
            $respond_on = date('Y-m-d H:i:s',strtotime("+1 days", strtotime($respond_on)));
            $bool_xclude_impact_sla_date = $this->is_date_sla_xclude(date('Y-m-d',strtotime($respond_on)));
            
        }
        
//************************************************************************************************************************//   
        
        $bool_xclude_impact_sla_date = $this->is_date_sla_xclude(date('Y-m-d',strtotime($resolution_on)));
               
        while ($bool_xclude_impact_sla_date) {
            
            $resolution_on = date('Y-m-d H:i:s',strtotime("+1 days", strtotime($resolution_on)));
            $bool_xclude_impact_sla_date = $this->is_date_sla_xclude(date('Y-m-d',strtotime($resolution_on)));
            
        }
        
//====================================================================================================================//   
        
        $planned_sla_time = ["planned_respond_sla_time" => $respond_on,"planned_resolution_sla_time" => $resolution_on,];
        
        return $planned_sla_time;
        
//        echo $logged_on .'<br>';
//        echo $respond_on .'<br>';
//        echo $resolution_on .'<br>';
 
    }
         
        
}