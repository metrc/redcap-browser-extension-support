<?php
namespace METRC\BrowserExtension;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;


class BrowserExtension extends AbstractExternalModule {

    public function getAPIToken($user, $project_id) {
        $sql = "SELECT api_token FROM redcap_user_rights WHERE username = '$user' AND project_id = '$project_id' AND api_token IS NOT NULL";
        $q = db_query($sql);
        $row = db_fetch_assoc($q);
        return ($row['api_token']) ?? false;
    }

    public function validateAPIToken($project_id, $api_token) {
        $sql = "SELECT username FROM redcap_user_rights WHERE project_id = '$project_id' AND api_token = '$api_token'";
        $q = db_query($sql);
        $row = db_fetch_assoc($q);
        return ($row['username']) ?? false;
    }

    public function getAllProjects($username) {
        $userAdmin = $this->isUserAdmin($username);
        $userQuery = "SELECT project_id FROM redcap_user_rights";
        if (!$userAdmin) $userQuery .= " WHERE username = '$username'";


        $q = db_query($userQuery);
        $projects = array();
        while ($row = db_fetch_assoc($q)) {
            $projects[] = $row['project_id'];
        }
        return $projects;
    }

    public function getProjectData($pid) {
        $sql = "SELECT project_id as `value`, app_title as `label` FROM redcap_projects WHERE project_id = '$pid'";
        $q = db_query($sql);
        $row = db_fetch_assoc($q);
        return $row;
    }

    public function isUserAdmin($username) {
        $sql = "SELECT * FROM redcap_user_information WHERE username = '$username' AND super_user = '1'";
        $q = db_query($sql);
        $row = db_fetch_assoc($q);
        return ($row) ? true : false;
    }

}