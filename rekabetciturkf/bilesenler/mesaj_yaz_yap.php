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


//	FORM DOLU MU ?	//

if ( (isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu') )
{
	if (is_numeric($_POST['fno']) == false)
	{
		header('Location: ../hata.php?hata=14');
		exit();
	}

	else $_POST['fno'] = zkTemizle2($_POST['fno']);


	// FORUM BİLGİLERİ ÇEKİLİYOR //

	$vtsorgu = "SELECT id,okuma_izni,yazma_izni,konu_acma_izni FROM $tablo_forumlar WHERE id='$_POST[fno]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir = $vt->fetch_array($vtsonuc);

	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=14');
		exit();
	}


	if (is_numeric($_POST['mesaj_no']) == false)
	{
		header('Location: ../hata.php?hata=47');
		exit();
	}

	else $_POST['mesaj_no'] = zkTemizle($_POST['mesaj_no']);




		//	FORUM YETKİLERİ - BAŞI	//
		//	FORUM YETKİLERİ - BAŞI	//



// forum okumaya kapalıysa sadece yöneticiler girebilir
if ($forum_satir['okuma_izni'] == 5)
{
	if ( (!isset($kullanici_kim['yetki']) ) OR ($kullanici_kim['yetki'] != 1) )
	{
		header('Location: ../hata.php?hata=164');
		exit();
	}
}



	//	KULLANICIYA GÖRE CEVAP YAZMA - BAŞI		//

if ($_POST['kip'] == 'cevapla')
{
	// KONUNUN KİLİT DURUMUNA BAKILIYOR

	$vtsorgu = "SELECT kilitli FROM $tablo_mesajlar WHERE id='$_POST[mesaj_no]' AND silinmis='0' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kilit_satir = $vt->fetch_array($vtsonuc);

	// konu yok uyarısı
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=47');
		exit();
	}

	// konu kilitli uyarısı
	elseif ($kilit_satir['kilitli'] == 1)
	{
		header('Location: ../hata.php?hata=57');
		exit();
	}



	//	OKUMA İZNİ SADECE YÖNETİCİLER İÇİNSE	//

	if ($forum_satir['okuma_izni'] == 1)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=15');
			exit();
		}
	}


	//	CEVAP YAZMAYA KAPALIYSA	//

	elseif ($forum_satir['yazma_izni'] == 5)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=193');
			exit();
		}
	}


	//	CEVAP YAZMA İZNİ SADECE YÖNETİCİLER İÇİNSE	//

	elseif ($forum_satir['yazma_izni'] == 1)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=58');
			exit();
		}
	}


	//	CEVAP YAZMA İZNİ SADECE YÖNETİCİLER VE YARDIMCILAR İÇİNSE	//

	elseif ($forum_satir['yazma_izni'] == 2)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1)
			AND ($kullanici_kim['yetki'] != 2) AND ($kullanici_kim['yetki'] != 3) )
		{
			header('Location: ../hata.php?hata=59');
			exit();
		}
	}


	//	CEVAP YAZMA İZNİ SADECE ÖZEL ÜYELER İÇİNSE 	//

	elseif ($forum_satir['yazma_izni'] == 3)
	{
		//	YÖNETİCİ DEĞİLSE KOŞULLARA BAK	//

		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2) )
		{
			if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$_POST[fno]' AND yazma='1' OR";
			else $grupek = "grup='0' AND";

			$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$_POST[fno]' AND yazma='1'";
			$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

			if ( !$vt->num_rows($kul_izin) )
			{
				header('Location: ../hata.php?hata=60');
				exit();
			}
		}
	}
}

	//	KULLANICIYA GÖRE CEVAP YAZMA - SONU			//




	//	KULLANICIYA GÖRE KONU AÇMA - BAŞI		//

else
{
	//	OKUMA İZNİ SADECE YÖNETİCİLER İÇİNSE	//

	if ($forum_satir['okuma_izni'] == 1)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=15');
			exit();
		}
	}


	//	KONU AÇMAYA KAPALIYSA 	//

	elseif ($forum_satir['konu_acma_izni'] == 5)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=192');
			exit();
		}
	}


	//	SADECE YÖNETİCİLER İÇİNSE	//

	elseif ($forum_satir['konu_acma_izni'] == 1)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=165');
			exit();
		}
	}


	//	SADECE YÖNETİCİLER VE YARDIMCILAR İÇİNSE	//

	elseif ($forum_satir['konu_acma_izni'] == 2)
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1)
			AND ($kullanici_kim['yetki'] != 2) AND ($kullanici_kim['yetki'] != 3) )
		{
			header('Location: ../hata.php?hata=166');
			exit();
		}
	}


	//	SADECE ÖZEL ÜYELER İÇİNSE 	//

	elseif ($forum_satir['konu_acma_izni'] == 3)
	{
		//	YÖNETİCİ DEĞİLSE KOŞULLARA BAK	//

		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2) )
		{
			if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$_POST[fno]' AND konu_acma='1' OR";
			else $grupek = "grup='0' AND";

			$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$_POST[fno]' AND konu_acma='1'";
			$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

			if ( !$vt->num_rows($kul_izin) )
			{
				header('Location: ../hata.php?hata=167');
				exit();
			}
		}
	}
}

	//	KULLANICIYA GÖRE KONU AÇMA - SONU			//




		//	FORUM YETKİLERİ - SONU	//
		//	FORUM YETKİLERİ - SONU	//





	//	İKİ İLETİ ARASI SÜRESİ DOLMAMIŞSA UYARILIYOR	//

	$tarih = time();
	
	if ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['ileti_sure']) )
	{
		header('Location: ../hata.php?hata=6');
		exit();
	}


    //  SANSÜRLENECEK SÖZCÜKLER ALINIYOR    //

    $vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='sozcukler' LIMIT 1";
    $yasak_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
    $yasak_sozcukler = $vt->fetch_row($yasak_sonuc);
    $ysk_sozd = explode("\r\n", $yasak_sozcukler[0]);


    //  SANSÜR CÜMLESİ ALINIYOR //

    $vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='cumle' LIMIT 1";
    $yasak_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
    $yasak_cumle = $vt->fetch_row($yasak_sonuc);


    //  SANSÜR UYGULANIYOR  //

    if ($ysk_sozd[0] != '')
    {
        if (function_exists('str_ireplace'))
        {
            $_POST['mesaj_baslik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['mesaj_baslik']);
            $_POST['mesaj_icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['mesaj_icerik']);
        }

        else
        {
            $_POST['mesaj_baslik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['mesaj_baslik']);
            $_POST['mesaj_icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['mesaj_icerik']);
        }
    }



    //	ZARARLI KODLAR TEMİZLENİYOR	//

	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['mesaj_baslik'] = @ileti_yolla(stripslashes($_POST['mesaj_baslik']),1);
		$_POST['mesaj_icerik'] = @ileti_yolla(stripslashes($_POST['mesaj_icerik']),2);
	}

	//	magic_quotes_gpc kapalıysa	//
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




						//	YAZILAN YENİ BAŞLIKSA	//



	if ($_POST['kip'] == 'yeni')
	{
		//		ÜST KONU BİLGİSİ		//

		if (isset($_POST['ust_konu']))
		{
			if (($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2)) $ust_konu = 1;

			elseif ($kullanici_kim['yetki'] == 3)
			{
				if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$_POST[fno]' AND yonetme='1' OR";
				else $grupek = "grup='0' AND";

				$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$_POST[fno]' AND yonetme='1'";
				$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

				//	YÖNETME YETKİSİ VARSA	//
				if ($vt->num_rows($kul_izin)) $ust_konu = 1;
				else $ust_konu = 0;
			}
		}

		else $ust_konu = 0;


		//	ALANLAR BOŞ İSE VEYA 53 KARAKTERDEN UZUN İSE	//

		if ( (strlen(utf8_decode($_POST['mesaj_baslik'])) > 200) OR (strlen($_POST['mesaj_baslik']) < 3) OR (strlen($_POST['mesaj_icerik']) < 3) )
		{
			header('Location: ../hata.php?hata=53');
			exit();
		}

		else
		{
			//	YENİ BAŞLIK VERİTABANINA GİRİLİYOR	//

			$vtsorgu = "INSERT INTO $tablo_mesajlar (tarih, mesaj_baslik, mesaj_icerik, yazan, hangi_forumdan, son_mesaj_tarihi,yazan_ip,bbcode_kullan,ust_konu,ifade)";
	
			$vtsorgu .= "VALUES ('$tarih','$_POST[mesaj_baslik]','$_POST[mesaj_icerik]','$kullanici_kim[kullanici_adi]','$_POST[fno]','$tarih','$_SERVER[REMOTE_ADDR]','$bbcode_kullan','$ust_konu','$ifade_kullan')";

			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// veritabanına yapılan son kaydın id`si alınıyor //
			$ymesaj_no = $vt->insert_id();


			//	KULLANICININ MESAJ SAYISI ARTTIRILIYOR VE SON İLETİ TARİHİ GİRİLİYOR	//

			$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi + 1, son_ileti='$tarih' WHERE id='$kullanici_kim[id]' LIMIT 1";

			$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//	FORUMUN KONU SAYISI ARTTIRILIYOR //

			$vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi=konu_sayisi + 1 WHERE id='$_POST[fno]' LIMIT 1";

			$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//	BAŞLIK GÖNDERİLDİ İLETİSİ	//

			if ((isset($_POST['mobil'])) AND ($_POST['mobil'] == 'mobil')) $yonlendir = '../mobil/index.php?ak='.$ymesaj_no;

			else $yonlendir = '../hata.php?bilgi=2&fno='.$_POST['fno'].'&mesaj_no='.$ymesaj_no;

			header('Location: '.$yonlendir);
			exit();
		}
	}





							//	YAZILAN CEVAPSA	//



	elseif ($_POST['kip'] == 'cevapla'){

		//	ALANLAR BOŞ İSE VEYA 53 KARAKTERDEN UZUN İSE	//

		if ( (strlen(utf8_decode($_POST['mesaj_baslik'])) > 200) OR (strlen($_POST['mesaj_icerik']) < 3) )
		{
			header('Location: ../hata.php?hata=53');
			exit();
		}

		else
		{
			//	BAŞLIK GİRİLMEMİŞSE Cvp: EKLE	//

			if ($_POST['mesaj_baslik'] == '')
			$_POST['mesaj_baslik'] = 'Cvp:';


			//	CEVAP VERİTABANINA GİRİLİYOR	//

			$vtsorgu = "INSERT INTO $tablo_cevaplar (tarih, cevap_baslik, cevap_icerik, cevap_yazan, hangi_basliktan, hangi_forumdan,yazan_ip,bbcode_kullan,ifade)";

			$vtsorgu .= "VALUES ('$tarih','$_POST[mesaj_baslik]','$_POST[mesaj_icerik]','$kullanici_kim[kullanici_adi]','$_POST[mesaj_no]','$_POST[fno]','$_SERVER[REMOTE_ADDR]','$bbcode_kullan','$ifade_kullan')";

			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$cevapno = $vt->insert_id();


			//	BAŞLIĞIN CEVAP SAYISI ARTTIRILIYOR, SON CEVAP NO, TARİHİ VE YAZAN GİRİLİYOR		//

			$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=cevap_sayi + 1, son_mesaj_tarihi='$tarih',son_cevap='$cevapno',son_cevap_yazan='$kullanici_kim[kullanici_adi]' WHERE id='$_POST[mesaj_no]' LIMIT 1";

			$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//	KULLANICININ MESAJ SAYISI ARTTIRILIYOR VE SON İLETİ TARİHİ GİRİLİYOR	//

			$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi + 1, son_ileti='$tarih' WHERE id='$kullanici_kim[id]' LIMIT 1";

			$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//	FORUMUN CEVAP SAYISI ARTTIRILIYOR //

			$vtsorgu = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi + 1 WHERE id='$_POST[fno]' LIMIT 1";

			$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//	CEVAP GÖNDERİLDİ İLETİSİ	//

			if ((isset($_POST['mobil'])) AND ($_POST['mobil'] == 'mobil')) $yonlendir = '../mobil/index.php?ak='.$_POST['mesaj_no'].'&aks='.$_POST['sayfa'].'#hcevap';

			else $yonlendir = '../hata.php?bilgi=1&fno='.$_POST['fno'].'&mesaj_no='.$_POST['mesaj_no'].'&sayfa='.$_POST['sayfa'].'&cevapno='.$cevapno;

			header('Location: '.$yonlendir);
			exit();
		}
	}
}


else
{
	header('Location: ../hata.php?hata=53');
	exit();
}
?>