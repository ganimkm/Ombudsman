   <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
    </ul>
    <!-- END BREADCRUMB -->

    <div class="page-content-wrap">                
                
        <div class="row">
            
            <div class="col-md-12">

                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Incident</strong> Status</h3>
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable_scrollbar">
                            
                            <thead>  
                                
                                <tr>
                                    
                                    <th>Incident #</th>

                                    <th>Logged On Date</th>
                                    <th>Problem</th>
                                    <th>Logged by</th>

                                    <th>User ID</th>
                                    <th>User Name</th>

                                    <th>Location</th>
                                    <th>Department</th>

                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Impact</th>
                                    
                                    <th>Actions</th>
                                    
                                </tr>
                                
                            </thead>

                            <tbody>
                                <?php
                                    foreach($incident as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td><a href="#" id="'.$row['incident_number'].'" class="show">'.$row['incident_number'].'</a></td>';

                                        echo '<td>'.$row['logged_on'].'</td>';
                                        echo '<td>'.$row['logged_description'].'</td>';
                                        echo '<td>'.$row['logged_by_user'].'</td>';

                                        echo '<td>'.$row['user_id'].'</td>';
                                        echo '<td>'.$row['user_name'].'</td>';

                                        echo '<td>'.$row['location_name'].'</td>';
                                        echo '<td>'.$row['department_name'].'</td>';

                                        echo '<td>'.$row['category_description'].'</td>';
                                        echo '<td>'.$row['sub_category_description'].'</td>';
                                        echo '<td>'.$row['impact_description'].'</td>';
                                        
                                        if (($row['hold_on'])=="" or ($row['hold_on'])==null){
                                            echo '<td>         
                                                <a href="'.site_url("helpdesk").'/ticket/hold/'.$row['incident_number'].'" class="btn btn-warning btn-rounded btn-xs"><span class="fa fa-pause"></span>Hold</a>
                                                <a href="'.site_url("helpdesk").'/ticket/transfer/'.$row['incident_number'].'" class="btn btn-info btn-rounded btn-xs"><span class="fa fa-exchange"></span>Transfer</a>    
                                                <a href="'.site_url("helpdesk").'/ticket/updatestatus/'.$row['incident_number'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-comment"></span>Status</a>
                                              </td>';
                                        }
                                        else{
                                            echo '<td>         
                                                <a href="'.site_url("helpdesk").'/ticket/hold/'.$row['incident_number'].'" class="btn btn-warning btn-rounded btn-xs disabled"><span class="fa fa-pause"></span>Hold</a>
                                                <a href="'.site_url("helpdesk").'/ticket/transfer/'.$row['incident_number'].'" class="btn btn-info btn-rounded btn-xs"><span class="fa fa-exchange"></span>Transfer</a>    
                                                <a href="'.site_url("helpdesk").'/ticket/updatestatus/'.$row['incident_number'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-comment"></span>Status</a>
                                              </td>'; 
                                        }

                                        echo '</tr>';
                                    }
                                ?>      
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                    <!-- Modal -->
                    <div id="modal-content" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Incident</h4>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <p></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            
        </div>  
        
    </div>
    
<script language="JavaScript">
        
    $(function(){

        $('.show').click(function(){

           var incident_number = $(this).attr('id');

           var post_url = "<?php echo site_url() ?>/IncidentController/Get_Incident" 
           var dataString = 'incident_number=' + incident_number

           $.ajax({

                type: "POST",
                url: post_url,
                data: dataString,
                cache: false,

                success : function(incident)
                   {
                        var infoModal = $('#modal-content');

                        $.each(incident,function(i,incident) 
                        {   
                            var htmlData = '<table id="masterlist" class="table table-bordered small " >';

                            htmlData += '<thead>';
                            htmlData += '<tr>';
                            htmlData += '<th colspan="6"> Call Detail</th>';
                            htmlData += '</tr>' ;
                            htmlData += '</thead>';


                            htmlData += '<tbody>';

                            htmlData += '<tr>';
                            htmlData += '<th>Incident #</th>';
                            htmlData += '<th>' + incident.Incident_Number + '</th>';
                            htmlData += '<th>User ID</th>';
                            htmlData += '<th>' + incident.User_ID + '</td>';
                            htmlData += '<th>User Name</th>';
                            htmlData += '<th>' + incident.User_Name + '</td>';
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Logged On Date</th>';
                            htmlData += '<td>' + incident.Logged_On_Date + '</td>';
                            htmlData += '<th>Logged On Time</th>';
                            htmlData += '<td>' + incident.Logged_On_Time + '</td>'; 
                            htmlData += '<th>Logged By</th>';                                                    
                            htmlData += '<td>' + incident.Logged_By_User + '</td>'; 
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Location</th>';
                            htmlData += '<th>' + incident.Location_Description + '</th>';
                            htmlData += '<th>Deaprtment</th>';
                            htmlData += '<th>' + incident.Department_Description + '</th>'; 
                            htmlData += '<th>Impact</th>';
                            htmlData += '<th>' + incident.Impact_Description + '</th>'; 
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Problem</th>';                                                    
                            htmlData += '<th colspan=5>' + incident.Logged_Description + '</th>'; 
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Category</th>';
                            htmlData += '<td>' + incident.Category_Description + '</td>';
                            htmlData += '<th>Sub Category</th>';
                            htmlData += '<td>' + incident.Sub_Category_Description + '</td>';
                            htmlData += '<th>Request Type</th>';
                            htmlData += '<td>' + incident.Request_Type_Description + '</td>';
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Rack Number</th>';
                            htmlData += '<td>' + incident.Rack_Number + '</td>';
                            htmlData += '<th>Room Number</th>';
                            htmlData += '<td>' + incident.Room_Number + '</td>';
                            htmlData += '<th>Extension</th>';
                            htmlData += '<td>' + incident.Extension_Number + '</td>';
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Call Mode</th>';
                            htmlData += '<td>' + incident.Call_Mode_Description + '</td>';
                            htmlData += '<th>Business Criteria</th>';
                            htmlData += '<td>' + incident.Business_Criteria_Description + '</td>';
                            htmlData += '<th>Reference Number</th>';
                            htmlData += '<td>' + incident.Reference_Number + '</td>';  
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Respond On Date</th>';
                            htmlData += '<td colspan="2">' + incident.Respond_On_Date + '</td>';
                            htmlData += '<th>Respond On Time</th>';
                            htmlData += '<td colspan="2">' + incident.Respond_On_Time + '</td>'; 
                            htmlData += '</tr>';                                              

                            htmlData += '<tr>';
                            htmlData += '<th>Hold On Date</th>';
                            htmlData += '<td>' + incident.Hold_On_Date + '</td>';
                            htmlData += '<th>Hold On Time</th>';
                            htmlData += '<td>' + incident.Hold_On_Time + '</td>'; 
                            htmlData += '<th>Hold By</th>';                                                    
                            htmlData += '<td>' + incident.Hold_By_User + '</td>'; 
                            htmlData += '</tr>';

                            htmlData += '<tr>';
                            htmlData += '<th>Hold Description</th>';
                            htmlData += '<th colspan="3">' + incident.Hold_Description + '</th>';
                            htmlData += '<th>Hold Reason</th>';
                            htmlData += '<td>' + incident.Hold_Reason_Description + '</td>'; 
                            htmlData += '</tr>';

                            htmlData += '</tbody>';

                            htmlData += '</table>';
                            
                            var post_url_status = "<?php echo site_url() ?>/IncidentController/Get_Incident_Status" 
                            var dataString_status = 'incident_number=' + incident_number

                           $.ajax({

                                type: "POST",
                                url: post_url_status,
                                data: dataString_status,
                                cache: false,

                                success : function(incidentstatus)
                                   {
                                       
                                        htmlData += '<table id="statuslist" class="table table-bordered small " >';
                                        
                                        htmlData += '<thead>';
                                        htmlData += '<tr>';
                                        htmlData += '<th colspan="6"> Additional Detail</th>';
                                        htmlData += '</tr>' ;
                                        htmlData += '</thead>';

                                        htmlData += '<tbody>';

                                        htmlData += '<tr>';
                                        htmlData += '<th colspan="1">Date</th>';
                                        htmlData += '<th colspan="1">Time</th>';
                                        htmlData += '<th colspan="4">Description</th>';
                                        htmlData += '</tr>';
                                            
                                        $.each(incidentstatus,function(i,incidentstatus) 
                                        {   
                                            
                                            htmlData += '<tr>';
                                            htmlData += '<td colspan="1">' + incidentstatus.Status_On_Date + '</td>';
                                            htmlData += '<td colspan="1">' + incidentstatus.Status_On_Time + '</td>';
                                            htmlData += '<td colspan="4">' + incidentstatus.Status_Description + '</td>';
                                            htmlData += '</tr>';

                                        });
                                        
                                        
                                        htmlData += '</tbody>';
                                        htmlData += '</table>';
                            
                                        infoModal.find('#modal-body').html(htmlData);
                                        infoModal.modal('show');
                                            
                                    }
                              });
              
                            infoModal.find('#modal-body').html(htmlData);
                            infoModal.modal('show');
                        });
                    }
              });
        });
    }); 

</script>