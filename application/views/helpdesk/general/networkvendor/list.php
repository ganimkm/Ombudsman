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
                        <h3 class="panel-title"><strong>Network Vendor</strong></h3>
                        <a  href="<?php echo site_url("helpdesk").'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>/add" class="btn btn-success btn-rounded pull-right"><span class="fa fa-plus"></span>Add a new</a>                                
                    </div>
                    
                    <div class="panel-body">
                        <table class="table datatable">
                            <thead>   
                                <tr>
                                    <th>Network Vendor ID</th>
                                    <th>Link</th>
                                    <th>Account Number</th>
                                    <th>Call Logging Detail</th>
                                    <th>Band Width</th>
                                    <th>Esclation</th>
                                    <th>Vendor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($networkvendor as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['id'].'</td>';
                                        echo '<td>'.$row['link'].'</td>';
                                        echo '<td>'.$row['account_number'].'</td>';
                                        echo '<td>'.$row['call_logging_detail'].'</td>';
                                        echo '<td>'.$row['band_width'].'</td>';
                                        
                                        if ($row['docs']){
                                            echo '<td><a href="'.site_url() . $row['docs'].'" target=_blank class="btn btn-info btn-xs">Esclation</a></td>';
                                        }else{
                                             echo '<td></td>';
                                        }
                                        
                                        echo '<td>'.$row['vendor'].'</td>';
                                        echo '<td>

                                        <a href="'.site_url("helpdesk/general").'/networkvendor/update/'.$row['id'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-pencil"></span></a>  
                                        <a href="'.site_url("helpdesk/general").'/networkvendor/delete/'.$row['id'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span></a>
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