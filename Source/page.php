<?php get_header(); ?>
<div class="page-content">		
	<div class="wrapper">
				<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>					
				<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>						
						<div class="post-header">
							<h1 class="entry-title" id="post_heading">
								<?php the_title(); ?>
							</h1>
							<?php get_the_tags(); ?>
							<p class = "post_date"><?php the_date('M-Y'); ?>  </p>
						</div>
						<?php the_content(); ?>
				</div>					
				<?php endwhile; ?>
				<?php else : ?>
				<div class="post"><h2><?php _e('Not Found', 'plaintext'); ?></h2></div>
				<?php endif; ?>		

		
	</div>
</div>
<?php get_footer(); ?>