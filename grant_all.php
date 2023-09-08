<?php
global $module;
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

if (!SUPER_USER) die('You must be a super user to run this script');

?>
    <h5>REDCap Browser Extension Support</h5>
<p>
<?php
$db = new RedCapDB();

// fetch a list of all user names on the system
$sql = "SELECT username FROM redcap_user_information";
$q = db_query($sql);
$users = array();
while ($row = db_fetch_assoc($q)) {
    $sql = "SELECT api_token, api_export FROM redcap_user_rights WHERE username = ? AND project_id = ?";
    $q2 = db_query($sql, [$row['username'], PROJECT_ID]);
    $row2 = db_fetch_assoc($q2);
    if (!$row2) {
        // grant access to this project and generate an API token
        $sql = 'INSERT INTO redcap_user_rights (username, project_id, api_export) VALUES (?, ?, ?)';
        $q3 = db_query($sql, [$row['username'], PROJECT_ID, 1]);
        $db->setAPIToken($row['username'], PROJECT_ID);
        echo "Granted access and generated API token for {$row['username']}<br>";
        continue;   // don't repeat the operations below
    }
    if (!$row2['api_token']) {
        // just generate an API token
        $db->setAPIToken($row['username'], PROJECT_ID);
        echo "Generated API token for {$row['username']}<br>";
    }
    if (!$row2['api_export']) {
        // just add API export rights
        $sql = 'UPDATE redcap_user_rights SET api_export = ? WHERE username = ? AND project_id = ?';
        $q3 = db_query($sql, [1, $row['username'], PROJECT_ID]);
        echo "Granted API export rights to {$row['username']}<br>";
    }

}
?>
</p>
<p>All operations complete.</p>

<?php require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';