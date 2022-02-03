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
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


if ( ( isset($_POST['basliklari_sil']) ) AND ( $_POST['basliklari_sil'] == 'basliklari_sil' ) )
{
	$_POST['fno'] = @zkTemizle($_POST['fno']);

	$tarih = time();
	$hesapla = ($tarih - ($_POST['gunsayisi'] * 86400));

	if ($_POST['fno'] != 'tumu' )
	$hangi_forumdan = "hangi_forumdan='$_POST[fno]' AND";
	else $hangi_forumdan = '';


	// 		MESAJLAR SİLİNİYOR		 //

	$vtsorgu = "SELECT id FROM $tablo_mesajlar
			WHERE $hangi_forumdan son_mesaj_tarihi < $hesapla";
	$mesaj_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "DELETE FROM $tablo_mesajlar
			WHERE $hangi_forumdan son_mesaj_tarihi < $hesapla";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// 		CEVAPLAR SİLİNİYOR		 //

	while ($eski_mesaj = $vt->fetch_assoc($mesaj_sonuc))
	{
		$vtsorgu = "DELETE FROM $tablo_cevaplar
				WHERE $hangi_forumdan hangi_basliktan='$eski_mesaj[id]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


    // FORUM BİLGİLERİ ÇEKİLİYOR	//

    $vtsorgu = "SELECT id FROM $tablo_forumlar";
    $vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


    while ($forum_satir = $vt->fetch_assoc($vtsonuc))
    {

        //	FORUMDAKİ BAŞLIKLARIN SAYISI ALINIYOR	//

        $vtsonuc9 = $vt->query("SELECT id FROM $tablo_mesajlar WHERE hangi_forumdan='$forum_satir[id]'") or die ($vt->hata_ver());
        $konu_sayi = $vt->num_rows($vtsonuc9);


        //	FORUMDAKİ TÜM MESAJLARIN SAYISI ALINIYOR	//

        $vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE hangi_forumdan='$forum_satir[id]'") or die ($vt->hata_ver());
        $cevap_sayi = $vt->num_rows($vtsonuc9);


        //  KONU VE CEVAP SAYISI YENİ ALANLARA GİRİLİYOR    //

        $vtsorgu = "UPDATE `$tablo_forumlar` SET konu_sayisi='$konu_sayi', cevap_sayisi='$cevap_sayi'
                    WHERE id='$forum_satir[id]' LIMIT 1";
        $vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	header('Location: hata.php?bilgi=36');
	exit();
}


elseif ( ( isset($_POST['forum_goster']) ) AND ( $_POST['forum_goster'] == 'forum_goster' ) )
{
	if ( empty($_POST['fno']) OR ($_POST['fno'] == '') )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	if ( ($_POST['gunsayisi'] <= 0) OR ($_POST['gunsayisi'] > 999) )
	{
		header('Location: hata.php?hata=153');
		exit();
	}

	$_POST['fno'] = @zkTemizle($_POST['fno']);

	$onayal = 'onayal';
	$tarih = time();
	$hesapla = ($tarih - ($_POST['gunsayisi'] * 86400));

	if ($_POST['fno'] != 'tumu' )
	$hangi_forumdan = "hangi_forumdan='$_POST[fno]' AND";
	else $hangi_forumdan = '';


	// 	SİLİNECEK MESAJ SAYISI ALINIYOR	 //

	$vtsorgu = "SELECT id FROM $tablo_mesajlar
			WHERE $hangi_forumdan son_mesaj_tarihi < $hesapla";
	$eski_mesaj_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$mesaj_sayi = $vt->num_rows($eski_mesaj_sonuc);


	// 	SİLİNECEK MESAJ SAYISI ALINIYOR	 //

	$toplam_cevap_sayi = 0;
	while ($eski_mesaj = $vt->fetch_assoc($eski_mesaj_sonuc))
	{
		$vtsorgu = "SELECT id FROM $tablo_cevaplar 
				WHERE $hangi_forumdan hangi_basliktan='$eski_mesaj[id]'";
		$eski_cevap_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$cevap_sayi = $vt->num_rows($eski_cevap_sonuc);
		$toplam_cevap_sayi += $cevap_sayi;
	}
}



$sayfa_adi = 'Yönetim Forum Temizleme';

include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');


// FORUM İZİNLERİ TABLOSU BAŞI		-->

?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Forum Temizleme</div>
<div class="kutu-icerik">

<?php

// başlıkları sil tıklanmışsa
if (empty($onayal)):

?>


<form name="temizleme" action="temizleme.php" method="post">
<input type="hidden" name="forum_goster" value="forum_goster">


<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">

<br> &nbsp; &nbsp; &nbsp; Bu sayfadan; belirttiğiniz gün sayısı içerisinde cevap yazılmayan başlıkları ve cevaplarını silebilirsiniz. Forumu seçip, gün girdikten sonra gelen sayfada, kaç başlığın ve bunlara bağlı kaç cevabın silineceği belirtilir. İsterseniz silme işleminden bu kısımda vazgeçebilirsiniz.

<br><br>
<center>
<b>Forum Seç:</b>
<br>

<?php


$forum_secenek = '<select name="fno" class="formlar" size="15">
<option value="tumu">&nbsp; - TÜM FORUMLAR -';


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


echo $forum_secenek;


?>
</select>

<br><br>

<input type="text" name="gunsayisi" size="4" class="formlar" maxlength="3">
<b>&nbsp; Gündür cevap yazılmayan &nbsp;</b>
<br><br>
<input type="submit" value="Başlıkları Bul" class="dugme">
<br><br>
</center>
	</td>
	</tr>
</table>
</form>

<?php

//	BAŞLIKLARI SİL TIKLANMIŞSA	//

elseif (isset($onayal)):

?>

<form name="temizleme" action="temizleme.php" method="post">
<input type="hidden" name="basliklari_sil" value="basliklari_sil">
<input type="hidden" name="fno" value="<?php if (isset($_POST['fno'])) echo $_POST['fno'] ?>">
<input type="hidden" name="gunsayisi" value="<?php if (isset($_POST['gunsayisi'])) echo $_POST['gunsayisi'] ?>">

<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">
<?php

echo ' &nbsp; Seçmiş olduğunuz forumda son <b>'.$_POST['gunsayisi'].'</b> gündür cevap yazılmamış;
<br><br> &nbsp; Başlık sayısı: <b>'.$mesaj_sayi.'</b>
<br> &nbsp; Başlıklara bağlı cevap sayısı: <b>'.$toplam_cevap_sayi.'</b>';

?>

<br><br>
<p align="center">
<b>Başlık ve cevaplarını silmek istediğinize emin misiniz?</b>
<br><br><br>
<input type="submit" value="Evet Sil" class="dugme">
</p>
	</td>
	</tr>
</table>

</form>

<?php

//  FORM İZİNLERİ GÖRÜNTÜLENİYOR - BİTİŞ  //

endif;

?>


</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>