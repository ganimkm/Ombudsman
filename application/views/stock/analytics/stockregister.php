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
      echo form_open('stock/analytics/stockregister', $attributes);

    ?>
               
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="panel-heading">  
                    
                    <h3 class="panel-title"><strong>Stock Register</strong></h3>
                    
                    <div class="pull-right">  

                        <div class="form-group">
                            <label for="inputError" class="control-label">Item Name :</label>
                        </div>

                        <div class="form-group">
                            <select id="stock_item" name="stock_item" class="form-control select">
                            <?php if ($stock) { echo '<option value="' . $stock[0]['item_id'] . '">' . $stock[0]['item_name'] . '</option>'; } ?>
                                <option value="ALL">ALL</option>
                                <?php foreach($stock_item as $row) { echo '<option value="' . $row['item_id'] . '">' . $row['item_name'] . '</option>'; } ?>
                            </select>       
                        </div>
                        
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

                                                    <th>S.No</th>
                                                    <th width=15%>Item Name</th>
                                                    <th width=9%>Date</th>
                                                    <th width=4%>Inward Qty</th>  
                                                    <th width=4%>Issue Qty</th> 
                                                    <th width=4%>Balance Qty</th>                                                   
                                                    <th width=5%>Ref #</th>
                                                    <th>User</th>
                                                    <th>Location</th>
                                                    <th>Department</th>
                                                    <th width=9%>Incident On</th>
                                                    <th>Incident Description</th>
                                                    <th>Owner</th>                                                    
                                                    <th>Resolved Description</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                
                                                <?php

                                                    $open_qty=0;
                                                    $close_qty=0;
                                                    $inward_qty=0;
                                                    $issue_qty=0;
                                                    $item_id="";
                                                
                                                    foreach($stock as $row)                                                        
                                                    {

                                                        if($item_id != $row['item_id']){
                                                            $open_qty=0;
                                                            $close_qty=0;
                                                            $inward_qty=0;
                                                            $issue_qty=0;
                                                        }else{
                                                            $item_id=$row['item_id'];
                                                        }

                                                ?>
                                                        <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $row['serial_number'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['item_name'] ?></td>                                                        
                                                        
                                                        <?php 
                                                           
                                                            if($row['stock_type'] == 'OPEN'){

                                                                $open_qty=$row['item_qty'];

                                                                echo '<td colspan=3 style="text-align: center; font-weight:bold;vertical-align: middle;">Opening Balance</td>';
                                                                echo '<td style="text-align: center; font-weight:bold;vertical-align: middle;">'.$open_qty.'</td>';

                                                            }else if($row['stock_type'] == 'CLOSE'){

                                                                $close_qty=$row['item_qty'];

                                                                echo '<td colspan=3 style="text-align: center; font-weight:bold;vertical-align: middle;">Closing Balance</td>';
                                                                echo '<td style="text-align: center; font-weight:bold;vertical-align: middle;">'.$close_qty.'</td>';

                                                            }else if($row['stock_type'] == 'INWARD'){

                                                                $inward_qty=$row['item_qty'];

                                                                $open_qty = $open_qty + $inward_qty;

                                                                echo '<td style="vertical-align: middle;">'.$row['date_on'].'</td>';
                                                                echo '<td style="text-align: center; vertical-align: middle;">'.abs($row['item_qty']).'</td>';
                                                                echo '<td>&nbsp;</td>';
                                                                echo '<td style="text-align: center;vertical-align: middle;">'.$open_qty.'</td>';

                                                            }else if($row['stock_type'] == 'ISSUE'){

                                                                $issue_qty=$row['item_qty'];

                                                                $open_qty = $open_qty + $issue_qty;

                                                                echo '<td style="vertical-align: middle;">'.$row['date_on'].'</td>';                                                                
                                                                echo '<td>&nbsp;</td>';
                                                                echo '<td style="text-align: center; vertical-align: middle;">'.abs($row['item_qty']).'</td>';
                                                                echo '<td style="text-align: center;vertical-align: middle;">'.$open_qty.'</td>';

                                                            }else{

                                                                echo '<td style="vertical-align: middle;">'.$row['date_on'].'</td>';

                                                                if($row['item_qty'] > 0){

                                                                    echo '<td style="text-align: center; font-weight:bold;vertical-align: middle;">'.abs($row['item_qty']).'</td>';
                                                                    echo '<td>&nbsp;</td>';
                                                                    echo '<td>'.$row['item_qty'].'</td>';


                                                                }elseif($row['item_qty'] < 0){

                                                                    echo '<td>&nbsp;</td>';
                                                                    echo '<td style="text-align: center; vertical-align: middle;">'.abs($row['item_qty']).'</td>';
                                                                    echo '<td>'.$row['item_qty'].'</td>';


                                                                }
                                                            }
                                                           
                                                        ?>
                        
                                                        <td style="vertical-align: middle;"><?php echo $row['ref_number'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['user_name'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['location_name'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['department_name'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['logged_on'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['actual_description'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['engineer_name'] ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['resolved_description'] ?></td>
                                                <?php  
                                                
                                                    $item_id=$row['item_id'];

                                                    }
                                                ?>   
                                                
                                            </tbody>

                                        </table>

                                    </div>

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

