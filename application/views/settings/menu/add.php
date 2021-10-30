    

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url("tools"); ?>">
                    <?php echo ucfirst($this->uri->segment(1));?>
                </a> 
            </li>
            <li>
                <a href="<?php echo site_url("tools").'/'.$this->uri->segment(2); ?>">
                    Menu
                </a>   
            </li>
            <li class="active">
                <a href="#">New</a>
            </li>
        </ul>

        <div class="page-header">    
            <h3>Adding Menu</h3>    
        </div>

        <?php
        //flash messages
            if(isset($flash_message)){
                if($flash_message == TRUE){
                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo '<strong>Well done!</strong> new ' . ucfirst('Menu') . ' created with success.';
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
          echo form_open('tools/menu/add', $attributes);
      
      ?>
      
        <fieldset>
            
            <div class="form-group">
                <label for="inputError" class="control-label col-sm-2">Menu ID</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Menu ID" value="<?php echo $menu[0]['Next_Menu_ID']; ?>">
                    </div>
            </div>
            
            <div class="form-group">
                <label for="inputError" class="control-label col-sm-2">Description</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo set_value('description'); ?>">
                    </div>
            </div>
            
            <div class="form-group">
                <label for="inputError" class="control-label col-sm-2">Menu Group</label>
                    <div class="col-sm-2">
                        <select id="menu_group" name="menu_group" class="form-control">
                            <option value="">Select</option>
                            <?php foreach($menu_group as $row) { echo '<option value="' . $row['Menu_Group_ID'] . '">' . $row['Description'] . '</option>'; } ?>
                        </select>
                    </div>
            </div>
            
            <div class="form-group">
                <label for="inputError" class="control-label col-sm-2">Page Link</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="page_link" name="page_link" placeholder="Page Link" value="<?php echo set_value('page_link'); ?>">
                    </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn" type="reset">Cancel</button>
                </div>
            </div>
            
        </fieldset>
 
        
      <?php echo form_close(); ?>

    </div> 

<script>
    $("#description").val("");
</script>