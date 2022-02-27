<?php
/****************************************************************************
* ctracker_login.php
****************************************************************************/
// CTracker_Ignore: File checked by human

define('IN_LOGIN', true);
define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_UU);
init_userprefs($userdata);

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
	$sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}

// Get URL vars
$mode	= $HTTP_GET_VARS['mode'];
$user_id = $HTTP_GET_VARS['uid'];


// Ensure that a user is not logged in
if ( $userdata['session_logged_in'] )
{
	message_die(GENERAL_MESSAGE, $lang['ctracker_login_logged']);
}


// Include the page_header
$page_title = $lang['ctracker_login_title'];
include($phpbb_root_path . 'includes/page_header.' . $phpEx);


// Define the Template for this file
$template->set_filenames(array(
	'body' => '../ctracker/ctracker_login.tpl')
);

// Include Visual Confirmation System
if ( $ctracker_config->settings['loginfeature'] == 1 )
{
	define('CRACKER_TRACKER_VCONFIRM', true);
	define('CTRACKER_ACCOUNT_FREE', true);

	include_once( $phpbb_root_path . 'ctracker/engines/ct_visual_confirm.' . $phpEx );
}

// Send some vars to the template
$template->assign_vars(array(
	'CONFIRM_IMAGE'	=> $confirm_image,
	'PAGE_ICON'	=> $images['ctracker_key_icon'],
	'PI_ICON'	=> $images['ctracker_easter_egg'],
	'S_FORM_ACTION'	=> append_sid( 'ctracker_login.' . $phpEx . '?mode=check&uid=' . $user_id ),
	'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
	'L_HEADER_TEXT'	=> $lang['ctracker_login_title'],
	'L_DESCRIPTION'	=> $lang['ctracker_login_confim'],
	'L_BUTTON_TEXT'	=> $lang['ctracker_login_button'])
);

// Generate the page
$template->pparse('body');

// Include the page_tail.php file
include($phpbb_root_path . 'includes/page_tail.' . $phpEx);

?>