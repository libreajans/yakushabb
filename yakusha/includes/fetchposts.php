<?php
/***************************************************************************
* fetchposts.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

error_reporting(E_ERROR | E_WARNING | E_PARSE);
set_magic_quotes_runtime(0);

include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

function phpbb_fetch_posts($forum_sql, $number_of_posts, $text_length)
{
	global $db, $board_config;

	$sql = 'SELECT t.*, pt.*, u.username, u.user_id, p.post_id, p.enable_smilies
		FROM  (
			' . TOPICS_TABLE . ' AS t, ' . USERS_TABLE . ' AS u, ' . POSTS_TEXT_TABLE . ' AS pt, ' . POSTS_TABLE . ' AS p
		) WHERE (
			t.forum_id IN (' . $forum_sql . ') AND
			t.topic_time <= ' . time() . ' AND
			t.topic_poster = u.user_id AND
			t.topic_first_post_id = pt.post_id AND
			t.topic_first_post_id = p.post_id )
		ORDER BY
		t.topic_time DESC';
	if ($number_of_posts != 0)
	{
		$sql .= '
		LIMIT
		0,' . $number_of_posts;
	}

	// query the database
	if(!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not query announcements information', '', __LINE__, __FILE__, $sql);
	}

	// fetch all postings
	$posts = array();
	if ($row = $db->sql_fetchrow($result))
	{
		$i = 0;
		do
		{
			$posts[$i]['bbcode_uid'] = $row['bbcode_uid'];
			$posts[$i]['enable_smilies'] = $row['enable_smilies'];
			$posts[$i]['post_text'] = $row['post_text'];
			$posts[$i]['topic_id'] = $row['topic_id'];
			$posts[$i]['topic_replies'] = $row['topic_replies'];
			$posts[$i]['topic_time'] = create_date($board_config['default_dateformat'], $row['topic_time'], $board_config['board_timezone']);
			$posts[$i]['topic_title'] = $row['topic_title'];
			$posts[$i]['user_id'] = $row['user_id'];
			$posts[$i]['username'] = $row['username'];
	
			//
			// do a little magic
			// note: part of this comes from mds' news script and some additional magics from Smartor
			//
			stripslashes($posts[$i]['post_text']);
			if (($text_length == 0) or (strlen($posts[$i]['post_text']) <= $text_length))
			{
				$posts[$i]['post_text'] = bbencode_second_pass($posts[$i]['post_text'], $posts[$i]['bbcode_uid']);
				$posts[$i]['striped'] = 0;
			}
			else // strip text for news
			{
				$posts[$i]['post_text'] = bbencode_second_pass($posts[$i]['post_text'], $posts[$i]['bbcode_uid']);
				$posts[$i]['post_text'] = substr($posts[$i]['post_text'], 0, $text_length) . '...';
				$posts[$i]['striped'] = 1;
			}
	
			// Smilies
			if ($posts[$i]['enable_smilies'] == 1)
			{
				$posts[$i]['post_text'] = smilies_pass($posts[$i]['post_text']);
			}
			$posts[$i]['post_text'] = make_clickable($posts[$i]['post_text']);
	
			// define censored word matches
			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replacement_word);
	
			// censor text and title
			if (count($orig_word))
			{
				$posts[$i]['topic_title'] = preg_replace($orig_word, $replacement_word, $posts[$i]['topic_title']);
				$posts[$i]['post_text'] = preg_replace($orig_word, $replacement_word,	$posts[$i]['post_text']);
			}
			$posts[$i]['post_text'] = nl2br($posts[$i]['post_text']);
			$i++;
			}
		while ($row = $db->sql_fetchrow($result));
	}
	return $posts;
}

function phpbb_fetch_poll($forum_sql)
{
	global $db;

	$sql = 'SELECT t.*, vd.*
	FROM ' . TOPICS_TABLE	. ' AS t, ' . VOTE_DESC_TABLE	. ' AS vd
	WHERE t.forum_id IN (' . $forum_sql . ') AND t.topic_status <> 1 AND
	t.topic_status <> 2 AND t.topic_vote = 1 AND t.topic_id = vd.topic_id
	ORDER BY t.topic_time DESC LIMIT 0,1';

	if (!$query = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query poll information', '', __LINE__, __FILE__, $sql);
	}

	$result = $db->sql_fetchrow($query);

	if ($result)
	{
		$sql = 'SELECT * FROM ' . VOTE_RESULTS_TABLE . '
		WHERE vote_id = ' . $result['vote_id'] . ' ORDER BY vote_option_id';

		if (!$query = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not query vote result information', '', __LINE__, __FILE__, $sql);
		}

		while ($row = $db->sql_fetchrow($query))
		{
			$result['options'][] = $row;
		}
	}

	return $result;
}

?>