<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; {L_VIEW_SINGLE}</td>
</tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" nowrap="nowrap">
<tr colspan="2">
<td class="catRight" height="28" nowrap="nowrap" align="left"><span class="nav">&nbsp;{L_TOPIC}: "<a href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a>"</span></td>
<td class="catRight" height="28" nowrap="nowrap" align="right"><span class="nav"><a href="{U_VIEW_POST}">{TURN_TO_POST}</a></span></td>
</tr>

{POLL_DISPLAY}

<!-- BEGIN postrow -->
<tr>
<td colspan="2" width="100%" align="left" valign="top" class="{postrow.ROW_CLASS}">
<table border="0" width="100%" align="center">
<tr>
<td nowrap="nowrap">
<a name="{postrow.U_POST_ID}"></a>
{postrow.POSTER_NAME} {postrow.POSTER_STATUS}<br />
<span class="genmed"><b>{postrow.POSTER_RANK}</b></span>
<br />{postrow.RANK_IMAGE}
</td>

<td width="100%">&nbsp;</td>

<td align="left" valign="top" class="copyright" style="padding-right:5;" nowrap="nowrap">
{postrow.POSTER_JOINED}<br />
{postrow.SEARCH}<br />
{postrow.POSTER_FROM}<br />
</td>

<td nowrap="nowrap" valign="top" width="80" align="right" style="padding-left:2; padding-right:2;">
{postrow.POSTER_AVATAR}
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td colspan="2" class="row2" nowrap="nowrap">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails"><b>{postrow.POST_SUBJECT}</b></span></td>
<td nowrap="nowrap">
<span class="postdetails"><b>{L_POSTED}: {postrow.POST_DATE}</b>&nbsp;</span>
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td colspan="2" width="100%" align="left" valign="top" class="{postrow.ROW_CLASS}">
<table width="100%" height="100%" border="0">

<tr>
<td colspan="2" height="100%" valign="top">
<span class="postbody">{postrow.MESSAGE}</span>
<span class="postbody">{postrow.ATTACHMENTS}</span>
<span class="postbody">{postrow.SIGNATURE}</span>
</td>
</tr>

</table>
</td>
</tr>

<tr>
<td colspan="2" class="row2" width="100%" height="15" valign="bottom" nowrap="nowrap">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="18">
<tr>
<td align="left" valign="middle" nowrap="nowrap">
{postrow.SEARCH_IMG}
{postrow.PROFILE_IMG}
{postrow.PM_IMG}
{postrow.EMAIL_IMG}
{postrow.WWW_IMG}
{postrow.AIM_IMG}
{postrow.YIM_IMG}
{postrow.MSN_IMG}

</td>
<td align="center" valign="middle" nowrap="nowrap" width="100%" class="gensmall">&nbsp;</td>
<td align="right" valign="middle" nowrap="nowrap">
{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG}&nbsp;</td>
</tr>
</table>
</td>
</tr>

<tr>
<td class="spaceRow" colspan="2" height="1"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END postrow -->
</table>