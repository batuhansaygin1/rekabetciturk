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

if(document.getElementById("yonetimMenu"))
{
var adres = window.location.href;
var adres_dosya =  adres.substring(adres.lastIndexOf("/")+1);
var adres_dosya2 =  adres.split('/').pop().split('#')[0].split('?')[0];
var toplam_link = document.getElementById("yonetimMenu").querySelectorAll("li").length;
var menuLinkler = $("#yonetimMenu li");

for (i=toplam_link-1; i=>0; i--)
{
	var bulunan = menuLinkler.uye(i).bul("a");
	if (adres_dosya == "") adres_dosya = "index.php";
	if ((bulunan.attrGetir("href") == adres_dosya) || (bulunan.attrGetir("href") == adres_dosya2))
	{
		bulunan.cssEkle("background", "#f4f4f4").cssEkle("font-weight","bold");
		break;
	}
}
}

//  -->