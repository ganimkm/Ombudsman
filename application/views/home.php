<!DOCTYPE html>
<html lang="en">
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
        
        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/jquery/jquery.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/jquery/jquery-ui.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap.min.js'?>"></script>                
        <!-- END PLUGINS -->
        
        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/icheck/icheck.min.js'?>"></script>        
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/scrolltotop/scrolltopcontrol.js'?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/morris/raphael-min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/morris/morris.min.js'?>"></script>      
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/rickshaw/d3.v3.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/rickshaw/rickshaw.min.js'?>"></script>
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'?>"></script>
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'?>"></script>            
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap-datepicker.js'?>"></script>             
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/owl/owl.carousel.min.js'?>"></script>               
        
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/moment.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/daterangepicker/daterangepicker.js'?>"></script>     
             
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap-datepicker.js'?>"></script>  
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap-timepicker.min.js'?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/datatables/jquery.dataTables.min.js'?>"></script> 
        
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap-file-input.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/bootstrap/bootstrap-select.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/tagsinput/jquery.tagsinput.min.js'?>"></script>
        
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/validationengine/languages/jquery.validationEngine-en.js'?>"></script>
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/validationengine/jquery.validationEngine.js'?>"></script>        
        <script type='text/javascript' src="<?php echo base_url() . 'js/plugins/jquery-validation/jquery.validate.js'?>"></script>     
       
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins/table2excel/jquery.table2excel.min.js'?>"></script>    
        
        <!-- END THIS PAGE PLUGINS -->       
        
     
        
         <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?php echo base_url() . 'js/settings.js'?>"></script>        
        <script type="text/javascript" src="<?php echo base_url() . 'js/plugins.js'?>"></script>     
        <script type="text/javascript" src="<?php echo base_url() . 'js/actions.js'?>"></script> 
        
<!--        <link href="<?php echo base_url() . 'multi-select/css/bootstrap-multiselect.css'?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url() . 'multi-select/js/bootstrap-multiselect.js'?>" type="text/javascript"></script>-->
        
<!--        <script type="text/javascript" src="<?php echo base_url() . 'js/demo_dashboard.js'?>"></script> -->
        
        <!-- END TEMPLATE -->

    <!-- END SCRIPTS -->
    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
          
             <?= $sidebar ?>   
     
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                   
                    <li class="xn-icon-button pull-right">
                        <a href="<?php echo site_url(). "/helpdesk/ticket/todo" ?>"><span class="fa fa-calendar"></span></a>
                        <div class="informer informer-danger"><div id="totaltodo"></div></div>                    
                    </li>
                    
 <!--
                    <li class="xn-icon-button pull-right">
                        <a href="<?php echo site_url(). "/helpdesk/ticket/networkdown" ?>"><span class="fa fa-thumbs-o-down"></span></a>
                        <div class="informer informer-danger"><div id="totalnetworkdown"></div></div>                    
                    </li>
-->


                    <?php
                    
                        if ($is_admin == "1")
                        {
                            /*
                            echo '<li class="xn-icon-button pull-right">';
                            echo '<a href="' . site_url() . 'helpdesk/ticket/todo"><span class="fa fa-calendar"></span></a>';
                            echo '<div class="informer informer-danger"><div id="totaltodo"></div></div>';
                            echo '</li>';
                            */
                            echo '<li class="xn-icon-button pull-right">';
                            echo '<a href="' . site_url() . 'helpdesk/ticket/networkdown"><span class="fa fa-thumbs-o-down"></span></a>';
                            echo '<div class="informer informer-danger"><div id="totalnetworkdown"></div></div> ';                  
                            echo '</li>';             
                        }
                    ?>
                    

                    
                </ul>
                
                <?= $main ?>         
                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?php echo site_url(). "/logout" ?>" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

     
<!--        <audio autoplay preload="auto">  
           <source src="<?php echo base_url() . 'audio/alert.mp3' ?>" />  
        </audio> 
        
        <audio autoplay preload="auto">  
           <source src="<?php echo base_url() . 'audio/fail.mp3' ?>" />  
        </audio>
        -->
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo base_url() . 'audio/alert.mp3' ?>" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo base_url() . 'audio/fail.mp3' ?>" preload="auto"></audio>
        <!-- END PRELOADS -->             
        
    
    </body>

<script>
    
var todo_count = function () {
  
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Get_TODO_Count" 
    var dataString = ''

    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        cache: false,

        success: function(todocount) //we're calling the response json array 'todocount'

        {

            $('#totaltodo').empty();
                
            $.each(todocount,function(i,todocount) 
            {     
                
                document.getElementById("totaltodo").innerHTML = todocount.todocount;

            });
        } //end success

    }); //end AJAX
  
   setTimeout(todo_count, 60000);
   
};

var networkdown_count = function () {
  
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Get_NetworkDown_Count" 
    var dataString = ''

    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        cache: false,

        success: function(networkdowncount) //we're calling the response json array 'todocount'

        {

            $('#totalnetworkdown').empty();
                
            $.each(networkdowncount,function(i,networkdowncount) 
            {     
                
                document.getElementById("totalnetworkdown").innerHTML = networkdowncount.networkdowncount;

            });
        } //end success

    }); //end AJAX
  
   setTimeout(networkdown_count, 60000);
   
};

$(document).ready(function()

    {

       todo_count();
       networkdown_count();
 
    });
    
var collection=[];// final collection of sounds to play
var loadedIndex=0;// horrible way of forcing a load of audio sounds
var index=0;

// remap audios to a buffered collection
function init(audios) {
  for(var i=0;i<audios.length;i++) {
    var audio = new Audio(audios[i]);
    collection.push(audio);
    buffer(audio);
  }
}

// did I mention it's a horrible way to buffer?
function buffer(audio) {
  if(audio.readyState==4)return loaded();
  setTimeout(function(){buffer(audio)},100);
}

// check if we're leady to dj this
function loaded() {
  loadedIndex++;
  //alert(loadedIndex);
  if(collection.length==loadedIndex)playLooped();
}

// play and loop after finished
function playLooped() {
  //var audio=Math.floor(Math.random() * (collection.length));
  //alert(audio);
    
  var audio=index;
    
  audio=collection[audio];
  //audio.play();
  
  if (index==(collection.length-1))
  {
      index = 0;
  }else{
     index++; 
  }
  
  setTimeout(playLooped,audio.duration*500);
  
  
}

// the songs to be played!
init([
  '<?php echo base_url() . 'audio/SRICITY.mp3' ?>',
  '<?php echo base_url() . 'audio/SWITCH.mp3' ?>',
  '<?php echo base_url() . 'audio/AND.mp3' ?>',
  '<?php echo base_url() . 'audio/NAVASUJA.mp3' ?>',
  '<?php echo base_url() . 'audio/LINK.mp3' ?>',
  '<?php echo base_url() . 'audio/down.mp3' ?>'
]);
    
    </script>
</html>
