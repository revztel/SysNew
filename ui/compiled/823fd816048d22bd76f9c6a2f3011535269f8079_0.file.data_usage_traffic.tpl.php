<?php
/* Smarty version 4.3.1, created on 2024-07-28 14:08:47
  from 'F:\xampp\htdocs\radius\system\plugin\ui\data_usage_traffic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a626bfb9c843_21655217',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '823fd816048d22bd76f9c6a2f3011535269f8079' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\data_usage_traffic.tpl',
      1 => 1715386125,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_66a626bfb9c843_21655217 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style>
    .table-container {
      flex: 0 0 100%;
      padding: 10px;
    }
  
    table {
      width: 100%;
      border-collapse: collapse;
    }
  
    thead {
      background-color: #f5f5f5;
    }
  
    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  
    tr:hover {
      background-color: #f5f5f5;
    }
  </style>

<div class="container">
    <div class="graph-container">
        <canvas id="trafficFlow"></canvas>
    </div>
</div>


<div style="overflow-x:auto;" class="table-container">
    <table>
      <thead>
        <tr>
          <th>Username</th>
          <th>Address</th>
          <th>Uptime</th>
          <th>Download</th>
          <th>Upload</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userTable']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['user']->value['address'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['user']->value['uptime'];?>
</td>
          <td id="tabletx"></td>
          <td id="tablerx"></td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
  <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    // Global variables for the chart and data
    var chart;
    var chartData = {
        labels: [],
        txData: [],
        rxData: []
    };

    // Function to create and update the chart
    function createChart() {
        var ctx = document.getElementById('trafficFlow').getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'TX',
                    data: chartData.txData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 0,
                    tension: 0.4,
                    fill: 'start' // Use 'start' to fill the area from the starting point
                }, {
                    label: 'RX',
                    data: chartData.rxData,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 0,
                    tension: 0.4,
                    fill: 'start' // Use 'start' to fill the area from the starting point
                }]
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
                            callback: function (value) {
                                return formatBytes(value); // Format the tick values using formatBytes()
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                var value = context.parsed.y || 0;
                                return label + ': ' + formatBytes(value) + 'ps';
                            }
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 0, // Set the point radius to 0 to remove the dots
                        hoverRadius: 0 // Set the hover point radius to 0 to remove the dots
                    },
                    line: {
                        tension: 0 // Set the line tension to 0 to remove the curve
                    }
                }
            }
        });
    }

    function formatBytes(bytes) {
        if (bytes === 0) {
            return '0 B';
        }
        var k = 1024;
        var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        var formattedValue = parseFloat((bytes / Math.pow(k, i)).toFixed(2));
        return formattedValue + ' ' + sizes[i];
    }
    function updateTrafficValues() {
      // Get the username and router values
      var username = '<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
'; // Replace with the actual username
      var router = '<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
'; // Replace with the actual router
  
      // Create the AJAX request
      $.ajax({
        url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/data_usage_monitor_traffic', // Replace with the actual PHP file path
        type: 'GET',
        dataType: 'json',
        data: {
          router: router,
          username: username
        },
        success: function(data) {
              var labels = data.labels;
              var txData = data.rows.tx;
              var rxData = data.rows.rx;
              if (txData.length > 0 && rxData.length > 0) {
                var TX = parseInt(txData[0]);
                var RX = parseInt(rxData[0]);
                // Update chart data
                chartData.labels.push(labels[0]);
                chartData.txData.push(TX);
                chartData.rxData.push(RX);
                // Limit the number of data points to display (e.g., show the last 10 entries)
                var maxDataPoints = 10;
                if (chartData.labels.length > maxDataPoints) {
                  chartData.labels.shift();
                  chartData.txData.shift();
                  chartData.rxData.shift();
                }
                // Update the chart with the new data
                chart.update();
                // Update the table values
                document.getElementById("tabletx").textContent = formatBytes(TX);
                document.getElementById("tablerx").textContent = formatBytes(RX);
              } else {
                document.getElementById("tabletx").textContent = "0";
                document.getElementById("tablerx").textContent = "0";
              }
            },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
          console.error("Error: " + errorThrown);
        }
      });
    }
   // Call createChart() to initialize the chart
   createChart();

// Example usage:
// updateTrafficValues();
// Update the traffic values every 1 seconds
setInterval(updateTrafficValues, 1000);
  
  <?php echo '</script'; ?>
>
  <?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
