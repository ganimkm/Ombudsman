    <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>">Business Criteria</a></li>
        <li class="active">Add</li>
    </ul>
    <!-- END BREADCRUMB -->

    <?php
    //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE){
                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> new ' . ucfirst('Business Criteria') . ' created with success.';
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
      echo form_open('helpdesk/general/businesscriteria/add', $attributes);

    ?>              

   
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">
                
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Adding</strong> Business Criteria</h3>
<!--                            <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>-->
                    </div>

                    <div class="panel-body">                                                                        

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Business Criteria ID</label>          
                            <div class="col-md-2 col-xs-12">
                                <input type="text" class="form-control" name="business_criteria_id" id="business_criteria_id" placeholder="Business Criteria ID" value="<?php echo $business_criteria[0]['next_business_criteria_id']; ?>"/>                          
                                <span class="help-block">Required</span>
                            </div>
                        </div>

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Description</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="text" class="form-control" name="business_criteria_description" id="business_criteria_description" placeholder="Description" value="<?php echo set_value('description'); ?>"/>                                        
                                <span class="help-block">Required</span>
                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear</button>                                    
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                </div>

            </div>
            
        </div>     
        
    </div>
    <!-- PAGE CONTENT WRAPPER -->
    
    <?php echo form_close(); ?>

    <script type="text/javascript">

        var myform = $("#myform").validate({
            ignore: [],
            
            rules: {                                            
                    business_criteria_id: {
                            required: true,
                            number: true
                    },
                    business_criteria_description: {
                            required: true,
                            maxlength: 50
                    }
                }                                        
            });                                    

    </script>
        
    <!-- END SCRIPTS -->         
    

   