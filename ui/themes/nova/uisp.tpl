{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">

        <!-- Main Panel -->
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span>{Lang::T('UISP Hosting')}</span>
            </div>
            <div class="panel-body">

                <!-- Intro / Hero Section -->
                <div class="jumbotron" style="text-align: center; background-color: #f5f5f5;">
                    <h1 style="margin-bottom: 20px;">{Lang::T('Take your ISP to the Next Level with UISP')}</h1>
                    <p style="font-size: 18px; line-height: 1.6; max-width: 700px; margin: 0 auto;">
                        {Lang::T('Experience all the features of Ubiquiti’s UISP at a fraction of the cost.')}
                        <br><strong>{Lang::T('Official Ubiquiti Pricing')}:</strong> \$30 
                        <br><strong>{Lang::T('Our  Pricing')}:</strong> \$9.9
                    </p>
                    <p style="margin-top: 30px;">
                        <a href="https://uisp.ispledger.net/sign_up.php" target="_blank" class="btn btn-lg btn-success">
                            <i class="ion ion-log-in"></i> {Lang::T('Sign Up Now')}
                        </a>
                    </p>
                </div>

                <!-- Selling Points / Features -->
                <div class="row" style="text-align: center; margin-bottom: 30px;">
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="glyphicon glyphicon-lock" style="font-size: 40px; color: #5bc0de;"></i>
                            <h3>{Lang::T('Secure Hosting')}</h3>
                            <p>{Lang::T('Your UISP instance is hosted on our secure infrastructure, ensuring privacy and top-notch protection.')}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="glyphicon glyphicon-dashboard" style="font-size: 40px; color: #5bc0de;"></i>
                            <h3>{Lang::T('High Performance')}</h3>
                            <p>{Lang::T('Enjoy fast loading times and a responsive dashboard for all your network management needs.')}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="glyphicon glyphicon-thumbs-up" style="font-size: 40px; color: #5bc0de;"></i>
                            <h3>{Lang::T('Reliable Support')}</h3>
                            <p>{Lang::T('Our dedicated team is here to assist you with any questions or issues you may have.')}</p>
                        </div>
                    </div>
                </div>

                <!-- Another Call-To-Action -->
                <div class="well" style="text-align: center;">
                    <h2 style="margin-top: 0;">{Lang::T('Ready to Upgrade?')}</h2>
                    <p style="font-size: 16px; margin-bottom: 20px;">
                        {Lang::T('Join us today and elevate your ISP operations with our affordable UISP hosting.')}
                    </p>
                    <a href="https://uisp.ispledger.net/sign_up.php" target="_blank" class="btn btn-primary btn-lg">
                        <i class="ion ion-android-add-circle"></i> {Lang::T('Get Started for $9')}
                    </a>
                </div>

            </div> <!-- /.panel-body -->
        </div> <!-- /.panel -->

    </div> <!-- /.col-sm-12 -->
</div> <!-- /.row -->

{include file="sections/footer.tpl"}
