<!--    <div class="col-sm-2">-->

<!--        <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Tools</strong></a>

        <hr>

        <ul class="nav nav-stacked">-->


                 <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand" id="main_icon" class="glyphicon glyphicon-align-justify">
                    <a href="#">
                        Ombudsman
                    </a>
                </li>
                

            <?php

                $menu_group_id = "";

                foreach($user_menu as $row)
                {   
                    if ($menu_group_id != $row['Menu_Group_ID'])
                    {   
                        if ($menu_group_id != "")
                        {
                            echo '</ul>';
                            echo '</li>';
                        }
                        
                    echo '<li> <a href="#" data-toggle="collapse" data-target=#'.$row['Menu_Group_Description'].'>'.$row['Menu_Group_Description'].' <i class="glyphicon glyphicon-chevron-down"></i></a>';
                    echo '<ul id="'.$row['Menu_Group_Description'].'">';

                    }

                    echo '<li><a href=' . site_url($row['Page_Link']) . '><i class="glyphicon glyphicon-list-alt"></i> '.$row['Menu_Description'].' </a></li>';   
                    $menu_group_id = $row['Menu_Group_ID'];

                }

                echo '</ul>';
                echo '</li>';
                
            ?>    -->
        

<!--                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>-->
        </div>
                
    <!--</div>-->