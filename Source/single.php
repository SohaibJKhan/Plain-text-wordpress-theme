<?php get_header(); ?>
<div class="page-content">
	<div class="plaintext_single">		
		<div class="row">
			<div class = "col-8">
				<div id="content">
					<?php if(have_posts()) : ?>
					<?php while(have_posts()) : the_post(); ?>
					<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="post-header">
							<h1 class="entry-title" id="post_heading">
							<?php the_title(); ?>
							</h1>
							<?php get_the_tags(); ?>
							<p class = "post_date"><?php the_date('M-Y'); ?>  </p>
							<?php the_post_thumbnail('large'); ?>
						</div>
						<div class="entry" id = "post_content">
							<?php the_content(); ?>
							<?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
						</div>
					</div>
					<?php endwhile; ?>
					<?php else : ?>
					<div class="post"><h2><?php _e('Not Found' , 'plaintext'); ?></h2></div>
					<?php endif; ?>		
					<?php comments_template(); ?>
				</div>
			</div>

			<div class="col-4">
				<div class="primary_sidebar">
					<?php dynamic_sidebar('first_sidebar'); ?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>