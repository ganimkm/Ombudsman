<?php

Class UserModel extends CI_Model {
    

    public function get_user($user_id=null)
    {   
        
        $this->db->select("um.user_id,um.user_name,um.password,um.email_address,um.mobile_number,um.designation,um.location_id,lm.location_name,um.department_id,dm.department_name,
        is_active,case is_active when 1 then 'Yes' else 'No' end as is_active_description,
        is_admin,case is_admin when 1 then 'Yes' else 'No' end as is_admin_description,
        IfNull(um.profile_picture,'noimage.png') as profile_picture,
        is_ticket_resolver,case is_ticket_resolver when 1 then 'Yes' else 'No' end as is_ticket_resolver_description");
        
        $this->db->from('user_master um');
        $this->db->join('location_master lm','lm.location_id = um.location_id' );
        $this->db->join('department_master dm','um.department_id = dm.department_id');
        $this->db->where('um.is_active', '1');  
          
        if ($user_id != null or $user_id != ""){
            $this->db->where('um.user_id', $user_id);     
        }

        $this->db->order_by('um.user_id', 'ASC');
        
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
    
    public function get_all_user()
    {   
        
        $this->db->select("*");
        $this->db->from('user_master um');

        $this->db->order_by('um.user_id', 'ASC');
        
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
    
    public function get_ticket_resolver_user($user_id=null)
    {   
        
        $this->db->select("um.user_id,um.user_name,um.password,um.email_address,um.mobile_number,um.designation,um.location_id,lm.location_name,um.department_id,dm.department_name,
        is_active,case is_active when 1 then 'Active' else 'In Active' end as is_active_description,
        is_admin,case is_admin when 1 then 'Admin' else 'Normal User' end as is_admin_description,
        is_ticket_resolver,case is_ticket_resolver when 1 then 'Resolver' else 'Normal User' end as is_ticket_resolver_description");
        
        $this->db->from('user_master um');
        $this->db->join('location_master lm','lm.location_id = um.location_id' );
        $this->db->join('department_master dm','um.department_id = dm.department_id');
          
        $this->db->where('um.is_ticket_resolver', '1');     
        $this->db->where('um.is_active', '1');  
        
        if ($user_id != null or $user_id != ""){
            $this->db->where('um.user_id', $user_id);     
        }

        $this->db->order_by('um.user_id', 'ASC');
        
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

    public function insert_user($data)
    {     
        $insert = $this->db->insert('user_master', $this->db->escape_str($data));
        return $insert;
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        $update=$this->db->update('user_master', $data);

        return $update;
        
    }

    public function delete_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_master'); 
    }
    
    public function is_admin_user($user_id){
         
        $sql = "select user_id from user_master where is_admin='1' and user_id = '" . $user_id . "'";   
        $query = $this->db->query($sql);

        //echo $this->db->last_query();
        
        if($query->num_rows() != 0)
        {
            return true;
        }
        else
        {
            return false;
        } 
    }
    
}

