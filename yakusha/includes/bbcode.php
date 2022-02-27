<?php
/***************************************************************************
 * bbcode.php
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define("BBCODE_UID_LEN", 10);

// global that holds loaded-and-prepared bbcode templates, so we only have to do
// that stuff once.
$bbcode_tpl = null;

function load_bbcode_template()
{
	global $template;
	$tpl_filename = $template->make_filename('bbcode.tpl');
	$tpl = fread(fopen($tpl_filename, 'r'), filesize($tpl_filename));

	// replace \ with \\ and then ' with \'.
	$tpl = str_replace('\\', '\\\\', $tpl);
	$tpl  = str_replace('\'', '\\\'', $tpl);

	// strip newlines.
	$tpl  = str_replace("\n", '', $tpl);

	// Turn template blocks into PHP assignment statements for the values of $bbcode_tpls..
	$tpl = preg_replace('#<!-- BEGIN (.*?) -->(.*?)<!-- END (.*?) -->#', "\n" . '$bbcode_tpls[\'\\1\'] = \'\\2\';', $tpl);

	$bbcode_tpls = array();

	eval($tpl);

	return $bbcode_tpls;
}

function prepare_bbcode_template($bbcode_tpl)
{
	global $lang;
	$bbcode_tpl['table_mainrow_color'] = str_replace('{TABMRCOLOR}', '\\1', $bbcode_tpl['table_mainrow_color']);
	$bbcode_tpl['table_mainrow_size'] = str_replace('{TABMRSIZE}', '\\1', $bbcode_tpl['table_mainrow_size']);
	$bbcode_tpl['table_mainrow_cs1'] = str_replace('{TABMRCSCOLOR}', '\\1', $bbcode_tpl['table_mainrow_cs']);
	$bbcode_tpl['table_mainrow_cs1'] = str_replace('{TABMRCSSIZE}', '\\2', $bbcode_tpl['table_mainrow_cs1']);
	$bbcode_tpl['table_maincol_color'] = str_replace('{TABMCCOLOR}', '\\1', $bbcode_tpl['table_maincol_color']);
	$bbcode_tpl['table_maincol_size'] = str_replace('{TABMCSIZE}', '\\1', $bbcode_tpl['table_maincol_size']);
	$bbcode_tpl['table_maincol_cs1'] = str_replace('{TABMCCSCOLOR}', '\\1', $bbcode_tpl['table_maincol_cs']);
	$bbcode_tpl['table_maincol_cs1'] = str_replace('{TABMCCSSIZE}', '\\2', $bbcode_tpl['table_maincol_cs1']);
	$bbcode_tpl['table_row_color'] = str_replace('{TABRCOLOR}', '\\1', $bbcode_tpl['table_row_color']);
	$bbcode_tpl['table_row_size'] = str_replace('{TABRSIZE}', '\\1', $bbcode_tpl['table_row_size']);
	$bbcode_tpl['table_row_cs1'] = str_replace('{TABRCSCOLOR}', '\\1', $bbcode_tpl['table_row_cs']);
	$bbcode_tpl['table_row_cs1'] = str_replace('{TABRCSSIZE}', '\\2', $bbcode_tpl['table_row_cs1']);
	$bbcode_tpl['table_col_color'] = str_replace('{TABCCOLOR}', '\\1', $bbcode_tpl['table_col_color']);
	$bbcode_tpl['table_col_size'] = str_replace('{TABCSIZE}', '\\1', $bbcode_tpl['table_col_size']);
	$bbcode_tpl['table_col_cs1'] = str_replace('{TABCCSCOLOR}', '\\1', $bbcode_tpl['table_col_cs']);
	$bbcode_tpl['table_col_cs1'] = str_replace('{TABCCSSIZE}', '\\2', $bbcode_tpl['table_col_cs1']);
	$bbcode_tpl['table_size'] = str_replace('{TABSIZE}', '\\1', $bbcode_tpl['table_size']);
	$bbcode_tpl['table_color'] = str_replace('{TABCOLOR}', '\\1', $bbcode_tpl['table_color']);
	$bbcode_tpl['table_cs1'] = str_replace('{TABCSCOLOR}', '\\1', $bbcode_tpl['table_cs']);
	$bbcode_tpl['table_cs1'] = str_replace('{TABCSSIZE}', '\\2', $bbcode_tpl['table_cs1']);
	$bbcode_tpl['olist_open'] = str_replace('{LIST_TYPE}', '\\1', $bbcode_tpl['olist_open']);
	$bbcode_tpl['color_open'] = str_replace('{COLOR}', '\\1', $bbcode_tpl['color_open']);
	$bbcode_tpl['size_open'] = str_replace('{SIZE}', '\\1', $bbcode_tpl['size_open']);
	$bbcode_tpl['quote_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{USERNAME}', '\\1', $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['code_open'] = str_replace('{L_CODE}', $lang['Code'], $bbcode_tpl['code_open']);
	$bbcode_tpl['img'] = str_replace('{URL}', '\\1', $bbcode_tpl['img']);

	//BBCode Search Mod
	$bbcode_tpl['search'] = str_replace('{KEYWORD}', '\\1', $bbcode_tpl['search']);

	// We do URLs in several different ways..
	$bbcode_tpl['imgwh'] = str_replace('{URL}', '\\3', $bbcode_tpl['imgwh']);
	$bbcode_tpl['imgwh'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['imgwh']);
	$bbcode_tpl['imgwh'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['imgwh']);

	$bbcode_tpl['url1'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url1']);
	$bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);
	$bbcode_tpl['url3'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url3']);
	$bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url4']);
	$bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);
	$bbcode_tpl['google'] = '\'' . $bbcode_tpl['google'] . '\'';
	$bbcode_tpl['google'] = str_replace('{STRING}', "' . str_replace('\\\"', '\"', '\\1') . '", $bbcode_tpl['google']);
	$bbcode_tpl['google'] = str_replace('{QUERY}', "' . urlencode(str_replace('\\\"', '\"', '\\1')) . '", $bbcode_tpl['google']);
	$bbcode_tpl['GVideo'] = str_replace('{GVIDEOID}', '\\1', $bbcode_tpl['GVideo']); 
    $bbcode_tpl['GVideo'] = str_replace('{GVIDEOLINK}', $lang['GVideo_link'], $bbcode_tpl['GVideo']); 
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBEID}', '\\1', $bbcode_tpl['youtube']); 
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBELINK}', $lang['youtube_link'], $bbcode_tpl['youtube']); 
	//--- [ + ]---[ MY BBCode Box ] ----------------
	$bbcode_tpl['marq_open'] = str_replace('{MARQ}', '\\1', $bbcode_tpl['marq_open']);
	$bbcode_tpl['stream'] = str_replace('{URL}', '\\1', $bbcode_tpl['stream']);
	$bbcode_tpl['ram'] = str_replace('{URL}', '\\1', $bbcode_tpl['ram']);
	$bbcode_tpl['flash'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['flash']);
	$bbcode_tpl['flash'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['flash']);
	$bbcode_tpl['flash'] = str_replace('{URL}', '\\3', $bbcode_tpl['flash']);
	$bbcode_tpl['video'] = str_replace('{URL}', '\\3', $bbcode_tpl['video']);
	$bbcode_tpl['video'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['video']);
	$bbcode_tpl['video'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['video']);
	$bbcode_tpl['align_open'] = str_replace('{ALIGN}', '\\1', $bbcode_tpl['align_open']);
	$bbcode_tpl['font_open']  = str_replace('{FONT}', '\\1',  $bbcode_tpl['font_open']);
	$bbcode_tpl['left'] = str_replace('{URL}', '\\1', $bbcode_tpl['left']); 
	$bbcode_tpl['right'] = str_replace('{URL}', '\\1', $bbcode_tpl['right']); 
	//--- [ -]---[ Advanced BBCode Box MOD LT ] ----------------
	define("BBCODE_TPL_READY", true);
	return $bbcode_tpl;
}


function bbencode_second_pass($text, $uid)
{
	global $lang, $bbcode_tpl, $userdata, $phpEx, $u_login_logout;
	
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// First: If there isn't a "[" and a "]" in the message, don't bother.
	if (! (strpos($text, "[") && strpos($text, "]")) )
	{
		// Remove padding, return.
		$text = substr($text, 1);
		return $text;
	}

	// Only load the templates ONCE..
	if (!defined("BBCODE_TPL_READY"))
	{
		// load templates from file into array.
		$bbcode_tpl = load_bbcode_template();

		// prepare array for use in regexps.
		$bbcode_tpl = prepare_bbcode_template($bbcode_tpl);
	}

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_second_pass_code($text, $uid, $bbcode_tpl);

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = str_replace("[quote:$uid]", $bbcode_tpl['quote_open'], $text);
	$text = str_replace("[/quote:$uid]", $bbcode_tpl['quote_close'], $text);

	// New one liner to deal with opening quotes with usernames...
	// replaces the two line version that I had here before..
	$text = preg_replace("/\[quote:$uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $text);

	// [list] and [list=x] for (un)ordered lists.
	// unordered lists
	$text = str_replace("[list:$uid]", $bbcode_tpl['ulist_open'], $text);
	// li tags
	$text = str_replace("[*:$uid]", $bbcode_tpl['listitem'], $text);
	// ending tags
	$text = str_replace("[/list:u:$uid]", $bbcode_tpl['ulist_close'], $text);
	$text = str_replace("[/list:o:$uid]", $bbcode_tpl['olist_close'], $text);
	// Ordered lists
	$text = preg_replace("/\[list=([a1]):$uid\]/si", $bbcode_tpl['olist_open'], $text);
	// [table] and [/table] for making tables.

	// beginning code [table], along with attributes
	$text = str_replace("[table:$uid]", $bbcode_tpl['table_open'], $text);
	$text = preg_replace("/\[table color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_color'], $text);
	$text = preg_replace("/\[table fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_size'], $text);
	$text = preg_replace("/\[table color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_cs1'], $text);
	// mainrow tag [mrow], along with attributes
	$text = str_replace("[mrow:$uid]", $bbcode_tpl['table_mainrow'], $text);
	$text = preg_replace("/\[mrow color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_mainrow_color'], $text);
	$text = preg_replace("/\[mrow fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_mainrow_size'], $text);
	$text = preg_replace("/\[mrow color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_mainrow_cs1'], $text);
	// maincol tag [mcol], along with attributes
	$text = str_replace("[mcol:$uid]", $bbcode_tpl['table_maincol'], $text);
	$text = preg_replace("/\[mcol color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_maincol_color'], $text);
	$text = preg_replace("/\[mcol fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_maincol_size'], $text);
	$text = preg_replace("/\[mcol color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_maincol_cs1'], $text);
	// row tag [row], along with attributes
	$text = str_replace("[row:$uid]", $bbcode_tpl['table_row'], $text);
	$text = preg_replace("/\[row color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_row_color'], $text);
	$text = preg_replace("/\[row fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_row_size'], $text);
	$text = preg_replace("/\[row color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_row_cs1'], $text);
	// column tag [col], along with attributes
	$text = str_replace("[col:$uid]", $bbcode_tpl['table_col'], $text);
	$text = preg_replace("/\[col color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_col_color'], $text);
	$text = preg_replace("/\[col fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_col_size'], $text);
	$text = preg_replace("/\[col color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_col_cs1'], $text);
	// ending tag [/table]
	$text = str_replace("[/table:$uid]", $bbcode_tpl['table_close'], $text);

	// colours
	$text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['color_open'], $text);
	$text = str_replace("[/color:$uid]", $bbcode_tpl['color_close'], $text);

	// size
	$text = preg_replace("/\[size=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['size_open'], $text);
	$text = str_replace("[/size:$uid]", $bbcode_tpl['size_close'], $text);

	// [b] and [/b] for bolding text.
	$text = str_replace("[b:$uid]", $bbcode_tpl['b_open'], $text);
	$text = str_replace("[/b:$uid]", $bbcode_tpl['b_close'], $text);

	// [u] and [/u] for underlining text.
	$text = str_replace("[u:$uid]", $bbcode_tpl['u_open'], $text);
	$text = str_replace("[/u:$uid]", $bbcode_tpl['u_close'], $text);

	// [i] and [/i] for italicizing text.
	$text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
	$text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);

	// Patterns and replacements for URL and email tags..
	$patterns = array();
	$replacements = array();

	// [img]image_url_here[/img] code..
	// This one gets first-passed..
	$patterns[] = "#\[img:$uid\]([^?](?:[^\[]+|\[(?!url))*?)\[/img:$uid\]#i";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['img'];
	}
	//BBCode Search Mod

	$patterns[] = "#\[search:$uid\](.*?)\[/search:$uid\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['search'];
	}

	// LEFT-RIGHT-start 
	// [left]image_url_here[/left] code.. 
	// This one gets first-passed.. 
	$patterns[6] = "#\[left:$uid\](.*?)\[/left:$uid\]#si"; 
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[6] = $replacer;
	}
	else
	{
		$replacements[6] = $bbcode_tpl['left']; 
	}

	// [right]image_url_here[/right] code.. 
	// This one gets first-passed.. 
	$patterns[7] = "#\[right:$uid\](.*?)\[/right:$uid\]#si"; 
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[7] = $replacer;
	}
	else
	{
		$replacements[7] = $bbcode_tpl['right']; 
	}
	// LEFT-RIGHT-end 
	
	// [img width= height= ] and [/img] code..
	$patterns[95] = "#\[img width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9]):$uid\](.*?)\[/img:$uid\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[95] = $replacer;
	}
	else
	{
	$replacements[95] = $bbcode_tpl['imgwh'];
	}

	// matches a [url]xxxx://www.phpbb.com[/url] code..
	$patterns[] = "#\[url\]([\w]+?://[^ \"\n\r\t<]*?)\[/url\]#is";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['url1'];
	}

	// [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
	$patterns[] = "#\[url\]((www|ftp)\.[^ \"\n\r\t<]*?)\[/url\]#is";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['url2'];
	}

	// [url=xxxx://www.phpbb.com]phpBB[/url] code..
	$patterns[] = "#\[url=([\w]+?://[^ \"\n\r\t<]*?)\]([^?\n\r\t].*?)\[/url\]#is";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'] )
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['url3'];
	}

	// [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
	$patterns[] = "#\[url=((www|ftp)\.[^ \"\n\r\t<]*?)\]([^?\n\r\t].*?)\[/url\]#is";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['url4'];
	}

	// [email]user@domain.tld[/email] code..
	$patterns[] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['email'];
	}

	//[google]string for search[/google] code..
	$patterns[] = "#\[google\](.*?)\[/google\]#ise";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['google'];
	}
	
	 // [marquee=left/right/up/down]Marquee Code[/marquee] code..
	$text = preg_replace("/\[marq=(left|right|up|down):$uid\]/si", $bbcode_tpl['marq_open'], $text);
	$text = str_replace("[/marq:$uid]", $bbcode_tpl['marq_close'], $text);

	// [ram]Ram URL[/ram] code..
	$patterns[] = "#\[ram:$uid\](.*?)\[/ram:$uid\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['ram'];
	}
	
	// [stream]Sound URL[/stream] code..
	$patterns[] = "#\[stream:$uid\](.*?)\[/stream:$uid\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['stream'];
	}

	// [flash width=X height=X]Flash URL[/flash] code..
	$patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/flash:$uid\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
	$replacements[] = $bbcode_tpl['flash'];
	}

	// [video width=X height=X]Video URL[/video] code..
	$patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/video:$uid\]#si";
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
	$replacements[] = $bbcode_tpl['video'];
	}

	$text = preg_replace($patterns, $replacements, $text);

	$text = str_replace("[sub:$uid]", '<sub>', $text);
	$text = str_replace("[/sub:$uid]", '</sub>', $text);

	// [sup]Superscript[/sup] code..
	$text = str_replace("[sup:$uid]", '<sup>', $text);
	$text = str_replace("[/sup:$uid]", '</sup>', $text);

	// [GVideo]GVideo URL[/GVideo] code.. 
    $patterns[] = "#\[GVideo\]http://video.google.com/videoplay\?docid=([0-9A-Za-z-_]*)[^[]*\[/GVideo\]#is"; 
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['GVideo'];
	}
     // [youtube]YouTube URL[/youtube] code.. 
    $patterns[] = "#\[youtube\]http://(?:www\.)?youtube.com/watch\?v=([0-9A-Za-z-_]{11})[^[]*\[/youtube\]#is"; 
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[] = $replacer;
	}
	else
	{
		$replacements[] = $bbcode_tpl['youtube'];
	} 

	//left için
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[6] = $replacer;
	}
	else
	{
		$replacements[6] = $bbcode_tpl['left'];
	} 

	if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
	{
		$replacements[7] = $replacer;
	}
	else
	{
		$replacements[7] = $bbcode_tpl['right'];
	} 

	//--- [ + ]---[ MY BBCode Box ] ----------------
	// [align=left/center/right/justify]Formatted Code[/align] code..
	$text = preg_replace("/\[align=(left|right|center|justify):$uid\]/si", $bbcode_tpl['align_open'], $text);
	$text = str_replace("[/align:$uid]", $bbcode_tpl['align_close'], $text);

	// [font=fonttype]text[/font] code..
	$text = preg_replace("/\[font=(.*?):$uid\]/si", $bbcode_tpl['font_open'], $text);
	$text = str_replace("[/font:$uid]", $bbcode_tpl['font_close'], $text);

	// [hr]
	$text = str_replace("[hr:$uid]", $bbcode_tpl['hr'], $text);

	// LEFT-RIGHT-start 
	// [left]image_url_here[/left] code.. 
	$text = preg_replace("#\[left\](([a-z]+?)://([^ \n\r]+?))\[/left\]#si", "[left:$uid]\\1[/left:$uid]", $text); 

	// [right]image_url_here[/right] code.. 
	$text = preg_replace("#\[right\](([a-z]+?)://([^ \n\r]+?))\[/right\]#si", "[right:$uid]\\1[/right:$uid]", $text); 
	// LEFT-RIGHT-end 

	// [you] bbcode - kendi tercihim yol ile
	global $userdata;
	$text = str_replace("[you]", $userdata['username'], $text);
	//--- [ - ]---[ MY BBCode Box ] ----------------

	$text = preg_replace($patterns, $replacements, $text);

	// Remove our padding from the string..
	$text = substr($text, 1);

	return $text;

} // bbencode_second_pass()

// Need to initialize the random numbers only ONCE
mt_srand( (double) microtime() * 1000000);

function make_bbcode_uid()
{
	// Unique ID for this message..
	$uid = dss_rand();
	$uid = substr($uid, 0, BBCODE_UID_LEN);
	return $uid;
}

function bbencode_first_pass($text, $uid)
{
	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_first_pass_pda($text, $uid, '[code]', '[/code]', '', true, '');

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = bbencode_first_pass_pda($text, $uid, '[quote]', '[/quote]', '', false, '');
	$text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\"]");

	// [list] and [list=x] for (un)ordered lists.
	$open_tag = array();
	$open_tag[0] = "[list]";

	// [table] and [/table] for making tables.
	// beginning code [table], along with attributes
	$text = preg_replace("#\[table\](.*?)\[/table\]#si", "[table:$uid]\\1[/table:$uid]", $text);
	$text = preg_replace("#\[table color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/table\]#si", "[table color=\\1:$uid]\\2[/table:$uid]", $text);
	$text = preg_replace("#\[table fontsize=([1-2]?[0-9])\](.*?)\[/table\]#si", "[table fontsize=\\1:$uid]\\2[/table:$uid]", $text);
	$text = preg_replace("#\[table color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)\[/table\]#si", "[table color=\\1 fontsize=\\2:$uid]\\3[/table:$uid]", $text);
	$text = preg_replace("#\[table fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/table\]#si", "[table color=\\2 fontsize=\\1:$uid]\\3[/table:$uid]", $text);
	// mainrow tag [mrow], along with attributes
	$text = preg_replace("#\[mrow\](.*?)#si", "[mrow:$uid]\\1", $text);
	$text = preg_replace("#\[mrow color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mrow color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mrow fontsize=([1-2]?[0-9])\](.*?)#si", "[mrow fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mrow color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[mrow color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[mrow fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mrow color=\\2 fontsize=\\1:$uid]\\3", $text);
	// maincol tag [mcol], along with attributes
	$text = preg_replace("#\[mcol\](.*?)#si", "[mcol:$uid]\\1", $text);
	$text = preg_replace("#\[mcol color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mcol color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mcol fontsize=([1-2]?[0-9])\](.*?)#si", "[mcol fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mcol color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[mcol color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[mcol fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mcol color=\\2 fontsize=\\1:$uid]\\3", $text);
	// row tag [row], along with attributes
	$text = preg_replace("#\[row\](.*?)#si", "[row:$uid]\\1", $text);
	$text = preg_replace("#\[row color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[row color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[row fontsize=([1-2]?[0-9])\](.*?)#si", "[row fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[row color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[row color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[row fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[row color=\\2 fontsize=\\1:$uid]\\3", $text);
	// column tag [col], along with attributes
	$text = preg_replace("#\[col\](.*?)#si", "[col:$uid]\\1", $text);
	$text = preg_replace("#\[col color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[col color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[col fontsize=([1-2]?[0-9])\](.*?)#si", "[col fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[col color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[col color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[col fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[col color=\\2 fontsize=\\1:$uid]\\3", $text);

	// unordered..
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:u]", false, 'replace_listitems');

	$open_tag[0] = "[list=1]";
	$open_tag[1] = "[list=a]";

	// ordered.
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:o]",  false, 'replace_listitems');

	// [color] and [/color] for setting text color
	$text = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "[color=\\1:$uid]\\2[/color:$uid]", $text);

	// [size] and [/size] for setting text size
	$text = preg_replace("#\[size=([1-2]?[0-9])\](.*?)\[/size\]#si", "[size=\\1:$uid]\\2[/size:$uid]", $text);

	// [b] and [/b] for bolding text.
	$text = preg_replace("#\[b\](.*?)\[/b\]#si", "[b:$uid]\\1[/b:$uid]", $text);

	// [u] and [/u] for underlining text.
	$text = preg_replace("#\[u\](.*?)\[/u\]#si", "[u:$uid]\\1[/u:$uid]", $text);

	// [i] and [/i] for italicizing text.
	$text = preg_replace("#\[i\](.*?)\[/i\]#si", "[i:$uid]\\1[/i:$uid]", $text);

	// [img]image_url_here[/img] code..
	$text = preg_replace("#\[img\]((http|ftp|https|ftps)://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|gif|png)))\[/img\]#sie", "'[img:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);

	//--- [ +]---[ MY BBCode Box ] ----------------
	//BBCode Search Mod
	$text = preg_replace("#\[search\](.*?)\[/search\]#si", "[search:$uid]\\1[/search:$uid]", $text);

	// [img width= heigth=] and [/img] code..
	$text = preg_replace("#\[img width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/img\]#si","[img width=\\1 height=\\2:$uid\]\\3[/img:$uid]", $text);

	// [marquee=left/right/up/down]Marquee Code[/marquee] code..
	$text = preg_replace("#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si", "[marq=\\1:$uid]\\2[/marq:$uid]", $text);

	// [ram]Ram URL[/ram] code..
	$text = preg_replace("#\[ram\](.*?)\[/ram\]#si", "[ram:$uid]\\1[/ram:$uid]", $text);

	// [stream]Sound URL[/stream] code..
	$text = preg_replace("#\[stream\](.*?)\[/stream\]#si", "[stream:$uid]\\1[/stream:$uid]", $text);

	// [flash width=X height=X]Flash URL[/flash] code..
	$text = preg_replace("#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/flash\]#si","[flash width=\\1 height=\\2:$uid\]\\3[/flash:$uid]", $text);

	// [video width=X height=X]Video URL[/video] code..
	$text = preg_replace("#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/video\]#si","[video width=\\1 height=\\2:$uid\]\\3[/video:$uid]", $text);

	// [sub]Subscrip[/sub] code..
	$text = preg_replace("#\[sub\](.*?)\[/sub\]#si", "[sub:$uid]\\1[/sub:$uid]", $text);

	// [sup]Superscript[/sup] code..
	$text = preg_replace("#\[sup\](.*?)\[/sup\]#si", "[sup:$uid]\\1[/sup:$uid]", $text);

	// [align=left/center/right/justify]Formatted Code[/align] code..
	$text = preg_replace("#\[align=(left|right|center|justify)\](.*?)\[/align\]#si", "[align=\\1:$uid]\\2[/align:$uid]", $text);

	// [font=fonttype]text[/font] code..
	$text = preg_replace("#\[font=(.*?)\](.*?)\[/font\]#si", "[font=\\1:$uid]\\2[/font:$uid]", $text);

	// [hr]
	$text = preg_replace("#\[hr\]#si", "[hr:$uid]", $text);

	// [left]image_url_here[/left] code.. 
	$text = preg_replace("#\[left\](([a-z]+?)://([^ \n\r]+?))\[/left\]#si", "[left:$uid]\\1[/left:$uid]", $text); 

	// [right]image_url_here[/right] code.. 
	$text = preg_replace("#\[right\](([a-z]+?)://([^ \n\r]+?))\[/right\]#si", "[right:$uid]\\1[/right:$uid]", $text); 
	//--- [ - ]---[ MY BBCode Box ] ----------------

	// Remove our padding from the string..
	return substr($text, 1);;

} // bbencode_first_pass()

function bbencode_first_pass_pda($text, $uid, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $func, $open_regexp_replace = false)
{
	$open_tag_count = 0;

	if (!$close_tag_new || ($close_tag_new == ''))
	{
		$close_tag_new = $close_tag;
	}

	$close_tag_length = strlen($close_tag);
	$close_tag_new_length = strlen($close_tag_new);
	$uid_length = strlen($uid);

	$use_function_pointer = ($func && ($func != ''));

	$stack = array();

	if (is_array($open_tag))
	{
		if (0 == count($open_tag))
		{
			// No opening tags to match, so return.
			return $text;
		}
		$open_tag_count = count($open_tag);
	}
	else
	{
		// only one opening tag. make it into a 1-element array.
		$open_tag_temp = $open_tag;
		$open_tag = array();
		$open_tag[0] = $open_tag_temp;
		$open_tag_count = 1;
	}

	$open_is_regexp = false;

	if ($open_regexp_replace)
	{
		$open_is_regexp = true;
		if (!is_array($open_regexp_replace))
		{
			$open_regexp_temp = $open_regexp_replace;
			$open_regexp_replace = array();
			$open_regexp_replace[0] = $open_regexp_temp;
		}
	}

	if ($mark_lowest_level && $open_is_regexp)
	{
		message_die(GENERAL_ERROR, "Unsupported operation for bbcode_first_pass_pda().");
	}

	// Start at the 2nd char of the string, looking for opening tags.
	$curr_pos = 1;
	while ($curr_pos && ($curr_pos < strlen($text)))
	{
		$curr_pos = strpos($text, "[", $curr_pos);

		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos)
		{
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending tag.
			$found_start = false;
			$which_start_tag = "";
			$start_tag_index = -1;

			for ($i = 0; $i < $open_tag_count; $i++)
			{
				// Grab everything until the first "]"...
				$possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);

				//
				// We're going to try and catch usernames with "[' characters.
				//
				if( preg_match('#\[quote=\\\&quot;#si', $possible_start, $match) && !preg_match('#\[quote=\\\&quot;(.*?)\\\&quot;\]#si', $possible_start) )
				{
					// OK we are in a quote tag that probably contains a ] bracket.
					// Grab a bit more of the string to hopefully get all of it..
					if ($close_pos = strpos($text, '&quot;]', $curr_pos + 14))
					{
						if (strpos(substr($text, $curr_pos + 14, $close_pos - ($curr_pos + 14)), '[quote') === false)
						{
							$possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 7);
						}
					}
				}

				// Now compare, either using regexp or not.
				if ($open_is_regexp)
				{
					$match_result = array();
					if (preg_match($open_tag[$i], $possible_start, $match_result))
					{
						$found_start = true;
						$which_start_tag = $match_result[0];
						$start_tag_index = $i;
						break;
					}
				}
				else
				{
					// straightforward string comparison.
					if (0 == strcasecmp($open_tag[$i], $possible_start))
					{
						$found_start = true;
						$which_start_tag = $open_tag[$i];
						$start_tag_index = $i;
						break;
					}
				}
			}

			if ($found_start)
			{
				// We have an opening tag.
				// Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
				$match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
				array_push($stack, $match);
				//
				// Rather than just increment $curr_pos
				// Set it to the ending of the tag we just found
				// Keeps error in nested tag from breaking out
				// of table structure..
				//
				$curr_pos += strlen($possible_start);
			}
			else
			{
				// check for a closing tag..
				$possible_end = substr($text, $curr_pos, $close_tag_length);
				if (0 == strcasecmp($close_tag, $possible_end))
				{
					// We have an ending tag.
					// Check if we've already found a matching starting tag.
					if (sizeof($stack) > 0)
					{
						// There exists a starting tag.
						$curr_nesting_depth = sizeof($stack);
						// We need to do 2 replacements now.
						$match = array_pop($stack);
						$start_index = $match['pos'];
						$start_tag = $match['tag'];
						$start_length = strlen($start_tag);
						$start_tag_index = $match['index'];

						if ($open_is_regexp)
						{
							$start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
						}

						// everything before the opening tag.
						$before_start_tag = substr($text, 0, $start_index);

						// everything after the opening tag, but before the closing tag.
						$between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);

						// Run the given function on the text between the tags..
						if ($use_function_pointer)
						{
							$between_tags = $func($between_tags, $uid);
						}

						// everything after the closing tag.
						$after_end_tag = substr($text, $curr_pos + $close_tag_length);

						// Mark the lowest nesting level if needed.
						if ($mark_lowest_level && ($curr_nesting_depth == 1))
						{
							if ($open_tag[0] == '[code]')
							{
								$code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
								$code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
								$between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
							}
							$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth:$uid]";
							$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth:$uid]";
						}
						else
						{
							if ($open_tag[0] == '[code]')
							{
								$text = $before_start_tag . '&#91;code&#93;';
								$text .= $between_tags . '&#91;/code&#93;';
							}
							else
							{
								if ($open_is_regexp)
								{
									$text = $before_start_tag . $start_tag;
								}
								else
								{
									$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$uid]";
								}
								$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$uid]";
							}
						}

						$text .= $after_end_tag;

						// Now.. we've screwed up the indices by changing the length of the string.
						// So, if there's anything in the stack, we want to resume searching just after it.
						// otherwise, we go back to the start.
						if (sizeof($stack) > 0)
						{
							$match = array_pop($stack);
							$curr_pos = $match['pos'];
//							bbcode_array_push($stack, $match);
//							++$curr_pos;
						}
						else
						{
							$curr_pos = 1;
						}
					}
					else
					{
						// No matching start tag found. Increment pos, keep going.
						++$curr_pos;
					}
				}
				else
				{
					// No starting tag or ending tag.. Increment pos, keep looping.,
					++$curr_pos;
				}
			}
		}
	} // while

	return $text;

} // bbencode_first_pass_pda()

function bbencode_second_pass_code($text, $uid, $bbcode_tpl)
{
	global $lang;

	$code_start_html = $bbcode_tpl['code_open'];
	$code_end_html =  $bbcode_tpl['code_close'];

	// First, do all the 1st-level matches. These need an htmlspecialchars() run,
	// so they have to be handled differently.
	$match_count = preg_match_all("#\[code:1:$uid\](.*?)\[/code:1:$uid\]#si", $text, $matches);

	for ($i = 0; $i < $match_count; $i++)
	{
		$before_replace = $matches[1][$i];
		$after_replace = $matches[1][$i];

		// Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
		$after_replace = str_replace("  ", "&nbsp; ", $after_replace);
		// now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
		$after_replace = str_replace("  ", " &nbsp;", $after_replace);

		// Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
		$after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);

		// now Replace space occurring at the beginning of a line
		$after_replace = preg_replace("/^ {1}/m", '&nbsp;', $after_replace);

		$str_to_match = "[code:1:$uid]" . $before_replace . "[/code:1:$uid]";

		$replacement = $code_start_html;
		$replacement .= $after_replace;
		$replacement .= $code_end_html;

		$text = str_replace($str_to_match, $replacement, $text);
	}

	// Now, do all the non-first-level matches. These are simple.
	$text = str_replace("[code:$uid]", $code_start_html, $text);
	$text = str_replace("[/code:$uid]", $code_end_html, $text);

	return $text;

} // bbencode_second_pass_code()

function make_clickable($text)
{
    global $board_config, $userdata, $lang, $phpEx, $u_login_logout;
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// ---- [ + ] -------- Hide links from unregistered users mod -----
	if ( !$userdata['session_logged_in'] and $board_config['hide_links'] )
	{
		$replacer .= $lang['Links_Allowed_For_Registered_Only'];
		$replacer .= sprintf($lang['Get_Registered'], "<a href=\"" . append_sid('profile.' . $phpEx . '?mode=register') . "\">", "</a>");
		$replacer .= sprintf($lang['Enter_Forum'], "<a href=\"" . append_sid($u_login_logout) . "\">", "</a>");

		//@$ret = preg_replace('/<a/', '<i', $ret);
		$ret = preg_replace("#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#is", $replacer, $ret);
		$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#is", $replacer, $ret);
		$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", $replacer, $ret);
		$ret .= '</i>';
	}
	else
	{
		// matches an "xxxx://yyyy" URL at the start of a line, or after a space.
		$url_meat = "\w\#$%&~/.\-;:=,?@\[\]+";
		$max_url_length = 60;
		$prefix_length = 40;
		$suffix_length = $max_url_length - $prefix_length - 3; // -3 for "..." in the middle
		$patterns[] = "#(^|[\n ])([\w]+?://[" . $url_meat . "]{1," . $max_url_length . "})($|[^" . $url_meat . "])#is";
		$replacements[] = "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>\\3";
		$patterns[] = "#(^|[\n ])([\w]+?://[" . $url_meat . "]{" . $prefix_length . "})([" . $url_meat . "]+)([" . $url_meat . "]{" . $suffix_length . "})($|[^" . $url_meat . "])#is";
		$replacements[] = "\\1<a href=\"\\2\\3\\4\" target=\"_blank\">\\2...\\4</a>\\5";
		$ret = preg_replace($patterns, $replacements, $ret);

		//$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
		$patlazy[] = "#(^|[\n ])((www|ftp)\.[" . $url_meat . "]{1," . $max_url_length . "})($|[^" . $url_meat . "])#is";
		$replazy[] = "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>\\4";
		$patlazy[] = "#(^|[\n ])((www|ftp)\.[" . $url_meat . "]{" . $prefix_length . "})([" . $url_meat . "]+)([" . $url_meat . "]{" . $suffix_length . "})($|[^" . $url_meat . "])#is";
		$replazy[] = "\\1<a href=\"http://\\2\\4\\5\" target=\"_blank\">\\2...\\5</a>\\6";
		$ret = preg_replace($patlazy, $replazy, $ret);
		$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
	}
	// ---- [ - ] -------- Hide links from unregistered users mod -----
	// Remove our padding..
	$ret = substr($ret, 1);
	return($ret);
}

function undo_make_clickable($text)
{
	$text = preg_replace("#<!-- BBCode auto-link start --><a href=\"(.*?)\" target=\"_blank\">.*?</a><!-- BBCode auto-link end -->#i", "\\1", $text);
	$text = preg_replace("#<!-- BBcode auto-mailto start --><a href=\"mailto:(.*?)\">.*?</a><!-- BBCode auto-mailto end -->#i", "\\1", $text);
	return $text;
}

function undo_htmlspecialchars($input)
{
	$input = preg_replace("/&gt;/i", ">", $input);
	$input = preg_replace("/&lt;/i", "<", $input);
	$input = preg_replace("/&quot;/i", "\"", $input);
	$input = preg_replace("/&amp;/i", "&", $input);

	return $input;
}

function replace_listitems($text, $uid)
{
	$text = str_replace("[*]", "[*:$uid]", $text);

	return $text;
}

function escape_slashes($input)
{
	$output = str_replace('/', '\/', $input);
	return $output;
}

function bbcode_array_push(&$stack, $value)
{
   $stack[] = $value;
   return(sizeof($stack));
}

function bbcode_array_pop(&$stack)
{
   $arrSize = count($stack);
   $x = 1;

   while(list($key, $val) = each($stack))
   {
      if($x < count($stack))
      {
	 		$tmpArr[] = $val;
      }
      else
      {
	 		$return_val = $val;
      }
      $x++;
   }
   $stack = $tmpArr;

   return($return_val);
}

function smilies_pass($message)
{
	static $orig, $repl;

	if (!isset($orig))
	{
		global $db, $board_config;
		$orig = $repl = array();

		$sql = 'SELECT * FROM ' . SMILIES_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not obtain smilies data", "", __LINE__, __FILE__, $sql);
		}
		$smilies = $db->sql_fetchrowset($result);

		if (count($smilies))
		{
			usort($smilies, 'smiley_sort');
		}

		for ($i = 0; $i < count($smilies); $i++)
		{
			$orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
			$repl[] = '<img src="'. $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
		}
	}

	if (count($orig))
	{
		$message = preg_replace($orig, $repl, ' ' . $message . ' ');
		$message = substr($message, 1, -1);
	}
	
	return $message;
}

function smiley_sort($a, $b)
{
	if ( strlen($a['code']) == strlen($b['code']) )
	{
		return 0;
	}

	return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

?>