<?php
// --------------------------------------------------------------
// TEL�F HAKKI : � 2000, 2005 Canver Networks [ phpBB T�rkiye ]
// --------------------------------------------------------------
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

//modlarla gelen �zellikler
$lang['Automatic_Database_Backup'] = 'Otomatik Yedekleme';
$lang['Extreame_Styles'] = 'Geli�mi� Stil';
$lang['Color_Groups'] = 'Renk Gruplar�';
$lang['Topic_Shadow'] = 'G�lge Ba�l�klar';
$lang['GD_not_found'] = 'GD K�t�phanesi Bulunamad�, L�ften hizmet sa�lay�c�n�zla irtibata ge�iniz';
$lang['Admin_voting'] = 'Anket oylar�';
$lang['Rules'] = 'Forum kurallar�';
$lang['User_avatars'] = 'Kullan�c� avatarlar�';
$lang['Auto_delete_users'] = '�yeleri otomatik sil';
$lang['Reset_users'] = 'Seviye resetle';
$lang['User_register'] = 'Yeni �ye ekle';
$lang['Email_list'] = 'E-posta listeleri';
$lang['Rebuild_Search'] = 'Arama tablosunu onar';

$lang['ADB_Maintenance'] = 'Veritaban� Bak�m';
$lang['BBackup_DB'] = 'Veritaban� Yedekle';
$lang['CRestore_DB'] = 'Veritaban� Geri Y�kle';
$lang['ZDatabase'] = 'Veri Taban�';
$lang['APermissions_search'] = 'Forum �zinleri';
$lang['BForum_auths'] = 'Toplu izinler';
$lang['CPermissions'] = '�zinler';

$lang['Forum_auth_explain_overall'] ='�stedi�iniz yetki tipini se�ip, ilgili forumlara uygulayabilirsiniz.';
$lang['Forum_auth_explain_overall_edit'] ='Varolan yetki tipleri';
$lang['Forum_auth_overall_restore'] ='�zin Restorasyonu';
$lang['ct_maintitle'] = 'G�venlik';
$lang['Styles_Management'] = 'Geli�mi� Stil';

//normal dil dosyas�
$lang['General'] = 'Genel Y�netim';
$lang['Users'] = '�ye Y�netimi';
$lang['Groups'] = 'Grup Y�netimi';
$lang['Forums'] = 'Forum Y�netimi';
$lang['Styles'] = 'Tema Y�netimi';

$lang['Configuration'] = 'Ayarlar';
$lang['Permissions'] = '�zinler';
$lang['Manage'] = 'Y�netim';
$lang['Disallow'] = 'Yasakl� �simler';
$lang['Prune'] = 'Eski Mesajlar� Sil';
$lang['Mass_Email'] = 'Kullan�c�lara E-Posta';
$lang['Ranks'] = 'Kullan�c� Seviyeleri';
$lang['Smilies'] = 'G�l�c�kler';
$lang['Ban_Management'] = 'Yasakl� Y�netimi';
$lang['Word_Censor'] = 'Sans�rl� Kelimeler';
$lang['Export'] = 'Kaydet';
$lang['Create_new'] = 'Olu�tur';
$lang['Add_new'] = 'Ekle';


//
// Index
//
$lang['Admin'] = 'Y�netim';
$lang['Admin_panel'] = 'Y�netim Paneli';
$lang['Not_admin'] = 'Bu sitenin y�neticili�ini yapma yetkiniz yok';
$lang['Welcome_phpBB'] = 'T�rk i�i phpBB forum sistemi Yakusha\'ya ho�geldiniz';
$lang['Admin_intro'] = 'T�rk i�i phpBB forum sistemi Yakusha\'y�  se�ti�iniz i�in te�ekk�r ederiz. Bu ekran size sitenizin bilgilerinin k�sa bir �zetini sunmaktad�r. Bu sayfaya soldaki <u>Y�netim - Ana Sayfa</u> linkine basarak geri d�nebilirsiniz. Sitenizin ana sayfas�na d�nmek i�in soldaki k���k logoyu kullanabilirsiniz. Soldaki di�er linkler forumunuzun her t�rl� ayar�n� yapman�z� sa�layacakt�r, her ekran kendinin nas�l kullan�laca��n� anlatacakt�r.';
$lang['Main_index'] = 'Ana Sayfa';
$lang['Forum_stats'] = '�statistikler';
$lang['Admin_Index'] = 'Y�netim - Ana Sayfa';
$lang['Preview_forum'] = 'Forum �nizlemesi';

$lang['Click_return_admin_index'] = 'Y�netim ana sayfas�na d�nmek i�in %sburaya%s t�klay�n';

$lang['Statistic'] = '�statistik';
$lang['Value'] = 'De�er';
$lang['Number_posts'] = 'Mesaj say�s�';
$lang['Posts_per_day'] = 'G�nl�k ortalama mesaj';
$lang['Number_topics'] = 'Ba�l�k say�s�';
$lang['Topics_per_day'] = 'G�nl�k ortalama ba�l�k';
$lang['Number_users'] = 'Kullan�c� say�s�';
$lang['Users_per_day'] = 'G�nl�k ortalama kullan�c�';
$lang['Board_started'] = 'Forum a��l�� tarihi';
$lang['Avatar_dir_size'] = 'Ki�isel sembol klas�r� b�y�kl���';
$lang['Database_size'] = 'Veritaban� b�y�kl���';
$lang['Gzip_compression'] = 'Gzip s�k��t�rma';
$lang['Not_available'] = 'Mevcut de�il';

$lang['ON'] = 'A��k';
$lang['OFF'] = 'Kapal�';


//
// DB Utils
//
$lang['Database_Utilities'] = 'Veritaban� ��lemleri';

$lang['Restore'] = 'Geri Y�kleme';
$lang['Backup'] = 'Yedekleme';
$lang['Restore_explain'] = 'Bu i�lem bir dosyadan t�m phpBB veritaban� tablolar�n� <B>geri y�kleyecektir</B>. E�er sunucunuz izin veriyorsa gzip ile s�k��t�r�lm�� bir text dosyas� y�kleyebilirsiniz, otomatik olarak a��lacakt�r. <b>UYARI:</b> Bu i�lem b�t�n bulunan verileri silecek yerine yenilerini yazacakt�r. Geri y�kleme uzun s�rebilir, tamamlanana kadar l�tfen bu sayfay� kapatmay�n�z.';
$lang['Backup_explain'] = 'Buradan t�m phpBB verilerinizi yedekleyebilirsiniz. E�er ayn� veritaban�nda saklamak istedi�iniz ba�ka tablolar�n�z da varsa, a�a��daki Ek Tablolar b�l�m�ne isimlerini virg�lle ay�rarak giriniz. E�er sunucunuz izin veriyorsa backup dosyan�z� gzip ile s�k��t�r�p da alabilirsiniz.';

$lang['Backup_options'] = 'Yedekleme se�enekleri';
$lang['Start_backup'] = 'Yedeklemeyi ba�lat';
$lang['Full_backup'] = 'Tam yedekleme';
$lang['Structure_backup'] = 'Sadece tablo yap�s�';
$lang['Data_backup'] = 'Sadece veriler';
$lang['Additional_tables'] = 'Ek tablolar';
$lang['Gzip_compress'] = 'Gzip s�k��t�rma';
$lang['Select_file'] = 'Bir dosya se�in';
$lang['Start_Restore'] = 'Geri y�klemeyi ba�lat';

$lang['Restore_success'] = 'Veritaban� ba�ar�yla yedeklendi.<br /><br />Siteniz yedeklemenin yap�ld��� zamanki haline d�n��t�r�ld�.';
$lang['Backup_download'] = 'Download k�sa bir s�re i�inde ba�layacak, l�tfen bekleyiniz';
$lang['Backups_not_supported'] = 'Kulland���n�z veritaban� sistemin hen�z yedekleme desteklenmiyor';

$lang['Restore_Error_uploading'] = 'Yedekleme dosyas�n� g�nderirken hata';
$lang['Restore_Error_filename'] = 'Dosya isminde problem olu�tu, l�tfen alternatif bir dosya deneyin';
$lang['Restore_Error_decompress'] = 'Gzip s�k��t�rmas� a��lam�yor, l�tfen d�zyaz� s�r�m�n� g�nderin';
$lang['Restore_Error_no_file'] = 'Dosya g�nderilmedi';


//
// Auth pages
//
$lang['Select_a_User'] = 'Bir kullan�c� se�';
$lang['Select_a_Group'] = 'Bir grup se�';
$lang['Select_a_Forum'] = 'Bir forum se�';
$lang['Auth_Control_User'] = 'Kullan�c� �zinleri Kontrol�';
$lang['Auth_Control_Group'] = 'Grup �zinleri Kontrol�';
$lang['Auth_Control_Forum'] = 'Forum �zinleri Kontrol�';
$lang['Look_up_User'] = 'Ayr�nt�lar';
$lang['Look_up_Group'] = 'Ayr�nt�lar';
$lang['Look_up_Forum'] = 'Ayr�nt�lar';

$lang['Group_auth_explain'] = 'Burada her gruba verilmi� olan izinleri ve b�l�m yetkilisi durumlar�n� de�i�tirebilirsiniz. Grup izinlerini de�i�tirirken kullan�c� izinlerinin gruptaki baz� kullan�c�lara hala baz� �zel haklar tan�yabilece�ini unutmay�n. E�er b�yle bir durum s�z konusuysa uyar�lacaks�n�z.';
$lang['User_auth_explain'] = 'Burada her kullan�c�ya verilmi� olan izinleri ve b�l�m yetkilisi durumlar�n� de�i�tirebilirsiniz. Kullan�c� izinlerini de�i�tirirken grup izinlerinin baz� kullan�c�lara hala baz� �zel haklar tan�yabilece�ini unutmay�n. E�er b�yle bir durum s�z konusuysa uyar�lacaks�n�z.';
$lang['Forum_auth_explain'] = 'Buradan her forumun izin derecesini de�i�tirebilirsiniz. Geli�mi� ve Basit olaraka ikiye ayr�lm�� olan izinlerde, geli�mi� se�ene�ini kullanarak daha �zel izinler verebilece�inizi unutmay�n�z.';

$lang['Simple_mode'] = 'Basit Mod';
$lang['Advanced_mode'] = 'Geli�mi� Mod';
$lang['Moderator_status'] = 'B�l�m yetkilisi durumu';

$lang['Allowed_Access'] = 'Eri�im izni verilmi�';
$lang['Disallowed_Access'] = 'Eri�im izni verilmemi�';
$lang['Is_Moderator'] = 'B�l�m yetkilisi';
$lang['Not_Moderator'] = 'B�l�m yetkilisi de�il';

$lang['Conflict_warning'] = 'Yetki �eli�kisi Uyar�s�';
$lang['Conflict_access_userauth'] = 'Bu kullan�c�n�n �ye oldu�u grup arac�l��� ile bu foruma eri�imi var. Grup izinleriyle oynayabilir ya da kullan�c�y� gruptan ��kartabilirsiniz. Bu durumu olu�turan gruplar ve forumlar a�a��da listelenmi�tir.';
$lang['Conflict_mod_userauth'] = 'Bu kullan�c�n�n �ye oldu�u grup arac�l��� ile bu foruma y�netici eri�imi var. Grup izinleriyle oynayabilir ya da kullan�c�y� gruptan ��kartabilirsiniz. Bu durumu olu�turan gruplar ve forumlar a�a��da listelenmi�tir.';

$lang['Conflict_access_groupauth'] = 'A�a��daki kullan�c�lar�n hala kullan�c� izinleriyle bu foruma eri�imleri var. Kullan�c� izinlerini de�i�tirebilirsiniz. �zel hakk� olan kullan�c�lar ve forumlar a�a��da listelenmi�tir.';
$lang['Conflict_mod_groupauth'] = 'A�a��daki kullan�c�lar�n hala kullan�c� izinleriyle bu foruma y�netici eri�imleri var. Kullan�c� izinlerini de�i�tirebilirsiniz. �zel hakk� olan kullan�c�lar ve forumlar a�a��da listelenmi�tir.';

$lang['Public'] = 'Herkese A��k';
$lang['Private'] = '�zel';
$lang['Registered'] = 'Kay�tl�lara A��k';
$lang['Administrators'] = 'Pano Y�neticilerine A��k';
$lang['Hidden'] = 'Gizli';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'Herkes';
$lang['Forum_REG'] = 'Kay�tl�';
$lang['Forum_PRIVATE'] = '�zel';
$lang['Forum_MOD'] = 'B�l�m Yetkilisi';
$lang['Forum_ADMIN'] = 'Pano Y�neticisi';

$lang['View'] = 'G�r�nt�leme';
$lang['Read'] = 'Okuma';
$lang['Post'] = 'G�nderme';
$lang['Reply'] = 'Cevap yazma';
$lang['Edit'] = 'De�i�tirme';
$lang['Delete'] = 'Silme';
$lang['Sticky'] = '�nemli';
$lang['Announce'] = 'Duyuru';
$lang['Vote'] = 'Oy kullanma';
$lang['Pollcreate'] = 'Anket ekleme';

$lang['Permissions'] = '�zinler';
$lang['Simple_Permission'] = 'Basit Mod';

$lang['User_Level'] = 'Kullan�c� seviyesi';
$lang['Auth_User'] = 'Kullan�c�';
$lang['Auth_Admin'] = 'Pano Y�neticisi';
$lang['Group_memberships'] = 'Grup �yelikleri';
$lang['Usergroup_members'] = 'Bu grubun �yeleri';

$lang['Forum_auth_updated'] = 'Forum izinleri g�ncellendi';
$lang['User_auth_updated'] = 'Kullan�c� izinleri g�ncellendi';
$lang['Group_auth_updated'] = 'Grup izinleri g�ncellendi';

$lang['Auth_updated'] = '�zinler g�ncellendi';
$lang['Click_return_userauth'] = 'Kullan�c� izinlerine d�nmek i�in %sburaya%s t�klay�n';
$lang['Click_return_groupauth'] = 'Grup izinlerine d�nmek i�in %sburaya%s t�klay�n';
$lang['Click_return_forumauth'] = 'Forum izinlerine d�nmek i�in %sburaya%s t�klay�n';


//
// Banning
//
$lang['Ban_control'] = 'Yasakl� Kontrol�';
$lang['Ban_explain'] = 'Buradan kullan�c�lar� yasaklama ayarlar�n� yapabilirsiniz. Bunu kullan�c� ad�n�, IP adresini ya da sunucu ad�n� banlayarak yapabilirsiniz. Bu, o kullan�c�n�n anasayfaya bile eri�imini engelleyecektir. Bir kullan�c�n�n ba�ka bir kullan�c� ad�yla kaydolmas�n� engellemek i�in o e-posta adresini yasaklayabilirsiniz. Unutmay�n ki bir e-posta adresini yasaklamak o kullan�c�n�n anasayfaya girmesini ya da mesaj gondermesini engellemez. Bunun i�in kullan�c� ad� ya da IP - sunucu yasaklamal�s�n�z.';
$lang['Ban_explain_warn'] = 'Bir IP dizisinin yasaklanmas� ba�lang�� ve biti� IP\'leri aras�ndaki t�m IP\'leri yasaklayacakt�r. Veritaban�nda yer kaplamamas� i�in uygun oldu�u yerlerde joker kullan�lacakt�r. E�er ger�ekten bir IP dizisi girmek istiyorsan�z l�tfen onu k�sa tutun ya da tek tek IP\'leri girin.';

$lang['Select_username'] = 'Kullan�c� ad� se�in';
$lang['Select_ip'] = 'IP se�in';
$lang['Select_email'] = 'E-posta adresi se�in';

$lang['Ban_username'] = 'Kullan�c� yasaklama';
$lang['Ban_username_explain'] = 'Birden fazla kullan�c� yasaklamak istiyorsan�z web taray�c�n�za uygun klavye-fare kombinasyonunu kullan�n.';

$lang['Ban_IP'] = 'IP ve Sunucu yasaklama';
$lang['IP_hostname'] = 'IP ve sunucu adresleri';
$lang['Ban_IP_explain'] = 'Birden fazla IP/sunucu yasaklamak i�in araya virg�l koyun. Bir IP dizisi belirtmek i�in ba�lang�� ve biti� aras�na - koyun. Joker olarak * kullan�n';

$lang['Ban_email'] = 'E-posta yasaklama';
$lang['Ban_email_explain'] = 'Birden fazla e-posta yasaklamak i�in virg�l kullan�n. Joker olarak * kullan�n, mesela *@hotmail.com';

$lang['Unban_username'] = 'Kullan�c� yasa�� kald�rma';
$lang['Unban_username_explain'] = 'Birden fazla kullan�c�n�n yasa��n� kald�rmak istiyorsan�z web taray�c�n�za uygun klavye-fare kombinasyonunu kullan�n';

$lang['Unban_IP'] = 'IP/sunucu yasa�� kald�rma';
$lang['Unban_IP_explain'] = 'Birden fazla IP/sunucu yasa��n� kald�rmak istiyorsan�z web taray�c�n�za uygun klavye-fare kombinasyonunu kullan�n';

$lang['Unban_email'] = 'E-posta yasa�� kald�rma';
$lang['Unban_email_explain'] = 'Birden fazla e-posta yasa��n� kald�rmak istiyorsan�z web taray�c�n�za uygun klavye-fare kombinasyonunu kullan�n';

$lang['No_banned_users'] = 'Yasakl� kullan�c� yok';
$lang['No_banned_ip'] = 'Yasakl� IP yok';
$lang['No_banned_email'] = 'Yasakl� e-posta yok';

$lang['Ban_update_sucessful'] = 'Yasak listesi ba�ar�yla g�ncellendi';
$lang['Click_return_banadmin'] = 'Yasak kontrol�ne d�nmek i�in %sburaya%s t�klay�n';


//
// Configuration
//
$lang['General_Config'] = 'Genel Ayarlar';
$lang['Config_explain'] = 'A�a��daki form sitenizdeki genel ayarlar� yapmak i�in kullan�lacakt�r. Kullan�c� ve forum bazl� ayarlar i�in sol taraftaki ilgili linklere t�klay�n�z.';

$lang['Click_return_config'] = 'Genel ayarlara d�nmek i�in %sburaya%s t�klay�n';

$lang['General_settings'] = 'Genel Pano Ayarlar�';
$lang['Server_name'] = 'Alan Ad�';
$lang['Server_name_explain'] = 'Bu panonun oldu�u sitenin alan ad�';
$lang['Script_path'] = 'Yaz�l�m yolu';
$lang['Script_path_explain'] = 'Alan ad�na g�re phpBB yaz�l�m�n�n bulundu�u yol';
$lang['Server_port'] = 'Sunucu portu';
$lang['Server_port_explain'] = 'Sunucunuzun �al��t��� port, genelde 80\'dir, sadece farkl�ysa de�i�tirin';
$lang['Site_name'] = 'Pano ismi';
$lang['Site_desc'] = 'Pano a��klamas�';
$lang['registration_status'] = '�ye Kayd�n� Durdur';
$lang['registration_status_explain'] = 'Bu se�ene�in \'Evet\' olmas�, forumunuzun yeni �ye al�m�n� durdurur.';
$lang['registration_closed'] = '�ye Kayd�n� Durdur Mesaj�';
$lang['registration_closed_explain'] = 'Bu yaz� \'�ye Kayd�n� Durdur\' se�ene�i \'Evet\' oldu�unda kullan�c�lara g�z�kecektir.';
$lang['Acct_activation'] = 'Hesap etkinle�tirme';
$lang['Acc_None'] = 'Kapal�';
$lang['Acc_User'] = 'Kullan�c�';
$lang['Acc_Admin'] = 'Pano Y�neticisi';

$lang['Abilities_settings'] = 'Kullan�c� ve Forum Genel Ayarlar�';
$lang['Max_poll_options'] = 'Maksimum anket se�ene�i say�s�';
$lang['Flood_Interval'] = 'Flood Aral���';
$lang['Flood_Interval_explain'] = 'Kullan�c�n�n iki mesaj� aras�nda beklemesi gereken s�re';
$lang['Board_email_form'] = 'Kullan�c�lar aras� e-posta';
$lang['Board_email_form_explain'] = 'Bu site arac�l��� ile kullan�c�lar�n birbirlerine e-posta g�ndermesini sa�lar';
$lang['Topics_per_page'] = 'Her sayfadaki ba�l�k say�s�';
$lang['Posts_per_page'] = 'Her sayfadaki mesaj say�s�';
$lang['Hot_threshold'] = 'Pop�lerlik s�n�r�';
$lang['Default_style'] = 'Varsay�lan tema';
$lang['Override_style'] = 'Kullan�c� temas�n� g�zard� et';
$lang['Override_style_explain'] = 'Kullan�c�lar�n se�ti�i stili varsay�lan ile de�i�tirir';
$lang['Default_language'] = 'Varsay�lan dil';
$lang['Date_format'] = 'Saat format�';
$lang['System_timezone'] = 'Sistem Zaman Dilimi';
$lang['Enable_gzip'] = 'GZip s�k��t�rma';
$lang['Enable_prune'] = 'Mesaj temizli�i';
$lang['Allow_HTML'] = 'HTML\'e izin ver';
$lang['Allow_BBCode'] = 'Bi�imlendirmeye izin ver';
$lang['Allowed_tags'] = '�zin verilen HTML etiketleri';
$lang['Allowed_tags_explain'] = 'Etiketleri virg�llerle ay�r�n';
$lang['Allow_smilies'] = 'G�l�c�klere izin ver';
$lang['Smilies_path'] = 'G�l�c�k klas�r�';
$lang['Smilies_path_explain'] = 'phpBB ana klas�r�ne g�re g�l�c�k klas�r�, �rn: images/smilies';
$lang['Allow_sig'] = '�mzaya izin ver';
$lang['Max_sig_length'] = 'Maksimum imza uzunlu�u';
$lang['Max_sig_length_explain'] = 'Kullan�c� imzalar�ndaki maksimum karakter say�s�';
$lang['Allow_name_change'] = 'Kullan�c� isim de�i�ikli�ine izin ver';

// Avatar ayarlar�
$lang['Avatar_settings'] = 'Ki�isel Sembol Ayarlar�';
$lang['Allow_local'] = 'Galeri sembolerini a�';
$lang['Allow_remote'] = 'Uzak sembolleri a�';
$lang['Allow_remote_explain'] = 'Ba�ka bir siteden link verilen semboller';
$lang['Allow_upload'] = 'Sembol g�ndermeyi a�';
$lang['Max_filesize'] = 'Maksimum sembol dosya b�y�kl���';
$lang['Max_filesize_explain'] = 'G�nderilen sebmoller i�in';
$lang['Max_avatar_size'] = 'Maksimum sembol boyutlar�';
$lang['Max_avatar_size_explain'] = '(Piksel olarak Y�kseklik x Geni�lik)';
$lang['Avatar_storage_path'] = 'Sembol Klas�r�';
$lang['Avatar_storage_path_explain'] = 'phpBB ana klas�r�ne g�re, �rn: images/avatars';
$lang['Avatar_gallery_path'] = 'Sembol Galeri Klas�r�';
$lang['Avatar_gallery_path_explain'] = 'phpBB ana klas�r�ne g�re �nceden y�klenmi� sembollerin yeri, �rn: images/avatars/gallery';

// E-posta ayarlar�
$lang['Email_settings'] = 'E-posta Ayarlar�';
$lang['Admin_email'] = 'Y�netici e-posta adresi';
$lang['Email_sig'] = 'E-posta �mzas�';
$lang['Email_sig_explain'] = 'G�nderilecek t�m e-postalara bu yaz� eklenir';
$lang['Use_SMTP'] = 'E-posta i�in SMTP sunucusunu kullan';
$lang['Use_SMTP_explain'] = 'Lokal sendmail fonksiyonu yerine SMTP sunucusunu kullanmak i�in Evet\'i se�in';
$lang['SMTP_server'] = 'SMTP Sunucu Adresi';
$lang['SMTP_username'] = 'SMTP Kullan�c� Ad�';
$lang['SMTP_username_explain'] = 'Sadece SMTP sunucunuz kullan�c� ismi istiyorsa giriniz';
$lang['SMTP_password'] = 'SMTP �ifresi';
$lang['SMTP_password_explain'] = 'Sadece SMTP sunucunuz �ifre istiyorsa giriniz';

$lang['Disable_privmsg'] = 'Ki�isel Mesajla�ma';
$lang['Inbox_limits'] = 'Gelenler\'deki maksimum msj. say�s� ';
$lang['Sentbox_limits'] = 'Ula�anlar\'daki maksimum msj. say�s�';
$lang['Savebox_limits'] = 'Saklananlar\'daki maksimum msj. say�s�';

// Cookie Ayarlar�
$lang['Cookie_settings'] = '�erez (cookie) Ayarlar�';
$lang['Cookie_settings_explain'] = 'Bu �erez\'lerin browserlara nas�l g�nderildi�ini ayarlamak i�indir. Bir �ok durumda bu ilk halinde b�rak�lmal�d�r. Bunlar� de�i�tirmeniz gerekiyorsa dikkatli olun, yanl�� ayarlar kullan�c�lar�n oturum a�mas�n� engeller.';
$lang['Cookie_domain'] = '�erez alan ad�';
$lang['Cookie_name'] = '�erez ad�';
$lang['Cookie_path'] = '�erez yolu';
$lang['Cookie_secure'] = '�erez g�venli�i [ https ]';
$lang['Cookie_secure_explain'] = 'Sunucunuz SSL modunda �al���yorsa a��n, aksi halde a�may�n';
$lang['Session_length'] = 'Oturum uzunlu�u [ saniye ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'G�rsel kay�t do�rulamaya izin ver';
$lang['Visual_confirm_explain'] = 'Yeni kay�t olanlar�, resim ile g�sterilen bir kodu girmeye mecbur eder.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Otomatik giri�e izin ver';
$lang['Allow_autologin_explain'] = 'Ziyaret�ilerin foruma otomatik giri� yapabilmelerine izin verir.';
$lang['Autologin_time'] = 'Otomatik giri� ge�erlilik s�resi.';
$lang['Autologin_time_explain'] = 'Ziyaret�i, ka� g�n forumu ziyaret etmezse otomatik giri� kayd� silinsin. Bu �zelli�i maksimum k�lmak i�in 0 giriniz.';

//
// Forum Management
//
$lang['Forum_admin'] = 'Forum Y�netimi';
$lang['Forum_admin_explain'] = 'Buradan forum ve kategorileri ekleyebilir, silebilir, de�i�tirebilir ve senkronize edebilirsiniz';
$lang['Edit_forum'] = 'Forumu de�i�tir';
$lang['Create_forum'] = 'Yeni forum ekle';
$lang['Create_category'] = 'Yeni kategori ekle';
$lang['Remove'] = '��kar';
$lang['Action'] = 'Eylem';
$lang['Update_order'] = 'S�ralamay� g�ncelle';
$lang['Config_updated'] = 'Forum Ayarlar� Ba�ar�yla G�ncellendi';
$lang['Edit'] = 'De�i�tir';
$lang['Delete'] = 'Sil';
$lang['Move_up'] = 'Yukar� ta��';
$lang['Move_down'] = 'A�a�� ta��';
$lang['Resync'] = 'Senkronize';
$lang['No_mode'] = 'Hi� bir y�ntem se�ilmedi';
$lang['Forum_edit_delete_explain'] = 'A�a��daki form panonuzdaki genel ayarlar� yapmak i�in kullan�lacakt�r. Kullan�c� ve forum bazl� ayarlar i�in sol taraftaki ilgili linklere t�klay�n�z.';

$lang['Move_contents'] = 'T�m i�eri�i ta��';
$lang['Forum_delete'] = 'Forumu sil';
$lang['Forum_delete_explain'] = 'A�a��daki form ile forum ya da kategori silebilir, i�eriklerini istedi�iniz yere ta��yabilirsiniz';

$lang['Status_locked'] = 'Kilitli';
$lang['Status_unlocked'] = 'Kilitli de�il';
$lang['Forum_settings'] = 'Genel Forum Ayarlar�';
$lang['Forum_name'] = 'Forum ad�';
$lang['Forum_desc'] = 'A��klama';
$lang['Forum_status'] = 'Forum durumu';
$lang['Forum_pruning'] = 'Otomatik Mesaj Temizleme';

$lang['prune_freq'] = 'Her x g�nde bir forumu kontrol et';
$lang['prune_days'] = 'x g�n i�inde cevap gelmeyen ba�l�klar� sil';
$lang['Set_prune_data'] = 'Mesaj temizli�ini a�t���n�z halde ka� g�nde bir mesaj temizli�i yap�lacag�n� se�mediniz';

$lang['Move_and_Delete'] = 'Ta�� ve Sil';

$lang['Delete_all_posts'] = 'T�m mesajlar� sil';
$lang['Nowhere_to_move'] = 'Ta��nacak yer yok';

$lang['Edit_Category'] = 'Kategoriyi de�i�tir';
$lang['Edit_Category_explain'] = 'Bir kategorinin ismini de�i�tirmek i�in bu formu kullan�n.';

$lang['Forums_updated'] = 'Forum ve Kategori bilgisi ba�ar�yla g�ncellendi';
$lang['Must_delete_forums'] = 'Bu kategoriyi silmeden �nce i�indeki t�m forumlar� silmelisiniz';

$lang['Click_return_forumadmin'] = 'Forum y�netim paneline d�nmek i�in %sburaya%s t�klay�n';


//
// Smiley Management
//
$lang['smiley_title'] = 'G�l�c�k Kontrol Paneli';
$lang['smile_desc'] = 'Buradan kullan�c�lara sunulan g�l�c�kleri ekleyebilir kald�rabilir ya da de�i�tirebilirsiniz.';

$lang['smiley_config'] = 'G�l�c�k Ayarlar�';
$lang['smiley_code'] = 'G�l�c�k Kodu';
$lang['smiley_url'] = 'G�l�c�k Resim Dosyas�';
$lang['smiley_emot'] = 'G�l�c�k A��klamas�';
$lang['smile_add'] = 'Yeni g�l�c�k ekle';
$lang['Smile'] = 'G�l�c�k';
$lang['Emotion'] = 'A��klama';

$lang['Select_pak'] = 'Paket (.txt) dosyas� se�';
$lang['replace_existing'] = 'Varolan g�l�c��� bununla de�i�tir';
$lang['keep_existing'] = 'Varolan g�l�c��� koru';
$lang['smiley_import_inst'] = 'G�l�c�k dosyas�n� zip ile a�mal� ve uygun g�l�c�k klas�r�ne g�ndermelisiniz. Sonra buradan do�ru se�enekleri bularak y�kleme i�lemini ger�ekle�tiriniz.';
$lang['smiley_import'] = 'G�l�c�k Paketi Kurma';
$lang['choose_smile_pak'] = 'G�l�c�k Paket Dosyas� (.txt) Se�in';
$lang['import'] = 'G�l�c�k Paketi Kur';
$lang['smile_conflicts'] = '�kilemlerde ne yap�lmal�?';
$lang['del_existing_smileys'] = 'Kurumdan �nce varolan g�l�c�kleri sil';
$lang['import_smile_pack'] = 'G�l�c�k Paketi Kur';
$lang['export_smile_pack'] = 'G�l�c�k Paketi Ekle';
$lang['export_smiles'] = 'Varolan g�l�c�klerinizden bir paket eklemek i�in, smiles.txt dosyas�n� indirmek i�in %sburaya%s t�klay�n. .txt uzant�s�n� korumak suretiyle bu dosyan�n ismini de�i�tirin. Sonra bu .txt dosyas�n� ve ilgili g�l�c�k resimlerini tek bir zip dosyas� i�inde s�k��t�r�n.';

$lang['smiley_add_success'] = 'G�l�c�k ba�ar�yla eklendi';
$lang['smiley_edit_success'] = 'G�l�c�k ba�ar�yla g�ncellendi';
$lang['smiley_import_success'] = 'G�l�c�k Paketi kurulumu ba�ar�ld�!';
$lang['smiley_del_success'] = 'G�l�c�k ba�ar�yla silindi';
$lang['Click_return_smileadmin'] = 'G�l�c�k kontrol paneline d�nmek i�in %sburaya%s t�klay�n';


//
// User Management
//
$lang['User_admin'] = 'Kullan�c� Y�netimi';
$lang['User_admin_explain'] = 'Buradan kullan�c�lar�n�z�n ayarlar�n� de�i�tirebilirsiniz. �zinleri de�i�tirmek i�in soldan �zinler linkini kullan�n.';

$lang['Look_up_user'] = 'Kullan�c�y� incele';

$lang['Admin_user_fail'] = 'Kullan�c�n�n bilgileri g�ncellenemedi.';
$lang['Admin_user_updated'] = 'Kullan�c� bilgileri ba�ar�yla g�ncellendi.';
$lang['Click_return_useradmin'] = 'Kullan�c� Y�netim Paneline d�nmek i�in %sburaya%s t�klay�n';

$lang['User_delete'] = 'Bu kullan�c�y� sil';
$lang['User_delete_explain'] = 'Kullan�c�y� silmek i�in buraya t�klay�n. Bu d�n��� olmayan bir i�lemdir.';
$lang['User_deleted'] = 'Kullan�c� ba�ar�yla silindi.';

$lang['Uye_status'] = '�ye aktif mi?';
$lang['User_status'] = 'Bu kullan�c� �u anda aktif';
$lang['User_allowpm'] = 'Ki�isel mesaj atabilir';
$lang['User_allowavatar'] = 'Ki�isel sembol kullanabilir';

$lang['Admin_avatar_explain'] = 'Burdan kullan�c�n�n �u andaki ki�isel sembol�n� silebilir ya da de�i�tirebilirsiniz.';
$lang['User_special'] = '�zel y�netici alanlar�';
$lang['User_special_explain'] = 'Bu alanlar kullan�c�lar taraf�ndan de�i�tirilemez. Buradan b�t�n kullan�c�lara verilmeyen ayarlar� yapabilirsiniz.';


//
// Group Management
//
$lang['Group_administration'] = 'Grup Y�netimi';
$lang['Group_admin_explain'] = 'Burdan gruplar�n�z� ekleyebilir, silebilir ya da de�i�tirebilirsiniz. Grup y�neticilerini, grup durumlar�n�, grup isimlerini de�i�tirebilirsiniz';
$lang['Error_updating_groups'] = 'Gruplar g�ncellenirken bir hata olu�tu';
$lang['Updated_group'] = 'Grup ba�ar�yla g�ncellendi';
$lang['Added_new_group'] = 'Yeni grup ba�ar�yla eklendi';
$lang['Deleted_group'] = 'Grup ba�ar�yla silindi';
$lang['New_group'] = 'Yeni grup ekle';
$lang['Edit_group'] = 'Grubu de�i�tir';
$lang['group_name'] = 'Grup ad�';
$lang['group_description'] = 'Grup a��klamas�';
$lang['group_moderator'] = 'Grup y�neticisi';
$lang['group_status'] = 'Grup durumu';
$lang['group_open'] = 'A��k grup';
$lang['group_closed'] = 'Kapal� grup';
$lang['group_hidden'] = 'Gizli grup';
$lang['group_delete'] = 'Grubu sil';
$lang['group_delete_check'] = 'Bu grubu sil';
$lang['submit_group_changes'] = 'De�i�iklikleri g�nder';
$lang['reset_group_changes'] = 'De�i�iklikleri sil';
$lang['No_group_name'] = 'Bu grup i�in bir isim belirtmelisiniz';
$lang['No_group_moderator'] = 'Bu grup i�in bir y�netici belirtmelisiniz';
$lang['No_group_mode'] = 'Bu grup i�in bir mod belirmelisiniz, a��k ya da kapal�';
$lang['No_group_action'] = 'Bir g�rev se�ilmemi�';
$lang['delete_group_moderator'] = 'Eski grup y�neticisi sil';
$lang['delete_moderator_explain'] = 'Grup y�neticisi de�i�tirirken, eski y�neticiyi gruptan atmak i�in buray� i�aretleyin. Aksi takdirde kullan�c� grubun normal bir �yesi olacakt�r.';
$lang['Click_return_groupsadmin'] = 'Grup y�netimine d�nmek i�in %sburaya%s t�klay�n.';
$lang['Select_group'] = 'Grup se�';
$lang['Look_up_group'] = 'Grubu incele';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Mesaj Temizli�i';
$lang['Forum_Prune_explain'] = 'Bu form ile se�ti�iniz g�n say�s� i�inde cevap gelmeyen ba�l�klar� silebilirsiniz. E�er bir say� girmezseniz t�m mesajlar silinir. ��inde anket olan mesajlar� ya da duyurular� silmeyecektir. Onlar� tek tek elle silmek zorundas�n�z.';
$lang['Do_Prune'] = 'Temizlik Yap';
$lang['All_Forums'] = 'T�m forumlar';
$lang['Prune_topics_not_posted'] = 'Bu kadar g�n i�inde cevap gelmemi� mesajlar� sil';
$lang['Topics_pruned'] = 'Silinen ba�l�klar';
$lang['Posts_pruned'] = 'Silinen mesajlar';
$lang['Prune_success'] = 'Mesaj temizli�i ba�ar�l�!';


//
// Word censor
//
$lang['Words_title'] = 'Kelime Sans�rleme';
$lang['Words_explain'] = 'Buradan otomatik olarak sans�rlenecek kelimeleri ekleyebilir, silebilir, de�i�tirebilirsiniz. Ayr�ca insanlar bu kelimeleri kullan�c� isimlerinde de kullanamazlar. Joker olarak * kullanabilirsiniz, �rn: *siklo* ansiklopedi\'yi, siklo* siklon\'u, *siklo dersiklo\'yu sans�rleyecektir.';
$lang['Word'] = 'Kelime';
$lang['Edit_word_censor'] = 'Sans�rl� kelimeyi de�i�tir';
$lang['Replacement'] = 'Yerine konulacak';
$lang['Add_new_word'] = 'Yeni kelime ekle';
$lang['Update_word'] = 'Sans�r� g�ncelle';

$lang['Must_enter_word'] = 'Bir kelime ve onun yerine girilecek kelimeyi girmelisiniz';
$lang['No_word_selected'] = 'De�i�tirmek i�in bir kelime se�mediniz';

$lang['Word_updated'] = 'Se�ilen sans�rl� kelime ba�ar�yla g�ncellendi';
$lang['Word_added'] = 'Sans�rl� kelime ba�ar�yla eklendi';
$lang['Word_removed'] = 'Se�ilen sans�rl� kelime ba�ar�yla silindi';

$lang['Click_return_wordadmin'] = 'Kelime sans�r� y�netim paneline d�nmek i�in %sburaya%s t�klay�n';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Buradan t�m kullan�c�lar�n�za ya da bir gruba dahil t�m kullan�c�lara e-posta g�nderebilirsiniz. Bu y�netici e-postas�na at�lan mesaj�n gizli karbon kopyalar�n�n kullan�c�lara g�nderilmesi yoluyla yap�lacak. E�er geni� bir gruba g�nderiyorsan�z l�tfen stop butonuna basmay�n ve sayfan�n y�klenmesini sab�rl� bir �ekilde bekleyin. B�y�k bir toptan e-posta g�nderiminin yava� olmas� do�ald�r, Yaz�l�m g�revini tamamlad���nda size haber verilecektir';
$lang['Compose'] = 'Olu�tur';
$lang['Recipients'] = 'Al�c�lar';
$lang['All_users'] = 'T�m Kullan�c�lar';
$lang['Email_successfull'] = 'Mesaj�n�z G�nderilmi�tir';
$lang['Click_return_massemail'] = 'Toptan e-posta formuna d�nmek i�in %sburaya%s t�klay�n�z';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Seviye Y�netimi';
$lang['Ranks_explain'] = 'Buradan kullan�c�lar�n�za verilecek seviyeler ekleyebilir, silebilir ve de�i�tirebilirsiniz. Kullan�c� y�netiminden kullan�c�lara verilebilecek �zel seviyeler de ekleyebilirsiniz.';

$lang['Add_new_rank'] = 'Yeni seviye ekle';

$lang['Rank_title'] = 'Seviye Ad�';
$lang['Rank_special'] = '�zel Seviye';
$lang['Rank_minimum'] = 'Minimum Mesaj Say�s�';
$lang['Rank_maximum'] = 'Maksimum Mesaj Say�s�';
$lang['Rank_image'] = 'Seviye resmi (phpBB ana klas�r�ne g�re)';
$lang['Rank_image_explain'] = 'Seviye i�in ufak bir resim kullan�n';
$lang['Rank_image_short'] = 'Seviye resmi';

$lang['Must_select_rank'] = 'Bir seviye se�melisiniz';
$lang['No_assigned_rank'] = 'Hi� �zel seviye atanmam��';

$lang['Rank_updated'] = 'Seviye ba�ar�yla g�ncellendi';
$lang['Rank_added'] = 'Seviye ba�ar�yla eklendi';
$lang['Rank_removed'] = 'Seviye ba�ar�yla silindi';
$lang['No_update_ranks'] = 'Bu seviye ba�ar�yla silindi, ancak bu seviyeye sahip olan kullan�c�lar�n ayarlar� de�i�medi. Bu kullan�c�lar�n hesaplar�n� kendiniz g�ncellemelisiniz';
$lang['Click_return_rankadmin'] = 'Seviye y�netimine d�nmek i�in %sburaya%s t�klay�n';


//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Yasakl� Kullan�c� �smi Kontrol�';
$lang['Disallow_explain'] = 'Burada kullan�lmamas� gereken kullan�c� isimlerini ayarlayabilirsiniz. Joker olarak * kullanabilirsiniz. Kay�t olmu� bir kullan�c� ad�n� yasaklayamazs�n�z, bunu yapmak i�in ilk �nce o kullan�c�y� silmelisiniz';

$lang['Delete_disallow'] = 'Sil';
$lang['Delete_disallow_title'] = 'Yasakl� bir kullan�c� ismini kald�r';
$lang['Delete_disallow_explain'] = 'Buradan yasakl� bir kullan�c� ismini se�ip g�nder butonuna basarak yasa�� kald�rabilirsiniz';

$lang['Add_disallow'] = 'Ekle';
$lang['Add_disallow_title'] = 'Yasakl� bir kullan�c� ismi ekle';
$lang['Add_disallow_explain'] = 'Joker olarak * kullanabilirsiniz';

$lang['No_disallowed'] = 'Yasakl� kullan�c� ad� yok';

$lang['Disallowed_deleted'] = 'Yasakl� kullan�c� ad� ba�ar�yla kald�r�ld�';
$lang['Disallow_successful'] = 'Yasakl� kullan�c� ad� ba�ar�yla eklendi';
$lang['Disallowed_already'] = 'Girdi�iniz isim yasaklanamad�. Ya listede var, ya sans�r listesinde var, ya da b�yle bir kullan�c� mevcut';

$lang['Click_return_disallowadmin'] = 'Yasakl� kullan�c� ad� kontrol paneline d�nmek i�in %sburaya%s t�klay�n';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Stil Y�netimi';
$lang['Styles_explain'] = 'Buradan kullan�c�lar�n�za sundu�unuz temalar�n�z� y�netebilirsiniz';
$lang['Styles_addnew_explain'] = 'Burada t�m tema\'lar�n�z listelenmi�tir. Bunlar hen�z veritaban�na kaydedilmemi�tir. Kaydetmek i�in birini se�in ve Y�kle tu�una bas�n';
$lang['Select_template'] = 'Bir tema se�in';

$lang['Style'] = 'Stil';
$lang['Template'] = 'Tema';
$lang['Install'] = 'Y�kle';
$lang['Download'] = '�ndir';

$lang['Edit_theme'] = 'Tema\'y� de�i�tir';
$lang['Edit_theme_explain'] = 'A�a��daki form ile se�ti�iniz tema\'y� de�i�tirebilirsiniz';

$lang['Create_theme'] = 'Tema ekle';
$lang['Create_theme_explain'] = 'A�a��daki form ile se�ilen tema i�in yeni bir stil ekleyin. Renkleri girerken # i�aretini kullanmay�n. �rn: CCCCCC do�ru, #CCCCCC yanl��';

$lang['Export_themes'] = 'Tema\'y� kaydet';
$lang['Export_explain'] = 'Bu panel ile se�ti�iniz tema i�in bir stil dosyas� ekleyip kaydedebileceksiniz. A�a��dan temay� se�in ve yaz�l�m onun i�in gerekli tema dosyas�n� ekleyip o klas�re kaydetmeyi deneyecektir. E�er kaydedemezse size indirme opsiyonunu sunacakt�r. Yaz�l�m\'�n dosyay� kaydedebilmesi i�in o klas�re yazma izninin verilmi� olmas� gerekir. Ayr�nt�l� bilgi i�in PhpBB2 kullanma k�lavuzuna bak�n.';

$lang['Theme_installed'] = 'Se�ilen tema ba�ar�yla y�klendi';
$lang['Style_removed'] = 'Se�ilen tema veritaban�ndan ba�ar�yla silindi. Bu tema\'y� sisteminizden tamam�yla silmek i�in dosylar�n� da silmelisiniz.';
$lang['Theme_info_saved'] = 'Se�ilen tema i�in stil bilgisi kaydedildi.';
$lang['Theme_updated'] = 'Se�ilen tema g�ncellendi. �imdi yeni tema ayarlar�n� kaydetmelisiniz';
$lang['Theme_created'] = 'Tema eklendi. �imdi bu tema\'y� sonradan kullanmak ya da ta��mak i�in kaydetmelisiniz';

$lang['Confirm_delete_style'] = 'Bu stili silmek istedi�inizden emin misiniz?';

$lang['Download_theme_cfg'] = 'Tema bilgi dosyas� yaz�lamad�. Dosyay� indirmek i�in a�a��daki butona t�klay�n�z. Sonra onu ilgili tema dosyalar�n�n bulundu�u klas�re g�ndermelisiniz. Sonra isterseniz dosyalar� da��t�m ya da ba�ka bir ama�la paketleyebilirsiniz';
$lang['No_themes'] = 'Se�ilen teman�n atanm�� hi� stili yok. Sol taraftaki Stil Y�netimi\'nden Ekle butonuna t�klay�n�z';
$lang['No_template_dir'] = 'Tema klas�r� a��lamad�. Web sunucusu taraf�ndan okunam�yor olabilir ya da b�yle bir klas�r yok';
$lang['Cannot_remove_style'] = 'Bu stil �u anda varsay�lan stil oldu�u i�in silinemez. Varsay�lan stili de�i�tirip tekrar deneyin.';
$lang['Style_exists'] = 'Se�ilen stil ad� kullan�mda, l�tfen ba�ka bir isim se�iniz.';

$lang['Click_return_styleadmin'] = 'Stil y�netimine d�nmek i�in %sburaya%s t�klay�n';

$lang['Theme_settings'] = 'Tema Ayarlar�';
$lang['Theme_element'] = 'Tema Elemanlar�';
$lang['Simple_name'] = '�smi';
$lang['Value'] = 'De�er';
$lang['Save_Settings'] = 'Ayarlar� Kaydet';

$lang['Stylesheet'] = 'CSS Stylesheet';
$lang['Stylesheet_explain'] = 'Bu Stil i�in ge�erli olan CSS dosyan�n ad�...';
$lang['Background_image'] = 'Arkaplan Resmi';
$lang['Background_color'] = 'Arkaplan Rengi';
$lang['Theme_name'] = 'Tema Ad�';
$lang['Link_color'] = 'Link Rengi';
$lang['Text_color'] = 'Yaz� Rengi';
$lang['VLink_color'] = 'Ziyaret Edilmi� Link Rengi';
$lang['ALink_color'] = 'Aktif Link Rengi';
$lang['HLink_color'] = '�st�ne Gelinen Link Rengi';
$lang['Tr_color1'] = 'Tablo Sat�r Rengi 1';
$lang['Tr_color2'] = 'Tablo Sat�r Rengi 2';
$lang['Tr_color3'] = 'Tablo Sat�r Rengi 3';
$lang['Tr_class1'] = 'Tablo Sat�r S�n�f� 1';
$lang['Tr_class2'] = 'Tablo Sat�r S�n�f� 2';
$lang['Tr_class3'] = 'Tablo Sat�r S�n�f� 3';
$lang['Th_color1'] = 'Tablo Ba�l�k Rengi 1';
$lang['Th_color2'] = 'Tablo Ba�l�k Rengi 2';
$lang['Th_color3'] = 'Tablo Ba�l�k Rengi 3';
$lang['Th_class1'] = 'Tablo Ba�l�k S�n�f� 1';
$lang['Th_class2'] = 'Tablo Ba�l�k S�n�f� 2';
$lang['Th_class3'] = 'Tablo Ba�l�k S�n�f� 3';
$lang['Td_color1'] = 'Tablo H�cre Rengi 1';
$lang['Td_color2'] = 'Tablo H�cre Rengi 2';
$lang['Td_color3'] = 'Tablo H�cre Rengi 3';
$lang['Td_class1'] = 'Tablo H�cre S�n�f� 1';
$lang['Td_class2'] = 'Tablo H�cre S�n�f� 2';
$lang['Td_class3'] = 'Tablo H�cre S�n�f� 3';
$lang['fontface1'] = 'Karakter Tipi 1';
$lang['fontface2'] = 'Karakter Tipi 2';
$lang['fontface3'] = 'Karakter Tipi 3';
$lang['fontsize1'] = 'Karakter B�y�kl��� 1';
$lang['fontsize2'] = 'Karakter B�y�kl��� 2';
$lang['fontsize3'] = 'Karakter B�y�kl��� 3';
$lang['fontcolor1'] = 'Karakter Rengi 1';
$lang['fontcolor2'] = 'Karakter Rengi 2';
$lang['fontcolor3'] = 'Karakter Rengi 3';
$lang['span_class1'] = 'Span S�n�f� 1';
$lang['span_class2'] = 'Span S�n�f� 2';
$lang['span_class3'] = 'Span S�n�f� 3';
$lang['img_poll_size'] = 'Anket resmi b�y�kl��� [px]';
$lang['img_pm_size'] = 'Ki�isel mesajlar durum resmi b�y�kl��� [px]';


//
// Install Process
//
$lang['Welcome_install'] = 'phpBB Y�klemesine Ho�geldiniz';
$lang['Initial_config'] = 'Genel Ayarlar';
$lang['DB_config'] = 'Veritaban� Ayarlar�';
$lang['Admin_config'] = 'Y�netici Ayarlar�';
$lang['continue_upgrade'] = 'Config dosyas�n� bilgisayar�nza indirdikten sonra \'Upgrade\'e Devam\' d��mesine basarak g�ncelleme i�lemine devam edebilirsiniz.';
$lang['upgrade_submit'] = 'G�ncellemeye Devam';

$lang['Installer_Error'] = 'Y�kleme s�ras�nda bir problem olu�tu';
$lang['Previous_Install'] = '�nceden y�klenmi� bir phpBB bulundu';
$lang['Install_db_error'] = 'Veritaban�n� g�ncellerken bir hata olu�tu';

$lang['Re_install'] = '�nceden y�kledi�iniz phpBB halen aktif. <br /><br />E�er phpBB\'yi yeniden y�klemek istiyorsan�z a�a��daki evet d��mesine bas�n. Bunu yaparken bunun �u andaki t�m verileri silece�ini, yedek yap�lmayaca��n� unutmay�n! Y�netici kullan�c� ad� ve �ifreniz yeniden �retilecektir; ba�ka hi�bir ayar�n�z korunmayacakt�r. <br /><br />Evet\'e basmadan �nce iyi d���n�n!';
$lang['Inst_Step_0'] = 'phpBB\'yi se�ti�iniz i�in te�ekk�r ederiz. Y�kleme i�lemini bitirmek i�in l�tfen a�a��daki bo�luklar� doldurunuz. Kullanaca��n�z veritaban�n� �nceden �retmi� olman�z gerekmektedir. Yakusha taraf�ndan modifiye edilmi� bu haliyle phpbb, mysql d���ndaki di�er veritabanlar�n� �u an i�in desteklememektedir. MySQL d���nda bir veritaban� kullanacaksan�z, standart phpbb\'yi tercih ediniz.';

$lang['Start_Install'] = 'Y�klemeye ba�la';
$lang['Finish_Install'] = 'Y�klemeyi bitir';

$lang['Default_lang'] = 'Panonun varsay�lan dili';
$lang['DB_Host'] = 'Veritaban� sunucu adresi';
$lang['DB_Name'] = 'Veritaban� ad�';
$lang['DB_Username'] = 'Veritaban� kullan�c� ad�';
$lang['DB_Password'] = 'Veritaban� �ifresi';
$lang['Database'] = 'Veritaban�n�z';
$lang['Install_lang'] = 'Y�kleme dilini se�in';
$lang['dbms'] = 'Veritaban� t�r�';
$lang['Table_Prefix'] = 'Veritaban� tablo �nadlar�';
$lang['Admin_Username'] = 'Y�netici kullan�c� ad�';
$lang['Admin_Password'] = 'Y�netici �ifresi';
$lang['Admin_Password_confirm'] = 'Y�netici �ifresi [ onay ]';

$lang['Inst_Step_2'] = 'Y�netici kullan�c� olu�turuldu. Bu noktada temel y�kleme tamamland�. �imdi yeni y�kledi�iniz panoyu y�netebilece�iniz bir sayfaya y�nlendirileceksiniz. Genel ayarlar� kontrol edin ve kendi ihtiya�lar�n�z do�rultusunda ayarlarlay�n. phpBB\'yi se�ti�iniz i�in te�ekk�r ederiz.';

$lang['Unwriteable_config'] = '�u anda config dosyas�na yaz�lam�yor. A�a��daki d��meye bas�nca bu config dosyas�n�n bir kopyas� bilgisayar�n�za indirilecektir. Bu dosyay� phpBB ile ayn� klas�r i�ine g�ndermelisiniz. Bunu yapt�ktan sonra bir �nceki form\'la �retilen y�netici ad� ve �ifresini kullanarak y�netim paneline girmeli ve ayarlar� yapmal�s�n�z. (Oturum a�t�ktan sonra ekran�n alt�nda bir link g�z�kecektir). phpBB\'yi se�ti�iniz i�in te�ekk�r ederiz.';
$lang['Download_config'] = 'Config dosyas�n� indir';

$lang['ftp_choose'] = '�ndirme Metodunu Se�in';
$lang['ftp_option'] = '<br />PHP\'nin bu s�r�m�nde ftp komutlar�na izin verildi�i i�in direk config dosyas�n� yerine ftp ile g�nderebilirsiniz.';
$lang['ftp_instructs'] = 'Config dosyas�n� phpBB\'nin bulundu�u yere otomatik olarak ftp ile g�ndermeyi se�tiniz. L�tfen a�a��daki bilgileri doldurunuz';
$lang['ftp_info'] = 'FTP bilgilerinizi girin';
$lang['Attempt_ftp'] = 'FTP ile g�nderme deneniyor';
$lang['Send_file'] = 'Bana sadece dosyay� g�nder ve ben onu kendim FTP\'liyim';
$lang['ftp_path'] = 'phpBB FTP yolu';
$lang['ftp_username'] = 'FTP Kullan�c� Ad�';
$lang['ftp_password'] = 'FTP �ifresi';
$lang['Transfer_config'] = 'Transfere ba�la';
$lang['NoFTP_config'] = 'FTP i�lemi ba�ar�s�z. L�tfen config doyas�n� indirip kendiniz g�nderiniz';

$lang['Install'] = 'Y�kle';
$lang['Upgrade'] = 'G�ncelle';

$lang['Install_Method'] = 'Y�kleme metodu';
$lang['Install_No_Ext'] = 'Sunucu\'nuz se�ti�iniz veritaban� t�r�n� desteklemiyor';
$lang['Install_No_PCRE'] = 'phpBB, php i�in \'Perl-Compatible Regular Expressions\' mod�l�ne ihtiya� duymaktad�r. Kulland���n�z php ayarlar� bunu desteklememektedir';

//
// Version Check
//
$lang['Version_up_to_date'] = 'Son s�r�m� kullan�yorsunuz. �nerilen g�ncelleme bulunmamaktad�r.';
$lang['Version_not_up_to_date'] = 'Kulland���n�z s�r�m g�ncel <b>de�il</b>. L�tfen, en g�ncel s�r�me sahip olmak i�in <a href=\'http://www.phpbb.com/downloads.php\' target=\'_new\'>www.phpbb.com/downloads.php</a> ba�lant�s�n� ziyaret edin.';
$lang['Latest_version_info'] = 'Mevcut olan en yeni phpBB s�r�m�: <b>%s</b>. ';
$lang['Current_version_info'] = 'Kulland���n�z phpBB s�r�m�: <b>%s</b>.';
$lang['Connect_socket_error'] = 'phpBB sitesi ile ba�lant� kurulamad�. Bildirilen hata:<br />%s';
$lang['Socket_functions_disabled'] = 'Soket fonksiyonlar�nda sorun olu�tu.';
$lang['Mailing_list_subscribe_reminder'] = 'En son phpBB g�ncellemelerinden haberdar olmak istiyorsan�z, l�tfen <a href=\'http://www.phpbb.com/support/\' target=\'_new\'> phpBB Haber Servisine</a> abone olun.';
$lang['Version_information'] = 'S�r�m Bilgisi';

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Yanl�� giri� denemesi.';
$lang['Max_login_attempts_explain'] = '�zin verilen yanl�� giri� denemesi.';
$lang['Login_reset_time'] = '�yelik kilitlilik s�resi';
$lang['Login_reset_time_explain'] = 'Yanl�� giri� yapan �yenin, �yeli�inin ne kadar s�re kilitlenece�ini dakika �zerinden belirtiniz.';

//Disable bord message
$lang['Board_disable_msg'] = 'Site kapal� mesaj�';
$lang['Board_disable_msg_explain'] = 'Bu yaz� \'Panoyu Kapat\' se�ene�i \'Evet\' oldu�unda kullan�c�lara g�z�kecektir.';

// Added for enhanced user management
$lang['User_lookup_explain'] = 'Formun herhangi bir k�sm�n� doldurman�z yeterlidir. Gerisini kendisi tarayacakt�r.';
$lang['One_user_found'] = 'Sadece bir kullan�c� bulundu, �ye profiline y�nlendiriliyorsunuz';
$lang['Click_goto_user'] = '�ye profilini d�zenlemek i�in %sburaya%s t�klay�n�z';
$lang['User_joined_explain'] = 'Unix time format�nda';
$lang['Click_return_perms_admin'] = 'Kullan�c� izinlerine d�nmik i�in %sburaya%s t�klay�n�z';

//topic flood
$lang['Topic_Flood_Interval'] ='Ba�l�k fload aral���';
$lang['Topic_Flood_Interval_explain'] ='�yenin kendi mesaj�na cevap yazamayaca�� zaman s�n�r�';

// LEV
$lang['Live_email_validation_title'] = 'Ger�ek zamanl� E-Posta do�rulama';
$lang['Usersname'] = '�ye Ad�';
$lang['Gonder'] = 'E-posta g�nder';
$lang['Admin_Users_List_Mail_Title'] = '�ye e-posta adresleri';
$lang['Admin_Users_List_Mail_Explain'] = 'Kay�tl� �yelerinize ait e-posta adreslerini g�rmektesiniz';

//imza resim
$lang['Max_sig_images_limit'] = '�mza i�in resim adet s�n�r�';
$lang['Max_sig_images_size'] = '�mza i�in resim s�n�r de�erleri';
$lang['Max_sig_images_size_explain'] = '(Y�kseklik x Geni�lik)';

// Bantron Mod : Begin
$lang['Bantron'] = 'Yasak Merkezi';
$lang['BM_Title'] = 'Yasak Merkezi';
$lang['BM_Explain'] = 'Bu sayfada yeni bir yasak ekleyip, d�zenleyip var olan bir yasa�� kald�rabilirsin.';

$lang['BM_Show_bans_by'] = 'Yasaklar� G�ster';
$lang['BM_All'] = 'T�m�';
$lang['BM_Show'] = 'G�ster';

$lang['BM_IP'] = 'IP';
$lang['BM_Last_visit'] = 'En son ziyaret edilen';
$lang['BM_Banned'] = 'Yasakland�';
$lang['BM_Expires'] = 'Ge�en s�re';
$lang['BM_By'] = 'Taraf�ndan';
$lang['BM_Reasons'] = 'Sebepler';

$lang['BM_Add_a_new_ban'] = 'Yeni bir yasak ekle';
$lang['BM_Delete_selected_bans'] = 'Se�ilen yasa�� kald�r';

$lang['BM_Private_reason'] = '�zel, sebebiniz';
$lang['BM_Private_reason_explain'] = 'Bu b�l�mde g�sterilen yasak sebebi, eposta adresi yada ip adresi sadece forum y�neticisi taraf�ndan g�r�lecektir.';

$lang['BM_Public_reason'] = 'A��k olacak, sebebiniz';
$lang['BM_Public_reason_explain'] = 'Bu yasak sebebini yasaklanan kullan�c� siteye giri� yapt���nda g�recektir.';
$lang['BM_Generic_reason'] = 'Genel sebep';
$lang['BM_Mirror_private_reason'] = '�zel sebebe yeni link ekle';
$lang['BM_Other'] = 'Di�erleri';

$lang['BM_Expire_time'] = 'Yasak s�resi';
$lang['BM_Expire_time_explain'] = 'Ge�en zaman diliminden sonra yasa��n aktifli�ini yitirece�ini unutmay�n�z.';
$lang['BM_Never'] = 'Asla';
$lang['BM_After_specified_length_of_time'] = 'Ge�en s�reden sonra';
$lang['BM_Minutes'] = 'Dakika';
$lang['BM_Hours'] = 'Saat';
$lang['BM_Days'] = 'G�n';
$lang['BM_Weeks'] = 'Hafta';
$lang['BM_Months'] = 'Ay';
$lang['BM_Years'] = 'Y�l';
$lang['BM_After_specified_date'] = 'Ge�en s�reden sonra';
$lang['BM_AM'] = 'G�nd�z';
$lang['BM_PM'] = 'Gece';
$lang['BM_24_hour'] = '24-Saat';
$lang['BM_Ban_reasons'] = 'Yasak Sebepleri';

//edit notes
$lang['Edit_notes_settings'] = 'D�zeltme Notlar�';
$lang['Edit_notes_enable'] = 'D�zeltme notlar� a��k';
$lang['Edit_notes_enable_explain'] = 'D�zeltme notlar�n� aktif veya pasif yapman�z� sa�lar';
$lang['Max_edit_notes'] = 'D�zeltme notlar� �st s�n�r�';
$lang['Max_edit_notes_explain'] = 'D�zeltme notlar� i�in �st s�n�r� belirleyin';
$lang['Edit_notes_permissions'] = 'D�zeltme notlar� izinleri';
$lang['Edit_notes_permissions_explain'] = 'D�zeltme notlar�n� i�in izinleri belirleyiniz';
$lang['Edit_notes_admin'] = 'Forum Y�neticisi';
$lang['Edit_notes_staff'] = 'B�l�m Yetkilisi';
$lang['Edit_notes_reg'] = 'Kay�tl� Kullan�c�lar';
$lang['Edit_notes_all'] = 'B�t�n Kullan�c�lar';

//
// Admin Userlist Start
//
$lang['Userlist'] = '�ye Listesi';
$lang['Userlist_description'] = 'T�m �yeleri g�rebilece�iniz ve y�netebilece�iniz b�l�m.';

$lang['Add_group'] = 'Gruba ekle';
$lang['Add_group_explain'] = 'Kullan�c� Grubunu se�in';

$lang['Open_close'] = '[+]';
$lang['Active'] = 'Aktif';
$lang['Group'] = 'Grup(lar)';
$lang['Rank'] = 'R�tbe';
$lang['Last_activity'] = 'Son Aktivite';
$lang['Never'] = 'Hi�bir zaman';
$lang['User_manage'] = 'Y�net';
$lang['Find_all_posts'] = 'T�m mesajlar�';

$lang['Select_one'] = 'Birini Se�in';
$lang['Ban'] = 'Ban';
$lang['Activate_deactivate'] = 'Aktif/Pasif Et';
$lang['User_id'] = 'ID';
$lang['User_level'] = 'Seviye';
$lang['Ascending'] = 'Artan';
$lang['Descending'] = 'Azalan';
$lang['Show'] = 'G�ster';
$lang['All'] = 'T�m�';
$lang['Member'] = '�ye';
$lang['Pending'] = 'Beklemede';

$lang['Confirm_user_ban'] = 'Kullan�c�(lar)� banlamak istedi�inize emin misiniz?';
$lang['Confirm_user_deleted'] = 'Kullan�c�(lar)� silmek istedi�inize emin misiniz?';

$lang['User_status_updated'] = 'Kullan�c�(lar) ba�ar�yla g�ncellendi';
$lang['User_banned_successfully'] = 'Kullan�c�(lar) ba�ar�yla banland�';
$lang['User_deleted_successfully'] = 'Kullan�c�(lar) ba�ar�yla silindi';
$lang['User_add_group_successfully'] ='Kullan�c�(lar) ba�ar�yla bir gruba eklendi';

$lang['Click_return_userlist'] = '�ye listesine d�nmek i�in %sburaya%s t�klay�n';

// Default avatar MOD, By Manipe (Begin)
$lang['Default_avatar'] = 'Sabit avatar tayini';
$lang['Default_avatar_explain'] = 'Buradan �yeleriniz i�in sabit bir avatar tayin edebilirsiniz. Bunu dilerseniz misafirleriniz i�in, isterseniz kay�tl� �yeleriniz i�in, isterseniz her iki t�r i�in de ge�erli olacak �ekilde tayin edebilirsiniz veya bu �zelli�i tamamen kapatabilirsiniz.';
$lang['Default_avatar_guests'] = 'Misafirler i�in a��k';
$lang['Default_avatar_users'] = '�yeler i�in a��k';
$lang['Default_avatar_both'] = 'Her ikisi i�in a��k';
$lang['Default_avatar_none'] = 'Avatar tayini kapal�';

$lang['Uye_ekle'] = 'Yeni �ye Ekle';
$lang['Uye_ekleme'] = 'Bu formu kullanarak forumunuza yeni �yeler ekleyebilirsiniz...';
$lang['Account_added_admin'] = 'Talebiniz �zerine, yeni �ye hesab� eklenmi�tir.';

$lang['Board_disable'] = 'Panoyu kapat';
$lang['Board_disable_explain'] = 'Bu panoyu kullan�c�lara kapayacakt�r.';
$lang['Board_disable_msg'] = 'Site kapal� mesaj�';
$lang['Board_disable_msg_explain'] = 'Bu yaz� \'Panoyu Kapat\' se�ene�i \'Evet\' oldu�unda kullan�c�lara g�z�kecektir.';

// Start add - Bin Mod
$lang['Bin_forum'] = '��p kutusu';
$lang['Bin_forum_explain'] = '��p kutusu olarak kullanmak istedi�iniz forumun id de�erini giriniz, 0 girerseniz bu fonksiyon kapat�lacakt�r. �lgili forumun izinlerinden g�r�nt�leme, okuma, editleme, silme... izinlerini b�l�m yetkilisi harici olanlara kapatmay� ihmal etmeyiniz.';

// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Aramalardaki Flood Aral���';
$lang['Search_Flood_Interval_explain'] = 'Bir kullan�c�n�n arama istekleri aras�nda beklemesi gereken saniye';
$lang['Confirm_delete_smiley'] = 'Bu Smileyi silmek istedi�inizden emin misiniz?';
$lang['Confirm_delete_word'] = 'Bu yasaklanm�� kelimeyi silmek istedi�inizden emin misiniz?';
$lang['Confirm_delete_rank'] = 'Bu seviyeyi silmek istedi�inizden emin misiniz?';

// Add stats & info MOD
$lang['Size_posts_tables'] = 'Mesaj tablosu b�y�kl���';
$lang['Size_search_tables'] = 'Arama tablosu b�y�kl���';
// Add stats & info MOD

//
// Admin Account Actions
//
$lang['Account_actions'] = '�yelik i�lemleri';
$lang['Account_inactive_explain'] = 'Burda hen�z aktif olmam��, aktif olmay� berleyen �yeleri g�rmektesiniz. �yelikleri aktif edebilir veya silebilirsiniz.<br />�lgili linkleri kullanarak �yeyle ilgili izinleri belirleyebilir veya profilini d�zenleyebilirsiniz.';
$lang['Account_active_explain'] = 'Burda aktif olmu� �yeleri g�rmektesiniz. �yelikleri pasif edebilir veya silebilirsiniz.<br />�lgili linkleri kullanarak �yeyle ilgili izinleri belirleyebilir veya profilini d�zenleyebilirsiniz.';
$lang['Account_active'] = 'Aktif �yeler';
$lang['Account_inactive'] = 'Pasif �yeler';
$lang['Account_activate'] = 'Aktif et';
$lang['Account_deactivate'] = 'Pasif et';
$lang['Account_none'] = 'Aktif olmay� bekleyen �ye yok.';
$lang['Account_total_user'] = '�ye say�s�: <b>%d</b> �ye';
$lang['Account_total_users'] = '�ye say�s�: <b>%d</b> �ye';
$lang['Account_activation'] = 'Aktivasyon metodu';
$lang['Account_awaits'] = 'Bekleme s�resi';
$lang['Account_registered'] = 'Kay�t tarihi';
$lang['Account_inactive'] = 'Pasif �yeler';
$lang['Account_active'] = 'Aktif �yeler';
$lang['Account_delete_users'] = 'Bu �yeleri silmek istedi�inizden emin misiniz?';
$lang['Account_delete_user'] = 'Bu �yeyi silmek istedi�inizden emin misiniz?';
$lang['Account_sort_letter'] = 'Arama �zelli�i';
$lang['Account_others'] = 'di�erleri';
$lang['Account_all'] = 'hepsi';
$lang['Account_year'] = 'Y�l';
$lang['Account_years'] = 'Y�l';
$lang['Account_week'] = 'Hafta';
$lang['Account_weeks'] = 'Hafta';
$lang['Account_day'] = 'G�n';
$lang['Account_days'] = 'G�n';
$lang['Account_hour'] = 'Saat';
$lang['Account_hours'] = 'Saat';
$lang['Account_user_activated'] = '�ye aktif edildi.';
$lang['Account_users_activated'] = '�yeler aktif edildi.';
$lang['Account_user_deactivated'] = '�ye pasif edildi.';
$lang['Account_users_deactivated'] = '�yeler pasif edildi.';
$lang['Account_user_deleted'] = '�ye silindi.';
$lang['Account_users_deleted'] = '�yeler silindi.';
$lang['Account_activated'] = '�yelik aktive';
$lang['Account_activated_text'] = '�yeli�iniz aktif edilmi�tir';
$lang['Account_deactivated'] = '�yelik pasifize';
$lang['Account_deactivated_text'] = '�yeli�iniz pasif edilmi�tir';
$lang['Account_deleted'] = '�yelik silme';
$lang['Account_deleted_text'] = '�yeli�iniz silinmi�tir';
$lang['Account_notification'] = 'Haber epostas� g�nderildi.';

$lang['Bantron_ban_rank'] = 'Yasakl� R�tbesi';
$lang['Bantron_ban_rank_explain'] = 'Yasaklanan kullan�c� i�in kullan�lacak renk grubunun numaras�';

$lang['Bantron_ban_color'] = 'Yasakl� Rengi';
$lang['Bantron_ban_color_explain'] = 'Yasaklanan kullan�c� i�in kullan�lacak r�tbenin numaras�';

$lang['Rss_count'] = 'RSS i�erik s�n�r�';
$lang['Rss_count_explain'] = 'RSS sayfas�nda listelenecek i�erik i�in �st s�n�r';

$lang['Login_for_profile'] = 'Profil g�n�nt�leme sadece kay�tl� �yelere a��k';
$lang['Login_for_memberlist'] = '�ye listesi sadece kay�tl� �yelere a��k';
$lang['Login_for_whoisonline'] = 'Kimler �evirimi�i sayfas� sadece kay�tl� �yelere a��k';

$lang['User_Styles'] = '�ye Stilleri';
$lang['Style_static'] = 'Stil �statistikleri';
$lang['User'] = '�ye';

$lang['Post_attachments'] = 'Dosya G�nder';
$lang['Download_attachments'] = 'Dosya �ndir';
$lang['Click_return_userprofile'] = '�ye profiline d�nmek i�in %sburaya%s t�klay�n�z';

$lang['Replace_title'] = 'Metin De�i�tir';
$lang['Replace_text'] = 'Bu ara� sayesinde, mesajlar�n�zda ge�en metinleri h�zl� bir �ekilde de�i�tirebilirsiniz. <br /><font color=\'red\'>Bu i�lemin geri d�n���m� m�mk�n de�ildir.</font>';
$lang['Link'] = 'Link';
$lang['Str_old'] = 'Ge�erli Metin';
$lang['Str_new'] = 'De�i�tirilecek Metin';
$lang['No_results'] = 'Hi�bir sonu� bulunamad�';
$lang['Replaced_count'] = 'Toplam %s mesaj de�i�tirildi';
$lang['Forum_icon'] = 'Forum ikon<br /><b>images/icons</b> dizini'; // Forum Icon MOD
$lang['Admin_session_logout'] = 'Y�netici ��k���';

//
// Inline Banner Ad
//
$lang['ad_managment']  = 'Reklam Y�netimi'; 
$lang['inline_ad_config']  = 'Reklam Ayarlar�'; 
$lang['inline_ads']  = 'Reklamlar'; 
$lang['ad_code_about']  = 'Bu sayfada �u anki reklamlar vard�r. Bu sayfadan onlar� de�i�tirebilir, yenilerini ekleyebilirsin'; 
$lang['Click_return_firstpost'] = ' Reklam y�netimine d�nmek i�in %sburaya%s t�klay�n�z..';
$lang['Click_return_inline_code'] = 'Reklam kodu y�netimine d�nmek i�in %sBuraya%s t�klay�n�z';
$lang['ad_after_post'] = 'Reklam� x Mesajdan Sonra G�r�nt�le';
$lang['ad_every_post'] = 'Reklam� x Mesajdan �nce G�r�nt�le'; 
$lang['ad_display'] = 'Reklam� G�ren Gruplar:'; 
$lang['ad_all'] = 'T�m�'; 
$lang['ad_reg'] = 'Kay�tl� Kullan�c�lar'; 
$lang['ad_guest'] = 'Kay�ts�z Kullan�c�lar';
$lang['ad_exclude'] = 'Reklam bu kullan�c� gruplar�na g�r�t�lenmesin ';
$lang['ad_forums'] = 'Reklam bu forumlarda g�r�nt�lenmesin';
$lang['ad_code'] = 'Reklam Kodu'; 
$lang['ad_post_threshold'] = 'x den fazla mesaj� olanlara reklam� g�r�nt�leme';
$lang['ad_add']  = 'Reklam Ekle'; 
$lang['ad_name']  = 'Reklam�n K�sa Ad�'; 
$lang['exclude_none']  = 'Hi�biri';

//
// Reports
//
$lang['Reports'] = 'Raporlar'; 
$lang['List'] = 'Liste'; 
$lang['Report_Admin_title'] = 'Raporlama Sistemi Y�netimi'; 
$lang['Report_Admin_explain'] = 'Bu sayfada rapor kategorileri olu�turabilir, d�zenleyebilir ve silebilir, ge�erli ayarlar� de�i�tirebilirsiniz.'; 

$lang['Report_count'] = 'Rapor say�s�'; 
$lang['Type'] = 'Bi�im'; 
$lang['Report_Type_normal'] = 'Normal'; 
$lang['Report_Type_extension'] = 'Eklenti'; 
$lang['Authorisation'] = 'Yetkilendirme'; 
$lang['Description'] = 'A��klama'; 

$lang['Standard_categories'] = 'Standart kategoriler'; 
$lang['No_standard_categories'] = 'Standart olmayan kategoriler'; 
$lang['Extension_categories'] = 'Eklenti kategoriler'; 
$lang['No_extension_categories'] = 'Eklenti olmayan kategoriler.'; 
$lang['Administrators_moderators'] = 'Forum y�neticileri ve B�l�m yetkilileri';
$lang['Only_administrators'] = 'Sadece forum y�neticileri'; 

$lang['Report_color_not_cleared'] = 'Raporlananlar�n rengi'; 
$lang['Report_color_in_process'] = 'Uygulamada olanlar�n rengi'; 
$lang['Report_color_cleared'] = 'Kald�r�lanlar�n rengi'; 
$lang['Reportlist_type'] = 'Rapor liste bi�imi'; 
$lang['Reportlist_type_admin'] = 'Y�netim Panelinde'; 
$lang['Reportlist_type_external'] = 'Y�netim Panelinde ve Listede'; 
$lang['Report_notify'] = 'E-posta bilgilendirme'; 

$lang['No_name_entered'] = 'Ge�erli bir isim girin.';
$lang['Category_deleted'] = 'Kategori ba�ar� ile silindi.'; 
$lang['Confirm_delete_category'] = 'Kategoriyi silmek istiyor musunuz?'; 
$lang['Confirm_delete_category_reportdel'] = 'T�m raporlar� bu kategorinin i�ine ta�� ve kategoriyi sil.'; 
$lang['Reports_delete'] = 'Raporlar� sil'; 
$lang['Reports_move'] = 'Raporlar� buraya ta��: %s'; 
$lang['Category_created'] = 'Kategori eklendi.'; 
$lang['Category_edited'] = 'Kategori d�zenlendi.'; 
$lang['Click_return_catadmin'] = 'Kategori y�netimine d�nmek i�in %sburaya%s t�klay�n';

$lang['Fazlalik_degerleri_bosalt_sort'] = 'Fazlal�k de�erleri bo�alt';
$lang['Fazlalik_degerleri_bosalt'] = '<b>Not:</b> <u>'.$lang['Fazlalik_degerleri_bosalt_sort'].'</u> se�ene�ini se�ti�iniz takdirde yedek alma i�leminden sonra arama tablolar�n�z� yeniden olu�turman�z gerekecektir.';

$lang['Allow_automat'] = 'Otomatik tamir �zelli�ini aktif et';
$lang['allow_automat_desc'] = 'Bu �zellik, y�netim paneline girdi�inizde b�t�n tablolar i�in g�nde bir kere, tamir et ve ��p� bo�alt komutlar�n� �al��t�r�r ';
$lang['hide_links'] = 'Linkleri misafirlerden gizle';

//
// ezportal Admin
//
$lang['General_Portal_Config'] = 'Ez-Portal Ayarlar�';
$lang['Welcome_Text'] = 'Ho�geldin Mesaj�';
$lang['Number_Recent_Topics'] = 'Son Konular Adedi';
$lang['Number_of_News'] = 'Haber adedi';
$lang['News_length'] = 'Haber uzunlu�u';
$lang['News_Forum'] = 'Haber forum(lar�)';
$lang['Poll_Forum'] = 'Anket forum(lar�)';
$lang['Comma'] = 'Forumlar (ID), birden fazla forumlar� virg�lle ay�r�n';
$lang['Portal_izleme'] = 'Portal �nizleme';

//---[+]---yakusha istatistik paneli
$lang['Statistics'] = '�statistik';
$lang['phpBB_version'] = 'phpBB versiyonu';
$lang['yakusha_version'] = 'Yakusha versiyonu';
$lang['php_version'] = 'PHP Versiyonu';
$lang['mysql_version'] = 'MySQL Versiyonu';
$lang['Wached_total'] = '�zlenen ba�l�k say�s�';
$lang['post_per_user'] = '�ye ba��na mesaj';
$lang['number_of_db_tables'] = 'Veritaban� tablo say�s�';
$lang['number_of_db_records'] = 'Veritaban� kay�t say�s�';
$lang['new_user'] = 'En yeni �ye';
$lang['son3day_list'] = 'Son �� g�n�n �yeleri';
$lang['administrators_list'] = 'Forum Y�neticileri';
$lang['moderators_list'] = 'B�l�m Yetkilileri';
$lang['deactivated_users_list'] = 'Pasif �yeler';
$lang['banned_users_list'] = 'Yasakl� �yeler';
//---[-]---yakusha istatistik paneli
$lang['Site_keywords'] = 'Site Meta Anahtarlar�';
$lang['Site_keywords_explain'] = 'Sitenizi tan�t�c� metalar� buraya girebilirsiniz';
// Link to Edit forum/Auth in ACP
$lang['Go_edit_forum'] = 'Forumu d�zenle';
$lang['Go_edit_forum_auth'] = 'Forum izinlerini d�zenle';

// Link to Edit User/Auth in ACP
$lang['Go_edit_profile'] = '�yenin profilini d�zenle';
$lang['Go_edit_auth'] = '�yenin izinlerini d�zenle';

$lang['No_selected_icon'] = 'Bo� Kullan';
$lang['Basit_seo_open'] = 'Basit Seo �zelli�i kullan�ls�n m�?';
$lang['Icon_mod_open'] = 'Forum ikonlar� �zelli�i kullan�ls�n m�?';
$lang['admin_message_save_from_mods'] = 'Admin mesajlar�n� b�l�m yetkililerinden koru';

$lang['Forum_width'] = 'Forum geni�li�i';
$lang['Forum_width_explain'] = 'Forum geni�li�ini % veya pixel cinsinden ayaralayabilirsiniz';
$lang['show_user_online_today'] = 'G�n�n ziyaret�ilerini g�r�nt�le';
$lang['show_mod_list'] = 'B�l�m yetkililerini ana sayfada g�r�nt�le';
$lang['keyword_len_explain'] = "[ Kalan Karaker ]";
$lang['topic_page_on_top'] = 'Mesaj sayfas�n� �ste dayal� g�ster?';
$lang['show_search_bots'] = 'Arama botlar�n� g�r�nt�le';
// [start] Open/Close All Forums
$lang['Close_forums'] = 'B�t�n forumlar� a�';
$lang['Open_forums'] = 'B�t�n forumlar� kilitle';
// [end] Open/Close All Forums
$lang['Version'] = 'Versiyon';
$lang['total_cat'] = 'Toplam Kategori';
$lang['total_forum'] = 'Toplam Forum';
$lang['total_supforum'] = 'Toplam �st Forum';
$lang['total_subforum'] = 'Toplam Alt Forum';
$lang['total_pm'] = 'Toplam �zel Mesaj';
$lang['total_vote'] = 'Toplam Anket';

?>