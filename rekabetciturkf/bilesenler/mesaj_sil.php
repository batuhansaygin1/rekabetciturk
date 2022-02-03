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
if (!defined('DOSYA_GUVENLIK')) include 'guvenlik.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';


if (isset($_GET['kip'])) $kip = $_GET['kip'];
if (isset($_GET['sayfa'])) $sayfa = $_GET['sayfa'];


if (is_numeric($_GET['mesaj_no']) == false)
{
    header('Location: ../hata.php?hata=47');
    exit();
}

elseif (isset($_GET['mesaj_no'])) $mesaj_no = @zkTemizle($_GET['mesaj_no']);


if ( (isset($_GET['cevap_no'])) AND (is_numeric($_GET['cevap_no']) == false) )
{
    header('Location: ../hata.php?hata=55');
    exit();
}

elseif (isset($_GET['cevap_no'])) $cevap_no = @zkTemizle($_GET['cevap_no']);




//	BAŞLIK VEYA CEVABIN HANGİ FORUMDAN OLDUĞUNA BAKILIYOR - BAŞI	//

if ($kip == 'mesaj')
{
	$vtsorgu = "SELECT hangi_forumdan FROM $tablo_mesajlar WHERE id='$mesaj_no' AND silinmis='0' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$fno = $vt->fetch_array($vtsonuc);

	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=47');
		exit();
	}
}

if ($kip == 'cevap')
{
	$vtsorgu = "SELECT hangi_forumdan FROM $tablo_cevaplar WHERE id='$cevap_no' AND silinmis='0' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$fno = $vt->fetch_array($vtsonuc);

	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=55');
		exit();
	}
}

//	BAŞLIK VEYA CEVABIN HANGİ FORUMDAN OLDUĞUNA BAKILIYOR - SONU	//




//	SİLME YETKİSİNE BAKILIYOR	- BAŞI //

//	YÖNETİCİ DEĞİLSE	//
if ($kullanici_kim['yetki'] != 1)
{
	$vtsorgu = "SELECT okuma_izni,yazma_izni,konu_acma_izni FROM $tablo_forumlar WHERE id='$fno[hangi_forumdan]'";
	$kul_izin_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kul_izin = $vt->fetch_assoc($kul_izin_sonuc);

	//	İZİNLERDEN BİRİ SADECE YÖNETİCİLER İÇİNSE VEYA KAPALIYSA	//
	if ( ($kul_izin['okuma_izni'] == 1) OR ($kul_izin['konu_acma_izni'] == 1) OR ($kul_izin['yazma_izni'] == 1) OR ($kul_izin['okuma_izni'] == 5) OR ($kul_izin['konu_acma_izni'] == 5) OR ($kul_izin['yazma_izni'] == 5) )
	{
		header('Location: ../hata.php?hata=56');
		exit();
	}


	//	FORUM YARDIMCI İSE	//
	if ($kullanici_kim['yetki'] == 2);


	//	BÖLÜM YARDIMCI İSE	//
	elseif ($kullanici_kim['yetki'] == 3)
	{
		if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$fno[hangi_forumdan]' AND yonetme='1' OR";
		else $grupek = "grup='0' AND";

		$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$fno[hangi_forumdan]' AND yonetme='1'";
		$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

		//	YÖNETME YETKİSİ YOKSA	//
		if (!$vt->num_rows($kul_izin))
		{
			header('Location: ../hata.php?hata=56');
			exit();
		}
	}


	//	YETKİSİ YOKSA	//
	else
	{
		header('Location: ../hata.php?hata=56');
		exit();
	}
}

//	SİLME YETKİSİNE BAKILIYOR	- SONU //




					//	SİLİNEN BAŞLIK İSE	//


if ($kip == 'mesaj')
{
	if ( (empty($_GET['onay']) ) OR ($_GET['onay'] != 'kabul') )
	{
		header('Location: ../hata.php?uyari=5&fno='.$_GET['fno'].'&kip=mesaj&mesaj_no='.$_GET['mesaj_no'].'&o='.$o.'&fsayfa='.$_GET['fsayfa']);
		exit();
	}


	// oturum bilgisine bakılıyor
	if ($_GET['o'] != $o)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_mesajlar SET silinmis='1' WHERE id='$mesaj_no'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//	FORUMUN KONU SAYISI EKSİLTİLİYOR //

	$vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi=konu_sayisi - 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//	EĞER BAŞLIĞIN CEVAPLARI VARSA DÖNGÜYE SOKARAK TEKER TEKER SİL	//

	$vtsorgu1 = "SELECT id FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$mesaj_no' ORDER BY id DESC";
	$vtsonuc_konu = $vt->query($vtsorgu1) or die ($vt->hata_ver());


	while ($cevaplari_sil = $vt->fetch_array($vtsonuc_konu))
	{
		$vtsorgu2 = "UPDATE $tablo_cevaplar SET silinmis='1' WHERE id='$cevaplari_sil[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu2) or die ($vt->hata_ver());


		//	FORUMUN CEVAP SAYISI EKSİLTİLİYOR //

		$vtsorgu3 = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi - 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
	}


	header('Location: ../hata.php?bilgi=6&fno='.$_GET['fno'].'&fsayfa='.$_GET['fsayfa']);
	exit();
}



				//	SİLİNEN CEVAP İSE	//



elseif ($kip == 'cevap')
{
	if ( (empty($_GET['onay']) ) OR ($_GET['onay'] != 'kabul') )
	{
		header('Location: ../hata.php?uyari=7&kip=cevap&mesaj_no='.$_GET['mesaj_no'].'&cevap_no='.$_GET['cevap_no'].'&o='.$o.'&fsayfa='.$_GET['fsayfa'].'&sayfa='.$_GET['sayfa']);
		exit();
	}


	// oturum bilgisine bakılıyor
	if ($_GET['o'] != $o)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_cevaplar SET silinmis='1' WHERE id='$cevap_no' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//	FORUMUN CEVAP SAYISI EKSİLTİLİYOR //

	$vtsorgu = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi - 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//	VERİTABANINDAN BAŞLIĞIN SON CEVABI ÇEKİLİYOR	//

	$vtsorgu = "SELECT id,tarih,cevap_yazan FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$mesaj_no' ORDER BY tarih DESC LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$son_mesaj = $vt->fetch_array($vtsonuc);


	//	BAŞKA CEVAP YOKSA; KONU TARİHİ SON MESAJ TARİHİ OLARAK GİRİLİYOR, CEVAP SAYISI 1 EKSİLTİLİYOR, son_cevap SIFIR YAPILIYOR, son_cevap_yazan SİLİNİYOR   //

	if (empty($son_mesaj['tarih']))
	{
		$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=0, son_mesaj_tarihi=tarih, son_cevap=0, son_cevap_yazan='' WHERE id='$mesaj_no' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}



	//	CEVAP VARSA; CEVAP TARİHİ SON MESAJ TARİHİ OLARAK GİRİLİYOR, CEVAP SAYISI 1 EKSİLTİLİYOR, CEVAP NO VE YAZAN GİRİLİYOR   //

	else
	{
		$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=cevap_sayi - 1, son_mesaj_tarihi='$son_mesaj[tarih]', son_cevap='$son_mesaj[id]', son_cevap_yazan='$son_mesaj[cevap_yazan]' WHERE id='$mesaj_no' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	header('Location: ../hata.php?bilgi=8&mesaj_no='.$mesaj_no.'&fsayfa='.$_GET['fsayfa'].'&sayfa='.$_GET['sayfa']);
	exit();
}
?>