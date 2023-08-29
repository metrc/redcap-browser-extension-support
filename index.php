<?php
global $module;
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

$api_token = $module->getAPIToken(USERID, PROJECT_ID);


if (!$api_token) {
    echo '<br>You do not have an API Token. Please generate one in this project first or revisit this page in a project you already have an API key.<br><br>';
    die();
}
$url = $module->getUrl('config.php', true, true);
$url .= '&api_token=' . $module->getAPIToken(USERID, PROJECT_ID);

echo '<br>Your Browser Extension Configuration URL is: <a href="' . $url . '">' . $url . '</a><br><br>';

?>
