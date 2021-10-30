<?php

Class SubCategoryModel extends CI_Model {
      
    public function get_sub_category($sub_category_id = null,$category_id = null)
    {   
        
        $this->db->select('scm.sub_category_id,scm.sub_category_description,scm.category_id,cm.category_description');
        $this->db->from('sub_category_master scm');
        $this->db->join('category_master cm', 'cm.category_id = scm.category_id');
          
        if ($sub_category_id != null){
            $this->db->where('scm.sub_category_id', $sub_category_id);     
        }
        
        if ($category_id != null){
            $this->db->where('cm.category_id', $category_id);    
        }
        
        $query = $this->db->get();
        
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
  
    }   

    public function get_next_sub_category_id()
    {
        $query = $this->db->query('select ifnull(max(sub_category_id),0) + 1 as next_sub_category_id from sub_category_master');
        return $query->result_array(); 
    }
    
    public function count_sub_category()
    {
        
        $query = $this->db->query($this->sql);
        return $query->num_rows();  
    }

    public function insert_sub_category($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('sub_category_master', $data);
        return $insert;
    }

    public function update_sub_category($sub_category_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('sub_category_id', $sub_category_id);
        $update=$this->db->update('sub_category_master', $data);
        
        return $update;
    }

    public function delete_sub_category($sub_category_id)
    {
        $this->db->where('sub_category_id', $sub_category_id);
        $this->db->delete('sub_category_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
      
}