<?php
/***************************************************************************
*  admin_auto_delete_users.php
***************************************************************************/

define('IN_PHPBB', true);

if(!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Users']['Auto_delete_users'] = $filename;
	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

define('DISABLE_VERSION_CHECK', false);
define('MOD_VERSION', '1.10');
define('MOD_CODE', 16);

/****************************************************************************
/** Admin CP Module
/***************************************************************************/

/****************************************************************************
/** Constants, Main Vars, Includes
/***************************************************************************/
include($phpbb_root_path . 'includes/functions_admin_auto_delete_users.' . $phpEx);
$page_title = $lang['User_Auto_Delete'];
$status_message = '';

/****************************************************************************
/** Check for language file
/***************************************************************************/
$language_file = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_auto_delete_users.' . $phpEx;
if (!file_exists($language_file))
{
	$language_file = str_replace($board_config['default_lang'], 'english', $language_file);
}
include($language_file);

if (count($HTTP_POST_VARS))
{
	/*******************************************************************************************
	/** Check for updated items
	/******************************************************************************************/
	foreach($HTTP_POST_VARS as $key => $val)
	{
		if (substr_count($key, 'update_id_'))
		{
			$update_name = substr($key, 10);
			
			if($board_config[$update_name] != $val)
			{
				$sql = 'UPDATE ' . CONFIG_TABLE . "
					   SET config_value = '$val'
					   WHERE config_name = '$update_name'";
				
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Config_Table_Error'], '', __LINE__, __FILE__, $sql);
				}
				else
				{
					$disp_text = (isset($lang[$update_name])) ? $lang[$update_name] : $update_name;
					$status_message .= sprintf($lang['Updated_Value'], $disp_text);
					$board_config[$update_name] = $val;
				}
			}
		}
	}
}

$template->set_filenames(array(
'body' => 'admin/admin_auto_delete_users.tpl')
);

$template->assign_vars(array(
'S_AUTO_DAYS' => $board_config['admin_auto_delete_days'],
'S_AUTO_DAYS_NO_POST' => $board_config['admin_auto_delete_days_no_post'],
'S_AUTO_DAYS_INACTIVE' => $board_config['admin_auto_delete_days_inactive'],

'L_INACTIVE' => $lang['admin_auto_delete_inactive'],
'L_INACTIVE_DESC' => $lang['DESC_admin_auto_delete_inactive'],
'S_INACTIVE_Y' => ($board_config['admin_auto_delete_inactive']) ? 'checked="checked"' : '',
'S_INACTIVE_N' => (!$board_config['admin_auto_delete_inactive']) ? 'checked="checked"' : '',

'L_NON_VISIT' => $lang['admin_auto_delete_non_visit'],
'L_NON_VISIT_DESC' => $lang['DESC_admin_auto_delete_non_visit'],
'S_NON_VISIT_Y' => ($board_config['admin_auto_delete_non_visit']) ? 'checked="checked"' : '',
'S_NON_VISIT_N' => (!$board_config['admin_auto_delete_non_visit']) ? 'checked="checked"' : '',

'L_NO_POST' => $lang['admin_auto_delete_no_post'],
'L_NO_POST_DESC' => $lang['DESC_admin_auto_delete_no_post'],
'S_NO_POST_Y' => ($board_config['admin_auto_delete_no_post']) ? 'checked="checked"' : '',
'S_NO_POST_N' => (!$board_config['admin_auto_delete_no_post']) ? 'checked="checked"' : '',

'L_AUTO_TOTAL' => $lang['admin_auto_delete_total'],
'L_AUTO_TOTAL_DESC' => $lang['DESC_admin_auto_delete_total'],
'S_AUTO_TOTAL' => $board_config['admin_auto_delete_total'],

'L_AUTO_MINS' => $lang['admin_auto_delete_minutes'],
'L_AUTO_MINS_DESC' => $lang['DESC_admin_auto_delete_minutes'],
'S_AUTO_MINS' => $board_config['admin_auto_delete_minutes'],

'FAKE_DELETE_TEXT' => (FAKE_DELETE) ? $lang['Fake_Delete'] : '',
'DEBUG_TEXT' => (DEBUG_THIS_MOD) ? $lang['Debug_Enabled'] : '',

'PHPEX' => $phpEx,
'FILENAME' => append_sid(basename(__FILE__)),
'L_PAGE_NAME' => $lang['User_Auto_Delete'],
'L_PAGE_DESC' => $lang['Page_Desc'],

'L_YES' => $lang['Yes'],
'L_NO' => $lang['No'],
'L_SUBMIT' => $lang['Submit'],
'L_RESET' => $lang['Reset'],
'L_ENABLED' => $lang['Enabled'],
'L_AUTO_DAYS' => $lang['Auto_Days'],

'L_VERSION' => 'Version',
'VERSION' => MOD_VERSION,

));

if ($status_message != '')
{
	$template->assign_block_vars('statusrow', array());
	$template->assign_vars(array(
	'L_STATUS' => $lang['Status'],
	'I_STATUS_MESSAGE' => $status_message)
	);
}

/************************************************************************
** Begin The Version Check Feature
************************************************************************/
if (file_exists($phpbb_root_path.'nivisec_version_check.'.$phpEx) && !DISABLE_VERSION_CHECK)
{
	include($phpbb_root_path.'nivisec_version_check.'.$phpEx);
}
/************************************************************************
** End The Version Check Feature
************************************************************************/

$template->pparse('body');
include('page_footer_admin.'.$phpEx);
?>