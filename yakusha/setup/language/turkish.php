<?php
/***************************************************************************
* copyright : (C) 1999-2005 by Christian Knerr, www.cback.de
***************************************************************************/
if(!defined('setup'))
{
	die('Hacking attempt');
}

$langu['welcome'] 		= 'yakusha ' . $yakusha_version . ' Kurulumu';
$langu['welcome_text'] 	= 'yakusha ' . $yakusha_version . '</b> pano sistemini seçtiğiniz için teşekkürler.
<p>Hızlı, güvenilir, tamamen Türkçe ve Türk işçiliği bir mesaj panosu sistemi ile karşınızda olmaktan gururluyuz.
<p>Otomatik kurulum aracı, pano kurulumunda size yardımcı olacaktır. Bu işlemden önce boş bir <b>MySQL veritabanı</b> oluşturmuş olmanız gerekmekte veya kurulum işlemini eski phpBB sistemi tablolarınız üzerine gerçekleştirebilirsiniz.';

$langu['imethod'] 		= 'Kurulum metodunu seçiniz';
$langu['convert'] 		= 'phpBB\'den dönüşüm';
$langu['install'] 		= 'Yeni kurulum';
$langu['imethod_text'] 	= 'Eğer, yakusha '. $yakusha_version .' sistemini yeni bir veritabanına ilk defa yükleyecekseniz <b>' . $langu['install'] . '</b> seçeneğini kullanınız.
<p>phpBB 2.0.19 veya üstü bir sürümden yakusha ' . $yakusha_version .' sürümüne geçmek için <b>' . $langu['convert'] . '</b> seçeneğini kullanınız.
<p><b>UYARI:</b> Dönüşüm işlemi orijinal phpBB bilgi ve ayarlarını koruyacaktır, fakat önceden yapılan modül eklemelerini, bunlara ait bilgi ve ayarları kaybedeceksiniz. Eğer dönüşüm yapmayı tercih ediyorsanız, güvenlik için lütfen veritabanınızın ve dosyalarınızın yedeğini alınız.';

$langu['destek'] 	= '<b><font color="green">Kurulumla ilgili teknik bilgiler ve yapılması gerekenler Yakusha Takımı tarafından hazırlanmış olan <u><a href="http://www.yakusha.net/destek/index.html" target="destek">destek belgelerinde</a></u> anlatılmaktadır. Mutlaka inceleyiniz!</font></b>';
$langu['ch_mods'] 	= 'CHMOD - Dosya İzinleri';
$langu['ch_modt'] 	= 'Kurulum sistemi, ilgili dosyaların izinlerinin kontrol ediyor. İlgili dosyaların ve klasörlerin izinleri CHMOD 777 ise hepsinin yanında "Tamam" ibaresi yer alacaktır, bu durumda kuruluma devam ediniz. Eğer CHMOD ayarları hatalı ise bir veya birden fazla satırda "Hatalı" ibaresi yer alıyor ise, FTP yazılımınız veya sunucunuzun sağladığı panelden ilgili dosya ve klasörlerin izinlerini CHMOD 777 veya rwx-rwx-rxw olarak ayarlamanız gerekmektedir.';
$langu['ch_ok'] 	= '<font color="green"><b>Tamam</b></font>';
$langu['ch_nok'] 	= '<font color="red"><b>Hatalı</b></font>';
$langu['ch_uok'] 	= '<font color="yellow"><b>boş</b></font>';
$langu['ok_btn'] 	= 'Devam';

$langu['installd'] 	= 'Kurulum ve Yönetim';
$langu['installd1'] = 'Kurulum için aşağıda istenen bilgileri doğru şekilde doldurmanız gerekmektedir.
<p><font color="red"><b>UYARI:</b></font> Öncelikli olarak boş bir database oluşturmuş olmanız gerekmektedir. Domain adınızı http:// ön eki ve sonlandırıcı \'/\' uzantısı <b>olmadan</b> girmeniz gerekmektedir.
<p>Bilgileri yanlış girerseniz, kurulum işlemi tamamlanamayacaktır.
<p>Kurulum yazılımı, gireceğiniz bilgileri kullanarak, kurulum değerlerini ve <b>config.php</b> dosyasınıdeğiştirilemeyecek şekilde oluşturacaktır.<br />Farklı bir tablo ön eki kullanabilirsiniz.';

$langu['field0a'] = 'Veritabanı tipi';
$langu['field0b'] = 'Tanımsız sürüm';

$langu['convert1'] 	= 'Çevirim';
$langu['convert2'] 	= 'Otomatik kurulum fonksiyonu phpBB sisteminizi yakusha ' . $yakusha_version . ' sistemine dönüştürecektir. Bu işlem için gerekli olan tüm bilgiler <b>config.php</b> dosyası tarafından sağlanacaktır.
Güvenliğiniz ve işlemin devam edebilmesi için veritabanı parolanızı doğrulamanız beklenmektedir.
<p>Eski <b>config.php</b> dosyasınızı yeni yakusha ' . $yakusha_version . ' forumunuza yükleyiniz.<p>
<font color="red"><b>UYARI:</b></font> Dönüşüm işleminden önce mutlaka eski dosyalarınızın ve eski Databese\'nizin bir yedeğini oluşturunuz.';
$langu['fieldC'] 	= 'MySQL parolanızı doğrulayınız';
$langu['fieldD'] 	= 'Kurulum yazılımı config.php dosyanızı bulamadı. Lütfen, eski forumunuzdan yedek aldığınız config.php dosyanızı yeni forum dosyalarınız arasına yükleyiniz. Eğer, ilgili dosyayı bulamazsanız, eski forum ayarlarınız üstüne kurulu olan bir config.php dosyası oluşturup yükleyiniz.';
$langu['fieldF'] 	= 'Güncelle';

$langu['field0'] = 'Database-Host';
$langu['field1'] = 'Database-Adı';
$langu['field2'] = 'MySQL-DB-Kullanıcı';
$langu['field3'] = 'MySQL-DB-Parola';
$langu['field4'] = 'Tablo Ön Eki';
$langu['field5'] = 'Domain-Adı';
$langu['field6'] = 'Forum Yolu';
$langu['field7'] = 'Server Port';
$langu['field8'] = 'Yönetici Adı';
$langu['field9'] = 'Yönetici E-posta';
$langu['fieldA'] = 'Yönetici Parola';
$langu['fieldB'] = 'Parola Doğrulama';

$langu['fieldE'] 		= 'Kurulumu Başlat';
$langu['err1'] 			= '<b>HATA:</b><p>Database bağlantısı kurulamadı. Tarayıcınızın <b>GERİ</b> düğmesine basarak değerleri kontrol ediniz.';
$langu['err2'] 			= '<b>HATA:</b><p>Database adı bulunamıyor. Tarayıcınızın <b>GERİ</b> düğmesine tıklayıp girdilerinizi kontrol ediniz.';
$langu['err3'] 			= '<b>PAROLA HATASI:</b><p>Parola doğrulama işlemi hatası. Tarayıcınızın <b>GERİ</b> düğmesine basarak tekrar deneyiniz.';
$langu['err4'] 			= '<b>Bütün değerleri doldurmadınız.</b><p>Tarayıcınızın <b>GERİ</b> düğmesine basarak, tekrar deneyiniz.';
$langu['running'] 		= '<center>Kurulum işlemi devam ediyor. Sayfa altında <b>DEVAM</b> linkini görene kadar bekleyiniz.<p>';
$langu['dbresponse1']	= '<b><font color="green">Database işlemleri bitti!</font></b>';
$langu['dbresponse2']	= '<b><font color="red">HATA</font></b>';

$langu['fertig'] = '<b>TEBRİKLER!</b>
<p><img src="images/yukle04.png">Kurulum işlemi tamamlanmıştır!
phpBB yakusha '.$yakusha_version.' forumunu tercih ettiğiniz için teşekkürler.
Forumunuza dönmeden bu klasörü <b>setup/</b> web alanınızdan siliniz!<p><b>UYARI!</b>
Yönetici hesabınız standart kurulum ile oluşturulmuş, ardından sizin girdiğiniz değerler doğrultusunda
yeniden düzenlenmiştir.<p><a href="../index.php">
<center>Forum ana sayfasına dönmek için tıklayınız</a> ';

$langu['cwrit'] = '<center>config.php oluşturulma işlemi tamamlanmıştır. Kurulum işleminden çıkmak için Bitir düğmesine tıklayınız.<br />
<p><p>';

$langu['cdol'] = '<b>config.php yükle</b><p>
<img src="images/config.png">
Kurulum scripti config.php dosyanızı otomatik olarak oluşturmuştur. Lütfen bu dosyayı bilgisayarınıza kaydedip forumunuzun
ana klasörünün (root) içine herhangi bir FTP programıyla yükleyiniz.<p>Bu klasör (index.php, viewtopic.php vs.)
dosyalarının içinde bulunduğu klösürdür. Bu İşlemden sonra <b>BİTİR</b>
düğmesine tıklayarak kurulum işlemini sonlandırınız.<p>';

$langu['dload'] 	= 'config.php dosyasını kaydet';
$langu['fstell'] 	= 'Bitir';

// EoF
?>