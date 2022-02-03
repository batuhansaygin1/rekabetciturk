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

function gosterGizle(gosterid,gizleid,gizleid2){if(document.getElementById(gosterid).style.display=="block"){document.getElementById(gosterid).style.display='none';document.getElementById(gizleid).style.display='none';document.getElementById(gizleid2).style.display='none';}else{document.getElementById(gosterid).style.display='block';document.getElementById(gizleid).style.display='none';document.getElementById(gizleid2).style.display='none';}}
function EnterGonder(olay){var tuskodu=null;if((olay!=null)&&(document.form1.enter_gonder.checked!=false)){if(window.event!=undefined){if(window.event.keyCode)tuskodu=window.event.keyCode;else if(window.event.charCode)tuskodu=window.event.charCode;}else{tuskodu=olay.keyCode;}}return (tuskodu==13);}
function denetle_ozel(){var dogruMu=true;if (document.form1.ozel_kime.value.length<4){dogruMu=false;alert("Özel iletiyi göndermek istediğiniz kişinin adını yazınız !");}else if(document.form1.mesaj_baslik.value.length<3){dogruMu=false;alert("iletiye başlık yazmayı unuttunuz !");}else if(document.form1.mesaj_icerik.value.length<3){dogruMu=false;alert("ileti yazmayı unuttunuz !");}else;return dogruMu;}
function onizle_ozel_mobil(){if(document.form1.mesaj_icerik.value=="Cevap Yaz...") document.form1.mesaj_icerik.value="";document.form1.action="../oi_yaz.php#onizleme";document.form1.submit();}
var user_agent=navigator.userAgent;var dikkat=document.getElementById("dikkat");
function cerez(){var veri="";if(document.cookie){index=document.cookie.indexOf("phpkf_mobil");if(index !=-1){bas=(document.cookie.indexOf("=",index)+1),son=document.cookie.indexOf(";",index);if(son==-1)son=document.cookie.length;veri=document.cookie.substring(bas,son);}}return(veri);}
function dikkatKapat(){var ctarih=new Date();ctarih.setTime(ctarih.getTime()+(7*24*60*60*1000));ctarih="; expires="+ctarih.toGMTString();dikkat.style.display="none";cerezveri=cerezveri+"1";document.cookie="phpkf_mobil="+cerezveri+ctarih+cdizin;}
var cerezveri=cerez();
if(user_agent.indexOf("Android")>0){if((user_agent.indexOf("phpKF Android Uygulamasi")<0)&&(cerezveri!="1"))dikkat.style.display="inline";}
//  -->