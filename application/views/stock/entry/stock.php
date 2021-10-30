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
                        <h3 class="panel-title"><strong>Item Stock</strong></h3>                              
                    </div>
                    
                    <div class="panel-body">
                        <table class="table datatable">
                            <thead>   
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Current Stock</th>
                                    <th>Reorder Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($stock as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['item_id'].'</td>';
                                        echo '<td>'.$row['item_name'].'</td>';
                                        echo '<td>'.$row['item_stock'].'</td>';
                                        echo '<td>'.$row['reorder_level'].'</td>';
                                        echo '<td>

                                        <a href="'.site_url("stock/entry").'/inward/'.$row['item_id'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa fa-plus"></span>Item Inward</a>  
                                        <a href="'.site_url("stock/entry").'/issue/'.$row['item_id'].'" class="btn btn-danger btn-rounded btn-xs"><span class="fa fa fa-minus"></span>Item Issue</a>  
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