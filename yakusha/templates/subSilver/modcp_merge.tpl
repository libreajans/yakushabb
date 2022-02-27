<form action="{S_MODCP_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_MERGE_TOPIC}</td>
</tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2">{L_MERGE_TOPIC}</th>
</tr>

<tr>
<td class="row1" align="center">
<span class="gen">
<br />
{L_MERGE_TOPIC} &nbsp; {S_TOPIC_SELECT}<br /><br />
{MESSAGE_TEXT}
</span>
<br /><br />
{S_HIDDEN_FIELDS}
<input class="mainoption" type="submit" name="confirm" value="{L_YES}" />&nbsp;&nbsp;
<input class="liteoption" type="submit" name="cancel" value="{L_NO}" /><br /><br />
</span>
</td>
</tr>
</table>
</form>