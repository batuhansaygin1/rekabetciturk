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
if (!defined('DOSYA_GUVENLIK')) include '../bilesenler/guvenlik.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


// özel ileti özelliği kapalıysa
if ($ayarlar['o_ileti'] == 0)
{
	header('Location: ../hata.php?uyari=2');
	exit();
}



// ÖZEL İLETİ KUTULARI GÖRÜTÜLENİYOR - BAŞI //
// ÖZEL İLETİ KUTULARI GÖRÜTÜLENİYOR - BAŞI //

if (isset($_GET['kip'])):


//  AYARLAR SAYFASI GÖRÜNTÜLENİYOR - BAŞI  //
//  ULAŞAN KUTUSU GÖRÜNTÜLENİYOR - BAŞI  //

if ($_GET['kip'] == 'ulasan')
{
$sayfano = 25;
$sayfa_adi = 'Özel iletiler Ulaşan Kutusu';
include 'bilesenler/sayfa_baslik.php';


//	 ULAŞAN İLETİLER OKUNMA TARİH SIRASINA GÖRE ÇEKİLİYOR	//
$vtsorgu = "SELECT id,kimden,kime,ozel_baslik,gonderme_tarihi,okunma_tarihi,cevap_sayi,cevap FROM $tablo_ozel_ileti WHERE
kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='2' AND cevap=0 OR
kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='2' AND cevap_sayi!=0 ORDER BY okunma_tarihi DESC";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


//	ULAŞAN İLETİLERİN SAYISI ALINIYOR		//

$vtsonuc9 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='2' AND cevap=0 OR kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='2' AND cevap_sayi!=0") or die ($vt->hata_ver());
$num_rows = $vt->num_rows($vtsonuc9);


// tema sınıfı örneği oluşturuluyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/ozel_ileti.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


// duyuru varsa koşul 8 alanı tekli döngüye sokuluyor
if (isset($tekli2))
{
	$ornek1->kosul('8', array('' => ''), true);
	$ornek1->tekli_dongu('2',$tekli2);
	unset($tekli2);
}
else $ornek1->kosul('8', array('' => ''), false);


//	OZEL İLETİ YOKSA	//

if (!$vt->num_rows($vtsonuc9))
{
	$ornek1->kosul('1', array('{KUTU_BOS}' => 'Ulaşan Kutusunda hiç iletiniz yok.'), true);
	$ornek1->kosul('2', array('' => ''), false);
}


//	OZEL İLETİ VARSA	//

else
{
	$tablono = 1;

	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);


	while ($satir = $vt->fetch_array($vtsonuc))
	{
		// son cevap çekiliyor
		if ($satir['cevap_sayi'] != 0)
		{
			$vtsorgu = "SELECT id,kimden,kime,gonderme_tarihi,okunma_tarihi FROM $tablo_ozel_ileti WHERE cevap='$satir[id]' ORDER BY gonderme_tarihi DESC LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$satir2 = $vt->fetch_assoc($vtsonuc2);

			// son cevap kendinin değilse
			if ($satir2['kimden'] != $kullanici_kim['kullanici_adi'])
			{
				$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen Yanıtlanmış" width="26" height="26">';
				if ($satir2['okunma_tarihi']) $oi_okunma_tarihi = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir2['okunma_tarihi']);
				else $oi_okunma_tarihi = '<font size="3">-</font>';
				$oi_gonderme_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir2['gonderme_tarihi']);
				$oi_soncevap = '<a href="../profil.php?kim='.$satir2['kimden'].'" class="nopadding">'.$satir2['kimden'].'</a>';
				$oi_kime = '<a href="../profil.php?kim='.$satir2['kime'].'" class="nopadding">'.$satir2['kime'].'</a>';
			}

			else
			{
				$vtsorgu = "SELECT id,kimden,kime,gonderme_tarihi,okunma_tarihi FROM $tablo_ozel_ileti WHERE cevap='$satir[id]' AND kimden='$kullanici_kim[kullanici_adi]' ORDER BY gonderme_tarihi DESC LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
				$satir3 = $vt->fetch_assoc($vtsonuc3);

				if ($satir3['kimden'] == $kullanici_kim['kullanici_adi'])
					$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen Yanıtlanmış" width="26" height="26">';
				else $oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_gelen.png" alt="" title="Alınan Yanıtlanmış" width="26" height="26">';

				if ($satir2['okunma_tarihi']) $oi_okunma_tarihi = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir2['okunma_tarihi']);
				else $oi_okunma_tarihi = '<font size="3">-</font>';

				$oi_gonderme_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir3['gonderme_tarihi']);
				$oi_soncevap = '<a href="../profil.php?kim='.$satir3['kimden'].'" class="nopadding">'.$satir3['kimden'].'</a>';
				$oi_kime = '<a href="../profil.php?kim='.$satir3['kime'].'" class="nopadding">'.$satir3['kime'].'</a>';
			}
		}

		else
		{
			$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen" width="26" height="26">';
			$oi_gonderme_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);
			$oi_okunma_tarihi = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['okunma_tarihi']);
			$oi_soncevap = '<font size="3">-</font>';
			$oi_kime = '<a href="../profil.php?kim='.$satir['kime'].'" class="nopadding">'.$satir['kime'].'</a>';
		}

		$oi_baslik = '<a href="oi_oku.php?oino='.$satir['id'].'">'.$satir['ozel_baslik'].'</a>';



		//	veriler tema motoruna yollanıyor	//
		$tekli1[] = array('{TABLO_NO}' => $tablono,
		'{OI_NO}' => $satir['id'],
		'{OI_SIMGE}' => $oi_simge,
		'{OZEL_ILET_BASLIK}' => $oi_baslik,
		'{OI_KIMDEN}' => $oi_kime,
		'{OI_TARIH1}' => $oi_gonderme_tarih,
		'{OI_CEVAP}' => $satir['cevap_sayi'],
		'{OI_TARIH2}' => $oi_soncevap,
		'{OI_SONCEVAP}' => $oi_okunma_tarihi);

		$tablono++;
	}
}


//	DOLULUK ORANI YÜZDESİ HESAPLANIYOR	//

if ($num_rows != 0)
{
	$doluluk_orani = 100 / ($ayarlar['ulasan_kutu_kota'] / $num_rows);
	settype($doluluk_orani,'integer');
	if ($doluluk_orani > 100) $doluluk_orani = 100;
}

else $doluluk_orani = 1;


$form_bilgi = '<form name="secim_formu" action="ozel_ileti.php" method="post">
<input type="hidden" name="git" value="ulasan">';

$kutu_aciklama = 'Yolladığınız iletiler gönderilen tarafından okunduğunda buraya taşınır.
<br>İletinin okunma tarihini yukarıda görebilirsiniz.';



//	TEMA UYGULANIYOR	//

$ornek1->kosul('6', array('' => ''), false);
$ornek1->kosul('5', array('' => ''), true);
$ornek1->kosul('7', array('' => ''), true);

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);

$ornek1->dongusuz(array('{KUTU_KOTA}' => $ayarlar['ulasan_kutu_kota'],
'{DOLULUK}' => $num_rows,
'{OZEL_ILETI_GONDER}' => $oi_rengi,
'{DOLULUK_ORANI}' => $doluluk_orani,
'{FORM_BILGI}' => $form_bilgi,
'{FORM_ICERIK}' => '',
'{KIMDEN_KIME}' => 'Gönderilen',
'{GELEN_KUTUSU}' => 'Gelen Kutusu',
'{ULASAN_KUTUSU}' => 'Ulaşan Kutusu',
'{GONDERILEN_KUTUSU}' => 'Gönderilen Kutusu',
'{KAYDEDILEN_KUTUSU}' => 'Kaydedilen Kutusu',
'{GELEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php">',
'{GELEN_KUTUSU_BAG2}' => '</a>',
'{ULASAN_KUTUSU_BAG}' => '',
'{ULASAN_KUTUSU_BAG2}' => '',
'{GONDERILEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=gonderilen">',
'{GONDERILEN_KUTUSU_BAG2}' => '</a>',
'{KAYDEDILEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=kaydedilen">',
'{KAYDEDILEN_KUTUSU_BAG2}' => '</a>',
'{TARIH_ALAN1}' => 'Gönderme Tarihi',
'{TARIH_ALAN2}' => 'Son Cevap',
'{SON_CEVAP}' => 'Okunma Tarihi',
'{KUTU_ACIKLAMA}' => $kutu_aciklama));

eval(TEMA_UYGULA);
exit();
}

//  ULAŞAN KUTUSU GÖRÜNTÜLENİYOR - SONU  //





//  GÖNDERİLEN KUTUSU GÖRÜNTÜLENİYOR - BAŞI  //

elseif ($_GET['kip'] == 'gonderilen')
{
$sayfano = 26;
$sayfa_adi = 'Özel iletiler Gönderilen Kutusu';
include 'bilesenler/sayfa_baslik.php';


//	GÖNDERİLEN İLETİLER TARİH SIRASINA GÖRE ÇEKİLİYOR	//

$vtsorgu = "SELECT id,ozel_baslik,kimden,kime,gonderme_tarihi,cevap_sayi,cevap FROM $tablo_ozel_ileti WHERE
kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='3' ORDER BY gonderme_tarihi DESC";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


//	GÖNDERİLEN İLETİLERİN SAYISI ALINIYOR		//

$vtsonuc9 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='3'") or die ($vt->hata_ver());
$num_rows = $vt->num_rows($vtsonuc9);


// tema sınıfı örneği oluşturuluyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/ozel_ileti.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


// duyuru varsa koşul 8 alanı tekli döngüye sokuluyor
if (isset($tekli2))
{
	$ornek1->kosul('8', array('' => ''), true);
	$ornek1->tekli_dongu('2',$tekli2);
	unset($tekli2);
}
else $ornek1->kosul('8', array('' => ''), false);


//	OZEL İLETİ YOKSA	//

if (!$vt->num_rows($vtsonuc9))
{
	$ornek1->kosul('1', array('{KUTU_BOS}' => 'Gönderilen Kutusunda hiç iletiniz yok.'), true);
	$ornek1->kosul('2', array('' => ''), false);
}


//	OZEL İLETİ VARSA	//

else
{
	$tablono = 1;

	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);


	while ($satir = $vt->fetch_array($vtsonuc))
	{
		// cevapsa konusu çekiliyor
		if ($satir['cevap'] != 0)
		{
			$oi_soncevap = '<a href="../profil.php?kim='.$satir['kimden'].'" class="nopadding">'.$satir['kimden'].'</a>';

			$vtsorgu = "SELECT id,ozel_baslik,kime,kimden,gonderme_tarihi,cevap_sayi,cevap FROM $tablo_ozel_ileti WHERE id='$satir[cevap]' LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$satir2 = $vt->fetch_assoc($vtsonuc2);

			$oi_no = $satir2['id'];
			$cevap_sayi = $satir2['cevap_sayi'];
			$oi_baslik = '<a href="oi_oku.php?oino='.$satir2['id'].'">'.$satir2['ozel_baslik'].'</a>';
			$oi_kime = '<a href="../profil.php?kim='.$satir['kime'].'" class="nopadding">'.$satir['kime'].'</a>';
			$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir2['gonderme_tarihi']);
			$oi_tarih2 = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);


			if ($satir2['kimden'] == $kullanici_kim['kullanici_adi'])
				$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen Yanıtlanmış" width="26" height="26">';
			else $oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_gelen.png" alt="" title="Alınan Yanıtlanmış" width="26" height="26">';
		}

		else
		{
			$oi_no = $satir['id'];
			$cevap_sayi = $satir['cevap_sayi'];
			$oi_baslik = '<a href="oi_oku.php?oino='.$satir['id'].'">'.$satir['ozel_baslik'].'</a>';
			$oi_kime = '<a href="../profil.php?kim='.$satir['kime'].'" class="nopadding">'.$satir['kime'].'</a>';
			$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);
			$oi_tarih2 = '<font size="3">-</font>';
			$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen" width="26" height="26">';
			$oi_soncevap = '<font size="3">-</font>';
		}


		//	veriler tema motoruna yollanıyor	//
		$tekli1[] = array('{TABLO_NO}' => $tablono,
		'{OI_NO}' => $oi_no,
		'{OI_SIMGE}' => $oi_simge,
		'{OZEL_ILET_BASLIK}' => $oi_baslik,
		'{OI_KIMDEN}' => $oi_kime,
		'{OI_CEVAP}' => $cevap_sayi,
		'{OI_TARIH1}' => $oi_tarih,
		'{OI_TARIH2}' => $oi_tarih2,
		'{OI_SONCEVAP}' => $oi_soncevap);

		$tablono++;
	}
}


$form_bilgi = '<form name="secim_formu" action="ozel_ileti.php" method="post">
<input type="hidden" name="git" value="gonderilen">';

$kutu_aciklama = 'Gönderdiğiniz kişi tarafından henüz okunmayan iletiler burada bulunur,
<br>gönderilen tarafından okunduklarında Ulaşan Kutusuna taşınır.';



//	TEMA UYGULANIYOR	//

$ornek1->kosul('6', array('' => ''), false);
$ornek1->kosul('5', array('' => ''), true);
$ornek1->kosul('7', array('' => ''), true);

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);

$ornek1->dongusuz(array('{KUTU_KOTA}' => '&#8734;',
'{DOLULUK}' => $num_rows,
'{OZEL_ILETI_GONDER}' => $oi_rengi,
'{DOLULUK_ORANI}' => '0',
'{FORM_BILGI}' => $form_bilgi,
'{FORM_ICERIK}' => '',
'{KIMDEN_KIME}' => 'Gönderilen',
'{GELEN_KUTUSU}' => 'Gelen Kutusu',
'{ULASAN_KUTUSU}' => 'Ulaşan Kutusu',
'{GONDERILEN_KUTUSU}' => 'Gönderilen Kutusu',
'{KAYDEDILEN_KUTUSU}' => 'Kaydedilen Kutusu',
'{GELEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php">',
'{GELEN_KUTUSU_BAG2}' => '</a>',
'{ULASAN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=ulasan">',
'{ULASAN_KUTUSU_BAG2}' => '</a>',
'{GONDERILEN_KUTUSU_BAG}' => '',
'{GONDERILEN_KUTUSU_BAG2}' => '',
'{KAYDEDILEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=kaydedilen">',
'{KAYDEDILEN_KUTUSU_BAG2}' => '</a>',
'{TARIH_ALAN1}' => 'Gönderme Tarihi',
'{TARIH_ALAN2}' => 'Cevap Tarihi',
'{SON_CEVAP}' => 'Son Cevap',
'{KUTU_ACIKLAMA}' => $kutu_aciklama));

eval(TEMA_UYGULA);
exit();
}

//  GÖNDERİLEN KUTUSU GÖRÜNTÜLENİYOR - SONU  //





//  KAYDEDİLEN KUTUSU GÖRÜNTÜLENİYOR - BAŞI  //

elseif ($_GET['kip'] == 'kaydedilen')
{
$sayfano = 27;
$sayfa_adi = 'Özel iletiler Kaydedilen Kutusu';
include 'bilesenler/sayfa_baslik.php';


//	KAYDEDİLEN İLETİLER TARİH SIRASINA GÖRE ÇEKİLİYOR	//

$vtsorgu = "SELECT * FROM $tablo_ozel_ileti WHERE
kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='4' AND cevap='0' OR
kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='4' AND cevap='0' ORDER BY gonderme_tarihi DESC";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


//	KAYDEDİLEN İLETİLERİN SAYISI ALINIYOR		//

$vtsonuc9 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='4' OR kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='4' AND cevap='0'") or die ($vt->hata_ver());
$num_rows = $vt->num_rows($vtsonuc9);


// tema sınıfı örneği oluşturuluyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/ozel_ileti.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


// duyuru varsa koşul 8 alanı tekli döngüye sokuluyor
if (isset($tekli2))
{
	$ornek1->kosul('8', array('' => ''), true);
	$ornek1->tekli_dongu('2',$tekli2);
	unset($tekli2);
}
else $ornek1->kosul('8', array('' => ''), false);


//	OZEL İLETİ YOKSA	//

if (!$vt->num_rows($vtsonuc9))
{
	$ornek1->kosul('1', array('{KUTU_BOS}' => 'Kaydedilen Kutusunda hiç iletiniz yok.'), true);
	$ornek1->kosul('2', array('' => ''), false);
}


//	OZEL İLETİ VARSA	//

else
{
	$tablono = 1;

	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);


	while ($satir = $vt->fetch_array($vtsonuc))
	{
		$oi_baslik = '<a href="oi_oku.php?oino='.$satir['id'].'">'.$satir['ozel_baslik'].'</a>';
		$oi_kimden = '<a href="../profil.php?kim='.$satir['kimden'].'" class="nopadding">'.$satir['kimden'].'</a>';
		$oi_kime = '<a href="../profil.php?kim='.$satir['kime'].'" class="nopadding">'.$satir['kime'].'</a>';
		$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);

		// yanıtlanmışsa
		if ($satir['cevap_sayi'] != '0')
		{
			if ($satir['kimden'] == $kullanici_kim['kullanici_adi'])
				$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen Yanıtlanmış" width="26" height="26">';
			else $oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_gelen.png" alt="" title="Alınan Yanıtlanmış" width="26" height="26">';
			$oi_soncevap = '<a href="../profil.php?kim='.$satir['kimden'].'" class="nopadding">'.$satir['kimden'].'</a>';
		}

		else
		{
			if ($satir['kimden'] == $kullanici_kim['kullanici_adi'])
				$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen" width="26" height="26">';
			else $oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_gelen.png" alt="" title="Alınan" width="26" height="26">';
			$oi_soncevap = '';
		}


		//	veriler tema motoruna yollanıyor	//
		$tekli1[] = array('{TABLO_NO}' => $tablono,
		'{OI_NO}' => $satir['id'],
		'{OI_SIMGE}' => $oi_simge,
		'{OZEL_ILET_BASLIK}' => $oi_baslik,
		'{OI_KIMDEN}' => $oi_kimden,
		'{OI_TARIH1}' => $oi_kime,
		'{OI_CEVAP}' => $satir['cevap_sayi'],
		'{OI_TARIH2}' => $oi_tarih,
		'{OI_SONCEVAP}'=> $oi_soncevap);
		$tablono++;
	}
}


//	DOLULUK ORANI YÜZDESİ HESAPLANIYOR	//

if ($num_rows != 0)
{
	$doluluk_orani = 100 / ($ayarlar['kaydedilen_kutu_kota'] / $num_rows);
	settype($doluluk_orani,'integer');
	if ($doluluk_orani > 100) $doluluk_orani = 100;
}

else $doluluk_orani = 1;


$form_bilgi = '<form name="secim_formu" action="ozel_ileti.php" method="post">
<input type="hidden" name="git" value="kaydedilen">';



//	TEMA UYGULANIYOR	//

$ornek1->kosul('6', array('' => ''), false);
$ornek1->kosul('5', array('' => ''), true);
$ornek1->kosul('7', array('' => ''), false);

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);

$ornek1->dongusuz(array('{KUTU_KOTA}' => $ayarlar['kaydedilen_kutu_kota'],
'{DOLULUK}' => $num_rows,
'{OZEL_ILETI_GONDER}' => $oi_rengi,
'{DOLULUK_ORANI}' => $doluluk_orani,
'{FORM_BILGI}' => $form_bilgi,
'{FORM_ICERIK}' => '',
'{KIMDEN_KIME}' => 'Gönderen',
'{GELEN_KUTUSU}' => 'Gelen Kutusu',
'{ULASAN_KUTUSU}' => 'Ulaşan Kutusu',
'{GONDERILEN_KUTUSU}' => 'Gönderilen Kutusu',
'{KAYDEDILEN_KUTUSU}' => 'Kaydedilen Kutusu',
'{GELEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php">',
'{GELEN_KUTUSU_BAG2}' => '</a>',
'{ULASAN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=ulasan">',
'{ULASAN_KUTUSU_BAG2}' => '</a>',
'{GONDERILEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=gonderilen">',
'{GONDERILEN_KUTUSU_BAG2}' => '</a>',
'{KAYDEDILEN_KUTUSU_BAG}' => '',
'{KAYDEDILEN_KUTUSU_BAG2}' => '',
'{TARIH_ALAN1}' => 'Alan',
'{TARIH_ALAN2}' => 'Gönderme Tarihi',
'{SON_CEVAP}' => 'Son Cevap',
'{KUTU_ACIKLAMA}' => ''));

eval(TEMA_UYGULA);
exit();
}
$gec = '';

//  KAYDEDİLEN KUTUSU GÖRÜNTÜLENİYOR - SONU  //





//  GELEN KUTUSU GÖRÜNTÜLENİYOR - BAŞI  //

else:

$sayfano = 28;
$sayfa_adi = 'Özel iletiler Gelen Kutusu';
include 'bilesenler/sayfa_baslik.php';


// tema sınıfı örneği oluşturuluyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/ozel_ileti.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


// duyuru varsa koşul 8 alanı tekli döngüye sokuluyor
if (isset($tekli2))
{
	$ornek1->kosul('8', array('' => ''), true);
	$ornek1->tekli_dongu('2',$tekli2);
	unset($tekli2);
}
else $ornek1->kosul('8', array('' => ''), false);




//  ÖZEL İLETİLERİN SAYISI ALINIYOR //
$vtsonuc9 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND cevap=0 OR kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu!='0' AND gonderen_kutu!='4' AND cevap_sayi!=0") or die ($vt->hata_ver());
$num_rows = $vt->num_rows($vtsonuc9);

$vtsonuc92 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu='2' AND cevap!=0") or die ($vt->hata_ver());
$num_rows2 = $vt->num_rows($vtsonuc92);


//  OZEL İLETİ YOKSA    //

if (!$vt->num_rows($vtsonuc9))
{
	$ornek1->kosul('1', array('{KUTU_BOS}' => 'Gelen Kutusunda hiç iletiniz yok.'), true);
	$ornek1->kosul('2', array('' => ''), false);
}


//  OZEL İLETİ VARSA    //

else
{
	// ÖZEL İLETİLER TARİH SIRASINA GÖRE ÇEKİLİYOR //
	$vtsorgu = "SELECT id,ozel_baslik,kimden,gonderme_tarihi,okunma_tarihi,cevap_sayi,cevap FROM $tablo_ozel_ileti WHERE
	kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND cevap=0 OR
	kimden='$kullanici_kim[kullanici_adi]' AND gonderen_kutu!='0' AND gonderen_kutu!='4' AND cevap_sayi!=0 ORDER BY gonderme_tarihi DESC";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$tablono = 1;


	while ($satir = $vt->fetch_assoc($vtsonuc))
	{
		// gelen özel ileti cevapsa konusu çekiliyor
		if ($satir['cevap'] != 0)
		{
			// konunun bilgileri depolanıyor
			$gonderme_tarihi = $satir['gonderme_tarihi'];
			$kimden = $satir['kimden'];
			$oi_tarih2 = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);

			$vtsorgu = "SELECT id,ozel_baslik,okunma_tarihi,cevap_sayi,cevap FROM $tablo_ozel_ileti WHERE id='$satir[cevap]' LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$satir = $vt->fetch_assoc($vtsonuc2);

			// konunun bilgileri geri yükleniyor
			$oi_soncevap = '<a href="../profil.php?kim='.$satir['kimden'].'" class="nopadding">'.$satir['kimden'].'</a>';
			$satir['kimden'] = $kimden;
			$satir['gonderme_tarihi'] = $gonderme_tarihi;
			$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);
			$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_gelen.png" alt="" title="Okunmuş" width="26" height="26">';
		}


		// kendi yolladığı cevaplanmışsa son cevabı çekiliyor
		elseif ($satir['cevap_sayi'] != 0)
		{
			// konunun bilgileri depolanıyor
			$ozel_id = $satir['id'];
			$kimden = $satir['kimden'];
			$ozel_baslik = $satir['ozel_baslik'];
			$cevap_sayi = $satir['cevap_sayi'];
			$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);

			$vtsorgu = "SELECT id,kimden,gonderme_tarihi,okunma_tarihi,cevap_sayi,cevap FROM $tablo_ozel_ileti WHERE cevap='$satir[id]' ORDER BY gonderme_tarihi DESC LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$satir = $vt->fetch_assoc($vtsonuc2);

			if ($satir['kimden'] == $kullanici_kim['kullanici_adi']) $satir['okunma_tarihi'] = 1;
			$oi_soncevap = '<a href="../profil.php?kim='.$satir['kimden'].'" class="nopadding">'.$satir['kimden'].'</a>';
			$oi_tarih2 = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);

			// konunun bilgileri geri yükleniyor
			$satir['id'] = $ozel_id;
			$satir['kimden'] = $kimden;
			$satir['ozel_baslik'] = $ozel_baslik;
			$satir['cevap_sayi'] = $cevap_sayi;

			if ($satir['kimden'] == $kullanici_kim['kullanici_adi'])
				$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_giden.png" alt="" title="Gönderilen Yanıtlanmış" width="26" height="26">';
			else $oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_gelen.png" alt="" title="Alınan Yanıtlanmış" width="26" height="26">';
		}

		else
		{
			if (!isset($satir['okunma_tarihi']))
				$oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_kapali.png" alt="" title="Okunmamış" width="26" height="26">';
			else $oi_simge = '<img src="../dosyalar/resimler/oi_simge/oi_acik.png" alt="" title="Okunmuş" width="26" height="26">';

			$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['gonderme_tarihi']);
			$oi_tarih2 = '<font size="3">-</font>';
			$oi_soncevap = '<font size="3">-</font>';
		}


		// okunmamış iletiler kalın yazdırılıyor
		$oi_baslik = '<a href="oi_oku.php?oino='.$satir['id'].'" >';
		if (!isset($satir['okunma_tarihi'])) $oi_baslik .= '<b>'.$satir['ozel_baslik'].'</b></a>';
		else $oi_baslik .= $satir['ozel_baslik'].'</a>';
		$oi_kimden = '<a href="../profil.php?kim='.$satir['kimden'].'" class="nopadding">'.$satir['kimden'].'</a>';

		// veriler tema motoruna yollanıyor
		$tekli1[] = array('{TABLO_NO}' => $tablono,
		'{OI_NO}' => $satir['id'],
		'{OI_SIMGE}' => $oi_simge,
		'{OZEL_ILET_BASLIK}' => $oi_baslik,
		'{OI_KIMDEN}' => $oi_kimden,
		'{OI_CEVAP}' => $satir['cevap_sayi'],
		'{OI_TARIH1}' => $oi_tarih,
		'{OI_TARIH2}' => $oi_tarih2,
		'{OI_SONCEVAP}'=> $oi_soncevap);

		$tablono++;
	}

	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
}




//  DOLULUK ORANI YÜZDESİ HESAPLANIYOR  //

if ($num_rows != 0)
{
	$num_rows += $num_rows2;
	$doluluk_orani = 100 / ($ayarlar['gelen_kutu_kota'] / $num_rows);
	settype($doluluk_orani,'integer');
	if ($doluluk_orani > 100) $doluluk_orani = 100;
}

else $doluluk_orani = 1;


$form_bilgi = '<form name="secim_formu" action="ozel_ileti.php" method="post">
<input type="hidden" name="git" value="ozel_ileti">';



//  TEMA UYGULANIYOR    //

$ornek1->kosul('6', array('' => ''), false);
$ornek1->kosul('5', array('' => ''), true);
$ornek1->kosul('7', array('' => ''), true);

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);

$ornek1->dongusuz(array('{KUTU_KOTA}' => $ayarlar['gelen_kutu_kota'],
'{DOLULUK}' => $num_rows,
'{OZEL_ILETI_GONDER}' => $oi_rengi,
'{DOLULUK_ORANI}' => $doluluk_orani,
'{FORM_BILGI}' => $form_bilgi,
'{FORM_ICERIK}' => '',
'{KIMDEN_KIME}' => 'Gönderen',
'{GELEN_KUTUSU}' => 'Gelen Kutusu',
'{ULASAN_KUTUSU}' => 'Ulaşan Kutusu',
'{GONDERILEN_KUTUSU}' => 'Gönderilen Kutusu',
'{KAYDEDILEN_KUTUSU}' => 'Kaydedilen Kutusu',
'{GELEN_KUTUSU_BAG}' => '',
'{GELEN_KUTUSU_BAG2}' => '',
'{ULASAN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=ulasan">',
'{ULASAN_KUTUSU_BAG2}' => '</a>',
'{GONDERILEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=gonderilen">',
'{GONDERILEN_KUTUSU_BAG2}' => '</a>',
'{KAYDEDILEN_KUTUSU_BAG}' => '<a href="ozel_ileti.php?kip=kaydedilen">',
'{KAYDEDILEN_KUTUSU_BAG2}' => '</a>',
'{TARIH_ALAN1}' => 'Gönderme Tarihi',
'{TARIH_ALAN2}' => 'Cevap Tarihi',
'{SON_CEVAP}' => 'Son Cevap',
'{KUTU_ACIKLAMA}' => ''));

eval(TEMA_UYGULA);


// Gelen kutusu dolu uyarısı

if ($ayarlar['gelen_kutu_kota'] <= $num_rows)
{
echo '<script type="text/javascript">
<!-- 
alert(\'Gelen Kutusu Tam Dolu !\\nTekrar özel ileti alabilmek için gelen kutusunu boşaltın.\')
//  -->
</script>';
}


//  NORMAL SAYFA GÖRÜNTÜLENİYOR - SONU  //



// ÖZEL İLETİ KUTULARI GÖRÜTÜLENİYOR - SONU //
// ÖZEL İLETİ KUTULARI GÖRÜTÜLENİYOR - SONU //

endif;
?>