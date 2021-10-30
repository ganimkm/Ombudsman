<?php

Class BusinessClassificationModel extends CI_Model {
            
    public function get_business_classification($business_classification_id = null)
    {
        $this->db->select('*');
        $this->db->from('business_classification_master');

        if ($business_classification_id != null)
        {    
            $this->db->where('business_classification_id', $business_classification_id);          
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_business_classification_id()
    {
        $query = $this->db->query('select ifnull(max(business_classification_id),0) + 1 as next_business_classification_id from business_classification_master');
        return $query->result_array(); 
    }
    
    public function count_business_classification()
    {
        $this->db->select('*');
        $this->db->from('business_classification_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_business_classification($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('business_classification_master', $data);
        return $insert;
    }

    public function update_business_classification($business_classification_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('business_classification_id', $business_classification_id);
        $update=$this->db->update('business_classification_master', $data);
        
        return $update;
    }

    public function delete_business_classification($business_classification_id)
    {
        $this->db->where('business_classification_id', $business_classification_id);
        $this->db->delete('business_classification_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

