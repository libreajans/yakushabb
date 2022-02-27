<?php
/***************************************************************************
* anket.php
***************************************************************************/
//izin kontrolleri için tarama geliþtirilmeli

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_POLL_OVERVIEW);
init_userprefs($userdata);
// End session management

//---[+]--- Logged In control on acp --------
if ( !$userdata['session_logged_in'])
{
	redirect(append_sid("login.$phpEx?anket.$phpEx", true));
}
//---[-]--- Logged In control on acp --------

// Output page header
$page_title = $lang['poll_overview'];
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("anket.php").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array('body' => 'poll.tpl'));

$sql = "SELECT topic_title, topic_id
	FROM " . TOPICS_TABLE . "
	WHERE topic_vote <> ''
	ORDER BY topic_time";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query post with polls', '', __LINE__, __FILE__, $sql);
}

$total_post_polls = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$post_poll_rowset[] = $row;
	$total_post_polls++;
} // while

for($j = 0; $j < $total_post_polls; $j++)
{
	$sql = "SELECT vd.vote_id,
		vd.vote_text,
		vd.vote_start,
		vd.vote_length,
		vr.vote_option_id,
		vr.vote_option_text,
		vr.vote_result
		FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
		WHERE vd.topic_id = " . $post_poll_rowset[$j]['topic_id'] . "
		AND vr.vote_id = vd.vote_id
		ORDER BY vr.vote_option_id ASC";
	
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain vote data for this topic", '', __LINE__, __FILE__, $sql);
	}
	
	if ( $vote_info = $db->sql_fetchrowset($result) )
	{
		$db->sql_freeresult($result);
		$vote_options = count($vote_info);
		$vote_id = $vote_info[0]['vote_id'];
		$vote_title = $vote_info[0]['vote_text'];
		
		
		$view_result = 0;
		$vote_results_sum = 0;
		
		for($i = 0; $i < $vote_options; $i++)
		{
			$vote_results_sum += $vote_info[$i]['vote_result'];
		}
		
		$vote_graphic = 0;
		$vote_graphic_max = count($images['voting_graphic']);
		$u_topic = "viewtopic.php?t=" . $post_poll_rowset[$j]['topic_id'];
		
		$template->assign_block_vars('post_poll',array(
			'POLL_QUESTION' => $vote_title,
			'L_TOTAL_VOTES' => $lang['Total_votes'],
			'TOTAL_VOTES' => $vote_results_sum,
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'TOPIC_TITLE' => $post_poll_rowset[$j]['topic_title'],
			'U_TOPIC'=> append_sid($u_topic) ));

		for($i = 0; $i < $vote_options; $i++)
		{
			$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
			$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);
			
			$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
			$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;
			
			if ( count($orig_word) )
			{
				$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
			}

			$template->assign_block_vars("post_poll.poll_option", array(
				'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
				'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
				'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),
	
				'POLL_OPTION_IMG' => $vote_graphic_img,
				'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length));
		}//end for
	} // end if
}//end for

$template->assign_vars(array(
'L_OVERVIEW' => $lang['poll_overview']));

$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>