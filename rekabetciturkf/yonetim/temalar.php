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
$uyumlu_surum = '2.10'; //$ayarlar['surum'];


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';


//	FORUM - PORTAL SEÇİMİ	//
//	FORUM - PORTAL SEÇİMİ	//

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'forum') ) $kip = 'forum';

elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'portal') )
{
	$vtsorgu = "SELECT * FROM $tablo_portal_ayarlar where isim='tema_secenek' LIMIT 1";
	$pt_sonuc = @$vt->query($vtsorgu) or die ($vt->hata_ver());
	$portal_temalari = $vt->fetch_assoc($pt_sonuc);

	$kip = 'portal';
}

else $kip = 'forum';




//	VARSAYILAN TEMAYI DEĞİŞTİR	//
//	VARSAYILAN TEMAYI DEĞİŞTİR	//

if ( (isset($_GET['temadizini'])) AND ($_GET['temadizini'] != '') )
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['temadizini']) > 20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}

	$_GET['temadizini'] = @zkTemizle($_GET['temadizini']);


	// forum için varsayılan tema değişimi	//

	if ($kip == 'forum')
	{
		// tema bilgileri tema_bilgi.txt dosyasından alınıyor

		$dosya = '../temalar/'.$_GET['temadizini'].'/tema_bilgi.txt';

		if (!($dosya_ac = fopen($dosya,'r')))
		{
			echo '<p><font color="red"><b>'.$dosya.' dosyası bulunamıyor!</b></font><p>';
			exit();
		}


		// forum tema sürüme bakılıyor

		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// forum teması seçeneklerde var mı bakılıyor

		if (!preg_match("/$_GET[temadizini],/", $ayarlar['tema_secenek']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}


		// tema dizini veritabanına giriliyor //

		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_GET[temadizini]' where etiket='temadizini' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=forum');
		exit();
	}


	// portal için varsayılan tema değişimi //

	else
	{
		// tema bilgileri tema_bilgi.txt dosyasından alınıyor

		$dosya = '../portal/temalar/'.$_GET['temadizini'].'/tema_bilgi.txt';

		if (!($dosya_ac = fopen($dosya,'r')))
		{
			echo '<p><font color="red"><b>'.$dosya.' dosyası bulunamıyor!</b></font><p>';
			exit();
		}


		// portal tema sürümüne bakılıyor

		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// portal teması seçeneklerde var mı bakılıyor

		$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$portal_ayarlar = $vt->fetch_assoc($vtsonuc);

		if (!preg_match("/$_GET[temadizini],/", $portal_ayarlar['sayi']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}


		// tema dizini veritabanına giriliyor //

		$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_GET[temadizini]' where isim='temadizini' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=portal');
		exit();
	}
}




//	KULLANICI SEÇİMLERİNİ BU TEMAYA AYARLA	//
//	KULLANICI SEÇİMLERİNİ BU TEMAYA AYARLA	//

elseif ( (isset($_GET['kullanici'])) AND ($_GET['kullanici'] != '') )
{
	$_GET['kullanici'] = @zkTemizle($_GET['kullanici']);

	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['kullanici']) >  20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}



	// forum için kullanıcı seçimi //

	if ($kip == 'forum')
	{
		// forum tema sürümüne bakılıyor

		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// forum teması seçeneklerde var mı bakılıyor

		if (!preg_match("/$_GET[kullanici],/", $ayarlar['tema_secenek']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}



		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizini='$_GET[kullanici]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=forum');
		exit();
	}


	// portal için kullanıcı seçimi //

	else
	{
		// portal tema sürümüne bakılıyor

		$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='portal_surum' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$portal_ayarlar = $vt->fetch_assoc($vtsonuc);

		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// portal teması seçeneklerde var mı bakılıyor

		$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$portal_ayarlar = $vt->fetch_assoc($vtsonuc);

		if (!preg_match("/$_GET[kullanici],/", $portal_ayarlar['sayi']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}



		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizinip='$_GET[kullanici]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=portal');
		exit();
	}
}




//	TEMAYI SEÇENEKLERE EKLE	//
//	TEMAYI SEÇENEKLERE EKLE	//

elseif ( (isset($_GET['ekle'])) AND ($_GET['ekle'] != '') )
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['ekle']) >  20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}



	// forum için seçeneklere ekle //

	if ( ($kip == 'forum') AND (!preg_match("/$_GET[ekle],/", $ayarlar['tema_secenek'])) )
	{
		$tema_ekle = @zkTemizle($_GET['ekle']);
		$tema_ekle = $ayarlar['tema_secenek'].$tema_ekle.',';


		// forum tema sürümüne bakılıyor

		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// tema seçenekler arasına ekleniyor

		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tema_ekle' where etiket='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=forum');
		exit();
	}


	// portal için seçeneklere ekle //

	elseif ( ($kip == 'portal') AND (!preg_match("/$_GET[ekle],/", $portal_temalari['sayi'])) )
	{
		$tema_ekle = @zkTemizle($_GET['ekle']);
		$tema_ekle = $portal_temalari['sayi'].$tema_ekle.',';


		// portal tema sürümüne bakılıyor

		$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='portal_surum' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$portal_ayarlar = $vt->fetch_assoc($vtsonuc);

		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// tema seçenekler arasına ekleniyor

		$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$tema_ekle' where isim='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=portal');
		exit();
	}

	header('Location: temalar.php');
	exit();
}




//	TEMAYI SEÇENEKLERDEN KALDIR	//
//	TEMAYI SEÇENEKLERDEN KALDIR	//

elseif ( (isset($_GET['kaldir'])) AND ($_GET['kaldir'] != '') )
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['kaldir']) >  20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}


	if ($_GET['kaldir'] == 'varsayilan')
	{
		header('Location: hata.php?hata=150');
		exit();
	}


	// forum için seçeneklerden kalır //

	if ( ($kip == 'forum') AND (preg_match("/$_GET[kaldir],/", $ayarlar['tema_secenek'])) )
	{
		$_GET['kaldir'] = @zkTemizle($_GET['kaldir']);
		$tema_cikart = str_replace($_GET['kaldir'].',','',$ayarlar['tema_secenek']);


		// tema varsayılan ise kaldırılıyor

		if ($ayarlar['temadizini'] == $_GET['kaldir'])
		{
			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='varsayilan' where etiket='temadizini' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}


		// tema seçenekler arasından kaldırılıyor

		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tema_cikart' where etiket='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// temayı kullanan üyelerin seçimleri siliniyor

		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizini='' where temadizini='$_GET[kaldir]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=forum');
		exit();
	}


	// portal için seçeneklerden kaldır //

	elseif ( ($kip == 'portal') AND (preg_match("/$_GET[kaldir],/", $portal_temalari['sayi'])) )
	{
		$_GET['kaldir'] = @zkTemizle($_GET['kaldir']);

		$tema_cikart = str_replace($_GET['kaldir'].',','',$portal_temalari['sayi']);


		// portal varsayılan tema alınıyor
		$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='temadizini' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$portal_ayarlar = $vt->fetch_assoc($vtsonuc);

		// tema varsayılan ise kaldırılıyor

		if ($portal_ayarlar['sayi'] == $_GET['kaldir'])
		{
			$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='varsayilan' where isim='temadizini' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		// tema seçenekler arasından kaldırılıyor

		$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$tema_cikart' where isim='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// temayı kullanan üyelerin seçimleri siliniyor

		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizinip='' where temadizinip='$_GET[kaldir]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: temalar.php?kip=portal');
		exit();
	}

	header('Location: temalar.php');
	exit();
}



$sayfa_adi = 'Yönetim Tema Sayfası';
include_once('bilesenler/sayfa_baslik.php');



// portal sürümü alınıyor
if ($kip == 'portal')
{
	$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='portal_surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$portal_ayarlar = $vt->fetch_assoc($vtsonuc);
}



//	SUNUCUDA YÜKLÜ TEMALAR SIRALANIYOR - BAŞI	//

if ($kip == 'forum') $dizin_adi = '../temalar/';	// forum tema dizini
else $dizin_adi = '../portal/temalar/';	// portal tema dizini

$dizin = @opendir($dizin_adi);	// dizini açıyoruz
$yanlis_tema = 'where';


//	DİZİNDEKİ DOSYALAR DÖNGÜYE SOKULARAK GÖRÜNTÜLENİYOR	//

while ( @gettype($bilgi = @readdir($dizin)) != 'boolean' )
{
	if ( (@is_dir($dizin_adi.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
	{
		// tema bilgileri tema_bilgi.txt dosyasından alınıyor

		$dosya = $dizin_adi.$bilgi.'/tema_bilgi.txt';
		if (!($dosya_ac = fopen($dosya,'r')))
		{
			echo '<p><font color="red"><b>'.$dosya.' dosyası bulunamıyor!</b></font><p>';
			continue;
		}

		$boyut = filesize($dosya);
		$dosya_metni = fread($dosya_ac,$boyut);
		fclose($dosya_ac);


		//	tema bilgileri parçalanıyor

		preg_match('|<TEMA_ADI>(.*?)</TEMA_ADI>|si', $dosya_metni, $tema_adi, PREG_OFFSET_CAPTURE);
		preg_match('|<YAPIMCI>(.*?)</YAPIMCI>|si', $dosya_metni, $tema_yapimci, PREG_OFFSET_CAPTURE);
		preg_match('|<BAGLANTI>(.*?)</BAGLANTI>|si', $dosya_metni, $tema_baglanti, PREG_OFFSET_CAPTURE);
		preg_match('|<SURUM>(.*?)</SURUM>|si', $dosya_metni, $tema_surum, PREG_OFFSET_CAPTURE);
		preg_match('|<TARIH>(.*?)</TARIH>|si', $dosya_metni, $tema_tarih, PREG_OFFSET_CAPTURE);
		preg_match('|<DEMO>(.*?)</DEMO>|si', $dosya_metni, $tema_demo, PREG_OFFSET_CAPTURE);
		preg_match('|<ACIKLAMA>(.*?)</ACIKLAMA>|si', $dosya_metni, $tema_aciklama, PREG_OFFSET_CAPTURE);
		preg_match('|<DUZENLEME>(.*?)</DUZENLEME>|si', $dosya_metni, $tema_duzenleme, PREG_OFFSET_CAPTURE);


		// bilgiler temizleniyor

		$tema_adi[1][0] = @zkTemizle($tema_adi[1][0]);
		$tema_yapimci[1][0] = @zkTemizle($tema_yapimci[1][0]);
		$tema_baglanti[1][0] = @zkTemizle($tema_baglanti[1][0]);
		$tema_surum[1][0] = @zkTemizle($tema_surum[1][0]);
		$tema_tarih[1][0] = @zkTemizle($tema_tarih[1][0]);
		$tema_demo[1][0] = @zkTemizle($tema_demo[1][0]);
		$tema_aciklama[1][0] = @zkTemizle($tema_aciklama[1][0]);

		if (isset($tema_duzenleme[1][0])) 
			$tema_duzenleme = '<p><b>Düzenleme : &nbsp; </b>'.@zkTemizle($tema_duzenleme[1][0]);

		else $tema_duzenleme = '';


		//	veriler tema motoruna yollanıyor	//

		$tema_resim = $dizin_adi.$bilgi.'/onizleme.jpg';
		$tema_yapimci = '<a href="http://'.$tema_baglanti[1][0].'">'.$tema_yapimci[1][0].'</a>';
		if ($tema_demo[1][0] != '') $tema_demo = '<a href="http://'.$tema_demo[1][0].'" target="_blank">Tıklayın</a>';
		else $tema_demo = 'Yok';


		// forum için	//

		if ($kip == 'forum')
		{
			// bu temayı kullananların sayısı
			$vtsonuc9 = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE temadizini='$bilgi'") or die ($vt->hata_ver());
			$tema_kullanim = $vt->num_rows($vtsonuc9);


			// şu an kullanılan tema dizini alınıyor
			$vtsorgu = "SELECT deger FROM $tablo_ayarlar where etiket='temadizini' LIMIT 1";
			$vtsonuc = @$vt->query($vtsorgu) or die ($vt->hata_ver());
			$suanki_tema = $vt->fetch_assoc($vtsonuc);


			$tema_uygulama = '<a href="temalar.php?kip=forum&amp;temadizini='.$bilgi.'&amp;surum='.$tema_surum[1][0].'&amp;yo='.$yo.'" onclick="return window.confirm(\'Forumun varsayılan temasını değiştirmek istediğinize eminmisiniz ?\')">- varsayılan tema yap -</a>';
			$tema_kullanici = '<a href="temalar.php?kip=forum&amp;kullanici='.$bilgi.'&amp;surum='.$tema_surum[1][0].'&amp;yo='.$yo.'" onclick="return window.confirm(\'Tüm üye seçimlerini bu tema ile değiştirmek istediğinize eminmisiniz ?\')">- üye seçimlerini değiştir -</a>';


			if (preg_match("/$bilgi,/", $ayarlar['tema_secenek']))
				$ekle_kaldir = '<a href="temalar.php?kip=forum&amp;kaldir='.$bilgi.'&amp;yo='.$yo.'">-KALDIR-</a>';
			else $ekle_kaldir = '<a href="temalar.php?kip=forum&amp;ekle='.$bilgi.'&amp;surum='.$tema_surum[1][0].'&amp;yo='.$yo.'">- EKLE -</a>';
			if ($suanki_tema['deger'] == $bilgi) $ekle_kaldir = '<font color="green">Kullanılan</font><br><br>'.$ekle_kaldir;


			if (!preg_match('/'.$uyumlu_surum.'/', $tema_surum[1][0]))
				$ftema_surum = $tema_surum[1][0].' &nbsp; <font color="#ff0000"><i>( Uyumsuz )</i></font>';
			else $ftema_surum = str_replace(';',', ', $tema_surum[1][0]);


			$tekli1[] = array('{TEMA_RESIM}' => $tema_resim,
			'{TEMA_ADI}' => $tema_adi[1][0],
			'{TEMA_YAPIMCI}' => $tema_yapimci,
			'{TEMA_SURUM}' => $ftema_surum,
			'{TEMA_TARIH}' => $tema_tarih[1][0],
			'{TEMA_DEMO}' => $tema_demo,
			'{TEMA_ACIKLAMA}' => $tema_aciklama[1][0].$tema_duzenleme,
			'{TEMA_UYGULAMA}' => $tema_uygulama,
			'{EKLE_KALDIR}' => $ekle_kaldir,
			'{TEMA_KULLANICI}' => $tema_kullanici,
			'{TEMA_KULLANIM}' => $tema_kullanim.'<br>kişi');


			// yüklü olmayan tema seçimleri için sorgu
			$yanlis_tema .= " temadizini!='$bilgi' AND";
		}



		// portal için	//

		elseif ($kip == 'portal')
		{
			// bu temayı kullananların sayısı
			$vtsonuc9 = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE temadizinip='$bilgi'") or die ($vt->hata_ver());
			$tema_kullanim = $vt->num_rows($vtsonuc9);
			$ptemas = str_replace('Portal - ', '',$tema_surum[1][0]);


			// şu an kullanılan tema dizini alınıyor
			$vtsorgu = "SELECT sayi FROM $tablo_portal_ayarlar where isim='temadizini' LIMIT 1";
			$vtsonuc = @$vt->query($vtsorgu) or die ($vt->hata_ver());
			$suanki_tema = $vt->fetch_assoc($vtsonuc);


			$tema_uygulama = '<a href="temalar.php?kip=portal&amp;temadizini='.$bilgi.'&amp;surum='.$ptemas.'&amp;yo='.$yo.'" onclick="return window.confirm(\'Portalın varsayılan temasını değiştirmek istediğinize eminmisiniz ?\')">- varsayılan tema yap -</a>';
			$tema_kullanici = '<a href="temalar.php?kip=portal&amp;kullanici='.$bilgi.'&amp;surum='.$ptemas.'&amp;yo='.$yo.'" onclick="return window.confirm(\'Tüm üye seçimlerini bu tema ile değiştirmek istediğinize eminmisiniz ?\')">- üye seçimlerini değiştir -</a>';


			if (preg_match("/$bilgi,/", $portal_temalari['sayi']))
				$ekle_kaldir = '<a href="temalar.php?kip=portal&amp;kaldir='.$bilgi.'&amp;yo='.$yo.'">-KALDIR-</a>';
			else $ekle_kaldir = '<a href="temalar.php?kip=portal&amp;ekle='.$bilgi.'&amp;surum='.$ptemas.'&amp;yo='.$yo.'">- EKLE -</a>';
			if ($suanki_tema['sayi'] == $bilgi) $ekle_kaldir = '<font color="green">Kullanılan</font><br><br>'.$ekle_kaldir;


			if (!preg_match('/'.$uyumlu_surum.'/', $ptemas))
				$ptema_surum = $tema_surum[1][0].' &nbsp; <font color="#ff0000"><i>( Uyumsuz )</i></font>';
			else $ptema_surum = str_replace(';',', ', $tema_surum[1][0]);


			$tekli1[] = array('{TEMA_RESIM}' => $tema_resim,
			'{TEMA_ADI}' => $tema_adi[1][0],
			'{TEMA_YAPIMCI}' => $tema_yapimci,
			'{TEMA_SURUM}' => $ptema_surum,
			'{TEMA_TARIH}' => $tema_tarih[1][0],
			'{TEMA_DEMO}' => $tema_demo,
			'{TEMA_ACIKLAMA}' => $tema_aciklama[1][0].$tema_duzenleme,
			'{TEMA_UYGULAMA}' => $tema_uygulama,
			'{EKLE_KALDIR}' => $ekle_kaldir,
			'{TEMA_KULLANICI}' => $tema_kullanici,
			'{TEMA_KULLANIM}' => $tema_kullanim.'<br>kişi');


			// yüklü olmayan tema seçimleri için sorgu
			$yanlis_tema .= " temadizinip!='$bilgi' AND";
		}
	}
}


@closedir($dizin);	// dizin kapatılıyor



	//	SUNUCUDA YÜKLÜ TEMALAR SIRALANIYOR - SONU	//



// forum için

if ($kip == 'forum')
{
	//	YÜKLÜ OLMAYAN TEMA KULLANALAR	//

	$yanlis_tema .= " temadizini!=''";

	$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar $yanlis_tema";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		$profil_degistir = '';

		while ($uye_adi = $vt->fetch_assoc($vtsonuc))
			$profil_degistir .= '<a href="kullanici_degistir.php?u='.$uye_adi['id'].'">'.$uye_adi['kullanici_adi'].'</a> , ';


		$yanlis_kullananlar = '<p align="left"><u><b>Dikkat:</b></u> &nbsp; Bir temayı kaldırmadan dosyalarını sildiğiniz için alttaki kullanıcılar, sunucunuzda yüklü olmayan bir tema seçmiş görünüyor. Eğer bu kullanıcıların seçimlerini düzeltmezseniz foruma giremezler.
	
		<br><br> İsterseniz kullanıcı adlerını teker teker tıklayarak profillerini değiştirebilir, ya da yukarıdaki temalardan birinin yanındaki
		<br> "- üye seçimlerini değiştir -" bağlantısını tıklayarak bu durumu düzeltebilirsiniz. </p>
	
		<b>Yanlış Tema Seçenler:</b> &nbsp; '.$profil_degistir;
	}


	else $yanlis_kullananlar = '';



	$sayfa_aciklama = '
<b>&nbsp; &nbsp; /temalar</b> dizininde yüklü olan temalar aşağıda sıralanmaktadır. Yeni tema yüklemek için indirdiğiniz temayı klasörüyle beraber /temalar dizine kopyalayın ve aşağıdan <b>- varsayılan tema yap -</b> bağlantısını tıklayın. 
<br><br>
&nbsp; &nbsp; Kullanıcıların yüklediğiniz temalar arasından seçim yapabilmesi için, temanın sol tarafındaki <b>- EKLE -</b> bağlantısı tıklayın. Seçenekler arasından çıkartmak içinse yine aynı yerdeki <b>-KALDIR-</b> bağlantısını tıklayın.

<br>&nbsp; &nbsp; Her temanın sol tarafında görünen <b>Kullanım</b> alanında, o temanın kaç kişi tarafından seçildiğini görebilirsiniz.

<br>&nbsp; &nbsp; Sunucunuzda yüklü olan temaları silmek istediğinizde, bu temayı seçmiş kişilerin hata almaması için önce <b>-KALDIR-</b> bağlantısını tıklayın. Aksi bir durum olduğunda sayfanın en altında bir uyarı belirecektir.
<br>&nbsp; &nbsp; İstediğiniz temanın yanındaki <b>- üye seçimlerini değiştir -</b> bağlantısını tıklayarak, tüm üyelerin seçimlerini bu tema ile değiştirebilirsiniz.';

	$kip_portal = '<a href="temalar.php?kip=portal" style="text-decoration: none"><b>Portal Temaları&nbsp; &raquo;</b></a>';


	$dongusuz = array('{KIP_FORUM}' => '&laquo; &nbsp;Forum Temaları',
	'{KIP_PORTAL}' => $kip_portal,
	'{SAYFA_ACIKLAMA}' => $sayfa_aciklama,
	'{SUANKI_TEMA}' => $suanki_tema['deger'],
	'{YANLIS_KULLANAN}' => $yanlis_kullananlar);
}



// portal için

elseif ($kip == 'portal')
{
	//	YÜKLÜ OLMAYAN TEMA KULLANALAR	//

	$yanlis_tema .= " temadizinip!=''";

	$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar $yanlis_tema";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		$profil_degistir = '';

		while ($uye_adi = $vt->fetch_assoc($vtsonuc))
			$profil_degistir .= '<a href="kullanici_degistir.php?u='.$uye_adi['id'].'">'.$uye_adi['kullanici_adi'].'</a> , ';


		$yanlis_kullananlar = '<p align="left"><u><b>Dikkat:</b></u> &nbsp; Bir temayı kaldırmadan dosyalarını sildiğiniz için alttaki kullanıcılar, sunucunuzda yüklü olmayan bir tema seçmiş görünüyor. Eğer bu kullanıcıların seçimlerini düzeltmezseniz foruma giremezler.
	
		<br><br> İsterseniz kullanıcı adlerını teker teker tıklayarak profillerini değiştirebilir, ya da yukarıdaki temalardan birinin yanındaki
		<br> "- üye seçimlerini değiştir -" bağlantısını tıklayarak bu durumu düzeltebilirsiniz. </p>
	
		<b>Yanlış Tema Seçenler:</b> &nbsp; '.$profil_degistir;
	}


	else $yanlis_kullananlar = '';



	$sayfa_aciklama = '
&nbsp; &nbsp; Portal için; &nbsp; <b>/portal/temalar</b> dizininde yüklü olan temalar aşağıda sıralanmaktadır. Yeni tema yüklemek için tek yapmanız gereken temayı klasörüyle beraber bu dizine kopyalamak ve aşağıdan <b>- varsayılan tema yap -</b> bağlantısını tıklamak.
<br><br>
&nbsp; &nbsp; Kullanıcıların yüklediğiniz temalar arasından seçim yapabilmesi için, temanın sol tarafındaki <b>- EKLE -</b> bağlantısı tıklayın. Seçenekler arasından çıkartmak içinse yine aynı yerdeki <b>-KALDIR-</b> bağlantısını tıklayın.

<br><br>&nbsp; &nbsp; Her temanın sol tarafında görünen <b>Kullanım</b> alanında, o temanın kaç kişi tarafından seçildiğini görebilirsiniz. 

<br><br>&nbsp; &nbsp; Sunucunuzda yüklü olan temaları silmek istediğinizde, bu temayı seçmiş kişilerin hata almaması için önce <b>-KALDIR-</b> bağlantısını tıklayın. Aksi bir durum olduğunda sayfanın en altında bir uyarı belirecektir.

<br><br>&nbsp; &nbsp; İstediğiniz temanın yanındaki <b>- üye seçimlerini değiştir -</b> bağlantısını tıklayarak, tüm üyelerin seçimlerini bu tema ile değiştirebilirsiniz.';

	$kip_forum = '<a href="temalar.php?kip=forum" style="text-decoration: none"><b>&laquo; &nbsp;Forum Temaları</b></a>';


	$dongusuz = array('{KIP_FORUM}' =>$kip_forum,
	'{KIP_PORTAL}' => 'Portal Temaları&nbsp; &raquo;',
	'{SAYFA_ACIKLAMA}' => $sayfa_aciklama,
	'{SUANKI_TEMA}' => $suanki_tema['sayi'],
	'{YANLIS_KULLANAN}' => $yanlis_kullananlar);
}




//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/temalar.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));

$ornek1->dongusuz($dongusuz);
$ornek1->tekli_dongu('1',$tekli1);


if ($portal_kullan == 1)
$ornek1->kosul('1', array('' => ''), true);

else $ornek1->kosul('1', array('' => ''), false);

eval(TEMA_UYGULA);

?>