<?php
/* Smarty version 4.3.1, created on 2025-01-08 19:40:18
  from 'F:\xampp\htdocs\radius\ui\themes\nova\customers-edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677eaa726243a4_15613950',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e7febe598642da8d28d1d944f483c666d697374' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\customers-edit.tpl',
      1 => 1718663340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677eaa726243a4_15613950 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo Lang::T('Edit Contact');?>
</span>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal" style="margin-left: auto;">
                        <?php echo Lang::T('Need Help?');?>

                    </button>
                </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit-post">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Username');?>
</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {?>
                                <span class="input-group-addon" id="basic-addon1">+</span>
                                <?php } else { ?>
                                <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <?php }?>
                                <input type="text" class="form-control" name="username" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
" required placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];
}?> <?php echo Lang::T('Phone Number');?>
">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Full Name');?>
</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['fullname'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Email');?>
</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['email'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Phone Number');?>
</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {?>
                                <span class="input-group-addon" id="basic-addon1">+</span>
                                <?php } else { ?>
                                <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <?php }?>
                                <input type="text" class="form-control" name="phonenumber" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['phonenumber'];?>
" placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];
}?> <?php echo Lang::T('Phone Number');?>
">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Address');?>
</label>
                        <div class="col-md-8">
                            <textarea name="address" id="address" class="form-control"><?php echo $_smarty_tpl->tpl_vars['d']->value['address'];?>
</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Coordinates');?>
</label>
                        <div class="col-md-8">
                            <input name="coordinates" id="coordinates" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['coordinates'];?>
" placeholder="6.465422, 3.406448">
                            <div id="map" style="width: 100%; height: 200px; min-height: 150px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Password');?>
</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" autocomplete="off" class="form-control" id="password" name="password" onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['password'];?>
">
                            </div>
                            <span class="help-block"><?php echo Lang::T('Keep Blank to do not change Password');?>
</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('PPPOE Password');?>
</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" autocomplete="off" class="form-control" id="pppoe_password" name="pppoe_password" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['pppoe_password'];?>
" onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'">
                            </div>
                            <span class="help-block"><?php echo Lang::T('User Cannot change this, only admin. if it Empty it will use user password');?>
</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">IP Address</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="Enter IP Address" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['ip_address'];?>
">
                        </div>
                    </div>
                                      <!-- SMS Group Selection -->
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('SMS Group');?>
</label>
                        <div class="col-md-8">
                            <select class="form-control" id="sms_group_id" name="sms_group_id">
                                <option value=""><?php echo Lang::T('Select SMS Group (optional)');?>
</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sms_groups']->value, 'group');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo Lang::T('Service Type');?>
</label>
                        <div class="col-md-8">
                            <select class="form-control" id="service_type" name="service_type">
                                <option value="Hotspot" <?php if ($_smarty_tpl->tpl_vars['d']->value['service_type'] == 'Hotspot') {?>selected<?php }?>>Hotspot</option>
                                <option value="PPPoE" <?php if ($_smarty_tpl->tpl_vars['d']->value['service_type'] == 'PPPoE') {?>selected<?php }?>>PPPoE</option>
                                <option value="Static" <?php if ($_smarty_tpl->tpl_vars['d']->value['service_type'] == 'Static') {?>selected<?php }?>>Static</option>
                                <option value="Others" <?php if ($_smarty_tpl->tpl_vars['d']->value['service_type'] == 'Others') {?>selected<?php }?>>Others</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Router</label>
                        <div class="col-md-8">
                            <select class="form-control" id="router_id" name="router_id">
                                <option value="">Select Router (optional)</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'router');
$_smarty_tpl->tpl_vars['router']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['router']->value) {
$_smarty_tpl->tpl_vars['router']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['router']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['router']->value['id'] == $_smarty_tpl->tpl_vars['d']->value['router_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['router']->value['name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-primary panel-hovered panel-stacked mb30">
            <div class="panel-heading"><?php echo Lang::T('Attributes');?>
</div>
            <div class="panel-body">
                <!--Customers Attributes edit start -->
                <?php if ($_smarty_tpl->tpl_vars['customFields']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customFields']->value, 'customField');
$_smarty_tpl->tpl_vars['customField']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customField']->value) {
$_smarty_tpl->tpl_vars['customField']->do_else = false;
?>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="<?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="custom_fields[<?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
]" id="<?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['customField']->value['field_value'];?>
">
                            </div>
                            <label class="col-md-2">
                                <input type="checkbox" name="delete_custom_fields[]" value="<?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
"> Delete
                            </label>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
                <!--Customers Attributes edit end -->
                <!-- Customers Attributes add start -->
                <div id="custom-fields-container">
                </div>
                <!-- Customers Attributes add end -->
            </div>
            <div class="panel-footer">
                <button class="btn btn-success btn-block" type="button" id="add-custom-field"><?php echo Lang::T('Add');?>
</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary" type="submit"><?php echo Lang::T('Save Changes');?>
</button>
        Or <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list"><?php echo Lang::T('Cancel');?>
</a>
    </div>
</div>

</form>


<?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        var customFieldsContainer = document.getElementById('custom-fields-container');
        var addCustomFieldButton = document.getElementById('add-custom-field');
        addCustomFieldButton.addEventListener('click', function () {
            var fieldIndex = customFieldsContainer.children.length;
            var newField = document.createElement('div');
            newField.className = 'form-group';
            newField.innerHTML = `
                <label class="col-md-4 control-label">Name:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="custom_field_name[]" placeholder="Name">
                </div>
                <label class="col-md-4 control-label">Value:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="custom_field_value[]" placeholder="Value">
                </div>
                <div class="col-md-2">
                    <button type="button" class="remove-custom-field btn btn-danger btn-sm">-</button>
                </div>
            `;
            customFieldsContainer.appendChild(newField);
        });

        customFieldsContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-custom-field')) {
                var fieldContainer = event.target.parentNode.parentNode;
                fieldContainer.parentNode.removeChild(fieldContainer);
            }
        });
    });

    function getLocation() {
        if (window.location.protocol == "https:" && navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            setupMap(51.505, -0.09);
        }
    }

    function showPosition(position) {
        setupMap(position.coords.latitude, position.coords.longitude);
    }

    function setupMap(lat, lon) {
        var map = L.map('map').setView([lat, lon], 13);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);
        var marker = L.marker([lat, lon]).addTo(map);
        map.on('click', function(e) {
            var coord = e.latlng;
            var lat = coord.lat;
            var lng = coord.lng;
            var newLatLng = new L.LatLng(lat, lng);
            marker.setLatLng(newLatLng);
            $('#coordinates').val(lat + ',' + lng);
        });
    }

    window.onload = function() {
        <?php if ($_smarty_tpl->tpl_vars['d']->value['coordinates']) {?>
            var coordinates = "<?php echo $_smarty_tpl->tpl_vars['d']->value['coordinates'];?>
".split(",");
            var lat = parseFloat(coordinates[0]);
            var lon = parseFloat(coordinates[1]);
            setupMap(lat, lon);
        <?php } else { ?>
            getLocation();
        <?php }?>
    }
<?php echo '</script'; ?>
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
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/e00RsnZZ5wE?si=SMGZr8eDKZgHojCG" allowfullscreen></iframe>
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
