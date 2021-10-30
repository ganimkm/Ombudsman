    

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url("general"); ?>">
                    <?php echo ucfirst($this->uri->segment(1));?>
                </a> 
            </li>
            <li>
                <a href="<?php echo site_url("general").'/'.$this->uri->segment(2); ?>">
                    Category
                </a>   
            </li>
            <li class="active">
                <a href="#">Update</a>
            </li>
        </ul>

        <div class="page-header">    
            <h3>Updating Category</h3>    
        </div>
            
    <?php
    
        //flash messages
        if($this->session->flashdata('flash_message')){
            
            if($this->session->flashdata('flash_message') == 'updated'){
                
                echo '<div class="alert alert-success">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Well done!</strong> product updated with success.';
                echo '</div>';  
                
            }else{
                
                echo '<div class="alert alert-error">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                echo '</div>';  
            
            }
            
        }
        
    ?>

    <?php

        $attributes = array('class' => 'form-horizontal', 'id' => '');
        //echo validation_errors();
        echo form_open('helpdesk/general/category/update/'.$this->uri->segment(5).'', $attributes);

    ?>

        <fieldset>

            <div class="form-group">
                <label for="inputError" class="control-label col-sm-2">Category ID</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="" name="category_id" placeholder="Category ID" value="<?php echo $category[0]['Category_ID']; ?>">
                    </div>
            </div>

            <div class="form-group">
                <label for="inputError" class="control-label col-sm-2">Description</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="" name="description" placeholder="Description" value="<?php echo $category[0]['Description']; ?>">
                    </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                    <button class="btn" type="reset">Cancel</button>
                </div>
            </div>

        </fieldset>
            
        <?php echo form_close(); ?>

    </div>
 
