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



if (isset($_POST['fsayfa'])) $_POST['fsayfa'] = zkTemizle($_POST['fsayfa']);
else $_POST['fsayfa'] = 0;


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

if ( ($ysk_sozd[0] != '') AND (!empty($_POST['mesaj_baslik'])) AND (!empty($_POST['mesaj_icerik'])) )
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


//	FORM DOLU MU? ZARARLI KODLAR TEMİZLENİYOR	//

if ( ( isset($_POST['mesaj_degisti_mi']) ) AND ($_POST['mesaj_degisti_mi'] == 'form_dolu') ):
$_POST['mesaj_no'] = @zkTemizle($_POST['mesaj_no']);
$_POST['cevap_no'] = @zkTemizle($_POST['cevap_no']);

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


// üst konu bilgisi
if (isset($_POST['ust_konu'])) $ust_konu_yap = 1;
else $ust_konu_yap = 0;


$ust_konu = '';

$tarih = time();


//	DEĞİŞTİRİLEN BAŞLIK İSE	//
//	DEĞİŞTİRİLEN BAŞLIK İSE	//



if ($_POST['kip'] == 'mesaj')
{
	//	ALANLAR BOŞ İSE VEYA 53 KARAKTERDEN UZUN İSE HATA MESAJI	//

	if ( (strlen(utf8_decode($_POST['mesaj_baslik'])) > 200) OR (strlen($_POST['mesaj_baslik']) < 3) OR (strlen($_POST['mesaj_icerik']) < 3) )
	{
		header('Location: ../hata.php?hata=53');
		exit();
	}


	//	KONUNUN BİLGİLERİ ÇEKİLİYOR	//

	$vtsorgu = "SELECT hangi_forumdan,yazan,degistirme_sayisi,kilitli FROM $tablo_mesajlar WHERE id='$_POST[mesaj_no]' AND silinmis='0' LIMIT 1";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// konu yoksa uyarı ver //
	if (!$vt->num_rows($vtsonuc3))
	{
		header('Location: ../hata.php?hata=47');
		exit();
	}


	$yetkili_mi = $vt->fetch_assoc($vtsonuc3);
	$fno = $yetkili_mi['hangi_forumdan'];


	$vtsorgu = "SELECT id,okuma_izni,yazma_izni,konu_acma_izni,forum_baslik,alt_forum FROM $tablo_forumlar WHERE id='$fno' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir = $vt->fetch_assoc($vtsonuc);


	//	İZİNLERDEN BİRİ SADECE YÖNETİCİLER İÇİNSE VEYA KAPALIYSA	//

	if ( ($forum_satir['okuma_izni'] == 1) OR ($forum_satir['konu_acma_izni'] == 1) OR ($forum_satir['yazma_izni'] == 1) OR ($forum_satir['okuma_izni'] == 5) OR ($forum_satir['konu_acma_izni'] == 5) OR ($forum_satir['yazma_izni'] == 5) )
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=52');
			exit();
		}
	}


	// konu kilitli ise değiştirilemez uyarısı veriliyor //

	if ( ($yetkili_mi['kilitli'] == 1) AND (($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2)) )
	{
		header('Location: ../hata.php?hata=50');
		exit();
	}



//	DEĞİŞTİRMEYE YETKİLİ OLUP OLMADIĞINA BAKILIYOR	- BAŞI	//


    //	YÖNETİCİ VE YARDICI İSE	//
    if ( ($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2) )
        $ust_konu = ",ust_konu='$ust_konu_yap'";

    //	BÖLÜM YARDIMCISI İSE	//
    if ($kullanici_kim['yetki'] == 3)
    {
        if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$fno' AND yonetme='1' OR";
        else $grupek = "grup='0' AND";

        //	KENDİ YAZISI DEĞİLSE	//
        if ( ($yetkili_mi['yazan'] != $kullanici_kim['kullanici_adi']) )
        {
            $vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$fno' AND yonetme='1'";
            $kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

            if ( !$vt->num_rows($kul_izin) )
            {
                header('Location: ../hata.php?hata=52');
                exit();
            }

            //  BÖLÜM YARDIMCISI İSE ÜST KONU YAPABİLİR  //
            else $ust_konu = ",ust_konu='$ust_konu_yap'";
        }

        //	KENDİ YAZISI İSE -- BÖLÜM YARDIMCISI İSE ÜST KONU YAPABİLİR  //
        else
        {
            $vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$fno' AND yonetme='1'";
            $kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());
            if ($vt->num_rows($kul_izin))
            $ust_konu = ",ust_konu='$ust_konu_yap'";
        }
    }

    //	YAZAN, YÖNETİCİ VEYA YARDIMCI İSE	//
    elseif ( ($yetkili_mi['yazan'] == $kullanici_kim['kullanici_adi']) OR ($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2) );

    //	HİÇBİRİ DEĞİLSE	//
    else
    {
        header('Location: ../hata.php?hata=52');
        exit();
    }

//	DEĞİŞTİRMEYE YETKİLİ OLUP OLMADIĞINA BAKILIYOR	- SONU	//




//	BAŞLIK DEĞİŞTİRİLİYOR	//

    $vtsorgu = "UPDATE $tablo_mesajlar SET degistirme_tarihi='$tarih',mesaj_baslik='$_POST[mesaj_baslik]',mesaj_icerik='$_POST[mesaj_icerik]',degistiren='$kullanici_kim[kullanici_adi]',degistirme_sayisi=degistirme_sayisi + 1,degistiren_ip='$_SERVER[REMOTE_ADDR]',bbcode_kullan='$bbcode_kullan',ifade='$ifade_kullan' $ust_konu WHERE id='$_POST[mesaj_no]' LIMIT 1";

    $vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


//	BAŞLIK DEĞİŞTİRİLDİ İLETİSİ	//

    header('Location: ../hata.php?bilgi=3&fno='.$fno.'&mesaj_no='.$_POST['mesaj_no'].'&fsayfa='.$_POST['fsayfa']);
    exit();
}




//	DEĞİŞTİRİLEN CEVAP İSE	//
//	DEĞİŞTİRİLEN CEVAP İSE	//


elseif ($_POST['kip'] == 'cevap')
{
	//	ALANLAR BOŞ İSE VEYA 53 KARAKTERDEN UZUN İSE HATA MESAJI	//

	if ( (strlen(utf8_decode($_POST['mesaj_baslik'])) > 200) OR (strlen($_POST['mesaj_icerik']) < 3) )
	{
		header('Location: ../hata.php?hata=53');
		exit();
	}


	//	CEVAP BİLGİLERİ VERİTABANINDAN ÇEKİLİYOR	//

	$vtsorgu = "SELECT cevap_yazan,degistirme_sayisi,hangi_forumdan,hangi_basliktan FROM $tablo_cevaplar
			WHERE id='$_POST[cevap_no]' AND silinmis='0' LIMIT 1";
	$vtsonuc4 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// cevap yoksa uyarı ver //
	if (!$vt->num_rows($vtsonuc4))
	{
		header('Location: ../hata.php?hata=55');
		exit();
	}


	$yetkili_mi = $vt->fetch_assoc($vtsonuc4);
	$fno = $yetkili_mi['hangi_forumdan'];


	$vtsorgu = "SELECT id,okuma_izni,yazma_izni,konu_acma_izni,forum_baslik,alt_forum FROM $tablo_forumlar WHERE id='$fno' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir = $vt->fetch_assoc($vtsonuc);


	//	İZİNLERDEN BİRİ SADECE YÖNETİCİLER İÇİNSE VEYA KAPALIYSA	//

	if ( ($forum_satir['okuma_izni'] == 1) OR ($forum_satir['konu_acma_izni'] == 1) OR ($forum_satir['yazma_izni'] == 1) OR ($forum_satir['okuma_izni'] == 5) OR ($forum_satir['konu_acma_izni'] == 5) OR ($forum_satir['yazma_izni'] == 5) )
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=52');
			exit();
		}
	}


	// konu kilitli ise değiştirilemez uyarısı veriliyor //

	$vtsorgu = "SELECT kilitli FROM $tablo_mesajlar WHERE id='$yetkili_mi[hangi_basliktan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$konu_kilitlimi = $vt->fetch_assoc($vtsonuc);

	if ( ($konu_kilitlimi['kilitli'] == 1) AND (($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2)) )
	{
		header('Location: ../hata.php?hata=51');
		exit();
	}



//	DEĞİŞTİRMEYE YETKİLİ OLUP OLMADIĞINA BAKILIYOR	- BAŞI	//

    //	BÖLÜM YARDIMCISI İSE	//
    if ($kullanici_kim['yetki'] == 3)
    {
        //	KENDİ YAZISI DEĞİLSE	//
        if ( ($yetkili_mi['cevap_yazan'] != $kullanici_kim['kullanici_adi']) )
        {
             if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$fno' AND yonetme='1' OR";
             else $grupek = "grup='0' AND";

            $vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$fno' AND yonetme='1'";
            $kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

            if ( !$vt->num_rows($kul_izin) )
            {
                header('Location: ../hata.php?hata=52');
                exit();
            }
        }
    }

    //	YAZAN, YÖNETİCİ VEYA YARDIMCI İSE	//
    elseif ( ($yetkili_mi['cevap_yazan'] == $kullanici_kim['kullanici_adi']) OR ($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2) );

    //	HİÇBİRİ DEĞİLSE	//
    else
    {
        header('Location: ../hata.php?hata=52');
        exit();
    }

//	DEĞİŞTİRMEYE YETKİLİ OLUP OLMADIĞINA BAKILIYOR	- SONU	//




    if ($_POST['mesaj_baslik']=='') $_POST['mesaj_baslik'] = 'Cvp:';


    //		CEVAP DEĞİŞTİRİLiYOR		//

    $vtsorgu = "UPDATE $tablo_cevaplar SET degistirme_tarihi='$tarih',cevap_baslik='$_POST[mesaj_baslik]',cevap_icerik='$_POST[mesaj_icerik]',degistiren='$kullanici_kim[kullanici_adi]',degistirme_sayisi=degistirme_sayisi + 1,degistiren_ip='$_SERVER[REMOTE_ADDR]',bbcode_kullan='$bbcode_kullan',ifade='$ifade_kullan' WHERE id='$_POST[cevap_no]' LIMIT 1";

    $vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


    //	CEVAP DEĞİŞTİRİLDİ İLETİSİ	//

    header('Location: ../hata.php?bilgi=4&fno='.$fno.'&mesaj_no='.$_POST['mesaj_no'].'&fsayfa='.$_POST['fsayfa'].'&sayfa='.$_POST['sayfa'].'&cevapno='.$_POST['cevap_no']);
    exit();
}

endif;



//		KONU KİLİTLEME İŞLEMLERİ 		//


if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'kilitle'))
{
	if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = $forum_index;
	$_GET['mesaj_no'] = zkTemizle($_GET['mesaj_no']);

	$vtsorgu = "SELECT kilitli,hangi_forumdan FROM $tablo_mesajlar
				WHERE id='$_GET[mesaj_no]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kilit_satir = $vt->fetch_assoc($vtsonuc);

	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=47');
		exit();
	}


	$vtsorgu = "SELECT id,okuma_izni,yazma_izni,konu_acma_izni,forum_baslik,alt_forum FROM $tablo_forumlar WHERE id='$kilit_satir[hangi_forumdan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir = $vt->fetch_assoc($vtsonuc);


	//	İZİNLERDEN BİRİ SADECE YÖNETİCİLER İÇİNSE VEYA KAPALIYSA	//

	if ( ($forum_satir['okuma_izni'] == 1) OR ($forum_satir['konu_acma_izni'] == 1) OR ($forum_satir['yazma_izni'] == 1) OR ($forum_satir['okuma_izni'] == 5) OR ($forum_satir['konu_acma_izni'] == 5) OR ($forum_satir['yazma_izni'] == 5) )
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=54');
			exit();
		}
	}



	//	YÖNETİCİ VE YARDIMCI İSE	//
	if ( ($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2) )
	{
		if ($kilit_satir['kilitli'] == 1)
		{
			$vtsorgu = "UPDATE $tablo_mesajlar SET kilitli='0'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		else
		{
			$vtsorgu = "UPDATE $tablo_mesajlar SET kilitli='1'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}


	//	BÖLÜM YARDIMCISI İSE	//
	elseif ($kullanici_kim['yetki'] == 3)
	{
		if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$kilit_satir[hangi_forumdan]' AND yonetme='1' OR";
		else $grupek = "grup='0' AND";

		$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$kilit_satir[hangi_forumdan]' AND yonetme='1'";
		$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

		if ($vt->num_rows($kul_izin))
		{
			if ($kilit_satir['kilitli'] == 1)
			{
				$vtsorgu = "UPDATE $tablo_mesajlar SET kilitli='0'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}

			else
			{
				$vtsorgu = "UPDATE $tablo_mesajlar SET kilitli='1'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}

			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit();
		}

		//	BU FORUMU YÖNETME YETKİSİ YOKSA	//
		else
		{
			header('Location: ../hata.php?hata=54');
			exit();
		}
	}

	//		YETKİSİ YOKSA		//
	else
	{
		header('Location: ../hata.php?hata=54');
		exit();
	}
}




//		ÜST KONU YAPMA İŞLEMLERİ 		//


elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'ustkonu'))
{
	if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = $forum_index;
	$_GET['mesaj_no'] = zkTemizle($_GET['mesaj_no']);


	$vtsorgu = "SELECT ust_konu,hangi_forumdan FROM $tablo_mesajlar
				WHERE id='$_GET[mesaj_no]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$ustkonu_satir = $vt->fetch_assoc($vtsonuc);


	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../hata.php?hata=47');
		exit();
	}


	$vtsorgu = "SELECT id,okuma_izni,yazma_izni,konu_acma_izni,forum_baslik,alt_forum FROM $tablo_forumlar WHERE id='$ustkonu_satir[hangi_forumdan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir = $vt->fetch_assoc($vtsonuc);


	//	İZİNLERDEN BİRİ SADECE YÖNETİCİLER İÇİNSE VEYA KAPALIYSA	//

	if ( ($forum_satir['okuma_izni'] == 1) OR ($forum_satir['konu_acma_izni'] == 1) OR ($forum_satir['yazma_izni'] == 1) OR ($forum_satir['okuma_izni'] == 5) OR ($forum_satir['konu_acma_izni'] == 5) OR ($forum_satir['yazma_izni'] == 5) )
	{
		if ( ( isset($kullanici_kim['yetki']) ) AND ($kullanici_kim['yetki'] != 1) )
		{
			header('Location: ../hata.php?hata=170');
			exit();
		}
	}



	//	YÖNETİCİ VEYA YARDIMCI İSE	//
	if ( ($kullanici_kim['yetki'] == 1) OR ($kullanici_kim['yetki'] == 2) )
	{
		if ($ustkonu_satir['ust_konu'] == 1)
		{
			$vtsorgu = "UPDATE $tablo_mesajlar SET ust_konu='0'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		else
		{
			$vtsorgu = "UPDATE $tablo_mesajlar SET ust_konu='1'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}


	//	BÖLÜM YARDIMCISI İSE	//
	elseif ($kullanici_kim['yetki'] == 3)
	{
		if ($kullanici_kim['grupid'] != '0') $grupek = "grup='$kullanici_kim[grupid]' AND fno='$ustkonu_satir[hangi_forumdan]' AND yonetme='1' OR";
		else $grupek = "grup='0' AND";

		$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE $grupek kulad='$kullanici_kim[kullanici_adi]' AND fno='$ustkonu_satir[hangi_forumdan]' AND yonetme='1'";
		$kul_izin = $vt->query($vtsorgu) or die ($vt->hata_ver());

		if ($vt->num_rows($kul_izin))
		{
			if ($ustkonu_satir['ust_konu'] == 1)
			{
				$vtsorgu = "UPDATE $tablo_mesajlar SET ust_konu='0'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}

			else
			{
				$vtsorgu = "UPDATE $tablo_mesajlar SET ust_konu='1'
						WHERE id='$_GET[mesaj_no]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}

			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit();
		}

		//	BU FORUMU YÖNETME YETKİSİ YOKSA	//
		else
		{
			header('Location: ../hata.php?hata=170');
			exit();
		}
	}

	//		YETKİSİ YOKSA		//
	else
	{
		header('Location: ../hata.php?hata=170');
		exit();
	}
}

?>