				<?php if( !defined('ABSPATH') ) exit;?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                	<?php 
	                		if( has_post_thumbnail() ){
	                			print '<a href="'.get_permalink($post->ID).'">'. get_the_post_thumbnail(NULL,'blog-large-thumb', array('class'=>'img-responsive')) .'</a>';
	                		}
	                	?>
	                    <div class="post-header">
	                        <h2>
	                        	<?php if( !is_single() ):?>
	                        		<a href="<?php the_permalink();?>"><?php the_title();?></a>
	                        	<?php else:?>
	                        		<?php the_title();?>
	                        	<?php endif;?>
	                        </h2>
	                        <?php print apply_filters('mars_blog_metas',null);?>
	                    </div>
	                    <div class="post-entry">
	                    	<?php if( !is_single() ):?>
	                        <?php the_excerpt();?>
	                        <a href="<?php the_permalink();?>" class="readmore"><?php _e('Read More','mars');?></a>
	                        <?php else: the_content();?>
	                        <?php wp_link_pages();?>
	                        <?php endif;?>
	                    </div>
                    </div>