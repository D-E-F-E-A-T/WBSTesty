<?php
/**
 * The template for displaying the page bookmakers. 
 * To view create a page with the title bookmakers. 
 * Then from the slug of the page, this custom page will be called.
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
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Superb welcome bonus promotion</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>High winning limits</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Deposits and withdrawals are charge free</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Offers possibility to bet via mobile phone</li>
							</ul>',			
		'bookmaker-link' => 'https://www.bet365.gr/el/'	
	),
	1 => array(
		'bookmaker-logo' => 'assets/bookmakers/bet365_logo.png',
		'bookmaker-name' => 'Bet 365',
		'bookmaker-stars' => 3,
		'bookmaker-text' => '<ul class="bookmaker">
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Superb welcome bonus promotion</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>High winning limits</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Deposits and withdrawals are charge free</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Offers possibility to bet via mobile phone</li>
							</ul>',			
		'bookmaker-link' => 'https://www.bet365.gr/el/'	
	),
	2 => array(
		'bookmaker-logo' => 'assets/bookmakers/bet365_logo.png',
		'bookmaker-name' => 'Bet 365',
		'bookmaker-stars' => 5,
		'bookmaker-text' => '<ul class="bookmaker">
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Superb welcome bonus promotion</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>High winning limits</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Deposits and withdrawals are charge free</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Offers possibility to bet via mobile phone</li>
							</ul>',			
		'bookmaker-link' => 'https://www.bet365.gr/el/'	
	),

);

?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<h2 class="entry-title">Bookmakers</h2>

				<div class = "bookmakers">
				<?php foreach($bookmakers  as $key => $bookmaker) : ?>
					<div id="bookmaker-<?php echo $key+1; ?>" class = "bookmaker">
						<div class = "bookmaker-logo">	
							<?php echo '<img src="' . get_template_directory_uri(). '/'. $bookmaker['bookmaker-logo'] . '" alt="' . $bookmaker['bookmaker-name'] . '">';?>
						</div>
						<div class = "bookmaker-name">
							<?php echo  $bookmaker['bookmaker-name'];?>
							<br>
							<span class="rating">
							<?php for ($x = 0; $x < $bookmaker['bookmaker-stars']; $x++) { ?>
								<span class="star"></span>
							<?php }; ?>
							</span>
						</div>
						<div class = "bookmaker-text">
							<?php echo  $bookmaker['bookmaker-text'];?>
						</div>
						<div class = "bookmaker-link">
							<?php echo  '<a href="' . $bookmaker['bookmaker-link'] . '">Play Now</a>';?>
						</div>
					</div><!-- .bookmaker -->
				<?php endforeach; ?>
					</div><!-- .bookmakers -->
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
