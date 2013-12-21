<?php

function magicbg_load_css() {
		wp_enqueue_style( 'magicbg-image', plugin_dir_url( __FILE__ ) . 'magicbg-image.css' );
}
add_action( 'init', 'magicbg_load_css' );

function magicbg_load_admin_scripts( $hook ) {
	wp_enqueue_script( 'magicbg-scripts', plugin_dir_url( __FILE__ ) . 'magicbg-scripts.js', array( 'jquery', 'media-upload', 'thickbox' ), filemtime( plugin_dir_path( __FILE__ ) . 'magicbg-scripts.js' ) );
}
function magicbg_load_admin_styles( $hook ) {
	wp_enqueue_style( 'thickbox' );
}
add_action( 'admin_enqueue_scripts', 'magicbg_load_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'magicbg_load_admin_styles' );
