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



        //      GİRİŞ YAP TIKLANMIŞSA   -   BAŞI    //

if ( (isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu') ):


//	GİRİŞ YAPILMIŞSA YÖNETİM ANA SAYFASINA YÖNLENDİR	//

if ( (isset($_COOKIE['yonetim_kimlik'])) AND ($_COOKIE['yonetim_kimlik'] != '') ):
	header('Location: index.php');
	exit();

else:

//	FORM DOLU DEĞİLSE UYAR		//

if ((empty($_POST['kullanici_adi'])) OR (empty($_POST['sifre'])))
{
	header('Location: ../hata.php?hata=18');
	exit();
}

if (( strlen($_POST['kullanici_adi']) >  20) or ( strlen($_POST['kullanici_adi']) <  4))
{
	header('Location: ../hata.php?hata=19');
	exit();
}

if (( strlen($_POST['sifre']) >  20) or ( strlen($_POST['sifre']) <  5))
{
	header('Location: ../hata.php?hata=20');
	exit();
}


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


//	ZARARLI KODLAR TEMİZLENİYOR	//

$_POST['kullanici_adi'] = @zkTemizle($_POST['kullanici_adi']);
$_POST['sifre'] = @zkTemizle($_POST['sifre']);
$_COOKIE['misafir_kimlik'] = @zkTemizle($_COOKIE['misafir_kimlik']);
$tarih = time();



// ŞİFRE ANAHTAR İLE KARIŞTIRILARAK VERİTABANINDAKİ İLE KARŞILAŞTIRIYOR //

$karma = sha1(($anahtar.$_POST['sifre']));

$vtsorgu = "SELECT id,sifre,kul_etkin,engelle,yetki,giris_denemesi,kilit_tarihi,kullanici_kimlik,yonetim_kimlik
		FROM $tablo_kullanicilar WHERE kullanici_adi='$_POST[kullanici_adi]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$yonetim_denetim = $vt->fetch_assoc($vtsonuc);


//	HESAP KİLİT TARİHİ KONTROL EDİLİYOR	//

if ( (isset($yonetim_denetim['kilit_tarihi'])) AND
( ($yonetim_denetim['kilit_tarihi'] + $ayarlar['kilit_sure']) > $tarih ) AND
($yonetim_denetim['giris_denemesi'] > 4) )
{
	header('Location: ../hata.php?hata=21');
	exit();
}




//	KULLANICI ADI VE ŞİFRE UYUŞMUYORSA	//

elseif ( (!$vt->num_rows($vtsonuc)) OR ($yonetim_denetim['sifre'] != $karma))
{

	//	BAŞARISIZ GİRİŞLER BEŞE ULAŞTIĞINDA HESAP KİLİTLENİYOR	//

	$vtsorgu = "UPDATE $tablo_kullanicilar
				SET kilit_tarihi='$tarih',
				giris_denemesi=giris_denemesi + 1
				WHERE kullanici_adi='$_POST[kullanici_adi]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($yonetim_denetim['giris_denemesi'] > 3)
	{
		header('Location: ../hata.php?hata=21');
		exit();
	}

	else
	{
		header('Location: ../hata.php?hata=22');
		exit();
	}
}


//	HESAP ETKİNLEŞTİRİLMEMİŞSE	//

elseif ($yonetim_denetim['kul_etkin'] == 0)
{
	header('Location: ../hata.php?hata=23');
	exit();
}


//	HESAP ENGELLENMİŞSE	//

elseif ($yonetim_denetim['engelle'] == 1)
{
	header('Location: ../hata.php?hata=24');
	exit();
}


//	YÖNETİCİ YETKİSİ YOKSA	//

elseif ($yonetim_denetim['yetki'] != 1)
{
	header('Location: ../hata.php?hata=144');
	exit();
}




//	SORUN YOK GİRİŞ YAPILIYOR	//

//	ZAMAN DEĞERİ SHA1 İLE ŞİFRELENEREK ÇEREZE YAZILIYOR //
//	BENİ HATIRLA İŞARETLİ İSE ÇEREZ GEÇERLİLİK SÜRESİ EKLENİYOR	//

elseif ($yonetim_denetim['sifre'] == $karma)
{
	if ($yonetim_denetim['kullanici_kimlik'] != '') $kullanici_kimlik = $yonetim_denetim['kullanici_kimlik'];
	else $kullanici_kimlik = sha1(microtime());
	$yonetim_kimlik = sha1(microtime());


	// Android uygulaması için
	if (@preg_match('/phpKF\ Android\ Uygulamasi/', $_SERVER['HTTP_USER_AGENT']))
	{
		if ($yonetim_denetim['kullanici_kimlik'] != '')
		{
			if ($yonetim_denetim['yonetim_kimlik'] != '') $yonetim_kimlik = $yonetim_denetim['yonetim_kimlik'];
			$kul_ip = '';
		}
		else $kul_ip = ", kul_ip='$_SERVER[REMOTE_ADDR]'";
	}
	else $kul_ip = ", kul_ip='$_SERVER[REMOTE_ADDR]'";



	if (isset($_POST['hatirla'])) $cerez_tarih = $tarih +$ayarlar['k_cerez_zaman'];
	else $cerez_tarih = 0;

	// çerez yazılıyor
	setcookie('kullanici_kimlik', $kullanici_kimlik, $cerez_tarih, $cerez_dizin, $cerez_alanadi);
	setcookie('yonetim_kimlik', $yonetim_kimlik, 0, $cerez_dizin, $cerez_alanadi);



	//	KULLANICI GİRİŞ YAPINCA AÇILAN MİSAFİR OTURUMU VE ÇEREZİ SİLİNİYOR	//

	if ( (isset($_COOKIE['misafir_kimlik'])) OR ($_COOKIE['misafir_kimlik'] != '') )
	{
		$vtsorgu = "DELETE FROM $tablo_oturumlar WHERE sid='$_COOKIE[misafir_kimlik]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		setcookie('misafir_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
	}


	//	YÖNETİCİ VE KULLANICI KİMLİK VERİTABANINA YAZILIYOR //

	$vtsorgu = "UPDATE $tablo_kullanicilar
				SET yonetim_kimlik='$yonetim_kimlik', kullanici_kimlik='$kullanici_kimlik',
				giris_denemesi=0,kilit_tarihi=0,yeni_sifre=0,
				son_giris=son_hareket, son_hareket='$tarih' $kul_ip
				WHERE id='$yonetim_denetim[id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if (isset($_POST['git']))
	{
		$_POST['git'] = @str_replace('veisareti', '&', $_POST['git']);
		if ($_POST['git'] == 'portal') header('Location: ../portal/index.php');
		elseif (preg_match('/ip_yonetimi.php\?/', $_POST['git'])) header('Location: '.$_POST['git']);
		elseif (preg_match('/eklentiler.php/', $_POST['git'])) header('Location: '.$_POST['git']);
		else header('Location: index.php');
		exit();
	}

	else
	{
		header('Location: index.php');
		exit();
	}
}
endif;


        //      GİRİŞ YAP TIKLANMIŞSA   -   SONU    //





//	GİRİŞ YAPILMIŞSA YÖNETİM ANA SAYFASINA YÖNLENDİR	//

elseif ( (isset($_COOKIE['yonetim_kimlik'])) AND ($_COOKIE['yonetim_kimlik'] != '') ):

if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';

header('Location: index.php');
exit();




// GİRİŞ YAPILMAMIŞSA GİRİŞ EKRANINI VER	//

else:
$sayfa_adi = 'Yönetim Giriş';
include_once('bilesenler/sayfa_baslik.php');



if (isset($_GET['git']))
{
	if ($_GET['git'] == 'portal') $portala_git = 'portal';
	elseif (preg_match('/ip_yonetimi.php\?/', $_GET['git'])) $portala_git = $_GET['git'];
	elseif (preg_match('/eklentiler.php/', $_GET['git'])) $portala_git = $_GET['git'];
	else $portala_git = '';
}
else $portala_git = '';


if ( isset($kullanici_kim['kullanici_adi']) ) $kulllanici_adi = $kullanici_kim['kullanici_adi'];
else $kulllanici_adi = '';



$javascript_kodu = '<script type="text/javascript"><!-- //
//  php Kolay Forum (phpKF)
//  =======================
//  Telif - Copyright (c) 2007 - 2017 phpKF Ekibi
//  http://www.phpkf.com   -   phpkf @ phpkf.com
//  Tüm hakları saklıdır - All Rights Reserved

function denetle(){ 
var dogruMu = true;
if ((document.giris.kullanici_adi.value.length < 4) || (document.giris.sifre.value.length < 5)){ 
	dogruMu = false; 
	alert("Lütfen kullanıcı adı ve şifrenizi giriniz !");}
else;
return dogruMu;}
function dogrula(girdi_ad, girdi_deger){
var alan = girdi_ad + \'-alan\';
if (girdi_ad == \'kullanici_adi\'){
	var kucuk = 4;
	var buyuk = 20;
	var desen = /^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/;}
else if (girdi_ad == \'sifre\'){
	var kucuk = 5;
	var buyuk = 20;
	var desen = /^[A-Za-z0-9-_.&]+$/;}
if ( girdi_deger.length < kucuk || girdi_deger.length > buyuk )
	document.getElementById(alan).innerHTML=\'<img width="17" height="17" src="../temalar/'.$temadizini.'/resimler/yanlis.png" alt="yanlış">\';
else if ( !girdi_deger.match(desen) )
	document.getElementById(alan).innerHTML=\'<img width="17" height="17" src="../temalar/'.$temadizini.'/resimler/yanlis.png" alt="yanlış">\';
	else document.getElementById(alan).innerHTML=\'<img width="17" height="17" src="../temalar/'.$temadizini.'/resimler/dogru.png" alt="doğru">\';}
//  -->
</script>';




$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/giris.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));

$dongusuz = array('{PORTALA_GIT}' => $portala_git,
				'{KULLANICI_ADI}' => $kulllanici_adi,
				'{JAVASCRIPT_KODU}' => $javascript_kodu);

$ornek1->dongusuz($dongusuz);

eval(TEMA_UYGULA);
endif;

?>