<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<form name="baslik_tasi" action="baslik_tasi.php" method="post">

<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="mesaj_no" value="{MESAJ_NO}">

<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo" style="max-width:600px">
	<tr>
	<td class="forum-kategori-alt-baslik">
BAŞLIK TAŞIMA
	</td>
	</tr>

	<tr>
	<td height="15"></td>
	</tr>

	<tr>
	<td class="liste-veri" align="center">

<b>Bu Foruma taşı: </b>
<br><br>

<select name="tasinan_forum" class="formlar" size="15">
{OPTION_FORUM}
</select>

	</td>
	</tr>

	<tr>
	<td height="20"></td>
	</tr>

	<tr>
	<td align="center">
<input class="dugme" type="submit" value="Başlığı Taşı">
	</td>
	</tr>

	<tr>
	<td height="20"></td>
	</tr>

</table>
</form>
