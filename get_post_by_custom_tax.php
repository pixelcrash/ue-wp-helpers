<?php

  $terms = get_terms( array(
    "taxonomy" => "country",
  ));
  
  foreach($terms as $term): 
  
  $posts = get_posts(["post_type" => "stockist", 'tax_query' => 
  array(
      array('taxonomy' => 'country',
      'field' => 'term_id',
      'terms' => $term->term_id)
    )]);
  
    if($posts):
      foreach($posts as $post):
        echo $post->ID . " " . $post->post_title . "<br>;
      endforeach;
    else:

    endif;
  
  endforeach;
  
  

?>
