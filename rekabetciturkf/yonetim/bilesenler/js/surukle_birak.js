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

var
alanDis = 'UL',
alanIc = 'LI',
tag1 = $(''+alanDis+''),
tag2 = $(''+alanDis+' '+alanIc+''),
id2 = null,
hiz = false,
limit = 10,
baslamaSayisi = 0,
tag2id = "";


	function CopKontrol()
	{
		var uyari = true;
		var cop_alani = $("#cop").ilk().bul("LI").ilk();
		if (cop_alani == "[object HTMLLIElement]") uyari = confirm(jsl["baglanti_cop_sil_uyari"]);
		return uyari;
	}


	function verileriToparla(ul, kip)
	{
		var eleman = {}, veri = "", elemanlar = "", gonder = "", textarea = "";

		if ($(ul).length == 0) return null;
		elemanlar = $(ul).return().children;

		if (kip == "#gorunen_baglantilar") textarea = "#siralama";
		else if (kip == "#gizle_alani") textarea = "#gizleme";
		else if (kip == "#cop_alani") textarea = "#copkutusu";
		else textarea = "#zzzzz";


		for (var i = 0; i<elemanlar.length; i++)
		{
			var childVerisi1 = elemanlar[i];
			veri = verileriToparla(childVerisi1, kip);

			if (JSON.stringify(veri) != '{}')
			{
				if (childVerisi1.id)
				{
					eleman[childVerisi1.id] = veri;
				}
				else
				{
					eleman[childVerisi1.tagName] = veri;
				}
			}

			else
			{
				if (childVerisi1.tagName == alanIc)
				{
					eleman[childVerisi1.id] = "son";
				}
			}

			if ( (childVerisi1.id) && (childVerisi1.id != "baglantilar") && (childVerisi1.id != "gizle") && (childVerisi1.id != "cop") )
			{
				var alt_id = document.getElementById(childVerisi1.id).parentNode.parentNode.id;

				if (alt_id == "gorunen_baglantilar") alt_id = 0;
				else if (alt_id == "gizle_alani") alt_id = 0;
				else if (alt_id == "cop_alani") alt_id = 0;

				$(textarea).val($(textarea).val()+childVerisi1.id+":"+alt_id+":"+i+"|");
			}
		}

		return eleman;
	}


	function verileriToparlaBloklar(ul, kip)
	{
		var eleman = {}, veri = "", elemanlar = "",  textarea = "";

		if ($(ul).length == 0) return null;
		elemanlar = $(ul).return().children;

		if (kip == "#sol_bloklar_alani") textarea = "#sol_bloklar_textarea";
		else if (kip == "#kapali_bloklar_alani") textarea = "#kapali_bloklar_textarea";
		else if (kip == "#sag_bloklar_alani") textarea = "#sag_bloklar_textarea";
		else textarea = "#zzzzz";

		for (var i = 0; i<elemanlar.length; i++)
		{
			var childVerisi1 = elemanlar[i];
			veri = verileriToparlaBloklar(childVerisi1, kip);

			if (JSON.stringify(veri) != '{}')
			{
				if (childVerisi1.id) eleman[childVerisi1.id] = veri;
				else eleman[childVerisi1.tagName] = veri;
			}
			else
			{
				if (childVerisi1.tagName == alanIc) eleman[childVerisi1.id] = "son";
			}
			
			if ( (childVerisi1.id) && (childVerisi1.id != "sol_bloklar") && (childVerisi1.id != "kapali_bloklar") && (childVerisi1.id != "sag_bloklar") )
			{
				$(textarea).val($(textarea).val()+childVerisi1.id+":"+i+"|");
			}
		}
		
		return eleman;
	}
	
	var rastgele = function(adet)
	{
		if(adet == null) adet = 15;
	
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for( var i=0; i < adet; i++ )
			text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}

	function katmanSay(ul,baslama){
		var eleman = {}, elemanlar = $(ul);


		if (limit == 0)
		{
			if(baslama == null) baslama = baslamaSayisi;

			if(baslama < limit)
			{
				if(elemanlar.uye(""+i+"").length > 0)
				{
					for(var i = 0; i < $(ul).length; i++)
					{
						eleman['id-'+rastgele()] = katmanSay(elemanlar.uye(""+i+"").bul("li ul"),(baslama+1));
					}
				}
				else eleman['id-'+rastgele()] = baslama;
			}
			else elemanlar.uye(""+i+"").sil(elemanlar.uye(""+i+""));
		}

		return eleman;
	}

	function ustEleman(obje, bul)
	{
			if(obje.id == bul){ return obje; }
			else if(obje.parentNode != null) return ustEleman(obje.parentNode, bul);
			else return obje;
	}

	
	function verileriCiktila(ul1, ul2, ul3)
	{
		$("#siralama").val("|");
		$("#gizleme").val("|");
		$("#copkutusu").val("|");
		$("#sol_bloklar_textarea").val("|");
		$("#kapali_bloklar_textarea").val("|");
		$("#sag_bloklar_textarea").val("|");
		
		verileriToparla(ul1, ul1);
		verileriToparla(ul2, ul2);
		verileriToparla(ul3, ul3);
		verileriToparlaBloklar(ul1, ul1);
		verileriToparlaBloklar(ul2, ul2);
		verileriToparlaBloklar(ul3, ul3);
	}


	tag2.attrEkle("draggable","true").on('dragstart', function(e)
	{
		var target= 'target' in e? e.target : e.srcElement;

		if((target.tagName == alanIc)) id2 = target;
		else id2 = target.parentNode;

		if($(id2).ilk().bul("ul").return()) $(id2).ilk().bul("ul").cssEkle("display","none");


		if( target && e.type == 'selectstart' ){
			target.dragDrop();
		}

		target.draggable = true;

		$(this).ilk().bul("*").return().draggable = false;

		e.dataTransfer.effectAllowed = 'move';
		e.dataTransfer.setData('text', target.textContent);

		$(id2).classEkle('tasiniyor');
	});



	tag2.on('dragenter', function(e)
	{
	
		katmanSay("ul");
		$.dur(e);

		var target= 'target' in e? e.target : e.srcElement;
		
		if( !hiz){

		e.dataTransfer.dropEffect = 'move';

			if($(this).ilk().return().getBoundingClientRect()){ var rectDeg = $(this).ilk().return().getBoundingClientRect();}
			else if(target.getBoundingClientRect()){ var rectDeg = target.getBoundingClientRect();}

			var
				 width = rectDeg.right - rectDeg.left
				, height = rectDeg.bottom - rectDeg.top
				, floating = /left|right|inline/.test($(this).cssGetir("float") + $(this).cssGetir("display"))
				, skew = (floating ? (e.clientX - rectDeg.left)/width : (e.clientY - rectDeg.top)/height) > .9
				, isWide = (target.offsetWidth > id2.offsetWidth)
				, isLong = (target.offsetHeight > id2.offsetHeight)
				, nextSibling = target.nextSibling
				, sonra;

				hiz = true;
				setTimeout(hizFonk, 1);

			if( floating ){
				sonra = (target.previousElementSibling === id2) && !isWide || (skew > .9) && isWide
			} else {
				sonra = (target.nextElementSibling !== id2) && !isLong || (skew > .9) && isLong;
			}

			if((id2.tagName == alanIc) && (target.parentNode.tagName == alanDis))
			{
				if($(id2).attrGetir("rel") == 'sistem')
				{
					if(ustEleman(target, 'cop').id != 'cop') target.parentNode.insertBefore(id2, sonra ? nextSibling : target);
				}
				else if($(id2).attrGetir("rel") == 'normal') target.parentNode.insertBefore(id2, sonra ? nextSibling : target);
			}
			
			$(id2).classEkle('ustunde');
		}
	});


	tag2.on('dragover', function(e)
	{
		$.dur(e);
		if($(id2).attrGetir("rel") == 'sistem')
		{
			if(ustEleman($(this).ilk().return(), 'cop').id != 'cop')
			{
				$(".bloklar_yapi2 UL LI UL").css("min-height:0;border:0");
				$(this).ilk().bul("ul").ilk().css("min-height:30px;border:1px dashed #dfdfdf");
			}
		}
	});


	tag2.on('dragleave', function(e){$.dur(e);});


	tag2.on('drop', function(e)
	{
		$.dur(e);

		if($(id2).ilk().bul("ul").return())
			$(id2).ilk().bul("ul").cssSil("display");

		tag2.classSil('ustunde');
		tag2.classSil('tasiniyor');
	});


	tag2.on('dragend', function(e)
	{
		$.dur(e);

		$(".bloklar_yapi2 UL LI UL").css("min-height:0; border:0");

		if($(id2).ilk().bul("ul").return())
			$(id2).ilk().bul("ul").cssSil("display");

		tag2.classSil('ustunde');
		tag2.classSil('tasiniyor');


		var dizinim = window.location.href.replace("//", "/");
		dizinim = dizinim.split("/");
		dizinim = dizinim.pop().split(".php");

		if ( (dizinim[0] == 'baglantilar') || (dizinim[0] == 'kategoriler') ) verileriCiktila("#gorunen_baglantilar","#gizle_alani","#cop_alani");
		else verileriCiktila("#sol_bloklar_alani","#kapali_bloklar_alani","#sag_bloklar_alani");

	});


	/*####################################################*/
	/*####################################################*/


	tag1.on('dragleave', function(e){$.dur(e);});

	tag1.on('dragenter', function(e){
		$.dur(e);
		if ($(this).ilk().bul(""+alanIc+"").length == 0) {
			e.dataTransfer.dropEffect = 'move';

				if($(id2).attrGetir("rel") == 'sistem')
				{
					if(ustEleman($(this).ilk().return(), 'cop').id != 'cop')
					{
						if(id2.tagName == alanIc) $(this).ilk().append(id2);
						$(id2).classEkle('ustunde');
					}
					else alert(jsl["baglanti_cop_uzerine_uyari"]);
				}
				else if($(id2).attrGetir("rel") == 'normal')
				{
					if(id2.tagName == alanIc) $(this).ilk().append(id2);
					$(id2).classEkle('ustunde');
				}
		}
		
	});


	function hizFonk(){
		hiz = false;
	}

//  -->