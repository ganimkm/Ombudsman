    <!-- START BREADCRUMB --> 
    
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li class="active">Assign Menu To User</li>
    </ul>
    <!-- END BREADCRUMB -->    

    <ul>
    <li><input type="checkbox" />All Menu Items
        
        <?php
        
            foreach($rootmenu as $row)
            {
                echo '<ul id="' .$row['Menu_ID']. '">';
                echo '<li><input type="checkbox" />'.$row['Description'].'</li>';
                echo '</ul>';

            }
        ?> 
        
    </li>  
    </ul>
    
    
    <ul>
        <li>
            <input type="checkbox" />Administration
            <ul>
                <li>
                    <input type="checkbox" />President
                    <ul id='11'>
                        <li>
                            <input type="checkbox" />Manager 1
                            <ul>
                                <li>
                                    <input type="checkbox" />Assistant Manager 1</li>
                                <li>
                                    <input type="checkbox" />Assistant Manager 2</li>
                                <li>
                                    <input type="checkbox" />Assistant Manager 3</li>
                            </ul>
                        </li>
                        <li>
                            <input type="checkbox" />Manager 2
                            <ul id='12'>
                                <li>
                                    <input type="checkbox" />Assistant Manager 1
                                    <ul>
                                <li>
                                    <input type="checkbox" />Assistant Manager 1</li>
                                <li>
                                    <input type="checkbox" />Assistant Manager 2</li>
                                <li>
                                    <input type="checkbox" />Assistant Manager 3</li>
                            </ul>
                                    
                                </li>
                                <li>
                                    <input type="checkbox" />Assistant Manager 2</li>
                                <li>
                                    <input type="checkbox" />Assistant Manager 3</li>
                            </ul>
                        </li>
                        <li>
                            <input type="checkbox" />Manager 3</li>
                    </ul>
                </li>
                <li>
                    <input type="checkbox" />Vice President
                    <ul>
                        <li>
                            <input type="checkbox" />Manager 4</li>
                        <li>
                            <input type="checkbox" />Manager 5</li>
                        <li>
                            <input type="checkbox" />Manager 6</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    
    <div id="wrapper">
        
        
        
    </div>

<script>
 
$(document).ready(function()
{  

    var post_url = "<?php echo site_url() ?>/AssignMenuController/Get_Menu_Items" 

    $.ajax(
    {
        type: "POST",
        url: post_url,
        cache: false,

        success: function(menuitems) //we're calling the response json array 'nwdowntime'

        {

    //                $('#masterdata').empty();
            $.each(menuitems,function(i,menuitems) 
            {     

               $('#' + menuitems.Menu_Group_ID).append('<ul id="' + menuitems.Menu_ID +  '"><li><input type="checkbox" name="' + menuitems.Menu_ID+menuitems.Menu_Description + '"/>' + menuitems.Menu_Description + '</li></ul>');

            });
        } //end success

    }); //end AJAX



    $('li :checkbox').on('click', function () {
        var $chk = $(this),
        $li = $chk.closest('li'),
        $ul, $parent;
        
        if ($li.has('ul')) {
            $li.find(':checkbox').not(this).prop('checked', this.checked)
        }
    
        do {
            $ul = $li.parent();
            $parent = $ul.siblings(':checkbox');
            if ($chk.is(':checked')) {
                $parent.prop('checked', $ul.has(':checkbox:not(:checked)').length == 0)
            } else {
                $parent.prop('checked', false)
            }
            $chk = $parent;
            $li = $chk.closest('li');
        } while ($ul.is(':not(.someclass)'));
        
    });
    
    
});

</script>
    
