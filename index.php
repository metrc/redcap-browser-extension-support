<?php
global $module;
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

?>
<h5>REDCap Browser Extension Support</h5>
<p>
First, you need to install the browser extension from the appropriate store.  You can find the extension here:<br/><br/>
    <strong>For Chrome, Chromium, Microsoft Edge, and Opera</strong><br/>
    <a href="https://chrome.google.com/webstore/detail/redcap-browser-extension/gplbopmpolkcfokdhjeclihfhnlhleji" target="_blank">
        <img src="<?php echo $module->getUrl("chrome_store_button.png") ?>" alt="Chrome Web Store"></a><br/><br/>


    <strong>For Firefox</strong><br/>
    <a href="https://addons.mozilla.org/en-US/firefox/addon/redcap-browser-extension/" target="_blank">
        <img src="<?php echo $module->getUrl("firefox_addon.webp") ?>" alt="Firefox Addons"></a><br/><br/>

</p>


    <p>
Once you have installed the extension, you need to configure it.  <button onclick="navigator.clipboard.writeText('<?php echo $module->getConfigurationKey(USERID, PROJECT_ID) ?>');">
        Click this button</button> to copy your configuration key to your clipboard.
    <strong>Do not share your configuration key with anyone.</strong>  It contains your API token and anyone with access to it can get a list of your projects.
</p><p>
Next, open the extension.  A popup should appear asking for your configuration key.  Paste the contents of your clipboard in the field and click save.
</p><p>
    If a popup window doesn't appear, then you need to select the extension icon in your browser's toolbar.  Right click on it, then select "Configure" or "Options".
    Paste the contents of your clipboard in the field and click save.
</p>
<p>
    Once you have configured the extension, you can use it to quickly navigate to a record in REDCap.  Just click the extension's icon (if you have it pinned).
    You'll be presented with a popup box.  Start typing the project name and select it from the list.  Then just enter a new or existing record ID and click "Go".
    If you're already logged into REDCap, you will be taken straight to the record in a new browser tab.  If you're not logged in, you will be prompted to log in and
    then redirected to the record's home page.</p>


<?php if (SUPER_USER): ?>
<p><h3>Admin Tools</h3>
<a href="<?php echo $module->getUrl('grant_all.php'); ?>">Grant all users access to this project</a> (may take a few moments to load while the operation completes)

    </p>
<?php endif; ?>

<?php require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';