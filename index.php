<?php
/*
  Plugin Name: RSS Feed Pull
  Plugin URI: https://example.com
  Description: Pulls Dynamic Feed content into you OsClass Site
  Version: 1.0.0
  Author: Clarence Middleton
  Author URI: https://clarencemiddleton.com
  Author Email: ClarenceCM3@gmail.com
  Short Name: rssfeedpull
  Plugin update URI: rssfeedpull
  Support URI: https://forums.osclasspoint.com/free-plugins/
  Product Key: RvR9IqCQA0IVv57n7P
*/

/*********************
 * Add Option to include Link to RSS Feeds you want
 * Add Option to rotate by different feed
 * Create Page that pulls content of feed not just link
 * 
 * Style Top of Page, or move to side bar
 * Locations
/home/listcarboncredits/public_html/oc-content/themes/sigma/header.php -82
/home/listcarboncredits/public_html/oc-content/themes/sigma/item.php - 100
 * 
 * 
 * 
 * 
 */


function rssfeedpull_install() {
    @mkdir(osc_content_path().'uploads/rssfeedpull/');
    $conn= getConnection();
    osc_set_preference('upload_path', osc_content_path().'uploads/rssfeedpull/', 'rssfeedpull', 'STRING');
    osc_set_preference('upload_url', osc_base_url().'oc-content/uploads/rssfeedpull/', 'rssfeedpull', 'STRING');
    osc_set_preference('code_size', '2', 'rssfeedpull', 'INTEGER');
    $conn->commit();
  }

  function rssfeedpull_uninstall() {
    $conn= getConnection();
    osc_delete_preference('upload_path', 'rssfeedpull');
    osc_delete_preference('upload_url', 'rssfeedpull');
    osc_delete_preference('code_size', 'rssfeedpull');
    $conn->commit();
    $files = glob(osc_get_preference('upload_path', 'rssfeedpull')."*.png");
    foreach($files as $f) {
      @unlink($f);
    }
    @rmdir(osc_get_preference('upload_path', 'rssfeedpull'));
  }



  function rssfeedpull_admin_menu() {
    if(osc_version()<320) {
      echo '<h3><a href="#">RSS Feed Pull</a></h3>
      <ul>        
        <li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'help.php') . '">&raquo; ' . __('Help', 'rssfeedpull') . '</a></li>
      </ul>';
    } else {
      osc_add_admin_submenu_divider('plugins', 'RSS Feed Pull', 'rssfeedpulls_divider', 'administrator');
      // osc_add_admin_submenu_page('plugins', __('RSS Feed Pull Settings', 'rssfeedpull'), osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'conf.php'), 'rssfeedpull_settings', 'administrator');
      osc_add_admin_submenu_page('plugins', __('RSS Feed Pull Help', 'rssfeedpull'), osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'help.php'), 'rssfeedpull_help', 'administrator');
    }
  }
  function show_rssfeedpull() {
    echo getFeed("https://www.carboncreditcart.com/carbon-credit-cart-blog/feed/");
  }


  function getFeed($feed_url) {
     
    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
     
    echo "<ul>";
     
    foreach($x->channel->item as $entry) {
        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
    }
    echo "</ul>";
  }
  



  /**
 * ADD HOOKS
 */
osc_register_plugin(osc_plugin_path(__FILE__), 'rssfeedpull_install');
osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'rssfeedpull_uninstall');

// FANCY MENU
if(osc_version()<320) {
    osc_add_hook('admin_menu', 'rssfeedpull_admin_menu');
  } else {
    osc_add_hook('admin_menu_init', 'rssfeedpull_admin_menu');
  } 
  
?>