<h1>{L_RANKS_TITLE}</h1>

<p>{L_RANKS_TEXT}</p>

<form method="post" action="{S_RANKS_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
<tr>
<th width='4%' class="thCornerL"> ID </th>
<th class="thTop">{L_RANK}</th>
<th class="thTop">{L_RANK_MINIMUM}</th>
<th class="thTop">{L_SPECIAL_RANK}</th>
<th class="thTop">{L_RANK_IMAGE_SHORT}</th>
<th class="thTop">{L_EDIT}</th>
<th class="thCornerR">{L_DELETE}</th>
</tr>
<!-- BEGIN ranks -->
<tr>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.RANK_ID}</td>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.RANK}</td>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.RANK_MIN}</td>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.SPECIAL_RANK}</td>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.IMAGE_DISPLAY}</td>
<td class="{ranks.ROW_CLASS}" align="center"><a href="{ranks.U_RANK_EDIT}">{L_EDIT}</a></td>
<td class="{ranks.ROW_CLASS}" align="center"><a href="{ranks.U_RANK_DELETE}">{L_DELETE}</a></td>
</tr>
<!-- END ranks -->
<tr>
<td class="catBottom" align="center" colspan="7"><input type="submit" class="mainoption" name="add" value="{L_ADD_RANK}" /></td>
</tr>
</table></form>