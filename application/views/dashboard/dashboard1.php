<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->                       

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <!-- START WIDGETS -->                    
    <div class="row">
        <div class="col-md-3" id="callstatussummary">

            <!-- START WIDGET SLIDER -->
            
            <div class="widget widget-default widget-carousel">
                <div class="owl-carousel" id="owl-callstatussummary">
                    <div>                                    
                        <div class="widget-title"><div id="totaltitle"></div></div>                                                                        
                        <div class="widget-subtitle"><div id="totalsubtitle"></div></div>
                        <div class="widget-int"><div id="totaldata"></div></div>
                    </div>
                    <div>                                    
                        <div class="widget-title"><div id="holdtitle"></div></div>                                                                        
                        <div class="widget-subtitle"><div id="holdsubtitle"></div></div>
                        <div class="widget-int"><div id="holddata"></div></div>
                    </div>
                     <div>                                    
                        <div class="widget-title"><div id="pendingtitle"></div></div>                                                                        
                        <div class="widget-subtitle"><div id="pendingsubtitle"></div></div>
                        <div class="widget-int"><div id="pendingdata"></div></div>
                    </div>
                    <div>                                    
                        <div class="widget-title"><div id="resolvedtitle"></div></div>                                                                        
                        <div class="widget-subtitle"><div id="resolvedsubtitle"></div></div>
                        <div class="widget-int"><div id="resolveddata"></div></div>
                    </div>
                </div>                            
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                             
            </div>         
            <!-- END WIDGET SLIDER -->
           
        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
<!--            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">-->
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-thumbs-down"></span>
                </div>                             
                <div class="widget-data">
                    <div class="widget-int num-count"><div id="networkdowndata"></div></div>
                    <div class="widget-title"><div id="networkdowntitle"></div></div>
                    <div class="widget-subtitle"><div id="networkdownsubtitle"></div></div>
                </div>      
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
            </div>                            
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET REGISTRED -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
<!--                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">375</div>
                    <div class="widget-title">Registred users</div>
                    <div class="widget-subtitle">On your website</div>
                </div>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            -->
            </div>                            
            <!-- END WIDGET REGISTRED -->

        </div>
        
        <div class="col-md-3">

            <!-- START WIDGET CLOCK -->
            <div class="widget widget-info widget-padding-sm">
                <div class="widget-big-int plugin-clock">00:00</div>                            
                <div class="widget-subtitle plugin-date">Loading...</div>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            
                <div class="widget-buttons widget-c3">
                    <div class="col">
                        <a href="#"><span class="fa fa-clock-o"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-bell"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-calendar"></span></a>
                    </div>
                </div>                            
            </div>                        
            <!-- END WIDGET CLOCK -->

        </div>
    </div>
    <!-- END WIDGETS -->

    <div class="row">

        <div class="col-md-8">
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Helpdesk</h3>
                        <span>Pending Tickets</span>
                    </div>                                    
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>                                        
                        </li>                                        
                    </ul>
                </div>

                <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table id='pendingtickets' class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">Incident #</th>
                                        <th width="10%">Date</th>
                                        <th width="30%">Problem</th>
                                        <th width="15%">User</th>
                                        <th width="10%">Location</th>
                                        <th width="10%">Department</th>
                                        <th width="10%">Severity</th>
                                        <th width="10%">Owner</th>
                                        <th width="5%">Days</th>
                                        <th width="5%">Status</th>
                                    </tr>
                                </thead>
                                <tbody id='pendingticketsdata'>

                                </tbody>
                            </table>
                        </div>
                </div>

            </div>
  
        </div>
        
        <div class="col-md-4">
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Network</h3>
                        <span>Device(s) Down Events</span>
                    </div>                                    
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>                                        
                        </li>                                        
                    </ul>
                </div>

                <div class="panel-body panel-body-table">
                   <div  style="height: 200px;">
                        <div class="table-responsive">
                            <table id='networkdevicestatus' class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20%">IP Address</th>
                                        <th width="30%">IP Description</th>
                                        <th width="30%">Time</th>
                                        <th width="20%">Status</th>
                                    </tr>
                                </thead>
                                <tbody id='networkdevicestatusdata'>

                                </tbody>
                            </table>
                        </div>
                   </div> 
                </div>

            </div>
           
        </div>
        
    </div> 
    
     <div class="row">
        
        <div class="col-md-8">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <div class="panel-title-box">
                                <h3>Helpdesk</h3>
                                <span>Hold Tickets</span>
                            </div>                                    
                            <ul class="panel-controls" style="margin-top: 2px;">
                                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                    </ul>                                        
                                </li>                                        
                            </ul>
                        </div>

                        <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table id='holdtickets' class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">Incident #</th>
                                                <th width="10%">Date</th>
                                                <th width="30%">Problem</th>
                                                <th width="15%">User</th>
                                                <th width="10%">Location</th>
                                                <th width="10%">Department</th>
                                                <th width="10%">Severity</th>
                                                <th width="10%">Owner</th>
                                                <th width="5%">Days</th>
                                                <th width="5%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id='holdticketsdata'>

                                        </tbody>
                                    </table>
                                </div>
                        </div>

                    </div>

                </div>
        
         

<!--                <div class="col-md-4">
             
                     <div class="panel panel-default">
 <div class="panel-heading">
  <i class="fa fa-bar-chart-o fa-fw"></i> Account Registrations Past 7 days
 </div>
  /.panel-heading 
 <div class="panel-body">
  <div id="acctregs1" style="height: 300px;"></div>
 </div>
  /.panel-body 
</div>
             -->
         </div>
         
         
    </div> 

<!--    <div class="row">
        
        
        <div class="col-md-8">
             
                     <div class="panel panel-default">
 <div class="panel-heading">
  <i class="fa fa-bar-chart-o fa-fw"></i> Incident Summary
 </div>
  /.panel-heading 
 <div class="panel-body">
     <label class="label label-success">Incident Summary</label>
  <div id="acctregs" style="height: 300px;"></div>
 </div>
  /.panel-body 
</div>
             
         </div>       
        
        
    </div>-->

<script>

// If you want the first execution of the function to happen immediately,
// you can change that to
var networkstatus = function () {
    
    var post_url = "<?php echo site_url() ?>/NetworkController/Get_Network_Device_Current_Status" 
    var dataString = 'ip_status=' + 'Down'
    var count=0
    
    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        cache: false,

        success: function(nwdevicestatus) //we're calling the response json array 'nwdevicestatus'

        {

            $('#networkdevicestatusdata').empty();
            $.each(nwdevicestatus,function(i,nwdevicestatus) 
            {     

                var row = $('<tr />'); // here we're creating a new select option for each group
                $("#networkdevicestatus").append(row)
                row.append($("<td><strong>" + nwdevicestatus.IP_ADDRESS + "</strong></td>"));
                row.append($("<td>" + nwdevicestatus.IP_DESCRIPTION + "</td>"));
                row.append($("<td>" + nwdevicestatus.TIME_STAMP + "</td>"));
                row.append($("<td><span class='label label-danger'>" + nwdevicestatus.STATUS + "</span></td>"));
                
                count+=1
                
            });
            
            $('#networkdowndata').empty();
            $('#networkdowntitle').empty();
            $('#networkdownsubtitle').empty();
            
            document.getElementById("networkdowndata").innerHTML = count;
            document.getElementById("networkdowntitle").innerHTML = 'Network';
            document.getElementById("networkdownsubtitle").innerHTML = 'Device(s) Down';

        } //end success

    }); //end AJAX
  
  
   setTimeout(networkstatus, 60000);
   
};

var pendingcalldetails = function () {
    
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Get_Pending_Call_Details" 
    var dataString = ''
   
    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        cache: false,

        success: function(pendingcalldetails) //we're calling the response json array 'nwdevicestatus'

        {

            $('#pendingticketsdata').empty();
            $.each(pendingcalldetails,function(i,pendingcalldetails) 
            {     

                var row = $('<tr />'); // here we're creating a new select option for each group
                $("#pendingtickets").append(row)
                row.append($("<td><strong>" + pendingcalldetails.Incident_Number + "</strong></td>"));
                row.append($("<td>" + pendingcalldetails.Logged_On_Date + "</td>"));
                row.append($("<td><strong>" + pendingcalldetails.Logged_Description + "</strong></td>"));
                row.append($("<td>" + pendingcalldetails.User_Name + "</td>"));
                row.append($("<td>" + pendingcalldetails.Location_Description + "</td>"));
                row.append($("<td><strong>" + pendingcalldetails.Department_Description + "</strong></td>"));
                row.append($("<td>" + pendingcalldetails.Impact_Description + "</td>"));
                row.append($("<td>" + pendingcalldetails.Assigned_To_User + "</td>"));
                row.append($("<td>" + pendingcalldetails.Status_Duration + "</td>"));
                row.append($("<td><span class='label label-danger'>" + pendingcalldetails.Status + "</span></td>"));

            });
        } //end success

    }); //end AJAX
  
  
   setTimeout(pendingcalldetails, 60000);
   
};

var holdcalldetails = function () {
    
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Get_Hold_Call_Details" 
    var dataString = ''
   
    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        cache: false,

        success: function(holdcalldetails) //we're calling the response json array 'nwdevicestatus'

        {

            $('#holdticketsdata').empty();
            $.each(holdcalldetails,function(i,holdcalldetails) 
            {     

                var row = $('<tr />'); // here we're creating a new select option for each group
                $("#holdtickets").append(row)
                row.append($("<td><strong>" + holdcalldetails.Incident_Number + "</strong></td>"));
                row.append($("<td>" + holdcalldetails.Logged_On_Date + "</td>"));
                row.append($("<td><strong>" + holdcalldetails.Logged_Description + "</strong></td>"));
                row.append($("<td>" + holdcalldetails.User_Name + "</td>"));
                row.append($("<td>" + holdcalldetails.Location_Description + "</td>"));
                row.append($("<td><strong>" + holdcalldetails.Department_Description + "</strong></td>"));
                row.append($("<td>" + holdcalldetails.Impact_Description + "</td>"));
                row.append($("<td>" + holdcalldetails.Assigned_To_User + "</td>"));
                row.append($("<td>" + holdcalldetails.Status_Duration + "</td>"));
                row.append($("<td><span class='label label-warning'>" + holdcalldetails.Status + "</span></td>"));

            });
        } //end success

    }); //end AJAX
  
  
   setTimeout(pendingcalldetails, 60000);
   
};

var callstatussummary = function () {
  
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Get_Call_Status_Summary" 
    var dataString = ''

    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        cache: false,

        success: function(callsummary) //we're calling the response json array 'callsummary'

        {

            $('#totaltitle').empty();
            $('#totalsubtitle').empty();
            $('#totaldata').empty();
            
            $('#holdtitle').empty();
            $('#holdsubtitle').empty();
            $('#holddata').empty();
            
            $('#pendingtitle').empty();
            $('#pendingsubtitle').empty();
            $('#pendingdata').empty();
            
            $('#resolvedtitle').empty();
            $('#resolvedsubtitle').empty();
            $('#resolveddata').empty();
                 
            $.each(callsummary,function(i,callsummary) 
            {     
                
                document.getElementById("totaltitle").innerHTML = 'Total Tickets';
                document.getElementById("totalsubtitle").innerHTML = callsummary.Month + ' ' + callsummary.Year;
                document.getElementById("totaldata").innerHTML = callsummary.Total_Tickets;
                
                document.getElementById("holdtitle").innerHTML = 'Hold Tickets';
                document.getElementById("holdsubtitle").innerHTML = callsummary.Month + ' ' + callsummary.Year;
                document.getElementById("holddata").innerHTML = callsummary.Hold_Tickets;
                
                document.getElementById("pendingtitle").innerHTML = 'Pending Tickets';
                document.getElementById("pendingsubtitle").innerHTML = callsummary.Month + ' ' + callsummary.Year;
                document.getElementById("pendingdata").innerHTML = callsummary.Pending_Tickets;
                
                document.getElementById("resolvedtitle").innerHTML = 'Resolved Tickets';
                document.getElementById("resolvedsubtitle").innerHTML = callsummary.Month + ' ' + callsummary.Year;
                document.getElementById("resolveddata").innerHTML = callsummary.Resolved_Tickets;
     
            });
        } //end success

    }); //end AJAX
  
   setTimeout(callstatussummary, 60000);
   
};

var charttest = function () {
     
    var acct_regs1 = [
        {date:"2015-01-18", y:0, z:0},
        {date:"2015-01-17", y:1, z:0},
        {date:"2015-01-16", y:2, z:1},
        {date:"2015-01-15", y:3, z:3},
        {date:"2015-01-14", y:6, z:3},
        {date:"2015-01-13", y:5, z:2},
        ];
        

        
               $('#acctregs').empty();
                                
                var acctregs1 = new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'acctregs1',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: acct_regs1,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'date',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['y','z'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value'],
                    dateFormat:function (x) { return new Date(x).toString().split("00:00:00")[0]; }
                });
                

                        
                setTimeout(charttest, 60000);

};

var Category_Wise_Incident_Summary = function () {
    
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Get_Category_Wise_Incident_Summary" 
    var dataString = ''
    var chart_json_string='';
    
    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        dataType: "json",
        cache: false,

        success: function(Category_Wise_Incident_Summary) //we're calling the response json array 'nwdevicestatus'

        {
            
            $.each(Category_Wise_Incident_Summary,function(i,Category_Wise_Incident_Summary) 
            {    
                                
                chart_json_string += '{"Category":"' + Category_Wise_Incident_Summary.Category_Description + '","Count":' + Category_Wise_Incident_Summary.Category_Count + '},'

            });
            
            
                    
            chart_json_string = '[' + chart_json_string.substring(0, chart_json_string.length - 1) + ']';
            
           // alert(chart_json_string);
            var acct_regs =  $.parseJSON(chart_json_string)
            
            //var jsonObj = $.parseJSON('[' + str + ']');
            
            //alert(chart_json_string);
            
                $('#acctregs').empty();
                                
                var acctregs = new Morris.Bar({
                    // ID of the element in which to draw the chart.
                    element: 'acctregs',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: acct_regs,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'Category',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['Count'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value'],
                   // dateFormat:function (x) { return new Date(x).toString().split("00:00:00")[0]; }
                });
                
                      
        } //end success

    }); //end AJAX
    
       setTimeout(Category_Wise_Incident_Summary, 60000);
   
};

var Day_Wise_Incident_Summary = function () {
    
    var post_url = "<?php echo site_url() ?>/HelpdeskController/Day_Wise_Incident_Summary" 
    var dataString = ''
    var chart_json_string='';
    
    $.ajax(
    {
        type: "POST",
        url: post_url,
        data: dataString,
        dataType: "json",
        cache: false,

        success: function(Day_Wise_Incident_Summary) //we're calling the response json array 'nwdevicestatus'

        {
            
            $.each(Day_Wise_Incident_Summary,function(i,Day_Wise_Incident_Summary) 
            {    
                                
                chart_json_string += '{"date":"' + Day_Wise_Incident_Summary.Logged_On_Date + '","count":' + Day_Wise_Incident_Summary.Day_Count + ',"count1":' + Day_Wise_Incident_Summary.Pending_Count + '},'

            });
                     
            chart_json_string = '[' + chart_json_string.substring(0, chart_json_string.length - 1) + ']';
            
           //alert(chart_json_string);
            var acct_regs =  $.parseJSON(chart_json_string)
            
            //var jsonObj = $.parseJSON('[' + str + ']');
            
            //alert(chart_json_string);
            
                $('#acctregs').empty();
                                
                var acctregs = new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'acctregs',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: acct_regs,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'date',
                    
                    xLabelAngle: 270,
                    
                    //lineWidth: 1,
                    
                    pointSize: 3,
                    
                    smooth: true,
                    
                    fillOpacity: 0,
                    
                    lineColors:['#3870C4','#FF6600'],
                    parseTime: false,
                    hideHover: false,
    
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['count','count1'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Logged','Pending'],
                    dateFormat:function (x) { return new Date(x).toString().split("00:00:00")[0]; }
                });
                
                      
        } //end success

    }); //end AJAX
    
       setTimeout(Day_Wise_Incident_Summary, 60000);
   
};

$(document).ready(function()
    {
       networkstatus();
       callstatussummary();
       pendingcalldetails();
       holdcalldetails();
       //charttest();
     //Category_Wise_Incident_Summary();
     //Day_Wise_Incident_Summary();
     //Network_Utilization();
       
    });
    


</script>
    
<!--    
    <script>
    
    var charttest = function () {
     
    var acct_regs = [
        {date:"2015-01-18", y:0},
        {date:"2015-01-17", y:1},
        {date:"2015-01-16", y:2},
        {date:"2015-01-15", y:3},
        {date:"2015-01-14", y:4},
        {date:"2015-01-13", y:5}
        ];
        

        
               $('#acctregs').empty();
                                
                var acctregs = new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'acctregs',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: acct_regs,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'date',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['y'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value'],
                    dateFormat:function (x) { return new Date(x).toString().split("00:00:00")[0]; }
                });
                

                        
                setTimeout(charttest, 60000);

};

   $(document).ready(function()
    {
       charttest();
       
    });
    
        </script>
        -->