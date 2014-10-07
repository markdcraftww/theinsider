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
	$formats = array( 'link' );
	add_theme_support( 'post-formats', $formats );
	set_post_thumbnail_size(920, 518, true);
	add_image_size( 'edm12', 630, 268, true );
	add_image_size( 'edm6', 308, 127, true );
	add_image_size( 'edm4', 201, 83, true );
	add_image_size( 'edm3', 142, 80, true );
	add_image_size( 'half', 70, 80, true );
		
	$background_args = array(
		'default-color'          => 'E8E9EA',
		'default-image'          => get_template_directory() . '/img/bkg.gif',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );
	$header_args = array(
		'default-image'          => get_template_directory() . '/img/logo.jpg',
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

// Register Custom Post Type
function edm() {

	$labels = array(
		'name'                => _x( 'EDMs', 'Post Type General Name', 'insider' ),
		'singular_name'       => _x( 'EDM', 'Post Type Singular Name', 'insider' ),
		'menu_name'           => __( 'EDMs', 'insider' ),
		'parent_item_colon'   => __( 'Parent EDM:', 'insider' ),
		'all_items'           => __( 'All EDMs', 'insider' ),
		'view_item'           => __( 'View EDM', 'insider' ),
		'add_new_item'        => __( 'Add New EDM', 'insider' ),
		'add_new'             => __( 'New EDM', 'insider' ),
		'edit_item'           => __( 'Edit EDM', 'insider' ),
		'update_item'         => __( 'Update EDM', 'insider' ),
		'search_items'        => __( 'Search EDMs', 'insider' ),
		'not_found'           => __( 'No EDMs found', 'insider' ),
		'not_found_in_trash'  => __( 'No EDM found in Trash', 'insider' ),
	);
	$args = array(
		'label'               => __( 'edm', 'insider' ),
		'description'         => __( 'Insider Emails', 'insider' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'page-attributes', ),
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
	register_post_type( 'edm', $args );

}

// Hook into the 'init' action
add_action( 'init', 'edm', 0 );

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
		<div class="col-content article">
	    	<?php if ( 'link' == get_post_format() ) { ?>
				<?php if ( has_post_thumbnail() ) { ?>
		    		<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>"><?php the_post_thumbnail(); ?></a>
		    	<?php } ?>
				<?php if($type == '12'){ ?>
					<div class="leader_title"><?php the_title(); ?></div>
				<?php } else { ?>
					<div class="story_content">
						<div class="title"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>"><?php the_title(); ?></a></div>
						<div class="excerpt"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>"><?php the_excerpt(); ?></a></div>
					</div>
				<?php } ?>	    	
	    	<?php } else { ?>
	    		<?php if ( has_post_thumbnail() ) { ?>
	    			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php } ?>
				<?php if($type == '12'){ ?>
					<div class="leader_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<?php } else { ?>
					<div class="story_content">
						<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="excerpt"><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></div>
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

function inthenewsEDM() {
	return '<table width="650" border="0" cellspacing="10" cellpadding="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr>
            <td style="outline: 1px solid #E8E9EA; border:1px solid #D4D6D8; color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #b3bf28;" bgcolor="#F8F8F8" align="left" valign="middle">
                <div style="padding: 5px; border-top: 5px solid #b3bf28;">
                    In the news
                </div>
            </td>
        </tr>
    </table>';
}
add_shortcode('newsedm', 'inthenewsEDM');

function edm_loop($atts, $content = null) {
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

	    	<?php if ( 'link' == get_post_format() ) { ?>
				<?php if($type == '12'){ ?>
	    			<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
					<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #0099D9;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #0099D9;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#4e7bb2; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-decoration: none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #0099D9;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#4e7bb2; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-decoration: none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>  
				<?php } ?>	    	
	    	<?php } else { ?>
				<?php if($type == '12'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#4e7bb2; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #0099D9;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #0099D9;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#4e7bb2; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-decoration: none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #0099D9;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#4e7bb2; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-decoration: none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>	    	
	    	<?php } ?>

	<?php endwhile; ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	wp_reset_query();
}
add_shortcode('edm', 'edm_loop');

function news_loop($atts, $content = null) {
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

	    	<?php if ( 'link' == get_post_format() ) { ?>
				<?php if($type == '12'){ ?>
	    			<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
					<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #b3bf28;border-top: 5px solid #b3bf28;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #b3bf28;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #b3bf28;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>  
				<?php } ?>	    	
	    	<?php } else { ?>
				<?php if($type == '12'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #b3bf28;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #b3bf28;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #b3bf28;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#b3bf28; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>	    	
	    	<?php } ?>

	<?php endwhile; ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	wp_reset_query();
}
add_shortcode('itnedm', 'news_loop');

function other_loop($atts, $content = null) {
	extract(shortcode_atts(array(
		'pagination' => 'false',
		'query' => '',
		'category' => '',
		'posts_per_page' => '1',
		'p' => '',
		'type' => '',
		'class' => ''
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
		<?php if($class == 'left'){ ?>
	    	<?php if ( 'link' == get_post_format() ) { ?>
				<?php if($type == '12'){ ?>
	    			<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
					<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#c70f73; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #c70f73;border-top: 5px solid #c70f73;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #c70f73;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#c70f73; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #c70f73;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#c70f73; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>  
				<?php } ?>	    	
	    	<?php } else { ?>
				<?php if($type == '12'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#c70f73; font-family:Arial, Helvetica, sans-serif; font-size:14px;border-top: 5px solid #c70f73;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #c70f73;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#c70f73; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #c70f73;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#c70f73; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>	    	
	    	<?php } ?>
	    <?php } ?>	
		<?php if($class == 'right'){ ?>
	    	<?php if ( 'link' == get_post_format() ) { ?>
				<?php if($type == '12'){ ?>
	    			<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
					<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#5dcae4; font-family:Arial, Helvetica, sans-serif; font-size:12px;border-top: 5px solid #5dcae4;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #5dcae4;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#5dcae4; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #5dcae4;"><tr><td height="60" valign="top"><a href="<?php global $post;$text = get_post_meta( $post->ID, '_cmb_test_title', true );echo $text; ?>?edm-<?php the_time('y-m-d') ?>" style="color:#5dcae4; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>  
				<?php } ?>	    	
	    	<?php } else { ?>
				<?php if($type == '12'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm12'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#5dcae4; font-family:Arial, Helvetica, sans-serif; font-size:12px;border-top: 5px solid #5dcae4;"><tr><td><?php the_title(); ?></td></tr></table>
				<?php } ?>
				<?php if($type == '6'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm6'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #5dcae4;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#5dcae4; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>
				<?php if($type == '4'){ ?>
	    				<a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm4'); ?></a>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="border-top: 5px solid #5dcae4;"><tr><td height="60" valign="top"><a href="<?php the_permalink(); ?>?edm-<?php the_time('y-m-d') ?>" style="color:#5dcae4; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-decoration:none;"><?php the_title(); ?></a></td></tr></table>
						<table width="100%" cellspacing="5" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr><td><?php the_excerpt(); ?></td></tr></table>

				<?php } ?>	    	
	    	<?php } ?>
	    <?php } ?>	

	<?php endwhile; ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	wp_reset_query();
}
add_shortcode('edmother', 'other_loop');

function table($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => 'color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;',
		'width' => '650',
		'border' => '0',
		'cellspacing' => '10',
		'cellpadding' => '0'
	), $atts));
	return '<table style="'.$style.'" border="'.$border.'" cellspacing="'.$cellspacing.'" cellpadding="'.$cellpadding.'" width="'.$width.'">';
}
add_shortcode('table', 'table');

function tr($atts, $content = null) {
	return '<tr>';
}
add_shortcode('tr', 'tr');

function endtr($atts, $content = null) {
	return '</tr>';
}
add_shortcode('endtr', 'endtr');

function td($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => 'outline: 1px solid #E8E9EA; border:1px solid #D4D6D8;',
		'bgcolor' => '#F8F8F8',
		'align' => 'left',
		'valign' => 'top'
	), $atts));
	return '<td bgcolor="'.$bgcolor.'" align="'.$align.'" valign="'.$valign.'" style="'.$style.'">';
}
add_shortcode('td', 'td');

function endtd($atts, $content = null) {
	return '</td>';
}
add_shortcode('endtd', 'endtd');

function endtable($atts, $content = null) {
	return '</table>';
}
add_shortcode('endtable', 'endtable');

function otherSC() {
    return '<div class="col-12 columns center"><img src="'. get_template_directory_uri() .'/img/footer_divider.png" alt="footer_divider" width="811" height="11" /></div>';
}
add_shortcode('other', 'otherSC');

function EDMotherSC() {
    return '<table width="650" border="0" cellspacing="10" cellpadding="0">
    	<tr>
    		<img src="'. get_template_directory_uri() .'/img/footer_divider.png" alt="footer_divider" width="630" height="11" />
    	<tr>
    </table>';
}
add_shortcode('otheredm', 'EDMotherSC');

function EDMinthenewsSC() {
    return '<table width="650" border="0" cellspacing="10" cellpadding="0" style="border-top: 5px solid #b3bf28;"><tr>
    	<td>
    		In the news
    	</td>
    </tr></table>';
}
add_shortcode('edmnews', 'EDMinthenewsSC');


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
			),
			array(
				'name' => 'Special',
				'desc' => '',
				'type' => 'wysiwyg',
				'id' => $prefix . 'yearend',
				'options' => array(
					'wpautop' => true,
					'media_buttons' => false,
					'tiny_mce' => true
				)
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

function edm_page() {
	p2p_register_connection_type( array(
		'name' => 'issue_to_edm',
		'from' => 'page',
		'to' => 'edm'
	) );
}
add_action( 'p2p_init', 'edm_page' );

add_filter('comment_form_default_fields', 'clear_url_box');
function clear_url_box($fields){
    if(isset($fields['url']))
    unset($fields['url']);
    return $fields;
}

class description_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<td id="menu-item-'. $item->ID . '"' . $value . $class_names .' style="'.$item->description.'" width="25%">';

		$attributes  = ! empty( $item->attr_title ) ? ' style="'  . $item->attr_title .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		if($depth != 0) {
			$description = $append = $prepend = "";
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
