if(! function_exists('get_newsboard()')){
  function get_newsboard($limit=-1, $type="news"){
    global $post;
    $args = array(
      'posts_per_page'	=> $limit,
      'post_type'		=> $type
    );
    
    $posts = new WP_Query( $args );  
    return $posts; 
        
    wp_reset_postdata();
    
  }
}

// in the template

<?php
  $news = get_newsboard(); 
  if($news->have_posts()) : ?>
  <ul uk-accordion>

  <?php  while($news->have_posts()) : $news->the_post(); ?>
  <?php   endwhile; ?>  
  <?php endif;   ?>
