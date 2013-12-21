<?php
// Processing Seasons
function get_season($date, $hemisphere) {
	if($hemisphere=="") {
		$hemisphere = "northern";
	}
	$date = date("Y-m-d");
	$season_names = array('winter', 'spring', 'summer', 'autumn');
	$date_year = date("Y", strtotime($date));
	switch (strtolower($hemisphere)) {
		case "northern": {
			if (
				strtotime($date)<strtotime($date_year.'-03-21') || 
				strtotime($date)>=strtotime($date_year.'-12-21')
			) { 
				return $season_names[0]; // Must be in Winter
			}elseif (strtotime($date)>=strtotime($date_year.'-09-23')) {
				return $season_names[3]; // Must be in Fall
			}elseif (strtotime($date)>=strtotime($date_year.'-06-21')) {
				return $season_names[2]; // Must be in Summer
			}elseif (strtotime($date)>=strtotime($date_year.'-03-21')) {
				return $season_names[1]; // Must be in Spring
			}
			break;
		}
		case "southern": {
			if (
				strtotime($date)<strtotime($date_year.'-03-21') || 
				strtotime($date)>=strtotime($date_year.'-12-21')
			) { 
				return $season_names[2]; // Must be in Summer
			}elseif (strtotime($date)>=strtotime($date_year.'-09-23')) {
				return $season_names[1]; // Must be in Spring
			}elseif (strtotime($date)>=strtotime($date_year.'-06-21')) {
				return $season_names[0]; // Must be in Winter
			}elseif (strtotime($date)>=strtotime($date_year.'-03-21')) {
				return $season_names[3]; // Must be in Fall	
			}
			break;
		}
		case "australia": {
			if (
				strtotime($date)<strtotime($date_year.'-03-01') || 
				strtotime($date)>=strtotime($date_year.'-12-01')
			) { 
				return $season_names[2]; // Must be in Summer
			}elseif (strtotime($date)>=strtotime($date_year.'-09-01')) {
				return $season_names[1]; // Must be in Spring
			}elseif (strtotime($date)>=strtotime($date_year.'-06-01')) {
				return $season_names[0]; // Must be in Winter
			}elseif (strtotime($date)>=strtotime($date_year.'-03-01')) {
				return $season_names[3]; // Must be in Fall	
			}
			break;
		}
		default: { echo "Invalid hemisphere set"; }
	}

}
function magicbg_admin_page() {
	global $magicbg_credits;
	global $magicbg_hemisphere;
 ?>
<div class="wrap">
	<div id="fsb-wrap" class="fsb-help">
		<div id="icon-themes" class="icon32"></div>  
        <h2>WordPress Magic Backgrounds</h2>  
        <?php
        	settings_errors();
        	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general'; ?>  
        <h2 class="nav-tab-wrapper">  
	        <a href="?page=magic-backgrounds&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General Settings</a>  
	        <a href="?page=magic-backgrounds&tab=seasons" class="nav-tab <?php echo $active_tab == 'seasons' ? 'nav-tab-active' : ''; ?>">Seasons Backgrounds</a>  
	        <a href="?page=magic-backgrounds&tab=special" class="nav-tab <?php echo $active_tab == 'special' ? 'nav-tab-active' : ''; ?>">Special Days Backgrounds</a>
	    </h2>  



	    <?php // GENERAL SETTINGS
	    	if( $active_tab == 'general' ) {
	    		if (!isset($_REQUEST['updated']))
					$_REQUEST['updated'] = false;
				if (false !== $_REQUEST['updated']) : ?>
			<div class="updated fade"><p><strong>Options saved</strong></p></div>
			<?php endif; ?>
		<form method="post" action="options.php">
		<?php settings_fields( 'magicbg_register_settings_general' ); ?>
			<h3>Hemisphere Settings</h3>
			<p> You can set your hemisphere by choosing from the srop down below. <br />Your hemisphere is 
				<select name="magicbg_hemisphere" id="magicbg_hemisphere">
					<option value="northern" <?php if($magicbg_hemisphere=="northern") { echo 'selected=""'; } ?> >northern</option>
					<option value="southern" <?php if($magicbg_hemisphere=="southern") { echo 'selected=""'; } ?> >southern</option>
					<option value="australia" <?php if($magicbg_hemisphere=="australia") { echo 'selected=""'; } ?> >australia</option>
					</select>
			</p>
			<p>
			<?php
				if(!isset($magicbg_hemisphere) || $magicbg_hemisphere=="") {
					echo 'You did not select any hemisphere yet. The default hemisfere is set to northern so it is '.ucfirst(get_season("",$magicbg_hemisphere)).'.';
				} else {
					echo 'You have selected '.$magicbg_hemisphere.' hemisphere so it is '.ucfirst(get_season("",$magicbg_hemisphere)).'.';
				} ?>
			</p>
			<h3 style="display: none;">Credits</h3>
			<p style="display: none;">Do you want to give credits to us? Do you want to help us improve this plugin and give you the most incredible wallpapers ever? Please select Yes in the drop down menu below. By doing this you will have a very small and discreet link to us on your website. The link will be visible on the bottom right corner of the browser.</p>
			<p style="display: none;">
				<select name="magicbg_credits" id="magicbg_credits">
					<option value="no" <?php if($magicbg_credits=="no") { echo 'selected=""'; } ?> >No</option>
					<option value="yes" <?php if($magicbg_credits=="yes") { echo 'selected=""'; } ?> >Yes</option>
				</select>
			</p>
			<p style="display: none;">
			<?php 
				if(!isset($magicbg_credits)) {
					echo 'You did not select anything yet. The default option is not to give credits to us.';
				} elseif ($magicbg_credits=="no") {
					echo 'You have selected not to give us credits.';
				} else {
					echo 'You have selected to give us credits. Thank you!';
				}  ?>
			</p>
			<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>
		</form>

		
	    <?php // SEASONS SETTINGS
	 		} elseif( $active_tab == 'seasons' ) {
	 			if (!isset( $_REQUEST['updated']))
					$_REQUEST['updated'] = false;
				if (false !== $_REQUEST['updated']) : ?>
			<div class="updated fade"><p><strong>Options saved</strong></p></div>
			<?php endif; ?>
			<h3>Seasons Settings</h3>
		<p>This is the lite version of Magic Backgrounds.<br /> If you like to change the default images please overwrite the following files located in /wp-content/plugins/magic-backgrounds-lite/includes/:<br /><br />autumn.jpg<br />winter.jpg<br />spring.jpg<br />summer.jpg <br /><br /><a href="http://markessence.com/blog/demo/wordpress-magic-backgrounds/" target="_blank">Click here</a> to download the full version of WordPress Magic Backgrounds.</p>
			
<?php } elseif ($active_tab == 'special') { ?>			


			<?php
			if ( ! isset( $_REQUEST['updated'] ) )
				$_REQUEST['updated'] = false;
			?>
			<?php if ( false !== $_REQUEST['updated'] ) : ?>
			<div class="updated fade"><p><strong>Options saved</strong></p></div>
			<?php endif; ?>
			<h3>Special Days Settings</h3>
		<p>This is the lite version of Magic Backgrounds. <br />
		<a href="http://markessence.com/blog/demo/wordpress-magic-backgrounds/" target="_blank">Click here</a> to download the full version of WordPress Magic Backgrounds. </p>
			
			
			
<?php } ?>	
			
		</div><!--end fsb-wrap-->
	</div><!--end wrap-->
	<?php

}
function magicbg_init_admin() {
	add_submenu_page( 'themes.php', 'Magic Backgrounds Settings', 'Magic Backgrounds', 'manage_options', 'magic-backgrounds', 'magicbg_admin_page' );
}
add_action('admin_menu', 'magicbg_init_admin');
function magicbg_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'magicbg_admin_style' );


// register the plugin settings
function magicbg_register_settings_general() {
	register_setting( 'magicbg_register_settings_general', 'magicbg_credits' );
	register_setting( 'magicbg_register_settings_general', 'magicbg_hemisphere' );
}
add_action( 'admin_init', 'magicbg_register_settings_general' );

