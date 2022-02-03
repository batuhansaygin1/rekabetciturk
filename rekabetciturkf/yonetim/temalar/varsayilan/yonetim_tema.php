<?php

$t_tema_adi = 'Varsayılan';
$t_renkler = '';
$basliktabani = '';
$css_satiri = '';

$yazi_tabani1 = '#ffffff';
$yazi_tabani2 = '#e0e0e0';


// sil, değiştir ve ip simgeleri
$simge_sil = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/sil.png"';
$simge_degistir = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/degistir.png"';
$simge_ip = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/ip.png"';
$simge_gerial = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/gerial.png"';


//  GENEL MENÜ TASARIMI  //
$tema_ozellik_genel_menu = array(
// üst link açılış
'ust_acilis' => '<li role="menuitem"><a href="{ADRES}" title="{BILGI}">{ISIM}</a>
<ul class="dropdown-menu2" role="menu">',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li role="menuitem"><a href="{ADRES}" title="{BILGI}">{ISIM}</a></li>'
);

?>