<?php

Class CategoryModel extends CI_Model {
            
    public function get_category($category_id = null)
    {
        $this->db->select('*');
        $this->db->from('category_master');
        
        if ($category_id != null)
        {
            $this->db->where('category_id', $category_id); 
        }

        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function get_next_category_id()
    {
        $query = $this->db->query('select ifnull(max(category_id),0) + 1 as next_category_id from category_master');
        return $query->result_array(); 
    }

    public function count_category()
    {
        $this->db->select('*');
        $this->db->from('category_master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function insert_category($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('category_master', $data);
        return $insert;
    }

    public function update_category($category_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('category_id', $category_id);
        $update=$this->db->update('category_master', $data);
        
        return $update;
    }

    public function delete_category($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->delete('category_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }
    
}

