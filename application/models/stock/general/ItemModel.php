<?php

Class ItemModel extends CI_Model {
            
    public function get_item($item_id = null)
    {
        $this->db->select('*');
        $this->db->from('item_master');
        
        if ($item_id != null)
        {
            $this->db->where('item_id', $item_id); 
        }

        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_item_id()
    {
        $query = $this->db->query('select ifnull(max(item_id),0) + 1 as next_item_id from item_master');
        return $query->result_array(); 
    }

    public function count_item()
    {
        $this->db->select('*');
        $this->db->from('item_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_item($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('item_master', $data);
        return $insert;
    }

    public function update_item($item_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('item_id', $item_id);
        $update=$this->db->update('item_master', $data);
        
        return $update;
    }

    public function delete_item($item_id)
    {
        $this->db->where('item_id', $item_id);
        $this->db->delete('item_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }
    
}

