<?php
/***************************************************************************
//Rebuild Search
//Author: chatasos < chatasos@psclub.gr > (Tassos Chatzithomaoglou) http://www.psclub.gr
//Version: 2.4.0
// Son D�zenleme ve S�r�m G�ncelleme:
// Yakusha ( sabri �nal ) <yakushaBB@gmail.com> http://www.yakusha.net
// DOSYA ADI : lang_admin_rebuild_search.php
// TEL�F HAKKI : � 2000, 2005 Canver Networks [ phpBB T�rkiye ]
// WWW : http://www.canver.net
 ***************************************************************************/
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

$lang['Rebuild_search'] = 'Arama Yeniden Yap�land�rmas�';
$lang['Rebuild_search_desc'] = 'Bu mod�l arama b�t�n mesajlar�n�z i�in arama tablolar�n� yeniden in�a edecektir. �stedi�iniz zaman durdurabilece�iniz gibi, yeniden ba�lamak istedi�inizde son kald���n�z yerden devam edebilme �ans�na da sahipsiniz.<br /><br /> �al��t���n� g�rmeniz (Zaman limitine ve d�zenlenecek mesajlara ba�l� olarak) uzun zaman alabilir. Bu y�zden e�er iptal etmek istemiyorsan�z �al��ma sayfas�n� i�i bitene kadar kapatmay�n, de�i�tirmeyin.';

// Input screen
$lang['Starting_post_id'] = 'Ba�lang�c post_id';
$lang['Starting_post_id_explain'] = 'D�zenlemenin ba�layaca�� ilk mesaj<br />En son kald���n�z yerden de ba�layabilirsiniz';

$lang['Start_option_beginning'] = 'En ba�tan ba�la';
$lang['Start_option_continue'] = 'Kald��� yerden devam et';

$lang['Clear_search_tables'] = 'Arama tablolar�n� temizle';
$lang['Clear_search_tables_explain'] = 'En ba�tan ba�layacaksan�z eski phpBB arama tablolar�n� kald�rabilirsiniz<br />(S�L/BO�ALT) metodlar� aras�nda se�im �ans�n�z bulunmaktad�r';
$lang['Clear_search_no'] = 'Hay�r';
$lang['Clear_search_delete'] = 'S�L';
$lang['Clear_search_truncate'] = 'BO�ALT';

$lang['Num_of_posts'] = 'Mesaj Say�s�';
$lang['Num_of_posts_explain'] = '��lenen toplam mesaj say�s�<br />Otomatik olarak veritaban�nda bulunan toplam / kalan mesaj say�s� ile doldurulacakt�r';

$lang['Posts_per_cycle'] = 'Her d�ng�deki mesaj say�s�';
$lang['Posts_per_cycle_explain'] = 'D�ng� her �al��t���nda toplam ka� mesaj� i�lesin?<br />php motorunun ve web sunucunuzun zaman a��mlar�n� engellemek i�in bu rakam� d���k tutunuz';

$lang['Time_limit'] = 'Zaman a��m� limiti';
$lang['Time_limit_explain'] = 'Zaman a��m� limitini belirleyiniz?';
$lang['Time_limit_explain_safe'] = '<i>php motorunuz (g�venli kipte) �al���yor ve %s saniyede zaman a��m�na u�rayacak �ekilde ayarlanm��, bu limiti a�may�n�z.</i>';
$lang['Time_limit_explain_webserver'] = '<i>php motorunuz %s saniyede zaman a��m�na u�rayacak �ekilde ayarlanm��, bu limiti a�may�n�z.</i>';

$lang['Refresh_rate'] = 'Yenileme h�z�';
$lang['Refresh_rate_explain'] = 'Bir sonraki d�ng�ye ge�ene kadar sayfan�n beklemesi gereken zaman s�n�r� (sn)<br />Genellikle de�i�tirmeniz gerekmez';

$lang['Disable_board'] = 'Forum Kapal�';
$lang['Disable_board_explain'] = '��lemler s�ras�nda mesaj panonuz a��k m� kals�n yoksa kapat�ls�n m�?';
$lang['Disable_board_explain_enabled'] = '��lemler bittikten sonra mesaj panonuz a��lacakt�r.';
$lang['Disable_board_explain_already'] = '<i>Mesaj panonuz zaten kapal�</i>';

$lang['Fast_mode'] = 'H�zl� Mod';
$lang['Fast_mode_explain'] = 'Bu se�enek, ilk girdileri silmeden b�t�n veritaban�n� g�zden ge�irecektir<br />UYARI! Etkileri i�in ilgili destek belgelerini inceleyiniz.';

$lang['Max_info'] = '(Max : %d)';

// Information strings
$lang['Info_processing_stopped'] = 'En son %s. mesajda kald�n�z. (%s tane biten mesaj) Tarih: %s';
$lang['Info_processing_aborted'] = 'En son %s. mesajda iptal ettiniz. (%s tane biten mesaj) Tarih: %s';
$lang['Info_processing_aborted_soon'] = 'Devam etmeden �nce bir s�re bekleyiniz...';
$lang['Info_processing_finished'] = '�al��ma sona erdi. (%s tane biten mesaj) Tarih: %s';
$lang['Info_processing_finished_new'] = '�al��ma sona erdi. (%s tane biten mesaj) Tarih: %s<br />fakat %s tane yeni mesaj g�nderildi';

// Progress screen
$lang['Rebuild_search_progress'] = 'Aramay� Yeniden Yap�land�rma Durumu';

$lang['Processed_post_ids'] = '��lemi tamamlanm�� mesajlar: %s - %s';
$lang['Timer_expired'] = '%s saniye ile zaman limiti a��ld�(expire)';
$lang['Cleared_search_tables'] = 'Arama tablolar� silindi. ';
$lang['Deleted_posts'] = '�al��ma yap�l�rken %s mesaj kullan�c�lar�n�z taraf�ndan silindi.';
$lang['Processing_next_posts'] = 'Bir sonraki %s mesaj �zerinde �al���yor. L�tfen bekleyiniz...';
$lang['All_session_posts_processed'] = 'Kullan�mdaki t�m mesajlar �zerinde de�i�iklik yap�ld�.';
$lang['All_posts_processed'] = 'T�m mesajlar ba�ar�l� bir �ekilde d�zenlendi.';
$lang['All_tables_optimized'] = 'T�m arama tablolar� ba�ar�l� bir �ekilde d�zenlendi.';

$lang['Processing_post_details'] = 'Detaylar';
$lang['Processed_posts'] = 'D�zenlenen Mesajlar';
$lang['Percent'] = 'Y�zdesi';
$lang['Current_session'] = 'Ge�ici Hesap';
$lang['Total'] = 'Toplam Hesap';

$lang['Process_details'] = '<b>%s</b> - <b>%s</b> aras�. (Toplam: <b>%s</b>)';
$lang['Percent_completed'] = '%s %% tamamland�';

$lang['Processing_time_details'] = 'Yeniden �n�a Zaman Detaylar�';
$lang['Processing_time'] = 'D�zenleme vakti';
$lang['Time_last_posts'] = 'Oturumun son %s mesaj�';
$lang['Time_from_the_beginning'] = 'Oturumun ba�lang�c�ndan beri';
$lang['Time_average'] = 'Ta��ma s�n�r�';
$lang['Time_estimated'] = 'Ge�erli oturum bitene kadar tahminen';

$lang['days'] = 'g�n';
$lang['hours'] = 'saat';
$lang['minutes'] = 'dakika';
$lang['seconds'] = 'saniye';

$lang['Database_size_details'] = 'Veritaban� B�y�kl�g�';
$lang['Size_current'] = '�u anda';
$lang['Size_estimated'] = 'Bitmeden �ncesi i�in';
$lang['Size_search_tables'] = 'Arama tablosu b�y�kl���';
$lang['Size_database'] = 'Veritaban� b�y�kl���';

$lang['Bytes'] = 'Bytes';

$lang['Active_parameters'] = '---';
$lang['Posts_last_cycle'] = 'Son ta��mada d�zenlenen mesajlar';
$lang['Board_status'] = 'Mesaj panosu durumu';
$lang['Board_disabled'] = 'Kapal�';
$lang['Board_enabled'] = 'A��k';

$lang['Info_estimated_values'] = '(*) Tahmini de�erler ge�ici ve yakla��k olarak hesaplanmaktad�r, amac� i�lem sonucu i�in size tahmini sonu�lar sunmakt�r! ��lemler sonunda kar��n�za ��kan sonu� ile tahminlerin uyu�mamas� ihtimali bulunmaktad�r...<br />Y�zdelik dilimlerin g�sterdi�i tahminlerin ger�ekle�me ihtimali ise �ok daha y�ksektir. �lginiz i�in te�ekk�rler.';
$lang['Click_return_rebuild_search'] = 'Yap�land�rma sayfas�na geri d�nmek i�in %sburaya%s t�klay�n';
$lang['Rebuild_search_aborted'] = '%s. mesajda �al��ma iptal edildi<br /><br />E�er �al��ma s�ras�nda i�lemi durdurmadan iptal ettiyseniz yeni bir yap�land�rmaya ba�lamadan �nce bir ka� dakika beklemelisiniz.';
$lang['Wrong_input'] = 'Yanl�� bir de�er girmi� bulunmaktas�n�z. L�tfen ilgili ayarlar� kontrol ediniz.';

// Buttons
$lang['Next'] = 'Sonra';
$lang['Processing'] = '�al���yor...';
$lang['Finished'] = 'Bitti';

?>