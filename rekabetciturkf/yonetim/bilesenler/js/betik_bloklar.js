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


// Kodları Çek
var BlokKodlari = function(GelenVeri)
{
	if(GelenVeri == 'yklenyr2') var Alan = $('#yklenyr2');
	else var Alan = $('#yklenyr');
	Alan.html('<img border="0" src="../phpkf-dosyalar/yukleniyor.gif" alt="yükleniyor"> '+yukleniyor);

	setTimeout(
		function(){
			$('#yeni_blok_kod').cssEkle("display","block"); 
			Alan.html(' ');
		},1000
	);
}


// Verileri Kaydet
$('#verileriKaydetButonu').tik(function(e)
{
	var BlokGenislik = $('#blok_genislik_durumu2').val();
	if (BlokGenislik == '') BlokGenislik = '200px';

	if ($('#baslik1').val() == '' || BlokGenislik == '') alert(lutfen_bos_birakmayin);
	else
	{
		$('#ListeYukle').html('<img src="../phpkf-dosyalar/yukleniyor.gif" alt=""> <span style="color:green;">'+duzenleniyor+'</span>');

		$.ajax({
			adres: "phpkf-bilesenler/blok_islemleri.php",
			tip: 'POST',
			veri: {
			blokgenislik:encodeURIComponent(BlokGenislik),
			blok_ad_id:encodeURIComponent($('#baslik2').val()),
			blok_ad:encodeURIComponent($('#baslik1').val()),
			ozelblokkod:encodeURIComponent($('#kodblogualani').val()),
			dosyaadres:encodeURIComponent($('#dosyaadres').val())},

			basarili: function(sonuc_mesaji)
			{
				$('#ListeYukle').html('<img src="../phpkf-dosyalar/yukleniyor.gif" alt=""> <span style="color:green;">'+duzenleniyor+'</span>');
				$('#baslik1').return().value='';
				$('#baslik2').return().value='';
				$('#OzelBlokmu').val('0');
				$('#kodblogualani').return().value='';
				$('#blok_genislik_durumu2').return().value='';
				$('#dosyaadres').return().value='';

				setTimeout(function(){
					$('#ListeYukle').html('&nbsp;');
					window.location.reload();
				},1000);
			}
		});
	}
});



// Ayarları Kaydet
$('#ayarlariKaydet').tik(function(e)
{
	$('#ayarlarKaydediliyor').html('<img src="../phpkf-dosyalar/yukleniyor.gif" alt=""> <span style="color:blue;">'+kaydediliyor+'</span>');

	$.ajax({
		adres: "phpkf-bilesenler/blok_islemleri.php",
		tip: 'POST',
		veri: {islem:'ayar_kaydet', sol_bloklar:encodeURIComponent($('#sol_bloklar_textarea').val()), kapali_bloklar:encodeURIComponent($('#kapali_bloklar_textarea').val()), sag_bloklar:encodeURIComponent($('#sag_bloklar_textarea').val())},
		basarili: function(sonuc_mesaji)
		{
			$('#ayarlarKaydediliyor').html('<img src="../phpkf-dosyalar/yukleniyor.gif" alt=""> <span style="color:green;">'+uygulaniyor+'</span>');

			setTimeout(function(){
				$('#ayarlarKaydediliyor').html('&nbsp;');
				window.location.reload();
			},1000);
		}
	});
});



// Düzelt Butonu
$('.duzeltLink').tik(function(e)
{
	var $this = $(this).ilk();

	$('#kodblogualani').return().value='';

	if($this.attrGetir("rel") != null)
	{
		var GelenId = $this.attrGetir("rel");
		var GelenBaslik = $this.attrGetir("title");

		if (GelenId == '' || GelenBaslik == '') alert(lutfen_bos_birakmayin);
		else
		{
			$this.html('<img src="../phpkf-dosyalar/yukleniyor.gif" alt="">');
			$('#BlokDuzeltmeAlani').cssEkle("display","block");
			$.ajax({
				adres: "phpkf-bilesenler/blok_islemleri.php",
				veri: {sorgula:GelenId},
				tip: 'POST',
				basarili: function(sonuc_mesaji)
				{
					var SorguSonuc2 = sonuc_mesaji.split('[[[ayrac]]]');
					setTimeout(function(){
					if (SorguSonuc2[0] == '1')
					{
						$('#kodDuzeltmeBlogu').cssEkle("display","block");
						$('#kodDuzeltmeButon').cssEkle("display","block");
						$('#kodblogualani').val(SorguSonuc2[2]);
						$('#dosyaadres').val(SorguSonuc2[3]);
						$('#OzelBlokmu').val('1');
					}
					else
					{
						$('#kodDuzeltmeBlogu').cssEkle("display","block");
						$('#OzelBlokmu').val('0');
					}

					$('#blok_genislik_durumu2').val(SorguSonuc2[1]);
					$('#baslik1').val(GelenBaslik);
					$('#baslik2').val(GelenId);

					for (i=4; i<(SorguSonuc2.length); i++) $('#baslik'+i).val(SorguSonuc2[i]);

					$this.html('<img src="../phpkf-dosyalar/duzenle.png" width="13" height="13" />');
					location.hash = "#ayarlar";
					},750);
				}
			});
		}
	}
});



// Sil Butonu
$('.silLink').tik(function(e)
{
	var $this = $(this).ilk();

	if($this.attrGetir("rel") != null)
	{
		var GelenId = $this.attrGetir("rel");
		if (GelenId == '') alert(lutfen_alan_seciniz);
		else
		{
			if (window.confirm(blok_sil_uyari))
			{
				$this.html('<img src="../phpkf-dosyalar/yukleniyor.gif" alt="">');
				$.ajax({
					adres: "phpkf-bilesenler/blok_islemleri.php",
					veri: {sil:GelenId},
					tip: 'POST',
					basarili: function(sonuc_mesaji){
						setTimeout(function()
						{
							setTimeout(function(){
								$('#Ikon2').html(' '); 
								window.location.reload();
							},500);
						},500);
					}
				});
			}
		}
	}
});



// Yeni Blok Oluştur
$('#yeniOlustur').tik(function(e)
{
	var Baslik2 =  'blok_'+Math.floor((Math.random()*9999999999)+1);
	var sira=Baslik2.substr(6);
	var yeniAd = prompt(blok_baslik,"");
	if (yeniAd!=null)

	if (yeniAd == null) alert(lutfen_bos_birakmayin);
	else
	{
		$.ajax({
			adres: "phpkf-bilesenler/blok_islemleri.php",
			veri: {yeniblok_id:Baslik2, yeniblok_sira:sira, yeniblok_baslik:yeniAd, yeniblok_kod:"", yeniblok_adres:""},
			tip: 'POST',
			basarili: function(sonuc_mesaji){
				setTimeout(function(){
					alert(blok_olusturuldu);
					setTimeout(function(){
						window.location.reload();
					},400);
				},200);
			}
		});
	}
});

//  -->