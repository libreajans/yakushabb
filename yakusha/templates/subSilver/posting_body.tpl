<!-- [+]-----[ My BBCode Box LT ] ------------ -->
<script language="javascript" type="text/javascript" src="images/bbcode_box/bbcode_box.js"></script>
<!-- [+]-----[ My BBCode Box LT ] ------------ -->

<!-- BEGIN privmsg_extensions -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
<tr>
<td valign="top" align="center" width="100%">
<table height="40" cellspacing="2" cellpadding="2" border="0">
<tr valign="middle">
<td>{INBOX_IMG}</td>
<td><span class="cattitle">{INBOX_LINK}&nbsp;&nbsp;</span></td>
<td>{SENTBOX_IMG}</td>
<td><span class="cattitle">{SENTBOX_LINK}&nbsp;&nbsp;</span></td>
<td>{OUTBOX_IMG}</td>
<td><span class="cattitle">{OUTBOX_LINK}&nbsp;&nbsp;</span></td>
<td>{SAVEBOX_IMG}</td>
<td><span class="cattitle">{SAVEBOX_LINK}&nbsp;&nbsp;</span></td>
</tr>
</table>
</td>
</tr>
</table>

<br clear="all" />
<!-- END privmsg_extensions -->

<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>

{POST_PREVIEW_BOX}
{ERROR_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left">
<span  class="nav">
<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
<!-- BEGIN switch_parent_link -->
&raquo; <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
<!-- END switch_parent_link -->
<!-- BEGIN switch_not_privmsg -->
<!-- IF PARENT_FORUM -->
&raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a>
<!-- ENDIF -->
&raquo; <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a>
<!-- BEGIN reply_mode -->
&raquo; <a href="{U_VIEW_TOPIC}" class="nav">{TOPIC_SUBJECT}</a>
<!-- END reply_mode -->
<!-- END switch_not_privmsg -->
</span>
</td>
</tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th class="thHead" colspan="2" height="25"><b>{L_POST_A}</b></th>
</tr>
<!-- BEGIN switch_username_select -->
<tr>
<td class="row1"><span class="gen"><b>{L_USERNAME}</b></span></td>
<td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span></td>
</tr>
<!-- END switch_username_select -->
<!-- BEGIN switch_privmsg -->
<tr>
<td class="row1"><span class="gen"><b>{L_USERNAME}</b></span></td>
<td class="row2"><span class="genmed"><input type="text"  class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" />&nbsp;<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></span></td>
</tr>
<input type="hidden" name="reply" value="{REPLY}" /><input type="hidden" name="id" value="{REPLY_ID}" />
<!-- END switch_privmsg -->
<!-- BEGIN switch_show_edit_notes -->
<!-- BEGIN edit_notes -->
<tr>
<td class="row1"><span class="gen"><b>{L_EDIT_NOTES}</b></span></td>
<td class="row2"><span class="gensmall">&nbsp;{edit_notes.L_EDITED_BY}</span><br />
<span class="genmed">
<input type="text" class="post" name="new_edit_notes[{edit_notes.S_NOTE_ID}]" style="width: 600px;" maxlength="255" size="45" value="{edit_notes.NOTE}" />
</span></td>
</tr>
<!-- END edit_notes -->

<tr>
<td class="row1"><span class="gen"><b>{L_EDIT_NOTES}</b></span></td>
<td class="row2"><span class="genmed">
<input type="text" class="post" name="new_edit_note" style="width: 500px;" maxlength="255" size="45" tabindex="1" value="{S_NEW_EDIT_NOTE}" /></span></td>
</tr>
<!-- END switch_show_edit_notes -->
<tr>
<td class="row1" width="22%"><span class="gen"><b>{L_SUBJECT}</b></span></td>
<td class="row2" width="78%">
<!-- BEGIN switch_type_toggle -->
<div class="gen">{S_TYPE_TOGGLE}</div>
<!-- END switch_type_toggle -->
<span class="gen"><input type="text" name="subject" size="45" maxlength="100" style="width: 500px" tabindex="2" class="post" value="{SUBJECT}" /></span> </td>
</tr>
<tr>
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
<td><span class="gen"><b>{L_MESSAGE_BODY}</b></span> </td>
</tr>
<tr>
<td valign="middle" align="center"> <br />
<table width="100" border="0" cellspacing="0" cellpadding="5">
<tr align="center">
<td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><b>{L_EMOTICONS}</b></td>
</tr>
<!-- BEGIN smilies_row -->
<tr align="center" valign="middle">
<!-- BEGIN smilies_col -->
<td><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></td>
<!-- END smilies_col -->
</tr>
<!-- END smilies_row -->
<!-- BEGIN switch_smilies_extra -->
<tr align="center">
<td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=350');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
</tr>
<!-- END switch_smilies_extra -->
<tr>
<td colspan="4">
<center><b><span class="gen"><a href="javascript:void(0);" onclick="window.open('http://www.postimage.org/index.php?mode=phpbb&tpl=.&forumurl=' + escape(document.location.href), '_imagehost', 'resizable=yes,width=500,height=400');return false;">{L_ADD_IMAGE}</a></span></b></center>
</td>
</tr>

</table>
</td>
</tr>
</table>
</td>
<!-- [+]-----[ My BBCode Box LT ] ------------ -->
<td class="row2" valign="top"><span class="gen"><span class="genmed"></span>
<table id="posttable" width="100%" border="1" bordercolor="#C0C0C0" style="border-collapse: collapse;" cellspacing="0" cellpadding="0" valign="top">
<tr align="right" valign="middle">
<td valign="center">
<table width="100%" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td height="30" background="images/bbcode_box/bg.gif" valign="middle">
<img src="images/bbcode_box/dots.gif" style="padding-left: 4px;"></td>
<td background="images/bbcode_box/bg.gif">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" width="70%">
<select style="height: 20px;" name="ft" onChange="BBCft();this.selectedIndex=0;" onMouseOver="helpline('ft')">
<option style="color:black; background-color: #FFFFFF; selected="selected">{L_FONT_TYPE}</option>
<option style="color:black; background-color: #FFFFFF; font-family: Arial;" value="Arial" class="genmed">Arial</option>
<option style="color:black; background-color: #FFFFFF; font-family: Arial Black;" value="Arial Black" class="genmed">Arial Black</option>
<option style="color:black; background-color: #FFFFFF; font-family: Century Gothic;" value="Century Gothic" class="genmed">Century Gothic</option>
<option style="color:black; background-color: #FFFFFF; font-family: Comic Sans MS;" value="Comic Sans MS" class="genmed">Comic Sans MS</option>
<option style="color:black; background-color: #FFFFFF; font-family: Courier New;" value="Courier New" class="genmed">Courier New</option>
<option style="color:black; background-color: #FFFFFF; font-family: Georgia;" value="Georgia" class="genmed">Georgia</option>
<option style="color:black; background-color: #FFFFFF; font-family: Lucida Console;"value="Lucida Console">Lucida Console</option>
<option style="color:black; background-color: #FFFFFF; font-family: Microsoft Sans Serif;" value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option>
<option style="color:black; background-color: #FFFFFF; font-family: Symbol;" value="Symbol" class="genmed">Symbol</option>
<option style="color:black; background-color: #FFFFFF; font-family: Tahoma;" value="Tahoma" class="genmed">Tahoma</option>
<option style="color:black; background-color: #FFFFFF; font-family: Trebuchet;" value="Trebuchet" class="genmed">Trebuchet</option>
<option style="color:black; background-color: #FFFFFF; font-family: Times New Roman;" value="Times New Roman" class="genmed">Times New Roman</option>
<option style="color:black; background-color: #FFFFFF; font-family: Verdana;" value="Verdana" class="genmed">Verdana</option>
</select>

<select style="height: 20px;" name="fs" onChange="BBCfs();this.selectedIndex=0;" onMouseOver="helpline('fs')">
<option style="color:black; background-color: #FFFFFF; font-size: 8; class="genmed" selected="selected">{L_FONT_SIZE}</option>
<option style="color:black; background-color: #FFFFFF; font-size: 8;" value="8" class="genmed">{L_FONT_TINY}</option>
<option style="color:black; background-color: #FFFFFF; font-size: 10;" value="10" class="genmed">{L_FONT_SMALL}</option>
<option style="color:black; background-color: #FFFFFF; font-size: 12;" value="12" class="genmed">{L_FONT_NORMAL}</option>
<option style="color:black; background-color: #FFFFFF; font-size: 18;" value="18" class="genmed">{L_FONT_LARGE}</option>
<option style="color:black; background-color: #FFFFFF; font-size: 24;" value="24" class="genmed">{L_FONT_HUGE}</option>
</select>

<select style="height: 20px;" name="fc" onChange="BBCfc();this.selectedIndex=0;" onMouseOver="helpline('fc')">
<option style="color:black; background-color: #FFFFFF; selected>{L_FONT_COLOR}</option>
<option style="color:black; background-color:{T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_DEFAULT}</option>
<option style="color:red; background-color:{T_TD_COLOR1}" value="red" class="genmed">{L_COLOR_RED}</option>
<option style="color:orange; background-color:{T_TD_COLOR1}" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
<option style="color:brown; background-color:{T_TD_COLOR1}" value="brown" class="genmed">{L_COLOR_BROWN}</option>
<option style="color:yellow; background-color:{T_TD_COLOR1}" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
<option style="color:green; background-color:{T_TD_COLOR1}" value="green" class="genmed">{L_COLOR_GREEN}</option>
<option style="color:olive; background-color:{T_TD_COLOR1}" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
<option style="color:cyan; background-color:{T_TD_COLOR1}" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
<option style="color:blue; background-color:{T_TD_COLOR1}" value="blue" class="genmed">{L_COLOR_BLUE}</option>
<option style="color:darkblue; background-color:{T_TD_COLOR1}" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
<option style="color:indigo; background-color:{T_TD_COLOR1}" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
<option style="color:violet; background-color:{T_TD_COLOR1}" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
<option style="color:black; background-color:{T_TD_COLOR1}" value="white" class="genmed">{L_COLOR_WHITE}</option>
<option style="color:black; background-color:{T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_BLACK}</option>
<option style="color:cadetblue; background-color: {T_TD_COLOR1}" value="cadetblue" class="genmed">{L_COLOR_CADET_BLUE}</option>
<option style="color:coral; background-color: {T_TD_COLOR1}" value="coral" class="genmed">{L_COLOR_CORAL}</option>
<option style="color:crimson; background-color: {T_TD_COLOR1}" value="crimson" class="genmed">{L_COLOR_CRIMSON}</option>
<option style="color:tomato; background-color: {T_TD_COLOR1}" value="tomato" class="genmed">{L_COLOR_TOMATO}</option>
<option style="color:seagreen; background-color: {T_TD_COLOR1}" value="seagreen" class="genmed">{L_COLOR_SEA_GREEN}</option>
<option style="color:darkorchid; background-color: {T_TD_COLOR1}" value="darkorchid" class="genmed">{L_COLOR_DARK_ORCHID}</option>
<option style="color:chocolate; background-color: {T_TD_COLOR1}"value="chocolate" class="genmed">{L_COLOR_CHOCOLATE}</option>
<option style="color:deepskyblue; background-color: {T_TD_COLOR1}" value="deepskyblue" class="genmed">{L_COLOR_DEEPSKYBLUE}</option>
<option style="color:gold; background-color: {T_TD_COLOR1}" value="gold" class="genmed">{L_COLOR_GOLD}</option>
<option style="color:gray; background-color: {T_TD_COLOR1}" value="gray" class="genmed">{L_COLOR_GRAY}</option>
<option style="color:midnightblue; background-color: {T_TD_COLOR1}" value="midnightblue" class="genmed">{L_COLOR_MIDNIGHTBLUE}</option>
<option style="color:darkgreen; background-color: {T_TD_COLOR1}" value="darkgreen" class="genmed">{L_COLOR_DARKGREEN}</option>
</select>
</td>

</tr>
</table>
</td>
</tr>
<tr>
<td height="30" background="images/bbcode_box/bg.gif" valign="middle">
<img src="images/bbcode_box/dots.gif" style="padding-left: 4px;"></td>
<td background="images/bbcode_box/bg.gif">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left">
<img border="0" src="images/bbcode_box/googlevid.gif" name="GVideo" type="image" onClick="BBCGVideo()" onMouseOver="helpline('googlevid')" class="postimage" alt="Google Video">
<img border="0" src="images/bbcode_box/youtube.gif" name="youtube" type="image" onClick="BBCyoutube()" onMouseOver="helpline('youtube')" class="postimage" alt="Youtube Video"> 
<img border="0" src="images/bbcode_box/url.gif" name="url" type="image" onClick="BBCurl()" onMouseOver="helpline('url')" class="postimage" alt="url">
<img border="0" src="images/bbcode_box/email.gif" name="email" type="image" onClick="BBCmail()" onMouseOver="helpline('mail')" class="postimage" alt="email">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0" title="">

<img border="0" src="images/bbcode_box/flash.gif" name="flash" type="image" onClick="BBCflash()" onMouseOver="helpline('flash')" class="postimage" alt="Flash">
<img border="0" src="images/bbcode_box/video.gif" name="video" type="image" onClick="BBCvideo()" onMouseOver="helpline('video')" class="postimage" alt="Video">
<img border="0" src="images/bbcode_box/sound.gif" name="stream" type="image" onClick="BBCstream()" onMouseOver="helpline('stream')" class="postimage" alt="Stream">
<img border="0" src="images/bbcode_box/ram.gif" name="ram" type="image" onClick="BBCram()" onMouseOver="helpline('ram')" class="postimage" alt="Real Media">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0" title="">

<img border="0" src="images/bbcode_box/img.gif" name="img" type="image" onClick="BBCimg()" onMouseOver="helpline('img')" class="postimage" alt="image">
<img border="0" src="images/bbcode_box/imgl.gif" name="imgl" type="image" onClick="BBCimgL()" onMouseOver="helpline('imgl')" class="postimage" alt="image left">
<img border="0" src="images/bbcode_box/imgr.gif" name="imgr" type="image" onClick="BBCimgR()" onMouseOver="helpline('imgr')" class="postimage" alt="image right">
<img border="0" src="images/bbcode_box/imgwh.gif" name="img" type="image" onClick="BBCimgWh()" onMouseOver="helpline('imgwh')" class="postimage" alt="image">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0" title="">

<img border="0" src="images/bbcode_box/marql.gif" name="marql" type="image" onClick="BBCmarql()" onMouseOver="helpline('marql')" class="postimage" alt="Marque to left">
<img border="0" src="images/bbcode_box/marqr.gif" name="marqr" type="image" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" class="postimage" alt="Marque to right">
<img border="0" src="images/bbcode_box/marqd.gif" name="marqd" type="image" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" class="postimage" alt="Marque to down">
<img border="0" src="images/bbcode_box/marqu.gif" name="marqu" type="image" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" class="postimage" alt="Marque to up">

</td>

</tr>
</table>
</td>
</tr>

<tr>
<td background="images/bbcode_box/bg.gif" valign="middle">
<img src="images/bbcode_box/dots.gif" style="padding-left: 4px;"></td>
<td background="images/bbcode_box/bg.gif" valign="middle">

<img border="0" src="images/bbcode_box/left.gif" name="left" type="image" onClick="BBCleft()" onMouseOver="helpline('left')" class="postimage" alt="left">
<img border="0" src="images/bbcode_box/center.gif" name="center" type="image" onClick="BBCcenter()" onMouseOver="helpline('center')" class="postimage" alt="center">
<img border="0" src="images/bbcode_box/right.gif" name="right" type="image" onClick="BBCright()" onMouseOver="helpline('right')" class="postimage" alt="right">
<img border="0" src="images/bbcode_box/justify.gif" name="justify" type="image" onClick="BBCjustify()" onMouseOver="helpline('justify')" class="postimage" alt="justify">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0">

<img border="0" src="images/bbcode_box/bold.gif" name="bold" type="image" onClick="BBCbold()" onMouseOver="helpline('b')" class="postimage" alt="bold">
<img border="0" src="images/bbcode_box/italic.gif" name="italic" type="image" onClick="BBCitalic()" onMouseOver="helpline('i')" class="postimage" alt="italic">
<img border="0" src="images/bbcode_box/under.gif" name="under" type="image" onClick="BBCunder()" onMouseOver="helpline('u')" class="postimage" alt="underline">
<img border="0" src="images/bbcode_box/strike.gif" name="strik" type="image" onClick="BBCstrike()" onMouseOver="helpline('strike')" class="postimage" alt="strike">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0">

<img border="0" src="images/bbcode_box/sup.gif" name="supscript" type="image" onClick="BBCsup()" onMouseOver="helpline('sup')" class="postimage" alt="sub">
<img border="0" src="images/bbcode_box/sub.gif" name="subs" type="image" onClick="BBCsub()" onMouseOver="helpline('sub')" class="postimage" alt="sup">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0">

<img border="0" src="images/bbcode_box/code.gif" name="code" type="image" onClick="BBCcode()" onMouseOver="helpline('code')" class="postimage" alt="code">
<img border="0" src="images/bbcode_box/quote.gif" name="quote" type="image" onClick="BBCquote()" onMouseOver="helpline('quote')" class="postimage" alt="quote">
<img border="0" src="images/bbcode_box/list.gif" name="listdf" type="image" onClick="BBClist()" onMouseOver="helpline('list')" class="postimage" alt="list">

<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0">

<img border="0" src="images/bbcode_box/google.gif" name="google" type="image" onClick="BBCgoogle()" onMouseOver="helpline('google')" class="postimage" alt="google">
<img border="0" src="images/bbcode_box/search.gif" name="search" type="image" onClick="BBCsearch()" onMouseOver="helpline('search')" class="postimage" alt="search">
<img style="padding-left: 5px; padding-right: 5px;" src="images/bbcode_box/blackdot.gif" width="1" height="100%" border="0">
<img border="0" src="images/bbcode_box/hr.gif" name="hr" type="image" onClick="BBChr()" onMouseOver="helpline('hr')" class="postimage" alt="hr">
<img border="0" src="images/bbcode_box/plain.gif" name="plain" type="image" onClick="BBCplain()" onMouseOver="helpline('plain')" class="postimage" alt="plain">

</td>
</tr>

</table>
</td>
</tr>

<tr>
<td colspan="9"><span class="gensmall">
<input type="text" name="helpbox" size="45" maxlength="100" style="width:100%; font-size:10px" class="helpline" value="{L_STYLES_TIP}" /></span>
</td>
</tr>
<tr>
<td colspan="9">
<span class="gen"><textarea name="message" rows="15" cols="35" wrap="virtual" style="width:100%; border: 0px;" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea></span>
</td>
</tr>
</tr>

<tr>
<td colspan="9" align="right">
<input type="button" value="{L_SELECT_ALL}" onClick="javascript:this.form.message.focus();this.form.message.select();" class="mainoption">
</td>
</tr>
</table>
</tr>
<!-- [-]-----[ My BBCode Box LT ] ------------ -->

<tr>
<td class="row1" valign="top"><span class="gen"><b>{L_OPTIONS}</b></span><br /><span class="gensmall">
<!-- BEGIN switch_html_enable -->
{HTML_STATUS}<br />
<!-- END switch_html_enable -->
{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
<td class="row2"><span class="gen"> </span>
<table cellspacing="0" cellpadding="1" border="0">
<!-- BEGIN switch_html_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
</td>
<td><span class="gen">{L_DISABLE_HTML}</span></td>
</tr>
<!-- END switch_html_checkbox -->
<!-- BEGIN switch_bbcode_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
</td>
<td><span class="gen">{L_DISABLE_BBCODE}</span></td>
</tr>
<!-- END switch_bbcode_checkbox -->
<!-- BEGIN switch_smilies_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
</td>
<td><span class="gen">{L_DISABLE_SMILIES}</span></td>
</tr>
<!-- END switch_smilies_checkbox -->
<!-- BEGIN switch_signature_checkbox -->
<tr>
<td>
<input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} />
</td>
<td><span class="gen">{L_ATTACH_SIGNATURE}</span></td>
</tr>
<!-- END switch_signature_checkbox -->
<!-- BEGIN switch_notify_checkbox -->
<tr>
<td>
<input type="checkbox" name="notify" {S_NOTIFY_CHECKED} />
</td>
<td><span class="gen">{L_NOTIFY_ON_REPLY}</span></td>
</tr>
<!-- END switch_notify_checkbox -->
<!-- BEGIN switch_delete_checkbox -->
<tr>
<td>
<input type="checkbox" name="delete" />
</td>
<td><span class="gen">{L_DELETE_POST}</span></td>
</tr>
<!-- END switch_delete_checkbox -->
</table>
</td>
</tr>
{POLLBOX}
{ATTACHBOX}

<!-- BEGIN switch_confirm -->
<tr>
<td class="row3" colspan="2" align="center"><br /><br />{CONFIRM_IMAGE}<br /><br /></td>
</tr>
<tr>
<td class="row2" colspan="2" align="center"><span class="gen"><b>{L_CT_CONFIRM}</b></span><br /><span class="gensmall">{L_CT_CONFIRM_E}</span><br /><br /><input type="text" class="post" style="width: 200px" name="confirm_code" size="6" onChange="javascript:this.value=this.value.toUpperCase();" value="" />{S_HIDDEN_FIELDS}</td>
</tr>
<!-- END switch_confirm -->

<tr>
<td class="catBottom" colspan="2" align="center" height="28"> {S_HIDDEN_FORM_FIELDS}<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" /></td>
</tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
<tr>
<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
</tr>
</table>
</form>

{TOPIC_REVIEW_BOX}