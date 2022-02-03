<?php
/*
 +-===================================================-+
 |              php Kolay Forum (phpKF)                |
 +-----------------------------------------------------+
 |         EKLENTİ ADI    :  FORUM İÇİN ANKET          |
 |         EKLENTİ SÜRÜMÜ :  1.2                       |
 |         KODLAYAN       :  ADEM YILMAZ               |
 +-----------------------------------------------------+
 |    Telif - Copyright (c) 2007 - 2015 Adem YILMAZ    |
 |      http://www.phpkf.com   -   phpkf@phpkf.com     |
 |      Tüm hakları saklıdır - All Rights Reserved     |
 +-----------------------------------------------------+
 |  Bu eklenti için phpKF telif maddeleri geçerlidir.  |
 |  Emeğe saygı göstererek bu kurallara uyunuz ve      |
 |  bu bölümü silmeyiniz.                              |
 |                                                     |
 |  http://www.phpkf.com/telif.php                     |
 +-===================================================-+*/


//  Bu eklenti ile ilgili sayfanın adresi
//  http://www.phpkf.com/k1896-forum-icin-anket.html




if (!defined('PHPKF_ICINDEN')) exit();



// Forum için Anket Eklenti bilgileri çekiliyor
$ekl_sorgu = "SELECT etkin FROM $tablo_eklentiler WHERE ad='forum_anket' LIMIT 1";
$ekl_sonuc = $vt->query($ekl_sorgu) or die ($vt->hata_ver());
$ekl_satir = $vt->fetch_assoc($ekl_sonuc);


//   EKLENTİ ETKİNSE   //

$anket_cikti = '';

if ($ekl_satir['etkin'] == 1)
{
	// dosyalar dahil ediliyor
	if (!defined('DOSYA_AYAR')) include 'ayar.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'kullanici_kimlik.php';

	$tablo_portal_anketsoru = $tablo_oneki.'portal_anketsoru';
	$tablo_portal_anketsecenek = $tablo_oneki.'portal_anketsecenek';


	if (isset($_GET['k'])) $vtsorgu_anket_yeri = "forum_yer='tum' OR forum_yer='k-$_GET[k]'";
	elseif (isset($_GET['f'])) $vtsorgu_anket_yeri = "forum_yer='tum' OR forum_yer='f-$_GET[f]'";
	else $vtsorgu_anket_yeri = "forum_yer='tum'";


	// ANKET BİLGİLERİ ÇEKİLİYOR //

	$vtsorgu = "SELECT * FROM $tablo_portal_anketsoru where $vtsorgu_anket_yeri";
	$anksonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while ($anket_satir = $vt->fetch_assoc($anksonuc))
	{
		$secenek_durum = '';
		$oyver_dugmesi = '';

		// ANKETİN OY TOPLAMI ALINIYOR  //

		$vtsorgu = "SELECT SUM(oylar) as toplam_oy FROM $tablo_portal_anketsecenek where anketno='$anket_satir[anketno]'";
		$toplamoy_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplamoy_satir = $vt->fetch_assoc($toplamoy_sonuc);
		$toplam_oy = $toplamoy_satir['toplam_oy'];


		//  ANKET SEÇENEK VE DÜĞME ETKİN DURUMU //

		if ($anket_satir['anket_durum'] == 0)
		{
			$oyizni = false;
			$oyver_dugmesi .= '<input type="submit" class="dugme" name="oyver" value="Oy Ver" disabled="disabled">';
		}

		elseif (empty($kullanici_kim['id']))
		{
			$oyizni = false;
			$oyver_dugmesi .= '<input type="submit" class="dugme" name="oyver" value="Oy Ver" disabled="disabled">';
		}

		elseif (!preg_match("/,$kullanici_kim[id],/", $anket_satir['oy_kullanan_id']))
		{
			$oyizni = true;
			$oyver_dugmesi .= '<input type="submit" class="dugme" name="oyver" value="Oy Ver">';
		}

		else
		{
			$oyizni = false;
			$oyver_dugmesi .= '<input type="submit" class="dugme" name="oyver" value="Oy Ver" disabled="disabled">';
		}




		// ANKET SEÇENEK OYLAMA BİLGİLERİ ÇEKİLİYOR //

		$vtsorgu = "SELECT * FROM $tablo_portal_anketsecenek where anketno='$anket_satir[anketno]' ORDER BY secenekno";
		$anketler_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$dongu = 0;


		// anketin seçenekleri sıralanıyor
		while ($anket_sonuc = $vt->fetch_assoc($anketler_sonuc))
		{
			if ($dongu == 0) $isaretli = ' checked="checked"';
			else $isaretli = '';

			$secenek_durum .= '<tr class="tablo_ici">
			<td class="liste-veri" align="left" height="25"><label style="cursor: pointer;">';

			if ($oyizni == true) $secenek_durum .= '<input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'"'.$isaretli.'>&nbsp;';

			else $secenek_durum .= '<input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" disabled="disabled">&nbsp;';


			$secenek_durum .= $anket_sonuc['secenek'].'</label>
			</td><td class="liste-veri" align="center">'.$anket_sonuc['oylar'].'</td>';


			// toplam ve ilgili oy sıfırdan büyükse
			if ( ($toplam_oy > 0) AND ($anket_sonuc['oylar'] > 0) )
			{
				$secenek_orani = 100 / ($toplam_oy / $anket_sonuc['oylar']);
				settype($secenek_orani,'integer');
			}

			else $secenek_orani = 1;


			$secenek_durum .= '<td class="tablo_ici" align="center" valign="middle">
			<div class="liste-veri" style="width:110px; float: right">
			<div class="oran_dis" align="left"><div class="oran_ic" style="width: '.$secenek_orani.'px"></div></div>
			</div>
			</td>
			</tr>';

			$dongu++;
		}


		$anket_cikti .= '
		<form method="post" action="portal/anket.php?kosul=oy_ver" name="anket_form">
		<input type="hidden" name="anketno" value="'.$anket_satir['anketno'].'">


		<table width="480" border="0" cellpadding="2" cellspacing="1" bgcolor="#dddddd" align="center">
		<tr class="tablo_ici">
		<td class="ana_forum_baslik" align="center" valign="middle" colspan="3">ANKET</td>
		</tr>

		<tr>
		<td class="forum_baslik" align="center" width="318">Seçenekler</td>
		<td class="forum_baslik" align="center" width="50">Oy</td>
		<td class="forum_baslik" align="center" width="112">Oran</td>
		</tr>

		<tr class="tablo_ici">
		<td class="liste-etiket" align="center" valign="middle" colspan="3" height="33">
		'.$anket_satir['anket_soru'].'
		</td>
		</tr>

		'.$secenek_durum.'
		<tr class="tablo_ici">
		<td class="liste-etiket" align="center" valign="middle" height="33">
		'.$oyver_dugmesi.'
		</td>
		<td class="liste-etiket" align="center" valign="middle" colspan="2">
		Toplam Oy: '.$toplam_oy.'
		</td>
		</tr>';



		// anket kapalıysa
		if ($anket_satir['anket_durum'] == 0)
		$anket_cikti .= '
		<tr class="tablo_ici">
		<td class="liste-etiket" align="center" valign="middle" colspan="3" height="30">
		<font color="#ff0000">Bu anket oylamaya kapatılmıştır !</font>
		</td>
		</tr>';



		$anket_cikti .= '
		<tr class="tablo_ici">
		<td class="liste-veri" align="center" valign="middle" colspan="3" height="30">
		<a href="portal/anket.php?anketno='.$anket_satir['anketno'].'">Ankete yorum yazmak veya yazılan yorumları görmek için tıklayın.</a>
		</td></tr></table>
		</form><br>';
	}
}


// Çıktı başlık altına ekleniyor
$baslik_en_alt .= $anket_cikti;

?>