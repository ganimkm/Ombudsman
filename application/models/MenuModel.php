<?php

Class MenuModel extends CI_Model {
    
    public function get_menu_items()
    {   

        $this->db->select('mm.menu_id,mm.menu_parent_id,mm.menu_name,mm.page_link,mm.menu_icon,mm.sort_order');
        $this->db->from('menu_master mm');
        $this->db->order_by('mm.menu_parent_id ASC,mm.sort_order ASC');
       
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
    
    public function is_page_link_valid4user($user_id,$page_link,$is_admin)
    {

        if ($is_admin != 1){
            $menus = $this->get_menu_items4user($user_id,0,false,$page_link);
        }else{
            return true;
        }    
        
        if(empty($menus))
        {
             return false;
             
        }else{
            
            return true;
        }  
        
    }        
    
    public function get_menu($menu_id = null)
    {
        $this->db->select('*');
        $this->db->from('menu_master');
        
        if ($menu_id != null)
        {
            $this->db->where('menu_id', $menu_id); 
        }

        $query = $this->db->get();
        return $query->result_array(); 
    }    

    public function get_menu_group()
    {
        $this->db->select('*');
        $this->db->from('menu_master');
        $this->db->where('menu_id is null', null, false); 
        
        $query = $this->db->get();
        return $query->result_array(); 
    }  
    
    public function get_next_menu_id()
    {
        $query = $this->db->query('select ifnull(max(menu_id),0) + 1 as next_menu_id from menu_master');
        return $query->result_array(); 
    }

    public function insert_menu($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert('menu_master', $data);
        return $insert;
    }

    public function update_menu($menu_id, $data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('menu_id', $menu_id);
        $update=$this->db->update('menu_master', $data);
        
        return $update;
    }

    public function delete_menu($menu_id)
    {
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('menu_master'); 
    }
    
    
    public function get_menu_levels_below($menu_group_id)
    {
        
        $num_rows=0;
        $num_levels_below=0;

        $sql= "select distinct menu_id from menu_master where menu_parent_id=" . $menu_group_id;

        $query = $this->db->query($sql);

        $num_rows = $query->num_rows();
        
            while ($num_rows > 0) 
            {

                $sql= "select distinct menu_id from menu_master where menu_parent_id in (" . $sql . ")";

                $query = $this->db->query($sql);
                $num_rows = $query->num_rows(); 

                $num_levels_below= $num_levels_below + 1;

            }
        
        return $num_levels_below;
        
    }
    
    public function get_max_menu_levels()
    {
        
        $num_rows=0;
        $num_level=0;
        $num_max_levels=0;

        $sql= "select menu_id from menu_master where menu_parent_id is null";

        $query = $this->db->query($sql);
        
        $num_rows = $query->num_rows(); 
        $menu = $query->result_array(); 

            if ($num_rows < 0){
                exit;
            }
            
            foreach($menu as $row)
            {
               
                $num_level = $this->get_menu_levels_below($row['menu_id']);

                if ($num_level < 0){
                    exit;
                }

                if ($num_level > $num_max_levels){
                    $num_max_levels = $num_level;
                }

            }
        
        return $num_max_levels;
                       
    }
    
    public function get_menu_items4user($user_id,$menu_parent_id=0,$include_all=false,$page_link=null)            
    {
        $sql="";
        $sqldepth="";
        $sqlmain="";
        $sqlcomplement="";
        
        $whereclause = "";
        
        $max_level=0;
        $i=0;        
        
        $max_level=$this->get_max_menu_levels();
        
            if ($max_level < 1){
                exit;
            }
            
        $sql = "select menu_id from user_menu_detail where user_id='" . $user_id . "'";
        $sqlmain = $sql;    
        
            for ($i = 0; $i <= $max_level; $i++) {
                
                $sqlmain = $sqlmain . " union select menu_id from menu_master where menu_parent_id in (" . $sql . ")";
                $sql = " select menu_id from menu_master where menu_parent_id in (" . $sql . ")";

            }
            
        $sql = "select menu_id from user_menu_detail where user_id='" . $user_id . "'";
            
            for ($i = 0; $i <= $max_level; $i++) {
                
                $sqlmain = $sqlmain . " union select menu_parent_id from menu_master where menu_id in (" . $sql . ")";
                $sql = " select menu_parent_id from menu_master where menu_id in (" . $sql . ")";

            }
            
        $sqldepth="";

        $sql = "select menu_id from menu_master where menu_parent_id is null";
        $sqldepth = "select menu_id,menu_name,menu_parent_id,0 as depth,sort_order from menu_master where menu_parent_id is null";
        
             for ($i = 0; $i <= $max_level; $i++) {
                
                $sqldepth = $sqldepth . " union select menu_id,menu_name,menu_parent_id," . $i . " as depth,sort_order from menu_master where menu_parent_id in (" . $sql . ")";
                $sql = " select menu_id from menu_master where menu_parent_id in (" . $sql . ")";

            }
            

        $sql = "select menu_id from menu_master";
        $sqlcomplement = $sql;
        
            for ($i = 0; $i <= $max_level; $i++) {
                
                $sqlcomplement = $sqlcomplement . " union select menu_id from menu_master where menu_parent_id in (" . $sql . ")";
                $sql = " select menu_id from menu_master where menu_parent_id in (" . $sql . ")";

            }
            
        $sql = "select menu_id from menu_master";
        
            for ($i = 0; $i <= $max_level; $i++) {
                
                $sqlcomplement = $sqlcomplement . " union select menu_parent_id from menu_master where menu_id in (" . $sql . ")";
                $sql = " select menu_parent_id from menu_master where menu_id in (" . $sql . ")";

            }
            
        $sql = "select menu_id,menu_name,menu_parent_id,page_link,menu_icon,depth,valid,sort_order from (";

        $sql =$sql . " select um.menu_id,um.menu_name,um.menu_parent_id,um.page_link,um.menu_icon,dm.depth,'true' as valid,um.sort_order from ";
        $sql =$sql . " (";
        $sql =$sql . " select v.menu_id,mm.menu_name,mm.menu_parent_id,mm.page_link,mm.menu_icon,mm.sort_order from menu_master mm,";
        $sql =$sql . " (";
        $sql =$sql . $sqlmain;
        $sql =$sql . " ) v";
        $sql =$sql . " where mm.menu_id = v.menu_id";
        $sql =$sql . " ) um,";
        $sql =$sql . " (";
        $sql =$sql . $sqldepth;
        $sql =$sql . " ) dm";
        $sql =$sql . " where um.menu_id = dm.menu_id";

        $sql =$sql . " union ";

        $sql =$sql . " select amnu.menu_id,amnu.menu_name,amnu.menu_parent_id,amnu.page_link,amnu.menu_icon,amnu.depth,amnu.valid,amnu.sort_order from";
        $sql =$sql . " (";
        $sql =$sql . " select um.menu_id,um.menu_name,um.menu_parent_id,um.page_link,um.menu_icon,dm.depth,'false' as valid,um.sort_order from";
        $sql =$sql . " (";
        $sql =$sql . " select v.menu_id,mm.menu_name,mm.menu_parent_id,mm.page_link,mm.menu_icon,mm.sort_order from menu_master mm,";
        $sql =$sql . " (";
        $sql =$sql . $sqlcomplement;
        $sql =$sql . " ) v";
        $sql =$sql . " where mm.menu_id = v.menu_id";
        $sql =$sql . " ) um,";
        $sql =$sql . " (";
        $sql =$sql . $sqldepth;
        $sql =$sql . " ) dm";
        $sql =$sql . " where um.menu_id = dm.menu_id";
        $sql =$sql . " ) amnu";
        $sql =$sql . " where amnu.menu_id not in";
        $sql =$sql . " (";
        $sql =$sql . " select v.menu_id from menu_master mm,";
        $sql =$sql . " (";
        $sql =$sql . $sqlmain;
        $sql =$sql . " ) v";
        $sql =$sql . " where mm.menu_id = v.menu_id";
        $sql =$sql . " )";
        $sql =$sql . " ) mnutree";    
        
        if ($include_all == false) {
            $whereclause = " valid='true'";
        }

        if ($menu_parent_id <> 0) {

            if ($whereclause <> "") {
                $whereclause = $whereclause . " and ";
            }

            if ($menu_parent_id <> -1) {
                $whereclause = $whereclause . " menu_parent_id=" . $menu_parent_id;
            }
            else{
                $whereclause = $whereclause . " menu_parent_id is null";
            }

        }

        if ($page_link != null) {
            
            if ($whereclause <> "") {
                $whereclause = $whereclause . " and ";
            }
            
            $whereclause = $whereclause . " page_link='" . $page_link ."'";
            
        }
        
        if ($whereclause <> "") {
            $sql = $sql . " where " . $whereclause;
        }

        $sql = $sql . " order by depth,sort_order";
       
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }
    
    
    public function get_html_menu($user_id,$is_admin){
        
        if ($is_admin != 1){
            $menus = $this->get_menu_items4user($user_id);
        }else{
            $menus = $this->get_menu_items();
        }    
        
        return $this->get_menu_array($menus);
        
    }
            
    public function get_menu_array($menu_items)
    {
    // create an array to hold the references
        $refs = array();

        //create and array to hold the list
        $list = array();

        // loop over the results
        //while($data = @mysql_fetch_assoc($result))
        foreach($menu_items as $data)
        {
            // assign by reference
            $thisref = &$refs[ $data['menu_id'] ];

            // add the the menu parent
            $thisref['menu_id'] = $data['menu_parent_id'];
            $thisref['menu_name'] = $data['menu_name'];
            $thisref['page_link'] = $data['page_link'];
            $thisref['menu_icon'] = $data['menu_icon'];

            // if there is no parent id
            if (is_null($data['menu_parent_id']))
            {
                $list[ $data['menu_id'] ] = &$thisref;
            }
            else
            {
                $refs[ $data['menu_parent_id'] ]['children'][ $data['menu_id'] ] = &$thisref;
            }
        }
        
        //print_r($list);
        return $this->arrange_html_menu($list);
    
    }

    private function arrange_html_menu($menu_arr)
    {
        
        //$menu_html .= $menu_html;
        
        $menu_html = "\n";
        
        foreach ($menu_arr as $key=>$v) 
        {
            if (array_key_exists('children', $v))
            {
                $menu_html .= "<li class='xn-openable active'>";
                $menu_html .= "<a href=" . site_url($v['page_link']) . "><span class='" . $v['menu_icon'] ."'></span> <span class='xn-text'>" . $v['menu_name'] . "</span></a>";
                $menu_html .= "\n<ul>\n";
                $menu_html .= $this->arrange_html_menu($v['children']);
                $menu_html .= "</ul>\n";
                $menu_html .= "</li>\n";
            }
            else{
                $menu_html .= "<li>";
                $menu_html .= "<a href=" . site_url($v['page_link']) . "><span class='" . $v['menu_icon'] ."'></span> <span class='xn-text'>" . $v['menu_name'] . "</span></a>";
                $menu_html .= "</li>\n";
            }
        }
        
         $menu_html .= "</li>\n";
        return $menu_html;
    }
      
 }

