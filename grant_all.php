<?php
global $module;
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

if (!SUPER_USER) die('You must be a super user to run this script');

?>
    <h5>REDCap Browser Extension Support - Granting all users access</h5>
<?php
$db = new RedCapDB();

// fetch a list of all user names on the system
$sql = "SELECT username FROM redcap_user_information";
$q = db_query($sql);
$users = array();
while ($row = db_fetch_assoc($q)) {
    $sql = "SELECT * FROM redcap_user_rights WHERE username = ? AND project_id = ?";
    $q2 = db_query($sql, [$row['username'], PROJECT_ID]);
    $row2 = db_fetch_assoc($q2);
    if ($row2 == NULL) {
        $sql = 'INSERT INTO redcap_user_rights (username, project_id, api_export) VALUES (?, ?, ?)';
        $q3 = db_query($sql, [$row['username'], PROJECT_ID, 1]);
        $db->setAPIToken($row['username'], PROJECT_ID);
    } elseif ($row2['api_token']) {
        $db->setAPIToken($row['username'], PROJECT_ID);
    } elseif (!$row['api_export']) {
        $sql = 'UPDATE redcap_user_rights SET api_export = ? WHERE username = ? AND project_id = ?';
        $q3 = db_query($sql, [1, $row['username'], PROJECT_ID]);
    } else {
        // echo 'User ' . $row['username'] . ' already has access to this project<br>';
    }

}
?>

<p>All users granted access to this project and API tokens have been generated.</p>

<?php require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';