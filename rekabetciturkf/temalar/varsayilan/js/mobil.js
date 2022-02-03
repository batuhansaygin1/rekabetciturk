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

if(window.navigator.userAgent.match(/(android|mobile)/i)){
var mobil_tarayici = true;
document.write('<style type="text/css">\
.sabit-menu ul li:hover > ul.dropdown-menu {display: none;}\
.genel-menu ul li:hover > ul.dropdown-menu2 {display: none;}\
</style>');
var adet = $(".dropdown-menu").length;
for (i=0;i<adet; i++){
var menu_ul = $(".dropdown-menu").uye(i).return().parentNode;
$(".dropdown-menu").uye(i).html('<li role="menuitem"><a href="'+
$(menu_ul).ilk().bul("a").uye(0)+'">'+
$(menu_ul).ilk().bul("a").uye(0).html()+"</a></li>"+
$(".dropdown-menu").uye(i).html());
$(menu_ul).ilk().bul("a").uye(0).attrEkle("href","javascript:void(0)");
$(menu_ul).ilk().bul("a").uye(0).attrEkle("onclick","MobilTikla(this)");}
var adet = $(".dropdown-menu2").length;
for (i=0;i<adet; i++){
var menu_ul = $(".dropdown-menu2").uye(i).return().parentNode;
$(".dropdown-menu2").uye(i).html('<li role="menuitem"><a href="'+
$(menu_ul).ilk().bul("a").uye(0)+'">'+
$(menu_ul).ilk().bul("a").uye(0).html()+"</a></li>"+
$(".dropdown-menu2").uye(i).html());
$(menu_ul).ilk().bul("a").uye(0).attrEkle("href","javascript:void(0)");
$(menu_ul).ilk().bul("a").uye(0).attrEkle("onclick","MobilTikla(this)");}
function MobilTikla(katman){
var katman2 = $(katman).return().parentNode;
if ($(katman2).ilk().bul("ul").cssGetir("display") == "none")
$(katman2).ilk().bul("ul").cssEkle("display","block");
else $(katman2).ilk().bul("ul").cssEkle("display","none");}
}
function BlokGizle(yon){
if (yon == 1)
{
	if ($(".sol-blok").cssGetir("display")=="none")
	{
		$(".sol-blok").css("display:block");
		if (window.innerWidth < 768) $(".sol-blok").classEkle("sol-blok-yuzer blok-golge");
		$(".sol-goster").css("display:none");
	}
	else
	{
		$(".sol-blok").css("display:none");
		if (window.innerWidth < 768) $(".sol-blok").classSil("sol-blok-yuzer blok-golge");
		$(".sol-goster").css("display:block");
	}
}
else
{
	if ($(".sag-blok").cssGetir("display")=="none")
	{
		$(".sag-blok").css("display:block");
		if (window.innerWidth < 991) $(".sag-blok").classEkle("sag-blok-yuzer blok-golge");
		$(".sag-goster").css("display:none");
	}
	else
	{
		$(".sag-blok").css("display:none");
		if (window.innerWidth < 991) $(".sag-blok").classSil("sag-blok-yuzer blok-golge");
		$(".sag-goster").css("display:block");
	}
}
}

//  -->