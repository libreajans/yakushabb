<?php
/***************************************************************************
 * page_header.php
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define('HEADER_INC', TRUE);

//---[+]---gzip_compression
$do_gzip_compress = FALSE;
if ( $board_config['gzip_compress'] )
{
	$phpver = phpversion();

	$useragent = (isset($_SERVER["HTTP_USER_AGENT"]) ) ? $_SERVER["HTTP_USER_AGENT"] : $HTTP_USER_AGENT;

	if ( $phpver >= '4.0.4pl1' && ( strstr($useragent,'compatible') || strstr($useragent,'Gecko') ) )
	{
		if ( extension_loaded('zlib') )
		{
			if (headers_sent() != TRUE) 
			{ 
				// Here we updated the gzip function.
				// With this method we can get the server up
				// to 10% faster
				$gz_possible = isset($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING']) && eregi('gzip, deflate',$HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING']);
				if ($gz_possible)
				{
					ob_start('ob_gzhandler'); 
				}
			}
		}
	}
	else if ( $phpver > '4.0' )
	{
		if ( strstr($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING'], 'gzip') )
		{
			if ( extension_loaded('zlib') )
			{
				$do_gzip_compress = TRUE;
				ob_start();
				ob_implicit_flush(0);

				header('Content-Encoding: gzip');
			}
		}
	}
}
//---[-]---gzip_compression

// Parse and show the overall header.
$template->set_filenames(array(
	'overall_header' => 'overall_header_p.tpl')
);

// Generate HTML required for Mozilla Navigation bar
// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];

// The following assigns all _common_ variables that may be used at any point in a template.
$template->assign_vars(array(
	'SITE_KEYWORDS' => ($keywords) ? $keywords : $board_config['site_keywords'],
	'L_PDA_INDEX' => $lang['Pda_index'],
	'L_SHOW_FULL_VERSION' => $lang['Show_full_version'],
	'L_SITE_WORDS' => $lang['Site_words'],
	'SITENAME' => $board_config['sitename'],
	'SITE_DESCRIPTION' => $board_config['site_desc'],
	'PAGE_TITLE' => $page_title,
	'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),

	'NAV_LINKS' => $nav_links_html)
);

// cope with private cache control setting
if (!empty($HTTP_SERVER_VARS['SERVER_SOFTWARE']) && strstr($HTTP_SERVER_VARS['SERVER_SOFTWARE'], 'Apache/2'))
{
	header ('Cache-Control: no-cache, pre-check=0, post-check=0');
}
else
{
	header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
}
header ('Expires: 0');
header ('Pragma: no-cache');

$template->pparse('overall_header');
if (($userdata['user_level'] == USER) and $board_config['board_disable'])
{
	message_die(GENERAL_MESSAGE, $closed);
}
?>