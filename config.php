<?php
global $module, $redcap_version, $redcap_base_url;
$super_user = false;

$username = $module->validateApiToken(PROJECT_ID, $_GET['api_token']);
if (!$username) {
    echo '<br>Invalid API Token<br><br>';
    die();
}
$result = array(
    'projects_url' => $module->getUrl('projects.php', true, true) . '&api_token=' . $_GET['api_token'],
    'redcap_version' => $redcap_version,
    'super_user' => $module->isUserAdmin($username),
    'base_url' => $redcap_base_url
);
$json = json_encode($result);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type: application/json; charset=UTF-8");
echo $json;