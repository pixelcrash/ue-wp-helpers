<?php 
// Tested August 2019 
// $new_id is the ID of the post, product, page or custom post type
// 


update_post_meta( $new_id, '_yoast_wpseo_title', 'title' );
update_post_meta( $new_id, '_yoast_wpseo_focuskw', 'keyword1 keyword2' );
update_post_meta( $new_id, '_yoast_wpseo_metadesc', 'description' );
update_post_meta( $new_id, '_yoast_wpseo_opengraph-title', 'title' );
update_post_meta( $new_id, '_yoast_wpseo_opengraph-description', 'description' );
update_post_meta( $new_id, '_yoast_wpseo_opengraph-image', 'image url' );
update_post_meta( $new_id, '_yoast_wpseo_twitter-title', 'title' );
update_post_meta( $new_id, '_yoast_wpseo_twitter-description', 'description' );
update_post_meta( $new_id, '_yoast_wpseo_twitter-image', 'image url with http: or https: ' );

?>
