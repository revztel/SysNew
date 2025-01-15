<?php
use PEAR2\Net\RouterOS;



// Database connection assumed: $db_host, $db_name, $db_user, $db_password
$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

function hotspot_settings_philippines() {
    global $ui, $conn;
    _admin();
    $ui->assign('_title', 'Hotspot Dashboard - Philippines');
    $admin = Admin::_info();
    $ui->assign('_admin', $admin);

     // Get the selected router ID from user input
     $routerId = isset($_POST['router_id']) ? trim($_POST['router_id']) : '';

     if (!empty($routerId)) {
         // Update router_id in tbl_appconfig
         $updateRouterIdStmt = $conn->prepare("UPDATE tbl_appconfig SET value = :router_id WHERE setting = 'router_id'");
         $updateRouterIdStmt->execute(['router_id' => $routerId]);
 
         // Fetch the router name based on the selected router ID
         $routerStmt = $conn->prepare("SELECT name FROM tbl_routers WHERE id = :router_id");
         $routerStmt->execute(['router_id' => $routerId]);
         $router = $routerStmt->fetch(PDO::FETCH_ASSOC);
 
         if ($router) {
             // Update router_name in tbl_appconfig
             $updateRouterNameStmt = $conn->prepare("UPDATE tbl_appconfig SET value = :router_name WHERE setting = 'router_name'");
             $updateRouterNameStmt->execute(['router_name' => $router['name']]);
         }
     }
 
     // Fetch the current router ID from the tbl_appconfig table
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'router_id'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $routerId = $result ? $result['value'] : '';
 
     // Fetch the router details from the tbl_routers table based on the router ID
     $stmt = $conn->prepare("SELECT ip_address, username, password FROM tbl_routers WHERE id = :router_id");
     $stmt->bindParam(':router_id', $routerId);
     $stmt->execute();
     $routerDetails = $stmt->fetch(PDO::FETCH_ASSOC);
 
     if ($routerDetails) {
         $mikrotik_host = $routerDetails['ip_address'];
         $mikrotik_user = $routerDetails['username'];
         $mikrotik_pass = $routerDetails['password'];
     } else {
         // Fallback to default values or handle the case where router details are not found
         $mikrotik_host = '192.168.88.1';
         $mikrotik_user = 'admin';
         $mikrotik_pass = '12345';
     }
 
     // Explicitly stated values for FAQ settings
     $settings = [];
     $faqSettings = [
         'frequently_asked_questions_headline1',
         'frequently_asked_questions_answer1',
         'frequently_asked_questions_headline2',
         'frequently_asked_questions_answer2',
         'frequently_asked_questions_headline3',
         'frequently_asked_questions_answer3'
     ];
 
     foreach ($faqSettings as $setting) {
         $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = :setting");
         $stmt->bindParam(':setting', $setting);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $settings[$setting] = $result ? $result['value'] : '';
     }
 
     // Fetch other settings
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'hotspot_title'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $hotspotTitle = $result ? $result['value'] : '';
 
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'description'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $description = $result ? $result['value'] : '';
 
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'phone'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $phone = $result ? $result['value'] : '';
 
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'CompanyName'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $company = $result ? $result['value'] : '';
 
     // Fetch color scheme
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'color_scheme'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $selectedColorScheme = $result ? $result['value'] : 'green';
 
     $colorSchemes = [
         'green' => [
             'primary' => 'green',
             'secondary' => 'teal',
         ],
         'brown' => [
             'primary' => 'yellow',
             'secondary' => 'orange',
         ],
         'orange' => [
             'primary' => 'orange',
             'secondary' => 'yellow',
         ],
         'red' => [
             'primary' => 'red',
             'secondary' => 'pink',
         ],
         'blue' => [
             'primary' => 'blue',
             'secondary' => 'indigo',
         ],
         'black' => [
             'primary' => 'black',
             'secondary' => 'gray',
         ],
         'yellow' => [
             'primary' => 'yellow',
             'secondary' => 'red',
         ],
         'pink' => [
             'primary' => 'pink',
             'secondary' => 'fuchsia',
         ],
     ];
 
     $primaryColor = $colorSchemes[$selectedColorScheme]['primary'];
     $secondaryColor = $colorSchemes[$selectedColorScheme]['secondary'];
     // Fetch the free_trial setting from tbl_appconfig
 $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'free_trial'");
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);
 $freeTrialEnabled = ($result && $result['value'] === 'enable');
 
     // Fetch available plans
     $stmt = $conn->prepare("SELECT value FROM tbl_appconfig WHERE setting = 'router_name'");
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $routerName = $result ? $result['value'] : '';
 
     $planQuery = "SELECT id, name_plan, price, validity, validity_unit FROM tbl_plans WHERE routers = :router_name AND type = 'Hotspot'";
     $planStmt = $conn->prepare($planQuery);
     $planStmt->bindValue(':router_name', $routerName);
     $planStmt->execute();
     $planResult = $planStmt->fetchAll(PDO::FETCH_ASSOC);
 
 // Check if form is submitted
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Update settings
     $newHotspotTitle = isset($_POST['hotspot_title']) ? trim($_POST['hotspot_title']) : $hotspotTitle;
     $newColorScheme = isset($_POST['color_scheme']) ? $_POST['color_scheme'] : $selectedColorScheme;
     $newFaqHeadline1 = isset($_POST['frequently_asked_questions_headline1']) ? trim($_POST['frequently_asked_questions_headline1']) : $settings['frequently_asked_questions_headline1'];
     $newFaqHeadline2 = isset($_POST['frequently_asked_questions_headline2']) ? trim($_POST['frequently_asked_questions_headline2']) : $settings['frequently_asked_questions_headline2'];
     $newFaqHeadline3 = isset($_POST['frequently_asked_questions_headline3']) ? trim($_POST['frequently_asked_questions_headline3']) : $settings['frequently_asked_questions_headline3'];
     $newFaqAnswer1 = isset($_POST['frequently_asked_questions_answer1']) ? trim($_POST['frequently_asked_questions_answer1']) : $settings['frequently_asked_questions_answer1'];
     $newFaqAnswer2 = isset($_POST['frequently_asked_questions_answer2']) ? trim($_POST['frequently_asked_questions_answer2']) : $settings['frequently_asked_questions_answer2'];
     $newFaqAnswer3 = isset($_POST['frequently_asked_questions_answer3']) ? trim($_POST['frequently_asked_questions_answer3']) : $settings['frequently_asked_questions_answer3'];
     $newDescription = isset($_POST['description']) ? trim($_POST['description']) : $description;
     $newFreeTrialSetting = isset($_POST['free_trial']) ? trim($_POST['free_trial']) : 'disable';
 
     // Update database for each setting
     $updateStmt = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'hotspot_title'");
     $updateStmt->execute([$newHotspotTitle]);
 
     $updateFreeTrialStmt = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'free_trial'");
     $updateFreeTrialStmt->execute([$newFreeTrialSetting]);
 
     $updateColorSchemeStmt = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'color_scheme'");
     $updateColorSchemeStmt->execute([$newColorScheme]);
 
     $updateFaqStmt1 = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'frequently_asked_questions_headline1'");
     $updateFaqStmt1->execute([$newFaqHeadline1]);
 
     $updateFaqStmt2 = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'frequently_asked_questions_headline2'");
     $updateFaqStmt2->execute([$newFaqHeadline2]);
 
     $updateFaqStmt3 = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'frequently_asked_questions_headline3'");
     $updateFaqStmt3->execute([$newFaqHeadline3]);
 
     $updateFaqAnswerStmt1 = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'frequently_asked_questions_answer1'");
     $updateFaqAnswerStmt1->execute([$newFaqAnswer1]);
 
     $updateFaqAnswerStmt2 = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'frequently_asked_questions_answer2'");
     $updateFaqAnswerStmt2->execute([$newFaqAnswer2]);
 
     $updateFaqAnswerStmt3 = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'frequently_asked_questions_answer3'");
     $updateFaqAnswerStmt3->execute([$newFaqAnswer3]);
 
     $updateDescriptionStmt = $conn->prepare("UPDATE tbl_appconfig SET value = ? WHERE setting = 'description'");
     $updateDescriptionStmt->execute([$newDescription]);
 
     // Use updated values
     $hotspotTitle = $newHotspotTitle;
     $selectedColorScheme = $newColorScheme;
     $settings['frequently_asked_questions_headline1'] = $newFaqHeadline1;
     $settings['frequently_asked_questions_headline2'] = $newFaqHeadline2;
     $settings['frequently_asked_questions_headline3'] = $newFaqHeadline3;
     $settings['frequently_asked_questions_answer1'] = $newFaqAnswer1;
     $settings['frequently_asked_questions_answer2'] = $newFaqAnswer2;
     $settings['frequently_asked_questions_answer3'] = $newFaqAnswer3;
     $description = $newDescription;
 
     $primaryColor = $colorSchemes[$selectedColorScheme]['primary'];
     $secondaryColor = $colorSchemes[$selectedColorScheme]['secondary'];
 
     // Update the $freeTrialEnabled variable
     $freeTrialEnabled = ($newFreeTrialSetting === 'enable');
 
     // Assign updated values to the template
     $ui->assign('free_trial_enabled', $freeTrialEnabled);
 
         // Fetch the latest trial time limit from tbl_trials
 // Fetch the latest trial time limit and uptime reset from tbl_trials
 $trialTimeLimit = '30'; // Default value for time limit
 $uptimeReset = '1'; // Default value for uptime reset
 $trialStmt = $conn->prepare("SELECT time_limit, uptime_reset FROM tbl_trials ORDER BY id DESC LIMIT 1");
 $trialStmt->execute();
 $trialResult = $trialStmt->fetch(PDO::FETCH_ASSOC);
 
 if ($trialResult) {
     $trialTimeLimit = $trialResult['time_limit'];
     $uptimeReset = $trialResult['uptime_reset'];
 }
        // Generate login.html
        $appUrl = APP_URL;
        $dynamicAction = $appUrl . "/xendit/index" . ($routerId ?: '1') . ".html";

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

        $localFile = __DIR__ . '/login.html';
        file_put_contents($localFile, $loginHtmlContent);

        // Re-fetch router credentials for the updated routerId
        if ($routerId) {
            $stmt = $conn->prepare("SELECT ip_address, username, password FROM tbl_routers WHERE id = :router_id");
            $stmt->bindParam(':router_id', $routerId);
            $stmt->execute();
            $routerDetails = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $routerDetails = false;
        }

        if ($routerDetails) {
            $mikrotik_host = $routerDetails['ip_address'];
            $mikrotik_user = $routerDetails['username'];
            $mikrotik_pass = $routerDetails['password'];
        } else {
            $mikrotik_host = '192.168.88.1';
            $mikrotik_user = 'admin';
            $mikrotik_pass = '12345';
        }

        // FTP upload login.html to MikroTik
        $logMessages = [];
        $ftp = ftp_connect($mikrotik_host);
        if ($ftp && ftp_login($ftp, $mikrotik_user, $mikrotik_pass)) {
            ftp_pasv($ftp, true);

            $remoteFile = 'hotspot/login.html';
            if (ftp_put($ftp, $remoteFile, $localFile, FTP_BINARY)) {
                $logMessages[] = "File uploaded successfully to '$remoteFile'.";
            } else {
                $logMessages[] = "Failed to upload the file to '$remoteFile'.";
            }

            $remoteFileFlash = 'flash/hotspot/login.html';
            if (ftp_put($ftp, $remoteFileFlash, $localFile, FTP_BINARY)) {
                $logMessages[] = "File uploaded successfully to '$remoteFileFlash'.";
            } else {
                $logMessages[] = "Failed to upload the file to '$remoteFileFlash'.";
            }

            ftp_close($ftp);
        } else {
            $logMessages[] = "Failed to connect to the MikroTik router.";
        }

// Navigate two levels down to the root folder, then go one level up to the "xendit" folder
$pluginDir = dirname(__DIR__, 2) . '/xendit';

// Generate indexX.html in the xendit folder
$routerFileName = $pluginDir . "/index" . ($routerId ?: '1') . ".html";





    

        // Assuming $hotspotTitle, $secondaryColor, $phone, $company, $description, $freeTrialEnabled, $primaryColor, $trialTimeLimit, $uptimeReset, $planResult, $routerId, $settings, and APP_URL are defined
        
        $htmlContent = "<!DOCTYPE html>\n";
        $htmlContent .= "<html lang=\"en\">\n";
        $htmlContent .= "<head>\n";
        $htmlContent .= " <meta charset=\"UTF-8\">\n";
        $htmlContent .= " <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
        $htmlContent .= " <title>" . htmlspecialchars($hotspotTitle) . " Hotspot Template - Index</title>\n";
        $htmlContent .= " <script src=\"https://cdn.tailwindcss.com\"></script>\n";
        $htmlContent .= " <script src=\"https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js\"></script>\n";
        $htmlContent .= " <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css\">\n";
        $htmlContent .= " <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/glider-js@1.7.7/glider.min.css\" />\n";
        $htmlContent .= " <script src=\"https://cdn.jsdelivr.net/npm/glider-js@1.7.7/glider.min.js\"></script>\n";
        $htmlContent .= " <link rel=\"preconnect\" href=\"https://cdn.jsdelivr.net\">\n";
        $htmlContent .= " <link rel=\"preconnect\" href=\"https://cdnjs.cloudflare.com\" crossorigin>\n";
        $htmlContent .= " <link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\">\n";
        $htmlContent .= "<style>\n";
        $htmlContent .= "    .call-icon {\n";
        $htmlContent .= "        font-size: 3rem;\n";
        $htmlContent .= "        color: #25D366;\n";
        $htmlContent .= "        border-radius: 40%;\n";
        $htmlContent .= "        padding: 15px;\n";
        $htmlContent .= "        transition: transform 0.3s ease;\n";
        $htmlContent .= "    }\n";
        $htmlContent .= "    .call-icon:hover {\n";
        $htmlContent .= "        transform: scale(1.1);\n";
        $htmlContent .= "    }\n";
        $htmlContent .= "</style>\n";
        $htmlContent .= "</head>\n";
        
        $htmlContent .= "<body class=\"font-sans antialiased text-gray-900\">\n";
        $htmlContent .= "    <header class=\"bg-{$secondaryColor}-900 text-white fixed w-full z-10\">\n";
        $htmlContent .= "        <div class=\"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5\">\n";
        $htmlContent .= "            <div class=\"flex items-center justify-between h-16\">\n";
        $htmlContent .= "                <div class=\"flex items-center\">\n";
        $htmlContent .= "                    <img src=\"logo.png\" alt=\"Your Company Logo\" class=\"h-8 w-8 mr-2\">\n";
        $htmlContent .= "                    <h1 class=\"text-xl font-bold\">" . htmlspecialchars($hotspotTitle) . "</h1>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "                <div class=\"block\">\n";
        $htmlContent .= "                    <div class=\"ml-10 flex items-baseline space-x-4\">\n";
        $htmlContent .= "                        <a href=\"#alreadyHavePackage\" class=\"text-{$secondaryColor}-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium\">Already Paid? Click Here.</a>\n";
        $htmlContent .= "                        <span class=\"text-{$secondaryColor}-200\">" . htmlspecialchars($phone) . "</span>\n";
        $htmlContent .= "                    </div>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "        </div>\n";
        $htmlContent .= "    </header>\n";
        
        $htmlContent .= "    <main class=\"pt-24\">\n";
        $htmlContent .= "        <section class=\"bg-white\">\n";
        $htmlContent .= "            <div class=\"max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8\">\n";
        $htmlContent .= "                <h2 class=\"text-3xl font-extrabold text-gray-900 mb-6\">" . htmlspecialchars($description) . "</h2>\n";
        
        if ($freeTrialEnabled) {
            $htmlContent .= "<div class=\"mt-8 flex justify-center\">\n";
            $htmlContent .= "    <div class=\"bg-gradient-to-br from-{$primaryColor}-400 to-{$secondaryColor}-600 p-6 rounded-lg shadow-lg transform transition duration-500 hover:scale-105\">\n";
            $htmlContent .= "        <div class=\"text-center\">\n";
            $htmlContent .= "            <span class=\"inline-flex px-4 py-2 rounded-full text-sm font-semibold tracking-wide uppercase bg-{$secondaryColor}-800 text-white shadow-md\">Free Trial</span>\n";
            $htmlContent .= "            <div class=\"mt-4 text-2xl leading-none font-extrabold text-white\">{$trialTimeLimit} Minutes</div>\n";
            $htmlContent .= "            <p class=\"mt-2 text-base leading-6 text-{$secondaryColor}-100\">Unlimited Wifi Every {$uptimeReset} Day(s)</p>\n";
            $htmlContent .= "        </div>\n";
            $htmlContent .= "        <div class=\"mt-5 text-center\">\n";
            $htmlContent .= "            <a href=\"http://192.168.180.1/login?dst=$(link-orig-esc)&amp;username=T-$(mac-esc)\" class=\"inline-block text-{$secondaryColor}-600 bg-white border-2 border-white hover:bg-{$secondaryColor}-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-{$secondaryColor}-500 focus:ring-opacity-50 transform transition-all duration-200 ease-in-out rounded-full font-bold px-6 py-3 text-md shadow-lg\">Click Here To Start Free Trial</a>\n";
            $htmlContent .= "        </div>\n";
            $htmlContent .= "    </div>\n";
            $htmlContent .= "</div>\n";
        }
        
        
        $htmlContent .= "                <div class=\"mt-10\">\n";
        $htmlContent .= "                    <div class=\"text-center\">\n";
        $htmlContent .= "                        <h3 class=\"text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl sm:leading-9\">CHECK OUR PRICING</h3>\n";
        $htmlContent .= "                        <p class=\"mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto\">Choose the plan that fits your needs.</p>\n";
        $htmlContent .= "                    </div>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "        </section>\n";
        $htmlContent .= "    </main>\n";
        
        $htmlContent .= "<div class=\"mt-10 max-w-7xl mx-auto grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-5\">\n";
        $macPlaceholder = "$(mac)"; // just a placeholder reference
        foreach ($planResult as $plan) {
            $htmlContent .= "<div class=\"flex flex-col rounded-lg shadow-xl overflow-hidden transform transition duration-500 hover:scale-105 package\" data-amount=\"" . htmlspecialchars($plan['price']) . "\" data-plan-id=\"" . $plan['id'] . "\" data-router-id=\"" . $routerId . "\" data-mac-address=\"" . $macPlaceholder . "\">\n";
            $htmlContent .= "    <div class=\"px-4 py-5 bg-gradient-to-tr from-{$primaryColor}-50 to-{$primaryColor}-200 text-center\">\n";
            $htmlContent .= "        <span class=\"inline-flex px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase bg-{$primaryColor}-800 text-{$primaryColor}-50\">" . htmlspecialchars($plan['name_plan']) . "</span>\n";
            $htmlContent .= "        <div class=\"mt-4 text-4xl leading-none font-extrabold text-{$primaryColor}-800\">\n";
            $htmlContent .= "            <span class=\"text-lg font-medium text-{$primaryColor}-600\">PHP</span>" . htmlspecialchars($plan['price']) . "\n";
            $htmlContent .= "        </div>\n";
            $htmlContent .= "        <p class=\"mt-2 text-md leading-5 text-{$primaryColor}-700 text-center\">" . htmlspecialchars($plan['validity']) . " " . htmlspecialchars($plan['validity_unit']) . " Unlimited</p>\n";
            $htmlContent .= "    </div>\n";
            $htmlContent .= "    <div class=\"px-4 pt-4 pb-6 bg-{$primaryColor}-500 text-center\">\n";
            $htmlContent .= "        <a href=\"#\" class=\"inline-block text-{$primaryColor}-800 bg-{$primaryColor}-50 hover:bg-{$primaryColor}-100 focus:outline-none focus:ring-4 focus:ring-{$primaryColor}-500 focus:ring-opacity-50 transform transition duration-150 ease-in-out rounded-lg font-semibold px-3 py-2 text-xs shadow-lg cursor-pointer\">Click Here To Connect</a>\n";
            $htmlContent .= "    </div>\n";
            $htmlContent .= "</div>\n";
        }
        $htmlContent .= "</div>\n";
        
        $htmlContent .= "<div id=\"alreadyHavePackage\" class=\"container mx-auto px-4\">\n";
        $htmlContent .= "    <div class=\"max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-lg\">\n";
        $htmlContent .= "        <div class=\"md:flex\">\n";
        $htmlContent .= "            <div class=\"w-full p-5\">\n";
        $htmlContent .= "                <div class=\"text-center\">\n";
        $htmlContent .= "                    <h3 class=\"text-2xl text-gray-900\">Already Have an Active Package?</h3>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "                <form id=\"loginForm\" class=\"form\" name=\"login\" action=\"http://192.168.180.1/login\" method=\"post\">\n";
        $htmlContent .= "                    <input type=\"hidden\" name=\"dst\" value=\"$(link-orig)\" />\n";
        $htmlContent .= "                    <input type=\"hidden\" name=\"popup\" value=\"true\" />\n";
        $htmlContent .= "                    <div class=\"mb-4\">\n";
        $htmlContent .= "                        <label class=\"block text-gray-700 text-sm font-bold mb-2\" for=\"username\">Username</label>\n";
        $htmlContent .= "                        <input id=\"usernameInput\" class=\"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline\" name=\"username\" type=\"text\" placeholder=\"Username\" required>\n";
        $htmlContent .= "                    </div>\n";
        $htmlContent .= "                    <div class=\"mb-6\">\n";
        $htmlContent .= "                        <label class=\"block text-gray-700 text-sm font-bold mb-2\" for=\"password\">Password</label>\n";
        $htmlContent .= "                        <input id=\"passwordInput\" class=\"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline\" name=\"password\" type=\"password\" placeholder=\"******************\" required>\n";
        $htmlContent .= "                    </div>\n";
        $htmlContent .= "                    <div class=\"flex items-center justify-between\">\n";
        $htmlContent .= "                        <button id=\"submitBtn\" class=\"bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\" type=\"submit\">Click Here To Connect</button>\n";
        $htmlContent .= "                    </div>\n";
        $htmlContent .= "                </form>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "        </div>\n";
        $htmlContent .= "    </div>\n";
        $htmlContent .= "</div>\n";
        
        $htmlContent .= "<div class=\"mt-10 text-center\">\n";
        $htmlContent .= "    <a href=\"" . APP_URL . "/index.php?_route=login\" class=\"bg-{$secondaryColor}-500 hover:bg-{$secondaryColor}-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\">Have a voucher code? Click here</a>\n";
        $htmlContent .= "</div>\n";
        

        
        $htmlContent .= "<!-- Payment Modal -->\n";
        $htmlContent .= "<div id=\"payment-modal\" class=\"hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center\">\n";
        $htmlContent .= "    <div class=\"bg-white rounded-lg p-6 w-full max-w-md\">\n";
        $htmlContent .= "        <h2 class=\"text-2xl font-semibold mb-4\">Pay Securely with your Preferred Method</h2>\n";
        $htmlContent .= "        <form id=\"payment-form\" class=\"space-y-4\">\n";
        $htmlContent .= "            <input type=\"hidden\" id=\"amount\" name=\"amount\">\n";
        $htmlContent .= "            <input type=\"hidden\" id=\"plan-id\" name=\"plan_id\">\n";
        $htmlContent .= "            <input type=\"hidden\" id=\"router-id\" name=\"router_id\">\n";
        $htmlContent .= "            <input type=\"hidden\" id=\"mac-address\" name=\"mac_address\">\n";
        $htmlContent .= "            <div>\n";
        $htmlContent .= "                <label for=\"buyer_phone\" class=\"block text-gray-700 font-medium mb-2\">Enter your Phone Number</label>\n";
        $htmlContent .= "                <input type=\"text\" id=\"buyer_phone\" name=\"buyer_phone\" class=\"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline\" required>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <div>\n";
        $htmlContent .= "                <label for=\"buyer_email\" class=\"block text-gray-700 font-medium mb-2\">Enter your Email</label>\n";
        $htmlContent .= "                <input type=\"email\" id=\"buyer_email\" name=\"buyer_email\" class=\"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline\" required value=\"ueix@gmail.com\">\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <div class=\"flex items-center justify-between\">\n";
        $htmlContent .= "                <button type=\"submit\" class=\"bg-[#4F01B9] hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline rounded-full\">Proceed to Payment</button>\n";
        $htmlContent .= "                <button type=\"button\" id=\"cancel-button\" class=\"bg-gray-600 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline rounded-full\">Cancel</button>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "        </form>\n";
        $htmlContent .= "    </div>\n";
        $htmlContent .= "</div>\n";
        
        $htmlContent .= "<div class=\"mt-10 mx-auto px-4 sm:px-6 lg:px-8\">\n";
        $htmlContent .= "    <h3 class=\"text-center text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl sm:leading-9\">What Our Users Say</h3>\n";
        $htmlContent .= "    <div class=\"glider-contain mt-6\">\n";
        $htmlContent .= "        <div class=\"glider\">\n";
        $htmlContent .= "            <div class=\"bg-white rounded-lg shadow-md overflow-hidden\">\n";
        $htmlContent .= "                <img class=\"w-full h-48 object-cover object-center\" src=\"assets/img/testimonials/testimonials-3.jpg\" alt=\"Testimonial from Otieno Peter\">\n";
        $htmlContent .= "                <div class=\"p-4\">\n";
        $htmlContent .= "                    <div class=\"uppercase tracking-wide text-sm text-indigo-500 font-semibold\">Otieno Peter</div>\n";
        $htmlContent .= "                    <p class=\"mt-2 text-gray-500\">\"Switching to this service has been a game changer for me. The connection is reliable and fast, making my online work seamless and efficient.\"</p>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <div class=\"bg-white rounded-lg shadow-md overflow-hidden\">\n";
        $htmlContent .= "                <img class=\"w-full h-48 object-cover object-center\" src=\"assets/img/testimonials/testimonials-2.jpg\" alt=\"Testimonial from Kiveu\">\n";
        $htmlContent .= "                <div class=\"p-4\">\n";
        $htmlContent .= "                    <div class=\"uppercase tracking-wide text-sm text-indigo-500 font-semibold\">Kiveu</div>\n";
        $htmlContent .= "                    <p class=\"mt-2 text-gray-500\">\"I've experienced unparalleled support and service. The team goes above and beyond to ensure customer satisfaction. Highly recommend!\"</p>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <div class=\"bg-white rounded-lg shadow-md overflow-hidden\">\n";
        $htmlContent .= "                <img class=\"w-full h-48 object-cover object-center\" src=\"assets/img/testimonials/testimonials-1.jpg\" alt=\"Testimonial from Anonymous User\">\n";
        $htmlContent .= "                <div class=\"p-4\">\n";
        $htmlContent .= "                    <div class=\"uppercase tracking-wide text-sm text-indigo-500 font-semibold\">Anonymous User</div>\n";
        $htmlContent .= "                    <p class=\"mt-2 text-gray-500\">\"Their commitment to quality and speed is evident. My internet experience has been fantastic ever since I made the switch.\"</p>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "        </div>\n";
        $htmlContent .= "        <button aria-label=\"Previous\" class=\"glider-prev\">«</button>\n";
        $htmlContent .= "        <button aria-label=\"Next\" class=\"glider-next\">»</button>\n";
        $htmlContent .= "        <div role=\"tablist\" class=\"dots\"></div>\n";
        $htmlContent .= "    </div>\n";
        $htmlContent .= "</div>\n";
        
        $htmlContent .= "<script>\n";
        $htmlContent .= "new Glider(document.querySelector('.glider'), {slidesToShow:1,slidesToScroll:1,draggable:true,dots:'.dots',arrows:{prev:'.glider-prev',next:'.glider-next'},responsive:[{breakpoint:775,settings:{slidesToShow:2,slidesToScroll:2,}},{breakpoint:1024,settings:{slidesToShow:3,slidesToScroll:3,}}]});\n";
        $htmlContent .= "</script>\n";
        
        $htmlContent .= "<div class=\"mt-10 mx-auto px-4 sm:px-6 lg:px-8\">\n";
        $htmlContent .= "    <div class=\"text-center\">\n";
        $htmlContent .= "        <h3 class=\"text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl sm:leading-9\">FREQUENTLY ASKED QUESTIONS Will Be Here</h3>\n";
        $htmlContent .= "        <p class=\"mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto\">Everything you need to know before getting started.</p>\n";
        $htmlContent .= "    </div>\n";
        $htmlContent .= "    <div class=\"mt-6\">\n";
        $htmlContent .= "        <dl class=\"space-y-6\">\n";
        
        $htmlContent .= "            <div class=\"bg-white rounded-lg shadow-md\">\n";
        $htmlContent .= "                <dt class=\"p-4 cursor-pointer text-lg leading-6 font-medium text-gray-900\" onclick=\"toggleFAQ('faq1')\">" . htmlspecialchars($settings['frequently_asked_questions_headline1']) . "</dt>\n";
        $htmlContent .= "                <dd id=\"faq1\" class=\"p-4 hidden text-base text-gray-500\">" . htmlspecialchars($settings['frequently_asked_questions_answer1']) . "</dd>\n";
        $htmlContent .= "            </div>\n";
        
        $htmlContent .= "            <div class=\"bg-white rounded-lg shadow-md\">\n";
        $htmlContent .= "                <dt class=\"p-4 cursor-pointer text-lg leading-6 font-medium text-gray-900\" onclick=\"toggleFAQ('faq2')\">" . htmlspecialchars($settings['frequently_asked_questions_headline2']) . "</dt>\n";
        $htmlContent .= "                <dd id=\"faq2\" class=\"p-4 hidden text-base text-gray-500\">" . htmlspecialchars($settings['frequently_asked_questions_answer2']) . "</dd>\n";
        $htmlContent .= "            </div>\n";
        
        $htmlContent .= "            <div class=\"bg-white rounded-lg shadow-md\">\n";
        $htmlContent .= "                <dt class=\"p-4 cursor-pointer text-lg leading-6 font-medium text-gray-900\" onclick=\"toggleFAQ('faq3')\">" . htmlspecialchars($settings['frequently_asked_questions_headline3']) . "</dt>\n";
        $htmlContent .= "                <dd id=\"faq3\" class=\"p-4 hidden text-base text-gray-500\">" . htmlspecialchars($settings['frequently_asked_questions_answer3']) . "</dd>\n";
        $htmlContent .= "            </div>\n";
        
        $htmlContent .= "        </dl>\n";
        $htmlContent .= "    </div>\n";
        $htmlContent .= "</div>\n";
        
        $htmlContent .= "<script>\n";
        $htmlContent .= "function toggleFAQ(faqId) {\n";
        $htmlContent .= "    var element = document.getElementById(faqId);\n";
        $htmlContent .= "    if (element.style.display === \"block\") {\n";
        $htmlContent .= "        element.style.display = \"none\";\n";
        $htmlContent .= "    } else {\n";
        $htmlContent .= "        element.style.display = \"block\";\n";
        $htmlContent .= "    }\n";
        $htmlContent .= "}\n";
        $htmlContent .= "</script>\n";
        
        $htmlContent .= "<form id=\"loginForm\" class=\"form\" name=\"login\" action=\"$(link-login-only)\" method=\"post\" $(if chap-id)onSubmit=\"return doLogin()\"$(endif)>\n";
        $htmlContent .= "    <input type=\"hidden\" name=\"dst\" value=\"$(link-orig)\" />\n";
        $htmlContent .= "    <input type=\"hidden\" name=\"popup\" value=\"true\" />\n";
        $htmlContent .= "    <input type=\"hidden\" name=\"mac\" value=\"$(mac)\" />\n";
        $htmlContent .= "</form>\n";
        
        $htmlContent .= "<div id=\"macAddressContainer\" class=\"mt-4\">\n";
        $htmlContent .= "    <p>Your MAC Address: <span id=\"macAddressDisplay\"></span></p>\n";
        $htmlContent .= "</div>\n";
        
        $htmlContent .= "<script>\n";
        $htmlContent .= "document.addEventListener('DOMContentLoaded', function() {\n";
        $htmlContent .= "    var macAddressInput = document.querySelector('input[name=\"mac\"]');\n";
        $htmlContent .= "    var macAddressDisplay = document.getElementById('macAddressDisplay');\n";
        $htmlContent .= "    if (macAddressInput && macAddressDisplay) {\n";
        $htmlContent .= "        var macAddress = macAddressInput.value;\n";
        $htmlContent .= "        macAddressDisplay.textContent = macAddress;\n";
        $htmlContent .= "    }\n";
        $htmlContent .= "});\n";
        $htmlContent .= "</script>\n";
        
        $htmlContent .= "</section>\n";
        $htmlContent .= "</main>\n";
        
        $htmlContent .= "<footer class=\"bg-{$secondaryColor}-900 text-white\">\n";
        $htmlContent .= "    <div class=\"max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8\">\n";
        $htmlContent .= "        <div class=\"lg:grid lg:grid-cols-3 lg:gap-8\">\n";
        $htmlContent .= "            <div class=\"lg:col-span-1\">\n";
        $htmlContent .= "                <h2 class=\"text-sm font-semibold uppercase tracking-wider\">Contact Us</h2>\n";
        $htmlContent .= "                <ul class=\"mt-4 space-y-4\">\n";
        $htmlContent .= "                    <li><span class=\"block\">Address</span></li>\n";
        $htmlContent .= "                    <li><span class=\"block\">Email: contact@" . htmlspecialchars($company) . "</span></li>\n";
        $htmlContent .= "                    <li><span class=\"block\">Phone: " . htmlspecialchars($phone) . "</span></li>\n";
        $htmlContent .= "                </ul>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <div class=\"lg:col-span-1\">\n";
        $htmlContent .= "                <h2 class=\"text-sm font-semibold uppercase tracking-wider\">Quick Links</h2>\n";
        $htmlContent .= "                <ul class=\"mt-4 space-y-4\">\n";
        $htmlContent .= "                    <li><a href=\"#\" class=\"hover:underline\">About Us</a></li>\n";
        $htmlContent .= "                    <li><a href=\"#\" class=\"hover:underline\">Our Services</a></li>\n";
        $htmlContent .= "                    <li><a href=\"#\" class=\"hover:underline\">FAQ</a></li>\n";
        $htmlContent .= "                    <li><a href=\"#\" class=\"hover:underline\">Support</a></li>\n";
        $htmlContent .= "                </ul>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <div class=\"lg:col-span-1\">\n";
        $htmlContent .= "                <h2 class=\"text-sm font-semibold uppercase tracking-wider\">Follow Us</h2>\n";
        $htmlContent .= "                <div class=\"mt-4 space-x-4\">\n";
        $htmlContent .= "                    <a href=\"#\" class=\"hover:text-gray-400\"><i class=\"fab fa-facebook-f\"></i></a>\n";
        $htmlContent .= "                    <a href=\"#\" class=\"hover:text-gray-400\"><i class=\"fab fa-twitter\"></i></a>\n";
        $htmlContent .= "                    <a href=\"#\" class=\"hover:text-gray-400\"><i class=\"fab fa-instagram\"></i></a>\n";
        $htmlContent .= "                    <a href=\"#\" class=\"hover:text-gray-400\"><i class=\"fab fa-linkedin-in\"></i></a>\n";
        $htmlContent .= "                </div>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "        </div>\n";
        $htmlContent .= "        <div class=\"mt-8 border-t border-gray-700 pt-8 md:flex md:items-center md:justify-between\">\n";
        $htmlContent .= "            <div class=\"flex space-x-6 md:order-2\">\n";
        $htmlContent .= "                <a href=\"#\" class=\"text-gray-400 hover:text-gray-300\"><span class=\"sr-only\">Facebook</span><i class=\"fab fa-facebook-f\"></i></a>\n";
        $htmlContent .= "                <a href=\"#\" class=\"text-gray-400 hover:text-gray-300\"><span class=\"sr-only\">Instagram</span><i class=\"fab fa-instagram\"></i></a>\n";
        $htmlContent .= "                <a href=\"#\" class=\"text-gray-400 hover:text-gray-300\"><span class=\"sr-only\">Twitter</span><i class=\"fab fa-twitter\"></i></a>\n";
        $htmlContent .= "                <a href=\"#\" class=\"text-gray-400 hover:text-gray-300\"><span class=\"sr-only\">LinkedIn</span><i class=\"fab fa-linkedin-in\"></i></a>\n";
        $htmlContent .= "            </div>\n";
        $htmlContent .= "            <p class=\"mt-8 text-base leading-6 text-gray-400 md:mt-0 md:order-1\">&copy; 2024 FreeIspRadius. All rights reserved.</p>\n";
        $htmlContent .= "        </div>\n";
        $htmlContent .= "    </div>\n";
        $htmlContent .= "<div class=\"fixed bottom-4 right-4\">\n";
        $htmlContent .= "    <a href=\"tel:" . htmlspecialchars($phone) . "\" class=\"call-icon\">\n";
        $htmlContent .= "        <i class=\"fas fa-phone\"></i>\n";
        $htmlContent .= "    </a>\n";
        $htmlContent .= "</div>\n";
        $htmlContent .= "</footer>\n";
        

// Include SweetAlert2 twice as per your example
$htmlContent .= "<!-- Include SweetAlert2 -->\n";
$htmlContent .= "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>\n\n";

$htmlContent .= "<!-- Include SweetAlert2 -->\n";
$htmlContent .= "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>\n\n";

// Start of the JavaScript code
$htmlContent .= "<script>\n";
$htmlContent .= "document.addEventListener('DOMContentLoaded', function() {\n";
$htmlContent .= "    // 1. When a user clicks on a package\n";
$htmlContent .= "    document.querySelectorAll('.package').forEach(pkg => {\n";
$htmlContent .= "        pkg.addEventListener('click', function() {\n";
$htmlContent .= "            const amount = this.dataset.amount;\n";
$htmlContent .= "            const planId = this.dataset.planId;\n";
$htmlContent .= "            const routerId = this.dataset.routerId;\n";
$htmlContent .= "            const macAddress = this.dataset.macAddress;\n";
$htmlContent .= "            console.log(\"Selected Plan:\", { amount, planId, routerId, macAddress });\n\n";

$htmlContent .= "            // Fill hidden fields in the modal\n";
$htmlContent .= "            document.getElementById('amount').value = amount;\n";
$htmlContent .= "            document.getElementById('plan-id').value = planId;\n";
$htmlContent .= "            document.getElementById('router-id').value = routerId;\n";
$htmlContent .= "            document.getElementById('mac-address').value = macAddress;\n\n";

$htmlContent .= "            // Show the modal\n";
$htmlContent .= "            document.getElementById('payment-modal').classList.remove('hidden');\n";
$htmlContent .= "        });\n";
$htmlContent .= "    });\n\n";

// 2. Cancel button closes the modal
$htmlContent .= "    // 2. Cancel button closes the modal\n";
$htmlContent .= "    document.getElementById('cancel-button').addEventListener('click', function() {\n";
$htmlContent .= "        document.getElementById('payment-modal').classList.add('hidden');\n";
$htmlContent .= "    });\n\n";

// 3. Submit "payment-form" to create user & invoice with validation
$htmlContent .= "    // 3. Submit \"payment-form\" to create user & invoice with validation\n";
$htmlContent .= "    document.getElementById('payment-form').addEventListener('submit', function(e) {\n";
$htmlContent .= "        e.preventDefault();  // Stop normal form submission\n\n";

$htmlContent .= "        console.log(\"Payment form submitted\");\n";
$htmlContent .= "        const formData = new FormData(this);\n";
$htmlContent .= "        const data = Object.fromEntries(formData);\n";
$htmlContent .= "        console.log(\"Form Data: \", data);\n\n";

// === Updated Validation Snippet Start ===
$htmlContent .= "        // === Updated Validation Snippet Start ===\n";
$htmlContent .= "        const phone = data.buyer_phone.trim();\n";
$htmlContent .= "        const phoneRegex = /^(0\\d{9}|63\\d{10})$/;\n";
$htmlContent .= "        if (!phoneRegex.test(phone)) {\n";
$htmlContent .= "            Swal.fire(\n";
$htmlContent .= "                'Invalid Phone Number',\n";
$htmlContent .= "                'Please enter a valid phone number starting with 0 or 63.',\n";
$htmlContent .= "                'error'\n";
$htmlContent .= "            );\n";
$htmlContent .= "            return; // Stop the form submission\n";
$htmlContent .= "        }\n";
$htmlContent .= "        // === Updated Validation Snippet End ===\n\n";

$htmlContent .= "        if (!data.buyer_email) {\n";
$htmlContent .= "            data.buyer_email = 'gonet@gmail.com'; // Default email\n";
$htmlContent .= "        }\n\n";




$htmlContent .= "        // Step A: Create user on the backend\n";
$htmlContent .= "        Swal.fire({\n";
$htmlContent .= "            title: 'Creating User',\n";
$htmlContent .= "            text: 'Please wait...',\n";
$htmlContent .= "            icon: 'info',\n";
$htmlContent .= "            showConfirmButton: false,\n";
$htmlContent .= "            allowOutsideClick: false,\n";
$htmlContent .= "            allowEscapeKey: false,\n";
$htmlContent .= "            didOpen: () => { Swal.showLoading(); }\n";
$htmlContent .= "        });\n\n";

$htmlContent .= "        fetch('xendit_user.php', {\n";
$htmlContent .= "            method: 'POST',\n";
$htmlContent .= "            headers: { 'Content-Type': 'application/json' },\n";
$htmlContent .= "            body: JSON.stringify(data)\n";
$htmlContent .= "        })\n";
$htmlContent .= "        .then(res => res.json())\n";
$htmlContent .= "        .then(userData => {\n";
$htmlContent .= "            console.log(\"User Creation Response: \", userData);\n";
$htmlContent .= "            Swal.close();\n\n";

$htmlContent .= "            if (userData.error) {\n";
$htmlContent .= "                Swal.fire('Error', userData.error, 'error');\n";
$htmlContent .= "                return;\n";
$htmlContent .= "            }\n\n";

$htmlContent .= "            // Step B: Create the Xendit invoice\n";
$htmlContent .= "            Swal.fire({\n";
$htmlContent .= "                title: 'Creating Payment Invoice',\n";
$htmlContent .= "                text: 'Contacting Xendit, please wait...',\n";
$htmlContent .= "                icon: 'info',\n";
$htmlContent .= "                showConfirmButton: false,\n";
$htmlContent .= "                allowOutsideClick: false,\n";
$htmlContent .= "                allowEscapeKey: false,\n";
$htmlContent .= "                didOpen: () => { Swal.showLoading(); }\n";
$htmlContent .= "            });\n\n";

$htmlContent .= "            const paymentData = {\n";
$htmlContent .= "                phone_number: data.buyer_phone,\n";
$htmlContent .= "                plan_id: data.plan_id,\n";
$htmlContent .= "                router_id: data.router_id,\n";
$htmlContent .= "                mac_address: data.mac_address\n";
$htmlContent .= "            };\n\n";

$htmlContent .= "            fetch('xendit_payment.php', {\n";
$htmlContent .= "                method: 'POST',\n";
$htmlContent .= "                headers: { 'Content-Type': 'application/json' },\n";
$htmlContent .= "                body: JSON.stringify(paymentData)\n";
$htmlContent .= "            })\n";
$htmlContent .= "            .then(res => res.json())\n";
$htmlContent .= "            .then(paymentResp => {\n";
$htmlContent .= "                console.log(\"Payment Response:\", paymentResp);\n";
$htmlContent .= "                Swal.close();\n\n";

$htmlContent .= "                if (paymentResp.status === 'success') {\n";
$htmlContent .= "                    // === CHANGED PART #1 ===\n";
$htmlContent .= "                    // Auto-redirect to the invoice URL – no prompt, no click needed.\n";
$htmlContent .= "                    window.location.href = paymentResp.invoice_url;\n\n";

$htmlContent .= "                    // Optionally hide the modal\n";
$htmlContent .= "                    document.getElementById('payment-modal').classList.add('hidden');\n";
$htmlContent .= "                } else {\n";
$htmlContent .= "                    Swal.fire(\n";
$htmlContent .= "                        'Error',\n";
$htmlContent .= "                        paymentResp.message || 'Failed to create invoice',\n";
$htmlContent .= "                        'error'\n";
$htmlContent .= "                    );\n";
$htmlContent .= "                }\n";
$htmlContent .= "            })\n";
$htmlContent .= "            .catch(err => {\n";
$htmlContent .= "                Swal.close();\n";
$htmlContent .= "                console.error(\"Payment creation error:\", err);\n";
$htmlContent .= "                Swal.fire(\n";
$htmlContent .= "                    'Error',\n";
$htmlContent .= "                    'An error occurred while creating payment invoice. Check console for details.',\n";
$htmlContent .= "                    'error'\n";
$htmlContent .= "                );\n";
$htmlContent .= "            });\n";
$htmlContent .= "        })\n";
$htmlContent .= "        .catch(err => {\n";
$htmlContent .= "            Swal.close();\n";
$htmlContent .= "            console.error(\"User creation error:\", err);\n";
$htmlContent .= "            Swal.fire(\n";
$htmlContent .= "                'Error',\n";
$htmlContent .= "                'An error occurred while creating user. Check console for details.',\n";
$htmlContent .= "                'error'\n";
$htmlContent .= "            );\n";
$htmlContent .= "        });\n";
$htmlContent .= "    });\n\n";

$htmlContent .= "    // 4. This is for a separate button if you have it\n";
$htmlContent .= "    document.getElementById('submitBtn').addEventListener('click', function() {\n";
$htmlContent .= "        console.log('Login form submit button clicked');\n";
$htmlContent .= "    });\n";
$htmlContent .= "});\n";
$htmlContent .= "</script>\n";

// Optionally, close the body and html tags if not already done
$htmlContent .= "</body>\n";
$htmlContent .= "</html>\n";


        
        
        




    


        file_put_contents($routerFileName, $htmlContent);

        // Log if needed
        $logFile = dirname(__DIR__, 2) . '/upload_log.txt';
        foreach ($logMessages as $logMessage) {
            file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $logMessage . PHP_EOL, FILE_APPEND);
        }

        // Redirect with success message
        r2(U . "plugin/hotspot_settings_philippines", 's', "Settings Saved, Uploaded to Router, and routerX.html generated.");
    }

    // Fetch routers for the dropdown
    $routers = $conn->query("SELECT id, name FROM tbl_routers")->fetchAll(PDO::FETCH_ASSOC);

    // Assign all variables to template
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
    $ui->assign('routers', $routers);
    $ui->assign('selected_router_id', $routerId);
    $faqHeadline1 = $settings['frequently_asked_questions_headline1'];
$faqAnswer1 = $settings['frequently_asked_questions_answer1'];
$faqHeadline2 = $settings['frequently_asked_questions_headline2'];
$faqAnswer2 = $settings['frequently_asked_questions_answer2'];
$faqHeadline3 = $settings['frequently_asked_questions_headline3'];
$faqAnswer3 = $settings['frequently_asked_questions_answer3'];

$ui->assign('frequently_asked_questions_headline1', $faqHeadline1);
$ui->assign('frequently_asked_questions_answer1', $faqAnswer1);
$ui->assign('frequently_asked_questions_headline2', $faqHeadline2);
$ui->assign('frequently_asked_questions_answer2', $faqAnswer2);
$ui->assign('frequently_asked_questions_headline3', $faqHeadline3);
$ui->assign('frequently_asked_questions_answer3', $faqAnswer3);
$selectedColorScheme = $newColorScheme; // updated after form submission
$ui->assign('selected_color_scheme', $selectedColorScheme); // re-assign to Smarty



    // Display template
    $ui->display('hotspot_settings_philippines.tpl');
}
