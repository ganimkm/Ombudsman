<?php

Class WIFIUserModel extends CI_Model {
    

    public function get_wifi_users($wifi_user_id = null)
    {
        $this->db->select('*');
        $this->db->from('wifi_users');
        
        if ($wifi_user_id != null)
        {
            $this->db->where('wifi_user_id', $wifi_user_id); 
        }

        $query = $this->db->get();
        return $query->result_array(); 
    } 
    
    public function get_next_wifiuser_id()
    {
        $query = $this->db->query('select ifnull(max(wifi_user_id),0) + 1 as next_wifi_user_id from wifi_users');
        return $query->result_array(); 
    }

    public function insert_wifi_user($data)
    {     
        $insert = $this->db->insert('wifi_users', $this->db->escape_str($data));
        return $insert;
    }

    public function update_wifi_user($wifi_user_id, $data)
    {
        $this->db->where('wifi_user_id', $wifi_user_id);
        $update=$this->db->update('wifi_users', $data);

        return $update;
        
    }

    public function delete_wifi_user($wifi_user_id)
    {
        $this->db->where('wifi_user_id', $wifi_user_id);
        $this->db->delete('wifi_users'); 
    }
        
}

