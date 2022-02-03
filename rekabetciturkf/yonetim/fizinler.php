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


if ( ( isset($_POST['izindegistir']) ) AND ( $_POST['izindegistir'] == 'izindegistir' ) )
{
	$_POST['okuma_izni'] = zkTemizle($_POST['okuma_izni']);
	$_POST['yazma_izni'] = zkTemizle($_POST['yazma_izni']);
	$_POST['konu_acma_izni'] = zkTemizle($_POST['konu_acma_izni']);
	$_POST['fno'] = zkTemizle($_POST['fno']);


	// misafirlere açıksa gizlenmesin
	if ($_POST['okuma_izni'] == '0') $_POST['gizle'] = 0;


	// okuma izni sadece yöneticiler içinse ve diğer izinler de kapalı değilse, diğer izinleri sadece yönetici olarak değiştir
	if ($_POST['okuma_izni'] == '1')
	{
		if ($_POST['konu_acma_izni'] != '5') $_POST['konu_acma_izni'] = 1;
		if ($_POST['yazma_izni'] != '5') $_POST['yazma_izni'] = 1;
	}


	// okuma izni yardımcılar içinse ve diğer izinler daha düşükse
	if ($_POST['okuma_izni'] == '2')
	{
		if (($_POST['konu_acma_izni'] == '0') OR ($_POST['konu_acma_izni'] == '3')) $_POST['konu_acma_izni'] = 2;
		if (($_POST['yazma_izni'] == '0') OR ($_POST['yazma_izni'] == '3')) $_POST['yazma_izni'] = 2;
	}


	// okuma izni özel üyeler içinse ve diğer izinler tüm üyeler ise
	if ($_POST['okuma_izni'] == '3')
	{
		if ($_POST['konu_acma_izni'] == '0') $_POST['konu_acma_izni'] = 3;
		if ($_POST['yazma_izni'] == '0') $_POST['yazma_izni'] = 3;
	}


	// okuma izni kapalı ise diğer izinleri de kapat
	if ($_POST['okuma_izni'] == '5')
	{
		$_POST['konu_acma_izni'] = 5;
		$_POST['yazma_izni'] = 5;
	}



	// FORUM İZİN BİLGİLERİ DEĞİŞTİRİLİYOR //

	$vtsorgu = "UPDATE $tablo_forumlar SET 
	okuma_izni='$_POST[okuma_izni]', yazma_izni='$_POST[yazma_izni]', konu_acma_izni='$_POST[konu_acma_izni]', gizle='$_POST[gizle]'
	WHERE id='$_POST[fno]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}




elseif ( ( isset($_POST['izingoster']) ) AND ( $_POST['izingoster'] == 'izingoster' ) )
{
	if ( (!isset($_POST['forum_izin'])) OR (is_numeric($_POST['forum_izin']) == false) )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['forum_izin'] = zkTemizle($_POST['forum_izin']);


	// FORUM İZİN BİLGİLERİ ÇEKİLİYOR //

	$vtsorgu = "SELECT id,forum_baslik,okuma_izni,yazma_izni,konu_acma_izni,gizle FROM $tablo_forumlar
			WHERE id='$_POST[forum_izin]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$izinler_satir = $vt->fetch_array($vtsonuc);
}




$sayfa_adi = 'Yönetim Forum İzinleri';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>
<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Forum İzinleri</div>
<div class="kutu-icerik">



<table cellspacing="0" width="100%" cellpadding="2" border="0" align="left">
	<tr>
	<td align="left" class="liste-veri">

<form name="forum_izinleri" action="fizinler.php" method="post">
<input type="hidden" name="izingoster" value="izingoster">

<?php

if ( (!isset($_POST['izindegistir'])) AND (!isset($_POST['izingoster'])) )
{
echo '
	<br> &nbsp; &nbsp; &nbsp; İzinlerini görüntülemek ve/veya düzenlemek istediğiniz forumu aşağıdan seçip
	<br>&nbsp;<b>İzinleri Göster</b> düğmesini tıklayın.

	<p> &nbsp; &nbsp; &nbsp; Forum bölümü yetkisi olarak <b>Özel Üyeleri</b> seçtiğinizde, istediğiniz kullanıcıya ilgili forum bölümüne erişimi için okuma, yazma veya yönetme yetkisi verebilirsiniz.
	<br>Herhangi bir üyeye forum bölümünü yönetme yetkisi verdiğinizde üye o forum bölümünün yardımcısı olur, yetkisi de <b>Bölüm Yardımcısı</b> olur.

	<p> &nbsp; &nbsp; &nbsp; Forum bölümünün ayarlanmış yetkiden daha düşük yetkili üyeler ilgili forumu yönetemez.
	Yani herhangi bir yetkisi yöneticiler olarak ayarlanmış bir forum bölümü için, daha düşük yetkiye sahip bir üyeye yönetme yetkisi verilemez. Bu durum yardımcı yetkisi verilmiş forum bölümleri için de geçerlidir.

	<p> &nbsp; &nbsp; &nbsp; <b><u>Bölüm Yardımcısı Atama:</u></b>&nbsp; Herhangi bir üyeye bölüm yardımcısı yetkisi ve/veya özel yetkiler vermek için, <a href="kullanicilar.php">bu sayfadan</a>
	istediğiniz üyenin kullanıcı adını tıklayın. Açılan, "Kullanıcı Profilini Değiştir" sayfasından <b>Diğer Yetkiler</b> bağlantısını tıklayın. Yeni açılan sayfadan yetki vermek istediğiniz forumu seçerek kullanıcıya istediğiniz yetkiyi verebilirsiniz.
	<br>Yönetme yetkisi verdiğinizde üyenin yetkisi bölüm yardımcısı olur.

	<p> &nbsp; &nbsp; &nbsp; <b><u>Forum Gizleme:</u></b>&nbsp; İstediğiniz forum bölümlerini, 
ayarlanan okuma yetkisinden düşük üyelere gizleyebilirsiniz. Mesela bir forum bölümünün okuma yetkisini sadece yöneticiler olarak ayarlayıp gizlediğinizde, bu bölüm ve konuları sadece yöneticiler tarafından görüntülenecektir.';
}

else echo '<br><center><a href="fizinler.php"><b>- Yardım Göster -</b></a></center>';

?>
<br><br>

<center>
<b>Forum Seç:</b> &nbsp;
<br>

<?php


$forum_secenek = '<select name="forum_izin" class="formlar" size="15" style="min-width:250px">';


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
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"';

			if ( ( isset($_POST['forum_izin']) ) AND ($_POST['forum_izin'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			else $forum_secenek .= '>';

			$forum_secenek .= ' &nbsp; - '.$forum_satir['forum_baslik'];
		}


		else
		{
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"';

			if ( ( isset($_POST['forum_izin']) ) AND ($_POST['forum_izin'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			else $forum_secenek .= '>';

			$forum_secenek .= ' &nbsp; - '.$forum_satir['forum_baslik'];


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
			{
			
				$forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"';

				if ( ( isset($_POST['forum_izin']) ) AND ($_POST['forum_izin'] == $alt_forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
				elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $alt_forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
				else $forum_secenek .= '>';

				$forum_secenek .= ' &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'];
			}
		}
	}
}


echo $forum_secenek.'</select>';


?>


<br><br>
<input type="submit" value="İzinleri Göster" class="dugme">
</center>
<br>
</form>


<?php if ( ( isset($_POST['izindegistir']) ) AND ( $_POST['izindegistir'] == 'izindegistir' ) )
echo '<p align="center"><b><font color="green">Forum izinleri değiştirilmiştir.</b></p><br>'; ?>


	</td>
	</tr>


<?php
//	FORUM İZİNLERİNİ GÖSTER TIKLANMIŞSA	//

if ( isset($izinler_satir) ):
?>

	<tr>
	<td align="center" valign="top">

<form name="forum_izinleri" action="fizinler.php" method="post">
<input type="hidden" name="izindegistir" value="izindegistir">
<input type="hidden" name="fno" value="<?php echo $izinler_satir['id'] ?>">


<hr>
<br><br>

<div><b><?php echo $izinler_satir['forum_baslik'] ?> Bölümü İzinleri</b></div>

<br><br>


<table cellspacing="1" cellpadding="2" width="400" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-etiket" align="left" valign="top" width="110">Okuma:</td>

	<td class="liste-veri" align="left" valign="middle">
<select name="okuma_izni" class="formlar" size="6">
<option value="0" <?php if ($izinler_satir['okuma_izni'] == 0) echo 'selected="selected"'; ?>>
Herkes

<option value="4" <?php if ($izinler_satir['okuma_izni'] == 4) echo 'selected="selected"'; ?>>
Tüm Üyeler

<option value="3" <?php if ($izinler_satir['okuma_izni'] == 3) echo 'selected="selected"'; ?>>
Özel Üyeler ve Yöneticiler

<option value="2" <?php if ($izinler_satir['okuma_izni'] == 2) echo 'selected="selected"'; ?>>
Yardımcılar ve Yöneticiler

<option value="1" <?php if ($izinler_satir['okuma_izni'] == 1) echo 'selected="selected"'; ?>>
Sadece Yöneticiler

<option value="5" <?php if ($izinler_satir['okuma_izni'] == 5) echo 'selected="selected"'; ?>>
Kapalı
</select>
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" valign="top">Konu Açma:</td>
	<td class="liste-veri" align="left" valign="middle">
<select name="konu_acma_izni" class="formlar" size="5">
<option value="0" <?php if ($izinler_satir['konu_acma_izni'] == 0) echo 'selected="selected"'; ?>>
Tüm Üyeler

<option value="3" <?php if ($izinler_satir['konu_acma_izni'] == 3) echo 'selected="selected"'; ?>>
Özel Üyeler ve Yöneticiler

<option value="2" <?php if ($izinler_satir['konu_acma_izni'] == 2) echo 'selected="selected"'; ?>>
Yardımcılar ve Yöneticiler

<option value="1" <?php if ($izinler_satir['konu_acma_izni'] == 1) echo 'selected="selected"'; ?>>
Sadece Yöneticiler

<option value="5" <?php if ($izinler_satir['konu_acma_izni'] == 5) echo 'selected="selected"'; ?>>
Kapalı
</select>
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" valign="top">Cevap Yazma:</td>
	<td class="liste-veri" align="left" valign="middle">
<select name="yazma_izni" class="formlar" size="5">
<option value="0" <?php if ($izinler_satir['yazma_izni'] == 0) echo 'selected="selected"'; ?>>
Tüm Üyeler

<option value="3" <?php if ($izinler_satir['yazma_izni'] == 3) echo 'selected="selected"'; ?>>
Özel Üyeler ve Yöneticiler

<option value="2" <?php if ($izinler_satir['yazma_izni'] == 2) echo 'selected="selected"'; ?>>
Yardımcılar ve Yöneticiler

<option value="1" <?php if ($izinler_satir['yazma_izni'] == 1) echo 'selected="selected"'; ?>>
Sadece Yöneticiler

<option value="5" <?php if ($izinler_satir['yazma_izni'] == 5) echo 'selected="selected"'; ?>>
Kapalı
</select>
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" valign="top">Gizleme:</td>
	<td class="liste-veri" align="left" valign="bottom">
<select name="gizle" class="formlar">
<?php
echo '<option value="0"';
if ($izinler_satir['gizle'] == 0) echo ' selected="selected"';
echo '>Göster';

echo '<option value="1"';
if ($izinler_satir['gizle'] == 1) echo ' selected="selected"';
echo '>Gizle';
?>
</select>
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" valign="top">Yönetme:</td>
	<td class="liste-veri" align="left" valign="top">
<?php
if ( ($izinler_satir['yazma_izni'] == 1) OR ($izinler_satir['konu_acma_izni'] == 1) OR ($izinler_satir['okuma_izni'] == 1) )
	echo 'Sadece Forum Yöneticileri';

else if ( ($izinler_satir['yazma_izni'] == 2) OR ($izinler_satir['konu_acma_izni'] == 2) OR ($izinler_satir['okuma_izni'] == 2) )
	echo 'Forum Yöneticileri ve Forum Yardımcıları';

else if ( ($izinler_satir['yazma_izni'] == 3) OR ($izinler_satir['konu_acma_izni'] == 3) OR ($izinler_satir['okuma_izni'] == 3) )
	echo 'Forum yöneticileri, yardımcıları ve bölümün yardımcıları
	<br><br><a href="kullanicilar.php">Bu Bölüme Yardımcılar Ata</a>';

elseif ( ($izinler_satir['yazma_izni'] == 5) OR ($izinler_satir['konu_acma_izni'] == 5) OR ($izinler_satir['okuma_izni'] == 5) )
	echo 'Sadece Forum Yöneticileri';

else echo 'Forum yöneticileri, yardımcıları ve bölümün yardımcıları
	<br><br><a href="kullanicilar.php">Bu Bölüme Yardımcılar Ata</a>';
?>
	</td>
	</tr>
</table>

<br>
<input type="submit" value="İzinleri Değiştir" class="dugme">

<br>
</form>
	</td>
	</tr>



<?php
	//	FORM İZİNLERİ GÖRÜNTÜLENİYOR - BİTİŞ	//

endif;
?>

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