<?php
/***************************************************************************
 * function_separate.php
 ***************************************************************************/
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// Select topic to be suggested
function get_dividers($topics)
{
	global $lang;

	$dividers = array();
	$total_topics = count($topics);
	$total_by_type = array (POST_GLOBAL_ANNOUNCE => 0, POST_ANNOUNCE => 0, POST_STICKY => 0, POST_NORMAL => 0);

	for ( $i=0; $i < $total_topics; $i++ )
	{
		$total_by_type[$topics[$i]['topic_type']]++;			
	}

	if ( ( $total_by_type[POST_GLOBAL_ANNOUNCE] + $total_by_type[POST_ANNOUNCE] + $total_by_type[POST_STICKY] ) != 0 )
	{
		$count_topics = 0;
		
		$dividers[$count_topics] = $lang['Global_Announcements'];
		$count_topics += $total_by_type[POST_GLOBAL_ANNOUNCE];

		$dividers[$count_topics] = $lang['Announcements'];
		$count_topics += $total_by_type[POST_ANNOUNCE];

		$dividers[$count_topics] = $lang['Sticky_Topics'];
		$count_topics += $total_by_type[POST_STICKY];

		if ( $count_topics < $total_topics )
		{
			$dividers[$count_topics] = $lang['Topics'];
		}
	}

	return $dividers;
}

?>