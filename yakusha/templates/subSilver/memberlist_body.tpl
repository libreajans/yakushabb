<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<form method="POST" action="{S_MODE_ACTION}" name="post">
<tr>
<td>
<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a class="nav" href="{S_MODE_ACTION}">{L_MEMBERLIST}</a></span>
</td>
</tr>

<tr>
<td align="left" nowrap="nowrap">
<input type="text" class="post" name="username" maxlength="25" size="20" tabindex="1" value="" />
<input type="submit" name="submituser" value="{L_LOOK_UP}" class="mainoption" />
</td>

<td align="right" nowrap="nowrap">
</form>
<form method="POST" action="{S_MODE_ACTION}" name="post">
<span class="genmed">
{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;{S_ORDER_SELECT}&nbsp;
<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
</span>
</td>
</form>
</tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th class="thCornerL" nowrap="nowrap" height="20" >#</th>
<th class="thTop" nowrap="nowrap">{L_PMS}</th>
<th class="thTop" nowrap="nowrap">{L_USERNAME}</th>
<th class="thTop" nowrap="nowrap">{L_POSTS}</th>
<th class="thTop" nowrap="nowrap">{L_USER_RANK}</th>
<th class="thTop" nowrap="nowrap">{L_JOINED}</th>
<th class="thTop" nowrap="nowrap">{L_FROM}</th>
<th class="thTop" nowrap="nowrap">{L_EMAIL}</th>
<th class="thCornerR" nowrap="nowrap">{L_WEBSITE}</th>
</tr>
<!-- BEGIN no_username -->
<tr>
<td class="row1" align="center" colspan="10"><span class="gen">{no_username.NO_USER_ID_SPECIFIED}</span></td>
</tr>
<!-- END no_username -->

<!-- BEGIN memberrow -->
<tr>
<td class="{memberrow.ROW_CLASS}" align="center"><span class="gen">&nbsp;{memberrow.ROW_NUMBER}&nbsp;</span></td>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.PM_IMG}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center"><span class="gen">&nbsp;{memberrow.USERNAME}&nbsp;</span></td>
<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">&nbsp;{memberrow.U_SEARCH_USER_POSTS}&nbsp;</span></td>
<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">&nbsp;{memberrow.USER_RANK_IMG}{memberrow.USER_RANK}&nbsp;</span></td>
<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">&nbsp;{memberrow.JOINED}&nbsp;</span></td>
<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">&nbsp;{memberrow.FROM}&nbsp;</span></td>
<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">&nbsp;{memberrow.EMAIL_IMG}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">&nbsp;{memberrow.WWW_IMG}&nbsp;</td>

</tr>
<!-- END memberrow -->
<tr>
<td class="catBottom" align="center" colspan="10" height="28"></td>
</tr>
</table>
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
<tr>
<td align="right" valign="top"></td>
</tr>
</table>

<!-- BEGIN no_username -->
<!--
<!-- END no_username -->

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td><span class="nav">{PAGE_NUMBER}</span></td>
<td align="right"><span class="gensmall"><b>{PAGINATION}</b></span>

</td>
</tr>
</table>
<!-- BEGIN no_username -->
-->
<!-- END no_username -->