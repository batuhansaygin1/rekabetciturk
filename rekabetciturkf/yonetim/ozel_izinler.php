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

if (empty($_GET['sayfa'])) $_GET['sayfa'] = 0;
else 	$_GET['sayfa'] = @zkTemizle($_GET['sayfa']);

if (empty($_GET['kul_ara'])) $_GET['kul_ara'] = '%';
else
{
	$_GET['kul_ara'] = @zkTemizle(trim($_GET['kul_ara']));
	$_GET['kul_ara'] = @str_replace('*','%',$_GET['kul_ara']);
}


$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar ORDER BY id";
$forumlar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

//	forum adları alınıyor
while ($forumlar_satir = $vt->fetch_assoc($forumlar_sonuc))
{
	$fid = $forumlar_satir['id'];
	$forum_baslik[$fid] = $forumlar_satir['forum_baslik'];
}



//	SORGU SONUCUNDAKİ TOPLAM SONUÇ SAYISI ALINIYOR	//

$vtsonuc9 = $vt->query("SELECT kulid FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%'") or die ($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc9);

$ozelizinler_kota = 30;

$toplam_sayfa = ($satir_sayi / $ozelizinler_kota);
settype($toplam_sayfa,'integer');

if (($satir_sayi % $ozelizinler_kota) != 0) $toplam_sayfa++;



//	ÖZEL İZİNLİ KULLANICILARIN BİLGİLERİ ÇEKİLİYOR	//

if ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'fnoters'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY fno DESC LIMIT $_GET[sayfa],$ozelizinler_kota";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'ad_AdanZye'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY kulad LIMIT $_GET[sayfa],$ozelizinler_kota";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'ad_ZdenAya'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY kulad DESC LIMIT $_GET[sayfa],$ozelizinler_kota";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'izinegore'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY yonetme DESC, fno LIMIT $_GET[sayfa],$ozelizinler_kota";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'grup'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY grup DESC, fno LIMIT $_GET[sayfa],$ozelizinler_kota";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

else
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY fno LIMIT $_GET[sayfa],$ozelizinler_kota";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$_GET['sirala'] = '';
}

$sayfa_adi = 'Yönetim Özel izinli Üye ve Gruplar';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');

?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Özel izinli Üye ve Gruplar</div>
<div class="kutu-icerik">


<form action="ozel_izinler.php" name="kul_ara" method="get">

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-veri" valign="bottom" height="35" align="left">
<input class="formlar" type="text" name="kul_ara" size="20" maxlength="20" value="<?php
echo str_replace('%','*',$_GET['kul_ara'])
?>">
&nbsp;<input type="submit" value="Ara" class="dugme">
	</td>
	<td class="liste-veri" valign="bottom" align="right">
<select name="sirala" class="formlar">
<option value="1">Forum Sırasına göre

<option value="fnoters" <?php if ( (isset($_GET['sirala'])) AND ($_GET['sirala'] == 'fnoters') ) echo 'selected="selected"' ?>>
Forum Sırasına göre tersten

<option value="ad_AdanZye" <?php if ( (isset($_GET['sirala'])) AND ($_GET['sirala'] == 'ad_AdanZye') ) echo 'selected="selected"' ?>>
Kullanıcı adına göre A'dan Z'ye

<option value="ad_ZdenAya" <?php if ( (isset($_GET['sirala'])) AND ($_GET['sirala'] == 'ad_ZdenAya') ) echo 'selected="selected"' ?>>
Kullanıcı adına göre Z'den A'ya

<option value="izinegore" <?php if ( (isset($_GET['sirala'])) AND ($_GET['sirala'] == 'izinegore') ) echo 'selected="selected"' ?>>
Yetkisine göre(Yardımcılar önde)

<option value="grup" <?php if ( (isset($_GET['sirala'])) AND ($_GET['sirala'] == 'grup') ) echo 'selected="selected"' ?>>
Gruplar önde

</select>
&nbsp;<input type="submit" value="üyeleri sırala" class="dugme">
	</td>
	</tr>
	
	<tr>
	<td colspan="2">

<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" class="tablo_border4">
	<tr class="forum_baslik">
	<td align="center" width="30">&nbsp;</td>
	<td align="center">Üye - Grup Adı</td>
	<td align="center" width="220">Forum Adı</td>
	<td align="center" width="45">Okuma</td>
	<td align="center" width="45">Konu</td>
	<td align="center" width="45">Cevap</td>
	<td align="center" width="50">Yönetme</td>
	</tr>

<?php

if ($satir_sayi == 0):

echo '<tr class="liste-etiket" bgcolor="'.$yazi_tabani1.'">
	<td colspan="9" align="center" height="70" valign="center">
Aradığınız koşula uyan özel izinli üye yok !
	</td>
	</tr>';

endif;


while ($ozelizinler_satir = $vt->fetch_array($vtsonuc2)):

	echo '<tr class="liste-veri" bgcolor="'.$yazi_tabani1.'" onMouseOver="this.bgColor= \''.$yazi_tabani2.'\'" onMouseOut="this.bgColor= \''.$yazi_tabani1.'\'">';


	if ($ozelizinler_satir['grup'] == 0)
		echo '<td align="center">
		<a href="kullanici_degistir.php?u='.$ozelizinler_satir['kulid'].'" title="Kullanıcı profilini değiştir"><img alt="değiştir" '.$simge_degistir.'></a>
		</td>

		<td align="left" title="Kullanıcı yetkilerini değiştir"><b>Üye:</b>
&nbsp;&nbsp;<a href="kul_izinler.php?kim='.$ozelizinler_satir['kulad'].'">'.$ozelizinler_satir['kulad'].'</a>';


	else echo '<td align="center" width="30">
	<a href="gruplar.php?duzenle='.$ozelizinler_satir['grup'].'#duzenle" title="Grubu Düzenle"><img alt="değiştir" '.$simge_degistir.'></a>
	</td>

	<td align="left" title="Grup yetkilerini değiştir"><b>Grup:</b>
&nbsp;<a href="kul_izinler.php?grup='.$ozelizinler_satir['grup'].'">'.$ozelizinler_satir['kulad'].'</a>';

?>
	</td>
	<td align="left">
<?php echo '<a href="../forum.php?f='.$ozelizinler_satir['fno'].'">'.$forum_baslik[$ozelizinler_satir['fno']].'</a>' ?>
	</td>
	<td align="center">
<?php if ($ozelizinler_satir['okuma'] == 1) echo 'var'; else echo '<b>yok</b>'; ?>
	</td>
	<td align="center">
<?php if ($ozelizinler_satir['konu_acma'] == 1) echo 'var'; else echo '<b>yok</b>'; ?>
	</td>
	<td align="center">
<?php if ($ozelizinler_satir['yazma'] == 1) echo 'var'; else echo '<b>yok</b>'; ?>
	</td>
	<td align="center">
<?php if ($ozelizinler_satir['yonetme'] == 1) echo 'var'; else echo '<b>yok</b>'; ?>
	</td>
	</tr>

<?php endwhile; ?>

</table>
<br>




<!--	SAYFALAR BAŞLANGIÇ		-->

<span id="sayfalama">
<?php if ($satir_sayi > $ozelizinler_kota): ?>
<table cellspacing="1" cellpadding="2" border="0" align="right" class="tablo_border">
	<tr>
	<td class="forum_baslik">
Toplam <?php echo $toplam_sayfa; ?> Sayfa:&nbsp;
	</td>
<?php
if ($_GET['sayfa'] != 0)
{
	echo '<td bgcolor="#ffffff" class="liste-veri" title="ilk sayfaya git">';
	echo '&nbsp;<a href="ozel_izinler.php?sayfa=0&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&laquo;ilk</a>&nbsp;</td>';
	
	echo '<td bgcolor="#ffffff" class="liste-veri" title="önceki sayfaya git">';
	echo '&nbsp;<a href="ozel_izinler.php?sayfa='.($_GET['sayfa'] - $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&lt;</a>&nbsp;</td>';
}

for ($sayi=0,$sayfa_sinir=$_GET['sayfa']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['sayfa'] / $ozelizinler_kota) - 3))	{	}
	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['sayfa'] + 8)) {break;}
		if (($sayi == 0) and ($_GET['sayfa'] == 0))
		{
			echo '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
			echo '&nbsp;<b>[1]</b>&nbsp;</td>';
		}

		elseif (($sayi + 1) == (($_GET['sayfa'] / $ozelizinler_kota) + 1))
		{
			echo '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
			echo '&nbsp;<b>['.($sayi + 1).']</b>&nbsp;</td>';
		}

		else
		{
			echo '<td bgcolor="#ffffff" class="liste-veri" title="'.($sayi + 1).' numaralı sayfaya git">';

			echo '&nbsp;<a href="ozel_izinler.php?sayfa='.($sayi * $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">'.($sayi + 1).'</a>&nbsp;</td>';
		}
	}
}
if ($_GET['sayfa'] < ($satir_sayi - $ozelizinler_kota))
{
	echo '<td bgcolor="#ffffff" class="liste-veri" title="sonraki sayfaya git">';
	echo '&nbsp;<a href="ozel_izinler.php?sayfa='.($_GET['sayfa'] + $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&gt;</a>&nbsp;</td>';

	echo '<td bgcolor="#ffffff" class="liste-veri" title="son sayfaya git">';
	echo '&nbsp;<a href="ozel_izinler.php?sayfa='.(($toplam_sayfa - 1) * $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">son&raquo;</a>&nbsp;</td>';
}

echo '</tr>
</table>';

endif;
?>
</span>

<!--	SAYFALAR BİTİŞ		-->


<div class="liste-veri" align="left"><font size="1">
Aradığınız koşula uyan özel izinli üye ve grup sayısı: <b><?php echo $satir_sayi ?></b>
<br>Yönetme yetkisi verilen üye o bölümün yardımcısı olur.
</font></div>


</td></tr></table>
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