    <!-- START BREADCRUMB --> 
    
    <ul class="breadcrumb">
       <li><a href="#">Home</a></li>
       <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
       <li><a href="#"><?php echo ucfirst($this->uri->segment(2));?></a></li>
       <li class="active">Incident</li>
    </ul>
    <!-- END BREADCRUMB -->

    <div class="page-content-wrap">                
                
        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Incident</strong></h3>
                        <a  href="<?php echo site_url("helpdesk").'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>/log" class="btn btn-success pull-right"> Add a new</a>                                
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable_scrollbar">
                            
                            <thead>  
                                
                                <tr>
                                    
                                    <th>Incident #</th>

                                    <th>Logged On Date</th>
                                    <th>Time</th>
                                    <th>Problem</th>
                                    <th>Logged by</th>

                                    <th>Actual Description</th>

                                    <th>User ID</th>
                                    <th>User Name</th>

                                    <th>Respond On Date</th>
                                    <th>Time</th>

                                    <th>Location</th>
                                    <th>Department</th>

                                    <th>Resolved On Date</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                    <th>Resolution Code</th>
                                    <th>Resolved by</th>

                                    <th>Request Type</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Impact</th>
                                    <th>Call Mode</th>
                                    <th>Business Criteria</th>

                                    <th>Transfered on Date</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                    <th>Transfered by</th>

                                    <th>Hold on Date</th>
                                    <th>Time</th>
                                    <th>Hold Reason</th>
                                    <th>Description</th>
                                    <th>Hold by</th>

                                    <th>Rack Number</th>  
                                    <th>Room Number</th>
                                    <th>Extension</th> 
                                    <th>Reference Number</th>  

                                    <th>Assigned To</th>    

                                    <th>Actions</th>

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
                                        echo '<td>'.$row['Logged_Description'].'</td>';
                                        echo '<td>'.$row['Logged_By_User'].'</td>';

                                        echo '<td>'.$row['Actual_Description'].'</td>'; 

                                        echo '<td>'.$row['User_ID'].'</td>';
                                        echo '<td>'.$row['User_Name'].'</td>';

                                        echo '<td>'.$row['Respond_On_Date'].'</td>';
                                        echo '<td>'.$row['Respond_On_Time'].'</td>'; 

                                        echo '<td>'.$row['Location_Description'].'</td>';
                                        echo '<td>'.$row['Department_Description'].'</td>';

                                        echo '<td>'.$row['Resolved_On_Date'].'</td>';
                                        echo '<td>'.$row['Resolved_On_Time'].'</td>';
                                        echo '<td>'.$row['Resolved_Description'].'</td>';
                                        echo '<td>'.$row['Resolution_Description'].'</td>';
                                        echo '<td>'.$row['Resolved_By_User'].'</td>';

                                        echo '<td>'.$row['Request_Type_Description'].'</td>';
                                        echo '<td>'.$row['Category_Description'].'</td>';
                                        echo '<td>'.$row['Sub_Category_Description'].'</td>';
                                        echo '<td>'.$row['Impact_Description'].'</td>';
                                        echo '<td>'.$row['Call_Mode_Description'].'</td>';
                                        echo '<td>'.$row['Business_Criteria_Description'].'</td>';

                                        echo '<td>'.$row['Transfered_On_Date'].'</td>';
                                        echo '<td>'.$row['Transfered_On_Time'].'</td>';
                                        echo '<td>'.$row['Transfer_Description'].'</td>';
                                        echo '<td>'.$row['Transfered_By_User'].'</td>';

                                        echo '<td>'.$row['Hold_On_Date'].'</td>';
                                        echo '<td>'.$row['Hold_On_Time'].'</td>';
                                        echo '<td>'.$row['Hold_Description'].'</td>';
                                        echo '<td>'.$row['Hold_Reason_Description'].'</td>';
                                        echo '<td>'.$row['Hold_By_User'].'</td>';

                                        echo '<td>'.$row['Rack_Number'].'</td>';
                                        echo '<td>'.$row['Room_Number'].'</td>';
                                        echo '<td>'.$row['Extension_Number'].'</td>';
                                        echo '<td>'.$row['Reference_Number'].'</td>'; 

                                        echo '<td>'.$row['Assigned_To_User'].'</td>';    

                                        echo '<td>

                                        <a href="'.site_url("tickets").'/incident/update/'.$row['Incident_Number'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-pencil"></span></a>  
                                        <a href="'.site_url("tickets").'/incident/delete/'.$row['Incident_Number'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span></a>
                                        </td>';
                                        echo '</tr>';
                                    }
                                ?>      
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                </div>

            </div>
            
        </div>  
        
    </div>

<script>

    function confirmDialog() {
        return confirm("Are you sure you want to delete this record?")
    }
    
</script>

