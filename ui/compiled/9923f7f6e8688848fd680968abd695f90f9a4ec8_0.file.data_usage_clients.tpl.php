<?php
/* Smarty version 4.3.1, created on 2024-07-28 14:08:42
  from 'F:\xampp\htdocs\radius\system\plugin\ui\data_usage_clients.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a626ba1020f2_17381224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9923f7f6e8688848fd680968abd695f90f9a4ec8' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\data_usage_clients.tpl',
      1 => 1715100879,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_66a626ba1020f2_17381224 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style>
  .container {
    display: flex;
    flex-wrap: wrap;
  }

  .graph-container {
    flex: 0 0 50%;
    padding: 10px;
  }

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
    <canvas id="usageChart" width="400" height="400"></canvas>
  </div>
  <!--<div class="graph-container">
    <canvas id="trafficFlow" width="400" height="400"></canvas>
  </div> -->
</div>
<br>
<div style="overflow-x:auto;" class="table-container">
  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>Address</th>
        <th>Uptime</th>
        <th>Service</th>
        <th>Caller ID</th>
        <th>Download</th>
        <th>Upload</th>
        <th>Total</th>
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
        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['service'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['caller_id'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['tx'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['rx'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['total'];?>
</td>
      </tr>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
</div>


<?php echo '<script'; ?>
>
  // // Create a line chart instance
  // var ctx = document.getElementById('trafficFlow').getContext('2d');

  // // Define the gradient fill colors
  // var gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
  // gradientFill.addColorStop(0, 'rgba(0, 0, 255, 0.5)'); // Blue color with transparency
  // gradientFill.addColorStop(1, 'rgba(0, 0, 255, 0)'); // Transparent blue color

  // var chart = new Chart(ctx, {
  //   type: 'line',
  //   data: {
  //     labels: [], // Update the labels array
  //     datasets: [
  //       {
  //         label: 'TX',
  //         data: [], // Update the data array for TX
  //         borderColor: 'blue',
  //         fill: 'start',
  //         backgroundColor: gradientFill, // Apply the gradient fill color
  //         tension: 0.2 // Adjust the tension to control the curve smoothness
  //       },
  //       {
  //         label: 'RX',
  //         data: [], // Update the data array for RX
  //         borderColor: 'red',
  //         fill: 'start',
  //         tension: 0.2 // Adjust the tension to control the curve smoothness
  //       }
  //     ]
  //   },
  //   options: {
  //     responsive: true,
  //     title: {
  //       display: true,
  //       text: 'Live Traffic'
  //     },
  //     scales: {
  //       x: {
  //         display: true,
  //         title: {
  //           display: true,
  //           text: 'Time'
  //         }
  //       },
  //       y: {
  //         display: true,
  //         title: {
  //           display: true,
  //           text: 'Live Traffic'
  //         },
  //         plugins: {
  //           tooltip: {
  //             callbacks: {
  //               label: function (context) {
  //                 var label = context.dataset.label || '';
  //                 var value = context.parsed.y || 0;
  //                 return label + ': ' + formatBytes(value) + 'ps';
  //               }
  //             }
  //           }
  //         },
  //         ticks: {
  //           callback: function (value, index, values) {
  //             return formatBytes(value);
  //           }
  //         },
  //       }
  //     }
  //   }
  // });

  // function updateTrafficValues() {
  //   // Get the username and router values
  //   var username = '<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
'; // Replace with the actual username
  //   var router = '<?php echo $_smarty_tpl->tpl_vars['router']->value;?>
'; // Replace with the actual router

  //   // Create the AJAX request
  //   $.ajax({
  //     url: '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/data_usage_monitor_traffic', // Replace with the actual PHP file path
  //     type: 'GET',
  //     dataType: 'json',
  //     data: {
  //       router: router,
  //       username: username
  //     },
  //     success: function (data) {
  //       console.log('Data:', data);
  //       // Update the chart data
  //       chart.data.labels = data.labels;
  //       chart.data.datasets[0].data = data.rows.tx;
  //       chart.data.datasets[1].data = data.rows.rx;
  //       chart.update();
  //     },
  //     error: function (XMLHttpRequest, textStatus, errorThrown) {
  //       console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
  //       console.error("Error: " + errorThrown);
  //     }
  //   });
  // }

  // // Example usage:
  // // updateTrafficValues();
  // // Update the traffic values every 5 seconds
  // setInterval(updateTrafficValues, 1000);


  // Function to format bytes into a human-readable format
  function formatBytes(bytes) {
    if (bytes === 0) {
      return '0 B';
    }
    var k = 1024;
    var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  }

  // Extract the JSON object from your PHP code and assign it to a JavaScript variable
  var jsonUserList = <?php echo $_smarty_tpl->tpl_vars['userList']->value;?>
;

  // Extract the necessary data for the graph
  var tx = 0;
  var rx = 0;

  jsonUserList.forEach(function (user) {
    tx += parseFloat(user.tx);
    rx += parseFloat(user.rx);
  });

  // Format the bytes into a human-readable format
  var formattedTx = formatBytes(tx);
  var formattedRx = formatBytes(rx);

  // Create the data object for the graph
  var data = {
    labels: ['Download', 'Upload'],
    datasets: [
      {
        data: [tx, rx],
        backgroundColor: ['rgba(0, 0, 255, 0.5)', 'rgba(0, 0, 255, 20)'],
        borderColor: ['rgba(0, 0, 255, 0.5)', 'rgba(0, 0, 255, 20)'],
        borderWidth: 1
      }
    ]
  };

  // Create the chart
  var ctx = document.getElementById('usageChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: data,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 10,
          bottom: 10
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: function (context) {
              var label = context.label || '';

              if (label) {
                label += ': ';
              }

              if (context.parsed) {
                label += formatBytes(context.parsed);
              }

              return label;
            }
          }
        }
      }
    }
  });
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
