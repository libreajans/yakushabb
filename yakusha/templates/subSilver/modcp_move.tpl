<form action="{S_MODCP_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_MOVE_TO_FORUM}</td>
</tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2">{L_MOVE_TO_FORUM}</th>
</tr>

<tr>
<td class="row1" align="center">
<span class="gen">
<br />
{L_MOVE_TO_FORUM}:&nbsp;{S_FORUM_SELECT}<br /><br />
<input type="checkbox" name="move_leave_shadow" />{L_LEAVESHADOW}<br /><br />
{MESSAGE_TEXT} {S_HIDDEN_FIELDS}<br /><br />
<input class="mainoption" type="submit" name="confirm" value="{L_YES}" />&nbsp;&nbsp;
<input class="button" type="submit" name="cancel" value="{L_NO}" /><br /><br />
</span>
</td>
</tr>

</table>
</form>