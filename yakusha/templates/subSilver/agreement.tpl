<style type="text/css">
<!--
.fieldset
{
margin-bottom:6px;
}
.panel
{
color:#000;
background-color:transparent;
padding:0px;
border:outset 0px;
}
.terms
{
color:{TEXT_COLOR};
background-color:{BG_COLOR};
height:200px;
padding:5px;
border:inset thin;
overflow:auto;
text-align:left;
}
.agree
{
color:#000;
background-color:transparent;
padding:6px;
border:thin inset;
}
.bold
{
font-weight:bold;
}
//-->
</style>
<form action="{S_AGREE}" method="POST">
<table width="100%" cellspacing="1" cellpadding="3" border="0" class="forumline">
<tr>
<th>{SITENAME} - {REGISTRATION}</th>
</tr>
<tr>
<td class="row1" align="center">
<div class="panel">
<table width="100%" cellspacing="3" cellpadding="0" border="0">
<tr align="left">
<td class="gensmall">{TO_JOIN}</td>
</tr>
<tr>
<td>
<div class="terms genmed">{AGREEMENT_RULES}<br />{AGREEMENT}</div>
<div class="gensmall"><input type="checkbox" name="agreed" value="{AGREE_HASH}">{AGREE_TRUE}</div>
</td>
</tr>
</table>
<input type="submit" value="{L_REGISTER}" class="mainoption" />
</div>
</td>
</tr>
</table>
</form>