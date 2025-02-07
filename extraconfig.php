<?php
global $module, $redcap_version;

$username = $module->validateApiToken(PROJECT_ID, $_GET['api_token']);
if (!$username) {
    echo 'Invalid API Token';
    die();
}

$returnData['system_admin'] = ($module->isUserAdmin($username));
$returnData['redcap_version'] = $redcap_version;

$allProjects = $module->getAllProjects($username, '%');

foreach($allProjects as $pid) {
    $returnData['project_data'][$pid] = $module->escape($module->getProjectPerms($username, $pid));
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
header("Pragma: no-cache");
header("Expires: Mon, 01 Jan 1990 00:00:00 GMT");

echo json_encode($returnData);
die();