<?php if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');?>
<div id="settings_form" >
  <div style="">
    <div style="float: left; width: 100%;">
      <fieldset>
        <h2><?php _e('RSS Feed Pull Help', 'rssfeedpull'); ?></h2>
        <h3><?php _e('What does RSS Feed Pull plugin do?', 'rssfeedpull');?></h3>
        <p><?php _e('It display a RSS Feed.', 'rssfeedpull');?></p>
        <br/>
        <h3><?php _e('IMPORTANT', 'rssfeedpull');?></h3>
        <p><?php _e('In order to work, you will need to place the following lines whereever you want to display the RSS Feed.', 'rssfeedpull');?></p>
        <pre>&lt;?php show_rssfeedpull(); ?&gt;</pre>
        <br />
        <br />
      </fieldset>
    </div>
    <div style="clear: both;"></div>										
  </div>
</div>