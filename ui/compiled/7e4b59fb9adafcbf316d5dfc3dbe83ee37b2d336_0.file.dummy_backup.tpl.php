<?php
/* Smarty version 4.3.1, created on 2024-06-16 14:03:04
  from 'F:\xampp\htdocs\radius\ui\themes\nova\dummy_backup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_666ec66853cea8_52312567',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e4b59fb9adafcbf316d5dfc3dbe83ee37b2d336' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\dummy_backup.tpl',
      1 => 1718535779,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_666ec66853cea8_52312567 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dummy Backup</title>
</head>
<body>
    <h1>Dummy Backup Page</h1>
    <p>This is a dummy backup page for testing routes.</p>
    <ul>
        <li><a href="index.php?_route=router_backups/download-backup">Download Backup</a></li>
        <li><a href="index.php?_route=router_backups/restore-backup">Restore Backup</a></li>
        <li><a href="index.php?_route=router_backups/delete-backup">Delete Backup</a></li>
    </ul>
</body>
</html>
<?php }
}
