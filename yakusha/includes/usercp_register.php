<?php
/***************************************************************************
* usercp_register.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
	exit;
}

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');
$registration_hash = md5($userdata['session_ip'] . $userdata['session_id']);

include_once($phpbb_root_path . 'ctracker/classes/class_ct_userfunctions.' . $phpEx);
$profile_security = new ct_userfunctions();
$profile_security->handle_profile();
(isset($HTTP_POST_VARS['submit']))? $profile_security->password_functions() : null;

// ---------------------------------------
// Load agreement template since user has not yet
// agreed to registration conditions/coppa
//

// BEGIN Disable Registration MOD
if( $board_config['registration_status'] && !$userdata['session_logged_in'] )
{
	if( $board_config['registration_closed'] == '' )
	{
		message_die(GENERAL_MESSAGE, 'registration_status', 'Information');
	}
	else
	{
		message_die(GENERAL_MESSAGE, $board_config['registration_closed'], 'Information'); 
	}  
}
// END Disable Registration MOD

function show_coppa()
{
	global $userdata, $template, $lang, $phpbb_root_path, $phpEx, $registration_hash ;

	$template->set_filenames(array('body' => 'agreement.tpl'));

	$template->assign_vars(array(
		'REGISTRATION' => $lang['Registration'],
		'AGREEMENT' => $lang['Reg_agreement'],
		'AGREEMENT_RULES' => $lang['Reg_agreement_Rules'],
		'AGREE_TRUE' => $lang['Agree_true'],
		'U_AGREE' => append_sid("profile.$phpEx?mode=register&amp;agreed=$registration_hash"),
		'DO_NOT_AGREE' => $lang['Agree_not'],
		'AGREE_HASH' => $registration_hash,
		'TO_JOIN' => $lang['To_Join'],
		'S_AGREE' => append_sid("profile.$phpEx?mode=register"))
	);

	$template->pparse('body');

}
//
// ---------------------------------------

$error = FALSE;
$error_msg = '';
$page_title = ( $mode == 'editprofile' ) ? $lang['Edit_profile'] : $lang['Register'];

if ( $mode == 'register' && $HTTP_POST_VARS['agreed'] != $registration_hash && $HTTP_GET_VARS['agreed'] != $registration_hash )
{
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	show_coppa();

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}

$coppa = ( empty($HTTP_POST_VARS['coppa']) && empty($HTTP_GET_VARS['coppa']) ) ? 0 : TRUE;

//
// Check and initialize some variables if needed
//
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
if (
	isset($HTTP_POST_VARS['submit']) ||
	isset($HTTP_POST_VARS['avatargallery']) ||
	isset($HTTP_POST_VARS['submitavatar']) ||
	isset($HTTP_POST_VARS['cancelavatar']) ||
	$mode == 'register' )
{
	include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);
	include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

	if ( $mode == 'editprofile' )
	{
		$user_id = intval($HTTP_POST_VARS['user_id']);
		$current_email = trim(htmlspecialchars($HTTP_POST_VARS['current_email']));
	}

	$strip_var_list = array('email' => 'email', 'icq' => 'icq', 'aim' => 'aim', 'msn' => 'msn', 'yim' => 'yim', 'website' => 'website', 'location' => 'location', 'occupation' => 'occupation', 'interests' => 'interests', 'confirm_code' => 'confirm_code');

	// Strip all tags from data ... may p**s some people off, bah, strip_tags is
	// doing the job but can still break HTML output ... have no choice, have
	// to use htmlspecialchars ... be prepared to be moaned at.
	while( list($var, $param) = @each($strip_var_list) )
	{
		if ( !empty($HTTP_POST_VARS[$param]) )
		{
			$$var = trim(htmlspecialchars($HTTP_POST_VARS[$param]));
		}
	}

	$username = ( !empty($HTTP_POST_VARS['username']) ) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';

	$trim_var_list = array('cur_password' => 'cur_password', 'new_password' => 'new_password', 'password_confirm' => 'password_confirm', 'signature' => 'signature');

	while( list($var, $param) = @each($trim_var_list) )
	{
		if ( !empty($HTTP_POST_VARS[$param]) )
		{
			$$var = trim($HTTP_POST_VARS[$param]);
		}
	}

	$signature = (isset($signature)) ? str_replace('<br />', "\n", $signature) : '';
	$signature_bbcode_uid = '';

	// Run some validation on the optional fields. These are pass-by-ref, so they'll be changed to
	// empty strings if they fail.
	validate_optional_fields($icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature);

	$viewemail = ( isset($HTTP_POST_VARS['viewemail']) ) ? ( ($HTTP_POST_VARS['viewemail']) ? TRUE : 0 ) : 0;
	$allowviewonline = ( isset($HTTP_POST_VARS['hideonline']) ) ? ( ($HTTP_POST_VARS['hideonline']) ? 0 : TRUE ) : TRUE;
	$notifyreply = ( isset($HTTP_POST_VARS['notifyreply']) ) ? ( ($HTTP_POST_VARS['notifyreply']) ? TRUE : 0 ) : TRUE;
	$notifypm = ( isset($HTTP_POST_VARS['notifypm']) ) ? ( ($HTTP_POST_VARS['notifypm']) ? TRUE : 0 ) : TRUE;
	$popup_pm = ( isset($HTTP_POST_VARS['popup_pm']) ) ? ( ($HTTP_POST_VARS['popup_pm']) ? TRUE : 0 ) : TRUE;
	$sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : 0;

	if ( $mode == 'register' )
	{
		$attachsig = ( isset($HTTP_POST_VARS['attachsig']) ) ? ( ($HTTP_POST_VARS['attachsig']) ? TRUE : 0 ) : $board_config['allow_sig'];

		$allowhtml = ( isset($HTTP_POST_VARS['allowhtml']) ) ? ( ($HTTP_POST_VARS['allowhtml']) ? TRUE : 0 ) : $board_config['allow_html'];
		$allowbbcode = ( isset($HTTP_POST_VARS['allowbbcode']) ) ? ( ($HTTP_POST_VARS['allowbbcode']) ? TRUE : 0 ) : $board_config['allow_bbcode'];
		$allowsmilies = ( isset($HTTP_POST_VARS['allowsmilies']) ) ? ( ($HTTP_POST_VARS['allowsmilies']) ? TRUE : 0 ) : $board_config['allow_smilies'];

		$mail_on_topic_moved = ( isset($HTTP_POST_VARS['topic_moved_mail']) ) ? ( ($HTTP_POST_VARS['topic_moved_mail']) ? TRUE : 0 ) : $userdata['user_topic_moved_mail'];
		$pm_on_topic_moved = ( isset($HTTP_POST_VARS['topic_moved_pm']) ) ? ( ($HTTP_POST_VARS['topic_moved_pm']) ? TRUE : 0 ) : $userdata['user_topic_moved_pm'];
		$pm_on_topic_moved_notify = ( isset($HTTP_POST_VARS['topic_moved_pm_notify']) ) ? ( ($HTTP_POST_VARS['topic_moved_pm_notify']) ? TRUE : 0 ) : $userdata['user_topic_moved_pm_notify'];
	}
	else
	{
		$attachsig = ( isset($HTTP_POST_VARS['attachsig']) ) ? ( ($HTTP_POST_VARS['attachsig']) ? TRUE : 0 ) : $userdata['user_attachsig'];

		$allowhtml = ( isset($HTTP_POST_VARS['allowhtml']) ) ? ( ($HTTP_POST_VARS['allowhtml']) ? TRUE : 0 ) : $userdata['user_allowhtml'];
		$allowbbcode = ( isset($HTTP_POST_VARS['allowbbcode']) ) ? ( ($HTTP_POST_VARS['allowbbcode']) ? TRUE : 0 ) : $userdata['user_allowbbcode'];
		$allowsmilies = ( isset($HTTP_POST_VARS['allowsmilies']) ) ? ( ($HTTP_POST_VARS['allowsmilies']) ? TRUE : 0 ) : $userdata['user_allowsmile'];

	}

	$user_style = ( isset($HTTP_POST_VARS['style']) ) ? intval($HTTP_POST_VARS['style']) : $board_config['default_style'];

	if ( !empty($HTTP_POST_VARS['language']) )
	{
		if ( preg_match('/^[a-z_]+$/i', $HTTP_POST_VARS['language']) )
		{
			$user_lang = htmlspecialchars($HTTP_POST_VARS['language']);
		}
		else
		{
			$error = true;
			$error_msg = $lang['Fields_empty'];
		}
	}
	else
	{
		$user_lang = $board_config['default_lang'];
	}

	$user_timezone = ( isset($HTTP_POST_VARS['timezone']) ) ? doubleval($HTTP_POST_VARS['timezone']) : $board_config['board_timezone'];

	$sql = "SELECT config_value
		FROM " . CONFIG_TABLE . "
		WHERE config_name = 'default_dateformat'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not select default dateformat', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$board_config['default_dateformat'] = $row['config_value'];
	$user_dateformat = ( !empty($HTTP_POST_VARS['dateformat']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['dateformat'])) : $board_config['default_dateformat'];

	$user_avatar_local = ( isset($HTTP_POST_VARS['avatarselect']) && !empty($HTTP_POST_VARS['submitavatar']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($HTTP_POST_VARS['avatarselect']) : ( ( isset($HTTP_POST_VARS['avatarlocal'])  ) ? htmlspecialchars($HTTP_POST_VARS['avatarlocal']) : '' );
	$user_avatar_category = ( isset($HTTP_POST_VARS['avatarcatname']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($HTTP_POST_VARS['avatarcatname']) : '' ;

	$user_avatar_remoteurl = ( !empty($HTTP_POST_VARS['avatarremoteurl']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['avatarremoteurl'])) : '';
	$user_avatar_upload = ( !empty($HTTP_POST_VARS['avatarurl']) ) ? trim($HTTP_POST_VARS['avatarurl']) : ( ( $HTTP_POST_FILES['avatar']['tmp_name'] != "none") ? $HTTP_POST_FILES['avatar']['tmp_name'] : '' );
	$user_avatar_name = ( !empty($HTTP_POST_FILES['avatar']['name']) ) ? $HTTP_POST_FILES['avatar']['name'] : '';
	$user_avatar_size = ( !empty($HTTP_POST_FILES['avatar']['size']) ) ? $HTTP_POST_FILES['avatar']['size'] : 0;
	$user_avatar_filetype = ( !empty($HTTP_POST_FILES['avatar']['type']) ) ? $HTTP_POST_FILES['avatar']['type'] : '';

	$user_avatar = ( empty($user_avatar_local) && $mode == 'editprofile' ) ? $userdata['user_avatar'] : '';
	$user_avatar_type = ( empty($user_avatar_local) && $mode == 'editprofile' ) ? $userdata['user_avatar_type'] : '';

	if ( (isset($HTTP_POST_VARS['avatargallery']) || isset($HTTP_POST_VARS['submitavatar']) || isset($HTTP_POST_VARS['cancelavatar'])) && (!isset($HTTP_POST_VARS['submit'])) )
	{
		$username = stripslashes($username);
		$email = stripslashes($email);
		$cur_password = htmlspecialchars(stripslashes($cur_password));
		$new_password = htmlspecialchars(stripslashes($new_password));
		$password_confirm = htmlspecialchars(stripslashes($password_confirm));

		$icq = stripslashes($icq);
		$aim = stripslashes($aim);
		$msn = stripslashes($msn);
		$yim = stripslashes($yim);

		$website = stripslashes($website);
		$location = stripslashes($location);
		$occupation = stripslashes($occupation);
		$interests = stripslashes($interests);
		$signature = htmlspecialchars(stripslashes($signature));

		$user_lang = stripslashes($user_lang);
		$user_dateformat = stripslashes($user_dateformat);

		if ( !isset($HTTP_POST_VARS['cancelavatar']))
		{
			$user_avatar = $user_avatar_category . '/' . $user_avatar_local;
			$user_avatar_type = USER_AVATAR_GALLERY;
		}
	}
}

//
// Let's make sure the user isn't logged in while registering,
// and ensure that they were trying to register a second time
// (Prevents double registrations)
//
if ($mode == 'register' && ($userdata['session_logged_in'] || $username == $userdata['username']))
{
	message_die(GENERAL_MESSAGE, $lang['Username_taken'], '', __LINE__, __FILE__);
}

//
// Did the user submit? In this case build a query to update the users profile in the DB
//
if ( isset($HTTP_POST_VARS['submit']) )
{
	include($phpbb_root_path . 'includes/usercp_avatar.'.$phpEx);

	$passwd_sql = '';
	if ( $mode == 'editprofile' )
	{
		if ( $user_id != $userdata['user_id'] )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Wrong_Profile'];
		}
	}
	else if ( $mode == 'register' )
	{
		if ( empty($username) || empty($new_password) || empty($password_confirm) || empty($email) )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
		}
	}

	if ($board_config['enable_confirm'] && $mode == 'register')
	{
		if (empty($HTTP_POST_VARS['confirm_id']))
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
		}
		else
		{
			$confirm_id = htmlspecialchars($HTTP_POST_VARS['confirm_id']);
			if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
			{
				$confirm_id = '';
			}
			
			$sql = 'SELECT code
				FROM ' . CONFIRM_TABLE . " 
				WHERE confirm_id = '$confirm_id' 
					AND session_id = '" . $userdata['session_id'] . "'";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain confirmation code', '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{

				if ($row['code'] != $confirm_code)
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
				}
				else
				{
					$sql = 'DELETE FROM ' . CONFIRM_TABLE . " 
						WHERE confirm_id = '$confirm_id' 
							AND session_id = '" . $userdata['session_id'] . "'";
					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not delete confirmation code', '', __LINE__, __FILE__, $sql);
					}
				}
			}
			else
			{		
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
			}
			$db->sql_freeresult($result);
		}
	}

	$passwd_sql = '';
	if ( !empty($new_password) && !empty($password_confirm) )
	{
		if ( $new_password != $password_confirm )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}
		else if ( $new_password==$username )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Pass_uname_match'];
		}

		else if ( strlen($new_password) > 32 )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_long'];
		}
		else
		{
			if ( $mode == 'editprofile' )
			{
				$sql = "SELECT user_password
					FROM " . USERS_TABLE . "
					WHERE user_id = $user_id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);

				if ( $row['user_password'] != md5($cur_password) )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
				}
			}

			if ( !$error )
			{
				$profile_security->pw_create_date($user_id);
				$new_password = md5($new_password);
				$passwd_sql = "user_password = '$new_password', ";
			}
		}
	}
	else if ( ( empty($new_password) && !empty($password_confirm) ) || ( !empty($new_password) && empty($password_confirm) ) )
	{
		$error = TRUE;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
	}

	//
	// Do a ban check on this email address
	//
	if ( $email != $userdata['user_email'] || $mode == 'register' )
	{
		$result = validate_email($email);
		if ( $result['error'] )
		{
			$email = $userdata['user_email'];

			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
		}

		if ( $mode == 'editprofile' )
		{
			$sql = "SELECT user_password
				FROM " . USERS_TABLE . "
				WHERE user_id = $user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);

			if ( $row['user_password'] != md5($cur_password) )
			{
				$email = $userdata['user_email'];

				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
			}
		}
	}

	$username_sql = '';
	if ( $board_config['allow_namechange'] || $mode == 'register' )
	{
		if ( empty($username) )
		{
			// Error is already triggered, since one field is empty.
			$error = TRUE;
		}
		else if ( $username != $userdata['username'] || $mode == 'register')
		{
			if (strtolower($username) != strtolower($userdata['username']) || $mode == 'register')
			{
				$result = validate_username($username);
				if ( $result['error'] )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
				}
			}

			if (!$error)
			{
				$username_sql = "username = '" . str_replace("\'", "''", $username) . "', ";
			}
		}
	}

	if ( $signature != '' )
	{
		if ( strlen($signature) > $board_config['max_sig_chars'])
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
		}
		else
		{
			if( preg_match_all("#\[img\]((ht|f)tp://)([^\r\n\t<\"]*?)\[/img\]#sie", $signature, $matches) )
			{
				if( count($matches[0]) > $board_config['sig_images_max_limit'] )
				{
					$error = TRUE;
					$l_too_many_images = ( $board_config['images_max_limit'] == 1 ) ? sprintf($lang['Too_many_sig_image'], $board_config['sig_images_max_limit']) : sprintf($lang['Too_many_sig_images'], $board_config['sig_images_max_limit']);
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $l_too_many_images;
				}
				else
				{
					for( $i = 0; $i < count($matches[0]); $i++ )
					{
						$image = preg_replace("#\[img\](.*)\[/img\]#si", "\\1", $matches[0][$i]);
						list($width, $height) = @getimagesize($image);
						if( $width > $board_config['sig_images_max_width'] || $height > $board_config['sig_images_max_height'] )
						{
							$error = TRUE;
							$l_image_too_large = sprintf($lang['Sig_image_too_large'], $board_config['sig_images_max_width'], $board_config['sig_images_max_height']);
							$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $l_image_too_large;
							break;
						}
					}
				}
			}
		}

		if ( !isset($signature_bbcode_uid) || $signature_bbcode_uid == '' )
		{
			$signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
		}
		$signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);
	}

	if ( $website != '' )
	{
		rawurlencode($website);
	}

	$avatar_sql = '';

	if ( isset($HTTP_POST_VARS['avatardel']) && $mode == 'editprofile' )
	{
		$avatar_sql = user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
	}
	else
	if ( ( !empty($user_avatar_upload) || !empty($user_avatar_name) ) && $board_config['allow_avatar_upload'] )
	{
		if ( !empty($user_avatar_upload) )
		{
			$avatar_mode = (empty($user_avatar_name)) ? 'remote' : 'local';
			$avatar_sql = user_avatar_upload($mode, $avatar_mode, $userdata['user_avatar'], $userdata['user_avatar_type'], $error, $error_msg, $user_avatar_upload, $user_avatar_name, $user_avatar_size, $user_avatar_filetype);
		}
		else if ( !empty($user_avatar_name) )
		{
			$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $l_avatar_size;
		}
	}
	else if ( $user_avatar_remoteurl != '' && $board_config['allow_avatar_remote'] )
	{
		user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
		$avatar_sql = user_avatar_url($mode, $error, $error_msg, $user_avatar_remoteurl);
	}
	else if ( $user_avatar_local != '' && $board_config['allow_avatar_local'] )
	{
		user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
		$avatar_sql = user_avatar_gallery($mode, $error, $error_msg, $user_avatar_local, $user_avatar_category);
	}

	if ( !$error )
	{
		if ( $avatar_sql == '' )
		{
			$avatar_sql = ( $mode == 'editprofile' ) ? '' : "'', " . USER_AVATAR_NONE;
		}

		if ( $mode == 'editprofile' )
		{
			if ( $email != $userdata['user_email'] && $board_config['require_activation'] != USER_ACTIVATION_NONE && $userdata['user_level'] != ADMIN )
			{
				$user_active = 0;

				$user_actkey = gen_rand_string(true);
				$key_len = 54 - ( strlen($server_url) );
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$user_actkey = substr($user_actkey, 0, $key_len);

				if ( $userdata['session_logged_in'] )
				{
					session_end($userdata['session_id'], $userdata['user_id']);
				}
			}
			else
			{
				$user_active = 1;
				$user_actkey = '';
			}

			$sql = "UPDATE " . USERS_TABLE . "
				SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", $email) ."', user_icq = '" . str_replace("\'", "''", $icq) . "', user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" . str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'", "''", $location) . "', user_interests = '" . str_replace("\'", "''", $interests) . "', user_sig = '" . str_replace("\'", "''", $signature) . "', user_sig_bbcode_uid = '$signature_bbcode_uid', user_viewemail = $viewemail, user_aim = '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', user_yim = '" . str_replace("\'", "''", $yim) . "', user_msnm = '" . str_replace("\'", "''", $msn) . "', user_attachsig = '$attachsig', user_allowsmile = $allowsmilies,  user_allowhtml = $allowhtml, user_allowbbcode = $allowbbcode, user_allow_viewonline = $allowviewonline, user_notify = $notifyreply, user_notify_pm = $notifypm, user_popup_pm = $popup_pm, user_timezone = $user_timezone, user_dateformat = '" . str_replace("\'", "''", $user_dateformat) . "', user_lang = '" . str_replace("\'", "''", $user_lang) . "', user_style = $user_style, user_active = $user_active, user_actkey = '" . str_replace("\'", "''", $user_actkey) . "'" . $avatar_sql . "
				WHERE user_id = $user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
			}

			// We remove all stored login keys since the password has been updated
			// and change the current one (if applicable)
			if ( !empty($passwd_sql) )
			{
				session_reset_keys($user_id, $user_ip);
			}
			if ( !$user_active )
			{
				//
				// The users account has been deactivated, send them an email with a new activation key
				//
				include($phpbb_root_path . 'includes/emailer.'.$phpEx);
				$emailer = new emailer($board_config['smtp_delivery']);

 				if ( $board_config['require_activation'] != USER_ACTIVATION_ADMIN )
 				{
 					$emailer->from($board_config['board_email']);
 					$emailer->replyto($board_config['board_email']);
 
 					$emailer->use_template('user_activate', stripslashes($user_lang));
 					$emailer->email_address($email);
 					$emailer->set_subject($lang['Reactivate']);
  
 					$emailer->assign_vars(array(
 						'SITENAME' => $board_config['sitename'],
 						'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
 						'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
 						'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
 					);
 					$emailer->send();
 					$emailer->reset();
 				}
 				else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
 				{
 					$sql = 'SELECT user_email, user_lang 
 						FROM ' . USERS_TABLE . '
 						WHERE user_level = ' . ADMIN;
 					
 					if ( !($result = $db->sql_query($sql)) )
 					{
 						message_die(GENERAL_ERROR, 'Could not select Administrators', '', __LINE__, __FILE__, $sql);
 					}
 					
 					while ($row = $db->sql_fetchrow($result))
 					{
 						$emailer->from($board_config['board_email']);
 						$emailer->replyto($board_config['board_email']);
 						
 						$emailer->email_address(trim($row['user_email']));
 						$emailer->use_template("admin_activate", $row['user_lang']);
 						$emailer->set_subject($lang['Reactivate']);
 
 						$emailer->assign_vars(array(
 							'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
 							'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),
 							'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
 						);
 						$emailer->send();
 						$emailer->reset();
 					}
 					$db->sql_freeresult($result);
 				}

				$message = $lang['Profile_updated_inactive'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

			}
			else
			{
				$message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Profile_see'],  '<a href="' . append_sid('profile.'.$phpEx.'?mode=viewprofile&u='.$userdata['user_id']) . '">', '</a>');
			}

			$template->assign_vars(array(
				"META" => '<meta http-equiv="refresh" content="2;url=' . append_sid("index.$phpEx") . '">')
			);

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$sql = "SELECT MAX(user_id) AS total
				FROM " . USERS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
			}

			if ( !($row = $db->sql_fetchrow($result)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
			}
			$user_id = $row['total'] + 1;

			//
			// Get current date
			//
			$sql = "INSERT INTO " . USERS_TABLE . "	(user_id, username, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_sig_bbcode_uid, user_avatar, user_avatar_type, user_viewemail, user_aim, user_yim, user_msnm, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_timezone, user_dateformat, user_lang, user_style, user_level, user_allow_pm, user_active, user_actkey)
				VALUES ($user_id, '" . str_replace("\'", "''", $username) . "', " . time() . ", '" . str_replace("\'", "''", $new_password) . "', '" . str_replace("\'", "''", $email) . "', '" . str_replace("\'", "''", $icq) . "', '" . str_replace("\'", "''", $website) . "', '" . str_replace("\'", "''", $occupation) . "', '" . str_replace("\'", "''", $location) . "', '" . str_replace("\'", "''", $interests) . "', '" . str_replace("\'", "''", $signature) . "', '$signature_bbcode_uid', $avatar_sql, $viewemail, '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', '" . str_replace("\'", "''", $yim) . "', '" . str_replace("\'", "''", $msn) . "', $attachsig, $allowsmilies, $allowhtml, $allowbbcode, $allowviewonline, $notifyreply, $notifypm, $popup_pm, $user_timezone, '" . str_replace("\'", "''", $user_dateformat) . "', '" . str_replace("\'", "''", $user_lang) . "', $user_style, 0, 1, ";
			if ( $board_config['require_activation'] == USER_ACTIVATION_SELF || $board_config['require_activation'] == USER_ACTIVATION_ADMIN || $coppa )
			{
				$user_actkey = gen_rand_string(true);
				$key_len = 54 - (strlen($server_url));
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$user_actkey = substr($user_actkey, 0, $key_len);
				$sql .= "0, '" . str_replace("\'", "''", $user_actkey) . "')";
			}
			else
			{
				$sql .= "1, '')";
			}

			if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into users table', '', __LINE__, __FILE__, $sql);
			}

			// BEGIN CrackerTracker v5.x
			($mode == 'register')? $profile_security->pw_create_date($user_id) : null;
			($mode == 'register')? $profile_security->reg_done() : null;
			// END CrackerTracker v5.x

			// START - Send PM On User Register
			$sql = "UPDATE " . USERS_TABLE . " SET user_new_privmsg = '1', user_last_privmsg = '65534' WHERE user_id = $user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql); 
			} 
			//
			$register_pm_subject = $lang['register_pm_subject']; 
			$register_pm = $lang['register_pm']; 
			$privmsgs_date = date("U"); 
			//
			$sql = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig) VALUES ('1', '" . str_replace("\'", "''", addslashes(sprintf($register_pm_subject,$board_config['sitename']))) . "', '2', " . $user_id . ", " . $privmsgs_date . ", '0', '1', '1', '0')"; 
			//
			if ( !$db->sql_query($sql) ) 
			{ 
				message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql); 
			}
			//
			$privmsg_sent_id = $db->sql_nextid(); 
			$privmsgs_text = $lang['register_pm_subject']; 
			// 
			$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_text) VALUES ($privmsg_sent_id, '" . str_replace("\'", "''", addslashes(sprintf($register_pm,$username,$board_config['sitename'],$board_config['sitename']))) . "')"; 
			if ( !$db->sql_query($sql) ) 
			{ 
				message_die(GENERAL_ERROR, 'Could not insert private message sent text', '', __LINE__, __FILE__, $sql); 
			}
			// END - Send PM On User Register


			$sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
				VALUES ('', 'Personal User', 1, 0)";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql);
			}

			$group_id = $db->sql_nextid();

			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
				VALUES ($user_id, $group_id, 0)";
			if( !($result = $db->sql_query($sql, END_TRANSACTION)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql);
			}

			if ( $coppa )
			{
				$message = $lang['COPPA'];
				$email_template = 'coppa_welcome_inactive';
			}
			else if ( $board_config['require_activation'] == USER_ACTIVATION_SELF )
			{
				$message = $lang['Account_inactive'];
				$email_template = 'user_welcome_inactive';
			}
			else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
			{
				$message = $lang['Account_inactive_admin'];
				$email_template = 'admin_welcome_inactive';
			}
			else
			{
				$message = $lang['Account_added'];
				$email_template = 'user_welcome';
			}

			include($phpbb_root_path . 'includes/emailer.'.$phpEx);
			$emailer = new emailer($board_config['smtp_delivery']);

			$emailer->from($board_config['board_email']);
			$emailer->replyto($board_config['board_email']);

			$emailer->use_template($email_template, stripslashes($user_lang));
			$emailer->email_address($email);
			$emailer->set_subject(sprintf($lang['Welcome_subject'], $board_config['sitename']));

				$emailer->assign_vars(array(
					'SITENAME' => $board_config['sitename'],
					'WELCOME_MSG' => sprintf($lang['Welcome_subject'], $board_config['sitename']),
					'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
					'PASSWORD' => $password_confirm,
					'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),
					'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
				);

			$emailer->send();
			$emailer->reset();

			if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
			{
				$sql = "SELECT user_email, user_lang 
					FROM " . USERS_TABLE . "
					WHERE user_level = " . ADMIN;
				
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not select Administrators', '', __LINE__, __FILE__, $sql);
				}
				
				while ($row = $db->sql_fetchrow($result))
				{
					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);
					
					$emailer->email_address(trim($row['user_email']));
					$emailer->use_template("admin_activate", $row['user_lang']);
					$emailer->set_subject($lang['New_account_subject']);

					$emailer->assign_vars(array(
						'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
						'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),
						'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
					);
					$emailer->send();
					$emailer->reset();
				}
				$db->sql_freeresult($result);
			}

			$message = $message . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

               if( $board_config['require_activation'] == USER_ACTIVATION_NONE ) 
               { 
                  $al_session_id = session_begin($user_id, $user_ip, PAGE_INDEX, FALSE, 0, 0);

                  if( $al_session_id ) 
                  { 
                     $meta_redirect_al = '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx", true) . '">';
                  } 
               }
               else 
               {
               $meta_redirect_al = '';
               } 
                
             message_die(GENERAL_MESSAGE, $message . $meta_redirect_al);
          } // if mode == register
	} // if !$error
} // End of submit


if ( $error )
{
	//
	// If an error occured we need to stripslashes on returned data
	//
	$username = stripslashes($username);
	$email = stripslashes($email);
	$cur_password = '';
	$new_password = '';
	$password_confirm = '';

	$icq = stripslashes($icq);
	$aim = str_replace('+', ' ', stripslashes($aim));
	$msn = stripslashes($msn);
	$yim = stripslashes($yim);

	$website = stripslashes($website);
	$location = stripslashes($location);
	$occupation = stripslashes($occupation);
	$interests = stripslashes($interests);
	$signature = stripslashes($signature);
	$signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $signature) : $signature;

	$user_lang = stripslashes($user_lang);
	$user_dateformat = stripslashes($user_dateformat);

}
else if ( $mode == 'editprofile' && !isset($HTTP_POST_VARS['avatargallery']) && !isset($HTTP_POST_VARS['submitavatar']) && !isset($HTTP_POST_VARS['cancelavatar']) )
{
	$user_id = $userdata['user_id'];
	$username = $userdata['username'];
	$email = $userdata['user_email'];
	$cur_password = '';
	$new_password = '';
	$password_confirm = '';

	$icq = $userdata['user_icq'];
	$aim = str_replace('+', ' ', $userdata['user_aim']);
	$msn = $userdata['user_msnm'];
	$yim = $userdata['user_yim'];

	$website = $userdata['user_website'];
	$location = $userdata['user_from'];
	$occupation = $userdata['user_occ'];
	$interests = $userdata['user_interests'];
	$signature_bbcode_uid = $userdata['user_sig_bbcode_uid'];
	$signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $userdata['user_sig']) : $userdata['user_sig'];

	$viewemail = $userdata['user_viewemail'];
	$notifypm = $userdata['user_notify_pm'];
	$popup_pm = $userdata['user_popup_pm'];

	$notifyreply = $userdata['user_notify'];
	$attachsig =  ( $userdata['user_allowsig'] ) ? $userdata['user_attachsig'] : '';
	$allowhtml = $userdata['user_allowhtml'];
	$allowbbcode = $userdata['user_allowbbcode'];
	$allowsmilies = $userdata['user_allowsmile'];

	$allowviewonline = $userdata['user_allow_viewonline'];

	$user_avatar = ( $userdata['user_allowavatar'] ) ? $userdata['user_avatar'] : '';
	$user_avatar_type = ( $userdata['user_allowavatar'] ) ? $userdata['user_avatar_type'] : USER_AVATAR_NONE;

	$user_style = $userdata['user_style'];
	$user_lang = $userdata['user_lang'];
	$user_timezone = $userdata['user_timezone'];
	$user_dateformat = $userdata['user_dateformat'];
}

//
// Default pages
//
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

make_jumpbox('viewforum.'.$phpEx);

if ( $mode == 'editprofile' )
{
	if ( $user_id != $userdata['user_id'] )
	{
		$error = TRUE;
		$error_msg = $lang['Wrong_Profile'];
	}
}

if( isset($HTTP_POST_VARS['avatargallery']) && !$error )
{
	include($phpbb_root_path . 'includes/usercp_avatar.'.$phpEx);

	// session id check
	if ($sid == '' || $sid != $userdata['session_id'])
	{
		$error = true;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Session_invalid'];
	}

	$avatar_category = ( !empty($HTTP_POST_VARS['avatarcategory']) ) ? htmlspecialchars($HTTP_POST_VARS['avatarcategory']) : '';

	$template->set_filenames(array(
		'body' => 'profile_avatar_gallery.tpl')
	);

	$allowviewonline = !$allowviewonline;

	display_avatar_gallery($mode, $avatar_category, $user_id, $email, $current_email, $coppa, $username, $email, $new_password, $cur_password, $password_confirm, $icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature, $viewemail, $notifypm, $popup_pm, $notifyreply, $attachsig, $allowhtml, $allowbbcode, $allowsmilies, $allowviewonline, $user_style, $user_lang, $user_timezone, $user_dateformat, $userdata['session_id']);
}
else
{
	//include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

	if ( !isset($coppa) )
	{
		$coppa = FALSE;
	}

	if ( !isset($user_style) )
	{
		$user_style = $board_config['default_style'];
	}

	$avatar_img = '';
	if ( $user_avatar_type )
	{
		switch( $user_avatar_type )
		{
			case USER_AVATAR_UPLOAD:
				$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				if ( $board_config['allow_avatar_remote'] )
				{
					$avatar_url = $userdata['user_avatar'];

					$avatar_status = check_avatar($avatar_url);
					if ($avatar_status === FALSE)
					{
						$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="images/avatar_yok.gif" alt="" border="0" />' : '';
					}
					else if ($avatar_status === TRUE)
					{
						if ( ($userdata['user_avatar_height'] && $userdata['user_avatar_height'] > 0) &&
							  ($userdata['user_avatar_width'] && $userdata['user_avatar_width'] > 0) )
						{
							$avatar_img = '<img src="' . $avatar_url  . '" height="' . $userdata['user_avatar_height'] . '" width="' . $userdata['user_avatar_width'] . '" alt="" border="0" />';
						}
						else  // No width/height in the user's profile
						{
							$avatar_img = '<img src="' . $avatar_url  . '" alt="" border="0" />';
						}
					}
				}
				else  // remote avatars not allowed
				$avatar_img = '';
				break;
			case USER_AVATAR_GALLERY:
				$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
		}
	}
        // Default avatar MOD, By Manipe (Begin)
	if ((!$avatar_img) && (($board_config['default_avatar_set'] == 1) || ($board_config['default_avatar_set'] == 2)) && ($board_config['default_avatar_users_url']))
	{
		$avatar_img = '<img src="' . $board_config['default_avatar_users_url'] . '" alt="" border="0" />';
	}
        // Default avatar MOD, By Manipe (End)

	$s_hidden_fields = '
		<input type="hidden" name="mode" value="' . $mode . '" />
		<input type="hidden" name="agreed" id="agreed" value="' . $registration_hash . '"  />
		<input type="hidden" name="coppa" value="' . $coppa . '" />
		<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />
	';
	
	if( $mode == 'editprofile' )
	{
		$s_hidden_fields .= '<input type="hidden" name="user_id" value="' . $userdata['user_id'] . '" />';
		//
		// Send the users current email address. If they change it, and account activation is turned on
		// the user account will be disabled and the user will have to reactivate their account.
		//
		$s_hidden_fields .= '<input type="hidden" name="current_email" value="' . $userdata['user_email'] . '" />';
	}

	if ( !empty($user_avatar_local) )
	{
		$s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
	}

	$html_status =  ( $userdata['user_allowhtml'] && $board_config['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
	$bbcode_status = ( $userdata['user_allowbbcode'] && $board_config['allow_bbcode']  ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
	$smilies_status = ( $userdata['user_allowsmile'] && $board_config['allow_smilies']  ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];

	$user_sig = $userdata['user_sig'];
	$user_sig_bbcode_uid = $userdata['user_sig_bbcode_uid'];
	
	if ( !$board_config['allow_html'] || !$userdata['user_allowhtml']) {
		if ( $user_sig != '' ) { $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig); }
	}
	if ( $board_config['allow_bbcode'] ) {
		if ( $user_sig != '' && $user_sig_bbcode_uid != '' ) { $user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig); }
	}
	if ( $board_config['allow_smilies'] ) {
		if ( $userdata['user_allowsmile'] && $user_sig != '' ) { $user_sig = smilies_pass($user_sig); }
	}
	if ( $user_sig != '' ) { $user_sig = str_replace("\n", "\n<br />\n", $user_sig); }

	if ( $error )
	{
		$template->set_filenames(array(
			'reg_header' => 'error_body.tpl')
		);
		$template->assign_vars(array(
			'ERROR_MESSAGE' => $error_msg)
		);
		$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
	}

	$template->set_filenames(array(
		'body' => (isset($HTTP_GET_VARS['dhtml']) && $HTTP_GET_VARS['dhtml'] == 'no' || $mode=="register" ? 'profile_add_body.tpl' : 'profile_add_body_dhtml.tpl'))
		//'body' => 'profile_add_body.tpl')
	);

	if ( $mode == 'editprofile' )
	{
		$template->assign_block_vars('switch_edit_profile', array());
	}

	if ( ($mode == 'register') || ($board_config['allow_namechange']) || ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD) )
	{
		$template->assign_block_vars('switch_namechange_allowed', array());
	}
	else
	{
		$template->assign_block_vars('switch_namechange_disallowed', array());
	}
	// [start] Actually disable HTML 1.0.1
	if ( $board_config['allow_html'] )
	{
		$template->assign_block_vars('switch_html_enable', array());
	}
	// [end] Actually disable HTML 1.0.1


	// Visual Confirmation
	$confirm_image = '';
	if (!empty($board_config['enable_confirm']) && $mode == 'register')
	{
		$sql = 'SELECT session_id 
			FROM ' . SESSIONS_TABLE; 
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			$confirm_sql = '';
			do
			{
				$confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
			}
			while ($row = $db->sql_fetchrow($result));
		
			$sql = 'DELETE FROM ' .  CONFIRM_TABLE . " 
				WHERE session_id NOT IN ($confirm_sql)";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete stale confirm data', '', __LINE__, __FILE__, $sql);
			}
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT COUNT(session_id) AS attempts 
			FROM ' . CONFIRM_TABLE . " 
			WHERE session_id = '" . $userdata['session_id'] . "'";
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain confirm code count', '', __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			if ($row['attempts'] > 3)
			{
				message_die(GENERAL_MESSAGE, $lang['Too_many_registers']);
			}
		}
		$db->sql_freeresult($result);
		
		// Generate the required confirmation code
		$code_length = mt_rand(4, 6);
		$code = dss_rand();
		$code = strtoupper(base_convert($code, 16, 35));
		$code = str_replace('I', '', $code); // The letter I could get confused with the letter J and the number 1 (one) so we remove it
		$code = str_replace('0', '', $code); // NB 0 (zero) could get confused with O (the letter) so we remove it
		$code = substr($code, 2, $code_length);

		$confirm_id = md5(uniqid($user_ip));

		$sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code) 
			VALUES ('$confirm_id', '". $userdata['session_id'] . "', '$code')";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not insert new confirm code information', '', __LINE__, __FILE__, $sql);
		}

		unset($code);

		$confirm_image = '<img src="' . append_sid("profile.$phpEx?mode=confirm&amp;id=$confirm_id") . '" alt="" title="" />';
		$s_hidden_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';

		$template->assign_block_vars('switch_confirm', array());
	}


	//
	// Let's do an overall check for settings/versions which would prevent
	// us from doing file uploads....
	//
	$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
	$form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

	$template->assign_vars(array(
		'USERNAME' => isset($username) ? $username : '',
		'CUR_PASSWORD' => isset($cur_password) ? $cur_password : '',
		'NEW_PASSWORD' => isset($new_password) ? $new_password : '',
		'PASSWORD_CONFIRM' => isset($password_confirm) ? $password_confirm : '',
		'EMAIL' => isset($email) ? $email : '',
		'CONFIRM_IMG' => $confirm_image,
		'YIM' => $yim,
		'ICQ' => $icq,
		'MSN' => $msn,
		'AIM' => $aim,
		'OCCUPATION' => occupation_select($occupation, 'occupation'),
		'INTERESTS' => $interests,
		'LOCATION' => location_select($location, 'location'),
		'WEBSITE' => $website,
		'SIGNATURE' => str_replace('<br />', "\n", $signature),
		'SIGNATURE_P' => $user_sig,
		'SIGNATURE_LEN' => $board_config['max_sig_chars'] - strlen(str_replace('<br />', "\n", $signature)),
		'VIEW_EMAIL_YES' => ( $viewemail ) ? 'checked="checked"' : '',
		'VIEW_EMAIL_NO' => ( !$viewemail ) ? 'checked="checked"' : '',
		'HIDE_USER_YES' => ( !$allowviewonline ) ? 'checked="checked"' : '',
		'HIDE_USER_NO' => ( $allowviewonline ) ? 'checked="checked"' : '',
		'NOTIFY_PM_YES' => ( $notifypm ) ? 'checked="checked"' : '',
		'NOTIFY_PM_NO' => ( !$notifypm ) ? 'checked="checked"' : '',
		'POPUP_PM_YES' => ( $popup_pm ) ? 'checked="checked"' : '',
		'POPUP_PM_NO' => ( !$popup_pm ) ? 'checked="checked"' : '',
		'ALWAYS_ADD_SIGNATURE_YES' => ( $attachsig ) ? 'checked="checked"' : '',
		'ALWAYS_ADD_SIGNATURE_NO' => ( !$attachsig ) ? 'checked="checked"' : '',
		'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
		'NOTIFY_REPLY_NO' => ( !$notifyreply ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_BBCODE_YES' => ( $allowbbcode ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_BBCODE_NO' => ( !$allowbbcode ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_HTML_YES' => ( $allowhtml ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_HTML_NO' => ( !$allowhtml ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_SMILIES_YES' => ( $allowsmilies ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_SMILIES_NO' => ( !$allowsmilies ) ? 'checked="checked"' : '',
		'SHOW_NO_DHTML' => append_sid("profile.php?mode=editprofile&amp;dhtml=no"),
		'SHOW_YES_DHTML' => append_sid("profile.php?mode=editprofile"),

		'ALLOW_AVATAR' => $board_config['allow_avatar_upload'],
		'AVATAR' => $avatar_img,
		'AVATAR_SIZE' => $board_config['avatar_filesize'],
		'LANGUAGE_SELECT' => language_select($user_lang, 'language'),
		'STYLE_SELECT' => style_select($user_style, 'style'),
		'TIMEZONE_SELECT' => tz_select($user_timezone, 'timezone'),
		'DATE_FORMAT_SELECT' => date_format_select($user_dateformat, $user_timezone),
		'HTML_STATUS' => $html_status,
		'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
		'SMILIES_STATUS' => $smilies_status,

		'U_CFAQ_JSLIB' => $phpbb_root_path . 'templates/collapsible_faq.js',
		'L_DHTML' => $lang['DHTML'],
		'L_CFAQ_NOSCRIPT' => sprintf($lang['dhtml_noscript'], ('<a href="'.append_sid("profile.$phpEx?".(isset($HTTP_GET_VARS['mode']) ? 'mode='.$HTTP_GET_VARS['mode'] : '').'&amp;dhtml=no').'">'), '</a>'),

		'L_CURRENT_PASSWORD' => $lang['Current_password'],
		'L_NEW_PASSWORD' => ( $mode == 'register' ) ? $lang['Password'] : $lang['New_password'],
		'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
		'L_CONFIRM_PASSWORD_EXPLAIN' => ( $mode == 'editprofile' ) ? $lang['Confirm_password_explain'] : '',
		'L_PASSWORD_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_if_changed'] : '',
		'L_PASSWORD_CONFIRM_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_confirm_if_changed'] : '',
		'L_PASSWORD_SECURITY_LEVEL1' => $lang['password_security_level1'],
		'L_PASSWORD_SECURITY_LEVEL2' => $lang['password_security_level2'],
		'L_PASSWORD_SECURITY_LEVEL3' => $lang['password_security_level3'],
		'L_PASSWORD_SECURITY_LEVEL4' => $lang['password_security_level4'],
		'L_PASSWORD_SECURITY_LEVEL5' => $lang['password_security_level5'],
		'L_PASSWORD_SECURITY_EXPLAIN' => $lang['password_security_explain'],
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],
		'L_ICQ_NUMBER' => $lang['ICQ'],
		'L_MESSENGER' => $lang['MSNM'],
		'L_YAHOO' => $lang['YIM'],
		'L_WEBSITE' => $lang['Website'],
		'L_AIM' => $lang['AIM'],
		'L_LOCATION' => $lang['Location'],
		'L_OCCUPATION' => $lang['Occupation'],
		'L_BOARD_LANGUAGE' => $lang['Board_lang'],
		'L_BOARD_STYLE' => $lang['Board_style'],
		'L_TIMEZONE' => $lang['Timezone'],
		'L_DATE_FORMAT' => $lang['Date_format'],
		'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],
		'L_INTERESTS' => $lang['Interests'],
		'L_SIG_PANEL' => $lang['Sig_panel'],
		'L_SIG_PRE' => $lang['Sig_pre'],
		'L_SELECT'=> $lang['Selecet'],
		'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'],
		'L_SELECT_PANEL' => $lang['Select_panel'],
		'L_ALWAYS_ALLOW_BBCODE' => $lang['Always_bbcode'],
		'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'],
		'L_HIDE_USER' => $lang['Hide_user'],
		'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],

		'L_AVATAR_PANEL' => $lang['Avatar_panel'],
		'L_AVATAR_EXPLAIN' => sprintf($lang['Avatar_explain'], $board_config['avatar_max_width'], $board_config['avatar_max_height'], (round($board_config['avatar_filesize'] / 1024))),
		'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
		'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
		'L_UPLOAD_AVATAR_URL_EXPLAIN' => $lang['Upload_Avatar_URL_explain'],
		'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
		'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
		'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],
		'L_LINK_REMOTE_AVATAR_EXPLAIN' => $lang['Link_remote_Avatar_explain'],
		'L_DELETE_AVATAR' => $lang['Delete_Image'],
		'L_CURRENT_IMAGE' => $lang['Current_Image'],

		'L_SIGNATURE' => $lang['Signature'],
		'L_SIGNATURE_LEN' => $board_config['max_sig_chars'],
		'L_SIGNATURE_LEN_EXPLAIN' => $lang['Signature_len_explain'],
		'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars']),
		'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
		'L_NOTIFY_ON_REPLY_EXPLAIN' => $lang['Always_notify_explain'],
		'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'],
		'L_POPUP_ON_PRIVMSG' => $lang['Popup_on_privmsg'],
		'L_POPUP_ON_PRIVMSG_EXPLAIN' => $lang['Popup_on_privmsg_explain'],
		'L_PREFERENCES' => $lang['Preferences'],
		'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'],
		'L_PUBLIC_VIEW_EMAIL_REQUEST' => $lang['Public_view_email_request'],
		'L_ITEMS_REQUIRED' => $lang['Items_required'],
		'L_REGISTRATION_INFO' => $lang['Registration_info'],
		'L_PROFILE_INFO' => $lang['Profile_info'],
		'L_PROFILE_INFO_NOTICE' => $lang['Profile_info_warn'],
		'L_EMAIL_ADDRESS' => $lang['Email_address'],

		'L_FONT_COLOR' => $lang['Font_color'],
		'L_COLOR_DEFAULT' => $lang['color_default'],
		'L_COLOR_DARK_RED' => $lang['color_dark_red'],
		'L_COLOR_RED' => $lang['color_red'],
		'L_COLOR_ORANGE' => $lang['color_orange'],
		'L_COLOR_BROWN' => $lang['color_brown'], 
		'L_COLOR_YELLOW' => $lang['color_yellow'], 
		'L_COLOR_GREEN' => $lang['color_green'], 
		'L_COLOR_OLIVE' => $lang['color_olive'], 
		'L_COLOR_CYAN' => $lang['color_cyan'], 
		'L_COLOR_BLUE' => $lang['color_blue'], 
		'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'], 
		'L_COLOR_INDIGO' => $lang['color_indigo'], 
		'L_COLOR_VIOLET' => $lang['color_violet'], 
		'L_COLOR_WHITE' => $lang['color_white'], 
		'L_COLOR_BLACK' => $lang['color_black'], 
		'L_COLOR_CADET_BLUE' => $lang['color_cadet_blue'],
		'L_COLOR_CORAL' => $lang['color_coral'], 
		'L_COLOR_CRIMSON' => $lang['color_crimson'], 
		'L_COLOR_TOMATO' => $lang['color_tomato'], 
		'L_COLOR_SEA_GREEN' => $lang['color_sea_green'], 
		'L_COLOR_DARK_ORCHID' => $lang['color_dark_orchid'],
		'L_COLOR_CHOCOLATE' => $lang['color_chocolate'],
		'L_COLOR_DEEPSKYBLUE' => $lang['color_deepskyblue'], 
		'L_COLOR_GOLD' => $lang['color_gold'], 
		'L_COLOR_GRAY' => $lang['color_gray'], 
		'L_COLOR_MIDNIGHTBLUE' => $lang['color_midnightblue'], 
		'L_COLOR_DARKGREEN' => $lang['color_darkgreen'], 

		'L_FONT_SIZE' => $lang['Font_size'], 
		'L_FONT_TINY' => $lang['font_tiny'], 
		'L_FONT_SMALL' => $lang['font_small'], 
		'L_FONT_NORMAL' => $lang['font_normal'], 
		'L_FONT_LARGE' => $lang['font_large'], 
		'L_FONT_HUGE' => $lang['font_huge'],
		'L_FONT_TYPE' => $lang['font_type'], 
		'L_CONFIRM_CODE_IMPAIRED' => sprintf($lang['Confirm_code_impaired'], '<a href="mailto:' . $board_config['board_email'] . '">', '</a>'),
		'L_CONFIRM_CODE' => $lang['Confirm_code'],
		'L_CONFIRM_CODE_EXPLAIN' => $lang['Confirm_code_explain'],

		'S_ALLOW_AVATAR_UPLOAD' => $board_config['allow_avatar_upload'],
		'S_ALLOW_AVATAR_LOCAL' => $board_config['allow_avatar_local'],
		'S_ALLOW_AVATAR_REMOTE' => $board_config['allow_avatar_remote'],
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_FORM_ENCTYPE' => $form_enctype,
		'S_PROFILE_ACTION' => append_sid("profile.$phpEx"))
	);

	//
	// This is another cheat using the block_var capability
	// of the templates to 'fake' an IF...ELSE...ENDIF solution
	// it works well :)
	//
	if ( $mode != 'register' )
	{
		if ( $userdata['user_allowavatar'] && ( $board_config['allow_avatar_upload'] || $board_config['allow_avatar_local'] || $board_config['allow_avatar_remote'] ) )
		{
			$template->assign_block_vars('switch_avatar_block', array() );

			if ( $board_config['allow_avatar_upload'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_path'])) )
			{
				if ( $form_enctype != '' )
				{
					$template->assign_block_vars('switch_avatar_block.switch_avatar_local_upload', array() );
				}
				$template->assign_block_vars('switch_avatar_block.switch_avatar_remote_upload', array() );
			}

			if ( $board_config['allow_avatar_remote'] )
			{
				$template->assign_block_vars('switch_avatar_block.switch_avatar_remote_link', array() );
			}

			if ( $userdata['user_allowsig'] )
			{
	       			$template->assign_block_vars('switch_sig_block', array() );
			}

			if ( $board_config['allow_avatar_local'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_gallery_path'])) )
			{
				$template->assign_block_vars('switch_avatar_block.switch_avatar_local_gallery', array() );
			}
		}
	}
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>