<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVASCRIPT_KODU}

<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo" style="max-width:710px">
	<tr>
	<td class="forum-kategori-alt-baslik" align="center" valign="middle" colspan="2">
E-Posta Gönder
	</td>
	</tr>

	<tr>
	<td bgcolor="#f8f8f8">

<form action="eposta.php" method="post" onsubmit="return denetle()" name="eposta_form">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="eposta_kime" value="{EPOSTA_KIME}">


<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tr>
	<td width="24%" class="liste-etiket" align="left">
&nbsp; Kime :
	</td>
	<td width="76%" class="liste-etiket" align="left">
{EPOSTA_KIME}
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left">
&nbsp; KONU :
	</td>
	<td class="liste-etiket" valign="bottom" align="left">
<input class="formlar" type="text" name="eposta_baslik" size="83" maxlength="60" value="" style="width:95%">
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" valign="top" align="left">
<br>
&nbsp; İÇERİK:
<br><br>
<div style="font-weight: normal">
<font size="1">
&nbsp; Gönderen ve yanıtlama<br>
&nbsp; adresi olarak sizin e-posta<br>
&nbsp; adresiniz kullanılacaktır.<br>
<br><br>
&nbsp; HTML <b>kapalı</b><br>
&nbsp; BBCode <b>kapalı</b>
<br><br>
&nbsp; (Sadece düz metin)
</font>
</div>
	</td>
	<td class="liste-etiket" valign="top" height="205" align="left">
<textarea class="formlar" cols="81" rows="15" name="eposta_icerik" style="width:95%; height:250px"></textarea>
<br><label style="cursor:pointer"><input type="checkbox" name="eposta_kopya" style="margin:5x;margin-left:0;padding:0">Bana da bir kopya gönder.</label>
	</td>
	</tr>

	<tr>
	<td class="ufak">&nbsp;</td>
	<td class="liste-etiket" height="50" valign="middle" align="center">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="E-Posta Gönder">
 &nbsp; 
<input class="dugme dugme-mavi" type="reset" value="Temizle">
</td></tr></table>
</form>
</td></tr></table>
