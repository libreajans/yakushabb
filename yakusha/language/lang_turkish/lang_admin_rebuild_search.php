<?php
/***************************************************************************
//Rebuild Search
//Author: chatasos < chatasos@psclub.gr > (Tassos Chatzithomaoglou) http://www.psclub.gr
//Version: 2.4.0
// Son Düzenleme ve Sürüm Güncelleme:
// Yakusha ( sabri ünal ) <yakushaBB@gmail.com> http://www.yakusha.net
// DOSYA ADI : lang_admin_rebuild_search.php
// TELÝF HAKKI : © 2000, 2005 Canver Networks [ phpBB Türkiye ]
// WWW : http://www.canver.net
 ***************************************************************************/
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

$lang['Rebuild_search'] = 'Arama Yeniden Yapýlandýrmasý';
$lang['Rebuild_search_desc'] = 'Bu modül arama bütün mesajlarýnýz için arama tablolarýný yeniden inþa edecektir. Ýstediðiniz zaman durdurabileceðiniz gibi, yeniden baþlamak istediðinizde son kaldýðýnýz yerden devam edebilme þansýna da sahipsiniz.<br /><br /> Çalýþtýðýný görmeniz (Zaman limitine ve düzenlenecek mesajlara baðlý olarak) uzun zaman alabilir. Bu yüzden eðer iptal etmek istemiyorsanýz çalýþma sayfasýný iþi bitene kadar kapatmayýn, deðiþtirmeyin.';

// Input screen
$lang['Starting_post_id'] = 'Baþlangýc post_id';
$lang['Starting_post_id_explain'] = 'Düzenlemenin baþlayacaðý ilk mesaj<br />En son kaldýðýnýz yerden de baþlayabilirsiniz';

$lang['Start_option_beginning'] = 'En baþtan baþla';
$lang['Start_option_continue'] = 'Kaldýðý yerden devam et';

$lang['Clear_search_tables'] = 'Arama tablolarýný temizle';
$lang['Clear_search_tables_explain'] = 'En baþtan baþlayacaksanýz eski phpBB arama tablolarýný kaldýrabilirsiniz<br />(SÝL/BOÞALT) metodlarý arasýnda seçim þansýnýz bulunmaktadýr';
$lang['Clear_search_no'] = 'Hayýr';
$lang['Clear_search_delete'] = 'SÝL';
$lang['Clear_search_truncate'] = 'BOÞALT';

$lang['Num_of_posts'] = 'Mesaj Sayýsý';
$lang['Num_of_posts_explain'] = 'Ýþlenen toplam mesaj sayýsý<br />Otomatik olarak veritabanýnda bulunan toplam / kalan mesaj sayýsý ile doldurulacaktýr';

$lang['Posts_per_cycle'] = 'Her döngüdeki mesaj sayýsý';
$lang['Posts_per_cycle_explain'] = 'Döngü her çalýþtýðýnda toplam kaç mesajý iþlesin?<br />php motorunun ve web sunucunuzun zaman aþýmlarýný engellemek için bu rakamý düþük tutunuz';

$lang['Time_limit'] = 'Zaman aþýmý limiti';
$lang['Time_limit_explain'] = 'Zaman aþýmý limitini belirleyiniz?';
$lang['Time_limit_explain_safe'] = '<i>php motorunuz (güvenli kipte) çalýþýyor ve %s saniyede zaman aþýmýna uðrayacak þekilde ayarlanmýþ, bu limiti aþmayýnýz.</i>';
$lang['Time_limit_explain_webserver'] = '<i>php motorunuz %s saniyede zaman aþýmýna uðrayacak þekilde ayarlanmýþ, bu limiti aþmayýnýz.</i>';

$lang['Refresh_rate'] = 'Yenileme hýzý';
$lang['Refresh_rate_explain'] = 'Bir sonraki döngüye geçene kadar sayfanýn beklemesi gereken zaman sýnýrý (sn)<br />Genellikle deðiþtirmeniz gerekmez';

$lang['Disable_board'] = 'Forum Kapalý';
$lang['Disable_board_explain'] = 'Ýþlemler sýrasýnda mesaj panonuz açýk mý kalsýn yoksa kapatýlsýn mý?';
$lang['Disable_board_explain_enabled'] = 'Ýþlemler bittikten sonra mesaj panonuz açýlacaktýr.';
$lang['Disable_board_explain_already'] = '<i>Mesaj panonuz zaten kapalý</i>';

$lang['Fast_mode'] = 'Hýzlý Mod';
$lang['Fast_mode_explain'] = 'Bu seçenek, ilk girdileri silmeden bütün veritabanýný gözden geçirecektir<br />UYARI! Etkileri için ilgili destek belgelerini inceleyiniz.';

$lang['Max_info'] = '(Max : %d)';

// Information strings
$lang['Info_processing_stopped'] = 'En son %s. mesajda kaldýnýz. (%s tane biten mesaj) Tarih: %s';
$lang['Info_processing_aborted'] = 'En son %s. mesajda iptal ettiniz. (%s tane biten mesaj) Tarih: %s';
$lang['Info_processing_aborted_soon'] = 'Devam etmeden önce bir süre bekleyiniz...';
$lang['Info_processing_finished'] = 'Çalýþma sona erdi. (%s tane biten mesaj) Tarih: %s';
$lang['Info_processing_finished_new'] = 'Çalýþma sona erdi. (%s tane biten mesaj) Tarih: %s<br />fakat %s tane yeni mesaj gönderildi';

// Progress screen
$lang['Rebuild_search_progress'] = 'Aramayý Yeniden Yapýlandýrma Durumu';

$lang['Processed_post_ids'] = 'Ýþlemi tamamlanmýþ mesajlar: %s - %s';
$lang['Timer_expired'] = '%s saniye ile zaman limiti aþýldý(expire)';
$lang['Cleared_search_tables'] = 'Arama tablolarý silindi. ';
$lang['Deleted_posts'] = 'Çalýþma yapýlýrken %s mesaj kullanýcýlarýnýz tarafýndan silindi.';
$lang['Processing_next_posts'] = 'Bir sonraki %s mesaj üzerinde çalýþýyor. Lütfen bekleyiniz...';
$lang['All_session_posts_processed'] = 'Kullanýmdaki tüm mesajlar üzerinde deðiþiklik yapýldý.';
$lang['All_posts_processed'] = 'Tüm mesajlar baþarýlý bir þekilde düzenlendi.';
$lang['All_tables_optimized'] = 'Tüm arama tablolarý baþarýlý bir þekilde düzenlendi.';

$lang['Processing_post_details'] = 'Detaylar';
$lang['Processed_posts'] = 'Düzenlenen Mesajlar';
$lang['Percent'] = 'Yüzdesi';
$lang['Current_session'] = 'Geçici Hesap';
$lang['Total'] = 'Toplam Hesap';

$lang['Process_details'] = '<b>%s</b> - <b>%s</b> arasý. (Toplam: <b>%s</b>)';
$lang['Percent_completed'] = '%s %% tamamlandý';

$lang['Processing_time_details'] = 'Yeniden Ýnþa Zaman Detaylarý';
$lang['Processing_time'] = 'Düzenleme vakti';
$lang['Time_last_posts'] = 'Oturumun son %s mesajý';
$lang['Time_from_the_beginning'] = 'Oturumun baþlangýcýndan beri';
$lang['Time_average'] = 'Taþýma sýnýrý';
$lang['Time_estimated'] = 'Geçerli oturum bitene kadar tahminen';

$lang['days'] = 'gün';
$lang['hours'] = 'saat';
$lang['minutes'] = 'dakika';
$lang['seconds'] = 'saniye';

$lang['Database_size_details'] = 'Veritabaný Büyüklügü';
$lang['Size_current'] = 'Þu anda';
$lang['Size_estimated'] = 'Bitmeden öncesi için';
$lang['Size_search_tables'] = 'Arama tablosu büyüklüðü';
$lang['Size_database'] = 'Veritabaný büyüklüðü';

$lang['Bytes'] = 'Bytes';

$lang['Active_parameters'] = '---';
$lang['Posts_last_cycle'] = 'Son taþýmada düzenlenen mesajlar';
$lang['Board_status'] = 'Mesaj panosu durumu';
$lang['Board_disabled'] = 'Kapalý';
$lang['Board_enabled'] = 'Açýk';

$lang['Info_estimated_values'] = '(*) Tahmini deðerler geçici ve yaklaþýk olarak hesaplanmaktadýr, amacý iþlem sonucu için size tahmini sonuçlar sunmaktýr! Ýþlemler sonunda karþýnýza çýkan sonuç ile tahminlerin uyuþmamasý ihtimali bulunmaktadýr...<br />Yüzdelik dilimlerin gösterdiði tahminlerin gerçekleþme ihtimali ise çok daha yüksektir. Ýlginiz için teþekkürler.';
$lang['Click_return_rebuild_search'] = 'Yapýlandýrma sayfasýna geri dönmek için %sburaya%s týklayýn';
$lang['Rebuild_search_aborted'] = '%s. mesajda çalýþma iptal edildi<br /><br />Eðer çalýþma sýrasýnda iþlemi durdurmadan iptal ettiyseniz yeni bir yapýlandýrmaya baþlamadan önce bir kaç dakika beklemelisiniz.';
$lang['Wrong_input'] = 'Yanlýþ bir deðer girmiþ bulunmaktasýnýz. Lütfen ilgili ayarlarý kontrol ediniz.';

// Buttons
$lang['Next'] = 'Sonra';
$lang['Processing'] = 'Çalýþýyor...';
$lang['Finished'] = 'Bitti';

?>