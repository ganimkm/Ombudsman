   <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
    </ul>
    <!-- END BREADCRUMB -->
     
    <?php

      $attributes = array('id' => 'myform','class' => 'form-horizontal');
      echo form_open('helpdesk/ticket/networkdownsave', $attributes);
    ?>              

    <!-- page content wrapper -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Logging</strong> Incident</h3>
<!--                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>-->
                        </div>

                        <div class="panel-body">                                                                        

                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Ticket Number</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" readonly name="incident_number" id="incident_number" placeholder="Ticket Number" value="<?php echo $incident[0]['next_incident_number'];?>"/>                   
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label">User</label>  
                                 <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" readonly name="user_id" id="user_id" placeholder="User ID" value="<?php echo $user[0]['user_id']; ?>"/>                     
                                    <span class="help-block">Required</span>
                                </div>
                                 <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" readonly name="user_name" id="user_name" placeholder="User Name" value="<?php echo $user[0]['user_name'];?>"/>                      
                                    <span class="help-block">Required</span>
                                </div>
                            </div>   
                            
                            <div class="form-group">                
                                <label class="col-md-2 col-xs-12 control-label">Location</label>
                                    <div class="col-sm-2">
                                        <select id="location" required="" name="location" class="form-control select">
                                            <option value="<?php echo $user[0]['location_id']; ?>"><?php echo $user[0]['location_name']; ?></option>
                                            <option value="">Select</option>
                                            <?php foreach($location as $row) { echo '<option value="' . $row['location_id'] . '">' . $row['location_name'] . '</option>'; }?>
                                        </select>
                                        <span class="help-block">Required</span>
                                    </div>

                                <label class="col-md-2 col-xs-12 control-label">Department</label>
                                    <div class="col-sm-2">
                                        <select id="department" name="department" class="form-control">
                                            <option value="<?php echo $user[0]['department_id']; ?>"><?php echo $user[0]['department_name']; ?></option>
                                            <option value="">Select</option>
                                            <?php foreach($department as $row) { echo '<option value="' . $row['department_id'] . '">' . $row['department_name'] . '</option>'; }?>
                                        </select>
                                        <span class="help-block">Required</span>
                                    </div>
                            </div>
                            
                            <div class="form-group">                
                                <label class="col-md-2 col-xs-12 control-label">Category</label>
                                    <div class="col-sm-2">
                                        <select id="category" name="category" class="form-control select">
                                            <option value="">Select</option>
                                            <?php foreach($category as $row) { echo '<option value="' . $row['category_id'] . '">' . $row['category_description'] . '</option>'; } ?>
                                        </select>
                                        <span class="help-block">Required</span>
                                    </div>

                                <label class="col-md-2 col-xs-12 control-label">Sub Category</label>
                                    <div class="col-sm-2">
                                        <select id="sub_category" name="sub_category" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                        <span class="help-block">Required</span>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                                
                                <label class="col-md-2 col-xs-12 control-label">Request Type</label>
                                <div class="col-md-2 col-xs-12">                                                                                            
                                    <select id="request_type" name="request_type" class="form-control select">
<!--                                        <option value="">Select</option>-->
                                        <?php foreach($request_type as $row) { echo '<option value="' . $row['request_type_id'] . '">' . $row['request_type_description'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                                
                                <label class="col-md-2 col-xs-12 control-label">Call Mode</label>
                                <div class="col-sm-2">                                                                                            
                                    <select id="call_mode" name="call_mode" class="form-control select">
<!--                                        <option value="">Select</option>-->
                                        <?php foreach($call_mode as $row) { echo '<option value="' . $row['call_mode_id'] . '">' . $row['call_mode_description'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                                                                                                   
                            </div>
                            
                            <div class="form-group">
                                
                                <label class="col-md-2 col-xs-12 control-label">Business Criteria</label>
                                <div class="col-md-2 col-xs-12">                                                                                            
                                    <select id="business_criteria" name="business_criteria" class="form-control select">
<!--                                        <option value="">Select</option>-->
                                        <?php foreach($business_criteria as $row) { echo '<option value="' . $row['business_criteria_id'] . '">' . $row['business_criteria_description'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                                
                                <label class="col-md-2 col-xs-12 control-label">Business Classification</label>
                                <div class="col-sm-2">                                                                                              
                                    <select id="business_classification" name="business_classification" class="form-control select">
<!--                                        <option value="">Select</option>-->
                                        <?php foreach($business_classification as $row) { echo '<option value="' . $row['business_classification_id'] . '">' . $row['business_classification_description'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                
                                <label class="col-md-2 col-xs-12 control-label">Impact</label>
                                <div class="col-md-2 col-xs-12">                                                                                          
                                    <select id="impact" name="impact" class="form-control select">
                                        <option value="">Select</option>
                                        <?php foreach($impact as $row) { echo '<option value="' . $row['impact_id'] . '">' . $row['impact_description'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                                
                                <label class="col-md-2 col-xs-12 control-label">Impact Classification</label>
                                <div class="col-md-4 col-xs-12">   
                                    <select id="impact_classification" name="impact_classification" class="form-control select">
                                        <option value="">Select</option>
                                        <?php foreach($impact_classification as $row) { echo '<option value="' . $row['impact_classification_id'] . '">' . $row['impact_classification_description'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-6 col-xs-12">      
                                    <textarea class="form-control" id="logged_description" required=""  name="logged_description" placeholder="Description" rows="3" value="<?php echo set_value('logged_description'); ?>"><?php if(!empty($auto_log_incidents))echo $auto_log_incidents[0]['incident_description'];?></textarea>
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label">Assigned To</label>
                                <div class="col-md-3 col-xs-12">                                                                                            
                                    <select id="assigned_to" name="assigned_to" class="form-control select">
                                        <option value="">Select</option>
                                        <?php foreach($assigned_to as $row) { echo '<option value="' . $row['user_id'] . '">' . $row['user_name'] . '</option>'; } ?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label">Incident Date</label>  
                                 <div class="col-md-2 col-xs-12">
                                    <!--<input type="text" class="form-control datepicker" name="logged_on_date" id="logged_on_date" placeholder="Date" value="<?php set_value('logged_on_date')?>"/>-->   
                                     <input type="text" class="form-control" name="logged_on_date" readonly="" id="logged_on_date" placeholder="Date" value="<?php set_value('logged_on_date')?>"/>      
                                    <span class="help-block">Required</span>
                                </div>
                                 <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="logged_on_time"  readonly="" id="logged_on_time" placeholder="Time" value="<?php set_value('logged_on_time')?>"/>    
                                    <span class="help-block">Required</span>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label">Extras</label>  
                                 <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="room_number" id="room_number" placeholder="room #" value="<?php echo set_value('rack_number'); ?>"/>                        
                                </div>
                                 <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="extension_number"  id="extension_number" placeholder="extn #" value="<?php echo set_value('extension_number'); ?>"/>                         
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="rack_number" id="rack_number" placeholder="rack #" value="<?php echo set_value('rack_number'); ?>"/>                       
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="reference #" value="<?php if(!empty($auto_log_incidents))echo $auto_log_incidents[0]['incident_ref_number'];?>"/>                       
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
    <!-- page content wrapper -->
    
    <?php echo form_close(); ?>

    <script type="text/javascript">

        var myform = $("#myform").validate({
            ignore: [],
            
            rules: {    

                    incident_number: {
                            required: true,
                            number: true
                    },
                    user_id: {
                            required: true,
                    },
                    user_name: {
                            required: true,
                    },
                    location: {
                            required: true,
                    },
                    department: {
                            required: true,
                    },
                    category: {
                            required: true,
                    },
                    sub_category: {
                            required: true,
                    },
                    request_type: {
                            required: true,
                    },
                    business_classification: {
                            required: true,
                    },
                    impact: {
                            required: true,
                    },
                    impact_classification: {
                            required: true,
                    },
                    call_mode: {
                            required: true,
                    },
                    business_criteria: {
                            required: true,
                    },
                    logged_description: {
                            required: true,
                    },
                    assigned_to: {
                            required: true,
                    },
                    logged_on_date: {
                            required: true,
                    },
                    logged_on_time: {
                            required: true,
                    }                    
                }                                        
            });                                    

    </script>
        
    <!-- end scripts -->         

  <?php echo form_close(); ?>

<script type="text/javascript">

    $('#category').change(function()
    {    
        var category_id = $('#category').val();

        if (category_id != "")
        {          
            var post_url = "<?php echo site_url() ?>/helpdesk/general/subcategorycontroller/get_sub_category"
            var datastring = 'category_id=' + category_id 
             //alert(post_url) ;          
            $.ajax(
            {
                type: "post",
                url: post_url,
                data: datastring,
                cache: false,
                
                success: function(subcategories) //we're calling the response json array 'subcategories'

                {
                    $('#sub_category').empty();
                    $.each(subcategories,function(i,subcategories) 
                    { 
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(subcategories.sub_category_id);
                        opt.text(subcategories.sub_category_description);
                        $('#sub_category').append(opt); 
                    });
                } //end success                    
            }); //end ajax
        } 
        else 
        {   
            $('#sub_category').empty();        
        }//end if
    }); //end change 

    $(document).ready(function()
    {

        $("#logged_on_date").attr("value", "<?php echo @date("Y-m-d");   ?>");
        $("#logged_on_time").attr("value", "<?php echo @date("H:i:s") ?>");
  
    });
    

            
</script>





