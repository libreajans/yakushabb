<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
<tr>
<td align="center"><span class="gen">{L_STATUS}<br /></span>
<span class="genmed"><b>{I_STATUS_MESSAGE}</b></span><br /></td>
</tr>
</table>
<!-- END statusrow -->


<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left">
<span class="maintitle">{L_PAGE_NAME}</span>
<br /><span class="gensmall"><b>{L_VERSION}{VERSION}</b></span>
<br /><br /><span class="genmed">{L_PAGE_DESC}</span>
</td>
</tr>
</table>

<br />
{S_ACTION_ADD}
<br /><br />

<form method="POST" action="{S_MODE_ACTION}" name="post">
<table width="100%" cellspacing="0" cellpadding="3" border="0">
<tr>
<td align="left" nowrap="nowrap">
<span class="genmed">
<input type="text" class="post" name="hack_name" maxlength="25" size="20" tabindex="1" value="" />
{S_MODE_SELECT}&nbsp;<input type="submit" name="submituser" value="{L_LOOK_UP}" class="mainoption" />
</span>
</td>
</tr>
</table>
</form>

<form method="post" action="{S_MODE_ACTION}" name="listrow_values">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th width="20" height="25" class="thCornerL"> &raquo; </th>
<th height="25" class="thTop">{L_HACK_NAME}</th>
<th class="thTop">{L_AUTHOR}</th>
<th class="thTop">{L_DESCRIPTION}</th>
<th class="thTop">{L_WEBSITE}</th>
<th class="thTop">{L_USER_VIEWABLE}</th>
<th class="thTop">&laquo;</th>
<th class="thCornerR"><input type="submit" name="delete_sub" value="{L_DELETE}" class="liteoption"></th>
</tr>

<!-- BEGIN empty_switch -->
<tr><td colspan="8" class="row1" align="center">{L_NO_HACKS}</td></tr>
<!-- END empty_switch -->

<!-- BEGIN listrow -->
<tr>
<td width="20" height="25" class="{listrow.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gen">{listrow.ROW_NUMBER}</span></td>
<td class="{listrow.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gen">{listrow.HACK_NAME}&nbsp;{listrow.HACK_VERSION}</span></td>
<td class="{listrow.ROW_CLASS}" align="center"><span class="genmed">{listrow.HACK_AUTHOR}</span></td>
<td class="{listrow.ROW_CLASS}" align="center"><span class="genmed">{listrow.HACK_DESC}</span></td>
<td class="{listrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{listrow.HACK_WEBSITE}</span></td>
<td class="{listrow.ROW_CLASS}" align="center" valign="middle"><span class="genmed">{listrow.HACK_DISPLAY}</span></td>
<td class="{listrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{listrow.S_ACTION_EDIT}</span></td>
<td class="{listrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall"><input type="checkbox" name="delete_id_{listrow.HACK_ID}"></span></td>
</tr>
<!-- END listrow -->

<tr>
<td class="catbottom" colspan="7" height="28" align="right">&nbsp;</td>
<td class="catbottom" align="center">
<input type="submit" name="delete_sub" value="{L_DELETE}" class="liteoption"></td>
</tr>
</table>
</form>