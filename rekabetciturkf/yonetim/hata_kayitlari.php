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


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if (isset($_GET['sil']))
{
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}
}



$sayfa_adi = 'Yönetim Hata Kayıtları';
$tema_sayfa_baslik = 'Hata Kayıtları';


$dosya_vt = '../bilesenler/log/veritabani.log.php';
$dosya_vty = 'bilesenler/log/veritabani.log.php';
$dosya_php = '../bilesenler/log/php.log.php';
$dosya_phpy = 'bilesenler/log/php.log.php';
$dosya_phpp = '../portal/bilesenler/log/php.log.php';



// Dosya Okuma Fonksiyonu
function DosyaOku($dosya)
{
	if (!($dosya_ac = @fopen($dosya, 'r')))
		return('Dosyası Açılamıyor: '.$dosya.'');

	else
	{
		$boyut = @filesize($dosya);
		$dosya_metni = @fread($dosya_ac, $boyut);
		@fclose($dosya_ac);
		$dosya_metni = @str_replace("<?php if (!defined('PHPKF_ICINDEN')) exit(); ?>", '', $dosya_metni);
		return $dosya_metni;
	}
}



// Dosya Silme Fonksiyonu
function DosyaSil($dosya)
{
	if (!($dosya_ac = @fopen($dosya, 'w'))) return false;

	else
	{
		$yolla = "<?php if (!defined('PHPKF_ICINDEN')) exit(); ?>\r\n";
		@flock($dosya_ac, 2);
		@fwrite($dosya_ac, $yolla);
		@flock($dosya_ac, 3);
		@fclose($dosya_ac);
		return true;
	}
}



// Dosya Silme İşlemleri
if ( (isset($_GET['sil'])) AND ($_GET['sil'] != '') )
{
	$sil = $_GET['sil'];

	if ($sil == 'vt')
	{
		if (!DosyaSil($dosya_vt))
		{
			echo 'Dosya Silinemedi: '.$dosya_vt;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=vt');
	}

	elseif ($sil == 'vty')
	{
		if (!DosyaSil($dosya_vty))
		{
			echo 'Dosya Silinemedi: '.$dosya_vty;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=vty');
	}

	elseif ($sil == 'php')
	{
		if (!DosyaSil($dosya_php))
		{
			echo 'Dosya Silinemedi: '.$dosya_php;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=php');
	}

	elseif ($sil == 'phpy')
	{
		if (!DosyaSil($dosya_phpy))
		{
			echo 'Dosya Silinemedi: '.$dosya_phpy;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=phpy');
	}

	elseif ($sil == 'phpp')
	{
		if (!DosyaSil($dosya_phpp))
		{
			echo 'Dosya Silinemedi: '.$dosya_phpp;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=phpp');
	}

	else header('Location: hata_kayitlari.php');

	exit();
}




//  SAYFA GÖSTERİMİ - BAŞI  //

$tema_sayfa_icerik = '<ul style="padding:0 20px">
<li style="margin-bottom:10px">
<a href="hata_kayitlari.php?kip=vt">Veritabanı Hataları (Normal)</a>
&nbsp;&nbsp;<a href="hata_kayitlari.php?sil=vt&amp;yo='.$yo.'">[sil]</a>
</li>

<li style="margin-bottom:25px">
<a href="hata_kayitlari.php?kip=vty">Veritabanı Hataları (Yönetim)</a>
&nbsp;&nbsp;<a href="hata_kayitlari.php?sil=vty&amp;yo='.$yo.'">[sil]</a>
</li>

<li style="margin-bottom:10px">
<a href="hata_kayitlari.php?kip=php">PHP Hataları (Normal)</a>
&nbsp;&nbsp;<a href="hata_kayitlari.php?sil=php&amp;yo='.$yo.'">[sil]</a>
</li>

<li style="margin-bottom:10px">
<a href="hata_kayitlari.php?kip=phpy">PHP Hataları (Yönetim)</a>
&nbsp;&nbsp;<a href="hata_kayitlari.php?sil=phpy&amp;yo='.$yo.'">[sil]</a>
</li>';

if ($portal_kullan == 1) $tema_sayfa_icerik .= '<li><a href="hata_kayitlari.php?kip=phpp">PHP Hataları (Portal)</a>
&nbsp;&nbsp;<a href="hata_kayitlari.php?sil=phpp&amp;yo='.$yo.'">[sil]</a>
</li>';

$tema_sayfa_icerik .= '</ul>';



if ( (isset($_GET['kip'])) AND ($_GET['kip'] != '') )
{
	$kip = $_GET['kip'];
	$tema_sayfa_icerik .= '<br><b style="color:#666666;">';
	$hata_cikti = '<textarea class="formlar" wrap="off" style="width:97%; height:400px; margin-top:3px;overflow:auto" placeholder="Hiçbir hata kaydı yok." readonly="readonly">';


	if ($kip == 'vt')
	{
		$tema_sayfa_icerik .= 'Veritabanı Hataları (Normal)';
		$hata_cikti .= DosyaOku($dosya_vt);
	}

	elseif ($kip == 'vty')
	{
		$tema_sayfa_icerik .= 'Veritabanı Hataları (Yönetim)';
		$hata_cikti .= DosyaOku($dosya_vty);
	}

	elseif ($kip == 'php')
	{
		$tema_sayfa_icerik .= 'Tüm php Hataları (Normal)';
		$hata_cikti .= DosyaOku($dosya_php);
	}

	elseif ($kip == 'phpy')
	{
		$tema_sayfa_icerik .= 'Tüm php Hataları (Yönetim)';
		$hata_cikti .= DosyaOku($dosya_phpy);
	}

	elseif ($kip == 'phpp')
	{
		$tema_sayfa_icerik .= 'Tüm php Hataları (Portal)';
		$hata_cikti .= DosyaOku($dosya_phpp);
	}

	else
	{
		$hata_cikti = '';
	}

	$tema_sayfa_icerik .= '</b><br>';
	$hata_cikti .= '</textarea>';
}
else
{
	$hata_cikti = '';
}



$tema_sayfa_icerik .= $hata_cikti;




//	TEMA UYGULANIYOR	//
include_once('bilesenler/sayfa_baslik.php');

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/varsayilan.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));

eval(TEMA_UYGULA);
?>