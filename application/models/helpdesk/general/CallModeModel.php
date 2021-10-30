<?php

Class CallModeModel extends CI_Model {
            
    public function get_call_mode($call_mode_id = null)
    {
        $this->db->select('*');
        $this->db->from('call_mode_master');
        
        if ($call_mode_id != null)
        {
            $this->db->where('call_mode_id', $call_mode_id); 
        }

        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_call_mode_id()
    {
        $query = $this->db->query('select ifnull(max(call_mode_id),0) + 1 as next_call_mode_id from call_mode_master');
        return $query->result_array(); 
    }

    public function count_call_mode()
    {
        $this->db->select('*');
        $this->db->from('call_mode_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_call_mode($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('call_mode_master', $data);
        return $insert;
    }

    public function update_call_mode($call_mode_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('call_mode_id', $call_mode_id);
        $update= $this->db->update('call_mode_master', $data);

        return $update;
      
    }

    public function delete_call_mode($call_mode_id)
    {
        $this->db->where('call_mode_id', $call_mode_id);
        $this->db->delete('call_mode_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }
    
}

