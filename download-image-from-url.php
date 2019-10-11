function ue_upload_image($img_url, $id){

      //using the API JSON from Instagram
      $image_url = $img_url;
      $upload_dir = wp_upload_dir();
      echo "image url: " . $image_url; 
      $data = file_get_contents( $image_url );
      $filename = basename($image_url);
      $filename = str_replace('?_nc_ht=scontent.cdninstagram.com', '', $filename);

      if ( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
      }
      else {
      $file = $upload_dir['basedir'] . '/' . $filename;
      }

      file_put_contents( $file, $data );

      //$wp_filetype = wp_check_filetype( $id, null );

      $attachment = array(
      'post_mime_type' => 'image/jpeg',
      'post_title' => sanitize_file_name( $filename ),
      'post_content' => $id,
      'post_status' => 'inherit'
      );

      
      $attach_id = wp_insert_attachment( $attachment, $file );
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      return $attach_id;
}

