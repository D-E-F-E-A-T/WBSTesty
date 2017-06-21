<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage WBS_Testy
 * @since WBS Testy 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php wbstesty_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wbstesty' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'wbstesty' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

		<h3>Share with friends</h3>
		<div class="social-navigation">
			<ul>	
			 <!-- Your share button code -->
				<li class="fb-share-button" data-href="<?php echo get_permalink(get_the_ID())?>" data-layout="button"></li>						
				<li><a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></li>
				<li class="g-plusone" data-size="medium" data-annotation="inline" data-width="300"></li>
				<script type="text/javascript">
				  window.___gcfg = {lang: 'el'};

				  (function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/platform.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
				<li><a data-pin-do="buttonBookmark" data-pin-round="false" data-pin-save="false" href="https://www.pinterest.com/pin/create/button/"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_16.png" /></a></li>
			</ul>
		</div>
		<div class="edit-post">
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
		</div>

</article><!-- #post-## -->
