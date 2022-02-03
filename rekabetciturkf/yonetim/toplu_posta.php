<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';

$sayfa_adi = 'Yönetim Toplu E-Posta Gönderimi';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');

?>

<script type="text/javascript">
<!-- //
function denetle()
{
	var dogruMu = true;
	if (document.eposta_form.adim.value.length < 1)
	{
		dogruMu = false; 
		alert("GÖNDERİM ADIMI KISMI BOŞ BIRAKILAMAZ !");
	}

	else if (document.eposta_form.eposta_baslik.value.length < 3)
	{
		dogruMu = false; 
		alert("YAZDIĞINIZ BAŞLIK 3 KARAKTERDEN UZUN OLMALIDIR !");
	}

	else if (document.eposta_form.eposta_icerik.value.length < 3)
	{
		dogruMu = false; 
		alert("YAZDIĞINIZ İLETİ 3 KARAKTERDEN UZUN OLMALIDIR !");
	}
	else;
	return dogruMu;
}
//  -->
</script>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Toplu E-Posta Gönderimi</div>
<div class="kutu-icerik">



<?php
		//  TOPLU E-POSTA GÖNDER TIKLANMIŞSA    -   BAŞI    //


if ( (isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu') ):


echo '
<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">
';



if (($_POST['eposta_baslik']=='') or ( strlen($_POST['eposta_baslik']) < 3)
	OR ( strlen($_POST['eposta_baslik']) > 60) or ($_POST['eposta_icerik']=='')
	OR ( strlen($_POST['eposta_icerik']) < 3)):

	echo '<center><br><br><font color="red"><b>
		E-posta başlığı en az 3, en fazla 60 karakterden oluşmalıdır.
		<br><br>E-posta içeriği en az 3 karakterden oluşmalıdır.</b></font><br><br><br>
		<b>Lütfen <a href="toplu_posta.php">geri dönüp</a> tekrar deneyin.</b><br><br></center>';


else:


//	magic_quotes_gpc açıksa	//

if (get_magic_quotes_gpc())
{
	$_POST['eposta_baslik'] = stripslashes($_POST['eposta_baslik']);
	$_POST['eposta_icerik'] = stripslashes($_POST['eposta_icerik']);
}


//  SEÇİLEN ALANA GÖRE SORGU YAPILIYOR  //

if ( (isset($_POST['kimlere'])) AND ($_POST['kimlere'] != '') )
{
	if ($_POST['kimlere'] == 'tum') $eposta_kimlere = "";
	elseif ($_POST['kimlere'] == 'e_haric') $eposta_kimlere = "WHERE engelle='0'";
	elseif ($_POST['kimlere'] == 'ee_haric') $eposta_kimlere = "WHERE engelle='0' AND kul_etkin='1'";
	elseif ($_POST['kimlere'] == 'yonetici') $eposta_kimlere = "WHERE yetki='1'";
	elseif ($_POST['kimlere'] == 'yardimci') $eposta_kimlere = "WHERE yetki='2'";
	elseif ($_POST['kimlere'] == 'engellenmis') $eposta_kimlere = "WHERE engelle='1' AND kul_etkin='1'";
	elseif ($_POST['kimlere'] == 'etkisiz') $eposta_kimlere = "WHERE kul_etkin='0'";


	//	GÖNDERİLECEK ÜYELERİN SAYISI ALINIYOR	//
	
	$vtsorgu = "SELECT posta FROM $tablo_kullanicilar $eposta_kimlere";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir_sayi = $vt->num_rows($vtsonuc);


	//  GÖNDERECEK KİMSE YOKSA HATA VERİLİYOR   //

	if (empty($satir_sayi))
	{
		echo '<center><br><font color="red"><b>
			Seçmiş olduğunuz grupta hiçbir üye bulunmamaktadır !
			</b></font><br><br></center>';
	}


	//  E-POSTA GÖNDERME KISMI - BAŞI   //

	else
	{
		if ( (isset($_POST['adim'])) AND (is_numeric($_POST['adim']) == false) ) $_POST['adim'] = 50;
		if ( (isset($_POST['adim'])) AND ($_POST['adim'] != '') ) $adim = $_POST['adim'];

		if ( (isset($_POST['devam'])) AND (is_numeric($_POST['devam']) == false) ) $devam = 0;
		if ( (!isset($_POST['devam'])) OR ($_POST['devam'] == '') ) $devam = 0;
		else $devam = $_POST['devam'];


		if ($satir_sayi >= $devam)
		{
			//	GÖNDERİLECEK E-POSTA ADRESLERİ ÇEKİLİYOR	//

			$vtsorgu = "SELECT kullanici_adi,posta FROM $tablo_kullanicilar $eposta_kimlere ORDER BY id LIMIT $devam,$adim";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//		POSTA YOLLANIYOR		//

			require('../bilesenler/eposta_sinif.php');

			while ($eposta_gonderilen = $vt->fetch_assoc($vtsonuc))
			{
				$posta_bul = array('{uye_adi}', '{uye_posta}');
				$posta_cevir = array($eposta_gonderilen['kullanici_adi'], $eposta_gonderilen['posta']);


				$mail = new eposta_yolla();

				if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
				elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();


				$mail->sunucu = $ayarlar['smtp_sunucu'];
				if ($ayarlar['smtp_kd'] == 'true') $mail->smtp_dogrulama = true;
				else $mail->smtp_dogrulama = false;
				$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
				$mail->sifre = $ayarlar['smtp_sifre'];


				$mail->gonderen = $ayarlar['y_posta'];
				$mail->gonderen_adi = $ayarlar['title'];
				$mail->GonderilenAdres($eposta_gonderilen['posta']);
				$mail->YanitlamaAdres($ayarlar['y_posta']);

				$mail->konu = str_replace($posta_bul, $posta_cevir,$_POST['eposta_baslik']);
				$mail->icerik = str_replace($posta_bul, $posta_cevir, $_POST['eposta_icerik']);


				if (!$mail->Yolla())
				{
					echo '<br><center><font color="red"><b>E-posta gönderilemedi !<br><br>Hata iletisi: ';
					echo $mail->hata_bilgi;
					echo '</b></font></center><br>';
					exit();
				}
				usleep(30000);
			}



			$kacdakac = ($devam / $adim) + 1;

			$asama = $satir_sayi / $adim;
			settype($asama,'integer');
			if (($satir_sayi % $adim) != 0) $asama++;



			if ($satir_sayi <= ($devam + $adim))
			{
				echo '<br><br><center><b>
				E-POSTALARINIZ YOLLANMIŞTIR...
				</b></center><br><br>';
			}


			else
			{
				echo '

					<form action="toplu_posta.php" method="post" name="eposta_form2">
					<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
					<input type="hidden" name="adim" value="'.$adim.'">
					<input type="hidden" name="devam" value="'.($devam + $adim).'">
					<input type="hidden" name="kimlere" value="'.$_POST['kimlere'].'">
					<input type="hidden" name="eposta_baslik" value="'.$_POST['eposta_baslik'].'">
					<input type="hidden" name="eposta_icerik" value="'.$_POST['eposta_icerik'].'">

					<br><br>

					<p><b>Gönderilecek toplam e-posta sayısı: </b>'.$satir_sayi.'
					<p><b>Gönderim Adımı: </b>'.$adim.'
					<p><b>Gönderim Aşaması: <font color="red">
					'.$kacdakac.' / '.$asama.'</font></b>
					<br><br><br>
					<center>3 saniye bekleyin ya da "Devam &gt;&gt;" düğmesini tıklayın.
					<br><br><br>
					<input class="dugme" type="submit" value="Devam &gt;&gt;">
					</center></form><br>
					<script type="text/javascript">
					<!-- //
						setTimeout("document.eposta_form2.submit()",3000);
					//-->
					</script>';
			}
		}

		else
		{
			echo '<br><center><b>
			E-POSTALARINIZ YOLLANMIŞTIR...
			</b></center><br>';
		}
	}


	//  E-POSTA GÖNDERME KISMI - SONU   //


}


//  SEÇİM ALANINDA HATA VARSA  //

else
{
	echo '<center><br><font color="red"><b>
	Seçmiş olduğunuz grupta hiçbir üye bulunmamaktadır !
	</b></font><br><br></center>';
}




endif; // form dolu - boş


echo '
	</td>
	</tr>
</table>
';



		//  TOPLU E-POSTA GÖNDER TIKLANMIŞSA    -   SONU    //



else:

?>

<span class="liste-veri">
Bu sayfadan üyelerinize toplu E-Posta gönderebilirsiniz.
Sadece yöneticilere, sadece forum yardımcılarına ya da tüm üyelere ayrı ayrı da yollayabilirsiniz.

<br>
Varsayılan "Gönderim Adımı" 50 dir. Bu özellik, çok fazla üyeniz varsa sunucuya yük yapmadan adım adım e-posta yollamanızı sağlar.
<br>İsterseniz bir seferde yollanan e-posta sayısını arttırabilirsiniz, ama fazla yükseltmeniz önerilmez.
<br>

E-Posta başlık ve içerik kısımlarında; gönderilen üyenin adı için {uye_adi}, e-posta adresi için de {uye_posta} kullanarak e-postaları özelleştirebilirsiniz.
<br><br>
</span>


<form action="toplu_posta.php" method="post" onsubmit="return denetle()" name="eposta_form">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">


<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center" bgcolor="#dddddd">
	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="middle" height="40" width="180">
Gönderilecek Kişiler :
	</td>

	<td align="left" class="liste-veri">
<select class="formlar" name="kimlere">
<option value="tum">Tüm üyeler</option>
<option value="e_haric">Engellenmiş Olanlar Hariç Tüm Üyeler</option>
<option value="ee_haric">Engellenmiş ve Etkin Olmayanlar Hariç Tüm Üyeler</option>
<option value="yonetici">Sadece Forum Yöneticileri</option>
<option value="yardimci">Sadece Forum Yardımcıları</option>
<option value="engellenmis">Sadece Engellenmiş Üyeler</option>
<option value="etkisiz">Sadece Etkin Olmayan Üyeler</option>
</select>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="middle" height="40">
Gönderim Adımı :
	</td>

	<td align="left" class="liste-veri">
<input class="formlar" type="text" name="adim" size="4" maxlength="3" value="50" style="width:50px">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="middle" height="40">
E-Posta Başlığı :
	</td>

	<td align="left" class="liste-veri">
<input class="formlar" type="text" name="eposta_baslik" size="53" maxlength="60" value="" style="width:96%">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="top" rowspan="2">
<br>
E-Posta İçeriği :
<br><br>
<div style="font-weight: normal">
<font size="1">
&nbsp;HTML <b>kapalı</b><br>
&nbsp;BBCode <b>kapalı</b>
<br><br><br>
&nbsp;Üye Adı: {uye_adi}<br>
&nbsp;Üye E-Posta: {uye_posta}
<br><br><br>
&nbsp;(Sadece düz metin)
</font>
</div>
	</td>

	<td align="left" class="liste-veri">
<br>
<textarea class="formlar" cols="50" rows="12" name="eposta_icerik" style="width:96%">
</textarea>
<br><br>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" class="liste-veri" height="40" valign="middle">
<input class="dugme" name="mesaj_gonder" type="submit" value="E-Postaları Gönder">
 &nbsp; 
<input class="dugme" type="reset" value="Temizle">
	</td>
	</tr>
</table>

</form>


<?php endif; // e-posta gönder tıklanmış - tıklanmamış ?>


</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>