<?php

Class DepartmentModel extends CI_Model {
    
    public function get_department($department_id = null)
    {   
        $this->db->select('*');
        $this->db->from('department_master');
        
        if ($department_id != null)
        {
            $this->db->where('department_id', $department_id); 
        }

        $query = $this->db->get();
        return $query->result_array();  
        
    }   
    
    public function get_next_department_id()
    {
        $query = $this->db->query('select ifnull(max(department_id),0) + 1 as next_department_id from department_master');
        return $query->result_array(); 
    }
    
    public function count_department()
    {
        $query = $this->db->query($this->sql);
        return $query->num_rows();  
    }

    public function insert_department($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('department_master', $data);
        return $insert;
    }

    public function update_department($department_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('department_id', $department_id);
        $update=$this->db->update('department_master', $data);
        
        return $update;
    }

    public function delete_department($department_id)
    {
        $this->db->where('department_id', $department_id);
        $this->db->delete('department_master'); 
    }
    
    public function __destruct() {  
        $this->db->close();  
    }    
    
}

