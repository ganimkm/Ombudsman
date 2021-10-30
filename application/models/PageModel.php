<?php

Class PageModel extends CI_Model {
            
    Public Function Get_Page($page_id = NULL)
    {
        $this->db->select('*');
        $this->db->from('Page_Master');
        
        if ($page_id != NULL)
        {
            $this->db->where('page_id', $page_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    Public Function Get_Next_Page_ID()
    {
        $query = $this->db->query('SELECT ifnull(MAX(Page_ID),0) + 1 as Next_Page_ID FROM Page_Master');
        return $query->result_array(); 
    }

    Public Function Count_Page()
    {
        $this->db->select('*');
        $this->db->from('Page_Master');
        $query = $this->db->get();
        return $query->num_rows();  
    }

    Public Function Insert_Page($data)
    {
        $this->db->set('last_update', 'NOW()', FALSE);
        $insert = $this->db->insert('Page_Master', $data);
        return $insert;
    }

    Public Function Update_Page($page_id, $data)
    {
        $this->db->set('last_update', 'NOW()', FALSE);
        $this->db->where('page_id', $page_id);
        $update=$this->db->update('Page_Master', $data);
        
        return $update;
    }

    Public Function Delete_page($page_id)
    {
        $this->db->where('page_id', $page_id);
        $this->db->delete('Page_Master'); 
    }
    
    Public function __destruct() {  
        $this->db->close();  
    }    
        
}

