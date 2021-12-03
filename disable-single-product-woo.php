add_action('init','prevent_access_to_product_page');
function prevent_access_to_product_page(){
    if ( is_product() ) {
        wp_redirect( site_url() );//will redirect to home page
    }
}
