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
      echo form_open('helpdesk/ticket/close/'.$this->uri->segment(4).'', $attributes);

    ?>  

        <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Resolve</strong> Incident</h3>
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
                                        <label class="col-md-3 control-label">Actual Problem</label>
                                        <div class="col-md-9 col-xs-12">      
                                            <textarea class="form-control" id="actual_description" required  name="actual_description" placeholder="Description" rows="3" value="<?php echo set_value('actual_description'); ?>"><?php echo $incident[0]['logged_description'];?></textarea>
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Resolved on</label>  
                                         <div class="col-md-3 col-xs-12">
                                            <!--<input type="text" class="form-control datepicker" name="resolved_on_date" id="resolved_on_date" placeholder="Date" value="<?php set_value('resolved_on_date')?>"/>-->   
                                            <input type="text" class="form-control" readonly name="resolved_on_date" id="resolved_on_date" placeholder="Date" value="<?php set_value('resolved_on_date')?>"/>                        
                                            <span class="help-block">Required</span>
                                        </div>
                                         <div class="col-md-2 col-xs-12">
                                            <input type="text" class="form-control" readonly name="resolved_on_time"  id="resolved_on_time" placeholder="Time" value="<?php set_value('resolved_on_time')?>"/>   
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Asset Change Description</label>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="radio-inline">
                                                <input type="radio" id="yescheck" class="iradio"  name="asset_change_description" value="1" <?=set_radio('asset_change_description', 1)?> />Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio"  id="nocheck" class="iradio"  name="asset_change_description" value="0" <?=set_radio('asset_change_description', 0)?> />No
                                            </label>
                                            <span class="help-block">Required</span>
                                        </div>                                         
                                    </div>
    
                                    <div id="groupissue">

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Issued Item</label>
                                            <div class="col-md-4 col-xs-12">                                                                                            
                                                <select id="issued_item" name="issued_item" class="form-control select">
                                                    <option value="">Select</option>
                                                    <?php foreach($stock_item as $row) { echo '<option value="' . $row['item_id'] . '">' . $row['item_name'] . '</option>'; } ?>
                                                </select>
                                                <span class="help-block">Required</span>
                                            </div>
                                            <label class="col-md-2 col-xs-12 control-label">Issued Qty</label>
                                            <div class="col-md-2 col-xs-12">
                                                <input type="text" class="form-control" name="issued_qty"  id="issued_qty" placeholder="Issued Qty" value="<?php echo set_value('issued_qty')?>"/>   
                                                <span class="help-block">Required</span>
                                            </div>
                                        </div> 

                                        <br>

                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Resolution Code</label>
                                        <div class="col-md-4 col-xs-12">                                                                                            
                                            <select id="resolution" name="resolution" class="form-control select">
                                                <option value="">Select</option>
                                                <?php foreach($resolution as $row) { echo '<option value="' . $row['resolution_id'] . '">' . $row['resolution_description'] . '</option>'; } ?>
                                            </select>
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Resolved Description</label>
                                        <div class="col-md-9 col-xs-12">  
                                            <textarea class="form-control" id="resolved_description" required  name="resolved_description" placeholder="Description" rows="3" value="<?php echo set_value('resolved_description'); ?>"></textarea>
                                            <span class="help-block">Required</span>
                                        </div>
                                    </div>
                                    
                                </div>
   
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
                                echo '<span class="contacts-title">'.$row['status_description'].'</span>';
                                echo '<p>' . $row['status_on_time'] . ' on ' . $row['status_on_date'] . ' by '  . $row['status_by_user'] . '</p>'; 
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
                    resolved_on_date: {
                            required: true,
                    },
                    resolved_on_time: {
                            required: true,
                    },                  
                    resolved_description: {
                            required: true,
                    },
                    resolution: {
                            required: true,
                    },
                    asset_change_description: {
                            required: true,
                    },
                    actual_description: {
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
        $("#resolved_on_date").attr("value", "<?php echo date("Y-m-d") ?>");
        $("#resolved_on_time").attr("value", "<?php echo date("H:i:s") ?>");

        $('#groupissue').hide();

    });

    $("input[type='radio']").click(function(){

        var radioValue = $("input[name='asset_change_description']:checked").val();

        if(radioValue == 1){

            $('#groupissue').show();

            $('#issued_item').attr('required', '');
            $('#issued_qty').attr('required', '');

        }else if(radioValue == 0){

            $('#issued_item').removeAttr('required');
            $('#issued_qty').removeAttr('required');

            $('#groupissue').hide();

           

        }

    });


</script>

