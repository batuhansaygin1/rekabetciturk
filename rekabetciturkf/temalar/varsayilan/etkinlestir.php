<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVASCRIPT_KODU}

<form name="giris" action="etkinlestir.php" method="post" onsubmit="return denetle()">


<div class="genel-tablo" style="max-width:600px">
<div class="giris-form-baslik">Etkinkeştirme Kodunu Tekrar Yolla</div>


<table cellspacing="20" width="100%" cellpadding="0" border="0" align="center">
	<tr>
	<td colspan="2" class="liste-veri" align="left">
&nbsp;&nbsp; Yeni oluşturduğunuz hesap için etkinleştirme kodu e-posta adresinize gelmediyse bu formu kullanabilirsiniz.
<br>
<br>&nbsp;&nbsp; Öncelikle e-posta hesabınızdaki önemsiz, istenmeyen (bulk, spam) için olan klasörlere de bakın. E-posta yanlışlıkla bu klasörlere de düşmüş olabilir. Eğer bunlarda da yoksa, alttaki forma kayıt için kullandığınız e-posta adresini yazın ve "Tekra Yolla" düğmesini tıklayın.

<br>
<br>&nbsp;&nbsp; E-postanın gelmesi gönderen ve alan sunucuların yoğunluğun dolayı nadiren saatler sürebilir. Tekrar istemenizin üzerinden uzun süre geçtinten sonra halen ekinleştirme e-postası gelmiyorsa, forum yöneticilerini e-posta yoluyla haberdar edin.

<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="right">
E-Posta Adresiniz: &nbsp; 
	</td>
	<td class="liste-etiket" align="left">
<input type="hidden" name="kayit_yapildi_mi" value="etkinlestirme_talebi" />
<input class="formlar" type="text" name="posta" size="20" maxlength="70" required />
	</td>
	</tr>

	<tr>
	<td colspan="2" align="center">
&nbsp; &nbsp;<input class="dugme" type="submit" value="Tekra Yolla" />
<br>
</td></tr></table>
</div>


</form>
<br>
<br>
