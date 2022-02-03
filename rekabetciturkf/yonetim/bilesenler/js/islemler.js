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

function SefYap(metin){
var metin;
metin = metin.toLowerCase();
var bul = {"_":"-"," ":"-", ",":"-", ".":"-", "ğ":"g", "ü":"u", "ş":"s", "ı":"i", "ö":"o", "ç":"c"};
for(var val in bul) metin = metin.split(val).join(bul[val]);
metin = metin.replace(/[^a-z0-9\-<>]/g, "");
metin = metin.replace(/[\-]+/g, "-");
return(metin);
}
function SefYapYazi(metin){
var metin;
document.duzenleyici_form.adres.value = SefYap(metin);
metin = metin.replace(/[\ ]+/g, ",");
metin = metin.replace(/[\-]+/g, "-");
metin = metin.replace(/[\_]+/g, "_");
document.duzenleyici_form.etiket.value = metin;
}
function SefYapKat(metin){
var metinsef = SefYap(metin);
var adres = document.form2.adres.value;
var bilgi = document.form2.bilgi.value;
var desen = new RegExp(adres, 'gi');
if(metinsef.match(desen)){
document.form2.adres.value = metinsef;}
var desen2 = new RegExp(bilgi, 'gi');
if(metin.match(desen2)){
document.form2.bilgi.value = metin;}
}
function tam_denetle(){
var dogruMu = true;
for (var i=0; i<document.form2.elements.length; i++){
if (document.form2.elements[i].value=="") dogruMu = false;}
if (!dogruMu) alert(jsl["tum_alanlar_zorunlu"]);
return dogruMu;}

//  -->