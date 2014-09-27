<?php 
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage JDs_portfolio
 */
 
$JDs_Portfolio_get_db = unserialize( get_option( 'JDs_portfolio_option' ) ) ;

if( $JDs_Portfolio_get_db['JDs_columns'] ) { $JDs_columns = $JDs_Portfolio_get_db['JDs_columns']; }
	else { $JDs_col = 'col-md-4'; }

if( $JDs_Portfolio_get_db['JDs_animation'] ) { $JDs_animation = $JDs_Portfolio_get_db['JDs_animation']; }
	else { $JDs_animation = 'fade'; }
	
if( $JDs_Portfolio_get_db['JDs_overlay_bg'] ) { $JDs_overlay_bg = $JDs_Portfolio_get_db['JDs_overlay_bg']; }
	else { $JDs_overlay_bg = 'grey'; }
	
if( $JDs_Portfolio_get_db['JDs_img_width'] ) { $JDs_img_width = $JDs_Portfolio_get_db['JDs_img_width']; }
	else { $JDs_img_width = '100%'; }
	
if ( $JDs_Portfolio_get_db['JDs_img_height'] ) { $JDs_img_height = $JDs_Portfolio_get_db['JDs_img_height']; }
	else { $JDs_img_height = 'auto'; }

?>

<div class="JDs_portfolio">
	
    <div class="JDs_category">
		<button class="filter" data-filter="all">All</button>
        <?php JDs_portfolio_list_categories(); ?>
	</div><!-- JDs category -->
    
    <div id="JDs_portfolio_container" class="row">
    	<?php 
			$JDs_portfolio = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => '-1')); 
			
			while ($JDs_portfolio->have_posts()) : $JDs_portfolio->the_post();
			
				global $JDs_meta;
				$meta = $JDs_meta->the_meta();
				
				$project_url = '#';
				if(isset($meta['project_url'])){
					$project_url = $meta['project_url'];
				}
				
				$JDs_item_classes = JDs_portfolio_add_classes(get_the_ID());
				$JDs_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		?>
        
        	<div class="<?php echo $JDs_columns." mix ".$JDs_item_classes;?> ">
        		<div class="JDs_portfolio_item">
                	<img class="JDs_portfolio_itemimg" src="<?php echo $JDs_img_src[0] ;?>" 
                	alt="JDs Portfolio Image" />
                
                	<div class="JDs_portfolio_overlay <?php echo $JDs_overlay_bg ." ".$JDs_animation; ?>">
                		<div class="JDs_overlay_link">
                    		<a href="<?php echo $JDs_img_src[0] ;?>" rel="prettyPhoto">
                            	<i class="fa fa-search"></i></a>
                    		<a href="<?php echo $project_url; ?>"><i class="fa fa-link"></i></a>
                    	</div>
                	</div>
                </div>
       		</div><!-- JDs Portfolio Item -->
        
		<?php 
			endwhile;
        	wp_reset_postdata();
		?>
    </div><!-- row -->    
</div><!-- JDs Portfolio -->

<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function(){
	jQuery('#JDs_portfolio_container').mixItUp({
		animation: {
			enable: true,
			duration: 400,
			effects: 'fade translateZ(-360px) stagger(34ms)',
			easing: 'cubic-bezier(0.445, 0.05, 0.55, 0.95)'
		}	
	});

    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>