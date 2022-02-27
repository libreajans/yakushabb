<table width="100%" cellspacing="2" cellpadding="0" border="0" align="center">
<tr>
<td colspan="2" align="center" valign="middle" nowrap="nowrap">
<a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br /><br />
</td>
</tr>
<tr>
<td align="left" valign="middle" nowrap="nowrap">
<span class="nav">
<a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;
<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}" align="middle" /></a>
</span>
</td>

<td align="right" valign="top" nowrap="nowrap">
<span class="gensmall"><b>{PAGINATION}</b></span>
</td>
</tr>
</table>

<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td nowrap="nowrap"><img src="images/nav.gif" border="0"></td>
<td width="75%">
<span class="gensmall">
<b>
<a class="nav" href="{U_INDEX}">{L_INDEX}</a> &raquo;
<!-- IF PARENT_FORUM -->
<a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> &raquo;
<!-- ENDIF -->
<a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
</b>
</span>
</td>
<td width="25%">
<div align="right" class="genmed">
{L_REPLIES}: {TOPIC_REPLIES} | {L_VIEWS}: {TOPIC_VIEWS}
</div>
</td>
</tr>
</table>


<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
<tr>
<td class="catHead" colspan="2" height="20">

<table width="100%" border="0">
<tr>

<!-- BEGIN switch_user_logged_in -->

<td align="left">
<span class="gensmall">{S_WATCH_TOPIC} :: <a href="{U_FAV}">{L_FAV}</a> </span>
</td>

<td align="right">
<a href="{U_VIEW_OLDER_TOPIC}" class="nav">{L_VIEW_PREVIOUS_TOPIC}</a> <span class="nav"> :: </span>
<a href="{U_VIEW_NEWER_TOPIC}" class="nav">{L_VIEW_NEXT_TOPIC}</a>
</td>
<!-- END switch_user_logged_in -->
</tr>
</table>
{POLL_DISPLAY}
</td>
</tr>

<!-- BEGIN postrow -->
<tr>
<td width="17%" align="left" valign="top" class="{postrow.ROW_CLASS}">
<center>
<span class="name">
<a name="{postrow.U_POST_ID}"></a>
&nbsp;{postrow.POSTER_NAME} {postrow.POSTER_STATUS}
</span>
<br />
<span class="postdetails">
{postrow.POSTER_RANK}<br />
{postrow.RANK_IMAGE}<br />
{postrow.POSTER_AVATAR}<br /><br />
{postrow.POSTER_FROM}<br />
{postrow.POSTER_JOINED}<br />
{postrow.SEARCH}<br />
</span>
</center>
</td>

<td width="83%" class="{postrow.ROW_CLASS}" height="28" valign="top">
<table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%">
<!--<span class="postdetails">{postrow.POST_SUBJECT}</span>-->
<a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}: {postrow.POST_DATE} - <b>{L_MESAJ}:</b> <a title="{L_MESAJ_TITLE}" href="{postrow.U_MINI_SINGLE_POST}">#{postrow.POST_NUMBER}</a></span></td>
<td valign="top" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} {postrow.REPORT_IMG} </td>
</tr>
<tr>
<td colspan="2">
<hr />
</td>
</tr>
<tr>
<td colspan="2" height="100%" valign="top">
<span class="postbody">{postrow.MESSAGE}</span>
<!-- Start add - Bottom aligned signature MOD -->
</td>
</tr>
<tr>
<td colspan="2">
<span class="postbody">{postrow.ATTACHMENTS}</span>
<span class="postbody">{postrow.SIGNATURE}</span>
<!--{postrow.EDITED_MESSAGE}-->
<!-- BEGIN post_edit_notes -->
<!-- BEGIN edit_notes_loop -->
<br >
<table style="background-color: #A9B8C2;" cellspacing="1" border="0" width="100%">
<tr>
<td style="background-color: #DCE1E5; padding: 4px;">
<span class="genmed">
{postrow.post_edit_notes.edit_notes_loop.L_EDITED_BY} &raquo;
<font color="maroon">{postrow.post_edit_notes.edit_notes_loop.NOTE}</font>
</span>
</td>
<td style="background-color: #DCE1E5; padding: 4px;" align="center">
<span class="genmed">
{postrow.post_edit_notes.edit_notes_loop.U_DELETE_NOTE} &raquo;
</span>
</td>
</tr>
</table>
<!-- END edit_notes_loop -->
<!-- END post_edit_notes -->
<!--{postrow.EDITED_MESSAGE}-->
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td colspan="2" class="{postrow.ROW_CLASS}" width="100%" valign="bottom" nowrap="nowrap">
<table cellspacing="0" cellpadding="0" border="0" height="18">
<tr>
<td valign="middle" nowrap="nowrap">
<!--<a href="#top" class="nav">{L_BACK_TO_TOP}</a>-->
{postrow.SEARCH_IMG} {postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}
<script language="JavaScript" type="text/javascript">
<!--
if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
document.write(' {postrow.ICQ_IMG}');
else
document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
//-->
</script>
<noscript>{postrow.ICQ_IMG}</noscript>
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td class="spaceRow" colspan="2" height="1"><img src="templates/nDesign/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>

<!-- START Inline Banner Ad -->
<!-- BEGIN switch_ad -->
<tr>
<td class="inlinead" width="100%" height="28" align="center" valign="top">{postrow.INLINE_AD}</td>
</tr>
<tr>
<td class="spaceRow" colspan="2" height="1"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END switch_ad -->
<!-- BEGIN switch_ad_style2 -->
<tr>
<td colspan=2 align="center" class="inlinead">{postrow.INLINE_AD}</td>
</tr>
<!-- END switch_ad_style2 -->
<!-- END Inline Banner Ad -->
<!-- END postrow -->

<tr>
<td class="catBottom" colspan="2" height="28">
<table width="100%" cellspacing="0" cellpadding="0" border="0" nowrap="nowrap">
<tr>
<form method="post" action="{S_POST_DAYS_ACTION}">

<td align="left">
<!-- BEGIN switch_user_logged_in -->
<span class="gensmall">{S_WATCH_TOPIC} :: <a href="{U_FAV}">{L_FAV}</a> </span>
<!-- END switch_user_logged_in -->
</td>

<td align="right">
<span class="gensmall">
{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<input type="submit" value="{L_GO}" class="liteoption" name="submit" />
</span>
</td>
</form>
</tr>
</table>
</td>
</tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">

<!-- BEGIN switch_my_quick_reply -->
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
<script language="javascript" type="text/javascript">
function qr_show_hide() {
var id = 'qr_open';
var item = null;

if (document.getElementById) {
item = document.getElementById(id);
}
else if (document.all) {
item = document.all[id];
}
else if (document.layers) {
item = document.layers[id];
}

if (item && item.style) {
if (item.style.display == "none") {
item.style.display = "";
}
else {
item.style.display = "none";
}
}
else if (item) {
item.visibility = "show";
}
}

function checkForm()
{
formErrors = false;

if (document.post.message.value.length < 2)
{
formErrors = "{S_MESSAGE_NO_FOUND}";
}

if (formErrors)
{
alert(formErrors);
return false;
}
else
{
if (document.post.quick_quote.checked) 
{
document.post.message.value = (document.post.last_msg.value + document.post.message.value);
}
formObj.preview.disabled = true;
formObj.submit.disabled = true;
return true;
}
}
</script>
<form action="{MQR_FORM_ACTION}" method="post" name="post" onsubmit="return checkForm()" enctype="multipart/form-data">
<tbody id="qr_open" style="display:none; position:relative;">
<tr>
<th class="thLeft" height="26" nowrap="nowrap" width="150">{MQR_LANG_OPTIONS}</th>
<th class="thRight" nowrap="nowrap">{MQR_LANG_QUICK_REPLY}</th>
</tr>
<tr>
<td class="row1 gensmall" align="left" valign="middle" width="150">
<span class="gensmall"><a href="javascript:void(0);" onclick="window.open('http://www.postimage.org/index.php?mode=phpbb&tpl=.&forumurl=' + escape(document.location.href), '_imagehost', 'resizable=yes,width=500,height=400');return false;">{L_ADD_IMAGE}</a></span><br /><br />
<a href="{MQR_SMILIES_URL}" onclick="window.open('{MQR_SMILIES_URL}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies">{MQR_LANG_SHOW_SMILIES}</a><br /><br />
<input type="checkbox" name="quick_quote" />{MQR_QUOTE_LAST_POST}<br />
<input type="checkbox" name="attach_sig" checked="checked" />{MQR_ATTACH_SIG}<br />
</td>
<input type="hidden" name="mode" value="reply" />
<input type="hidden" name="sid" value="{MQR_SESSION_ID}" />
<input type="hidden" name="t" value="{MQR_TOPIC_ID}" />
<input type="hidden" name="notify" value="{MQR_NOTIFY_USER}" />
<input type="hidden" name="last_msg" value='{MQR_LAST_MSG}' />
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="row1" valign="top">
<textarea name="message" cols="70" rows="7" wrap="virtual" style="width:100%" class="post"></textarea>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr align="center">
<td>
<input type="submit" name="preview" class="liteoption" value="{MQR_LANG_PREVIEW}" />&nbsp;<input type="submit" name="post" class="mainoption" value="{MQR_LANG_SUBMIT}" />
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</form>
</table>
<!-- END switch_my_quick_reply -->

<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td nowrap="nowrap"><img src="images/nav.gif" border="0"></td>
<td width="75%">
<span class="gensmall">
<b>
<a class="nav" href="{U_INDEX}">{L_INDEX}</a> &raquo;
<!-- IF PARENT_FORUM -->
<a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> &raquo;
<!-- ENDIF -->
<a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
</b>
</span>
</td>
<td width="25%">
<div align="right" class="genmed">{S_TIMEZONE}</div>
</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left" valign="middle" nowrap="nowrap">
<span class="nav">
<a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;
<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}" align="middle" /></a>&nbsp;
<!-- BEGIN switch_my_quick_reply -->
<a href="javascript:qr_show_hide();"><img src="{QUICK_REPLY_IMG}" border="0" alt="{L_QUICK_REPLY}" align="middle" /></a>
<!-- END switch_my_quick_reply -->
</span>
</td>

<td align="right" valign="top" nowrap="nowrap">
<span class="gensmall"><b>{PAGINATION}</b></span>
</td>
</tr>
</table>


<!-- BEGIN switch_user_logged_in -->
<table class="forumline" width="100%" cellpadding="3" cellspacing="0" border="0" align="center">
<tr>
<td class="row1" width="50%">

<div id="tbut">{S_TOPIC_ADMIN}</div><br />

<form id="qsearch_form_forum" method="POST" target="_top" action="{U_TOPIC_SEARCH}">
<input type="hidden" name="search_terms" value="any" />
<input type="hidden" name="return_chars" value="100" />
<input type="hidden" name="show_results" value="posts" />
<input type="hidden" name="sort_dir" value="ASC" />
<input type="hidden" name="mode" value="topic_search" />
<input type="hidden" name="topic_id" value="{TOPIC_ID}" />
<input class="post" type="text" name="search_keywords" size="18" value="{L_SEARCH_TOPIC}" id="searchfield"
  onfocus="if (document.getElementById('qsearch_form_forum').search_keywords.value == '{L_SEARCH_TOPIC}') { document.getElementById('qsearch_form_forum').search_keywords.value = ''; }"
  onblur="if (document.getElementById('qsearch_form_forum').search_keywords.value == '') { document.getElementById('qsearch_form_forum').search_keywords.value = '{L_SEARCH_TOPIC}'; }" />
<input type="submit" name="submit" value="{L_ARA}" class="liteoption" />
</form>

<div class="gensmall"><br />{JUMPBOX}</div></td>
<td align="right" class="row1" width="50%"><span class="gensmall">{S_REPORT_TOPIC}<br />{S_AUTH_LIST}</span></td>
</tr>
</table>
<!-- END switch_user_logged_in -->
