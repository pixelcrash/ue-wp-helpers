If you create a new post via an xml request (I used Zapier) 
and you want to update that post with the hook "save_post"

You need to do the following

1. add the hook:
add_action('save_post', 'ue_new_instagram', 10, 2);

2. Create the function:
function ue_new_instagram($post_id, $post){
   
    //determine post type
    if(get_post_type( $post_id ) == 'instagram'){
      $my_post = array(
      'ID'           => $post_id,
        'post_title'   => 'This is the post title.2',
        'post_content' => 'This is the updated content.2',
      );
      // remove the function 
      remove_action( 'save_post', 'ue_new_instagram');
      
      // update the post
        wp_update_post( $my_post );
        
      // add the functiong again
        add_action('save_post', 'ue_new_instagram', 10, 2);
    }
    
}


