// #footer #script
// Add a custom javascript to the footer -> the very end
add_action('wp_footer', 'ue_footer_scripts', 20);
function ue_footer_scripts(){ ?>
  <script>
      // your custom footer script
  </script>
<?php }


// #debug #helper
// A better var_dump with layout -> makes debuggin cleaner
function var_dump_pre($value){
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
}

// #contactform7 #forms 
// Display a contactform7 inside php 
function showform($id, $attr = "empty"){
  echo do_shortcode( '[contact-form-7 id='.$id.' title="dest"]' );
}

// #CSS #JS
// LOAD CSS & JS
function ue_enqueue_style() {

  wp_enqueue_style( 'uikitmin', get_template_directory_uri() . '/bower_components/uikit/css/uikit.min.css' );
  wp_enqueue_style( 'makeup', get_template_directory_uri() . '/app/css/dist/makeup.css', array(), '0.01', 'all');
  wp_enqueue_script( 'uikit', get_template_directory_uri() . '/bower_components/uikit/js/uikit.min.js', array('jquery')); // loading the uikit framework
  wp_enqueue_script( 'magic', get_template_directory_uri() . '/app/js/magic.js', array('jquery')); // That is where the app magic is happening  
  wp_enqueue_script( 'jscookies', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array('jquery'));
  
}
add_action( 'wp_enqueue_scripts', 'ue_enqueue_style' );

// #Fonts
// LOAD GOOGLE FONTS
function custom_add_google_fonts() {
 wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Open+Sans:400,700', false );
 }
 add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );


// #MENU 
// REGISTER MENUS 

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'lang-menu' => __( 'Language Menu' ),
      'footer-menu-1' => __( 'Footer Menu 1' ),
      'footer-menu-2' => __( 'Footer Menu 2' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// Add features #image
add_theme_support( 'post-thumbnails' );

// Hide Admin bar
add_filter('show_admin_bar', '__return_false');


// #admin #helper #media
// Show the image size in the media list dashboard page
add_filter('manage_upload_columns', 'size_column_register');
function size_column_register($columns) {
    $columns['dimensions'] = 'Dimensions';
    return $columns;
}

add_action('manage_media_custom_column', 'size_column_display', 10, 2);
function size_column_display($column_name, $post_id) {
    if( 'dimensions' != $column_name || !wp_attachment_is_image($post_id)) return;
    list($url, $width, $height) = wp_get_attachment_image_src($post_id, 'full');
    echo esc_html("ID: {$post_id} / {$width}&times;{$height}");
}
