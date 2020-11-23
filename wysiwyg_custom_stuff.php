<?php
// ADD Custom Colors 
function my_mce4_options($init) {

    $custom_colours = '
        "000000", "Black",
        "FF5719", "Programm",
        "29F73F", "People",
        "7F26FF", "Place"
    ';
    
    $init['textcolor_map'] = '['.$custom_colours.']';
    $init['textcolor_rows'] = 1;
    $init['textcolor_cols'] = 4;

    return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');
