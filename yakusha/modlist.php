<?php
/***************************************************************************
* modlist.php
* yakusha mod listesinin listeleme kýsmý
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_MODLIST);
init_userprefs($userdata);

include($phpbb_root_path.'includes/functions_hacks_list.'.$phpEx);
include($phpbb_root_path.'language/lang_'.$board_config['default_lang'].'/lang_admin_hacks_list.'.$phpEx);

setup_hacks_list_array();
scan_hl_files();

if ( isset($HTTP_POST_VARS['hack_name']) )
{
	$hack_name = htmlspecialchars(trim($HTTP_POST_VARS['hack_name']));
}
else
{
	$hack_name = '';
}

if ( isset($HTTP_POST_VARS['mode']) )
{
	$mode = htmlspecialchars(trim($HTTP_POST_VARS['mode']));
}
else
{
	$mode = '';
}


if(isset($HTTP_POST_VARS['order']))
{
	$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'ASC';
}

switch( $mode )
{
	case 'hack_name':
	$mode = "hack_name";
	break;

	case 'hack_desc':
	$mode = "hack_desc";
	break;

	case 'hack_author':
	$mode = "hack_author";
	break;

	case 'hack_author_email':
	$mode = "hack_author_email";
	break;

	case 'hack_author_website':
	$mode = "hack_author_website";
	break;

	default:
	$mode = "hack_name";
	break;
}

//
// Modlist sorting
//
$mode_types_text = array($lang['Hack_Name'], $lang['Description'], $lang['Author'], $lang['Author_Email'],	$lang['Website']);
$mode_types = array('hack_name', 'hack_desc', 'hack_author', 'hack_author_email', 'hack_author_website');

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

// Generate page
$page_title = $lang['Hacks_List'];
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("modlist.php").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'modlist.tpl')
);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_PAGE_TITLE' => $page_title,
	'L_HACK_NAME' => $lang['Hack_Name'],
	'L_HACK_AUTHOR' => $lang['Author'],
	'L_HACK_DESC' => $lang['Description'],
	'L_HACK_WEB' => $lang['Website'],
	'L_SORT' => $lang['Sort'],
	'L_SUBMIT' => $lang['Sort'],
	'L_LOOK_UP' => $lang['Look_up_hack'],
	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_MODE_ACTION' => append_sid("modlist.$phpEx"))
);


//admin ve modlar için gizli modlar da gösteriliyor
$hide = '';
if ($userdata['user_level'] == MOD or $userdata['user_level'] == ADMIN)
{
	$hide = '';
}
else
{
	$hide = " AND hack_hide = 'No'";
}

if ( $hack_name && isset($HTTP_POST_VARS['submituser']) )
{
	$sql = "SELECT * FROM " . HACKS_LIST_TABLE . "
	WHERE (" . $mode . " like \"%$hack_name%\")" . $hide . " order by " . $mode;

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Sorgu Çalýþtýrýlamadý', '', __LINE__, __FILE__, $sql);
	}
}
else
{
	$sql = "SELECT * FROM " . HACKS_LIST_TABLE . " WHERE hack_id > 0 $hide ORDER BY $mode $sort_order ";
	
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Sorgu Çalýþtýrýlamadý', '', __LINE__, __FILE__, $sql);
	}
}

// echo $sql;

if ( $row = $db->sql_fetchrow($result) )
{
	$i = 1;
	do
	{
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	
		$template->assign_block_vars('modlistrow', array(
			'ROW_NUMBER' => +$i,
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'HACK_ID' => $row['hack_id'],
			'HACK_AUTHOR' => ($row['hack_author_email'] != '') ? ((USE_CRYPTIC_EMAIL) ? stripslashes($row['hack_author']) . ' - ' . cryptize_hl_email(stripslashes($row['hack_author_email'])) : '<a href="mailto:' . stripslashes($row['hack_author_email']) . '">' . stripslashes($row['hack_author']) . '</a>') : stripslashes($row['hack_author']),
			'HACK_WEBSITE' => ($row['hack_author_website'] != '') ? '<a href="' . stripslashes($row['hack_author_website']) . '" target="author_web">' . stripslashes($row['hack_author_website']) . '</a>' : $lang['No_Website'],
			'HACK_NAME' => ($row['hack_download_url'] != '') ? '<a href="' . stripslashes($row['hack_download_url']) . '" target="hack_web">' . stripslashes($row['hack_name']) . '</a>' : stripslashes($row['hack_name']),
			'HACK_DESC' => stripslashes($row['hack_desc']),
			'HACK_VERSION' => ($row['hack_version'] != '') ? ' v' . stripslashes($row['hack_version']) : '',
			'YIM' => $yim));
		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
		$db->sql_freeresult($result);
	}
else
{
	$template->assign_block_vars('no_username', array(
		'NO_USER_ID_SPECIFIED' => $lang['Mod_no_found'] )
	);
}

$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>