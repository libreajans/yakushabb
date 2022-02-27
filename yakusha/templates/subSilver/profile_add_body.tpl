<script language="JavaScript" type="text/javascript">
<!--
// bbCode control by subBlue design
// www.subBlue.com

// Startup variables
var imageTag = false; var theSelection = false;

// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version
var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
&& (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
&& (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;
var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

// Define the bbCode tags
bbcode = new Array(); bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[s]','[/s]','[align=left]','[/align]','[align=center]','[/align]','[align=right]','[/right]','[align=justify]','[/align]','[img]','[/img]');
imageTag = false;

// Replacement for arrayname.length property
function getarraysize(thearray) {
for (i = 0; i < thearray.length; i++) {
if ((thearray[i] == "undefined") || (thearray[i] == "") || (thearray[i] == null))
return i;
}
return thearray.length;
}

// Replacement for arrayname.push(value) not implemented in IE until version 5.5
// Appends element to the array
function arraypush(thearray,value) {
thearray[ getarraysize(thearray) ] = value;
}

// Replacement for arrayname.pop() not implemented in IE until version 5.5
// Removes and returns the last element of an array
function arraypop(thearray) {
thearraysize = getarraysize(thearray);
retval = thearray[thearraysize - 1];
delete thearray[thearraysize - 1];
return retval;
}

function bbfontstyle(bbopen, bbclose) {
var txtarea = document.profile.signature;

if ((clientVer >= 4) && is_ie && is_win) {
theSelection = document.selection.createRange().text;
if (!theSelection) {
txtarea.value += bbopen + bbclose;
txtarea.focus();
return;
}
document.selection.createRange().text = bbopen + theSelection + bbclose;
txtarea.focus();
return;
}
else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
{
mozWrap(txtarea, bbopen, bbclose);
return;
}
else
{
txtarea.value += bbopen + bbclose;
txtarea.focus();
}
storeCaret(txtarea);
}


function bbstyle(bbnumber) {
var txtarea = document.profile.signature;

txtarea.focus();
donotinsert = false;
theSelection = false;
bblast = 0;

if (bbnumber == -1) { // Close all open tags & default button names
while (bbcode[0]) {
butnumber = arraypop(bbcode) - 1;
txtarea.value += bbtags[butnumber + 1];
buttext = eval('document.profile.addbbcode' + butnumber + '.value');
eval('document.profile.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
}
imageTag = false; // All tags are closed including image tags :D
txtarea.focus();
return;
}

if ((clientVer >= 4) && is_ie && is_win)
{
theSelection = document.selection.createRange().text; // Get text selection
if (theSelection) {
// Add tags around selection
document.selection.createRange().text = bbtags[bbnumber] + theSelection + bbtags[bbnumber+1];
txtarea.focus();
theSelection = '';
return;
}
}
else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
{
mozWrap(txtarea, bbtags[bbnumber], bbtags[bbnumber+1]);
return;
}

// Find last occurance of an open tag the same as the one just clicked
for (i = 0; i < bbcode.length; i++) {
if (bbcode[i] == bbnumber+1) {
bblast = i;
donotinsert = true;
}
}

if (donotinsert) {  // Close all open tags up to the one just clicked & default button names
while (bbcode[bblast]) {
butnumber = arraypop(bbcode) - 1;
txtarea.value += bbtags[butnumber + 1];
buttext = eval('document.profile.addbbcode' + butnumber + '.value');
eval('document.profile.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
imageTag = false;
}
txtarea.focus();
return;
} else { // Open tags

if (imageTag && (bbnumber != 14)) {  // Close image tag before adding another
txtarea.value += bbtags[15];
lastValue = arraypop(bbcode) - 1; // Remove the close image tag from the list
document.profile.addbbcode14.value = "Img"; // Return button back to normal state
imageTag = false;
}

// Open tag
txtarea.value += bbtags[bbnumber];
if ((bbnumber == 14) && (imageTag == false)) imageTag = 1; // Check to stop additional tags after an unclosed image tag
arraypush(bbcode,bbnumber+1);
eval('document.profile.addbbcode'+bbnumber+'.value += "*"');
txtarea.focus();
return;
}
storeCaret(txtarea);
}

// From http://www.massless.org/mozedit/
function mozWrap(txtarea, open, close)
{
var selLength = txtarea.textLength;
var selStart = txtarea.selectionStart;
var selEnd = txtarea.selectionEnd;
if (selEnd == 1 || selEnd == 2)
selEnd = selLength;

var s1 = (txtarea.value).substring(0,selStart);
var s2 = (txtarea.value).substring(selStart, selEnd)
var s3 = (txtarea.value).substring(selEnd, selLength);
txtarea.value = s1 + open + s2 + close + s3;
return;
}

// Insert at Claret position. Code from
// http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
function storeCaret(textEl) {
if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}
-->
</script>

<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post" name="profile">

{ERROR_BOX}

<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tr>
<td align="left">
<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> <b>&raquo;</b> {L_REGISTRATION_INFO}</span></td>
<td align="right">
<span class="nav"><a href="{SHOW_YES_DHTML}">DHTML</a></span>
</td>
</tr>
</table>
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th class="thHead" colspan="2" height="25" valign="middle">{L_REGISTRATION_INFO}</th>
</tr>
<tr>
<td class="row2" colspan="2"><span class="gensmall"><img src="images/cp/hesap.png">{L_ITEMS_REQUIRED}</span></td>
</tr>
<!-- BEGIN switch_namechange_disallowed -->
<tr>
<td class="row1" width="38%"><span class="gen">{L_USERNAME}: *</span></td>
<td class="row2"><input type="hidden" name="username" value="{USERNAME}" /><span class="gen"><b>{USERNAME}</b></span></td>
</tr>
<!-- END switch_namechange_disallowed -->
<!-- BEGIN switch_namechange_allowed -->
<tr>
<td class="row1" width="38%"><span class="gen">{L_USERNAME}: *</span></td>
<td class="row2"><input type="text" class="post" style="width:200px" name="username" size="25" maxlength="25" value="{USERNAME}" /></td>
</tr>
<!-- END switch_namechange_allowed -->
<tr>
<td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: *</span></td>
<td class="row2"><input type="text" class="post" style="width:200px" name="email" size="25" maxlength="255" value="{EMAIL}" /></td>
</tr>
<!-- BEGIN switch_edit_profile -->
<tr>
<td class="row1"><span class="gen">{L_CURRENT_PASSWORD}: *</span><br />
<span class="gensmall">{L_CONFIRM_PASSWORD_EXPLAIN}</span></td>
<td class="row2">
<input type="password" class="post" style="width: 200px" name="cur_password" size="25" maxlength="32" value="{CUR_PASSWORD}" />
</td>
</tr>
<!-- END switch_edit_profile -->
<tr>
<td class="row1"><span class="gen">{L_NEW_PASSWORD}: *</span><br />
<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
<td class="row2" nowrap="nowrap">
<script language="JavaScript" type="text/javascript">
<!--
// Password security
function check_pw(pw_to_check)
{
var counter_to_check = 0;
var minlength_to_check = 6;

if (pw_to_check.length >= minlength_to_check)
{
counter_to_check = counter_to_check + 1;
}
if (pw_to_check.match(/[A-Z\Ä\Ö\Ü\Â\Î]/))
{
counter_to_check = counter_to_check + 2;
}
if (pw_to_check.match(/[a-z\ä\ö\ü\ß\â\î]/))
{
counter_to_check = counter_to_check + 1;
}
if (pw_to_check.match(/[0-9]/))
{
counter_to_check = counter_to_check + 2;
}
if (pw_to_check.match(/[\.\,\?\!\%\*\_\#\:\;\~\\&\$\§\€\@\/\=\+\-\(\)\[\]\|\<\>]/))
{
counter_to_check = counter_to_check + 2;
}
if (pw_to_check == document.getElementsByName('username').username.value)
{
counter_to_check = 0;
}
if (pw_to_check == document.getElementsByName('email').email.value)
{
counter_to_check = 0;
}

if (counter_to_check <= 2)
{
document.getElementsByName('holder_pw')[0].style.backgroundColor = 'red';
document.getElementsByName('holder_pw')[0].style.color = 'black';
document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL1}';
}
else if (counter_to_check <= 4)
{
document.getElementsByName('holder_pw')[0].style.backgroundColor = 'yellow';
document.getElementsByName('holder_pw')[0].style.color = 'black';
document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL2}';
}
else if (counter_to_check <= 5)
{
document.getElementsByName('holder_pw')[0].style.backgroundColor = 'pink';
document.getElementsByName('holder_pw')[0].style.color = 'white';
document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL3}';
}
else if (counter_to_check <= 7)
{
document.getElementsByName('holder_pw')[0].style.backgroundColor = 'green';
document.getElementsByName('holder_pw')[0].style.color = 'white';
document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL4}';
}
else if (counter_to_check == 8)
{
document.getElementsByName('holder_pw')[0].style.backgroundColor = '#FFA34F';
document.getElementsByName('holder_pw')[0].style.color = 'white';
document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL5}';
}
}
//-->
</script>
<input onkeyup="check_pw(this.value);" onfocus="check_pw(this.value);" type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" />

</tr>
<tr>
<td class="row1"><span class="gen"><a href="{U_FAQ}#36" tabindex="98" target="_phpbbfaq">{L_PASSWORD_SECURITY_EXPLAIN}</a></span> </td>
<td class="row2">
<input tabindex="99" title="" readonly="readonly" type="text" class="post" style="width : 200px; text-align : center; border : 1px solid #DEE3E7; background-color : #DEE3E7;" name="holder_pw" size="25" value="" />   </td>
</tr>

<tr>
<td class="row1"><span class="gen">{L_CONFIRM_PASSWORD}: * </span><br />
<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
<td class="row2">
<input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="32" value="{PASSWORD_CONFIRM}" />
</td>
</tr>
<!-- Visual Confirmation -->
<!-- BEGIN switch_confirm -->
<tr>
<td class="row1" colspan="2" align="center"><span class="gensmall">{L_CONFIRM_CODE_IMPAIRED}</span><br /><br />{CONFIRM_IMG}<br /><br /></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_CONFIRM_CODE}: * </span><br /><span class="gensmall">{L_CONFIRM_CODE_EXPLAIN}</span></td>
<td class="row2"><input type="text" class="post" style="width: 200px" name="confirm_code" size="10" maxlength="6" value="" onChange="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
<!-- END switch_confirm -->
<!-- BEGIN switch_edit_profile -->

<tr>
<th class="thSides" colspan="2" height="25" valign="middle">{L_PROFILE_INFO}</th>
</tr>
<tr>
<td class="row2" colspan="2"><img src="images/cp/bilgi.png"><span class="gensmall">{L_PROFILE_INFO_NOTICE}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_ICQ_NUMBER}:</span></td>
<td class="row2">
<input type="text" name="icq" class="post" style="width: 100px"  size="10" maxlength="15" value="{ICQ}" />
</td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_AIM}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 150px"  name="aim" size="20" maxlength="255" value="{AIM}" />
</td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_MESSENGER}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 150px"  name="msn" size="20" maxlength="255" value="{MSN}" />
</td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_YAHOO}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 150px"  name="yim" size="20" maxlength="255" value="{YIM}" />
</td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_WEBSITE}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 200px"  name="website" size="25" maxlength="255" value="{WEBSITE}" />
</td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_INTERESTS}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 200px"  name="interests" size="35" maxlength="150" value="{INTERESTS}" />
</td>
</tr>

<tr>
<th class="thSides" colspan="2" height="25" valign="middle">{L_SIG_PANEL}</th>
</tr>
<tr>
<td class="row2"colspan="2" valign="middle"><span class="gensmall"><img src="images/cp/imza.png">{L_SIG_PANEL}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_SIG_PRE}</span></td>
<td class="row2"><span class="gen">{SIGNATURE_P}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_SIGNATURE}:</span><br /><span class="gensmall">{L_SIGNATURE_EXPLAIN}<br /><br />{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
<td class="row2">
<script language="JavaScript" type="text/javascript">
<!--
// Available characters in signature
function signatureCounter(field, countfield, maxlimit)
{
if (field.value.length > maxlimit)
{
field.value = field.value.substring(0, maxlimit);
}
else
{
countfield.value = maxlimit - field.value.length;
}
}
//-->
</script>
<span class="genmed">
<!-- Signature BBCode Controller 1.0.0 by DTTVB -->
<select name="addbbcode22" onChange="bbfontstyle('[font=' + this.form.addbbcode22.options[this.form.addbbcode22.selectedIndex].value + ']', '[/font]');this.selectedIndex=0;">
<option style="font-weight : bold;" selected="selected">{L_FONT_TYPE}</option>
<option style="color:black; background-color: #FFFFFF; font-family: Arial;" value="Arial" class="genmed">Arial</option>
<option style="color:black; background-color: #FFFFFF; font-family: Arial Black;" value="Arial Black" class="genmed">Arial Black</option>
<option style="color:black; background-color: #FFFFFF; font-family: Century Gothic;" value="Century Gothic" class="genmed">Century Gothic</option>
<option style="color:black; background-color: #FFFFFF; font-family: Comic Sans MS;" value="Comic Sans MS" class="genmed">Comic Sans MS</option>
<option style="color:black; background-color: #FFFFFF; font-family: Courier New;" value="Courier New" class="genmed">Courier New</option>
<option style="color:black; background-color: #FFFFFF; font-family: Georgia;" value="Georgia" class="genmed">Georgia</option>
<option style="color:black; background-color: #FFFFFF; font-family: Lucida Console;"value="Lucida Console">Lucida Console</option>
<option style="color:black; background-color: #FFFFFF; font-family: Microsoft Sans Serif;" value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option>
<option style="color:black; background-color: #FFFFFF; font-family: Symbol;" value="Symbol" class="genmed">Symbol</option>
<option style="color:black; background-color: #FFFFFF; font-family: Tahoma;" value="Tahoma" class="genmed">Tahoma</option>
<option style="color:black; background-color: #FFFFFF; font-family: Trebuchet;" value="Trebuchet" class="genmed">Trebuchet</option>
<option style="color:black; background-color: #FFFFFF; font-family: Times New Roman;" value="Times New Roman" class="genmed">Times New Roman</option>
<option style="color:black; background-color: #FFFFFF; font-family: Verdana;" value="Verdana" class="genmed">Verdana</option>
</select>
<select name="addbbcode20" onChange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]')">
<option selected class="genmed">{L_FONT_SIZE}</option>
<option value="7" class="genmed">{L_FONT_TINY}</option>
<option value="9" class="genmed">{L_FONT_SMALL}</option>
<option value="12" class="genmed">{L_FONT_NORMAL}</option>
<option value="18" class="genmed">{L_FONT_LARGE}</option>
<option  value="24" class="genmed">{L_FONT_HUGE}</option>
</select>
<select name="addbbcode18" onChange="bbfontstyle('[color=' + this.form.addbbcode18.options[this.form.addbbcode18.selectedIndex].value + ']', '[/color]');this.selectedIndex=0;">
<option style="color:black; background-color: {T_TD_COLOR1}" value="{T_FONTCOLOR1}" class="genmed">{L_FONT_COLOR}</option>
<option style="color:darkred; background-color: {T_TD_COLOR1}" value="darkred" class="genmed">{L_COLOR_DARK_RED}</option>
<option style="color:red; background-color: {T_TD_COLOR1}" value="red" class="genmed">{L_COLOR_RED}</option>
<option style="color:orange; background-color: {T_TD_COLOR1}" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
<option style="color:brown; background-color: {T_TD_COLOR1}" value="brown" class="genmed">{L_COLOR_BROWN}</option>
<option style="color:yellow; background-color: {T_TD_COLOR1}" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
<option style="color:green; background-color: {T_TD_COLOR1}" value="green" class="genmed">{L_COLOR_GREEN}</option>
<option style="color:olive; background-color: {T_TD_COLOR1}" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
<option style="color:cyan; background-color: {T_TD_COLOR1}" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
<option style="color:blue; background-color: {T_TD_COLOR1}" value="blue" class="genmed">{L_COLOR_BLUE}</option>
<option style="color:darkblue; background-color: {T_TD_COLOR1}" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
<option style="color:indigo; background-color: {T_TD_COLOR1}" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
<option style="color:violet; background-color: {T_TD_COLOR1}" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
<option style="color:white; background-color: {T_TD_COLOR1}" value="white" class="genmed">{L_COLOR_WHITE}</option>
<option style="color:black; background-color: {T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_BLACK}</option>
<option style="color:cadetblue; background-color: {T_TD_COLOR1}" value="cadetblue" class="genmed">{L_COLOR_CADET_BLUE}</option>
<option style="color:coral; background-color: {T_TD_COLOR1}" value="coral" class="genmed">{L_COLOR_CORAL}</option>
<option style="color:crimson; background-color: {T_TD_COLOR1}" value="crimson" class="genmed">{L_COLOR_CRIMSON}</option>
<option style="color:tomato; background-color: {T_TD_COLOR1}" value="tomato" class="genmed">{L_COLOR_TOMATO}</option>
<option style="color:seagreen; background-color: {T_TD_COLOR1}" value="seagreen" class="genmed">{L_COLOR_SEA_GREEN}</option>
<option style="color:darkorchid; background-color: {T_TD_COLOR1}" value="darkorchid" class="genmed">{L_COLOR_DARK_ORCHID}</option>
<option style="color:chocolate; background-color: {T_TD_COLOR1}"value="chocolate" class="genmed">{L_COLOR_CHOCOLATE}</option>
<option style="color:deepskyblue; background-color: {T_TD_COLOR1}" value="deepskyblue" class="genmed">{L_COLOR_DEEPSKYBLUE}</option>
<option style="color:gold; background-color: {T_TD_COLOR1}" value="gold" class="genmed">{L_COLOR_GOLD}</option>
<option style="color:gray; background-color: {T_TD_COLOR1}" value="gray" class="genmed">{L_COLOR_GRAY}</option>
<option style="color:midnightblue; background-color: {T_TD_COLOR1}" value="midnightblue" class="genmed">{L_COLOR_MIDNIGHTBLUE}</option>
<option style="color:darkgreen; background-color: {T_TD_COLOR1}" value="darkgreen" class="genmed">{L_COLOR_DARKGREEN}</option>
</select>
<br />
<input type="button" class="button" accesskey="b" name="addbbcode0" value="B" style="font-weight:bold; width: 20px" onClick="bbstyle(0)" />
<input type="button" class="button" accesskey="i" name="addbbcode2" value="i" style="font-style:italic; width: 20px" onClick="bbstyle(2)" />
<input type="button" class="button" accesskey="u" name="addbbcode4" value="u" style="text-decoration: underline; width: 20px" onClick="bbstyle(4)" />
<input type="button" class="button" accesskey="q" name="addbbcode6" value="s" style="font-style:strike; width: 19px" onClick="bbstyle(6)" />
<input type="button" class="button" accesskey="c" name="addbbcode8" value="left" style="width: 50px" onClick="bbstyle(8)" />
<input type="button" class="button" accesskey="l" name="addbbcode10" value="center" style="width: 50px" onClick="bbstyle(10)" />
<input type="button" class="button" accesskey="o" name="addbbcode12" value="right" style="width: 50px" onClick="bbstyle(12)" />
<input type="button" class="button" accesskey="p" name="addbbcode14" value="justify" style="width: 50px"  onClick="bbstyle(14)" />
<input type="button" class="button" accesskey="w" name="addbbcode16" value="img" style="text-decoration: underline; width: 40px" onClick="bbstyle(16)" /><br />
</span>
<textarea name="signature" style="width: 300px" rows="6" cols="30" class="post" wrap="virtual" onKeyDown="signatureCounter(this.form.signature, this.form.signatureLen, {L_SIGNATURE_LEN});" onKeyUp="signatureCounter(this.form.signature, this.form.signatureLen, {L_SIGNATURE_LEN});">{SIGNATURE}</textarea>
<input type="button" value="{L_SELECT}" onClick="javascript:this.form.signature.focus();this.form.signature.select();" class="mainoption">
<input class="post" readonly="readonly" type="text" name="signatureLen" size="3" maxlength="3" value="{SIGNATURE_LEN}" /><span class="gensmall">&nbsp;{L_SIGNATURE_LEN_EXPLAIN}</span>
</td>
</tr>
<tr>
<th class="thSides" colspan="2" height="25" valign="middle">{L_PREFERENCES}</th>
</tr>
<tr>
<td class="row2" colspan="2" height="12" valign="middle"><img src="images/cp/secenek.png"><span class="gensmall">{L_PREFERENCES}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_PUBLIC_VIEW_EMAIL}:</span></td>
<td class="row2">
<script type="text/javascript" language="JavaScript">
<!--
// Spam warning
function spamwarn_question()
{
if (confirm('{L_PUBLIC_VIEW_EMAIL_REQUEST}'))
{
document.getElementsByName('viewemail')[0].checked = true;
return true;
}
else
{
document.getElementsByName('viewemail')[1].checked = true;
return false;
}
}
//-->
</script>
<input type="radio" name="viewemail" value="1" onclick="return spamwarn_question();" {VIEW_EMAIL_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_HIDE_USER}:</span></td>
<td class="row2">
<input type="radio" name="hideonline" value="1" {HIDE_USER_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="hideonline" value="0" {HIDE_USER_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_NOTIFY_ON_REPLY}:</span><br />
<span class="gensmall">{L_NOTIFY_ON_REPLY_EXPLAIN}</span></td>
<td class="row2">
<input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_NOTIFY_ON_PRIVMSG}:</span></td>
<td class="row2">
<input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_POPUP_ON_PRIVMSG}:</span><br /><span class="gensmall">{L_POPUP_ON_PRIVMSG_EXPLAIN}</span></td>
<td class="row2">
<input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<!-- BEGIN switch_sig_block -->
<tr>
<td class="row1"><span class="gen">{L_ALWAYS_ADD_SIGNATURE}:</span></td>
<td class="row2">
<input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<!-- END switch_sig_block -->

<!-- // gereksiz ayarlar diye kapatýldý
<tr>
<td class="row1"><span class="gen">{L_ALWAYS_ALLOW_BBCODE}:</span></td>
<td class="row2">
<input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<!-- BEGIN switch_html_enable -->
<tr>
<td class="row1"><span class="gen">{L_ALWAYS_ALLOW_HTML}:</span></td>
<td class="row2">
<input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<!-- END switch_html_enable -->
<tr>
<td class="row1"><span class="gen">{L_ALWAYS_ALLOW_SMILIES}:</span></td>
<td class="row2">
<input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
-->
<!--
<tr>
<th class="thSides" colspan="2" height="12" valign="middle">{L_SELECT_PANEL}</th>
</tr>
-->
<!-- END switch_edit_profile -->

<tr>
<td class="row1"><span class="gen">{L_LOCATION}:</span></td>
<!-- [+] MOD: Þehir Açýlýr Kutuda //-->
<td class="row2 gensmall"> {LOCATION} </td>
<!-- [-] MOD: Þehir Açýlýr Kutuda //-->
</tr>
<tr>
<td class="row1"><span class="gen">{L_OCCUPATION}:</span></td>
<!-- [+] MOD: meslek açýlýr kutuda //-->
<td class="row2 gensmall"> {OCCUPATION} </td>
<!-- [-] MOD: meslek açýlýr kutuda //-->
</tr>
<!-- BEGIN switch_edit_profile -->
<tr>
<td class="row1"><span class="gen">{L_BOARD_STYLE}:</span></td>
<td class="row2"><span class="gensmall">{STYLE_SELECT}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_BOARD_LANGUAGE}:</span></td>
<td class="row2"><span class="gensmall">{LANGUAGE_SELECT}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_TIMEZONE}:</span></td>
<td class="row2"><span class="gensmall">{TIMEZONE_SELECT}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_DATE_FORMAT}:</span></td>
<td class="row2"><span class="gensmall">{DATE_FORMAT_SELECT}</span></td>
</tr>
<!-- END switch_edit_profile -->
<!-- BEGIN switch_avatar_block -->

<tr>
<th class="thSides" colspan="2" height="12" valign="middle">{L_AVATAR_PANEL}</th>
</tr>
<tr>
<td class="row2" colspan="2" valign="middle"><img src="images/cp/avatar.png"><span class="gensmall">{L_AVATAR_PANEL}</span></td>
</tr>
<tr>
<td class="row1" colspan="2"><table width="70%" cellspacing="2" cellpadding="0" border="0" align="center">
<tr>
<td width="65%"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
<td align="center"><span class="gensmall">{L_CURRENT_IMAGE}</span><br />{AVATAR}<br /><input type="checkbox" name="avatardel" />&nbsp;<span class="gensmall">{L_DELETE_AVATAR}</span></td>
</tr>
</table></td>
</tr>
<!-- BEGIN switch_avatar_local_upload -->
<tr>
<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_FILE}:</span></td>
<td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width:200px" /></td>
</tr>
<!-- END switch_avatar_local_upload -->
<!-- BEGIN switch_avatar_remote_upload -->
<tr>
<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_URL}:</span><br /><span class="gensmall">{L_UPLOAD_AVATAR_URL_EXPLAIN}</span></td>
<td class="row2"><input type="text" name="avatarurl" size="40" class="post" style="width:200px" /></td>
</tr>
<!-- END switch_avatar_remote_upload -->
<!-- BEGIN switch_avatar_remote_link -->
<tr>
<td class="row1"><span class="gen">{L_LINK_REMOTE_AVATAR}:</span><br /><span class="gensmall">{L_LINK_REMOTE_AVATAR_EXPLAIN}</span></td>
<td class="row2"><input type="text" name="avatarremoteurl" size="40" class="post" style="width:200px" /></td>
</tr>
<!-- END switch_avatar_remote_link -->
<!-- BEGIN switch_avatar_local_gallery -->
<tr>
<td class="row1"><span class="gen">{L_AVATAR_GALLERY}:</span></td>
<td class="row2"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" /></td>
</tr>
<!-- END switch_avatar_local_gallery -->
<!-- END switch_avatar_block -->
<tr>
<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
</tr>
</table>

</form>