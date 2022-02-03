<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

echo '
<!-- Sol bloklar baş -->
<div class="phpkf-blok-gizle sol-goster" onclick="BlokGizle(1)">&raquo;</div>
<div class="sol-blok">
<div class="phpkf-blok-gizle sol-gizle" onclick="BlokGizle(1)">&raquo;</div>
<div class="phpkf-blok-kutusu" id="yonetimMenu">

<div class="kutu-baslik">'.$lymenu['yonetim_menu'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="index.php">'.$lymenu['anasayfa'].'</a></li>
<li><a href="baglantilar.php">'.$lymenu['baglantilar'].'</a></li>
<li><a href="duyurular.php">'.$lymenu['duyurular'].'</a></li>
<li><a href="yuklemeler.php">'.$lymenu['yuklemeler'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['bolum_yonetimi'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="forumlar.php">'.$lymenu['forum_duzenleme'].'</a></li>
<li><a href="fizinler.php">'.$lymenu['forum_izinleri'].'</a></li>
<li><a href="temizleme.php">'.$lymenu['forum_temizleme'].'</a></li>
<li><a href="silinmis.php">'.$lymenu['silinen_iletiler'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['ayarlar'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="ayarlar.php">'.$lymenu['genel'].'</a></li>
<li><a href="ayarlar.php?kip=uyelik">'.$lymenu['uyelik'].'</a></li>
<li><a href="ayarlar.php?kip=eposta">'.$lymenu['eposta'].'</a></li>
<li><a href="ayarlar.php?kip=ozel_ileti">'.$lymenu['ozel_ileti'].'</a></li>
<li><a href="ayarlar.php?kip=yukleme">'.$lymenu['yukleme'].'</a></li>
<li><a href="ayarlar.php?kip=duzenleyici">'.$lymenu['duzenleyici'].'</a></li>
<li><a href="ayarlar.php?kip=cms">'.$lymenu['cms_ve_portal'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['gorunum'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="temalar.php">'.$lymenu['temalar'].'</a></li>
<li><a href="javascript:void(0)">'.$lymenu['tema_yukle'].'</a></li>
<li><a href="javascript:void(0)">'.$lymenu['tema_ayarlari'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['eklenti'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="eklentiler.php">'.$lymenu['eklentiler'].'</a></li>
<li><a href="eklentiler.php?kip=yukle">'.$lymenu['eklenti_yukle'].'</a></li>
<li><a href="eklentiler.php?kip=ayarlar">'.$lymenu['ayarlar'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['uyeler'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="uyeler.php">'.$lymenu['uyeler'].'</a></li>
<li><a href="yeni_uye.php">'.$lymenu['yeni_uye_ekle'].'</a></li>
<li><a href="ozel_izinler.php">'.$lymenu['ozel_izinler'].'</a></li>
<li><a href="ip_yonetimi.php">'.$lymenu['ip_yonetimi'].'</a></li>
<li><a href="yasaklamalar.php">'.$lymenu['yasaklamalar'].'</a></li>
<li><a href="toplu_posta.php">'.$lymenu['toplu_eposta'].'</a></li>
<li><a href="../'.$dosya_cevrimici.'">'.$lymenu['cevrimici_ziyaretciler'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['grup_yonetimi'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="gruplar.php">'.$lymenu['uye_gruplari'].'</a></li>
<li><a href="kul_izinler.php">'.$lymenu['uye_ve_grup_izinleri'].'</a></li>
<li><a href="ozel_izinler.php">'.$lymenu['grup_izinleri'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['veritabani'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="vt_yedek.php">'.$lymenu['yedekleme'].'</a></li>
<li><a href="vt_yukle.php">'.$lymenu['geri_yukle'].'</a></li>
<li><a href="vt_yonetim.php">'.$lymenu['veritabani_yonetimi'].'</a></li>
<li><a href="show_status.php">'.$lymenu['mysql_sunucu_bilgisi'].'</a></li>
</ul>
</div>

<div class="kutu-baslik ara-baslik">'.$lymenu['diger'].'</div>
<div class="kutu-icerik yonetim-menu">
<ul class="kutu-liste">
<li><a href="oi_sil.php">'.$lymenu['ozel_ileti_temizleme'].'</a></li>
<li><a href="ileti_guncelle.php">'.$lymenu['ileti_sayisi_guncelleme'].'</a></li>
<li><a href="hata_kayitlari.php">'.$lymenu['hata_kayitlari'].'</a></li>
<li><a href="phpinfo.php">'.$lymenu['sunucu_bilgisi'].'</a></li>
</ul>
</div>

</div>
</div>
<!-- Sol bloklar son -->

';

?>