<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVASCRIPT_KODU}

<form name="giris" action="yeni_sifre.php" method="post" onsubmit="return denetle()">


<div class="genel-tablo" style="max-width:500px">
<div class="giris-form-baslik">Yeni Şifre Başvurusu</div>


<table cellspacing="20" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">

<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td colspan="2" class="liste-veri" align="left">
&nbsp;&nbsp; Aşağıdaki alana yeni şifrenizi girip "Yeni Şifre Oluştur" düğmenizi tıklayana kadar, eski şifreniz geçerlidir.
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="right">
Yeni Şifreniz: &nbsp; 
	</td>
	<td class="liste-etiket" align="left">
<input type="hidden" name="kayit_yapildi_mi" value="sifre_olustur" />
<input type="hidden" name="kulid" value="{FORM_KULID}" />
<input type="hidden" name="ys" value="{FORM_YS}" />
<input class="formlar" type="password" name="y_sifre1" size="20" maxlength="20" required />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="right">
Yeni Şifreniz Tekrar: &nbsp; 
	</td>
	<td class="liste-etiket" align="left">
<input class="formlar" type="password" name="y_sifre2" size="20" maxlength="20" required />
	</td>
	</tr>

	<tr>
	<td colspan="2" align="center">
<br>
&nbsp; &nbsp; &nbsp; <input class="dugme" type="submit" value="Yeni Şifre Oluştur" />
<br>
<br>

<!--__KOSUL_BITIR-1__-->




<!--__KOSUL_BASLAT-2__-->

	<tr>
	<td colspan="2" class="liste-veri" align="left">
&nbsp;&nbsp; Buradan yeni şifre talebinde buluduğunuzda şifreniz hemen sıfırlanmaz. Ancak size gelen e-posta'da bulunan bağlantıyı tıklayıp, açılan sayfadan yeni şifrenizi oluşturduğunuzda sıfırlanır. Bu sayede başkası sizin yerinize yeni şifre alamaz.
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="right">
E-Posta Adresiniz: &nbsp; 
	</td>
	<td class="liste-etiket">
<input type="hidden" name="kayit_yapildi_mi" value="sifre_talebi" />
<input class="formlar" type="text" name="posta" size="20" maxlength="70" required />
	</td>
	</tr>

	<tr>
	<td colspan="2" align="center">
<br>
&nbsp; &nbsp; &nbsp; <input class="dugme" type="submit" value="Yeni şifre al" />
<br>
<br>

<!--__KOSUL_BITIR-2__-->


</td></tr></table>
</div>


</form>
<br>
<br>

