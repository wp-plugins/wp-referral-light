<?php
/*
Plugin Name: WordPress Referral Lite
Description: WordPress Referral Lite is a very useful plugin that extends your Wordpress website with a very effective referral system. You have an option to use cookies to track your website referrals. 
Author: markessence
Author URI: http://markessence.com
Version: 1.1
*/
ob_start();

# Set/Read Cookie ref
$ref = 0;
$ref = (int)$_GET['ref'];
if (isset($_GET['ref']) && !empty($_GET['ref']) && $_GET['ref'] != 0) {
	$ref = (int)$_POST['ref'];
	setcookie('ref',(int)$_GET['ref'],time()+60*60*24*30);
}
else if (isset($_COOKIE['ref']) && !empty($_COOKIE['ref']))
$ref = (int)$_COOKIE['ref'];
# Edit User
add_action( 'personal_options_update', 'update_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );
function update_extra_profile_fields( $user_id ) { 
    global $current_user,$wpdb;
    get_currentuserinfo();
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    if (in_array('administrator', $current_user->roles) || $current_user->data->ID==$user_id){
	    $userdata = array();
	    //$userdata['ID'] = $user_id;                    
	    $userdata['referral_id'] = $_POST['referral_id'];
	    update_user_meta( $user_id, 'referral_id', $_POST['referral_id'] );
    }
}
# Adding User 
add_action('user_register', 'register_post_fields');
function register_post_fields($user_id, $password='', $meta=array())  {
    $userdata = array();
    $userdata['ID'] = $user_id;
    $userdata['referral_id'] = $_POST['referral_id'];
    wp_update_user($userdata);
    update_user_meta( $user_id, 'referral_id', $_POST['referral_id'] );    
}
# Listing User ID & Referral ID in profile page
function profile_fields($profile_fields) {
    global $current_user,$wpdb;
    get_currentuserinfo();
	// Add new fields ONLY for admin
	if (in_array('administrator', $current_user->roles)){
		$profile_fields['referral_id'] = 'Referral ID';
	}
	return $profile_fields;
}
add_filter('user_contactmethods', 'profile_fields');
# Adding hidden WP Refferal code to the registration form
add_action('register_form','register_extra_fields');
function register_extra_fields(){
	$ref = 0;
	$ref = (int)$_GET['ref'];
	if (isset($_COOKIE['ref']) && !empty($_COOKIE['ref']))
	$ref = (int)$_COOKIE['ref'];
	echo '<input type="hidden"  size="25" value="'.$ref.'" name="referral_id" readonly="readonly" />';
} 
# Adding hidden WP Refferal codein users listing
add_filter('manage_users_columns', 'add_user_data_column');
function add_user_data_column($columns) {
    $columns['user_id'] = 'User ID';
    $columns['referral_id'] = 'Referral ID';
    return $columns;
}
add_action('manage_users_custom_column',  'show_user_id_content', 10, 3);
function show_user_id_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    switch ($column_name) {
        case 'user_id' :
        	return $user_id;
            break;
        case 'referral_id' :
            return get_the_author_meta('referral_id', $user->ID);
            break;
        default:
    }
    return $return;
}	
# Adding shortcode [referral_link]
function WP_Referral_link_shortcode( $atts ){
	if ( is_user_logged_in() ) {
		$html = "Your plain link is: ".site_url('/wp-login.php?action=register&ref=').get_current_user_id()."<br />";
		$html .= '<p><small><em>Powered by <a href="http://markessence.com/blog/demo/wp-referral/" title="WordPress Referral Plugin" target="_blank" rel="external"> WordPress Referral Plugin</em></small></p>';
		return $html;
	}
}
add_shortcode( 'referral_link', 'WP_Referral_link_shortcode' );