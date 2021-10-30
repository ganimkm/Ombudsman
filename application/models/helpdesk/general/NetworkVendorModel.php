<?php

Class NetworkVendorModel extends CI_Model {
            
    public function get_network_vendor($network_vendor_id = null)
    {
        $this->db->select('*');
        $this->db->from('network_link_call_logging');
        
        if ($network_vendor_id != null)
        {
            $this->db->where('id', $network_vendor_id);
        }
     
        $query = $this->db->get();
        return $query->result_array(); 
    }    
    
    public function __destruct() {  
        $this->db->close();  
    }    
        
}

