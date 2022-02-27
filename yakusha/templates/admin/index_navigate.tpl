<style type="text/css"> body { margin-right : auto ; margin-left : auto ; margin-top : auto ; margin-bottom : auto ; } </style>
<form name=open_close method=get action=append_sid("index.$phpEx?pane=left&amp;open_close={OPEN_CLOSE}")> 
<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
<tr>
<td align="center" >
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
<tr>
<th height="25" class="thHead"><b>{L_ADMIN}</b></th>
</tr>
<tr>
<td class="row1"><span class="genmed"><a href="{U_ADMIN_INDEX}" target="main" class="genmed">{L_ADMIN_INDEX}</a></span></td>
</tr>
<tr>
<td class="row1"><span class="genmed"><a href="{U_INDEX}" target="main" class="genmed">{L_PREVIEW_FORUM}</a></span></td>
</tr>
<tr>
<td class="row1"><span class="genmed"><a href="{U_PORTAL}" target="main" class="genmed">{L_PORTAL}</a></span></td>
</tr>
<tr>
<td class="row1"><span class="genmed"><a href="{U_ADMIN_STAT}" target="main" class="genmed">{L_FORUM_STATS}</a></span></td>
</tr>
<tr>
<td class="row1"><span class="genmed"><a href="{U_XS_LINK}" target="main" class="genmed">{U_XS_NAME}</a></span></td>
</tr>
<!-- BEGIN catrow -->
<tr>
<td height="28" class="catSides"><span class="cattitle">
<input type=hidden name=open_close value={OPEN_CLOSE}>{catrow.ADMIN_CATEGORY}</span></td>
</tr>
<!-- BEGIN modulerow -->
<tr>
<td class="row1">
<span class="genmed">
<a href="{catrow.modulerow.U_ADMIN_MODULE}"  target="main" class="genmed">{catrow.modulerow.ADMIN_MODULE}</a>
</span>
</td>
</tr>
<!-- END modulerow -->
<!-- END catrow -->
</table>
</td>
</tr>
</table>
</form>