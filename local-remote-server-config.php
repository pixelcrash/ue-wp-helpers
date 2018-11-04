/*
 * Check for the current environment
 */
if ($_SERVER["HTTP_HOST"] === 'server01.at') {
  $db_name = '';
  $password = '';
	$user_name = '';
	$hostname = '';
	define('WP_HOME','server01.at');
	define('WP_SITEURL','server01.at');

} else if ($_SERVER["HTTP_HOST"] === 'localhost:8888') {
  $db_name = '';
  $password = 'root';
	$user_name = 'root';
	$hostname = '127.0.0.1:8889';
	define('WP_HOME','http://localhost:8888/');
	define('WP_SITEURL','http://localhost:8888/');
  
	
} else if ($_SERVER["HTTP_HOST"] === 'server02.at') {
  $db_name = '';
  $password = '';
	$user_name = '';
	$hostname = '';
	define('WP_HOME','server02.at');
	define('WP_SITEURL','server02.at');
  
	
}
