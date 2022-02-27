<?php
/***************************************************************************
 * lang_auto_backup.php [English]
 ***************************************************************************/

$lang['Automatic_Backup'] = 'Otomatik Veritabaný Yedekle';
$lang['Automatic_Backup_Explain'] = 'Bu bölümde, otomatik veritabaný yedekleme ayarlarýnýzý düzenleyebilirsiniz, basit zaman düzeni için, <b>Basit Sentaks</b>\'ý seçin, eðer geliþmiþ ayarlar alanýný kullanmak istiyorsanýz, <b>Geliþmiþ Sentaks</b>\'ý seçin. Buradan veritabanýnýzýn ne zaman yedeklenmesini istediðinizi özelleþtirebilir ve hangi e-posta adresinize bilgi verilmesini istediðinizi belirtebilirsiniz.';
$lang['Automatic_Backup_Form_Explain'] = 'E-posta adresi seçeneði için, Baþka bir server üzerinde olan e-posta adresinizi vermenizi tavsiye ederiz, ayrýca bu e-posta adresinizin limiti yüksek olmalýdýr; çünkü veritabaný dosyasý büyük olabilir. (Gmail, Yahoo gibi...)';
$lang['Click_return_auto_backup'] = 'Otomatik Veritabaný Yedekleme ayarlarýna dönmek için %sburaya%s týklayýnýz';
$lang['Error_updating_auto_backup'] = 'SQL Yedek dosyalarý güncellenirken hata';
$lang['auto_backup_advanced_user'] = 'Geliþmiþ Sentaks';
$lang['auto_backup_advanced_user_explain'] = 'Bu crontab programýnýn web arayüzüdür. Örneðin: * * * * * ifadesi "Her gün" anlamýna gelmektedir. 0 0 * * * ifadesi ise her gün, gece yarýsý anlamýna gelmektedir.';
$lang['auto_backup_basic_user'] = 'Basit Sentaks';
$lang['auto_backup_level'] = 'Sentaks türünü seçiniz';
$lang['Backup_type'] = 'Yedek Ayarlarý';
$lang['phpBB_only'] = 'Sadece phpBB tablolarý';
$lang['No_Search'] = 'Arama tablolarýný ayrý tut';
$lang['Ignore_tables'] = 'Ekteki tablolarý ayrý tut';
$lang['Submit'] = 'Gönder';
$lang['Reset'] = 'Temizle';
$lang['Email_Address'] = 'E-posta adresi';
$lang['Email_true'] = 'Yedek dosyasýný e-posta ile gönder';
$lang['Delay_time'] = 'Gecikme zamaný';

// Dakika
$lang['Minutes'] = 'Dakika';
$lang['Every_Minute'] = 'Her Dakika';
$lang['Every_Other_Minutes']= 'Her Diðer Dakika';
$lang['Every_Five_Minutes']= 'Her Beþ Dakika';
$lang['Every_Ten_Minutes']= 'Her On Dakika';
$lang['Every_Fifteen_Minutes']= 'Her Onbeþ Dakika';

// Saat
$lang['Hours'] = 'Saat';
$lang['Every_Hour'] = 'Her Saat';
$lang['Every_Other_Hour']= 'Her Diðer Saat';
$lang['Every_Four_Hours']= 'Her Dört Saat';
$lang['Every_Six_Hours']= 'Her Altý Saat';
$lang['Midnight']= 'Geceyarýsý';
$lang['Noon']= 'Öðlen';

// Günler
$lang['Days'] = 'Gün';
$lang['Every_Day'] = 'Her Gün';

// Aylar
$lang['Months'] = 'Aylar';
$lang['Every_Month'] = 'Her Ay';
$lang['January'] = 'Ocak';
$lang['February'] = 'Þubat';
$lang['March'] = 'Mart';
$lang['April'] = 'Nisan';
$lang['May'] = 'Mayýs';
$lang['June'] = 'Haziran';
$lang['July'] = 'Temmuz';
$lang['August'] = 'Aðustos';
$lang['September'] = 'Eylül';
$lang['October'] = 'Ekim';
$lang['November'] = 'Kasým';
$lang['December'] = 'Aralýk';

// haftanýn günleri
$lang['Weekdays'] = 'Haftanýn Günleri';
$lang['Every_Weekday'] = 'Haftanýn Hergünü';
$lang['Sunday'] = 'Pazar';
$lang['Monday'] = 'Pazartesi';
$lang['Tuesday'] = 'Salý';
$lang['Wednesday'] = 'Çarþamba';
$lang['Thursday'] = 'Perþembe';
$lang['Friday'] = 'Cuma';
$lang['Saturday'] = 'Cumartesi';

//FTP

$lang['FTP_true'] = 'Yedeði FTP Sunucu\'da sakla';
$lang['FTP_server'] = 'FTP Sunucu';
$lang['FTP_user_name'] = 'FTP Kullanýcý adý';
$lang['FTP_user_pass'] = 'FTP Þifresi';
$lang['FTP_directory'] = 'FTP Dizini';

// Yedekleri backups dizinine sakla
$lang['write_backups_true'] = 'Yedekleri backups dizininde sakla';
$lang['files_to_keep'] = 'Tutulacak dosyalar';
$lang['files_to_keep_explain'] = 'Saklamak istediðiniz yedekleme sayýsýný girin.<br><b>-1</b> ifadesi bütün yedeklemeleri sakla anlamýna gelir.';

$lang['Error_updating_auto_backup'] = 'SQL Yedek bilgisinde hata';
$lang['Error_retrieving_auto_backup'] = 'SQL yedek bilgisini düzenelrken hata oluþtu.';
$lang['Error_enabling_disabling_board'] = 'Forumu kullancýlara açarken ya da kapatýrken sorun yaþandý.';
$lang['error_email_subject'] = 'Veritabanýnýzý yedeklerken bir hata oluþtu';
$lang['auto_backup_email_message'] = 'Veri tabanýnýz baþarýlý bir þekilde yedeklendi ';
$lang['auto_backup_email_subject'] = 'Veritabaný yedeði';
$lang['file_saved_to_backups'] = 'Dosya %s kayýt edildi';

// FTP email messages
$lang['Current_directory'] = 'Geçerli Dizin';
$lang['Change_directory_to'] = 'Dizini þuna deðiþtir';
$lang['Couldnt_change_directory'] = 'Dizin deðiþtirelemedi';
$lang['Creating_directory'] = 'Dizin ekle';
$lang['Created_directory'] = 'Dizin eklendi';
$lang['Cant_Create_directory'] = 'Dizin eklenemedi';
$lang['FTP_upload_failed'] = 'FTP yüklemesi baþarýsýz oldu';
$lang['FTP_connection_failed'] = 'FTP baðlantýsý yapýlamadý';
$lang['FTP_file_information'] = 'FTP dosyasý bilgisi';
$lang['Uploaded_file_to'] = 'Dosyalar buraya: %s';

?>