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
<span class="maintitle">{L_PAGE_NAME}</span><br />
<span class="gensmall"><b>{L_VERSION} {VERSION} <br />{NIVISEC_CHECKER_VERSION}</b></span><br /><br />
<span class="genmed">{L_PAGE_DESC}<br /><br />{VERSION_CHECK_DATA}</span></td>
</tr>
</table>
<br />
{FAKE_DELETE_TEXT}{DEBUG_TEXT}
<form method="post" action="{FILENAME}" name="config_updates">

<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<th class="catHead" align="center" colspan="2">{L_PAGE_NAME}</th>
<tr>
<td class="row1" align="left"><span class="gen">{L_AUTO_MINS}</span><br /><span class="gensmall">{L_AUTO_MINS_DESC}</span></td>
<td class="row2" align="left" valign="middle" width="45%"><input class="post" type="text" maxlength="255" size="5" name="update_id_admin_auto_delete_minutes" value="{S_AUTO_MINS}"></td>
</tr>
<tr>
<td class="row1" align="left"><span class="gen">{L_AUTO_TOTAL}</span><br /><span class="gensmall">{L_AUTO_TOTAL_DESC}</span></td>
<td class="row2" align="left" valign="middle"><span class="gen">&nbsp;{S_AUTO_TOTAL}</span></td>
</tr>
<tr>
<th class="catHead" align="center" colspan="2">{L_NON_VISIT}</span></th>
</tr>
<tr>
<td class="row3" align="center" colspan="2"><span class="gensmall">{L_NON_VISIT_DESC}</span></td>
</tr>
<tr>
<td class="row1" align="right"><span class="gen">{L_AUTO_DAYS}</span></td>
<td class="row2" align="left" valign="middle"><input class="post" type="text" maxlength="255" size="5" name="update_id_admin_auto_delete_days" value="{S_AUTO_DAYS}"></td>
</tr>
<tr>
<td class="row1" align="right"><span class="gen">{L_ENABLED}</span></td>
<td class="row2" align="left" valign="middle">
<input type="radio" name="update_id_admin_auto_delete_non_visit" value="1" {S_NON_VISIT_Y}>&nbsp;{L_YES}&nbsp;&nbsp;
<input type="radio" name="update_id_admin_auto_delete_non_visit" value="0" {S_NON_VISIT_N}>&nbsp;{L_NO}
</td>
</tr>
<tr>
<th class="catHead" align="center" colspan="2">{L_INACTIVE}</th>
</tr>
<tr>
<td class="row3" align="center" colspan="2"><span class="gensmall">{L_INACTIVE_DESC}</span></td>
</tr>
<tr>
<td class="row1" align="right"><span class="gen">{L_AUTO_DAYS}</span></td>
<td class="row2" align="left" valign="middle"><input class="post" type="text" maxlength="255" size="5" name="update_id_admin_auto_delete_days_inactive" value="{S_AUTO_DAYS_INACTIVE}"></td>
</tr>
<tr>
<td class="row1" align="right"><span class="gen">{L_ENABLED}</span></td>
<td class="row2" align="left" valign="middle">
<input type="radio" name="update_id_admin_auto_delete_inactive" value="1" {S_INACTIVE_Y}>&nbsp;{L_YES}&nbsp;&nbsp;
<input type="radio" name="update_id_admin_auto_delete_inactive" value="0" {S_INACTIVE_N}>&nbsp;{L_NO}
</td>
</tr>
<tr>
<th class="catHead" align="center" colspan="2">{L_NO_POST}</span></th>
</tr>
<tr>
<td class="row3" align="center" colspan="2"><span class="gensmall">{L_NO_POST_DESC}</span></td>
</tr>
<tr>
<td class="row1" align="right"><span class="gen">{L_AUTO_DAYS}</span></td>
<td class="row2" align="left" valign="middle"><input class="post" type="text" maxlength="255" size="5" name="update_id_admin_auto_delete_days_no_post" value="{S_AUTO_DAYS_NO_POST}"></td>
</tr>
<tr>
<td class="row1" align="right"><span class="gen">{L_ENABLED}</span></td>
<td class="row2" align="left" valign="middle">
<input type="radio" name="update_id_admin_auto_delete_no_post" value="1" {S_NO_POST_Y}>&nbsp;{L_YES}&nbsp;&nbsp;
<input type="radio" name="update_id_admin_auto_delete_no_post" value="0" {S_NO_POST_N}>&nbsp;{L_NO}
</td>
</tr>
<tr>
<td class="catbottom" colspan="8" height="28" align="center">
<input type="submit" value="{L_SUBMIT}" name="submit" class="mainoption">&nbsp;&nbsp;
<input type="reset" value="{L_RESET}" name="reset" class="liteoption">
</td>
</tr>
</table>
</form>