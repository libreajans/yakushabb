<?php

if ( !defined('IN_PHPBB') )
{
die('Hacking attempt');
}

// --------------------------------------------------------------
// DOSYA ADI : lang_******.php
// TELÝF HAKKI : © 2000, 2005 Canver Networks [ phpBB Türkiye ]
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
$lang['Shadow_attachments'] = 'Gölge Eklentiler';
$lang['Forbidden_extensions'] = 'Uzantý: Yasaklar';
$lang['Extension_control'] = 'Uzantý: Kontrol';
$lang['Extension_group_manage'] = 'Uzantý: Grup Yönetimi';
$lang['Special_categories'] = 'Özel Kategoriler ';
$lang['Sync_attachments'] = 'Senkronize Et';
$lang['Quota_limits'] = 'Kota Limitleri';

// Attachments -> Management
$lang['Attach_settings'] = 'Yüklü Eklentiler';
$lang['Manage_attachments_explain'] = 'Burada Eklenti MOD\'unun genel ayarlarýný yapabilirsiniz. Eðer Ayarlarý Test Et butonuna týklarsanýz, Eklenti MOD\'u doðru çalýþmasýný kontrol edecek olan bazý Sistem Testleri gerçekleþtirecek. Eðer eklentileri yüklemekte sorun yaþýyorsanýz, bu testi çalýþtýrarak detaylý bir hata mesajý alabilirsiniz.';
$lang['Attach_filesize_settings'] = 'Eklenti Dosya Boyutu Ayarlarý';
$lang['Attach_number_settings'] = 'Eklenti Sayýsý Ayarlarý';
$lang['Attach_options_settings'] = 'Eklenti Seçenekleri';

$lang['Upload_directory'] = 'Yükleme Dizini';
$lang['Upload_directory_explain'] = 'phpBB kurulum dizinine göre Eklenti MOD\'u yükleme dizinini yazýn. Örneðin, phpBB kurulumunuz dizininiz http://www.site_adi.com/phpBB2 ise ve Eklenti MOD\'u yükleme dizininiz http://www.site_adi.com/phpBB2/files ise \'files\' yazýn.';
$lang['Attach_img_path'] = 'Eklenti Ýkonu';
$lang['Attach_img_path_explain'] = 'Mesajlarda, eklenti linkinin yanýnda görüntülenecek resim. Eðer bir resim kullanmak istemiyorsanýz boþ býrakýn. Bu ayar, Uzantý Grubu Yönetimi Ayarlarý tarafýndan geçersiz kýlýnabilir.';
$lang['Attach_topic_icon'] = 'Eklenti Konusu Ýkonu';
$lang['Attach_topic_icon_explain'] = 'Bu ikon eklenti bulunan baþlýðýn önünde görüntülenir. Eðer bir ikon kullanmak istemiyorsanýz boþ býrakýn.';
$lang['Attach_display_order'] = 'Eklenti Gösterim Sýrasý';
$lang['Attach_display_order_explain'] = 'Bu ayar ile eklentilerin gösterim sýrasýný seçebilirsiniz. Artan ya da azalan sýrayla yeni ya da eski eklentinin önce gösterilmesini seçebilirsiniz.';
$lang['Show_apcp'] = 'Yeni Eklenti Gönderme Kontrol Panelini göster';
$lang['Show_apcp_explain'] = 'Yeni Eklenti Gönderme Kontrol Panelinin gösterilmesini (evet) ya da eski sistemin gösterilmesini (hayýr) seçebilirsiniz. (Ýki seçeneði de sýrayla deneyip size uygun olaný seçiniz)';

$lang['Max_filesize_attach'] = 'Dosya Boyutu';
$lang['Max_filesize_attach_explain'] = 'Maksimum Eklenti Boyutu. 0 deðeri \'limitsiz\' anlamýndadýr. Bu ayar Server Ayarlarý ile sýnýrlandýrýlmýþtýr. Örneðin, server php ayarý maksimum 2 MB yüklemeye izin veriyorsa, bu ayar Eklenti MOD\'u tarafýndan deðiþtirilemez.';
$lang['Attach_quota'] = 'Eklenti Kotasý';
$lang['Attach_quota_explain'] = 'Tüm eklentiler için belirlenen maksimum disk alaný. 0 deðeri \'limitsiz\' anlamýndadýr.';
$lang['Max_filesize_pm'] = 'Özel Mesajlardaki maksimum Dosya Boyutu';
$lang['Max_filesize_pm_explain'] = 'Özel Meajlar için belirlenen maksimum disk alaný. 0 deðeri \'limitsiz\' anlamýndadýr.';
$lang['Default_quota_limit'] = 'Varsayýlan Kota Limiti';
$lang['Default_quota_limit_explain'] = 'Bu ayar ile yeni üye olan üyelerin ve hiçbir limit tanýmlanmamýþ üyelerin Varsayýlan Kota Limitini otomatik olarak belirleyebilirsiniz. Eðer herhangi bir Eklenti Kotasý kullanmýyorsanýz \'Kota Limiti Yok\' seçeneðini kullanabilirsiniz.';

$lang['Max_attachments'] = 'Maksimum Eklenti Sayýsý';
$lang['Max_attachments_explain'] = 'Bir mesajda izin verilen maksimum eklenti sayýsý.';
$lang['Max_attachments_pm'] = 'Bir Özel Mesajdaki Maksimum Eklenti Sayýsý';
$lang['Max_attachments_pm_explain'] = 'Bir Özel Mesajda izin verilen maksimum eklenti sayýsý.';

$lang['Disable_mod'] = 'Eklenti MOD\'u Kapat';
$lang['Disable_mod_explain'] = 'Bu seçenek yeni temalarý test ederken kullanýlabilir ve Yönetim Paneli dýþýndaki tüm Eklenti MOD\'u özelliklerini kapatýr.';
$lang['PM_Attachments'] = 'Özel Mesajda Eklentilere Ýzin Ver';
$lang['PM_Attachments_explain'] = 'Özel mesajlarda eklenti gönderip gönderilmeyeceðini seçebilirsiniz.';
$lang['Ftp_upload'] = 'FTP Yüklemeyi Aç';
$lang['Ftp_upload_explain'] = 'FTP Yükleme seçeneðini açýp kapayabilirsiniz. Eðer eveti seçerseniz, Eklenti FTP Ayarlarýný tanýmlamalýsýnýz, bundan böyle yükleme dizini kullanýlmayacaktýr.';
$lang['Attachment_topic_review'] = 'Eklentileri mesaj gönder ekranýnda görüntülemek ister misiniz?';
$lang['Attachment_topic_review_explain'] = 'Eðer evet\'i seçerseniz, bütün eklentiler mesaj gönderme ekranýnda görüntülenecektir. (Bu ekran, yeni bir cevap yazarken sayfanýn altýnda görüntülenen ekrandýr)';

$lang['Ftp_server'] = 'FTP Yükleme Server\'ý';
$lang['Ftp_server_explain'] = 'Serverýnýza dosya göndermek için buraya IP adresi veya FTP adresi girmelisiniz. Eðer bu alanlarý boþ býrakýrsanýz phpbb kurulumnda girdiðiniz deðerler esas alýnýr. Adreslerin baþýna ftp:// veya benzer birþey yazmayýn. (ftp.site.com veya IP adresi hangisi daha hýzlý ise)';

$lang['Attach_ftp_path'] = 'Yükleme dizinine göre FTP Yolu';
$lang['Attach_ftp_path_explain'] = 'Eklerin depolanacaðý dizin. Bu dizin CHMOD ayarýna sahip olmak zorunda deðil. Buraya IP ve FTP adresi <u>girmeyin</u>, bu alan sadece FTP yolu içindir.<br />Örnek: /home/web/uploads';
$lang['Ftp_download_path'] = 'FTP Yolu için Ýndirme Linki';
$lang['Ftp_download_path_explain'] = 'Dosyalarýn depolandýðý yerin yolunu girin.<br />Eðer bir uzak FTP sunucusu kullanýyorsanýz, adresini tam olarak girin, örneðin: http://www.mystorage.com/phpBB2/upload. <br />Eðer dosyalar yerel bir sunucuda depolanýyorsa, phpBB\'nin kurulu olduðu yola göre göreceli adresi girin, örneðin: \'upload\'.<br />Bu alaný boþ býrakýrsanýz, FTP yolu eriþilemez, fiziksel indirmeyi kullanamazsýnýz.';
$lang['Ftp_passive_mode'] = 'FTP Passive Modu Aç';
$lang['Ftp_passive_mode_explain'] = 'Bu özellik uzak sunucu ile aranýzda bir kapý açar ve tüm iletiþimleri o kapý üzerinden yürütür. Uzak sunucu kendisine baðlý olanlarý dinler ve ona baðlanýr.';

$lang['No_ftp_extensions_installed'] = 'FTP dosya göndermeyi kullanamazsýn, çünkü sunucunuzdaki PHP bu özelliði desteklemiyor.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Burada sisteminizde bulunmayan Eklentilerin bilgilerini mesajlardan silebilirsiniz, ayrýca herhangi bir mesajda görüntülenmeyen Eklentileri de silebilirsiniz. Bir linke týklayarak eklentiyi görebilir ya da indirebilirsiniz. Eðer bir link yoksa Eklenti sistemde bulunmamaktadýr.';
$lang['Shadow_attachments_file_explain'] = 'Hiçbir mesajda görüntülenmeyen ama sistemde bulunan Eklentileri sil.';
$lang['Shadow_attachments_row_explain'] = 'Sistemde bulunmayan Eklentilerin mesaj bilgilerini silin.';
$lang['Empty_file_entry'] = 'Boþ Dosya/Eklenti Girdisi';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Resetlenen resim önizlemeleri: %s';
$lang['Attach_sync_finished'] = 'Eklenti Senkronizasyonu Bitti.';
$lang['Sync_topics'] = 'Baþlýk senkronize';
$lang['Sync_posts'] = 'Mesaj senkronize';
$lang['Sync_thumbnails'] = 'Önizleme resmi senkronize';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Uzantý Yönetimi';
$lang['Manage_extensions_explain'] = 'Burada dosyalarýn uzantýlarýný yönetebilirsiniz. Eðer bir uzantýya sahip dosyanýn sisteme yüklenmesine izin vermek istiyorsanýz, lütfen Uzantý Grubu Yönetimini kullanýn.';
$lang['Explanation'] = 'Açýklama';
$lang['Extension_group'] = 'Uzantý Grubu';
$lang['Invalid_extension'] = 'Geçersiz Uzantý';
$lang['Extension_exist'] = '%s Uzantýsý zaten var';
$lang['Unable_add_forbidden_extension'] = '%s uzantýsý yasaklý, bu uzantýyý izin verilen uzantýlara ekleyemezsiniz'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Uzantý Gruplarý Yönetimi';
$lang['Manage_extension_groups_explain'] = 'Burada Uzantý Gruplarý ekleyebilir, silebilir ve düzenleyebilir; Uzantý Gruplarýný kapatabilir; özel Kategori atayabilir; indirme þeklini deðiþtirebilir ve belli bir Uzantý Grubuna dahil eklentiler için yükleme ikonu tanýmlayabilirsiniz.';
$lang['Special_category'] = 'Özel Kategori';
$lang['Category_images'] = 'Resim Dosyasý';
$lang['Category_stream_files'] = 'Akýcý Medya';
$lang['Category_swf_files'] = 'Flash Dosyasý';
$lang['Allowed'] = 'Ýzin Ver';
$lang['Allowed_forums'] = 'Ýzin Verilen Forumlar';
$lang['Ext_group_permissions'] = 'Grup Ýzinleri';
$lang['Download_mode'] = 'Ýndirme Modu';
$lang['Upload_icon'] = 'Yükleme Ýkonu';
$lang['Max_groups_filesize'] = 'Maksimum Dosya Boyutu';
$lang['Extension_group_exist'] = '%s Uzantý Grubu zaten var';
$lang['Collapse'] = '<b>[+]</b> ';
$lang['Decollapse'] = '<b>[-]</b> ';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Özel Kategori Yönetimi';
$lang['Manage_categories_explain'] = 'Burada Özel Kategoriler tanýmlayabilirsiniz. Özel kategoriler için özel parametre ve koþullar tanýmlayabilirsiniz.';
$lang['Settings_cat_images'] = 'Özel Kategori Yönetimi: Resim Dosyasý';
$lang['Settings_cat_streams'] = 'Özel Kategori Yönetimi: Akýcý Medya';
$lang['Settings_cat_flash'] = 'Özel Kategori Yönetimi: Flash Dosyasý';
$lang['Display_inlined'] = 'Resimleri direkt olarak göster';
$lang['Display_inlined_explain'] = 'Resimleri direkt veya baðlantý (link) olarak gösterilmesi';
$lang['Max_image_size'] = 'Maksimum Resim Boyutlarý';
$lang['Max_image_size_explain'] = 'Eklenebilecek maksimum resim boyutu (piksel olarak Geniþlik x Yükseklik).<br />Eðer 0x0 olarak ayarlarsanýz bu özellik kapatýlacaktýr. Bu özellik bazen PHP ayarlarýndan dolayý düzgün çalýþmayabilir.';
$lang['Image_link_size'] = 'Maksimum Resim Link Boyutlarý';
$lang['Image_link_size_explain'] = 'Eðer bu özellik için girilen deðerler aþýlýrsa resim link olarak gösterilir. Eðer satýriçi göster açýksa (piksel olarak Geniþlik x Yükseklik).<br />Eðer 0x0 olarak ayarlarsanýz bu özellik kapatýlacaktýr. Bu özellik bazen PHP ayarlarýndan dolayý düzgün çalýþmayabilir.';
$lang['Assigned_group'] = 'Gruba verilen';

$lang['Image_create_thumbnail'] = 'Önizleme Resimleri üret';
$lang['Image_create_thumbnail_explain'] = 'Her zaman bir önizleme resmi üret. Bu özellik Özel Kategolerdeki kurallarýn neredeyse hepsini çiðner, belirlenen maksimum boyutlar hariç. Bu özellik ile eklenen resimlerin küçültülmüþ halleri gösterilir, týklandýðýnda ise orjinal resmi açar.';
$lang['Image_min_thumb_filesize'] = 'Minimum Önizleme Dosya Boyutu';
$lang['Image_min_thumb_filesize_explain'] = 'Eðer resim bu deðerler altýnda ise önizleme resmi üretilmeyecektir.';
$lang['Image_imagick_path'] = 'Imagick Programý (Tam Yolu)';
$lang['Image_imagick_path_explain'] = 'Çeviri programý olan imagick\'in yolunu girin, normali /usr/bin/convert (windows: c:/imagemagick/convert.exe)';
$lang['Image_search_imagick'] = 'Imagick Ara';

$lang['Use_gd2'] = 'GD2 Eklentisini Kullan ';
$lang['Use_gd2_explain'] = 'GD1 ve GD2 PHP eklentileri sisteminizde kurulu olabilir. imagemagick programý olmadan da doðru bir þekilde önizleme resimleri oluþturulabilir, Eklenti MOD\'u bu yüzden size farklý iki seçenek verir, burada sizin seçiminiz temel alýnýr. Eðer önzileme resimlerinde problem veya kalitesizlik varsa bu ayarlarý kontrol edin.';
$lang['Attachment_version'] = 'Attachment Mod Version %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Yasaklý Uzantý Yönetimi';
$lang['Manage_forbidden_extensions_explain'] = 'Burada yasaklý uzantý grubu ekleyebilir ve çýkarabilirsiniz. Güvenlik gerekçeleriyle php, php3 ve php4 uzantýlarý varsayýlan olarak yasaklanmýþtýr, bunlarý silemezsiniz.';
$lang['Forbidden_extension_exist'] = '%s uzantýsý zaten yasaklý'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = '%s uzantýsý izin verilen uzantýlar kýsmýnda tanýmlý. Lütfen uzantýyý buraya eklemek için Ýzin Verilen uzantýlar bölümünden silin.'; // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Uzantý Grubu Ýzinleri -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Buradan eklentiler için uzantý seçeneklerini forumlara göre ayarlayabilirsiniz. Normal olarak tüm uzantýlar tüm forumlara açýktýr. Herhangi bir zamanda tekrar tüm forumlarý seçebilirsiniz. Eðer yeni bir forum eklerseniz bu tüm forumlar seçeneðine dahil olur. Eðer foruma giriþi sýnýrladýysan, ilk önce buradan gerekli ayarlarý yapýn.';
$lang['Note_admin_empty_group_permissions'] = 'NOT:<br />Burada kullanýcýlarýn normal olarak dosya ekleyebileceði forumlar sýralanýr, ama uzantý ayarlarý izin vermiyorsa, kullanýcýlar herhangi birþey gönderemez. Eðer onlar dosya göndermeyi denerlerse bir hata mesajý alacaklar. Belki bu forumlara Yöneticinin dosya göndermesine izin vermek isteyebilirsin.<br /><br />';
$lang['Add_forums'] = 'Forum Ekle';
$lang['Add_selected'] = 'Seçileni Ekle';
$lang['Perm_all_forums'] = 'BÜTÜN FORUMLAR';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Eklenti Kotasý Limitleri Yönetimi';
$lang['Manage_quotas_explain'] = 'Burada Kota Limitleri ekleyebilir, silebilir ve deðiþtirebilirsiniz. Kota Limitlerini daha sonra Kullanýcý Ve Kullanýcý Gruplarýna atayabilirsiniz. Bir Kullanýcýya bir Kota Limiti atamak için, Kullanýcýlar->Yönetim linklerini izleyerek Kullanýcýyý seçtikten sonra en alttaki Seçenekten ayarlayabilirsiniz. Bir Kullanýcý Grubuna bir Kota Limiti atamak için, Kullanýcý Gruplarý->Yönetim linklerini takip ederek istediðiniz Kullanýcý Grubunu seçtikten sonra gerekli Ayarý yapabilirsiniz. Hangi Kullanýcýlara ve Kullanýcý Gruplarýna Kota Limiti atandýðýný görmek için, Kota Açýklamasýnýn solundaki \'Görüntüleme\' linkine týklayýn.';
$lang['Assigned_users'] = 'Atanan Kullanýcýlar';
$lang['Assigned_groups'] = 'Atanan Kullanýcý Gruplarý';
$lang['Quota_limit_exist'] = '%s Kota Limiti zaten var.';

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Dosya Eklenti Kontrol Paneli';
$lang['Control_panel_explain'] = 'Burada Kullanýcý, Eklenti, Ýzlenim gibi özelliklere baðlý olarak bütün eklentileri görebilir ve yönetebilirsiniz';
$lang['File_comment_cp'] = 'Dosya Açýklamasý';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = '* iþareti ile kelimenin bir bölümünü girip gerisinin bulunmasýný saðlayabilirsiniz';
$lang['Size_smaller_than'] = 'Eklenti boyutu küçüktür (byte)';
$lang['Size_greater_than'] = 'Eklenti boyutu büyüktür (byte)';
$lang['Count_smaller_than'] = 'Ýndirilme sayýsý küçüktür';
$lang['Count_greater_than'] = 'Ýndirilme sayýsý büyüktür';
$lang['More_days_old'] = 'Belirtilen günden eski eklentiler';
$lang['No_attach_search_match'] = 'Arama isteðinize göre sonuç bulunamadý';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Eklenti Sayýsý';
$lang['Total_filesize'] = 'Toplam Dosya Boyutu';
$lang['Number_posts_attach'] = 'Eklentili Mesajlarýn Sayýsý';
$lang['Number_topics_attach'] = 'Eklentili Konularýn Sayýsý';
$lang['Number_users_attach'] = 'Eklenti Gönderen Toplam Kullanýcý Sayýsý';
$lang['Number_pms_attach'] = 'Özel Mesajlardaki Toplam Eklenti Sayýsý';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = '%s için Eklenti Ýstatistikleri';
$lang['Size_in_kb'] = 'Boyut (KB)';
$lang['Downloads'] = 'Ýndirilme';
$lang['Post_time'] = 'Gönderilme Zamaný';
$lang['Posted_in_topic'] = 'Konu';
$lang['Submit_changes'] = 'Deðiþiklikleri Gönder';

// Sort Types
$lang['Sort_Attachments'] = 'Eklentiler';
$lang['Sort_Size'] = 'Boyut';
$lang['Sort_Filename'] = 'Dosya Adý';
$lang['Sort_Comment'] = 'Yorum';
$lang['Sort_Extension'] = 'Uzantý';
$lang['Sort_Downloads'] = 'Ýndirilme';
$lang['Sort_Posttime'] = 'Gönderilme Zamaný';
$lang['Sort_Posts'] = 'Mesajlar';

// View Types
$lang['View_Statistic'] = 'Ýstatistikler';
$lang['View_Search'] = 'Ara';
$lang['View_Username'] = 'Kullanýcý Adý';
$lang['View_Attachments'] = 'Eklentiler';

// Successfully updated
$lang['Attach_config_updated'] = 'Eklenti Ayarlarý baþarýyla güncellendi';
$lang['Click_return_attach_config'] = 'Eklenti Ayarlarýna dönmek için %sburaya%s týklayýn';
$lang['Test_settings_successful'] = 'Ayar Testi bitti. Yaptýðýnýz ayarlarda bir sorun yok.';

// Some basic definitions
$lang['Attachments'] = 'Mesaj Ekleri';
$lang['Attachment'] = 'Eklenti';
$lang['Extensions'] = 'Uzantýlar';
$lang['Extension'] = 'Uzantý';

// Auth pages
$lang['Auth_attach'] = 'Dosya Gönder';
$lang['Auth_download'] = 'Dosya Ýndir';

?>