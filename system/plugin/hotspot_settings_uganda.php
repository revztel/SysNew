<?php
use PEAR2\Net\RouterOS;



// Database connection assumed: $db_host, $db_name, $db_user, $db_password
$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

function hotspot_settings_uganda() {
    global $ui, $conn;
    _admin();
    $ui->assign('_title', 'Hotspot Dashboard - Uganda');
    $admin = Admin::_info();
    $ui->assign('_admin', $admin);

    // Fetch the Uganda-specific router_id (or adapt as needed)
    $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'router_id_uganda'");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $routerId = $res ? $res['value'] : '';

    // Fetch router details
    $stmt = $conn->prepare("SELECT ip_address, username, password FROM tbl_routers WHERE id = :router_id");
    $stmt->bindParam(':router_id', $routerId);
    $stmt->execute();
    $routerDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($routerDetails) {
        $mikrotik_host = $routerDetails['ip_address'];
        $mikrotik_user = $routerDetails['username'];
        $mikrotik_pass = $routerDetails['password'];
    } else {
        // Default/fallback values
        $mikrotik_host = '192.168.88.1';
        $mikrotik_user = 'admin';
        $mikrotik_pass = '12345';
    }

    // Using the same variable names as Kenya
    $settingsKeys = [
        'hotspot_title',
        'description',
        'free_trial',
        'frequently_asked_questions_headline1',
        'frequently_asked_questions_answer1',
        'frequently_asked_questions_headline2',
        'frequently_asked_questions_answer2',
        'frequently_asked_questions_headline3',
        'frequently_asked_questions_answer3',
        'color_scheme'
    ];

    $settings = [];
    foreach ($settingsKeys as $key) {
        $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = :setting");
        $stmt->execute(['setting' => $key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $settings[$key] = $row ? $row['value'] : '';
    }

    $hotspotTitle = $settings['hotspot_title'];
    $description = $settings['description'];
    $faqHeadline1 = $settings['frequently_asked_questions_headline1'];
    $faqAnswer1 = $settings['frequently_asked_questions_answer1'];
    $faqHeadline2 = $settings['frequently_asked_questions_headline2'];
    $faqAnswer2 = $settings['frequently_asked_questions_answer2'];
    $faqHeadline3 = $settings['frequently_asked_questions_headline3'];
    $faqAnswer3 = $settings['frequently_asked_questions_answer3'];
    $selectedColorScheme = $settings['color_scheme'] ?: 'green';
    $freeTrialEnabled = ($settings['free_trial'] === 'enable');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newHotspotTitle = trim($_POST['hotspot_title']);
        $newDescription = trim($_POST['description']);
        $newFreeTrial = isset($_POST['free_trial']) ? $_POST['free_trial'] : 'disable';
        $newFaqHeadline1 = trim($_POST['frequently_asked_questions_headline1']);
        $newFaqAnswer1 = trim($_POST['frequently_asked_questions_answer1']);
        $newFaqHeadline2 = trim($_POST['frequently_asked_questions_headline2']);
        $newFaqAnswer2 = trim($_POST['frequently_asked_questions_answer2']);
        $newFaqHeadline3 = trim($_POST['frequently_asked_questions_headline3']);
        $newFaqAnswer3 = trim($_POST['frequently_asked_questions_answer3']);
        $newColorScheme = $_POST['color_scheme'];
        $newRouterId = isset($_POST['router_id']) ? trim($_POST['router_id']) : '';

        // Update router_id for Uganda
        $updateRouterIdStmt = $conn->prepare("UPDATE tbl_appconfig SET value = :router_id WHERE setting = 'router_id_uganda'");
        $updateRouterIdStmt->execute(['router_id' => $newRouterId]);

        // Update settings
        $updateSettings = [
            'hotspot_title' => $newHotspotTitle,
            'description' => $newDescription,
            'free_trial' => $newFreeTrial,
            'frequently_asked_questions_headline1' => $newFaqHeadline1,
            'frequently_asked_questions_answer1' => $newFaqAnswer1,
            'frequently_asked_questions_headline2' => $newFaqHeadline2,
            'frequently_asked_questions_answer2' => $newFaqAnswer2,
            'frequently_asked_questions_headline3' => $newFaqHeadline3,
            'frequently_asked_questions_answer3' => $newFaqAnswer3,
            'color_scheme' => $newColorScheme
        ];

        foreach ($updateSettings as $k => $v) {
            $upd = $conn->prepare("UPDATE tbl_appconfig SET value = :val WHERE setting = :setname");
            $upd->execute(['val' => $v, 'setname' => $k]);
        }

        // Refresh variables
        $hotspotTitle = $newHotspotTitle;
        $description = $newDescription;
        $faqHeadline1 = $newFaqHeadline1;
        $faqAnswer1 = $newFaqAnswer1;
        $faqHeadline2 = $newFaqHeadline2;
        $faqAnswer2 = $newFaqAnswer2;
        $faqHeadline3 = $newFaqHeadline3;
        $faqAnswer3 = $newFaqAnswer3;
        $selectedColorScheme = $newColorScheme;
        $freeTrialEnabled = ($newFreeTrial === 'enable');
        $routerId = $newRouterId;

        // Generate login.html
        $appUrl = APP_URL;
        $dynamicAction = $appUrl . "/system/plugin/router" . ($routerId ?: '1') . ".html";

        $loginHtmlContent = <<<EOL
<!DOCTYPE html>
<html>
<head>
<title>{$hotspotTitle} - Login</title>
</head>
<body>
<form name="redirect" action="{$dynamicAction}" method="post">
<input type="hidden" name="mac" value="\$(mac)">
<input type="hidden" name="ip" value="\$(ip)">
<input type="hidden" name="user" value="\$(username)">
<input type="hidden" name="link-login" value="\$(link-login)">
<input type="hidden" name="link-orig" value="\$(link-orig)">
<input type="hidden" name="error" value="\$(error)">
</form>
<script language="JavaScript">
document.redirect.submit();
</script>
</body>
</html>
EOL;

        // Save login.html locally
        $localFile = __DIR__ . '/login.html';
        file_put_contents($localFile, $loginHtmlContent);

        // FTP upload to MikroTik
        $logMessages = [];
        $ftp = ftp_connect($mikrotik_host);
        if ($ftp && ftp_login($ftp, $mikrotik_user, $mikrotik_pass)) {
            ftp_pasv($ftp, true);

            // Upload to hotspot folder
            $remoteFile = 'hotspot/login.html';
            if (ftp_put($ftp, $remoteFile, $localFile, FTP_BINARY)) {
                $logMessages[] = "File uploaded successfully to '$remoteFile'.";
            } else {
                $logMessages[] = "Failed to upload to '$remoteFile'.";
            }

            // Optionally upload to flash/hotspot
            $remoteFileFlash = 'flash/hotspot/login.html';
            if (ftp_put($ftp, $remoteFileFlash, $localFile, FTP_BINARY)) {
                $logMessages[] = "File uploaded successfully to '$remoteFileFlash'.";
            } else {
                $logMessages[] = "Failed to upload to '$remoteFileFlash'.";
            }

            ftp_close($ftp);
        } else {
            $logMessages[] = "Failed to connect to the MikroTik router.";
        }

        // Log if needed
        $logFile = dirname(__DIR__, 2) . '/upload_log.txt';
        foreach ($logMessages as $logMessage) {
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $logMessage . PHP_EOL, FILE_APPEND);
        }

        r2(U . "plugin/hotspot_settings_uganda", 's', "Settings Saved and Uploaded to Router");
    }

    // Assign to template
    $ui->assign('hotspot_title', $hotspotTitle);
    $ui->assign('description', $description);
    $ui->assign('frequently_asked_questions_headline1', $faqHeadline1);
    $ui->assign('frequently_asked_questions_answer1', $faqAnswer1);
    $ui->assign('frequently_asked_questions_headline2', $faqHeadline2);
    $ui->assign('frequently_asked_questions_answer2', $faqAnswer2);
    $ui->assign('frequently_asked_questions_headline3', $faqHeadline3);
    $ui->assign('frequently_asked_questions_answer3', $faqAnswer3);
    $ui->assign('selected_color_scheme', $selectedColorScheme);
    $ui->assign('free_trial_enabled', $freeTrialEnabled);

    $routers = $conn->query("SELECT id, name FROM tbl_routers")->fetchAll(PDO::FETCH_ASSOC);
    $ui->assign('routers', $routers);
    $ui->assign('selected_router_id', $routerId);

    $ui->display('hotspot_settings_uganda.tpl');
}
