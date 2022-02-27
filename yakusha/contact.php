<?php
/* * * * * * * * * * * * * * * * * * * * *
* Filename: contact.php
* * * * * * * * * * * * * * * * * * * * */

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_CONTACT);
init_userprefs($userdata);

$board_contact_lang = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_board_contact.'.$phpEx;
if( !@file_exists($board_contact_lang) )
{
	$board_contact_lang = $phpbb_root_path . 'language/lang_english/lang_board_contact.'.$phpEx;
}
include($board_contact_lang);

$page_title = $lang['contact_title'];
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("contact.php").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

if ( !empty($HTTP_POST_VARS['submit']) )
{
	$contact = array();
	$error = false;

	// Check their name
	if ( !empty($HTTP_POST_VARS['name']) )
	{
		$contact['name'] = trim(stripslashes($HTTP_POST_VARS['name']));
	}
	else
	{
		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['contact_no_name'] : $lang['contact_no_name'];
	}
	// Check their email
	if ( !empty($HTTP_POST_VARS['email']) )
	{
		if (preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $HTTP_POST_VARS['email']))
		{
			$contact['email'] = trim(stripslashes($HTTP_POST_VARS['email']));
		}
		else
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['contact_invalid_email'] : $lang['contact_invalid_email'];
		}
	}
	else
	{
		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['contact_no_email'] : $lang['contact_no_email'];
	}
	// Check their message
	if ( !empty($HTTP_POST_VARS['message']) )
	{
		$contact['message'] = trim(stripslashes($HTTP_POST_VARS['message']));
	}
	else
	{
		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['contact_no_message'] : $lang['contact_no_message'];
	}
	$contact['urgency'] = trim(stripslashes($HTTP_POST_VARS['urgency']));
	$contact['subject'] = trim(stripslashes($HTTP_POST_VARS['subject']));

	if (!$error)
	{
		include($phpbb_root_path . 'includes/emailer.'.$phpEx);
		$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
		$server_name = trim($board_config['server_name']);
		$page_name = (isset($HTTP_SERVER_VARS['PHP_SELF'])) ? $HTTP_SERVER_VARS['PHP_SELF'] : '';
		$contact['link'] = $server_protocol . $server_name . $page_name;
		
		// Email them
		$emailer = new emailer($board_config['smtp_delivery']);
		$emailer->from($contact['email']);
		$emailer->replyto($contact['email']);
		
		$email_headers = 'X-AntiAbuse: Board servername - ' . $server_name . "\n";
		$email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n";
		
		$emailer->use_template('contact_board_email', $user_lang);
		$emailer->email_address($board_config['board_email']);
		$emailer->set_subject($contact['urgency'] . ': ' . $contact['subject']);
		$emailer->extra_headers($email_headers);
		
		$emailer->assign_vars(array(
			'BOARD_ADMIN' => $board_config['board_email'],
			'FROM_NAME' => $contact['name'],
			'LINK' => $contact['link'],
			'FROM_EMAIL' => $contact['email'],
			'FROM_IP' => decode_ip($user_ip),
			'MESSAGE' => $contact['message'])
		);

		$emailer->send();
		$emailer->reset();

		// Print output
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid("index.$phpEx") . '">')
		);
		$message = $lang['contact_sent'] . '<br /><br />' . sprintf($lang['Click_return_index'],	'<a href="' . append_sid("index.$phpEx") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		$template->set_filenames(array(
			'contact_header' => 'error_body.tpl')
		);
	
		$template->assign_vars(array(
			'ERROR_MESSAGE' => $error_msg)
		);
	
		$template->assign_var_from_handle('ERROR_BOX', 'contact_header');
		$template->pparse('contact_header');
	}
}//end !empty($HTTP_POST_VARS['submit'])

// Default page view
$subject = '<select name="subject" style="width: 260px;">';
$subject .= '<option value="' . $lang['contact_subject_question'] . '">' . $lang['contact_subject_question'] . '</option>';
$subject .= '<option value="' . $lang['contact_subject_request'] . '">' . $lang['contact_subject_request'] . '</option>';
$subject .= '<option value="' . $lang['contact_subject_suggest'] . '">' . $lang['contact_subject_suggest'] . '</option>';
$subject .= '<option value="' . $lang['contact_subject_trouble'] . '">' . $lang['contact_subject_trouble'] . '</option>';
$subject .= '<option value="' . $lang['contact_subject_other'] . '">' . $lang['contact_subject_other'] . '</option>';
$subject .= '</select>';

$urgency = '<select name="urgency" style="width: 260px;">';
$urgency .= '<option value="' . $lang['contact_urgency_four'] . '">' . $lang['contact_urgency_four'] . '</option>';
$urgency .= '<option value="' . $lang['contact_urgency_three'] . '">' . $lang['contact_urgency_three'] . '</option>';
$urgency .= '<option value="' . $lang['contact_urgency_two'] . '">' . $lang['contact_urgency_two'] . '</option>';
$urgency .= '<option value="' . $lang['contact_urgency_one'] . '">' . $lang['contact_urgency_one'] . '</option>';
$urgency .= '</select>';

$template->set_filenames(array(
	'body' => 'contact_body.tpl')
);

$template->assign_vars(array(
	'L_HEADER' => $lang['contact_title'],
	'L_ABOUT' => $lang['contact_about'],
	'L_EMAIL_SETTINGS' => $lang['contact_settings'],
	'L_EMAIL_CONTENT' => $lang['contact_content'],
	'L_ITEMS_IMPORTANT' => $lang['contact_important'],
	'L_ITEMS_VIEWED' => $lang['contact_viewed'],
	'L_NAME' => $lang['contact_name'],
	'L_NAME_EXPLAIN' => $lang['contact_name_explain'],
	'L_EMAIL' => $lang['contact_email'],
	'L_EMAIL_EXPLAIN' => $lang['contact_email_explain'],
	'L_URGENCY' => $lang['contact_urgency'],
	'L_URGENCY_EXPLAIN' => $lang['contact_urgency_explain'],
	'URGENCY' => $urgency,
	'L_SUBJECT' => $lang['contact_subject'],
	'SUBJECT' => $subject,
	'L_MESSAGE' => $lang['contact_message'],
	'L_MESSAGE_EXPLAIN' => $lang['contact_message_explain'],
	'L_CONTACT' => $lang['contact_by'],
	'L_POSTED_NAME' => $contact['name'],
	'L_POSTED_EMAIL' => $contact['email'],
	'L_POSTED_MESSAGE' => $contact['message'],
	'U_CONTACT_ACTION' => append_sid("contact.$phpEx"))
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>