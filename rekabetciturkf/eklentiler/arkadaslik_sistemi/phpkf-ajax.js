// Arkadaş ekleme işlemi
function ark_yolla()
{
	var kime = $("#ark_yolla").attrGetir("name");
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {ekle_kimi:kime},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlık İsteğiniz Gönderildi")
		{
		$("#ark_yolla").attrSil("href");
		$("#ark_yolla").attrSil("onclick");
		$("#arkadaslik").attrEkle("title","İstek gönderildi");
		$("#arkadaslik").attrEkle("src","eklentiler/arkadaslik_sistemi/i_gitti.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// İsteği geri çekme işlemi
function ist_cek()
{
	var kime = $("#ist_cek").attrGetir("name");
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {gericek_kimden:kime},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlık İsteğiniz Geri Çekildi")
		{
		$("#ist_cek").attrSil("href");
		$("#ist_cek").attrSil("onclick");
		$("#arkadaslik").attrEkle("title","İstek geri çekildi");
		$("#arkadaslik").attrEkle("src","eklentiler/arkadaslik_sistemi/i_cekildi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// İsteği kabul etme işlemi
function ist_kabul()
{
	var kime = $("#ist_kabul").attrGetir("name");
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {kabulet_kimi:kime},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlık İsteğini Kabul Ettiniz")
		{
		$("#ist_kabul").attrSil("href");
		$("#ist_kabul").attrSil("onclick");
		$("#arkadaslik_r").gizle();
		$("#ist_redd").gizle();
		$("#arkadaslik").attrEkle("title","İstek kabul edildi");
		$("#arkadaslik").attrEkle("src","eklentiler/arkadaslik_sistemi/a_alindi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// İsteği redd etme işlemi
function ist_redd()
{
	var kime = $("#ist_redd").attrGetir("name");
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {reddet_kimi:kime},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlık İsteğini Redd Ettiniz")
		{
		$("#ist_redd").attrSil("href");
		$("#ist_redd").attrSil("onclick");
		$("#arkadaslik").gizle();
		$("#ist_kabul").gizle();
		$("#arkadaslik_r").attrEkle("title","İstek redd edildi");
		$("#arkadaslik_r").attrEkle("src","eklentiler/arkadaslik_sistemi/i_reddedildi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// Arkadaşlıktan silme işlemi
function ark_sil()
{
	var kime = $("#ark_sil").attrGetir("name");
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {sil_kimi:kime},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlıktan Silindi")
		{
		$("#ark_sil").attrSil("href");
		$("#ark_sil").attrSil("onclick");
		$("#arkadaslik").attrEkle("title","Arkadaş listesinden silindi");
		$("#arkadaslik").attrEkle("src","eklentiler/arkadaslik_sistemi/a_silindi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// Arkadaş listesinden silme işlemi
function ark_liste_sil(arkadas)
{
	var kime = $("#ark_liste_sil").attrGetir("name"); 
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {sil_kimi:arkadas},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlıktan Silindi")
		{
		$("#ark_liste_sil").attrSil("href");
		$("#ark_liste_sil").attrSil("onclick");
		$("."+arkadas+"").attrEkle("title","Arkadaş listesinden silindi");
		$("."+arkadas+"").attrEkle("src","eklentiler/arkadaslik_sistemi/a_silindi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// İstekler sayfasından isteği kabul etme işlemi
function ist_liste_kabul(i_kabul)
{
	var kime = $("#"+i_kabul+"_liste_kabul").attrGetir("name"); 
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {kabulet_kimi:i_kabul},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlık İsteğini Kabul Ettiniz")
		{
		$("#"+i_kabul+"_kabul").attrSil("href");
		$("#"+i_kabul+"_liste_kabul").attrSil("onclick");
		$("#"+i_kabul+"_redd").gizle();
		$("."+i_kabul+"").attrEkle("title","Arkadaş listesine alındı");
		$("."+i_kabul+"").attrEkle("src","eklentiler/arkadaslik_sistemi/a_alindi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}
// İstekler sayfasından isteği redd etme işlemi
function ist_liste_redd(i_redd)
{
	var kime = $("#"+i_redd+"_liste_kabul").attrGetir("name"); 
	$.ajax(
	{
		tip: "GET",
		adres: "bilesenler/arkadaslik.php",
		veri: {reddet_kimi:i_redd},
		basarili: function(cvp)
		{
		if(cvp == "Arkadaşlık İsteğini Redd Ettiniz")
		{
		$("#"+i_redd+"_kabul").attrSil("href");
		$("#"+i_redd+"_liste_kabul").attrSil("onclick");
		$("#"+i_redd+"_redd").gizle();
		$("."+i_redd+"").attrEkle("title","İstek redd edildi");
		$("."+i_redd+"").attrEkle("src","eklentiler/arkadaslik_sistemi/i_reddedildi.png");
		}else{
			alert(cvp);
			}
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}