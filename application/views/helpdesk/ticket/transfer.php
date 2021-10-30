   <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
    </ul>
    <!-- END BREADCRUMB -->
     
    <?php
    //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE){
                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> new ' . ucfirst('Incident') . ' created with success.';
                echo '</div>';       
            }else{
                echo '<div class="alert alert-danger" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                echo '</div>';          
            }
        }
    ?>
    
    <?php

      $attributes = array('id' => 'myform','class' => 'form-horizontal');
      echo form_open('helpdesk/ticket/transfer/'.$this->uri->segment(4).'', $attributes);

    ?>  

        <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Transfer</strong> Incident</h3>
<!--                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>-->
                        </div>

                        <div class="panel-body">                                                                        

                            <div class="row">
                                
            
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">User</label>  
                                         <div class="col-md-2 col-xs-12">
                                            <input type="text" class="form-control" readonly name="user_id" id="user_id" placeholder="User ID" value="<?php echo $incident[0]['user_id']; ?>">                   
                                            <span class="help-block">Required</span>
                                        </div>
                                         <div class="col-md-4 col-xs-12">
                                            <input type="text" class="form-control" readonly name="user_name" id="user_name" placeholder="User Name" value="<?php echo $incident[0]['user_name']; ?>">                     
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Transfer on</label>  
                                         <div class="col-md-3 col-xs-12">
                                            <!--<input type="text" class="form-control datepicker" name="transfered_on_date" id="transfered_on_date" placeholder="Date" value="<?php set_value('transfered_on_date')?>"/>--> 
                                             <input type="text" class="form-control" name="transfered_on_date" id="transfered_on_date" readonly="" placeholder="Date" value="<?php set_value('transfered_on_date')?>"/> 
                                            <span class="help-block">Required</span>
                                        </div>
                                         <div class="col-md-2 col-xs-12">
                                            <input type="text" class="form-control" name="transfered_on_time"  id="transfered_on_time" readonly="" placeholder="Time" value="<?php set_value('transfered_on_time')?>"/>   
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Transfer To</label>
                                        <div class="col-md-4 col-xs-12">                                                                                            
                                            <select id="transfered_to" name="transfered_to" class="form-control select">
                                                <option value="">Select</option>
                                                <?php foreach($transfered_to as $row) { echo '<option value="' . $row['user_id'] . '">' . $row['user_name'] . '</option>'; } ?>
                                            </select>
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Transfer Description</label>
                                        <div class="col-md-9 col-xs-12">  
                                            <textarea class="form-control" id="transfer_description" required  name="transfer_description" placeholder="Description" rows="3" value="<?php echo set_value('transfer_description'); ?>"></textarea>
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
<!--                                <div class="col-md-6">
                                    
                                    <table id="masterlist" class="table table-bordered small " >
                                        <thead>
                                            <tr>
                                                <th colspan="4"> Call Detail</th>
                                            </tr>    
                                        </thead>
                                        
                                        <tbody>

                                            <?php

                                                foreach($incident as $row)
                                                {
                                                    echo '<tr>';
                                                    echo '<th>Incident #</th>';
                                                    echo '<th>'.$row['Incident_Number'].'</th>';
                                                    echo '<th>Respond On Date</th>';
                                                    echo '<td>'.$row['Respond_On_Date'].'</td>';
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Logged On Date</th>';
                                                    echo '<td>'.$row['Logged_On_Date'].'</td>';
                                                    echo '<th>Respond On Time</th>';
                                                    echo '<td>'.$row['Respond_On_Time'].'</td>'; 
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Logged On Time</th>';
                                                    echo '<td>'.$row['Logged_On_Time'].'</td>';
                                                    echo '<th>Hold On Date</th>';
                                                    echo '<td>'.$row['Hold_On_Date'].'</td>'; 
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Problem</th>';                                                    
                                                    echo '<th>'.$row['Logged_Description'].'</th>'; 
                                                    echo '<th>Hold On Time</th>';
                                                    echo '<td>'.$row['Hold_On_Time'].'</td>'; 
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Logged By</th>';                                                    
                                                    echo '<th>'.$row['Logged_By_User'].'</th>'; 
                                                    echo '<th>Hold By User</th>';
                                                    echo '<td>'.$row['Hold_By_User'].'</td>'; 
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Location</th>';
                                                    echo '<th>'.$row['Location_Description'].'</th>';
                                                    echo '<th>Hold Description</th>';
                                                    echo '<td>'.$row['Hold_Description'].'</td>'; 
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Department</th>';
                                                    echo '<th>'.$row['Department_Description'].'</th>';
                                                    echo '<th>Hold Reason</th>';
                                                    echo '<td>'.$row['Hold_Reason_Description'].'</td>'; 
                                                     echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Request Type</th>';
                                                    echo '<td>'.$row['Request_Type_Description'].'</td>';
                                                    echo '<th>Rack Number</th>';
                                                    echo '<td>'.$row['Rack_Number'].'</td>';
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Category</th>';
                                                    echo '<td>'.$row['Category_Description'].'</td>';
                                                    echo '<th>Room Number</th>';
                                                    echo '<td>'.$row['Room_Number'].'</td>';
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Sub Category</th>';
                                                    echo '<td>'.$row['Sub_Category_Description'].'</td>';
                                                     echo '<th>Extension</th>';
                                                    echo '<td>'.$row['Extension_Number'].'</td>';
                                                    echo '</tr>';
                                                    
                                                    echo '<tr>';
                                                    echo '<th>Impact</th>';
                                                    echo '<th>'.$row['Impact_Description'].'</th>';
                                                    echo '<th>Reference Number</th>';
                                                    echo '<td>'.$row['Reference_Number'].'</td>';    
                                                    echo '</tr>';

                                                    echo '<tr>';
                                                    echo '<th>Call Mode</th>';
                                                    echo '<td>'.$row['Call_Mode_Description'].'</td>';
                                                    echo '<th>Business Criteria</th>';
                                                    echo '<td>'.$row['Business_Criteria_Description'].'</td>';
                                                    echo '</tr>';

                                                }
                                            ?> 

                                        </tbody>

                                    </table>
                                </div>-->
                                
                            </div>
                            
                        <div class="panel-footer">
                            <button class="btn btn-default" type="reset">Clear</button>                                    
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                        
                    </div>
            </div>
            
        </div>     
        
        </div>
        
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Updates</h3>         
                        <ul class="panel-controls">
                            <li><a href="#" class="control-primary"><span class="fa fa-refresh"></span></a></li>
                        </ul>
                    </div>

                    <div class="panel-body scroll list-group list-group-contacts"> 

                        <?php

                            foreach($incident_status as $row)
                            {
                                echo '<a href="#" class="list-group-item">';                                 
                                echo '<div class="list-group-status status-away"></div>';
                                echo '<span class="contacts-title">'.$row['Status_Description'].'</span>';
                                echo '<p>' . $row['Status_On_Time'] . ' on ' . $row['Status_On_Date'] . ' by '  . $row['Status_By_User'] . '</p>'; 
                                echo '</a>';
                            }

                       ?>    

                    </div>

                </div>

            </div>

        </div>
        
    </div>     
    <!-- PAGE CONTENT WRAPPER -->
    
    <?php echo form_close(); ?>

    <script type="text/javascript">

        var myform = $("#myform").validate({
            ignore: [],
            
            rules: {                                            
                    user_id: {
                            required: true,
                    },
                    user_name: {
                            required: true,
                    },
                    transfered_on_date: {
                            required: true,
                    },
                    transfered_on_time: {
                            required: true,
                    },                  
                    transfered_to: {
                            required: true,
                    },
                    transfer_description: {
                            required: true,
                    }
                }                                        
            });                                    

    </script>
        
    <!-- END SCRIPTS -->         

  <?php echo form_close(); ?>
      
<script type="text/javascript">

    $(document).ready(function()
    {  
        $("#transfered_on_date").attr("value", "<?php echo date("Y-m-d") ?>");
        $("#transfered_on_time").attr("value", "<?php echo date("H:i:s") ?>");
    });
   
</script>