<?php
  if ( have_posts() ) :
    while ( have_posts() ) :
      the_post();
?>
<main>
<?php

if( have_rows('blocke') ):
  while ( have_rows('blocke') ) : the_row();
    // Get template part based on the ue block 
    $template = get_row_layout();
    get_template_part('ue-blocks/block', $template);
  endwhile;
else :
  // no layouts found
endif;

?>
</main>

<?php endwhile; endif; ?>
