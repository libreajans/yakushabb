<?php
/***************************************************************************
 * page_tail.php
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

global $do_gzip_compress;

// Show the overall footer.
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="admin/index.' . $phpEx . '?sid=' . $userdata['session_id'] . '">' . $lang['Admin_panel'] . '</a><br /><br />' : '';

// CrackerTracker v5.x
$output_login_status = ($userdata['ct_enable_ip_warn'])? $lang['ctracker_ma_on'] : $lang['ctracker_ma_off'];
// CrackerTracker v5.x

//if( ($userdata['session_logged_in']) and ($userdata['user_level'] == ADMIN) )
{
	$excuted_queries = $db->num_queries;

	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$gentime = round(($endtime - $starttime), 4);
	$sql_time = round($db->sql_time, 4);
	$sql_part = round($sql_time / $gentime * 100);
	$php_part = 100 - $sql_part;
	$page_generation = 'Page Generation: '. $gentime .' (PHP: '. $php_part .' % '.$sql_part.' :SQL) - SQL queries: '. $excuted_queries;
}

$template->set_filenames(array('overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl'));

$template->assign_vars(array(
	'TRANSLATION_INFO' => ( isset($lang['TRANSLATION_INFO']) ) ? $lang['TRANSLATION_INFO'] : '',
	'L_STATUS_LOGIN' => ($ctracker_config->settings['login_ip_check'])? sprintf($lang['ctracker_ipwarn_info'], $output_login_status) : '',
	'PAGE_GENERATION' => $page_generation,
	'ADMIN_LINK' => $admin_link)
);

$template->pparse('overall_footer');

// Close our DB connection.
$db->sql_close();

// Compress buffered output if required and send to browser
if ( $do_gzip_compress )
{
	// Borrowed from php.net!
	$gzip_contents = ob_get_contents();
	ob_end_clean();

	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);

	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack('V', $gzip_crc);
	echo pack('V', $gzip_size);
}

exit;

?>