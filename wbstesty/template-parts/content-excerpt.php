<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage WBS_Testy
 * @since WBS Testy 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php the_category( ', '); ?>
		<?php echo get_the_date( 'd / m / y'); ?>
	</header><!-- .entry-header -->

	<?php wbstesty_post_thumbnail(); ?>

	<div class="entry-content">
			<?php wbstesty_custom_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

  
	   <?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'wbstesty' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
