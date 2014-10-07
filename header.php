<!DOCTYPE html>
<!--[if lt IE 7]><html class="lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><![endif]-->
<!--[if IE 7]><html class="lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><![endif]-->
<!--[if IE 8]><html class="lt-ie9" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html xmlns="http://www.w3.org/1999/xhtml"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" />
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome-ie7.min.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
<![endif]-->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/grid.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.modernizr.js"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="container">

	<div class="col-group">	
		<?php
			$defaults = array(
				'theme_location'  => 'header_menu',
				'menu'            => '',
				'container'       => 'div',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '<div class="col-content">',
				'link_after'      => '</div>',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);		
		?>
		<?php wp_nav_menu($defaults); ?>
	</div>

	<div class="col-group" id="headerSection">
		<div class="col-6 underline">
			<div class="col-content ">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" width="464" height="91"></a>
			</div>
		</div>
		<div class="col-6 underline">
			<div class="col-content logo">
				<form action="<?php bloginfo('url'); ?>" method="get">
					<select id="page_id" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
						<option value="">
						<?php echo esc_attr( __( 'Select Edition:', 'insider' ) ); ?></option> 
						<?php 
							$args = array(
								'sort_order' => 'DESC',
								'sort_column' => 'post_date'
							);
							$pages = get_pages($args); 
							foreach ( $pages as $page ) {
								$option = '<option value="' . get_page_link( $page->ID ) . '">';
								$option .= $page->post_title;
								$option .= '</option>';
								echo $option;
							}
						?>
					</select>
				</form>			
			</div>
		</div>
	</div>

	<div class="col-group">	
		<div class="col-6">
			<div class="col-content edition">
				<?php the_time('F Y') ?> | 
				<?php 
					if(is_page()){
						the_title();
					} else {
						$connected = new WP_Query( array(
						  'connected_type' => 'posts_to_pages',
						  'connected_items' => get_queried_object(),
						  'nopaging' => true,
						) );
						if ( $connected->have_posts() ) : while ( $connected->have_posts() ) : $connected->the_post();
							the_title(); 
						endwhile;
						wp_reset_postdata();
						endif;
					}
				?>
				| For internal distribution only			
			</div>
		</div>
		<div class="col-6">
			<div class="col-content edition logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/tata_comms.jpg" alt="tata_comms" width="179" height="24">
			</div>
		</div>
	</div>

	<div class="col-group">	
		<div class="col-6">
			<div class="col-content">
				<a href="https://twitter.com/tata_comm" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter_btn.jpg" alt="tata_comms" width="248" height="50"></a>
			</div>
		</div>

		<div class="col-6">
			<div class="col-content social">
				<a href="http://webapps/VLine/" target="_blank" class="vline">V-Line</a>
				<a href="http://facebook.com/TataCommunications" target="_blank" class="facebook">Facebook</a>
				<a href="http://youtube.com/tatacomms" target="_blank" class="youtube">YouTube</a>
				<a href="http://linkedin.com/company/tata-communication" target="_blank" class="linkedin">LinkedIn</a>
				<a href="https://emea.salesforce.com/_ui/core/chatter/groups/GroupProfilePage?g=0F920000000L118&fromEmail=1" target="_blank" class="chatter">Chatter</a>
			</div>
		</div>
	</div>