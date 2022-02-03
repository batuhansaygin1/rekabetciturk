<?php
/*
 +-===================================================-+
 |              php Kolay Forum (phpKF)                |
 +-----------------------------------------------------+
 |         EKLENTİ ADI    :  BENZER KONULAR            |
 |         EKLENTİ SÜRÜMÜ :  1.2                       |
 |         KODLAYAN       :  ADEM YILMAZ               |
 +-----------------------------------------------------+
 |    Telif - Copyright (c) 2007 - 2017 phpKF Ekibi    |
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
//  http://www.phpkf.com/k1897-benzer-konular.html



if (!defined('PHPKF_ICINDEN')) exit();



// Benzer Konular Eklenti bilgileri çekiliyor
$ekl_sorgu = "SELECT etkin FROM $tablo_eklentiler WHERE ad='benzer_konular' LIMIT 1";
$ekl_sonuc = $vt->query($ekl_sorgu) or die ($vt->hata_ver());
$ekl_satir = $vt->fetch_assoc($ekl_sonuc);



//   EKLENTİ ETKİNSE   //

if ($ekl_satir['etkin'] == 1):


// html karakterler ve bazı karakterler temizleniyor
$bul = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;', '&#34;', '\'', '\\', '/', '!', '..', '(', ')', '[', ']', ',', '?', '+');
$etiket = @str_replace($bul, '', $mesaj_satir['mesaj_baslik']);


// başlık parçalanıyor
$etiket = explode(' ',$etiket);


// 3 karakterden küçük sözcükler atılıyor ve sorgu hazırlanıyor
foreach ($etiket as $deger)
{
	if (strlen($deger) >= 3)
	{
		// silinmiş ve aynı konu hariç
		if (!isset($etiket_sozcukler))
		{
			$etiket_sozcukler = "*$deger* ";
			$konunun_etiketleri = '<a href="#'.$deger.'">'.$deger.'</a>';
		}


		else
		{
			// aynı sözcükler atılıyor
			if (!preg_match("/$deger/i", $etiket_sozcukler))
			{
				$etiket_sozcukler .= "*$deger* ";
				$konunun_etiketleri .= ', &nbsp; <a href="#'.$deger.'">'.$deger.'</a>';
			}
		}
	}
}


// arama sonucu 5 ile sınırlanıyor
if (isset($etiket_sozcukler)) $etiket_sorgu = "WHERE id!=$mesaj_satir[id] AND silinmis=0 AND MATCH (mesaj_baslik) AGAINST ('$etiket_sozcukler') LIMIT 5";


// sorgu boş ise
elseif (!isset($etiket_sozcukler)) $etiket_sorgu = 'LIMIT 0';


// etiket yoksa
if (!isset($konunun_etiketleri)) $konunun_etiketleri = 'Etiket Yok !';



// benzer konuların bilgileri çekiliyor
$vtsorgu = "SELECT id,yazan,mesaj_baslik,son_mesaj_tarihi,goruntuleme,cevap_sayi,hangi_forumdan FROM $tablo_mesajlar $etiket_sorgu";
$vtsonuc = $vt->query($vtsorgu);


$benzer_cikti = '
<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#d0d0d0" style="margin:0 auto;margin-top:20px">
	<tr>
	<td class="ana_forum_baslik" colspan="6" align="center" valign="middle">
Benzer konular
	</td>
	</tr>

	<tr class="forum_baslik">
	<td align="center" colspan="2">Başlık</td>
	<td align="center" width="100" class="mobil-gizle">Yazan</td>
	<td align="center" width="55" class="mobil-gizle">Cevap</td>
	<td align="center" width="70" class="mobil-gizle">Gösterim</td>
	<td align="center" width="135">Son ileti</td>
	</tr>

';


if ($vt->num_rows($vtsonuc))
{
	// konular sıralanıyor
	while ($benzer_konular = $vt->fetch_assoc($vtsonuc))
	{
		$benzer_cikti .= '
		<tr class="liste-veri">
		<td align="center" width="30" height="30" class="tablo_ici"><img '.$acik_konu.' alt="Konu Klasör"></td>

		<td align="left" class="tablo_ici">
		<a title="'.$benzer_konular['mesaj_baslik'].'" href="'.linkver('konu.php?k='.$benzer_konular['id'], $benzer_konular['mesaj_baslik']).'">'.$benzer_konular['mesaj_baslik'].'</a>
		</td>

		<td align="center" class="tablo_ici mobil-gizle">
		<a href="'.linkver('profil.php?kim='.$benzer_konular['yazan'],$benzer_konular['yazan']).'" title="Kullanıcı Profilini Görüntüle">'.$benzer_konular['yazan'].'</a>
		</td>

		<td align="center" class="tablo_ici mobil-gizle">'.$benzer_konular['cevap_sayi'].'</td>
		<td align="center" class="tablo_ici mobil-gizle">'.$benzer_konular['goruntuleme'].'</td>

		<td align="center" class="tablo_ici">
			'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $benzer_konular['son_mesaj_tarihi']).'
		</td>
		</tr>
		';
	}
}


else
{
	$benzer_cikti .= '
	<tr class="liste-veri">
	<td align="center" height="30" class="tablo_ici" colspan="6">
<b>Benzer konu yok</b>
	</td>
	</tr>
	';
}


$benzer_cikti .= '</table>';


// etiketler
$etiketler_cikti = '
<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" bgcolor="#d0d0d0" style="margin:0 auto;margin-top:7px">
	<tr class="tablo_ici">
	<td align="center" valign="middle" class="forum_baslik" height="25" width="70">Etiketler</td>
	<td align="left" valign="middle" class="liste-veri" height="25">&nbsp;&nbsp;'.$konunun_etiketleri.'</td>
	</tr>
	</table>
';




//   EKLENTİ KAPALIYSA   //

else:

$benzer_cikti = '';
$etiketler_cikti = '';

endif;

?>