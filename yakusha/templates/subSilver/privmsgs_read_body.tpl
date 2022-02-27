<!--[+] hýzlý cevap -->
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
formErrors = '{MQR_EMPTY_MESSAGE}';
}

if (formErrors)
{
alert(formErrors);
return false;
}
else
{
formObj.preview.disabled = true;
formObj.submit.disabled = true;
return true;
}
}
</script>
<!--[-] hýzlý cevap -->


<table cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td valign="middle">{INBOX_IMG}</td>
<td valign="middle"><span class="cattitle">{INBOX} &nbsp;</span></td>
<td valign="middle">{SENTBOX_IMG}</td>
<td valign="middle"><span class="cattitle">{SENTBOX} &nbsp;</span></td>
<td valign="middle">{OUTBOX_IMG}</td>
<td valign="middle"><span class="cattitle">{OUTBOX} &nbsp;</span></td>
<td valign="middle">{SAVEBOX_IMG}</td>
<td valign="middle"><span class="cattitle">{SAVEBOX}</span></td>
</tr>
</table>

<br />

<table cellspacing="1" cellpadding="1" width="100%" border=0>
<tr>
<td>{REPLY_PM_IMG}</td>
<td width="100%"><span class="nav">&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; {L_MESSAGE}</span></td>
</tr>
</table>

<table class="forumline" width="100%">
<tr align="right">
<td class="catHead" colspan="3" height="28">
<span class="nav">
<a href="{U_PRIVMSG_PREVIOUS}">{L_PRIVMSG_PREVIOUS}</a> :: <a href="{U_PRIVMSG_NEXT}">{L_PRIVMSG_NEXT}</a>
</span>
</td>
</tr>
<tr>
<th class=thHead nowrap colspan=3>{BOX_NAME} :: {L_MESSAGE}</th>
</tr>

<tr>
<td width="100%" class="row1">
<table border="0" width="100%" align="center">
<tr>
<td nowrap="nowrap">
{MESSAGE_FROM}
<br /><span class="genmed"><b>{RANK_FROM}</b></span>
<br />{RANK_FROM_IMG}
</td>

<td width="60%">&nbsp;</td>

<td align="right">
<span class="gensmall">{POSTER_JOINED}<br />{POSTER_POSTS}</span>
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td class="row1">
<table cellspacing=0 cellPadding=0 width="100%" border=0>
<tr>
<td width="100%">
<a href="{L_POST_SUBJECT}"><img src="{TEMPLATE_PATH}/images/icon_minipost.gif" border="0" /></a><span class="genmed"><b>{POST_SUBJECT}</b></span>
</td>
<td valign=top nowrap>
<span class=postdetails><B>{L_POSTED}:</B> {POST_DATE}</span>
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td class="row1">
<table height="100%" cellSpacing=3 cellPadding=1 width="100%" border=0>
<tr>
<td valign=top colspan=2>
<span class="postbody">{MESSAGE}</span>
<!-- BEGIN postrow -->
{ATTACHMENTS}
<!-- END postrow -->
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td class="row3" valign="bottom" noqrap width="100%" height="20">
<table height="13" cellspacing="0" cellpadding="0" width="100%" border="0">
<tr>
<td vAlign=center noWrap align=left>

{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG}
<script language="JavaScript" type="text/javascript">
<!--
if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 ) document.write('{ICQ_IMG}');
else document.write('<div style="position:relative"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px">{ICQ_STATUS_IMG}</div></div>');
//-->
</script>
<noscript>{ICQ_IMG}</noscript>

</td>

<td valign="center" align="right">
{QUOTE_PM_IMG} {EDIT_PM_IMG}
</td>
</tr>
</table>
</td>
</tr>

<tr>
<form method="post" action="{S_PRIVMSGS_ACTION}">
<td class="catBottom" colspan="3" height="28" align="right"> {S_HIDDEN_FIELDS}
<input type="submit" name="save" value="{L_SAVE_MSG}" class="liteoption" />
<input type="submit" name="delete" value="{L_DELETE_MSG}" class="liteoption" />
<!-- BEGIN switch_attachments -->
<input type="submit" name="pm_delete_attach" value="{L_DELETE_ATTACHMENTS}" class="liteoption" />
<!-- END switch_attachments -->
</td>
</form>
</tr>
</table>


<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">

<form action="{MQR_FORM_ACTION}" method="post" name="post" onsubmit="return checkForm()">
<tbody id="qr_open" style="display:none; position:relative;">
<td class="row1 gensmall" align="left" valign="middle" width="150">
<a href="{MQR_SMILIES_URL}" onclick="window.open('{MQR_SMILIES_URL}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies">{MQR_LANG_SHOW_SMILIES}</a><br /><br />
<input type="checkbox" name="attach_sig" checked="checked" />{MQR_ATTACH_SIG}<br />
</td>
<input type="hidden" name="reply" value="1" />
<input type="hidden" name="id" value="{PM_ID}" />
<input type="hidden" name="mode" value="reply" />
<input type="hidden" name="sid" value="{MQR_SESSION_ID}" />
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<span class="genmed">{L_TO}:</span> <input type="text" name="username" maxlength="25" value="{MESSAGE_FROM1}" />
<input type="text" name="subject" size="45" maxlength="100" value="{POST_SUBJECT}" /></span>
<tr>
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

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left" nowrap="nowrap">
{REPLY_PM_IMG}
<a href="javascript:qr_show_hide();"><img src="{QUICK_REPLY_IMG}" border="0" alt="{L_QUICK_REPLY}" /></a>
</td>
<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
</tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
<tr>
<td valign="top" align="right"><span class="gensmall">{JUMPBOX}</span></td>
</tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
<tr>
</tr>
</table>
