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


if (!defined('DOSYA_AYAR')) include '../../ayar.php';


//	ÇEREZ BİLGİLERİ YOKSA KULLANICI GİRİŞ SAYFASINA YÖNLENDİRİLİYOR	//

if ( (empty($_COOKIE['kullanici_kimlik'])) OR ($_COOKIE['kullanici_kimlik'] == '') OR
	(empty($_COOKIE['yonetim_kimlik'])) OR ($_COOKIE['yonetim_kimlik'] == '') )
{
	if (isset($_SERVER['REQUEST_URI']))
	{
		if ( (preg_match('/ip_yonetimi.php\?/', $_SERVER['REQUEST_URI']))
		OR (preg_match('/eklentiler.php\?/', $_SERVER['REQUEST_URI'])) )
			$git = '?git='.@str_replace('&', 'veisareti', $_SERVER['REQUEST_URI']);

		else $git = '';
	}
	else $git = '';

	header('Location: giris.php'.$git);
	exit();
}


//	ÇEREZ BİLGİSİ VARSA VERİTABANINDA İLE KARŞILAŞTIRILIYOR	//

elseif ((isset($_COOKIE['kullanici_kimlik'])) AND (isset($_COOKIE['yonetim_kimlik'])))
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';

	$_COOKIE['yonetim_kimlik'] = @zkTemizle4($_COOKIE['yonetim_kimlik']);
	$_COOKIE['yonetim_kimlik'] = @zkTemizle($_COOKIE['yonetim_kimlik']);
	$_COOKIE['kullanici_kimlik'] = @zkTemizle4($_COOKIE['kullanici_kimlik']);
	$_COOKIE['kullanici_kimlik'] = @zkTemizle($_COOKIE['kullanici_kimlik']);


	// çerez geçerlilik süresi
	if ($ayarlar['k_cerez_zaman'] > 86400) $k_cerez_zaman = 86400;
	else $k_cerez_zaman = $ayarlar['k_cerez_zaman'];


	$vtsorgu = "SELECT id,yonetim_kimlik,kullanici_kimlik,yetki,son_hareket,kul_ip FROM $tablo_kullanicilar WHERE yonetim_kimlik='$_COOKIE[yonetim_kimlik]' AND kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir = $vt->fetch_array($vtsonuc);


	//  KULLANICI VEYA YÖNETİM KİMLİK UYUŞMUYORSA VEYA IP ADRESİ DEĞİŞMİŞSE  //
	//  VEYA ÇEREZ BİR GÜNDEN ESKİYSE ÇEREZ TEMİZLENİYOR  //
	//  VE GİRİŞ SAYFASINA YÖNLENDİRİLİYOR  //

	if(!$vt->num_rows($vtsonuc))
	{
		setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
		header('Location: giris.php');
		exit();
	}

	elseif ( ($satir['kullanici_kimlik'] != $_COOKIE['kullanici_kimlik']) OR
			($satir['yonetim_kimlik'] != $_COOKIE['yonetim_kimlik']) OR
			(($satir['son_hareket'] + $k_cerez_zaman) < time()) )
	{
		setcookie('kullanici_kimlik','',0, $cerez_dizin, $cerez_alanadi);
		setcookie('yonetim_kimlik','',0, $cerez_dizin, $cerez_alanadi);

		header('Location: giris.php');
		exit();
	}

	elseif ($satir['yetki'] != 1)
	{
		header('Location: hata.php?hata=144');
		exit();
	}
}


else
{
	if (isset($_SERVER['REQUEST_URI']))
	{
		if ( (preg_match('/ip_yonetimi.php\?/', $_SERVER['REQUEST_URI']))
		OR (preg_match('/eklentiler.php/', $_SERVER['REQUEST_URI'])) )
			$git = '?git='.@str_replace('&', 'veisareti', $_SERVER['REQUEST_URI']);

		else $git = '';
	}
	else $git = '';

	header('Location: giris.php'.$git);
	exit();
}


// yönetim oturum kodu
if ($satir != 0)
{
	$yo = $satir['kullanici_kimlik'];
	$yo = $yo[3].$yo[6].$yo[8].$yo[10].$yo[13].$yo[17].$yo[19].$yo[25].$yo[30].$yo[33];
}

else $yo = 0;

define('DOSYA_YONETIM_GUVENLIK',true);


// Yönetim Dil dosyası yükleniyor
if (!defined('DOSYA_YONETIM_DIL'))  include_once('diller/index.php');
?>