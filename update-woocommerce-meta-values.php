<?php 
// The functions are helpful if you want to make a product importer or 
// create products with a function and update the values for it

// Create a new product by duplicating a template (this can be in draft)

$wc_adp = new WC_Admin_Duplicate_Product;
$new_product = $wc_adp->product_duplicate( wc_get_product( '831' ) ); //ID of Product Template
$new_product->set_catalog_visibility('visible');
$new_id = $new_product->get_id();
$new_product->save();

// 1. Update ACF REPEATER Field for a product
$colors = array('#888999', '#876589');

foreach($colors as $dot):

  // make array for the fields inside the repeater field
  $row = array(
    'dot' => $dot,
    'other_field_name'   => 'value for other vield' 
    );

  //$new_id is the id of the post or product 
  add_row('repeater_field_name', $row, $new_id);

endforeach;


// 2. Update Title, Content, Excerpt
wp_update_post( array('ID' => $new_id, 'post_title' => 'title'));
wp_update_post( array('ID' => $new_id, 'post_content' => "content"));
wp_update_post( array('ID' => $new_id, 'post_excerpt' => "excerpt"));
wp_update_post(array( 'ID'    =>  $new_id, 'post_status'   =>  'publish' ));

// 3. Woocommerce related fields
update_post_meta( $new_id, '_stock_status', 'instock' );
update_post_meta( $new_id, "_sku", 'sku should be unique');
update_post_meta( $new_id, '_purchase_note', 'purchase_note');


// 4. Add Images to the Image Gallery of the product with upload
$gallery = ""; //Empty Variable to store the ids of the Images

// Variables for the loop and formating the final variable (id, id, id)
$slide_counter = 1;
$slide_n = 0;

// Get images from Folder on Server 
$slider = glob($path .'/gallery/*.{jpg,png,gif}' , GLOB_BRACE);
$slide_n = count($slider);

foreach($slider as $image):
  $name = basename($image);
  $img = $dir[$rand] . "/slider/" . $name;
  $upload_id = ue_upload_imag($img);
  $gallery .= $upload_id;
  // Add comma if it is not the last image in the folder
  if($slide_counter != $slide_n): $gallery .= ", "; endif;
  $slide_counter++;

  // uncomment for debug
  //echo "slide-counter: " . $slide_counter . " - slide_n: " . $slide_n . "<br />";

endforeach;
//echo $gallery;

update_post_meta($new_id, '_product_image_gallery',  $gallery);



?>
