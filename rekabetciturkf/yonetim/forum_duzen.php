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


// KİP VERİSİ YOKSA UYARI VER	//

if ( (empty($_GET['kip'])) )
{
	header('Location: hata.php?hata=138');
	exit();
}


@ini_set('magic_quotes_runtime', 0);


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';




//	ZARARLI KODLAR TEMİZLENİYOR	//

if ( (isset($_GET['dalno'])) AND (is_numeric($_GET['dalno']) == false) )
{
	header('Location: hata.php?hata=139');
	exit();
}


if ( (isset($_GET['fno'])) AND (is_numeric($_GET['fno']) == false) )
{
	header('Location: hata.php?hata=14');
	exit();
}


if (isset($_GET['dalno'])) $_GET['dalno'] = zkTemizle($_GET['dalno']);
else $_GET['dalno'] = 0;

if (isset($_GET['fno'])) $_GET['fno'] = zkTemizle($_GET['fno']);
else $_GET['fno'] = 0;



// SAYFA BAŞLIĞI //

$sayfa_adi = 'Yönetim Forum Düzenleme';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');


echo '<form action="bilesenler/forum_duzen_yap.php?yo='.$yo.'" method="post" name="forum_duzen">
<input type="hidden" name="fno" value="'.$_GET['fno'].'">
<input type="hidden" name="kip" value="'.$_GET['kip'].'">';

?>
<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Forum Düzenleme</div>
<div class="kutu-icerik">



<table cellspacing="5" width="580" cellpadding="4" border="0" align="center">
<?php

// FORUM DALI DÜZENLE	//

if($_GET['kip'] == 'dal_duzenle'):

$vtsorgu = "SELECT * FROM $tablo_dallar WHERE id='$_GET[dalno]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$forum_satir = $vt->fetch_array($vtsonuc);


echo '
	<tr>
	<td colspan="2" width="140" height="20"></td>
	</tr>

	<tr>
	<td class="liste-etiket" align="center">
Forum Dalı Başlığı :
	</td>
	<td class="liste-veri">

<input type="hidden" name="dalno" value="'.$_GET['dalno'].'">
<input type="text" name="forum_baslik" size="50" value="'
.@str_replace('&','&#38',$forum_satir['ana_forum_baslik']).
'" class="formlar">

	</td>
	</tr>
';


// FORUM DÜZENLE	//

elseif($_GET['kip'] == 'forum_duzenle'):

$vtsorgu = "SELECT * FROM $tablo_forumlar WHERE id='$_GET[fno]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$forum_satir = $vt->fetch_array($vtsonuc);

$ust_forumlar_formu = '<input type="hidden" name="dalno" value="'.$forum_satir['dal_no'].'">';




//	ALT FORUM FORMU HAZIRLANIYOR	//

$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$vtsonuc_dal = $vt->query($vtsorgu) or die ($vt->hata_ver());


if ($forum_satir['alt_forum'] == '0')
	$ust_forumlar_formu .= '<select name="alt_forum" class="formlar">
	<option value="ust" selected="selected">ÜST FORUM';

else
	$ust_forumlar_formu = '<select name="alt_forum" class="formlar">
	<option value="ust">ÜST FORUM';



while ($ust_dal_satir = $vt->fetch_assoc($vtsonuc_dal))
{
	$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar WHERE dal_no='$ust_dal_satir[id]' AND alt_forum='0' ORDER BY sira";
	$ust_forum_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$ust_forumlar_formu .= '
	<option value="">[ '.$ust_dal_satir['ana_forum_baslik'].' ]';


	while ($ust_forum_satir = $vt->fetch_assoc($ust_forum_sonuc))
	{
		if ($ust_forum_satir['id'] == $forum_satir['alt_forum'])
			$ust_forumlar_formu .= '
			<option value="'.$ust_forum_satir['id'].'" selected="selected"> &nbsp; - '.$ust_forum_satir['forum_baslik'];

		elseif ($ust_forum_satir['id'] != $_GET['fno'])
		$ust_forumlar_formu .= '
		<option value="'.$ust_forum_satir['id'].'"> &nbsp; - '.$ust_forum_satir['forum_baslik'];
	}
}

$ust_forumlar_formu .= '
</select>

';

?>
	<tr>
	<td colspan="2" align="left" class="liste-veri">
<br>
&nbsp; &nbsp; Buradan; forum başlığını, açıklamasını ve resmini değiştirebilirsiniz.
<br>
Alt forum seçeneği ile, istediğiniz forumun alt forumu yapabilir veya tekrar üst forum haline getirebilirsiniz.
<br>
<br>
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" width="140" align="left">Forum Başlığı :</td>

	<td class="liste-veri" align="left">
<input type="text" name="forum_baslik" size="50" value="<?php echo @str_replace('&','&#38',$forum_satir['forum_baslik']) ?>" class="formlar">
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left">Forum Resmi :</td>
	<td class="liste-veri" align="left">
<input type="text" name="resim" size="50" value="<?php
if (isset($forum_satir['resim'])) echo $forum_satir['resim'] ?>" class="formlar">
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left">Alt Forum :</td>
	<td class="liste-veri" align="left">
<?php echo $ust_forumlar_formu; ?>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" valign="top" align="left">
<b>Açıklama :</b>
<br><br><br>
HTML <b>açık</b>
<br>
BBCode <b>kapalı</b>
	</td>
	<td class="liste-veri" align="left">
<textarea cols="48" rows="8" name="forum_bilgi" class="formlar"><?php echo @str_replace('&','&#38',$forum_satir['forum_bilgi']) ?></textarea>
	</td>
	</tr>

<?php endif; ?>

	<tr>
	<td colspan="2" align="center" class="liste-veri">
<br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input name="mesaj_gonder" type="submit" value="Düzenle" class="dugme">
<br>
<br>
	</td>
	</tr>

	</table>

</div>
</div>
</div>

</form>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>