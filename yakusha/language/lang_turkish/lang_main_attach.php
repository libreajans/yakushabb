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
// Attachment Mod Main Language Variables
//


// Auth Related Entries
$lang['Rules_attach_can'] = 'Bu foruma eklenti <b>gönderebilirsiniz</b>';
$lang['Rules_attach_cannot'] = 'Bu foruma eklenti <b>gönderemezsiniz</b>';
$lang['Rules_download_can'] = 'Bu forumdan eklenti <b>indirebilirsiniz</b>';
$lang['Rules_download_cannot'] = 'Bu forumdan eklenti <b>indiremezsiniz</b>';
$lang['Sorry_auth_view_attach'] = 'Üzgünüz, ama bu eklentiyi görmeye ya da indirmeye yetkiniz yok';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'Açýklama'; // used in Administration Panel too...
$lang['Downloaded'] = 'Ýndirilme';
$lang['Download'] = 'Ýndir'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Dosya Boyutu';
$lang['Viewed'] = 'Ýzlenme';
$lang['Download_number'] = '%d defa'; // replace %d with count
$lang['Extension_disabled_after_posting'] = '\'%s\' uzantýsý forum yönetimi tarafýndan yasaklanmýþtýr, bu yüzden bu eklenti görüntülenmeyecektir.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Eklenti Kontrol Paneli';
$lang['Attach_posting_cp_explain'] = 'Eðer Eklenti Gönder\'e týklarsanýz, yeni bir Eklenti gönderebileceðiniz ekraný görebilirsiniz.<br />Eðer Gönderilmiþ Eklentiler\'e týklarsanýz, mesaja önceden gönderilmiþ eklentileri görebileceðiniz ve düzenleyebileceðiniz ekraný görebilirsiniz.<br />Eðer bir Eklentiyi deðiþtirmek (Yeni Versiyon Göndermek) istiyorsanýz, her iki butona da týklamalýsýnýz. Þöyleki, önce Gönderilmiþ Eklentiler\'e, hemen ardýndan Eklenti Gönder\'e týklayýn. Daha sonra normal bir þekilde eklentiyi bulup yükleyin ama Eklenti Gönder\'e týklamayýn, bunun yerine yeni versiyonu göndermek istediðiniz eklentinin altýndaki Yeni Versiyonu Gönder\'e týklayýn .';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Eklentiyi Gönder';
$lang['Add_attachment_title'] = 'Eklenti Gönder';
$lang['Add_attachment_explain'] = 'Eðer bir Eklenti göndermek <b>istemiyorsanýz</b> aþaðýdaki alanlarý <i>boþ býrakýn</i>.';
$lang['File_name'] = 'Dosya Adý';
$lang['File_comment'] = 'Açýklama';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Gönderilmiþ Eklentiler';
$lang['Options'] = 'Seçenekler';
$lang['Update_comment'] = 'Açýklamayý Güncelle';
$lang['Delete_attachments'] = 'Eklentileri Sil';
$lang['Delete_attachment'] = 'Eklentiyi Sil';
$lang['Delete_thumbnail'] = 'Önizlemeyi Sil';
$lang['Upload_new_version'] = 'Yeni Versiyonu Gönder';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = 'Geçersiz dosya adý: %s'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'Eklenti çok büyük.<br />PHP\'de tanýmlanan maksimum dosya boyutuna ulaþýlamýyor.<br />Eklenti Mod\'u php.ini\'de tanýmlanan maksimum yükleme boyutunu belirleyemiyor.';
$lang['Attachment_php_size_overrun'] = 'Eklenti çok büyük.<br />Maksimum Yükleme Boyutu: %d MB.<br />Lütfen bu boyutun php.ini\'de tanýmlý olduðuna dikkat edin, yani bu PHP tarafýndan ayarlanmýþtýr ve Eklenti MOD\'u tarafýndan deðiþtirilemez.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = '%s uzantýsýna izin verilmiyor'; // replace %s with extension (e.g. .php)
$lang['Disallowed_extension_within_forum'] = 'Bu forumda %s uzantýsýyla eklenti gönderme yetkiniz yok'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'Eklenti çok büyük.<br />Maksimum Boyut: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Üzgünüz, bütün eklentiler için maksimum dosya boyutuna ulaþýldý. Eðer sorunuz varsa Forum Yönetimi ile temas kurun.';
$lang['Too_many_attachments'] = 'Eklenti gönderilemiyor. Bir mesajdaki maksimum Eklenti sayýsýna (%d) ulaþýldý'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'Eklenti/Resim %dx%d boyutundan küçük olmalý';
$lang['General_upload_error'] = 'Yükleme Hatasý: %s\'ye eklenti yüklenemiyor.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = '\'Eklenti Gönder\'deki boþluklarý doldurmalýsýnýz';
$lang['Error_missing_old_entry'] = 'Eklenti Güncellenemiyor, eski Eklenti bulunamadý';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'Üzgünüz, özel mesajlarda gönderilen eklentileriniz toplam maksimum boyuta eriþti. Lütfen alýnan/gönderilen kutularýnýzdaki gereksiz özel mesajlarýnýzý silin.';
$lang['Attach_quota_receiver_pm_reached'] = 'Üzgünüz, özel mesajlarda \'%s\' kullanýcýsýnýn eklentileri toplam maksimum boyuta eriþti. Lütfen haber verin, veya eklentilerini silene kadar bekleyin.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Ýndirmek ya da görüntülemek için bir Eklenti seçmediniz.';
$lang['Error_no_attachment'] = 'Seçilen Eklenti bulunamadý';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Seçilen Eklentileri silmek istediðinize emin misiniz?';
$lang['Deleted_attachments'] = 'Seçilen Eklentiler silindi.';
$lang['Error_deleted_attachments'] = 'Eklentiler silinemiyor.';
$lang['Confirm_delete_pm_attachments'] = 'Bu Özel Mesajdaki tüm Eklentileri silmek istediðinize emin misinz??';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'Eklenti özelliði kullanýlmamakta.';

$lang['Directory_does_not_exist'] = '\'%s\' dizini yok ya da bulunamýyor.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Lütfen \'%s\' in dizin olup olmadýðýný kontrol ediniz.'; // replace %s with directory
$lang['Directory_not_writeable'] = '\'%s\' dizininin yazma izni yok. Yükleme dizinini yeniden oluþturmalý ve CHMOD 777 olarak ayarlamalýsýnýz.<br />Eðer sadece ftp-izni vermek istiyorsanýz \'Özelliði\' rwxrwxrwx yapmalýsýnýz.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'FTP Servera baðlanýlamadý: \'%s\'. Please check your FTP-Settings.';
$lang['Ftp_error_login'] = 'FTP Servera giriþ yapýlamadý. \'%s\' Kullanýcý adý yanlýþ veya þifre hatalý.';
$lang['Ftp_error_path'] = 'FTP dizinine eriþim izni yok: \'%s\'.';
$lang['Ftp_error_upload'] = 'Dosyalar ftp dizinine yüklenemedi: \'%s\'.';
$lang['Ftp_error_delete'] = 'Dosyalar ftp dizininden silinemedi: \'%s\'.<br />Bu hata için var olmayan eklentiden baþka bir sebep bulunamýyor, lütfen önce gölge eklentileri kontrol edin.';
$lang['Ftp_error_pasv_mode'] = 'FTP Passive Modunu aç/kapa';

// Attach Rules Window
$lang['Rules_page'] = 'Eklenti Kurallarý';
$lang['Attach_rules_title'] = 'Ýzin Verilen Eklenti Gruplarý ve Boyutlarý';
$lang['Group_rule_header'] = '%s -> Maksimum Yükleme Boyutu: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Ýzin Verilen Uzantýlar ve Boyutlarý';
$lang['Note_user_empty_group_permissions'] = 'NOT:<br />Bu foruma Eklenti gönderebilmenize raðmen<br />herhangi bir uzantý grubuna izin verilmediði için,<br />eklenti gönderemezsiniz. Eðer denemek isterseniz,<br />Hata Mesajý alýrsýnýz.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Normal Yükleme Kotasý';
$lang['Pm_quota'] = 'Özel Mesaj Yükleme Kotasý';
$lang['User_upload_quota_reached'] = 'Üzgünüz, maksimum eklenti yükleme kotasýna (%d %s) ulaþtýnýz'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Eklentiler';
$lang['UACP'] = 'Kullanýcý Eklenti Kontrol Paneli';
$lang['User_uploaded_profile'] = 'Yüklenen: <b>%s</b>';
$lang['User_quota_profile'] = 'Kota: <b>%s</b>';
$lang['Upload_percent_profile'] = 'Toplamýn <b>%d</b>%%';

// Common Variables
$lang['Bytes'] = 'Byte';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Eklenti Ara';
$lang['Test_settings'] = 'Ayarlarý Kontrol Et';
$lang['Not_assigned'] = 'Belirtilmemiþ';
$lang['No_file_comment_available'] = 'Dosya açýklamasýna izin yok';
$lang['Attachbox_limit'] = 'Eklenti Kutunuz %d%% dolu';
$lang['No_quota_limit'] = 'Kota Limiti Yok';
$lang['Unlimited'] = 'Limit Yok';

?>