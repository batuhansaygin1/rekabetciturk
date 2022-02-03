<?php
$phpkf_ayarlar_kip = "";
if (!defined('DOSYA_AYAR')) include_once('../../../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../../gerecler.php');
include_once('../../seo.php');


$yazan = $ayarlar['rss_bot_uye_adi']; // Yazan üye adı
$yazan_ad = $ayarlar['rss_bot_uye_gercek']; // Yazan ad-soyad
$yazan_id = $ayarlar['rss_bot_uye_id']; // Yazan üye id
$kackayit = $ayarlar['rss_bot_kota']; // Toplam kaç kayıt girilecek..


if (strlen($ayarlar['rss_bot_kaynak']) < 12)
{
	echo 'RSS kaynak girilmemis !';
	exit();
}

$tum_adresler = explode("\n", $ayarlar['rss_bot_kaynak']);

foreach ($tum_adresler as $tek_adres)
{
	if ( (isset($tek_adres)) AND (strlen($tek_adres)>12) )
	{
		$tek_adres = str_replace("\r", '', $tek_adres);
		$kaynaklar[] = array(
		'ad' => 'RSS',
		'adres' => $tek_adres,
		'kategori' => ','.$ayarlar['rss_bot_kat'].',',
		'haber_kaynak' => $ayarlar['rss_bot_ekyazi'],
		);
	}
}




// RSS Fonksiyonları - Başı //

function startElement($parser, $name, $attrs)
{
	global $rss_channel, $currently_writing, $main;

	$name = str_replace('?', 'I', utf8_decode($name));

	if ($name == "ENCLOSURE")
	{
		$rss_channel["ENCLOSURE"][] = $attrs["URL"];
	}

	switch($name)
	{
		case "RSS":
		case "RDF:RDF":
		case "ITEMS":
		$currently_writing = "";
		break;

		case "CHANNEL":
		$main = "CHANNEL";
		break;

		case "IMAGE":
		$main = "IMAGE";
		$rss_channel["IMAGE"] = array();
		break;

		case "ITEM":
		$main = "ITEMS";
		break;

		default:
		$currently_writing = $name;
		break;
	}
}


function endElement($parser, $name)
{
	global $rss_channel, $currently_writing, $item_counter;

	$name = str_replace('?', 'I', utf8_decode($name));

	$currently_writing = "";
	if ($name == "ITEM") {
		$item_counter++;
	}
}


function characterData($parser, $data)
{
	global $rss_channel, $currently_writing, $main, $item_counter, $kaynak_ad, $ayarlar;

	if ($currently_writing != "")
	{
		switch($main)
		{
			case "CHANNEL":
			if (isset($rss_channel[$currently_writing]))
			{
				$rss_channel[$currently_writing] .= $data;
			}
			else
			{
				$rss_channel[$currently_writing] = $data;
			}
			break;

			case "IMAGE":
			if (isset($rss_channel[$main][$currently_writing]))
			{
				$rss_channel[$main][$currently_writing] .= $data;
			}
			else
			{
				$rss_channel[$main][$currently_writing] = $data;
				if (($kaynak_ad == 'link_ekle') AND ($currently_writing == "LINK")) $rss_channel["ITEMS"][$item_counter][$currently_writing] = $data;
				if (($ayarlar['rss_bot_resim'] == '1') AND ($currently_writing == "URL"))$rss_channel["ENCLOSURE"][] = $data;
			}
			break;

			case "ITEMS":
			if (isset($rss_channel[$main][$item_counter][$currently_writing]))
			{
				$rss_channel[$main][$item_counter][$currently_writing] .= $data;
				if ($currently_writing == "CATEGORY") $rss_channel["ITEMS"][$item_counter][$currently_writing] .= $data;
			}
			else
			{
				$rss_channel[$main][$item_counter][$currently_writing] = $data;
				if ($currently_writing == "CATEGORY") $rss_channel["ITEMS"][$item_counter][$currently_writing] = $data;
			}
			break;
		}
	}
}

// RSS Fonksiyonları - Sonu //







//  RSS kaynakları alınıyor - başı  //

$toplam = 0;
foreach ($kaynaklar as $kaynak)
{
$ttoplam = 0;
$rss_channel = array();
$item_counter = 0;
$currently_writing = '';
$main = '';


$kaynak_ad = $kaynak['ad'];
$kadres = $kaynak['adres'];
$kategori = $kaynak['kategori'];
$haber_kaynak = $kaynak['haber_kaynak'];


$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");


if (!($fp = @fopen($kadres, 'r')))
{
	die('RSS XML dosyası açılamıyor: '.$kadres);
}

while ($data = fread($fp, 4096))
{
	if (!xml_parse($xml_parser, $data, feof($fp)))
	{
		die(sprintf("XML hata: %s satir %d",
		xml_error_string(xml_get_error_code($xml_parser)),
		xml_get_current_line_number($xml_parser)));
	}
}
xml_parser_free($xml_parser);





if ( ($kackayit != '0') AND ($item_counter > $kackayit)) $item_counter = $kackayit;


for($i=0; $i < $item_counter; $i++)
{
	$tarih = time();
	$link = $rss_channel["ITEMS"][$i]["LINK"];
	$baslik = $rss_channel["ITEMS"][$i]["TITLE"];
	$icerik = $rss_channel["ITEMS"][$i]["DESCRIPTION"];
	if (isset($rss_channel["ITEMS"][$i]["CATEGORY"])) $title = $rss_channel["ITEMS"][$i]["CATEGORY"];

	if ((isset($rss_channel["ENCLOSURE"][$i])) AND ($ayarlar['rss_bot_resim'] == '1'))
		$icerik = '<img src="'.$rss_channel["ENCLOSURE"][$i].'" alt="." /><br>'.$icerik;

	if ((isset($rss_channel["ITEMS"][$i]["LINK"])) AND ($ayarlar['rss_bot_link'] == '1'))
		$icerik = $icerik.'<br><a target="_blank" href="'.$rss_channel["ITEMS"][$i]["LINK"].'">Devamı için tıklayın...</a>';

	$icerik = $icerik.$haber_kaynak;


	// magic_quotes_gpc açıksa
	if (get_magic_quotes_gpc())
	{
		$baslik = @ileti_yolla(stripslashes(BoslukSil($baslik)), 3);
		$icerik = @ileti_yolla(stripslashes($icerik), 1);
	}

	// magic_quotes_gpc kapalıysa
	else
	{
		$baslik = @ileti_yolla(BoslukSil($baslik), 1);
		$icerik = @ileti_yolla($icerik, 1);
	}


	//  Etiket ve Adres işlemleri - başı  //
	$yadres = sefyap($baslik);
	$etiket = $baslik;

	$bul = array(' ', ',', '&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;', '&#34;', '\'', '\\', '/', '!', '.', '(', ')', '[', ']', ',', '?', '+', ':', '"', '’', '´', '`');
	$etiket = str_replace($bul, ',', $etiket);
	$etiket = explode(',', $etiket);
	$etiketler = '';

	foreach ($etiket as $etiketdepo)
	{
		$etiketdepo = BoslukSil($etiketdepo);
		$etiketdepo = preg_replace('/^(daki|deki|taki|teki|den|dan|ten|tan|nden|ndan)$/i', '', $etiketdepo);
		if (strlen($etiketdepo) > 2) $etiketler .= $etiketdepo.',';
	}
	//  Etiket ve Adres işlemleri - sonu  //


	// Veritabanına kayıt girilmeden evvel, daha önce aynı konu başlığı ile giriş yapılmışmı ona bakılıyor...
	$vtsorgu = "SELECT id FROM $tablo_yazilar WHERE baslik='$baslik' AND kategori='$kategori' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu);
	$Kontrol = $vt->fetch_assoc($vtsonuc);

	if (empty($Kontrol)) // Konu, veritabanına daha evvel işlenmemişse buraya giriliyor.
	{
		$vtsorgu = "INSERT INTO $tablo_yazilar (tip,kategori,alt_yazi,sayfa_no,tarih,yayin_tarihi,yazan,yazan_id,yazan_ip,yorum_durum,adres,etiket,baslik,icerik)
		VALUES('2','$kategori','0','0','$tarih','$tarih','$yazan;$yazan_ad','$yazan_id','127.0.0.1','1','$yadres','$etiketler','$baslik','$icerik')";
		$vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam++;
		$ttoplam++;
	}

} // for döngü sonu

echo '<br>'.$rss_channel['TITLE'].' : '.$ttoplam;

} // foreach döngü sonu

//  RSS kaynakları alınıyor - sonu  //


echo '<br><br>'.$toplam.' Kayıt veritabanına işlendi...';

?>