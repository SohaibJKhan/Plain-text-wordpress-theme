<?php  
 get_header(); ?>
 <div class="page-content">
 	<div class="wrapper">
	 
			<div id="content">
				<h3 class = "blog_heading"><?php echo "Blog" ?></h3>
					<?php if(have_posts()) : ?>
					<?php while(have_posts()) : the_post(); ?>
					
					<div class="post" id="post-<?php the_ID(); ?>">
						
						<div class="entry" id="blog_posts_page">
							<span class="post_date"><?php the_date('M, Y'); ?></span>
							<h2 class = "page_title_heading"><a href="<?php the_permalink();?>"> <?php the_title(); ?></h2> </a>
							
						</div>
					</div>
					
					<?php endwhile; ?>
					<?php else : ?>
					<div class="post"><h2><?php _e('Not Found' ,'plaintext'); ?></h2></div>
					<?php endif; ?>
					<?php the_posts_pagination( array( 
						'show_all' => true,
							) ); 
					?>

			</div>
		
	</div>
</div>
<?php get_footer(); ?>