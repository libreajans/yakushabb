<!-- BEGIN topics_list_box -->
<!-- BEGIN row -->
<!-- BEGIN header_table -->

<table border="0" cellpadding="5" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="{topics_list_box.row.header_table.COLSPAN}" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_TITLE}&nbsp;</th>
<th width="100" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_AUTHOR}&nbsp;</th>
<th width="70" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_REPLIES}&nbsp;</th>
<th width="50" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_VIEWS}&nbsp;</th>
<th width="150" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_LASTPOST}&nbsp;</th>
</tr>
<!-- END header_table -->
<!-- BEGIN header_row -->
<form method="post" action="{S_POST_DAYS_ACTION}">
<tr>
<td class="row3" colspan="{topics_list_box.row.COLSPAN}"><span class="gensmall">&nbsp;&nbsp;<b>{topics_list_box.row.L_TITLE}</b></span></td>
</tr>
<form>
<!-- END header_row -->
<!-- BEGIN topic -->
<tr>
<td class="{topics_list_box.row.ROW_FOLDER_CLASS}" align="center" valign="middle"><img src="{topics_list_box.row.TOPIC_FOLDER_IMG}" alt="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" title="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" /></td>
<!-- BEGIN icon -->
<td class="{topics_list_box.row.ROW_CLASS}" align="center" valign="middle" width="20">{topics_list_box.row.ICON}</td>
<!-- END icon -->
<td class="{topics_list_box.row.ROW_CLASS}" width="100%">
<span class="topictitle">{topics_list_box.row.TOPIC_ATTACHMENT_IMG}{topics_list_box.row.NEWEST_POST_IMG}{topics_list_box.row.TOPIC_TYPE}<a href="{topics_list_box.row.U_VIEW_TOPIC}" class="topictitle">{topics_list_box.row.TOPIC_TITLE}</a></span><span class="gensmall">&nbsp;&nbsp;{topics_list_box.row.TOPIC_ANNOUNCES_DATES}{topics_list_box.row.TOPIC_CALENDAR_DATES}</span>
<span class="gensmall">
{topics_list_box.row.GOTO_PAGE}
</span>
</td>
<td class="row3" align="center" valign="middle"><span class="name">{topics_list_box.row.TOPIC_AUTHOR}</span></td>
<td class="row2" align="center" valign="middle"><span class="postdetails">{topics_list_box.row.REPLIES}</span></td>
<td class="row2" align="center" valign="middle"><span class="postdetails">{topics_list_box.row.VIEWS}</span></td>
<td class="row3" align="right" valign="middle" nowrap="nowrap"><span class="postdetails">{topics_list_box.row.LAST_POST_TIME}<br />{topics_list_box.row.LAST_POST_AUTHOR} {topics_list_box.row.LAST_POST_IMG}</span></td>
</tr>
<!-- END topic -->
<!-- BEGIN no_topics -->
<tr>
<td class="row1" colspan="{topics_list_box.row.COLSPAN}" height="30" align="center" valign="middle"><span class="gen">{topics_list_box.row.L_NO_TOPICS}</span></td>
</tr>
<!-- END no_topics -->
<!--
<!-- BEGIN bottom -->
<tr>
<td class="catBottom" colspan="{topics_list_box.row.COLSPAN}" align="center" valign="middle"><span class="genmed">{topics_list_box.row.FOOTER}</span></td>
</tr>
<!-- END bottom -->
-->
<!-- BEGIN footer_table -->
</table>
<!-- END footer_table -->
<!-- BEGIN spacer -->
<br class="gensmall">
<!-- END spacer -->
<!-- END row -->
<!-- END topics_list_box -->