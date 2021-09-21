// get all products and their TERMS

$args = array(
    'hide_empty' => false, 
    'orderby' => 'name'
);
      
// update post_type
$posts_in_post_type = get_posts( array(
    'fields' => 'ids',
    'post_type' => 'custom_post_type',
    'posts_per_page' => -1,
    'suppress_filters' => 0
) );

// update custom_taxonomy 
$ins = wp_get_object_terms( $posts_in_post_type, 'custom_taxonomy', array( 'ids' ) ); 

// CREATE array to store the values
$cTerms = array();

  
if($ins):

  // First add all parents and also a bool to check if it is a parent or not
  foreach($ins as $in):
    if($in->parent):
      $cTerms[$in->parent]['name'] = get_term( $in->parent )->name;
      $cTerms[$in->parent]['parent'] = 1;
    endif;
  endforeach;

  // add values - check if the value has a parent or not
  // if has parent add it to [childs]
  foreach($ins as $in):
    if($in->parent):
      $newdata = array($in->term_id => $in->name, "name" => $in->name, "child_id" => $in->term_id);
      $cTerms[$in->parent]['childs'][] = $newdata;
    else:
      $cTerms[$in->term_id]['name'] = $in->name;
      $cTerms[$in->term_id]['parent'] = 0;
    endif;
  endforeach;

  // SORT Main Array
  usort($cTerms, function($a, $b) {
    return $a['name'] <=> $b['name'];
  });

  // SORT Childs
  if($cTerms):
    foreach($cTerms as $cterm):
      if($cterm['parent']):
        usort($cterm['childs'], function($a, $b) {
          return $a['name'] <=> $b['name'];
        });
      endif;
    endforeach;
  endif;


endif;

// possible output as select with parent as optgroup header
echo "<select>";
foreach($cTerms as $key => $menu):

  if($menu['parent']):
    echo '<optgroup label="'.$menu['name'].'">';      
    if($menu['childs']):
     foreach($menu['childs'] as $child):
       echo '<option value="'.$child['child_id'].'">'. $child['name'] .'</option>';
     endforeach;
     echo '</optgroup>';  
    endif;
  else:
    echo '<option value="'.$key.'">'. $menu['name'] .'</option>';
  endif;

endforeach;
echo "</select>";
