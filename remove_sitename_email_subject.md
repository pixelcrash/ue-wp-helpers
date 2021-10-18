## Remove the Sitename from email subject


´´´php
add_filter('wp_mail', 'email_subject_remove_sitename');
function email_subject_remove_sitename($email) {
  $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
  $email['subject'] = str_replace("[".$blogname."] - ", "", $email['subject']);    
  $email['subject'] = str_replace("[".$blogname."]", "", $email['subject']);
  return $email;
}
'''


found via https://newbedev.com/wp-mail-remove-sitename-from-email-subject
