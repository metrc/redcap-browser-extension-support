<?php
namespace METRC\BrowserExtension;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;


class BrowserExtension extends AbstractExternalModule {

    public function redcap_module_link_check_display($project_id, $link) {
        if ($this->getAPIToken(USERID, $project_id)) return $link;
    }


    public function getAPIToken($user, $project_id) {
        $sql = "SELECT api_token FROM redcap_user_rights WHERE username = ? AND project_id = ? AND api_token IS NOT NULL";
        $q = db_query($sql, [$user, $project_id]);
        $row = db_fetch_assoc($q);
        return ($row['api_token']) ?? false;
    }

    public function validateAPIToken($project_id, $api_token) {
        $sql = "SELECT username FROM redcap_user_rights WHERE project_id = ? AND api_token = ?";
        $q = db_query($sql, [$project_id, $api_token]);
        $row = db_fetch_assoc($q);
        return ($row['username']) ?? false;
    }

    public function getAllProjects($username, $term) {
        $username = db_escape($username);
        $term = db_escape($term);
        $userAdmin = $this->isUserAdmin($username);
        $userQuery = "SELECT redcap_user_rights.project_id, redcap_projects.app_title FROM redcap_user_rights, redcap_projects 
                            WHERE redcap_user_rights.project_id = redcap_projects.project_id AND redcap_projects.app_title LIKE '%$term%'";
        if (!$userAdmin) $userQuery .= " AND  redcap_user_rights.username = '$username'";
        $userQuery .= " GROUP BY redcap_projects.project_id";
        $userQuery .= " ORDER BY redcap_projects.app_title ASC";
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

    public function getConfigurationKey($user, $project_id) {
        global $redcap_version, $redcap_base_url;
        $api_token = $this->getAPIToken($user, $project_id);
        $configuration_key = $redcap_base_url . '|' . $redcap_version . '|' . db_escape($_GET['prefix']) . '|' . $project_id . '|' . $api_token . '|' . $this->isUserAdmin($user);
        return $configuration_key;
    }


}