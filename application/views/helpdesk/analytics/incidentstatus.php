    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active">Router Traffic</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <?php

      $attributes = array('class' => 'form-inline', 'id' => 'masterform');
      echo form_open('callreport/callstatus', $attributes);

    ?>
    
    <!-- PAGE CONTENT WRAPPER -->
    
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Incident</strong> Status</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        </ul>
                    </div>

                    <div class="panel-body">



                    </div>

                </div>     
         
            </div>
            
        </div>
            
    </div>     

    <!-- PAGE CONTENT WRAPPER -->
    
    
<!--<div class="btn-group btn-breadcrumb">
    <a href="#" class="btn btn-default">&nbsp;<span class="glyphicon glyphicon-home"></span></i></a>
    <a href="#" class="btn btn-default">Helpdesk Report</a>
    <a href="<?php echo site_url("callreport").'/'.$this->uri->segment(2); ?>" class="btn btn-default">Call Status</a>
</div>

<div class="page-header users-header">
    <h4>
        Call Status
    </h4>
</div>

<?php

  $attributes = array('class' => 'form-inline', 'id' => 'masterform');
  echo form_open('callreport/callstatus', $attributes);

?>

<fieldset>

    <div class="well">    

        <div class="form-group">
            <label for="inputError" class="control-label">From Date</label>
            <input type="text" class="form-control" id="from_date" name="from_date" placeholder="From Date" <?php if (isset($_POST['from_date'])) echo 'value="'.$_POST['from_date'].'"';?>  >               
        </div>

        <div class="form-group">
            <label for="inputError" class="control-label">To Date</label>
            <input type="text" class="form-control" id="to_date" name="to_date" placeholder="To Date" <?php if (isset($_POST['to_date'])) echo 'value="'.$_POST['to_date'].'"';?> > 
        </div>

        <div class="form-group">
            <label for="inputError" class="control-label" class="form-control">Call Status</label>
            <select id="call_status" class="form-control">
                <option value='Pending' selected>Pending</option> 
                <option value='Resolved'>Resolved</option>
                <option value='Hold'>Hold</option>
                <option value='All'>All</option>
            </select>
        </div>

   </div>

</fieldset>

<table id="masterlist" class="table table-striped table-responsive table-hover small " cellspacing="0" width="100%">

    <thead>   
        <tr>
            <th>Incident #</th>
            <th>Date</th>
            <th>Time</th>
            <th>Description</th>
            <th>User Name</th>
            <th>Respond On Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>Department</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Impact</th>                  
            <th>Owner</th>              
        </tr>
    </thead>

    <tbody id="masterdata">
        <?php
            foreach($incident as $row)
            {
                echo '<tr>';
                echo '<td>'.$row['Incident_Number'].'</td>';
                echo '<td>'.$row['Logged_On_Date'].'</td>';
                echo '<td>'.$row['Logged_On_Time'].'</td>';
                echo '<td>'.$row['Logged_Description'].'</td>';  
                echo '<td>'.$row['User_Name'].'</td>';
                echo '<td>'.$row['Respond_On_Date'].'</td>';
                echo '<td>'.$row['Respond_On_Time'].'</td>';                        
                echo '<td>'.$row['Location_Description'].'</td>';
                echo '<td>'.$row['Department_Description'].'</td>';
                echo '<td>'.$row['Category_Description'].'</td>';
                echo '<td>'.$row['Sub_Category_Description'].'</td>';
                echo '<td>'.$row['Impact_Description'].'</td>'; 
                echo '<td>'.$row['Assigned_To_User'].'</td>';                          
                echo '</tr>';
            }
        ?>      
    </tbody>

</table>

<script>

$(function () {

    $('#call_status').change(function(){

        var fromdate = document.getElementById("from_date").value;
        var todate = document.getElementById("to_date").value;
        var callstatus = document.getElementById("call_status").value;

        var post_url = "<?php echo site_url() ?>/HelpdeskReportController/Get_Incidents" 
        var dataString = 'from_date=' + fromdate + '&to_date=' + todate + '&call_status=' + callstatus

        //alert(callstatus);

        if(fromdate != "" && todate != ""){
            if(Date.parse(fromdate) > Date.parse(todate)){
                alert("To Date Must be greater than From Date");
                exit();
            }
        } 

        $.ajax(
        {
            type: "POST",
            url: post_url,
            data: dataString,
            cache: false,

            success: function(getincidents) //we're calling the response json array 'nwdowntime'

            {
                $('#masterdata').empty();
                $.each(getincidents,function(i,getincidents) 
                {     

                    //alert("hai");
                    var row = $('<tr />'); // here we're creating a new select option for each group
                    $("#masterlist").append(row)
                    row.append($("<td>" + getincidents.Incident_Number + "</td>"));
                    row.append($("<td>" + getincidents.Logged_On_Date + "</td>"));
                    row.append($("<td>" + getincidents.Logged_On_Time + "</td>"));
                    row.append($("<td>" + getincidents.Logged_Description + "</td>"));
                    row.append($("<td>" + getincidents.User_Name + "</td>"));
                    row.append($("<td>" + getincidents.Respond_On_Date + "</td>"));
                    row.append($("<td>" + getincidents.Respond_On_Time + "</td>"));
                    row.append($("<td>" + getincidents.Location_Description + "</td>"));
                    row.append($("<td>" + getincidents.Department_Description + "</td>"));
                    row.append($("<td>" + getincidents.Category_Description + "</td>"));
                    row.append($("<td>" + getincidents.Sub_Category_Description + "</td>"));
                    row.append($("<td>" + getincidents.Impact_Description + "</td>"));
                    row.append($("<td>" + getincidents.Assigned_To_User + "</td>"));
                });
            } //end success

        }); //end AJAX

    });

});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$(function() {
$( "#from_date" ).datepicker({
        inline: true,
        showOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy/mm/dd',
    })
.datepicker('widget').wrap('<div class="ll-skin-latoja"/>');
});

$(function() {
$( "#to_date" ).datepicker({
        inline: true,
        showOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy/mm/dd'
   })
.datepicker('widget').wrap('<div class="ll-skin-latoja"/>');
});

$(document).ready(function()
{

//        $("#from_date").attr("value", "<?php echo date('Y/m/d', strtotime(' -1 day')) ?>");
//        $("#to_date").attr("value", "<?php echo date("Y/m/d")?>");

});

</script>-->