$the_query = new WP_Query( array( 'post_type' => 'acf-field-group') );

		// The Group Loop
		if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
		  $group_ID = get_the_ID();
		  $name = get_the_title();

		  echo '<p>Group ID: '.$group_ID.', Group name: '.$name.'</p>';

		  $fields = array();
		  $fields = apply_filters('acf/field_group/get_fields', $fields, $group_ID);
		  
		  if( $fields )
		  {
			  foreach( $fields as $field )
			  {
				  $value = get_field( $field['name'] );
				  
				  echo '<dl>';
					  echo '<dt>' . $field['label'] . '</dt>';
					  echo '<dd>' .$value . '</dd>';
				  echo '</dl>';
			  }
		  } 

		endwhile;
		endif;
		
		// Reset Post Data
		wp_reset_postdata();
