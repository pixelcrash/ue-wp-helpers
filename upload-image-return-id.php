<?php
// $image_url is pointing to an image on the same server
// If you have a folder where all the images are you can do it like this

// Folder with subfolders
$path = ABSPATH . 'posters';

// Storing all subfolders in Array
$dir = glob($path . '/*' , GLOB_ONLYDIR);

//choosing a random folder from array
$rand = array_rand($dir);

// returning the name of the folder
$foldername = basename($dir[$rand]); 

// Our Image had the same name as the foldername and was placed inside the folder "cover"

$img = $dir[$rand] . "/cover/" . $foldername . ".png";
$coverid = ue_upload_imag($img);

// Make the uploaded folder the featured image of a new post with the ID $new_id;
set_post_thumbnail($new_id, $coverid);

// Get the url for the YOAST Plugin for og:graph (you could add size for twitter and facebook)
$social_img = wp_get_attachment_image_src( $coverid, 'facebook' );
$seo['img_facebook'] = $social_img[0];
$social_img = wp_get_attachment_image_src( $coverid, 'twitter' );
$seo['img_twitter'] = $social_img[0];
  
function ue_upload_imag($image_url){

      
      $upload_dir = wp_upload_dir();
      $image_data = file_get_contents( $image_url );
      $filename = basename( $image_url );

      if ( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
      }
      else {
      $file = $upload_dir['basedir'] . '/' . $filename;
      }

      file_put_contents( $file, $image_data );

      $wp_filetype = wp_check_filetype( $filename, null );

      $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => sanitize_file_name( $filename ),
      'post_content' => 'kkkk',
      'post_status' => 'inherit'
      );

      
      $attach_id = wp_insert_attachment( $attachment, $file );
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      return $attach_id;
}

?>
