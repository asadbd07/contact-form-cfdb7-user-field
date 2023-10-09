<?php
/*
Plugin name: Contact Form CFDB7 User Field
Description: Modify CF7 submissions to include the logged-in username in Contact Form CFDB7. If no user is logged-in then it will return Guest.
Author: Md Asaduzzaman
Author URI: https://github.com/asadbd07/
Version: 1.0
*/

//Global variable
$user = "";
add_action('wp_loaded', 'add_cf7_custom_data_filter');

function add_cf7_custom_data_filter() {
    global $user;
    if ( is_user_logged_in() ) {
    	 $current_user = wp_get_current_user();
         $user = $current_user->user_login;
    } else {
	     $user = "Guest";
    }
   
    add_filter('cfdb7_before_save_data', 'add_custom_data_to_cf7_submission', 10, 1);
}

function add_custom_data_to_cf7_submission($form_data) {
    global $user;
    $form_data['Submitted by'] = $user;
    return $form_data;
}
?>