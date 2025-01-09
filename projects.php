<?php
global $module;

$username = $module->validateApiToken(PROJECT_ID, $_GET['api_token']);
if (!$username) {
    echo 'Invalid API Token';
    die();
}

$projects = $module->getAllProjects($username, $_GET['term']);
$projectData = array();
foreach ($projects as $pid) {
    $projectData[] = $module->escape($module->getProjectData($pid));
}
$json = json_encode($projectData);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
header("Pragma: no-cache");
header("Expires: Mon, 01 Jan 1990 00:00:00 GMT");
echo $json;
die();