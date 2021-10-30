   <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active">Network Down</li>
    </ul>
    <!-- END BREADCRUMB -->

    <div class="page-content-wrap">                
                
        <div class="row">
            
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Log</strong> Incident</h3>
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable">

                            <thead>   
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Location</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($user as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['user_id'].'</td>';
                                        echo '<td>'.$row['user_name'].'</td>';
                                        echo '<td>'.$row['location_name'].'</td>'; 
                                        echo '<td>'.$row['department_name'].'</td>';                        
                                        echo '<td>

                                        <a href="'.site_url("helpdesk").'/ticket/networkdownadd/'.$incident_ref_number.'/'.$row['user_id'].'" class="btn btn-danger btn-rounded btn-xs"><span class="fa fa-ticket"></span>Log Incident</a>                          
                                        </td>';
                                        echo '</tr>';
                                    }
                                ?>      
                            </tbody>

                        </table>
                       
                        <div class="page-header">    
                            <h4>Network Down Incident</h4>    
                        </div>
                        
                        <table class="table datatable">

                            <thead>   
                                <tr>   
                                    <th>Incident Ref #</th>
                                    <th>Incident Date</th>
                                    <th>Description</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Incident Type</th>                                    
                                    
                                </tr>
                            </thead>

                            <tbody>
                                
                                <?php
                                    foreach($networkdown_incidents as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['incident_ref_number'].'</td>';
                                        echo '<td>'.$row['incident_date'].'</td>';
                                        echo '<td>'.$row['incident_description'].'</td>';
                                        echo '<td>'.$row['start_time'].'</td>';
                                        echo '<td>'.$row['end_time'].'</td>';
                                        echo '<td>'.$row['incident_type_description'].'</td>';
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
    
   