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

var katman_bilyazi = document.getElementById("bilyazi");
var katman_bkapat = document.getElementById("bkapat");
var katman_byukari = document.getElementById("byukari");
var katman_basagi = document.getElementById("basagi");


function cerez(){
	var veri = "";
	if(document.cookie)
	{
		index = document.cookie.indexOf("kfk_bildirim");
		if (index !=-1)
		{
			bas = (document.cookie.indexOf("=" , index)+1),son = document.cookie.indexOf(";" , index);
			if (son==-1) son = document.cookie.length;
			veri = document.cookie.substring(bas, son);
		}
	}
	return(veri);
}

function BKapat(i)
{
	var ctarih = new Date();
	ctarih.setTime(ctarih.getTime()+(7*24*60*60*1000));
	ctarih = "; expires="+ctarih.toGMTString();
	i++;

	if (bilyazi[i])
	{
		katman_bilyazi.innerHTML = bilyazi[i];
		katman_bkapat.onclick = function(){BKapat(i);};

		if (i!=1)
		{
			var katman3 = document.getElementById("bildirimsayi");
			bildirimsayi = katman3.innerHTML;katman3.innerHTML = (bildirimsayi-bilsayi[(i-1)]);
			var cerezveri = cerez();
			cerezveri = cerezveri +  biltip[(i-1)] + ":" + bilsayi[(i-1)] + "_";
			document.cookie="kfk_bildirim="+cerezveri+ctarih+cdizin;
		}
	}
	else
	{
		if (i!=1)
		{
			var cerezveri = cerez();
			cerezveri = cerezveri +  biltip[(i-1)] + ":" + bilsayi[(i-1)] + "_";
			document.cookie="kfk_bildirim="+cerezveri+ctarih+cdizin;
			Bildirim('bildirimk1',4);
		}
	}
}


function Bildirim(katman,islem)
{
	var katman1 = document.getElementById(katman);
	if (islem == 1)
	{
		if (katman1.style.top == "-16px") setTimeout("Bildirim2(\'"+katman+"\',\'"+islem+"\')",100);
	}
	else Bildirim2(katman,islem);
}

function Bildirim2(katman,islem)
{
	var katman1=document.getElementById(katman);
	if (islem == 1)
	{
		var deger = -16;
		var deger2 = 91;
		Hareket(katman,deger,deger2,islem);
	}
	else if (islem == 4) katman1.style.display="none";
}

function Hareket(katman,deger,deger2,islem)
{
	deger++;
	deger++;
	deger++;
	deger++;
	document.getElementById(katman).style.top = deger+"px";
	if (deger < deger2) setTimeout("Hareket(\'"+katman+"\', \'"+deger+"\', \'"+deger2+"\', \'"+islem+"\')",1);
}

function yonTik(i)
{
	if (bilyazi[i])
	{
		katman_bilyazi.innerHTML = bilyazi[i];
		katman_bkapat.onclick = function(){BKapat(i);};
	}

	if (bilyazi[i-1])
	{
		katman_byukari.className = "tikE";
		katman_byukari.onclick = function(){bYukari(i);};
	}
	else
	{
		katman_byukari.className = "tikH";
		katman_byukari.onclick = "";
	}

	if (bilyazi[i+1])
	{
		katman_basagi.className = "tikE";
		katman_basagi.onclick = function(){bAsagi(i);};
	}
	else
	{
		katman_basagi.className = "tikH";
		katman_basagi.onclick = "";
	}
}

function bYukari(i)
{
	i--;
	yonTik(i);
}

function bAsagi(i)
{
	i++;
	yonTik(i);
}


BKapat(0);
yonTik(1)

//  -->