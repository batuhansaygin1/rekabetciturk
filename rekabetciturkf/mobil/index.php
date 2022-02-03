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


if (!@is_file('../ayar.php'))
{
	// ayar.php yok, kurulum yapılmamış, kurulum sayfasına yönlendir.
	header('Location: ../kurulum/index.php');
	exit();
}


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
$sayfano = 41;
$sayfa_adi = 'Ana Sayfa';
$tarih = time();




// Veriler Temizleniyor
if (isset($_GET['ak']))
{
	$_GET['ak'] = @zkTemizle($_GET['ak']);
	$_GET['ak'] = @str_replace(array('-','x','.'), '', $_GET['ak']);
	if (!is_numeric($_GET['ak'])) $_GET['ak'] = 0;
	if ($_GET['ak'] < 0) $_GET['ak'] = 0;
}
else $_GET['ak'] = 0;


if (isset($_GET['aks']))
{
	$_GET['aks'] = @zkTemizle($_GET['aks']);
	$_GET['aks'] = @str_replace(array('-','x','.'), '', $_GET['aks']);
	if (!is_numeric($_GET['aks'])) $_GET['aks'] = 0;
	if ($_GET['aks'] < 0) $_GET['aks'] = 0;
}
else $_GET['aks'] = 0;


if (isset($_GET['af']))
{
	$_GET['af'] = @zkTemizle($_GET['af']);
	$_GET['af'] = @str_replace(array('-','x','.'), '', $_GET['af']);
	if (!is_numeric($_GET['af'])) $_GET['af'] = 0;
	if ($_GET['af'] < 0) $_GET['af'] = 0;
}
else $_GET['af'] = 0;


if (isset($_GET['afs']))
{
	$_GET['afs'] = @zkTemizle($_GET['afs']);
	$_GET['afs'] = @str_replace(array('-','x','.'), '', $_GET['afs']);
	if (!is_numeric($_GET['afs'])) $_GET['afs'] = 0;
	if ($_GET['afs'] < 0) $_GET['afs'] = 0;
}
else $_GET['afs'] = 0;







//	KONU GÖSTERİMİ - BAŞI	//
//	KONU GÖSTERİMİ - BAŞI	//
//	KONU GÖSTERİMİ - BAŞI	//

if ($_GET['ak'] > 0)
{

$vtsorgu = "SELECT
id,tarih,hangi_forumdan,yazan,mesaj_baslik,mesaj_icerik,tarih,cevap_sayi,kilitli,bbcode_kullan,ifade
FROM $tablo_mesajlar WHERE id='$_GET[ak]' AND silinmis='0' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$mesaj_satir = $vt->fetch_assoc($vtsonuc);


if ($mesaj_satir['mesaj_baslik'] != '')
	$sayfa_adi = $mesaj_satir['mesaj_baslik'];

else $sayfa_adi = 'Mobil Sürüm Konu: Yok';

$sayfano = '47,'.$_GET['ak'];
include 'bilesenler/sayfa_baslik.php';

// Dizin - Dosya adı
if ($dizin_bilgi == '')
{
	$mobil_dosya = 'mobil.php';
}

else
{
	$mobil_dosya = 'index.php';
}


// konu yoksa
if (empty($mesaj_satir)) $hata_iletisi = '<br><br>Seçtiğiniz konu veritabanında bulunmamaktadır !<br><br>';


// forum bilgileri çekiliyor
$vtsorgu = "SELECT id,forum_baslik,okuma_izni,konu_acma_izni,alt_forum FROM $tablo_forumlar WHERE id='$mesaj_satir[hangi_forumdan]' LIMIT 1";
$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
$forum_satir2 = $vt->fetch_assoc($vtsonuc2);


if ($forum_satir2['alt_forum'] != '0')
{
	$alt_forum_baslik = '&nbsp;<a href="'.$mobil_dosya.'?af='.$mesaj_satir['hangi_forumdan'].'">'.$forum_satir2['forum_baslik'].'</a>';

	$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar WHERE id='$forum_satir2[alt_forum]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir3 = $vt->fetch_assoc($vtsonuc2);

	$ust_forum_baslik = '&nbsp;<a href="'.$mobil_dosya.'?af='.$forum_satir3['id'].'">'.$forum_satir3['forum_baslik'].'</a> &nbsp;&raquo;<br>';
}

else
{
	$ust_forum_baslik = '&nbsp;<a href="'.$mobil_dosya.'?af='.$mesaj_satir['hangi_forumdan'].'">'.$forum_satir2['forum_baslik'].'</a>';
	$alt_forum_baslik = '';
}



//	KULLANICIYA GÖRE FORUM GÖSTERİMİ - BAŞI	//


//	FORUM HERKESE KAPALIYSA	//

if ($forum_satir2['okuma_izni'] == 5)
{
	// sadece yöneticiyse girebilir
	if ( (!isset($kullanici_kim['yetki']) ) OR ($kullanici_kim['yetki'] != 1) )
		$hata_iletisi = 'Bu forum kapatılmıştır !';
}


//	FORUM MİSAFİRLERE KAPALIYSA		//

if ($forum_satir2['okuma_izni'] > 0)
{
	// üye değilse - ziyaretçiyse
	if (empty($kullanici_kim['id'])) $hata_iletisi = 'Bu foruma sadece üyeler girebilir !';
}


//	SADECE YÖNETİCİLER İÇİNSE	//

if ($forum_satir2['okuma_izni'] == 1)
{
	if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		$hata_iletisi ='Bu foruma sadece yöneticiler girebilir !';
}


//	SADECE YÖNETİCİLER VE YARDIMCILAR İÇİNSE	//

elseif ($forum_satir2['okuma_izni'] == 2)
{
	if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1)
		AND ($kullanici_kim['yetki'] != 2) AND ($kullanici_kim['yetki'] != 3) )
			$hata_iletisi = 'Bu foruma sadece yöneticiler ve yardımcılar girebilir !';
}


//	SADECE ÖZEL ÜYELER İÇİNSE 	//

elseif ($forum_satir2['okuma_izni'] == 3)
{
	//	YÖNETİCİ DEĞİLSE YARDIMCILIĞINA BAK	//

	if (isset($kullanici_kim['yetki']))
	{
		if (($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2));

		elseif ($kullanici_kim['yetki'] == 3)
		{
			$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE kulad='$kullanici_kim[kullanici_adi]' AND fno='$_GET[af]' AND okuma='1'";
			$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

			if ( !$vt->num_rows($kul_izin) ) $hata_iletisi = 'Bu foruma sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';
		}

		else $hata_iletisi = 'Bu foruma sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';
	}
}

//	KULLANICIYA GÖRE FORUM GÖSTERİMİ - SONU	//






// OLUŞTURULACAK SAYFA SAYISI BAĞLANTISI //

$satir_sayi = $mesaj_satir['cevap_sayi'];

$sinir = 8;

$toplam_sayfa = ($satir_sayi / $sinir);
settype($toplam_sayfa,'integer');

if ( ($satir_sayi % $sinir) != 0 )
$toplam_sayfa++;



//	SAYFA BAĞLANTILARI OLUŞTURULUYOR BAŞI	//

$sayfalama_cikis ='';

if ($satir_sayi > $sinir):

$sayfalama_cikis .= '<div class="sayfalama-kutu">
<div class="sayfalama"><ul>';

if ($_GET['aks'] != 0)
{
	$sayfalama_cikis .= '<li title="ilk sayfa"><a href="'.$mobil_dosya.'?ak='.$_GET['ak'].'">&laquo;</a></li>

	<li title="önceki sayfa"><a href="'.$mobil_dosya.'?ak='.$_GET['ak'].'&amp;aks='.($_GET['aks'] - $sinir).'">&lt;</a></li>';
}

for ($sayi=0,$sayfa_sinir=$_GET['aks']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['aks'] / $sinir) - 3));
	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['aks'] + 8))  break;
		if (($sayi == 0) AND ($_GET['aks'] == 0))
		{
			$sayfalama_cikis .= '<li title="Şu anki sayfa" class="aktif"><a name="#">[1]</a></li>';
		}

		elseif (($sayi + 1) == (($_GET['aks'] / $sinir) + 1))
		{
			$sayfalama_cikis .= '<li title="Şu anki sayfa" class="aktif"><a name="#">['.($sayi + 1).']</a></li>';
		}

		else
		{
			$sayfalama_cikis .= '<li title="'.($sayi + 1).'. sayfaya git"><a href="'.$mobil_dosya.'?ak='.$_GET['ak'].'&amp;aks='.($sayi * $sinir).'">'.($sayi + 1).'</a></li>';
		}
	}
}

if ($_GET['aks'] < ($satir_sayi - $sinir))
{
	$sayfalama_cikis .= '<li class="liste-veri" title="sonraki sayfa"><a href="'.$mobil_dosya.'?ak='.$_GET['ak'].'&amp;aks='.($_GET['aks'] + $sinir).'">&gt;</a></li>

	<li class="liste-veri" title="son sayfa"><a href="'.$mobil_dosya.'?ak='.$_GET['ak'].'&amp;aks='.(($toplam_sayfa - 1) * $sinir).'">&raquo;</a></li>';
}

$sayfalama_cikis .= '</ul></div><div class="clear"></div></div>';

endif;

// SAYFA BAĞLANTILARI OLUŞTURULUYOR - SONU //




if ($mesaj_satir['ifade'] == 1)
	$mesaj_satir['mesaj_icerik'] = ifadeler($mesaj_satir['mesaj_icerik']);

if ( ($mesaj_satir['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	$konu_icerik = bbcode_acik($mesaj_satir['mesaj_icerik'],$mesaj_satir['id']);

else $konu_icerik = bbcode_kapali($mesaj_satir['mesaj_icerik']);


//  konu sadece ilk sayfada gösteriliyor  //

if ($_GET['aks'] < 1 )
{
	$konu_baslik = '<a href="'.$dizin_bilgi.'konu.php?k='.$mesaj_satir['id'].'">&nbsp;'.$mesaj_satir['mesaj_baslik'].'</a>';
	$yazan = '<a href="'.$dizin_bilgi.'profil.php?kim='.$mesaj_satir['yazan'].'">'.$mesaj_satir['yazan'].'</a>';
	$kctarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $mesaj_satir['tarih']);
	$cevapno = '';

	//	veriler tema motoruna yollanıyor
	$tekli1[] = array('{BASLIK}' => $konu_baslik,
	'{YAZAN}' => $yazan,
	'{CEVAPNO}' => $cevapno,
	'{TARIH}' => $kctarih,
	'{ICERIK}' => $konu_icerik);
}



// CEVAP BİLGİLERİ ÇEKİLİYOR

$vtsorgu = "SELECT
id,cevap_yazan,cevap_baslik,cevap_icerik,tarih,bbcode_kullan,ifade
FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$_GET[ak]' ORDER BY tarih LIMIT $_GET[aks],$sinir";
$cevap = $vt->query($vtsorgu) or die ($vt->hata_ver());


if ( (!isset($_GET['aks'])) OR ($_GET['aks'] <= 0) ) $sira = 1;
else $sira = $_GET['aks']+1;


while ($cevap_satir = $vt->fetch_assoc($cevap))
{
	$yazan = '<a href="'.$dizin_bilgi.'profil.php?kim='.$cevap_satir['cevap_yazan'].'">'.$cevap_satir['cevap_yazan'].'</a>';
	$kctarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $cevap_satir['tarih']);
	$cevapno = '<div class="yazar-sag">Cevap: '.$sira.'</div>';

	if ($cevap_satir['ifade'] == 1)
		$cevap_satir['cevap_icerik'] = ifadeler($cevap_satir['cevap_icerik']);

	if ( ($cevap_satir['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
		$cevap_icerik = bbcode_acik($cevap_satir['cevap_icerik'],$cevap_satir['id']);

	else $cevap_icerik = bbcode_kapali($cevap_satir['cevap_icerik']);


	//	veriler tema motoruna yollanıyor
	$tekli1[] = array('{BASLIK}' => $cevap_satir['cevap_baslik'],
	'{YAZAN}' => $yazan,
	'{CEVAPNO}' => $cevapno,
	'{TARIH}' => $kctarih,
	'{ICERIK}' => $cevap_icerik);
	$sira++;
}




//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/konu.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


if (isset($hata_iletisi))
{
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{HATA_ILETISI}' => $hata_iletisi), true);
}
else
{
	// Hızlı Cevap

	if (isset($kullanici_kim['id']))
	{
		if ($mesaj_satir['kilitli'] == 1) $form_ksayfa = 0;
		else
		{
			if ($satir_sayi < $sinir) $form_ksayfa = 0;
			elseif ( ($satir_sayi % $sinir) == 0 ) $form_ksayfa = $satir_sayi; 
			else $form_ksayfa = $satir_sayi - ($satir_sayi % $sinir);
		}

		$form_bilgi = '<form action="'.$dizin_bilgi.'bilesenler/mesaj_yaz_yap.php" method="post" onsubmit="return denetle_duzenleyici()" name="form1" id="duzenleyici_form">
		<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
		<input type="hidden" name="sayfa_onizleme" value="mesaj_yaz">
		<input type="hidden" name="mesaj_onizleme" value="Önizleme">
		<input type="hidden" name="bbcode_kullan" value="1">
		<input type="hidden" name="ifade" value="1">
		<input type="hidden" name="kip" value="cevapla">
		<input type="hidden" name="mobil" value="mobil">
		<input type="hidden" name="mesaj_baslik" value="Cvp:">
		<input type="hidden" name="fno" value="'.$mesaj_satir['hangi_forumdan'].'">
		<input type="hidden" name="mesaj_no" value="'.$mesaj_satir['id'].'">
		<input type="hidden" name="fsayfa" value="0">
		<input type="hidden" name="sayfa" value="'.$form_ksayfa.'">';

		$ornek1->kosul('3', array('{FORM_BILGI}' => $form_bilgi), true);
	}
	else
	{
		$ornek1->kosul('3', array('' => ''), false);
	}

	$ornek1->kosul('1', array('' => ''), false);
}

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);


$ornek1->dongusuz(array('{SAYFA_BASLIK}' => $ayarlar['anasyfbaslik'],
'{FORUM_BASLIK}' => $ust_forum_baslik,
'{ALT_FORUM_BASLIK}' => $alt_forum_baslik,
'{KONU_BASLIK}' => $mesaj_satir['mesaj_baslik'],
'{DIZIN}' => $dizin_bilgi,
'{FORM_ICERIK}' => '',
'{SAYFALAMA}' => $sayfalama_cikis));
ini_set('include_path', 'mobil');
eval(TEMA_UYGULA);
exit();
}


//	KONU GÖSTERİMİ - SONU	//
//	KONU GÖSTERİMİ - SONU	//
//	KONU GÖSTERİMİ - SONU	//






//	FORUM GÖSTERİMİ - BAŞI	//
//	FORUM GÖSTERİMİ - BAŞI	//
//	FORUM GÖSTERİMİ - BAŞI	//


$sinir = 50;

if ($_GET['af'] > 0)
{

if ($_GET['afs'] == 0)
{
	$afs = '';
	$fsayfa = 0;
}
else
{
	$afs = '&amp;afs='.$_GET['afs'];
	$fsayfa = $_GET['afs'];
}

$vtsorgu = "SELECT id,tarih,yazan,son_cevap_yazan,mesaj_baslik,ust_konu,son_mesaj_tarihi,ust_konu as siralama FROM $tablo_mesajlar WHERE silinmis='0' AND hangi_forumdan='$_GET[af]' AND ust_konu='1'
UNION SELECT id,tarih,yazan,son_cevap_yazan,mesaj_baslik,ust_konu,son_mesaj_tarihi,ust_konu as siralama FROM $tablo_mesajlar WHERE silinmis='0' AND hangi_forumdan='$_GET[af]'
ORDER BY ust_konu DESC, son_mesaj_tarihi DESC LIMIT $_GET[afs],$sinir";
$baslik_sirala = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "SELECT id,forum_baslik,okuma_izni,konu_acma_izni,alt_forum,konu_sayisi FROM $tablo_forumlar WHERE id='$_GET[af]' LIMIT 1";
$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
$forum_satir = $vt->fetch_assoc($vtsonuc2);


// Sayfa başlığı
if ($forum_satir['forum_baslik'] != '')
	$sayfa_adi = $forum_satir['forum_baslik'];

else $sayfa_adi = 'Mobil Sürüm Bölüm: Yok';

$sayfano = '48,'.$_GET['af'];
include 'bilesenler/sayfa_baslik.php';

// Dizin - Dosya adı
if ($dizin_bilgi == '')
{
	$mobil_dosya = 'mobil.php';
}

else
{
	$mobil_dosya = 'index.php';
}


// forum yoksa
if (empty($forum_satir)) $hata_iletisi = '<br><br>Seçtiğiniz forum veritabanında bulunmamaktadır !<br><br>';


// forumda konu yoksa
if ($forum_satir['konu_sayisi'] == '0') $hata_iletisi = '<br><br>Bu forumda henüz hiçbir yazı bulunmamaktadır !<br><br>';



if ($forum_satir['alt_forum'] != '0')
{
	$alt_forum_baslik = '&nbsp;<a href="'.$mobil_dosya.'?af='.$forum_satir['id'].'">'.$forum_satir['forum_baslik'].'</a>';

	$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar WHERE id='$forum_satir[alt_forum]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir2 = $vt->fetch_assoc($vtsonuc2);

	$ust_forum_baslik = '<br>&nbsp;<a href="'.$mobil_dosya.'?af='.$forum_satir2['id'].'">'.$forum_satir2['forum_baslik'].'</a> &nbsp;&raquo;<br>';
}

else
{
	$ust_forum_baslik = '<br>&nbsp;<a href="'.$mobil_dosya.'?af='.$forum_satir['id'].'">'.$forum_satir['forum_baslik'].'</a>';
	$alt_forum_baslik = '';
}




//	KULLANICIYA GÖRE FORUM GÖSTERİMİ - BAŞI	//


//	FORUM HERKESE KAPALIYSA	//

if ($forum_satir['okuma_izni'] == 5)
{
	// sadece yöneticiyse girebilir
	if ( (!isset($kullanici_kim['yetki']) ) OR ($kullanici_kim['yetki'] != 1) )
		$hata_iletisi = 'Bu forum kapatılmıştır !';
}


//	FORUM MİSAFİRLERE KAPALIYSA		//

if ($forum_satir['okuma_izni'] > 0)
{
	// üye değilse - ziyaretçiyse
	if (empty($kullanici_kim['id'])) $hata_iletisi = 'Bu foruma sadece üyeler girebilir !';
}


//	SADECE YÖNETİCİLER İÇİNSE	//

if ($forum_satir['okuma_izni'] == 1)
{
	if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		$hata_iletisi = 'Bu foruma sadece yöneticiler girebilir !';
}


//	SADECE YÖNETİCİLER VE YARDIMCILAR İÇİNSE	//

elseif ($forum_satir['okuma_izni'] == 2)
{
	if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1)
		AND ($kullanici_kim['yetki'] != 2) AND ($kullanici_kim['yetki'] != 3) )
		$hata_iletisi = 'Bu foruma sadece yöneticiler ve yardımcılar girebilir !';
}


//	SADECE ÖZEL ÜYELER İÇİNSE 	//

elseif ($forum_satir['okuma_izni'] == 3)
{
	//	YÖNETİCİ DEĞİLSE YARDIMCILIĞINA BAK	//

	if (isset($kullanici_kim['yetki']))
	{
		if (($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2));

		elseif ($kullanici_kim['yetki'] == 3)
		{
			$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE kulad='$kullanici_kim[kullanici_adi]' AND fno='$_GET[af]' AND okuma='1'";
			$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

			if (!$vt->num_rows($kul_izin)) $hata_iletisi = 'Bu foruma sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';
		}

		else $hata_iletisi = 'Bu foruma sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';
	}
}

//	KULLANICIYA GÖRE FORUM GÖSTERİMİ - SONU	//




// OLUŞTURULACAK SAYFA SAYISI BAĞLANTISI //

$satir_sayi = $forum_satir['konu_sayisi'];

$toplam_sayfa = ($satir_sayi / $sinir);
settype($toplam_sayfa,'integer');

if ( ($satir_sayi % $sinir) != 0 )
$toplam_sayfa++;



//	SAYFA BAĞLANTILARI OLUŞTURULUYOR BAŞI	//

$sayfalama_cikis ='';

if ($satir_sayi > $sinir):

$sayfalama_cikis .= '<div class="sayfalama-kutu">
<div class="sayfalama"><ul>';

if ($_GET['afs'] != 0)
{
	$sayfalama_cikis .= '<li title="ilk sayfa"><a href="'.$mobil_dosya.'?af='.$_GET['af'].'">&laquo;</a></li>
<li title="önceki sayfa"><a href="'.$mobil_dosya.'?af='.$_GET['af'].'&amp;afs='.($_GET['afs'] - $sinir).'">&lt;</a></li>';
}

for ($sayi=0,$sayfa_sinir=$_GET['afs']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['afs'] / $sinir) - 3));
	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['afs'] + 8))  break;
		if (($sayi == 0) AND ($_GET['afs'] == 0))
		{
			$sayfalama_cikis .= '<li title="Şu anki sayfa" class="aktif"><a name="#">[1]</a></li>';
		}

		elseif (($sayi + 1) == (($_GET['afs'] / $sinir) + 1))
		{
			$sayfalama_cikis .= "\r\n".'<li title="Şu anki sayfa" class="aktif"><a name="#">['.($sayi + 1).']</a></li>';
		}

		else
		{
			$sayfalama_cikis .= "\r\n".'<li title="'.($sayi + 1).'. sayfaya git"><a href="'.$mobil_dosya.'?af='.$_GET['af'].'&amp;afs='.($sayi * $sinir).'">'.($sayi + 1).'</a></li>';
		}
	}
}

if ($_GET['afs'] < ($satir_sayi - $sinir))
{
	$sayfalama_cikis .= '<li title="sonraki sayfa"><a href="'.$mobil_dosya.'?af='.$_GET['af'].'&amp;afs='.($_GET['afs'] + $sinir).'">&gt;</a></li>
<li title="son sayfa"><a href="'.$mobil_dosya.'?af='.$_GET['af'].'&amp;afs='.(($toplam_sayfa - 1) * $sinir).'">&raquo;</a></li>';
}

$sayfalama_cikis .= '</div><div class="clear"></div></div>';

endif;

// SAYFA BAĞLANTILARI OLUŞTURULUYOR - SONU //



if ( (!isset($_GET['afs'])) OR ($_GET['afs'] <= 0) ) $sira = 1;
else $sira = $_GET['afs']+1;


while ($satir = $vt->fetch_assoc($baslik_sirala))
{
	if ($satir['ust_konu'] == '1') $konu_baslik = '<b>üst konu:</b> '.$satir['mesaj_baslik'];
	else $konu_baslik = $satir['mesaj_baslik'];
	$konu_baglanti = $mobil_dosya.'?ak='.$satir['id'];
	$konu_yazan = $satir['yazan'];
	$konu_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['tarih']);
	$konu_soncevap_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['son_mesaj_tarihi']);


	if ($satir['son_cevap_yazan'] != '') $konu_soncevap_yazan = $satir['son_cevap_yazan'];
	else $konu_soncevap_yazan = $satir['yazan'];


	//	veriler tema motoruna yollanıyor
	$tekli1[] = array('{SIRA}' => $sira,
	'{KONU_BASLIK}' => $konu_baslik,
	'{KONU_BAGLANTI}' => $konu_baglanti,
	'{KONU_YAZAN}' => $satir['yazan'],
	'{KONU_TARIH}' => $konu_tarih,
	'{KONU_SONCEVAP_YAZAN}' => $konu_soncevap_yazan,
	'{KONU_SONCEVAP_TARIH}' => $konu_soncevap_tarih);
	$sira++;
}



//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/forum.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


if (isset($hata_iletisi))
{
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{HATA_ILETISI}' => $hata_iletisi), true);
}
else
{
	// Hızlı Konu Açma

	if (isset($kullanici_kim['id']))
	{
		$form_bilgi = '<form action="'.$dizin_bilgi.'bilesenler/mesaj_yaz_yap.php" method="post" onsubmit="return denetle_duzenleyici()" name="form1" id="duzenleyici_form">
		<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
		<input type="hidden" name="sayfa_onizleme" value="mesaj_yaz">
		<input type="hidden" name="mesaj_onizleme" value="Önizleme">
		<input type="hidden" name="bbcode_kullan" value="1">
		<input type="hidden" name="ifade" value="1">
		<input type="hidden" name="kip" value="yeni">
		<input type="hidden" name="mesaj_no" value="0">
		<input type="hidden" name="mobil" value="mobil">
		<input type="hidden" name="fno" value="'.$forum_satir['id'].'">
		<input type="hidden" name="fsayfa" value="'.$fsayfa.'">';

		$ornek1->kosul('3', array('{FORM_BILGI}' => $form_bilgi), true);
	}
	else
	{
		$ornek1->kosul('3', array('' => ''), false);
	}

	$ornek1->kosul('1', array('' => ''), false);
}

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);


$ornek1->dongusuz(array('{SAYFA_BASLIK}' => $ayarlar['anasyfbaslik'],
'{FORUM_BASLIK}' => $ust_forum_baslik,
'{ALT_FORUM_BASLIK}' => $alt_forum_baslik,
'{DIZIN}' => $dizin_bilgi,
'{FORM_ICERIK}' => '',
'{SAYFALAMA}' => $sayfalama_cikis));
ini_set('include_path', 'mobil');
eval(TEMA_UYGULA);
exit();

}

//	FORUM GÖSTERİMİ - SONU	//
//	FORUM GÖSTERİMİ - SONU	//
//	FORUM GÖSTERİMİ - SONU	//




//	ANA SAYFA GÖSTERİMİ - BAŞI	//
//	ANA SAYFA GÖSTERİMİ - BAŞI	//
//	ANA SAYFA GÖSTERİMİ - BAŞI	//


$sayfano = 41;
include 'bilesenler/sayfa_baslik.php';

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/index.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


// Dizin - Dosya adı
if ($dizin_bilgi == '')
{
	$mobil_dosya = 'mobil.php';
}

else
{
	$mobil_dosya = 'index.php';
}


// Dallar Sıralanıyor

$vtsorgu = "SELECT * FROM $tablo_dallar ORDER BY sira";
$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
$dongu1 = 0;

while ($dallar_satir = $vt->fetch_assoc($vtsonuc3))
{
	if (strlen($dallar_satir['ana_forum_baslik']) > 50)
		$dal_baslik = mb_substr($dallar_satir['ana_forum_baslik'],0,50, 'utf-8');
	else $dal_baslik = $dallar_satir['ana_forum_baslik'];

	$tema_dis[] = array('{FORUM_DALI_BASLIK}' => $dal_baslik);


	$vtsorgu = "SELECT id,forum_baslik,okuma_izni,gizle,forum_bilgi,resim FROM $tablo_forumlar WHERE alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
	$vtsonuc4 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//	ÜST FORUMLAR SIRALANIYOR    //

	while ($forum_satir = $vt->fetch_assoc($vtsonuc4))
	{
		// alt forumların bilgileri çekiliyor
		$vtsorgu = "SELECT id,forum_baslik,okuma_izni,gizle,forum_bilgi,resim FROM $tablo_forumlar WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
		$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$alt_forum_sorgu = '';
		$fkonu_sayisi = 0;
		$fmesaj_sayisi = 0;


		// Yetkiye göre üst forum (ve konu) başlığı gizleme

		if (($forum_satir['gizle'] == 1) AND ($forum_satir['okuma_izni'] != 0))
		{
			if (isset($kullanici_kim['id']))
			{
				if (($forum_satir['okuma_izni'] == 5) AND ($kullanici_kim['yetki'] != 1)) continue;

				elseif (($forum_satir['okuma_izni'] == 1) AND ($kullanici_kim['yetki'] != 1)) continue;

				elseif (($forum_satir['okuma_izni'] == 2) AND ($kullanici_kim['yetki'] == 0)) continue;

				elseif (($forum_satir['okuma_izni'] == 3) AND ($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2))
				{
					if ($kullanici_kim['yetki'] >= 0)
					{
						$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE kulad='$kullanici_kim[kullanici_adi]' AND fno='$forum_satir[id]' AND okuma='1'";
						$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());
						if (!$vt->num_rows($kul_izin)) continue;
					}
					else continue;
				}
			}

			else continue;
		}


		if (empty($forum_satir['resim'])) $forum_klasor = '<img src="'.$dizin_bilgi.'mobil/temalar/'.$temadizini.'/resimler/forum01.gif" alt="forum simgesi">';
		else {
			$forum_klasor = '<img src="';
			if ( (!preg_match('/\/\//i', $forum_satir['resim'])) AND (!preg_match('/^\//i', $forum_satir['resim'])) ) $forum_klasor .= $dizin_bilgi;
			$forum_klasor .= $forum_satir['resim'].'" alt="forum simgesi">';
		}

		$frmbilgi = str_replace('<br>', '', $forum_satir['forum_bilgi']);
		$forum_baglanti = $mobil_dosya.'?af='.$forum_satir['id'];


		//	veriler tema motoruna yollanıyor	//

		$tema_ic[$dongu1][] = array('{ALTFORUM_CLASS}' => '',
		'{FORUM_BAGLANTI}' => $forum_baglanti,
		'{FORUM_KLASOR}' => $forum_klasor,
		'{FORUM_BASLIK}' => $forum_satir['forum_baslik'],
		'{FORUM_BILGI}' => $frmbilgi);


		// alt forum varsa
		if ($vt->num_rows($vtsonuc5))
		{
			//	ALT FORUMLAR SIRALANIYOR    //
			while ($alt_forum_satir = $vt->fetch_assoc($vtsonuc5))
			{
				// Yetkiye göre alt forum (ve konu) başlığı gizleme
				if (($alt_forum_satir['gizle'] == 1) AND ($alt_forum_satir['okuma_izni'] != 0))
				{
					if (isset($kullanici_kim['id']))
					{
						if (($alt_forum_satir['okuma_izni'] == 5) AND ($kullanici_kim['yetki'] != 1)) continue;

						elseif (($alt_forum_satir['okuma_izni'] == 1) AND ($kullanici_kim['yetki'] != 1)) continue;

						elseif (($alt_forum_satir['okuma_izni'] == 2) AND ($kullanici_kim['yetki'] == 0)) continue;

						elseif (($alt_forum_satir['okuma_izni'] == 3) AND ($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2))
						{
							if ($kullanici_kim['yetki'] >= 0)
							{
								$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE kulad='$kullanici_kim[kullanici_adi]' AND fno='$alt_forum_satir[id]' AND okuma='1'";
								$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());
								if (!$vt->num_rows($kul_izin)) continue;
							}
							else continue;
						}
					}
					else continue;
				}


				if (empty($alt_forum_satir['resim'])) $forum_klasor = '<img src="'.$dizin_bilgi.'mobil/temalar/'.$temadizini.'/resimler/forum01.gif" alt="forum simgesi">';
				else{
					$forum_klasor = '<img src="';
					if ( (!preg_match('/\/\//i', $alt_forum_satir['resim'])) AND (!preg_match('/^\//i', $alt_forum_satir['resim'])) ) $forum_klasor .= $dizin_bilgi;
					$forum_klasor .= $alt_forum_satir['resim'].'" alt="forum simgesi">';
				}

				$frmbilgi = str_replace('<br>', '', $alt_forum_satir['forum_bilgi']);
				$forum_baglanti = $mobil_dosya.'?af='.$alt_forum_satir['id'];


				//	veriler tema motoruna yollanıyor	//
				$tema_ic[$dongu1][] = array('{ALTFORUM_CLASS}' => 'class="altforum"',
				'{FORUM_BAGLANTI}' => $forum_baglanti,
				'{FORUM_KLASOR}' => $forum_klasor,
				'{FORUM_BASLIK}' => $alt_forum_satir['forum_baslik'],
				'{FORUM_BILGI}' => $frmbilgi);


				$alt_forum_sorgu .= "OR silinmis='0' AND hangi_forumdan='$alt_forum_satir[id]' ";
			}
		}
	}

	if (!isset($tema_ic[$dongu1]))
	{
		$tema_ic[$dongu1][] = array('{ALTFORUM_CLASS}' => 'class="altforum"',
		'{FORUM_BAGLANTI}' => '',
		'{FORUM_KLASOR}' => '',
		'{FORUM_BASLIK}' => 'HENÜZ FORUM OLUŞTURULMAMIŞ',
		'{FORUM_BILGI}' => '');
	}

	$dongu1++;
}




//  GÜNCEL KONULAR - BAŞI  //

if ($ayarlar['sonkonular'] == 1)
{
	//  Güncel konuların bilgileri çekiliyor
	$vtsorgu = "SELECT id,tarih,mesaj_baslik,yazan,son_mesaj_tarihi,son_cevap_yazan FROM $tablo_mesajlar WHERE silinmis=0 ORDER BY son_mesaj_tarihi DESC LIMIT $ayarlar[kacsonkonu]";
	$vtsonuc6 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while ($son10 = $vt->fetch_assoc($vtsonuc6))
	{
		$guncel_baglanti = $mobil_dosya.'?ak='.$son10['id'];
		$guncel_yazan = $son10['yazan'];
		$guncel_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $son10['tarih']);
		$guncel_soncevap_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $son10['son_mesaj_tarihi']);


		if ($son10['son_cevap_yazan'] != '') $son10_soncevap_yazan = $son10['son_cevap_yazan'];
		else $son10_soncevap_yazan = $son10['yazan'];


		//	veriler tema motoruna yollanıyor
		$tekli1[] = array('{GUNCEL_BAGLANTI}' => $guncel_baglanti,
		'{GUNCEL_BASLIK}' => $son10['mesaj_baslik'],
		'{GUNCEL_YAZAN}' => $son10['yazan'],
		'{GUNCEL_TARIH}' => $guncel_tarih,
		'{GUNCEL_SONCEVAP_YAZAN}' => $son10_soncevap_yazan,
		'{GUNCEL_SONCEVAP_TARIH}' => $guncel_soncevap_tarih);
	}
}
//  GÜNCEL KONULAR - SONU  //



//	TEMA UYGULANIYOR	//

// forum var - yok

if ( (isset($tema_dis)) AND (isset($tema_ic)) )
{
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->icice_dongu('1', $tema_dis, $tema_ic);
}

else
{
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{HATA_ILETISI}' => 'HENÜZ FORUM DALI OLUŞTURULMAMIŞ'), true);
}

if (isset($tekli1)) $ornek1->tekli_dongu('1',$tekli1);
else $ornek1->kosul('3', array('' => ''), false);

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => $ayarlar['anasyfbaslik'], '{DIZIN}' => $dizin_bilgi));
ini_set('include_path', 'mobil');
eval(TEMA_UYGULA);
exit();

//	ANA SAYFA GÖSTERİMİ - SONU	//
//	ANA SAYFA GÖSTERİMİ - SONU	//
//	ANA SAYFA GÖSTERİMİ - SONU	//

?>