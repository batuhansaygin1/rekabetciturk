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
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';
$dosya_yolu = 'dosyalar/yuklemeler/';


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';



if ((isset($_GET['ara'])) AND ($_GET['ara'] != ''))
{
	$_GET['ara'] = @zkTemizle($_GET['ara']);

	// özel iletilerde aranıyor
	$vtsorgu = "SELECT id FROM $tablo_ozel_ileti WHERE ozel_icerik LIKE '%$_GET[ara]%' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$ozel = $vt->fetch_array($vtsonuc);

	if (isset($ozel['id'])) echo '<b>Var</b>';
	else echo 'Yok';
	exit();
}



//	DOSYA SİLME İŞLEMLERİ - BAŞI	//

elseif ((isset($_GET['sil'])) AND ($_GET['sil'] != ''))
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	// Veri rakam değilse hata ver
	if (!is_numeric($_GET['sil']))
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	// site kurucusu değilse hata ver
	if ($kullanici_kim['id'] != 1)
	{
		header('Location: hata.php?hata=151');
		exit();
	}

	// dosyanın bilgileri çekiliyor
	$vtsorgu = "SELECT id,dosya FROM $tablo_yuklemeler WHERE id='$_GET[sil]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$dosya = $vt->fetch_array($vtsonuc);

	// dosya yoksa hata ver
	if (!isset($dosya['id']))
	{
		header('Location: hata.php?hata=206');
		exit();
	}

	// dosya sunucudan siliniyor
	@unlink('../'.$dosya_yolu.$dosya['dosya']);

	// dosya girdisi veritabanından siliniyor
	$vtsorgu = "DELETE FROM $tablo_yuklemeler WHERE id='$_GET[sil]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=49');
	exit();
}

//	DOSYA SİLME İŞLEMLERİ - SONU	//



$sayfa_adi = 'Yönetim Dosya Yüklemeleri';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<script type="text/javascript">
<!-- //
function GonderAl(adres,katman){
var katman1 = document.getElementById(katman);
var veri_yolla = 'name=value';
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);

istek.onreadystatechange = function(){
if (istek.readyState == 4){
	if (istek.status == 200) katman1.innerHTML = istek.responseText;
	else katman1.innerHTML = '<font color="#ff0000"><b>Bağlantı Kurulamadı !</b></font>';}};
istek.send(veri_yolla);}

function ara(katman,veri){
adres = 'yuklemeler.php?ara='+veri;
var katman1 = document.getElementById(katman);
katman1.innerHTML = '<img src="../dosyalar/yukleniyor.gif" width="15" alt="Yü." title="Yükleniyor...">';
setTimeout("GonderAl('"+adres+"','"+katman+"')",1000);}
//  -->
</script>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Dosya Yüklemeleri</div>
<div class="kutu-icerik">


<?php

$sira = 1;
$tboyut = 0;

$vtsorgu = "SELECT * FROM $tablo_yuklemeler ORDER BY ";

if ((isset($_GET['uye'])) AND ($_GET['uye'] == '1')) $vtsorgu .= "uye_adi ASC";
elseif ((isset($_GET['uye'])) AND ($_GET['uye'] == '0')) $vtsorgu .= "uye_adi DESC";
elseif ((isset($_GET['tarih'])) AND ($_GET['tarih'] == '1')) $vtsorgu .= "tarih DESC";
elseif ((isset($_GET['tarih'])) AND ($_GET['tarih'] == '0')) $vtsorgu .= "tarih ASC";
elseif ((isset($_GET['ip'])) AND ($_GET['ip'] == '1')) $vtsorgu .= "ip ASC";
elseif ((isset($_GET['ip'])) AND ($_GET['ip'] == '0')) $vtsorgu .= "ip DESC";
elseif ((isset($_GET['boyut'])) AND ($_GET['boyut'] == '1')) $vtsorgu .= "boyut ASC";
elseif ((isset($_GET['boyut'])) AND ($_GET['boyut'] == '0')) $vtsorgu .= "boyut DESC";
else $vtsorgu .= "id ASC";

$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());



echo '
<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#dddddd">
	<tr class="forum_baslik">
	<td align="center" valign="top" colspan="2" height="25">';

if ((isset($_GET['uye']) AND ($_GET['uye'] == '1')))
	echo '<a href="yuklemeler.php?uye=0" style="color:#ffffff;text-decoration:none">Üye Adı &#9650;</a>';
elseif ((isset($_GET['uye'])) AND ($_GET['uye'] == '0'))
	echo '<a href="yuklemeler.php?uye=1" style="color:#ffffff;text-decoration:none">Üye Adı &#9660;</a>';
else echo '<a href="yuklemeler.php?uye=1" style="color:#ffffff;text-decoration:none">Üye Adı</a>';


echo '</td>
	<td align="center" width="130">';


if ((!isset($_GET['uye'])) AND (!isset($_GET['tarih'])) AND (!isset($_GET['ip'])) AND (!isset($_GET['boyut'])))
	echo '<a href="yuklemeler.php?tarih=1" style="color:#ffffff;text-decoration:none">Tarih &#9650;</a>';
elseif ((isset($_GET['tarih'])) AND ($_GET['tarih'] == '1'))
	echo '<a href="yuklemeler.php?tarih=0" style="color:#ffffff;text-decoration:none">Tarih &#9660;</a>';
elseif ((isset($_GET['tarih']) AND ($_GET['tarih'] == '0')))
	echo '<a href="yuklemeler.php?tarih=1" style="color:#ffffff;text-decoration:none">Tarih &#9650;</a>';
else echo '<a href="yuklemeler.php?tarih=0" style="color:#ffffff;text-decoration:none">Tarih</a>';


echo '</td>
	<td align="center" width="120">';


if ((isset($_GET['ip']) AND ($_GET['ip'] == '1')))
	echo '<a href="yuklemeler.php?ip=0" style="color:#ffffff;text-decoration:none">IP Adresi &#9650;</a>';
elseif ((isset($_GET['ip'])) AND ($_GET['ip'] == '0'))
	echo '<a href="yuklemeler.php?ip=1" style="color:#ffffff;text-decoration:none">IP Adresi &#9660;</a>';
else echo '<a href="yuklemeler.php?ip=1" style="color:#ffffff;text-decoration:none">IP Adresi</a>';


echo '</td>
	<td align="center" width="80">';


if ((isset($_GET['boyut']) AND ($_GET['boyut'] == '1')))
	echo '<a href="yuklemeler.php?boyut=0" style="color:#ffffff;text-decoration:none">Boyut &#9650;</a>';
elseif ((isset($_GET['boyut'])) AND ($_GET['boyut'] == '0'))
	echo '<a href="yuklemeler.php?boyut=1" style="color:#ffffff;text-decoration:none">Boyut &#9660;</a>';
else echo '<a href="yuklemeler.php?boyut=1" style="color:#ffffff;text-decoration:none">Boyut</a>';


echo '</td>
	<td align="center" width="40">Sil</td>
	<td align="center" width="40">Ara</td>
	<td align="center" width="40">Ö.Ara</td>
	<td align="center" width="40">Aç</td>
	</tr>
';




while ($yukleme = $vt->fetch_array($vtsonuc2)):

echo '
	<tr class="liste-veri" bgcolor="#ffffff" onMouseOver="this.bgColor= \'#e0e0e0\'" onMouseOut="this.bgColor= \'#ffffff\'">
	<td width="20" align="left">
<b>'.$sira.')</b>
	</td>

	<td align="left" height="25">
	<a href="../profil.php?u='.$yukleme['uye_id'].'">'.$yukleme['uye_adi'].'</a>
	</td>

	<td align="center">
'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yukleme['tarih']).'
	</td>

	<td align="center">
	<a href="ip_yonetimi.php?kip=1&amp;ip='.$yukleme['ip'].'">'.$yukleme['ip'].'</a>
	</td>

	<td align="right">'.NumaraBicim($yukleme['boyut']).' <b>kb</b></td>

	<td align="center">
	<a href="yuklemeler.php?sil='.$yukleme['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(\'Dosyayı ve girdiyi silmek istediğinize emin misiniz ?\')">Sil</a>
	</td>

	<td align="center">
	<a href="../arama.php?a=1&amp;b=1&amp;forum=tum&amp;tarih=tum_zamanlar&amp;sozcuk_hepsi='.$yukleme['dosya'].'" target="_blank">Ara</a>
	</td>

	<td align="center">
	<div id="oara-'.$yukleme['id'].'">
	<a href="javascript:void(0);" onclick="ara(\'oara-'.$yukleme['id'].'\', \''.$yukleme['dosya'].'\')">Ö.Ara</a>
	</div>
	</td>

	<td align="center">
	<a href="../'.$dosya_yolu.$yukleme['dosya'].'" target="_blank">Aç</a>
	</td>
	</tr>
';

$sira++;
$tboyut += $yukleme['boyut'];

endwhile;


echo '
	<tr class="tablo_ici">
	<td class="liste-veri" colspan="9">&nbsp;</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" colspan="9" class="liste-veri">
	<b>Toplam:</b>&nbsp; '.NumaraBicim($tboyut/1024, 2).' mb
	</td>
	</tr>';

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