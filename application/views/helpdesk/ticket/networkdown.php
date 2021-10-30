   <!-- START BREADCRUMB -->     
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url($this->uri->segment(1)).'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active">Network Down</li>
    </ul>
    <!-- END BREADCRUMB -->

    <div class="page-content-wrap">                
                
        <div class="row">
            <div class="col-md-12">

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    
                    <div class="panel-heading">                                
                        <h3 class="panel-title"><strong>Network Down</strong> Incidents</h3>
                        <button id="ignore" class="btn btn-danger btn-rounded pull-right"><span class="fa fa-check-square-o"></span>Ignore Selected</button>
                    </div>
                    
                    <div class="panel-body">
                        
                        <table class="table datatable_scrollbar">
                            
                            <thead>  
                                
                                <tr>
                                    
                                    <th>Incident Ref #</th>
                                    <th>Incident Date</th>
                                    <th>Description</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Incident Type</th>                                    
                                    <th>Actions</th>
                                    
                                    <th><input type="checkbox" id="checkall" title="Select all" onClick="CheckAll(this)"/></th>
                                    
                                </tr>
                                
                            </thead>

                            <tbody>
                                
                                <?php
                                
                                    foreach($networkdown_incidents as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td><a href="#" id="'.$row['incident_ref_number'].'" class="show">'.$row['incident_ref_number'].'</a></td>';

                                        echo '<td>'.$row['incident_date'].'</td>';
                                        echo '<td>'.$row['incident_description'].'</td>';
                                        echo '<td>'.$row['start_time'].'</td>';
                                        echo '<td>'.$row['end_time'].'</td>';
                                        echo '<td>'.$row['incident_type_description'].'</td>';

                                        echo '<td>           
                                             <a href="'.site_url("helpdesk").'/ticket/networkdownlog/'.$row['incident_ref_number'].'" class="btn btn-success btn-rounded btn-xs"><span class="fa fa-ticket"></span>Convert</a>
                                             <!--<a href="'.site_url("helpdesk").'/ticket/networkdownignore/'.$row['incident_ref_number'].'" class="btn btn-danger btn-rounded btn-xs" onclick="return confirmDialog();"><span class="fa fa-times"></span>Ignore</a>-->                                                 
                                             </td>';

                                        echo '<td><input type="checkbox" name="incident_ref_number" value="'.$row['incident_ref_number'].'"></td>';
                                        
                                        echo '</tr>';
                                        
                                    }
                                    
                                ?>    
    
                            </tbody>
                            
                        </table>
                        
                    </div>
                    
                    <!-- Modal -->
                    <div id="modal-content" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Incident</h4>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <p></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                </div>

            </div>
            
        </div>  
        
    </div>

<script language="JavaScript">
    
function CheckAll(source) {
    
  checkboxes = document.getElementsByName('incident_ref_number');
  
  for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
  }
  
}

$(function(){
    
    $('#ignore').click(function(){

        var selected_incident_ref_numbers ="" ;

        $("input:checkbox[name=incident_ref_number]:checked").each(function () {
            //alert($(this).val());
            selected_incident_ref_numbers += ($(this).val()) + ","
        });
      
       if (selected_incident_ref_numbers == ''){
            alert("Select the Netwok Down Incident(s) to ignore");
            exit();
        }
            
        selected_incident_ref_numbers =  selected_incident_ref_numbers.substring(0, selected_incident_ref_numbers.length - 1);

       //alert(selected_incident_ref_numbers);
       
        var post_url = "<?php echo site_url() ?>/helpdesk/ticket/IncidentController/ignore_netwok_down" 
        var dataString = 'incident_ref_numbers=' + selected_incident_ref_numbers  

            $.ajax(
            {
                type: "POST",
                url: post_url,
                data: dataString,
                cache: false,

                success: function(ignoreincident) //we're calling the response json array 'nwdowntime'

                {
                   window.location.reload(true);
                } //end success

            }); //end AJAX     

        });
 
    });
    

    function confirmDialog() {
        return confirm("Are you sure you want to ignore this incident?")
    }

</script>