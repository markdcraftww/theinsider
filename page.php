<?php get_header(); ?>

	<div class="col-group pageContent">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			<?php the_content(); ?>
					
	    <?php endwhile; ?>
	    
	    <?php else : ?>
	    
	    <?php endif; ?>
	</div>
    <div class="col-group">
    	<div class="col-12"></div>
	    <?php
			$args = array (
				'post_type' => 'spot',
			);
			$spots = new WP_Query( $args );
			if ( $spots->have_posts() ) {
				while ( $spots->have_posts() ) {
					$spots->the_post();
		?>
		<?php if ( 'link' == get_post_format() ) { ?>
					<div class="col-3  upper">
						<div class="col-content spot">
							<a href="<?php global $post; $url = get_post_meta( $post->ID, '_cmb_test_title', true ); echo $url; ?>" target="_blank"><?php the_post_thumbnail(); ?></a>
						</div>
					</div>
		<?php } else { ?>
		<div class="col-3 upper">
			<div class="col-content spot">
				<div class="col-half">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="col-half">
					<h5><?php the_title(); ?></h5>
					<p><?php echo get_the_excerpt(); ?> <a href="<?php global $post; $url = get_post_meta( $post->ID, '_cmb_test_title', true ); echo $url; ?>">Read more &raquo;</a></p>
				</div>
			</div>
		</div>	
	<?php } ?>
	<?php
			}
		} else {
	?>
	<?php
		}
		wp_reset_postdata();    
    ?>
    </div>
<?php get_footer(); ?>	