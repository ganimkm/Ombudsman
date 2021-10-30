    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(1));?></li>
    </ul>
    <!-- END BREADCRUMB -->

    <div class="page-content-wrap">                
                
        <div class="row">
            
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Wifi Users</strong></h3>
                        <a  href="<?php echo site_url("wifiuser"); ?>/add" class="btn btn-success btn-rounded pull-right"><span class="fa fa-plus"></span>Add a new</a>                                 
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable">
                            
                            <thead>   
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Location</th>
                                    <th>Department</th>
                                    <th>MAC Address</th>
                                    <th>Wifi Name</th>
                                    <th>Remarks</th>  
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    foreach($user as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['employee_id'].'</td>';
                                        echo '<td>'.$row['employee_name'].'</td>';
                                        echo '<td>'.$row['location'].'</td>';
                                        echo '<td>'.$row['department'].'</td>';
                                        echo '<td>'.$row['mac_address'].'</td>';
                                        echo '<td>'.$row['wifi_name'].'</td>';
                                        echo '<td>'.$row['remarks'].'</td>';
                                        echo '<td>                           
                                        <a href="'.site_url("wifiuser").'/update/'.$row['wifi_user_id'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-pencil"></span></a>  
                                        <a href="'.site_url("wifiuser").'/delete/'.$row['wifi_user_id'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span></a>
                                        </td>';
                                        echo '</tr>';
                                    }
                                ?>      
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                </div>
                
                <!-- END SIMPLE DATATABLE -->
            </div>
            
        </div>  
        
    </div>

<script>

    function confirmDialog() {
        return confirm("Are you sure you want to delete this record?")
    }
</script>