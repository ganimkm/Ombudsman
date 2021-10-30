<?php

Class HomePageModel extends CI_Model {
            
    Public Function Get_Home_Page($user_id)
    {
        
        $this->db->select('um.user_id,um.home_page_id,pm.page_url as home_page_url');
        $this->db->from('user_master um');
        $this->db->join('page_Master pm', 'um.home_page_id=pm.page_id' );

        $this->db->where('um.user_id', $user_id); 
       
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
}