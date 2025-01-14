<?php
include "../init.php";

/**
 * PHP Mikrotik Billing (https://freeispradius.com/)
 * by https://t.me/freeispradius
 **/

_admin();
$ui->assign('_title', Lang::T('Router Files Management'));
$ui->assign('_system_menu', 'network');

$admin = Admin::_info();
$ui->assign('_admin', $admin);

use PEAR2\Net\RouterOS;

require_once 'system/autoload/PEAR2/Autoload.php';

if (!in_array($admin['user_type'], ['SuperAdmin', 'Admin'])) {
    _alert(Lang::T('You do not have permission to access this page'), 'danger', "dashboard");
}

$action = $routes['1'] ?? 'list';

switch ($action) {
    case 'list':
        // Display the main Files management page
        $routers = ORM::for_table('tbl_routers')->find_many();
        $ui->assign('routers', $routers);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['router_id'])) {
            $router_id = $_POST['router_id'];
            $router = ORM::for_table('tbl_routers')->find_one($router_id);

            if ($router) {
                try {
                    $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                    // Fetch Files
                    $fileRequest = new RouterOS\Request('/file/print');
                    $fileResponse = $client->sendSync($fileRequest);

                    $files = [];
                    foreach ($fileResponse as $file) {
                        $files[] = [
                            'id' => $file->getProperty('.id'),
                            'name' => $file->getProperty('name'),
                            'type' => $file->getProperty('type'),
                            'size' => $file->getProperty('size'),
                            'creation_time' => $file->getProperty('creation-time'),
                            'path' => $file->getProperty('name'), // Include the path for directory navigation
                        ];
                    }

                    // Fetch Directories (assuming directories are represented as files with 'directory' type)
                    $directories = array_filter($files, function($file) {
                        return $file['type'] === 'directory';
                    });

                    $ui->assign('selected_router', $router);
                    $ui->assign('files', $files);
                    $ui->assign('directories', $directories);
                } catch (Exception $e) {
                    error_log('Error fetching files: ' . $e->getMessage());
                    r2(U . 'router_files/list', 'e', Lang::T('Error fetching files: ') . $e->getMessage());
                }
            } else {
                r2(U . 'router_files/list', 'e', Lang::T('Router not found'));
            }
        }

        $ui->display('router_files.tpl');
        break;

   

        case 'upload':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $router_id = $_POST['router_id'] ?? null;
                $destination_path = $_POST['destination_path'] ?? '';
                $router = ORM::for_table('tbl_routers')->find_one($router_id);
        
                if ($router) {
                    if (isset($_FILES['files'])) {
                        try {
                            $ftp_host = $router['ip_address'];
                            $ftp_user = $router['username'];
                            $ftp_pass = $router['password'];
        
                            // Connect to MikroTik router via FTP
                            $ftp = ftp_connect($ftp_host);
                            if ($ftp && ftp_login($ftp, $ftp_user, $ftp_pass)) {
                                ftp_pasv($ftp, true);
        
                                // Process each uploaded file
                                $file_count = count($_FILES['files']['name']);
                                for ($i = 0; $i < $file_count; $i++) {
                                    $uploadFile = $_FILES['files']['tmp_name'][$i];
                                    $remoteFileName = $_FILES['files']['name'][$i];
                                    $remoteFilePath = $_FILES['files']['full_path'][$i]; // Relative path
        
                                    // Construct the remote file path
                                    $remoteFile = $destination_path . '/' . $remoteFilePath;
                                    $remoteFile = ltrim($remoteFile, '/'); // Remove leading slash
        
                                    // Ensure the directory exists on the router
                                    $directories = explode('/', dirname($remoteFile));
                                    $currentPath = '';
                                    foreach ($directories as $dir) {
                                        $currentPath .= '/' . $dir;
                                        ftp_mkdir($ftp, ltrim($currentPath, '/'));
                                    }
        
                                    // Upload the file
                                    if (!ftp_put($ftp, $remoteFile, $uploadFile, FTP_BINARY)) {
                                        throw new Exception("Failed to upload file: $remoteFileName");
                                    }
                                }
        
                                ftp_close($ftp);
                                r2(U . 'router_files/list', 's', Lang::T('Files uploaded successfully'));
                            } else {
                                r2(U . 'router_files/list', 'e', Lang::T('Failed to connect to the MikroTik router via FTP'));
                            }
                        } catch (Exception $e) {
                            error_log('Error uploading files: ' . $e->getMessage());
                            r2(U . 'router_files/list', 'e', Lang::T('Error uploading files: ') . $e->getMessage());
                        }
                    } else {
                        r2(U . 'router_files/list', 'e', Lang::T('No files selected for upload'));
                    }
                } else {
                    r2(U . 'router_files/list', 'e', Lang::T('Router not found'));
                }
            } else {
                r2(U . 'router_files/list', 'e', Lang::T('Invalid request'));
            }
            break;

    case 'delete':
        $router_id = $_POST['router_id'] ?? null;
        $file_name = $_POST['file_name'] ?? null;

        $router = ORM::for_table('tbl_routers')->find_one($router_id);

        if ($router) {
            try {
                $client = new RouterOS\Client($router['ip_address'], $router['username'], $router['password']);

                // Delete the file using the '/file/remove' command
                $removeFileRequest = new RouterOS\Request('/file/remove');
                $removeFileRequest->setArgument('numbers', $file_name);

                $client->sendSync($removeFileRequest);

                r2(U . 'router_files/list', 's', Lang::T('File deleted successfully'));
            } catch (Exception $e) {
                error_log('Error deleting file: ' . $e->getMessage());
                r2(U . 'router_files/list', 'e', Lang::T('Error deleting file: ') . $e->getMessage());
            }
        } else {
            r2(U . 'router_files/list', 'e', Lang::T('Router not found'));
        }
        break;

    default:
        r2(U . 'router_files/list', 's', '');
}
?>
