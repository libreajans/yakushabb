<?php
/***************************************************************************
* admin_color_groups.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human

define('IN_PHPBB', true);

if (!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Groups']['Color_Groups'] = $filename;

	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('color_change_1','color_change_2','color_change_3','color_change_4','color_change_5','color_change_6','color_change_7','color_change_8','color_change_9','color_change_10','new_group_name','new_group_color');
require('./pagestart.' . $phpEx);

include_once($phpbb_root_path."includes/functions_color_groups.$phpEx");
define('MOD_VERSION', '1.2.1');

find_lang_file_nivisec('lang_color_groups');


// Module Actual Start
define('DISABLE_VERSION_CHECK', FALSE);
$debug = false;

// Main Vars
$status_message = '';
$order_num_max = get_color_group_order_max();
$order_num_min = get_color_group_order_min();
$next_order_num = $order_num_max + 1;
$filename = basename(__FILE__);

// Small Functions
function count_users_in_color_group($group_id)
{
	global $db, $lang;
	$sql = 'SELECT COUNT(user_id) as count FROM ' . USERS_TABLE . "
		WHERE user_color_group = $group_id";
	if (!empty($group_id))
	{
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
		$row = $db->sql_fetchrow($result);
	}
	return max(0, $row['count']);
}
function swap_color_group_order_num($g1, $g2)
{
	global $lang, $status_message, $next_order_num;
	
	do_query_nivisec(
	'SELECT group_id, group_name, order_num FROM ' . COLOR_GROUPS_TABLE . "
		WHERE group_id = $g1
		OR group_id = $g2",
	// End query
	$row_items,
	$lang['Error_Group_Table']
	);
	
	//On the small chance the two order numbers are equal somehow, fix it
	if ($row_items[0]['order_num'] == $row_items[1]['order_num'])
	{
		do_fast_query_nivisec(
		'UPDATE ' . COLOR_GROUPS_TABLE . "
		SET order_num = $next_order_num
		WHERE group_id = " . $row_items[1]['group_id'],
		
		$lang['Error_Group_Table']
		);
		$status_message .= sprintf($lang['Invalid_Order_Num'], $row_items[1]['group_name']);
	}
	else
	{
		//We know 2 items are returned, if not something is screwed up badly
		do_fast_query_nivisec(
		'UPDATE ' . COLOR_GROUPS_TABLE . '
		SET order_num = ' . $row_items[0]['order_num'] . '
		WHERE group_id = ' . $row_items[1]['group_id'],
		$lang['Error_Group_Table']
		);
		do_fast_query_nivisec(
		'UPDATE ' . COLOR_GROUPS_TABLE . '
		SET order_num = ' . $row_items[1]['order_num'] . '
		WHERE group_id = ' . $row_items[0]['group_id'],
		$lang['Error_Group_Table']
		);
	}
}
function hide_toggle_color_group($group_id, $mode)
{
	global $lang;
	
	switch($mode)
	{
		case 'hide':
		$hide_mode = 1;
		break;
		case 'unhide':
		$hide_mode = 0;
		break;
	}
	
	do_fast_query_nivisec(
	'UPDATE ' . COLOR_GROUPS_TABLE . "
	SET hidden = $hide_mode
	WHERE group_id = $group_id",
	$lang['Error_Group_Table']
	);
}

function make_color_group_reference()
{
	global $db, $lang;
	
	$c_groups = array();
	
	$sql = 'SELECT group_id, group_name FROM ' . COLOR_GROUPS_TABLE;
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Users_Table'], '', __LINE__, __FILE__, $sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$c_groups[$row['group_id']] = stripslashes($row['group_name']);
	}
	return $c_groups;
}	
// Get parameters.  'var_name' => 'default'
$params = array('mode' => '', 'action' => '', 'switch1' => '', 'switch2' => '');
if ($debug)
{
	//Dump out the get and post vars if in debug mode
	echo '<pre><span  class="gensmall"><font color="blue">DEBUG - POST VARS -<br>';
	print_r($HTTP_POST_VARS);
	echo '</font><br>';
	echo '<font color="red">DEBUG - GET VARS -<br>';
	print_r($HTTP_GET_VARS);
	echo '</font><br></pre></span>';
}

foreach($params as $var => $default)
{
	$$var = $default;
	if( isset($HTTP_POST_VARS[$var]) || isset($HTTP_GET_VARS[$var]) )
	{
		$$var = ( isset($HTTP_POST_VARS[$var]) ) ? $HTTP_POST_VARS[$var] : $HTTP_GET_VARS[$var];
	}
}
	$color_group_list = make_color_group_reference();

// Check for edit user lists or deletes
$found_list = false;
$found_delete = false;
$found_hide = false;
$found_unhide = false;
if (count($HTTP_POST_VARS))
{
	foreach ($HTTP_POST_VARS as $key => $val)
	{
		if (preg_match("/^edit_group_/", $key))
		{
			$group_id = str_replace('edit_group_', '', $key);
			$found_list = true;
		}
		elseif (preg_match("/^delete_group_/", $key))
		{
			$group_id_delete = str_replace('delete_group_', '', $key);
			$found_delete = true;
		}
		elseif (preg_match("/^hide_group_/", $key))
		{
			$group_id_hide = str_replace('hide_group_', '', $key);
			$found_hide = true;
		}
		elseif (preg_match("/^unhide_group_/", $key))
		{
			$group_id_unhide = str_replace('unhide_group_', '', $key);
			$found_unhide = true;
		}
	}
}
// Edit user lists
if ($found_list && isset($group_id))
{
	$page_title = $lang['Color_Group_User_List'];
	$page_desc = $lang['Color_Group_User_List_Desc'];

	
	//Get group info
	$sql = 'SELECT * FROM ' . COLOR_GROUPS_TABLE . "
		WHERE group_id = $group_id";
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
	$group_row = $db->sql_fetchrow($result);
	
	//Make Our List
	$user_list = array();
	$sql = 'SELECT username, user_id FROM ' . USERS_TABLE . "
				WHERE user_color_group = $group_id
				ORDER BY username ASC";
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Users_Table'], '', __LINE__, __FILE__, $sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$user_list[] = $row['user_id'];
	}
	
	//Make A full list of all users, non grouped, and grouped
	$sql = 'SELECT user_id, username, user_color_group FROM ' . USERS_TABLE . '
			WHERE user_id <> ' . ANONYMOUS . '
			ORDER BY username ASC';
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Users_Table'], '', __LINE__, __FILE__, $sql);
	$user_list_box = '<select class="post" name="user_list_box" size="20" multiple />';
	while ($row = $db->sql_fetchrow($result))
	{
		$selected = (in_array($row['user_id'], $user_list)) ? 'selected="true"' : '';
		$username = $row['username'];
		$c_group = ($row['user_color_group'] != 0) ? '('.$color_group_list[$row['user_color_group']].')' : '';
		$id = $row['user_id'];
		$user_list_box .= "<option value=\"$id\" $selected />$username $c_group</option>";
	}
	$user_list_box .= '</select>';

	//Make Our List
	$group_list = array();
	$sql = 'SELECT group_name, group_id FROM ' . GROUPS_TABLE . "
				WHERE group_color_group = $group_id
				ORDER BY group_name ASC";
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Users_Table'], '', __LINE__, __FILE__, $sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$group_list[] = $row['group_id'];
	}
	
	//Make A full list of all groups, non grouped, and grouped
	$sql = 'SELECT group_id, group_name, group_color_group FROM ' . GROUPS_TABLE . '
		WHERE group_single_user = 0		
		ORDER BY group_name ASC';
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Users_Table'], '', __LINE__, __FILE__, $sql);
	$group_list_box = '<select class="post" name="group_list_box" size="20" multiple />';
	while ($row = $db->sql_fetchrow($result))
	{
		$selected = (in_array($row['group_id'], $group_list)) ? 'selected="true"' : '';
		$username = $row['group_name'];
		$c_group = ($row['group_color_group'] != 0) ? '('.$color_group_list[$row['group_color_group']].')' : '';
		$id = $row['group_id'];
		$group_list_box .= "<option value=\"$id\" $selected />$username $c_group</option>";
	}
	$group_list_box .= '</select>';
	
	$template->assign_vars(array(
	'S_USER_LIST'=> $user_list,
	'S_USER_LIST_BOX' => $user_list_box,
	'S_GROUP_LIST_BOX' => $group_list_box,
	'L_EDITING_GROUP' => sprintf($lang['Editing_Group'], $group_row['group_name']),
	'S_GROUP_COLOR' => $group_row['group_color'],
	'S_GROUP_ID' => $group_row['group_id']
	));
	$template->set_filenames(array('body' => 'admin/color_groups_user_list.tpl'));
}
// Main Display
else
{
	// Update groups area
	if (isset($HTTP_POST_VARS['update_groups']))
	{
		$sql = 'SELECT * FROM ' . COLOR_GROUPS_TABLE;
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
		//We have to loop through all the color sets, each group_id
		while ($row = $db->sql_fetchrow($result))
		{
			if (isset($HTTP_POST_VARS['color_change_'.$row['group_id']]) && $HTTP_POST_VARS['color_change_'.$row['group_id']] != $row['group_color'])
			{
				$changeColor = addslashes($HTTP_POST_VARS['color_change_'.$row['group_id']]);
				$sql = 'UPDATE ' . COLOR_GROUPS_TABLE . "
					SET group_color = '" . $changeColor . "'
					WHERE group_id = " . $row['group_id'];
				if (!$db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
				$status_message .= sprintf($lang['Group_Updated'], stripslashes($row['group_name']));
			}
		}
	}
	
	// Update group list
	if (isset($HTTP_POST_VARS['update_group_list']))
	{
		color_groups_update_group_id($HTTP_POST_VARS['real_group_list'], $HTTP_POST_VARS['real_user_list'], $HTTP_POST_VARS['group_id']);
	}
	
	// Hide/Unhide a group
	if ($found_hide)
	{
		hide_toggle_color_group($group_id_hide, 'hide');
		$status_message .= $lang['Group_Hidden'];
	}
	if ($found_unhide)
	{
		hide_toggle_color_group($group_id_unhide, 'unhide');
		$status_message .= $lang['Group_Unhidden'];
	}
	
	// Delete a group
	if ($found_delete)
	{
		$sql = 'DELETE FROM ' . COLOR_GROUPS_TABLE . "
			WHERE group_id = $group_id_delete";
		if (!$db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_color_group = 0
			WHERE user_color_group = $group_id_delete";
		if (!$db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Users_Table'], '', __LINE__, __FILE__, $sql);
		$status_message .= $lang['Deleted_Group'];
	}
	
	// Add a group
	if (isset($HTTP_POST_VARS['add_new_group']))
	{
		$invalid_add = false;
		if (empty($HTTP_POST_VARS['new_group_name'])) $invalid_add = true;
		else
		{
			$newGroupName = addslashes($HTTP_POST_VARS['new_group_name']);
			//Check for duplicate name
			$sql = 'SELECT group_name FROM ' . COLOR_GROUPS_TABLE . "
			WHERE group_name = '" . $newGroupName . "'";
			if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
			$group_row = $db->sql_fetchrow($result);
			if ($group_row['group_name'] == $HTTP_POST_VARS['new_group_name']) $invalid_add = true;
		}
		// Don't try to add it if it is invalid!
		if ($invalid_add)
		{
			$status_message .= sprintf($lang['Invalid_Group_Add'], $HTTP_POST_VARS['new_group_name']);
		}
		else
		{
			//Insert it
			$changeColor = addslashes($HTTP_POST_VARS['new_group_color']);
			$changeName = addslashes($HTTP_POST_VARS['new_group_name']);
			do_fast_query_nivisec(
			'INSERT INTO ' . COLOR_GROUPS_TABLE . "
			 	(order_num, group_name, group_color) VALUES 
				($next_order_num, '" . $changeName . "', '" . $changeColor . "')",
			
			$lang['Error_Group_Table']
			);
			$next_order_num++;
		}
		
		
	}
	if ($action == 'switch')
	{
		swap_color_group_order_num($switch1, $switch2);
		$status_message .= $lang['Moved_Group'];
	}
	
	$page_title = $lang['Manage_Color_Groups'];
	$page_desc = $lang['Manage_Color_Groups_Desc'];
	$template->set_filenames(array('body' => 'admin/color_groups_manager.tpl'));
	//Make color name sample
	$color_html = $lang['Color_List'];
	foreach(explode(",", RGB_COLOR_LIST) as $val)
	{
		$val = trim($val);
		$color_html .= "&nbsp;&nbsp;<font color=\"$val\">$val</font>";
	}
	
	//Setup Group Lists
	do_query_nivisec(
	'SELECT * FROM ' . COLOR_GROUPS_TABLE . '
		ORDER BY order_num ASC',
	$result_list,
	$lang['Error_Group_Table']
	);
	for ($i = 0; $i < count($result_list); $i++)
	{
		$empty = false;
		$template->assign_block_vars('grouprow', array(
		'ID' => $result_list[$i]['group_id'],
		'HIDE' => ($result_list[$i]['hidden']) ? 'unhide_group_'.$result_list[$i]['group_id'] : 'hide_group_'.$result_list[$i]['group_id'],
		'L_HIDE' => ($result_list[$i]['hidden']) ? $lang['Un-hide'] : $lang['Hide'],
		'MOVE_UP' => ($result_list[$i]['order_num'] > $order_num_min) ? '<a href="'.append_sid($filename.'?action=switch&amp;switch1='.$result_list[$i]['group_id'].'&amp;switch2='.$result_list[$i-1]['group_id']).'">'.$lang['Move_Up'].'</a>' : '',
		'MOVE_DOWN' => ($result_list[$i]['order_num'] < $order_num_max) ? '<a href="'.append_sid($filename.'?action=switch&amp;switch1='.$result_list[$i]['group_id'].'&amp;switch2='.$result_list[$i+1]['group_id']).'">'.$lang['Move_Down'].'</a>' : '',
		'NAME' => stripslashes($result_list[$i]['group_name']),
		'COUNT' => count_users_in_color_group($result_list[$i]['group_id']),
		'COLOR' => stripslashes($result_list[$i]['group_color']),
		'STATUS' => (check_font_color_nivisec($result_list[$i]['group_color'])) ? $lang['Color_Ok'] : $lang['Error_Font_Color']
		));
	}
	
	if(!isset($empty))
	{
		$template->assign_block_vars('emptyswitch', array());
	}
	
}
//Common Variables
$template->assign_vars(array(
	'S_ACTION' => append_sid(basename(__FILE__)),
	'S_MODE' => $mode,
	'L_USERS_LIST' => $lang['Users_List'],
	'L_GROUPS_LIST' => $lang['Groups_List'],
	'L_LIST_INFO' => $lang['List_Info'],
	'HTML_COLOR_LIST' => $color_html,
	'L_ADD_NEW_GROUP' => $lang['Add_New_Group'],
	'L_COLOR' => $lang['Color'],
	'L_USER_COUNT' => $lang['User_Count'],
	'L_STATUS' => $lang['Status'],
	'L_GROUP_NAME' => $lang['Group_Name'],
	'L_NO_GROUPS' => $lang['No_Groups_Exist'],
	'L_UPDATE' => $lang['Update'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],
	'L_EXAMPLE' => $lang['Example'],
	'L_DEFINE_USERS' => $lang['Define_Users'],
	'L_DELETE' => $lang['Delete'],
	'L_COLORS' => $lang['Colors'],
	'L_USER_LEVELS' => $lang['User_Levels'],
	'L_USER_LIST' => $lang['User_List'],
	'L_ADD' => $lang['Add_Arrow'],
	'L_VERSION' => $lang['Version'],
	'L_PAGE_NAME' => $page_title,
	'L_PAGE_DESC' => $page_desc,
	'L_MOVE_UP' => $lang['Move_Up'],
	'L_MOVE_DOWN' => $lang['Move_Down'],
	'L_NO_GROUP_LIST' => $lang['Unassigned_User_List'],
	'L_GROUPED_LIST' => $lang['Assigned_User_List'],
	'VERSION' => MOD_VERSION,
));

if (!empty($status_message))
{
	$template->assign_block_vars('statusrow', array());
	$template->assign_vars(array(
		'L_STATUS' => $lang['Status'],
		'STATUS_TIME' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
		'I_STATUS_MESSAGE' => $status_message)
	);
}

$template->pparse('body');
copyright_nivisec($lang['Color_Groups'], '2007');
include('page_footer_admin.'.$phpEx);

?>