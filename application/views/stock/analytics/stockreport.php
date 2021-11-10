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
        <li class="active">Stock Report</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <?php

      $attributes = array('class' => 'form-inline', 'id' => 'myform');
      echo form_open('stock/analytics/stockreport', $attributes);

    ?>
               
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="panel-heading">  
                    
                    <h3 class="panel-title"><strong>Stock Report</strong></h3>
                    
                    <div class="pull-right">  

                        <button class="btn btn-primary" onclick="return ValidateEndDate();">View Report <span class="fa fa-list fa-right"></span></button>

                    </div>
                    
                </div>
                
                <div class="panel-body">

                    <div class="panel panel-default tabs">  

                        <ul class="nav nav-tabs" role="tablist">  
                            <li class="active"><a href="#stockreports" role="tab" data-toggle="tab">Details</a></li>    
                            <!--<li><a href="#callsummary" role="tab" data-toggle="tab">Summary</a></li>-->
                        </ul>

                        <div class="panel-body tab-content">

                            <div class="tab-pane active" id="stockreports">

                                <div class="row">

                                        <table id="stocktable" class="table table-bordered stockreportsdata"  cellspacing="0" width="100%">

                                            <thead>  

                                                <tr>

                                                    <th style="text-align: center; vertical-align: middle;" width=4%>S.No</th>
                                                    <th style="text-align: center; vertical-align: middle;" width=15%>Item Name</th>
                                                    <th style="text-align: center; vertical-align: middle;" width=5%>Current Stock</th>    
                                                    <th style="text-align: center; vertical-align: middle;" width=5%>Reorder Level</th>                                                  
                                                </tr>

                                            </thead>

                                            <tbody>
                                                
                                                <?php

                                                
                                                    $rownum=0;

                                                    foreach($stock as $row)   
                                                   
                                                    {

                                                ?>
                                                    <tr>

                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $rownum+1 ?></td>
                                                        <td style="vertical-align: middle;"><?php echo $row['item_name'] ?></td>  
                                                        <td style="vertical-align: middle;"><?php echo $row['item_stock'] ?></td>        
                                                        <td style="vertical-align: middle;"><?php echo $row['reorder_level'] ?></td>                                                                                                              

                                                    </tr>

                                                <?php  

                                                    $rownum+=1;
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
            
        $(document).ready(function() {
                $('#stocktable').DataTable({
                    "pageLength": 200,
                    "ordering": false,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdf',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: 'Data export'
                    },'copy','csv','excel','print']
                });
            });

    </script>

