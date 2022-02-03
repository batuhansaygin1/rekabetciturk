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


@session_start();
if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';


// üye alımı kapalıysa
if ($ayarlar['uye_kayit'] != 1)
{
	header('Location: ../hata.php?uyari=9');
	exit();
}


//  kayıt deneme sayısı her denemede arttırılıyor   //
if (empty($_SESSION['kayit_deneme'])) $_SESSION['kayit_deneme'] = 1;
else $_SESSION['kayit_deneme']++;


//  kayıt denemesi beşe ulaştığında hata iletisi veriliyor  //
if ($_SESSION['kayit_deneme'] > 5)
{
	header('Location: ../hata.php?hata=25');
	exit();
}


//  BİLGİLERİ TEKRAR GİRMEYE GEREK KALMAMASI İÇİN OTURUMA KAYDEDİLİYOR  //

$_SESSION['kullanici_adi'] = @zkTemizle4($_POST['kullanici_adi']);
$_SESSION['posta'] = @zkTemizle4($_POST['posta']);




// kayıt sorusu özelliği açık ise
if ($ayarlar['kayit_soru'] == '1') $_SESSION['kayit_cevabi'] = @zkTemizle4($_POST['kayit_cevabi']);

// onay kodu kapalı ise
if ($ayarlar['onay_kodu'] != '1')
{
	$_POST['onay_kodu'] = 'kapali';
	$_SESSION['onay_kodu'] = 'kapali';
}



// KAYIT ALANINDA EKSİK VARSA UYARILIYOR  //

if ( (!@$_POST['kullanici_adi']) OR (!@$_POST['sifre']) OR (!@$_POST['posta']) ):

header('Location: ../hata.php?hata=26');
exit();





//  GÖRSEL ONAY KODU DOĞRU İSE DEVAM    //

elseif ( (isset($_POST['onay_kodu'])) AND (!is_array($_POST['onay_kodu'])) AND (isset($_SESSION['onay_kodu'])) AND (@strtolower($_POST['onay_kodu']) == @strtolower($_SESSION['onay_kodu'])) ):


// KAYIT BİLGİLERİNİN DOĞRULUĞU DENETLENİYOR //

if (!@preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/', $_POST['kullanici_adi']))
{
	header('Location: ../hata.php?hata=27');
	exit();
}
if ((@strlen($_POST['kullanici_adi']) > 20) OR (@strlen($_POST['kullanici_adi']) < 4))
{
	header('Location: ../hata.php?hata=28');
	exit();
}

if ($_POST['sifre'] != $_POST['sifre2'])
{
	header('Location: ../hata.php?hata=33');
	exit();
}
if (!@preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['sifre']))
{
	header('Location: ../hata.php?hata=34');
	exit();
}
if ((@strlen($_POST['sifre']) > 20) OR (@strlen($_POST['sifre']) < 5))
{
	header('Location: ../hata.php?hata=35');
	exit();
}

if (@strlen($_POST['posta']) > 70)
{
	header('Location: ../hata.php?hata=40');
	exit();
}

if (!@preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
{
	header('Location: ../hata.php?hata=10');
	exit();
}

if ($ayarlar['kayit_soru'] == 1)
{
	if (@strtolower($_POST['kayit_cevabi']) != @strtolower($ayarlar['kayit_cevabi']))
	{
		header('Location: ../hata.php?hata=41');
		exit();
	}
}





        //      YASAKLAR - BAŞI     //


//  YASAK KULLANICI ADLARI ALINIYOR //

$vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='kulad' LIMIT 1";
$yasak_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$yasak_kulad = $vt->fetch_row($yasak_sonuc);
$ysk_kuladd = explode("\r\n", $yasak_kulad[0]);


//  KULLANICI ADI YASAKLARLARI    //

if ($ysk_kuladd[0] != '')
{
	$dongu_sayi = count($ysk_kuladd);
	for ($d=0; $d < $dongu_sayi; $d++)
	{
		if ( (!preg_match('/^\*/', $ysk_kuladd[$d])) AND (!preg_match('/\*$/', $ysk_kuladd[$d])) )
			$ysk_kuladd[$d] = '^'.$ysk_kuladd[$d].'$';

		elseif (!preg_match('/^\*/', $ysk_kuladd[$d])) $ysk_kuladd[$d] = '^'.$ysk_kuladd[$d];

		elseif (!preg_match('/\*$/', $ysk_kuladd[$d])) $ysk_kuladd[$d] .= '$';

		$ysk_kuladd[$d] = str_replace('*', '', $ysk_kuladd[$d]);


		if (preg_match("/$ysk_kuladd[$d]/i", $_POST['kullanici_adi']))
		{
			header('Location: ../hata.php?hata=29');
			exit();
		}
	}
}




//  YASAK POSTA ADRESLERİ ALINIYOR  //

$vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='posta' LIMIT 1";
$yasak_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$yasak_posta = $vt->fetch_row($yasak_sonuc);
$ysk_postad = explode("\r\n", $yasak_posta[0]);


//  E-POSTA ADRESİ YASAKLARI    //

if ($ysk_postad[0] != '')
{
	$dongu_sayi = count($ysk_postad);
	for ($i=0; $i<$dongu_sayi; $i++)
	{
		if ( (!preg_match('/^\*/', $ysk_postad[$i])) AND (!preg_match('/\*$/', $ysk_postad[$i])) )
		$ysk_postad[$i] = '^'.$ysk_postad[$i].'$';

		elseif (!preg_match('/^\*/', $ysk_postad[$i])) $ysk_postad[$i] = '^'.$ysk_postad[$i];

		elseif (!preg_match('/\*$/', $ysk_postad[$i])) $ysk_postad[$i] .= '$';

		$ysk_postad[$i] = str_replace('*', '', $ysk_postad[$i]);


		if (preg_match("/$ysk_postad[$i]/i", $_POST['posta']))
		{
			header('Location: ../hata.php?hata=30');
			exit();
		}
	}
}

        //      YASAKLAR - SONU     //






if ($_POST['kayit_yapildi_mi'] == 'form_dolu')
{
	$tarih = time();


	// KULLANICI ADININ DAHA ÖNCE ALINIP ALINMADIĞI DENETLENİYOR //

	$vtsorgu = "SELECT kullanici_adi FROM $tablo_kullanicilar WHERE kullanici_adi='$_POST[kullanici_adi]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// E-POSTA İLE DAHA ÖNCE KAYIT YAPILIP YAPILMADIĞI DENETLENİYOR // 

	$vtsorgu = "SELECT posta FROM $tablo_kullanicilar WHERE posta='$_POST[posta]'";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=42');
		exit();
	}

	elseif ($vt->num_rows($vtsonuc2))
	{
		header('Location: ../hata.php?hata=43');
		exit();
	}

	else
	{
		if (isset($_POST['eposta_gizle'])) $posta_goster = 0;
		else $posta_goster = 1;

		$_POST['posta'] = $vt->real_escape_string($_POST['posta']);
		$_POST['gercek_ad'] = $_POST['kullanici_adi'];
		$_POST['sehir'] = '';
		$dogum_tarihi = '00-00-0000';


		// anahtar değeri şifreyle karıştırılarak sha1 ile kodlanıyor
		$karma = sha1(($anahtar.$_POST['sifre']));


		//  HESAP ETKİNLEŞTİRME ÖZELLİĞİNE GÖRE GEREKLİ İŞLEMLER YAPILIYOR  //

		if ($ayarlar['hesap_etkin'] == 0)
		{
			$vtsorgu = "INSERT INTO $tablo_kullanicilar (kullanici_adi, sifre, posta, posta_goster, gercek_ad, dogum_tarihi, dogum_tarihi_goster, katilim_tarihi, sehir, sehir_goster, kul_etkin, son_giris, son_hareket, kul_ip, sayfano, hangi_sayfada)";

			$vtsorgu .= "VALUES ('$_POST[kullanici_adi]','$karma','$_POST[posta]','$posta_goster','$_POST[gercek_ad]','$dogum_tarihi','0','$tarih','$_POST[sehir]', '0', '1','$tarih','$tarih','$_SERVER[REMOTE_ADDR]','-1','Kullanıcı çıkış yaptı')";

			$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$kul_etkin_kod = 0;
		}

		else
		{
			//  HESAP ETKİNLEŞTİRME KODU OLUŞTURULUYOR  //
			$kul_etkin_kod = sha1(microtime());
			$kul_etkin_kod = substr($kul_etkin_kod,9,10);

			$vtsorgu = "INSERT INTO $tablo_kullanicilar (kullanici_adi, sifre, posta, posta_goster, gercek_ad, dogum_tarihi, dogum_tarihi_goster, katilim_tarihi, sehir, sehir_goster, kul_etkin_kod, son_giris, son_hareket, kul_ip, sayfano, hangi_sayfada)";

			$vtsorgu .= "VALUES ('$_POST[kullanici_adi]','$karma','$_POST[posta]','$posta_goster','$_POST[gercek_ad]','$dogum_tarihi','0','$tarih','$_POST[sehir]','0','$kul_etkin_kod','$tarih','$tarih','$_SERVER[REMOTE_ADDR]','-1','Kullanıcı çıkış yaptı')";

			$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		$kulid = $vt->insert_id();



		//  POSTALAR/KAYIT.TXT DOSYASINDAKİ YAZILAR ALINIYOR... //
		//  ... BELİRTİLEN YERLERE YENİ BİLGİLER GİRİLİYOR  // 

		if ($ayarlar['hesap_etkin'] == 0) $dosya = './postalar/kayit0.txt';
		elseif ($ayarlar['hesap_etkin'] == 1) $dosya = './postalar/kayit1.txt';
		else $dosya = './postalar/kayit2.txt';


		if (!($dosya_ac = fopen($dosya,'r'))) die ('Dosya Açılamıyor');
		$posta_metni = fread($dosya_ac,3072);
		fclose($dosya_ac);

		$bul = array('{forumadi}',
		'{alanadi}',
		'{f_dizin}',
		'{kullanici_adi}',
		'{sifre}',
		'{posta}',
		'{gercek_ad}',
		'{dogum_tarihi}',
		'{sehir}',
		'{kulid}',
		'{kul_etkin_kod}');

		$cevir = array($ayarlar['anasyfbaslik'],
		$ayarlar['alanadi'],
		$ayarlar['f_dizin'],
		$_POST['kullanici_adi'],
		$_POST['sifre'],
		$_POST['posta'],
		$_POST['gercek_ad'],
		$dogum_tarihi,
		$_POST['sehir'],
		$kulid,
		$kul_etkin_kod);

		if ($cevir[2] == '/')
		$cevir[2] = '';

		$posta_baslik = $ayarlar['anasyfbaslik'].' Forumlarına Hoş Geldiniz';
		$posta_metni = str_replace($bul,$cevir,$posta_metni);


		//  HESAP BİLGİLERİ VE HESAP ETKİNLEŞTİRME KODU POSTALANIYOR    //

		require('eposta_sinif.php');
		$mail = new eposta_yolla();


		if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
		elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();


		$mail->sunucu = $ayarlar['smtp_sunucu'];
		if ($ayarlar['smtp_kd'] == 'true') $mail->smtp_dogrulama = true;
		else $mail->smtp_dogrulama = false;
		$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
		$mail->sifre = $ayarlar['smtp_sifre'];

		$mail->gonderen = $ayarlar['y_posta'];
		$mail->gonderen_adi = $ayarlar['anasyfbaslik'];

		$mail->GonderilenAdres($_POST['posta']);

		$mail->YanitlamaAdres($ayarlar['y_posta']);
		$mail->konu = $posta_baslik;
		$mail->icerik = $posta_metni;


		if ($mail->Yolla())
		{
			// KAYIT İŞLEMİ TAMAMLANDI, EKRAN ÇIKTISI VERİLİYOR //

			if ($ayarlar['hesap_etkin'] == 0)
			{
				header('Location: ../hata.php?bilgi=15');
				exit();
			}

			elseif ($ayarlar['hesap_etkin'] == 1)
			{
				header('Location: ../hata.php?bilgi=16');
				exit();
			}

			else
			{
				header('Location: ../hata.php?bilgi=17');
				exit();
			}
		}

		else
		{
			// E-POSTA GÖNDERİLEMEDİ //

			if ($ayarlar['hesap_etkin'] == 0)
			{
				header('Location: ../hata.php?hata=198');
				exit();
			}

			elseif ($ayarlar['hesap_etkin'] == 1)
			{
				header('Location: ../hata.php?hata=11');
				exit();
			}

			else
			{
				header('Location: ../hata.php?hata=199');
				exit();
			}
		}
	}
}


$gec = '';


else:

header('Location: ../hata.php?hata=44');
exit();

endif;

?>