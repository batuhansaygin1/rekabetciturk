<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);
if (!defined('DOSYA_DIL')) include_once('diller/index.php');
header("Content-type: text/html; charset=utf-8");



//	VERİTABANINDAKİ FORUM TABLOLARI SİLİNİYOR	//

if ( (isset($_POST['kurulum'])) AND ($_POST['kurulum'] = 'forum_sil') )
{
	if ( (empty($_POST['vt_sunucu'])) OR (empty($_POST['vt_adi'])) OR (empty($_POST['tablo_onek'])) )
	{
		echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Veritabanı kullanıcı adı ve şifresi hariç tüm alanların doldurulması zorunludur!'.$vt_hata_tablo[2];
		exit();
	}

	if (!preg_match('/^[a-zA-Z]\w{0,10}+$/', $_POST['tablo_onek']))
	{
		echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Veritabanı tablo öneki sadece harf ile başlamalı ve 10 karakterden uzun olmamalıdır.'.$vt_hata_tablo[2];
		exit();
	}


	if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);


	function zkTemizle($metin)
	{
		$donen = urldecode($metin);
		$donen = str_replace('>','',$donen);
		$donen = str_replace('<','',$donen);
		$donen = str_replace("'",'',$donen);
		$donen = str_replace('\\','',$donen);
		$donen = str_replace('"','',$donen);
		return $donen;
	}


	$vt_sunucu = zkTemizle($_POST['vt_sunucu']);
	$vt_adi = zkTemizle($_POST['vt_adi']);
	$vt_kullanici = zkTemizle($_POST['vt_kullanici']);
	$vt_sifre = zkTemizle($_POST['vt_sifre']);
	$vtsecim = zkTemizle($_POST['vt_tip']);


	// Veritabanı sınıf dosyası yükleniyor
	if(!@include_once('../bilesenler/veritabani/'.$vtsecim.'.php'))
	{
		echo $vt_hata_tablo[0].'Veritabanı Dosyası Bulunamıyor!'.$vt_hata_tablo[1].'/bilesenler/veritabani/'.$vtsecim.'.php dosyası bulunamıyor!<br /><br />Veritabanı Tipi seçimi hatalı veya veritabanı dosyası silinmiş veya eksik.'.$vt_hata_tablo[2];
		exit();
	}



	//  Veritabanı ile bağlantı kuruluyor
	$vt = new sinif_vt();
	$vt->baglan($vt_sunucu, $vt_kullanici, $vt_sifre);

	//  veritabanı seçiliyor
	if ($vt->hata_cikti == '') $veri_tabani = $vt->sec($vt_adi);
	else $veri_tabani = false;



	// Hata iletileri
	if ( (!$vt) OR (!$veri_tabani) )
	{
		if ( (preg_match("|Can\'t connect to MySQL server|si", $vt->hata_cikti))
			OR (preg_match("|Unknown MySQL server|si", $vt->hata_cikti))
			OR (preg_match("|php_network_getaddresses|si", $vt->hata_cikti)) )
			echo $vt_hata_tablo[0].'Veritabanı sunucusu ile bağlantı kurulamıyor !'.$vt_hata_tablo[1].'Girdiğiniz veritabanı adresini kontrol edip tekrar deneyin.<br><br>
			<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

		elseif (preg_match("|Access denied for user|si", $vt->hata_cikti))
			echo $vt_hata_tablo[0].'Hatalı kullanıcı adı veya şifre !'.$vt_hata_tablo[1].'Girdiğiniz veritabanı kullanıcı adı ve şifresini kontrol edip tekrar deneyin.<br><br>
			<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

		elseif (preg_match("|Unknown database|si", $vt->hata_cikti))
			echo $vt_hata_tablo[0].'Veritabanı açılamıyor !'.$vt_hata_tablo[1].'Veritabanı adını doğru yazdığınızdan emin olun.<br><br>
			<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

		else echo $vt_hata_tablo[0].'Veritabanı ile bağlantı kurulamıyor !'.$vt_hata_tablo[1].'Veritabanı sunucu adresi, kullanıcı adı ve şifre bilgilerinizi tekrar girin.<br><br>
			<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

		die();
	}


	// Tablolar siliniyor
	$vtsorgu = "SHOW TABLE STATUS LIKE '$_POST[tablo_onek]%'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($silinen = $vt->fetch_assoc($vtsonuc))
	{
		$vtsorgu = "DROP TABLE $silinen[Name]";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	echo $vt_hata_tablo[0].'- Silme İşlemi Başarılı -'.$vt_hata_tablo[1].'<br /><center><b>Veritabanındaki phpKF tabloları silinmiştir.</b><br /><br /></center>'.$vt_hata_tablo[2];
	exit();
}


//  SAYFA BAŞI   //

echo '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="sablon.css" rel="stylesheet" type="text/css" />
<title>'.$lk[53].'</title>
</head>
<body>
<div class="ana_govde" style="margin:0 auto; width:100%; max-width:770px">


<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
<tbody>
	<tr>
	<td class="liste-veri" bgcolor="#f9f9f9" colspan="5" height="50" valign="middle">

'.$TEMA_DIL_SECIM.'

<script type="text/javascript">
//<![CDATA[
<!-- 
function denetle()
{
	var dogruMu = true;
	for (var i=0; i<7; i++)
	{
		if (document.silme_formu.elements[i].name == "vt_kullanici") continue;
		else if (document.silme_formu.elements[i].name == "vt_sifre") continue;
		else if (document.silme_formu.elements[i].value=="")
		{
			dogruMu = false; 
			alert("'.$lk[54].'");
			break;
		}
	}
	return dogruMu;
}
//  -->
//]]>
</script>
	<td>
	<tr>

	<tr class="liste-veri">
	<td width="85" height="27" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="index.php"><b>'.$lk[69].'</b></a>
	</td>

	<td width="95" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="guncelle.php"><b>'.$lk[70].'</b></a>
	</td>

	<td width="85" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="yukleme.php"><b>'.$lk[71].'</b></a>
	</td>

	<td width="80" align="center" valign="middle" bgcolor="#f8f8f8" style="border-top: 1px solid #d0d0d0; border-left: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0;">
<b>'.$lk[72].'</b>
	</td>

	<td bgcolor="#f9f9f9">&nbsp;</td>
	</tr>
</tbody>
</table>



<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
	<tr>
	<td align="center">

<form action="sil.php" method="post" onsubmit="return denetle()" name="silme_formu">
<input type="hidden" name="kurulum" value="forumu_sil" />

<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" class="tablo_border2">
	<tr>
	<td align="center" valign="top" height="17"></td>
	</tr>
	
	<tr>
	<td align="center" valign="top">

<table cellspacing="1" cellpadding="0" width="96%" border="0"  class="tablo_border3">
	<tr>
	<td>

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tr>
	<td class="baslik" colspan="2" align="center" height="45">
'.$lk[53].'
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<br />
'.$lk[55].'


<br /><br /><br />
<font size="1">
<i>&nbsp;&nbsp; &nbsp; '.$lk[56].'</i>
</font>
	</td>
	</tr>

	<tr>
	<td>


<table cellspacing="1" width="96%" cellpadding="5" border="0" align="center" bgcolor="#d0d0d0">
	<tr>
	<td colspan="2" class="site_baslik" align="center" style="height: 14px;">
'.$lk[57].'
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$lk[58].'<br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sunucu" size="40" maxlength="100" value="localhost" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$lk[84].'<br />
<font size="1" style="font-weight: normal">
'.$lk[85].'
</font><br /><br />
	</td>

	<td align="left">
<select class="formlar" name="vt_tip">
'.$veritabanlari.'
</select>
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$lk[59].'<br />
<font size="1" style="font-weight: normal">
'.$lk[60].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_adi" size="40" maxlength="100" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$lk[61].'<br />
<font size="1" style="font-weight: normal">
'.$lk[62].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_kullanici" size="40" maxlength="100" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$lk[63].'<br />
<font size="1" style="font-weight: normal">
'.$lk[64].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sifre" size="40" maxlength="100" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$lk[65].'<br />
<font size="1" style="font-weight: normal">
'.$lk[66].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="tablo_onek" size="40" maxlength="20" value="phpkf_" required />
	</td>
	</tr>
</table>

<script type="text/javascript">
//<![CDATA[
<!-- //
document.silme_formu.vt_kullanici.setAttribute("autocomplete","off");
document.silme_formu.vt_sifre.setAttribute("autocomplete","off");
//  -->
//]]>
</script>

	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="center" valign="middle" height="50">
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input class="dugme" type="submit" value="'.$lk[67].'" />
	</td>
	</tr>


</table>
</td></tr></table>

	</td>
	</tr>

	<tr>
	<td height="17" ></td>
	</tr>

</table>
</form>
</td></tr></table>';



$yil = @gmdate('Y');

echo '
<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
	<tbody>
	<tr>
	<td height="25"></td>
	</tr>

	<tr>
	<td align="center" valign="bottom" class="liste-veri">
<div style="font-family: Verdana, Tahoma, helvetica; font-size:11px; color:#000000; position:relative; z-index:1001; text-align:center; float:left; width:100%; height:35px;">
<br /><a href="http://www.phpkf.com" target="_blank" style="text-decoration:none"><b>php Kolay Forum (phpKF) &copy; 2007 - '.@$yil.'</b></a>
</div>
</td></tr></tbody></table>
<br />

</div>
</body>
</html>';
?>