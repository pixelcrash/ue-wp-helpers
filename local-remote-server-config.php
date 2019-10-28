/*
 * Check for the current environment
 */
if ($_SERVER["HTTP_HOST"] === 'DOMAIN.COM') {
 	$db_name = 'XXX';
  	$password = 'XXX';
	$username = 'XXX';
	$hostname = 'localhost';
	define('WP_HOME','https://DOMAIN.COM');
	define('WP_SITEURL','https://DOMAIN.COM');

} elseif($_SERVER["HTTP_HOST"] === 'localhost:8888') {
  	$db_name = 'XXX';
  	$password = 'root';
	$username = 'root';
	$hostname = 'localhost';
	define('WP_HOME','http://localhost:8888/project');
	define('WP_SITEURL','http://localhost:8888/project');

} 

define('DB_NAME', $db_name);
define('DB_USER', $username);
define('DB_PASSWORD', $password);
define('DB_HOST', $hostname);

// ADD FTP UPLOAD INFO
define('FS_METHOD', 'ftpext');
define('FTP_BASE', '/var/www/vhosts/chriscoyier.net/httpdocs/');
define('FTP_USER', 'username');
define('FTP_PASS', 'password');
define('FTP_HOST', 'host');
define('FTP_SSL', false);
