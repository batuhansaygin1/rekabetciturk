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
if (!defined('DOSYA_GERECLER')) include '../../bilesenler/gerecler.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'guvenlik.php';


//	ZARARLI KODLAR TEMİZLENİYOR	//

if (isset($_POST['kip'])) $kip = $_POST['kip'];
elseif (isset($_GET['kip'])) $kip = $_GET['kip'];
else $kip = '';


if (isset($_POST['resim'])) $_POST['resim'] = @zkTemizle($_POST['resim']);
if (isset($_POST['fno'])) $_POST['fno'] = @zkTemizle($_POST['fno']);
if (isset($_POST['dalno'])) $_POST['dalno'] = @zkTemizle($_POST['dalno']);
if (isset($_GET['dalno'])) $_GET['dalno'] = @zkTemizle($_GET['dalno']);
if (isset($_GET['sira'])) $_GET['sira'] = @zkTemizle($_GET['sira']);


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';



//	DALI DÜZENLEME	//

if ($kip == 'dal_duzenle')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
		$_POST['forum_baslik'] = @$vt->real_escape_string(stripslashes($_POST['forum_baslik']));

	//	magic_quotes_gpc kapalıysa	//
	else $_POST['forum_baslik'] = @$vt->real_escape_string($_POST['forum_baslik']);


	$vtsorgu = "UPDATE $tablo_dallar SET ana_forum_baslik='$_POST[forum_baslik]' WHERE id='$_POST[dalno]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	header('Location: ../forumlar.php');
	exit();
}




//	FORUM DÜZENLEME	//

elseif ($kip == 'forum_duzenle')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	// forum seçilmemişse uyarı ver
	if ( (!isset($_POST['alt_forum'])) OR ($_POST['alt_forum'] == '') )
	{
		header('Location: ../hata.php?hata=152');
		exit();
	}

	else $_POST['alt_forum'] = @zkTemizle($_POST['alt_forum']);


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['forum_baslik'] = @$vt->real_escape_string(stripslashes($_POST['forum_baslik']));
		$_POST['forum_bilgi'] = @$vt->real_escape_string(stripslashes($_POST['forum_bilgi']));
    }

	//	magic_quotes_gpc kapalıysa	//
    else
	{
		$_POST['forum_baslik'] = @$vt->real_escape_string($_POST['forum_baslik']);
		$_POST['forum_bilgi'] = @$vt->real_escape_string($_POST['forum_bilgi']);
    }


	//	düzenlenen forumun üst - alt forum durumuna bakılıyor //

	$vtsorgu = "SELECT dal_no,sira,alt_forum FROM $tablo_forumlar WHERE id='$_POST[fno]' LIMIT 1";
	$durum_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$durum = $vt->fetch_assoc($durum_sonuc);




	//	ÜST FORUM YAPARAK DÜZENLE	//

	if ($_POST['alt_forum'] == 'ust')
	{
		// alt forum ise, üst forum yaparak düzenle
		if ($durum['alt_forum'] != '0')
		{
			// forum dalının en altındaki üst forumun sıra numarası alınıyor
			$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE alt_forum='0' AND dal_no='$durum[dal_no]' ORDER BY sira DESC LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$enalt = $vt->fetch_assoc($vtsonuc);
			$enalt['sira']++;

			$vtsorgu = "UPDATE $tablo_forumlar SET forum_baslik='$_POST[forum_baslik]', forum_bilgi='$_POST[forum_bilgi]', resim='$_POST[resim]', sira='$enalt[sira]', alt_forum='0' WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// üst forum yapılarak düzenlenen forumun altındaki alt forumların sıra sayıları değiştiriliyor
			$vtsorgu966 = "SELECT id FROM $tablo_forumlar
					WHERE alt_forum='$durum[alt_forum]' AND sira > '$durum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu966) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu977 = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu977) or die ($vt->hata_ver());
			}
		}


		// zaten üst forum, sadece düzenle
		else
		{
			$vtsorgu = "UPDATE $tablo_forumlar SET forum_baslik='$_POST[forum_baslik]', forum_bilgi='$_POST[forum_bilgi]', resim='$_POST[resim]' WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}



	//	ALT FORUM YAPARAK DÜZENLE	//

	else
	{
		// üst forum ise, alt forum yaparak düzenle
		if ($durum['alt_forum'] == '0')
		{
			// seçilen üst forumun dal numarası alınıyor

			$vtsorgu = "SELECT dal_no FROM $tablo_forumlar WHERE id='$_POST[alt_forum]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$dal_no = $vt->fetch_assoc($vtsonuc);


			// seçilen üst forumun en alt sıradaki alt forumunun sira numarası alınıyor

			$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE alt_forum='$_POST[alt_forum]' ORDER BY sira DESC LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$enalt = $vt->fetch_assoc($vtsonuc);
		
			if (!isset($enalt['sira'])) $enalt['sira'] = 1;
			else $enalt['sira']++;


			$vtsorgu = "UPDATE $tablo_forumlar SET forum_baslik='$_POST[forum_baslik]', forum_bilgi='$_POST[forum_bilgi]', resim='$_POST[resim]', dal_no='$dal_no[dal_no]', sira='$enalt[sira]', alt_forum='$_POST[alt_forum]' WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// alt forum yapılan forumun geldiği daldaki altında kalan üst forumların sıra sayıları değiştiriliyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar
					WHERE dal_no='$durum[dal_no]' AND alt_forum='0' AND sira > '$durum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}
		}




		// farklı bir üst forumda alt forum ise, alt forum yaparak düzenle
		elseif ($durum['alt_forum'] != $_POST['alt_forum'])
		{
			// seçilen üst forumun dal numarası alınıyor

			$vtsorgu = "SELECT dal_no FROM $tablo_forumlar WHERE id='$_POST[alt_forum]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$dal_no = $vt->fetch_assoc($vtsonuc);


			// seçilen üst forumun en alt sıradaki alt forumunun sira numarası alınıyor

			$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE alt_forum='$_POST[alt_forum]' ORDER BY sira DESC LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$enalt = $vt->fetch_assoc($vtsonuc);
		
			if (!isset($enalt['sira'])) $enalt['sira'] = 1;
			else $enalt['sira']++;


			$vtsorgu = "UPDATE $tablo_forumlar SET forum_baslik='$_POST[forum_baslik]', forum_bilgi='$_POST[forum_bilgi]', resim='$_POST[resim]', dal_no='$dal_no[dal_no]', sira='$enalt[sira]', alt_forum='$_POST[alt_forum]' WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// başka bir üst forumun altına alınan alt forumun,
			// geldiği yerdeki altında kalan alt forumların sıra sayıları değiştiriliyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar
					WHERE alt_forum='$durum[alt_forum]' AND sira > '$durum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}
		}




		// aynı üst forumun alt forumu ise, sadece düzenle
		else
		{
			$vtsorgu = "UPDATE $tablo_forumlar SET forum_baslik='$_POST[forum_baslik]', forum_bilgi='$_POST[forum_bilgi]', resim='$_POST[resim]' WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}


	header('Location: ../forumlar.php');
	exit();
}



//	DAL YUKARI TAŞIMA	//

elseif ($kip == 'dal_yukari')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	//	DAL ZATEN EN BAŞTA İSE, YANİ sira=1 İSE BİR ŞEY YAPMA	//
	if ($_GET['sira'] != '1')
	{
		$asagi_sira = ($_GET['sira'] - 1);

		$vtsorgu = "UPDATE $tablo_dallar SET sira='0' WHERE sira='$asagi_sira' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_dallar SET sira='$asagi_sira' WHERE sira='$_GET[sira]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_dallar SET sira='$_GET[sira]' WHERE sira='0' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	header('Location: ../forumlar.php');
	exit();
}



//	DAL AŞAĞI TAŞIMA	//

elseif ($kip == 'dal_asagi')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	$vtsorgu = "SELECT sira FROM $tablo_dallar ORDER BY sira DESC LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$enalt = $vt->fetch_assoc($vtsonuc);


	//	DAL ZATEN EN ALTTA İSE BİR ŞEY YAPMA	//

	if ($enalt['sira'] > $_GET['sira'])
	{
		$yukari_sira = ($_GET['sira'] + 1);

		$vtsorgu = "UPDATE $tablo_dallar SET sira='0' WHERE sira='$yukari_sira' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_dallar SET sira='$yukari_sira' WHERE sira='$_GET[sira]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_dallar SET sira='$_GET[sira]' WHERE sira='0' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	header('Location: ../forumlar.php');
	exit();
}




//	FORUM YUKARI TAŞIMA	//

elseif ($kip == 'forum_yukari')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	// ÜST FORUM İŞLEMİ //

	if ( (isset($_GET['ustforum'])) AND ($_GET['ustforum'] == '1') )
	{
		//	FORUM ZATEN EN BAŞTA İSE, YANİ sira=1 İSE BİR ŞEY YAPMA	//

		if ($_GET['sira'] != '1')
		{
			$asagi_sira = ($_GET['sira'] - 1);

			$vtsorgu = "UPDATE $tablo_forumlar SET sira='0' WHERE alt_forum='0' AND dal_no='$_GET[dalno]' AND sira='$asagi_sira' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$asagi_sira' WHERE alt_forum='0' AND dal_no='$_GET[dalno]' AND sira='$_GET[sira]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$_GET[sira]' WHERE alt_forum='0' AND dal_no='$_GET[dalno]' AND sira='0' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}


	// ALT FORUM İŞLEMİ //

	elseif ( (isset($_GET['altforum'])) AND ($_GET['altforum'] != '') )
	{
		//	FORUM ZATEN EN BAŞTA İSE, YANİ sira=1 İSE BİR ŞEY YAPMA	//

		if ($_GET['sira'] != '1')
		{
			$asagi_sira = ($_GET['sira'] - 1);

			$vtsorgu = "UPDATE $tablo_forumlar SET sira='0' WHERE alt_forum='$_GET[altforum]' AND dal_no='$_GET[dalno]' AND sira='$asagi_sira' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$asagi_sira' WHERE alt_forum='$_GET[altforum]' AND dal_no='$_GET[dalno]' and sira='$_GET[sira]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$_GET[sira]' WHERE alt_forum='$_GET[altforum]' AND dal_no='$_GET[dalno]' and sira='0' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}


	header('Location: ../forumlar.php');
	exit();
}




//	FORUM AŞAĞI TAŞIMA	//

elseif ($kip == 'forum_asagi')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}


	// ÜST FORUM İŞLEMİ //

	if ( (isset($_GET['ustforum'])) AND ($_GET['ustforum'] == '1') )
	{
		// en alt sıradaki üst forumun sıra numarası alınıyor

		$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE dal_no='$_GET[dalno]' AND alt_forum='0' ORDER BY sira DESC LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$enalt = $vt->fetch_array($vtsonuc);


		//	FORUM ZATEN EN ALTTA İSE BİR ŞEY YAPMA	//

		if ($enalt['sira'] > $_GET['sira'])
		{
			$yukari_sira = ($_GET['sira'] + 1);
	
			$vtsorgu = "UPDATE $tablo_forumlar SET sira='0' WHERE alt_forum='0' AND dal_no='$_GET[dalno]' and sira='$yukari_sira' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$yukari_sira' WHERE alt_forum='0' AND dal_no='$_GET[dalno]' and sira='$_GET[sira]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$_GET[sira]' WHERE alt_forum='0' AND dal_no='$_GET[dalno]' and sira='0' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}


	// ALT FORUM İŞLEMİ //

	elseif ( (isset($_GET['altforum'])) AND ($_GET['altforum'] != '') )
	{
		// en alt sıradaki alt forumun sıra numarası alınıyor

		$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE dal_no='$_GET[dalno]' AND alt_forum='$_GET[altforum]' ORDER BY sira DESC LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$enalt = $vt->fetch_array($vtsonuc);


		//	FORUM ZATEN EN ALTTA İSE BİR ŞEY YAPMA	//

		if ($enalt['sira'] > $_GET['sira'])
		{
			$yukari_sira = ($_GET['sira'] + 1);
	
			$vtsorgu = "UPDATE $tablo_forumlar SET sira='0' WHERE alt_forum='$_GET[altforum]' AND dal_no='$_GET[dalno]' and sira='$yukari_sira' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$yukari_sira' WHERE alt_forum='$_GET[altforum]' AND dal_no='$_GET[dalno]' and sira='$_GET[sira]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
			$vtsorgu = "UPDATE $tablo_forumlar SET sira='$_GET[sira]' WHERE alt_forum='$_GET[altforum]' AND dal_no='$_GET[dalno]' and sira='0' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}

	header('Location: ../forumlar.php');
	exit();
}




//	YENİ DALI OLUŞTUR	//

elseif ($kip == 'yeni_dal')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}

	if ($_POST['ana_forum_baslik'] == '')
	{
		header('Location: ../hata.php?hata=140');
		exit();
	}

	$vtsorgu = "SELECT sira FROM $tablo_dallar ORDER BY sira DESC LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$sira = $vt->fetch_assoc($vtsonuc);
	if (isset($sira['sira'])) $sira['sira']++;
	else  $sira['sira'] = 1;

	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
		$_POST['ana_forum_baslik'] = @$vt->real_escape_string(stripslashes($_POST['ana_forum_baslik']));

	//	magic_quotes_gpc kapalıysa	//
	else $_POST['ana_forum_baslik'] = @$vt->real_escape_string($_POST['ana_forum_baslik']);


	$vtsorgu = "INSERT INTO $tablo_dallar (ana_forum_baslik,sira)
				VALUES ('$_POST[ana_forum_baslik]', '$sira[sira]')";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: ../forumlar.php');
	exit();
}




//	YENİ ÜST VEYA ALT FORUM OLUŞTUR	//

elseif ($kip == 'yeni_forum')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: ../hata.php?hata=45');
		exit();
	}

	// forum seçilmemişse uyarı ver
	if ( (!isset($_POST['alt_forum'])) OR ($_POST['alt_forum'] == '') )
	{
		header('Location: ../hata.php?hata=152');
		exit();
	}

	else $_POST['alt_forum'] = @zkTemizle($_POST['alt_forum']);


	// başlık girilmemişse uyarı ver
	if ($_POST['forum_baslik'] == '')
	{
		header('Location: ../hata.php?hata=141');
		exit();
	}


	//	YENİ ÜST FORUM OLUŞTUR	//

	if ($_POST['alt_forum'] == 'ust')
	{
		$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE dal_no='$_POST[dalno]' ORDER BY sira DESC LIMIT 1";
	
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$sira = $vt->fetch_assoc($vtsonuc);
		if (isset($sira['sira'])) $sira['sira']++;
		else  $sira['sira'] = 1;

		//	magic_quotes_gpc açıksa	//
		if (get_magic_quotes_gpc())
		{
			$_POST['forum_baslik'] = @$vt->real_escape_string(stripslashes($_POST['forum_baslik']));
			$_POST['forum_bilgi'] = @$vt->real_escape_string(stripslashes($_POST['forum_bilgi']));
		}

		//	magic_quotes_gpc kapalıysa	//
		else
		{
			$_POST['forum_baslik'] = @$vt->real_escape_string($_POST['forum_baslik']);
			$_POST['forum_bilgi'] = @$vt->real_escape_string($_POST['forum_bilgi']);
		}
    

		$vtsorgu = "INSERT INTO $tablo_forumlar (dal_no, forum_baslik, forum_bilgi, sira)
		VALUES ('$_POST[dalno]','$_POST[forum_baslik]','$_POST[forum_bilgi]', '$sira[sira]')";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	//	YENİ ALT FORUM OLUŞTUR	//

	else
	{
		$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE alt_forum='$_POST[alt_forum]' ORDER BY sira DESC LIMIT 1";
	
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$sira = $vt->fetch_assoc($vtsonuc);
		if (isset($sira['sira'])) $sira['sira']++;
		else  $sira['sira'] = 1;

		//	magic_quotes_gpc açıksa	//
		if (get_magic_quotes_gpc())
		{
			$_POST['forum_baslik'] = @$vt->real_escape_string(stripslashes($_POST['forum_baslik']));
			$_POST['forum_bilgi'] = @$vt->real_escape_string(stripslashes($_POST['forum_bilgi']));
		}

		//	magic_quotes_gpc kapalıysa	//
		else
		{
			$_POST['forum_baslik'] = @$vt->real_escape_string($_POST['forum_baslik']);
			$_POST['forum_bilgi'] = @$vt->real_escape_string($_POST['forum_bilgi']);
		}
    

		$vtsorgu = "INSERT INTO $tablo_forumlar (dal_no, forum_baslik, forum_bilgi, sira, alt_forum)
		VALUES ('$_POST[dalno]','$_POST[forum_baslik]','$_POST[forum_bilgi]', '$sira[sira]', '$_POST[alt_forum]')";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}



	header('Location: ../forumlar.php');
	exit();
}
?>