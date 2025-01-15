<?php
/* Smarty version 4.3.1, created on 2024-06-11 16:50:57
  from 'F:\xampp\htdocs\radius\ui\themes\nova\print-voucher.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66685641837ea2_26130501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aeb7475ee9642055f8398ea3ee7b23098d60f861' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\print-voucher.tpl',
      1 => 1718113017,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66685641837ea2_26130501 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\xampp\\htdocs\\radius\\system\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_smarty_tpl->tpl_vars['_title']->value;?>
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="ui/ui/images/favicon.ico">
    <style>
        .ukuran {
            size: A4;
        }

        body,
        td,
        th {
            font-size: 12px;
            font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;

            html,
            body {
                width: 210mm;
                height: 297mm;
            }
        }

        @media print {
            body {
                size: auto;
                margin: 0;
                box-shadow: 0;
            }

            page[size="A4"] {
                margin: 0;
                size: auto;
                box-shadow: 0;
            }

            .page-break {
                display: block;
                page-break-before: always;
            }

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <page size="A4">
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/print-voucher/" class="no-print">
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="btn btn-default btn-sm">
                <tr>
                    <td>From ID &gt; <input type="text" name="from_id" style="width:40px" value="<?php echo $_smarty_tpl->tpl_vars['from_id']->value;?>
"> limit
                        <input type="text" name="limit" style="width:40px" value="<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
"></td>
                    <td>Voucher PerLine <input type="text" style="width:40px" name="vpl" value="<?php echo $_smarty_tpl->tpl_vars['vpl']->value;?>
">
                        vouchers</td>
                    <td>PageBreak after <input type="text" style="width:40px" name="pagebreak" value="<?php echo $_smarty_tpl->tpl_vars['pagebreak']->value;?>
">
                        vouchers</td>
                    <td>Plans <select id="plan_id" name="planid" style="width:50px">
                            <option value="0">--all--</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plans']->value, 'plan');
$_smarty_tpl->tpl_vars['plan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['plan']->value) {
$_smarty_tpl->tpl_vars['plan']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['plan']->value['id'] == $_smarty_tpl->tpl_vars['planid']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['plan']->value['name_plan'];?>

                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select></td>
                    <td><button type="submit">submit</button></td>
                </tr>
            </table>
            <hr>
            <center><button type="button" onclick="window.print()"
                    class="btn btn-default btn-sm no-print"><?php echo Lang::T('Click Here to Print');?>
</button><br>
                <?php echo Lang::T('Print side by side, it will easy to cut');?>
<br>
                show <?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['v']->value);?>
 vouchers from <?php echo $_smarty_tpl->tpl_vars['vc']->value;?>
 vouchers<br>
                from ID <?php echo $_smarty_tpl->tpl_vars['v']->value[0]['id'];?>
 limit <?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
 vouchers
            </center>
        </form>
        <div id="printable" align="center">
            <hr>
            <?php $_smarty_tpl->_assignInScope('n', 1);?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['voucher']->value, 'vs');
$_smarty_tpl->tpl_vars['vs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['vs']->value) {
$_smarty_tpl->tpl_vars['vs']->do_else = false;
?>
                <?php $_smarty_tpl->_assignInScope('jml', $_smarty_tpl->tpl_vars['jml']->value+1);?>
                <?php if ($_smarty_tpl->tpl_vars['n']->value == 1) {?>
                    <table>
                        <tr>
                        <?php }?>
                        <td><?php echo $_smarty_tpl->tpl_vars['vs']->value;?>
</td>
                        <?php if ($_smarty_tpl->tpl_vars['n']->value == $_smarty_tpl->tpl_vars['vpl']->value) {?>
                    </table>
                    <?php $_smarty_tpl->_assignInScope('n', 1);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('n', $_smarty_tpl->tpl_vars['n']->value+1);?>
                <?php }?>


                <?php if ($_smarty_tpl->tpl_vars['jml']->value == $_smarty_tpl->tpl_vars['pagebreak']->value) {?>
                    <?php $_smarty_tpl->_assignInScope('jml', 0);?>
                    <!-- pageBreak -->
                    <div class="page-break">
                        <div class="no-print" style="background-color: #E91E63; color:#FFF;" align="center">-- pageBreak --
                            <hr>
                        </div>
                    </div>
                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </page>
    <?php echo '<script'; ?>
 src="ui/ui/scripts/jquery-1.10.2.js"><?php echo '</script'; ?>
>
    <?php if ((isset($_smarty_tpl->tpl_vars['xfooter']->value))) {?>
        <?php echo $_smarty_tpl->tpl_vars['xfooter']->value;?>

    <?php }?>
    <?php echo '<script'; ?>
>
        jQuery(document).ready(function() {
            // initiate layout and plugins
            $("#actprint").click(function() {
                window.print();
                return false;
            });
        });
    <?php echo '</script'; ?>
>

</body>

</html><?php }
}
