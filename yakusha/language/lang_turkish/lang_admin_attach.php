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

/**
* DO NOT CHANGE
*/
if (!isset($lang) || !is_array($lang))
{
$lang = array();
}


//
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
$lang['Control_Panel'] = 'Kontrol Paneli';
$lang['Shadow_attachments'] = 'G�lge Eklentiler';
$lang['Forbidden_extensions'] = 'Uzant�: Yasaklar';
$lang['Extension_control'] = 'Uzant�: Kontrol';
$lang['Extension_group_manage'] = 'Uzant�: Grup Y�netimi';
$lang['Special_categories'] = '�zel Kategoriler ';
$lang['Sync_attachments'] = 'Senkronize Et';
$lang['Quota_limits'] = 'Kota Limitleri';

// Attachments -> Management
$lang['Attach_settings'] = 'Y�kl� Eklentiler';
$lang['Manage_attachments_explain'] = 'Burada Eklenti MOD\'unun genel ayarlar�n� yapabilirsiniz. E�er Ayarlar� Test Et butonuna t�klarsan�z, Eklenti MOD\'u do�ru �al��mas�n� kontrol edecek olan baz� Sistem Testleri ger�ekle�tirecek. E�er eklentileri y�klemekte sorun ya��yorsan�z, bu testi �al��t�rarak detayl� bir hata mesaj� alabilirsiniz.';
$lang['Attach_filesize_settings'] = 'Eklenti Dosya Boyutu Ayarlar�';
$lang['Attach_number_settings'] = 'Eklenti Say�s� Ayarlar�';
$lang['Attach_options_settings'] = 'Eklenti Se�enekleri';

$lang['Upload_directory'] = 'Y�kleme Dizini';
$lang['Upload_directory_explain'] = 'phpBB kurulum dizinine g�re Eklenti MOD\'u y�kleme dizinini yaz�n. �rne�in, phpBB kurulumunuz dizininiz http://www.site_adi.com/phpBB2 ise ve Eklenti MOD\'u y�kleme dizininiz http://www.site_adi.com/phpBB2/files ise \'files\' yaz�n.';
$lang['Attach_img_path'] = 'Eklenti �konu';
$lang['Attach_img_path_explain'] = 'Mesajlarda, eklenti linkinin yan�nda g�r�nt�lenecek resim. E�er bir resim kullanmak istemiyorsan�z bo� b�rak�n. Bu ayar, Uzant� Grubu Y�netimi Ayarlar� taraf�ndan ge�ersiz k�l�nabilir.';
$lang['Attach_topic_icon'] = 'Eklenti Konusu �konu';
$lang['Attach_topic_icon_explain'] = 'Bu ikon eklenti bulunan ba�l���n �n�nde g�r�nt�lenir. E�er bir ikon kullanmak istemiyorsan�z bo� b�rak�n.';
$lang['Attach_display_order'] = 'Eklenti G�sterim S�ras�';
$lang['Attach_display_order_explain'] = 'Bu ayar ile eklentilerin g�sterim s�ras�n� se�ebilirsiniz. Artan ya da azalan s�rayla yeni ya da eski eklentinin �nce g�sterilmesini se�ebilirsiniz.';
$lang['Show_apcp'] = 'Yeni Eklenti G�nderme Kontrol Panelini g�ster';
$lang['Show_apcp_explain'] = 'Yeni Eklenti G�nderme Kontrol Panelinin g�sterilmesini (evet) ya da eski sistemin g�sterilmesini (hay�r) se�ebilirsiniz. (�ki se�ene�i de s�rayla deneyip size uygun olan� se�iniz)';

$lang['Max_filesize_attach'] = 'Dosya Boyutu';
$lang['Max_filesize_attach_explain'] = 'Maksimum Eklenti Boyutu. 0 de�eri \'limitsiz\' anlam�ndad�r. Bu ayar Server Ayarlar� ile s�n�rland�r�lm��t�r. �rne�in, server php ayar� maksimum 2 MB y�klemeye izin veriyorsa, bu ayar Eklenti MOD\'u taraf�ndan de�i�tirilemez.';
$lang['Attach_quota'] = 'Eklenti Kotas�';
$lang['Attach_quota_explain'] = 'T�m eklentiler i�in belirlenen maksimum disk alan�. 0 de�eri \'limitsiz\' anlam�ndad�r.';
$lang['Max_filesize_pm'] = '�zel Mesajlardaki maksimum Dosya Boyutu';
$lang['Max_filesize_pm_explain'] = '�zel Meajlar i�in belirlenen maksimum disk alan�. 0 de�eri \'limitsiz\' anlam�ndad�r.';
$lang['Default_quota_limit'] = 'Varsay�lan Kota Limiti';
$lang['Default_quota_limit_explain'] = 'Bu ayar ile yeni �ye olan �yelerin ve hi�bir limit tan�mlanmam�� �yelerin Varsay�lan Kota Limitini otomatik olarak belirleyebilirsiniz. E�er herhangi bir Eklenti Kotas� kullanm�yorsan�z \'Kota Limiti Yok\' se�ene�ini kullanabilirsiniz.';

$lang['Max_attachments'] = 'Maksimum Eklenti Say�s�';
$lang['Max_attachments_explain'] = 'Bir mesajda izin verilen maksimum eklenti say�s�.';
$lang['Max_attachments_pm'] = 'Bir �zel Mesajdaki Maksimum Eklenti Say�s�';
$lang['Max_attachments_pm_explain'] = 'Bir �zel Mesajda izin verilen maksimum eklenti say�s�.';

$lang['Disable_mod'] = 'Eklenti MOD\'u Kapat';
$lang['Disable_mod_explain'] = 'Bu se�enek yeni temalar� test ederken kullan�labilir ve Y�netim Paneli d���ndaki t�m Eklenti MOD\'u �zelliklerini kapat�r.';
$lang['PM_Attachments'] = '�zel Mesajda Eklentilere �zin Ver';
$lang['PM_Attachments_explain'] = '�zel mesajlarda eklenti g�nderip g�nderilmeyece�ini se�ebilirsiniz.';
$lang['Ftp_upload'] = 'FTP Y�klemeyi A�';
$lang['Ftp_upload_explain'] = 'FTP Y�kleme se�ene�ini a��p kapayabilirsiniz. E�er eveti se�erseniz, Eklenti FTP Ayarlar�n� tan�mlamal�s�n�z, bundan b�yle y�kleme dizini kullan�lmayacakt�r.';
$lang['Attachment_topic_review'] = 'Eklentileri mesaj g�nder ekran�nda g�r�nt�lemek ister misiniz?';
$lang['Attachment_topic_review_explain'] = 'E�er evet\'i se�erseniz, b�t�n eklentiler mesaj g�nderme ekran�nda g�r�nt�lenecektir. (Bu ekran, yeni bir cevap yazarken sayfan�n alt�nda g�r�nt�lenen ekrand�r)';

$lang['Ftp_server'] = 'FTP Y�kleme Server\'�';
$lang['Ftp_server_explain'] = 'Server�n�za dosya g�ndermek i�in buraya IP adresi veya FTP adresi girmelisiniz. E�er bu alanlar� bo� b�rak�rsan�z phpbb kurulumnda girdi�iniz de�erler esas al�n�r. Adreslerin ba��na ftp:// veya benzer bir�ey yazmay�n. (ftp.site.com veya IP adresi hangisi daha h�zl� ise)';

$lang['Attach_ftp_path'] = 'Y�kleme dizinine g�re FTP Yolu';
$lang['Attach_ftp_path_explain'] = 'Eklerin depolanaca�� dizin. Bu dizin CHMOD ayar�na sahip olmak zorunda de�il. Buraya IP ve FTP adresi <u>girmeyin</u>, bu alan sadece FTP yolu i�indir.<br />�rnek: /home/web/uploads';
$lang['Ftp_download_path'] = 'FTP Yolu i�in �ndirme Linki';
$lang['Ftp_download_path_explain'] = 'Dosyalar�n depoland��� yerin yolunu girin.<br />E�er bir uzak FTP sunucusu kullan�yorsan�z, adresini tam olarak girin, �rne�in: http://www.mystorage.com/phpBB2/upload. <br />E�er dosyalar yerel bir sunucuda depolan�yorsa, phpBB\'nin kurulu oldu�u yola g�re g�receli adresi girin, �rne�in: \'upload\'.<br />Bu alan� bo� b�rak�rsan�z, FTP yolu eri�ilemez, fiziksel indirmeyi kullanamazs�n�z.';
$lang['Ftp_passive_mode'] = 'FTP Passive Modu A�';
$lang['Ftp_passive_mode_explain'] = 'Bu �zellik uzak sunucu ile aran�zda bir kap� a�ar ve t�m ileti�imleri o kap� �zerinden y�r�t�r. Uzak sunucu kendisine ba�l� olanlar� dinler ve ona ba�lan�r.';

$lang['No_ftp_extensions_installed'] = 'FTP dosya g�ndermeyi kullanamazs�n, ��nk� sunucunuzdaki PHP bu �zelli�i desteklemiyor.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Burada sisteminizde bulunmayan Eklentilerin bilgilerini mesajlardan silebilirsiniz, ayr�ca herhangi bir mesajda g�r�nt�lenmeyen Eklentileri de silebilirsiniz. Bir linke t�klayarak eklentiyi g�rebilir ya da indirebilirsiniz. E�er bir link yoksa Eklenti sistemde bulunmamaktad�r.';
$lang['Shadow_attachments_file_explain'] = 'Hi�bir mesajda g�r�nt�lenmeyen ama sistemde bulunan Eklentileri sil.';
$lang['Shadow_attachments_row_explain'] = 'Sistemde bulunmayan Eklentilerin mesaj bilgilerini silin.';
$lang['Empty_file_entry'] = 'Bo� Dosya/Eklenti Girdisi';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Resetlenen resim �nizlemeleri: %s';
$lang['Attach_sync_finished'] = 'Eklenti Senkronizasyonu Bitti.';
$lang['Sync_topics'] = 'Ba�l�k senkronize';
$lang['Sync_posts'] = 'Mesaj senkronize';
$lang['Sync_thumbnails'] = '�nizleme resmi senkronize';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Uzant� Y�netimi';
$lang['Manage_extensions_explain'] = 'Burada dosyalar�n uzant�lar�n� y�netebilirsiniz. E�er bir uzant�ya sahip dosyan�n sisteme y�klenmesine izin vermek istiyorsan�z, l�tfen Uzant� Grubu Y�netimini kullan�n.';
$lang['Explanation'] = 'A��klama';
$lang['Extension_group'] = 'Uzant� Grubu';
$lang['Invalid_extension'] = 'Ge�ersiz Uzant�';
$lang['Extension_exist'] = '%s Uzant�s� zaten var';
$lang['Unable_add_forbidden_extension'] = '%s uzant�s� yasakl�, bu uzant�y� izin verilen uzant�lara ekleyemezsiniz'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Uzant� Gruplar� Y�netimi';
$lang['Manage_extension_groups_explain'] = 'Burada Uzant� Gruplar� ekleyebilir, silebilir ve d�zenleyebilir; Uzant� Gruplar�n� kapatabilir; �zel Kategori atayabilir; indirme �eklini de�i�tirebilir ve belli bir Uzant� Grubuna dahil eklentiler i�in y�kleme ikonu tan�mlayabilirsiniz.';
$lang['Special_category'] = '�zel Kategori';
$lang['Category_images'] = 'Resim Dosyas�';
$lang['Category_stream_files'] = 'Ak�c� Medya';
$lang['Category_swf_files'] = 'Flash Dosyas�';
$lang['Allowed'] = '�zin Ver';
$lang['Allowed_forums'] = '�zin Verilen Forumlar';
$lang['Ext_group_permissions'] = 'Grup �zinleri';
$lang['Download_mode'] = '�ndirme Modu';
$lang['Upload_icon'] = 'Y�kleme �konu';
$lang['Max_groups_filesize'] = 'Maksimum Dosya Boyutu';
$lang['Extension_group_exist'] = '%s Uzant� Grubu zaten var';
$lang['Collapse'] = '<b>[+]</b> ';
$lang['Decollapse'] = '<b>[-]</b> ';

// Extensions -> Special Categories
$lang['Manage_categories'] = '�zel Kategori Y�netimi';
$lang['Manage_categories_explain'] = 'Burada �zel Kategoriler tan�mlayabilirsiniz. �zel kategoriler i�in �zel parametre ve ko�ullar tan�mlayabilirsiniz.';
$lang['Settings_cat_images'] = '�zel Kategori Y�netimi: Resim Dosyas�';
$lang['Settings_cat_streams'] = '�zel Kategori Y�netimi: Ak�c� Medya';
$lang['Settings_cat_flash'] = '�zel Kategori Y�netimi: Flash Dosyas�';
$lang['Display_inlined'] = 'Resimleri direkt olarak g�ster';
$lang['Display_inlined_explain'] = 'Resimleri direkt veya ba�lant� (link) olarak g�sterilmesi';
$lang['Max_image_size'] = 'Maksimum Resim Boyutlar�';
$lang['Max_image_size_explain'] = 'Eklenebilecek maksimum resim boyutu (piksel olarak Geni�lik x Y�kseklik).<br />E�er 0x0 olarak ayarlarsan�z bu �zellik kapat�lacakt�r. Bu �zellik bazen PHP ayarlar�ndan dolay� d�zg�n �al��mayabilir.';
$lang['Image_link_size'] = 'Maksimum Resim Link Boyutlar�';
$lang['Image_link_size_explain'] = 'E�er bu �zellik i�in girilen de�erler a��l�rsa resim link olarak g�sterilir. E�er sat�ri�i g�ster a��ksa (piksel olarak Geni�lik x Y�kseklik).<br />E�er 0x0 olarak ayarlarsan�z bu �zellik kapat�lacakt�r. Bu �zellik bazen PHP ayarlar�ndan dolay� d�zg�n �al��mayabilir.';
$lang['Assigned_group'] = 'Gruba verilen';

$lang['Image_create_thumbnail'] = '�nizleme Resimleri �ret';
$lang['Image_create_thumbnail_explain'] = 'Her zaman bir �nizleme resmi �ret. Bu �zellik �zel Kategolerdeki kurallar�n neredeyse hepsini �i�ner, belirlenen maksimum boyutlar hari�. Bu �zellik ile eklenen resimlerin k���lt�lm�� halleri g�sterilir, t�kland���nda ise orjinal resmi a�ar.';
$lang['Image_min_thumb_filesize'] = 'Minimum �nizleme Dosya Boyutu';
$lang['Image_min_thumb_filesize_explain'] = 'E�er resim bu de�erler alt�nda ise �nizleme resmi �retilmeyecektir.';
$lang['Image_imagick_path'] = 'Imagick Program� (Tam Yolu)';
$lang['Image_imagick_path_explain'] = '�eviri program� olan imagick\'in yolunu girin, normali /usr/bin/convert (windows: c:/imagemagick/convert.exe)';
$lang['Image_search_imagick'] = 'Imagick Ara';

$lang['Use_gd2'] = 'GD2 Eklentisini Kullan ';
$lang['Use_gd2_explain'] = 'GD1 ve GD2 PHP eklentileri sisteminizde kurulu olabilir. imagemagick program� olmadan da do�ru bir �ekilde �nizleme resimleri olu�turulabilir, Eklenti MOD\'u bu y�zden size farkl� iki se�enek verir, burada sizin se�iminiz temel al�n�r. E�er �nzileme resimlerinde problem veya kalitesizlik varsa bu ayarlar� kontrol edin.';
$lang['Attachment_version'] = 'Attachment Mod Version %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Yasakl� Uzant� Y�netimi';
$lang['Manage_forbidden_extensions_explain'] = 'Burada yasakl� uzant� grubu ekleyebilir ve ��karabilirsiniz. G�venlik gerek�eleriyle php, php3 ve php4 uzant�lar� varsay�lan olarak yasaklanm��t�r, bunlar� silemezsiniz.';
$lang['Forbidden_extension_exist'] = '%s uzant�s� zaten yasakl�'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = '%s uzant�s� izin verilen uzant�lar k�sm�nda tan�ml�. L�tfen uzant�y� buraya eklemek i�in �zin Verilen uzant�lar b�l�m�nden silin.'; // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Uzant� Grubu �zinleri -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Buradan eklentiler i�in uzant� se�eneklerini forumlara g�re ayarlayabilirsiniz. Normal olarak t�m uzant�lar t�m forumlara a��kt�r. Herhangi bir zamanda tekrar t�m forumlar� se�ebilirsiniz. E�er yeni bir forum eklerseniz bu t�m forumlar se�ene�ine dahil olur. E�er foruma giri�i s�n�rlad�ysan, ilk �nce buradan gerekli ayarlar� yap�n.';
$lang['Note_admin_empty_group_permissions'] = 'NOT:<br />Burada kullan�c�lar�n normal olarak dosya ekleyebilece�i forumlar s�ralan�r, ama uzant� ayarlar� izin vermiyorsa, kullan�c�lar herhangi bir�ey g�nderemez. E�er onlar dosya g�ndermeyi denerlerse bir hata mesaj� alacaklar. Belki bu forumlara Y�neticinin dosya g�ndermesine izin vermek isteyebilirsin.<br /><br />';
$lang['Add_forums'] = 'Forum Ekle';
$lang['Add_selected'] = 'Se�ileni Ekle';
$lang['Perm_all_forums'] = 'B�T�N FORUMLAR';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Eklenti Kotas� Limitleri Y�netimi';
$lang['Manage_quotas_explain'] = 'Burada Kota Limitleri ekleyebilir, silebilir ve de�i�tirebilirsiniz. Kota Limitlerini daha sonra Kullan�c� Ve Kullan�c� Gruplar�na atayabilirsiniz. Bir Kullan�c�ya bir Kota Limiti atamak i�in, Kullan�c�lar->Y�netim linklerini izleyerek Kullan�c�y� se�tikten sonra en alttaki Se�enekten ayarlayabilirsiniz. Bir Kullan�c� Grubuna bir Kota Limiti atamak i�in, Kullan�c� Gruplar�->Y�netim linklerini takip ederek istedi�iniz Kullan�c� Grubunu se�tikten sonra gerekli Ayar� yapabilirsiniz. Hangi Kullan�c�lara ve Kullan�c� Gruplar�na Kota Limiti atand���n� g�rmek i�in, Kota A��klamas�n�n solundaki \'G�r�nt�leme\' linkine t�klay�n.';
$lang['Assigned_users'] = 'Atanan Kullan�c�lar';
$lang['Assigned_groups'] = 'Atanan Kullan�c� Gruplar�';
$lang['Quota_limit_exist'] = '%s Kota Limiti zaten var.';

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Dosya Eklenti Kontrol Paneli';
$lang['Control_panel_explain'] = 'Burada Kullan�c�, Eklenti, �zlenim gibi �zelliklere ba�l� olarak b�t�n eklentileri g�rebilir ve y�netebilirsiniz';
$lang['File_comment_cp'] = 'Dosya A��klamas�';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = '* i�areti ile kelimenin bir b�l�m�n� girip gerisinin bulunmas�n� sa�layabilirsiniz';
$lang['Size_smaller_than'] = 'Eklenti boyutu k���kt�r (byte)';
$lang['Size_greater_than'] = 'Eklenti boyutu b�y�kt�r (byte)';
$lang['Count_smaller_than'] = '�ndirilme say�s� k���kt�r';
$lang['Count_greater_than'] = '�ndirilme say�s� b�y�kt�r';
$lang['More_days_old'] = 'Belirtilen g�nden eski eklentiler';
$lang['No_attach_search_match'] = 'Arama iste�inize g�re sonu� bulunamad�';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Eklenti Say�s�';
$lang['Total_filesize'] = 'Toplam Dosya Boyutu';
$lang['Number_posts_attach'] = 'Eklentili Mesajlar�n Say�s�';
$lang['Number_topics_attach'] = 'Eklentili Konular�n Say�s�';
$lang['Number_users_attach'] = 'Eklenti G�nderen Toplam Kullan�c� Say�s�';
$lang['Number_pms_attach'] = '�zel Mesajlardaki Toplam Eklenti Say�s�';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = '%s i�in Eklenti �statistikleri';
$lang['Size_in_kb'] = 'Boyut (KB)';
$lang['Downloads'] = '�ndirilme';
$lang['Post_time'] = 'G�nderilme Zaman�';
$lang['Posted_in_topic'] = 'Konu';
$lang['Submit_changes'] = 'De�i�iklikleri G�nder';

// Sort Types
$lang['Sort_Attachments'] = 'Eklentiler';
$lang['Sort_Size'] = 'Boyut';
$lang['Sort_Filename'] = 'Dosya Ad�';
$lang['Sort_Comment'] = 'Yorum';
$lang['Sort_Extension'] = 'Uzant�';
$lang['Sort_Downloads'] = '�ndirilme';
$lang['Sort_Posttime'] = 'G�nderilme Zaman�';
$lang['Sort_Posts'] = 'Mesajlar';

// View Types
$lang['View_Statistic'] = '�statistikler';
$lang['View_Search'] = 'Ara';
$lang['View_Username'] = 'Kullan�c� Ad�';
$lang['View_Attachments'] = 'Eklentiler';

// Successfully updated
$lang['Attach_config_updated'] = 'Eklenti Ayarlar� ba�ar�yla g�ncellendi';
$lang['Click_return_attach_config'] = 'Eklenti Ayarlar�na d�nmek i�in %sburaya%s t�klay�n';
$lang['Test_settings_successful'] = 'Ayar Testi bitti. Yapt���n�z ayarlarda bir sorun yok.';

// Some basic definitions
$lang['Attachments'] = 'Mesaj Ekleri';
$lang['Attachment'] = 'Eklenti';
$lang['Extensions'] = 'Uzant�lar';
$lang['Extension'] = 'Uzant�';

// Auth pages
$lang['Auth_attach'] = 'Dosya G�nder';
$lang['Auth_download'] = 'Dosya �ndir';

?>