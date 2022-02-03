<?php

@ini_set('magic_quotes_runtime', 0);

if (!defined('DOSYA_AYAR')) include 'ayar.php';
if (!defined('DOSYA_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_TEMA_SINIF')) include_once('bilesenler/tema_sinif.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'bilesenler/kullanici_kimlik.php';

@$kullanici = $kullanici_kim['kullanici_adi'];
// Sayfalama başı

$limit = 10; // her sayfada gösterilecek arkadaş limiti
 
@$sayfa = $_GET["sayfa"];
 
if(($sayfa=="") or !is_numeric($sayfa)){ // sayfa değeri boş veya rakam değilse sayfa değerini 1 yap
 $sayfa=1; 
}
if($sayfa < 1) { // sayfa değeri 1 den azsa 1 e beraber et
$sayfa = 1; 
}

$sor = "select * from $tablo_istekler where arkadas = '$kullanici'";
@$cevap = $vt->query($sor);
@$satirsayisi = $vt->num_rows($cevap);

$toplam_sayfa = ceil($satirsayisi / $limit);
 if($sayfa > $toplam_sayfa)
{
 $sayfa = $toplam_sayfa; 
 }
$baslangic   = ($sayfa-1) * $limit;

$sayfa_goster = 5; // gösterilecek sayfa sayısı
 
$en_az_orta = ceil($sayfa_goster/2);
$en_fazla_orta = ($toplam_sayfa+1) - $en_az_orta;
 
$sayfa_orta = $sayfa;
if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
 
$sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
$sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta); 
 
if($sol_sayfalar < 1) $sol_sayfalar = 1;
if($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;
 // sayfa 1 e beraber değilse Önce ve İlk sayfa ekleniyor
 $sayfalama = '';
if($sayfa != 1) $sayfalama .= '<button type="button" class="btn btn-primary" onclick="window.location=\'?sayfa=1\'">İlk sayfa</button> ';
if($sayfa != 1) $sayfalama .= '<button type="button" class="btn btn-primary" onclick="window.location=\'?sayfa='.($sayfa-1).'\'">Önceki</button> ';
// sayafalara geçiş için butonlara numara yazdırılıyor
for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
    if($sayfa == $s) {
        $sayfalama .= '<font color="black">Sayfa: ' . $s . ' </font>';
    } else {
        $sayfalama .= '<button type="button" class="btn btn-primary" onclick="window.location=\'?sayfa='.$s.'\'">'.$s.'</button> ';
    }
}
 
if($sayfa != $toplam_sayfa) $sayfalama .= '<button type="button" class="btn btn-primary" onclick="window.location=\'?sayfa='.($sayfa+1).'\'">Sonraki</button> ';
if($sayfa != $toplam_sayfa) $sayfalama .= '<button type="button" class="btn btn-primary" onclick="window.location=\'?sayfa='.$toplam_sayfa.'\'">Son sayfa</button> ';
$sayfalama .= '</br>';
// Sayfalama sonu
$yazdir = "select * from $tablo_istekler where arkadas = '$kullanici' order by id DESC LIMIT $baslangic,$limit";
@$vtsonuc = $vt->query($yazdir);
@$a_sayi = $vt->num_rows($vtsonuc);
// Arkadaş ekleme bildirimi varsa okundu olarak işaretleniyor
$vtsorgub = "UPDATE $tablo_bildirimler SET okundu='1' WHERE uye_id='$kullanici_kim[id]' AND tip='20' AND okundu='0' ORDER BY id LIMIT 1";
$vtsonucb = $vt->query($vtsorgub) or die ($vt->hata_ver());

while($al = @$vt->fetch_array($vtsonuc))
{
$arkadas = $al["kullanici_adi"];
// kullanıcı bilgisi çekiliyor
$vtsorgus = "SELECT id,resim FROM $tablo_kullanicilar WHERE kullanici_adi='$arkadas'";
$vtsonucs = $vt->query($vtsorgus) or die ($vt->hata_ver());
$arkadasi = $vt->fetch_assoc($vtsonucs);


// kullanıcı resmi
if ($arkadasi['resim'] != '') $resim = $arkadasi['resim'];
elseif ($ayarlar['kul_resim'] != '') $resim = $ayarlar['kul_resim'];
else $resim = '';

$tekli[] = array('{K_ADI}' => $arkadas,
'{RESIM}' => $resim);
}

$renkver = 1;
$sayfa_adi = 'Arkadaşlık isteği sayfası';
include_once('bilesenler/sayfa_baslik.php');

//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'eklentiler/arkadaslik_sistemi/tema_dosyasi/istekler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));

if (isset($tekli)) $ornek1->tekli_dongu('1',$tekli); 
if($a_sayi > 0)
{
$ornek1->kosul('2', array(''=>''), false);
}else{
$ornek1->kosul('2', array(''=>''), true);
$ornek1->kosul('1', array(''=>''), false);
}
$ornek1->dongusuz(array('{ISTEK_SAYI}' => $satirsayisi,
'{SAYFALAMA}' => $sayfalama));

eval(TEMA_UYGULA);
?>