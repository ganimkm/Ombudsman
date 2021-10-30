<?php

Class RegionModel extends CI_Model {
            
    public function get_region($region_id = null)
    {
        $this->db->select('*');
        $this->db->from('region_master');
        
        if ($region_id != null)
        {
            $this->db->where('region_id', $region_id);
        }

        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_region_id()
    {
        $query = $this->db->query('select ifnull(max(region_id),0) + 1 as next_region_id from region_master');
        return $query->result_array(); 
    }
 
    public function count_region()
    {
        $this->db->select('*');
        $this->db->from('region_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_region($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('region_master', $data);
        return $insert;
    }

    public function update_region($region_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('region_id', $region_id);
        $update=$this->db->update('region_master', $data);
        
        return $update;
    }

    public function delete_region($region_id)
    {
        $this->db->where('region_id', $region_id);
        $this->db->delete('region_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

