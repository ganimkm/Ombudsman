<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        
        <li class="xn-logo">
            <a href="index.html"><?php echo $Project_title ?></a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?php echo base_url() . 'assets/images/users/user.png'?>" alt="<?php echo $user_name ?>"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo base_url() . 'assets/images/users/user.png'?>" alt="<?php echo $user_name ?>"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $user_name ?></div>
                    <div class="profile-data-title"><?php echo $designation ?></div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
        
        <li class="xn-title">Navigation</li>    
        
        <li>
            <a href="<?php echo base_url() ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
        </li>
        
        <li class="xn-openable active">
            <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Helpdesk</span></a>
            <ul>                            
                <li class="xn-openable">
                    <a href="#">Gereral</a>
                    <ul>
                        <li><a href="<?php echo site_url('helpdesk/general/user') ?>">User</a></li>
                        <li><a href="<?php echo site_url('helpdesk/general/category') ?>">Category</a></li>
                        <li><a href="<?php echo site_url('helpdesk/general/subcategory') ?>">Sub Category</a></li>
                        <li><a href="<?php echo site_url('helpdesk/general/location') ?>">Location</a></li>
                        <li><a href="<?php echo site_url('helpdesk/general/department') ?>">Department</a></li>
                    </ul>
                </li> 
                <li class="xn-openable active">
                    <a href="#">Tickets</a>
                    <ul>
                        <li><a href="<?php echo site_url('helpdesk/tickets/incident/log') ?>">Log</a></li>
                        <li><a href="<?php echo site_url('helpdesk/tickets/incident/respond') ?>">Accept</a></li>
                        <li><a href="<?php echo site_url('helpdesk/tickets/incident/resolve') ?>">Resolve</a></li>
                        <li><a href="<?php echo site_url('helpdesk/tickets/incident/status') ?>">Status</a></li>
                    </ul>
                </li>
                <li class="xn-openable">
                    <a href="#">Analytics</a>
                    <ul>
                        <li><a href="<?php echo site_url('helpdesk/analytics/dailymis') ?>">Daily Report</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        
        <li class="xn-openable">
            <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Network</span></a>
            <ul>                            
                <li class="xn-openable">
                    <a href="#">Gereral</a>
                    <ul>
                        <li><a href="<?php echo site_url('network/general/ipaddress') ?>">IP Address</a></li>
                        <li><a href="<?php echo site_url('network/general/ipinterface') ?>">IP Interface</a></li>
                        <li><a href="<?php echo site_url('network/general/ipcategory') ?>">IP Category</a></li>
                        <li><a href="<?php echo site_url('network/general/iptype') ?>">IP Type</a></li>
                        <li><a href="<?php echo site_url('network/general/ipserviceprovider') ?>">IP Service Provider</a></li>
                    </ul>
                </li> 
                <li class="xn-openable">
                    <a href="#">Monitor</a>
                    <ul>
                        <li><a href="<?php echo site_url('network/monitor/interfacetraffic') ?>">Interface Traffic</a></li>
                        <li><a href="<?php echo site_url('network/monitor/maciptrack') ?>">MAC IP Track</a></li>
                        <li><a href="<?php echo site_url('network/monitor/ipstatus') ?>">IP Status</a></li>
                    </ul>
                </li>
                <li class="xn-openable">
                    <a href="#">Analytics</a>
                    <ul>
                        <li><a href="<?php echo site_url('network/analytics/downtime') ?>">Downtime</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        

<!--<li class="xn-openable">
    <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Navigation Levels</span></a>
    <ul>                            
        <li class="xn-openable">
            <a href="#">Second Level</a>
            <ul>
                <li class="xn-openable">
                    <a href="#">Third Level</a>
                    <ul>
                        <li class="xn-openable">
                            <a href="#">Fourth Level</a>
                            <ul>
                                <li><a href="#">Fifth Level</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>  

    </ul>
</li>-->
        
    </ul>

</div>



