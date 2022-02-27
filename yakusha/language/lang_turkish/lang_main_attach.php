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
// Attachment Mod Main Language Variables
//


// Auth Related Entries
$lang['Rules_attach_can'] = 'Bu foruma eklenti <b>g�nderebilirsiniz</b>';
$lang['Rules_attach_cannot'] = 'Bu foruma eklenti <b>g�nderemezsiniz</b>';
$lang['Rules_download_can'] = 'Bu forumdan eklenti <b>indirebilirsiniz</b>';
$lang['Rules_download_cannot'] = 'Bu forumdan eklenti <b>indiremezsiniz</b>';
$lang['Sorry_auth_view_attach'] = '�zg�n�z, ama bu eklentiyi g�rmeye ya da indirmeye yetkiniz yok';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'A��klama'; // used in Administration Panel too...
$lang['Downloaded'] = '�ndirilme';
$lang['Download'] = '�ndir'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Dosya Boyutu';
$lang['Viewed'] = '�zlenme';
$lang['Download_number'] = '%d defa'; // replace %d with count
$lang['Extension_disabled_after_posting'] = '\'%s\' uzant�s� forum y�netimi taraf�ndan yasaklanm��t�r, bu y�zden bu eklenti g�r�nt�lenmeyecektir.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Eklenti Kontrol Paneli';
$lang['Attach_posting_cp_explain'] = 'E�er Eklenti G�nder\'e t�klarsan�z, yeni bir Eklenti g�nderebilece�iniz ekran� g�rebilirsiniz.<br />E�er G�nderilmi� Eklentiler\'e t�klarsan�z, mesaja �nceden g�nderilmi� eklentileri g�rebilece�iniz ve d�zenleyebilece�iniz ekran� g�rebilirsiniz.<br />E�er bir Eklentiyi de�i�tirmek (Yeni Versiyon G�ndermek) istiyorsan�z, her iki butona da t�klamal�s�n�z. ��yleki, �nce G�nderilmi� Eklentiler\'e, hemen ard�ndan Eklenti G�nder\'e t�klay�n. Daha sonra normal bir �ekilde eklentiyi bulup y�kleyin ama Eklenti G�nder\'e t�klamay�n, bunun yerine yeni versiyonu g�ndermek istedi�iniz eklentinin alt�ndaki Yeni Versiyonu G�nder\'e t�klay�n .';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Eklentiyi G�nder';
$lang['Add_attachment_title'] = 'Eklenti G�nder';
$lang['Add_attachment_explain'] = 'E�er bir Eklenti g�ndermek <b>istemiyorsan�z</b> a�a��daki alanlar� <i>bo� b�rak�n</i>.';
$lang['File_name'] = 'Dosya Ad�';
$lang['File_comment'] = 'A��klama';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'G�nderilmi� Eklentiler';
$lang['Options'] = 'Se�enekler';
$lang['Update_comment'] = 'A��klamay� G�ncelle';
$lang['Delete_attachments'] = 'Eklentileri Sil';
$lang['Delete_attachment'] = 'Eklentiyi Sil';
$lang['Delete_thumbnail'] = '�nizlemeyi Sil';
$lang['Upload_new_version'] = 'Yeni Versiyonu G�nder';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = 'Ge�ersiz dosya ad�: %s'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'Eklenti �ok b�y�k.<br />PHP\'de tan�mlanan maksimum dosya boyutuna ula��lam�yor.<br />Eklenti Mod\'u php.ini\'de tan�mlanan maksimum y�kleme boyutunu belirleyemiyor.';
$lang['Attachment_php_size_overrun'] = 'Eklenti �ok b�y�k.<br />Maksimum Y�kleme Boyutu: %d MB.<br />L�tfen bu boyutun php.ini\'de tan�ml� oldu�una dikkat edin, yani bu PHP taraf�ndan ayarlanm��t�r ve Eklenti MOD\'u taraf�ndan de�i�tirilemez.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = '%s uzant�s�na izin verilmiyor'; // replace %s with extension (e.g. .php)
$lang['Disallowed_extension_within_forum'] = 'Bu forumda %s uzant�s�yla eklenti g�nderme yetkiniz yok'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'Eklenti �ok b�y�k.<br />Maksimum Boyut: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = '�zg�n�z, b�t�n eklentiler i�in maksimum dosya boyutuna ula��ld�. E�er sorunuz varsa Forum Y�netimi ile temas kurun.';
$lang['Too_many_attachments'] = 'Eklenti g�nderilemiyor. Bir mesajdaki maksimum Eklenti say�s�na (%d) ula��ld�'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'Eklenti/Resim %dx%d boyutundan k���k olmal�';
$lang['General_upload_error'] = 'Y�kleme Hatas�: %s\'ye eklenti y�klenemiyor.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = '\'Eklenti G�nder\'deki bo�luklar� doldurmal�s�n�z';
$lang['Error_missing_old_entry'] = 'Eklenti G�ncellenemiyor, eski Eklenti bulunamad�';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = '�zg�n�z, �zel mesajlarda g�nderilen eklentileriniz toplam maksimum boyuta eri�ti. L�tfen al�nan/g�nderilen kutular�n�zdaki gereksiz �zel mesajlar�n�z� silin.';
$lang['Attach_quota_receiver_pm_reached'] = '�zg�n�z, �zel mesajlarda \'%s\' kullan�c�s�n�n eklentileri toplam maksimum boyuta eri�ti. L�tfen haber verin, veya eklentilerini silene kadar bekleyin.';

// Errors -> Download
$lang['No_attachment_selected'] = '�ndirmek ya da g�r�nt�lemek i�in bir Eklenti se�mediniz.';
$lang['Error_no_attachment'] = 'Se�ilen Eklenti bulunamad�';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Se�ilen Eklentileri silmek istedi�inize emin misiniz?';
$lang['Deleted_attachments'] = 'Se�ilen Eklentiler silindi.';
$lang['Error_deleted_attachments'] = 'Eklentiler silinemiyor.';
$lang['Confirm_delete_pm_attachments'] = 'Bu �zel Mesajdaki t�m Eklentileri silmek istedi�inize emin misinz??';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'Eklenti �zelli�i kullan�lmamakta.';

$lang['Directory_does_not_exist'] = '\'%s\' dizini yok ya da bulunam�yor.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'L�tfen \'%s\' in dizin olup olmad���n� kontrol ediniz.'; // replace %s with directory
$lang['Directory_not_writeable'] = '\'%s\' dizininin yazma izni yok. Y�kleme dizinini yeniden olu�turmal� ve CHMOD 777 olarak ayarlamal�s�n�z.<br />E�er sadece ftp-izni vermek istiyorsan�z \'�zelli�i\' rwxrwxrwx yapmal�s�n�z.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'FTP Servera ba�lan�lamad�: \'%s\'. Please check your FTP-Settings.';
$lang['Ftp_error_login'] = 'FTP Servera giri� yap�lamad�. \'%s\' Kullan�c� ad� yanl�� veya �ifre hatal�.';
$lang['Ftp_error_path'] = 'FTP dizinine eri�im izni yok: \'%s\'.';
$lang['Ftp_error_upload'] = 'Dosyalar ftp dizinine y�klenemedi: \'%s\'.';
$lang['Ftp_error_delete'] = 'Dosyalar ftp dizininden silinemedi: \'%s\'.<br />Bu hata i�in var olmayan eklentiden ba�ka bir sebep bulunam�yor, l�tfen �nce g�lge eklentileri kontrol edin.';
$lang['Ftp_error_pasv_mode'] = 'FTP Passive Modunu a�/kapa';

// Attach Rules Window
$lang['Rules_page'] = 'Eklenti Kurallar�';
$lang['Attach_rules_title'] = '�zin Verilen Eklenti Gruplar� ve Boyutlar�';
$lang['Group_rule_header'] = '%s -> Maksimum Y�kleme Boyutu: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = '�zin Verilen Uzant�lar ve Boyutlar�';
$lang['Note_user_empty_group_permissions'] = 'NOT:<br />Bu foruma Eklenti g�nderebilmenize ra�men<br />herhangi bir uzant� grubuna izin verilmedi�i i�in,<br />eklenti g�nderemezsiniz. E�er denemek isterseniz,<br />Hata Mesaj� al�rs�n�z.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Normal Y�kleme Kotas�';
$lang['Pm_quota'] = '�zel Mesaj Y�kleme Kotas�';
$lang['User_upload_quota_reached'] = '�zg�n�z, maksimum eklenti y�kleme kotas�na (%d %s) ula�t�n�z'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Eklentiler';
$lang['UACP'] = 'Kullan�c� Eklenti Kontrol Paneli';
$lang['User_uploaded_profile'] = 'Y�klenen: <b>%s</b>';
$lang['User_quota_profile'] = 'Kota: <b>%s</b>';
$lang['Upload_percent_profile'] = 'Toplam�n <b>%d</b>%%';

// Common Variables
$lang['Bytes'] = 'Byte';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Eklenti Ara';
$lang['Test_settings'] = 'Ayarlar� Kontrol Et';
$lang['Not_assigned'] = 'Belirtilmemi�';
$lang['No_file_comment_available'] = 'Dosya a��klamas�na izin yok';
$lang['Attachbox_limit'] = 'Eklenti Kutunuz %d%% dolu';
$lang['No_quota_limit'] = 'Kota Limiti Yok';
$lang['Unlimited'] = 'Limit Yok';

?>