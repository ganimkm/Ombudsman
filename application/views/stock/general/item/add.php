    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>"><?php echo ucfirst($this->uri->segment(3));?></a></li>
        <li class="active">Add</li>
    </ul>
    <!-- END BREADCRUMB -->

     
    <?php
    //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE){
                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> new ' . ucfirst('Item') . ' created with success.';
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
      echo form_open('stock/general/item/add', $attributes);

    ?>              

   
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                <form class="form-horizontal">
                    
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Adding</strong> Item</h3>
<!--                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>-->
                        </div>

                        <div class="panel-body">                                                                        

                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Item ID</label>          
                                <div class="col-md-2 col-xs-12">
                                    <input type="text" class="form-control" name="item_id" id="item_id" placeholder="Item ID" value="<?php echo $item[0]['next_item_id']; ?>"/>                          
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Item Name</label>          
                                <div class="col-md-3 col-xs-12">
                                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" value="<?php echo set_value('item_name'); ?>"/>                                        
                                    <span class="help-block">Required</span>
                                </div>
                            </div>
                            
                            <div class="form-group">                                        
                                <label class="col-md-3 col-xs-12 control-label">Reorder Level Qty</label>          
                                <div class="col-md-1 col-xs-12">
                                    <input type="text" class="form-control" name="reorder_level_qty" id="reorder_level_qty" placeholder="Reorder Level" value="<?php echo set_value('reorder_level_qty'); ?>"/>                                        
                                    <span class="help-block">Required</span>
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
                    item_id: {
                            required: true,
                            number: true
                    },
                    item_name: {
                            required: true,
                            maxlength: 500
                    },
                    reorder_level_qty: {
                            required: true,
                             number: true
                    }
                }                                        
            });                                    

    </script>
        
    <!-- END SCRIPTS -->         
    

   