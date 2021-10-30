<?php

    // Create customized config variables
    $config['Web_Address']= 'http://172.20.10.56/Ombudsman/index.php';
    $config['Project_title']= 'Ombudsman';
    $config['Developed_By']= 'IT Team';


    $config['closed_email_template'] = '<body>

<table style="font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #212F3D;
	border-collapse: collapse;
	width:50%">
	
<tr>

	<th colspan="2" style="color:#ffffff;
	border-width: 1px;
	font-size: 15px;
	padding: 20px 8px;
	border-style: solid;
	border-color: #D5D8DC;
	background-color:#1CAF9A;">Sankara Nethralaya IT Helpdesk</th>


</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Ticket #</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##TICKET_NUMBER##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Created On</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##CREATED_DATE##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">User NAME</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##USER_NAME##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Problem Description</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##PROBLEM_DESCRIPTION##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">RESOLVED BY</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##CALL_RESOLVED_BY##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Current Status</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##CURRENT_STATUS##</td>
</tr>

</table>

</body>';

$config['email_template'] = '<body>

<table style="font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #212F3D;
	border-collapse: collapse;
	width:50%">
	
<tr>

	<th colspan="2" style="color:#ffffff;
	border-width: 1px;
	font-size: 15px;
	padding: 20px 8px;
	border-style: solid;
	border-color: #D5D8DC;
	background-color:#1CAF9A;">Sankara Nethralaya IT Helpdesk</th>


</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Ticket #</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##TICKET_NUMBER##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Created On</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##CREATED_DATE##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Estimated Resolve On</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##ESTIMATED_RESOLVED_DATE##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">User NAME</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##USER_NAME##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Problem Description</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##PROBLEM_DESCRIPTION##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Call Assigned To</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##CALL_ASSIGNED_TO##</td>
</tr>

<tr><td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">Current Status</td>
	<td style="border-width: 1px;padding: 8px;border-style: solid;border-color: #D5D8DC;background-color: #F8F9F9;">##CURRENT_STATUS##</td>
</tr>

</table>

</body>'

?>