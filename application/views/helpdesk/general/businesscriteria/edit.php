<!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>">Business Criteria</a></li>
        <li class="active">Update</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <?php

        //flash messages
        if($this->session->flashdata('flash_message')){

            if($this->session->flashdata('flash_message') == 'updated'){

                echo '<div class="alert alert-success" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                echo '<strong>Well done!</strong> ' . ucfirst('Business Criteria') . ' updated with success.';
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

      $attributes = array('class' => 'form-horizontal', 'id' => 'myform');
      echo form_open('helpdesk/general/businesscriteria/update/'.$this->uri->segment(5).'', $attributes);

    ?>              
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            
            <div class="col-md-12">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Updating</strong> Business Criteria</h3>
<!--                            <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>-->
                    </div>

                    <div class="panel-body">                                                                        

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Business Criteria ID</label>          
                            <div class="col-md-2 col-xs-12">
                                <input type="text" class="form-control" name="business_criteria_id" id="business_criteria_id" placeholder="Business Criteria ID" value="<?php echo $business_criteria[0]['business_criteria_id']; ?>"/>                          
                                <span class="help-block">Required</span>
                            </div>
                        </div>

                        <div class="form-group">                                        
                            <label class="col-md-3 col-xs-12 control-label">Description</label>          
                            <div class="col-md-3 col-xs-12">
                                <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $business_criteria[0]['business_criteria_description']; ?>"/>                                      
                                <span class="help-block">Required</span>
                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear</button>                                    
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>

                </div>

            </div>
            
        </div>     
        
    </div>
  
<?php echo form_close(); ?>

     <script type="text/javascript">

        var myform = $("#myform").validate({
            ignore: [],
            
            rules: {                                            
                    business_criteria_id: {
                            required: true,
                            number: true
                    },
                    description: {
                            required: true,
                            maxlength: 50
                    }
                }                                        
            });                                    

    </script>
    
    <!-- END SCRIPTS --> 