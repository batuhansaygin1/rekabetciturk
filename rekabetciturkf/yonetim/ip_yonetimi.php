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
include_once('../bilesenler/seo.php');
include '../bilesenler/hangi_sayfada.php';


$adim = 20;

if (empty($_GET['sayfa'])) $sayfa = 0;

else
{
	$_GET['sayfa'] = @zkTemizle($_GET['sayfa']);
	$_GET['sayfa'] = @str_replace(array('-','x'), '', $_GET['sayfa']);
	if (is_numeric($_GET['sayfa']) == false) $_GET['sayfa'] = 0;
	if ($_GET['sayfa'] < 0) $_GET['sayfa'] = 0;
	$sayfa = $_GET['sayfa'];
}

// ip adresi kontrol ediliyor

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == '1') )
{
	if ( (!isset($_GET['ip'])) OR ($_GET['ip'] == '') OR (!preg_match('/^[0-9.]+$/', $_GET['ip'])) )
	{
		header('Location: hata.php?hata=190');
		exit();
	}

	$_GET['ip'] = zkTemizle3(zkTemizle4($_GET['ip']));
}


// kullanıcı adı kontrol ediliyor

elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == '2') )
{
	if ( ( strlen($_GET['kim']) < 4) OR ( strlen($_GET['kim']) > 20))
	{
		header('Location: hata.php?hata=46');
		exit();
	}

	$_GET['kim'] = zkTemizle3(zkTemizle4(trim($_GET['kim'])));

	$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar WHERE kullanici_adi='$_GET[kim]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kullanici = $vt->fetch_array($vtsonuc);

	if (empty($kullanici))
	{
		header('Location: hata.php?hata=46');
		exit();
	}
}




$sayfa_adi = 'Yönetim IP Yönetimi';
include_once('bilesenler/sayfa_baslik.php');
$sayfa_baslik = 'IP Yönetimi';


//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/ip_yonetimi.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));





//  IP ADRESİNE GÖRE ARAMA - BAŞI    //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == '1') ):


$safya_kip = 'kip=1&amp;ip='.$_GET['ip'];


$vtsorgu = "SELECT id,yazan,degistiren,tarih,degistirme_tarihi,mesaj_baslik,hangi_forumdan as hangi,yazan_ip,degistiren_ip,tarih as tarih2,8 AS rakam,9 AS rakam2
FROM $tablo_mesajlar WHERE yazan_ip='$_GET[ip]'

UNION ALL SELECT id,yazan,degistiren,tarih,degistirme_tarihi,mesaj_baslik,hangi_forumdan as hangi,yazan_ip,degistiren_ip,degistirme_tarihi as tarih2,8 AS rakam,8 AS rakam2
FROM $tablo_mesajlar WHERE degistiren_ip='$_GET[ip]'

UNION ALL SELECT id,cevap_yazan as yazan,degistiren,tarih,degistirme_tarihi,cevap_baslik as mesaj_baslik,hangi_basliktan as hangi,yazan_ip,degistiren_ip,tarih as tarih2,9 AS rakam,9 AS rakam2
FROM $tablo_cevaplar WHERE yazan_ip='$_GET[ip]'

UNION ALL SELECT id,cevap_yazan as yazan,degistiren,tarih,degistirme_tarihi,cevap_baslik as mesaj_baslik,hangi_basliktan as hangi,yazan_ip,degistiren_ip,degistirme_tarihi as tarih2,9 AS rakam,8 AS rakam2
FROM $tablo_cevaplar WHERE degistiren_ip='$_GET[ip]'

UNION ALL SELECT id,yazan as yazan,yazan_id,tarih,silinmis,uye_adi as mesaj_baslik,uye_id as hangi,yazan_ip,onay,tarih as tarih2,6 AS rakam,6 AS rakam2
FROM $tablo_yorumlar WHERE yazan_ip='$_GET[ip]'

ORDER BY tarih2 DESC";


$vtsonuc1 = @$vt->query($vtsorgu.' LIMIT 101') or die ($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc1);
$vtsonuc1 = @$vt->query("$vtsorgu LIMIT $sayfa,$adim") or die ($vt->hata_ver());



$sayfa_aciklama3 = '<br><div align="center" class="liste-veri" style="text-align: left; width: 100%; height: 18px;"><a target="_blank" href="http://www.whois.sc/'.$_GET['ip'].'"><b>'.$_GET['ip'];
if ($satir_sayi>100){
	$sayfa_aciklama3 .= '</b></a>&nbsp; ip adresi için son 100 işlem gösteriliyor.</div>';
	$satir_sayi = 100;}
else $sayfa_aciklama3 .= '</b></a>&nbsp; ip adresi için <b>'.$satir_sayi.'</b> sonuç bulundu.</div>';


$sayfa_aciklama = '<br><div align="center" class="liste-veri" style="text-align: left; width: 699px; height: 18px;">
<a href="ip_yonetimi.php" style="text-decoration: none;"><b>&laquo; &nbsp;ilk sayfasına geri dön</b></a></div>';



$toplam_sayfa = ($satir_sayi / $adim);
settype($toplam_sayfa,'integer');
if ( ($satir_sayi % $adim) != 0 ) $toplam_sayfa++;


$vtsorgu = "SELECT id,kullanici_adi,katilim_tarihi,son_hareket,hangi_sayfada,sayfano FROM $tablo_kullanicilar WHERE kul_ip='$_GET[ip]' ORDER BY son_hareket DESC LIMIT 50";
$vtsonuc3 = @$vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "SELECT giris,son_hareket,hangi_sayfada,sayfano FROM $tablo_oturumlar WHERE kul_ip='$_GET[ip]' ORDER BY son_hareket DESC LIMIT 50";
$vtsonuc4 = @$vt->query($vtsorgu) or die ($vt->hata_ver());



//  KULLANICILAR //

if ($vt->num_rows($vtsonuc3))
{
	$sira = 1;

	while ($uye = $vt->fetch_assoc($vtsonuc3))
	{
		$uye_adi = '<a href="../profil.php?u='.$uye['id'].'">'.$uye['kullanici_adi'].'</a>';

		$kayit = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uye['katilim_tarihi']);
		$son_giris = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uye['son_hareket']);
		$hsayfa = HangiSayfada($uye['sayfano'], $uye['hangi_sayfada']);
		$hsayfa = str_replace('<a href="', '<a href="../', $hsayfa);


		//	veriler tema motoruna yollanıyor	//

		$tekli2[] = array('{SIRA}' => $sira,
		'{UYE_ADI}' => $uye_adi,
		'{HANGI_SAYFADA}' => $hsayfa,
		'{KAYIT}' => $kayit,
		'{SON_GIRIS}' => $son_giris);

		$sira++;
	}
}


//  MİSAFİRLER //

if ($vt->num_rows($vtsonuc4))
{
	if (!isset($sira)) $sira = 1;

	while ($uye = $vt->fetch_assoc($vtsonuc4))
	{
		$uye_adi = 'Misafir';

		$kayit = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uye['giris']);
		$son_giris = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uye['son_hareket']);
		$hsayfa = HangiSayfada($uye['sayfano'], $uye['hangi_sayfada']);
		$hsayfa = str_replace('<a href="', '<a href="../', $hsayfa);


		//	veriler tema motoruna yollanıyor	//

		$tekli2[] = array('{SIRA}' => $sira,
		'{UYE_ADI}' => $uye_adi,
		'{HANGI_SAYFADA}' => $hsayfa,
		'{KAYIT}' => $kayit,
		'{SON_GIRIS}' => $son_giris);

		$sira++;
	}
}



//  YAPILAN İŞLMELER SIRALANIYOR //

if ($vt->num_rows($vtsonuc1))
{
	$sira = $sayfa+1;

	while ($konular = $vt->fetch_assoc($vtsonuc1))
	{
		// bulunan cevap ise
		if ($konular['rakam'] == '9')
		{
			// cevabın konusunun bilgileri çekiliyor
			$vtsorgu = "SELECT id,mesaj_baslik FROM $tablo_mesajlar WHERE id='$konular[hangi]'";
			$vtsonuc12 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$konular2 = $vt->fetch_assoc($vtsonuc12);


			// cevabın kaçıncı sırada olduğu hesaplanıyor
			$vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$konular[hangi]' AND id < $konular[id]") or die ($vt->hata_ver());
			$cavabin_sirasi = $vt->num_rows($vtsonuc9);

			$sayfaya_git = ($cavabin_sirasi / $ayarlar['ksyfkota']);
			settype($sayfaya_git,'integer');
			$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

			if ($sayfaya_git != 0) $sayfaya_git = '&amp;ks='.$sayfaya_git;
			else $sayfaya_git = '';


			// bağlantılar oluşturuluyor
			$konu_baslik = '<a href="../konu.php?k='.$konular2['id'].$sayfaya_git.'#c'.$konular['id'].'">'.$konular2['mesaj_baslik'].' &raquo; '.$konular['mesaj_baslik'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

			$cevap_tarihi = '<center>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']).'</center>';


			if ($konular['rakam2'] == '9')
			{
				$islem = 'Cevap Yazma';
				$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
				$ip_adresi = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';
			}

			else
			{
				$islem = 'Cevap Değiştirme';
				$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['degistirme_tarihi']);
				$ip_adresi = '<a href="../profil.php?kim='.$konular['degistiren'].'">'.$konular['degistiren'].'</a>';
			}
		}



		// bulunan konu ise
		elseif ($konular['rakam'] == '8')
		{
			$konu_baslik = '<a href="../konu.php?k='.$konular['id'].'">'.$konular['mesaj_baslik'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';


			if ($konular['rakam2'] == '9')
			{
				$islem = 'Konu Açma';
				$tarih =  zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
				$ip_adresi = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';
			}

			else
			{
				$islem = 'Konu Değiştirme';
				$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['degistirme_tarihi']);
				$ip_adresi = '<a href="../profil.php?kim='.$konular['degistiren'].'">'.$konular['degistiren'].'</a>';
			}
		}



		// bulunan yorum ise
		elseif ($konular['rakam'] == '6')
		{
			$konu_baslik = 'Kime: <a href="../profil.php?u='.$konular['hangi'].'">'.$konular['mesaj_baslik'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

			$islem = 'Yorum Yazma';
			$tarih =  zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
			$ip_adresi = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$konular['yazan_ip'].'">'.$konular['yazan_ip'].'</a>';
		}


		//	veriler tema motoruna yollanıyor	//

		$tekli1[] = array('{SIRA}' => $sira,
		'{KONU_BASLIK}' => $konu_baslik,
		'{YAZAN}' => $yazan,
		'{IP_DEGISTIREN2}' => $ip_adresi,
		'{ISLEM}' => $islem,
		'{TARIH}' => $tarih);

		$sira++;
	}
}




$ornek1->kosul('4', array('' => ''), false);
$ornek1->kosul('3', array('{KAYIT_IP}' => 'Kayıt Tarihi', '{YAZAN_IP}' => 'Yazan', '{IP_DEGISTIREN}' => 'İşlem Yapan','{UYE_MISAFIR}' => 'Üyeler ve Misafirler', '{KONULAR_CEVAPLAR}' => 'Bu ip Adresiyle Yapılan Son işlemler', '{SAYFA_ACIKLAMA3}' => $sayfa_aciklama3), true);


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
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), true);
}
else
{
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), true);
}



//  IP ADRESİNE GÖRE ARAMA - SONU    //








//  KULLANICI ADINA GÖRE ARAMA - BAŞI   //

elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == '2') ):


$safya_kip = 'kip=2&amp;kim='.$_GET['kim'];

$vtsorgu = "SELECT id,yazan,degistiren,tarih,degistirme_tarihi,mesaj_baslik,hangi_forumdan as hangi,yazan_ip,degistiren_ip,tarih as tarih2,8 AS rakam,9 AS rakam2
FROM $tablo_mesajlar WHERE yazan='$kullanici[kullanici_adi]'

UNION ALL SELECT id,yazan,degistiren,tarih,degistirme_tarihi,mesaj_baslik,hangi_forumdan as hangi,yazan_ip,degistiren_ip,degistirme_tarihi as tarih2,8 AS rakam,8 AS rakam2
FROM $tablo_mesajlar WHERE degistiren='$kullanici[kullanici_adi]'

UNION ALL SELECT id,cevap_yazan as yazan,degistiren,tarih,degistirme_tarihi,cevap_baslik as mesaj_baslik,hangi_basliktan as hangi,yazan_ip,degistiren_ip,tarih as tarih2,9 AS rakam,9 AS rakam2
FROM $tablo_cevaplar WHERE cevap_yazan='$kullanici[kullanici_adi]'

UNION ALL SELECT id,cevap_yazan as yazan,degistiren,tarih,degistirme_tarihi,cevap_baslik as mesaj_baslik,hangi_basliktan as hangi,yazan_ip,degistiren_ip,degistirme_tarihi as tarih2,9 AS rakam,8 AS rakam2
FROM $tablo_cevaplar WHERE degistiren='$kullanici[kullanici_adi]'

UNION ALL SELECT id,kimden,kimden,gonderme_tarihi,okunma_tarihi,ozel_baslik,cevap as hangi,kime,kime,gonderme_tarihi as tarih2,7 AS rakam,7 AS rakam2
FROM $tablo_ozel_ileti WHERE kimden='$kullanici[kullanici_adi]'

UNION ALL SELECT id,yazan as yazan,yazan_id,tarih,silinmis,uye_adi as mesaj_baslik,uye_id as hangi,yazan_ip,onay,tarih as tarih2,6 AS rakam,6 AS rakam2
FROM $tablo_yorumlar WHERE yazan_id='$kullanici[id]'

ORDER BY tarih2 DESC";


$vtsonuc1 = @$vt->query($vtsorgu.' LIMIT 101') or die ($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc1);
$vtsonuc1 = @$vt->query("$vtsorgu LIMIT $sayfa,$adim") or die ($vt->hata_ver());



$sayfa_aciklama3 = '<br><div align="center" class="liste-veri" style="text-align: left; width: 100%; height: 18px;"><b>'.$kullanici['kullanici_adi'];
if ($satir_sayi>100){
	$sayfa_aciklama3 .= '</b> adlı üye için son 100 işlem gösteriliyor.</div>';
	$satir_sayi = 100;}
else $sayfa_aciklama3 .= '</b> adlı üye için <b>'.$satir_sayi.'</b> sonuç bulundu.</div>';

$sayfa_aciklama = '<br><div align="center" class="liste-veri" style="text-align: left; width: 699px; height: 18px;">
<a href="ip_yonetimi.php" style="text-decoration: none"><b>&laquo; &nbsp;ilk sayfasına geri dön</b></a></div>';



$toplam_sayfa = ($satir_sayi / $adim);
settype($toplam_sayfa,'integer');
if ( ($satir_sayi % $adim) != 0 ) $toplam_sayfa++;


$vtsorgu = "SELECT id,son_hareket,hangi_sayfada,kul_ip,sayfano FROM $tablo_kullanicilar WHERE kullanici_adi='$kullanici[kullanici_adi]' LIMIT 1";
$vtsonuc3 = @$vt->query($vtsorgu) or die ($vt->hata_ver());



//  KULLANICININ BİLGİLERİ //

if ($vt->num_rows($vtsonuc3))
{
	$sira = 1;
	$uye = $vt->fetch_assoc($vtsonuc3);

	$uye_adi = '<a href="../profil.php?u='.$uye['id'].'">'.$kullanici['kullanici_adi'].'</a>';
	$kayit = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$uye['kul_ip'].'">'.$uye['kul_ip'].'</a>';
	$son_giris = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uye['son_hareket']);
	$hsayfa = HangiSayfada($uye['sayfano'], $uye['hangi_sayfada']);
	$hsayfa = str_replace('<a href="', '<a href="../', $hsayfa);


	//	veriler tema motoruna yollanıyor	//

	$tekli2[] = array('{SIRA}' => $sira,
	'{UYE_ADI}' => $uye_adi,
	'{HANGI_SAYFADA}' => $hsayfa,
	'{KAYIT}' => $kayit,
	'{SON_GIRIS}' => $son_giris);
}



//  YAPILAN İŞLEMLER SIRALANIYOR //

if ($vt->num_rows($vtsonuc1))
{
	$sira = $sayfa+1;

	while ($konular = $vt->fetch_assoc($vtsonuc1))
	{
		// bulunan cevap ise
		if ($konular['rakam'] == '9')
		{
			// cevabın konusunun bilgileri çekiliyor
			$vtsorgu = "SELECT id,mesaj_baslik FROM $tablo_mesajlar WHERE id='$konular[hangi]'";
			$vtsonuc12 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$konular2 = $vt->fetch_assoc($vtsonuc12);


			// cevabın kaçıncı sırada olduğu hesaplanıyor
			$vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$konular[hangi]' AND id < $konular[id]") or die ($vt->hata_ver());
			$cavabin_sirasi = $vt->num_rows($vtsonuc9);

			$sayfaya_git = ($cavabin_sirasi / $ayarlar['ksyfkota']);
			settype($sayfaya_git,'integer');
			$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

			if ($sayfaya_git != 0) $sayfaya_git = '&amp;ks='.$sayfaya_git;
			else $sayfaya_git = '';


			// bağlantılar oluşturuluyor
			$konu_baslik = '<a href="../konu.php?k='.$konular2['id'].$sayfaya_git.'#c'.$konular['id'].'">'.$konular2['mesaj_baslik'].' &raquo; '.$konular['mesaj_baslik'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

			$cevap_tarihi = '<center>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']).'</center>';


			if ($konular['rakam2'] == '9')
			{
				$islem = 'Cevap Yazma';
				$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
				$ip_adresi = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$konular['yazan_ip'].'">'.$konular['yazan_ip'].'</a>';
			}

			else
			{
				$islem = 'Cevap Değiştirme';
				$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['degistirme_tarihi']);
				$ip_adresi = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$konular['degistiren_ip'].'">'.$konular['degistiren_ip'].'</a>';
			}
		}


		// bulunan konu ise
		elseif ($konular['rakam'] == '8')
		{
			$konu_baslik = '<a href="../konu.php?k='.$konular['id'].'">'.$konular['mesaj_baslik'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';


			if ($konular['rakam2'] == '9')
			{
				$islem = 'Konu Açma';
				$tarih =  zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
				$ip_adresi = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$konular['yazan_ip'].'">'.$konular['yazan_ip'].'</a>';
			}

			else
			{
				$islem = 'Konu Değiştirme';
				$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['degistirme_tarihi']);
				$ip_adresi = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$konular['degistiren_ip'].'">'.$konular['degistiren_ip'].'</a>';
			}
		}



		// bulunan özel ileti ise
		elseif ($konular['rakam'] == '7')
		{
			$konu_baslik = 'Kime: <a href="../profil.php?kim='.$konular['yazan_ip'].'">'.$konular['yazan_ip'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

			$islem = 'Özel ileti Yazma';
			$tarih =  zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
			$ip_adresi = '-';
		}


		// bulunan yorum ise
		elseif ($konular['rakam'] == '6')
		{
			$konu_baslik = 'Kime: <a href="../profil.php?u='.$konular['hangi'].'">'.$konular['mesaj_baslik'].'</a>';
			$yazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

			$islem = 'Yorum Yazma';
			$tarih =  zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['tarih']);
			$ip_adresi = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$konular['yazan_ip'].'">'.$konular['yazan_ip'].'</a>';
		}




		//	veriler tema motoruna yollanıyor	//

		$tekli1[] = array('{SIRA}' => $sira,
		'{KONU_BASLIK}' => $konu_baslik,
		'{YAZAN}' => $yazan,
		'{IP_DEGISTIREN2}' => $ip_adresi,
		'{ISLEM}' => $islem,
		'{TARIH}' => $tarih);

		$sira++;
	}
}



$ornek1->kosul('4', array('' => ''), false);
$ornek1->kosul('3', array('{KAYIT_IP}' => 'IP Adresi', '{IP_DEGISTIREN}' => 'IP Adresi', '{UYE_MISAFIR}' => 'Üyenin Bilgileri', '{KONULAR_CEVAPLAR}' => 'Üyenin Yaptığı Son işlemler', '{SAYFA_ACIKLAMA3}' => $sayfa_aciklama3), true);


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
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), true);
}
else
{
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), true);
}



//  KULLANICI ADINA GÖRE ARAMA - SONU   //








//  NORMAL GÖSTERİM - BAŞI   //
else:

$sayfa_aciklama = '';

$sayfa_aciklama2 = '<br> &nbsp; Ip adresini, <b>IP Sorgulama</b> alanına girerek o ip adresi ile yapılan tüm işlemleri görüntüleyebilirsiniz.

<br> &nbsp; Üye adını, <b>Üye Sorgulama</b> alanına girerek o üyenin yaptığı tüm işlemleri görüntüleyebilirsiniz.

<br><br> &nbsp; Ayrıca, konu ve çevrimiçi sayfalarındaki ip adreslerini tıklayarak da bu özellikleri kullanabilirsiniz.<br>';


$ornek1->kosul('1', array('' => ''), false);
$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('3', array('' => ''), false);
$ornek1->kosul('5', array('' => ''), false);
$ornek1->kosul('6', array('' => ''), false);
$ornek1->kosul('4', array('{IP_ADRESI}' => $_SERVER['REMOTE_ADDR'], '{UYE_ADI}' => $kullanici_kim['kullanici_adi'],'{SAYFA_ACIKLAMA2}' => $sayfa_aciklama2), true);

//  NORMAL GÖSTERİM - SONU   //

endif;






//  SAYFALAMA   //

$sayfalama = '';

if (isset($safya_kip))
{
	if ($satir_sayi > $adim):

	$sayfalama .= '<p>
	<table cellspacing="1" cellpadding="2" border="0" align="right" class="tablo_border">
		<tbody>
		<tr>
		<td class="forum_baslik">
	Toplam '.$toplam_sayfa.' Sayfa:&nbsp;
		</td>
	';

	if ($sayfa != 0)
	{
		$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="ilk sayfaya git">';
		$sayfalama .= '&nbsp;<a href="ip_yonetimi.php?'.$safya_kip.'">&laquo;ilk</a>&nbsp;</td>';

		$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="önceki sayfaya git">';
		$sayfalama .= '&nbsp;<a href="ip_yonetimi.php?'.$safya_kip.'&amp;sayfa='.($sayfa - $adim).'">&lt;</a>&nbsp;</td>';
	}

	for ($sayi=0,$sayfa_sinir=$sayfa; $sayi < $toplam_sayfa; $sayi++)
	{
		if ($sayi < (($sayfa / $adim) - 3));
		else
		{
			$sayfa_sinir++;
			if ($sayfa_sinir >= ($sayfa + 8)) break;
			if (($sayi == 0) and ($sayfa == 0))
			{
				$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
				$sayfalama .= '&nbsp;<b>[1]</b>&nbsp;</td>';
			}

			elseif (($sayi + 1) == (($sayfa / $adim) + 1))
			{
				$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
				$sayfalama .= '&nbsp;<b>['.($sayi + 1).']</b>&nbsp;</td>';
			}

			else
			{
				$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="'.($sayi + 1).' numaralı sayfaya git">';

				$sayfalama .= '&nbsp;<a href="ip_yonetimi.php?'.$safya_kip.'&amp;sayfa='.($sayi * $adim).'">'.($sayi + 1).'</a>&nbsp;</td>';
			}
		}
	}

	if ($sayfa < ($satir_sayi - $adim))
	{
		$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="sonraki sayfaya git">';
		$sayfalama .= '&nbsp;<a href="ip_yonetimi.php?'.$safya_kip.'&amp;sayfa='.($sayfa + $adim).'">&gt;</a>&nbsp;</td>';

		$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="son sayfaya git">';
		$sayfalama .= '&nbsp;<a href="ip_yonetimi.php?'.$safya_kip.'&amp;sayfa='.(($toplam_sayfa - 1) * $adim).'">son&raquo;</a>&nbsp;</td>';
	}

	$sayfalama .= '</tr>
		</tbody>
	</table>';

	endif;
}



$dongusuz = array('{SAYFA_BASLIK}' => $sayfa_baslik,
'{SAYFA_ACIKLAMA}' => $sayfa_aciklama,
'{SAYFALAMA}' => $sayfalama);


$ornek1->dongusuz($dongusuz);

eval(TEMA_UYGULA);

?>