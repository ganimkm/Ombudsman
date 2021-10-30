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
                        <h3 class="panel-title"><strong>User</strong></h3>
                        <a  href="<?php echo site_url("user"); ?>/add" class="btn btn-success btn-rounded pull-right"><span class="fa fa-plus"></span>Add a new</a>                                 
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable">
                            
                            <thead>   
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Mobile #</th>
                                    <th>Designation</th>
                                    <th>Is Active</th>  
                                    <th>Is Admin</th>
                                    <th>Is Resolver</th>
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
                                        echo '<td>'.$row['email_address'].'</td>';
                                        echo '<td>'.$row['mobile_number'].'</td>';
                                        echo '<td>'.$row['designation'].'</td>';
                                        echo '<td>'.$row['is_active_description'].'</td>';
                                        echo '<td>'.$row['is_admin_description'].'</td>';
                                        echo '<td>'.$row['is_ticket_resolver_description'].'</td>';
                                        echo '<td>                           
                                        <a href="'.site_url("user").'/update/'.$row['user_id'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-pencil"></span></a>  
                                        <a href="'.site_url("user").'/delete/'.$row['user_id'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span></a>
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