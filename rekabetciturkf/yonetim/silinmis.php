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
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


// site kurucusu değilse hata ver
if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//  BAŞLIĞI GERİ YÜKLEME İŞLEMLERİ   //

if ( (isset($_GET['kurtark'])) AND ($_GET['kurtark'] != '') )
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
	if (isset($_GET['kurtark'])) $_GET['kurtark'] = @zkTemizle($_GET['kurtark']);


	if (is_numeric($_GET['kurtark']) == false)
	{
		header('Location: hata.php?hata=47');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	// başlığın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_forumdan,silinmis FROM $tablo_mesajlar WHERE id='$_GET[kurtark]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// başlık yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=47');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);
	// başlık zaten geri yüklenmişse
	if ($fno['silinmis'] != 1)
	{
		header('Location: hata.php?hata=168');
		exit();
	}


	// başlığın silinen cevapları varsa döngüye sokularak teker teker geri yükleniyor
	$vtsorgu1 = "SELECT id FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[kurtark]' ORDER BY id DESC";
	$vtsonuc_konu = $vt->query($vtsorgu1) or die ($vt->hata_ver());


	$toplam_cevap = 0;

	while ($cevaplari_yukle = $vt->fetch_assoc($vtsonuc_konu))
	{
		$vtsorgu2 = "UPDATE $tablo_cevaplar SET silinmis=0 WHERE id='$cevaplari_yukle[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu2) or die ($vt->hata_ver());


		// forumun cevap sayisi arttırılıyor
		$vtsorgu3 = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi + 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
		$toplam_cevap++;
	}


	// başlığın son cevabı çekiliyor
	$vtsorgu = "SELECT id,tarih,cevap_yazan FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[kurtark]' ORDER BY tarih DESC LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$son_mesaj = $vt->fetch_assoc($vtsonuc);


	// cevabı yoksa
	if (empty($son_mesaj['tarih']))
		$vtsorgu = "UPDATE $tablo_mesajlar SET silinmis=0, cevap_sayi=0, son_mesaj_tarihi=tarih, son_cevap=0, son_cevap_yazan=NULL WHERE id='$_GET[kurtark]'";

	// cevabı varsa
	else $vtsorgu = "UPDATE $tablo_mesajlar SET silinmis=0, cevap_sayi='$toplam_cevap', son_mesaj_tarihi='$son_mesaj[tarih]', son_cevap='$son_mesaj[id]', son_cevap_yazan='$son_mesaj[cevap_yazan]' WHERE id='$_GET[kurtark]'";

	// konu geri yükleniyor, son mesaj tarihi ve son cevap bilgileri güncelleniyor
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// forumun konu sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi=konu_sayisi + 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: ../konu.php?k='.$_GET['kurtark']);
	exit();
}




//  CEVABI GERİ YÜKLEME İŞLEMLERİ   //

elseif ( (isset($_GET['kurtarc'])) AND ($_GET['kurtarc'] != '') )
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
	if (isset($_GET['kurtarc'])) $_GET['kurtarc'] = @zkTemizle($_GET['kurtarc']);


	if (is_numeric($_GET['kurtarc']) == false)
	{
		header('Location: hata.php?hata=55');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// cevabın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_forumdan,silinmis,hangi_basliktan FROM $tablo_cevaplar WHERE id='$_GET[kurtarc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// cevap yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=55');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);
	// cevap zaten geri yüklenmişse
	if ($fno['silinmis'] != 1)
	{
		header('Location: hata.php?hata=169');
		exit();
	}


	// cevap geri yükleniyor
	$vtsorgu = "UPDATE $tablo_cevaplar SET silinmis=0 WHERE id='$_GET[kurtarc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// forumun cevap sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi + 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// başlığın son cevabı çekiliyor
	$vtsorgu = "SELECT id,tarih,cevap_yazan FROM $tablo_cevaplar WHERE silinmis=0 AND hangi_basliktan='$fno[hangi_basliktan]' ORDER BY tarih DESC LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$son_mesaj = $vt->fetch_assoc($vtsonuc);


	// başka cevabı yoksa, başlık tarihi son mesaj tarihi olarak giriliyor, cevap_sayi ve son_cevap sıfır yapılıyor, son_cevap_yazan siliniyor
	if (empty($son_mesaj['tarih']))
	{
		$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=0, son_mesaj_tarihi=tarih, son_cevap=0, son_cevap_yazan=NULL WHERE id='$fno[hangi_basliktan]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// cevap varsa, tarihi son mesaj tarihi olarak giriliyor, cevap sayısı bir arttırılıyor, cevap no ve cevap yazan giriliyor
	else
	{
		$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=cevap_sayi + 1, son_mesaj_tarihi='$son_mesaj[tarih]', son_cevap='$son_mesaj[id]', son_cevap_yazan='$son_mesaj[cevap_yazan]' WHERE id='$fno[hangi_basliktan]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	if (is_numeric($_GET['ks']) == false) $_GET['ks'] = 0;

	header('Location: ../konu.php?k='.$fno['hangi_basliktan'].'&amp;ks='.$_GET['ks'].'#c'.$_GET['kurtarc']);
	exit();
}




//  YORUMU GERİ YÜKLEME İŞLEMLERİ   //

elseif ( (isset($_GET['kurtary'])) AND ($_GET['kurtary'] != '') )
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
	if (isset($_GET['kurtarc'])) $_GET['kurtary'] = @zkTemizle($_GET['kurtarc']);


	if (is_numeric($_GET['kurtary']) == false)
	{
		header('Location: hata.php?hata=209');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// yorumun bilgileri çekiliyor
	$vtsorgu = "SELECT id,silinmis,uye_id,yazan_id FROM $tablo_yorumlar WHERE id='$_GET[kurtary]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// yorum yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=209');
		exit();
	}

	$yno = $vt->fetch_assoc($vtsonuc);
	// yorum zaten geri yüklenmişse
	if ($yno['silinmis'] != 1)
	{
		header('Location: hata.php?hata=210');
		exit();
	}


	// yorum geri yükleniyor
	$vtsorgu = "UPDATE $tablo_yorumlar SET silinmis=0, onay=1 WHERE id='$_GET[kurtary]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// yorum yazanın yorum sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_yapilan=yrm_yapilan + 1 WHERE id='$yno[yazan_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// yorum yapılanın yorum sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_sayi=yrm_sayi + 1 WHERE id='$yno[uye_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: hata.php?bilgi=53');
	exit();
}




//  BAŞLIK KALICI SİLME İŞLMELERİ   //

elseif ( (isset($_GET['silk'])) AND ($_GET['silk'] != '') )
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
	if (isset($_GET['silk'])) $_GET['silk'] = @zkTemizle($_GET['silk']);


	if (is_numeric($_GET['silk']) == false)
	{
		header('Location: hata.php?hata=47');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// başlığın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_forumdan,yazan FROM $tablo_mesajlar WHERE id='$_GET[silk]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// başlık yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=47');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);


	// başlık siliniyor
	$vtsorgu = "DELETE FROM $tablo_mesajlar WHERE id='$_GET[silk]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// konu açanın mesaj sayısı eksiltiliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi - 1 WHERE kullanici_adi='$fno[yazan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// cevapların bilgileri çekiliyor
	$vtsorgu = "SELECT id,cevap_yazan FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[silk]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($cevaplar = $vt->fetch_assoc($vtsonuc))
	{
		// başlığın cevapları varsa siliniyor
		$vtsorgu2 = "DELETE FROM $tablo_cevaplar WHERE id='$cevaplar[id]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

		// cevap yazanın mesaj sayısı eksiltiliyor
		$vtsorgu3 = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi - 1 WHERE kullanici_adi='$cevaplar[cevap_yazan]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
	}


	header('Location: hata.php?bilgi=6&fno='.$fno['hangi_forumdan'].'&fsayfa=0');
	exit();
}




//  CEVAP KALICI SİLME İŞLMELERİ   //

elseif ( (isset($_GET['silc'])) AND ($_GET['silc'] != '') )
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
	if (isset($_GET['silc'])) $_GET['silc'] = @zkTemizle($_GET['silc']);


	if (is_numeric($_GET['silc']) == false)
	{
		header('Location: hata.php?hata=55');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// cevabın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_basliktan,cevap_yazan FROM $tablo_cevaplar WHERE id='$_GET[silc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// cevap yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=55');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);


	// cevap siliniyor
	$vtsorgu = "DELETE FROM $tablo_cevaplar WHERE id='$_GET[silc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// cevap yazanın mesaj sayısı eksiltiliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi - 1 WHERE kullanici_adi='$fno[cevap_yazan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: hata.php?bilgi=8&mesaj_no='.$fno['hangi_basliktan'].'&fsayfa=0&sayfa=0');
	exit();
}




//  YORUMU KALICI SİLME İŞLMELERİ   //

elseif ( (isset($_GET['sily'])) AND ($_GET['sily'] != '') )
{
	if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
	if (isset($_GET['sily'])) $_GET['sily'] = @zkTemizle($_GET['sily']);


	if (is_numeric($_GET['sily']) == false)
	{
		header('Location: hata.php?hata=209');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// yorumun bilgileri çekiliyor
	$vtsorgu = "SELECT id FROM $tablo_yorumlar WHERE id='$_GET[sily]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// yorum yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=209');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);


	// yorum siliniyor
	$vtsorgu = "DELETE FROM $tablo_yorumlar WHERE id='$_GET[sily]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=52');
	exit();
}





//  SAYFA NORMAL GÖSTERİM BAŞI  //
//  SAYFA NORMAL GÖSTERİM BAŞI  //
//  SAYFA NORMAL GÖSTERİM BAŞI  //


$sayfa_adi = 'Yönetim Silinen İletiler';
include_once('bilesenler/sayfa_baslik.php');



//  FORUM BAŞLIKLARI ÇEKİLİYOR //

$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar";
$vtsonuc4 = $vt->query($vtsorgu) or die ($vt->hata_ver());

while ($forum_satir = $vt->fetch_assoc($vtsonuc4))
	$tumforum_satir[$forum_satir['id']] = $forum_satir['forum_baslik'];


//  SİLİNMİŞ KONULAR ÇEKİLİYOR   //

$vtsorgu = "SELECT id,yazan,hangi_forumdan,son_mesaj_tarihi,cevap_sayi,goruntuleme,mesaj_baslik,yazan,son_cevap_yazan FROM $tablo_mesajlar WHERE silinmis='1' ORDER BY son_mesaj_tarihi";
$vtsonuc10 = $vt->query($vtsorgu) or die ($vt->hata_ver());



//  KONULAR SIRALANIYOR //

if ($vt->num_rows($vtsonuc10))
{
	$sira = 1;

	while ($konular = $vt->fetch_assoc($vtsonuc10))
	{
		$konu_baslik = '<a href="konu_silinmis.php?k='.$konular['id'].'">'.$konular['mesaj_baslik'].'</a>';
		$forum_baslik = '<a href="../forum.php?f='.$konular['hangi_forumdan'].'">'.$tumforum_satir[$konular['hangi_forumdan']].'</a>';
		$konu_acan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';


		// cevap varsa
		if ($konular['cevap_sayi'] == 0)
		$konu_sonyazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

		// cevap yoksa
		else $konu_sonyazan = '<a href="../profil.php?kim='.$konular['son_cevap_yazan'].'">'.$konular['son_cevap_yazan'].'</a>';

		$konu_sontarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['son_mesaj_tarihi']);


		//	veriler tema motoruna yollanıyor	//

		$tekli1[] = array('{SIRA}' => $sira,
		'{KONU_BASLIK}' => $konu_baslik,
		'{FORUM_BASLIK}' => $forum_baslik,
		'{KONU_ACAN}' => $konu_acan,
		'{CEVAP_SAYI}' => $konular['cevap_sayi'],
		'{GOSTERIM}' => $konular['goruntuleme'],
		'{SON_YAZAN}' => $konu_sonyazan,
		'{TARIH}' => $konu_sontarih);

		$sira++;
	}
}



//  SİLİNMİŞ CEVAPLAR ÇEKİLİYOR   //

$vtsorgu = "SELECT id,tarih,cevap_baslik,cevap_yazan,hangi_basliktan,hangi_forumdan FROM $tablo_cevaplar WHERE silinmis='1' ORDER BY id";
$vtsonuc11 = $vt->query($vtsorgu) or die ($vt->hata_ver());


//  CEVAPLAR SIRALANIYOR //

if ($vt->num_rows($vtsonuc11))
{
	$sira = 1;

	while ($cevaplar = $vt->fetch_assoc($vtsonuc11))
	{
		// cevabın konusunun bilgileri çekiliyor
		$vtsorgu = "SELECT id,cevap_sayi,goruntuleme,mesaj_baslik,silinmis FROM $tablo_mesajlar WHERE id='$cevaplar[hangi_basliktan]'";
		$vtsonuc12 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$konular = $vt->fetch_assoc($vtsonuc12);


		// cevabın konusu silinmişse cevap bölümünde gösterme
		if ($konular['silinmis'] == 1) continue;


		// cevabın kaçıncı sırada olduğu hesaplanıyor
		$vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$cevaplar[hangi_basliktan]' AND id < $cevaplar[id]") or die ($vt->hata_ver());
		$cavabin_sirasi = $vt->num_rows($vtsonuc9);

		$sayfaya_git = ($cavabin_sirasi / $ayarlar['ksyfkota']);
		settype($sayfaya_git,'integer');
		$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

		if ($sayfaya_git != 0) $sayfaya_git = '&amp;ks='.$sayfaya_git;
		else $sayfaya_git = '';


		// bağlantılar oluşturuluyor
		$cevap_baslik = '<a href="konu_silinmis.php?k='.$konular['id'].$sayfaya_git.'#c'.$cevaplar['id'].'">'.$konular['mesaj_baslik'].' &raquo; '.$cevaplar['cevap_baslik'].'</a>';
		$forum_baslik = '<a href="../forum.php?f='.$cevaplar['hangi_forumdan'].'">'.$tumforum_satir[$cevaplar['hangi_forumdan']].'</a>';
		$cevap_yazan = '<a href="../profil.php?kim='.$cevaplar['cevap_yazan'].'">'.$cevaplar['cevap_yazan'].'</a>';

		$cevap_tarihi = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $cevaplar['tarih']);


		//	veriler tema motoruna yollanıyor	//

		$tekli2[] = array('{SIRA}' => $sira,
		'{CEVAP_BASLIK}' => $cevap_baslik,
		'{FORUM_BASLIK}' => $forum_baslik,
		'{CEVAP_YAZAN}' => $cevap_yazan,
		'{CEVAP_SAYI}' => $konular['cevap_sayi'],
		'{GOSTERIM}' => $konular['goruntuleme'],
		'{TARIH}' => $cevap_tarihi);

		$sira++;
	}
}





//  SİLİNMİŞ YORUMLAR ÇEKİLİYOR   //

$vtsorgu = "SELECT * FROM $tablo_yorumlar WHERE silinmis=1 ORDER BY id";
$vtsonuc13 = $vt->query($vtsorgu) or die ($vt->hata_ver());


//  YORUMLAR SIRALANIYOR //

if ($vt->num_rows($vtsonuc13))
{
	$sira = 1;

	while ($yorumlar = $vt->fetch_assoc($vtsonuc13))
	{
		$yorum_yazilan = '<a href="../profil.php?u='.$yorumlar['uye_id'].'">'.$yorumlar['uye_adi'].'</a>';
		$yorum_yazan = '<a href="../profil.php?u='.$yorumlar['yazan_id'].'">'.$yorumlar['yazan'].'</a>';
		$yorum_tarihi = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorumlar['tarih']);
		$yorum = bbcode_acik(ifadeler($yorumlar['yorum_icerik']),0);

		$geri = '<a href="silinmis.php?kurtary='.$yorumlar['id'].'&amp;yo='.$yo.'"><img '.$simge_gerial.' alt="Bu yorumu geri yükle" title="Bu yorumu geri yükle"></a>';

		$sil = '<a href="silinmis.php?sily='.$yorumlar['id'].'&amp;yo='.$yo.'"><img '.$simge_sil.' alt="Bu yorumu kalıcı olarak sil" title="Bu yorumu kalıcı olarak sil" onclick="return window.confirm(\'Bu yorumu kalıcı olarak silmek istediğinize emin misiniz?\')"></a>';

		//	veriler tema motoruna yollanıyor

		$tekli3[] = array('{SIRA}' => $sira,
		'{YORUM_YAZILAN}' => $yorum_yazilan,
		'{YORUM_YAZAN}' => $yorum_yazan,
		'{YORUM_TARIHI}' => $yorum_tarihi,
		'{YORUM}' => $yorum,
		'{GERI}' => $geri,
		'{SIL}' => $sil);

		$sira++;
	}
}





//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/silinmis.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



if (isset($tekli1))
{
	$ornek1->tekli_dongu('1',$tekli1);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), true);
}

else
{
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), true);
}



if (isset($tekli2))
{
	$ornek1->tekli_dongu('2',$tekli2);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), true);
}

else
{
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), true);
}


if (isset($tekli3))
{
	$ornek1->tekli_dongu('3',$tekli3);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), true);
}

else
{
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), true);
}



$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Silinen İletiler'));

eval(TEMA_UYGULA);

?>