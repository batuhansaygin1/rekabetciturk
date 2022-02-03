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


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//	DUYURU EKLENİYOR	//

if ( (isset($_POST['duyuru'])) AND ($_POST['duyuru'] == 'ekle') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if ( (!isset($_POST['fno'])) OR  ($_POST['fno'] == '') )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['fno'] = zkTemizle($_POST['fno']);


	// zararlı kodlar temizleniyor
	$bul = array('meta ');
	$cevir = array('');

	$_POST['mesaj_baslik'] = str_replace($bul, $cevir, $_POST['mesaj_baslik']);
	$_POST['mesaj_icerik'] = str_replace($bul, $cevir, $_POST['mesaj_icerik']);


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['mesaj_baslik'] = @$vt->real_escape_string(stripslashes($_POST['mesaj_baslik']));
		$_POST['mesaj_icerik'] = @$vt->real_escape_string(stripslashes($_POST['mesaj_icerik']));
	}

	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['mesaj_baslik'] = @$vt->real_escape_string($_POST['mesaj_baslik']);
		$_POST['mesaj_icerik'] = @$vt->real_escape_string($_POST['mesaj_icerik']);
	}

	$vtsorgu = "INSERT INTO $tablo_duyurular (fno,duyuru_baslik,duyuru_icerik)
				VALUES ('$_POST[fno]','$_POST[mesaj_baslik]', '$_POST[mesaj_icerik]')";


	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: duyurular.php');
	exit();
}



//	SEÇİLİ DUYURU SİLİNİYOR	//

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'sil') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	$_GET['dno'] = zkTemizle($_GET['dno']);

	$vtsorgu = "DELETE FROM $tablo_duyurular WHERE id='$_GET[dno]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: duyurular.php');
	exit();
}



//	SEÇİLİ DUYURU DÜZENLENİYOR	//

if ( (isset($_POST['duyuru'])) AND ($_POST['duyuru'] == 'duzenle') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if ( (!isset($_POST['fno'])) OR  ($_POST['fno'] == '') )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['fno'] = zkTemizle($_POST['fno']);

	$_POST['dno'] = zkTemizle($_POST['dno']);


	// zararlı kodlar temizleniyor
	$bul = array('meta ');
	$cevir = array('');

	$_POST['mesaj_baslik'] = str_replace($bul, $cevir, $_POST['mesaj_baslik']);
	$_POST['mesaj_icerik'] = str_replace($bul, $cevir, $_POST['mesaj_icerik']);


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['mesaj_baslik'] = @$vt->real_escape_string(stripslashes($_POST['mesaj_baslik']));
		$_POST['mesaj_icerik'] = @$vt->real_escape_string(stripslashes($_POST['mesaj_icerik']));
	}

	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['mesaj_baslik'] = @$vt->real_escape_string($_POST['mesaj_baslik']);
		$_POST['mesaj_icerik'] = @$vt->real_escape_string($_POST['mesaj_icerik']);
	}

	$vtsorgu = "UPDATE $tablo_duyurular SET fno='$_POST[fno]',duyuru_baslik='$_POST[mesaj_baslik]',duyuru_icerik='$_POST[mesaj_icerik]' WHERE id='$_POST[dno]'";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: duyurular.php');
	exit();
}




$sayfa_adi = 'Yönetim Duyurular';
include_once('bilesenler/sayfa_baslik.php');
$sayfa_baslik = 'Yönetim Duyurular';



//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/duyurular.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));







			// DUYURU DÜZENLEME BAĞLANTISI TIKLANMIŞSA - BAŞI   //



if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle') ):

$_GET['dno'] = @zkTemizle($_GET['dno']);


// DUYURUNUN BİLGİLERİ ÇEKİLİYOR //

$vtsorgu = "SELECT * FROM $tablo_duyurular where id='$_GET[dno]' LIMIT 1";
$duzenle_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$duyuru_duzenle = $vt->fetch_assoc($duzenle_sonuc);


$sayfa_baslik = 'Duyuru Düzenleme';
$duyuru_baslik = @str_replace('&','&#38',$duyuru_duzenle['duyuru_baslik']);
$duyuru_icerik = @str_replace('&','&#38',$duyuru_duzenle['duyuru_icerik']);


$forum_secenek = '
<select name="fno" class="formlar">';

if ($duyuru_duzenle['fno'] == 'tum') $forum_secenek .= '<option value="tum" selected="selected"> &nbsp; - TÜM SAYFALAR -';
else $forum_secenek .= '<option value="tum"> &nbsp; - TÜM SAYFALAR -';

if ($portal_kullan == 1) 
{
    if ($duyuru_duzenle['fno'] == 'por') $forum_secenek .= '<option value="por" selected="selected"> &nbsp; - PORTAL ANA SAYFASI -';
    else $forum_secenek .= '<option value="por"> &nbsp; - PORTAL ANA SAYFASI -';
}

if ($duyuru_duzenle['fno'] == 'ozel') $forum_secenek .= '<option value="ozel" selected="selected"> &nbsp; - ÖZEL İLETİ SAYFALARI -';
else $forum_secenek .= '<option value="ozel"> &nbsp; - ÖZEL İLETİ SAYFALARI -';

if ($duyuru_duzenle['fno'] == 'mis') $forum_secenek .= '<option value="mis" selected="selected"> &nbsp; - MİSAFİRLER -';
else $forum_secenek .= '<option value="mis"> &nbsp; - MİSAFİRLER -';

if ($duyuru_duzenle['fno'] == 'uye') $forum_secenek .= '<option value="uye" selected="selected"> &nbsp; - TÜM ÜYELER -';
else $forum_secenek .= '<option value="uye"> &nbsp; - TÜM ÜYELER -';

if ($duyuru_duzenle['fno'] == 'byar') $forum_secenek .= '<option value="byar" selected="selected"> &nbsp; - BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -';
else $forum_secenek .= '<option value="yar"> &nbsp; - BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -';

if ($duyuru_duzenle['fno'] == 'fyar') $forum_secenek .= '<option value="fyar" selected="selected"> &nbsp; - FORUM YARDIMCILARI -';
else $forum_secenek .= '<option value="yar"> &nbsp; - FORUM YARDIMCILARI -';

if ($duyuru_duzenle['fno'] == 'yon') $forum_secenek .= '<option value="yon" selected="selected"> &nbsp; - YÖNETİCİLER -';
else $forum_secenek .= '<option value="yon"> &nbsp; - YÖNETİCİLER -';


// forum dalı adları çekiliyor

$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


while ($dallar_satir = $vt->fetch_array($dallar_sonuc))
{
	$forum_secenek .= '<option value="">[ '.$dallar_satir['ana_forum_baslik'].' ]';


	// forum adları çekiliyor

	$vtsorgu = "SELECT id,forum_baslik,alt_forum FROM $tablo_forumlar
				WHERE alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while ($forum_satir = $vt->fetch_array($vtsonuc))
	{
		// alt forumuna bakılıyor
		$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar
					WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
		$vtsonuca = $vt->query($vtsorgu) or die ($vt->hata_ver());


		if (!$vt->num_rows($vtsonuca))
		{
			if ($duyuru_duzenle['fno'] == $forum_satir['id']) $forum_secenek .= '
			<option value="'.$forum_satir['id'].'" selected="selected"> &nbsp; - '.$forum_satir['forum_baslik'];

			else $forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];
		}


		else
		{
			if ($duyuru_duzenle['fno'] == $forum_satir['id']) $forum_secenek .= '
			<option value="'.$forum_satir['id'].'" selected="selected"> &nbsp; - '.$forum_satir['forum_baslik'];

			else $forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
			{
				if ($duyuru_duzenle['fno'] == $alt_forum_satir['id']) $forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'" selected="selected"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'];

				else $forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'];
			}
		}
	}
}

$forum_secenek .= '</select>';



$dongusuz = array('{FORUM_SECENEK}' => $forum_secenek,
'{DNO}' => $_GET['dno'],
'{KIP}' => 'duzenle"><input type="hidden" name="yo" value="'.$yo,
'{FORM_GONDER}' => 'Düzenle',
'{DUYURU_BASLIK}' => $duyuru_baslik,
'{FORM_ICERIK}' => $duyuru_icerik);


$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('3', array('' => ''), false);
$ornek1->kosul('1', $dongusuz, true);





			// DUYURU DÜZENLEME BAĞLANTISI TIKLANMIŞSA - SONU   //


elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'yeni') ):


$sayfa_baslik = 'Duyuru Ekleme';


$forum_secenek = '
<select name="fno" class="formlar">
<option value="tum"> &nbsp; - TÜM FORUM SAYFALARI -';

if ($portal_kullan == 1) $forum_secenek .= '<option value="por"> &nbsp; - PORTAL ANA SAYFASI -';

$forum_secenek .= '<option value="ozel"> &nbsp; - ÖZEL İLETİ SAYFALARI -
<option value="mis"> &nbsp; - MİSAFİRLER -
<option value="uye"> &nbsp; - TÜM ÜYELER -
<option value="byar"> &nbsp; - BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -
<option value="fyar"> &nbsp; - FORUM YARDIMCILARI -
<option value="yon"> &nbsp; - YÖNETİCİLER -
<option value=""> &nbsp; --------------------------------------------------';



// forum dalı adları çekiliyor

$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


while ($dallar_satir = $vt->fetch_array($dallar_sonuc))
{
	$forum_secenek .= '<option value="">[ '.$dallar_satir['ana_forum_baslik'].' ]';


	// forum adları çekiliyor

	$vtsorgu = "SELECT id,forum_baslik,alt_forum FROM $tablo_forumlar
				WHERE alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while ($forum_satir = $vt->fetch_array($vtsonuc))
	{
		// alt forumuna bakılıyor
		$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar
					WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
		$vtsonuca = $vt->query($vtsorgu) or die ($vt->hata_ver());


		if (!$vt->num_rows($vtsonuca))
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];


		else
		{
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
				$forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'];
		}
	}
}

$forum_secenek .= '</select>';



$dongusuz = array('{FORUM_SECENEK}' => $forum_secenek,
'{DNO}' => '',
'{KIP}' => 'ekle"><input type="hidden" name="yo" value="'.$yo,
'{FORM_GONDER}' => 'G ö n d e r',
'{DUYURU_BASLIK}' => '',
'{FORM_ICERIK}' => '');


$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('3', array('' => ''), false);
$ornek1->kosul('1', $dongusuz, true);





			//      GİRİŞ SAYFASI - DUYURULAR SIRALANIYOR       //

else:


//	FORUM BİLGİLERİ ÇEKİLİYOR	//

$vtsorgu = "SELECT id,forum_baslik,okuma_izni FROM $tablo_forumlar ORDER BY dal_no, sira";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

while ($forum_satir = $vt->fetch_array($vtsonuc))
{
	$tumforum_satir[$forum_satir['id']] = $forum_satir['forum_baslik'];
}



// DUYURU SIRALAMA ŞEKLİ    //

if (isset($_GET['sirala']))
{
	if ($_GET['sirala'] == 'f1')
	{
		$duyuru_sirala = 'fno';
		$siralama_secenek = '<option value="f2">Forum sırasına göre tersten
<option value="f1" selected="selected">Forum sırasına göre
<option value="d2">Oluşturulma sırasına göre tersten
<option value="d1">Oluşturulma sırasına göre';
	}

	elseif ($_GET['sirala'] == 'f2')
	{
		$duyuru_sirala = 'fno DESC';
		$siralama_secenek = '<option value="f2" selected="selected">Forum sırasına göre tersten
<option value="f1">Forum sırasına göre
<option value="d2">Oluşturulma sırasına göre tersten
<option value="d1">Oluşturulma sırasına göre';
	}

	elseif ($_GET['sirala'] == 'd1')
	{
		$duyuru_sirala = 'id';
		$siralama_secenek = '<option value="f2">Forum sırasına göre tersten
<option value="f1">Forum sırasına göre
<option value="d2">Oluşturulma sırasına göre tersten
<option value="d1" selected="selected">Oluşturulma sırasına göre';
	}

	elseif ($_GET['sirala'] == 'd2')
	{
		$duyuru_sirala = 'id DESC';
		$siralama_secenek = '<option value="f2">Forum sırasına göre tersten
<option value="f1">Forum sırasına göre
<option value="d2" selected="selected">Oluşturulma sırasına göre tersten
<option value="d1">Oluşturulma sırasına göre';
	}
}

else
{
	$duyuru_sirala = 'fno DESC';
	$siralama_secenek = '<option value="f2" selected="selected">Forum sırasına göre tersten
<option value="f1">Forum sırasına göre
<option value="d2">Oluşturulma sırasına göre tersten
<option value="d1">Oluşturulma sırasına göre';
}



// DUYURU BİLGİLERİ ÇEKİLİYOR //

$vtsorgu = "SELECT * FROM $tablo_duyurular ORDER BY $duyuru_sirala";
$duyuru_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// DUYURU VARSA DÖNGÜYE GİRİLİYOR //

if ($vt->num_rows($duyuru_sonuc)) 
{
	while ($duyurular = $vt->fetch_assoc($duyuru_sonuc))
	{
		if ($duyurular['fno'] == 'tum') $forum_baslik = '"Ana Duyuru"';
		elseif ($duyurular['fno'] == 'por') $forum_baslik = '"Portal Duyurusu"';
		elseif ($duyurular['fno'] == 'ozel') $forum_baslik = '"Özel İleti Duyurusu"';
		elseif ($duyurular['fno'] == 'mis') $forum_baslik = '"Misafirler Duyurusu"';
		elseif ($duyurular['fno'] == 'uye') $forum_baslik = '"Tüm Üyeler Duyurusu"';
		elseif ($duyurular['fno'] == 'byar') $forum_baslik = '"Bölüm Yardımcıları ve Özel Üyeler Duyurusu"';
		elseif ($duyurular['fno'] == 'fyar') $forum_baslik = '"Forum Yardımcıları Duyurusu"';
		elseif ($duyurular['fno'] == 'yon') $forum_baslik = '"Yöneticiler Duyurusu"';
		else $forum_baslik = $tumforum_satir[$duyurular['fno']].' Duyurusu';


		$tekli1[] = array('{FORUM_BASLIK}' => $forum_baslik,
		'{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'],
		'{DUYURU_ICERIK}' => $duyurular['duyuru_icerik'],
		'{DNO}' => $duyurular['id'],
		'{YO}' => $yo);
	}


	$dongusuz = array('{KIP}' => 'duzenle',
	'{SIMGE_DEGISTIR}' => $simge_degistir,
	'{SIMGE_SIL}' => $simge_sil,
	'{YENI_DUYURU_EKLE}' => 'duyurular.php?kip=yeni',
	'{SIRALAMA_SECENEK}' => $siralama_secenek);


	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', $dongusuz, true);

	$ornek1->tekli_dongu('1',$tekli1);
}



else
{
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('{DUYURU_YOK}' => 'Henüz Duyuru Yok !',
	'{YENI_DUYURU_EKLE}' => 'duyurular.php?kip=yeni'), true);
}


endif;


$dongusuz = array('{SAYFA_BASLIK}' => $sayfa_baslik);
$ornek1->dongusuz($dongusuz);

eval(TEMA_UYGULA);

?>