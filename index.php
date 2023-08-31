<?php
global $module;
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

$api_token = $module->getAPIToken(USERID, PROJECT_ID);


if (!$api_token) {
    echo '<br>You do not have an API Token for this project. You must request one from your administrator.  You can also access
        this page in a different project in which you have an API key.';
    die();
}
$url = $module->getUrl('config.php', true, true);
$url .= '&api_token=' . $module->getAPIToken(USERID, PROJECT_ID);

?>
<h5>REDCap Browser Extension Support</h5>
<p>
First, you need to install the browser extension from the appropriate store.  You can find the extension here:
    <ul>
    <li><strong>Firefox: </strong></li>
    <li><strong>Chrome, Edge, and Opera: </strong></li>
    <li><strong>Safari: </strong>Under development</li>
</ul>

</p><p>
Once you have installed the extension, you need to configure it.  <button onclick="navigator.clipboard.writeText('<?php echo $url ?>');">Click this button</button> to copy your configuration to your clipboard.
</p><p>
Next, open the extension.  A popup should appear asking for your configuration URL.  Paste the contents of your clipboard in the field and click save.
</p><p>
    If a popup window doesn't appear, then you need to select the extension icon in your browser's toolbar.  Right click on it, then select "Configure" or "Options".
    Paste the contents of your clipboard in the field and click save.
</p>
<p>&nbsp;</p>
<p><strong>To Use</strong>:  Click the extension's icon (if you have it pinned).  You'll be presented with a popup box.  Start typing the project name and
select it from the list.  Then just enter a new or existing record ID and click "Go".  If you're already logged into REDCap, you will be taken straight to the record
    in a new browser tab.  If you're not logged in, you will be prompted to login and then redirected to the record home page.</p>
<?php require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';