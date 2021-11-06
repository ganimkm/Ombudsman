<?php

Class StockAnalyticsModel extends CI_Model {

    Public Function get_stock_register($fromdate,$todate,$item_id="ALL")
    {   
        
        $wherecluase = "";

        if ($item_id != "ALL")
        { 
            $wherecluase = " where vtx.item_id=" . $item_id ;
        }

        $sql="select @a:=@a+1 serial_number,if(@prev_id=vtx.item_id,@itsum := @itsum + vtx.item_qty,@itsum := vtx.item_qty) item_current_stock,@prev_id := vtx.item_id,vtx.* from (

            select isr.item_id,im.item_name,'OPEN' as stock_type,'' as date_on,sum(isr.item_qty) as item_qty,'' as ref_number,
            '' as user_id,'' as user_name,'' as location_name,'' as department_name,
            '' as logged_on,'' as actual_description,'' as resolved_description,'' as resolved_on,'' as resolved_by,'' as engineer_name,1 as row_num 
            from item_master im left join item_stock_register isr on isr.item_id = im.item_id 
            where date(isr.date_on) <= '". $fromdate ."' group by isr.item_id
            
            union all
            
            select *,2 as row_num from (select isr.item_id,im.item_name,'INWARD' as stock_type,isr.date_on,isr.item_qty,isr.ref_number,
            '' as user_id,'' as user_name,'' as location_name,'' as department_name,
            '' as logged_on,'' as actual_description,'' as resolved_description,'' as resolved_on,'' as resolved_by,'' as engineer_name
            from item_stock_register isr inner join item_master im on isr.item_id = im.item_id 
            where isr.item_qty > 0
            
            union all
            
            select isr.item_id,im.item_name,'ISSUE' as stock_type,isr.date_on,isr.item_qty,isr.ref_number,
            inh.user_id,um1.user_name,lm.location_name,dm.department_name,
            inh.logged_on,inh.actual_description,inh.resolved_description,inh.resolved_on,inh.resolved_by,um2.user_name as engineer_name
            from item_stock_register isr inner join item_master im on isr.item_id = im.item_id 
            inner join incident_header inh on isr.ref_number = inh.incident_number
            inner join location_master lm on inh.location_id=lm.location_id
            inner join department_master dm on inh.department_id=dm.department_id
            inner join user_master um1 on inh.user_id = um1.user_id
            inner join user_master um2 on inh.resolved_by = um2.user_id
            where isr.item_qty < 0) vt where date(vt.date_on) > '". $fromdate ."'
            
            union all
            
            select isr.item_id,im.item_name,'CLOSE' as stock_type,'' as date_on,sum(isr.item_qty) as item_qty,'' as ref_number,
            '' as user_id,'' as user_name,'' as location_name,'' as department_name,
            '' as logged_on,'' as actual_description,'' as resolved_description,'' as resolved_on,'' as resolved_by,'' as engineer_name,3 as row_num 
            from item_stock_register isr inner join item_master im on isr.item_id = im.item_id 
            where date(isr.date_on) <= '". $todate ."' group by isr.item_id,im.item_name
            
            ) vtx,(SELECT @a:= 0) AS a " . $wherecluase . " order by item_id,row_num,date_on";

        //echo $sql;
        
        $query = $this->db->query($sql);
        return $query->result_array();  
        
    }   
  
}

