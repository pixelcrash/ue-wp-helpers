function create_new_post($title, $content, $slug){
  
  $data = array(
  'post_title'    => wp_strip_all_tags( $title ),
  'post_content'  => $content,
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_category' => array( 8,39 )
);
 
// Insert the post into the database
$new_post_id = wp_insert_post( $data );
if($new_post_id){
  $slug = sanitize_title_with_dashes($slug);
  wp_update_post( array(
            'ID' => $new_post_id,
            'post_name' => $slug // do your thing here
        ));
}else{
  // ALL BAD
}
 

}
