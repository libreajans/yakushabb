<?php
// --------------------------------------------------------------
// TELÝF HAKKI : © 2000, 2005 Canver Networks [ phpBB Türkiye ]
// --------------------------------------------------------------
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

//modlarla gelen özellikler
$lang['Automatic_Database_Backup'] = 'Otomatik Yedekleme';
$lang['Extreame_Styles'] = 'Geliþmiþ Stil';
$lang['Color_Groups'] = 'Renk Gruplarý';
$lang['Topic_Shadow'] = 'Gölge Baþlýklar';
$lang['GD_not_found'] = 'GD Kütüphanesi Bulunamadý, Lüften hizmet saðlayýcýnýzla irtibata geçiniz';
$lang['Admin_voting'] = 'Anket oylarý';
$lang['Rules'] = 'Forum kurallarý';
$lang['User_avatars'] = 'Kullanýcý avatarlarý';
$lang['Auto_delete_users'] = 'Üyeleri otomatik sil';
$lang['Reset_users'] = 'Seviye resetle';
$lang['User_register'] = 'Yeni üye ekle';
$lang['Email_list'] = 'E-posta listeleri';
$lang['Rebuild_Search'] = 'Arama tablosunu onar';

$lang['ADB_Maintenance'] = 'Veritabaný Bakým';
$lang['BBackup_DB'] = 'Veritabaný Yedekle';
$lang['CRestore_DB'] = 'Veritabaný Geri Yükle';
$lang['ZDatabase'] = 'Veri Tabaný';
$lang['APermissions_search'] = 'Forum Ýzinleri';
$lang['BForum_auths'] = 'Toplu izinler';
$lang['CPermissions'] = 'Ýzinler';

$lang['Forum_auth_explain_overall'] ='Ýstediðiniz yetki tipini seçip, ilgili forumlara uygulayabilirsiniz.';
$lang['Forum_auth_explain_overall_edit'] ='Varolan yetki tipleri';
$lang['Forum_auth_overall_restore'] ='Ýzin Restorasyonu';
$lang['ct_maintitle'] = 'Güvenlik';
$lang['Styles_Management'] = 'Geliþmiþ Stil';

//normal dil dosyasý
$lang['General'] = 'Genel Yönetim';
$lang['Users'] = 'Üye Yönetimi';
$lang['Groups'] = 'Grup Yönetimi';
$lang['Forums'] = 'Forum Yönetimi';
$lang['Styles'] = 'Tema Yönetimi';

$lang['Configuration'] = 'Ayarlar';
$lang['Permissions'] = 'Ýzinler';
$lang['Manage'] = 'Yönetim';
$lang['Disallow'] = 'Yasaklý Ýsimler';
$lang['Prune'] = 'Eski Mesajlarý Sil';
$lang['Mass_Email'] = 'Kullanýcýlara E-Posta';
$lang['Ranks'] = 'Kullanýcý Seviyeleri';
$lang['Smilies'] = 'Gülücükler';
$lang['Ban_Management'] = 'Yasaklý Yönetimi';
$lang['Word_Censor'] = 'Sansürlü Kelimeler';
$lang['Export'] = 'Kaydet';
$lang['Create_new'] = 'Oluþtur';
$lang['Add_new'] = 'Ekle';


//
// Index
//
$lang['Admin'] = 'Yönetim';
$lang['Admin_panel'] = 'Yönetim Paneli';
$lang['Not_admin'] = 'Bu sitenin yöneticiliðini yapma yetkiniz yok';
$lang['Welcome_phpBB'] = 'Türk iþi phpBB forum sistemi Yakusha\'ya hoþgeldiniz';
$lang['Admin_intro'] = 'Türk iþi phpBB forum sistemi Yakusha\'yý  seçtiðiniz için teþekkür ederiz. Bu ekran size sitenizin bilgilerinin kýsa bir özetini sunmaktadýr. Bu sayfaya soldaki <u>Yönetim - Ana Sayfa</u> linkine basarak geri dönebilirsiniz. Sitenizin ana sayfasýna dönmek için soldaki küçük logoyu kullanabilirsiniz. Soldaki diðer linkler forumunuzun her türlü ayarýný yapmanýzý saðlayacaktýr, her ekran kendinin nasýl kullanýlacaðýný anlatacaktýr.';
$lang['Main_index'] = 'Ana Sayfa';
$lang['Forum_stats'] = 'Ýstatistikler';
$lang['Admin_Index'] = 'Yönetim - Ana Sayfa';
$lang['Preview_forum'] = 'Forum Önizlemesi';

$lang['Click_return_admin_index'] = 'Yönetim ana sayfasýna dönmek için %sburaya%s týklayýn';

$lang['Statistic'] = 'Ýstatistik';
$lang['Value'] = 'Deðer';
$lang['Number_posts'] = 'Mesaj sayýsý';
$lang['Posts_per_day'] = 'Günlük ortalama mesaj';
$lang['Number_topics'] = 'Baþlýk sayýsý';
$lang['Topics_per_day'] = 'Günlük ortalama baþlýk';
$lang['Number_users'] = 'Kullanýcý sayýsý';
$lang['Users_per_day'] = 'Günlük ortalama kullanýcý';
$lang['Board_started'] = 'Forum açýlýþ tarihi';
$lang['Avatar_dir_size'] = 'Kiþisel sembol klasörü büyüklüðü';
$lang['Database_size'] = 'Veritabaný büyüklüðü';
$lang['Gzip_compression'] = 'Gzip sýkýþtýrma';
$lang['Not_available'] = 'Mevcut deðil';

$lang['ON'] = 'Açýk';
$lang['OFF'] = 'Kapalý';


//
// DB Utils
//
$lang['Database_Utilities'] = 'Veritabaný Ýþlemleri';

$lang['Restore'] = 'Geri Yükleme';
$lang['Backup'] = 'Yedekleme';
$lang['Restore_explain'] = 'Bu iþlem bir dosyadan tüm phpBB veritabaný tablolarýný <B>geri yükleyecektir</B>. Eðer sunucunuz izin veriyorsa gzip ile sýkýþtýrýlmýþ bir text dosyasý yükleyebilirsiniz, otomatik olarak açýlacaktýr. <b>UYARI:</b> Bu iþlem bütün bulunan verileri silecek yerine yenilerini yazacaktýr. Geri yükleme uzun sürebilir, tamamlanana kadar lütfen bu sayfayý kapatmayýnýz.';
$lang['Backup_explain'] = 'Buradan tüm phpBB verilerinizi yedekleyebilirsiniz. Eðer ayný veritabanýnda saklamak istediðiniz baþka tablolarýnýz da varsa, aþaðýdaki Ek Tablolar bölümüne isimlerini virgülle ayýrarak giriniz. Eðer sunucunuz izin veriyorsa backup dosyanýzý gzip ile sýkýþtýrýp da alabilirsiniz.';

$lang['Backup_options'] = 'Yedekleme seçenekleri';
$lang['Start_backup'] = 'Yedeklemeyi baþlat';
$lang['Full_backup'] = 'Tam yedekleme';
$lang['Structure_backup'] = 'Sadece tablo yapýsý';
$lang['Data_backup'] = 'Sadece veriler';
$lang['Additional_tables'] = 'Ek tablolar';
$lang['Gzip_compress'] = 'Gzip sýkýþtýrma';
$lang['Select_file'] = 'Bir dosya seçin';
$lang['Start_Restore'] = 'Geri yüklemeyi baþlat';

$lang['Restore_success'] = 'Veritabaný baþarýyla yedeklendi.<br /><br />Siteniz yedeklemenin yapýldýðý zamanki haline dönüþtürüldü.';
$lang['Backup_download'] = 'Download kýsa bir süre içinde baþlayacak, lütfen bekleyiniz';
$lang['Backups_not_supported'] = 'Kullandýðýnýz veritabaný sistemin henüz yedekleme desteklenmiyor';

$lang['Restore_Error_uploading'] = 'Yedekleme dosyasýný gönderirken hata';
$lang['Restore_Error_filename'] = 'Dosya isminde problem oluþtu, lütfen alternatif bir dosya deneyin';
$lang['Restore_Error_decompress'] = 'Gzip sýkýþtýrmasý açýlamýyor, lütfen düzyazý sürümünü gönderin';
$lang['Restore_Error_no_file'] = 'Dosya gönderilmedi';


//
// Auth pages
//
$lang['Select_a_User'] = 'Bir kullanýcý seç';
$lang['Select_a_Group'] = 'Bir grup seç';
$lang['Select_a_Forum'] = 'Bir forum seç';
$lang['Auth_Control_User'] = 'Kullanýcý Ýzinleri Kontrolü';
$lang['Auth_Control_Group'] = 'Grup Ýzinleri Kontrolü';
$lang['Auth_Control_Forum'] = 'Forum Ýzinleri Kontrolü';
$lang['Look_up_User'] = 'Ayrýntýlar';
$lang['Look_up_Group'] = 'Ayrýntýlar';
$lang['Look_up_Forum'] = 'Ayrýntýlar';

$lang['Group_auth_explain'] = 'Burada her gruba verilmiþ olan izinleri ve bölüm yetkilisi durumlarýný deðiþtirebilirsiniz. Grup izinlerini deðiþtirirken kullanýcý izinlerinin gruptaki bazý kullanýcýlara hala bazý özel haklar tanýyabileceðini unutmayýn. Eðer böyle bir durum söz konusuysa uyarýlacaksýnýz.';
$lang['User_auth_explain'] = 'Burada her kullanýcýya verilmiþ olan izinleri ve bölüm yetkilisi durumlarýný deðiþtirebilirsiniz. Kullanýcý izinlerini deðiþtirirken grup izinlerinin bazý kullanýcýlara hala bazý özel haklar tanýyabileceðini unutmayýn. Eðer böyle bir durum söz konusuysa uyarýlacaksýnýz.';
$lang['Forum_auth_explain'] = 'Buradan her forumun izin derecesini deðiþtirebilirsiniz. Geliþmiþ ve Basit olaraka ikiye ayrýlmýþ olan izinlerde, geliþmiþ seçeneðini kullanarak daha özel izinler verebileceðinizi unutmayýnýz.';

$lang['Simple_mode'] = 'Basit Mod';
$lang['Advanced_mode'] = 'Geliþmiþ Mod';
$lang['Moderator_status'] = 'Bölüm yetkilisi durumu';

$lang['Allowed_Access'] = 'Eriþim izni verilmiþ';
$lang['Disallowed_Access'] = 'Eriþim izni verilmemiþ';
$lang['Is_Moderator'] = 'Bölüm yetkilisi';
$lang['Not_Moderator'] = 'Bölüm yetkilisi deðil';

$lang['Conflict_warning'] = 'Yetki Çeliþkisi Uyarýsý';
$lang['Conflict_access_userauth'] = 'Bu kullanýcýnýn üye olduðu grup aracýlýðý ile bu foruma eriþimi var. Grup izinleriyle oynayabilir ya da kullanýcýyý gruptan çýkartabilirsiniz. Bu durumu oluþturan gruplar ve forumlar aþaðýda listelenmiþtir.';
$lang['Conflict_mod_userauth'] = 'Bu kullanýcýnýn üye olduðu grup aracýlýðý ile bu foruma yönetici eriþimi var. Grup izinleriyle oynayabilir ya da kullanýcýyý gruptan çýkartabilirsiniz. Bu durumu oluþturan gruplar ve forumlar aþaðýda listelenmiþtir.';

$lang['Conflict_access_groupauth'] = 'Aþaðýdaki kullanýcýlarýn hala kullanýcý izinleriyle bu foruma eriþimleri var. Kullanýcý izinlerini deðiþtirebilirsiniz. Özel hakký olan kullanýcýlar ve forumlar aþaðýda listelenmiþtir.';
$lang['Conflict_mod_groupauth'] = 'Aþaðýdaki kullanýcýlarýn hala kullanýcý izinleriyle bu foruma yönetici eriþimleri var. Kullanýcý izinlerini deðiþtirebilirsiniz. Özel hakký olan kullanýcýlar ve forumlar aþaðýda listelenmiþtir.';

$lang['Public'] = 'Herkese Açýk';
$lang['Private'] = 'Özel';
$lang['Registered'] = 'Kayýtlýlara Açýk';
$lang['Administrators'] = 'Pano Yöneticilerine Açýk';
$lang['Hidden'] = 'Gizli';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'Herkes';
$lang['Forum_REG'] = 'Kayýtlý';
$lang['Forum_PRIVATE'] = 'Özel';
$lang['Forum_MOD'] = 'Bölüm Yetkilisi';
$lang['Forum_ADMIN'] = 'Pano Yöneticisi';

$lang['View'] = 'Görüntüleme';
$lang['Read'] = 'Okuma';
$lang['Post'] = 'Gönderme';
$lang['Reply'] = 'Cevap yazma';
$lang['Edit'] = 'Deðiþtirme';
$lang['Delete'] = 'Silme';
$lang['Sticky'] = 'Önemli';
$lang['Announce'] = 'Duyuru';
$lang['Vote'] = 'Oy kullanma';
$lang['Pollcreate'] = 'Anket ekleme';

$lang['Permissions'] = 'Ýzinler';
$lang['Simple_Permission'] = 'Basit Mod';

$lang['User_Level'] = 'Kullanýcý seviyesi';
$lang['Auth_User'] = 'Kullanýcý';
$lang['Auth_Admin'] = 'Pano Yöneticisi';
$lang['Group_memberships'] = 'Grup üyelikleri';
$lang['Usergroup_members'] = 'Bu grubun üyeleri';

$lang['Forum_auth_updated'] = 'Forum izinleri güncellendi';
$lang['User_auth_updated'] = 'Kullanýcý izinleri güncellendi';
$lang['Group_auth_updated'] = 'Grup izinleri güncellendi';

$lang['Auth_updated'] = 'Ýzinler güncellendi';
$lang['Click_return_userauth'] = 'Kullanýcý izinlerine dönmek için %sburaya%s týklayýn';
$lang['Click_return_groupauth'] = 'Grup izinlerine dönmek için %sburaya%s týklayýn';
$lang['Click_return_forumauth'] = 'Forum izinlerine dönmek için %sburaya%s týklayýn';


//
// Banning
//
$lang['Ban_control'] = 'Yasaklý Kontrolü';
$lang['Ban_explain'] = 'Buradan kullanýcýlarý yasaklama ayarlarýný yapabilirsiniz. Bunu kullanýcý adýný, IP adresini ya da sunucu adýný banlayarak yapabilirsiniz. Bu, o kullanýcýnýn anasayfaya bile eriþimini engelleyecektir. Bir kullanýcýnýn baþka bir kullanýcý adýyla kaydolmasýný engellemek için o e-posta adresini yasaklayabilirsiniz. Unutmayýn ki bir e-posta adresini yasaklamak o kullanýcýnýn anasayfaya girmesini ya da mesaj gondermesini engellemez. Bunun için kullanýcý adý ya da IP - sunucu yasaklamalýsýnýz.';
$lang['Ban_explain_warn'] = 'Bir IP dizisinin yasaklanmasý baþlangýç ve bitiþ IP\'leri arasýndaki tüm IP\'leri yasaklayacaktýr. Veritabanýnda yer kaplamamasý için uygun olduðu yerlerde joker kullanýlacaktýr. Eðer gerçekten bir IP dizisi girmek istiyorsanýz lütfen onu kýsa tutun ya da tek tek IP\'leri girin.';

$lang['Select_username'] = 'Kullanýcý adý seçin';
$lang['Select_ip'] = 'IP seçin';
$lang['Select_email'] = 'E-posta adresi seçin';

$lang['Ban_username'] = 'Kullanýcý yasaklama';
$lang['Ban_username_explain'] = 'Birden fazla kullanýcý yasaklamak istiyorsanýz web tarayýcýnýza uygun klavye-fare kombinasyonunu kullanýn.';

$lang['Ban_IP'] = 'IP ve Sunucu yasaklama';
$lang['IP_hostname'] = 'IP ve sunucu adresleri';
$lang['Ban_IP_explain'] = 'Birden fazla IP/sunucu yasaklamak için araya virgül koyun. Bir IP dizisi belirtmek için baþlangýç ve bitiþ arasýna - koyun. Joker olarak * kullanýn';

$lang['Ban_email'] = 'E-posta yasaklama';
$lang['Ban_email_explain'] = 'Birden fazla e-posta yasaklamak için virgül kullanýn. Joker olarak * kullanýn, mesela *@hotmail.com';

$lang['Unban_username'] = 'Kullanýcý yasaðý kaldýrma';
$lang['Unban_username_explain'] = 'Birden fazla kullanýcýnýn yasaðýný kaldýrmak istiyorsanýz web tarayýcýnýza uygun klavye-fare kombinasyonunu kullanýn';

$lang['Unban_IP'] = 'IP/sunucu yasaðý kaldýrma';
$lang['Unban_IP_explain'] = 'Birden fazla IP/sunucu yasaðýný kaldýrmak istiyorsanýz web tarayýcýnýza uygun klavye-fare kombinasyonunu kullanýn';

$lang['Unban_email'] = 'E-posta yasaðý kaldýrma';
$lang['Unban_email_explain'] = 'Birden fazla e-posta yasaðýný kaldýrmak istiyorsanýz web tarayýcýnýza uygun klavye-fare kombinasyonunu kullanýn';

$lang['No_banned_users'] = 'Yasaklý kullanýcý yok';
$lang['No_banned_ip'] = 'Yasaklý IP yok';
$lang['No_banned_email'] = 'Yasaklý e-posta yok';

$lang['Ban_update_sucessful'] = 'Yasak listesi baþarýyla güncellendi';
$lang['Click_return_banadmin'] = 'Yasak kontrolüne dönmek için %sburaya%s týklayýn';


//
// Configuration
//
$lang['General_Config'] = 'Genel Ayarlar';
$lang['Config_explain'] = 'Aþaðýdaki form sitenizdeki genel ayarlarý yapmak için kullanýlacaktýr. Kullanýcý ve forum bazlý ayarlar için sol taraftaki ilgili linklere týklayýnýz.';

$lang['Click_return_config'] = 'Genel ayarlara dönmek için %sburaya%s týklayýn';

$lang['General_settings'] = 'Genel Pano Ayarlarý';
$lang['Server_name'] = 'Alan Adý';
$lang['Server_name_explain'] = 'Bu panonun olduðu sitenin alan adý';
$lang['Script_path'] = 'Yazýlým yolu';
$lang['Script_path_explain'] = 'Alan adýna göre phpBB yazýlýmýnýn bulunduðu yol';
$lang['Server_port'] = 'Sunucu portu';
$lang['Server_port_explain'] = 'Sunucunuzun çalýþtýðý port, genelde 80\'dir, sadece farklýysa deðiþtirin';
$lang['Site_name'] = 'Pano ismi';
$lang['Site_desc'] = 'Pano açýklamasý';
$lang['registration_status'] = 'Üye Kaydýný Durdur';
$lang['registration_status_explain'] = 'Bu seçeneðin \'Evet\' olmasý, forumunuzun yeni üye alýmýný durdurur.';
$lang['registration_closed'] = 'Üye Kaydýný Durdur Mesajý';
$lang['registration_closed_explain'] = 'Bu yazý \'Üye Kaydýný Durdur\' seçeneði \'Evet\' olduðunda kullanýcýlara gözükecektir.';
$lang['Acct_activation'] = 'Hesap etkinleþtirme';
$lang['Acc_None'] = 'Kapalý';
$lang['Acc_User'] = 'Kullanýcý';
$lang['Acc_Admin'] = 'Pano Yöneticisi';

$lang['Abilities_settings'] = 'Kullanýcý ve Forum Genel Ayarlarý';
$lang['Max_poll_options'] = 'Maksimum anket seçeneði sayýsý';
$lang['Flood_Interval'] = 'Flood Aralýðý';
$lang['Flood_Interval_explain'] = 'Kullanýcýnýn iki mesajý arasýnda beklemesi gereken süre';
$lang['Board_email_form'] = 'Kullanýcýlar arasý e-posta';
$lang['Board_email_form_explain'] = 'Bu site aracýlýðý ile kullanýcýlarýn birbirlerine e-posta göndermesini saðlar';
$lang['Topics_per_page'] = 'Her sayfadaki baþlýk sayýsý';
$lang['Posts_per_page'] = 'Her sayfadaki mesaj sayýsý';
$lang['Hot_threshold'] = 'Popülerlik sýnýrý';
$lang['Default_style'] = 'Varsayýlan tema';
$lang['Override_style'] = 'Kullanýcý temasýný gözardý et';
$lang['Override_style_explain'] = 'Kullanýcýlarýn seçtiði stili varsayýlan ile deðiþtirir';
$lang['Default_language'] = 'Varsayýlan dil';
$lang['Date_format'] = 'Saat formatý';
$lang['System_timezone'] = 'Sistem Zaman Dilimi';
$lang['Enable_gzip'] = 'GZip sýkýþtýrma';
$lang['Enable_prune'] = 'Mesaj temizliði';
$lang['Allow_HTML'] = 'HTML\'e izin ver';
$lang['Allow_BBCode'] = 'Biçimlendirmeye izin ver';
$lang['Allowed_tags'] = 'Ýzin verilen HTML etiketleri';
$lang['Allowed_tags_explain'] = 'Etiketleri virgüllerle ayýrýn';
$lang['Allow_smilies'] = 'Gülücüklere izin ver';
$lang['Smilies_path'] = 'Gülücük klasörü';
$lang['Smilies_path_explain'] = 'phpBB ana klasörüne göre gülücük klasörü, örn: images/smilies';
$lang['Allow_sig'] = 'Ýmzaya izin ver';
$lang['Max_sig_length'] = 'Maksimum imza uzunluðu';
$lang['Max_sig_length_explain'] = 'Kullanýcý imzalarýndaki maksimum karakter sayýsý';
$lang['Allow_name_change'] = 'Kullanýcý isim deðiþikliðine izin ver';

// Avatar ayarlarý
$lang['Avatar_settings'] = 'Kiþisel Sembol Ayarlarý';
$lang['Allow_local'] = 'Galeri sembolerini aç';
$lang['Allow_remote'] = 'Uzak sembolleri aç';
$lang['Allow_remote_explain'] = 'Baþka bir siteden link verilen semboller';
$lang['Allow_upload'] = 'Sembol göndermeyi aç';
$lang['Max_filesize'] = 'Maksimum sembol dosya büyüklüðü';
$lang['Max_filesize_explain'] = 'Gönderilen sebmoller için';
$lang['Max_avatar_size'] = 'Maksimum sembol boyutlarý';
$lang['Max_avatar_size_explain'] = '(Piksel olarak Yükseklik x Geniþlik)';
$lang['Avatar_storage_path'] = 'Sembol Klasörü';
$lang['Avatar_storage_path_explain'] = 'phpBB ana klasörüne göre, örn: images/avatars';
$lang['Avatar_gallery_path'] = 'Sembol Galeri Klasörü';
$lang['Avatar_gallery_path_explain'] = 'phpBB ana klasörüne göre önceden yüklenmiþ sembollerin yeri, örn: images/avatars/gallery';

// E-posta ayarlarý
$lang['Email_settings'] = 'E-posta Ayarlarý';
$lang['Admin_email'] = 'Yönetici e-posta adresi';
$lang['Email_sig'] = 'E-posta Ýmzasý';
$lang['Email_sig_explain'] = 'Gönderilecek tüm e-postalara bu yazý eklenir';
$lang['Use_SMTP'] = 'E-posta için SMTP sunucusunu kullan';
$lang['Use_SMTP_explain'] = 'Lokal sendmail fonksiyonu yerine SMTP sunucusunu kullanmak için Evet\'i seçin';
$lang['SMTP_server'] = 'SMTP Sunucu Adresi';
$lang['SMTP_username'] = 'SMTP Kullanýcý Adý';
$lang['SMTP_username_explain'] = 'Sadece SMTP sunucunuz kullanýcý ismi istiyorsa giriniz';
$lang['SMTP_password'] = 'SMTP Þifresi';
$lang['SMTP_password_explain'] = 'Sadece SMTP sunucunuz þifre istiyorsa giriniz';

$lang['Disable_privmsg'] = 'Kiþisel Mesajlaþma';
$lang['Inbox_limits'] = 'Gelenler\'deki maksimum msj. sayýsý ';
$lang['Sentbox_limits'] = 'Ulaþanlar\'daki maksimum msj. sayýsý';
$lang['Savebox_limits'] = 'Saklananlar\'daki maksimum msj. sayýsý';

// Cookie Ayarlarý
$lang['Cookie_settings'] = 'Çerez (cookie) Ayarlarý';
$lang['Cookie_settings_explain'] = 'Bu çerez\'lerin browserlara nasýl gönderildiðini ayarlamak içindir. Bir çok durumda bu ilk halinde býrakýlmalýdýr. Bunlarý deðiþtirmeniz gerekiyorsa dikkatli olun, yanlýþ ayarlar kullanýcýlarýn oturum açmasýný engeller.';
$lang['Cookie_domain'] = 'Çerez alan adý';
$lang['Cookie_name'] = 'Çerez adý';
$lang['Cookie_path'] = 'Çerez yolu';
$lang['Cookie_secure'] = 'Çerez güvenliði [ https ]';
$lang['Cookie_secure_explain'] = 'Sunucunuz SSL modunda çalýþýyorsa açýn, aksi halde açmayýn';
$lang['Session_length'] = 'Oturum uzunluðu [ saniye ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'Görsel kayýt doðrulamaya izin ver';
$lang['Visual_confirm_explain'] = 'Yeni kayýt olanlarý, resim ile gösterilen bir kodu girmeye mecbur eder.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Otomatik giriþe izin ver';
$lang['Allow_autologin_explain'] = 'Ziyaretçilerin foruma otomatik giriþ yapabilmelerine izin verir.';
$lang['Autologin_time'] = 'Otomatik giriþ geçerlilik süresi.';
$lang['Autologin_time_explain'] = 'Ziyaretçi, kaç gün forumu ziyaret etmezse otomatik giriþ kaydý silinsin. Bu özelliði maksimum kýlmak için 0 giriniz.';

//
// Forum Management
//
$lang['Forum_admin'] = 'Forum Yönetimi';
$lang['Forum_admin_explain'] = 'Buradan forum ve kategorileri ekleyebilir, silebilir, deðiþtirebilir ve senkronize edebilirsiniz';
$lang['Edit_forum'] = 'Forumu deðiþtir';
$lang['Create_forum'] = 'Yeni forum ekle';
$lang['Create_category'] = 'Yeni kategori ekle';
$lang['Remove'] = 'Çýkar';
$lang['Action'] = 'Eylem';
$lang['Update_order'] = 'Sýralamayý güncelle';
$lang['Config_updated'] = 'Forum Ayarlarý Baþarýyla Güncellendi';
$lang['Edit'] = 'Deðiþtir';
$lang['Delete'] = 'Sil';
$lang['Move_up'] = 'Yukarý taþý';
$lang['Move_down'] = 'Aþaðý taþý';
$lang['Resync'] = 'Senkronize';
$lang['No_mode'] = 'Hiç bir yöntem seçilmedi';
$lang['Forum_edit_delete_explain'] = 'Aþaðýdaki form panonuzdaki genel ayarlarý yapmak için kullanýlacaktýr. Kullanýcý ve forum bazlý ayarlar için sol taraftaki ilgili linklere týklayýnýz.';

$lang['Move_contents'] = 'Tüm içeriði taþý';
$lang['Forum_delete'] = 'Forumu sil';
$lang['Forum_delete_explain'] = 'Aþaðýdaki form ile forum ya da kategori silebilir, içeriklerini istediðiniz yere taþýyabilirsiniz';

$lang['Status_locked'] = 'Kilitli';
$lang['Status_unlocked'] = 'Kilitli deðil';
$lang['Forum_settings'] = 'Genel Forum Ayarlarý';
$lang['Forum_name'] = 'Forum adý';
$lang['Forum_desc'] = 'Açýklama';
$lang['Forum_status'] = 'Forum durumu';
$lang['Forum_pruning'] = 'Otomatik Mesaj Temizleme';

$lang['prune_freq'] = 'Her x günde bir forumu kontrol et';
$lang['prune_days'] = 'x gün içinde cevap gelmeyen baþlýklarý sil';
$lang['Set_prune_data'] = 'Mesaj temizliðini açtýðýnýz halde kaç günde bir mesaj temizliði yapýlacagýný seçmediniz';

$lang['Move_and_Delete'] = 'Taþý ve Sil';

$lang['Delete_all_posts'] = 'Tüm mesajlarý sil';
$lang['Nowhere_to_move'] = 'Taþýnacak yer yok';

$lang['Edit_Category'] = 'Kategoriyi deðiþtir';
$lang['Edit_Category_explain'] = 'Bir kategorinin ismini deðiþtirmek için bu formu kullanýn.';

$lang['Forums_updated'] = 'Forum ve Kategori bilgisi baþarýyla güncellendi';
$lang['Must_delete_forums'] = 'Bu kategoriyi silmeden önce içindeki tüm forumlarý silmelisiniz';

$lang['Click_return_forumadmin'] = 'Forum yönetim paneline dönmek için %sburaya%s týklayýn';


//
// Smiley Management
//
$lang['smiley_title'] = 'Gülücük Kontrol Paneli';
$lang['smile_desc'] = 'Buradan kullanýcýlara sunulan gülücükleri ekleyebilir kaldýrabilir ya da deðiþtirebilirsiniz.';

$lang['smiley_config'] = 'Gülücük Ayarlarý';
$lang['smiley_code'] = 'Gülücük Kodu';
$lang['smiley_url'] = 'Gülücük Resim Dosyasý';
$lang['smiley_emot'] = 'Gülücük Açýklamasý';
$lang['smile_add'] = 'Yeni gülücük ekle';
$lang['Smile'] = 'Gülücük';
$lang['Emotion'] = 'Açýklama';

$lang['Select_pak'] = 'Paket (.txt) dosyasý seç';
$lang['replace_existing'] = 'Varolan gülücüðü bununla deðiþtir';
$lang['keep_existing'] = 'Varolan gülücüðü koru';
$lang['smiley_import_inst'] = 'Gülücük dosyasýný zip ile açmalý ve uygun gülücük klasörüne göndermelisiniz. Sonra buradan doðru seçenekleri bularak yükleme iþlemini gerçekleþtiriniz.';
$lang['smiley_import'] = 'Gülücük Paketi Kurma';
$lang['choose_smile_pak'] = 'Gülücük Paket Dosyasý (.txt) Seçin';
$lang['import'] = 'Gülücük Paketi Kur';
$lang['smile_conflicts'] = 'Ýkilemlerde ne yapýlmalý?';
$lang['del_existing_smileys'] = 'Kurumdan önce varolan gülücükleri sil';
$lang['import_smile_pack'] = 'Gülücük Paketi Kur';
$lang['export_smile_pack'] = 'Gülücük Paketi Ekle';
$lang['export_smiles'] = 'Varolan gülücüklerinizden bir paket eklemek için, smiles.txt dosyasýný indirmek için %sburaya%s týklayýn. .txt uzantýsýný korumak suretiyle bu dosyanýn ismini deðiþtirin. Sonra bu .txt dosyasýný ve ilgili gülücük resimlerini tek bir zip dosyasý içinde sýkýþtýrýn.';

$lang['smiley_add_success'] = 'Gülücük baþarýyla eklendi';
$lang['smiley_edit_success'] = 'Gülücük baþarýyla güncellendi';
$lang['smiley_import_success'] = 'Gülücük Paketi kurulumu baþarýldý!';
$lang['smiley_del_success'] = 'Gülücük baþarýyla silindi';
$lang['Click_return_smileadmin'] = 'Gülücük kontrol paneline dönmek için %sburaya%s týklayýn';


//
// User Management
//
$lang['User_admin'] = 'Kullanýcý Yönetimi';
$lang['User_admin_explain'] = 'Buradan kullanýcýlarýnýzýn ayarlarýný deðiþtirebilirsiniz. Ýzinleri deðiþtirmek için soldan Ýzinler linkini kullanýn.';

$lang['Look_up_user'] = 'Kullanýcýyý incele';

$lang['Admin_user_fail'] = 'Kullanýcýnýn bilgileri güncellenemedi.';
$lang['Admin_user_updated'] = 'Kullanýcý bilgileri baþarýyla güncellendi.';
$lang['Click_return_useradmin'] = 'Kullanýcý Yönetim Paneline dönmek için %sburaya%s týklayýn';

$lang['User_delete'] = 'Bu kullanýcýyý sil';
$lang['User_delete_explain'] = 'Kullanýcýyý silmek için buraya týklayýn. Bu dönüþü olmayan bir iþlemdir.';
$lang['User_deleted'] = 'Kullanýcý baþarýyla silindi.';

$lang['Uye_status'] = 'Üye aktif mi?';
$lang['User_status'] = 'Bu kullanýcý þu anda aktif';
$lang['User_allowpm'] = 'Kiþisel mesaj atabilir';
$lang['User_allowavatar'] = 'Kiþisel sembol kullanabilir';

$lang['Admin_avatar_explain'] = 'Burdan kullanýcýnýn þu andaki kiþisel sembolünü silebilir ya da deðiþtirebilirsiniz.';
$lang['User_special'] = 'Özel yönetici alanlarý';
$lang['User_special_explain'] = 'Bu alanlar kullanýcýlar tarafýndan deðiþtirilemez. Buradan bütün kullanýcýlara verilmeyen ayarlarý yapabilirsiniz.';


//
// Group Management
//
$lang['Group_administration'] = 'Grup Yönetimi';
$lang['Group_admin_explain'] = 'Burdan gruplarýnýzý ekleyebilir, silebilir ya da deðiþtirebilirsiniz. Grup yöneticilerini, grup durumlarýný, grup isimlerini deðiþtirebilirsiniz';
$lang['Error_updating_groups'] = 'Gruplar güncellenirken bir hata oluþtu';
$lang['Updated_group'] = 'Grup baþarýyla güncellendi';
$lang['Added_new_group'] = 'Yeni grup baþarýyla eklendi';
$lang['Deleted_group'] = 'Grup baþarýyla silindi';
$lang['New_group'] = 'Yeni grup ekle';
$lang['Edit_group'] = 'Grubu deðiþtir';
$lang['group_name'] = 'Grup adý';
$lang['group_description'] = 'Grup açýklamasý';
$lang['group_moderator'] = 'Grup yöneticisi';
$lang['group_status'] = 'Grup durumu';
$lang['group_open'] = 'Açýk grup';
$lang['group_closed'] = 'Kapalý grup';
$lang['group_hidden'] = 'Gizli grup';
$lang['group_delete'] = 'Grubu sil';
$lang['group_delete_check'] = 'Bu grubu sil';
$lang['submit_group_changes'] = 'Deðiþiklikleri gönder';
$lang['reset_group_changes'] = 'Deðiþiklikleri sil';
$lang['No_group_name'] = 'Bu grup için bir isim belirtmelisiniz';
$lang['No_group_moderator'] = 'Bu grup için bir yönetici belirtmelisiniz';
$lang['No_group_mode'] = 'Bu grup için bir mod belirmelisiniz, açýk ya da kapalý';
$lang['No_group_action'] = 'Bir görev seçilmemiþ';
$lang['delete_group_moderator'] = 'Eski grup yöneticisi sil';
$lang['delete_moderator_explain'] = 'Grup yöneticisi deðiþtirirken, eski yöneticiyi gruptan atmak için burayý iþaretleyin. Aksi takdirde kullanýcý grubun normal bir üyesi olacaktýr.';
$lang['Click_return_groupsadmin'] = 'Grup yönetimine dönmek için %sburaya%s týklayýn.';
$lang['Select_group'] = 'Grup seç';
$lang['Look_up_group'] = 'Grubu incele';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Mesaj Temizliði';
$lang['Forum_Prune_explain'] = 'Bu form ile seçtiðiniz gün sayýsý içinde cevap gelmeyen baþlýklarý silebilirsiniz. Eðer bir sayý girmezseniz tüm mesajlar silinir. Ýçinde anket olan mesajlarý ya da duyurularý silmeyecektir. Onlarý tek tek elle silmek zorundasýnýz.';
$lang['Do_Prune'] = 'Temizlik Yap';
$lang['All_Forums'] = 'Tüm forumlar';
$lang['Prune_topics_not_posted'] = 'Bu kadar gün içinde cevap gelmemiþ mesajlarý sil';
$lang['Topics_pruned'] = 'Silinen baþlýklar';
$lang['Posts_pruned'] = 'Silinen mesajlar';
$lang['Prune_success'] = 'Mesaj temizliði baþarýlý!';


//
// Word censor
//
$lang['Words_title'] = 'Kelime Sansürleme';
$lang['Words_explain'] = 'Buradan otomatik olarak sansürlenecek kelimeleri ekleyebilir, silebilir, deðiþtirebilirsiniz. Ayrýca insanlar bu kelimeleri kullanýcý isimlerinde de kullanamazlar. Joker olarak * kullanabilirsiniz, Örn: *siklo* ansiklopedi\'yi, siklo* siklon\'u, *siklo dersiklo\'yu sansürleyecektir.';
$lang['Word'] = 'Kelime';
$lang['Edit_word_censor'] = 'Sansürlü kelimeyi deðiþtir';
$lang['Replacement'] = 'Yerine konulacak';
$lang['Add_new_word'] = 'Yeni kelime ekle';
$lang['Update_word'] = 'Sansürü güncelle';

$lang['Must_enter_word'] = 'Bir kelime ve onun yerine girilecek kelimeyi girmelisiniz';
$lang['No_word_selected'] = 'Deðiþtirmek için bir kelime seçmediniz';

$lang['Word_updated'] = 'Seçilen sansürlü kelime baþarýyla güncellendi';
$lang['Word_added'] = 'Sansürlü kelime baþarýyla eklendi';
$lang['Word_removed'] = 'Seçilen sansürlü kelime baþarýyla silindi';

$lang['Click_return_wordadmin'] = 'Kelime sansürü yönetim paneline dönmek için %sburaya%s týklayýn';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Buradan tüm kullanýcýlarýnýza ya da bir gruba dahil tüm kullanýcýlara e-posta gönderebilirsiniz. Bu yönetici e-postasýna atýlan mesajýn gizli karbon kopyalarýnýn kullanýcýlara gönderilmesi yoluyla yapýlacak. Eðer geniþ bir gruba gönderiyorsanýz lütfen stop butonuna basmayýn ve sayfanýn yüklenmesini sabýrlý bir þekilde bekleyin. Büyük bir toptan e-posta gönderiminin yavaþ olmasý doðaldýr, Yazýlým görevini tamamladýðýnda size haber verilecektir';
$lang['Compose'] = 'Oluþtur';
$lang['Recipients'] = 'Alýcýlar';
$lang['All_users'] = 'Tüm Kullanýcýlar';
$lang['Email_successfull'] = 'Mesajýnýz Gönderilmiþtir';
$lang['Click_return_massemail'] = 'Toptan e-posta formuna dönmek için %sburaya%s týklayýnýz';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Seviye Yönetimi';
$lang['Ranks_explain'] = 'Buradan kullanýcýlarýnýza verilecek seviyeler ekleyebilir, silebilir ve deðiþtirebilirsiniz. Kullanýcý yönetiminden kullanýcýlara verilebilecek özel seviyeler de ekleyebilirsiniz.';

$lang['Add_new_rank'] = 'Yeni seviye ekle';

$lang['Rank_title'] = 'Seviye Adý';
$lang['Rank_special'] = 'Özel Seviye';
$lang['Rank_minimum'] = 'Minimum Mesaj Sayýsý';
$lang['Rank_maximum'] = 'Maksimum Mesaj Sayýsý';
$lang['Rank_image'] = 'Seviye resmi (phpBB ana klasörüne göre)';
$lang['Rank_image_explain'] = 'Seviye için ufak bir resim kullanýn';
$lang['Rank_image_short'] = 'Seviye resmi';

$lang['Must_select_rank'] = 'Bir seviye seçmelisiniz';
$lang['No_assigned_rank'] = 'Hiç özel seviye atanmamýþ';

$lang['Rank_updated'] = 'Seviye baþarýyla güncellendi';
$lang['Rank_added'] = 'Seviye baþarýyla eklendi';
$lang['Rank_removed'] = 'Seviye baþarýyla silindi';
$lang['No_update_ranks'] = 'Bu seviye baþarýyla silindi, ancak bu seviyeye sahip olan kullanýcýlarýn ayarlarý deðiþmedi. Bu kullanýcýlarýn hesaplarýný kendiniz güncellemelisiniz';
$lang['Click_return_rankadmin'] = 'Seviye yönetimine dönmek için %sburaya%s týklayýn';


//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Yasaklý Kullanýcý Ýsmi Kontrolü';
$lang['Disallow_explain'] = 'Burada kullanýlmamasý gereken kullanýcý isimlerini ayarlayabilirsiniz. Joker olarak * kullanabilirsiniz. Kayýt olmuþ bir kullanýcý adýný yasaklayamazsýnýz, bunu yapmak için ilk önce o kullanýcýyý silmelisiniz';

$lang['Delete_disallow'] = 'Sil';
$lang['Delete_disallow_title'] = 'Yasaklý bir kullanýcý ismini kaldýr';
$lang['Delete_disallow_explain'] = 'Buradan yasaklý bir kullanýcý ismini seçip gönder butonuna basarak yasaðý kaldýrabilirsiniz';

$lang['Add_disallow'] = 'Ekle';
$lang['Add_disallow_title'] = 'Yasaklý bir kullanýcý ismi ekle';
$lang['Add_disallow_explain'] = 'Joker olarak * kullanabilirsiniz';

$lang['No_disallowed'] = 'Yasaklý kullanýcý adý yok';

$lang['Disallowed_deleted'] = 'Yasaklý kullanýcý adý baþarýyla kaldýrýldý';
$lang['Disallow_successful'] = 'Yasaklý kullanýcý adý baþarýyla eklendi';
$lang['Disallowed_already'] = 'Girdiðiniz isim yasaklanamadý. Ya listede var, ya sansür listesinde var, ya da böyle bir kullanýcý mevcut';

$lang['Click_return_disallowadmin'] = 'Yasaklý kullanýcý adý kontrol paneline dönmek için %sburaya%s týklayýn';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Stil Yönetimi';
$lang['Styles_explain'] = 'Buradan kullanýcýlarýnýza sunduðunuz temalarýnýzý yönetebilirsiniz';
$lang['Styles_addnew_explain'] = 'Burada tüm tema\'larýnýz listelenmiþtir. Bunlar henüz veritabanýna kaydedilmemiþtir. Kaydetmek için birini seçin ve Yükle tuþuna basýn';
$lang['Select_template'] = 'Bir tema seçin';

$lang['Style'] = 'Stil';
$lang['Template'] = 'Tema';
$lang['Install'] = 'Yükle';
$lang['Download'] = 'Ýndir';

$lang['Edit_theme'] = 'Tema\'yý deðiþtir';
$lang['Edit_theme_explain'] = 'Aþaðýdaki form ile seçtiðiniz tema\'yý deðiþtirebilirsiniz';

$lang['Create_theme'] = 'Tema ekle';
$lang['Create_theme_explain'] = 'Aþaðýdaki form ile seçilen tema için yeni bir stil ekleyin. Renkleri girerken # iþaretini kullanmayýn. Örn: CCCCCC doðru, #CCCCCC yanlýþ';

$lang['Export_themes'] = 'Tema\'yý kaydet';
$lang['Export_explain'] = 'Bu panel ile seçtiðiniz tema için bir stil dosyasý ekleyip kaydedebileceksiniz. Aþaðýdan temayý seçin ve yazýlým onun için gerekli tema dosyasýný ekleyip o klasöre kaydetmeyi deneyecektir. Eðer kaydedemezse size indirme opsiyonunu sunacaktýr. Yazýlým\'ýn dosyayý kaydedebilmesi için o klasöre yazma izninin verilmiþ olmasý gerekir. Ayrýntýlý bilgi için PhpBB2 kullanma kýlavuzuna bakýn.';

$lang['Theme_installed'] = 'Seçilen tema baþarýyla yüklendi';
$lang['Style_removed'] = 'Seçilen tema veritabanýndan baþarýyla silindi. Bu tema\'yý sisteminizden tamamýyla silmek için dosylarýný da silmelisiniz.';
$lang['Theme_info_saved'] = 'Seçilen tema için stil bilgisi kaydedildi.';
$lang['Theme_updated'] = 'Seçilen tema güncellendi. Þimdi yeni tema ayarlarýný kaydetmelisiniz';
$lang['Theme_created'] = 'Tema eklendi. Þimdi bu tema\'yý sonradan kullanmak ya da taþýmak için kaydetmelisiniz';

$lang['Confirm_delete_style'] = 'Bu stili silmek istediðinizden emin misiniz?';

$lang['Download_theme_cfg'] = 'Tema bilgi dosyasý yazýlamadý. Dosyayý indirmek için aþaðýdaki butona týklayýnýz. Sonra onu ilgili tema dosyalarýnýn bulunduðu klasöre göndermelisiniz. Sonra isterseniz dosyalarý daðýtým ya da baþka bir amaçla paketleyebilirsiniz';
$lang['No_themes'] = 'Seçilen temanýn atanmýþ hiç stili yok. Sol taraftaki Stil Yönetimi\'nden Ekle butonuna týklayýnýz';
$lang['No_template_dir'] = 'Tema klasörü açýlamadý. Web sunucusu tarafýndan okunamýyor olabilir ya da böyle bir klasör yok';
$lang['Cannot_remove_style'] = 'Bu stil þu anda varsayýlan stil olduðu için silinemez. Varsayýlan stili deðiþtirip tekrar deneyin.';
$lang['Style_exists'] = 'Seçilen stil adý kullanýmda, lütfen baþka bir isim seçiniz.';

$lang['Click_return_styleadmin'] = 'Stil yönetimine dönmek için %sburaya%s týklayýn';

$lang['Theme_settings'] = 'Tema Ayarlarý';
$lang['Theme_element'] = 'Tema Elemanlarý';
$lang['Simple_name'] = 'Ýsmi';
$lang['Value'] = 'Deðer';
$lang['Save_Settings'] = 'Ayarlarý Kaydet';

$lang['Stylesheet'] = 'CSS Stylesheet';
$lang['Stylesheet_explain'] = 'Bu Stil için geçerli olan CSS dosyanýn adý...';
$lang['Background_image'] = 'Arkaplan Resmi';
$lang['Background_color'] = 'Arkaplan Rengi';
$lang['Theme_name'] = 'Tema Adý';
$lang['Link_color'] = 'Link Rengi';
$lang['Text_color'] = 'Yazý Rengi';
$lang['VLink_color'] = 'Ziyaret Edilmiþ Link Rengi';
$lang['ALink_color'] = 'Aktif Link Rengi';
$lang['HLink_color'] = 'Üstüne Gelinen Link Rengi';
$lang['Tr_color1'] = 'Tablo Satýr Rengi 1';
$lang['Tr_color2'] = 'Tablo Satýr Rengi 2';
$lang['Tr_color3'] = 'Tablo Satýr Rengi 3';
$lang['Tr_class1'] = 'Tablo Satýr Sýnýfý 1';
$lang['Tr_class2'] = 'Tablo Satýr Sýnýfý 2';
$lang['Tr_class3'] = 'Tablo Satýr Sýnýfý 3';
$lang['Th_color1'] = 'Tablo Baþlýk Rengi 1';
$lang['Th_color2'] = 'Tablo Baþlýk Rengi 2';
$lang['Th_color3'] = 'Tablo Baþlýk Rengi 3';
$lang['Th_class1'] = 'Tablo Baþlýk Sýnýfý 1';
$lang['Th_class2'] = 'Tablo Baþlýk Sýnýfý 2';
$lang['Th_class3'] = 'Tablo Baþlýk Sýnýfý 3';
$lang['Td_color1'] = 'Tablo Hücre Rengi 1';
$lang['Td_color2'] = 'Tablo Hücre Rengi 2';
$lang['Td_color3'] = 'Tablo Hücre Rengi 3';
$lang['Td_class1'] = 'Tablo Hücre Sýnýfý 1';
$lang['Td_class2'] = 'Tablo Hücre Sýnýfý 2';
$lang['Td_class3'] = 'Tablo Hücre Sýnýfý 3';
$lang['fontface1'] = 'Karakter Tipi 1';
$lang['fontface2'] = 'Karakter Tipi 2';
$lang['fontface3'] = 'Karakter Tipi 3';
$lang['fontsize1'] = 'Karakter Büyüklüðü 1';
$lang['fontsize2'] = 'Karakter Büyüklüðü 2';
$lang['fontsize3'] = 'Karakter Büyüklüðü 3';
$lang['fontcolor1'] = 'Karakter Rengi 1';
$lang['fontcolor2'] = 'Karakter Rengi 2';
$lang['fontcolor3'] = 'Karakter Rengi 3';
$lang['span_class1'] = 'Span Sýnýfý 1';
$lang['span_class2'] = 'Span Sýnýfý 2';
$lang['span_class3'] = 'Span Sýnýfý 3';
$lang['img_poll_size'] = 'Anket resmi büyüklüðü [px]';
$lang['img_pm_size'] = 'Kiþisel mesajlar durum resmi büyüklüðü [px]';


//
// Install Process
//
$lang['Welcome_install'] = 'phpBB Yüklemesine Hoþgeldiniz';
$lang['Initial_config'] = 'Genel Ayarlar';
$lang['DB_config'] = 'Veritabaný Ayarlarý';
$lang['Admin_config'] = 'Yönetici Ayarlarý';
$lang['continue_upgrade'] = 'Config dosyasýný bilgisayarýnza indirdikten sonra \'Upgrade\'e Devam\' düðmesine basarak güncelleme iþlemine devam edebilirsiniz.';
$lang['upgrade_submit'] = 'Güncellemeye Devam';

$lang['Installer_Error'] = 'Yükleme sýrasýnda bir problem oluþtu';
$lang['Previous_Install'] = 'Önceden yüklenmiþ bir phpBB bulundu';
$lang['Install_db_error'] = 'Veritabanýný güncellerken bir hata oluþtu';

$lang['Re_install'] = 'Önceden yüklediðiniz phpBB halen aktif. <br /><br />Eðer phpBB\'yi yeniden yüklemek istiyorsanýz aþaðýdaki evet düðmesine basýn. Bunu yaparken bunun þu andaki tüm verileri sileceðini, yedek yapýlmayacaðýný unutmayýn! Yönetici kullanýcý adý ve þifreniz yeniden üretilecektir; baþka hiçbir ayarýnýz korunmayacaktýr. <br /><br />Evet\'e basmadan önce iyi düþünün!';
$lang['Inst_Step_0'] = 'phpBB\'yi seçtiðiniz için teþekkür ederiz. Yükleme iþlemini bitirmek için lütfen aþaðýdaki boþluklarý doldurunuz. Kullanacaðýnýz veritabanýný önceden üretmiþ olmanýz gerekmektedir. Yakusha tarafýndan modifiye edilmiþ bu haliyle phpbb, mysql dýþýndaki diðer veritabanlarýný þu an için desteklememektedir. MySQL dýþýnda bir veritabaný kullanacaksanýz, standart phpbb\'yi tercih ediniz.';

$lang['Start_Install'] = 'Yüklemeye baþla';
$lang['Finish_Install'] = 'Yüklemeyi bitir';

$lang['Default_lang'] = 'Panonun varsayýlan dili';
$lang['DB_Host'] = 'Veritabaný sunucu adresi';
$lang['DB_Name'] = 'Veritabaný adý';
$lang['DB_Username'] = 'Veritabaný kullanýcý adý';
$lang['DB_Password'] = 'Veritabaný þifresi';
$lang['Database'] = 'Veritabanýnýz';
$lang['Install_lang'] = 'Yükleme dilini seçin';
$lang['dbms'] = 'Veritabaný türü';
$lang['Table_Prefix'] = 'Veritabaný tablo önadlarý';
$lang['Admin_Username'] = 'Yönetici kullanýcý adý';
$lang['Admin_Password'] = 'Yönetici þifresi';
$lang['Admin_Password_confirm'] = 'Yönetici þifresi [ onay ]';

$lang['Inst_Step_2'] = 'Yönetici kullanýcý oluþturuldu. Bu noktada temel yükleme tamamlandý. Þimdi yeni yüklediðiniz panoyu yönetebileceðiniz bir sayfaya yönlendirileceksiniz. Genel ayarlarý kontrol edin ve kendi ihtiyaçlarýnýz doðrultusunda ayarlarlayýn. phpBB\'yi seçtiðiniz için teþekkür ederiz.';

$lang['Unwriteable_config'] = 'Þu anda config dosyasýna yazýlamýyor. Aþaðýdaki düðmeye basýnca bu config dosyasýnýn bir kopyasý bilgisayarýnýza indirilecektir. Bu dosyayý phpBB ile ayný klasör içine göndermelisiniz. Bunu yaptýktan sonra bir önceki form\'la üretilen yönetici adý ve þifresini kullanarak yönetim paneline girmeli ve ayarlarý yapmalýsýnýz. (Oturum açtýktan sonra ekranýn altýnda bir link gözükecektir). phpBB\'yi seçtiðiniz için teþekkür ederiz.';
$lang['Download_config'] = 'Config dosyasýný indir';

$lang['ftp_choose'] = 'Ýndirme Metodunu Seçin';
$lang['ftp_option'] = '<br />PHP\'nin bu sürümünde ftp komutlarýna izin verildiði için direk config dosyasýný yerine ftp ile gönderebilirsiniz.';
$lang['ftp_instructs'] = 'Config dosyasýný phpBB\'nin bulunduðu yere otomatik olarak ftp ile göndermeyi seçtiniz. Lütfen aþaðýdaki bilgileri doldurunuz';
$lang['ftp_info'] = 'FTP bilgilerinizi girin';
$lang['Attempt_ftp'] = 'FTP ile gönderme deneniyor';
$lang['Send_file'] = 'Bana sadece dosyayý gönder ve ben onu kendim FTP\'liyim';
$lang['ftp_path'] = 'phpBB FTP yolu';
$lang['ftp_username'] = 'FTP Kullanýcý Adý';
$lang['ftp_password'] = 'FTP Þifresi';
$lang['Transfer_config'] = 'Transfere baþla';
$lang['NoFTP_config'] = 'FTP iþlemi baþarýsýz. Lütfen config doyasýný indirip kendiniz gönderiniz';

$lang['Install'] = 'Yükle';
$lang['Upgrade'] = 'Güncelle';

$lang['Install_Method'] = 'Yükleme metodu';
$lang['Install_No_Ext'] = 'Sunucu\'nuz seçtiðiniz veritabaný türünü desteklemiyor';
$lang['Install_No_PCRE'] = 'phpBB, php için \'Perl-Compatible Regular Expressions\' modülüne ihtiyaç duymaktadýr. Kullandýðýnýz php ayarlarý bunu desteklememektedir';

//
// Version Check
//
$lang['Version_up_to_date'] = 'Son sürümü kullanýyorsunuz. Önerilen güncelleme bulunmamaktadýr.';
$lang['Version_not_up_to_date'] = 'Kullandýðýnýz sürüm güncel <b>deðil</b>. Lütfen, en güncel sürüme sahip olmak için <a href=\'http://www.phpbb.com/downloads.php\' target=\'_new\'>www.phpbb.com/downloads.php</a> baðlantýsýný ziyaret edin.';
$lang['Latest_version_info'] = 'Mevcut olan en yeni phpBB sürümü: <b>%s</b>. ';
$lang['Current_version_info'] = 'Kullandýðýnýz phpBB sürümü: <b>%s</b>.';
$lang['Connect_socket_error'] = 'phpBB sitesi ile baðlantý kurulamadý. Bildirilen hata:<br />%s';
$lang['Socket_functions_disabled'] = 'Soket fonksiyonlarýnda sorun oluþtu.';
$lang['Mailing_list_subscribe_reminder'] = 'En son phpBB güncellemelerinden haberdar olmak istiyorsanýz, lütfen <a href=\'http://www.phpbb.com/support/\' target=\'_new\'> phpBB Haber Servisine</a> abone olun.';
$lang['Version_information'] = 'Sürüm Bilgisi';

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Yanlýþ giriþ denemesi.';
$lang['Max_login_attempts_explain'] = 'Ýzin verilen yanlýþ giriþ denemesi.';
$lang['Login_reset_time'] = 'Üyelik kilitlilik süresi';
$lang['Login_reset_time_explain'] = 'Yanlýþ giriþ yapan üyenin, üyeliðinin ne kadar süre kilitleneceðini dakika üzerinden belirtiniz.';

//Disable bord message
$lang['Board_disable_msg'] = 'Site kapalý mesajý';
$lang['Board_disable_msg_explain'] = 'Bu yazý \'Panoyu Kapat\' seçeneði \'Evet\' olduðunda kullanýcýlara gözükecektir.';

// Added for enhanced user management
$lang['User_lookup_explain'] = 'Formun herhangi bir kýsmýný doldurmanýz yeterlidir. Gerisini kendisi tarayacaktýr.';
$lang['One_user_found'] = 'Sadece bir kullanýcý bulundu, üye profiline yönlendiriliyorsunuz';
$lang['Click_goto_user'] = 'Üye profilini düzenlemek için %sburaya%s týklayýnýz';
$lang['User_joined_explain'] = 'Unix time formatýnda';
$lang['Click_return_perms_admin'] = 'Kullanýcý izinlerine dönmik için %sburaya%s týklayýnýz';

//topic flood
$lang['Topic_Flood_Interval'] ='Baþlýk fload aralýðý';
$lang['Topic_Flood_Interval_explain'] ='Üyenin kendi mesajýna cevap yazamayacaðý zaman sýnýrý';

// LEV
$lang['Live_email_validation_title'] = 'Gerçek zamanlý E-Posta doðrulama';
$lang['Usersname'] = 'Üye Adý';
$lang['Gonder'] = 'E-posta gönder';
$lang['Admin_Users_List_Mail_Title'] = 'Üye e-posta adresleri';
$lang['Admin_Users_List_Mail_Explain'] = 'Kayýtlý üyelerinize ait e-posta adreslerini görmektesiniz';

//imza resim
$lang['Max_sig_images_limit'] = 'Ýmza için resim adet sýnýrý';
$lang['Max_sig_images_size'] = 'Ýmza için resim sýnýr deðerleri';
$lang['Max_sig_images_size_explain'] = '(Yükseklik x Geniþlik)';

// Bantron Mod : Begin
$lang['Bantron'] = 'Yasak Merkezi';
$lang['BM_Title'] = 'Yasak Merkezi';
$lang['BM_Explain'] = 'Bu sayfada yeni bir yasak ekleyip, düzenleyip var olan bir yasaðý kaldýrabilirsin.';

$lang['BM_Show_bans_by'] = 'Yasaklarý Göster';
$lang['BM_All'] = 'Tümü';
$lang['BM_Show'] = 'Göster';

$lang['BM_IP'] = 'IP';
$lang['BM_Last_visit'] = 'En son ziyaret edilen';
$lang['BM_Banned'] = 'Yasaklandý';
$lang['BM_Expires'] = 'Geçen süre';
$lang['BM_By'] = 'Tarafýndan';
$lang['BM_Reasons'] = 'Sebepler';

$lang['BM_Add_a_new_ban'] = 'Yeni bir yasak ekle';
$lang['BM_Delete_selected_bans'] = 'Seçilen yasaðý kaldýr';

$lang['BM_Private_reason'] = 'özel, sebebiniz';
$lang['BM_Private_reason_explain'] = 'Bu bölümde gösterilen yasak sebebi, eposta adresi yada ip adresi sadece forum yöneticisi tarafýndan görülecektir.';

$lang['BM_Public_reason'] = 'Açýk olacak, sebebiniz';
$lang['BM_Public_reason_explain'] = 'Bu yasak sebebini yasaklanan kullanýcý siteye giriþ yaptýðýnda görecektir.';
$lang['BM_Generic_reason'] = 'Genel sebep';
$lang['BM_Mirror_private_reason'] = 'Özel sebebe yeni link ekle';
$lang['BM_Other'] = 'Diðerleri';

$lang['BM_Expire_time'] = 'Yasak süresi';
$lang['BM_Expire_time_explain'] = 'Geçen zaman diliminden sonra yasaðýn aktifliðini yitireceðini unutmayýnýz.';
$lang['BM_Never'] = 'Asla';
$lang['BM_After_specified_length_of_time'] = 'Geçen süreden sonra';
$lang['BM_Minutes'] = 'Dakika';
$lang['BM_Hours'] = 'Saat';
$lang['BM_Days'] = 'Gün';
$lang['BM_Weeks'] = 'Hafta';
$lang['BM_Months'] = 'Ay';
$lang['BM_Years'] = 'Yýl';
$lang['BM_After_specified_date'] = 'Geçen süreden sonra';
$lang['BM_AM'] = 'Gündüz';
$lang['BM_PM'] = 'Gece';
$lang['BM_24_hour'] = '24-Saat';
$lang['BM_Ban_reasons'] = 'Yasak Sebepleri';

//edit notes
$lang['Edit_notes_settings'] = 'Düzeltme Notlarý';
$lang['Edit_notes_enable'] = 'Düzeltme notlarý açýk';
$lang['Edit_notes_enable_explain'] = 'Düzeltme notlarýný aktif veya pasif yapmanýzý saðlar';
$lang['Max_edit_notes'] = 'Düzeltme notlarý üst sýnýrý';
$lang['Max_edit_notes_explain'] = 'Düzeltme notlarý için üst sýnýrý belirleyin';
$lang['Edit_notes_permissions'] = 'Düzeltme notlarý izinleri';
$lang['Edit_notes_permissions_explain'] = 'Düzeltme notlarýný için izinleri belirleyiniz';
$lang['Edit_notes_admin'] = 'Forum Yöneticisi';
$lang['Edit_notes_staff'] = 'Bölüm Yetkilisi';
$lang['Edit_notes_reg'] = 'Kayýtlý Kullanýcýlar';
$lang['Edit_notes_all'] = 'Bütün Kullanýcýlar';

//
// Admin Userlist Start
//
$lang['Userlist'] = 'Üye Listesi';
$lang['Userlist_description'] = 'Tüm üyeleri görebileceðiniz ve yönetebileceðiniz bölüm.';

$lang['Add_group'] = 'Gruba ekle';
$lang['Add_group_explain'] = 'Kullanýcý Grubunu seçin';

$lang['Open_close'] = '[+]';
$lang['Active'] = 'Aktif';
$lang['Group'] = 'Grup(lar)';
$lang['Rank'] = 'Rütbe';
$lang['Last_activity'] = 'Son Aktivite';
$lang['Never'] = 'Hiçbir zaman';
$lang['User_manage'] = 'Yönet';
$lang['Find_all_posts'] = 'Tüm mesajlarý';

$lang['Select_one'] = 'Birini Seçin';
$lang['Ban'] = 'Ban';
$lang['Activate_deactivate'] = 'Aktif/Pasif Et';
$lang['User_id'] = 'ID';
$lang['User_level'] = 'Seviye';
$lang['Ascending'] = 'Artan';
$lang['Descending'] = 'Azalan';
$lang['Show'] = 'Göster';
$lang['All'] = 'Tümü';
$lang['Member'] = 'Üye';
$lang['Pending'] = 'Beklemede';

$lang['Confirm_user_ban'] = 'Kullanýcý(lar)ý banlamak istediðinize emin misiniz?';
$lang['Confirm_user_deleted'] = 'Kullanýcý(lar)ý silmek istediðinize emin misiniz?';

$lang['User_status_updated'] = 'Kullanýcý(lar) baþarýyla güncellendi';
$lang['User_banned_successfully'] = 'Kullanýcý(lar) baþarýyla banlandý';
$lang['User_deleted_successfully'] = 'Kullanýcý(lar) baþarýyla silindi';
$lang['User_add_group_successfully'] ='Kullanýcý(lar) baþarýyla bir gruba eklendi';

$lang['Click_return_userlist'] = 'Üye listesine dönmek için %sburaya%s týklayýn';

// Default avatar MOD, By Manipe (Begin)
$lang['Default_avatar'] = 'Sabit avatar tayini';
$lang['Default_avatar_explain'] = 'Buradan üyeleriniz için sabit bir avatar tayin edebilirsiniz. Bunu dilerseniz misafirleriniz için, isterseniz kayýtlý üyeleriniz için, isterseniz her iki tür için de geçerli olacak þekilde tayin edebilirsiniz veya bu özelliði tamamen kapatabilirsiniz.';
$lang['Default_avatar_guests'] = 'Misafirler için açýk';
$lang['Default_avatar_users'] = 'Üyeler için açýk';
$lang['Default_avatar_both'] = 'Her ikisi için açýk';
$lang['Default_avatar_none'] = 'Avatar tayini kapalý';

$lang['Uye_ekle'] = 'Yeni Üye Ekle';
$lang['Uye_ekleme'] = 'Bu formu kullanarak forumunuza yeni üyeler ekleyebilirsiniz...';
$lang['Account_added_admin'] = 'Talebiniz üzerine, yeni üye hesabý eklenmiþtir.';

$lang['Board_disable'] = 'Panoyu kapat';
$lang['Board_disable_explain'] = 'Bu panoyu kullanýcýlara kapayacaktýr.';
$lang['Board_disable_msg'] = 'Site kapalý mesajý';
$lang['Board_disable_msg_explain'] = 'Bu yazý \'Panoyu Kapat\' seçeneði \'Evet\' olduðunda kullanýcýlara gözükecektir.';

// Start add - Bin Mod
$lang['Bin_forum'] = 'Çöp kutusu';
$lang['Bin_forum_explain'] = 'Çöp kutusu olarak kullanmak istediðiniz forumun id deðerini giriniz, 0 girerseniz bu fonksiyon kapatýlacaktýr. Ýlgili forumun izinlerinden görüntüleme, okuma, editleme, silme... izinlerini bölüm yetkilisi harici olanlara kapatmayý ihmal etmeyiniz.';

// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Aramalardaki Flood Aralýðý';
$lang['Search_Flood_Interval_explain'] = 'Bir kullanýcýnýn arama istekleri arasýnda beklemesi gereken saniye';
$lang['Confirm_delete_smiley'] = 'Bu Smileyi silmek istediðinizden emin misiniz?';
$lang['Confirm_delete_word'] = 'Bu yasaklanmýþ kelimeyi silmek istediðinizden emin misiniz?';
$lang['Confirm_delete_rank'] = 'Bu seviyeyi silmek istediðinizden emin misiniz?';

// Add stats & info MOD
$lang['Size_posts_tables'] = 'Mesaj tablosu büyüklüðü';
$lang['Size_search_tables'] = 'Arama tablosu büyüklüðü';
// Add stats & info MOD

//
// Admin Account Actions
//
$lang['Account_actions'] = 'Üyelik iþlemleri';
$lang['Account_inactive_explain'] = 'Burda henüz aktif olmamýþ, aktif olmayý berleyen üyeleri görmektesiniz. Üyelikleri aktif edebilir veya silebilirsiniz.<br />Ýlgili linkleri kullanarak üyeyle ilgili izinleri belirleyebilir veya profilini düzenleyebilirsiniz.';
$lang['Account_active_explain'] = 'Burda aktif olmuþ üyeleri görmektesiniz. Üyelikleri pasif edebilir veya silebilirsiniz.<br />Ýlgili linkleri kullanarak üyeyle ilgili izinleri belirleyebilir veya profilini düzenleyebilirsiniz.';
$lang['Account_active'] = 'Aktif üyeler';
$lang['Account_inactive'] = 'Pasif üyeler';
$lang['Account_activate'] = 'Aktif et';
$lang['Account_deactivate'] = 'Pasif et';
$lang['Account_none'] = 'Aktif olmayý bekleyen üye yok.';
$lang['Account_total_user'] = 'Üye sayýsý: <b>%d</b> üye';
$lang['Account_total_users'] = 'Üye sayýsý: <b>%d</b> üye';
$lang['Account_activation'] = 'Aktivasyon metodu';
$lang['Account_awaits'] = 'Bekleme süresi';
$lang['Account_registered'] = 'Kayýt tarihi';
$lang['Account_inactive'] = 'Pasif üyeler';
$lang['Account_active'] = 'Aktif üyeler';
$lang['Account_delete_users'] = 'Bu üyeleri silmek istediðinizden emin misiniz?';
$lang['Account_delete_user'] = 'Bu üyeyi silmek istediðinizden emin misiniz?';
$lang['Account_sort_letter'] = 'Arama özelliði';
$lang['Account_others'] = 'diðerleri';
$lang['Account_all'] = 'hepsi';
$lang['Account_year'] = 'Yýl';
$lang['Account_years'] = 'Yýl';
$lang['Account_week'] = 'Hafta';
$lang['Account_weeks'] = 'Hafta';
$lang['Account_day'] = 'Gün';
$lang['Account_days'] = 'Gün';
$lang['Account_hour'] = 'Saat';
$lang['Account_hours'] = 'Saat';
$lang['Account_user_activated'] = 'Üye aktif edildi.';
$lang['Account_users_activated'] = 'Üyeler aktif edildi.';
$lang['Account_user_deactivated'] = 'Üye pasif edildi.';
$lang['Account_users_deactivated'] = 'Üyeler pasif edildi.';
$lang['Account_user_deleted'] = 'Üye silindi.';
$lang['Account_users_deleted'] = 'Üyeler silindi.';
$lang['Account_activated'] = 'Üyelik aktive';
$lang['Account_activated_text'] = 'Üyeliðiniz aktif edilmiþtir';
$lang['Account_deactivated'] = 'Üyelik pasifize';
$lang['Account_deactivated_text'] = 'Üyeliðiniz pasif edilmiþtir';
$lang['Account_deleted'] = 'Üyelik silme';
$lang['Account_deleted_text'] = 'Üyeliðiniz silinmiþtir';
$lang['Account_notification'] = 'Haber epostasý gönderildi.';

$lang['Bantron_ban_rank'] = 'Yasaklý Rütbesi';
$lang['Bantron_ban_rank_explain'] = 'Yasaklanan kullanýcý için kullanýlacak renk grubunun numarasý';

$lang['Bantron_ban_color'] = 'Yasaklý Rengi';
$lang['Bantron_ban_color_explain'] = 'Yasaklanan kullanýcý için kullanýlacak rütbenin numarasý';

$lang['Rss_count'] = 'RSS içerik sýnýrý';
$lang['Rss_count_explain'] = 'RSS sayfasýnda listelenecek içerik için üst sýnýr';

$lang['Login_for_profile'] = 'Profil gönüntüleme sadece kayýtlý üyelere açýk';
$lang['Login_for_memberlist'] = 'Üye listesi sadece kayýtlý üyelere açýk';
$lang['Login_for_whoisonline'] = 'Kimler çevirimiçi sayfasý sadece kayýtlý üyelere açýk';

$lang['User_Styles'] = 'Üye Stilleri';
$lang['Style_static'] = 'Stil Ýstatistikleri';
$lang['User'] = 'Üye';

$lang['Post_attachments'] = 'Dosya Gönder';
$lang['Download_attachments'] = 'Dosya Ýndir';
$lang['Click_return_userprofile'] = 'Üye profiline dönmek için %sburaya%s týklayýnýz';

$lang['Replace_title'] = 'Metin Deðiþtir';
$lang['Replace_text'] = 'Bu araç sayesinde, mesajlarýnýzda geçen metinleri hýzlý bir þekilde deðiþtirebilirsiniz. <br /><font color=\'red\'>Bu iþlemin geri dönüþümü mümkün deðildir.</font>';
$lang['Link'] = 'Link';
$lang['Str_old'] = 'Geçerli Metin';
$lang['Str_new'] = 'Deðiþtirilecek Metin';
$lang['No_results'] = 'Hiçbir sonuç bulunamadý';
$lang['Replaced_count'] = 'Toplam %s mesaj deðiþtirildi';
$lang['Forum_icon'] = 'Forum ikon<br /><b>images/icons</b> dizini'; // Forum Icon MOD
$lang['Admin_session_logout'] = 'Yönetici Çýkýþý';

//
// Inline Banner Ad
//
$lang['ad_managment']  = 'Reklam Yönetimi'; 
$lang['inline_ad_config']  = 'Reklam Ayarlarý'; 
$lang['inline_ads']  = 'Reklamlar'; 
$lang['ad_code_about']  = 'Bu sayfada þu anki reklamlar vardýr. Bu sayfadan onlarý deðiþtirebilir, yenilerini ekleyebilirsin'; 
$lang['Click_return_firstpost'] = ' Reklam yönetimine dönmek için %sburaya%s týklayýnýz..';
$lang['Click_return_inline_code'] = 'Reklam kodu yönetimine dönmek için %sBuraya%s týklayýnýz';
$lang['ad_after_post'] = 'Reklamý x Mesajdan Sonra Görüntüle';
$lang['ad_every_post'] = 'Reklamý x Mesajdan Önce Görüntüle'; 
$lang['ad_display'] = 'Reklamý Gören Gruplar:'; 
$lang['ad_all'] = 'Tümü'; 
$lang['ad_reg'] = 'Kayýtlý Kullanýcýlar'; 
$lang['ad_guest'] = 'Kayýtsýz Kullanýcýlar';
$lang['ad_exclude'] = 'Reklam bu kullanýcý gruplarýna görütülenmesin ';
$lang['ad_forums'] = 'Reklam bu forumlarda görüntülenmesin';
$lang['ad_code'] = 'Reklam Kodu'; 
$lang['ad_post_threshold'] = 'x den fazla mesajý olanlara reklamý görüntüleme';
$lang['ad_add']  = 'Reklam Ekle'; 
$lang['ad_name']  = 'Reklamýn Kýsa Adý'; 
$lang['exclude_none']  = 'Hiçbiri';

//
// Reports
//
$lang['Reports'] = 'Raporlar'; 
$lang['List'] = 'Liste'; 
$lang['Report_Admin_title'] = 'Raporlama Sistemi Yönetimi'; 
$lang['Report_Admin_explain'] = 'Bu sayfada rapor kategorileri oluþturabilir, düzenleyebilir ve silebilir, geçerli ayarlarý deðiþtirebilirsiniz.'; 

$lang['Report_count'] = 'Rapor sayýsý'; 
$lang['Type'] = 'Biçim'; 
$lang['Report_Type_normal'] = 'Normal'; 
$lang['Report_Type_extension'] = 'Eklenti'; 
$lang['Authorisation'] = 'Yetkilendirme'; 
$lang['Description'] = 'Açýklama'; 

$lang['Standard_categories'] = 'Standart kategoriler'; 
$lang['No_standard_categories'] = 'Standart olmayan kategoriler'; 
$lang['Extension_categories'] = 'Eklenti kategoriler'; 
$lang['No_extension_categories'] = 'Eklenti olmayan kategoriler.'; 
$lang['Administrators_moderators'] = 'Forum yöneticileri ve Bölüm yetkilileri';
$lang['Only_administrators'] = 'Sadece forum yöneticileri'; 

$lang['Report_color_not_cleared'] = 'Raporlananlarýn rengi'; 
$lang['Report_color_in_process'] = 'Uygulamada olanlarýn rengi'; 
$lang['Report_color_cleared'] = 'Kaldýrýlanlarýn rengi'; 
$lang['Reportlist_type'] = 'Rapor liste biçimi'; 
$lang['Reportlist_type_admin'] = 'Yönetim Panelinde'; 
$lang['Reportlist_type_external'] = 'Yönetim Panelinde ve Listede'; 
$lang['Report_notify'] = 'E-posta bilgilendirme'; 

$lang['No_name_entered'] = 'Geçerli bir isim girin.';
$lang['Category_deleted'] = 'Kategori baþarý ile silindi.'; 
$lang['Confirm_delete_category'] = 'Kategoriyi silmek istiyor musunuz?'; 
$lang['Confirm_delete_category_reportdel'] = 'Tüm raporlarý bu kategorinin içine taþý ve kategoriyi sil.'; 
$lang['Reports_delete'] = 'Raporlarý sil'; 
$lang['Reports_move'] = 'Raporlarý buraya taþý: %s'; 
$lang['Category_created'] = 'Kategori eklendi.'; 
$lang['Category_edited'] = 'Kategori düzenlendi.'; 
$lang['Click_return_catadmin'] = 'Kategori yönetimine dönmek için %sburaya%s týklayýn';

$lang['Fazlalik_degerleri_bosalt_sort'] = 'Fazlalýk deðerleri boþalt';
$lang['Fazlalik_degerleri_bosalt'] = '<b>Not:</b> <u>'.$lang['Fazlalik_degerleri_bosalt_sort'].'</u> seçeneðini seçtiðiniz takdirde yedek alma iþleminden sonra arama tablolarýnýzý yeniden oluþturmanýz gerekecektir.';

$lang['Allow_automat'] = 'Otomatik tamir özelliðini aktif et';
$lang['allow_automat_desc'] = 'Bu özellik, yönetim paneline girdiðinizde bütün tablolar için günde bir kere, tamir et ve çöpü boþalt komutlarýný çalýþtýrýr ';
$lang['hide_links'] = 'Linkleri misafirlerden gizle';

//
// ezportal Admin
//
$lang['General_Portal_Config'] = 'Ez-Portal Ayarlarý';
$lang['Welcome_Text'] = 'Hoþgeldin Mesajý';
$lang['Number_Recent_Topics'] = 'Son Konular Adedi';
$lang['Number_of_News'] = 'Haber adedi';
$lang['News_length'] = 'Haber uzunluðu';
$lang['News_Forum'] = 'Haber forum(larý)';
$lang['Poll_Forum'] = 'Anket forum(larý)';
$lang['Comma'] = 'Forumlar (ID), birden fazla forumlarý virgülle ayýrýn';
$lang['Portal_izleme'] = 'Portal önizleme';

//---[+]---yakusha istatistik paneli
$lang['Statistics'] = 'Ýstatistik';
$lang['phpBB_version'] = 'phpBB versiyonu';
$lang['yakusha_version'] = 'Yakusha versiyonu';
$lang['php_version'] = 'PHP Versiyonu';
$lang['mysql_version'] = 'MySQL Versiyonu';
$lang['Wached_total'] = 'Ýzlenen baþlýk sayýsý';
$lang['post_per_user'] = 'Üye baþýna mesaj';
$lang['number_of_db_tables'] = 'Veritabaný tablo sayýsý';
$lang['number_of_db_records'] = 'Veritabaný kayýt sayýsý';
$lang['new_user'] = 'En yeni üye';
$lang['son3day_list'] = 'Son üç günün üyeleri';
$lang['administrators_list'] = 'Forum Yöneticileri';
$lang['moderators_list'] = 'Bölüm Yetkilileri';
$lang['deactivated_users_list'] = 'Pasif üyeler';
$lang['banned_users_list'] = 'Yasaklý üyeler';
//---[-]---yakusha istatistik paneli
$lang['Site_keywords'] = 'Site Meta Anahtarlarý';
$lang['Site_keywords_explain'] = 'Sitenizi tanýtýcý metalarý buraya girebilirsiniz';
// Link to Edit forum/Auth in ACP
$lang['Go_edit_forum'] = 'Forumu düzenle';
$lang['Go_edit_forum_auth'] = 'Forum izinlerini düzenle';

// Link to Edit User/Auth in ACP
$lang['Go_edit_profile'] = 'Üyenin profilini düzenle';
$lang['Go_edit_auth'] = 'Üyenin izinlerini düzenle';

$lang['No_selected_icon'] = 'Boþ Kullan';
$lang['Basit_seo_open'] = 'Basit Seo özelliði kullanýlsýn mý?';
$lang['Icon_mod_open'] = 'Forum ikonlarý özelliði kullanýlsýn mý?';
$lang['admin_message_save_from_mods'] = 'Admin mesajlarýný bölüm yetkililerinden koru';

$lang['Forum_width'] = 'Forum geniþliði';
$lang['Forum_width_explain'] = 'Forum geniþliðini % veya pixel cinsinden ayaralayabilirsiniz';
$lang['show_user_online_today'] = 'Günün ziyaretçilerini görüntüle';
$lang['show_mod_list'] = 'Bölüm yetkililerini ana sayfada görüntüle';
$lang['keyword_len_explain'] = "[ Kalan Karaker ]";
$lang['topic_page_on_top'] = 'Mesaj sayfasýný üste dayalý göster?';
$lang['show_search_bots'] = 'Arama botlarýný görüntüle';
// [start] Open/Close All Forums
$lang['Close_forums'] = 'Bütün forumlarý aç';
$lang['Open_forums'] = 'Bütün forumlarý kilitle';
// [end] Open/Close All Forums
$lang['Version'] = 'Versiyon';
$lang['total_cat'] = 'Toplam Kategori';
$lang['total_forum'] = 'Toplam Forum';
$lang['total_supforum'] = 'Toplam Üst Forum';
$lang['total_subforum'] = 'Toplam Alt Forum';
$lang['total_pm'] = 'Toplam Özel Mesaj';
$lang['total_vote'] = 'Toplam Anket';

?>