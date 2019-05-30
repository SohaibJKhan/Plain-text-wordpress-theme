<?php

// *** P L A I N  T E X T   F U N C T I O N S  *** // 




//Customizing Comment Box
add_filter( 'comment_form_defaults', 'plaintext_custom_form_fields' );
function plaintext_custom_form_fields( $defaults )
{
    $defaults = array( 'title_reply' => '', 'comment_field' => '<textarea id="comment_box" name="comment" cols="90" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>',);
    return $defaults;
}


function plaintext_setup() {


  // Theme Supports
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );

  //Custom Logo
  add_theme_support( 'custom-logo', array(
      'height'      => 300,
      'width'       => 300,
      'flex-height' => true,
    ) );
  add_theme_support( 'custom-background' );

  add_editor_style( '/css/editor-style.css' );

  register_nav_menus( array( 
    'header_right' => __( 'Main Menu' ,'plaintext' ),
  ));

}

add_action("after_setup_theme" , "plaintext_setup");

function plaintext_content_width()
{
  if ( ! isset( $content_width ) ) $content_width = 780;
}
add_action( 'after_setup_theme', 'plaintext_content_width', 0 );

function plaintext_custom_header_setup() {
add_theme_support( 'custom-header', apply_filters( 'plaintext_custom_header_args', array(
    'width'              => 900,
    'height'             => 119,
    'flex-height'        => true,
    'wp-head-callback'   => 'plaintext_header_style',
  ) ) );
}

add_action( 'after_setup_theme', 'plaintext_custom_header_setup' );

function plaintext_header_style() {
  $header_text_color = get_header_textcolor();
  /*if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
    return;
  }*/
  ?>
  <style id="plaintext-custom-header-styles" type="text/css">
    .site-title>a ,.header_menu>li>a
    {
        color: #<?php echo esc_attr( $header_text_color ); ?>;
    } 
    .site_header {
      background-image: url( <?php header_image(); ?> );
    }
  </style>
  <?php
}


// ** DO NOT INTERRUPT WITH THIS CLASS !! **
class plaintext_Menu_Walker extends Walker {

  var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');
  
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }
  
  function end_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
  
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
  
    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';
    $class_names = $value = '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;
    
    /* Add active class */
    if (in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }
    
    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }
    
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    
    $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';
    
    $output .= $indent . '<li' . $id . $value . $class_names .'>';
    
    $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
    $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
    $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
    $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
    
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'><span>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;
    
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
  
  function end_el(&$output, $item, $depth = 0, $args = array()) {
    $output .= "</li>\n";
  }
}


//enqueue scripts
function plaintext_scripts() {
  
  wp_enqueue_style( 'plaintext', get_template_directory_uri() .'/style.css' );
  wp_enqueue_style( 'meanmenu', get_template_directory_uri() .'/css/meanmenu.css' );
  wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
  wp_enqueue_script( 'meanmenu-js', get_template_directory_uri() .'/js/jquery.meanmenu.js'  , array('jquery'));
  wp_enqueue_script( 'plaintextjs', get_template_directory_uri() .'/js/script.js'  , array('jquery'));


  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'plaintext_scripts' );


//sidebars
function plaintext_registering_sidebar()
{
	register_sidebar( array(
	'id' => 'primary_sidebar' ,
	'name' => __ ('Primary Sidebar' , 'plaintext') ,
	'description' =>__('This is the Primary Sidebar' , 'plaintext'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'before_title'  => '<h3 class="plaintext_primary_sidebar">',
    'after_title'   => '</h3>',
    'after_widget'  => '</div>',
		) 
	);
}

add_action( 'widgets_init' , 'plaintext_registering_sidebar' );

