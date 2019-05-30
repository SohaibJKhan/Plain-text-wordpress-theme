<?php
function plaintext_custom_header_setup() {
add_theme_support( 'custom-header', apply_filters( 'plaintext_custom_header_args', array(
		'width'              => 900,
		'height'             => 119,
		'flex-height'        => true,
		'wp-head-callback'   => 'plaintext_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'plaintext_custom_header_setup' );

function plaintext_header_style() {
	$header_text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}
	?>
	<style id="plaintext-custom-header-styles" type="text/css">
		.site-title>a ,.header_menu>li>a
	{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
	}	
	</style>
	<?php
}
