<?php
/* Smarty version 4.3.1, created on 2024-12-23 19:26:26
  from 'F:\xampp\htdocs\radius\ui\themes\nova\recharge.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67698f326d5e03_39563632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd70521f6b0fbc8a11424715381fb918c33f0196' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\recharge.tpl',
      1 => 1717845236,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_67698f326d5e03_39563632 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Activate Account');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
            <div class="panel-body">
            
            
            
            
            
            
            
            <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
prepaid/recharge-post">
    <div class="form-group">
          <label class="col-md-2 control-label"><?php echo Lang::T('Select Account');?>
</label>
        <div class="col-md-6">
            <select <?php if ($_smarty_tpl->tpl_vars['cust']->value) {
} else { ?> id="personSelect" <?php }?> class="form-control select2" name="id_customer" style="width: 100%" data-placeholder="<?php echo Lang::T('Select Customer');?>
...">
                <?php if ($_smarty_tpl->tpl_vars['cust']->value) {?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['cust']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['cust']->value['username'];?>
 &bull; <?php echo $_smarty_tpl->tpl_vars['cust']->value['fullname'];?>
 &bull; <?php echo $_smarty_tpl->tpl_vars['cust']->value['email'];?>
</option>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Type');?>
</label>
        <div class="col-md-6">
            <label><input type="radio" id="Hot" name="type" value="Hotspot"> <?php echo Lang::T('Hotspot Plans');?>
</label>
            <label><input type="radio" id="POE" name="type" value="PPPOE"> <?php echo Lang::T('PPPoE Plans');?>
</label>
            <label><input type="radio" id="Static" name="type" value="Static"> <?php echo Lang::T('Static Ip Plans');?>
</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo Lang::T('Routers');?>
</label>
        <div class="col-md-6">
            <select id="server" name="server" class="form-control select2" >
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['router']->value->id == $_smarty_tpl->tpl_vars['cust']->value['router_id']) {?>
                <option value='<?php echo $_smarty_tpl->tpl_vars['router']->value->id;?>
' selected><?php echo $_smarty_tpl->tpl_vars['router']->value->name;?>
</option>
                <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
    </div>

    <div class="form-group">
              <label class="col-md-2 control-label"><?php echo Lang::T('Service Plan');?>
</label>
        <div class="col-md-6">
            <select id="plan" name="plan" class="form-control select2">
                
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['r']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                
                <?php echo $_smarty_tpl->tpl_vars['router']->value->id;?>

                
                <?php if ($_smarty_tpl->tpl_vars['router']->value->id == $_smarty_tpl->tpl_vars['cust']->value['router_id']) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['p']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['plan']->value->routers == $_smarty_tpl->tpl_vars['router']->value->name) {?>
                <option class="plan-option" data-type="<?php echo $_smarty_tpl->tpl_vars['plan']->value->type;?>
" value='<?php echo $_smarty_tpl->tpl_vars['plan']->value->id;?>
'><?php echo $_smarty_tpl->tpl_vars['plan']->value->name_plan;?>
</option>
                <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
    </div>
     
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
									<button class="btn btn-success" type="submit"><?php echo Lang::T('Recharge Now');?>
</button>
       Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list"><?php echo Lang::T('Cancel');?>
</a>
        </div>
    </div>
</form></div>
  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {
    // Store original options
    var originalOptions = $('#plan').html();
    
    $('input[type="radio"]').change(function() {
        var selectedType = $(this).val();
        
        // Restore original options
        $('#plan').html(originalOptions);
        
        // Filter options based on selected type
        $('#plan option').each(function() {
            if ($(this).data('type') !== selectedType) {
                $(this).remove();
            }
        });
    });
});
<?php echo '</script'; ?>
>


            
          
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
document.addEventListener("DOMContentLoaded", function() {
    
    // Correctly wrapped JavaScript code
    
    // Initialize Select2 elements
    $('.select2').select2({theme: "bootstrap"});
    
    $('#personSelect').change(function(){
      var customerId = $(this).val();
      
       fetch('<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/findme&router='+customerId)
            .then(response => response.json())
            .then(data => {
                  
                // Assuming the response contains an object with router details
                // Clear existing options in the router dropdown
                // var routerSelect = document.getElementById('server');
                // routerSelect.innerHTML = ''; // Remove existing options
                $('#server').empty();
                // Add an option for the router returned by the AJAX request
                if(data.router_id && data.router_name) {
                    console.log(data.router_name);
                    // var option = new Option(data.router_name, data.router_id, true, true);
                    // routerSelect.add(option);
                    
                    $('#server').append($('<option>', {
                        value: data.router_id,
                        text: data.router_name
                    }));
                    
                } else {
                    // Handle case where no router is found or customer has no specific router
                    routerSelect.add(new Option('No router available', '', true, true));
                }
                      $('#server').trigger('change.select2');
                      $('#server').val(data.router_id);
                // Refresh the Select2 dropdown to display the new option
                // $('#server').select2({theme: "bootstrap"});
            })
            .catch(error => {
                console.error('Error fetching router data:', error);
            });
    });
    // });
    // Event listener for customer selection change
    // document.getElementById('personSelect').addEventListener('change', function() {
        
    //     console.log('dfdfdf');
        
    //     var customerId = this.value; // Get the selected customer ID
 
    //     // Make an AJAX request to fetch the router for the selected customer
    //     fetch('<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
fetch-router-for-customer?id_customer=' + encodeURIComponent(customerId))
    //         .then(response => response.json())
    //         .then(data => {
                
    //             // Assuming the response contains an object with router details
    //             // Clear existing options in the router dropdown
    //             var routerSelect = document.getElementById('server');
    //             routerSelect.innerHTML = ''; // Remove existing options
                
    //             // Add an option for the router returned by the AJAX request
    //             if(data.router_id && data.router_name) {
    //                 var option = new Option(data.router_name, data.router_id, true, true);
    //                 routerSelect.add(option);
    //             } else {
    //                 // Handle case where no router is found or customer has no specific router
    //                 routerSelect.add(new Option('No router available', '', true, true));
    //             }

    //             // Refresh the Select2 dropdown to display the new option
    //             $('#server').select2({theme: "bootstrap"});
    //         })
    //         .catch(error => {
    //             console.error('Error fetching router data:', error);
    //         });
    // });
    
});
<?php echo '</script'; ?>
>



// <?php echo '<script'; ?>
>
// // Disable user interaction with the select element
// document.getElementById('server').addEventListener('mousedown', function(event) {
//     event.preventDefault();
// });
// <?php echo '</script'; ?>
>



<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Tutorial Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/M91aZf1wrEw?si=H-5RTIizizTbRurt" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
