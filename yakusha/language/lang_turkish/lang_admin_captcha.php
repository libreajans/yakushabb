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

$lang['VC_Captcha_Config']           = 'G�rsel Do�rulama';
$lang['captcha_config_explain']      = 'Burada g�rsel onaylamada aktifle�tirilmi� kay�t kodunun g�r�n�m�n� belirleyebilirsiniz.';
$lang['VC_active']                   = 'G�rsel Onaylama Aktif!'; 
$lang['VC_inactive']                 = 'G�rsel Onaylama Aktif De�il!';
$lang['background_configs']          = 'Arkaplan'; 
$lang['Click_return_captcha_config'] = 'G�rsel do�rulama ayarlar�na d�nmek i�in %sburaya%s t�klay�n�z';

$lang['CAPTCHA_width']                  = 'G�rsel do�rulama geni�li�i';
$lang['CAPTCHA_height']                 = 'G�rsel do�rulama y�ksekli�i';
$lang['background_color']               = 'Arkaplan Rengi'; 
$lang['background_color_explain']       = 'Hex Kodu (�rnek. Mavi i�in #0000FF).'; 
$lang['pre_letters']                    = 'G�lgeli harf say�s�'; 
$lang['pre_letters_explain']            = ''; 
$lang['great_pre_letters']              = 'Harf g�lgesi art���'; 
$lang['great_pre_letters_explain']      = ''; 
$lang['Random']                         = 'Rasgele'; 
$lang['random_font_per_letter']         = 'Her harf i�in rasgele yaz�tipi.'; 
$lang['random_font_per_letter_explain'] = 'Her harf farkl� bir yaz�tipi kullan�r.'; 

$lang['back_chess']         = 'Dama �rne�i'; 
$lang['back_chess_explain'] = 'T�m arkaplan� 16 kare ile doldur.'; 
$lang['back_ellipses']      = '�emberler'; 
$lang['back_arcs']          = 'E�imli �izgiler'; 
$lang['back_lines']         = '�izgiler'; 
$lang['back_image']         = 'Arkaplan resimi'; 
$lang['back_image_explain'] = '(Bu fonksiyon entegre edilmemi�)'; 

$lang['foreground_lattice']               = '�nplan Kafesi'; 
$lang['foreground_lattice_explain']       = '(geni�lik x y�kseklik)<br />G�rsel do�rulama �zerine beyaz bir kafes olu�tur';
$lang['foreground_lattice_color']         = 'Kafes rengi'; 
$lang['foreground_lattice_color_explain'] = $lang['background_color_explain']; 
$lang['gammacorrect']                     = 'Kar��tl�k D�zenle'; 
$lang['gammacorrect_explain']             = '(0 = kapal�)<br />UYARI! De�erdeki de�i�iklikler direkt olarak g�rsel do�rulama okunabilirli�ini etkiler.';
$lang['generate_jpeg']                    = 'Resim tipi';
$lang['generate_jpeg_explain']            = 'JPEG format� png ve di�erlerinden daha y�ksek bir s�k��t�rma oran�na sahiptir. Bu g�rsel do�rulama okunu�unu direkt olarak etkiler.';
$lang['generate_jpeg_quality']            = 'Kalite'; 
?>