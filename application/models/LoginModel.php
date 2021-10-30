<?php

class LoginModel extends CI_Model
{
     //get the user_id & password from user_master
    public function validate_user($user_id){
        
        $this->db->select('*');
        $this->db->from('user_master');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 1);

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
    
    public function get_user_data($user_id){
         
        $this->db->select('*');
        $this->db->from('user_master');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
          
    }
    
    public function update_password($user_id, $data){
        
        $this->db->where('user_id', $user_id);
        $update=$this->db->update('user_master', $data);
        
        return $update;
    }
}

?>