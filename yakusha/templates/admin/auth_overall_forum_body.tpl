<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script type="text/javascript" language="JavaScript" src="../images/auth_overall_forum/overlib.js"></script>
<script type="text/javascript" language="JavaScript" src="../images/auth_overall_forum/admin_overall_forumauth.js"></script>
<h1>{L_FORUM_TITLE}</h1>

<p>{L_FORUM_EXPLAIN}</p>

<form method="post" action="{S_FORUM_ACTION}"><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
<th class="cat" colspan="13">{L_FORUM_TITLE}</th>
</tr>
<tr>
<td class="row1" align="center" valign="middle" colspan="13">
<table width="50%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
<td class="row1" align="center">
<!-- BEGIN authedit -->
<a href="javascript:void(0);" onClick="return start_edit('{authedit.VALUE}', '{authedit.NAME}');" class="gen"><img src="../images/auth_overall_forum/{authedit.NAME}.gif">&nbsp;{authedit.NAME}</a> &nbsp;
<!-- END authedit -->
</td>
</tr>

<tr>
<td class="row3" align="center">
          <span class="gensmall">
            {L_FORUM_EXPLAIN_EDIT} -
            <a href="javascript:void(0);" onClick="return start_restore();">{L_FORUM_OVERALL_RESTORE}</a>
            <a href="javascript:void(0);" onClick="return stop_edit();" class="gen">{L_FORUM_OVERALL_STOP}</a>
          </span></td>
</tr>
</table>
</td>
</tr>
<!-- BEGIN catrow -->
<tr>
<td width="100%"class="row2" align="center" valign="middle"><span class="cattitle"><b><a target="_yeni" href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></b></span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_view}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_read}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_post}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_reply}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_edit}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_delete}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_sticky}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_announce}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_vote}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_pollcreate}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_attachments}</span></td>
<td class="row2" align="center" valign="middle"><span class="gen">{catrow.auth_download}</span></td>
</tr>
<!-- BEGIN forumrow -->
<tr>
<td class="row1"><span class="gen"><a href="{catrow.forumrow.U_VIEWFORUM}" {catrow.forumrow.STYLE} target="_new">{catrow.forumrow.FORUM_NAME}</a></span></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_VIEW_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_VIEW_IMG}',{catrow.forumrow.FORUM_ID},'VIEW');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_VIEW" name="auth[{catrow.forumrow.FORUM_ID}][VIEW]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_READ_IMG}.gif"  onClick="return change_auth(this,'{catrow.forumrow.AUTH_READ_IMG}',{catrow.forumrow.FORUM_ID},'READ');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_READ" name="auth[{catrow.forumrow.FORUM_ID}][READ]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_POST_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_POST_IMG}',{catrow.forumrow.FORUM_ID},'POST');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_POST" name="auth[{catrow.forumrow.FORUM_ID}][POST]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_REPLY_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_REPLY_IMG}',{catrow.forumrow.FORUM_ID},'REPLY');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_REPLY" name="auth[{catrow.forumrow.FORUM_ID}][REPLY]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_EDIT_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_EDIT_IMG}',{catrow.forumrow.FORUM_ID},'EDIT');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_EDIT" name="auth[{catrow.forumrow.FORUM_ID}][EDIT]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_DELETE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_DELETE_IMG}',{catrow.forumrow.FORUM_ID},'DELETE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_DELETE" name="auth[{catrow.forumrow.FORUM_ID}][DELETE]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_STICKY_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_STICKY_IMG}',{catrow.forumrow.FORUM_ID},'STICKY');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_STICKY" name="auth[{catrow.forumrow.FORUM_ID}][STICKY]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_ANNOUNCE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_ANNOUNCE_IMG}',{catrow.forumrow.FORUM_ID},'ANNOUNCE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_ANNOUNCE" name="auth[{catrow.forumrow.FORUM_ID}][ANNOUNCE]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_VOTE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_VOTE_IMG}',{catrow.forumrow.FORUM_ID},'VOTE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_VOTE" name="auth[{catrow.forumrow.FORUM_ID}][VOTE]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_POLLCREATE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_POLLCREATE_IMG}',{catrow.forumrow.FORUM_ID},'POLLCREATE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_POLLCREATE" name="auth[{catrow.forumrow.FORUM_ID}][POLLCREATE]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_POST_ATTACH_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_POST_ATTACH_IMG}',{catrow.forumrow.FORUM_ID},'POST_ATTACH');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_POST_ATTACH" name="auth[{catrow.forumrow.FORUM_ID}][POST_ATTACH]"></td>
<td class="row1" align="center"><img src="../images/auth_overall_forum/{catrow.forumrow.AUTH_DL_ATTACH_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_DL_ATTACH_IMG}',{catrow.forumrow.FORUM_ID},'DL_ATTACH');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_DL_ATTACH" name="auth[{catrow.forumrow.FORUM_ID}][DL_ATTACH]"></td>
</tr>
<!-- END forumrow -->
<!-- END catrow -->
<tr>
<td colspan="13" class="cat" align="center"><input type="submit" class="liteoption" name="submit" value="{L_SUBMIT}" /></td>
</tr>
</table></form>
