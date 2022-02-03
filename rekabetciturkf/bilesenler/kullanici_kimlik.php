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

if (!defined('DOSYA_KULLANICI_KIMLIK')) define('DOSYA_KULLANICI_KIMLIK',true);


//	KULLANICI TANINIYOR	//

if ((isset($_COOKIE['kullanici_kimlik'])) AND ($_COOKIE['kullanici_kimlik'] != ''))
{
	if (!defined('DOSYA_GERECLER')) include 'gerecler.php';

	$_COOKIE['kullanici_kimlik'] = zkTemizle4($_COOKIE['kullanici_kimlik']);
	$_COOKIE['kullanici_kimlik'] = zkTemizle($_COOKIE['kullanici_kimlik']);

	$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kullanici_kim = $vt->fetch_assoc($vtsonuc);


	if (!$vt->num_rows($vtsonuc)) $kullanici_kim = 0;

	else
	{
		//  IP ADRESİ DEĞİŞMİŞSE VEYA ÇEREZ SÜRESİ DOLMUŞSA  //
		//  ÇEREZ TEMİZLENİYOR VE KİMLİK BİLGİSİ SİLİNİYOR  //

		if (($kullanici_kim['son_hareket'] + $ayarlar['k_cerez_zaman']) < time())
		{
			setcookie('kullanici_kimlik','',0, $cerez_dizin, $cerez_alanadi);
			setcookie('yonetim_kimlik','',0, $cerez_dizin, $cerez_alanadi);

			$vtsorgu = "UPDATE $tablo_kullanicilar SET kullanici_kimlik='', yonetim_kimlik='' WHERE id='$kullanici_kim[id]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$kullanici_kim = false;
		}
	}
}

else $kullanici_kim = false;



// oturum kodu
if ($kullanici_kim)
{
	$o = $kullanici_kim['kullanici_kimlik'];
	$o = $o[3].$o[6].$o[8].$o[10].$o[13].$o[17].$o[19].$o[25].$o[30].$o[33];

	// Bazı veriler siliniyor
	$kullanici_kim['kullanici_kimlik'] = '';
	$kullanici_kim['yonetim_kimlik'] = '';
	$kullanici_kim['kul_etkin_kod'] = '';
	$kullanici_kim['yeni_sifre'] = '';
	$kullanici_kim['sifre'] = '';

	$TEMA_UYE_BILGI = $kullanici_kim;
}

else
{
	$o = 0;
	$TEMA_UYE_BILGI = false;
}
?>