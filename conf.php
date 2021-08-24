<?php if (!defined('OC_ADMIN') || OC_ADMIN !== true) exit('Access is not allowed.');
if (Params::getParam('plugin_action') == 'done') {
  osc_set_preference('rssfeed_url', Params::getParam('rssfeed_url'), 'rssfeedpull', 'STRING');
  echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. Feed is Added, See Help for Install Details', 'rssfeedpull') . '.</p></div>';
  osc_reset_preferences();
}
?>


<p>Current Feed: <?php echo osc_get_preference('rssfeed_url', 'rssfeedpull'); ?> </p>
<div id="settings_form">
  <div>
    <div style="float: left; width: 100%;">
      <fieldset>
        <h2><?php _e('RSS Feed Pull', 'rssfeedpull'); ?></h2>
        <form name="rssfeedpull_form" id="rssfeedpull_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data">
          <div style="float: left; width: 100%;">
            <input type="hidden" name="page" value="plugins" />
            <input type="hidden" name="action" value="renderplugin" />
            <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>conf.php" />
            <input type="hidden" name="plugin_action" value="done" />
            <label for="upload_path"><?php _e('RSS Feed', 'rssfeedpull'); ?></label>
            <br />
            <input type="text" name="rssfeed_url" id="rssfeed_url" style="width:720px;" value="<?php echo osc_get_preference('rssfeed_url', 'rssfeedpull'); ?>" />
            <br />
            <br />
            <br />
            <br />
            <span style="float:left;margin-top:15px;"><button type="submit" class="btn btn-submit" style="float: left;"><?php _e('Update', 'rssfeedpull'); ?></button></span>
          </div>
          <br />
          <div style="clear:both;"></div>
        </form>
      </fieldset>
    </div>
    <div style="clear: both;"></div>
  </div>
</div>