<?php
if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '3.00'))
{
	$tablo_forum_mesajlar = $tablo_mesajlar;
}
else
{
	// SEO durumu
	if ( (($ayarlar['seo'] == 1) OR ($ayarlar['seo'] == 2)) AND (!defined('PHPKF_SEO')) ) define('PHPKF_SEO',true);
	include_once($forum_dizin.'bilesenler/seo.php');

	$tablo_forum_mesajlar = $forum_tablo_oneki.'mesajlar';
}


// Konu sıralama seçimi
if ($ayarlar['forum_konular_blok_sira'] == 0) $sorgu_siralama= 'son_mesaj_tarihi DESC';
else $sorgu_siralama= 'tarih';


// Güncel konular alınıyor
$vtsorgu = "SELECT * FROM $tablo_forum_mesajlar WHERE silinmis='0' ORDER BY $sorgu_siralama LIMIT $ayarlar[forum_konular_blok_sayi]";
$vtsonuc_fkb = $vt->query($vtsorgu) or die ($vt->hata_ver());


// Güncel konular döngü
while ($guncel_konu = $vt->fetch_assoc($vtsonuc_fkb))
{
	if (strlen($guncel_konu['mesaj_baslik']) > $ayarlar['forum_konular_blok_baslik'])
	$forum_konular_baslik = mb_substr($guncel_konu['mesaj_baslik'], 0, $ayarlar['forum_konular_blok_baslik'],'UTF-8').'...';
	else $forum_konular_baslik = $guncel_konu['mesaj_baslik'];

	$guncel_konular[$guncel_konu['id']] = $guncel_konu;

	$guncel_konular[$guncel_konu['id']]['mesaj_baslik_link'] = '<a href="'.$forum_dizin.linkver('konu.php?k='.$guncel_konu['id'],$guncel_konu['mesaj_baslik']).'"><b>'.$forum_konular_baslik.'</b></a>';

	$guncel_konular[$guncel_konu['id']]['son_mesaj_tarihi'] = zaman('d.m.Y', $ayarlar['saat_dilimi'], false, $guncel_konu['son_mesaj_tarihi'], $ayarlar['tarih'], true);


	if ($guncel_konu['cevap_sayi'] == 0)
	{
		$guncel_konular[$guncel_konu['id']]['yazan_link'] = '<a href="'.$forum_dizin.linkver('profil.php?kim='.$guncel_konu['yazan'],$guncel_konu['yazan']).'">'.$guncel_konu['yazan'].'</a>';
	}

	else
	{
		$guncel_konular[$guncel_konu['id']]['yazan_link'] = '<a href="'.$forum_dizin.linkver('profil.php?kim='.$guncel_konu['son_cevap_yazan'],$guncel_konu['son_cevap_yazan']).'">'.$guncel_konu['son_cevap_yazan'].'</a>';
	}
}


echo '<style type="text/css" scoped="scoped">
@import url("phpkf-bilesenler/eklentiler/forum_konular_blok/forum_konular_blok_sablon.css");
</style>
<div class="son-konular"><ul>';

foreach ($guncel_konular as $guncel_konu)
{
echo '<li>'.$guncel_konu['mesaj_baslik_link'].'<br><span>Yazan: '.$guncel_konu['yazan_link'].'
&nbsp;('.$guncel_konu['son_mesaj_tarihi'].')</span></li>';
}
echo '</ul></div>';
?>