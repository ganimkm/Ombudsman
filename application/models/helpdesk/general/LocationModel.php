<?php

Class LocationModel extends CI_Model {
            
    public function get_location($location_id = null)
    {

        $this->db->select('lm.location_id,lm.location_name,lm.region_id,rm.region_name');
        $this->db->from('location_master lm');
        $this->db->join('region_master rm', 'rm.region_id = lm.region_id');
          
        
        if ($location_id != null)
        {
            $this->db->where('location_id', $location_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_location_id()
    {
        $query = $this->db->query('select ifnull(max(location_id),0) + 1 as next_location_id from location_master');
        return $query->result_array(); 
    }

    public function count_location()
    {
        $this->db->select('*');
        $this->db->from('location_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_location($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('location_master', $data);
        return $insert;
    }

    public function update_location($location_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('location_id', $location_id);
        $update=$this->db->update('location_master', $data);
        
        return $update;
    }

    public function delete_location($location_id)
    {
        $this->db->where('location_id', $location_id);
        $this->db->delete('location_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

