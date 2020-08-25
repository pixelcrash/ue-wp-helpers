add_action('wp_head', 'show_template');

function show_template() {
  global $template;
  global $current_user;
  get_currentuserinfo();
  if ($current_user->user_level == 10 ) print_r($template);
}
