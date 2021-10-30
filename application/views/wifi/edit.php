<!-- START BREADCRUMB -->     
<ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>       
        <li class="active">Update</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <?php

        //flash messages
        if($this->session->flashdata('flash_message')){

            if($this->session->flashdata('flash_message') == 'updated'){

                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> ' . ucfirst('Category') . ' updated with success.';
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

      $attributes = array('class' => 'form-horizontal', 'id' => 'myform');
      echo form_open('wifiuser/update/'.$this->uri->segment(3).'', $attributes);

    ?>            

   
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Update</strong> Wifi User</h3>
<!--                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>-->
                        </div>

                        <div class="panel-body">                                                                        

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">ID</label>          
                                <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="wifi_user_id" id="wifi_user_id" placeholder="ID" required value="<?php echo $wifiuser[0]['wifi_user_id']; ?>"/>                          
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Employee ID</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="employee_id" id="employee_id" required placeholder="Employee ID" value="<?php echo $wifiuser[0]['employee_id']; ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                            </div>

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Employee Name</label>          
                                <div class="col-md-4 col-xs-12">
                                    <input type="text" class="form-control" name="employee_name" id="employee_name"  required placeholder="Employee Name" value="<?php echo $wifiuser[0]['employee_name']; ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                            </div>

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">MAC Address</label>          
                                <div class="col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="mac_address" id="mac_address" required placeholder="MAC Address" value="<?php echo $wifiuser[0]['mac_address']; ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                            </div>

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Wifi Name</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="wifi_name" id="wifi_name" required placeholder="Wifi Name" value="<?php echo $wifiuser[0]['wifi_name']; ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                            </div>

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Location</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="<?php echo $wifiuser[0]['location']; ?>"/>                                        
                                </div>
                            </div>

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Department</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="department" id="department" placeholder="Department" value="<?php echo $wifiuser[0]['department']; ?>"/>                                        
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Remarks</label>     
                                <div class="col-md-5 col-xs-12">      
                                    <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks" rows="3" value=""><?php echo $wifiuser[0]['remarks']; ?></textarea>
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
    <!-- PAGE CONTENT WRAPPER -->
    
    <?php echo form_close(); ?>

   

   