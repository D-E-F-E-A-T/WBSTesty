<?php
/**
 * The template for displaying the page bookmakers. 
 * To view make a page with the title bookmakers. 
 * Then from the slug of the page this custom page will be called.
 * That's all!
 *
 * @package WordPress
 * @subpackage WBS_Testy
 * @since WBS Testy 1.0
 */
 ?>
<?php 
//Populate the bookmakers array
$bookmakers = array(
	0 => array(
		'bookmaker-logo' => 'assets/bookmakers/bet365_logo.png',
		'bookmaker-name' => 'Bet 365',
		'bookmaker-stars' => 4,
		'bookmaker-text' => '<ul class="bookmaker">
								<li>Superb welcome bonus promotion</li>
								<li>High winning limits</li>
								<li>Deposits and withdrawals are charge free</li>
								<li>Offers possibility to bet via mobile phone</li>
							</ul>',			
		'bookmaker-link' => 'https://www.bet365.gr/el/'	
	),
	1 => array(
		'bookmaker-logo' => 'assets/bookmakers/bet365_logo.png',
		'bookmaker-name' => 'Bet 365',
		'bookmaker-stars' => 4,
		'bookmaker-text' => '<ul class="bookmaker">
								<li>Superb welcome bonus promotion</li>
								<li>High winning limits</li>
								<li>Deposits and withdrawals are charge free</li>
								<li>Offers possibility to bet via mobile phone</li>
							</ul>',			
		'bookmaker-link' => 'https://www.bet365.gr/el/'	
	),
	2 => array(
		'bookmaker-logo' => 'assets/bookmakers/bet365_logo.png',
		'bookmaker-name' => 'Bet 365',
		'bookmaker-stars' => 4,
		'bookmaker-text' => '<ul class="bookmaker">
								<li>Superb welcome bonus promotion</li>
								<li>High winning limits</li>
								<li>Deposits and withdrawals are charge free</li>
								<li>Offers possibility to bet via mobile phone</li>
							</ul>',			
		'bookmaker-link' => 'https://www.bet365.gr/el/'	
	),

);

?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
			// End of the loop.
		endwhile;
		?>
			<div class = "bookmakers">
			<?php foreach($bookmakers  as $key => $bookmaker) : ?>
				<div id="bookmaker-<?php echo $key+1; ?>" class = "bookmaker" style="float:left; width: 100%; border-bottom:3px solid #000000; clear:both; padding:1.2em 0em">
					<div class = "bookmaker-logo" style="width:20%; float:left; margin-right:20px">	
						<?php echo '<img src="' . get_template_directory_uri(). '/'. $bookmaker['bookmaker-logo'] . '" alt="' . $bookmaker['bookmaker-name'] . '">';?>
					</div>
					<div class = "bookmaker-name" style="width:15%; float:left">
						<?php echo  $bookmaker['bookmaker-name'];?>
						<br>
						<?php echo  $bookmaker['bookmaker-stars'];?>
					</div>
					<div class = "bookmaker-text" style="width:45%; float:left">
						<?php echo  $bookmaker['bookmaker-text'];?>
					</div>
					<div class = "bookmaker-link" style="width:15%; float:left">
						<?php echo  '<a href="' . $bookmaker['bookmaker-link'] . '">Play Now</a>';?>
					</div>
				</div>
			<?php endforeach; ?>
		</article><!-- #post-## -->
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
