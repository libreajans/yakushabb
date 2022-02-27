<?php
/***************************************************************************
 * admin_stat.php
 ***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Statistic'] = $filename;

	return;
}
$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);


//-------------------------- fonksiyonlar --------------------------
function check_mysql_version()
{
	global $db;

	$sql = 'SELECT VERSION() AS mysql_version';
	$result = $db->sql_query($sql);
	if( !$result )
	{
		message_die(GENERAL_ERROR, "Could not obtain MySQL Version", "", __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$version = $row['mysql_version'];

	if ( preg_match("/^3\.23\.([0-9]$|[0-9]-|1[0-3]$|1[0-6]-)/", $version) ) // Version from 3.23.0 to 3.23.16
	{
		return FALSE;
	}
	elseif ( preg_match("/^(3\.23)|(4\.)|(5\.)/", $version) )
	{
		return TRUE;
	}
	else // Versions before 3.23.0
	{
		return FALSE;
	}
}

// Gets table statistics
function get_table_statistic()
{
	global $db, $table_prefix;
	global $tables;

	$stat['all']['count'] = 0;
	$stat['all']['records'] = 0;
	$stat['all']['size'] = 0;

	$sql = 'SHOW TABLE STATUS';
	$result = $db->sql_query($sql);
	if( !$result )
	{
		message_die(GENERAL_ERROR, "Could not obtain table data", "", __LINE__, __FILE__, $sql);
	}
	while( $row = $db->sql_fetchrow($result) )
	{
		$stat['all']['count']++;
		$stat['all']['records'] += intval($row['Rows']);
		$stat['all']['size'] += intval($row['Data_length']) + intval($row['Index_length']);
	}
	$db->sql_freeresult($result);
	return $stat;
}

//-------------------------- MOD: View complete Avatar Directory Size MOD --------------------------
$folders = '';
function traverse($dir)
{
	global $folders;
	$dh=opendir($dir);
	while ($file=readdir($dh))
	{
		if($file!=="." && $file!="..")
		{
			$fullpath=$dir."/".$file;
			$avatar_dir_size += @filesize($dir."/".$file);
			if(is_dir($fullpath))
			{
				$current_entry = (empty($folders[0])) ? 0 : count($folders);
				$folders[$current_entry] = $fullpath;
				traverse($fullpath);
			}
		}
		else continue;
	}
	closedir($dh);
}
//-------------------------- End MOD: View complete Avatar Directory Size MOD --------------------------

$template->set_filenames(array("body" => "admin/index_stat.tpl"));

if (check_mysql_version())
{
	$stat = get_table_statistic();
	$template-> assign_vars(array(
		'NUMBER_OF_DB_TABLES' => $stat['all']['count'],
		'NUMBER_OF_DB_RECORDS' => $stat['all']['records'])
	);
}

$template->assign_vars(array(
	'L_WELCOME' => $lang['Welcome_phpBB'],
	'L_ADMIN_INTRO' => $lang['Admin_intro'],
	'L_FORUM_STATS' => $lang['Forum_stats'],
	'L_STATISTIC' => $lang['Statistic'],
	'L_VALUE' => $lang['Value'],
	'L_PHPBB_VERSION' => $lang['phpBB_version'],
	'L_YAK_VERSION' => $lang['yakusha_version'],
	'L_NUMBER_POSTS' => $lang['Number_posts'],
	'L_POSTS_PER_DAY' => $lang['Posts_per_day'],
	'L_NUMBER_TOPICS' => $lang['Number_topics'],
	'L_TOPICS_PER_DAY' => $lang['Topics_per_day'],
	'L_NUMBER_USERS' => $lang['Number_users'],
	'L_USERS_PER_DAY' => $lang['Users_per_day'],
	'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
	'L_SIZE_POSTS_TABLES' => $lang['Size_posts_tables'],
	'L_SIZE_SEARCH_TABLES' => $lang['Size_search_tables'],
	'L_BOARD_STARTED' => $lang['Board_started'],
	'L_AVATAR_DIR_SIZE' => $lang['Avatar_dir_size'],
	'L_DB_SIZE' => $lang['Database_size'],
	'L_FORUM_LOCATION' => $lang['Forum_Location'],
	'L_STARTED' => $lang['Login'],
	'L_GZIP_COMPRESSION' => $lang['Gzip_compression'])
);

// Get forum statistics
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$total_topics = get_db_stat('topiccount');
$newest_userdata = get_db_stat('newestuser');
$wached_total = get_db_stat('wached_total');
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];

$start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

$boarddays = ( time() - $board_config['board_startdate'] ) / 86400;
$posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
$topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
$users_per_day = sprintf("%.2f", $total_users / $boarddays);
$posts_per_user = sprintf("%.2f", $total_posts / $total_users);

$avatar_dir_size = 0;

traverse($phpbb_root_path . "images/avatars");
for($i = 0; $i < count($folders); $i++)
{
	$dir = opendir($folders[$i]);
	while( $file = readdir($dir) )
	{
		if( $file != "." && $file != ".." )
		{
			$avatar_dir_size += filesize($folders[$i] . "/" . $file);
		}
	}
}
$avatar_dir_size = sprintf("%.3f MB", ( $avatar_dir_size / 1048576 ));

if($posts_per_day > $total_posts)
{
	$posts_per_day = $total_posts;
}

if($topics_per_day > $total_topics)
{
	$topics_per_day = $total_topics;
}

if($users_per_day > $total_users)
{
	$users_per_day = $total_users;
}

// DB size ... MySQL only
// This code is heavily influenced by a similar routine
// in phpMyAdmin 2.2.0
if( preg_match("/^mysql/", SQL_LAYER) )
{
	$sql = "SELECT VERSION() AS mysql_version";
	if($result = $db->sql_query($sql))
	{
		$row = $db->sql_fetchrow($result);
		$version = $row['mysql_version'];

		if( preg_match("/^(3\.23|4\.|5\.)/", $version) )
		{
			$db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)|(5\.)/", $version) ) ? "`$dbname`" : $dbname;

			$sql = "SHOW TABLE STATUS FROM " . $db_name;
			if($result = $db->sql_query($sql))
			{
				$tabledata_ary = $db->sql_fetchrowset($result);

				$dbsize = 0;
				$size_posts_tables  = 0;
				$size_search_tables = 0;

				for($i = 0; $i < count($tabledata_ary); $i++)
				{
					if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
					{
						if( $table_prefix != "" )
						{
							if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
							{
								$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}
							if( $tabledata_ary[$i]['Name'] == POSTS_TABLE || $tabledata_ary[$i]['Name'] == POSTS_TEXT_TABLE)
							{
								$size_posts_tables += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}
							if( $tabledata_ary[$i]['Name'] == SEARCH_WORD_TABLE || $tabledata_ary[$i]['Name'] == SEARCH_MATCH_TABLE)
							{
								$size_search_tables += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}
						}
						else
						{
							$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
						}
					}
				}
			} // Else we Could not get the table status.
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else
	{
		$dbsize = $lang['Not_available'];
	}
}
else
{
	$dbsize = $lang['Not_available'];
}

// Stats & info
$dbsize = sprintf("%.3f MB", ( $dbsize / 1048576 ));
$size_posts_tables = sprintf("%.3f MB", ( $size_posts_tables / 1048576 ));
$size_search_tables = sprintf("%.3f MB", ( $size_search_tables / 1048576 ));
// Stats & info

// ekleme istatistikler

//---[+]---banlý üyelerle ilgili olanlar

// toplam sayýsý alýnýyor
$sql = "SELECT COUNT(ban_userid) AS total
	FROM " . BANLIST_TABLE . "
	WHERE ban_userid > 0 ";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not ban statistic data", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_banned_users = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not update pending information!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);

//-----banlý üye varsa isimleri
if ($total_banned_users > 0)
{
	$banned_names = '';
	$sql = "SELECT b.ban_id, b.ban_userid, u.user_id, u.username
		FROM " . BANLIST_TABLE . " b, " . USERS_TABLE . " u
			WHERE b.ban_userid = u.user_id
		ORDER BY u.username";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$banned_names .= (($banned_names == '') ? '' : ', ') . "<a href=". append_sid("admin_user_bantron.".$phpEx) .">". htmlspecialchars($row['username'])."</a>";
		//$banned_names .= (($banned_names == '') ? '' : ', ') . "<a href=". append_sid("admin_user_bantron.php?mode=edit&amp;ban_id=".$row['ban_id']) .">". htmlspecialchars($row['username'])."</a>";
		//$banned_names .= (($banned_names == '') ? '' : ', ') . "<a href=". append_sid("admin_users.php?mode=edit&amp;u=".$row['user_id']) .">". htmlspecialchars($row['username'])."</a>";
	}
	$db->sql_freeresult($result);
}
//---[-]---banlý üyelerle ilgili olanlar

//---[+]---pasif üyelerle ilgili olanlar


// kategori sayýsý
$sql = "SELECT COUNT(cat_id) AS total FROM " . CATEGORIES_TABLE;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_cat = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);
//$total_cat

//forum sayýsý
$sql = "SELECT COUNT(forum_id) AS total FROM " . FORUMS_TABLE;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_forum = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);
//$total_forum

//sup forum sayýsý
$sql = "SELECT COUNT(forum_id) AS total FROM " . FORUMS_TABLE . "
WHERE  forum_parent = 0 ";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_supforum = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);
//$total_supforum

//sub forum sayýsý
$sql = "SELECT COUNT(forum_id) AS total FROM " . FORUMS_TABLE . "
WHERE  forum_parent > 0 ";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_subforum = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);
//$total_subforum

//pm sayýsý
$sql = "SELECT COUNT(privmsgs_id) AS total FROM " . PRIVMSGS_TABLE;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_pm = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);
//$total_pm

//anket sayýsý
$sql = "SELECT COUNT(vote_id) AS total FROM " . VOTE_DESC_TABLE;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_vote = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);
//$total_vote

// toplam pasif üye sayýsý alýnýyor
$sql = "SELECT COUNT(user_id) AS total
	FROM " . USERS_TABLE . "
	WHERE user_active = 0 AND user_id <> " . ANONYMOUS;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_deactivated_users = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);

if ($total_deactivated_users > 0)
{
	$pasif_names = '';
	$sql = "SELECT username,user_id
		FROM " . USERS_TABLE . "
		WHERE user_active = 0 AND user_id <> " . ANONYMOUS ."
		ORDER BY user_regdate ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$pasif_names .= (($pasif_names == '') ? '' : ', ') . "<a href=". append_sid("admin_users.php?mode=edit&amp;u=".$row['user_id']) .">". htmlspecialchars($row['username'])."</a>";
	}
	$db->sql_freeresult($result);
}
//---[-]---pasif üyelerle ilgili olanlar

//---[+]---bölüm yetkilileriyle ilgili olanlar
$sql = "SELECT COUNT(user_id) AS total
	FROM " . USERS_TABLE . "
	WHERE user_level = " . MOD . " AND user_id <> " . ANONYMOUS;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_moderators = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);

// bölüm yetkilisi listesi alýnýyor
if ($total_moderators > 0)
{
	$moderators_list = '';
	$sql = "SELECT username,user_id
		FROM " . USERS_TABLE . "
		WHERE user_level = " . MOD . " AND user_id <> " . ANONYMOUS ."
		ORDER BY user_regdate ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$moderators_list .= (($moderators_list == '') ? '' : ', ') . "<a href=". append_sid("admin_ug_auth.php?mode=user&amp;u=".$row['user_id']) .">". htmlspecialchars($row['username'])."</a>";
	}
	$db->sql_freeresult($result);
}
//---[-]---bölüm yetkilileriyle ilgili olanlar

//---[+]---forum yöneticileriyle ilgili olanlar

$sql = "SELECT COUNT(user_id) AS total
	FROM " . USERS_TABLE . "
	WHERE user_level = " . ADMIN . "
	AND user_id <> " . ANONYMOUS;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_administrators = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);

if ($total_administrators > 0)
{
	$administrator_list = '';
	$sql = "SELECT user_id, username
		FROM " . USERS_TABLE . "
		WHERE user_level = " . ADMIN . "
		AND user_id <> " . ANONYMOUS . "
		ORDER BY username";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$administrator_list .= (($administrator_list == '') ? '' : ', ') . "<a href=". append_sid("admin_ug_auth.php?mode=user&amp;u=".$row['user_id']) .">". htmlspecialchars($row['username'])."</a>";
	}
	$db->sql_freeresult($result);
}
//---[+]---forum yöneticileriyle ilgili olanlar

//---[+]---son üç günün üyeleri
$gunun_tarihi = time()- 260000;
$sql = "SELECT COUNT(user_id) AS total
	FROM " . USERS_TABLE . "
	WHERE user_regdate > $gunun_tarihi
	AND user_id <> " . ANONYMOUS;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$total_reg_son3day = $row['total'];
}
else
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$db->sql_freeresult($result);

if ($total_reg_son3day > 0)
{
	$son3day_list = '';
	$sql = "SELECT user_id, username
		FROM " . USERS_TABLE . "
		WHERE user_regdate > $gunun_tarihi
		AND user_id <> " . ANONYMOUS . "
		ORDER BY user_regdate DESC ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$son3day_list .= (($son3day_list == '') ? '' : ', ') . "<a href=". append_sid("admin_users.php?mode=edit&amp;u=".$row['user_id']) .">". htmlspecialchars($row['username'])."</a>";
	}
	$db->sql_freeresult($result);
}
//---[-]---son üç günün üyeleri

//---[+]---MYSQL VERSÝYON
// Version information
$sql = "SELECT VERSION() AS mysql_version";
$result = $db->sql_query($sql);
if ( !$result )
{
	message_die(GENERAL_ERROR, "Could not get statistic data!", "", __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$mysql_version = $row['mysql_version'];
$db->sql_freeresult($result);
//---[-]---MYSQL VERSÝYON

$template->assign_vars(array(
	'TOTAL_CAT' => $total_cat,
	'TOTAL_FORUM' => $total_forum,
	'TOTAL_SUPFORUM' => $total_supforum,
	'TOTAL_SUBFORUM' => $total_subforum,
	'TOTAL_PM' => $total_pm,
	'TOTAL_VOTE' => $total_vote,

	'L_TOTAL_CAT' => $lang['total_cat'],
	'L_TOTAL_FORUM' => $lang['total_forum'],
	'L_TOTAL_SUPFORUM' => $lang['total_supforum'],
	'L_TOTAL_SUBFORUM' => $lang['total_subforum'],
	'L_TOTAL_PM' => $lang['total_pm'],
	'L_TOTAL_VOTE' => $lang['total_vote'],

	'NUMBER_OF_MODERATORS' => $total_moderators,

	'NUMBER_OF_BANNED_USERS' => $total_banned_users,
	'BANNED_USERS_LIST' => $banned_names,

	'NUMBER_OF_DEACTIVATED_USERS' => $total_deactivated_users,
	'DEACTIVATED_USERS_LIST' => $pasif_names,

	'NUMBER_OF_MODERATORS' => $total_moderators,
	'MODERATORS_LIST' => $moderators_list,

	'NUMBER_OF_ADMINISTRATORS' => $total_administrators,
	'ADMINISTRATORS_LIST' => $administrator_list,

	'NUMBER_OF_SON3DAY' =>$total_reg_son3day,
	'SON3DAY_LIST' =>$son3day_list,

	'U_NEW_USER' => '<a href="' . append_sid("admin_users.php?mode=edit&amp;u=".$newest_uid) . '">'.$newest_user.'</a>',

	'U_PHP_VERSION' => phpversion(),
	'L_PHP_VERSION' => $lang['php_version'],
	'U_MYSQL_VERSION' => $mysql_version,
	'L_MYSQL_VERSION' => $lang['mysql_version'],
	'L_WACHED_TOTAL' => $lang['Wached_total'],
	'L_POST_PER_USER' => $lang['post_per_user'],
	'L_NUMBER_OF_DB_TABLES' => $lang['number_of_db_tables'],
	'L_NUMBER_OF_DB_RECORDS' => $lang['number_of_db_records'],
	'L_NEW_USER' => $lang['new_user'],
	'L_NUMBER_OF_SON3DAY' => $lang['son3day_list'],
	'L_ADMINISTRATORS_LIST' => $lang['administrators_list'],
	'L_JR_ADMIN_LIST' => $lang['jr_admin_list'],
	'L_MODERATORS_LIST' => $lang['moderators_list'],
	'L_DEACTIVATED_USERS_LIST' => $lang['deactivated_users_list'],
	'L_BANNED_USERS_LIST' => $lang['banned_users_list'],


	'NUMBER_OF_POSTS' => $total_posts,
	'NUMBER_OF_TOPICS' => $total_topics,
	'NUMBER_OF_USERS' => $total_users,
	'NUMBER_OF_WACHED_TOTAL' => $wached_total,

	'SIZE_POSTS_TABLES' => $size_posts_tables,
	'SIZE_SEARCH_TABLES' => $size_search_tables,
	'START_DATE' => $start_date,
	'POSTS_PER_DAY' => $posts_per_day,
	'TOPICS_PER_DAY' => $topics_per_day,
	'USERS_PER_DAY' => $users_per_day,
	'POST_PER_USER' => $posts_per_user,

	'AVATAR_DIR_SIZE' => $avatar_dir_size,
	'DB_SIZE' => $dbsize,
	'YAK_VERSION' => $board_config['yakusha_ver'],
	'PHPBB_VERSION' => '2' . $board_config['version'],
	'GZIP_COMPRESSION' => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'])
);
//
// End forum statistics
//

// Check for new version
$current_version = explode('.', '2' . $board_config['version']);
$minor_revision = (int) $current_version[2];

$errno = 0;
$errstr = $version_info = '';

// Version cache mod start
// Change following two variables if you need to:
$cache_update = 86400; // 24 hours cache timeout. change it to whatever you want
$cache_file = '../cache/phpbb_update_' . $board_config['default_lang'] . $board_config['version'] . '.php'; // file where to store cache

$do_update = true;
if(@file_exists($cache_file))
{
	$last_update = 0;
	$version_info = '';
	@include($cache_file);
	if($last_update && !empty($version_info) && $last_update > (time() - $cache_update))
	{
		$do_update = false;
	}
	else
	{
		$version_info = '';
	}
}

if($do_update)
{
	// Version cache mod end

	if ($fsock = @fsockopen('www.phpbb.com', 80, $errno, $errstr, 10))
	{
		@fputs($fsock, "GET /updatecheck/20x.txt HTTP/1.1\r\n");
		@fputs($fsock, "HOST: www.phpbb.com\r\n");
		@fputs($fsock, "Connection: close\r\n\r\n");

		$get_info = false;
		while (!@feof($fsock))
		{
			if ($get_info)
			{
				$version_info .= @fread($fsock, 1024);
			}
			else
			{
				if (@fgets($fsock, 1024) == "\r\n")
				{
					$get_info = true;
				}
			}
		}
		@fclose($fsock);

		$version_info = explode("\n", $version_info);
		$latest_head_revision = (int) $version_info[0];
		$latest_minor_revision = (int) $version_info[2];
		$latest_version = (int) $version_info[0] . '.' . (int) $version_info[1] . '.' . (int) $version_info[2];

		if ($latest_head_revision == 2 && $minor_revision == $latest_minor_revision)
		{
			$version_info = '<p style="color:green">' . $lang['Version_up_to_date'] . '</p>';
		}
		else
		{
			$version_info = '<p style="color:red">' . $lang['Version_not_up_to_date'];
			$version_info .= '<br />' . sprintf($lang['Latest_version_info'], $latest_version) . ' ' . sprintf($lang['Current_version_info'], '2' . $board_config['version']) . '</p>';
		}
	}
	else
	{
		if ($errstr)
		{
			$version_info = '<p style="color:red">' . sprintf($lang['Connect_socket_error'], $errstr) . '</p>';
		}
		else
		{
			$version_info = '<p>' . $lang['Socket_functions_disabled'] . '</p>';
		}
	}

	$version_info .= '<p>' . $lang['Mailing_list_subscribe_reminder'] . '</p>';
	// Version cache mod start
	if(@$f = fopen($cache_file, 'w'))
	{
		$search = array('\\', '\'');
		$replace = array('\\\\', '\\\'');
		fwrite($f, '<' . '?php $last_update = ' . time() . '; $version_info = \'' . str_replace($search, $replace, $version_info) . '\'; ?' . '>');
		fclose($f);
		@chmod($cache_file, 0777);
	}
}
// Version cache mod end


$template->assign_vars(array(
	'VERSION_INFO' => $version_info,
	'L_VERSION_INFORMATION' => $lang['Version_information'])
);

$template->pparse("body");
include('./page_footer_admin.'.$phpEx);

?>