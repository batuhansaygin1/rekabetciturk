<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!--__KOSUL_BASLAT-1__--><!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="temalar/varsayilan/sablon.css" rel="stylesheet" type="text/css">
<link href="temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<title><?php echo $l['uyelik_kosullari']; ?></title>
</head>
<body>
<div style="padding:20px">
<table cellspacing="0" cellpadding="10" border="0" align="center" class="genel-tablo" style="width:100%">
	<tr>
	<td align="center" valign="bottom" class="forum-kategori-baslik">
<font color="#ff0000"><?php echo $l['uyelik_kosullari']; ?></font>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<b> &nbsp; Siteye üye olmak için aşağıdaki maddeleri kabul etmeniz gerekmektedir.</b><br>

<ul style="padding:15px; margin:0px; font-size:13px; line-height:25px">
<li>Siteye yazdığınız içeriğin sorumluluğu tamamen size aittir, yazdığınız içerikten site yazarı veya site yöneticileri sorumlu tutulamaz.</li>

<li>Siteye mesaj attığınızda, tarihiyle birlikte ip adresiniz (internetteki kimliğiniz) de kaydedilir.</li>

<li>Site yöneticileri uygunsuz bulduğu mesajları değiştirme ve/veya silme, üyeliğinizi iptal etme hakkına sahiptir.</li>

<li>Sitede yasaları aykırı her türlü yazı yazılması kesinlikle yasaktır.</li>

<li>Kopya yazılım, kopya müzik, hack, crack, warez gibi dosyaların veya içeriğin yazılması yasaktır.</li>

<li>Müstehcen, kaba, iftira niteliğinde, tehdit edici yazılar yazılması yasaktır.</li>

<li>Siteye yazdığınız yazıların yüz binlerce kişi tarafından okunabileceğini düşünerek; Türkçemize yakışan, imla kurallarına uygun güzel bir dille yazın.</li>

<li>Yukarıdaki maddelerin değiştirilme hakkı saklıdır.</li>
</ul>

</td></tr></table>
</div>
</body>
</html>
<!--__KOSUL_BITIR-1__-->




<!--__KOSUL_BASLAT-2__-->
<script type="text/javascript"><!-- //
function SayiArttir(){
	var now = new Date();
	var sayac = Math.random();
	sayac++;
	document.images.onaykodu.src="bilesenler/onay_kodu.php?a=1&sayi="+sayac+"&oturum={SESSION_ID}";
	document.getElementById('onay_kodu').value="";
}
//  -->
</script>
{JAVASCRIPT_KODU}


<div class="genislik" style="margin-top:20px">
<div class="tam-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['kullanici_kayit']; ?></div>
<div class="kutu-icerik kayit-form">


<form action="bilesenler/kayit_yap.php" method="post" onsubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="oturum" value="{PHP_SESSID}" />



<fieldset>
<legend><?php echo $l['kayit_bilgileri']; ?></legend>
<div class="phpkf-form-label">
<label class="label" for="kuladi"><?php echo $l['kullanici_adi']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['kullanici_adi']; ?>" name="kullanici_adi" id="kullanici_adi" class="formlar giris-text" maxlength="20" value="{KULLANICI_ADI}" onkeyup="javascript:dogrula_giris(this.id)" onblur="KAdi()" autocomplete="off" required />
<div style="height:5px; font-size:9px; color:#ff0000" id="kullanici_adi-alan2">
<a href="javascript:void(0)" onclick="KAdi()"><b><?php echo $l['denetle']; ?></b></a>
</div>
</div>

<div class="phpkf-form-label">
<label class="label" for="sifre"><?php echo $l['sifre']; ?><br/></label>
<input type="password" placeholder="<?php echo $l['sifre']; ?>" name="sifre" id="sifre" class="formlar giris-text" maxlength="20" value="" onkeyup="javascript:dogrula_giris(this.id)" autocomplete="new-password" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="sifre2"><?php echo $l['sifre'].' '.$l['tekrar']; ?><br/></label>
<input type="password" placeholder="<?php echo $l['sifre'].' '.$l['tekrar']; ?>" name="sifre2" id="sifre2" class="formlar giris-text" maxlength="20" value="" onkeyup="javascript:dogrula_giris(this.id)" autocomplete="new-password" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="eposta"><?php echo $l['eposta']; ?><br/></label>
<input type="email" placeholder="<?php echo $l['eposta_adresi']; ?>" name="posta" id="posta" class="formlar giris-text" maxlength="70" value="{EPOSTA}" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>
</fieldset>


<!--__KOSUL_BASLAT-4__-->

<fieldset>
<legend><?php echo $l['onay_kodu']; ?></legend>
<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><br/></label>
<img src="bilesenler/onay_kodu.php?a=1&amp;oturum={ONAY_ID}" title="<?php echo $l['onay_kodu_yazin']; ?>" alt="<?php echo $l['onay_kodu']; ?>" id="onaykodu" border="1" width="200" height="40" class="onay-kodu" /> &nbsp; &nbsp; 
<img src="temalar/varsayilan/resimler/yenile.png" title="<?php echo $l['onay_kodu_degis']; ?>" alt="." style="cursor:pointer" onclick="javascript:SayiArttir()" border="0" width="25" height="31" />
</div>

<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><?php echo $l['onay_kodu']; ?><br/></label>
<input type="text" name="onay_kodu" id="onay_kodu" class="formlar giris-text" maxlength="6" placeholder="<?php echo $l['onay_kodu_yazin2']; ?>" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>
</fieldset>

<!--__KOSUL_BITIR-4__-->



<!--__KOSUL_BASLAT-3__-->

<fieldset>
<legend><?php echo $l['guvenlik_sorusu']; ?></legend>
<div>{KAYIT_SORUSU}</div>
<div class="phpkf-form-label">
<input type="text" placeholder="<?php echo $l['guvenlik_cevap']; ?>" name="kayit_cevabi" id="kayit_cevabi" class="formlar giris-text" maxlength="20" value="{KAYIT_CEVABI}" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>
</fieldset>

<!--__KOSUL_BITIR-3__-->



<fieldset>
<div>
<label class="label" for="kosul"></label>
<input type="checkbox" name="kosul" id="kosul" style="position:relative; top:2px" required />
<label for="kosul" style="cursor:pointer">
<a href="javascript:void(0)" onclick="window.open('kayit.php?kosul=kabul', 'uyelik_kosul', 'resizable=yes,toolbar=0,status=0,width=670,height=475');return false">
<?php echo $l['uyelik_kosullari']; ?></a><?php echo $l['uyelik_kosullari_kabul']; ?>
</label>
</div>
</fieldset>


<fieldset>
<div style="text-align:center"><button type="submit" class="dugme dugme-mavi"><?php echo $l['kaydol']; ?></button></div>
</fieldset>



</form>

<div style="display:none">
<img width="0" height="0" border="0" alt="." src="temalar/varsayilan/resimler/bos.png" />
<img width="0" height="0" border="0" alt="." src="temalar/varsayilan/resimler/dogru.png" />
<img width="0" height="0" border="0" alt="." src="temalar/varsayilan/resimler/yanlis.png" />
<img width="0" height="0" border="0" alt="." src="dosyalar/yukleniyor.gif" />
</div>

</div>
</div>
</div>
</div>

<script type="text/javascript"><!-- //
<?php if ($kullanici_adi == '') echo 'setTimeout("document.form1.kullanici_adi.value=\'\'",100);'; ?>
setTimeout("document.form1.sifre.value=''",100);
setTimeout("document.form1.sifre2.value=''",100);
setTimeout("dogrula_giris('kullanici_adi')",100);
setTimeout("dogrula_giris('posta')",100);
if(document.getElementById('kayit_cevabi')) setTimeout("dogrula_giris('kayit_cevabi')",100);
// -->
</script>

<!--__KOSUL_BITIR-2__-->
