// $taxonomies = array('taxonomy'); 
// $post_types = array('post_type_1'); 

function get_terms_by_post_type( $taxonomies, $post_types ) {

    global $wpdb;

    $query = $wpdb->prepare(
        "SELECT t.*, COUNT(*) from $wpdb->terms AS t
        INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
        INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id
        WHERE p.post_type IN('%s') AND tt.taxonomy IN('%s')
        GROUP BY t.term_id",
        join( "', '", $post_types ),
        join( "', '", $taxonomies )
    );

    $results = $wpdb->get_results( $query );
    
    // use wp_list_sort() to sort the result by name
    $results = wp_list_sort( $results, 'name' );
    
    return $results;

}
