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


if ( ( isset($_POST['oi_sil']) ) AND ( $_POST['oi_sil'] == 'oi_sil' ) )
{
	if ( ($_POST['gunsayisi'] <= 0) OR ($_POST['gunsayisi'] > 999) )
	{
		header('Location: hata.php?hata=153');
		exit();
	}

	$tarih = time();
	$hesapla = ($tarih - ($_POST['gunsayisi'] * 86400));


	$vtsorgu = "DELETE FROM $tablo_ozel_ileti WHERE gonderme_tarihi < $hesapla AND alan_kutu!=4 AND gonderen_kutu!=4 AND okunma_tarihi IS NOT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: hata.php?bilgi=47');
	exit();
}


elseif ( ( isset($_POST['oi_hesapla']) ) AND ( $_POST['oi_hesapla'] == 'oi_hesapla' ) )
{
	if ( ($_POST['gunsayisi'] <= 0) OR ($_POST['gunsayisi'] > 999) )
	{
		header('Location: hata.php?hata=153');
		exit();
	}


	$onayal = 'onayal';
	$tarih = time();
	$hesapla = ($tarih - ($_POST['gunsayisi'] * 86400));


	// SİLİNECEK ÖZEL İLETİ SAYISI ALINIYOR //

	$vtsorgu = "SELECT * FROM $tablo_ozel_ileti WHERE gonderme_tarihi < $hesapla AND alan_kutu!=4 AND gonderen_kutu!=4 AND okunma_tarihi IS NOT NULL";
	$eski_mesaj_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$oi_sayi = $vt->num_rows($eski_mesaj_sonuc);
}


$sayfa_adi = 'Yönetim Özel İleti Silme';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Özel İleti Silme</div>
<div class="kutu-icerik">


<?php if (empty($onayal)): ?>


<form name="oi_sil" action="oi_sil.php" method="post">
<input type="hidden" name="oi_hesapla" value="oi_hesapla">


<table cellspacing="1" width="100%" cellpadding="2" border="0" align="left">
	<tr>
	<td align="left" class="liste-veri">

<br> &nbsp; &nbsp; &nbsp; Bu sayfadan; belirttiğiniz günden eski, kaydedilen kutusuna taşınmamış özel iletileri silebilirsiniz. Günü girdikten sonra gelen sayfada, kaç özel iletinin silineceği belirtilir. İsterseniz silme işleminden bu kısımda vazgeçebilirsiniz.

<br><br> &nbsp; &nbsp; &nbsp; Özel iletileri silmeden önce <a href="duyurular.php?kip=yeni">buradan</a> sayfaya bir duyurusu ekleyerek, üyeleri silinmesini istemedikleri iletileri kaydetmeleri konusunda uyarabilirsiniz.

<br>

<center>

<br><br>


<input type="text" name="gunsayisi" size="4" class="formlar" maxlength="3">
<b>&nbsp; Günden eski kaydedilmemiş özel iletiler&nbsp;</b>
<br><br><br>
<input type="submit" value="Bul" class="dugme">
<br><br>
</center>
	</td>
	</tr>
</table>

</form>

<?php

//	BAŞLIKLARI SİL TIKLANMIŞSA	//

elseif (isset($onayal)):

if ($oi_sayi > 0)
{
	echo '
	<form name="oi_sil" action="oi_sil.php" method="post">
	<input type="hidden" name="oi_sil" value="oi_sil">
	<input type="hidden" name="gunsayisi" value="'.$_POST['gunsayisi'].'">';
}


echo '<table cellspacing="1" width="100%" cellpadding="2" border="0" align="left">
	<tr>
	<td align="center" class="liste-veri">';


if ($oi_sayi > 0)
{
	echo '
&nbsp; <b>'.$_POST['gunsayisi'].'</b> günden eski özel ileti sayısı: <b>'.$oi_sayi.'</b>
	<br><br>
<b>Özel iletileri silmek istediğinize emin misiniz?</b>
<br><br><br>
<input type="submit" value="Evet Sil" class="dugme">';
}


else
{
	echo '<center>
	<br>
&nbsp; <b>Forumda '.$_POST['gunsayisi'].' günden eski silinecek özel ileti yok.</b>
	<br><br><br>
	<center>
';
}


echo '

<br>
	</td>
	</tr>
</table>
</form>';


	//	FORM İZİNLERİ GÖRÜNTÜLENİYOR - BİTİŞ	//

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