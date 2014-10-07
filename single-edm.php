<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <style type="text/css">
/*<![CDATA[*/
    .ReadMsgBody { width: 100%;} 
    .ExternalClass {width: 100%;}
    .ExternalClass * {line-height: 100%}  
    div, p, a, li, td { -webkit-text-size-adjust:none; }
    /*]]>*/
    </style>
</head>

<body bgcolor="#E8E9EA" style="text-align:center; margin:0; padding:0; background:#e8e9ea" <?php body_class(); ?>>
    <table class="single-edm" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#E8E9EA;">
        <tr>
            <td align="center" valign="top">
                <table width="660" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="outline: 1px solid #C9CCCF; border:1px solid #B4B8BB;">
                    <tr>
                        <td>

				 		<?php
							$defaults = array(
								'theme_location'  => 'header_menu',
								'menu'            => '',
								'container'       => 'false',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'menu',
								'menu_id'         => '',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<table width="650" border="0" cellspacing="10" cellpadding="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><tr>%3$s</tr></table>',
								'depth'           => 0,
								'walker' => new description_walker()
							);		
						?>
						<?php wp_nav_menu($defaults); ?>  

                        </td>
                        
                    </tr>
                    
                    <tr>
                    	<td>
                    		<table width="650" border="0" cellspacing="10" cellpadding="0">
                    			<tr>
                    				<td align="left" valign="middle" style="border-bottom: 3px solid #69adcd; padding-bottom: 10px;">
                    					<a href="<?php bloginfo('url'); ?>?edm-<?php the_time('y-m-d') ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" width="464" height="91"></a>
                    				</td>
                    			</tr>
                            </table>                    	
                    	</td>
                    </tr>  
                    <tr>
                    	<td>
                    	<table width="650" border="0" cellspacing="10" cellpadding="0">
                    			<tr>
                    				<td align="left" valign="middle" style="color: #4E7BB2;font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
										<?php the_time('F Y') ?> | 
										<?php 
											if(is_page()){
												the_title();
											} else {
												$connected = new WP_Query( array(
												  'connected_type' => 'issue_to_edm',
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
                    				</td>
                    			</tr>
                    	</table>		
                    	</td>
                    </tr> 
					<tr>
						<td>
							<table width="650" border="0" cellspacing="10" cellpadding="0">
								<td>
									<a href="https://twitter.com/tata_comm" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter_btn.jpg" alt="tata_comms" width="248" height="50"></a>
								</td>

								<td align="right">
									<a href="http://facebook.com/TataCommunications" target="_blank" class="facebook"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.jpg" alt="facebook" width="23" height="22" /></a>
									<a href="http://youtube.com/tatacomms" target="_blank" class="youtube"><img src="<?php echo get_template_directory_uri(); ?>/img/youtube.jpg" alt="youtube" width="23" height="22" /></a>
									<a href="http://linkedin.com/company/tata-communication" target="_blank" class="linkedin"><img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.jpg" alt="linkedin" width="22" height="22" /></a>
									<a href="https://emea.salesforce.com/_ui/core/chatter/groups/GroupProfilePage?g=0F920000000L118&fromEmail=1" target="_blank" class="chatter"><img src="<?php echo get_template_directory_uri(); ?>/img/chatter.jpg" alt="chatter" width="23" height="22" /></a>
									<a href="http://incompass1:8080/vline/" target="_blank" class="vline"><img src="<?php echo get_template_directory_uri(); ?>/img/vline.jpg" alt="chatter" width="23" height="22" /></a>
								</td>					
							</table>
						</td>
					</tr>                    
                    <tr>
                    
                    	<td>
                    		<?php if (have_posts()) : while (have_posts()) : the_post(); ?><?php the_content(); ?><?php endwhile; ?><?php else : ?><?php endif; ?>
                    	</td>
                    </tr>
                    
                    <tr>
                    	<td>
                    	<table width="650" cellspacing="10" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
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
                        	<td bgcolor="#F8F8F8" align="left" valign="top" style="outline: 1px solid #E8E9EA; border:1px solid #D4D6D8;">
                        		<a href="<?php global $post; $url = get_post_meta( $post->ID, '_cmb_test_title', true ); echo $url;  ?>?edm-<?php the_time('y-m-d') ?>"><?php the_post_thumbnail('edm3'); ?></a>
                            </td>
                        <?php } else { ?>
                        	<td bgcolor="#F8F8F8" align="left" valign="top" style="outline: 1px solid #E8E9EA; border:1px solid #D4D6D8;">
                        		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
                        		<tr>
                        		<td width="50%">
                        		<?php the_post_thumbnail('half'); ?>
                        		</td>
                        		<td>
                        			<h5 style="margin: 0 5px 5px 0;color:#fca73e; font-family:Arial, Helvetica, sans-serif; font-size:14px"><?php the_title(); ?></h5>
                        			<p style="margin: 0 5px 5px 0;"><?php echo get_the_excerpt(); ?> <a href="<?php global $post; $url = get_post_meta( $post->ID, '_cmb_test_title', true ); echo $url;  ?>?edm-<?php the_time('y-m-d') ?>">Read more &raquo;</a></p>
                        		</td>
                        		</tr>
                        		</table>
                            </td>
                        <?php } ?>
                        <?php } } else {  } wp_reset_postdata(); ?>
                        </table>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
							<table width="650" border="0" cellspacing="10" cellpadding="0" style="color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
								<tr>
									<td align="left" valign="middle"><a href="mailto:Internal.Communications@tatacommunications.com" style="color:#4e7bb2; text-decoration:none;">Get involved: Email your articles and we'll post them in The Insider.</a></td>
									<td align="right" valign="middle"><img src="<?php echo get_template_directory_uri(); ?>/img/f1_logo.jpg" width="159" height="54" alt="F1 Partner" /></td>
								</tr>
							</table>
                    	</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
