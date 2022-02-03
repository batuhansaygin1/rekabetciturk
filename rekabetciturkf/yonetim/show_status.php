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

$sayfa_adi = 'Yönetim MySQL Bilgileri';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">MySQL Bilgileri</div>
<div class="kutu-icerik">

<?php
//  MYSQL SUNUCUNUN ÇALIŞMA SÜRESİ ALINIYOR //

$vtsorgu = "SHOW STATUS LIKE 'Uptime'";

$vtsonuc = @$vt->query($vtsorgu) or die ($vt->hata_ver());
$mysql_calisma = $vt->fetch_assoc($vtsonuc);


$acilis = zonedate('d.m.Y - H:i:s', $ayarlar['saat_dilimi'], false, (time()-$mysql_calisma['Value']));

$gun = ($mysql_calisma['Value'] / 60 / 60 / 24);
settype($gun,'integer');
$saat = (($mysql_calisma['Value'] / 60 / 60 ) % 24);
$dakika = (($mysql_calisma['Value'] / 60 ) % 60);
$saniye = ($mysql_calisma['Value'] % 60);


echo '<br>
<b> &nbsp; MySQL sunucu çalışma süresi: &nbsp; </b>'.$gun.' gün, '.$saat.' saat, '.$dakika.' dakika ve '.$saniye.' saniye

<p><b> &nbsp; MySQL sunucu başlama zamanı: &nbsp; </b>'.$acilis.'
<br><br>

<table cellspacing="1" width="100%" cellpadding="4" border="0" align="left" bgcolor="#dddddd">';



//	MySQL BİLGİLERİ ÇEKİLİYOR	//

$vtsorgu = "SHOW STATUS";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

while ($show_status = $vt->fetch_array($vtsonuc))
{
    echo '
    <tr class="liste-veri" bgcolor="'.$yazi_tabani1.'" onMouseOver="this.bgColor= \''.$yazi_tabani2.'\'" onMouseOut="this.bgColor= \''.$yazi_tabani1.'\'">
    <td align="left" class="liste-etiket" width="35%">'.$show_status[0].'</td>
    <td align="left" class="liste-veri" width="65%">'.$show_status[1].'</td>
    </tr>';  
}
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