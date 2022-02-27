<?php
/***************************************************************************
 * functions_validate.php
 ***************************************************************************/

 if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

//
// Check to see if the username has been taken, or if it is disallowed.
// Also checks if it includes the " character, which we don't allow in usernames.
// Used for registering, changing names, and posting anonymously with a username
//
function validate_username($username)
{
	global $db, $lang, $userdata;

	// Remove doubled up spaces
	$username = preg_replace('#\s+#', ' ', trim($username)); 
	$username = phpbb_clean_username($username);

	$sql = "SELECT username 
		FROM " . USERS_TABLE . "
		WHERE LOWER(username) = '" . strtolower($username) . "'";
	if ($result = $db->sql_query($sql))
	{
		while ($row = $db->sql_fetchrow($result))
		{
			if (($userdata['session_logged_in'] && $row['username'] != $userdata['username']) || !$userdata['session_logged_in'])
			{
				$db->sql_freeresult($result);
				return array('error' => true, 'error_msg' => $lang['Username_taken']);
			}
		}
	}
	$db->sql_freeresult($result);

	$sql = "SELECT group_name
		FROM " . GROUPS_TABLE . " 
		WHERE LOWER(group_name) = '" . strtolower($username) . "'";
	if ($result = $db->sql_query($sql))
	{
		if ($row = $db->sql_fetchrow($result))
		{
			$db->sql_freeresult($result);
			return array('error' => true, 'error_msg' => $lang['Username_taken']);
		}
	}
	$db->sql_freeresult($result);

	$sql = "SELECT disallow_username
		FROM " . DISALLOW_TABLE;
	if ($result = $db->sql_query($sql))
	{
		if ($row = $db->sql_fetchrow($result))
		{
			do
			{
				if (preg_match("#\b(" . str_replace("\*", ".*?", preg_quote($row['disallow_username'], '#')) . ")\b#i", $username))
				{
					$db->sql_freeresult($result);
					return array('error' => true, 'error_msg' => $lang['Username_disallowed']);
				}
			}
			while($row = $db->sql_fetchrow($result));
		}
	}
	$db->sql_freeresult($result);

	$sql = "SELECT word 
		FROM  " . WORDS_TABLE;
	if ($result = $db->sql_query($sql))
	{
		if ($row = $db->sql_fetchrow($result))
		{
			do
			{
				if (preg_match("#\b(" . str_replace("\*", ".*?", preg_quote($row['word'], '#')) . ")\b#i", $username))
				{
					$db->sql_freeresult($result);
					return array('error' => true, 'error_msg' => $lang['Username_disallowed']);
				}
			}
			while ($row = $db->sql_fetchrow($result));
		}
	}
	$db->sql_freeresult($result);

	// Don't allow " and ALT-255 in username.
	if (strstr($username, '"') || strstr($username, '&quot;') || strstr($username, chr(160)))
	{
		return array('error' => true, 'error_msg' => $lang['Username_invalid']);
	}

	return array('error' => false, 'error_msg' => '');
}

// +MOD: Live Email Validate (LEV)
//
// test SMTP mail delivery
function probe_smtp_mailbox($email, $hostname)
{
	global $board_config, $lang, $phpEx;
  @set_time_limit(30);

  if ($connect = @fsockopen($hostname, 25, $errno, $errstr, 15))
  {
    usleep(888);
    $out = fgetss($connect, 1024);

    if (ereg('^220', $out))
    {
      fputs($connect, "HELO " . $board_config['server_name'] . "\r\n");

      while (ereg('^220', $out))
      {
        $out = fgetss($connect, 1024);
      }

      fputs($connect, "VRFY <" . $email . ">\r\n");
      $verify = fgetss($connect, 1024);

      fputs($connect, "MAIL FROM: <" . $board_config['board_email'] . ">\r\n");
      $From = fgetss($connect, 1024);

      fputs($connect, "RCPT TO: <" . $email . ">\r\n");
      $To = fgetss($connect, 1024);

      fputs($connect, "QUIT\r\n");
      fclose($connect);

      if (ereg('^250', $From) && ereg('^250', $To) && !ereg('^550', $verify))
      {
        $result = array('error' => false, 'error_msg' => '');
      }
      else
      {
      	$result = array('error' => true, 'error_msg' => sprintf($lang['Email_unverified'], '<a href="' . append_sid('faq.' . $phpEx) . '">' . $lang['FAQ'] . '</a>') . ((DEBUG == TRUE) ? "<br />Server: $hostname | From: $From| To: " . str_replace('-"', ' ', $To) : ' '));
      }
    }
    @fclose($connect);
  }
  else
  {
	$result = array('error' => true, 'error_msg' => sprintf($lang['No_connection'], '<a href="' . append_sid('faq.' . $phpEx) . '">' . $lang['FAQ'] . '</a>') . ((DEBUG == TRUE) ? "<br />$hostname : no route to this domain, host unavailable" : ' '));
  }
  return $result;
}

// Try to find an MX record that matches the hostname - Unix
function check_smtp_addr_unix($email)
{
  list($username, $domain) = explode('@', $email);

  if (checkdnsrr($domain, 'MX'))
  {
    getmxrr($domain, $mxhosts);
    $result = probe_smtp_mailbox($email, $mxhosts[0]);

    if ($result['error'] == false)
    {
    	return $result;
    }

    for ($i = 1; $i < count($mxhosts); $i++)
    {
      $result = probe_smtp_mailbox($email, $mxhosts[$i]);
      if ($result['error'] == false)
      {
      	return $result;
      }
    }
    return $result;
  }
  else
  {
  	return (probe_smtp_mailbox($email, $domain));
  }
}

// Try to find an MX record that matches the hostname - Win32
function check_smtp_addr_win($email)
{
  list($username, $domain) = explode('@', $email);
  exec("nslookup -type=MX $domain", $outputs);

  foreach ($outputs as $hostname)
  {
    if (@strpos($domain, $hostname))
    {
      $result =  probe_smtp_mailbox($email, $domain);

      if ($result['error'] == false)
      {
      	return $result;
      }
    }
  }

  if (isset($result))
  {
  	return $result;
  }
  else
  {
  	return (probe_smtp_mailbox($email, $domain));
  }
}
//
// -MOD: Live Email Validate (LEV)


//
// Check to see if email address is banned
// or already present in the DB
//
function validate_email($email)
{
        global $db, $lang, $board_config, $phpEx;

	if ($email != '')
	{
		if (preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $email))
		{
                        // +MOD: Live Email Validate (LEV)
                        if ($board_config['live_email_validation'])
                        {
                          $system = @preg_match("/Microsoft|Win32|IIS|WebSTAR|Xitami/", $_SERVER['SERVER_SOFTWARE']) ?
                          $result = check_smtp_addr_win($email) : $result = check_smtp_addr_unix($email);
                  
                          if ($result['error'] == true)
                          {
                            return array('error' => true, 'error_msg' => $result['error_msg']);
                          }
                        }
                        // -MOD: Live Email Validate (LEV)

			$sql = "SELECT ban_email
				FROM " . BANLIST_TABLE;
			if ($result = $db->sql_query($sql))
			{
				if ($row = $db->sql_fetchrow($result))
				{
					do
					{
						$match_email = str_replace('*', '.*?', $row['ban_email']);
						if (preg_match('/^' . $match_email . '$/is', $email))
						{
							$db->sql_freeresult($result);
							return array('error' => true, 'error_msg' => $lang['Email_banned']);
						}
					}
					while($row = $db->sql_fetchrow($result));
				}
			}
			$db->sql_freeresult($result);

   $sql = "SELECT user_email
				FROM " . USERS_TABLE . "
				WHERE user_email = '" . str_replace("\'", "''", $email) . "'";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, "Could not obtain user email information.", "", __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				return array('error' => true, 'error_msg' => $lang['Email_taken']);
			}
			$db->sql_freeresult($result);

			return array('error' => false, 'error_msg' => '');
		}
	}

	return array('error' => true, 'error_msg' => $lang['Email_invalid']);
}

//
// Does supplementary validation of optional profile fields. This expects common stuff like trim() and strip_tags()
// to have already been run. Params are passed by-ref, so we can set them to the empty string if they fail.
//
function validate_optional_fields(&$icq, &$aim, &$msnm, &$yim, &$website, &$location, &$occupation, &$interests, &$sig)
{
	$check_var_length = array('aim', 'msnm', 'yim', 'location', 'occupation', 'interests', 'sig');

	for($i = 0; $i < count($check_var_length); $i++)
	{
		if (strlen($$check_var_length[$i]) < 2)
		{
			$$check_var_length[$i] = '';
		}
	}

	// ICQ number has to be only numbers.
	if (!preg_match('/^[0-9]+$/', $icq))
	{
		$icq = '';
	}
	
	// website has to start with http://, followed by something with length at least 3 that
	// contains at least one dot.
	if ($website != "")
	{
		if (!preg_match('#^http[s]?:\/\/#i', $website))
		{
			$website = 'http://' . $website;
		}

		if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $website))
		{
			$website = '';
		}
	}

	return;
}

?>