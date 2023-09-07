<?php
global $module;

$username = $module->validateApiToken(PROJECT_ID, $_GET['api_token']);
if (!$username) {
    echo 'Invalid API Token';
    die();
}

$target_project = $module->escape($_REQUEST['target_project']);

// get the highest record number for the target project from redcap_data
$sql = "SELECT MAX(record) AS max_record FROM redcap_data WHERE project_id = ? GROUP BY record ORDER BY record DESC LIMIT 1";
$result = $module->query($sql, [$target_project]);
$row = db_fetch_assoc($result);
$max_record = $row['max_record'];

// redirect to the new record page for the target project
header("Location: " . APP_PATH_WEBROOT . "DataEntry/record_home.php?auto=1&pid=$target_project&id=" . ($max_record + 1));