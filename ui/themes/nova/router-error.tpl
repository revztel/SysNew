<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error - FreeIspRadius</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Orbitron:700" rel="stylesheet">

    <!-- Bootstrap and Font Awesome -->
    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ui/ui/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="ui/ui/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">
    <style>
        /* Custom Cursor */
        body {
            cursor: url('ui/ui/images/cursor-danger.png'), auto;
            background-color: #0b0b0b;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        /* Selection Highlight */
        ::-moz-selection {
            color: #fff;
            background: #ff0000;
        }

        ::selection {
            color: #fff;
            background: #ff0000;
        }

        /* Glitch Effect */
        .glitch {
            position: relative;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 48px;
            text-transform: uppercase;
            animation: glitch 1s infinite;
        }

        .glitch::before,
        .glitch::after {
            content: attr(data-text);
            position: absolute;
            left: 0;
        }

        .glitch::before {
            animation: glitchTop 1s infinite;
            clip: rect(0, 900px, 0, 0);
        }

        .glitch::after {
            animation: glitchBottom 1s infinite;
            clip: rect(0, 900px, 0, 0);
        }

        @keyframes glitch {
            0% {
                text-shadow: 2px 2px #ff0000, -2px -2px #00ffea;
            }
            20% {
                text-shadow: -2px -2px #ff0000, 2px 2px #00ffea;
            }
            40% {
                text-shadow: 2px -2px #ff0000, -2px 2px #00ffea;
            }
            60% {
                text-shadow: -2px 2px #ff0000, 2px -2px #00ffea;
            }
            80% {
                text-shadow: 2px 2px #ff0000, -2px -2px #00ffea;
            }
            100% {
                text-shadow: -2px -2px #ff0000, 2px 2px #00ffea;
            }
        }

        @keyframes glitchTop {
            0% {
                clip: rect(0, 9999px, 0, 0);
            }
            50% {
                clip: rect(0, 9999px, 50px, 0);
                transform: translate(-2px, -2px);
            }
            100% {
                clip: rect(0, 9999px, 0, 0);
            }
        }

        @keyframes glitchBottom {
            0% {
                clip: rect(0, 9999px, 0, 0);
            }
            50% {
                clip: rect(85px, 9999px, 140px, 0);
                transform: translate(2px, 2px);
            }
            100% {
                clip: rect(0, 9999px, 0, 0);
            }
        }

        /* Box Styling */
        .box {
            background: linear-gradient(135deg, #1d1d1d 0%, #111 100%);
            border: 1px solid #ff0000;
            box-shadow: 0 0 20px #ff0000;
        }

        /* Button Styling */
        .btn-danger,
        .btn-warning,
        .btn-info,
        .btn-success,
        .btn-primary {
            background: #ff0000;
            border: none;
            box-shadow: 0 0 10px #ff0000;
            font-weight: bold;
        }

        .btn-danger:hover,
        .btn-warning:hover,
        .btn-info:hover,
        .btn-success:hover,
        .btn-primary:hover {
            background: #cc0000;
            box-shadow: 0 0 15px #cc0000;
        }

        /* Links */
        a {
            color: #ff0000;
            text-decoration: none;
        }

        a:hover {
            color: #cc0000;
            text-decoration: underline;
        }

        /* Image Styling */
        .img-responsive {
            filter: drop-shadow(0 0 10px #ff0000);
        }

        /* List Styling */
        ul {
            list-style: square;
        }

        li {
            padding: 5px 0;
        }

        /* Video Embed */
        .embed-responsive {
            border: 2px solid #ff0000;
            box-shadow: 0 0 20px #ff0000;
        }

        /* Footer */
        .box-footer {
            border-top: 1px solid #ff0000;
        }

        /* Media Queries */
        @media (max-width: 767px) {
            .glitch {
                font-size: 36px;
            }
        }
    </style>
</head>

<body class="hold-transition">
    <div class="container">
        <section class="content">
            <div class="row">
                <!-- Main Content -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-danger box-solid">
                        <!-- Header -->
                        <section class="content-header">
                            <h1 class="text-center glitch" data-text="{$error_title}">
                               
                            </h1>
                        </section>
                        <!-- Body -->
                        <div class="box-body" style="font-size: larger;">
                            <center>
                                <img src="./ui/ui/images/error.png" class="img-responsive hidden-sm hidden-xs" alt="Error Image">
                            </center>
                            <br>
                            <p>{$error_message}</p>
                            <br>
                            <h3>Mikrotik Troubleshooting:</h3>
                            <ul>
                                <li>First step is to make sure your Mikrotik has Internet.</li>
                                <li>Ensure your API port in IP > Services is set to <strong>8728</strong>.</li>
                                <li>Verify that your Username and Password are correct.</li>
                                <li>Confirm your FreeIspRadius OVPN is connected. Check in Interfaces  the VPN (OVPN) is named <strong>freeispradius</strong>.</li>
                            </ul>
                            <br>
                            <!-- Video -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/7mZJ-eGdq44?si=IjqkT5lU1zhQDJDq" allowfullscreen></iframe>
                            </div>
                        </div>
                        <!-- Footer -->
                        <div class="box-footer">
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <a href="./update.php?step=4" class="btn btn-info btn-sm btn-block"><i class="fa fa-database"></i> Update Database</a>
                                <a href="{$_url}community#update" class="btn btn-success btn-sm btn-block"><i class="fa fa-refresh"></i> Update FreeIspRadius</a>
                            </div>
                            <br>
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <a href="https://wa.me/254769023642" target="_blank" class="btn btn-success btn-sm btn-block"><i class="fa fa-whatsapp"></i> Ask Support Line</a>
                                <a href="https://t.me/freeispradius" target="_blank" class="btn btn-primary btn-sm btn-block"><i class="fa fa-telegram"></i> Ask Telegram Community</a>
                            </div>
                            <br><br>
                            <a href="javascript:void(0);" onclick="history.back();" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!-- Image for Smaller Screens -->
                <div class="col-md-4">
                    <img src="./ui/ui/images/error.png" class="img-responsive hidden-md hidden-lg" alt="Error Image">
                </div>
            </div>
        </section>
    </div>

    <!-- Optional JavaScript -->
    <script src="ui/ui/scripts/jquery.min.js"></script>
    <script src="ui/ui/scripts/bootstrap.min.js"></script>
</body>

</html>
