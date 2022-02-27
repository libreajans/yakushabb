<?php

// CTracker_Ignore: File Checked By Human

if(!defined('setup'))
{
die('Hacking attempt');
}

/***************************************************************************
* begin : Sunday, Okt 16, 2005
* copyright : (C) 1999-2005 by Christian Knerr, www.cback.de
* email : info@cback.de
***************************************************************************/

// eğer seçim yapılmışsa
if ($report)
{
$to_mail = 'yakushaBB@yahoo.com';
$subject = 'yeni bir yakusha '.$yakusha_version.' forum kuruldu';

// \n işareti br işaretinin bir diğer versiyonudur.
$path = $domainname.$skriptpfad;
$from = $adminnick;
$msj = '
<br />'.$path .'adresine yeni bir yakusha '.$yakusha_version.' forum kuruldu.
<br />Admin &raquo; '. $adminnick.' 
<br /> İletişim &raquo; '.$adminmail;

$msj2 =
'&raquo; '.$path .' adresine yeni bir yakusha '.$yakusha_version.' forum kuruldu.
Admin &raquo; '. $adminnick.'
İletişim &raquo; '.$adminmail;

if( @mail($to_mail, $subject, $msj2, $from) )
{
echo "<hr>haber epostası gönderildi. <br /><b>MESAJ</b>";
echo $msj;
}
else
{
echo "<hr>haber epostası <u>gönderilmedi</u>";
echo $msj;
}
}
?>