// VIA https://www.codementor.io/robbertvermeulen/get-nav-menu-items-by-location-es0n8lmtt

function get_nav_by_location( $location, $args = [] ) {
    $locations = get_nav_menu_locations();
    $object = wp_get_nav_menu_object( $locations[$location] );
    $menu_items = wp_get_nav_menu_items( $object->name, $args );
    return $menu_items;
}


// ADD Filter to add "Current" 
add_filter( 'wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3 );

function prefix_nav_menu_classes($items, $menu, $args) {
    _wp_menu_item_classes_by_context($items);
    return $items;
}

// HOW TO USE

$menu_items = get_nav_by_location('locationname');
if($menu_items):
foreach($menu_items as $item):
  echo $item->ID . " " . $item->url . " " . $item->title . " " . $item->current . "<hr>";
endforeach;
endif;


// UPDATE 
// is working now also with classe, current item 

<?php
  // Name of the Menu
  $menu_items = get_nav_by_location('main');
?>
			
<ul class="uk-navbar-nav">
  <?php if($menu_items): ?>
    <?php foreach($menu_items as $item): ?>
      <li class="<?=$item->current; ?>">
        <a href="<?=$item->url; ?>" class=" stretch 
          <?php echo implode(" ", $item->classes); ?>" id="menu-<?=$item->ID;?>" title="<?=$item->description; ?>"><?=$item->title; ?>
        </a>
      </li>
    <?php endforeach; ?>
  <?php endif; ?>
</ul>
