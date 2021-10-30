    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active">Daily MIS</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <?php

      $attributes = array('class' => 'form-inline', 'id' => 'masterform');
      echo form_open('helpdesk/analytics/dailymis', $attributes);

    ?>
               
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        
        <div class="row">
            
            <div class="col-md-12">
                
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Daily Call Report</strong></h3>
                    </div>
                    
                    <div class="panel-body">
                        
                        <div class="well">

                            <div class="form-group">
                                <label for="inputError" class="control-label">To Date :</label>
                                <input type="text" class="form-control datepicker" name="to_date" id="to_date" placeholder="To Date" value="<?php echo $todate; ?>"/>       
                            </div>

                            <button class="btn btn-primary pull-right">View Report <span class="fa fa-list fa-right"></span></button>

                        </div>
                        
                        <div class="panel panel-default tabs">  
                        
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#callsummary" role="tab" data-toggle="tab">Summary</a></li>
                            <li><a href="#calldetails" role="tab" data-toggle="tab">Details</a></li>     
                            <li><a href="#callchart" role="tab" data-toggle="tab">Chart</a></li>
                        </ul>
                        
                        <div class="panel-body tab-content">
                            
                            <div class="tab-pane active" id="callsummary">

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        
                                        <?php

                                        /********************************************************************************************************************/
                                        
                                            $rows = count($locationsummary);
                                            $cols = count($locationsummary[0]);

                                            echo '<table id="locationsummary" class="table table-bordered" cellspacing="0" width="100%">';
                                             
                                            echo '<tr>';
                                            echo '<th colspan='. $cols . ' class="text-center">Location Wise Call Summary</th>';
                                            echo '</tr>';

                                            echo '<tbody id="locationsummarydata">';
                                            
                                            echo '<tr>';
                                            echo '<th rowspan=2 class="text-center">S.No</th>';
                                            echo '<th rowspan=2 class="text-center">Location</th>';

                                            echo '<th colspan=3 class="text-center">Call Details as on ' . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . '</th>';
                                            echo '<th colspan=3 class="text-center">Call Details - ' . @date('Y-m-d', @strtotime($todate)) . '</th>'; 
                                            echo '</tr>';

                                            echo '<tr>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '</tr>';

                                            for ($row = 0; $row < $rows; $row++) 
                                            {
                                                echo '<tr>';

                                                $cols = count($locationsummary[$row]);

                                                    if (intval($row+1) != $rows){
                                                        echo '<td>' .  intval($row+1) . '</td>';
                                                        echo '<td>' . $locationsummary[$row]['Location_Description'] . '</td>';
                                                    }else{
                                                       echo '<td colspan=2 class="text-center"><strong>Total</strong></td>'; 
                                                    }

                                                    echo '<td class="text-center">' . $locationsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $locationsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $locationsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Closed'] . '</td>';

                                                    echo '<td class="text-center">' . $locationsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $locationsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $locationsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Closed'] . '</td>';

                                                echo '</tr>';
                                            }

                                            echo '</tbody>';   
                                            echo '</table>';

                                            /********************************************************************************************************************/

                                            $rows = count($categorysummary);
                                            $cols = count($categorysummary[0]);

                                            echo '<table id="categorysummary" class="table table-bordered" cellspacing="0" width="100%">';

                                            echo '<tr>';
                                            echo '<th colspan='. $cols . ' class="text-center">Category Wise Call Summary</th>';
                                            echo '</tr>';

                                            echo '<tr>';
                                            echo '<th rowspan=2 class="text-center">S.No</th>';
                                            echo '<th rowspan=2 class="text-center">Category</th>';

                                            echo '<th colspan=3 class="text-center">Call Details as on ' . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . '</th>';
                                            echo '<th colspan=3 class="text-center">Call Details - ' . @date('Y-m-d', @strtotime($todate)) . '</th>'; 
                                            echo '</tr>';

                                            echo '<tr>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '</tr>';


                                            for ($row = 0; $row < $rows; $row++) 
                                            {
                                                echo '<tr>';

                                                $cols = count($categorysummary[$row]);

                                                    if (intval($row+1) != $rows){
                                                        echo '<td>' .  intval($row+1) . '</td>';
                                                        echo '<td>' . $categorysummary[$row]['Category_Description'] . '</td>';
                                                    }else{
                                                       echo '<td colspan=2 class="text-center"><strong>Total</strong></td>'; 
                                                    }

                                                    echo '<td class="text-center">' . $categorysummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $categorysummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $categorysummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Closed'] . '</td>';

                                                    echo '<td class="text-center">' . $categorysummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $categorysummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $categorysummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Closed'] . '</td>';

                                                echo '</tr>';
                                            }

                                            echo '</table>';

                                         /********************************************************************************************************************/

                                            $rows = count($impactsummary);
                                            $cols = count($impactsummary[0]);

                                            echo '<table id="impactsummary" class="table table-bordered" cellspacing="0" width="100%">';

                                            echo '<tr>';
                                            echo '<th colspan='. $cols . ' class="text-center">Impact Wise Call Summary</th>';
                                            echo '</tr>';

                                            echo '<tr>';
                                            echo '<th rowspan=2 class="text-center">S.No</th>';
                                            echo '<th rowspan=2 class="text-center">Impact</th>';

                                            echo '<th colspan=3 class="text-center">Call Details as on ' . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . '</th>';
                                            echo '<th colspan=3 class="text-center">Call Details - ' . @date('Y-m-d', @strtotime($todate)) . '</th>'; 
                                            echo '</tr>';

                                            echo '<tr>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '</tr>';


                                            for ($row = 0; $row < $rows; $row++) 
                                            {
                                                echo '<tr>';

                                                $cols = count($impactsummary[$row]);

                                                    if (intval($row+1) != $rows){
                                                        echo '<td>' .  intval($row+1) . '</td>';
                                                        echo '<td>' . $impactsummary[$row]['Impact_Description'] . '</td>';
                                                    }else{
                                                       echo '<td colspan=2 class="text-center"><strong>Total</strong></td>'; 
                                                    }

                                                    echo '<td class="text-center">' . $impactsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $impactsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $impactsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Closed'] . '</td>';

                                                    echo '<td class="text-center">' . $impactsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $impactsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $impactsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Closed'] . '</td>';

                                                echo '</tr>';
                                            }

                                            echo '</table>';

                                            
                                        /********************************************************************************************************************/

                                            $rows = count($departmentsummary);
                                            $cols = count($departmentsummary[0]);

                                            echo '<table id="departmentsummary" class="table table-bordered" cellspacing="0" width="100%">';

                                            echo '<tr>';
                                            echo '<th colspan='. $cols . ' class="text-center">Department Wise Call Summary</th>';
                                            echo '</tr>';

                                            echo '<tr>';
                                            echo '<th rowspan=2 class="text-center">S.No</th>';
                                            echo '<th rowspan=2 class="text-center">Department</th>';

                                            echo '<th colspan=3 class="text-center">Call Details as on ' . @date('Y-m-d', @strtotime("-1 day", strtotime($todate))) . '</th>';
                                            echo '<th colspan=3 class="text-center">Call Details - ' . @date('Y-m-d', @strtotime($todate)) . '</th>'; 
                                            echo '</tr>';

                                            echo '<tr>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '<td class="text-center"><strong>Calls Received</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Pending</strong></td>';
                                            echo '<td class="text-center"><strong>Calls Closed</strong></td>';

                                            echo '</tr>';


                                            for ($row = 0; $row < $rows; $row++) 
                                            {
                                                echo '<tr>';

                                                $cols = count($departmentsummary[$row]);

                                                    if (intval($row+1) != $rows){
                                                        echo '<td>' .  intval($row+1) . '</td>';
                                                        echo '<td>' . $departmentsummary[$row]['Department_Description'] . '</td>';
                                                    }else{
                                                       echo '<td colspan=2 class="text-center"><strong>Total</strong></td>'; 
                                                    }

                                                    echo '<td class="text-center">' . $departmentsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $departmentsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $departmentsummary[$row][str_replace("-","_",@date("Y-m-d", strtotime("-1 day", strtotime($todate)))) . '_Calls_Closed'] . '</td>';

                                                    echo '<td class="text-center">' . $departmentsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Received'] . '</td>';
                                                    echo '<td class="text-center">' . $departmentsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Pending'] . '</td>';
                                                    echo '<td class="text-center">' . $departmentsummary[$row][str_replace("-","_",@date('Y-m-d', @strtotime($todate))) . '_Calls_Closed'] . '</td>';

                                                echo '</tr>';
                                            }

                                            echo '</table>';

                                        /********************************************************************************************************************/

                                        ?>
                                        
                                    </div>
                                    
                                    <div class="col-md-6">
                                        
                                        <div class="page-header">
                                            <h4>Pending Calls</h4>
                                        </div>
                                        
                                        <table class="table datatable_nopaging" cellspacing="0" width="100%">

                                            <thead>  

                                                <tr>

                                                    <th>Incident #</th>

                                                    <th>Logged On Date</th>
                                                    <th>Time</th>
                                                    <th>Problem</th>

                                                    <th>User Name</th>

                                                    <th>Location</th>
                                                    <th>Department</th>

                                                    <th>Category</th>
                                                    <th>Impact</th>

                                                    <th>Assigned To</th>  

                                                    <th>Status Type</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                    foreach($pendingincident as $row)
                                                    {
                                                        echo '<tr>';
                                                        echo '<td>'.$row['Incident_Number'].'</td>';

                                                        echo '<td>'.$row['Logged_On_Date'].'</td>';
                                                        echo '<td>'.$row['Logged_On_Time'].'</td>';
                                                        echo '<td>'.$row['Actual_Description'].'</td>'; 

                                                        echo '<td>'.$row['User_Name'].'</td>';

                                                        echo '<td>'.$row['Location_Description'].'</td>';
                                                        echo '<td>'.$row['Department_Description'].'</td>';

                                                        echo '<td>'.$row['Category_Description'].'</td>';
                                                        echo '<td>'.$row['Impact_Description'].'</td>';

                                                        echo '<td>'.$row['Assigned_To_User'].'</td>'; 

                                                        echo '<td>'.$row['On_Status'].'</td>';

                                                        echo '</tr>';
                                                    }
                                                ?>      
                                            </tbody>
                                              
                                        </table>
                                        
                                        <div class="page-header">
                                            <h4>Hold Calls</h4>
                                        </div>
                                        
                                        <table class="table datatable_nopaging" cellspacing="0" width="100%">

                                            <thead>  

                                                <tr>

                                                    <th>Incident #</th>

                                                    <th>Logged On Date</th>
                                                    <th>Time</th>
                                                    <th>Problem</th>

                                                    <th>User Name</th>

                                                    <th>Location</th>
                                                    <th>Department</th>

                                                    <th>Category</th>
                                                    <th>Impact</th>

                                                    <th>Assigned To</th>  

                                                    <th>Status Type</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                    foreach($holdincident as $row)
                                                    {
                                                        echo '<tr>';
                                                        echo '<td>'.$row['Incident_Number'].'</td>';

                                                        echo '<td>'.$row['Logged_On_Date'].'</td>';
                                                        echo '<td>'.$row['Logged_On_Time'].'</td>';
                                                        echo '<td>'.$row['Actual_Description'].'</td>'; 

                                                        echo '<td>'.$row['User_Name'].'</td>';

                                                        echo '<td>'.$row['Location_Description'].'</td>';
                                                        echo '<td>'.$row['Department_Description'].'</td>';

                                                        echo '<td>'.$row['Category_Description'].'</td>';
                                                        echo '<td>'.$row['Impact_Description'].'</td>';

                                                        echo '<td>'.$row['Assigned_To_User'].'</td>'; 

                                                        echo '<td>'.$row['On_Status'].'</td>';

                                                        echo '</tr>';
                                                    }
                                                ?>      
                                            </tbody>
                                              
                                        </table>
                                                 
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                            <div class="tab-pane" id="calldetails">

                                 <table class="table table-bordered" cellspacing="0" width="100%">

                                    <thead>  

                                        <tr>

                                            <th>Incident #</th>

                                            <th>Logged On Date</th>
                                            <th>Time</th>
                                            <th>Problem</th>
                                            
                                            <th>User Name</th>

                                            <th>Location</th>
                                            <th>Department</th>
                                            
                                            <th>Category</th>
                                            <th>Impact</th>
                                            
                                            <th>Assigned To</th>  
                                                                                        
                                            <th>Resolved On Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                            <th>Resolved by</th>
                                            
                                            <th>Status Type</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php
                                            foreach($incident as $row)
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$row['Incident_Number'].'</td>';

                                                echo '<td>'.$row['Logged_On_Date'].'</td>';
                                                echo '<td>'.$row['Logged_On_Time'].'</td>';
                                                echo '<td>'.$row['Actual_Description'].'</td>'; 

                                                echo '<td>'.$row['User_Name'].'</td>';

                                                echo '<td>'.$row['Location_Description'].'</td>';
                                                echo '<td>'.$row['Department_Description'].'</td>';

                                                echo '<td>'.$row['Category_Description'].'</td>';
                                                echo '<td>'.$row['Impact_Description'].'</td>';
                                               
                                                echo '<td>'.$row['Assigned_To_User'].'</td>'; 
                                                                                                
                                                echo '<td>'.$row['Resolved_On_Date'].'</td>';
                                                echo '<td>'.$row['Resolved_On_Time'].'</td>';
                                                echo '<td>'.$row['Resolved_Description'].'</td>';
                                                echo '<td>'.$row['Resolved_By_User'].'</td>';
                                                
                                                echo '<td>'.$row['On_Status'].'</td>';

                                                echo '</tr>';
                                            }
                                        ?>      
                                    </tbody>

                                </table>
                                
                            </div>
                            
                            <div class="tab-pane" id="callchart">
                                

                            </div>   

                        </div>
                        
<!--                        <div class="panel-footer">                                                                        
                            <button class="btn btn-primary pull-right">Save Changes <span class="fa fa-floppy-o fa-right"></span></button>
                        </div>-->
                        
                    </div>  
                        
                    </div>    

            </div>
            
        </div>                    

    </div>
    <!-- END PAGE CONTENT WRAPPER --> 
