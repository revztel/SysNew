<?php
/* Smarty version 4.3.1, created on 2025-01-08 18:28:08
  from 'F:\xampp\htdocs\radius\ui\themes\nova\uisp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_677e998865d4e7_57246213',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9ea594c58e9072fac81b7d1d204fabf485ba263' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\ui\\themes\\nova\\uisp.tpl',
      1 => 1736350073,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_677e998865d4e7_57246213 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-12">

        <!-- Main Panel -->
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span><?php echo Lang::T('UISP Hosting');?>
</span>
            </div>
            <div class="panel-body">

                <!-- Intro / Hero Section -->
                <div class="jumbotron" style="text-align: center; background-color: #f5f5f5;">
                    <h1 style="margin-bottom: 20px;"><?php echo Lang::T('Take your ISP to the Next Level with UISP');?>
</h1>
                    <p style="font-size: 18px; line-height: 1.6; max-width: 700px; margin: 0 auto;">
                        <?php echo Lang::T('Experience all the features of Ubiquiti’s UISP at a fraction of the cost.');?>

                        <br><strong><?php echo Lang::T('Official Ubiquiti Pricing');?>
:</strong> \$30 
                        <br><strong><?php echo Lang::T('Our  Pricing');?>
:</strong> \$9.9
                    </p>
                    <p style="margin-top: 30px;">
                        <a href="https://uisp.ispledger.net/sign_up.php" target="_blank" class="btn btn-lg btn-success">
                            <i class="ion ion-log-in"></i> <?php echo Lang::T('Sign Up Now');?>

                        </a>
                    </p>
                </div>

                <!-- Selling Points / Features -->
                <div class="row" style="text-align: center; margin-bottom: 30px;">
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="glyphicon glyphicon-lock" style="font-size: 40px; color: #5bc0de;"></i>
                            <h3><?php echo Lang::T('Secure Hosting');?>
</h3>
                            <p><?php echo Lang::T('Your UISP instance is hosted on our secure infrastructure, ensuring privacy and top-notch protection.');?>
</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="glyphicon glyphicon-dashboard" style="font-size: 40px; color: #5bc0de;"></i>
                            <h3><?php echo Lang::T('High Performance');?>
</h3>
                            <p><?php echo Lang::T('Enjoy fast loading times and a responsive dashboard for all your network management needs.');?>
</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="glyphicon glyphicon-thumbs-up" style="font-size: 40px; color: #5bc0de;"></i>
                            <h3><?php echo Lang::T('Reliable Support');?>
</h3>
                            <p><?php echo Lang::T('Our dedicated team is here to assist you with any questions or issues you may have.');?>
</p>
                        </div>
                    </div>
                </div>

                <!-- Another Call-To-Action -->
                <div class="well" style="text-align: center;">
                    <h2 style="margin-top: 0;"><?php echo Lang::T('Ready to Upgrade?');?>
</h2>
                    <p style="font-size: 16px; margin-bottom: 20px;">
                        <?php echo Lang::T('Join us today and elevate your ISP operations with our affordable UISP hosting.');?>

                    </p>
                    <a href="https://uisp.ispledger.net/sign_up.php" target="_blank" class="btn btn-primary btn-lg">
                        <i class="ion ion-android-add-circle"></i> <?php echo Lang::T('Get Started for $9');?>

                    </a>
                </div>

            </div> <!-- /.panel-body -->
        </div> <!-- /.panel -->

    </div> <!-- /.col-sm-12 -->
</div> <!-- /.row -->

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
