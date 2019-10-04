if( ! function_exists('ue_list_categories')){
    function ue_list_categories($arr=array()){
      
      $arr['class'] = ($arr['class']) ? $arr['class']  :  ''; 
      $all = ($arr['all']) ? 1  :  0; 
      $allid = ($arr['all']) ? $arr['all']  :  get_option( 'page_on_front' );
      $cats = "";
    
      if($all): 
        $cats .= "<li><a href='".get_the_permalink($allid)."' class='current-cat'>All</li>"; 
      else:
        $cats .= "<li><a href='".get_the_permalink($allid)."' class=''>All</li>";
      endif;
      
      if($arr['parents']):
      foreach($arr['parents'] as $parent):
      $cats .= wp_list_categories( array(
            'orderby'    => 'name',
            'show_count' => true,
            'hierarchical'        => false,
            'title_li'            => NULL,
            'echo'              =>  0,
            'current_category'    => 0,
            'child_of'            => $parent
        )); 
      endforeach;
      endif;
        
        echo "<ul class='".$arr['class']."' >";
        echo $cats;
        echo "</ul>";  
      }
}
