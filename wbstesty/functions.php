<?php
/**
 * WBS Testy functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage WBS_Testy
 * @since WBS Testy 1.0
 */

/**
 * WBS Testy only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'wbstesty_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own wbstesty_setup() function to override in a child theme.
 *
 * @since WBS Testy 1.0
 */
function wbstesty_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/wbstesty
	 * If you're building a theme based on WBS Testy, use a find and replace
	 * to change 'wbstesty' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wbstesty' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since WBS Testy 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wbstesty' ),
		'social'  => __( 'Social Links Menu', 'wbstesty' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', wbstesty_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // wbstesty_setup
add_action( 'after_setup_theme', 'wbstesty_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since WBS Testy 1.0
 */
function wbstesty_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wbstesty_content_width', 840 );
}
add_action( 'after_setup_theme', 'wbstesty_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since WBS Testy 1.0
 */
function wbstesty_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wbstesty' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'wbstesty' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'wbstesty' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'wbstesty' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'wbstesty' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'wbstesty' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wbstesty_widgets_init' );

if ( ! function_exists( 'wbstesty_fonts_url' ) ) :
/**
 * Register Google fonts for WBS Testy.
 *
 * Create your own wbstesty_fonts_url() function to override in a child theme.
 *
 * @since WBS Testy 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function wbstesty_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'wbstesty' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'wbstesty' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'wbstesty' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since WBS Testy 1.0
 */
function wbstesty_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wbstesty_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since WBS Testy 1.0
 */
function wbstesty_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'wbstesty-fonts', wbstesty_fonts_url(), array(), null );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Slab', false ); 

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'wbstesty-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'wbstesty-ie', get_template_directory_uri() . '/css/ie.css', array( 'wbstesty-style' ), '20160816' );
	wp_style_add_data( 'wbstesty-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'wbstesty-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'wbstesty-style' ), '20160816' );
	wp_style_add_data( 'wbstesty-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'wbstesty-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'wbstesty-style' ), '20160816' );
	wp_style_add_data( 'wbstesty-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'wbstesty-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'wbstesty-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'wbstesty-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'wbstesty-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'wbstesty-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'wbstesty-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'wbstesty' ),
		'collapse' => __( 'collapse child menu', 'wbstesty' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'wbstesty_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since WBS Testy 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function wbstesty_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'wbstesty_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since WBS Testy 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function wbstesty_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since WBS Testy 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function wbstesty_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'wbstesty_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since WBS Testy 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function wbstesty_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'wbstesty_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since WBS Testy 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function wbstesty_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'wbstesty_widget_tag_cloud_args' );


/**
 * Takes the first sentence from the content and echo's it
 *
 * @since WBS Testy 1.0
 *
 * @requires PHP 5.3+
 * @echo string The Custom Excerpt.
 */
function wbstesty_custom_excerpt() {
    $excerpt = strstr(get_the_content(), '.', true).'.';
	$button = '<div class="article-more"><a href="'. get_permalink(get_the_ID()) . '">' . 'Read More</a></div>';
	echo $excerpt . $button;
}

/**
 * Custom WP_Widget instance. This Widget outputs a a list the latest posts. 
 *
 * @since WBS Testy 1.0
 *
 */
class wbstesty_widget_latest_posts extends WP_Widget {
 
    /**
     * Sets up a new Latest Posts widget instance.
     *
     * @since 1.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_latest_posts',
            'description' => __( 'Your Site&#8217;s Latest Posts.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'latest-posts', __( 'Latest Posts' ), $widget_ops );
        $this->alt_option_name = 'widget_recent_entries';
    }
 
    /**
     * Outputs the content for the current Latest Posts widget instance.
     *
     * @since 1.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Latest Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
 
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Posts' );
 
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
 
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
        if ( ! $number )
            $number = 4;
 
        /**
         * Filters the arguments for the Latest Posts widget.
         *
         * @since 1.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
 
        if ($r->have_posts()) :
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
        <ul>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                <span class="post-category"><?php the_category( ', ')?></span>
				<span class="post-date"><?php echo get_the_date('d / m / y'); ?></span>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php echo $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
 
        endif;
    }
 
    /**
     * Handles updating the settings for the current Latest Posts widget instance.
     *
     * @since 1.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }
 
    /**
     * Outputs the settings form for the Latest Posts widget.
     *
     * @since 1.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Latest Posts';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
 
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
 
<?php
    }
};

/**
 * Custom WP_Widget instance. This Widget outputs a subscribe to newsletter form. 
 *
 * @since WBS Testy 1.0
 *
 */
class wbstesty_widget_newsletter extends WP_Widget {

    /**
     * Sets up a new Newsletter widget instance.
     *
     * @since 1.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_newsletter',
            'description' => __( 'Your Site&#8217;s Opt In Form.' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'newsletter', __( 'Newsletter' ), $widget_ops );
        $this->alt_option_name = 'widget_newsletter_optin';
    }
 
    /**
     * Outputs the content for the current Newsletter widget instance.
     *
     * @since 1.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Newsletter widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
 
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Subscribe' );
 
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
 
        $optin_description = ( ! empty( $instance['optin_description'] ) ) ? $instance['optin_description'] : __( 'Join Our Newsletter And Get
 Unlimited Access To Our Guides' );
		$call_to_action = ( ! empty( $instance['call_to_action'] ) ) ? $instance['call_to_action'] : __( 'Join Now' );
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
		<?php if ( $optin_description ) {
            echo $optin_description;
        } ?>       
		<form id="contact-form" method="post" action="">
			<input type="email" name="your-email" id="email" placeholder="Your email..." required>
			<button type="submit"> <?php echo $call_to_action; ?></button>
		</form>
        <?php echo $args['after_widget']; ?>
        <?php
    }
 
    /**
     * Handles updating the settings for the current Newsletter widget instance.
     *
     * @since 1.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['optin_description'] = sanitize_text_field( $new_instance['optin_description'] );
		$instance['call_to_action'] = sanitize_text_field( $new_instance['call_to_action'] );
        return $instance;
    }
 
    /**
     * Outputs the settings form for the Newsletter widget.
     *
     * @since 1.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Subscribe';
        $optin_description    = isset( $instance['optin_description'] ) ? esc_attr(  $instance['optin_description'] ) : 'Join Our Newsletter And Get
 Unlimited Access To Our Guides';
        $call_to_action = isset( $instance['call_to_action'] ) ? esc_attr(  $instance['call_to_action'] ) : 'Join Now';
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
 
        <p><label for="<?php echo $this->get_field_id( 'optin_description' ); ?>"><?php _e( 'Newsletter description text:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'optin_description' ); ?>" name="<?php echo $this->get_field_name( 'optin_description' ); ?>" type="text" value="<?php echo $optin_description; ?>" /></p>
		
	    <p><label for="<?php echo $this->get_field_id( 'call_to_action' ); ?>"><?php _e( 'Newsletter call to action button text:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'call_to_action' ); ?>" name="<?php echo $this->get_field_name( 'call_to_action' ); ?>" type="text" value="<?php echo $call_to_action; ?>" /></p>

<?php
    }
};

add_action( 'widgets_init', function(){ register_widget( 'wbstesty_widget_latest_posts' );});
add_action( 'widgets_init', function(){ register_widget( 'wbstesty_widget_newsletter' );});