// ALLOW SVG Upload

add_filter(
	'upload_mimes',
	function ( $upload_mimes ) {
		// By default, only administrator users are allowed to add SVGs.
		// To enable more user types edit or comment the lines below but beware of
		// the security risks if you allow any user to upload SVG files.
		if ( ! current_user_can( 'administrator' ) ) {
			return $upload_mimes;
		}

		$upload_mimes['svg']  = 'image/svg+xml';
		$upload_mimes['svgz'] = 'image/svg+xml';

		return $upload_mimes;
	}
);

// Disable core auto-updates
add_filter( 'auto_update_core', '__return_false' );
// Disable auto-updates for plugins.
add_filter( 'auto_update_plugin', '__return_false' );
// Disable auto-updates for themes.
add_filter( 'auto_update_theme', '__return_false' );


// DISABLE GUTENBERG FOR REAK
add_filter('gutenberg_can_edit_post', '__return_false', 5);
add_filter('use_block_editor_for_post', '__return_false', 5);


// DISABLE RESTAPI
add_filter(
	'rest_authentication_errors',
	function ( $access ) {
		return new WP_Error(
			'rest_disabled',
			__( 'The WordPress REST API has been disabled.' ),
			array(
				'status' => rest_authorization_required_code(),
			)
		);
	}
);


// DISABLE ALL COMMENTS
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});


// DISABLE ATTACHMENT PAGES
add_action(
	'template_redirect',
	function () {
		global $post;
		if ( ! is_attachment() || ! isset( $post->post_parent ) || ! is_numeric( $post->post_parent ) ) {
			return;
		}

		// Does the attachment have a parent post?
		// If the post is trashed, fallback to redirect to homepage.
		if ( 0 !== $post->post_parent && 'trash' !== get_post_status( $post->post_parent ) ) {
			// Redirect to the attachment parent.
			wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
		} else {
			// For attachment without a parent redirect to homepage.
			wp_safe_redirect( get_bloginfo( 'wpurl' ), 302 );
		}
		exit;
	},
	1
);


// DISABLE WP VERSION NR
add_filter('the_generator', '__return_empty_string');


// DISABLE XML-RCP
add_filter( 'xmlrpc_enabled', '__return_false' );



// DISABLE SEARCH
add_action(
	'parse_query',
	function ( $query, $error = true ) {
		if ( is_search() && ! is_admin() ) {
			$query->is_search       = false;
			$query->query_vars['s'] = false;
			$query->query['s']      = false;
			if ( true === $error ) {
				$query->is_404 = true;
			}
		}
	},
	15,
	2
);

// Remove the Search Widget.
add_action(
	'widgets_init',
	function () {
		unregister_widget( 'WP_Widget_Search' );
	}
);

// Remove the search form.
add_filter( 'get_search_form', '__return_empty_string', 999 );

// Remove the core search block.
add_action(
	'init',
	function () {
		if ( ! function_exists( 'unregister_block_type' ) || ! class_exists( 'WP_Block_Type_Registry' ) ) {
			return;
		}
		$block = 'core/search';
		if ( WP_Block_Type_Registry::get_instance()->is_registered( $block ) ) {
			unregister_block_type( $block );
		}
	}
);

// Remove admin bar menu search box.
add_action(
	'admin_bar_menu',
	function ( $wp_admin_bar ) {
		$wp_admin_bar->remove_menu( 'search' );
	},
	11
);


// Remove login error 
add_filter(
	'login_errors',
	function ( $error ) {
		// Edit the line below to customize the message.
		return 'Something is wrong!';
	}
);
