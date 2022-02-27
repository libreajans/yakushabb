<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
<tr>
<td align="left"><span class="catTitle"> {L_RECENT_TITLE}</span> </td>
<td align="right"><span class="genmed">{L_SHOWING_POSTS} <b>{STATUS}</b></span></td>
</tr>
</table>

<form name="form" method="GET" action="{U_RECENT}">
<input type="hidden" name="mode" value="lastXdays" />
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">

<tr>
<td align="left"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> <span class="nav">&raquo; {L_RECENT_TOPIC}</span></td>
<td align="center">
<div align="right">
<span class="gensmall"><b>{L_SELECT_MODE}
[ <a href="{FORM_ACTION}?mode=today">{L_TODAY}</a> ]
[ <a href="{FORM_ACTION}?mode=yesterday">{L_YESTERDAY}</a> ]
[ <a href="{FORM_ACTION}?mode=last24">{L_LAST24}</a> ]
[ <a href="{FORM_ACTION}?mode=lastweek">{L_LASTWEEK}</a> ]
[ {L_LAST} {THEME_INPUT} <input type="text" name="amount_days" size="2" value="{AMOUNT_DAYS}" maxlength="3" class="post" /> <a href="javascript:document.form.submit();">{L_DAYS}</a> ]
</span>
</div>
</td>
</tr>
</form>
</table>

<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center" class="forumline">

<!-- BEGIN switch_no_topics --><!-- <!-- END switch_no_topics -->
<tr>
<th width="4%" height="25" class="thCornerL" nowrap="nowrap">#</th>
<th class="thTop" nowrap="nowrap">{L_TOPICS}</th>
<th class="thTop" nowrap="nowrap">{L_FORUM}</th>
<th class="thTop" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
<th class="thCornerR" nowrap="nowrap">{L_LASTPOST}</th>
</tr>

<!-- BEGIN switch_no_topics --> --> <!-- END switch_no_topics -->

<!-- BEGIN recent -->
<tr>
<td class="{recent.ROW_CLASS}" align="center" valign="middle"><img src="{recent.TOPIC_FOLDER_IMG}" alt="{recent.TOPIC_FOLDER_ALT}" title="{recent.TOPIC_FOLDER_ALT}" /></td>
<td class="{recent.ROW_CLASS}" nowrap="nowrap">
<span class="topictitle">{recent.NEWEST_IMG}{recent.TOPIC_TYPE}<a href="{recent.U_VIEW_TOPIC}" class="topictitle">{recent.TOPIC_TITLE}</a></span>
<span class="gensmall">{recent.GOTO_PAGE}<br />{recent.FIRST_TIME} - {recent.FIRST_AUTHOR}</span>
</td>
<td class="{recent.ROW_CLASS}" align="center" width="25%" nowrap="nowrap"><span class="nav"><a href="{recent.U_VIEW_FORUM}">{recent.FORUM_NAME}</a></span></td>
<td class="{recent.ROW_CLASS}" align="center" width="10%" nowrap="nowrap"><span class="genmed"> {recent.REPLIES}</span></td>
<td class="{recent.ROW_CLASS}" align="right" width="20%" nowrap="nowrap"><span class="gensmall"> {recent.LAST_URL} {recent.LAST_TIME}<br />{recent.LAST_AUTHOR}&nbsp;</span></td>
</tr>
<!-- END recent -->

<!-- BEGIN switch_no_topics -->
<tr>
<th colspan="5" class="thTop" align="center" height="28"></th>
</tr>
<tr>
<td colspan="5" class="row1" align="center" height="28"><span class="gen"><i>{L_NO_TOPICS}</i></span></td>
</tr>
<!-- END switch_no_topics -->

<tr>
<td class="spaceRow" colspan="5" height="1"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>

<tr>
<td colspan="5" class="catBottom" height="28">&nbsp;</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td><span class="nav">{PAGE_NUMBER}</span></td>
<td align="right"><span class="gensmall"><b>{PAGINATION}</b></span></td>
</tr>
</table>