<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $Project_title ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
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
                    
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    
                    <?php echo validation_errors(); ?>
                    
                    <?php

                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                        echo form_open('login', $attributes);

                    ?>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="user_id" id="user_id" required="" placeholder="User id"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" required="" placeholder="Password"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        
                        <div class="col-md-6">
                            <a href="<?php echo site_url(). "login/reset_password" ?>" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Log In</button>
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






