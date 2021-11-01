<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" id="theme" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" id="theme" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css"/>    

<!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active">Call Report</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <?php

      $attributes = array('class' => 'form-inline', 'id' => 'myform');
      echo form_open('helpdesk/analytics/callreport', $attributes);

    ?>
               
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="panel-heading">  
                    
                    <h3 class="panel-title"><strong>Call Report</strong></h3>
                    
                    <div class="pull-right">  
                        
                        <div class="form-group">
                            <label for="inputError" class="control-label">From Date :</label>
                            <input type="text" class="form-control datepicker" name="from_date" id="from_date" placeholder="From Date" value="<?php echo $from_date; ?>"/>       
                        </div>

                        <div class="form-group">
                            <label for="inputError" class="control-label">To Date :</label>
                            <input type="text" class="form-control datepicker" name="to_date" id="to_date" placeholder="To Date" value="<?php echo $to_date; ?>"/>       
                        </div>

                        <button class="btn btn-primary" onclick="return ValidateEndDate();">View Report <span class="fa fa-list fa-right"></span></button>

<!--                        <button class="btn btn-danger" onclick="exportexcel()"><i class="fa fa-file-excel-o"></i> Export Data</button>-->

                    </div>
                    
                </div>
                
                <div class="panel-body">

                    <div class="panel panel-default tabs">  

                        <ul class="nav nav-tabs" role="tablist">  
                            <li class="active"><a href="#calldetails" role="tab" data-toggle="tab">Details</a></li>    
                            <!--<li><a href="#callsummary" role="tab" data-toggle="tab">Summary</a></li>-->
                        </ul>

                        <div class="panel-body tab-content">

                            <div class="tab-pane active" id="calldetails">

                                <div class="row">

                                        <table id="calltable" class="table table-bordered calldetailsdata"  cellspacing="0" width="100%">

                                            <thead>  

                                                <tr>

                                                    <th width="5%">Incident #</th>
                                                    <th width="9%">Incident On</th>
                                                    <th width="9%">Respond On</th>
                                                    <th width="9%">Resolved On</th>
                                                    <th>User</th>
                                                    <th>Location</th>
                                                    <th>Department</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Request Type</th>
                                                    <th width="5%">Impact</th>
                                                    <th>Incident Description</th>
                                                    <th>Owner</th>
                                                    <th>Resolved Description</th>
                                                    <th>Status</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                
                                                <?php
                                                
                                                    foreach($incident as $row)
                                                        
                                                    {
                                                        echo '<tr>';
                                                        echo '<td>'.$row['incident_number'].'</td>';
                                                        echo '<td>'.$row['logged_on'].'</td>';
                                                        echo '<td>'.$row['respond_on'].'</td>';
                                                        echo '<td>'.$row['resolved_on'].'</td>';
                                                        echo '<td>'.$row['user_name'].'</td>';
                                                        echo '<td>'.$row['location_name'].'</td>';
                                                        echo '<td>'.$row['department_name'].'</td>';
                                                        echo '<td>'.$row['category_description'].'</td>';
                                                        echo '<td>'.$row['sub_category_description'].'</td>';
                                                        echo '<td>'.$row['request_type_description'].'</td>';
                                                        echo '<td>'.$row['impact_description'].'</td>';
                                                        echo '<td>'.$row['logged_description'].'</td>';
                                                        echo '<td>'.$row['assigned_to_user'].'</td>';                                                        
                                                        echo '<td>'.$row['resolved_description'].'</td>';
                                                        echo '<td>'.$row['on_status'].'</td>';
                                                        echo '</tr>';
                                                    }
                                                ?>   
                                                
                                            </tbody>

                                        </table>

                                    </div>

                            </div>

                            <div class="tab-pane" id="callsummary">

                               

                            </div>

                        </div>

                    </div>  
                        
                </div>    

            </div>
            
        </div>                    

    </div>
    <!-- END PAGE CONTENT WRAPPER --> 
    
    <script type="text/javascript">
        
    function ValidateEndDate() {
        
           var fromdate = $("#from_date").val();
           var todate = $("#to_date").val();
           
           if (fromdate != '' && todate !='') {
               if (Date.parse(fromdate) > Date.parse(todate)) {
                   alert("From date should not be greater than to date");
                   return false;
               }
           }          
       }
       
 $(document).ready(function() {
        $('#calltable').DataTable({
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },'copy','csv','excel','print']
        });
    });

        function exportexcel() { 
            
            $("#calltable").table2excel({  
                name: "Table2Excel",  
                filename: "callreport",  
                fileext: ".xls"  
            });  
            
        }  

    </script>

