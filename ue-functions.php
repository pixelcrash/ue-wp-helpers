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
