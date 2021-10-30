<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        
        <li class="xn-logo">
            <a href="<?php echo base_url() ?>"><?php echo $Project_title ?></a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?php echo base_url() . '/images/' . $profile[0]['profile_picture'] ?>" alt="<?php echo $profile[0]['user_name'] ?>"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo base_url() . '/images/' . $profile[0]['profile_picture'] ?>" alt="<?php echo $profile[0]['user_name'] ?>"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $profile[0]['user_name'] ?></div>
                    <div class="profile-data-title"><?php echo $profile[0]['designation'] ?></div>
                </div>
                <div class="profile-controls">
                    <a href="<?php echo site_url('profile') ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
        

        
        <?php echo $menus ?>

        <li><a target="_blank" href="http://172.20.2.187/networkscript/"><span class="fa fa-desktop"></span> <span class="xn-text">Network Scripts</span></a></li>
 
    </ul>
   <!-- END X-NAVIGATION -->

</div>



