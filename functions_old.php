<?php

function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('admin/wp-admin.css'));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');

if ( ! isset( $content_width ) )
	$content_width = 900;

// Register Theme Features
function insider()  {
	show_admin_bar(false);
	remove_action('wp_head', 'wp_generator');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');	
	$formats = array( 'link', );
	add_theme_support( 'post-formats', $formats );
	set_post_thumbnail_size(920, 518, true);
		
	$background_args = array(
		'default-color'          => 'E8E9EA',
		'default-image'          => get_template_directory() . '/img/bkg.gif',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );
	$header_args = array(
		'default-image'          => get_template_directory() . 'img/logo.jpg',
		'width'                  => 464,
		'height'                 => 91,
		'flex-width'             => false,
		'flex-height'            => false,
		'random-default'         => false,
		'header-text'            => false,
		'default-text-color'     => '',
		'uploads'                => true,
	);
	add_theme_support( 'custom-header', $header_args );
}
add_action( 'after_setup_theme', 'insider' );

//Navigation Menus
function insider_menus() {
	$locations = array(
		'header_menu' => __( 'Header Menu', 'insider' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'insider_menus' );

function spots() {
	$labels = array(
		'name'                => _x( 'Spots', 'Post Type General Name', 'insider' ),
		'singular_name'       => _x( 'Spot', 'Post Type Singular Name', 'insider' ),
		'menu_name'           => __( 'Spots', 'insider' ),
		'parent_item_colon'   => __( 'Parent Spot:', 'insider' ),
		'all_items'           => __( 'All Spots', 'insider' ),
		'view_item'           => __( 'View Spot', 'insider' ),
		'add_new_item'        => __( 'Add New Spot', 'insider' ),
		'add_new'             => __( 'New Spot', 'insider' ),
		'edit_item'           => __( 'Edit Spot', 'insider' ),
		'update_item'         => __( 'Update Spot', 'insider' ),
		'search_items'        => __( 'Search spots', 'insider' ),
		'not_found'           => __( 'No spots found', 'insider' ),
		'not_found_in_trash'  => __( 'No spots found in Trash', 'insider' ),
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'post-formats' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'spot', $args );
}
add_action( 'init', 'spots', 0 );

function archive()  {
	$args = array(
		'id'            => 'archive',
		'name'          => __( 'Sidebar', 'insider' ),
		'description'   => __( '', 'insider' ),
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'archive' );

function myLoop($atts, $content = null) {
	extract(shortcode_atts(array(
		'pagination' => 'false',
		'query' => '',
		'category' => '',
		'posts_per_page' => '1',
		'p' => '',
		'type' => ''
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	if($pagination == 'true'){
		$query .= '&paged='.$paged;
	}
	if(!empty($category)){
		$query .= '&category_name='.$category;
	}
	if(!empty($posts_per_page)){
		$query .= '&posts_per_page='.$posts_per_page;
	}
	if(!empty($p)){
		$query .= '&p='.$p;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	?>
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	<div <?php post_class('col-' . $type . ''); ?>>
		<div class="col-content article article_header">
	    	<?php if ( 'link' == get_post_format() ) { ?>
				<?php if ( has_post_thumbnail() ) { ?>
		    		<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>" class=""><?php the_post_thumbnail(); ?></a>
		    	<?php } ?>
				<?php if($type == '12'){ ?>
					<div class="leader_title"><?php the_title(); ?></div>
				<?php } else { ?>
					<div class="story_content">
						<div class="title"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>"><?php the_title(); ?></a></div>
						<div class="excerpt"><?php the_excerpt(); ?></div>
					</div>
				<?php } ?>	    	
	    	<?php } else { ?>
	    		<?php if ( has_post_thumbnail() ) { ?>
	    			<a href="<?php the_permalink(); ?>" class=""><?php the_post_thumbnail(); ?></a>
				<?php } ?>
				<?php if($type == '12'){ ?>
					<div class="leader_title"><?php the_title(); ?></div>
				<?php } else { ?>
					<div class="story_content">
						<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="excerpt"><?php the_excerpt(); ?></div>
					</div>
				<?php } ?>	    	
	    	<?php } ?>
		</div>
	</div>
	<?php endwhile; ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	wp_reset_query();
}
add_shortcode('article', 'myLoop');

function inthenewsSC() {
    return '<div class="col-12">
    	<div class="col-content inthenews">
    		In the news
    	</div>
    </div>';
}
add_shortcode('news', 'inthenewsSC');

function otherSC() {
    return '<div class="col-12 columns center"><img src="'. get_template_directory_uri() .'/img/footer_divider.png" alt="footer_divider" width="811" height="11" /></div>';
}
add_shortcode('other', 'otherSC');

function be_sample_metaboxes( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'meta',
		'title' => 'External Link',
		'pages' => array('post', 'spot'), // post type
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'URL',
				'desc' => '',
				'type' => 'text',
				'id' => $prefix . 'test_title'
			)
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );

add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}
function my_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'posts_to_pages',
		'from' => 'post',
		'to' => 'page'
	) );
}
add_action( 'p2p_init', 'my_connection_types' );

add_filter('comment_form_default_fields', 'clear_url_box');
function clear_url_box($fields){
    if(isset($fields['url']))
    unset($fields['url']);
    return $fields;
}