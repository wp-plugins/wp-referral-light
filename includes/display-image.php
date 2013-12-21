<?php

function magicbg_display_image() {
	global $magicbg_credits;
	global $magicbg_hemisphere;

		if (get_season("",$magicbg_hemisphere)=='spring') {
			$image = plugin_dir_url( __FILE__ ) . 'spring.jpg';
		} elseif (get_season("",$magicbg_hemisphere)=='summer') {
			$image = plugin_dir_url( __FILE__ ) . 'summer.jpg';
		} elseif(get_season("",$magicbg_hemisphere)=='autumn') {
			$image = plugin_dir_url( __FILE__ ) . 'autumn.jpg';
		} else {
			$image = plugin_dir_url( __FILE__ ) . 'winter.jpg';
		}
		if( is_ssl() ) {
			$image = str_replace( 'http://', 'https://', $image );
		}
		$html = '<img src="'.esc_url( $image ).'" id="magicbg_image"/>';
		if ($magicbg_credits == "yes") {
			$html .= '<style type="text/css"> html { position: relative !important; } body { background: none !important; } a.magicbg { position: fixed !important; right: 0; bottom: 10px; font-size: 10px; line-height: 12px; font-family: Arial; background-color:rgba(0,0,0,0.5); text-align: right; color: #f4f4f4; text-decoration:none; padding: 5px 10px 5px 10px; -webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px; } </style><a class="magicbg" href="http://markessence.com/blog/demo/wordpress-magic-backgrounds/" title="WordPress Magic Backgrounds" target="_blank">Powered by Magic <br />Backgrounds</a>';
		} else {
			$html .= '<style type="text/css"> body { background: none !important; } </style>';

		}
		echo $html;
	//echo get_season("",$magicbg_hemisphere);
}
add_action( 'wp_footer', 'magicbg_display_image' );



