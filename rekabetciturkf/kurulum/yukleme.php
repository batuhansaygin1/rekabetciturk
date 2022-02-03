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
@ini_set('magic_quotes_runtime', 0);




		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - BAŞI	//

if ( (isset($_POST['vt_yukleme'])) AND ($_POST['vt_yukleme'] == 'vt_yukleme') ):

if ( (empty($_POST['vt_sunucu'])) OR (empty($_POST['vt_adi'])) )
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Veritabanı kullanıcı adı ve şifresi hariç tüm alanların doldurulması zorunludur!'.$vt_hata_tablo[2];
	exit();
}


//	DOSYA YÜKLEMEDE HATA OLURSA - DOSYA ÇOK BÜYÜKSE	//

if ( (isset($_FILES['vtyukle']['error'])) AND ($_FILES['vtyukle']['error'] != 0) )
{
	echo '<h2>hata_iletisi= Dosya Yüklenemedi, Dosya adı alınamadı !<p>Bunun nedeni dosyanın 2mb.`dan büyük olması ya da<br />dosya adının kabul edilmeyen karakterler içermesi olabilir. <p>Yedeği tablo tablo ayrı dosyalara bölmeyi deneyin veya dosya adını değiştirmeyi deneyin.</h2>'.$_FILES['vtyukle']['tmp_name'].' - '.$_FILES['vtyukle']['error'];
	exit();
}


//	DOSYA 5`MB. DAN BÜYÜKSE	//
if ( (isset($_FILES['vtyukle']['tmp_name'])) AND ($_FILES['vtyukle']['tmp_name'] != '') )
{
	if ($_FILES['vtyukle']['size'] > 5242880)
	{
		echo '<h2>hata_iletisi= 5mb.`dan büyük yedek yükleyemezsiniz. <br />Yedeği tablo tablo ayrı dosyalara bölmeyi deneyin.</h2>';
		exit();
	}
}


$ayir = explode(".", strtolower($_FILES['vtyukle']['name']));
$uzanti = end($ayir);


//	DOSYA SIKIŞTIRILMIŞ MI BAKILIYOR	//

if ($uzanti == 'gz'):

	if(extension_loaded('zlib'))
	{
		$gzipdosya01 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac01 = gzread( $gzipdosya01, 9921920 );
		gzclose($gzipdosya01);

		//	çift sıkıştırılımış olma olasılığına karşı tekrar açılıyor
		$yeni_gzipdosya = fopen($_FILES['vtyukle']['tmp_name'], 'w') or die ("Dosya açılamıyor!");
		fwrite($yeni_gzipdosya, $gzipac01);
		fclose($yeni_gzipdosya);

		$gzipdosya02 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac02 = gzread( $gzipdosya02, 9921920 );
		gzclose($gzipdosya02);

		$ac = $gzipac02;
	}
	else echo '<h2>hata_iletisi= Sunucunuz sıkıştırılmış dosya yüklemesini desteklemiyor!</h2>';


//	DOSYA .SQL UZANTILI DEĞİLSE	//

elseif ($uzanti != 'sql'):
	echo '<h2>hata_iletisi= Sadece .sql ve .gz uzantılı dosyalar yüklenebilir.</h2>';
	exit();


//	TEMP'TEKİ DOSYANIN İÇİNDEKİLER DEĞİŞKENE AKTARILIYOR	//

else:
$dosya = @fopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
$boyut = filesize($_FILES['vtyukle']['tmp_name']);
$ac = @fread( $dosya, $boyut );
endif;



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




// dosyadaki veriler satır satır dizi değişkene aktarılıyor //
$toplam = explode(";\n\n", $ac);

// satır sayısı alınıyor //
$toplam_sayi = count($toplam);

// dizideki satırlar döngüye sokuluyor //
for ($satir=0;$satir<$toplam_sayi;$satir++)
{
	// 9 karakterden kısa dizi elemanları diziden atılıyor	//
	if (strlen($toplam[$satir]) > 9)
	{
		// yorumlar diziden atılıyor //
		if (preg_match("/\n\n--/", $toplam[$satir]))
		{
			$yorum = explode("\n\n", $toplam[$satir]);
			$yorum_sayi = count($yorum);

			for ($satir2=0;$satir2<$yorum_sayi;$satir2++)
			{
				if ( (strlen($yorum[$satir2]) > 9) AND (!preg_match("/--/", $yorum[$satir2])) )
				// sorgu veritabanına giriliyor //
				$vtsorgu = $vt->query($yorum[$satir2]) or die ($vt_hata_tablo[0].'Sorgu Başarısız'.$vt_hata_tablo[1].$vt->error().$vt_hata_tablo[2]);
			}
		}

		else // sorgu veritabanına giziliyor //
		$vtsorgu = $vt->query($toplam[$satir]) or die ($vt_hata_tablo[0].'Sorgu Başarısız'.$vt_hata_tablo[1].$vt->error().$vt_hata_tablo[2]);
	}
}


//	VERİTABANI YEDEĞİ YÜKLENDİ MESAJI	//

@setcookie('kullanici_kimlik', '', 0, '/', $_SERVER['HTTP_HOST']);
@setcookie('yonetim_kimlik', '', 0, '/', $_SERVER['HTTP_HOST']);
echo $vt_hata_tablo[0].'- Yükleme Başarılı -'.$vt_hata_tablo[1].'<br /><center><b>Veritabanı yedeğiniz başarıyla geri yüklenmiştir.</b></center>'.$vt_hata_tablo[2];
exit();

		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - SONU	//







else:

//  SAYFA BAŞI   //

echo '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="sablon.css" rel="stylesheet" type="text/css" />
<title>'.$lk[73].'</title>
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
	for (var i=0; i<6; i++)
	{
		if (document.vtyukleme.elements[i].name == "vt_kullanici") continue;
		else if (document.vtyukleme.elements[i].name == "vt_sifre") continue;
		else if (document.vtyukleme.elements[i].value=="")
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

	<td width="85" align="center" valign="middle" bgcolor="#f8f8f8" style="border-top: 1px solid #d0d0d0; border-left: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0;">
<b>'.$lk[71].'</b>
	</td>

	<td width="80" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="sil.php"><b>'.$lk[72].'</b></a>
	</td>

	<td bgcolor="#f9f9f9">&nbsp;</td>
	</tr>
</tbody>
</table>



<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
	<tr>
	<td align="center">

<form name="vtyukleme" action="yukleme.php" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="vt_yukleme" value="vt_yukleme" />


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
'.$lk[73].'
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<br />
&nbsp; '.$lk[79].'<br /><br /><br />';


if (!ini_get('file_uploads')) echo '&nbsp; <b>'.$lk[74].'</b><p>';
echo '&nbsp; <b>'.$lk[75].': </b>'.ini_get('upload_max_filesize').
'<br />&nbsp; <b>'.$lk[76].':</b> '.ini_get('post_max_size').
'<br />&nbsp; <b>'.$lk[77].':</b> '.ini_get('max_input_time').$lk[83].'
<br />&nbsp; <b>'.$lk[78].':</b> '.ini_get('max_execution_time').$lk[83];


echo '<br /><br /><br />
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
'.$lk[80].'
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
<br />'.$lk[81].'<br />
<font size="1" style="font-weight: normal">
'.$lk[82].'
</font><br /><br />
	</td>

	<td align="left">
<input name="vtyukle" type="file" size="30" required />
	</td>
	</tr>
</table>

<script type="text/javascript">
//<![CDATA[
<!-- //
//document.vtyukleme.vt_kullanici.setAttribute("autocomplete","off");
document.vtyukleme.vt_sifre.setAttribute("autocomplete","off");
//  -->
//]]>
</script>

	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="center" valign="middle" height="50">
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input class="dugme" type="submit" value="Yedeği Yükle" />
	</td>
	</tr>


</table>
</td></tr></table>
</td></tr>
	<tr>
	<td height="17" ></td>
	</tr>
</table>
</form>
</td></tr></table>';



$yil = @gmdate('Y');

echo '<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
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

endif;

?>