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


if (!defined('PHPKF_ICINDEN')) exit();
define('DOSYA_BILDIRIM',true);
if (!defined('DOSYA_AYAR')) include $bldrm_dizin.'../ayar.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include $bldrm_dizin.'kullanici_kimlik.php';


//   ÜYE GİRİŞİ YAPILMIŞSA BİLDİRİMLERİNE BAKILIYOR   //

if (isset($kullanici_kim['id'])):
if (!defined('DOSYA_GERECLER')) include $bldrm_dizin.'gerecler.php';



// yöneticiler için ek sorgu
if ($kullanici_kim['yetki'] != 0) $eksorgu = "OR seviye='1' AND okundu='0'";
else $eksorgu = '';

$sorgu = "SELECT * FROM $tablo_bildirimler WHERE uye_id='$kullanici_kim[id]' AND okundu='0' AND seviye!='1' $eksorgu ORDER BY id";
$vtsonuc = $vt->query($sorgu) or die ($vt->hata_ver());

$bgoster = 0;
$jbilyazi = 'var cdizin = "; path='.$ayarlar['f_dizin']."\";\r\n";


// Bildirim varsa
if ($vt->num_rows($vtsonuc))
{
	$bozel = 0;
	$byorum = 0;
	$bonay = 0;
	$btsk = 0;
	$bcmsyorum = 0;
	$bsiparis = 0;
	$bodeme = 0;
	$bcvp = 0;
	$oozel = 0;
	$oyorum = 0;
	$oonay = 0;
	$otsk = 0;
	$ocmsyorum = 0;
	$osiparis = 0;
	$oodeme = 0;
	$ocvp = 0;
	$bsayi = 0;


	// çereze bakılıyor
	if (isset($_COOKIE['kfk_bildirim']))
	{
		if (preg_match('|1:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $oozel = $cerezoku[1];
		if (preg_match('|2:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $oyorum = $cerezoku[1];
		if (preg_match('|3:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $oonay = $cerezoku[1];
		if (preg_match('|4:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $otsk = $cerezoku[1];
		if (preg_match('|5:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $ocmsyorum = $cerezoku[1];
		if (preg_match('|6:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $osiparis = $cerezoku[1];
		if (preg_match('|7:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $oodeme = $cerezoku[1];
		if (preg_match('|8:([0-9]*?)_|si', $_COOKIE['kfk_bildirim'],$cerezoku)) $ocvp = $cerezoku[1];
	}



	while ($bildirim = $vt->fetch_assoc($vtsonuc))
	{
		if ($bildirim['tip'] == 1) $bozel++;
		elseif ($bildirim['tip'] == 2) $byorum++;
		elseif ($bildirim['tip'] == 3) $bonay++;
		elseif ($bildirim['tip'] == 4) $btsk++;
		elseif ($bildirim['tip'] == 5) $bcmsyorum++;
		elseif ($bildirim['tip'] == 6) $bsiparis++;
		elseif ($bildirim['tip'] == 7) $bodeme++;
		elseif ($bildirim['tip'] == 8) $bcvp++;
	}


	// özel ileti bildirimleri
	if ($bozel > 0)
	{
		if (($bozel == $oozel) OR ($bozel < $oozel))
		{
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE uye_id='$kullanici_kim[id]' AND tip='1' AND okundu='0' ORDER BY id LIMIT $oozel";
			$vtsonuc2 = $vt->query($sorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($bozel > $oozel) $bozel = $bozel - $oozel;
			$bsayi++;
			$bgoster += $bozel;
			$jbilyazi .= 'biltip['.$bsayi.'] = 1;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$bozel.';'."\r\n";

			$adres = $bldrm_dizin.'ozel_ileti.php';
			$yazi = $bozel.' Yeni özel ileti var<br>Okumak için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// profil yorum bildirimleri
	if ($byorum > 0)
	{
		if (($byorum == $oyorum) OR ($byorum < $oyorum))
		{
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE uye_id='$kullanici_kim[id]' AND tip='2' AND okundu='0' ORDER BY id LIMIT $oyorum";
			$vtsonuc2 = $vt->query($sorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($byorum > $oyorum) $byorum = $byorum - $oyorum;
			$bsayi++;
			$bgoster += $byorum;
			$jbilyazi .= 'biltip['.$bsayi.'] = 2;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$byorum.';'."\r\n";

			$adres = $bldrm_dizin.'profil.php#yorum';
			$yazi = $byorum.' Yeni yorum var<br>Okumak için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// onaysız yazı bildirimleri
	if ($bonay > 0)
	{
		if (($bonay == $oonay) OR ($bonay < $oonay))
		{
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE tip='3' AND okundu='0' ORDER BY id LIMIT $oonay";
			$vtsonuc2 = $vt->query($sorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($bonay > $oonay) $bonay = $bonay - $oonay;
			$bsayi++;
			$bgoster += $bonay;
			$jbilyazi .= 'biltip['.$bsayi.'] = 3;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$bonay.';'."\r\n";

			$adres = $bldrm_dizin.'onay.php';
			$yazi = $bonay.' Onaysız yazı var<br>Okumak için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// teşekkür bildirimleri
	if ($btsk > 0)
	{
		if (($btsk == $otsk) OR ($btsk < $otsk))
		{
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE uye_id='$kullanici_kim[id]' AND tip='4' AND okundu='0' ORDER BY id LIMIT $otsk";
			$vtsonuc2 = $vt->query($sorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($btsk > $otsk) $btsk = $btsk - $otsk;
			$bsayi++;
			$bgoster += $btsk;
			$jbilyazi .= 'biltip['.$bsayi.'] = 4;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$btsk.';'."\r\n";

			$adres = $bldrm_dizin.'profil_degistir.php?kosul=bildirim';
			$yazi = $btsk.' Yeni teşekkür edildi<br>Görmek için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// CMS yorum bildirimleri
	if ( ($bcmsyorum > 0) AND ($kullanici_kim['yetki'] == 1) )
	{
		if (($bcmsyorum == $ocmsyorum) OR ($bcmsyorum < $ocmsyorum))
		{
			$vtsorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE tip='5' AND okundu='0'";
			$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($bcmsyorum > $ocmsyorum) $bcmsyorum = $bcmsyorum - $ocmsyorum;
			$bsayi++;
			$bgoster += $bcmsyorum;
			$jbilyazi .= 'biltip['.$bsayi.'] = 5;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$bcmsyorum.';'."\r\n";

			$adres = $bldrm_dizin.'phpkf-yonetim/yorumlar.php';
			$yazi = $bcmsyorum.' Onaysız yorum var<br>Görmek için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// sipariş bildirimleri
	if ($bsiparis > 0)
	{
		if (($bsiparis == $osiparis) OR ($bsiparis < $osiparis))
		{
			$vtsorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE tip='6' AND okundu='0'";
			$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($bsiparis > $osiparis) $bsiparis = $bsiparis - $osiparis;
			$bsayi++;
			$bgoster += $bsiparis;
			$jbilyazi .= 'biltip['.$bsayi.'] = 6;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$bsiparis.';'."\r\n";

			$adres = $bldrm_dizin.'phpkf-yonetim/ozel_sayfa.php?s=phpkf-bilesenler/eklentiler/urunler/urunler_yonetim.php&siparisler';
			$yazi = $bsiparis.' Sipariş var<br>Görmek için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// ödeme bildirimi
	if ($bodeme > 0)
	{
		if (($bodeme == $oodeme) OR ($bodeme < $oodeme))
		{
			$vtsorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE tip='7' AND okundu='0'";
			$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($bodeme > $oodeme) $bodeme = $bodeme - $oodeme;
			$bsayi++;
			$bgoster += $bodeme;
			$jbilyazi .= 'biltip['.$bsayi.'] = 7;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$bodeme.';'."\r\n";

			$adres = $bldrm_dizin.'phpkf-yonetim/ozel_sayfa.php?s=phpkf-bilesenler/eklentiler/urunler/urunler_yonetim.php&siparisler';
			$yazi = $bodeme.' Ödeme var<br>Görmek için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}


	// cevap bildirimi
	if ($bcvp > 0)
	{
		if (($bcvp == $ocvp) OR ($bcvp < $ocvp))
		{
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE uye_id='$kullanici_kim[id]' AND tip='8' AND okundu='0' ORDER BY id LIMIT $ocvp";
			$vtsonuc2 = $vt->query($sorgu2) or die ($vt->hata_ver());
		}
		else
		{
			if ($bcvp > $ocvp) $bcvp = $bcvp - $ocvp;
			$bsayi++;
			$bgoster += $bcvp;
			$jbilyazi .= 'biltip['.$bsayi.'] = 8;'."\r\n";
			$jbilyazi .= 'bilsayi['.$bsayi.'] = '.$bcvp.';'."\r\n";

			$adres = $bldrm_dizin.'ymesaj.php';
			$yazi = $bcvp.' Yeni cevap var<br>Görmek için tıklayın';
			$jbilyazi .= 'bilyazi['.$bsayi.'] = \'<div class="bildirimk8"><a onclick="BKapat('.$bsayi.')" href="'.$adres.'">'.$yazi.'</a></div>\';'."\r\n";
		}
	}
}



//   BİLDİRİM VARSA   //

if ($bgoster > 0)
{
if ($temadizini == 'varsayilan') $css = '/css/sablon_bildirim.css';
else $css = '/sablon_bildirim.css';

echo '<link href="'.$bldrm_dizin.'temalar/'.$temadizini.$css.'" rel="stylesheet" type="text/css">
<div id="bildirimk1" style="top:-16px" align="center">
<div id="bildirimk2">
<div id="bildirimk3" onMouseOver="Bildirim(\'bildirimk1\',1)" title="Bildirim Var"><b id="bildirimsayi">'.$bgoster.'</b></div>
<div id="bildirimk4" onMouseOver="Bildirim(\'bildirimk1\',1)">
<div id="bildirimk5">
<div id="bildirimk6"><span id="bkapat" title="Bildirimi kapatmak için tıklayın" onclick="BKapat(1)">[X]</span></div>

<div class="bildirimk9">
<b id="byukari">&#9650;</b>
<div style="height:32px"></div>
<b id="basagi">&#9660;</b>
</div>

<div class="bildirimk7" id="bilyazi" onclick="Bildirim(\'bildirimk1\',4)"></div>

</div></div></div></div>
<script type="text/javascript"><!--//
var biltip = new Array();
var bilyazi = new Array();
var bilsayi = new Array();
'.$jbilyazi.'
// -->
</script>
<script type="text/javascript" src="'.$bldrm_dizin.'bilesenler/js/betik_bildirim.js"></script>';
}



// bildirim yoksa veya kapatılmışsa çerezleri sil
else
{
if (isset($_COOKIE['kfk_bildirim']))
{
echo '<script type="text/javascript"><!--//
'.$jbilyazi.'var sil = new Date();
sil.setFullYear(sil.getFullYear()-10);
document.cookie="kfk_bildirim=null;expires="+sil.toGMTString()+cdizin;
// -->
</script>';
}
}
endif;
if (!isset($ndtgao)){
$mvgst=true;echo SATIR2;}
?>