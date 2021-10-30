<?php

Class RequestTypeModel extends CI_Model {
            
    public function get_request_type($request_type_id = null)
    {
        $this->db->select('*');
        $this->db->from('request_type_master');

        if ($request_type_id != null)
        {    
            $this->db->where('request_type_id', $request_type_id);          
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_request_type_id()
    {
        $query = $this->db->query('select ifnull(max(request_type_id),0) + 1 as next_request_type_id from request_type_master');
        return $query->result_array(); 
    }
    
    public function count_request_type()
    {
        $this->db->select('*');
        $this->db->from('request_type_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_request_type($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('request_type_master', $data);
        return $insert;
    }

    public function update_request_type($request_type_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('request_type_id', $request_type_id);
        $update=$this->db->update('request_type_master', $data);
        
        return $update;
    }

    public function delete_request_type($request_type_id)
    {
        $this->db->where('request_type_id', $request_type_id);
        $this->db->delete('request_type_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

