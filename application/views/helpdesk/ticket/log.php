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

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Log</strong> Incident</h3>
                    </div>
                    
                    <div class="panel-body ">
                        
						<div style="overflow-x:auto;">
						
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

                                        <a href="'.site_url("helpdesk").'/ticket/add/'.$row['user_id'].'" class="btn btn-danger btn-rounded btn-xs"><span class="fa fa-ticket"></span>Log Incident</a>                          
                                        </td>';
                                        echo '</tr>';
                                    }
                                ?>      
                            </tbody>

                        </table>
                       </div>
                        <div class="page-header">    
                            <h4>Today Incidents</h4>    
                        </div>
						
						<div style="overflow-x:auto;">
                        
                        <table class="table table-responsive datatable">

                            <thead>   
                                <tr>
                                    <th width="8%">Incident #</th>
                                    <th width="10%">Date</th>
                                    <th>Description</th>
                                    <th width="10%">User Name</th>
                                    <th>Location</th>
                                    <th>Department</th>
                                    <th width="10%">Impact</th> 
                                    <th width="8%">Room Number</th>
                                    <th width="8%">Extension</th>                  
                                    <th width="10%">Assigned To</th> 
                                    
                                    <?php
                                        if ($is_admin == "1")
                                        {
                                            echo '<th>Actions</th>'; 
                                        }
                                    ?>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                
                                <?php
                                    foreach($incident as $row)
                                    {
                                       echo '<tr>';
                                        echo '<td>'.$row['incident_number'].'</td>';
                                        echo '<td>'.$row['logged_on'].'</td>';
                                        echo '<td>'.$row['logged_description'].'</td>';
                                        echo '<td>'.$row['user_name'].'</td>';                       
                                        echo '<td>'.$row['location_name'].'</td>';
                                        echo '<td>'.$row['department_name'].'</td>';
                                        echo '<td>'.$row['impact_description'].'</td>';
                                        echo '<td>'.$row['room_number'].'</td>';
                                        echo '<td>'.$row['extension_number'].'</td>';
                                        echo '<td>'.$row['assigned_to_user'].'</td>';  
                                        
                                        if ($is_admin == "1")
                                        {
                                            if (($row['respond_on'])=="" or ($row['respond_on'])==null){
                                                echo '<td>         
                                                    <a href="'.site_url("helpdesk").'/ticket/transfer/'.$row['incident_number'].'" class="btn btn-info btn-rounded btn-xs"><span class="fa fa-exchange"></span>Transfer</a>    
                                                  </td>';
                                            }
                                            else{
                                                echo '<td>                                                        
                                                    <a href="'.site_url("helpdesk").'/ticket/transfer/'.$row['incident_number'].'" class="btn btn-info btn-rounded btn-xs disabled"><span class="fa fa-exchange"></span>Transfer</a>    
                                                  </td>'; 
                                            }
                                            echo '</tr>';
                                        }
                                    }
                                ?>      
                            </tbody>

                       </table>
                        
						</div>
						
                    </div>
                    
                </div>

            </div>
            
        </div>  

    </div>
    
   