<?php
/***************************************************************************
* login.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human
// Tell the CTracker Filescanner that this constant is allowed

define("IN_LOGIN", true);

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Set page ID for session management
$userdata = session_pagestart($user_ip, PAGE_LOGIN, 1);
init_userprefs($userdata);
// End session management

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
	$sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}

// CrackerTracker v5.x
if ( !empty($HTTP_POST_VARS['username']) && $ctracker_config->settings['loginfeature'] == 1 )
{
	$ctracker_config->check_login_status($HTTP_POST_VARS['username']);	
}
// CrackerTracker v5.x

if( isset($HTTP_POST_VARS['login']) || isset($HTTP_GET_VARS['login']) || isset($HTTP_POST_VARS['logout']) || isset($HTTP_GET_VARS['logout']) )
{
	if( ( isset($HTTP_POST_VARS['login']) || isset($HTTP_GET_VARS['login']) ) && (!$userdata['session_logged_in'] || isset($HTTP_POST_VARS['admin'])) )
	{
		$username = isset($HTTP_POST_VARS['username']) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
		$password = isset($HTTP_POST_VARS['password']) ? $HTTP_POST_VARS['password'] : '';

		$sql = "SELECT user_id, username, user_password, user_active, user_level, user_login_tries, user_last_login_try, ct_login_count
			FROM " . USERS_TABLE . "
			WHERE username = '" . str_replace("\\'", "''", $username) . "'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
		}

		if( $row = $db->sql_fetchrow($result) )
		{

			// If the last login is more than x minutes ago, then reset the login tries/time
			if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($board_config['login_reset_time'] * 60)))
			{
				$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0, user_allow_viewonline = ' . (int) $hideonline . ' WHERE user_id = ' . $row['user_id']);
				$row['user_last_login_try'] = $row['user_login_tries'] = 0;
			}

			// Check to see if user is allowed to login again... if his tries are exceeded
			if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $board_config['max_login_attempts'] && $row['user_last_login_try'] >= (time() - ($board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)
			{
				message_die(GENERAL_MESSAGE, sprintf($lang['Login_attempts_exceeded'], $board_config['max_login_attempts'], $board_config['login_reset_time']));
			}

			if( md5($password) == $row['user_password'] && $row['user_active'] )
			{
				$autologin = ( isset($HTTP_POST_VARS['autologin']) ) ? TRUE : 0;
				$hideonline = ( isset ( $HTTP_POST_VARS['hideonline'] ) ) ? 0 : 1;
				$admin = (isset($HTTP_POST_VARS['admin'])) ? 1 : 0;
				$session_id = session_begin($row['user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
				// Reset login tries
				$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
				// CrackerTracker v5.x
				if ( $ctracker_config->settings['login_history'] == 1 )
				{
					$ctracker_config->update_login_history($row['user_id']);
				}

				if ( $ctracker_config->settings['loginfeature'] == 1 )
				{
					$ctracker_config->reset_login_system($row['user_id']);
				}

				if ( $ctracker_config->settings['login_ip_check'] == 1 )
				{
					$ctracker_config->set_user_ip($row['user_id']);
				}
				// CrackerTracker v5.x
				if( $session_id )
				{
					$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "portal.$phpEx";
					
					if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
					{
							message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
					}

					if ( ! isset ( $HTTP_POST_VARS['admin'] ) )
					{
						// Handle redirects
						$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "portal.$phpEx";

						if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
						{
								message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
						}
						
						$template->assign_vars(array(
							'META' => '<meta http-equiv="refresh" content="2;url=' . append_sid($redirect) . '">')
						);

						$message = $lang['Olympus_login_logged_in'] . '<br /><br />' . sprintf($lang['Olympus_login_click_return'], '<a href="' . append_sid($redirect) . '">', '</a>');
						// Output 'You have sucessfully been logged in' message.
						message_die(GENERAL_MESSAGE, $message);
					}
					else
					{
						$url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "portal.$phpEx";
						redirect(append_sid($url, true));
					}
				}
				else
				{
					message_die(CRITICAL_ERROR, "Could not start session : login", "", __LINE__, __FILE__);
				}
			}
			// Only store a failed login attempt for an active user - inactive users can't login even with a correct password
			else
			{
				// Save login tries and last login, but only store a failed login attempt for an
				// active user - inactive users can't login even with a correct password
				if ( $row['user_id'] != ANONYMOUS && $row['user_active'] )
				{
					// CrackerTracker v5.x
					include_once($phpbb_root_path . 'ctracker/classes/class_log_manager.' . $phpEx);
					$logfile = new log_manager();
					$logfile->prepare_log($row['username']);
					$logfile->write_general_logfile($ctracker_config->settings['logsize_logins'], 4);
					unset($logfile);

					if ( $ctracker_config->settings['loginfeature'] == 1 )
					{
						$ctracker_config->handle_wrong_login($row['user_id'], $row['ct_login_count']);
					}
					// CrackerTracker v5.x
					$sql = 'UPDATE ' . USERS_TABLE . '
						SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '
						WHERE user_id = ' . $row['user_id'];
					$db->sql_query($sql);
				}

			}
			// Split message for inactive users
			if ( ! $row['user_active'] )
			{
				$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "portal.$phpEx";

				if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
				{
					message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
				}

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid($redirect) . '">')
				);
				$message = $lang['Olympus_login_account_inactive'] . '<br /><br />' . sprintf($lang['Olympus_login_resend_activation'], "<a href=\"profile.$phpEx?mode=resendactivation\">", '</a>') . '<br /><br />' . sprintf($lang['Click_return_login'], '<a href="' . append_sid("login.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			}
			// Split message for invalid password
			else if ( md5($password) != $row['user_password'] && $row['user_active'] )
			{
				$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "portal.$phpEx";
				
				if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
				{
					message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
				}

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid($redirect) . '">')
				);

				$message = $lang['Olympus_login_invalid_password'] . '<br /><br />' . sprintf($lang['Olympus_login_reset_password'], "<a href=\"profile.$phpEx?mode=sendpassword\">", '</a>') . '<br /><br />' . sprintf($lang['Click_return_login'], '<a href="' . append_sid("login.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			}

		}
		else
		{
			$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "";
			$redirect = str_replace("?", "&", $redirect);

			if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
			{
				message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
			}

			$template->assign_vars(array(
				'META' => "<meta http-equiv=\"refresh\" content=\"1;url=login.$phpEx?redirect=$redirect\">")
			);

			$message = $lang['Olympus_login_not_registered'] . '<br /><br />' . sprintf($lang['Olympus_login_register_account'], "<a href=\"profile.$phpEx?mode=register\">", '</a>') . '<br /><br />' . sprintf($lang['Click_return_login'], '<a href="' . append_sid("login.$phpEx") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
	}
	// Admin Session Logout
	else if( isset($HTTP_GET_VARS['admin_session_logout']) && $userdata['user_level'] == ADMIN )
	{
		// session id check
		if ( $sid == '' || $sid != $userdata['session_id'] )
		{
			message_die(GENERAL_ERROR, 'Invalid_session');
		}
		
		$sql = "UPDATE " . SESSIONS_TABLE . "
			SET session_admin = 0
			WHERE session_id = '" . $userdata['session_id'] . "'";
		if (!($result = $db->sql_query($sql)))
		{
			message_die(CRITICAL_ERROR, 'Couldn\'t update Sessions Table', '', __LINE__, __FILE__, $sql);
		}
		
		redirect(append_sid("portal.$phpEx", true));
	}
	// Admin Session Logout
	else if( ( isset($HTTP_GET_VARS['logout']) || isset($HTTP_POST_VARS['logout']) ) && $userdata['session_logged_in'] )
	{
		// session id check
		if ($sid == '' || $sid != $userdata['session_id'])
		{
			message_die(GENERAL_ERROR, 'Invalid_session');
		}

		if( $userdata['session_logged_in'] )
		{
			session_end($userdata['session_id'], $userdata['user_id']);
		}

		if (!empty($HTTP_POST_VARS['redirect']) || !empty($HTTP_GET_VARS['redirect']))
		{
			$url = (!empty($HTTP_POST_VARS['redirect'])) ? htmlspecialchars($HTTP_POST_VARS['redirect']) : htmlspecialchars($HTTP_GET_VARS['redirect']);
			$url = str_replace('&amp;', '&', $url);
			redirect(append_sid($url, true));
		}
		else
		{
                        redirect(append_sid("portal.$phpEx", true));
		}
	}
	else
	{
		$url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "portal.$phpEx";
		redirect(append_sid($url, true));
	}
}
else
{
	//
	// Do a full login page dohickey if
	// user not already logged in
	//
	if( !$userdata['session_logged_in'] || (isset($HTTP_GET_VARS['admin']) && $userdata['session_logged_in'] && $userdata['user_level'] == ADMIN))
	{
		$page_title = $lang['Login'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->set_filenames(array(
			'body' => 'login_olympus_body.tpl')
		);

		$forward_page = '';

		if( isset($HTTP_POST_VARS['redirect']) || isset($HTTP_GET_VARS['redirect']) )
		{
			$forward_to = $HTTP_SERVER_VARS['QUERY_STRING'];

			if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) )
			{
				$forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];
				$forward_match = explode('&', $forward_to);

				if(count($forward_match) > 1)
				{
					for($i = 1; $i < count($forward_match); $i++)
					{
						if( !ereg("sid=", $forward_match[$i]) )
						{
							if( $forward_page != '' )
							{
								$forward_page .= '&';
							}
							$forward_page .= $forward_match[$i];
						}
					}
					$forward_page = $forward_match[0] . '?' . $forward_page;
				}
				else
				{
					$forward_page = $forward_match[0];
				}
			}
		}

		$username = ( $userdata['user_id'] != ANONYMOUS ) ? $userdata['username'] : '';

		$s_hidden_fields = '<input type="hidden" name="redirect" value="' . $forward_page . '" />';
		$s_hidden_fields .= (isset($HTTP_GET_VARS['admin'])) ? '<input type="hidden" name="admin" value="1" />' : '';

		make_jumpbox('viewforum.'.$phpEx);
		$template->assign_vars(array(
			'L_LOGIN_REGISTER'	=> $lang['Olympus_login_register'],
			'L_LOGIN_INFO'		=> $lang['Olympus_login_info'],
			'L_LOGIN_INDEX'		=> $lang['Olympus_login_index'],
			'L_LOGIN_FAQ'		=> $lang['Olympus_login_faq'],
			'L_LOGIN_ADMIN'		=> $lang['Olympus_login_admin'],
			'L_LOGIN_ACTIVATE'	=> $lang['Olympus_login_activate'],
			'L_LOGIN_HIDEME'	=> $lang['Olympus_login_hideme'],
			'L_LOGIN_OPTIONS'	=> $lang['Olympus_login_options'],

			'U_LOGIN_ACTIVATE'	=> append_sid("profile.$phpEx?mode=resendactivation"),

			'USERNAME' => $username,
			'U_FORUM_ADMIN' => sprintf($lang['Forum_admin_eposta'], '<a href="mailto:' . $board_config['board_email'] . '">', '</a>'),
			'L_ENTER_PASSWORD' => (isset($HTTP_GET_VARS['admin'])) ? $lang['Admin_reauthenticate'] : $lang['Enter_password'],
			'L_SEND_PASSWORD' => $lang['Forgotten_password'],
			'U_SEND_PASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields )
		);

		if ( isset( $HTTP_GET_VARS['admin'] ) )
		{
			$template->assign_block_vars('switch_admin_reauth', array());
		}

		if ( $board_config['require_activation'] !== USER_ACTIVATION_ADMIN && ! $userdata['session_logged_in'] )
		{
			$template->assign_block_vars('switch_admin_activation', array());
		}

		$template->pparse('body');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
	else
	{
		redirect(append_sid("portal.$phpEx", true));
	}
}

?>