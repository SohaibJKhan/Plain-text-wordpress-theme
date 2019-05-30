<?php get_header(); ?>
<div class="page-content">
      <div class="wrapper">
        <div class="header">
          <h1><?php _e("Page Not found" , "plaintext"); ?></h1>
        </div>
        <div class="body">

          <p><?php _e("Looks like you've followed a broken link or entered a URL that doesn't  exist on this site.", "plaintext");?></p>

          <p>
            <a id="back-link" href="<?php echo esc_url( home_url("/")); ?>"><- <?php _e("Back to our site" , "plaintext"); ?></a>
          </p>
        </div>
      </div>
    </div>

<?php get_footer(); ?>