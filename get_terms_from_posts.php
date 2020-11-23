<?php
/*
  Get Custom Terms from an array of IDs (f.e. ACF Relationship)
  Return an array 
  array[ID]
   array[ID]['term_id']
   array[ID]['slug']
   array[ID]['name']

*/


if(! function_exists('ue_get_terms_from_posts')){
  function ue_get_terms_from_posts($items, $term='seminar'){
    $output_terms = array(); 
    
    if($items):
      foreach($items as $item):
  
        
        $terms = get_the_terms($item, $term);
        
        if($terms):
          foreach($terms as $singleterm):
            //term_id, slug, name
            if(! array_key_exists($singleterm->term_id, $search_array)):
              $output_terms[$singleterm->term_id]['slug'] = $singleterm->slug;
              $output_terms[$singleterm->term_id]['name'] = $singleterm->name;
            endif;
          
          endforeach;
        endif;
        

      endforeach;
    endif;
    
    return $output_terms;
  }
}
