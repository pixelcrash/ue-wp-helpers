function updateTime(){
  global $post;
  $argss = array(
    'numberposts'	=> -1,
    'post_type'		=> 'instagram'
  );
  
  $igs = new WP_Query( $argss );  
  
  if($igs->have_posts()) :
    while($igs->have_posts()) : $igs->the_post(); 
      
      $time = get_field('timestamp');
      $post_id = get_the_ID();

    endwhile;
  endif;
  
  wp_reset_postdata();
}
