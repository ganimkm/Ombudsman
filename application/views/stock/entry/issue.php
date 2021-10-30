    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>"><?php echo ucfirst($this->uri->segment(3));?></a></li>
        <li class="active">Issue</li>
    </ul>
    <!-- END BREADCRUMB -->

     
    <?php
    //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE){
                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> new ' . ucfirst('Item Issue') . ' created with success.';
                echo '</div>';       
            }else{
                echo '<div class="alert alert-danger" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                echo '</div>';          
            }
        }
    ?>
    
    <?php

      $attributes = array('id' => 'myform','class' => 'form-horizontal');
      echo form_open('stock/entry/issue/'.$this->uri->segment(4).'', $attributes);

    ?>              

   
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                <form class="form-horizontal">
                    
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><?php echo $item[0]['item_name']; ?></strong> Issue</h3>
                        </div>

                        <div class="panel-body">                                                                        

                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Item Issue #</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" readonly name="issue_number" id="issue_number" placeholder="Issue #" value="<?php echo $issue[0]['next_issue_number']; ?>"/>                          
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label">Issue Date</label>  
                                 <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control datepicker" name="issue_date" id="issue_date" placeholder="Issue Date" value="<?php set_value('issue_date')?>"/>     
                                    <span class="help-block">Required</span>
                                </div> 
                                 <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="issue_time" id="issue_time" placeholder="Issue Time" value="<?php set_value('issue_time')?>"/>     
                                    <span class="help-block">Required</span>
                                </div> 
                            </div>
                           
                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Quantity</label>          
                                <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="issue_qty" id="issue_qty" placeholder="Issue Qty" value="<?php echo set_value('issue_qty'); ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                                
                                 <?php
                                    if ($this->session->flashdata('err_message') != '') {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                                        echo '<strong>Oh snap!</strong> ' . $this->session->flashdata('err_message');
                                        echo '</div>';              
                                    }
                                ?> 
                                
                            </div>
   
                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Ref Details</label>          
                                <div class="col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="ref_number" id="ref_number" placeholder="like Ticket Number..." value="<?php echo set_value('ref_number'); ?>"/>                                        
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="panel-footer">
                            <button class="btn btn-default" type="reset">Clear</button>                                    
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                        
                    </div>
                    
                </form>

            </div>
            
        </div>     
        
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    
    <?php echo form_close(); ?>

    <script type="text/javascript">

        var myform = $("#myform").validate({
            ignore: [],
            
            rules: {                                            
                    issue_number: {
                            required: true,
                            number: true
                    },
                    issue_date: {
                            required: true,
                            maxlength: 500
                    },
                    issue_qty: {
                            required: true,
                            number: true
                    }
                }                                        
            });   
            
            $(document).ready(function()
                {
                    $("#issue_date").attr("value", "<?php echo @date("Y-m-d");?>");
                    $("#issue_time").attr("value", "<?php echo @date("H:i:s");?>");

                });

    </script>
        
    <!-- END SCRIPTS -->         
    

   