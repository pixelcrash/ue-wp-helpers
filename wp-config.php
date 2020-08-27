 if ($_SERVER["HTTP_HOST"] === '') {
  $db_name = 'xxx';
  $password = 'xxx';
	$user_name = 'xxx';
	$hostname = 'xxx';
	define('WP_HOME','https://xxx');
	define('WP_SITEURL','https://xxx');

} else if ($_SERVER["HTTP_HOST"] === 'localhost:8888') {
  $db_name = '';
  $password = '';
	$user_name = '';
	$hostname = '';
	define('WP_HOME','http://localhost:8888/xxx');
	define('WP_SITEURL','http://localhost:8888/xxx');
	define('MAIN', 'http://localhost:8888/xxx/wp-content/');
}
