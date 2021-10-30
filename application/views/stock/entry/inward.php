    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>"><?php echo ucfirst($this->uri->segment(3));?></a></li>
        <li class="active">Inward</li>
    </ul>
    <!-- END BREADCRUMB -->

     
    <?php
    //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE){
                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> new ' . ucfirst('Item Inward') . ' created with success.';
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
      echo form_open('stock/entry/inward/'.$this->uri->segment(4).'', $attributes);

    ?>              

   
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                <form class="form-horizontal">
                    
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><?php echo $item[0]['item_name']; ?></strong> Inward</h3>
                        </div>

                        <div class="panel-body">                                                                        

                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Item Inward #</label>          
                                <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" readonly name="inward_number" id="inward_number" placeholder="Inward #" value="<?php echo $inward[0]['next_inward_number']; ?>"/>                          
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label">Inward Date</label>  
                                 <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control datepicker" name="inward_date" id="inward_date" placeholder="Inward Date" value="<?php set_value('inward_date')?>"/>     
                                    <span class="help-block">Required</span>
                                </div> 
                                 <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="inward_time" id="inward_time" placeholder="Inward Time" value="<?php set_value('inward_time')?>"/>     
                                    <span class="help-block">Required</span>
                                </div> 
                            </div>
                           
                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Quantity</label>          
                                <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="inward_qty" id="inward_qty" placeholder="Inward Qty" value="<?php echo set_value('inward_qty'); ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">                                        
                                <label class="col-md-2 col-xs-12 control-label">Ref Details</label>          
                                <div class="col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="ref_number" id="ref_number" placeholder="like Invoice Number,PO number,Bill Number..." value="<?php echo set_value('ref_number'); ?>"/>                                        
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
                    inward_number: {
                            required: true,
                            number: true
                    },
                    inward_date: {
                            required: true,
                            maxlength: 500
                    },
                    inward_qty: {
                            required: true,
                            number: true
                    }
                }                                        
            });   
            
            $(document).ready(function()
                {

                    $("#inward_date").attr("value", "<?php echo @date("Y-m-d");?>");
                    $("#inward_time").attr("value", "<?php echo @date("H:i:s");?>");

                });

    </script>
        
    <!-- END SCRIPTS -->         
    

   