<?php

Class ImpactModel extends CI_Model {
            
    public function get_impact($impact_id = null)
    {
        $this->db->select('*');
        $this->db->from('impact_master');
        
        if ($impact_id != null)
        {
            $this->db->where('impact_id', $impact_id);
        }
     
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_impact_id()
    {
        $query = $this->db->query('select ifnull(max(impact_id),0) + 1 as next_impact_id from impact_master');
        return $query->result_array(); 
    }
    
    public function count_impact()
    {
        $this->db->select('*');
        $this->db->from('impact_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_impact($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('impact_master', $data);
        return $insert;
    }

    public function update_impact($impact_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('impact_id', $impact_id);
        $update=$this->db->update('impact_master', $data);
        
        return $update;
    }

    public function delete_impact($impact_id)
    {
        $this->db->where('impact_id', $impact_id);
        $this->db->delete('impact_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

