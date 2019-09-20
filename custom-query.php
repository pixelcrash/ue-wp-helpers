<?php the_post(); ?>
<?php
  $args = array( 
    'post_type' => 'post'
  );
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ) :
  while ( $the_query->have_posts() ) : $the_query->the_post();
?>

// HERE GOES LOOP DATA

<?php
  endwhile;
  endif;
  wp_reset_postdata();
?>
