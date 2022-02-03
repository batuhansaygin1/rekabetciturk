<!-- //

// Artı puan işlemleri
function begendim()
{
	$("#begenme-input").val();
	var form = $("#begeni-formu").formVerileri();
	$.ajax(
	{
		tip: "POST",
		adres: "eklentiler/begeni_sistemi/begen.php",
		veri: form,
		basarili: function(cvp)
		{
			if(cvp == 'Daha önce oylama yaptınız!')
			{
				alert("Daha önce oylama yaptınız!");
				return false;
			}
			if(cvp == 'Sadece Üyeler Oylama Yapabilir!')
			{
				alert("Sadece Üyeler Oylama Yapabilir!");
				return false;
			}
			var sayi = $("#begenens").html();
			sayi++;
			$("#begenens").html(""+sayi+"");
			$("#begen").ilk().attrSil("onclick");
			$("#begenme").ilk().attrSil("onclick");
			$("#begen").ilk().attrSil("href");
			$("#begenme").ilk().attrSil("href");
			alert(cvp);
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}


// Eksi puan işlemleri
function begenmedim()
{
	var id = $("#begen").attrGetir("name");
	$("#begenme-input").val(id);
	var form = $("#begeni-formu").formVerileri();
	$.ajax(
	{
		tip: "POST",
		adres: "eklentiler/begeni_sistemi/begen.php",
		veri: form,
		basarili: function(cvp2)
		{
			if(cvp2 == 'Daha önce oylama yaptınız!')
			{
				alert("Daha önce oylama yaptınız!");
				return false;
			}
			if(cvp2 == 'Sadece Üyeler Oylama Yapabilir!')
			{
				alert("Sadece Üyeler Oylama Yapabilir!");
				return false;
			}
			var sayi = $("#begenmeyens").html();
			sayi++;
			$("#begenmeyens").html(""+sayi+"");
			$("#begen").ilk().attrSil("onclick");
			$("#begenme").ilk().attrSil("onclick");
			$("#begen").ilk().attrSil("href");
			$("#begenme").ilk().attrSil("href");
			alert(cvp2);
		},
		hata:function()
		{
			alert("phpKF-ajax Başarısız");
		}
	});
}

//  -->