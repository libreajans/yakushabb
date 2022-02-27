<?php
/***************************************************************************
*	googlesitemap.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_GSM);
init_userprefs($userdata);

// Compresss the sitemap with gzip
// this isn't as pretty as the code in page_header.php, but it's simple & it works :)
if(function_exists(ob_gzhandler) && $board_config['gzip_compress'] == 1)
{
	ob_start(ob_gzhandler);
}

// Begin Configuration Section
$included_forum_ids = array();
//$excluded_forum_ids = array(49);
// End Configuration Section


if ( count($included_forum_ids) > 0 )
{
	$included_forum_ids_sql = 'forum_id IN (' . implode(', ', $included_forum_ids) . ')';
}

if ( count($excluded_forum_ids) > 0 )
{
	$excluded_forum_ids_sql = 'forum_id NOT IN (' . implode(', ', $excluded_forum_ids) . ')';
}

if ( ( count($included_forum_ids) > 0 ) && ( count($excluded_forum_ids) > 0 ) )
{
	$and = 'AND';
}

if ( ( count($included_forum_ids) > 0 ) || ( count($excluded_forum_ids) > 0 ) )
{
	$where = 'WHERE';
}

$sql = "SELECT topic_id, forum_id, topic_title, topic_time, topic_type FROM " . TOPICS_TABLE . " $where $included_forum_ids_sql $and $excluded_forum_ids_sql ORDER BY topic_time DESC";

if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Error: could not retrive topic IDs', '', __LINE__, __FILE__, $sql);
}

$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
$server_url = $server_protocol . $server_name . $server_port . $script_name."viewtopic.php?";

$output = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' . "\n";
$output .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

while ( $row = $db->sql_fetchrow($result) )
{
	$topic_id = $row['topic_id'];
	$topic_title = $row['topic_title'];
	$lastmodified = date('Y-m-d\Th:i+10:08', $row['topic_time']);
	$viewtopic = ($board_config['basit_seo_open']) ? $server_url . "t=" . $row['topic_id'] . "-" . format_url($row['topic_title']) : $server_url . "t=" . $row['topic_id'];
	$priority = ( $row['topic_type'] == POST_STICKY || $row['topic_type'] == POST_ANNOUNCE ) ? '1.0' : '0.5';
	
	$output .= "<url>\n";
	$output .= "\t<loc>$protocol$servername$port$path$viewtopic"	. "</loc>\n";
	$output .= "\t<lastmod>$lastmodified</lastmod>\n";
	$output .= "\t<changefreq>daily</changefreq>\n";
	$output .= "\t<priority>$priority</priority>\n";
	$output .= "</url>\n\n";
}
$output .= "</urlset>\n";

header('Content-type: application/xml');
echo $output;
?>