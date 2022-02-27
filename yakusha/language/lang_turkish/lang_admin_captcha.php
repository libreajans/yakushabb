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

$lang['VC_Captcha_Config']           = 'Görsel Doðrulama';
$lang['captcha_config_explain']      = 'Burada görsel onaylamada aktifleþtirilmiþ kayýt kodunun görünümünü belirleyebilirsiniz.';
$lang['VC_active']                   = 'Görsel Onaylama Aktif!'; 
$lang['VC_inactive']                 = 'Görsel Onaylama Aktif Deðil!';
$lang['background_configs']          = 'Arkaplan'; 
$lang['Click_return_captcha_config'] = 'Görsel doðrulama ayarlarýna dönmek için %sburaya%s týklayýnýz';

$lang['CAPTCHA_width']                  = 'Görsel doðrulama geniþliði';
$lang['CAPTCHA_height']                 = 'Görsel doðrulama yüksekliði';
$lang['background_color']               = 'Arkaplan Rengi'; 
$lang['background_color_explain']       = 'Hex Kodu (Örnek. Mavi için #0000FF).'; 
$lang['pre_letters']                    = 'Gölgeli harf sayýsý'; 
$lang['pre_letters_explain']            = ''; 
$lang['great_pre_letters']              = 'Harf gölgesi artýþý'; 
$lang['great_pre_letters_explain']      = ''; 
$lang['Random']                         = 'Rasgele'; 
$lang['random_font_per_letter']         = 'Her harf için rasgele yazýtipi.'; 
$lang['random_font_per_letter_explain'] = 'Her harf farklý bir yazýtipi kullanýr.'; 

$lang['back_chess']         = 'Dama Örneði'; 
$lang['back_chess_explain'] = 'Tüm arkaplaný 16 kare ile doldur.'; 
$lang['back_ellipses']      = 'Çemberler'; 
$lang['back_arcs']          = 'Eðimli çizgiler'; 
$lang['back_lines']         = 'Çizgiler'; 
$lang['back_image']         = 'Arkaplan resimi'; 
$lang['back_image_explain'] = '(Bu fonksiyon entegre edilmemiþ)'; 

$lang['foreground_lattice']               = 'Önplan Kafesi'; 
$lang['foreground_lattice_explain']       = '(geniþlik x yükseklik)<br />Görsel doðrulama üzerine beyaz bir kafes oluþtur';
$lang['foreground_lattice_color']         = 'Kafes rengi'; 
$lang['foreground_lattice_color_explain'] = $lang['background_color_explain']; 
$lang['gammacorrect']                     = 'Karþýtlýk Düzenle'; 
$lang['gammacorrect_explain']             = '(0 = kapalý)<br />UYARI! Deðerdeki deðiþiklikler direkt olarak görsel doðrulama okunabilirliðini etkiler.';
$lang['generate_jpeg']                    = 'Resim tipi';
$lang['generate_jpeg_explain']            = 'JPEG formatý png ve diðerlerinden daha yüksek bir sýkýþtýrma oranýna sahiptir. Bu görsel doðrulama okunuþunu direkt olarak etkiler.';
$lang['generate_jpeg_quality']            = 'Kalite'; 
?>