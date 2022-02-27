<h1>{L_BULM_EDIT_TITLE}</h1>
<p>{L_BULM_EDIT_DESCRIPT}</p>
<form name="action" method="post" action="{S_BANLIST_ACTION}">
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
<tr>
<th class="thHead">{L_BULM_UPDATE_TITLE}</th>
</tr>
<tr>
<td class="row1" align="left">{L_REASON}: <br /><span class="gensmall">{L_BAN_REASON_EXPLAIN}</span></td>
</tr>
<tr>
<td class="row2" align="center"><textarea name="ban_reason" rows="10" cols="100">{REASON}</textarea></td>
</tr>
<tr>
<td class="row2" align="center"><input type="submit" name="updatebanreason" value="{L_SUBMIT}" class="mainoption" /></td>
</tr>
<input type="hidden" name="ban_id" value="{BAN_ID}"/>
</table>
</form>