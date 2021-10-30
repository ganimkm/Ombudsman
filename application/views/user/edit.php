    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(2));?></li>
    </ul>
    <!-- END BREADCRUMB -->
     
    <?php

        //flash messages
        if($this->session->flashdata('flash_message')){

            if($this->session->flashdata('flash_message') == 'updated'){

                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> ' . ucfirst('User') . ' updated with success.';
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
      echo form_open('user/update/'.$this->uri->segment(3).'', $attributes);

    ?>              

   
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <?php echo validation_errors(); ?>
            
            <div class="col-md-12">
                    
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Updating</strong> User</h3>
<!--                            <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>-->
                    </div>

                    <div class="panel-body">                                                                        

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">User ID</label>          
                            <div class="col-md-2 col-xs-12">
                                <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" value="<?php echo $user[0]['user_id']; ?>"/>               
                                <span class="help-block">Required</span>
                            </div>
                        </div>

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">User Name</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?php echo $user[0]['user_name']; ?>"/>                                     
                                <span class="help-block">Required</span>
                            </div>
                        </div>
                        
                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Password</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $this->encrypt->decode($user[0]['password']); ?>"/>                                       
                                <span class="help-block">Required</span>
                            </div>
                        </div>
                        
                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Confirm Password</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo $this->encrypt->decode($user[0]['password']); ?>"/>                                                   
                                <span class="help-block">Required same value as Password</span>
                            </div>
                        </div>

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Email</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user[0]['email_address']; ?>"/>                                        
                                <span class="help-block">Required</span>
                            </div>
                        </div>
                        
                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Mobile #</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number" value="<?php echo $user[0]['mobile_number']; ?>"/>                                         
                                <span class="help-block">Required</span>
                            </div>
                        </div>
                        
                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Designation</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="<?php echo $user[0]['designation']; ?>"/>                                       
                                <span class="help-block">Required</span>
                            </div>
                        </div>
                                                
                        <div class="form-group">                
                            <label class="col-md-3 col-xs-12 control-label">Location</label>
                                <div class="col-sm-2">
                                    <select id="location" name="location" class="form-control select">
                                        <option value="<?php echo $user[0]['location_id']; ?>"><?php echo $user[0]['location_name']; ?></option>
                                        <option value="">Select</option>
                                        <?php foreach($location as $row) { echo '<option value="' . $row['location_id'] . '">' . $row['location_name'] . '</option>'; }?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                        </div>
                        
                        <div class="form-group">   
                            <label class="col-md-3 col-xs-12 control-label">Department</label>
                                <div class="col-sm-2">
                                    <select id="department" name="department" class="form-control select"> 
                                        <option value="<?php echo $user[0]['department_id']; ?>"><?php echo $user[0]['department_name']; ?></option>
                                        <option value="">Select</option>
                                        <?php foreach($department as $row) { echo '<option value="' . $row['department_id'] . '">' . $row['department_name'] . '</option>'; }?>
                                    </select>
                                    <span class="help-block">Required</span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Is Active</label>
                            <div class="col-md-3 col-xs-12">
                                <label class="radio-inline">
                                    <input type="radio" class="iradio" name="is_active" value="1" <?php echo set_radio('is_active', '1', $user[0]['is_active'] == '1'); ?> />Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="iradio" name="is_active" value="0" <?php echo set_radio('is_active', '1', $user[0]['is_active'] == '0'); ?> />No
                                </label>
                            </div>    
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Is Admin</label>
                            <div class="col-md-3 col-xs-12">
                                <label class="radio-inline">
                                    <input type="radio" class="iradio" name="is_admin" value="1" <?php echo set_radio('is_admin', '1', $user[0]['is_admin'] == '1'); ?> />Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="iradio" name="is_admin" value="0" <?php echo set_radio('is_admin', '1', $user[0]['is_admin'] == '0'); ?> />No
                                </label>
                            </div>    
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Is Ticket Resolver</label>
                            <div class="col-md-3 col-xs-12">
                                <label class="radio-inline">
                                    <input type="radio" class="iradio" name="is_ticket_resolver" value="1" <?php echo set_radio('is_ticket_resolver', '1', $user[0]['is_ticket_resolver'] == '1'); ?> />Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="iradio" name="is_ticket_resolver" value="0" <?php echo set_radio('is_ticket_resolver', '1', $user[0]['is_ticket_resolver'] == '0'); ?> />No
                                </label>
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

    <script type="text/javascript">
        
    $('#location').change(function()
    {    
        var location_id = $('#location').val();

        if (location_id != "")
        {          
            var post_url = "<?php echo site_url() ?>/DepartmentController/Get_Department"
            var dataString = 'location_id=' + location_id 
            
            $.ajax(
            {
                type: "POST",
                url: post_url,
                data: dataString,
                cache: false,
                
                success: function(departments) //we're calling the response json array 'subcategories'

                {
                    $('#department').empty();
                    $.each(departments,function(i,departments) 
                    { 
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(departments.Department_ID);
                        opt.text(departments.Description);
                        $('#department').append(opt); 
                    });
                } //end success                    
            }); //end AJAX
        } 
        else 
        {   
            $('#department').empty();        
        }//end if
    }); //end change 
    
        var myform = $("#myform").validate({
            ignore: [],
            
            rules: {                                            
                    user_id: {
                            required: true
                    },
                    user_name: {
                            required: true
                    },
                    password: {
                            required: true,
                            minlength: 5,
                            maxlength: 10                            
                    },
                    'confirm_password': {
                            required: true,
                            minlength: 5,
                            maxlength: 10,
                            equalTo: "#password"
                    },
                    Designation: {
                            required: true
                    },
                    location: {
                            required: true
                    },
                    department: {
                            required: true
                    }
                }                                        
            });                                    

    </script>
        
    <!-- END SCRIPTS -->         