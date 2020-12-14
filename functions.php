<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts' );

require_once(dirname(__FILE__) . '/custom-widgets/quick-widgets.php');

function theme_enqueue_scripts() {
    /**
     * frontend ajax requests.
     */
    //wp_enqueue_script( 'quicknclean-directionbox', get_stylesheet_directory_uri() . '/directions-box.js', array('jquery', 'wpgmza'), '1.2.3', true );

    wp_enqueue_script( 'quicknclean-markerlisting', get_stylesheet_directory_uri() . '/custom-map.js', array('jquery', 'wpgmza'), '2.0.4', true );
    wp_enqueue_script( 'quicknclean-form', get_stylesheet_directory_uri() . '/custom-global.js', array('jquery'), '2.0.3', true );

    wp_enqueue_style('child-global', get_stylesheet_directory_uri() . '/assets/css/main-global.min.css', array(), '1.1.1');

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );