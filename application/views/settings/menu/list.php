    
        
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
        </ul>
        
        <div class="page-header users-header">
            <h3>
                Menu
                <a  href="<?php echo site_url("tools").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
            </h3>
        </div>
        
        <table id="masterlist" class="table table-striped table-responsive table-hover small " cellspacing="0" width="100%">
        
            <thead>   
                <tr>
                    <th>Menu ID</th>
                    <th>Description</th>
                    <th>Menu Group</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($menu as $row)
                    {
                        echo '<tr>';
                        echo '<td>'.$row['Menu_ID'].'</td>';
                        echo '<td>'.$row['Description'].'</td>';
                        echo '<td>'.$row['Menu_Group_ID'].'</td>';
                        echo '<td>
                            
                        <a href="'.site_url("tools").'/menu/update/'.$row['Menu_ID'].'" class="btn btn-primary btn-rounded btn-xs"><span class="fa fa-pencil"></span></a>  
                        <a href="'.site_url("tools").'/menu/delete/'.$row['Menu_ID'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span></a>
                        </td>';
                        echo '</tr>';
                    }
                ?>      
            </tbody>
            
        </table>
        
    </div>

<script>
    
$(document).ready(function() {
    var table = $('#masterlist').DataTable({"sScrollX": "100%"});
    var tt = new $.fn.dataTable.TableTools( table );
 
    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
} );

function confirmDialog() {
    return confirm("Are you sure you want to delete this record?")
}
</script>