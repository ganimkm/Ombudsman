<!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
    </ul>
    <!-- END BREADCRUMB -->

    <div class="page-content-wrap">                
                
        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Issued Items</strong></h3>                              
                    </div>
                    
                    <div class="panel-body">
                        <table class="table datatable">
                            <thead>   
                                <tr>
                                    <th>Issue Number</th>
                                    <th>Issue Date</th>
                                    <th>Item Name</th>
                                    <th>Issue Qty</th>
                                    <th>Ref Details</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($issue_data as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['issue_number'].'</td>';
                                        echo '<td>'.$row['issue_date'].'</td>';
                                        echo '<td>'.$row['item_name'].'</td>';
                                        echo '<td>'.$row['issue_qty'].'</td>';
                                        echo '<td>'.$row['ref_number'].'</td>';
                                        echo '<td>
 
                                        <a href="'.site_url("stock/entry").'/issue/delete/'.$row['issue_number'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span>Delete Issue</a>
                                        </td>';
                                        echo '</tr>';
                                    }
                                ?>        
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                </div>
                
                <!-- END SIMPLE DATATABLE -->
            </div>
            
        </div>  
        
    </div>

<script>

    function confirmDialog() {
        return confirm("Are you sure you want to delete this record?")
    }
    
</script>