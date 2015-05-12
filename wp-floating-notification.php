<?php
/**
 * Plugin Name: WP Floating Notification
 * Plugin URI: http://www.vibgyorlogics.com
 * Description: WP Floating Notification , Notification: Error, Warning, Success, Info.
 * Version: 1.0.0
 * Author: Vishal Kamal
 * Author URI: http://www.trickyworld.in/
 * License: Vibgyor logic Copyright @2015.
 */

add_action('admin_menu', 'wp_floating_notification_menu');

function wp_floating_notification_menu() {

	//create new top-level menu
	add_menu_page('Wp Floating Notification', 'Wp Floating Notification', 'administrator', __FILE__, 'wp_floating_notification_settings_page');
	
}

add_action('wp_head', 'wp_floating_notification_incluejscss');
function wp_floating_notification_incluejscss(){
	wp_enqueue_style( 'wp_notification_css', plugins_url( '/css/style.css' , __FILE__ ) );
	wp_enqueue_script( 'wp_notification_js',plugins_url( '/js/script.js' , __FILE__ ), array(), '1.0.0', true );
	
}

add_action('wp_footer', 'wp_floating_notification_settings_page');
function wp_floating_notification_settings_page() {
	$html = "<div id = 'wp-notfication_wraper'>";
  if(isset($_SESSION['wpnotifications'])){
	  $msg_type = 'error';
     foreach($_SESSION['wpnotifications'] as $key => $values){
		 if($values['msgtype'] == 'error')
			  $msg_type = 'error';		 
		 if($values['msgtype'] == 'warning')
			  $msg_type = 'warning';
		 if($values['msgtype'] == 'success')
			  $msg_type = 'success';
		 if($values['msgtype'] == 'info')
			  $msg_type = 'info';
		 $html .= "<div  class = 'wp_notification notification_".$msg_type."'><span class = 'close_notification'>X</span><p>".$values['msg']."</p></div>";
		}
  }
  $html .= "</div>";
  echo $html;
  unset($_SESSION['wpnotifications']);
}

add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function setWpNotification($msg = '', $msgType = 'error'){
		if(!empty($msg)){
				$tmp = array(
					'msg' => $msg,
					'msgtype' => $msgType,
					'status' => 1
					);
				//var_dump(count($_SESSION['wpnotifications']));die;
				$_SESSION['wpnotifications'][] = $tmp;
				
		}
		
	}
	
function getWpNotification(){
		return $_SESSION['wpnotifications'];
	}