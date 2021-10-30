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
                        <h3 class="panel-title"><strong>Department</strong></h3>
                        <a  href="<?php echo site_url("helpdesk").'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>/add" class="btn btn-success btn-rounded pull-right"><span class="fa fa-plus"></span>Add a new</a>                                
                    </div>
                    
                    <div class="panel-body">
                        <table class="table datatable">
                            <thead>   
                                <tr>
                                    <th>Department ID</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($department as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['department_id'].'</td>';
                                        echo '<td>'.$row['department_name'].'</td>';
                                        echo '<td>

                                        <a href="'.site_url("helpdesk/general").'/department/update/'.$row['department_id'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-pencil"></span></a>  
                                        <a href="'.site_url("helpdesk/general").'/department/delete/'.$row['department_id'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span></a>
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