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


if (!defined('DOSYA_AYAR')) include 'ayar.php';


//	ÇEREZ BİLGİSİ YOKSA KULLANICI UYARI SAYFASINA YÖNLENDİRİLİYOR	//

if ((empty($_COOKIE['kullanici_kimlik'])) OR ($_COOKIE['kullanici_kimlik'] == ''))
{
	if (isset($_GET['cikiss']))
	{
		header('Location: index.php');
		exit();
	}

	else
	{
		if (is_array($_SERVER['REQUEST_URI'])) $_SERVER['REQUEST_URI'] = '';
		$git = @str_replace('&', 'veisareti', $_SERVER['REQUEST_URI']);

		header('Location: hata.php?uyari=6&git='.$git);
		exit();
	}
}


//	ÇEREZ BİLGİSİ VARSA VERİTABANINDAKİ İLE KARŞILAŞTIRILIYOR	//

elseif (isset($_COOKIE['kullanici_kimlik']))
{
	if (!defined('DOSYA_GERECLER')) include 'gerecler.php';

	$_COOKIE['kullanici_kimlik'] = zkTemizle4($_COOKIE['kullanici_kimlik']);
	$_COOKIE['kullanici_kimlik'] = zkTemizle($_COOKIE['kullanici_kimlik']);

	$vtsorgu = "SELECT kullanici_kimlik,son_hareket,kul_ip FROM $tablo_kullanicilar
			WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir = $vt->fetch_assoc($vtsonuc);


	//  KULLANICI KİMLİK UYUŞMUYORSA VEYA IP ADRESİ DEĞİŞMİŞSE  //
	//  VEYA ÇEREZ SÜRESİ DOLMUŞSA ÇEREZ TEMİZLENİYOR  //
	//  VE GİRİŞ SAYFASINA YÖNLENDİRİLİYOR  //

	if (!$vt->num_rows($vtsonuc))
	{
		setcookie('kullanici_kimlik','',0, $cerez_dizin, $cerez_alanadi);
		setcookie('yonetim_kimlik','',0, $cerez_dizin, $cerez_alanadi);
		header('Location: giris.php');
		exit();
	}

	elseif ( ($satir['kullanici_kimlik'] != $_COOKIE['kullanici_kimlik']) OR
			(($satir['son_hareket'] + $ayarlar['k_cerez_zaman']) < time()) )
	{
		setcookie('kullanici_kimlik','',0, $cerez_dizin, $cerez_alanadi);
		setcookie('yonetim_kimlik','',0, $cerez_dizin, $cerez_alanadi);
		header('Location: giris.php');
		exit();
	}
}


else
{
	header('Location: hata.php?uyari=6');
	exit();
}


unset($satir);
define('DOSYA_GUVENLIK',true);
?>