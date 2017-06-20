<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage WBS_Testy
 * @since WBS Testy 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-branding">
				<?php wbstesty_the_custom_logo(); ?>
			</div><!-- .site-branding -->
			<?php if ( has_nav_menu( 'footer' )  ) : ?>
				<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'wbstesty' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'menu_class'     => 'menu-footer',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the wbstesty footer text for footer customization.
					 *
					 * @since WBS Testy 1.0
					 */
					do_action( 'wbstesty_credits' );
				?>
				<span class="site-title">Copyright 2017 &copy <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wbstesty' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'wbstesty' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
