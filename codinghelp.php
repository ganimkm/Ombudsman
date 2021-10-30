    

<!--
------------------------snmpwalk-------------------------------------------


<?php

    $oid = ".1.3.6.1.2.1.2.2.1.8";   // Interface description
    $oid1 = ".1.3.6.1.2.1.2.2.1.1";   // Alias Name


     $out = snmpwalk('172.20.10.210','snmain','.1.3.6.1.2.1.2.2.1.1');

     $out1 = snmpwalk('172.20.10.210','snmain','.1.3.6.1.2.1.2.2.1.2');
     
     $out2 = snmpwalk('172.20.10.210','snmain','.1.3.6.1.2.1.2.2.1.5');
     
     $out3 = snmpwalk('172.20.10.210','snmain','.1.3.6.1.2.1.2.2.1.8');
     
     //$out4 = snmpwalk('172.20.10.210','snmain','.1.3.6.1.2.1.2.2.1.18');
//                                         
//                                         foreach($out1 as $key => $value)
//                                         {
//                                        # echo $key ;
//                                         echo $value."<br>";
//                                         }
// 
//   
     
//==============================Multiple array show===========================================
     
        foreach( $out1 as $index => $code ) {
        //echo '<option value="' . $code . '">' . $names[$index] . '</option>';
         echo $code . '    ' . $out2[$index]. $out3[$index]. $out[$index] . $out[$index] . "<br>";
        }
        
?>

------------------------multiple row insert-------------------------------------------

<tr>
    <td><input type="text" name="user[0][name]" value=""></td>
    <td><input type="text" name="user[0][address]" value=""><br></td>
    <td><input type="text" name="user[0][age]" value=""></td>
    <td><input type="text" name="user[0][email]" value=""></td>
</tr>
<tr>
    <td><input type="text" name="user[1][name]" value=""></td>
    <td><input type="text" name="user[1][address]" value=""><br></td>
    <td><input type="text" name="user[1][age]" value=""></td>
    <td><input type="text" name="user[1][email]" value=""></td>
</tr>
Then you can simply do:

foreach($_POST['user'] as $user)
{
    $this->db->insert('mytable', $user);
}


------------------------commit Rollback in codeigniter-------------------------------------------

<?php

$this->db->trans_begin();

//insert transaction
$i_data = array(
      'user_id'     => $app['opp_id']
    , 'amount'      => $app['total']
    , 'type'        => 1
    , 'feb_bal'     => 1
    , 'note'        => 'Earnings' 
);

$this->db->insert('transaction', $i_data);
$tran_id = $this->db->insert_id();

//insert 2
$c_data = array(
      'oppt_opp_id' => $app['id']
    , 'status'      => 0 //closed
);
$this->db->insert('progress', $c_data);

//insert 3 
$e_data = array(
      'tran_id' => $tran_id
    , 'app_id'  => $app['id']
    , 'type'    => 1
    , 'status'  => 2
);
$this->db->insert('earn_spend', $e_data);

if ($this->db->trans_status() === FALSE)
{
    $this->db->trans_rollback();
}
else
{
    $this->db->trans_commit();
}

?>


------------------------Array Search-------------------------------------------
$key = array_search('red', $array);   // $key = 1;

------------------------get table td value-------------------------------------------

echo '<td>'.$ip_address[0]['IP_ADDRESS'].'</td>';
echo '<td>'.$this->utility->SNMP_Clean_Output($interface_number).'</td>';
echo '<td class="alias">'.$this->utility->SNMP_Clean_Output($ip_interface_alias[$index]).'</td>'; 
echo '<td>'.$this->utility->SNMP_Clean_Output($ip_interface_description[$index]).'</td>'; 
echo '<td>'.$this->utility->SNMP_Clean_Output($ip_interface_ifspeed[$index]).'</td>'; 

interfacealias = $(this).closest('tr').children('td.pEmail').text() + "," ;




-------------------------------



<?php
$_snmp_ip = '172.20.8.202';
$_snmp_com = 'snmain';

$_dot1dTpFdbAddress = snmp2_real_walk($_snmp_ip, $_snmp_com, ".1.3.6.1.2.1.17.4.3.1.1.0");

foreach($_dot1dTpFdbAddress  as $_dot1dTpFdbAddress_key => $_dot1dTpFdbAddress_value)
{
        preg_match("/(\.[\d]*){6}$/i", $_dot1dTpFdbAddress_key, $_dot1dTpFdbAddress_key_unique);
        preg_match("/([0-9A-F ]*){6}$/i", $_dot1dTpFdbAddress_value, $_dot1dTpFdbAddress_value_unique);
        
        echo $_dot1dTpFdbAddress_key_unique['0'] .'<br>';
        
        $_dot1dTpFdbPort = snmp2_get($_snmp_ip, $_snmp_com, ".1.3.6.1.2.1.17.4.3.1.2".$_dot1dTpFdbAddress_key_unique['0']);

        preg_match("/[\d]*$/i", $_dot1dTpFdbPort, $_dot1dTpFdbPort);
        $_dot1dBasePortIfIndex = snmp2_get($_snmp_ip, $_snmp_com, ".1.3.6.1.2.1.17.1.4.1.2.".$_dot1dTpFdbPort['0']);

        preg_match("/[\d]*$/i", $_dot1dBasePortIfIndex, $_dot1dBasePortIfIndex);
        $_ifName = snmp2_get($_snmp_ip, $_snmp_com, ".1.3.6.1.2.1.31.1.1.1.1.".$_dot1dBasePortIfIndex['0']);

        preg_match("/\"([^\"]*)\"$/i", $_ifName, $_ifName);

        $mac = str_replace(" ", ":", strtolower($_dot1dTpFdbAddress_value_unique['0']));
        $mac = preg_replace("(^:|:$)","", $mac);
        $_mac[$mac] = $_ifName['1'];
}
//print_r($_mac);


/* Create Job for Breached call updatation


DELIMITER $$

CREATE EVENT UPDATE_BREACHED_CALLS
	ON SCHEDULE EVERY 1 MINUTE STARTS '2017-08-08 00:00:00' 
	DO 
  
  BEGIN
	
    update incident_header set breached_on=DATE_ADD(planned_resolve_on, INTERVAL 60 SECOND)
    where resolved_on is null and breached_on is null and planned_resolve_on < Now();
	    
	END $$

DELIMITER ;

select * from information_schema.EVENTS

SET GLOBAL event_scheduler = ON;
SET @@global.event_scheduler = ON;
SET GLOBAL event_scheduler = 1;
SET @@global.event_scheduler = 1;
 
 */

?>
 



 -->