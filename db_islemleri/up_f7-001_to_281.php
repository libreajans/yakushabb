<?php

define("IN_PHPBB", true);
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// General Information
$agreed = $_GET['agreed'];
$old_ver = 'Yakusha F-7.001';
$new_ver = 'Yakusha 2.8.1';

$title = $old_ver. ' &raquo; ' .$new_ver;
$version = 'V.2.0.0';
$rootpath = './';
$sprefix = 'phpbb_';

// Load Configuration
@@include($rootpath . "extension.inc");
@@include($rootpath . "config." . $phpEx);
?>

<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<style>
body { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; background-color: #e8eaed;}
h3 { font-size : 16px; color: darkred; border-bottom-width: 2px; border-bottom-style: dotted; border-bottom-color: #D1D7DC; }
.error { font-family: Arial; font-size : 11px; color: red; font-weight: bold; }
.okey { font-family: Arial; font-size : 11px; color: #00AA00; font-weight: bold; }
.islem { font-family: Arial; font-size : 11px; color: #808080; font-weight: normal; }
p { font-family: Verdana; font-size : 13px; font-weight: normal; }
</style>

</head>
<body bgcolor="#70A5CC">

<?php
// veri tabanı bağlantısı
@$sql = mysql_connect($dbhost, $dbuser, $dbpasswd)
or die("<span class='error'><center>Sistem Hatası: SQL Bağlantısı Kurulamıyor.</span>");

@mysql_select_db($dbname)
or die("<span class='error'><center>Sistem Hatası: Database Bağlantısı Kurulamıyor..</span>");

// sql sorguları
$sql = Array(

" INSERT INTO phpbb_config ( config_name, config_value ) VALUES ('show_mod_list',0); ",
" CREATE TABLE phpbb_portal ( portal_name varchar(255) NOT NULL, portal_value TEXT NOT NULL, PRIMARY KEY (portal_name)) ",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'welcome_text', 'Buraya mesajınızı yazabilirsiniz....<br /><br />Mesajı değiştirmek için yönetici panelinden portal kısmına giriniz. <b>HTML</b> komutları kullanabilirsiniz.<br /><br />Daha fazla bilgi ve sorular için lütfen destek sitemizi (www.yakusha.net) ziyaret ediniz.')",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'number_of_news', '5')",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'news_length', '200')",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'news_forum ', '1')",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'poll_forum ', '1')",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'number_recent_topics', '10')",
" INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'number_recent_news', '15')",
#-- tema tablosu boşaltılıyor ve temalar yeniden tanıtılıyor
" TRUNCATE TABLE `phpbb_themes`; ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('1', 'xand', 'xand', 'xand.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL); ",

" TRUNCATE TABLE `phpbb_themes_name`; ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('1', 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', ''); ",

//---------- mod listesi girilyor
" TRUNCATE TABLE `phpbb_hacks_list`; ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('1', 'Şehir Açılır Kutuda', 'Kullanıcı profilinde bulunan ve profil değişikliği ile kayıt sırasında doldurulabilen şehir/nereli girdi kutusunu, içinde şehirlerin yer aldığı açılır (drop-down) bir kutu ile değiştirir.', 'ALEXIS', '', 'http://www.canver.net', '3.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('2', 'Meslek Açılır Kutuda', 'Kullanıcı profilinde bulunan ve profil değişikliği ile kayıt sırasında doldurulabilen meslek girdi kutusunu, içinde mesleklerin yer aldığı açılır (drop-down) bir kutu ile değiştirir.', 'ALEXIS', '', 'http://www.canver.net', '2.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('3', 'Toplam üye sayısı link', 'index.php sayfasının altında bulunan istatiktik kutusunda yer alan toplam üye sayısını üye listesine gidecek şekilde linkler.', 'ALEXIS', '', 'http://www.canver.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('4', 'Forum yönetim geliştirme', 'Yönetim panelindeki forum yönetim kısmında, sil, değiştir, düzenle vb. linkleri resimler ile değiştirir ;)', 'ALEXIS', '', 'http://www.canver.net', '1.0.0a', 'no', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('5', 'Display Total Replies And Views In Viewtopic', 'Bu eklenti wiewtopic.php de toplam cevabı ve gösterimi gösterir', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.1', 'No', '', '0', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('6', 'Display forum desciription in viewforum', 'Bu eklenti wiewforum.php de forum açıklamasını gösterir', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('7', 'Special ban system', 'Üyelerin, mesaj gönderip gönderemeyeceğine yöneticilerin karar verebilmelerine imkan tanır.', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('8', 'Multi-page topics, forums or searchs in one page', 'Çoklu sonuçları tek sayfada gösterir, topic, forum ve search sayfalarında..', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.5', 'No', '', '', '1144334662'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('9', 'My bbcode box lt', 'BBcode butonlarını Microsoft Office 2003 tarzı buton seti şekline dönüştürür ve yeni bbcode özellikleri ekler. Advancad bbcode box modunun daha da küçültülmüş, orta halli bir türevidir. Çoklu dil özelliklerini kaldıracak şekilde yapılandırılmıştır.', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '2.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('10', 'Yakusha Modlist', 'Modların listesinin oluşturulmasına ve mod bilgilerinin düzenlenmesine imkan tanır. Nivisec - Admin hack list 1.2.0 modunun geliştirilmiş bir türevidir.', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.0', 'No', '', '0', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('11', 'Lock / Unlock Topic with Post', 'Mesajdan ilgili başlığı kilitlemeye veya kilidi açmaya yarar.', 'Yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.2', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('12', 'Light Statictik', 'İstatistik bilgisi verileri için fazladan yapılan if döngüsü karmaşasını düzeltir.', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('13', 'Clean BBcode', 'Oluşturduğumuz bir bbcode listesiyle açıkta kalan geçersiz biçim kodlarını temizler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.2', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('14', 'Highlight Clean', 'Highlight özelliği için bir düzeltme içerir. (Yayınlanmamış sürümdür)', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.4', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('15', 'Bantron Eklentileri', 'Bantron ile banlanan üyeye, otomatik olarak, önceden ayarlanmış olan banlı rütbesini atar, renk gruplarından da aynı işlemi gerçekleştirir. Eğer üye üye listesinden banlanmışsa, yine aynı işlemi yapar. :)', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('16', 'İstatistik bilgilerine bilgi ekle', 'Panele arama tablosu ve mesaj tablosu büyüklüğünü de ekler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('17', 'Date and backup type in backup filename', 'his MOD automatically adds the current date and backup type to the filename of database backup files', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('18', 'Logged In control on acp', 'Profil görüntüleme, üye listesi, kimler online sayfalarını misafirlerin görüp göremeyeceğini panelden ayarlamaya yarar', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('19', 'Moderate list open / close', 'Bölüm yetkilisi bilgilerinin ana sayfada görünüp görünmemesini yönetim panelinden kontrol etmeye izin verir', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('20', 'Otomatik bakım - Version cache eklentisi', 'Version cache moduyla birlikte çalışır, yönetim panelinden aç kapa özelliği vardır. 24 saatte bir bütün tabloları optimize ve repair eder! Admin paneline girişte bu sorgulamayı yapar. ', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('21', 'Bölüm yetkilileri kontrolü ', 'Ana sayfada, bölüm yetkilisi bilgilerinin görünüp görünemeyeceğini yönetim panelinden kontrol etmeye izin veren basit bir özellik ekler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('22', 'Easy Meta tag Control', 'Metaları tek noktada toplar ve her dosyanın ihtiyacı olan metalar tek noktadan çekilir', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('23', 'Yönetim paneli istatistik sayfası', 'Yönetim paneli ana sayfasındaki istatistikler için yeni bir sayfa oluşturur ve bir çok yeni istatistik ve teknik bilgi ekler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', 'Alfa 0.1.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('24', 'Bantron - Yasaklılar Sayfası', 'Bantron moduyla yasaklanan üyelerin yasak geçerlilik sürelerini, yasaklanma zamanlarını ve yasaklanma sebeplerini listeler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', 'Alfa 0.1.0', 'No', '', '', '0'); ",
 //avatar boyutu yeniden ayarlanıyor
" UPDATE `phpbb_config` SET `config_value` = '97' WHERE `config_name` = 'avatar_max_width'; ",
" UPDATE `phpbb_config` SET `config_value` = '97' WHERE `config_name` = 'avatar_max_height'; ",

#-[+]---- son bakım işlemleri ----
" UPDATE phpbb_config SET `config_name` = 'default_style', `config_value` = '1' WHERE `config_name` = 'default_style'; ",
" UPDATE phpbb_config SET `config_name` = 'default_lang', `config_value` = 'turkish' WHERE `config_name` = 'default_lang';",
" UPDATE phpbb_users SET `user_style` = 'NULL' WHERE `user_id` > '1';",

" UPDATE phpbb_config SET `config_name` = 'yakusha_ver', `config_value` = 'yakusha 2.8.1' WHERE `config_name` = 'yakusha_ver';",
#-[-]---- son bakım işlemleri ----

);
?>

<center>
<table border="0" width="800px" cellspacing="0">
<tr>
<td width="100%" valign="top" bgcolor="#ffffff">
<br>
<br>
 <table align="center" border="0" height="850%" width="90%" cellspacing="0">
 <tr>
 <td align="right">
 <h3><b><?=$title; ?></b> <small><?=$version; ?></small></h3>
 <br>
 <br>
 <p align="center"><?php echo $old_ver;?> için Database güncelleme işlemine hoşgeldiniz. <br /><br />Bu kurulum Scripti Databasenizi <br /><b><?php echo $old_ver;?></b> sürümünden <b><?php echo $new_ver;?></b><br /> sürümüne güncelleyecektir.
 </td>
 </tr>
 <tr>
 <td>
 <?php
 if (@$agreed == "true") {

 echo "
 <br /><p align='center'><b>Database İşlemleri</b>
 <ul>
 ";
 // şimdi databese güncelleme işlemi gerçekleştiriliyor
 for( $i = 0; $i < count($sql); $i++ )
 {
 $sql[$i] = preg_replace('/' . $sprefix . '/', $table_prefix, $sql[$i]);
 if(!$result = mysql_query ($sql[$i]) )
 {
 echo '<li><span class="error">[ HATA ]</span><span class="islem"> ' . $sql[$i] . '</font></li></span><br />';
 }
 else
 {
 echo '<li><span class="okey">[ TAMAM ]</span><span class="islem"> ' . $sql[$i] . '</font></li></span><br />';
 }
 }
 echo "
 </ul>
 <p align='center'>İşlem tamamlanmıştır! Bu dosyayı web alanınızdan <b>mutlaka siliniz.</b>
 <br /><br />
 Foruma geri dönmek için <a href=\"./index.$phpEx\">buraya</a> tıklayınız.
 ";
 }
 else
 {
 echo "
 <br /><p align='center'> Güncelleme işlemini gerçekleştirmek için <a href=\"?agreed=true\">buraya</a> tıklayınız.
 ";
 }
 ?>
 </td>
 </tr>
 </table>
 </center>
 <br /><br />
</td>
</tr>
</table>
</body>
</html>


<?php @mysql_close($sql); ?>