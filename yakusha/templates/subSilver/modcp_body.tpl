<!-- [+] hepsini iþaretle -->
<script language="Javascript" type="text/javascript">
<!--
function setCheckboxes(theForm, elementName, isChecked)
{
var chkboxes = document.forms[theForm].elements[elementName];
var count = chkboxes.length;

if (count)
{
for (var i = 0; i < count; i++)
{
chkboxes[i].checked = isChecked;
}
}
else
{
chkboxes.checked = isChecked;
}

return true;
}
//-->
</script>
<!-- [-] hepsini iþaretle -->

<form name="modcpForm" id="modcpForm" method="post" action="{S_MODCP_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left"><span class="nav">
<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo;
<!-- IF PARENT_FORUM -->
<a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> &raquo;
<!-- ENDIF -->
<a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a>
</span>
</td>
</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
<tr>
<td class="catHead" colspan="6" align="center" height="28"><span class="cattitle">{L_MOD_CP}</span>
</td>
</tr>
<tr>
<td class="spaceRow" colspan="6" align="center"><span class="gensmall">{L_MOD_CP_EXPLAIN}</span></td>
</tr>
<tr>
<th width="4%" class="thLeft" nowrap="nowrap">&nbsp;</th>
<th nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
<th nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
<th width="8%" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
<th width="17%" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
<th width="5%" class="thRight" nowrap="nowrap">&nbsp;{L_SELECT}&nbsp;</th>
</tr>
<!-- BEGIN topicrow -->
<tr>
<td class="row1" align="center" valign="middle"><img src="{topicrow.TOPIC_FOLDER_IMG}" /></td>
<td class="row1">&nbsp;<span class="topictitle">{topicrow.TOPIC_ATTACHMENT_IMG} {topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span></td>
<td class="row1" align="center" valign="middle"><span class="genmed">{topicrow.USERNAME}</span></td>
<td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
<td class="row1" align="center" valign="middle"><span class="postdetails">{topicrow.LAST_POST_TIME}</span></td>
<td class="row2" align="center" valign="middle">
<input type="checkbox" name="topic_id_list[]" value="{topicrow.TOPIC_ID}" />
</td>
</tr>
<!-- END topicrow -->
<tr align="right">
<td class="catBottom" colspan="6" height="29"> {S_HIDDEN_FIELDS}
<!-- BEGIN switch_auth_delete -->
<input type="submit" name="delete" class="liteoption" value="{L_DELETE}" />
<!-- END switch_auth_delete -->
<input type="submit" class="liteoption" name="recycle" value="{L_RECYCLE}" />
<input type="submit" name="move" class="liteoption" value="{L_MOVE}" />
<input type="submit" name="lock" class="liteoption" value="{L_LOCK}" />
<input type="submit" name="unlock" class="liteoption" value="{L_UNLOCK}" />
<input type="submit" name="merge" class="liteoption" value="{L_MERGE}" />
<!-- BEGIN switch_auth_sticky -->
<input type="submit" name="sticky" class="liteoption" value="{L_STICKY}" />
<!-- END switch_auth_sticky -->
<!-- BEGIN switch_auth_announce -->
<input type="submit" name="announce" class="liteoption" value="{L_ANNOUNCE}" />
<!-- END switch_auth_announce -->
<input type="submit" name="normalise" class="liteoption" value="{L_NORMALISE}" />
</td>
</tr>
</table>
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
<tr>
<td align="left" valign="middle"><span class="gensmall"><b>{PAGINATION}</b></span>
</td>
<td align="right" valign="top" nowrap="nowrap"><span class="gensmall">
<span class="gensmall"><b />
<a href="#" onclick="setCheckboxes('modcpForm', 'topic_id_list[]', true); return false;">{L_MARK_ALL}</a>&nbsp;::&nbsp;
<a href="#" onclick="setCheckboxes('modcpForm', 'topic_id_list[]', false); return false;">{L_UNMARK_ALL}</a></b>
</span>
</td>
</tr>
</table>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="right">{JUMPBOX}</td>
</tr>
</table>