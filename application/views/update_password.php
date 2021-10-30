<!DOCTYPE html>
<html lang="en" class="body-full-height">
    
    <head>        
        <!-- META SECTION -->
        <title><?php echo $Project_title ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="<?php echo base_url() . '/favicon.ico' ?>" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url() . 'css/theme-default.css'?>"/>
        <!-- EOF CSS INCLUDE --> 
        
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/jquery/jquery.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/jquery/jquery-ui.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap.min.js'?>"></script>  
        
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/validationengine/jquery.validationEngine.js'?>"></script>        
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/jquery-validation/jquery.validate.js'?>"></script>     
        <!-- END PLUGINS -->

    </head>

    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                
                <div class="login-logo"></div>
                
                <div class="login-body">
                    
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    
                    <div class="login-error">
                        <?php echo validation_errors(); ?>
                    </div>

                    <?php

                        //flash messages
                        if($this->session->flashdata('flash_message')){

                            if($this->session->flashdata('flash_message') == 'updated'){

                                echo '<div class="alert alert-success" role="alert">';
                                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                                echo '<strong>Well done!</strong> ' . ucfirst('Password') . ' updated with success.';
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
                        echo form_open('login/update_password/'.$this->uri->segment(3). '/' .$this->uri->segment(4).'' , $attributes);

                    ?>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="user_id" id="user_id" required="" readonly="" placeholder="User Id" value="<?php echo $user_id ?>"/>  
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" required="" placeholder="New Password"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="" placeholder="New Password Again"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    
                        <div class="col-md-6">
                            <a href="<?php echo site_url(). "login/reset_password" ?>" class="btn btn-link btn-block">Reset Password Again!</a>
                        </div>
                        
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Update Password</button>
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2015 <?php echo $Developed_By ?>
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </body>
    
    <script type="text/javascript">

        var myform = $("#myform").validate({
            
            ignore: [],
            
            rules:{                                            
                    user_id: {
                            required: true
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

    </script>
    
</html>






