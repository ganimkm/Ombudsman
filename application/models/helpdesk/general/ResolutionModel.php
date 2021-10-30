<?php

Class ResolutionModel extends CI_Model {
            
    public function get_resolution($resolution_id = null)
    {
        $this->db->select('*');
        $this->db->from('resolution_master');
        
        if ($resolution_id != null)
        {
            $this->db->where('resolution_id', $resolution_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_resolution_id()
    {
        $query = $this->db->query('select ifnull(max(resolution_id),0) + 1 as next_resolution_id from resolution_master');
        return $query->result_array(); 
    }

    public function count_resolution()
    {
        $this->db->select('*');
        $this->db->from('resolution_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_resolution($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('resolution_master', $data);
        return $insert;
    }

    public function update_resolution($resolution_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('resolution_id', $resolution_id);
        $update=$this->db->update('resolution_master', $data);
        
        return $update;
    }

    public function delete_resolution($resolution_id)
    {
        $this->db->where('resolution_id', $resolution_id);
        $this->db->delete('resolution_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

