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


if (!defined('DOSYA_AYAR')) include '../../ayar.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../bilesenler/gerecler.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'guvenlik.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../bilesenler/kullanici_kimlik.php';


if ($kullanici_kim['id'] != 1)
{
	header('Location: ../hata.php?hata=151');
	exit();
}


//	FORM DOLU MU ?	//

if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//  OTURUM BİLGİSİNE BAKILIYOR  //
if ($gyo != $yo)
{
	header('Location: ../hata.php?hata=45');
	exit();
}




//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //

if ( (isset($_POST['kip'])) AND ($_POST['kip'] !='') ):


if ($_POST['kip'] =='eposta')
{
	//	ALANLAR DOLU MU ?	//

	if ( (!$_POST['y_posta']) OR (!$_POST['eposta_yontem']) )
	{
		header('Location: ../hata.php?hata=98');
		exit();
	}

	elseif (( strlen($_POST['y_posta']) > 100))
	{
		header('Location: ../hata.php?hata=131');
		exit();
	}

	elseif (($_POST['eposta_yontem'] != 'mail') AND ($_POST['eposta_yontem']!= 'smtp'))
	{
		header('Location: ../hata.php?hata=132');
		exit();
	}

	elseif (($_POST['smtp_kd'] != 'true') AND ($_POST['smtp_kd'] != 'false'))
	{
		header('Location: ../hata.php?hata=133');
		exit();
	}

	elseif (( strlen($_POST['smtp_sunucu']) > 100))
	{
		header('Location: ../hata.php?hata=134');
		exit();
	}

	elseif (( strlen($_POST['smtp_kullanici']) > 100))
	{
		header('Location: ../hata.php?hata=135');
		exit();
	}

	elseif (( strlen($_POST['smtp_sifre']) > 100))
	{
		header('Location: ../hata.php?hata=136');
		exit();
	}

	elseif ( (!is_numeric($_POST['smtp_port'])) OR ( strlen($_POST['smtp_port']) > 6))
	{
		header('Location: ../hata.php?hata=225');
		exit();
	}



	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[y_posta]' where etiket='y_posta' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[eposta_yontem]' where etiket='eposta_yontem' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[smtp_kd]' where etiket='smtp_kd' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[smtp_sunucu]' where etiket='smtp_sunucu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[smtp_kullanici]' where etiket='smtp_kullanici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[smtp_port]' where etiket='smtp_port' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($_POST['smtp_sifre'] != 'sifre_degismedi')
	{
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[smtp_sifre]' where etiket='smtp_sifre' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();
}





elseif ($_POST['kip'] =='ozel_ileti')
{
	//	ALANLAR DOLU MU ?	//

	if ( (!$_POST['gelen_kutu_kota']) OR (!$_POST['ulasan_kutu_kota']) OR (!$_POST['kaydedilen_kutu_kota']) )
	{
		header('Location: ../hata.php?hata=98');
		exit();
	}

	elseif (( strlen($_POST['gelen_kutu_kota']) > 3) OR ( strlen($_POST['ulasan_kutu_kota']) > 3) OR ( strlen($_POST['kaydedilen_kutu_kota']) > 3))
	{
		header('Location: ../hata.php?hata=124');
		exit();
	}

	elseif ( (!preg_match('/^[0-9]+$/', $_POST['gelen_kutu_kota'])) OR
			(!preg_match('/^[0-9]+$/', $_POST['ulasan_kutu_kota'])) OR
			(!preg_match('/^[0-9]+$/', $_POST['kaydedilen_kutu_kota'])) )
	{
		header('Location: ../hata.php?hata=125');
		exit();
	}

	elseif ( (!preg_match('/^[01]+$/', $_POST['o_ileti'])) OR (!preg_match('/^[01]+$/', $_POST['oi_uyari'])) )
	{
		header('Location: ../hata.php?hata=160');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[o_ileti]' where etiket='o_ileti' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[oi_uyari]' where etiket='oi_uyari' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[gelen_kutu_kota]' where etiket='gelen_kutu_kota' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[ulasan_kutu_kota]' where etiket='ulasan_kutu_kota' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kaydedilen_kutu_kota]' where etiket='kaydedilen_kutu_kota' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();
}






elseif ($_POST['kip'] =='cms')
{
	//	ALANLAR DOLU MU ?	//

	if ( (!preg_match('/^[01]+$/', $_POST['portal'])) OR (!preg_match('/^[01]+$/', $_POST['cms_kullan'])) OR (!preg_match('/^[01]+$/', $_POST['cms_icinden'])) )
	{
		header('Location: ../hata.php?hata=160');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[portal]' where etiket='portal_kullan' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[cms_kullan]' where etiket='cms_kullan' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[cms_icinden]' where etiket='cms_icinden' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();
}





elseif ($_POST['kip'] =='uyelik')
{
	//	ALANLAR DOLU MU ?	//

	if ( (!$_POST['ileti_sure']) OR (!$_POST['kilit_sure']) OR (!$_POST['imza_uzunluk']) OR (!$_POST['resim_boyut']) OR (!$_POST['resim_yukseklik']) OR (!$_POST['resim_genislik']) OR (!$_POST['kurucu']) OR (!$_POST['yonetici']) OR (!$_POST['yardimci']) OR (!$_POST['blm_yrd']) OR (!$_POST['kullanici']) OR (!$_POST['cevrimici']) )
	{
		header('Location: ../hata.php?hata=98');
		exit();
	}

	elseif (!preg_match('/^[01]+$/', $_POST['bbcode']))
	{
		header('Location: ../hata.php?hata=160');
		exit();
	}

	elseif (!preg_match('/^[0-9]+$/', $_POST['cevrimici']))
	{
		header('Location: ../hata.php?hata=162');
		exit();
	}

	elseif (strlen($_POST['cevrimici']) > 2)
	{
		header('Location: ../hata.php?hata=163');
		exit();
	}

	elseif ((!preg_match('/^[0-9]+$/', $_POST['ileti_sure'])))
	{
		header('Location: ../hata.php?hata=106');
		exit();
	}

	elseif ($_POST['ileti_sure'] > 86400)
	{
		header('Location: ../hata.php?hata=107');
		exit();
	}

	elseif ((!preg_match('/^[0-9]+$/', $_POST['kilit_sure'])))
	{
		header('Location: ../hata.php?hata=108');
		exit();
	}

	elseif ($_POST['kilit_sure'] > 1440)
	{
		header('Location: ../hata.php?hata=109');
		exit();
	}

	elseif (!preg_match('/^[01]+$/', $_POST['kayit_soru']))
	{
		header('Location: ../hata.php?hata=110');
		exit();
	}

	elseif ( ( strlen($_POST['kayit_sorusu']) > 100) OR ( strlen($_POST['kayit_cevabi']) > 100))
	{
		header('Location: ../hata.php?hata=111');
		exit();
	}

	elseif ( (!preg_match('/^[0-9]+$/', $_POST['imza_uzunluk'])) OR
			($_POST['imza_uzunluk'] > 500) )
	{
		header('Location: ../hata.php?hata=112');
		exit();
	}

	elseif (!preg_match('/^[012]+$/', $_POST['hesap_etkin']))
	{
		header('Location: ../hata.php?hata=116');
		exit();
	}

	elseif (( strlen($_POST['kurucu']) > 100))
	{
		header('Location: ../hata.php?hata=120');
		exit();
	}

	elseif (( strlen($_POST['yonetici']) > 100))
	{
		header('Location: ../hata.php?hata=121');
		exit();
	}

	elseif (( strlen($_POST['yardimci']) > 100))
	{
		header('Location: ../hata.php?hata=122');
		exit();
	}

	elseif (( strlen($_POST['blm_yrd']) > 100))
	{
		header('Location: ../hata.php?hata=191');
		exit();
	}

	elseif (( strlen($_POST['kullanici']) > 100))
	{
		header('Location: ../hata.php?hata=123');
		exit();
	}

	elseif ((!preg_match('/^[01]+$/', $_POST['resim_yukle'])))
	{
		header('Location: ../hata.php?hata=126');
		exit();
	}

	elseif ((!preg_match('/^[01]+$/', $_POST['uzak_resim'])))
	{
		header('Location: ../hata.php?hata=127');
		exit();
	}

	elseif ((!preg_match('/^[01]+$/', $_POST['resim_galerisi'])))
	{
		header('Location: ../hata.php?hata=128');
		exit();
	}

	elseif ((!preg_match('/^[0-9]+$/', $_POST['resim_boyut'])) OR ($_POST['resim_boyut'] > 9999))
	{
		header('Location: ../hata.php?hata=129');
		exit();
	}

	elseif ( (!preg_match('/^[01]+$/', $_POST['uye_kayit'])) OR (!preg_match('/^[01]+$/', $_POST['kayit_onay'])) )
	{
		header('Location: ../hata.php?hata=160');
		exit();
	}

	elseif ( (!preg_match('/^[0-9]+$/', $_POST['resim_yukseklik'])) OR
			(!preg_match('/^[0-9]+$/', $_POST['resim_genislik'])) OR
			($_POST['resim_yukseklik'] > 999) OR ($_POST['resim_genislik'] > 999))
	{
		header('Location: ../hata.php?hata=130');
		exit();
	}

	else
	{
		$_POST['kayit_sorusu'] = zkTemizle($_POST['kayit_sorusu']);
		$_POST['kayit_cevabi'] = zkTemizle($_POST['kayit_cevabi']);
		$_POST['kul_resim'] = zkTemizle($_POST['kul_resim']);
		$_POST['kurucu'] = zkTemizle($_POST['kurucu']);
		$_POST['yonetici'] = zkTemizle($_POST['yonetici']);
		$_POST['yardimci'] = zkTemizle($_POST['yardimci']);
		$_POST['blm_yrd'] = zkTemizle($_POST['blm_yrd']);
		$_POST['kullanici'] = zkTemizle($_POST['kullanici']);
	}



	$_POST['cevrimici'] = ($_POST['cevrimici'] * 60);
	$_POST['resim_boyut'] = ($_POST['resim_boyut'] * 1024);
	$_POST['kilit_sure'] = ($_POST['kilit_sure'] * 60);


	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[bbcode]' where etiket='bbcode' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[cevrimici]' where etiket='cevrimici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[resim_boyut]' where etiket='resim_boyut' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kilit_sure]' where etiket='kilit_sure' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[ileti_sure]' where etiket='ileti_sure' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[imza_uzunluk]' where etiket='imza_uzunluk' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[uye_kayit]' where etiket='uye_kayit' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[hesap_etkin]' where etiket='hesap_etkin' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kayit_onay]' where etiket='onay_kodu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kayit_soru]' where etiket='kayit_soru' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kayit_sorusu]' where etiket='kayit_sorusu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kayit_cevabi]' where etiket='kayit_cevabi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kurucu]' where etiket='kurucu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yonetici]' where etiket='yonetici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yardimci]' where etiket='yardimci' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[blm_yrd]' where etiket='blm_yrd' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kullanici]' where etiket='kullanici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kul_resim]' where etiket='kul_resim' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[resim_yukle]' where etiket='resim_yukle' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[uzak_resim]' where etiket='uzak_resim' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[resim_galerisi]' where etiket='resim_galerisi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[resim_yukseklik]' where etiket='resim_yukseklik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[resim_genislik]' where etiket='resim_genislik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();
}





elseif ($_POST['kip'] =='yukleme')
{
	//	ALANLAR DOLU MU ?	//

	if ( (!$_POST['yukleme_dosya']) OR (!$_POST['yukleme_dizin']) OR (!$_POST['yukleme_boyut']) OR (!$_POST['yukleme_genislik']) OR (!$_POST['yukleme_yukseklik']) )
	{
		header('Location: ../hata.php?hata=98');
		exit();
	}

	elseif ((!preg_match('/^[0-9]+$/', $_POST['yukleme_boyut'])) OR (!preg_match('/^[0-9]+$/', $_POST['yukleme_genislik'])) OR (!preg_match('/^[0-9]+$/', $_POST['yukleme_yukseklik'])))
	{
		header('Location: ../hata.php?hata=226');
		exit();
	}


	$_POST['yukleme_dosya'] = zkTemizle($_POST['yukleme_dosya']);
	$_POST['yukleme_boyut'] = ($_POST['yukleme_boyut'] * 1024);

	$_POST['yukleme_dizin'] = zkTemizle($_POST['yukleme_dizin']);
	$_POST['yukleme_dizin'] = preg_replace("|^/|is", '', $_POST['yukleme_dizin']);
	$_POST['yukleme_dizin'] = preg_replace("|/$|is", '', $_POST['yukleme_dizin']);


	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yukleme_dosya]' where etiket='yukleme_dosya' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yukleme_dizin]' where etiket='yukleme_dizin' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yukleme_boyut]' where etiket='yukleme_boyut' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yukleme_genislik]' where etiket='yukleme_genislik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yukleme_yukseklik]' where etiket='yukleme_yukseklik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();
}





elseif ($_POST['kip'] =='duzenleyici')
{
	//	ALANLAR DOLU MU ?	//

	if ( (!$_POST['duzenleyici']) OR (!$_POST['dduzenleyici']) OR (!$_POST['yduzenleyici']) )
	{
		header('Location: ../hata.php?hata=98');
		exit();
	}


	$_POST['duzenleyici'] = zkTemizle($_POST['duzenleyici']);
	$_POST['dduzenleyici'] = zkTemizle($_POST['dduzenleyici']);
	$_POST['yduzenleyici'] = zkTemizle($_POST['yduzenleyici']);

	$_POST['duzenleyici_font'] = zkTemizle($_POST['duzenleyici_font']);
	$_POST['dugme_html'] = zkTemizle($_POST['dugme_html']);
	$_POST['dugme_bbcode'] = zkTemizle($_POST['dugme_bbcode']);
	$_POST['dugme_hizli'] = zkTemizle($_POST['dugme_hizli']);
	$_POST['duzenleyici_html_tema'] = zkTemizle($_POST['duzenleyici_html_tema']);
	$_POST['duzenleyici_bbcode_tema'] = zkTemizle($_POST['duzenleyici_bbcode_tema']);
	$_POST['duzenleyici_hizli_tema'] = zkTemizle($_POST['duzenleyici_hizli_tema']);
	$_POST['dugme_kodlar'] = zkTemizle0($_POST['dugme_kodlar']);
	$_POST['dugme_stil'] = zkTemizle0($_POST['dugme_stil']);



	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[duzenleyici]' where etiket='duzenleyici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dduzenleyici]' where etiket='dduzenleyici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[yduzenleyici]' where etiket='yduzenleyici' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[duzenleyici_font]' where etiket='duzenleyici_font' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dugme_html]' where etiket='dugme_html' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dugme_bbcode]' where etiket='dugme_bbcode' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dugme_hizli]' where etiket='dugme_hizli' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[duzenleyici_html_tema]' where etiket='duzenleyici_html_tema' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[duzenleyici_bbcode_tema]' where etiket='duzenleyici_bbcode_tema' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[duzenleyici_hizli_tema]' where etiket='duzenleyici_hizli_tema' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dugme_kodlar]' where etiket='dugme_kodlar' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dugme_stil]' where etiket='dugme_stil' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();
}

$gec='';

//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //










//  GENEL AYARLAR - BAŞI  //

else:


//	ALANLAR DOLU MU ?	//

if ( (!$_POST['title']) OR (!$_POST['anasyfbaslik']) OR (!$_POST['syfbaslik']) OR (!$_POST['alanadi']) OR (!$_POST['f_dizin']) OR (!$_POST['fsyfkota']) OR (!$_POST['ksyfkota']) OR (!$_POST['tarih_bicimi']) OR (!$_POST['saat_dilimi']) OR (!$_POST['k_cerez_zaman']) OR (!$_POST['dil_varsayilan']) OR (!$_POST['dil_eklenen']) )
{
	header('Location: ../hata.php?hata=98');
	exit();
}

elseif (( strlen($_POST['title']) > 100) OR ( strlen($_POST['anasyfbaslik']) > 100) OR ( strlen($_POST['syfbaslik']) > 100))
{
	header('Location: ../hata.php?hata=99');
	exit();
}

elseif (( strlen($_POST['alanadi']) > 100))
{
	header('Location: ../hata.php?hata=100');
	exit();
}

elseif (( strlen($_POST['f_dizin']) > 100))
{
	header('Location: ../hata.php?hata=101');
	exit();
}

elseif (( strlen($_POST['fsyfkota']) > 2) OR ( strlen($_POST['ksyfkota']) > 2))
{
	header('Location: ../hata.php?hata=102');
	exit();
}

elseif ((!preg_match('/^[0-9]+$/', $_POST['fsyfkota'])) OR (!preg_match('/^[0-9]+$/', $_POST['ksyfkota'])))
{
	header('Location: ../hata.php?hata=103');
	exit();
}

elseif (( strlen($_POST['tarih_bicimi']) > 20))
{
	header('Location: ../hata.php?hata=113');
	exit();
}

elseif (( strlen($_POST['saat_dilimi']) > 4) OR ( strlen($_POST['saat_dilimi']) < 1))
{
	header('Location: ../hata.php?hata=114');
	exit();
}

elseif (!preg_match('/^[0-9]+$/', $_POST['k_cerez_zaman']))
{
	header('Location: ../hata.php?hata=104');
	exit();
}

elseif (strlen($_POST['k_cerez_zaman']) > 5)
{
	header('Location: ../hata.php?hata=105');
	exit();
}

elseif ( (!preg_match('/^[01]+$/', $_POST['forum_durumu'])) OR (!preg_match('/^[01]+$/', $_POST['sonkonular'])) OR (!preg_match('/^[01]+$/', $_POST['seo']))
		OR (!preg_match('/^[01]+$/', $_POST['boyutlandirma'])) OR (!preg_match('/^[01]+$/', $_POST['bolum_kisi']))
		OR (!preg_match('/^[01]+$/', $_POST['konu_kisi'])) OR (!preg_match('/^[012]+$/', $_POST['vt_hata'])) )
{
	header('Location: ../hata.php?hata=160');
	exit();
}

elseif (!preg_match('/^[0-9]+$/', $_POST['kacsonkonu']))
{
	header('Location: ../hata.php?hata=118');
	exit();
}

elseif ($_POST['kacsonkonu'] > 50)
{
	header('Location: ../hata.php?hata=119');
	exit();
}

elseif (( strlen($_POST['forum_rengi']) > 10) OR ( strlen($_POST['forum_rengi']) < 1))
{
	header('Location: ../hata.php?hata=115');
	exit();
}


else
{
	if (get_magic_quotes_gpc())
	{
		$_POST['title'] = stripslashes($_POST['title']);
		$_POST['anasyfbaslik'] = stripslashes($_POST['anasyfbaslik']);
		$_POST['syfbaslik'] = stripslashes($_POST['syfbaslik']);
		$_POST['tema_genislik'] = stripslashes($_POST['tema_genislik']);
		$_POST['tema_logo_ust'] = stripslashes($_POST['tema_logo_ust']);
		$_POST['tema_logo_alt'] = stripslashes($_POST['tema_logo_alt']);
		$_POST['meta_diger'] = stripslashes($_POST['meta_diger']);
		$_POST['site_taban_kod'] = stripslashes($_POST['site_taban_kod']);
	}


	$_POST['title'] = zkTemizle($_POST['title']);
	$_POST['anasyfbaslik'] = zkTemizle($_POST['anasyfbaslik']);
	$_POST['syfbaslik'] = zkTemizle($_POST['syfbaslik']);
	$_POST['alanadi'] = zkTemizle($_POST['alanadi']);
	$_POST['f_dizin'] = zkTemizle($_POST['f_dizin']);
	$_POST['tarih_bicimi'] = zkTemizle($_POST['tarih_bicimi']);
	$_POST['forum_rengi'] = zkTemizle($_POST['forum_rengi']);
	$_POST['tema_genislik'] = zkTemizle($_POST['tema_genislik']);
	$_POST['tema_logo_ust'] = zkTemizle0($_POST['tema_logo_ust']);
	$_POST['tema_logo_alt'] = zkTemizle0($_POST['tema_logo_alt']);
	$_POST['meta_diger'] = zkTemizle0($_POST['meta_diger']);
	$_POST['site_taban_kod'] = zkTemizle0($_POST['site_taban_kod']);
	$_POST['dil_varsayilan'] = zkTemizle($_POST['dil_varsayilan']);
	$_POST['dil_eklenen'] = zkTemizle($_POST['dil_eklenen']);
}



	$_POST['k_cerez_zaman'] = ($_POST['k_cerez_zaman'] * 60);

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[k_cerez_zaman]' where etiket='k_cerez_zaman' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[title]' where etiket='title' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[anasyfbaslik]' where etiket='anasyfbaslik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[syfbaslik]' where etiket='syfbaslik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[alanadi]' where etiket='alanadi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[f_dizin]' where etiket='f_dizin' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[forum_durumu]' where etiket='forum_durumu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[fsyfkota]' where etiket='fsyfkota' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[ksyfkota]' where etiket='ksyfkota' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[sonkonular]' where etiket='sonkonular' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[kacsonkonu]' where etiket='kacsonkonu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[tarih_bicimi]' where etiket='tarih_bicimi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[saat_dilimi]' where etiket='saat_dilimi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[seo]' where etiket='seo' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[boyutlandirma]' where etiket='boyutlandirma' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[bolum_kisi]' where etiket='bolum_kisi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[konu_kisi]' where etiket='konu_kisi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[vt_hata]' where etiket='vt_hata' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[forum_rengi]' where etiket='forum_rengi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[tema_genislik]' where etiket='tema_genislik' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[tema_logo_ust]' where etiket='tema_logo_ust' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[tema_logo_alt]' where etiket='tema_logo_alt' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[meta_diger]' where etiket='meta_diger' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[site_taban_kod]' where etiket='site_taban_kod' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dil_varsayilan]' where etiket='dil_varsayilan' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_POST[dil_eklenen]' where etiket='dil_eklenen' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



	// Değişiklik uygulandı bildirimi
	header('Location: ../hata.php?bilgi=12');
	exit();


endif; // kip koşul sonu

//  GENEL AYARLAR - SONU  //




endif; // formu dolu koşul sonu
?>