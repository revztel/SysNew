<?php
/* Smarty version 4.3.1, created on 2024-06-17 13:31:31
  from 'F:\xampp\htdocs\radius\system\plugin\ui\mikrotik_monitor.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66701083120d05_98522398',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96174b868c7e9606d8f085028ccd5f401f91f1a6' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\mikrotik_monitor.tpl',
      1 => 1718620268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66701083120d05_98522398 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="box-body table-responsive no-padding">
  <div class="col-sm-12 col-md-12">
    <form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_ui">
      <ul class="nav nav-tabs"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'r');
$_smarty_tpl->tpl_vars['r']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->do_else = false;
?> <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['r']->value['id'] == $_smarty_tpl->tpl_vars['router']->value) {?>class="active"
          <?php }?>>
          <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_ui/<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
</a>
        </li> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </ul>
    </form>
    <div class="panel">
      <div class="table-responsive" api-get-text="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_get_resources/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
">
        <center>
          <br>
          <br>
          <img src="ui/ui/images/loading.gif">
          <br>
          <br>
          <br>
        </center>
      </div>
      <!-- Progress Bars -->
      <div class="column-card-container" id="progress-bars">
        <!-- CPU Load Progress Bar -->
        <div class="column-card" id="cpu-load-bar">
          <div class="column-card-header_progres">CPU Load</div>
          <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-success progress-animated" role="progressbar"
              style="width: 0%; background-color: #5cb85c">0%</div>
          </div>
        </div>
        <!-- Temperature Progress Bar -->
        <div class="column-card" id="temperature-bar">
          <div class="column-card-header_progres">Temperature</div>
          <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-info progress-animated" role="progressbar"
              style="width: 0%; background-color: #5cb85c">0°C</div>
          </div>
        </div>
        <!-- Voltage Progress Bar -->
        <div class="column-card" id="voltage-bar">
          <div class="column-card-header_progres">Voltage</div>
          <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-primary progress-animated" role="progressbar"
              style="width: 0%; background-color: #5cb85c">0 V</div>
          </div>
        </div>
      </div>
      <!-- End of Progress Bars -->

    </div>
    <div class="table-responsive">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab_4" data-toggle="tab">Wireless Status</a>
          </li>
          <li>
            <a href="#tab_1" data-toggle="tab">Interface Status</a>
          </li>
          <li>
            <a href="#tab_2" data-toggle="tab">Hotspot Online Users</a>
          </li>
          <li>
            <a href="#tab_3" data-toggle="tab">PPPoE Online Users</a>
          </li>
          <li>
            <a href="#tab_5" data-toggle="tab">Traffic Monitor</a>
          </li>
        </ul>
        <div class="tab-content">
          <div style="overflow-x:auto;" class="tab-pane" id="tab_1">
            <div class="box-body no-padding" id="traffic-panel">
              <table id="traffic-table" class="display">
                <thead>
                  <tr>
                    <th>Interface Name</th>
                    <th>Tx (bytes Out)</th>
                    <th>Rx (bytes In)</th>
                    <th>Total Usage</th>
                    <th>Status</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" style="overflow-x:auto;" id="tab_2">
            <div class="box-body no-padding" id="hotspot-panel">
              <table class="display" id="hotspot-table">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>IP Address</th>
                    <th>Uptime</th>
                    <th>Server</th>
                    <th>Mac Address</th>
                    <th>Session Time Left</th>
                    <th>Upload (RX)</th>
                    <th>Download (TX)</th>
                    <th>Total Usage</th>
                    <!--  <th>Action</th>  -->
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div style="overflow-x:auto;" class="tab-pane" id="tab_3">
            <div class="box-body no-padding" id="traffic-panel">
              <table class="display" id="ppp-table">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>IP Address</th>
                    <th>Uptime</th>
                    <th>Service</th>
                    <th>Caller ID</th>
                    <th>Download</th>
                    <th>Upload</th>
                    <th>Total Usage</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div style="overflow-x:auto;" class="tab-pane active" id="tab_4">
            <div class="box-body no-padding" id="signal-panel">
              <table class="display" id="signal-table">
                <thead>
                  <tr>
                    <th>Interface</th>
                    <th>Mac Address</th>
                    <th>Uptime</th>
                    <th>Last Ip</th>
                    <th>Last Activity</th>
                    <th>Signal Strength</th>
                    <th>Tx / Rx CCQ</th>
                    <th>Rx Rate</th>
                    <th>Tx Rate</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div style="overflow-x:auto;" class="tab-pane" id="tab_5">
            <div class="box-body no-padding" id="">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <th>Interace</th>
                    <th>TX</th>
                    <th>RX</th>
                  </tr>
                  <tr>
                    <td>
                      <select name="interface" id="interface">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['interfaces']->value, 'interface');
$_smarty_tpl->tpl_vars['interface']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['interface']->value) {
$_smarty_tpl->tpl_vars['interface']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['interface']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['interface']->value;?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </select>
                    </td>
                    <td>
                      <div id="tabletx"></div>
                    </td>
                    <td>
                      <div id="tablerx"></div>
                    </td>
                  </tr>
                </table>
                <canvas id="chart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        var $j = jQuery.noConflict(); // Use $j as an alternative to $

        function fetchData() {
            return $j.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_get_resources_json<?php echo $_smarty_tpl->tpl_vars['routes']->value;?>
', // Ganti dengan URL yang sesuai untuk mendapatkan data real-time
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $j('#cpu-load-bar .progress-bar').css('width', data.cpu_load + '%').text(data.cpu_load + '%');
                    $j('#temperature-bar .progress-bar').css('width', data.temperature + '%').text(data.temperature + '°C');
                    $j('#voltage-bar .progress-bar').css('width', data.voltage + '%').text(data.voltage + ' V');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }

        function fetchTrafficData() {
            return $j.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_get_traffic/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
',
                method: 'GET',
                success: function(response) {
                    $j('#traffic-table').DataTable().clear().rows.add(response).draw();
                },
                error: function(xhr, error, thrown) {
                    console.log('AJAX error:', error);
                }
            });
        }

        function fetchUserListData() {
            var table = $j('#ppp-table').DataTable({
                columns: [
                    { data: 'username' },
                    { data: 'address' },
                    { data: 'uptime' },
                    { data: 'service' },
                    { data: 'caller_id' },
                    { data: 'tx' },
                    { data: 'rx' },
                    { data: 'total' },
                ]
            });
            return $j.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_get_ppp_online_users/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
',
                method: 'GET',
                success: function(response) {
                    table.clear().rows.add(response).draw();
                },
                error: function(xhr, error, thrown) {
                    console.log('AJAX error:', error);
                },
            });
        }

        function fetchHotspotListData() {
            var table = $j('#hotspot-table').DataTable({
                columns: [
                    { data: 'username' },
                    { data: 'address' },
                    { data: 'uptime' },
                    { data: 'server' },
                    { data: 'mac' },
                    { data: 'session_time' },
                    { data: 'tx_bytes' },
                    { data: 'rx_bytes' },
                    { data: 'total' },
                ]
            });
            return $j.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_get_hotspot_online_users/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
',
                method: 'GET',
                success: function(response) {
                    table.clear().rows.add(response).draw();
                },
                error: function(xhr, error, thrown) {
                    console.log('AJAX error:', error);
                },
            });
        }

        function fetchSignalListData() {
            var table = $j('#signal-table').DataTable({
                columns: [
                    { data: 'interface' },
                    { data: 'mac_address' },
                    { data: 'uptime' },
                    { data: 'last_ip' },
                    { data: 'last_activity' },
                    { data: 'signal_strength' },
                    { data: 'tx_ccq' },
                    { data: 'rx_rate' },
                    { data: 'tx_rate' }
                ]
            });
            return $j.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_get_wlan/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
',
                method: 'GET',
                success: function(response) {
                    table.clear().rows.add(response).draw();
                },
                error: function(xhr, error, thrown) {
                    console.log('AJAX error:', error);
                }
            });
        }

        function disconnectUser(username) {
            console.log('Disconnect user:', username);
        }

        var chart;
        var chartData = {
            labels: [],
            txData: [],
            rxData: []
        };

        function createChart() {
            var ctx = document.getElementById('chart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'TX',
                            data: chartData.txData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 0,
                            tension: 0.4,
                            fill: 'start'
                        },
                        {
                            label: 'RX',
                            data: chartData.rxData,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 0,
                            tension: 0.4,
                            fill: 'start'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Time'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Live Traffic'
                            },
                            ticks: {
                                callback: function(value) {
                                    return formatBytes(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    var value = context.parsed.y || 0;
                                    return label + ': ' + formatBytes(value) + 'ps';
                                }
                            }
                        }
                    },
                    elements: {
                        point: {
                            radius: 0,
                            hoverRadius: 0
                        },
                        line: {
                            tension: 0
                        }
                    }
                }
            });
        }

        function formatBytes(bytes) {
            if (bytes === 0) return '0 B';
            var k = 1024;
            var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
            var i = Math.floor(Math.log(bytes) / Math.log(k));
            var formattedValue = parseFloat((bytes / Math.pow(k, i)).toFixed(2));
            return formattedValue + ' ' + sizes[i];
        }

        function updateTrafficValues() {
            var interface = $j('#interface').val();
            $j.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/mikrotik_monitor_traffic_update/<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
',
                dataType: 'json',
                data: {
                    interface: interface
                },
                success: function(data) {
                    var labels = data.labels;
                    var txData = data.rows.tx;
                    var rxData = data.rows.rx;
                    if (txData.length > 0 && rxData.length > 0) {
                        var TX = parseInt(txData[0]);
                        var RX = parseInt(rxData[0]);
                        chartData.labels.push(labels[0]);
                        chartData.txData.push(TX);
                        chartData.rxData.push(RX);
                        var maxDataPoints = 10;
                        if (chartData.labels.length > maxDataPoints) {
                            chartData.labels.shift();
                            chartData.txData.shift();
                            chartData.rxData.shift();
                        }
                        chart.update();
                        document.getElementById("tabletx").textContent = formatBytes(TX);
                        document.getElementById("tablerx").textContent = formatBytes(RX);
                    } else {
                        document.getElementById("tabletx").textContent = "0";
                        document.getElementById("tablerx").textContent = "0";
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                    console.error("Error: " + errorThrown);
                }
            });
        }

        function startRefresh() {
            setInterval(updateTrafficValues, 2000);
        }

        $j(document).ready(function() {
            $j('#traffic-table').DataTable({
                columns: [
                    { data: 'name' },
                    { data: 'tx' },
                    { data: 'rx' },
                    { data: 'total' },
                    { data: 'status' }
                ]
            });

            fetchData()
                .then(fetchTrafficData)
                .then(fetchUserListData)
                .then(fetchHotspotListData)
                .then(fetchSignalListData)
                .then(function() {
                    createChart();
                    startRefresh();
                    $j('#interface').on('input', function() {
                        updateTrafficValues();
                    });
                });
        });
    <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>
          window.addEventListener('DOMContentLoaded', function() {
            var portalLink = "freeispradius.com";
            $('#version').html('MikroTik Monitor | Ver: 3.0 | by: <a href="' + portalLink + '">FreeIspRadius</a>');
          });
        <?php echo '</script'; ?>
>
        

    <?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
