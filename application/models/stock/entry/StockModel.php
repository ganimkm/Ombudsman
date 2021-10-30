<?php

Class StockModel extends CI_Model {
            
    public function get_current_stock($item_id=null)
    { 
       
        $this->db->select("itm.item_id,itm.item_name,ifnull(sum(itsm.item_qty),0) as item_stock,ifnull(itm.reorder_level_qty,0) as reorder_level",false);
        
        $this->db->from("item_master itm");
        $this->db->join("item_stock_register itsm", "itsm.item_id=itm.item_id", 'left');
        
        

        if ($item_id != null or $item_id != ""){
            $this->db->where('itm.item_id',$item_id, false);
        }
 
        $this->db->group_by("itm.item_id");
        $this->db->order_by("itm.item_id",null,false); 
        
        $query = $this->db->get();
        return $query->result_array();   
    }
    
    public function get_issue_detail($issue_number=null)
    { 
       
        $this->db->select("itid.issue_number,itid.issue_date,itid.item_id,itm.item_name,itid.issue_qty,itid.ref_number",false);
        
        $this->db->from("item_issue_detail itid");
        $this->db->join("item_master itm", "itid.item_id=itm.item_id");
        
        if ($issue_number != null or $issue_number != ""){
            $this->db->where('itid.issue_number',$issue_number, false);
        }

        $this->db->order_by("itid.issue_number desc",null,false); 
        
        $query = $this->db->get();
        return $query->result_array();   
    }
    
    public function get_next_inward_number()
    {
        $query = $this->db->query("select ifnull(max(inward_number),0) + 1 as next_inward_number from item_inward_detail");
        return $query->result_array(); 
    }
    
    public function insert_inward($data,$stock_register_data)
    {
        $this->db->trans_begin();
                
        $this->db->set('last_update', 'now()', false);
        
        $insert = $this->db->insert('item_inward_detail', $data);
        $insert = $this->db->insert('item_stock_register', $stock_register_data);
        
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();         
        }

        return $insert;
    }
    
    public function get_next_issue_number()
    {
        $query = $this->db->query("select ifnull(max(issue_number),0) + 1 as next_issue_number from item_issue_detail");
        return $query->result_array(); 
    }
    
    public function insert_issue($data,$stock_register_data)
    {
        $this->db->trans_begin();
                
        $this->db->set('last_update', 'now()', false);
        
        $insert = $this->db->insert('item_issue_detail', $data);
        $insert = $this->db->insert('item_stock_register', $stock_register_data);
        
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();         
        }

        return $insert;
    }
    
    public function delete_issue($issue_number)
    {
        $this->db->trans_begin();
        
        $this->db->where('issue_number', $issue_number);
        $this->db->delete('item_issue_detail'); 
        
        $this->db->where('issue_number', $issue_number);
        $this->db->delete('item_stock_register'); 
        
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();         
        }
        
    }
}

