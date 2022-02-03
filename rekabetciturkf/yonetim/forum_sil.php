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


//	ZARARLI KODLAR TEMİZLENİYOR	//

if (isset($_POST['fno'])) $_POST['fno'] = @zkTemizle($_POST['fno']);
if (isset($_POST['dalno'])) $_POST['dalno'] = @zkTemizle($_POST['dalno']);
if (isset($_POST['forumlar'])) $_POST['forumlar'] = @zkTemizle($_POST['forumlar']);
if (isset($_POST['dallar'])) $_POST['dallar'] = @zkTemizle($_POST['dallar']);
if (isset($_POST['dalatasi_no'])) $_POST['dalatasi_no'] = @zkTemizle($_POST['dalatasi_no']);



		//		FORUM DALI İŞLEMLERİ		//

if ( (isset($_POST['dalno'])) AND ($_POST['dalno'] != '') )
{
	// işlem yapılan dalın, sıra numarası alınıyor
	$vtsorgu = "SELECT id,sira FROM $tablo_dallar WHERE id='$_POST[dalno]'";
	$vtsonuc_silinen = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$silinen_dal = $vt->fetch_assoc($vtsonuc_silinen);


	// işlem yapılan dalın, forumları alınıyor
	$vtsorgu = "SELECT id FROM $tablo_forumlar WHERE dal_no='$_POST[dalno]'";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if (!empty($_POST['sil']))
	{
		while ($fno = $vt->fetch_assoc($vtsonuc2))
		{
			$vtsorgu = "DELETE FROM $tablo_cevaplar WHERE hangi_forumdan='$fno[id]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "DELETE FROM $tablo_mesajlar WHERE hangi_forumdan='$fno[id]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "DELETE FROM $tablo_forumlar WHERE id='$fno[id]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}


		$vtsorgu = "DELETE FROM $tablo_dallar WHERE id='$_POST[dalno]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// silinen dalın altındaki dalların sıra sayıları değiştiriliyor
		$vtsorgu = "SELECT id FROM $tablo_dallar WHERE sira > '$silinen_dal[sira]'";
		$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


		while ($dal_sira = $vt->fetch_assoc($vtsonuc_sira))
		{
			$vtsorgu = "UPDATE $tablo_dallar SET sira=sira - 1 WHERE id='$dal_sira[id]' LIMIT 1";
			$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());

		}


		header('Location: hata.php?bilgi=27');
		exit();
	}


	elseif ( (!empty($_POST['tasi'])) AND (!empty($_POST['dallar'])) )
	{
		//	forum dalının en alttaki forumunun sira numarası alınıyor
		$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE dal_no='$_POST[dallar]' AND alt_forum='0' ORDER BY sira DESC LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$enalt = $vt->fetch_assoc($vtsonuc);

		if ( (!isset($enalt['sira'])) OR ($enalt['sira'] == '') OR ($enalt['sira'] == '0') ) $enalt['sira'] = 1;


		while ($fno = $vt->fetch_assoc($vtsonuc2))
		{
			$enalt['sira']++;
			$vtsorgu = "UPDATE $tablo_forumlar SET dal_no='$_POST[dallar]', sira='$enalt[sira]' WHERE id='$fno[id]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		header('Location: hata.php?bilgi=28');
		exit();
	}


	else
	{
		header('Location: hata.php?hata=142');
		exit();
	}
}



		//		FORUM İŞLEMLERİ		//

elseif ( (isset($_POST['fno'])) AND ($_POST['fno'] != '') )
{
	if (!empty($_POST['sil']))
	{
		//	silinen forumun, üst - alt forum durumu ve sıra numarası alınıyor
		$vtsorgu = "SELECT id,dal_no,sira,alt_forum FROM $tablo_forumlar WHERE id='$_POST[fno]' LIMIT 1";
		$vtsonuc_silinen = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$silinen_forum = $vt->fetch_assoc($vtsonuc_silinen);


		// silinen forumun, alt forumları varsa uyarı veriliyor
		$vtsorgu = "SELECT id FROM $tablo_forumlar WHERE alt_forum='$silinen_forum[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		if ($vt->num_rows($vtsonuc))
		{
			header('Location: hata.php?hata=39');
			exit();
		}



		// cevapları, konuları ve forum siliniyor
		$vtsorgu = "DELETE FROM $tablo_cevaplar WHERE hangi_forumdan='$_POST[fno]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "DELETE FROM $tablo_mesajlar WHERE hangi_forumdan='$_POST[fno]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "DELETE FROM $tablo_forumlar WHERE id='$_POST[fno]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



		// silinen üst forum ise
		if ($silinen_forum['alt_forum'] == '0')
		{
			// silinen forumun altındaki üst forumların sıra sayıları değiştiriliyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar
					WHERE dal_no='$silinen_forum[dal_no]' AND alt_forum='0' AND sira > '$silinen_forum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}
		}


		// silinen alt forum ise
		else
		{
			// silinen forumun altındaki alt forumların sıra sayıları değiştiriliyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar
					WHERE alt_forum='$silinen_forum[alt_forum]' AND sira > '$silinen_forum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}
		}


		header('Location: hata.php?bilgi=29');
		exit();
	}




	elseif ( (!empty($_POST['tasi'])) AND (!empty($_POST['forumlar'])) )
	{
		$vtsorgu = "UPDATE $tablo_cevaplar SET hangi_forumdan='$_POST[forumlar]' WHERE hangi_forumdan='$_POST[fno]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_mesajlar SET hangi_forumdan='$_POST[forumlar]' WHERE hangi_forumdan='$_POST[fno]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// taşınan forumun konu sayısı hesaplanıyor
        $vtsonuc9 = $vt->query("SELECT id FROM $tablo_mesajlar WHERE hangi_forumdan='$_POST[forumlar]'") or die ($vt->hata_ver());
        $konu_sayi = $vt->num_rows($vtsonuc9);


        // taşınan forumun cevap sayısı hesaplanıyor
        $vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE hangi_forumdan='$_POST[forumlar]'") or die ($vt->hata_ver());
        $cevap_sayi = $vt->num_rows($vtsonuc9);


        // taşınan forumun konu ve cevap sayısı giriliyor
        $vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi='$konu_sayi',cevap_sayisi='$cevap_sayi'
                    WHERE id='$_POST[forumlar]' LIMIT 1";
        $vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


        // mesajları silinen forumun konu ve cevap sayısı sıfırlanıyor
        $vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi='0',cevap_sayisi='0'
                    WHERE id='$_POST[fno]' LIMIT 1";
        $vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		header('Location: hata.php?bilgi=30');
		exit();
	}




	elseif ( (!empty($_POST['dalatasi'])) AND (!empty($_POST['dalatasi_no'])) )
	{
		//	seçilen forumun üst - alt forum durumana bakılıyor
		$vtsorgu = "SELECT id,dal_no,sira,alt_forum FROM $tablo_forumlar WHERE id='$_POST[fno]' LIMIT 1";
		$vtsonuc_tasinan = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$tasinan_forum = $vt->fetch_assoc($vtsonuc_tasinan);



		// seçilen forumun üst forum ise
		if ($tasinan_forum['alt_forum'] == '0')
		{
			//	forum dalının en alttaki forumunun sira numarası alınıyor
			$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE dal_no='$_POST[dalatasi_no]' ORDER BY sira DESC LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$enalt = $vt->fetch_assoc($vtsonuc);


			if ( (!isset($enalt['sira'])) OR ($enalt['sira'] == '') OR ($enalt['sira'] == '0') ) $enalt['sira'] = 1;
			else $enalt['sira']++;


			$vtsorgu = "UPDATE $tablo_forumlar SET dal_no='$_POST[dalatasi_no]', sira='$enalt[sira]', alt_forum=0 WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// taşınan forumun altındaki üst forumların sıra sayıları değiştiriliyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar
					WHERE dal_no='$tasinan_forum[dal_no]' AND alt_forum='0' AND sira > '$tasinan_forum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}


			// alt forumlarına bakılıyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar WHERE alt_forum='$_POST[fno]'";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// alt forumları varsa bunlarında dal numaraları değiştirliyor
			while ($alt_forum = $vt->fetch_assoc($vtsonuc2))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET dal_no='$_POST[dalatasi_no]' WHERE id='$alt_forum[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}
		}



		// seçilen forumun alt forum ise, üst forum yaparak taşınıyor
		else
		{
			//	forum dalının en alttaki forumunun sira numarası alınıyor
			$vtsorgu = "SELECT sira FROM $tablo_forumlar WHERE dal_no='$_POST[dalatasi_no]' ORDER BY sira DESC LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$enalt = $vt->fetch_assoc($vtsonuc);


			if ( (!isset($enalt['sira'])) OR ($enalt['sira'] == '') OR ($enalt['sira'] == '0') ) $enalt['sira'] = 1;
			else $enalt['sira']++;


			$vtsorgu = "UPDATE $tablo_forumlar SET dal_no='$_POST[dalatasi_no]', sira='$enalt[sira]', alt_forum=0 WHERE id='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// taşınan forumun altındaki alt forumların sıra sayıları değiştiriliyor
			$vtsorgu = "SELECT id FROM $tablo_forumlar
					WHERE alt_forum='$tasinan_forum[alt_forum]' AND sira > '$tasinan_forum[sira]'";
			$vtsonuc_sira = $vt->query($vtsorgu) or die ($vt->hata_ver());


			while ($forum_sira = $vt->fetch_assoc($vtsonuc_sira))
			{
				$vtsorgu = "UPDATE $tablo_forumlar SET sira=sira - 1 WHERE id='$forum_sira[id]' LIMIT 1";
				$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			}
		}


		header('Location: hata.php?bilgi=31');
		exit();
	}



	else
	{
		header('Location: hata.php?hata=143');
		exit();
	}
}



//	SAYFAYA DOĞRUDAN ERİŞİLİYOR İSE UYARILIYOR	//

if ( (empty($_GET['kip'])) )
{
	header('Location: hata.php?hata=138');
	exit();
}

$sayfa_adi = 'Yönetim Forum Silme / Taşıma';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Forum Silme / Taşıma</div>
<div class="kutu-icerik">


<table cellspacing="1" width="580" cellpadding="4" border="0" align="center">
	<tr class="tablo_ici">
	<td align="left" class="liste-veri">
<br>
<form action="forum_sil.php" name="forumdalsilme" method="post">

<?php
if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'dal_sil') )
{
	echo '<input name="dalno" type="hidden" value="'.$_GET['dalno'].'">
&nbsp; Önceki sayfadan seçtiğiniz forum dalı altındaki forumları, buradan seçtiğiniz başka bir forum dalına taşıyabilir veya taşımadan silebilirsiniz.

<p>&nbsp; Taşıma veya silme işlemlerinde, forumdalı altındaki; forumlar, alt forumlar, konular ve cevapları işlem görür.

<br><br><center><b>Yapacağınız işlem için bir daha onay istenmeyecektir.
<br>Lütfen iyice emin olduktan sonra işlem yapınız.</b><br><br><br>
<select name="dallar" class="formlar">
<option value="" selected="selected"> &nbsp; - Taşıyacağınız forum dalını seçiniz - &nbsp; ';


	//	FORUM DALLARI BİLGİLERİ ÇEKİLİYOR	//

	$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
	$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($dallar_satir = $vt->fetch_array($dallar_sonuc))
		echo '<option value="'.$dallar_satir['id'].'">'.$dallar_satir['ana_forum_baslik'];
}


elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'forum_sil') )
{
	echo '<input name="fno" type="hidden" value="'.$_GET['fno'].'">
&nbsp; Önceki sayfadan seçtiğiniz forumu, buradan seçeceğiniz başka bir forum dalı altına taşıyabilirsiniz.
<br><br>
<center><b>Yapacağınız işlem için bir daha onay istenmeyecektir.
<br>Lütfen iyice emin olduktan sonra işlem yapınız.</b>
<br><br><br>
Bu forum dalına taşı: &nbsp;
<select name="dalatasi_no" class="formlar">
<option value="" selected="selected"> &nbsp; - Taşıyacağınız forum dalını seçiniz - &nbsp; ';


	//	FORUM DALLARI BİLGİLERİ ÇEKİLİYOR	//

	$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
	$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($dallar_satir2 = $vt->fetch_array($dallar_sonuc))
		echo '<option value="'.$dallar_satir2['id'].'">'.$dallar_satir2['ana_forum_baslik'];


	echo '</select>
<p><input class="dugme" name="dalatasi" type="submit" value="Taşı">
<br><br><br>

<hr class="cizgi_renk">
<br>
&nbsp; Önceki sayfadan seçtiğiniz forum altındaki başlıkları ve cevaplarını, buradan seçtiğiniz başka bir foruma taşıyabilir veya taşımadan silebilirsiniz.
<br><br>
<b>Yapacağınız işlem için bir daha onay istenmeyecektir.
<br>Lütfen iyice emin olduktan sonra işlem yapınız.</b>
<br><br>
<br><br><b>İçeriğini bu foruma taşı:</b>

<br><br>
<select name="forumlar" class="formlar" size="15">
<option value="" selected="selected"> &nbsp; - Taşıyacağınız forumu seçiniz - &nbsp; ';

$forum_secenek = '';


	$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while ($dallar_satir = $vt->fetch_array($vtsonuc3))
	{
		$forum_secenek .= '<option value="">['.$dallar_satir['ana_forum_baslik'].']';


		//	FORUM BİLGİLERİ ÇEKİLİYOR	//
		$vtsorgu = "SELECT id,forum_baslik,alt_forum FROM $tablo_forumlar where alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
		$forum_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		while ($forum_satir = $vt->fetch_array($forum_sonuc))
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

echo $forum_secenek;

}


?>

</select>
<br><br><br>
<input class="dugme" name="tasi" type="submit" value="Buraya Taşı">
&nbsp; &nbsp;
<input class="dugme" name="sil" type="submit" value="Taşımadan Sil">
</center>
</form>
<br>
	</td>
	</tr>

</table>

</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>