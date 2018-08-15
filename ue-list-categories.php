<?php 

//Custom list of categories with seperator and optional link output

function ue_list_cats($id, $links=1, $seperator=", "){

$categories = get_the_category($id);
if( $categories ){
    $output = "";

    // CHILD CATEGORIES
    foreach ($categories as $category) {
        if( $category->parent ){
          if($links){
            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" >' . $category->name.'</a>' . $seperator;
          }else{
            $output .= $category->name. $seperator;
          }  
        }
    }
    echo trim($output, $seperator);
}
}
