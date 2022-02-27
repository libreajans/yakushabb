<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
<form method="POST" action="{S_MODE_ACTION}" name="post">
<tr colspan="2">
<td align="left" nowrap="nowrap">
<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{S_MODE_ACTION}">{L_PAGE_TITLE}</a></span>
</td>
<td align="right" nowrap="nowrap">
<span class="genmed">
<input type="text" class="post" name="hack_name" maxlength="25" size="20" tabindex="1" value="" />
{S_MODE_SELECT}&nbsp;<input type="submit" name="submituser" value="{L_LOOK_UP}" class="mainoption" />
</span>
</td>
</tr>
</form>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th class="thCornerL" nowrap="nowrap" height="20" >#</th>
<th class="thTop" nowrap="nowrap">{L_HACK_NAME}</th>
<th class="thTop" nowrap="nowrap">{L_HACK_AUTHOR}</th>
<th class="thTop" nowrap="nowrap">{L_HACK_DESC}</th>
<th class="thTop" nowrap="nowrap">{L_HACK_WEB}</th>
</tr>
<!-- BEGIN no_username -->
<tr>
<td class="row1" align="center" colspan="10"><span class="gen">{no_username.NO_USER_ID_SPECIFIED}</span></td>
</tr>
<!-- END no_username -->

<!-- BEGIN modlistrow -->
<tr>
<td width="20" class="{modlistrow.ROW_CLASS}" align="center"><span class="gen">{modlistrow.ROW_NUMBER}</span></td>
<td class="{modlistrow.ROW_CLASS}" align="center"><span class="gen">{modlistrow.HACK_NAME}{modlistrow.HACK_VERSION}</span></td>
<td class="{modlistrow.ROW_CLASS}" align="center"><span class="genmed">{modlistrow.HACK_AUTHOR}</span></td>
<td class="{modlistrow.ROW_CLASS}" align="center"><span class="genmed">{modlistrow.HACK_DESC}</span></td>
<td class="{modlistrow.ROW_CLASS}" align="center"><span class="genmed">{modlistrow.HACK_WEBSITE}</td>
</tr>
<!-- END modlistrow -->

<form method="POST" action="{S_MODE_ACTION}" name="post">
<tr>
<td class="catBottom" align="center" colspan="10" height="28">
<span class="genmed">
{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;{L_ORDER}:&nbsp;{S_ORDER_SELECT}&nbsp;
<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
</span>
</td>
</tr>
</form>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="center"><span class="gen">Mod Listesi &copy; <a target="_new" href="http://www.yakusha.net">yakusha</a></span></td>
</tr>
</table>