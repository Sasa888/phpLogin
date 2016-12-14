<?php 

	DEFINE('DB_USER', 'root');
	DEFINE('DB_PASSWORD', '');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'sasaphp');



	$dbc = @mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME ) OR die ('Could not connect to MYSQL: ' . mysqli_connect_error() );

	/*mysqli_set_charset('utf-8');*/

 ?>