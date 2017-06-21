<?php
/**
 * WBS Testy back compat functionality
 *
 * Prevents WBS Testy from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage WBS_Testy
 * @since WBS Testy 1.0
 */

/**
 * Prevent switching to WBS Testy on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since WBS Testy 1.0
 */
function wbstesty_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'wbstesty_upgrade_notice' );
}
add_action( 'after_switch_theme', 'wbstesty_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * WBS Testy on WordPress versions prior to 4.4.
 *
 * @since WBS Testy 1.0
 *
 * @global string $wp_version WordPress version.
 */
function wbstesty_upgrade_notice() {
	$message = sprintf( __( 'WBS Testy requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'wbstesty' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since WBS Testy 1.0
 *
 * @global string $wp_version WordPress version.
 */
function wbstesty_customize() {
	wp_die( sprintf( __( 'WBS Testy requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'wbstesty' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'wbstesty_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since WBS Testy 1.0
 *
 * @global string $wp_version WordPress version.
 */
function wbstesty_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'WBS Testy requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'wbstesty' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'wbstesty_preview' );
