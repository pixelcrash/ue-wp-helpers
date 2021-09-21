  $ins = get_indications_cLang_parent(); 
  $cTerms = array();
  
  if($ins):
    
    // add all parents
    foreach($ins as $in):
      if($in->parent):
        $cTerms[$in->parent]['name'] = get_term( $in->parent )->name;
        $cTerms[$in->parent]['parent'] = 1;
      endif;
    endforeach;
    
    // add values
    foreach($ins as $in):
      if($in->parent):
        $newdata = array($in->term_id => $in->name, "name" => $in->name, "child_id" => $in->term_id);
        //array_push($cTerms[$in->parent], $newdata);
        //$cTerms[$in->parent][] = $newdata;
        $cTerms[$in->parent]['childs'][] = $newdata;
        //echo "has parent: " . $in->name . " " . $in->term_id . " has parent" . $in->parent . "<br>";
      else:
        $cTerms[$in->term_id]['name'] = $in->name;
        $cTerms[$in->term_id]['parent'] = 0;
      endif;
    endforeach;
    
    usort($cTerms, function($a, $b) {
      return $a['name'] <=> $b['name'];
    });
    
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
