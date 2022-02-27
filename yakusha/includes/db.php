<?php
/***************************************************************************
* db.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

switch($dbms)
{
	case 'mysql':
		include($phpbb_root_path . 'db/mysql.'.$phpEx);
		break;

	case 'mysql4':
		include($phpbb_root_path . 'db/mysql4.'.$phpEx);
		break;
}

// Make the database connection.
$db = new sql_db($dbhost, $dbuser, $dbpasswd, $dbname, false);
if(!$db->db_connect_id)
{
	//message_die(CRITICAL_ERROR, "Could not connect to the database");
	@include($phpbb_root_path . 'error.html');
	exit;
}

?>