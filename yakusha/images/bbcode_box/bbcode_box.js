var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = 
(
	(clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
	&& (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
	&& (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1)
);
var is_moz = 0;

var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

b_help = "Kalýn: [b]text[/b]";
i_help = "Ýtalik: [i]metin[/i]";
u_help = "Altý çizgili: [u]metin[/u]";
quote_help = "Alýntý: [quote]metin[/quote] veya [quote=\'yazar\']metin[/quote]";
code_help = "Kod: [code]code[/code]";
url_help = "URL ekle: [url]http://www.site yolu[/url] veya [url=http://www.site yolu]site adý[/url]";
fc_help = "Font Rengi: [color=red]metin[/color] Dilerseniz color=#FF0000 þeklinde de girebilirsiniz";
fs_help = "Font Boyutu: [size=10]küçük metin[/size]";
ft_help = "Font Tipi: [font=Tahoma]metin[/font]";
mail_help = "Eposta ekle: [email]adý@uzantýsý[/email]";
img_help = "Resim ekle: [img]http://resim yolu[/img]";
left_help = "Metni sola hizala: [align=left]metin[/align]";
center_help = "Metni ortaya hizala: [align=center]metin[/align]";
right_help = "Metni saða hizala: [align=right]metin[/align]";
justify_help = "Metni iki uca hizala: [align=justify]metin[/align]";
list_help = "Sýralý liste: [list=1|a]metin[/list] Hatýrlatma: Maddeler oluþturmak için [*] kullanýnýz";
strike_help = "Üstü çizgili: [s]metin[/s]";
plain_help = "Biçim kodlarýný temizle";
hr_help = "Çizgi ekle: [hr]";

search_help = "Forum içinde ara: [search]örnek metin[/search]";
imgwh_help = "Boyutlandýrýlmýþ resim ekle:[img width=xxx height=xxx]http:// resim yolu[/img]";
imgl_help = "Sola yaslý resim ekle:[left]http:// resim yolu[/left]";
imgr_help = "Saða yaslý resim ekle:[right]http:// resim yolu[/right]";
googlevid_help = "Google Video ekle: [GVideo]http://google video linki[/GVideo]";
youtube_help = "Youtube Video ekle: [youtube]http:// youtube video linki[/youtube]";
marqr_help="Saða kayan metin: [marq=right]metin[/marq]";
marql_help="Sola kayan metin: [marq=left]metin[/marq]";
marqu_help="Yukarý kayan metin: [marq=up]metin[/marq]";
marqd_help="Aþaðý kayan metin: [marq=down]metin[/marq]";
stream_help="Ses dosyasý ekle: [stream]Dosya adresi[/stream]";
ram_help="Real medya dosyasý ekle: [ram]Dosya adresi[/ram]";
video_help="Video dosyasý ekle: [video width=# height=#]Dosya adresi[/video]";
flash_help="Flash dosyasý ekle: [flash width=# height=#]flash adresi[/flash]";
sup_help = "Üstnot: [sup]metin[/sup]";
sub_help = "Dipnot: [sub]metin[/sub]";
google_help = "Google: [Google]Google'da ara[/Google]";

var Google = 0;
var search = 0;
var imgWh = 0;
var Quote = 0;
var Bold  = 0;
var Italic = 0;
var Underline = 0;
var Code = 0;
var flash = 0;
var fc = 0;
var fs = 0;
var ft = 0;
var center = 0;
var right = 0;
var left = 0;
var justify = 0;
var marqd = 0;
var marqu = 0;
var marql = 0;
var marqr = 0;
var mail = 0;
var video = 0;
var stream = 0;
var ram = 0;
var hr = 0;
var plain = 0;
var List = 0;
var Strikeout = 0;
var superscript = 0;
var subscript = 0;

// Fix a bug involving the TextRange object in IE. From
// http://www.frostjedi.com/terra/scripts/demo/caretBug.html
// (script by TerraFrost modified by reddog)
function initInsertions() 
{
	document.post.message.focus();
	if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
}

function BBCplain() 
{
	theSelection = document.selection.createRange().text;
	if (theSelection != '') 
	{
		temp = theSelection;
		document.selection.createRange().text = temp.replace(/\[[^\]]*\]/gi,"");
	}
}

function BBChr() {
	ToAdd = "[hr]";
	PostWrite(ToAdd);
}

function BBCstrike() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[s]" + theSelection + "[/s]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[s]", "[/s]");
		return;
	}

	if (Strikeout == 0) 
	{
		ToAdd = "[s]";
		document.strik.src = "images/bbcode_box/strike1.gif";
		Strikeout = 1;
	} 
	else 
	{
		ToAdd = "[/s]";
		document.strik.src = "images/bbcode_box/strike.gif";
		Strikeout = 0;
	}
	PostWrite(ToAdd);
}

function BBCsearch() 
{
        var FoundErrors = '';
        var enterURL   = prompt("Ýlgili kelimeyi giriniz");
        if (!enterURL) {
                FoundErrors += " Geçerli bir kelime girmediniz.";
        }
        if (FoundErrors) {
                alert("Error:"+FoundErrors);
                return;
        }
        var ToAdd = "[search]"+enterURL+"[/search]";
        PostWrite(ToAdd);
}

function BBCdir(dirc) 
{
	document.post.message.dir=(dirc);
}

function BBCjustify() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=justify]", "[/align]");
		return;
	}

	if (justify == 0) 
	{
		ToAdd = "[align=justify]";
		document.post.justify.src = "images/bbcode_box/justify1.gif";
		justify = 1;
	} 
	else 
	{
		ToAdd = "[/align]";
		document.post.justify.src = "images/bbcode_box/justify.gif";
		justify = 0;
	}
	PostWrite(ToAdd);
}

function BBCleft() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=left]", "[/align]");
		return;
	}

	if (left == 0) 
	{
		ToAdd = "[align=left]";
		document.post.left.src = "images/bbcode_box/left1.gif";
		left = 1;
	} 
	else 
	{
		ToAdd = "[/align]";
		document.post.left.src = "images/bbcode_box/left.gif";
		left = 0;
	}
	PostWrite(ToAdd);
}

function BBCright() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=right]", "[/align]");
		return;
	}
	
	if (right == 0) 
	{
		ToAdd = "[align=right]";
		document.post.right.src = "images/bbcode_box/right1.gif";
		right = 1;
	} 
	else 
	{
		ToAdd = "[/align]";
		document.post.right.src = "images/bbcode_box/right.gif";
		right = 0;
	}
	PostWrite(ToAdd);
}

function BBCcenter() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=center]", "[/align]");
		return;
	}

	if (center == 0) 
	{
		ToAdd = "[align=center]";
		document.post.center.src = "images/bbcode_box/center1.gif";
		center = 1;
	} 
	else 
	{
		ToAdd = "[/align]";
		document.post.center.src = "images/bbcode_box/center.gif";
		center = 0;
	}
	PostWrite(ToAdd);
}

function BBCft() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[font="+document.post.ft.value+"]" + theSelection + "[/font]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[font="+document.post.ft.value+"]", "[/font]");
		return;
	}
	ToAdd = "[font="+document.post.ft.value+"]"+" "+"[/font]";
	PostWrite(ToAdd);
}

function BBCfs() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[size="+document.post.fs.value+"]" + theSelection + "[/size]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[size="+document.post.fs.value+"]", "[/size]");
		return;
	}
	ToAdd = "[size="+document.post.fs.value+"]"+" "+"[/size]";
	PostWrite(ToAdd);
}

function BBCfc() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[color="+document.post.fc.value+"]" + theSelection + "[/color]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[color="+document.post.fc.value+"]", "[/color]");
		return;
	}
	ToAdd = "[color="+document.post.fc.value+"]"+" "+"[/color]";
	PostWrite(ToAdd);
}

function emoticon(text) 
{
	var txtarea = document.post.message;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
		txtarea.focus();
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}

function bbfontstyle(bbopen, bbclose) 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (!theSelection) 
		{
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

function storeCaret(textEl) 
{
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) 
{
	if (document.post.message.createTextRange && document.post.message.caretPos) 
	{
		var caretPos = document.post.message.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?	text + ' ' : text;
	}
	else document.post.message.value += text;
	document.post.message.focus(caretPos)
}

function BBCcode() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[code]" + theSelection + "[/code]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[code]", "[/code]");
		return;
	}	

	if (Code == 0) 
	{
		ToAdd = "[code]";
		document.post.code.src = "images/bbcode_box/code1.gif";
		Code = 1;
	}
	else 
	{
		ToAdd = "[/code]";
		document.post.code.src = "images/bbcode_box/code.gif";
		Code = 0;
	}
	PostWrite(ToAdd);
}

function BBCquote() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[quote]", "[/quote]");
		return;
	}

	if (Quote == 0) 
	{
		ToAdd = "[quote]";
		document.post.quote.src = "images/bbcode_box/quote1.gif";
		Quote = 1;
	}
	else 
	{
		ToAdd = "[/quote]";
		document.post.quote.src = "images/bbcode_box/quote.gif";
		Quote = 0;
	}
	PostWrite(ToAdd);
}

function BBClist() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[list]" + theSelection + "[/list]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[list]", "[/list]");
		return;
	}

	if (List == 0) 
	{
		ToAdd = "[list]";
		document.listdf.src = "images/bbcode_box/list1.gif";
		List = 1;
	} 
	else 
	{
		ToAdd = "[/list]";
		document.listdf.src = "images/bbcode_box/list.gif";
		List = 0;
	}
	PostWrite(ToAdd);
}

function BBCbold() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[b]" + theSelection + "[/b]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[b]", "[/b]");
		return;
	}

	if (Bold == 0) 
	{
		ToAdd = "[b]";
		document.post.bold.src = "images/bbcode_box/bold1.gif";
		Bold = 1;
	} 
	else 
	{
		ToAdd = "[/b]";
		document.post.bold.src = "images/bbcode_box/bold.gif";
		Bold = 0;
	}
	PostWrite(ToAdd);
}

function BBCitalic() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[i]" + theSelection + "[/i]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[i]", "[/i]");
		return;
	}

	if (Italic == 0) 
	{
		ToAdd = "[i]";
		document.post.italic.src = "images/bbcode_box/italic1.gif";
		Italic = 1;
	}
	else 
	{
		ToAdd = "[/i]";
		document.post.italic.src = "images/bbcode_box/italic.gif";
		Italic = 0;
	}
	PostWrite(ToAdd);
}

function BBCunder() 
{
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) 
	{
		theSelection = document.selection.createRange().text;
		if (theSelection != '') 
		{
			document.selection.createRange().text = "[u]" + theSelection + "[/u]";
			document.post.message.focus();
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[u]", "[/u]");
		return;
	}

	if (Underline == 0) 
	{
		ToAdd = "[u]";
		document.post.under.src = "images/bbcode_box/under1.gif";
		Underline = 1;
	} 
	else 
	{
		ToAdd = "[/u]";
		document.post.under.src = "images/bbcode_box/under.gif";
		Underline = 0;
	}
	PostWrite(ToAdd);
}

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

function BBCurl() 
{
	var FoundErrors = '';
	var enterURL   = prompt("Adresi giriniz", "http://");
	var enterTITLE = prompt("Adres adýný giriniz", "Web Sayfasý Adý");
	if (!enterURL)    {
		FoundErrors += " Geçerli bir Web adresi girmediniz.";
	}
	if (!enterTITLE)  {
		FoundErrors += " Sayfa adý girmediniz.";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
	PostWrite(ToAdd);
}

function BBCimg() 
{
	var FoundErrors = '';
	var enterURL   = prompt("Adresi giriniz","http://");
	if (!enterURL) 
	{
		FoundErrors += "Geçerli bir Web adresi girmediniz.";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[img]"+enterURL+"[/img]";
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}

function BBCimgL() 
{
	var FoundErrors = '';
	var enterURL   = prompt("Adresi giriniz","http://");
	if (!enterURL) {
		FoundErrors += "Geçerli bir Web adresi girmediniz.";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[left]"+enterURL+"[/left]";
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}

function BBCimgR() 
{
	var FoundErrors = '';
	var enterURL   = prompt("Adresi giriniz","http://");
	if (!enterURL) {
		FoundErrors += "Geçerli bir Web adresi girmediniz.";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[right]"+enterURL+"[/right]";
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}

function BBCmail() 
{
        var FoundErrors = '';
        var entermail   = prompt("E-posta adresini giriniz.","");
        if (!entermail) {
                FoundErrors += " Geçerli bir E-posta adresi girmediniz.";
        }
        if (FoundErrors) {
                alert("Error:"+FoundErrors);
                return;
        }
        var ToAdd = "[email]"+entermail+"[/email]";
        PostWrite(ToAdd);
}

function helpline(help) 
{
	document.post.helpbox.value = eval(help + "_help");
	document.post.helpbox.readOnly = "true";
}

function BBCGVideo() 
{
   var FoundErrors = ''; 
   var enterURL   = prompt("Video adresini giriniz.", "http://"); 
   if (!enterURL)    { 
      FoundErrors += " Hata: Geçerli bir Video adresi girmediniz"; 
   } 
   if (FoundErrors)  { 
      alert("Error:"+FoundErrors); 
      return; 
   } 
   var ToAdd = "[GVideo]"+enterURL+"[/GVideo]"; 
   PostWrite(ToAdd); 
} 

function BBCyoutube() 
{ 
   var FoundErrors = ''; 
   var enterURL   = prompt("Video adresini giriniz.", "http://"); 
   if (!enterURL)    { 
      FoundErrors += " Hata: Geçerli bir Video adresi girmediniz"; 
   } 
   if (FoundErrors)  { 
      alert("Error:"+FoundErrors); 
      return; 
   } 
   var ToAdd = "[youtube]"+enterURL+"[/youtube]"; 
   PostWrite(ToAdd); 
}

function BBCimgWh() 
{
	var FoundErrors = '';
	var enterURL = prompt("Lütfen resim adresini giriniz.", "http://");
	if (!enterURL)    
	{
		FoundErrors += " Geçerli bir resim adresi girmediniz.";
	}

	var enterW = prompt("Resim geniþliðini giriniz", "400");
	if (!enterW)    
	{
		FoundErrors += " Resim geniþliði girmediniz.";
	}

	var enterH = prompt("Resim yüksekliði giriniz.", "350");
	if (!enterH)
	{
		FoundErrors += "Resim yüksekliði girmediniz.";
	}

	if (FoundErrors)  
	{
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[img width="+enterW+" height="+enterH+"]"+enterURL+"[/img]";
	PostWrite(ToAdd);
}

function BBCvideo() 
{
	var FoundErrors = '';
	var enterURL   = prompt("Video adresini giriniz.", "http://");
	if (!enterURL)    {
		FoundErrors += " Geçerli bir Video adresi girmediniz.";
	}
		var enterW   = prompt("Video geniþliðini giriniz.", "400");
	if (!enterW)    {
		FoundErrors += " Video geniþliði girmediniz.";
	}
	var enterH   = prompt("Video yüksekliði giriniz.", "350");
	if (!enterH)    {
		FoundErrors += " Video yüksekliði girmediniz.";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[video width="+enterW+" height="+enterH+"]"+enterURL+"[/video]";
	PostWrite(ToAdd);
}

function BBCflash() 
{
	var FoundErrors = '';
	var enterURL   = prompt("Flash dosya adresini giriniz", "http://");
	if (!enterURL)    {
		FoundErrors += " Geçerli bir Flash dosya adresi girmediniz.";
	}
	var enterW   = prompt("Dosya geniþliði giriniz", "250");
	if (!enterW)    {
		FoundErrors += " Dosya geniþliði girmediniz.";
	}
	var enterH   = prompt("Dosya yüksekliði giriniz", "250");
	if (!enterH)    {
		FoundErrors += " Dosya yüksekliði girmediniz.";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[flash width="+enterW+" height="+enterH+"]"+enterURL+"[/flash]";
	PostWrite(ToAdd);
}

function BBCsup() 
{
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[sup]" + theSelection + "[/sup]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[sup]", "[/sup]");
		return;
	}
	if (superscript == 0) {
		ToAdd = "[sup]";
		document.supscript.src = "images/bbcode_box/sup1.gif";
		superscript = 1;
	} else {
		ToAdd = "[/sup]";
		document.supscript.src = "images/bbcode_box/sup.gif";
		superscript = 0;
	}
	PostWrite(ToAdd);
}

function BBCsub() 
{
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[sub]" + theSelection + "[/sub]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[sub]", "[/sub]");
		return;
	}
	if (subscript == 0) {
		ToAdd = "[sub]";
		document.subs.src = "images/bbcode_box/sub1.gif";
		subscript = 1;
	} else {
		ToAdd = "[/sub]";
		document.subs.src = "images/bbcode_box/sub.gif";
		subscript = 0;
	}
	PostWrite(ToAdd);
}

function checkForm() 
{
	formErrors = false;
	if (document.post.message.value.length < 2) 
	{
		formErrors = "Lütfen mesajýnýzý oluþturunuz";
	}

	if (formErrors) 
	{
		alert(formErrors);
		return false;
	}
	else
	{
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

function BBCram() 
{
        var FoundErrors = '';
        var enterURL   = prompt("Dosya adresini giriniz","http://");
        if (!enterURL) {
                FoundErrors += " Geçerli bir dosya adresi girmediniz.";
        }
        if (FoundErrors) {
                alert("Error:"+FoundErrors);
                return;
        }
        var ToAdd = "[ram]"+enterURL+"[/ram]";
        PostWrite(ToAdd);
}

function BBCgoogle() 
{
        var FoundErrors = '';
        var enterURL   = prompt("Ýlgili kelimeyi giriniz");
        if (!enterURL) {
                FoundErrors += " Geçerli bir kelime girmediniz.";
        }
        if (FoundErrors) {
                alert("Error:"+FoundErrors);
                return;
        }
        var ToAdd = "[google]"+enterURL+"[/google]";
        PostWrite(ToAdd);
}

function BBCstream() 
{
        var FoundErrors = '';
        var enterURL   = prompt("Dosya adresini giriniz","http://");
        if (!enterURL) {
                FoundErrors += " Geçerli bir dosya adresi girmediniz.";
        }
        if (FoundErrors) {
                alert("Error:"+FoundErrors);
                return;
        }
        var ToAdd = "[stream]"+enterURL+"[/stream]";
        PostWrite(ToAdd);
}

function BBCmarqu() 
{
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=up]", "[/marq]");
		return;
	}
	if (marqu == 0) {
		ToAdd = "[marq=up]";
		document.post.marqu.src = "images/bbcode_box/marqu1.gif";
		marqu = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqu.src = "images/bbcode_box/marqu.gif";
		marqu = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarql() 
{
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=left]", "[/marq]");
		return;
	}
	if (marql == 0) {
		ToAdd = "[marq=left]";
		document.post.marql.src = "images/bbcode_box/marql1.gif";
		marql = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marql.src = "images/bbcode_box/marql.gif";
		marql = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqr() 
{
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=right]", "[/marq]");
		return;
	}
	if (marqr == 0) {
		ToAdd = "[marq=right]";
		document.post.marqr.src = "images/bbcode_box/marqr1.gif";
		marqr = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqr.src = "images/bbcode_box/marqr.gif";
		marqr = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqd() 
{
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=down]", "[/marq]");
		return;
	}
	if (marqd == 0) {
		ToAdd = "[marq=down]";
		document.post.marqd.src = "images/bbcode_box/marqd1.gif";
		marqd = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqd.src = "images/bbcode_box/marqd.gif";
		marqd = 0;
	}
	PostWrite(ToAdd);
}