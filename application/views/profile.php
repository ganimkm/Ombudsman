    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(1));?></li>
    </ul>
    <!-- END BREADCRUMB -->

    <?php

  $attributes = array('id' => 'myform','class' => 'form-horizontal');
  echo form_open_multipart('profile/update', $attributes);

?>
    
    <div class="page-content-wrap">                
                
        <div class="row">
            
            <div class="col-md-12">

               <?php

                    //flash messages
                    if($this->session->flashdata('flash_message')){

                        if($this->session->flashdata('flash_message') == 'updated'){

                            echo '<div class="alert alert-success" role="alert">';
                            echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                            echo '<strong>Well done!</strong> ' . ucfirst('Profile') . ' updated with success.';
                            echo '</div>';   

                        }else{

                            echo '<div class="alert alert-danger" role="alert">';
                            echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                            echo '</div>';  

                        }

                    }

                ?>
            
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Update</strong> Profile</h3>
                    </div>

                    <div class="panel-body">                                                                        

                        <div class="col-md-3 col-sm-6 col-xs-12">

                            <h3 class="page-header">Profile Picture</h3>

                            <div class="text-center">
                                <img id="avatar" src="<?php echo base_url() . '/images/' . $profile[0]['profile_picture'] ?>" class="img-rounded" width="200" height="200" alt="<?php echo $user_name ?>"/>  
                                <h6>Upload a different photo...</h6>
                                <input class="text-center center-block well well-sm" name="uploadfile" id="uploadfile" type="file" accept="image/*">
                            </div>

                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12 personal-info">

                            <h3 class="page-header">Personal info</h3>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Name</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?php echo $profile[0]['user_name']; ?>"/>    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $profile[0]['email_address']; ?>"/>      
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mobile #</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number" value="<?php echo $profile[0]['mobile_number']; ?>"/>                                         
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Designation</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="<?php echo $profile[0]['designation']; ?>"/> 
                                </div>
                            </div>
                            
                            <h3 class="page-header">Login info</h3>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User ID</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" readonly="" name="user_id" id="user_id" placeholder="User ID" value="<?php echo $profile[0]['user_id']; ?>"/>    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-4">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $this->encrypt->decode($profile[0]['password']); ?>"/>  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Confirm Password</label>
                                <div class="col-lg-4">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo $this->encrypt->decode($profile[0]['password']); ?>"/>  
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear</button>                                    
                        <button class="btn btn-primary" type="submit">Save Changes</button>
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
                        required: true
                },
                user_name: {
                        required: true
                },
                email: {
                        required: true,
                        email: true
                },
                password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20                            
                },
                'confirm_password': {
                        required: true,
                        minlength: 5,
                        maxlength: 20,
                        equalTo: "#password"
                }
            }                                        
        });                                    

   function readURL(input) {
       
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#avatar').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#uploadfile").change(function(){
        readURL(this);
    });
    
</script>

<!-- END SCRIPTS -->        