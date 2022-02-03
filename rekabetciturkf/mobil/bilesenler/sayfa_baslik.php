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


// Temayı değiştirmek için aşağıdaki tema dizinini değiştirin
$ayarlar['temadizini'] = 'gece_mavisi';
$temadizini = $ayarlar['temadizini'];


if (!defined('PHPKF_ICINDEN')) exit();

if (isset($_SERVER['REQUEST_URI']))
{
	if (!@preg_match('/"/', urldecode($_SERVER['REQUEST_URI']))) $meta_canonical = $_SERVER['REQUEST_URI'];
	else $meta_canonical = '';
	$meta_canonical = zkTemizle($meta_canonical);
	$meta_canonical = zkTemizle4($meta_canonical);
	$meta_canonical = 'http://'.$ayarlar['alanadi'].$meta_canonical;
}
else $meta_canonical = 'http://'.$ayarlar['alanadi'];

$meta_etiketler = '<meta name="generator" content="phpKF" />'."\r\n".$ayarlar['meta_diger']."\r\n";


if (($sayfano == 41) OR ($sayfano == 47) OR ($sayfano == 48))
{
	if (!defined('DOSYA_OTURUM')) include '../bilesenler/oturum.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../bilesenler/tema_sinif.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/baslik.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$dizin_bilgi2 = '';

	if ( (preg_match('/\/mobil\//i', $_SERVER['REQUEST_URI'])) )
	{
		$dizin_bilgi = '../';
	}
	else
	{
		$dizin_bilgi = '';
	}
}

else
{
	if (@is_file('ayar.php'))
	{
		if (!defined('DOSYA_OTURUM')) include 'bilesenler/oturum.php';
		if (!defined('DOSYA_TEMA_SINIF')) include 'bilesenler/tema_sinif.php';

		$ornek1 = new phpkf_tema();
		$tema_dosyasi = 'mobil/temalar/'.$temadizini.'/baslik.php';
		eval($ornek1->tema_dosyasi($tema_dosyasi));
		$dizin_bilgi = '';
		$dizin_bilgi2 = 'mobil/';
	}
	else
	{
		if (!defined('DOSYA_OTURUM')) include '../bilesenler/oturum.php';
		if (!defined('DOSYA_TEMA_SINIF')) include '../bilesenler/tema_sinif.php';

		$ornek1 = new phpkf_tema();
		$tema_dosyasi = 'temalar/'.$temadizini.'/baslik.php';
		eval($ornek1->tema_dosyasi($tema_dosyasi));
		$dizin_bilgi = '../';
		$dizin_bilgi2 = '';
	}
}

if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';

if ($sayfa_adi == 'Ana Sayfa') $sayfa_baslik = $ayarlar['title'];
else $sayfa_baslik = $sayfa_adi;

$tarih = time();
$cikis = '';



//	META ETİKETLERİ		//

header("Content-type: text/html; charset=utf-8");


//	TEMA UYGULANIYOR	//

$dongusuz = array('{DIZIN}' => $dizin_bilgi,
'{FORUM_INDEX}' => $forum_index,
'{PORTAL_INDEX}' => $portal_index,
'{SAYFA_BASLIK}' => $sayfa_baslik);

$oi_rengi = 'width="127" height="26" border="0" src="temalar/varsayilan/resimler/oiyazs.png"';


if (isset($kullanici_kim['id']))
{
	$bilsayi = 0;
	$okunmamis_oi2 = '';
	$okunmamis_oi3 = '';


	// Bildirimler çekiliyor
	$sorgu = "SELECT * FROM $tablo_bildirimler WHERE uye_id='$kullanici_kim[id]' AND okundu='0' ORDER BY id";
	$bilsonuc = $vt->query($sorgu);

	while ($bildirim = $vt->fetch_assoc($bilsonuc))
	{
		$bilsayi++;
		// profil yorumları
		if ($bildirim['tip'] == '2')
		{
			$okunmamis_oi3 .= '<li><a href="'.$dizin_bilgi.'profil.php#yorum" title="Profil Yorumu">
			<h6><u>Profilinize yorum yaptıldı</u></h6>
			<p>Yazan: '.$bildirim['bildirim'].'</p>
			<p>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $bildirim['tarih']).'</p></a></li>';
		}

		// Teşekkürler
		elseif ($bildirim['tip'] == '4')
		{
			$tsk_konu = explode(';', $bildirim['bildirim']);
			$tsk_konu[1] = str_replace('&ks=', '&aks=', $tsk_konu[1]);
			$tsk_konu[1] = preg_replace('/^k=/', 'ak=', $tsk_konu[1]);
			$okunmamis_oi3 .= '<li><a href="'.$dizin_bilgi.'mobil/index.php?'.$tsk_konu[1].'" onclick="BKapat(1)" title="Teşekkür" id="bilyazi">
			<h6><u>Teşekkür edildi</u></h6>
			<p>Eden: '.$tsk_konu[0].'</p>
			<p>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $bildirim['tarih']).'</p></a></li>
			<script type="text/javascript"><!--//
			var cdizin = "; path='.$ayarlar['f_dizin'].'";
			var biltip = new Array();var bilyazi = new Array();var bilsayi = new Array();
			biltip[1] = 4;bilsayi[1] = '.$bilsayi.';bilyazi[1] = "";
			// --></script>';
		}
	}
	$okunmamis_oi1 = '<span class="label">'.$bilsayi.'</span>';



	// Özel iletiler bildirim olarak gösteriliyor
	if (($ayarlar['o_ileti'] == 1) AND ($kullanici_kim['okunmamis_oi']))
	{
		$okunmamis_oi1 = '<span class="label">'.$bilsayi.'</span>';
		$okunmamis_oi2 = '&nbsp;('.$kullanici_kim['okunmamis_oi'].')';


		$vtsorgu = "SELECT id,ozel_baslik,kimden,gonderme_tarihi,okunma_tarihi FROM $tablo_ozel_ileti WHERE kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null ORDER BY gonderme_tarihi DESC";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		while ($satir = $vt->fetch_assoc($vtsonuc))
		{
			$okunmamis_oi3 .= '<li><a href="'.$dizin_bilgi.'mobil/oi_oku.php?oino='.$satir['id'].'" title="Özel ileti">
			<h6><u>Özel ileti</u>: '.$satir['ozel_baslik'].'</h6>';
			$okunmamis_oi3 .= '<p>Yazan: '.$satir['kimden'].'</p>
			<p>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']).'</p></a>
			</li>';
		}

	}
	else
	{
		if ($bilsayi == 0)
		{
			$okunmamis_oi1 = '';
			$okunmamis_oi2 = '';
			$okunmamis_oi3 = '<li><h6><br><p align="center">Hiç bildiriminiz yok. &nbsp; </p><br></h6></li>';
		}
	}


	// yöneticiler için bağlantılar
	if ($kullanici_kim['yetki'] != 0) $ornek1->kosul('3', array('' => ''), true);
	else $ornek1->kosul('3', array('' => ''), false);

	$ornek1->kosul('2', array('{KULLANICI_ADI}' => $kullanici_kim['kullanici_adi'],
	'{O}' => $o,
	'{OKUNMAMIS_OI1}' => $okunmamis_oi1,
	'{OKUNMAMIS_OI2}' => $okunmamis_oi2,
	'{OKUNMAMIS_OI3}' => $okunmamis_oi3), true);
	$ornek1->kosul('1', array('' => ''), false);
}

//  KULLANICI GİRİŞ YAPMAMIŞSA  //

else
{
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
}


$ornek1->dongusuz($dongusuz);

$ornek1->tema_uygula();

unset($dongusuz);
unset($tekli1);
unset($ornek1);

?>