<?php get_header(); ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    // DOING THE LOOP

    <?php  if ( !post_password_required() ): ?>
      // PUT EVERYTHING PROTECTED IN HERE

    <?php else:
    
      // SHOW THE CONTENT, IT WILL BE REPLACED WITH THE PASSWORD FORM
      the_content();

    endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>	
<?php get_footer(); ?>


// Functions.php for the form 

function my_password_form() {
global $post;
  
$o = <<<HTML
<section class="uk-section">
  <div class="uk-container">
    <div class="uk-grid">
      <div class="uk-width-1-1">
HTML;
    
$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
$o = $o . '
  <form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="uk-form">
    <fieldset class="uk-fieldset">
      <legend class="uk-legend uk-margin">Password protected area</legend>
      <label for="' . $label . '">Please enter your provided pass</label>
      <input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="uk-input  uk-margin"/>
      <input type="submit" class="uk-button uk-button-default  uk-margin" name="Submit" value="Enter" />
    </fieldset>
  </form>';
    
$o = $o . <<<HTML
</div>
  </div>
  </div>
  </section>
HTML;
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

function the_title_trim($title)
  {
    $pattern[0] = '/Protected:/';
    $pattern[1] = '/Private:/';
    $replacement[0] = ''; // Enter some text to put in place of Protected:
    $replacement[1] = ''; // Enter some text to put in place of Private:

    return preg_replace($pattern, $replacement, $title);
  }
  add_filter('the_title', 'the_title_trim')
