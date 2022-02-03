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


$sayfa_adi = 'Yönetim - Forum Yönetimi';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');


// ANA FORUM DALI BİLGİLERİ ÇEKİLİYOR //

$vtsorgu = "SELECT * FROM $tablo_dallar ORDER BY sira";
$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Forum Yönetimi</div>
<div class="kutu-icerik">



<?php

while ($dallar_satir = $vt->fetch_assoc($vtsonuc2)):

echo '
<table cellspacing="1" width="98%" cellpadding="2" border="0" align="center" class="tablo_border4">
	<tr>
	<td height="30" class="forum_baslik" align="left" colspan="2">&nbsp;'
.$dallar_satir['ana_forum_baslik'].'
	</td>

	<td class="forum_baslik" align="center" bgcolor="#0099ff" width="80">
<a href="forum_duzen.php?kip=dal_duzenle&amp;dalno='.$dallar_satir['id'].'"><font color="#ffffff" style="font-size: 11px">düzenle</font></a>
	</td>

	<td class="forum_baslik" align="center" bgcolor="#0099ff" width="70">
<a href="forum_sil.php?kip=dal_sil&amp;dalno='.$dallar_satir['id'].'"><font color="#ffffff" style="font-size: 11px">sil / taşı</font></a>
	</td>

	<td class="forum_baslik" align="center" bgcolor="#0099ff" width="85">
<a href="bilesenler/forum_duzen_yap.php?kip=dal_yukari&amp;yo='.$yo.'&amp;sira='.$dallar_satir['sira'].'"><font color="#ffffff" style="font-size: 11px">yukarı al</font></a><br><a href="bilesenler/forum_duzen_yap.php?kip=dal_asagi&amp;yo='.$yo.'&amp;sira='.$dallar_satir['sira'].'"><font color="#ffffff" style="font-size: 11px">aşağı al</font></a>
	</td>
	</tr>';



		//		FORUM DALLARI SIRALANIYOR SONU		//

		//		FORUMLAR SIRALANIYOR BAŞI		//




//	ÜST FORUM BİLGİLERİ ÇEKİLİYOR	//

$vtsorgu = "SELECT * FROM $tablo_forumlar WHERE alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$ust_forumlar_formu = '';


while ($forum_satir = $vt->fetch_assoc($vtsonuc)):


$ust_forumlar_formu .= '<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];


echo '
	<tr class="tablo_ici">
	<td width="50" align="center" class="liste-veri">';
if (empty($forum_satir['resim']))
	echo '<img border="0" src="../temalar/varsayilan/resimler/forum01.gif" alt="Forum Simgesi">';
elseif ( (preg_match('/^http:\/\//i', $forum_satir['resim'])) OR (preg_match('/^https:\/\//i', $forum_satir['resim']))
				OR (preg_match('/^ftp:\/\//i', $forum_satir['resim'])) OR (preg_match('/^\//i', $forum_satir['resim'])) )
	echo '<img width="30 border="0" src="'.$forum_satir['resim'].'" alt="Forum Simgesi">';
else echo '<img width="30 border="0" src="../'.$forum_satir['resim'].'" alt="Forum Simgesi">';
echo'</td>

	<td align="left" class="liste-veri">
<p><a href="../forum.php?f='.$forum_satir['id'].'">'.$forum_satir['forum_baslik'].'</a><br>'.$forum_satir['forum_bilgi'].'
	</td>

	<td align="center" width="80" class="liste-veri">
<a href="forum_duzen.php?kip=forum_duzenle&amp;fno='.$forum_satir['id'].'">düzenle</a>
	</td>

	<td align="center" width="70" class="liste-veri">
<a href="forum_sil.php?kip=forum_sil&amp;fno='.$forum_satir['id'].'">sil / taşı</a>
	</td>

	<td align="center" width="85" class="liste-veri">
<p><a href="bilesenler/forum_duzen_yap.php?kip=forum_yukari&amp;dalno='.$forum_satir['dal_no'].'&amp;fno='.$forum_satir['id'].'&amp;ustforum=1&amp;yo='.$yo.'&amp;sira='.$forum_satir['sira'].'">yukarı al</a><p><a href="bilesenler/forum_duzen_yap.php?kip=forum_asagi&amp;dalno='.$forum_satir['dal_no'].'&amp;fno='.$forum_satir['id'].'&amp;ustforum=1&amp;yo='.$yo.'&amp;sira='.$forum_satir['sira'].'">aşağı al</a>
	</td>
	</tr>';



	//	ALT FORUMLARINA BAKILIYOR

	$vtsorgu = "SELECT * FROM $tablo_forumlar WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
	$vtsonuca = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuca))
	{
		echo '
		<tr>
		<td colspan="5" class="tablo_ici">

		<table cellspacing="3" width="100%" cellpadding="3" border="0" align="center" class="tablo_ici">';



		while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
		{
			echo '<tr class="tablo_ici">
			<td width="75" align="right"><img border="0" src="../temalar/varsayilan/resimler/alt_forum.png" alt="Alt Forumlar">&nbsp;</td>
			<td width="50" align="center" class="liste-veri">';
			if (empty($alt_forum_satir['resim']))
				echo '<img border="0" src="../temalar/varsayilan/resimler/forum01.gif" alt="Alt Forum Simgesi">';
			elseif ( (preg_match('/^http:\/\//i', $alt_forum_satir['resim'])) OR (preg_match('/^https:\/\//i', $alt_forum_satir['resim']))
				OR (preg_match('/^ftp:\/\//i', $alt_forum_satir['resim'])) OR (preg_match('/^\//i', $alt_forum_satir['resim'])) )
				echo '<img width="30 border="0" src="'.$alt_forum_satir['resim'].'" alt="Forum Simgesi">';
			else echo '<img width="30 border="0" src="../'.$alt_forum_satir['resim'].'" alt="alt forum">';
			echo'</td>

			<td align="left" class="liste-veri">
			<a href="../forum.php?f='.$alt_forum_satir['id'].'">'.$alt_forum_satir['forum_baslik'].'</a><br>'.$alt_forum_satir['forum_bilgi'].'
			</td>

			<td align="center" width="76" class="liste-veri">
			<p><a href="forum_duzen.php?kip=forum_duzenle&amp;fno='.$alt_forum_satir['id'].'">düzenle</a>
			</td>

			<td align="center" width="68" class="liste-veri">
			<p><a href="forum_sil.php?kip=forum_sil&amp;fno='.$alt_forum_satir['id'].'">sil / taşı</a>
			</td>

			<td align="center" width="75" class="liste-veri">
			<p><a href="bilesenler/forum_duzen_yap.php?kip=forum_yukari&amp;dalno='.$alt_forum_satir['dal_no'].'&amp;fno='.$alt_forum_satir['id'].'&amp;altforum='.$forum_satir['id'].'&amp;yo='.$yo.'&amp;sira='.$alt_forum_satir['sira'].'"><i>yukarı al</i></a><p><a href="bilesenler/forum_duzen_yap.php?kip=forum_asagi&amp;dalno='.$alt_forum_satir['dal_no'].'&amp;fno='.$alt_forum_satir['id'].'&amp;altforum='.$forum_satir['id'].'&amp;yo='.$yo.'&amp;sira='.$alt_forum_satir['sira'].'"><i>aşağı al</i></a>
			</td>
			</tr>';
		}


		echo '
		</table>
		</td>
		</tr>
		';

	}


endwhile;




echo '
	<tr class="tablo_ici">
	<td width="50">&nbsp;</td>
	<td class="liste-veri" height="80" align="left" valign="middle">

<form action="bilesenler/forum_duzen_yap.php?yo='.$yo.'" method="post" name="yeni_forum">
<input type="hidden" name="kip" value="yeni_forum">
<input type="hidden" name="sira" value="sonsira">
<input type="hidden" name="dalno" value="'.$dallar_satir['id'].'">

<div style="position:relative;float:left;width:80px">&nbsp; <b>Başlık:</b></div>
<input class="formlar" type="text" name="forum_baslik" size="50" value="" style="width:320px;">
<br>

<div style="position:relative;float:left;width:80px">&nbsp; <b>Açıklama:&nbsp;&nbsp;</b></div>
<input class="formlar" type="text" name="forum_bilgi" size="50" value="" style="width:320px;">
<br>

<div style="position:relative;float:left;width:80px">&nbsp; <b>Alt Forum:</b></div>
<select name="alt_forum" class="formlar">
<option value="ust" selected="selected">ÜST FORUM OLUŞTUR
'.$ust_forumlar_formu.'
</select>
<br><br>

<input class="dugme" type="submit" value="Yeni forum oluştur" name="yeni_forum">
</form>
	</td>
	<td colspan="3">&nbsp;</td>
	</tr>
</table><br>';

endwhile;


?>


		<!--	TÜM FORUMLARIN SIRALANIŞI SONU		-->



<form action="bilesenler/forum_duzen_yap.php?yo=<?php echo $yo ?>" method="post" name="yeni_dal">
<input type="hidden" name="kip" value="yeni_dal">
&nbsp; <b>Yeni Forum Dalı Adı: </b>
<br>
&nbsp; <input class="formlar" type="text" name="ana_forum_baslik" value="" size="60">
<br>
<br>
&nbsp; <input class="dugme" type="submit" value="Oluştur" name="yeni_dal">
</form>


</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>