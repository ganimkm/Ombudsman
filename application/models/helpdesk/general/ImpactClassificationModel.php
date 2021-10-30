<?php

Class ImpactClassificationModel extends CI_Model {
            
    public function get_impact_classification($impact_classification_id = null)
    {
        $this->db->select('*');
        $this->db->from('impact_classification_master');

        if ($impact_classification_id != null)
        {    
            $this->db->where('impact_classification_id', $impact_classification_id);          
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_impact_classification_id()
    {
        $query = $this->db->query('select ifnull(max(impact_classification_id),0) + 1 as next_impact_classification_id from impact_classification_master');
        return $query->result_array(); 
    }
    
    public function count_impact_classification()
    {
        $this->db->select('*');
        $this->db->from('impact_classification_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_impact_classification($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('impact_classification_master', $data);
        return $insert;
    }

    public function update_impact_classification($impact_classification_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('impact_classification_id', $impact_classification_id);
        $update=$this->db->update('impact_classification_master', $data);
        
        return $update;
    }

    public function delete_impact_classification($impact_classification_id)
    {
        $this->db->where('impact_classification_id', $impact_classification_id);
        $this->db->delete('impact_classification_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }     
        
}

