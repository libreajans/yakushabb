<?php
/***************************************************************************
* admin_forums.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Forums']['Manage'] = $file;
	return;
}

// Load default header
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('cat_title','forumname','forum_keywords');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

$forum_auth_ary = array(
	"auth_view" => AUTH_MOD, 
	"auth_read" => AUTH_MOD, 
	"auth_post" => AUTH_MOD, 
	"auth_reply" => AUTH_MOD, 
	"auth_edit" => AUTH_MOD,
	"auth_delete" => AUTH_MOD, 
	"auth_sticky" => AUTH_MOD, 
	"auth_announce" => AUTH_MOD, 
	"auth_vote" => AUTH_MOD, 
	"auth_pollcreate" => AUTH_MOD
);

$forum_auth_ary['auth_attachments'] = AUTH_MOD;
$forum_auth_ary['auth_download'] = AUTH_MOD;

// Mode setting
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = "";
}

// ------------------
// Begin function block
//
function get_info($mode, $id)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$namefield = 'cat_title';
		break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$namefield = 'forum_name';
		break;

		default:
			message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
		break;
	}
	$sql = "SELECT count(*) as total FROM $table";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not get Forum/Category information", "", __LINE__, __FILE__, $sql);
	}
	$count = $db->sql_fetchrow($result);
	$count = $count['total'];

	$db->sql_freeresult($result);

	$sql = "SELECT * FROM $table WHERE $idfield = $id";

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not get Forum/Category information", "", __LINE__, __FILE__, $sql);
	}

	if( $db->sql_numrows($result) != 1 )
	{
		message_die(GENERAL_ERROR, "Forum/Category doesn't exist or multiple forums/categories with ID $id", "", __LINE__, __FILE__);
	}

	$return = $db->sql_fetchrow($result);
	$return['number'] = $count;
	$db->sql_freeresult($result);

	return $return;
}

function get_list($mode, $id, $select)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$namefield = 'cat_title';
		break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$namefield = 'forum_name';
		break;

		default:
			message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
		break;
	}

	$sql = "SELECT * FROM $table";
	if( $select == 0 )
	{
		$sql .= " WHERE $idfield <> $id";
	}

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not get list of Categories/Forums", "", __LINE__, __FILE__, $sql);
	}

	$cat_list = "";

	while( $row = $db->sql_fetchrow($result) )
	{
		$s = "";
		if ($row[$idfield] == $id)
		{
			$s = " selected=\"selected\"";
		}
		$catlist .= "<option value=\"$row[$idfield]\"$s>" . $row[$namefield] . "</option>\n";
	}
	$db->sql_freeresult($result);
	return($catlist);
}

// Begin Simple Subforums MOD
function get_list_cat($id, $parent, $forum_id)
{
	global $db;

	// Get categories
	$sql = 'SELECT * FROM ' . CATEGORIES_TABLE . ' ORDER BY cat_order ASC';

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get list of categories", '', __LINE__, __FILE__, $sql);
	}

	$cat_list = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		$cat_list[] = $row;
	}

	$db->sql_freeresult($result);

	// Get all forums and check if forum has subforums
	$has_sub = false;
	$sql = 'SELECT * FROM ' . FORUMS_TABLE . ' ORDER BY forum_order ASC';

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not get list of forums", '', __LINE__, __FILE__, $sql);
	}

	$forums_list = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		if( $row['forum_parent'] > 0 && $row['forum_parent'] == $forum_id )
		{
			$has_sub = true;
		}

		if( !$row['forum_parent'] )
		{
			$forums_list[] = $row;
		}
	}
	$db->sql_freeresult($result);

	// Generate select
	for( $i = 0; $i < count($cat_list); $i++ )
	{
		$cat_id = $cat_list[$i]['cat_id'];
		$selected = ( $id == $cat_id && $parent == 0 ) ? ' selected="selected"' : '';
		$str .= '<option value="' . $cat_id . '"' . $selected . '>' . $cat_list[$i]['cat_title'] . '</option>';

		if( !$has_sub )
		{
			for( $j = 0; $j < count($forums_list); $j++)
			{
				if( $forums_list[$j]['cat_id'] == $cat_id && $forums_list[$j]['forum_id'] != $forum_id )
				{
					$forum_id2 = $forums_list[$j]['forum_id'];
					$selected = ( $id == $cat_id && $parent == $forum_id2 ) ? ' selected="selected"' : '';
					$str .= '<option value="' . $cat_id . ',' . $forum_id2 . '"' . $selected . '>- ' . $forums_list[$j]['forum_name'] . '</option>';
				}
			}
		}
	}
	return $str;
}
// End Simple Subforums MOD


function renumber_order($mode, $cat = 0)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$orderfield = 'cat_order';
			$cat = 0;
		break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$orderfield = 'forum_order';
			$catfield = 'cat_id';
		break;

		default:
			message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
		break;
	}

	$sql = "SELECT * FROM $table";
	if( $cat != 0)
	{
		$sql .= " WHERE $catfield = $cat";
	}
	$sql .= " ORDER BY $orderfield ASC";


	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not get list of Categories", "", __LINE__, __FILE__, $sql);
	}

	$i = 10;
	$inc = 10;

	while( $row = $db->sql_fetchrow($result) )
	{
		$sql = "UPDATE $table
		SET $orderfield = $i
		WHERE $idfield = " . $row[$idfield];
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not update order fields", "", __LINE__, __FILE__, $sql);
		}
		$i += 10;
	}
}
//
// End function block
// ------------------

//
// Begin program proper
//
if( isset($HTTP_POST_VARS['addforum']) || isset($HTTP_POST_VARS['addcategory']) )
{
	$mode = ( isset($HTTP_POST_VARS['addforum']) ) ? "addforum" : "addcat";

	if( $mode == "addforum" )
	{
		list($cat_id) = each($HTTP_POST_VARS['addforum']);
		$cat_id = intval($cat_id);
		// stripslashes needs to be run on this because slashes are added when the forum name is posted
		$forumname = stripslashes($HTTP_POST_VARS['forumname'][$cat_id]);
	}
}
// [start] Open/Close All Forums
else if( isset($HTTP_POST_VARS['openforums']) || isset($HTTP_POST_VARS['closeforums']) )
{
	$mode = ( isset($HTTP_POST_VARS['openforums']) ) ? "openforums" : "closeforums";
}
// [end] Open/Close All Forums
if( !empty($HTTP_POST_VARS['password']) )
{
	if( !preg_match("#^[A-Za-z0-9]{3,20}$#si", $HTTP_POST_VARS['password']) )
	{
		message_die(GENERAL_MESSAGE, $lang['Only_alpha_num_chars']);
	}
}

if( !empty($mode) ) 
{
	switch($mode)
	{
		case 'addforum':
		case 'editforum':
		// Show form to create/modify a forum

		if ($mode == 'editforum')
		{
			// $newmode determines if we are going to INSERT or UPDATE after posting?

			$l_title = $lang['Edit_forum'];
			$newmode = 'modforum';
			$buttonvalue = $lang['Update'];

			$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);
			$row = get_info('forum', $forum_id);

			$cat_id = $row['cat_id'];
			// Begin Simple Subforums MOD
			$parent_id = $row['forum_parent'];
			// End Simple Subforums MOD

			$forumname = $row['forum_name'];
			$forumdesc = $row['forum_desc'];
			$forumstatus = $row['forum_status'];
			$forum_keywords = $row['forum_keywords'];
			$forumicon = $row['forum_icon'];
			$forum_password = $row['forum_password'];

			// start forum prune stuff.
			if( $row['prune_enable'] )
			{
				$prune_enabled = "checked=\"checked\"";
				$sql = "SELECT * FROM " . PRUNE_TABLE . " WHERE forum_id = $forum_id";
				if(!$pr_result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Auto-Prune: Could not read auto_prune table.', __LINE__, __FILE__);
				}

				$pr_row = $db->sql_fetchrow($pr_result);
			}
			else
			{
				$prune_enabled = '';
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$l_title = $lang['Create_forum'];
			$newmode = 'createforum';
			$buttonvalue = $lang['Create_forum'];

			$forumdesc = '';
			$forumstatus = FORUM_UNLOCKED;
			$forum_keywords = '';
			$forumicon = '';
			$forum_password = '';
			$forum_id = '';
			$prune_enabled = '';
		}

		// Begin Simple Subforums MOD
		$catlist = get_list_cat($cat_id, $parent_id, $forum_id);
		// End Simple Subforums MOD


		$forumstatus == ( FORUM_LOCKED ) ? $forumlocked = "selected=\"selected\"" : $forumunlocked = "selected=\"selected\"";

		// These two options ($lang['Status_unlocked'] and $lang['Status_locked']) seem to be missing from
		// the language files.
		$lang['Status_unlocked'] = isset($lang['Status_unlocked']) ? $lang['Status_unlocked'] : 'Unlocked';
		$lang['Status_locked'] = isset($lang['Status_locked']) ? $lang['Status_locked'] : 'Locked';

		$statuslist = "<option value=\"" . FORUM_UNLOCKED . "\" $forumunlocked>" . $lang['Status_unlocked'] . "</option>\n";
		$statuslist .= "<option value=\"" . FORUM_LOCKED . "\" $forumlocked>" . $lang['Status_locked'] . "</option>\n"; 

		#--[+]--- forum icon tarayýcý -------------------------------
		if ($board_config['icon_mod_open'])
		{
			$dir_way = 'images/icons';
			$dir = @opendir($phpbb_root_path .'/'. $dir_way);

			$avatar_row_count = 0;
			$avatar_col_count = 0;
			$forum_icon_list .= '<table cellspacing="0" cellpadding="5" align="center" border="1"><tr><tr><td colspan="10" align="center">'.$lang['No_selected_icon'].'<input type="radio" name="forumicon" value=""></td></tr>';
			while (($dizin = readdir($dir)) != false )
			{
				if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $dizin) )
				{
					$avatar_col_count++;
					$diz = "$dir_way/$dizin";
					$selected = ( $diz == $forumicon ) ? 'checked="checked"' : '';
					$forum_icon_list .= "<td align='center'><img src='../$diz'><br /><input type=\"radio\" name=\"forumicon\" $selected value=\"$diz\"></td>";
					if( $avatar_col_count == 10 )
					{
						$forum_icon_list .= "</tr><tr>";
						$avatar_row_count++;
						$avatar_col_count = 0;
					}
				}
			}
			$forum_icon_list .= "</tr></table>";
			@closedir($dir);
		}
		#--[-]--- forum icon tarayýcý -------------------------------

		$template->set_filenames(array('body' => ($board_config['icon_mod_open']) ? 'admin/forum_edit_body.tpl' : 'admin/forum_edit_body_.tpl' ));
		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
		$template->assign_vars(array(
			'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_SUBMIT_VALUE' => $buttonvalue, 
			'S_CAT_LIST' => $catlist,
			'S_STATUS_LIST' => $statuslist,
			'S_PRUNE_ENABLED' => $prune_enabled,
			'L_AUTH_LINK' => $lang['Go_edit_forum_auth'],
			'S_SWITCH_ACTION' => append_sid("admin_forumauth.$phpEx"),

			'S_FORUM_ICONS' => $forum_icon_list,
			'L_FORUM_TITLE' => $l_title,
			'L_FORUM_EXPLAIN' => $lang['Forum_edit_delete_explain'],
			'L_FORUM_SETTINGS' => $lang['Forum_settings'], 
			'L_FORUM_NAME' => $lang['Forum_name'], 
			'L_CATEGORY' => $lang['Category'] . ' / ' . $lang['Forum'], 
			'L_FORUM_DESCRIPTION' => $lang['Forum_desc'],
			'L_FORUM_STATUS' => $lang['Forum_status'],
			'L_FORUM_ICON' => $lang['Forum_icon'], 
			'L_PASSWORD' => $lang['Forum_password'],
			'L_FORUM_KEYWORD' => $lang['Forum_keywords'],
			'KEYWORDS_LEN' => $lang['keyword_len_explain'],
			'L_AUTO_PRUNE' => $lang['Forum_pruning'],
			'L_ENABLED' => $lang['Enabled'],
			'L_PRUNE_DAYS' => $lang['prune_days'],
			'L_PRUNE_FREQ' => $lang['prune_freq'],
			'L_DAYS' => $lang['Days'],

			'PRUNE_DAYS' => ( isset($pr_row['prune_days']) ) ? $pr_row['prune_days'] : 7,
			'PRUNE_FREQ' => ( isset($pr_row['prune_freq']) ) ? $pr_row['prune_freq'] : 1,
			'FORUM_NAME' => $forumname,
			'FORUM_PASSWORD' => $forum_password,
			'FORUM_KEYWORDS' => $forum_keywords,
			'DESCRIPTION' => $forumdesc,
			'ICON' => ( $forumicon ) ? $forumicon : $forumicon,
			'ICON_DISPLAY' => ( $forumicon ) ? '<img src="' . $phpbb_root_path . trim($forumicon) . '" />' : '')
		);
		$template->pparse("body");
		break;

		case 'createforum':
		// Create a forum in the DB
		if( trim($HTTP_POST_VARS['forumname']) == "" )
		{
			message_die(GENERAL_ERROR, "Can't create a forum without a name");
		}

		$sql = "SELECT MAX(forum_order) AS max_order
		FROM " . FORUMS_TABLE . "
		WHERE cat_id = " . intval($HTTP_POST_VARS[POST_CAT_URL]);
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not get order number from forums table", "", __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);

		$max_order = $row['max_order'];
		$next_order = $max_order + 10;

		$db->sql_freeresult($result);
		$sql = "SELECT MAX(forum_id) AS max_id FROM " . FORUMS_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not get order number from forums table", "", __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);

		$max_id = $row['max_id'];
		$next_id = $max_id + 1;

		// Default permissions of public :: 
		$field_sql = "";
		$value_sql = "";
		while( list($field, $value) = each($forum_auth_ary) )
		{
			$field_sql .= ", $field";
			$value_sql .= ", $value";
		}

		// There is no problem having duplicate forum names so we won't check for it.
		// Begin Simple Subforums MOD
		$list = explode(',', $HTTP_POST_VARS[POST_CAT_URL]);
		$new_cat = ( count($list) ) ? intval($list[0]) : intval($HTTP_POST_VARS[POST_CAT_URL]);
		$new_parent = ( isset($list[1]) ) ? intval($list[1]) : 0;
		// End Simple Subforums MOD

		$sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, forum_name, cat_id, forum_parent, forum_desc, forum_order, forum_status, forum_keywords, forum_icon, forum_password, prune_enable" . $field_sql . ")
			VALUES ('" . $next_id . "', '" . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . "', " . $new_cat . ', ' . $new_parent . ", '" . str_replace("\'", "''", $HTTP_POST_VARS['forumdesc']) . "', $next_order, " . intval($HTTP_POST_VARS['forumstatus']) . ", '" . str_replace("\'", "''", $HTTP_POST_VARS['forum_keywords']) . "', '" . str_replace("\'", "''", $HTTP_POST_VARS['forumicon']) . "', '" . str_replace("\'", "''", $HTTP_POST_VARS['password']) . "', " . intval($HTTP_POST_VARS['prune_enable']) . $value_sql . ")";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not insert row in forums table", "", __LINE__, __FILE__, $sql);
		}

		if( $HTTP_POST_VARS['prune_enable'] )
		{
			if( $HTTP_POST_VARS['prune_days'] == "" || $HTTP_POST_VARS['prune_freq'] == "")
			{
				message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
			}

			$sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)
				VALUES('" . $next_id . "', " . intval($HTTP_POST_VARS['prune_days']) . ", " . intval($HTTP_POST_VARS['prune_freq']) . ")";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not insert row in prune table", "", __LINE__, __FILE__, $sql);
			}
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);

		break;

		case 'modforum':
		// Begin Simple Subforums MOD
		$forum_id = intval($HTTP_POST_VARS[POST_FORUM_URL]);
		$row = get_info('forum', $forum_id);
		$list = explode(',', $HTTP_POST_VARS[POST_CAT_URL]);
		$new_cat = ( count($list) ) ? intval($list[0]) : intval($HTTP_POST_VARS[POST_CAT_URL]);
		$new_parent = ( isset($list[1]) ) ? intval($list[1]) : 0;

		if( !$row['forum_parent'] && $row['cat_id'] !== $new_cat )
		{
			$sql = "UPDATE " . FORUMS_TABLE . " SET cat_id='$new_cat' WHERE forum_parent='$forum_id'";
			$db->sql_query($sql);
		}

		// Modify a forum in the DB
		if( isset($HTTP_POST_VARS['prune_enable']))
		{
			if( $HTTP_POST_VARS['prune_enable'] != 1 )
			{
				$HTTP_POST_VARS['prune_enable'] = 0;
			}
		}

		$sql = "UPDATE " . FORUMS_TABLE . "
			SET forum_name = '" . str_replace("\'", "''", $HTTP_POST_VARS['forumname']) . "', cat_id = $new_cat, forum_parent = $new_parent, forum_desc = '" . str_replace("\'", "''", $HTTP_POST_VARS['forumdesc']) . "', forum_status = " . intval($HTTP_POST_VARS['forumstatus']) . ", forum_keywords = '" . str_replace("\'", "''", $HTTP_POST_VARS['forum_keywords']) . "', forum_icon = '" . trim(str_replace("\'", "''", $HTTP_POST_VARS['forumicon'])) . "', forum_password = '" . str_replace("\'", "''", $HTTP_POST_VARS['password']) . "', prune_enable = " . intval($HTTP_POST_VARS['prune_enable']) . "
			WHERE forum_id = " . intval($HTTP_POST_VARS[POST_FORUM_URL]);
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not update forum information", "", __LINE__, __FILE__, $sql);
		}

		if( $HTTP_POST_VARS['prune_enable'] == 1 )
		{
			if( $HTTP_POST_VARS['prune_days'] == "" || $HTTP_POST_VARS['prune_freq'] == "" )
			{
				message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
			}

			$sql = "SELECT * FROM " . PRUNE_TABLE . " WHERE forum_id = " . intval($HTTP_POST_VARS[POST_FORUM_URL]);
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not get forum Prune Information","",__LINE__, __FILE__, $sql);
			}

			if( $db->sql_numrows($result) > 0 )
			{
				$sql = "UPDATE " . PRUNE_TABLE . "
				SET prune_days = " . intval($HTTP_POST_VARS['prune_days']) . ", prune_freq = " . intval($HTTP_POST_VARS['prune_freq']) . "
				WHERE forum_id = " . intval($HTTP_POST_VARS[POST_FORUM_URL]);
			}
			else
			{
				$sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)
				VALUES(" . intval($HTTP_POST_VARS[POST_FORUM_URL]) . ", " . intval($HTTP_POST_VARS['prune_days']) . ", " . intval($HTTP_POST_VARS['prune_freq']) . ")";
			}

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not Update Forum Prune Information","",__LINE__, __FILE__, $sql);
			}
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);
		break;

		case 'addcat':
		// Create a category in the DB
		if( trim($HTTP_POST_VARS['categoryname']) == '')
		{
			message_die(GENERAL_ERROR, "Can't create a category without a name");
		}

		$sql = "SELECT MAX(cat_order) AS max_order
			FROM " . CATEGORIES_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not get order number from categories table", "", __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);

		$max_order = $row['max_order'];
		$next_order = $max_order + 10;

		// There is no problem having duplicate forum names so we won't check for it.
		$sql = "INSERT INTO " . CATEGORIES_TABLE . " (cat_title, cat_order)
			VALUES ('" . str_replace("\'", "''", $HTTP_POST_VARS['categoryname']) . "', $next_order)";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not insert row in categories table", "", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);

		break;

		case 'editcat':
		// Show form to edit a category
		$newmode = 'modcat';
		$buttonvalue = $lang['Update'];

		$cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

		$row = get_info('category', $cat_id);
		$cat_title = $row['cat_title'];

		$template->set_filenames(array("body" => "admin/category_edit_body.tpl"));
		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $cat_id . '" />';

		$template->assign_vars(array(
			'CAT_TITLE' => $cat_title,
			'L_EDIT_CATEGORY' => $lang['Edit_Category'], 
			'L_EDIT_CATEGORY_EXPLAIN' => $lang['Edit_Category_explain'], 
			'L_CATEGORY' => $lang['Category'], 
			'S_HIDDEN_FIELDS' => $s_hidden_fields, 
			'S_SUBMIT_VALUE' => $buttonvalue, 
			'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
			'L_CLOSE_FORUMS' => $lang['Close_forums'],
			'L_OPEN_FORUMS' => $lang['Open_forums'])
		);

		$template->pparse("body");
		break;

		case 'modcat':
		// Modify a category in the DB
		$sql = "UPDATE " . CATEGORIES_TABLE . "
			SET cat_title = '" . str_replace("\'", "''", $HTTP_POST_VARS['cat_title']) . "'
			WHERE cat_id = " . intval($HTTP_POST_VARS[POST_CAT_URL]);
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not update forum information", "", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);

		break;

		case 'deleteforum':
		// Show form to delete a forum
		$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);
		$select_to = '<select name="to_id">';
		$select_to .= "<option value=\"-1\"$s>" . $lang['Delete_all_posts'] . "</option>\n";
		$select_to .= get_list('forum', $forum_id, 0);
		$select_to .= '</select>';
		$buttonvalue = $lang['Move_and_Delete'];
		$newmode = 'movedelforum';
		$foruminfo = get_info('forum', $forum_id);
		$name = $foruminfo['forum_name'];

		$template->set_filenames(array("body" => "admin/forum_delete_body.tpl"));

		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $forum_id . '" />';

		$template->assign_vars(array(
			'NAME' => $name, 
			'L_FORUM_DELETE' => $lang['Forum_delete'], 
			'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'], 
			'L_MOVE_CONTENTS' => $lang['Move_contents'], 
			'L_FORUM_NAME' => $lang['Forum_name'], 
			"S_HIDDEN_FIELDS" => $s_hidden_fields,
			'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"), 
			'S_SELECT_TO' => $select_to,
			'S_SUBMIT_VALUE' => $buttonvalue)
		);

		$template->pparse("body");
		break;

		case 'movedelforum':

		// Move or delete a forum in the DB
		$from_id = intval($HTTP_POST_VARS['from_id']);
		$to_id = intval($HTTP_POST_VARS['to_id']);
		$delete_old = intval($HTTP_POST_VARS['delete_old']);

		// Either delete or move all posts in a forum
		if($to_id == -1)
		{
			// Delete polls in this forum
			$sql = "SELECT v.vote_id 
			FROM " . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t 
			WHERE t.forum_id = $from_id 
			AND v.topic_id = t.topic_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, "Could not obtain list of vote ids", "", __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$vote_ids = '';
				do
				{
					$vote_ids = (($vote_ids != '') ? ', ' : '') . $row['vote_id'];
				}
				while ($row = $db->sql_fetchrow($result));

				$sql = "DELETE FROM " . VOTE_DESC_TABLE . " 
					WHERE vote_id IN ($vote_ids)";
				$db->sql_query($sql);

				$sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " 
					WHERE vote_id IN ($vote_ids)";
				$db->sql_query($sql);

				$sql = "DELETE FROM " . VOTE_USERS_TABLE . " 
					WHERE vote_id IN ($vote_ids)";
				$db->sql_query($sql);
			}
			$db->sql_freeresult($result);

			include($phpbb_root_path . "includes/prune.$phpEx");
			prune($from_id, 0, true); // Delete everything from forum
		}
		else
		{
			$sql = "SELECT * FROM " . FORUMS_TABLE . " WHERE forum_id IN ($from_id, $to_id)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not verify existence of forums", "", __LINE__, __FILE__, $sql);
			}

			if($db->sql_numrows($result) != 2)
			{
				message_die(GENERAL_ERROR, "Ambiguous forum ID's", "", __LINE__, __FILE__);
			}
			$sql = "UPDATE " . TOPICS_TABLE . "
				SET forum_id = $to_id
				WHERE forum_id = $from_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not move topics to other forum", "", __LINE__, __FILE__, $sql);
			}
			$sql = "UPDATE " . POSTS_TABLE . "
				SET	forum_id = $to_id
				WHERE forum_id = $from_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not move posts to other forum", "", __LINE__, __FILE__, $sql);
			}
			sync('forum', $to_id);
		}

		// Alter Mod level if appropriate - 2.0.4
		$sql = "SELECT ug.user_id 
			FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug 
			WHERE a.forum_id <> $from_id 
			AND a.auth_mod = 1
			AND ug.group_id = a.group_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not obtain moderator list", "", __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			$user_ids = '';
			do
			{
				$user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
			}
			while ($row = $db->sql_fetchrow($result));

			$sql = "SELECT ug.user_id 
				FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug 
				WHERE a.forum_id = $from_id 
				AND a.auth_mod = 1 
				AND ug.group_id = a.group_id
				AND ug.user_id NOT IN ($user_ids)";
			if( !$result2 = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not obtain moderator list", "", __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result2))
			{
				$user_ids = '';
				do
				{
					$user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
				}
				while ($row = $db->sql_fetchrow($result2));

				$sql = "UPDATE " . USERS_TABLE . " 
					SET user_level = " . USER . " 
					WHERE user_id IN ($user_ids) 
					AND user_level <> " . ADMIN;
				$db->sql_query($sql);
			}
			$db->sql_freeresult($result);
		}
		$db->sql_freeresult($result2);

		$sql = "DELETE FROM " . FORUMS_TABLE . "
			WHERE forum_id = $from_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not delete forum", "", __LINE__, __FILE__, $sql);
		}

		// Begin Simple Subforums MOD
		// Move subforums to category
		$sql = "UPDATE " . FORUMS_TABLE . " SET forum_parent = '0' WHERE forum_parent = '$from_id'";
		$db->sql_query($sql);
		// End Simple Subforums MOD

		$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
		WHERE forum_id = $from_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not delete forum", "", __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . PRUNE_TABLE . "
			WHERE forum_id = $from_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not delete forum prune information!", "", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);

		break;

		case 'deletecat':
		// Show form to delete a category
		$cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

		$buttonvalue = $lang['Move_and_Delete'];
		$newmode = 'movedelcat';
		$catinfo = get_info('category', $cat_id);
		$name = $catinfo['cat_title'];

		if ($catinfo['number'] == 1)
		{
			$sql = "SELECT count(*) as total
				FROM ". FORUMS_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not get Forum count", "", __LINE__, __FILE__, $sql);
			}
			$count = $db->sql_fetchrow($result);
			$count = $count['total'];

			if ($count > 0)
			{
				message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
			}
			else
			{
				$select_to = $lang['Nowhere_to_move'];
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$select_to = '<select name="to_id">';
			$select_to .= get_list('category', $cat_id, 0);
			$select_to .= '</select>';
		}

		$template->set_filenames(array("body" => "admin/forum_delete_body.tpl"));

		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $cat_id . '" />';

		$template->assign_vars(array(
			'NAME' => $name, 
			'L_FORUM_DELETE' => $lang['Forum_delete'], 
			'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'], 
			'L_MOVE_CONTENTS' => $lang['Move_contents'], 
			'L_FORUM_NAME' => $lang['Forum_name'], 
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
			'S_SELECT_TO' => $select_to,
			'S_SUBMIT_VALUE' => $buttonvalue)
		);

		$template->pparse("body");
		break;

		case 'movedelcat':
		// Move or delete a category in the DB
		$from_id = intval($HTTP_POST_VARS['from_id']);
		$to_id = intval($HTTP_POST_VARS['to_id']);

		if (!empty($to_id))
		{
			$sql = "SELECT * FROM " . CATEGORIES_TABLE . " WHERE cat_id IN ($from_id, $to_id)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not verify existence of categories", "", __LINE__, __FILE__, $sql);
			}
			if($db->sql_numrows($result) != 2)
			{
				message_die(GENERAL_ERROR, "Ambiguous category ID's", "", __LINE__, __FILE__);
			}

			$sql = "UPDATE " . FORUMS_TABLE . "
				SET cat_id = $to_id
				WHERE cat_id = $from_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not move forums to other category", "", __LINE__, __FILE__, $sql);
			}
		}

		$sql = "DELETE FROM " . CATEGORIES_TABLE ."
			WHERE cat_id = $from_id";

		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not delete category", "", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);

		break;

		case 'forum_order':
		// Change order of forums in the DB
		$move = intval($HTTP_GET_VARS['move']);
		$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

		$forum_info = get_info('forum', $forum_id);
		$cat_id = $forum_info['cat_id'];

		$sql = "UPDATE " . FORUMS_TABLE . "
			SET forum_order = forum_order + $move
			WHERE forum_id = $forum_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not change category order", "", __LINE__, __FILE__, $sql);
		}

		renumber_order('forum', $forum_info['cat_id']);
		$show_index = TRUE;

		break;

		case 'cat_order':
		// Change order of categories in the DB
		$move = intval($HTTP_GET_VARS['move']);
		$cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

		$sql = "UPDATE " . CATEGORIES_TABLE . "
			SET cat_order = cat_order + $move
			WHERE cat_id = $cat_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not change category order", "", __LINE__, __FILE__, $sql);
		}

		renumber_order('category');
		$show_index = TRUE;

		break;

		case 'forum_sync':
		sync('forum', intval($HTTP_GET_VARS[POST_FORUM_URL]));
		$show_index = TRUE;

		break;
		// [start] Open/Close All Forums
		case 'closeforums':
		$sql = "UPDATE " . FORUMS_TABLE . "
			SET forum_status = 1";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't close all forums", "", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
		break;

		case 'openforums':
		$sql = "UPDATE " . FORUMS_TABLE . "
			SET forum_status = 0";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't open all forums", "", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
		break;
		// [end] Open/Close All Forums


		default:
		message_die(GENERAL_MESSAGE, $lang['No_mode']);
		break;
	}

	if ($show_index != TRUE)
	{
		include('./page_footer_admin.'.$phpEx);
		exit;
	}
}

// Start page proper
$template->set_filenames(array('body' => ($board_config['icon_mod_open']) ? 'admin/forum_admin_body.tpl' : 'admin/forum_admin_body_.tpl' ));

$template->assign_vars(array(
	'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
	'L_FORUM_TITLE' => $lang['Forum_admin'],
	'L_FORUM_EXPLAIN' => $lang['Forum_admin_explain'], 
	'L_CREATE_FORUM' => $lang['Create_forum'], 
	'L_CREATE_CATEGORY' => $lang['Create_category'], 
	'L_EDIT' => '<img src="../images/im/edit.gif" border="0" alt="' . $lang['Edit'] . '" title="' . $lang['Edit'] . '" />',
	'L_DELETE' => '<img src="../images/im/del.gif" border="0" alt="' . $lang['Delete'] . '" title="' . $lang['Delete'] . '" />',
	'L_MOVE_UP' => '<img src="../images/im/up.png" border="0" alt="' . $lang['Move_up'] . '" title="' . $lang['Move_up'] . '" />',
	'L_MOVE_DOWN' => '<img src="../images/im/down.png" border="0" alt="' . $lang['Move_down'] . '" title="' . $lang['Move_down'] . '" />',
	'L_AUTH' => '<img src="../images/im/auth.png" border="0" alt="' . $lang['CPermissions'] . '" title="' . $lang['CPermissions'] . '" />',
	'L_RESYNC' => '<img src="../images/im/resync.gif" border="0" alt="' . $lang['Resync'] . '" title="' . $lang['Resync'] . '" />')
);

$sql = "SELECT cat_id, cat_title, cat_order
	FROM " . CATEGORIES_TABLE . "
	ORDER BY cat_order";
if( !$q_categories = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
}

if( $total_categories = $db->sql_numrows($q_categories) )
{
	$category_rows = $db->sql_fetchrowset($q_categories);

	$sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY cat_id, forum_order";
	if(!$q_forums = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);
	}

	if( $total_forums = $db->sql_numrows($q_forums) )
	{
		$forum_rows = $db->sql_fetchrowset($q_forums);
	}

	// Okay, let's build the index
	$gen_cat = array();

	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		$template->assign_block_vars("catrow", array( 
			'S_ADD_FORUM_SUBMIT' => "addforum[$cat_id]", 
			'S_ADD_FORUM_NAME' => "forumname[$cat_id]", 
			'CAT_ID' => $cat_id,
			'CAT_DESC' => $category_rows[$i]['cat_title'],
			'U_CAT_EDIT' => append_sid("admin_forums.$phpEx?mode=editcat&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_CAT_DELETE' => append_sid("admin_forums.$phpEx?mode=deletecat&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_CAT_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=-15&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_CAT_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=15&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_VIEWCAT' => append_sid($phpbb_root_path."index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
		);

		for($j = 0; $j < $total_forums; $j++)
		{
			$forum_id = $forum_rows[$j]['forum_id'];
			if ($forum_rows[$j]['cat_id'] == $cat_id  && $forum_rows[$j]['forum_parent'] == 0)
			{
				$template->assign_block_vars("catrow.forumrow", array(
					'FORUM_ID' => $forum_id,
					'FORUM_NAME' => $forum_rows[$j]['forum_name'],
					'FORUM_DESC' => $forum_rows[$j]['forum_desc'],
					'FORUM_KEYWORDS' => $forum_rows[$j]['forum_keywords'],
					'FORUM_ICON_IMG' => ( $forum_rows[$j]['forum_icon'] ) ? '<img src="' . $phpbb_root_path . $forum_rows[$j]['forum_icon'] . '" alt="'.$forum_data[$j]['forum_name'].'" title="'.$forum_data[$j]['forum_name'].'" />' : '', // Forum Icon Mod
					'ROW_COLOR' => $row_color,
					'NUM_TOPICS' => $forum_rows[$j]['forum_topics'],
					'NUM_POSTS' => $forum_rows[$j]['forum_posts'],

					'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_AUTH' => append_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id"))
				);
				// Begin Simple Subforums MOD
				for( $k = 0; $k < $total_forums; $k++ )
				{
					$forum_id2 = $forum_rows[$k]['forum_id'];
					if ( $forum_rows[$k]['forum_parent'] == $forum_id )
					{
						$template->assign_block_vars("catrow.forumrow", array(
							'FORUM_ID' => $forum_rows[$k]['forum_id'],
							'FORUM_NAME' => '--&nbsp;' . $forum_rows[$k]['forum_name'],
							'FORUM_DESC' => $forum_rows[$k]['forum_desc'],
							'ROW_COLOR' => $row_color,
							'NUM_TOPICS' => $forum_rows[$k]['forum_topics'],
							'NUM_POSTS' => $forum_rows[$k]['forum_posts'],
							'STYLE' => ' style="padding-left: 20px;" ',
							'FORUM_KEYWORDS' => $forum_rows[$k]['forum_keywords'],
							'FORUM_ICON_IMG' => ( $forum_rows[$k]['forum_icon'] ) ? '<img src="' . $phpbb_root_path . $forum_rows[$k]['forum_icon'] . '" alt="'.$forum_data[$k]['forum_name'].'" title="'.$forum_data[$k]['forum_name'].'" />' : '',
							'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id2"),
							'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id2"),
							'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id2"),
							'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id2"),
							'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id2"),
							'U_FORUM_AUTH' => append_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=$forum_id2"),
							'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id2"))
						);
					}
				} // for ... forums
				// End Simple Subforums MOD
			}// if ... forumid == catid
		} // for ... forums
	} // for ... categories
}// if ... total_categories

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>