<?php get_header(); ?>
	<div class="col-group">
		<p>	</p>
		<div class="col-12">
	    	<div class="col-content article">
	    		<div class="article_header">
	    		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	    			<?php if ( has_post_thumbnail() ) { ?>
	    			    <?php the_post_thumbnail(); ?>
	    			<?php } ?>
	    			<h4><?php the_title(); ?></h4>
	    		</div>
	    	</div>
	    </div>
	</div>
	<div class="col-group">
		<div class="col-9">
	    	<div class="col-content article">
				<div class="meta"><a href="mailto:Enter recipient here?subject=The Insider article recommendation&body=I thought you might be interested in <?php the_title(); ?>. You can view it at: <?php the_permalink(); ?>"><i class="icon-envelope-alt"></i> Email</a> <a href="#respond"><i class="icon-comments-alt"></i> Comments</a> <!--a href="http://localhost:8888/insider/wp-admin/admin-ajax.php?action=wti_like_post_process_vote&task=like&post_id=<?php  the_ID(); ?>&nonce=45a02a1e33"><i class="icon-thumbs-up-alt"></i> Like</a--> <?php GetWtiLikePost(); ?></div>
				<div class="single_title">
					<?php the_title(); ?>
				</div>
				<?php the_content(); ?> 
				<div class="meta"><a href="mailto:Enter recipient here?subject=The Insider article recommendation&body=I thought you might be interested in <?php the_title(); ?>. You can view it at: <?php the_permalink(); ?>"><i class="icon-envelope-alt"></i> Email</a> <a href="#respond"><i class="icon-comments-alt"></i> Comments</a> <!--a href="http://localhost:8888/insider/wp-admin/admin-ajax.php?action=wti_like_post_process_vote&task=like&post_id=<?php  the_ID(); ?>&nonce=45a02a1e33"><i class="icon-thumbs-up-alt"></i> Like</a--> <?php GetWtiLikePost(); ?></div>
				<hr />
				<?php comments_template(); ?>
				<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); paginate_comments_links(); ?>
			    <?php endwhile; ?>
			    
			    <?php else : ?>
			    
			    <?php endif; ?>	
				
			</div>
		</div>
		<div class="col-3">
	    	<div class="col-content article">
				<?php if (is_active_sidebar('archive')) : ?>
				<div id="archive_widget" class="widget_area">
					<ul><?php dynamic_sidebar( 'archive' ); ?></ul>
				</div>    
				<?php endif; ?>	
			</div>
		</div>
	</div>
	

<?php get_footer(); ?>	