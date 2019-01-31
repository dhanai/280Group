<?php

/**
 * Load required classes.
 */
require_once get_theme_file_path('lib/init.php');

/**
 * Global variables.
 */
$shopifyApi = new ShopifyApi();
$themeCPT = new ThemeCPT();


global $glide_acf_option_fields;
  
//THEME SETUP STUFF  
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
# Enable thumbnails
add_theme_support('post-thumbnails');
# Set JPEG quality to 100%
add_filter('jpeg_quality', function() { return 100; });
# Assets directory
DEFINE('assetDir', get_template_directory_uri() . '/assets');
DEFINE('ASSET_VERSION', filemtime(get_template_directory() . '/assets/css/bundle.min.css') + filemtime(get_template_directory() . '/assets/js/bundle.js'));
# Time format for the_time()
DEFINE('tFormat', 'M d, Y');
# Various page IDs - SET THESE PER PROJECT
DEFINE('HOME', get_home_url());
DEFINE('BLOG', 289);
DEFINE('RESOURCES', 16);
DEFINE('CONTACT', 291);

// Load Classes
require_once 'classes/sys/autoloader.php';
require_once 'include_json.php';


// HANDLING SCRIPTS AND SOME CLEANUP

// Elminiate the emoji script
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

add_action('wp_enqueue_scripts', function() {
	if (is_admin()) return;
	  wp_deregister_script('wp-embed.min.js');
	  wp_deregister_script('wp-embed');
	  wp_deregister_script('embed');
	  wp_deregister_script('jquery-easing');
  	wp_dequeue_style('page-list-style');
	  wp_dequeue_style('yoast-seo-adminbar');
    wp_dequeue_script('jquery-migrate');
    
    wp_deregister_script('jquery');
    wp_dequeue_script('jquery');
    wp_enqueue_script('jquery', assetDir.'/js/jquery.min.js', array(), null, true);
    wp_enqueue_script('bundle', assetDir.'/js/bundle.js?v='.ASSET_VERSION, array('jquery'), null, true);
    
  	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  		wp_enqueue_script( 'comment-reply' );
    }    
    
}, 999);



// ADD CUSTOM THUMBNAIL SIZES
add_image_size( 'masthead', 1640, 600 );
add_image_size( 'masthead-mobile', 683, 480 );
add_image_size( 'masthead-home-icon', 70, 70 );
add_image_size( 'cta-icon', 110, 90, true );
add_image_size( 'blockquote-avatar', 130, 130, true );
add_image_size( 'icon-small', 45, 45, false );
add_image_size( 'icon-medium', 55, 55, false );
add_image_size( 'icon-large', 70, 70, false );
add_image_size( 'icon-xlarge', 90, 90, false );
add_image_size( 'icon-xxlarge', 110, 110, false );
add_image_size( 'square215', 215, 215, true );
add_image_size( 'square320', 320, 320, true );
add_image_size( 'award-logo', 220, 120, false );
add_image_size( 'client-logo', 130, 70, false );
add_image_size( 'testimonial-logo', 115, 115, false );
add_image_size( 'blog-list', 278, 140, true );
add_image_size( 'blog-list-large', 630, 314, true );
add_image_size( 'blog-detail', 755, 378, true );
add_image_size( 'product-detail', 285, 385, false );
add_image_size( 'team-member', 285, 285, true );


// ADD CUSTOM MENU LOCATIONS
function register_menus() {
  register_nav_menu('main-nav',__( 'Main Nav' ));
  register_nav_menu('mobile-nav',__( 'Mobile Nav' ));
  register_nav_menu('cta-nav',__( 'CTA Nav' ));
  register_nav_menu('footer-nav',__( 'Footer Nav' ));
  register_nav_menu('legal-nav',__( 'Legal Nav' ));
  
}
add_action( 'init', 'register_menus' );


// ADD CUSTOM SHORTCODES
function sc_current_year( $atts ) {
  return date('Y');
}
add_shortcode( 'current_year', 'sc_current_year' );

function sc_inperson_price( $atts, $content  ) {
  global $glide_acf_option_fields;
  return "<span class='online-price'>" . $glide_acf_option_fields['inperson_price'] . " " . $content."</span>";
}
add_shortcode( 'inperson_price', 'sc_inperson_price' );

function sc_agile_inperson_price( $atts, $content  ) {
  global $glide_acf_option_fields;
  return "<span class='online-price'>" . $glide_acf_option_fields['agile_inperson_price'] . " " .$content."</span>";
}
add_shortcode( 'agile_inperson_price', 'sc_agile_inperson_price' );

function sc_online_price( $atts, $content ) {
  global $glide_acf_option_fields;
  return "<span class='online-price'>$1,495 ".$content."</span>";
}
add_shortcode( 'online_price', 'sc_online_price' );


function sc_checkmark_list( $atts, $content ) {
  return "<span class='checkmark-list'>".$content."</span>";
}
add_shortcode( 'checkmark-list', 'sc_checkmark_list' );

function sc_pin_right_image( $atts, $content ) {
  return "<span class='pin-right-image'>".do_shortcode($content)."</span>";
}
add_shortcode( 'rightimage', 'sc_pin_right_image' );


function sc_mobile_table_message( $atts, $content ) {
  global $glide_acf_option_fields;
  return '<div class="mobile-scroll-message">'.$glide_acf_option_fields['mobile_tables_message'  ].'</div>';
}
add_shortcode( 'mobile-table-message', 'sc_mobile_table_message' );



// REGISTER CUSTOM POST TYPES
// NOTE - After development, put the code from CTP UI plugin into this section and deactivate the plugin
function cptui_register_my_cpts() {

	/**
	 * Post Type: Courses.
	 */

	$labels = array(
		"name" => __( "Courses", "" ),
		"singular_name" => __( "Course", "" ),
		"add_new" => __( "Add Course", "" ),
	);

	$args = array(
		"label" => __( "Courses", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "courses", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-book",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "courses", $args );

	/**
	 * Post Type: Training Locations.
	 */

	$labels = array(
		"name" => __( "Training Locations", "" ),
		"singular_name" => __( "Training Location", "" ),
	);

	$args = array(
		"label" => __( "Training Locations", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "locations", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-location-alt",
		"supports" => array( "title", "thumbnail" ),
	);

	register_post_type( "training_locations", $args );

	/**
	 * Post Type: Clients.
	 */

	$labels = array(
		"name" => __( "Clients", "" ),
		"singular_name" => __( "Client", "" ),
	);

	$args = array(
		"label" => __( "Clients", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "clients", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-businessman",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "clients", $args );

	/**
	 * Post Type: Products.
	 */

	$labels = array(
		"name" => __( "Products", "" ),
		"singular_name" => __( "Product", "" ),
	);

	$args = array(
		"label" => __( "Products", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "products", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-cart",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "products", $args );

	/**
	 * Post Type: Case Studies.
	 */

	$labels = array(
		"name" => __( "Case Studies", "" ),
		"singular_name" => __( "Case Study", "" ),
	);

	$args = array(
		"label" => __( "Case Studies", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "case_studies", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-chart-line",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "case_studies", $args );

	/**
	 * Post Type: Team.
	 */

	$labels = array(
		"name" => __( "Team", "" ),
		"singular_name" => __( "Team Member", "" ),
	);

	$args = array(
		"label" => __( "Team", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "team_member", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-groups",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "team_member", $args );

	/**
	 * Post Type: Testimonials.
	 */

	$labels = array(
		"name" => __( "Testimonials", "" ),
		"singular_name" => __( "Testimonial", "" ),
	);

	$args = array(
		"label" => __( "Testimonials", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "testimonial", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-format-quote",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "testimonial", $args );

	/**
	 * Post Type: Events.
	 */

	$labels = array(
		"name" => __( "Events", "" ),
		"singular_name" => __( "Event", "" ),
	);

	$args = array(
		"label" => __( "Events", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "events", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-calendar-alt",
		"supports" => array( "title" ),
	);

	register_post_type( "events", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


// ACF FUNCTIONS & FIELDS
if( function_exists('acf_add_options_page') ) {
  $option_page = acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title' 	=> 'Theme Settings',
		'menu_slug' 	=> 'acf-options',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false,
		'position' => 2
	));
}

// Function to prevent php errors when the ACF field isn't in the field array
function snag_field($name) {
  global $glide_acf_fields;
  return (isset($glide_acf_fields[$name]) ? $glide_acf_fields[$name] : "");
}

function build_acf_button($object, $classes="") {
  $link = "";
  $link = "<a href='".$object['url']."' target='".$object['target']."' class=' ".$classes." '>".$object['title']."</a>";
  
  return $link;
}

function acf_load_collection_field_choices( $field ) {
  global $shopifyApi;
  //GET TOOLKITS FROM SHOPIFY
  $responsearray = $shopifyApi->getCollections();
  
  $collections_list = $responsearray['data']['shop']['collections']['edges'];
  $collections = [];
  foreach($collections_list as $collection) {
    $collections[$collection['node']['id']] = $collection['node']['title'];
  }

  // reset choices
  $field['choices'] = $collections;

  return $field;
}

add_filter('acf/load_field/name=shopify_collection_in_person', 'acf_load_collection_field_choices');
add_filter('acf/load_field/name=shopify_collection_location', 'acf_load_collection_field_choices');


function acf_load_online_course_field_choices( $field ) {
  global $shopifyApi;
  //GET TOOLKITS FROM SHOPIFY
  $responsearray = $shopifyApi->getOnlineCourses();

  $collections_list = $responsearray['data']['shop']['collectionByHandle']['products']['edges'];
  $collections = [];
  foreach($collections_list as $collection) {
    $collections[$collection['node']['id']] = $collection['node']['title'];
  }

  // reset choices
  $field['choices'] = $collections;

  return $field;
}
add_filter('acf/load_field/name=shopify_product', 'acf_load_online_course_field_choices');

function acf_load_shopify_toolkit_products( $field ) {
  global $shopifyApi;
  //GET TOOLKITS FROM SHOPIFY
  $responsearray = $shopifyApi->getToolkitProducts();

  $collections_list = $responsearray['data']['shop']['collectionByHandle']['products']['edges'];
  $collections = [];
  foreach($collections_list as $collection) {
    $collections[$collection['node']['id']] = $collection['node']['title'];
  }

  // reset choices
  $field['choices'] = $collections;

  return $field;
}
add_filter('acf/load_field/name=shopify_toolkit_product', 'acf_load_shopify_toolkit_products');




// USE This function when using google map fields in ACF


function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyBT9WWycVW1AivP7Z4lQld7FwC8b14oSM0';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');




// GRAVITY FORMS STUFF
//add_filter('gform_init_scripts_footer', '__return_true');



// MISC STUFF

// Set up client's logo on the login page
function my_login_logo() { 
  
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-dark.png);
		height:84px;
		width:144px;
		background-size: 144px 84px;
		background-repeat: no-repeat;
        	padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );



// retrieves the attachment ID from the file URL
function glide_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		
        return $attachment[0]; 
}

function getRootParent() {
	global $post;
	$parent = $post->ID;

	if ($post->post_parent)	{
		$ancestors = get_post_ancestors($post->ID);
		$root = count($ancestors)-1;
		$parent = $ancestors[$root];
	}

	return $parent;
}

function has_children() {
  global $post;

  $children = get_pages( array( 'child_of' => $post->ID ) );
  if( count( $children ) == 0 ) {
      return false;
  } else {
      return true;
  }
}

function get_current_page_depth(){
	global $wp_query;
	
	$object = $wp_query->get_queried_object();
	$parent_id  = $object->post_parent;
	$depth = 0;
	while($parent_id > 0){
		$page = get_page($parent_id);
		$parent_id = $page->post_parent;
		$depth++;
	}
 
 	return $depth;
}



/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once dirname( __FILE__ ) . '/classes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function my_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Advanced Custom Fields', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/required-plugins/advanced-custom-fields-pro.5.6.9.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		),
		array(
			'name'               => 'Gravity Forms', // The plugin name.
			'slug'               => 'gravityforms', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/required-plugins/gravityforms_2.2.6.1.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		),
		array(
			'name'     => 'Custom Post Type UI',
			'slug'     => 'custom-post-type-ui',
			'required' => false,
		),	
		array(
			'name'     => 'Shortcodes Ultimate',
			'slug'     => 'shortcodes-ultimate',
			'required' => false,
		),	
		array(
			'name'     => 'Shortcodes Ultimate: Shortcode Creator',
			'slug'     => 'shortcodes-ultimate-maker',
			'source'             => get_stylesheet_directory() . '/required-plugins/shortcodes-ultimate-maker.zip', // The plugin source.
			'required' => false,
		),	
		array(
			'name'     => 'AJAX Thumbnail Rebuild',
			'slug'     => 'ajax-thumbnail-rebuild',
			'required' => false,
		),	
		array(
			'name'     => 'Intuitive Custom Post Order',
			'slug'     => 'intuitive-custom-post-order',
			'required' => false,
		),						
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
		),
		
		
		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		
		/*
array(
			'name'         => 'TGM New Media Plugin', // The plugin name.
			'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
			'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),
*/
		// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository
		// and not in a subdirectory ('/src') of the repository.

    /*
		array(
			'name'   => 'Adminbar Link Comments to Pending',
			'slug'   => 'adminbar-link-comments-to-pending',
			'source' => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		),
*/
		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// 'wordpress-seo-premium'.
		// By setting 'is_callable' to either a function from that plugin or a class method
		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// recognize the plugin as being installed.
		
	);
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			// translators: %s: plugin name.
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ),
			// translators: %s: plugin name.
			'updating'                        => __( 'Updating Plugin: %s', 'theme-slug' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				// translators: 1: plugin name(s).
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme-slug'
			),
			'notice_can_install_recommended'  => _n_noop(
				// translators: 1: plugin name(s).
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme-slug'
			),
			'notice_ask_to_update'            => _n_noop(
				// translators: 1: plugin name(s).
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				// translators: 1: plugin name(s).
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme-slug'
			),
			'notice_can_activate_required'    => _n_noop(
				// translators: 1: plugin name(s).
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			),
			'notice_can_activate_recommended' => _n_noop(
				// translators: 1: plugin name(s).
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme-slug' ),
			// translators: 1: plugin name.
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),
			// translators: 1: plugin name.
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),
			// translators: 1: dashboard link.
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme-slug' ),
			'dismiss'                         => __( 'Dismiss this notice', 'theme-slug' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'theme-slug' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'theme-slug' ),
			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);
	tgmpa( $plugins, $config );
}



// SHOPIFY API INTEGRATIONS
add_action( 'wp_ajax_shopify_products', 'shopify_products' );
add_action( 'wp_ajax_nopriv_shopify_products', 'shopify_products' );

function shopify_products() {

  $url = "https://4fe5b52ec9b40c295a44a72de244749b:6f638a9925c3efbd1b52831954e3e71d@the-280-group.myshopify.com/admin/products.json";

  if (isset($_REQUEST)) {
    
  //open connection
      $ch = curl_init();
    
      $headers = array(
        'Content-type: application/xml',
        'username: username',
        'password: password'
      );
    
      //set the url, number of POST vars, POST data
      curl_setopt($ch,CURLOPT_URL, $url);
      //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    
      //execute post
      $result = curl_exec($ch);
      $responseInfo = curl_getinfo($ch);
    
    
      //trace($responseInfo);
    
      //close connection
      curl_close($ch);
      
      //JLM NOTE: put in the curl code from postman
    
      print long_json_string;
    
      //print $responseInfo;
      //print "test";
      
    
    
    
  }
  die();  
}


add_action('acf/input/admin_head', 'lh_acf_admin_head'); 
function lh_acf_admin_head() {
        ?>
        <style type="text/css">
        .acf-editor-wrap iframe {
            height: 200px !important;
            min-height: 200px;
        }
        .acf-editor-wrap .mce-fullscreen iframe{
            height: 800px !important;
            min-height: 800px;
        }
        </style>
        <?php
} 



function SearchFilter($query)  {  
  
  if ($query->is_search && !is_admin() ) {
    $query->set('post_type',array('page','products','courses', 'training_locations', 'post'));
    
    //Exclude posts by ID
    $post_ids = array(13658,13660,13661,13662,13663,13664,13665,13666,13670,13671,13673,13674,13675,13669,14760);
    $query->set('post__not_in', $post_ids);
    
  }
  return $query;
}  
add_filter('pre_get_posts', 'SearchFilter'); 


function iweb_modest_youtube_player( $html, $url, $args ) {
  $iframe = str_replace( '?feature=oembed', '?feature=oembed&showinfo=0&rel=0', $html );
  $iframe = str_replace( 'src', 'data-src', $html );
	return $iframe;
}
add_filter( 'embed_oembed_html', 'iweb_modest_youtube_player', 10, 3 );