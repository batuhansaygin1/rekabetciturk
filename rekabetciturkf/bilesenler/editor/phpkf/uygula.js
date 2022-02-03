<!-- //
/*
 +===========================================================+
 |                  php Kolay Forum (phpKF)                  |
 +===========================================================+
 |                                                           |
 |            Telif - Copyright (c) 2007 - 2018              |
 |       http://www.phpkf.com   -   phpkf @ phpkf.com        |
 |        Tüm hakları saklıdır - All Rights Reserved         |
 |              http://www.phpkf.com/telif.php               |
 |                                                           |
 +===========================================================+*/

// Butonlar ve sıraları hazırlanıyor

if (duzenleyici_bicim=='bbcode') desen = dugme_bbcode;
else desen = dugme_html;

if (desen == '') var desen = 'kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih devam | youtube video audio | postimage yukleme | geri ileri';


// döngü sayısı hesaplanıyor
desen=desen.replace(/[\ ]+/g, " ");
var desenler=desen.split(" ");
var adet=desenler.length;
var dugmeler_cikti='';


// Düğmeler oluşturuluyor
for (i=0; i<adet; i++)
{
	if(desenler[i]=='|'){dugmeler_cikti+='<div class="dugme_ayrac"></div>';continue;}
	else if(desenler[i]==';'){dugmeler_cikti+='<div class="clear"></div>';continue;}

	phpkf_dugme=phpkf_dugmeler[desenler[i]];
	if(!phpkf_dugme)continue;

	dugmeler_cikti += '<div class="sabit_katman" title="'+phpkf_dugme['aciklama']+'" id="dugme_'+phpkf_dugme['id']+'" onclick="'+phpkf_dugme['islem']+'">'+phpkf_dugme['ek']+'<button type="button" class="dugmeler"><i '+phpkf_dugme['simge']+'></i></button></div>';
}



// Tam ekran
document.write('<div id="duzenleyici_govde" class="duzenleyici_govde"><div id="mesaj_tamekran" class="mesaj_tamekran">');


// Düzenleyici Başlık
document.write('<div id="duzenleyici_baslik" class="duzenleyici_baslik">\
<div id="duzenleyici_baslik_yazi" class="duzenleyici_baslik_yazi">'+phpkfl["kaynak_duzenleyici"]+'</div>\
<div onclick="tam_ekran(\''+duzenleyici_id+'\')" class="goster-gizle" id="goster-gizleb" title="'+phpkfl["tam_ekran"]+'"><i class="fa fa-arrows-alt dugme_tamekran"></i></div>\
<div onclick="duzenleyici_degis(\''+duzenleyici_id+'\',duzenleyici_cevir)" class="goster-gizle" id="goster-gizle" title="'+phpkfl["zengin_duzenleyiciye_gec"]+'"><i class="fa dugme_degistir">D</i></div>\
<div style="clear:both"></div>\
</div>');


// Düğmeler yazdırılıyor
document.write('<div><div id="dugme_alt" class="dugme_alt">'+dugmeler_cikti+'</div></div>');


// Yazı alanı
document.write('<div id="duzenleyici_ana" class="duzenleyici_ana">\
<div id="phpkf_textarea"><textarea cols="5" rows="5" name="phpkf_duzenleyici" id="phpkf_duzenleyici"></textarea></div>\
<div style="display:ruby"><div id="phpkf_div" class="formlar_mesajyaz" style="display:none">&nbsp;</div></div>\
<div id="duzenleyici_taban" class="duzenleyici_taban"></div>\
</div>');

document.write('</div></div><div class="clear"></div>');


// Düzenleyici Başlatılıyor
//document.onreadystatechange=function(){if(document.readyState==='complete')phpKFduzenleyici(duzenleyici_id);}
phpKFduzenleyici(duzenleyici_id);

//  -->