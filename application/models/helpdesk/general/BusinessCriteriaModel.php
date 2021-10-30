<?php

Class BusinessCriteriaModel extends CI_Model {
            
    public function get_business_criteria($business_criteria_id = null)
    {
        $this->db->select('*');
        $this->db->from('business_criteria_master');
        
        if ($business_criteria_id != null)
        {
            $this->db->where('business_criteria_id', $business_criteria_id); 
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_business_criteria_id()
    {
        $query = $this->db->query('select ifnull(max(business_criteria_id),0) + 1 as next_business_criteria_id from business_criteria_master');
        return $query->result_array(); 
    }
    
    public function count_business_criteria()
    {
        $this->db->select('*');
        $this->db->from('business_criteria_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_business_criteria($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('business_criteria_master', $data);
        return $insert;
    }

    public function update_business_criteria($business_criteria_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('business_criteria_id', $business_criteria_id);
        $update=$this->db->update('business_criteria_master', $data);
        
        return $update;

    }

    public function delete_business_criteria($business_criteria_id)
    {
        $this->db->where('business_criteria_id', $business_criteria_id);
        $this->db->delete('business_criteria_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }
    
}

