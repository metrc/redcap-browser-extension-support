<?php
global $module;


$username = $module->validateApiToken(PROJECT_ID, $_GET['api_token']);
if (!$username) {
    echo '<br>Invalid API Token<br><br>';
    die();
}

$projects = $module->getAllProjects($username);
$projectData = array();
foreach ($projects as $pid) {
    $projectData[] = $module->getProjectData($pid);
}
$json = json_encode($projectData);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type: application/json; charset=UTF-8");
echo $json;
die();