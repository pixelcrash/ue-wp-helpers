/* If you have to create new post with a new language you can duplicate all 
the existing posts and duplicate their content (including ACF) 
and relate the new post to the new translation and connect with the other 
language translation */

// 1. Our site was setup in german (de) and we added an english (en) version

// 2. First we check if the site already has a translation (for each post_type)

// You can call this function ue_check_language('your-post-type');

function ue_check_language($post_type){
  global $post;
  $args = array(
     'posts_per_page'    =>  -1,
     'post_type'         =>  $post_type,
     'lang'              => 'de'
  );
  
  $query = new WP_Query( $args );
  $i = 0;
  if($query->have_posts()):
    while ( $query->have_posts() ) : $query->the_post();
    $de_id = get_the_ID();
    // getting the translated id 
    $en_id = pll_get_post( $de_id, 'en' );
    the_title(); 
    // if there is no translation
    if(!$en_id):
      // Duplicate Post
      $new_post = ue_duplicate($de_id);
      // Set language for the new post
      pll_set_post_language($new_post, 'en');
      // Releate the languages 
      pll_save_post_translations( array(
      	'de' => $de_id,
      	'en' => $new_post,
      ));
      echo " - did Translation: $new_post ";
    endif;
    echo "<hr>";
  endwhile; endif; wp_reset_postdata(); 
}

// Function to duplicate post content + acf fields 

function ue_duplicate($post_id) {
   $title   = get_the_title($post_id);
   $oldpost = get_post($post_id);
   $post    = array(
     'post_title' => $title,
     'post_status' => 'publish',
     'post_type' => $oldpost->post_type,
     'post_author' => 1
   );
   $new_post_id = wp_insert_post($post);
   // get all the meta fields (ACF)
   $data = get_post_custom($post_id);
   foreach ( $data as $key => $values) {
     foreach ($values as $value) {
       add_post_meta( $new_post_id, $key, $value );
     }
   }
  // Return the new ID
   return $new_post_id;
 }
