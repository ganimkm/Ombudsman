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
                        <h3 class="panel-title"><strong>TODO</strong> Incidents</h3>
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable_scrollbar">
                            
                            <thead>  
                                
                                <tr>
                                    
                                    <th>Incident Ref #</th>
                                    <th>Incident Date</th>
                                    <th>Description</th>
                                    <th>Incident Type</th>
                                    <th>Scheduler</th>
                                    <th>Actions</th>
                                    
                                </tr>
                                
                            </thead>

                            <tbody>
                                
                                <?php
                                
                                    foreach($todo_incidents as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td><a href="#" id="'.$row['incident_ref_number'].'" class="show">'.$row['incident_ref_number'].'</a></td>';

                                        echo '<td>'.$row['incident_date'].'</td>';
                                        echo '<td>'.$row['incident_description'].'</td>';
                                        echo '<td>'.$row['incident_type_description'].'</td>';
                                        echo '<td>'.$row['scheduler_name'].'</td>';
                                        
                                        if($row['default_user'] != ''){
                                            
                                            echo '<td>           
                                             <a href="'.site_url("helpdesk").'/ticket/todoadd/'.$row['incident_ref_number'].'/'.$row['default_user'].'" class="btn btn-success btn-rounded btn-xs"><span class="fa fa-ticket"></span>Convert</a>
                                             <a href="'.site_url("helpdesk").'/ticket/todoignore/'.$row['incident_ref_number'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span>Ignore</a>                                                 
                                             </td>';
                                            
                                        }else{
                                        
                                        echo '<td>           
                                             <a href="'.site_url("helpdesk").'/ticket/todolog/'.$row['incident_ref_number'].'" class="btn btn-success btn-rounded btn-xs"><span class="fa fa-ticket"></span>Convert</a>
                                             <a href="'.site_url("helpdesk").'/ticket/todoignore/'.$row['incident_ref_number'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span>Ignore</a>                                                 
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

<script>

    function confirmDialog() {
        return confirm("Are you sure you want to ignore this incident?")
    }

</script>