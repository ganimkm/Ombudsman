<?php

Class AssignMenuModel extends CI_Model {
            
    Public Function Get_Menus($user_id = NULL)
    {
           
        if ($user_id != NULL)
        {
            $query = $this->db->query("Select MM.Menu_ID,MM.Description as Menu_Description,MM.Menu_Group_ID,MGM.Description as Menu_Group_Description,MM.Page_Link
                        From Menu_Master MM Left join Menu_Master MGM ON MM.Menu_Group_ID = MGM.Menu_ID
                        Order By MM.Menu_Group_ID");

            return $query->result_array();          
        }
        else 
        {
            $query = $this->db->query("Select MM.Menu_ID,MM.Description as Menu_Description,MM.Menu_Group_ID,MGM.Description as Menu_Group_Description,MM.Page_Link
                                    From Menu_Master MM Left join Menu_Master MGM ON MM.Menu_Group_ID = MGM.Menu_ID
                                    Order By MM.Menu_Group_ID");

            return $query->result_array();         
        }    
    }        
}