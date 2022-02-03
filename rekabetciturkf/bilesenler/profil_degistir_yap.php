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


$_COOKIE['kullanici_kimlik'] = zkTemizle4($_COOKIE['kullanici_kimlik']);
$_COOKIE['kullanici_kimlik'] = zkTemizle($_COOKIE['kullanici_kimlik']);

$vtsorgu = "SELECT id,kullanici_adi,kullanici_kimlik,sifre,posta,resim FROM $tablo_kullanicilar
			WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$kullanici_kim = $vt->fetch_array($vtsonuc);



// FORM DOLUMU BAKILIYOR    //

if ( (isset($_POST['profil_degisti_mi'])) AND ($_POST['profil_degisti_mi'] == 'form_dolu') ):


// oturum bilgisine bakılıyor
if ($_GET['o'] != $o)
{
	header('Location: ../hata.php?hata=45');
	exit();
}


//  NORMAL PROFİL DEĞİŞİKLİĞİ - BAŞI   //

if ( (isset($_POST['islem_turu'])) AND ($_POST['islem_turu'] == 'normal') ):


	if ( (empty($_POST['gercek_ad'])) OR (empty($_POST['dogum_gun'])) OR (empty($_POST['dogum_ay'])) OR (empty($_POST['dogum_yil'])) OR (empty($_POST['sehir'])) )
	{
		header('Location: ../hata.php?hata=73');
		exit();
	}


	if (!preg_match('/^[A-Za-z0-9-_ ğĞüÜŞşİıÖöÇç.]+$/', $_POST['gercek_ad']))
	{
		header('Location: ../hata.php?hata=31');
		exit();
	}

	if ((strlen($_POST['gercek_ad']) > 30) OR (strlen($_POST['gercek_ad']) < 4))
	{
		header('Location: ../hata.php?hata=32');
		exit();
	}

	if ((!preg_match('/^[A-Za-zğĞüÜŞşİıÖöÇç]+$/', $_POST['sehir'])) OR ( strlen($_POST['sehir']) > 30))
	{
		header('Location: ../hata.php?hata=36');
		exit();
	}

	if (!preg_match('/^[0-9]+$/', $_POST['dogum_gun']))
	{
		header('Location: ../hata.php?hata=74');
		exit();
	}

	if (!preg_match('/^[0-9]+$/', $_POST['dogum_ay']))
	{
		header('Location: ../hata.php?hata=74');
		exit();
	}

	if (!preg_match('/^[0-9]+$/', $_POST['dogum_yil']))
	{
		header('Location: ../hata.php?hata=74');
		exit();
	}

	if (!preg_match('/^[012]+$/', $_POST['cinsiyet']))
	{
		header('Location: ../hata.php?hata=79');
		exit();
	}

	if ( strlen($_POST['web']) > 99)
	{
		header('Location: ../hata.php?hata=75');
		exit();
	}

	if ( strlen($_POST['web']) !=  0)
	{
		if (!preg_match('/^(http|https):\/\//i', $_POST['web']))
		{
			$_POST['web'] = 'http://'.$_POST['web'];
		}
	}


	if (!preg_match('/^[A-Za-z0-9-_]+$/', $_POST['tema_secim']))
	{
		header('Location: ../hata.php?hata=76');
		exit();
	}

	if ( strlen($_POST['tema_secim']) > 20)
	{
		header('Location: ../hata.php?hata=77');
		exit();
	}


	if ( (isset($_POST['tema_secimp'])) AND (!preg_match('/^[A-Za-z0-9-_]+$/', $_POST['tema_secimp'])) )
	{
		header('Location: ../hata.php?hata=76');
		exit();
	}

	if  ( (isset($_POST['tema_secimp'])) AND ( strlen($_POST['tema_secimp']) > 20) )
	{
		header('Location: ../hata.php?hata=77');
		exit();
	}


	if ( strlen($_POST['imza']) > $ayarlar['imza_uzunluk'] )
	{
		header('Location: ../hata.php?hata=78');
		exit();
	}


	if ( strlen($_POST['hakkinda']) > 1000 )
	{
		header('Location: ../hata.php?hata=224');
		exit();
	}


	//  ANINDA MESAJLAŞMA ADRESLERİ //

	if ( strlen($_POST['icq']) > 30)
	{
		header('Location: ../hata.php?hata=79');
		exit();
	}

	if ( strlen($_POST['aim']) > 99)
	{
		header('Location: ../hata.php?hata=80');
		exit();
	}

	if ($_POST['aim'] != '')
	{
		if (!preg_match('/^(http|https):\/\//i', $_POST['aim']))
		{
			$_POST['aim'] = 'http://'.$_POST['aim'];
		}
	}

	if ( strlen($_POST['msn']) > 99)
	{
		header('Location: ../hata.php?hata=81');
		exit();
	}

	if ( strlen($_POST['yahoo']) > 99)
	{
		header('Location: ../hata.php?hata=82');
		exit();
	}

	if ( strlen($_POST['skype']) > 99)
	{
		header('Location: ../hata.php?hata=83');
		exit();
	}

	if ($_POST['skype'] != '')
	{
		if (!preg_match('/^(http|https):\/\//i', $_POST['skype']))
		{
			$_POST['skype'] = 'http://'.$_POST['skype'];
		}
	}



	//	YASAK AD SOYADLAR ALINIYOR	//

	$vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='adsoyad' LIMIT 1";
	$yasak_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yasak_adsoyad = $vt->fetch_row($yasak_sonuc);
	$ysk_adsoyadd = explode("\r\n", $yasak_adsoyad[0]);


	// AD SOYADIN YASAKLAR LİSTESİNDE OLUP OLMADIĞINA BAKILIYOR	//

	if ($ysk_adsoyadd[0] != '')
	{
		$dongu_sayi = count($ysk_adsoyadd);
		for ($i=0; $i<$dongu_sayi; $i++)
		{
			if ((preg_match("/$ysk_adsoyadd[$i]/i", $_POST['gercek_ad'])))
			{
				header('Location: ../hata.php?hata=186');
				exit();
			}
		}
	}




	//  İMZADAN ZARARLI KODLAR TEMİZLENİYOR //

	if ( isset($_POST['imza']) AND ($_POST['imza'] != '') )
	{
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
			if (function_exists('str_ireplace')) $_POST['imza'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['imza']);
			else $_POST['imza'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['imza']);
		}


		//  magic_quotes_gpc açıksa //
		if (get_magic_quotes_gpc())
			$_POST['imza'] = @ileti_yolla(stripslashes(imza_denetim($_POST['imza'])),1);

		//  magic_quotes_gpc kapalıysa  //
		else $_POST['imza'] = @ileti_yolla(imza_denetim($_POST['imza']),1);
	}



	//  HAKKINDA BİLGİSİNDEN ZARARLI KODLAR TEMİZLENİYOR //

	if ( isset($_POST['hakkinda']) AND ($_POST['hakkinda'] != '') )
	{
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
			if (function_exists('str_ireplace')) $_POST['hakkinda'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['hakkinda']);
			else $_POST['hakkinda'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['hakkinda']);
		}


		//  magic_quotes_gpc açıksa //
		if (get_magic_quotes_gpc())
			$_POST['hakkinda'] = @ileti_yolla(stripslashes($_POST['hakkinda']),1);

		//  magic_quotes_gpc kapalıysa  //
		else $_POST['hakkinda'] = @ileti_yolla($_POST['hakkinda'],1);
	}




		//	KULLANICI RESİMİNİN TİP VE BÜYÜKLÜĞÜNE BAKILIYOR - BAŞI 	//



	//	RESİM SİL SEÇİLİYSE $kul_resim DEĞİŞKENİ BOŞALTILIYOR	//
	if ( isset($_POST['resim_sil']) ) 	$kul_resim = '';


	//	RESİM YÜKLEME KISMI - BAŞI	//

	elseif ( ($ayarlar['resim_yukle'] == 1) AND (isset($_FILES['resim_yukle']['tmp_name']))
		AND ($_FILES['resim_yukle']['tmp_name'] != '') )
	{
		list($genislik, $yukseklik, $tip) = @getimagesize($_FILES['resim_yukle']['tmp_name']);

		if ( (isset($tip)) AND ($tip == 2) )
		{
			$uzanti = '.jpg';

			if ( !@imagecreatefromjpeg($_FILES['resim_yukle']['tmp_name']) )
			{
				header('Location: ../hata.php?hata=84');
				exit();
			}
		}

		elseif ( (isset($tip)) AND ($tip == 1) )
		{
			$uzanti = '.gif';

			if ( !@imagecreatefromgif ($_FILES['resim_yukle']['tmp_name']) )
			{
				header('Location: ../hata.php?hata=84');
				exit();
			}
		}

		elseif ( (isset($tip)) AND ($tip == 3) )
		{
			$uzanti = '.png';

			if ( !@imagecreatefrompng($_FILES['resim_yukle']['tmp_name']) )
			{
				header('Location: ../hata.php?hata=84');
				exit();
			}
		}

		else
		{
			header('Location: ../hata.php?hata=85');
			exit();
		}



		if ($_FILES['resim_yukle']['size'] > $ayarlar['resim_boyut'])
		{
			header('Location: ../hata.php?hata=86');
			exit();
		}

		if ( ($genislik > $ayarlar['resim_genislik']) OR
			($yukseklik > $ayarlar['resim_yukseklik']) )
		{
			header('Location: ../hata.php?hata=87');
			exit();
		}

		$dosya_yolu = '../dosyalar/resimler/yuklenen/'.rand(1111111111, 9999999999).$uzanti;

		if ( !@move_uploaded_file($_FILES["resim_yukle"]["tmp_name"],$dosya_yolu) )
		{
			header('Location: ../hata.php?hata=88');
			exit();
		}
		//	DOSYA SORUNSUZSA ADRES $kul_resim DEĞİŞKENİNE AKTARILIYOR	//
		$kul_resim = $kul_resim = str_replace('../', '', $dosya_yolu);
	}


//	RESİM YÜKLEME KISMI - SONU	//




//	UZAK RESİM YÜKLEME KISMI - BAŞI	//


	elseif ( ($ayarlar['uzak_resim'] == 1) AND (isset($_POST['uzak_resim'])) AND ($_POST['uzak_resim'] != '') OR 
		($ayarlar['resim_galerisi'] == 1) AND (isset($_POST['uzak_resim2'])) AND ($_POST['uzak_resim2'] != '') )
	{
		if ( (isset($_POST['uzak_resim'])) AND ($_POST['uzak_resim'] != '') )
		$resim_adres = $_POST['uzak_resim'];

		elseif ( (isset($_POST['uzak_resim2'])) AND ($_POST['uzak_resim2'] != '') )
		$resim_adres = '../'.$_POST['uzak_resim2'];

		if ( (!@getimagesize($resim_adres)) AND (preg_match('/^(http|https|ftp):\/\//i', $resim_adres)) )
		{
			header('Location: ../hata.php?hata=89');
			exit();
		}

		list($genislik, $yukseklik, $tip) = @getimagesize($resim_adres);

		if ( (isset($tip)) AND ($tip == 2) )
		{
			if ( !@imagecreatefromjpeg($resim_adres) )
			{
				header('Location: ../hata.php?hata=84');
				exit();
			}
		}

		elseif ( (isset($tip)) AND ($tip == 1) )
		{
			if ( !@imagecreatefromgif ($resim_adres) )
			{
				header('Location: ../hata.php?hata=84');
				exit();
			}
		}

		elseif ( (isset($tip)) AND ($tip == 3) )
		{
			if ( !@imagecreatefrompng($resim_adres) )
			{
				header('Location: ../hata.php?hata=84');
				exit();
			}
		}

		else
		{
			header('Location: ../hata.php?hata=85');
			exit();
		}




		$resim_dosya = @file_get_contents($resim_adres);
		$resim_boyut = @round((strlen($resim_dosya)),2);

		if ($resim_boyut > $ayarlar['resim_boyut'])
		{
			header('Location: ../hata.php?hata=90');
			exit();
		}

		if ( ($genislik > $ayarlar['resim_genislik']) OR
			($yukseklik > $ayarlar['resim_yukseklik']) )
		{
			header('Location: ../hata.php?hata=91');
			exit();
		}

		//	DOSYA SORUNSUZSA ADRES $kul_resim DEĞİŞKENİNE AKTARILIYOR	//
		elseif ( (!isset($_POST['uzak_resim2'])) OR ($_POST['uzak_resim2'] == '') ) $kul_resim = $resim_adres;
		else $kul_resim = $_POST['uzak_resim2'];
}

//	UZAK RESİM YÜKLEME KISMI - SONU	//


//	HİÇBİR ŞEY YÜKLENMİYORSA ESKİ RESİM ADRESİ $kul_resim DEĞİŞKENİNE AKTARILIYOR	//

else
{
	$kul_resim = $kullanici_kim['resim'];
}



		//	KULLANICI RESİMİNİN TİP VE BÜYÜKLÜĞÜNE BAKILIYOR - SONU 	//





	if ( (!preg_match('/^[01]+$/', $_POST['posta_goster'])) OR
			(!preg_match('/^[012]+$/', $_POST['dogum_tarihi_goster'])) OR
			(!preg_match('/^[01]+$/', $_POST['sehir_goster'])) OR
			(!preg_match('/^[01]+$/', $_POST['gizli'])) )
	{
		header('Location: ../hata.php?hata=92');
		exit();
	}


	//		PROFİL DEĞİŞTİRİLİYOR		//

	if ( ($_COOKIE['kullanici_kimlik'] == $kullanici_kim['kullanici_kimlik']) )
	{
		$_POST['web'] = zkTemizle($_POST['web']);
		$_POST['icq'] = zkTemizle($_POST['icq']);
		$_POST['aim'] = zkTemizle($_POST['aim']);
		$_POST['msn'] = zkTemizle($_POST['msn']);
		$_POST['yahoo'] = zkTemizle($_POST['yahoo']);
		$_POST['skype'] = zkTemizle($_POST['skype']);
		$dogum_tarihi = $_POST['dogum_gun'].'-'.$_POST['dogum_ay'].'-'.$_POST['dogum_yil'];


		// portal tema dizini
		if (isset($_POST['tema_secimp'])) $temadizinip_sorgu = ",temadizinip='$_POST[tema_secimp]'";
		else $temadizinip_sorgu = '';


		$vtsorgu = "UPDATE $tablo_kullanicilar SET web='$_POST[web]',dogum_tarihi='$dogum_tarihi',sehir='$_POST[sehir]',gercek_ad='$_POST[gercek_ad]',resim='$kul_resim',imza='$_POST[imza]',posta_goster='$_POST[posta_goster]',dogum_tarihi_goster='$_POST[dogum_tarihi_goster]',sehir_goster='$_POST[sehir_goster]',gizli='$_POST[gizli]',icq='$_POST[icq]',aim='$_POST[aim]',msn='$_POST[msn]',yahoo='$_POST[yahoo]',skype='$_POST[skype]',temadizini='$_POST[tema_secim]',cinsiyet='$_POST[cinsiyet]',hakkinda='$_POST[hakkinda]' $temadizinip_sorgu WHERE id='$kullanici_kim[id]' LIMIT 1";

		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: ../hata.php?bilgi=10');
		exit();
	}

	else
	{
		header('Location: ../hata.php?hata=94');
		exit();
	}



//  NORMAL PROFİL DEĞİŞİKLİĞİ - SONU   //





//  E-POSTA VE ŞİFRE DEĞİŞİKLİĞİ - BAŞI   //


elseif ( (isset($_POST['islem_turu'])) AND ($_POST['islem_turu'] == 'sifre') ):


	if ( (empty($_POST['ysifre'])) OR (empty($_POST['ysifre2'])) OR (empty($_POST['posta'])) )
	{
		header('Location: ../hata.php?hata=73');
		exit();
	}

	if ( (sha1(($anahtar.$_POST['sifre']))) != $kullanici_kim['sifre'] )
	{
		header('Location: ../hata.php?hata=188');
		exit();
	}

	if ($_POST['ysifre'] != $_POST['ysifre2'])
	{
		header('Location: ../hata.php?hata=33');
		exit();
	}

	if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['ysifre']))
	{
		header('Location: ../hata.php?hata=34');
		exit();
	}

	if (( strlen($_POST['ysifre']) >  20) OR ( strlen($_POST['ysifre']) <  5))
	{
		header('Location: ../hata.php?hata=35');
		exit();
	}

	if ( strlen($_POST['posta']) > 70)
	{
		header('Location: ../hata.php?hata=40');
		exit();
	}

	if (!preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
	{
		header('Location: ../hata.php?hata=10');
		exit();
	}




	//	YASAK POSTA ADRESLERİ ALINIYOR	//

	$vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='posta' LIMIT 1";
	$yasak_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yasak_posta = $vt->fetch_row($yasak_sonuc);
	$ysk_postad = explode("\r\n", $yasak_posta[0]);


	// E-POSTA ADRESİNİN YASAKLAR LİSTESİNDE OLUP OLMADIĞINA BAKILIYOR	//

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




	// 	E-POSTA ADRESİ DEĞİŞTİYSE YENİ ADRESLE DAHA ÖNCE KAYIT YAPILIP YAPILMADIĞINA BAKILIYOR	//

	$es_degisti = 0;
	$kul_etkin_kod = '';
	$_POST['posta'] = zkTemizle($_POST['posta']);

	if ($kullanici_kim['posta'] != $_POST['posta'])
	{
		$vtsorgu = "SELECT posta FROM $tablo_kullanicilar WHERE posta='$_POST[posta]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

		if ($vt->num_rows($vtsonuc2))
		{
			header('Location: ../hata.php?hata=93');
			exit();
		}


		// e-posta etkinleştirme kodu oluşturuluyor
		$kul_etkin_kod = sha1(microtime());
		$kul_etkin_kod = substr($kul_etkin_kod,9,10);



		//  ONAY E-POSTASI OLUŞTURULUYOR    //

		$dosya = './postalar/eposta_onay.txt';
		$posta_baslik = $ayarlar['anasyfbaslik'].' - E-Posta Değişikliği Onayı';


		$tiklanacak_baglanti = $protocol.'://'.$ayarlar['alanadi'].$anadizin.
		'kul_etkin.php?onay=eposta&kulid='.$kullanici_kim['id'].'&kulkod='.$kul_etkin_kod;

		if (!($dosya_ac = fopen($dosya,'r'))) die ('Dosya Açılamıyor');
		$posta_metni = fread($dosya_ac,3072);
		fclose($dosya_ac);

		$bul = array('{forumadi}','{kullanici_adi}','{tiklanacak_baglanti}');
		$cevir = array($ayarlar['anasyfbaslik'],$kullanici_kim['kullanici_adi'],$tiklanacak_baglanti);
		$posta_metni = str_replace($bul,$cevir,$posta_metni);


		//  ONAY BİLGİLERİ POSTALANIYOR //

		require('eposta_sinif.php');
		$mail = new eposta_yolla();

		if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
		elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();

		$mail->sunucu = $ayarlar['smtp_sunucu'];
		if ($ayarlar['smtp_kd'] == 'true') $mail->smtp_dogrulama = true;
		else $mail->smtp_dogrulama = false;
		$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
		$mail->sifre = $ayarlar['smtp_sifre'];

		$mail->gonderen     = $ayarlar['y_posta'];
		$mail->gonderen_adi = $ayarlar['anasyfbaslik'];
		$mail->GonderilenAdres($_POST['posta'],$kullanici_kim['kullanici_adi']);
		$mail->YanitlamaAdres($ayarlar['y_posta'],$ayarlar['anasyfbaslik']);

		$mail->konu = $posta_baslik;
		$mail->icerik = $posta_metni;


		// e-posta sorunsuz yolladı ve yeni e-posta adresi eklendi.
		if ($mail->Yolla())
		{
			$es_degisti = 1;
			$yeni_posta = $_POST['posta'];
		}

		// e-posta yollanamadı
		else
		{
			$es_degisti = 4;
			$yeni_posta = '';
		}
	}


	// e-posta adresi aynı girilmiş ise
	else $yeni_posta = '';




	// şifre değişmedi, eskisi geçerli

	if (($_POST['ysifre'] == 'sifre_degismedi') OR ($_POST['ysifre2'] == 'sifre_degismedi'))
	{
		$karma = $kullanici_kim['sifre'];
	}


	// şifre değiştiyse anahtar ile birleştirilip sha1 ile şifreleniyor

	if (($_POST['ysifre'] != 'sifre_degismedi') OR ($_POST['ysifre2'] != 'sifre_degismedi'))
	{
		if ($es_degisti == 4) $es_degisti = 4;
		elseif ($es_degisti == 1) $es_degisti = 3;
		else $es_degisti = 2;
		$karma = sha1(($anahtar.$_POST['ysifre']));
	}



	//		E-POSTA VE ŞİFRE DEĞİŞTİRİLİYOR		//

	if ( ($_COOKIE['kullanici_kimlik'] == $kullanici_kim['kullanici_kimlik']) )
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET sifre='$karma',posta2='$yeni_posta',kul_etkin_kod='$kul_etkin_kod' WHERE id='$kullanici_kim[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		// sadece e-posta değişti
		if ($es_degisti == 1)
		{
			header('Location: ../hata.php?bilgi=42');
			exit();
		}

		// sadece şifre değişti
		elseif ($es_degisti == 2)
		{
			header('Location: ../hata.php?bilgi=43');
			exit();
		}

		// ikisi de değişti
		elseif ($es_degisti == 3)
		{
			header('Location: ../hata.php?bilgi=44');
			exit();
		}

		// e-posta yollanamadı
		elseif ($es_degisti == 4)
		{
			header('Location: ../hata.php?hata=175');
			exit();
		}

		// değişiklik yok
		else
		{
			header('Location: ../hata.php?uyari=8');
			exit();
		}

	}

	else
	{
		header('Location: ../hata.php?hata=94');
		exit();
	}



//  E-POSTA VE ŞİFRE DEĞİŞİKLİĞİ - SONU   //





//  TAKİP DEĞİŞİKLİĞİ - BAŞI   //


elseif ( (isset($_POST['islem_turu'])) AND ($_POST['islem_turu'] == 'takip') ):

	$takip_veri = '';

	if ( (isset($_POST['takip_secim'])) AND ($_POST['takip_secim'] == '1') )
	{
		if ( (isset($_POST['takip'])) AND (is_array($_POST['takip'])) )
		{
			foreach ($_POST['takip'] as $takip_dizi)
				if (preg_match('/^f-/i', $takip_dizi)) $takip_veri .= $takip_dizi.';';
		}
	}


	//		PROFİL DEĞİŞTİRİLİYOR		//

	if ( ($_COOKIE['kullanici_kimlik'] == $kullanici_kim['kullanici_kimlik']) )
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET takip='$takip_veri' WHERE id='$kullanici_kim[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: ../hata.php?bilgi=55');
		exit();
	}

	else
	{
		header('Location: ../hata.php?hata=94');
		exit();
	}

//  TAKİP DEĞİŞİKLİĞİ - SONU   //


endif; // işlem türü
endif; // form dolu mu ?
?>