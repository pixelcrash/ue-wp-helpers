/* <IMG BLOCK> */
function ue_layout_img_shortcode($atts) {
  $a = shortcode_atts( array(
     'id' => '1'
  ), $atts );
  ?> <img  src="<?php echo wp_get_attachment_image_src($atts['id'], 'full')[0]; ?>" uk-img> <?php 
}

add_shortcode( 'img', 'ue_layout_img_shortcode' );

/* </IMG BLOCK> */

/* <IMG IMG BLOCK> */
function ue_layout_imgimg_shortcode($atts) {
  $a = shortcode_atts( array(
     'id1' => '1',
     'id2' => '2'
  ), $atts );
   ?> 
   <img  src="<?php echo wp_get_attachment_image_src($atts['id1'], 'full')[0]; ?>" uk-img>
   <img  src="<?php echo wp_get_attachment_image_src($atts['id2'], 'full')[0]; ?>" uk-img>
  <?php 
}

add_shortcode( 'imgimg', 'ue_layout_imgimg_shortcode' );
