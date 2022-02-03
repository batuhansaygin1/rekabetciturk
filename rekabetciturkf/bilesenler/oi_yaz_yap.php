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
$tarih = time();


// özel ileti özelliği kapalıysa
if ($ayarlar['o_ileti'] == 0)
{
	header('Location: ../hata.php?uyari=2');
	exit();
}


// FORM DOLUYSA İŞLEMLERE DEVAM //

if ( (isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):


$_POST['ozel_kime'] = zkTemizle(trim($_POST['ozel_kime']));

//  kullanıcı adı yoksa veya 4 karakterden kısaysa
if (strlen($_POST['ozel_kime']) < 4)
{
	header('Location: ../hata.php?hata=63');
	exit();
}

//  mesaj başlığı ve içeriği denetleniyor
if (( strlen($_POST['mesaj_baslik']) < 3) or ( strlen(utf8_decode($_POST['mesaj_baslik'])) > 200) or ( strlen($_POST['mesaj_icerik']) < 3))
{
	header('Location: ../hata.php?hata=64');
	exit();
}


// zararlı kodlar temizleniyor

// magic_quotes_gpc açıksa
if (get_magic_quotes_gpc())
{
	$_POST['mesaj_baslik'] = @ileti_yolla(stripslashes($_POST['mesaj_baslik']),1);
	$_POST['mesaj_icerik'] = @ileti_yolla(stripslashes($_POST['mesaj_icerik']),2);
}

// magic_quotes_gpc kapalıysa
else
{
	$_POST['mesaj_baslik'] = @ileti_yolla($_POST['mesaj_baslik'],1);
	$_POST['mesaj_icerik'] = @ileti_yolla($_POST['mesaj_icerik'],2);
}


// bbcode kullanma bilgisi
if (isset($_POST['bbcode_kullan'])) $bbcode_kullan = 1;
else $bbcode_kullan = 0;


// ifade kullanma bilgisi
if (isset($_POST['ifade'])) $ifade_kullan = 1;
else $ifade_kullan = 0;


// üye adı denetleniyor
$vtsorgu = "SELECT id,kullanici_adi,posta,engelle,kul_etkin FROM $tablo_kullanicilar WHERE kullanici_adi='$_POST[ozel_kime]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$kime = $vt->fetch_array($vtsonuc);


// üye adı geçersizse
if (!isset($kime['id']))
{
	header('Location: ../hata.php?hata=66');
	exit();
}


// üye engellenmişse
if ($kime['engelle'] == '1')
{
	header('Location: ../hata.php?hata=178');
	exit();
}


// üyenin hesabı etkin değilse
if ($kime['kul_etkin'] == '0')
{
	header('Location: ../hata.php?hata=179');
	exit();
}


// gönderen yönetici veya yardımcı değilse engellenmiş olabilir.
if ($kullanici_kim['yetki'] == 0)
{
	// gönderilen üyenin engelleme girdileri çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_yasaklar WHERE etiket='$kime[id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir = $vt->fetch_array($vtsonuc);


	// engelleme tipi belirleniyor
	if (isset($satir['tip']))
	{
		if ($satir['tip'] == '1')
		{
			if (!preg_match("/$kullanici_kim[kullanici_adi],/i", $satir['deger']))
			{
				header('Location: ../hata.php?hata=176');
				exit();
			}
		}

		elseif ($satir['tip'] == '2')
		{
			if (preg_match("/$kullanici_kim[kullanici_adi],/i", $satir['deger']))
			{
				header('Location: ../hata.php?hata=177');
				exit();
			}
		}
	}
}


// iki ileti arası süresi dolmamışsa uyarı ver
if ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['ileti_sure']) )
{
	header('Location: ../hata.php?hata=65');
	exit();
}


// gönderilen kişinin gelen kutusu doluysa uyarı ver

$vtsonuc9 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kime='$kime[kullanici_adi]' AND alan_kutu='1' AND cevap=0 OR kimden='$kime[kullanici_adi]' AND gonderen_kutu!='0' AND gonderen_kutu!='4' AND cevap_sayi!=0") or die ($vt->hata_ver());
$num_rows = $vt->num_rows($vtsonuc9);

$vtsonuc10 = $vt->query("SELECT id FROM $tablo_ozel_ileti WHERE kimden='$kime[kullanici_adi]' AND alan_kutu='1' AND cevap!=0") or die ($vt->hata_ver());
$num_rows2 = $vt->num_rows($vtsonuc10);

$num_rows += ($num_rows2 + 1);


if($num_rows > $ayarlar['gelen_kutu_kota'])
{
	header('Location: ../hata.php?hata=67');
	exit();
}


// özel ileti yanıtlama işlemleri
if (isset($_POST['oino']))
{
	if (is_numeric($_POST['oino']))
	{
		$oino = @zkTemizle2($_POST['oino']);

		// yanıtlanan özel ileti çekiliyor
		$vtsorgu = "SELECT kimden,kime FROM $tablo_ozel_ileti WHERE id='$oino' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$ozel_ileti = $vt->fetch_array($vtsonuc);

		// kendi açtığı konuysa
		if ($kullanici_kim['kullanici_adi'] == $ozel_ileti['kimden']) $eksorgu = "alan_kutu=1,";
		else $eksorgu = "gonderen_kutu=1,";

		// yanıtlanan özel iletinin cevap sayısı arttırılıyor ve gelen kutusuna taşınıyor
		$vtsorgu = "UPDATE $tablo_ozel_ileti SET $eksorgu cevap_sayi=cevap_sayi+1 WHERE id='$oino' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	else $oino = 0;
}


// özel ileti veritabanına giriliyor
$vtsorgu = "INSERT INTO $tablo_ozel_ileti (kimden,kime,ozel_baslik,ozel_icerik,gonderme_tarihi,gonderen_kutu,alan_kutu,bbcode_kullan,ifade,cevap)";
$vtsorgu .= "VALUES ('$kullanici_kim[kullanici_adi]','$kime[kullanici_adi]','$_POST[mesaj_baslik]','$_POST[mesaj_icerik]','$tarih','3','1','$bbcode_kullan','$ifade_kullan','$oino')";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$yapilanoi = $vt->insert_id();


// gönderilenin okunmmamış özel ileti sayısı arttırılıyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET okunmamis_oi=okunmamis_oi+1 WHERE id='$kime[id]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// gönderenin son ileti tarihi güncelleniyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET son_ileti='$tarih' WHERE id='$kullanici_kim[id]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// bildirim veritabanına giriliyor
$vtsorgu = "INSERT INTO $tablo_bildirimler (tarih,uye_id,seviye,tip,okundu,bildirim)";
$vtsorgu .= "VALUES ('$tarih','$kime[id]','0','1','0','$kullanici_kim[kullanici_adi]')";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



//		/POSTALAR/OZEL_POSTA.TXT DOSYASINDAKİ YAZILAR ALINIYOR...		//
//		... BELİRTİLEN YERLERE YENİ BİLGİLER GİRİLİYOR		// 

if ($ayarlar['oi_uyari'])
{
	if (!($dosya_ac = fopen('./postalar/ozel_ileti_uyari.txt','r'))) die ('Dosya Açılamıyor');
	$posta_metni = fread($dosya_ac,1024);
	fclose($dosya_ac);

	$ozel_adres = 'http://'.$ayarlar['alanadi'];
	if ($ayarlar['f_dizin'] != '/') $ozel_adres .= $ayarlar['f_dizin'];
	$ozel_adres .= '/ozel_ileti.php';

	$bul = array('{forumadi}',
	'{kullanici_adi}',
	'{ozel_ileti_sayfasi}');

	$cevir = array($ayarlar['title'],
	$kullanici_kim['kullanici_adi'],
	$ozel_adres);

	$posta_metni = str_replace($bul,$cevir,$posta_metni);


	// posta yollanıyor

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
	$mail->GonderilenAdres($kime['posta']);

	if (!empty($_POST['eposta_kopya'])) $mail->DigerAdres($kullanici_kim['posta']);

	$mail->YanitlamaAdres($ayarlar['y_posta']);
	$mail->konu = $ayarlar['title'].' - Özel iletiniz Var';
	$mail->icerik = $posta_metni;

	$mail->Yolla();
}
//	E-POSTA YOLLANIYOR - SONU	//


if (isset($_POST['mobil']))
{
	header('Location: ../mobil/oi_oku.php?oino='.$yapilanoi);
	exit();
}

else
{
	header('Location: ../hata.php?bilgi=11&cevap_no='.$yapilanoi);
	exit();
}

endif;
?>