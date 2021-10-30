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
    </head>
    
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                
                <div class="login-logo"></div>
                
                <div class="login-body">
                    
                    <div class="login-title">Reset Password</div>
                    
                    <div class="login-error">
                        <?php echo validation_errors(); ?>
                    </div>

                    <?php

                        //flash messages
                        if($this->session->flashdata('flash_message')){

                            if($this->session->flashdata('flash_message') == 'updated'){

                                echo '<div class="alert alert-success" role="alert">';
                                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                                echo '<strong>Well done!</strong> Password Update Link Sent to your Registered EMail.';
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

                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                        echo form_open('login/reset_password', $attributes);

                    ?>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="user_id" id="user_id" required="" placeholder="User Id"/>
                        </div>
                    </div>
                    
                    <div class="form-group">

                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Reset Password</button>
                        </div>
                        
                        <div class="col-md-6">
                            <a href="<?php echo site_url(). "login" ?>" class="btn btn-link btn-block">Return to Login</a>
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
    
</html>






