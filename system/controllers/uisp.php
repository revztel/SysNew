<?php
// uisp.php

// Make sure you include or require any necessary files, e.g., ORM, Paginator, etc.

// Example: case 'uisp' block or standalone handling
$ui->assign('_title', Lang::T('UISP Signup'));
$ui->assign('xfooter', '<script type="text/javascript" src="ui/lib/c/uisp.js"></script>');

$name = _post('name');

if ($name != '') {
    // Build the paginator with a WHERE condition for name_plan LIKE %$name% and type = 'UISP'
    $paginator = Paginator::build(
        ORM::for_table('tbl_plans'),
        ['name_plan' => '%' . $name . '%', 'type' => 'UISP'],
        $name
    );

    // Join to get extra bandwidth or any other table columns you might need
    $d = ORM::for_table('tbl_bandwidth')
        ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
        ->where('tbl_plans.type', 'UISP')
        ->where_like('tbl_plans.name_plan', '%' . $name . '%')
        ->offset($paginator['startpoint'])
        ->limit($paginator['limit'])
        ->find_many();
} else {
    $paginator = Paginator::build(
        ORM::for_table('tbl_plans'),
        ['type' => 'UISP'],
        $name
    );

    $d = ORM::for_table('tbl_bandwidth')
        ->join('tbl_plans', ['tbl_bandwidth.id', '=', 'tbl_plans.id_bw'])
        ->where('tbl_plans.type', 'UISP')
        ->offset($paginator['startpoint'])
        ->limit($paginator['limit'])
        ->find_many();
}

// Assign fetched data to Smarty variables
$ui->assign('d', $d);
$ui->assign('paginator', $paginator);

// If you have hooks, run them
run_hook('view_list_uisp'); // e.g. a new hook for UISP

// Finally, display the uisp.tpl template
$ui->display('uisp.tpl');
