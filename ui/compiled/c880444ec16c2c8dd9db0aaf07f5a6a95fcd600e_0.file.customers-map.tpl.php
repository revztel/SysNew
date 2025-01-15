<?php
/* Smarty version 4.3.1, created on 2024-04-14 22:44:28
  from 'F:\xampp\htdocs\radius\ui\themes\nova\customers-map.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_661c321c90c0a5_00905014',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c880444ec16c2c8dd9db0aaf07f5a6a95fcd600e' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\customers-map.tpl',
      1 => 1713123864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_661c321c90c0a5_00905014 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- Map container div -->
<div id="map" class="well" style="width: '100%'; height: 78vh; margin: 20px auto"></div>

<?php echo '<script'; ?>
>
function getLocation() {
    if (window.location.protocol == "https:" && navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showDefaultPosition);
    } else {
        setupMap(-1.2921, 36.8219); // Default coordinates for Nairobi, Kenya
    }
}

function showPosition(position) {
    setupMap(position.coords.latitude, position.coords.longitude);
}

function showDefaultPosition() {
    setupMap(-1.2921, 36.8219); // Default coordinates for Nairobi, Kenya
}

function setupMap(lat, lon) {
    var map = L.map('map').setView([lat, lon], 13);
    var group = L.featureGroup().addTo(map);
    var customers = <?php echo json_encode($_smarty_tpl->tpl_vars['customers']->value);?>
;

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    customers.forEach(function(customer) {
        var name = customer.id;
        var name = customer.name;
        var info = customer.info;
        var direction = customer.direction;
        var coordinates = customer.coordinates;
        var balance = customer.balance;
        var address = customer.address;

        // Create a popup for the marker
        var popupContent = "<strong>Name</strong>: " + name + "<br>" +
                           "<strong>Info</strong>: " + info + "<br>" +
                           "<strong>Balance</strong>: " + balance + "<br>" +
                           "<strong>Address</strong>: " + address + "<br>" +
                           "<a href='<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/"+ customer.id +"'>More Info</a> &bull; " +
                           "<a href='https://www.google.com/maps/dir//" + direction + "' target='maps'>Get Direction</a><br>";

        // Add marker to map
        var marker = L.marker(JSON.parse(coordinates)).addTo(group);
        marker.bindTooltip(name, { permanent: true }).bindPopup(popupContent);
    });

    map.fitBounds(group.getBounds());
}

window.onload = function() {
    getLocation();
}
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
