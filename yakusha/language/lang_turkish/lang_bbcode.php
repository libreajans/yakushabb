<?php

if ( !defined('IN_PHPBB') )
{
die('Hacking attempt');
}

// --------------------------------------------------------------
// DOSYA ADI : lang_******.php
// TEL�F HAKKI : � 2000, 2005 Canver Networks [ phpBB T�rkiye ]
// WWW : http://www.phpbbturkiye.com
// --------------------------------------------------------------

$faq[] = array("--","Giri�");
$faq[] = array("Bi�im Kodlar� nedir?", "Bi�im Kodlar�, HTML'in �zel bir uygulamas�d�r. Forumlara yazd���n�z mesajlarda Bi�im Kodlar� kullanabilme imkan�n� pano y�neticisi belirler. Ayr�ca mesaj g�nderme formundaki se�enekler sayesinde diledi�iniz mesajlarda Bi�im Kodlar�'n� iptal etmeniz m�mk�nd�r. Bi�im Kodlar�, HTML'e benzer tarzdad�r fakat etiketler &lt; ve &gt; yerine k��eli parantez i�ine al�n�r. Ayr�ca nelerin nas�l g�r�nt�lendi�i daha iyi kontrol edilebilir. Mesajlar�n�za Bi�im Kodlar� eklemek i�in mesaj g�vdesi �zerinde bulunan ara� �ubu�unu kullanman�z i�i �ok daha kolayla�t�r�r (ara� �ubu�u g�r�n�m� kulland���n�z tema'ya ba�l�d�r). Ayr�ca alttaki rehberi faydal� bulabilirsiniz.");

$faq[] = array("--","Metin Bi�imini De�i�tirme");
$faq[] = array("Kal�n, e�ik veya alt��izili yaz�lar nas�l yaz�l�r?", "Bi�im Kodlar�, metnin temel bi�imlemesini kolayca de�i�tirmenizi sa�layan etiketlere sahiptir. Bunu ger�ekle�tirmek i�in �u y�ntemler kullan�l�r: <ul><li>Metnin belirli bir k�sm�n� kal�n harflerle g�r�nt�lemek i�in <b>[b][/b]</b> etiketleri i�ine al�n, �rn. <br /><br /><b>[b]</b>Merhaba<b>[/b]</b><br /><br />yaz�l�nca <b>Merhaba</b> olarak g�r�nt�lenir.</li><li>Alt��izili yaz�lar i�in <b>[u][/u]</b> kullan�n, �rn.: <br /><br /><b>[u]</b>G�nayd�n<b>[/u]</b><br /><br />yaz�l�nca <u>G�nayd�n</u> olarak g�r�nt�lenir.</li><li>Metni e�ik yazmak i�in <b>[i][/i]</b> kullan�n, �rn. <br /><br />�ok <b>[i]</b>B�y�k!<b>[/i]</b><br /><br />yaz�l�nca sonu� �ok <i>B�y�k!</i> olur.</li></ul>");
$faq[] = array("Yaz�lar�n rengi veya boyutu nas�l de�i�tirilir?", "Yaz�lar�n renk veya boyutunu de�i�tirmek i�in alttaki etiketler kullan�labilir. Elde edilen sonu�, kullan�lan web taray�c�s� ve bilgisayar sistemine g�re de�i�ebilir, akl�n�zda bulunsun: <ul><li>Yaz�lar�n rengi, metni <b>[color=][/color]</b> etiketleri i�ine alarak de�i�tirilir. Belirli ingilizce renk isimlerini (�rn. red, blue, yellow vs.) veya alternatif olarak 16 tabanl� say� sisteminde (HEX) kodlanm�� �� rakaml� renk kodunu yazabilirsiniz (�rn. #FFFFFF, #000000). Metni �rne�in k�rm�z� harflerle yazmak i�in:<br /><br /><b>[color=red]</b>Merhaba!<b>[/color]</b><br /><br />veya<br /><br /><b>[color=#FF0000]</b>Merhaba!<b>[/color]</b><br /><br />ayn� �ekilde g�r�nt�lenir: <span style=\"color:red\">Merhaba!</span></li><li>Karakterlerin boyutunu benzer �ekilde <b>[size=][/size]</b> kullanarak de�i�tirebilirsiniz. Bu etiket kulland���n�z tema'ya ba�l�d�r. Karakterlerin pixel olarak boyutunu yazman�z �nerilir. Bu rakam 1 ile ba�lay�p (g�zle g�r�lmeyecek kadar k���k), en fazla 29 (�ok b�y�k) olabilir. �rnek:<br /><br /><b>[size=9]</b>K���K<b>[/size]</b><br /><br />genelde �u sonucu verir: <span style=\"font-size:9px\">K���K</span><br /><br />�te yandan:<br /><br /><b>[size=24]</b>B�Y�K!<b>[/size]</b><br /><br /><span style=\"font-size:24px\">B�Y�K!</span> sonucunu verir.</li></ul>");
$faq[] = array("Bi�imlendirme etiketlerini kar��t�rabilir miyim?", "Evet, mesela dikkati �ekmek i�in ��yle yazabilirsiniz:<br /><br /><b>[size=18][color=red][b]</b>D�KKAT!<b>[/b][/color][/size]</b><br /><br />Bu yaz� �u �ekilde g�r�nt�lenir: <span style=\"color:red;font-size:18px\"><b>D�KKAT!</b></span><br /><br />Uzun metinleri bu �ekilde yazmaman�z� �neririz! Unutmay�n ki, etiketlerin d�zg�n bir �ekilde kapat�lmas�n� temin etmek, metni g�nderen ki�i olarak sizin g�revinizdir. �rne�in bu �ekilde yazmak yanl��t�r: <br /><br /><b>[b][u]</b>Etiketler hatal� kapat�lm��<b>[/b][/u]</b>");

$faq[] = array("--","Al�nt� ile Cevap ve E�aral�kl� Yaz�tipi");
$faq[] = array("Al�nt� ile cevap yazma", "Bir metinden al�nt� yapman�n iki ayr� y�ntemi vard�r: kaynak vererek veya vermeyerek.<ul><li>Bir mesaja cevap vermek i�in Al�n�t� ile Cevap komutunu kullan�rsan�z, orijinal mesaj�n kendi mesaj�n�za <b>[quote=\"\"][/quote]</b> etiketleri aras�nda eklendi�ini g�receksiniz. Bu y�ntem, bir �ahs� veya se�ece�iniz herhangi ba�ka bir yeri kaynak vererek yan�t yazman�z� sa�lar. �rne�in Ali isminde bir �ahs�n yazd�klar�n� al�nt� etmek i�in �u �ekilde yazman�z gerek: <br /><br /><b>[quote=\"Ali\"]</b>Ali'nin yazd��� yaz�lar...<b>[/quote]</b><br /><br />Sonu�ta al�nt� yap�lan k�sm�n �n�ne otomatik olarak Ali demi�ki: yaz�l�r. Al�nt� yapt���n�z �ahs�n ismini t�rnak i�aretleri \"\" i�ine almay� unutmay�n, t�rnak i�aretleri kullanman�z <b>�art</b>.</li><br /><br /><li>�kinci y�ntem, kaynak vermeden al�nt� yapman�z� sa�lar. �lgili b�l�m� <b>[quote][/quote]</b> etiketleri i�ine alman�z yeterli. Bu b�l�m�n �n�nde Al�nt�: yaz�s�n� g�receksiniz.</li></ul>");
$faq[] = array("Kaynak yaz�l�m veya e�aral�kl� yaz�tipiyle g�r�nt�leme", "Bir programlama dilinde yaz�lm�� kaynak yaz�l�m veya e�aral�kl� yaz�tipi (�rn. Courier) gerektiren herhangi bir metni g�r�nt�lemek i�in, ilgili k�sm� <b>[code][/code]</b> etiketleri i�ine almal�s�n�z. �rn.: <br /><br /><b>[code]</b>echo \"Bu bizim kodumuz\";<b>[/code]</b><br /><br /><b>[code][/code]</b> etiketleri aras�na yaz�lan t�m bi�imleme etiketleri (�rn. [i], [b] gibi) iptal edilir. Bu bi�imlendirmenin kulland��� yaz�tipi, kulland���n�z temaya g�re farkl�l�k g�sterebilir.");

$faq[] = array("--","Liste Ekleme");
$faq[] = array("Madde imiyle liste", "Bi�im Kodlar� rakams�z (madde imiyle) ve rakaml� olmak �zere iki t�rl� liste destekler. Bu listeler asl�nda HTML listelerine e�ittir. Rakams�z liste, her maddeyi bir madde imiyle beraber sat�r ba��n� biraz girintilenmi� olarak g�r�nt�ler. Rakams�z bir liste haz�rlamak i�in <b>[list][/list]</b> etiketlerini kullan�n ve her sat�r�n ba��na <b>[*]</b> yaz�n. �rn. sevdi�iniz renklerin bir listesini �u �ekilde haz�rlayabilirsiniz:<br /><br /><b>[list]</b><br /><b>[*]</b>K�rm�z�<br /><b>[*]</b>Mavi<br /><b>[*]</b>Sar�<br /><b>[/list]</b><br /><br />Sonu� olarak �u listeyi g�receksiniz:<ul><li>K�rm�z�</li><li>Mavi</li><li>Sar�</li></ul>");
$faq[] = array("Rakaml� liste", "�kinci liste t�r� olan rakaml� listeyle, her sat�r ba��nda g�r�len rakam� kontrol edebilirsiniz. Rakamlara g�re s�ralanm�� bir liste i�in <b>[list=1][/list]</b> kullanman�z gerek. Alternatif olarak alfabe'ye g�re s�ralanm�� bir liste i�in <b>[list=a][/list]</b> etiketlerini kullanabilirsiniz. Rakams�z listelerde oldu�u gibi, her maddeyi <b>[*]</b> ile i�aretlemeniz gerek. �rne�in:<br /><br /><b>[list=1]</b><br /><b>[*]</b>Ma�azaya git<br /><b>[*]</b>Yeni bilgisayar al<br /><b>[*]</b>Eve g�t�r<br /><b>[/list]</b><br /><br />�u �ekilde g�r�nt�lenir:<ol type=\"1\"><li>Ma�azaya git</li><li>Yeni bilgisayar al</li><li>Eve g�t�r</li></ol>�te yandan alfabeye g�re s�ralanm�� bir listeyi �u �ekilde yazman�z gerekir:<br /><br /><b>[list=a]</b><br /><b>[*]</b>Birinci se�enek<br /><b>[*]</b>�kinci se�enek<br /><b>[*]</b>���nc� se�enek<br /><b>[/list]</b><br /><br />Sonu�:<ol type=\"a\"><li>Birinci se�enek</li><li>�kinci se�enek</li><li>���nc� se�enek</li></ol>");

$faq[] = array("--", "Link (URL) Ekleme");
$faq[] = array("Ayr� bir siteye link verme", "Bi�im Kodlar� link (URL) eklemek i�in de�i�ik y�ntemleri destekler.<ul><li>Birinci y�ntem <b>[url=][/url]</b> etiketidir. = i�aretinin arkas�na yaz�lanlar link olarak �al���r. �rne�in phpBB.com'a link vermek i�in �u �ekilde yaz�n:<br /><br /><b>[url=http://www.phpbb.com/]</b>phpBB'yi ziyaret edin!<b>[/url]</b><br /><br />Sonu�ta �u linki g�receksiniz: <a href=\"http://www.phpbb.com/\" target=\"_blank\">phpBB'yi ziyaret edin!</a> Bu linki t�klay�nca ayr� bir pencere a��l�r. B�ylece kullan�c� panoyu gezmeye devam edebilir.</li><li>Link adresinin g�sterilmesini istiyorsan�z, �u �ekildede yazabilirsiniz:<br /><br /><b>[url]</b>http://www.phpbb.com/<b>[/url]</b><br /><br />Sonu�ta �u linki g�receksiniz: <a href=\"http://www.phpbb.com/\" target=\"_blank\">http://www.phpbb.com/</a></li><li>phpBB ayr�ca <i>Sihirli Linkler</i> denen bir i�leme sahip. Bunun sayesinde, kurallara uygun bir �ekilde yaz�lan her link adresi otomatik olarak link'e �evrilir, herhangi bir etiket, hatta http:// yazman�za gerek kalmaz. �rn. www.phpbb.com yaz�nca, izlenim sayfas�nda otomatik olarak <a href=\"http://www.phpbb.com/\" target=\"_blank\">www.phpbb.com</a> olarak g�r�nt�lenir.</li><li>Ayn� i�lem email adresleri i�in uygulan�r. Dilerseniz �zel olarak bir adres belirleyebilirsiniz, �rn.:<br /><br /><b>[email]</b>no.one@domain.adr<b>[/email]</b><br /><br />yaz�l�nca �u �ekilde g�r�nt�lenir: <a href=\"emailto:no.one@domain.adr\">no.one@domain.adr</a> Veya basit�e no.one@domain.adr yazabilirsiniz ve mesaj�n�z g�r�nt�lendi�inde bu k�s�m otomatik olarak link'e �evrilir.</li></ul>B�t�n Bi�im Kodlar� etiketleri gibi, link adreslerini de di�er etiketlerin i�ine alabilirsiniz, �rn. <b>[img][/img]</b> (bir sonraki madde bak�n), <b>[b][/b]</b>, vs. Bi�imleme etiketlerinde oldu�u gibi, etiketlerin d�zg�n bir �ekilde s�ras�yla kapat�lmas�n� kendiniz sa�lamal�s�n�z, �rn.:<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/url][/img]</b><br /><br />do�ru <u>de�ildir</u> ve hatta mesaj�n�z�n silinmesine yol a�abilir, bu konuda dikkatli olman�z gerek.");

$faq[] = array("--", "Mesajlarda Resim G�r�nt�leme");
$faq[] = array("Bir mesaja resim ekleme", "Bi�im Kodlar� mesajlar�n�za resim eklemek i�in bir etikete sahiptir. Bu etiketi kullan�rken iki �nemli noktay� dikkate alman�z gerek: Bir�ok kullan�c� mesajlarda �ok say�da resmin g�r�nt�lenmesini ho� kar��lam�yor. Ayr�ca kullanmak istedi�iniz resme internet �zerinden ula��labilmeli (�rn. bu resmin kendi bilgisayar�n�zda bulunmas� yeterli de�ildir). �u anda phpBB �zerinden resim kaydetme imkan� yoktur (bu konular muhtemelen phpBB'nin bir sonraki s�r�m�nde ele al�nacak). Bir resmi g�r�nt�lemek i�in, resmin adresini <b>[img][/img]</b> etiketleri i�ine almal�s�n�z. �rn.:<br /><br /><b>[img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img]</b><br /><br />Bir �nceki maddede belirtildi�i gibi, resmi dilerseniz <b>[url][/url]</b> etiketleri i�ine alabilirsiniz. �rn.:<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img][/url]</b><br /><br />yaz�nca �u sonucu verir:<br /><br /><a href=\"http://www.phpbb.com/\" target=\"_blank\"><img src=\"templates/subSilver/images/logo_phpBB_med.gif\" border=\"0\" alt=\"\" /></a><br />");

$faq[] = array("--", "Di�er Konular");
$faq[] = array("Kendi etiketlerimi ekleyebilir miyim?", "Hay�r, maalesef phpBB 2.xx s�r�m�nde b�yle bir imkan yok. Bir sonraki s�r�mde �zelle�tirilmi� Bi�im Kodlar� etiketleri sunmay� planl�yoruz.");

$faq[] = array("--", "<a name=\"tables\"></a>Tablolar ve Tablo Etiketleri");
$faq[] = array("[table] [/table] etiketleri nas�l kullan�l�r?", "Bir tablo ba�latmak i�in [table] [/table] etiketini kullan�n�z. Tablo ba�lang�c�nda [table] etiketini, tablonun sonunda [/table] etiketini kullan�l�r.");
$faq[] = array("[mrow] etiketi nas�l kullan�l�r?", "Bir ba�l�kl� s�tunla (ortal�, koyu text) ba�layan yeni bir sat�r i�in [mrow] etiketi kullan�l�r. <br />Not: [/mrow] etiketi zorunlu DE��LD�R.<br /><br /><b><u>�rne�in:</u></b><br /><br />[table]<b>[mrow]</b>Ana Sat�r[/table]etiketi<br /><br /><table align=\"top\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size: 12px\" border=\"1\" bgcolor=\"#FFFFFF\"><tr><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r</td></tr></table><br /> gibi bir g�r�nt� olu�turur.");
$faq[] = array("[mcol] etiketi nas�l kullan�l�r?", "Her ba�l�kl� sutun i�in (ortal�, koyu metin) [mcol] etiketi kullan�l�r<br />Not: [/mcol] etiketi zorunlu DE��LD�R. <br /><br /><b><u>�rne�in:</u></b><br /><br /> [table][mrow]Ana Sat�r H�cre 1<b>[mcol]</b>Ana Sat�r H�cre 2[col]Ana Sat�r H�cre 3[/table] etiketi<br /><br /><table align=\"top\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size: 12px\" border=\"1\" bgcolor=\"#FFFFFF\"><tr><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r H�cre 1</td><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r H�cre 2</td><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r H�cre 3</td></tr></table><br /> gibi bir g�r�nt� olu�turur");
$faq[] = array("[row] etiketi nas�l kullan�l�r?", "Her yeni sat�r (basit, ortal� de�il) i�in [row] etiketi kullan�l�r.<br />Not: [/row] etiketi zorunlu DE��LD�R<br /><br /><b><u>�rne�in:</u></b><br /><br />[table][mrow]Ana Sat�r<b>[row]</b>Ge�erli Sat�r[/table] etiketi<br /><br /><table align=\"top\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size: 12px\" border=\"1\" bgcolor=\"#FFFFFF\"><tr><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r</td></tr><tr><td>Ge�erli Sat�r</td></tr></table><br /> gibi bir g�r�nt� olu�turur.");
$faq[] = array("[col] etiketi nas�l kullan�l�r?", "[col] etiketi yeni bir sutun (basit, ortal� de�il) yapmak  i�in kullan�l�r<br />Not:[/col] etiketi zorunlu DE��LD�R.<br /><br /><b><u>�rnek:</u></b><br /><br /> [table][mrow]Ana Sat�r 1[mcol]Ana Sat�r 2[row]Ge�erli Sat�r 1<b>[col]</b>Ge�erli Sat�r 2[/table] etiketleri<br /><br /><table align=\"top\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size: 12px\" border=\"1\" bgcolor=\"#FFFFFF\"><tr><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r 1</td><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r 2</td></tr><tr><td>Ge�erli Sat�r 1</td><td>Ge�erli Sat�r 2</td></tr></table><br /> gibi bir g�r�nt� olu�turur.");
$faq[] = array(" [mrow], [mcol], [row], [col] etiketlerine kapatma etiketi eklemem gerekir mi?", "Hay�r, [table] etiketi, gerekli olan [/table] kapatma etiketi d���ndaki herhangi bir kapatma etiketine ihtiya� duymaz.");
$faq[] = array("Farkl� ekitetler veya �zellikler var m�?", "Herhangi bir table etiketi ile<a href=\"#color\">\"color=\"</a> ve <a href=\"#fontsize\">\"fontsize=\"</a> etiketlerini kullanabilirsiniz. HTML etiketlerindeki gibi etiketleri birbirinden tek bo�luk ile ay�rarak kullanman�z gerekmektedir. Ge�ersiz kullan�m �ekilleri istenen g�r�nt�n�n olu�mas�na engel olacakt�r.<br /><br /><a name=\"color\"><br /></a><span style=\"font-size: 16px\"><b><u>Color</u></b></span><br /><br />\"color=\" etiketi arka plan rengini de�i�tirmeye izin verir. <br />�zelle�mi� renk isimlerini kullanabilirsiniz (�rnek: red, blue, yellow, vs.) veya hexadecimal renk de�erlerini kullanabilirsiniz. �rnek: #FFFFFF, #000000.<br /><br /><b><u>�rnek:</u></b><br />[table color=blue][mrow color=green]Ana Sat�r 1[mcol color=red]Ana Sat�r 2[row color=#00FF00]Ge�erli Sat�r 1[col color=#FF0000]Ge�erli Sat�r 2[row]Ge�ersiz Sat�r 1[col]Ge�ersiz Sat�r 2[/table] etiketleri<br /><br /><table align=\"top\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size: 12px\" border=\"1\" bgcolor=\"#0000FF\"><tr bgcolor=\"#00FF00\"><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r 1</td><td bgcolor=\"#FF0000\" style=\"font-weight: bold; text-align: center;\">Ana Sat�r 2</td></tr><tr bgcolor=\"#FF0000\"><td>Ge�erli Sat�r 1</td><td bgcolor=\"#00FF00\">Ge�erli Sat�r 2</td></tr><tr><td>Ge�ersiz Sat�r 1</td><td>Ge�ersiz Sat�r 2</table><br />gibi bir g�r�nt� olu�turur.<br /><hr><br /><a name=\"fontsize\"></a><br /><span style=\"font-size: 16px\"><b><u>Fontsize</u></b></span><br /><br />\"fontsize=\" etiketi metin boyutunu de�i�tirmeye izin verir.<br />Varsay�lan olarak font size de�eri ge�erli tema dosyas�nda genellikle, FONTSIZE3 olarak gelmektedir. Bu de�eri de�i�tirmek i�in [table] etiketi �st�nde kimi etiketleri kullanman�z gerekmektedir. <br /><br /><b><u>�rnek:</u></b><br />[table fontsize=18][mrow fontsize=10]Ana Sat�r 1[mcol fontsize=14]Ana Sat�r 2[row fontsize=5]Ge�erli Sat�r 1[col fontsize=28]Ge�erli Sat�r 2[row]Ge�ersiz Sat�r 1[col]Ge�ersiz Sat�r 2[/table] etiketleri<br /><br /><table align=\"top\" cellpadding=\"2\" cellspacing=\"0\" style=\"font-size: 18px\" border=\"1\" bgcolor=\"#FFFFFF\"><tr style=\"font-size: 10px\"><td style=\"font-weight: bold; text-align: center;\">Ana Sat�r 1</td><td  style=\"font-weight: bold; text-align: center; font-size: 14px\">Ana Sat�r 2</td></tr><tr style=\"font-size: 5px\"><td>Ge�erli Sat�r 1</td><td style=\"font-size: 28px\">Ge�erli Sat�r 2</td></tr><tr><td>Ge�ersiz Sat�r 1</td><td>Ge�ersiz Sat�r 2</table><br /> gibi bir g�r�nt� olu�turur.");//

// This ends the BBCode guide entries
//

?>