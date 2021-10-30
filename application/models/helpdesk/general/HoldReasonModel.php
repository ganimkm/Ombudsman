<?php

Class HoldReasonModel extends CI_Model {
            
    public function get_hold_reason($hold_reason_id = null)
    {
        $this->db->select('*');
        $this->db->from('hold_reason_master');

        if ($hold_reason_id != null)
        {    
            $this->db->where('hold_reason_id', $hold_reason_id);          
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_hold_reason_id()
    {
        $query = $this->db->query('select ifnull(max(hold_reason_id),0) + 1 as next_hold_reason_id from hold_reason_master');
        return $query->result_array(); 
    }
    
    public function count_hold_reason()
    {
        $this->db->select('*');
        $this->db->from('hold_reason_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_hold_reason($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('hold_reason_master', $data);
        return $insert;
    }

    public function update_hold_reason($hold_reason_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('hold_reason_id', $hold_reason_id);
        $update=$this->db->update('hold_reason_master', $data);
        
        return $update;
    }

    public function delete_hold_reason($hold_reason_id)
    {
        $this->db->where('hold_reason_id', $hold_reason_id);
        $this->db->delete('hold_reason_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

