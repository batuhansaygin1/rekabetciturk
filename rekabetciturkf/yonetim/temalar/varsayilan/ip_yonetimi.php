<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>


<!--__KOSUL_BASLAT-3__-->

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">IP Yönetimi</div>
<div class="kutu-icerik">

{SAYFA_ACIKLAMA}
<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" bgcolor="#dddddd" style="border-bottom:3px solid #58ABD0;margin-bottom:20px;">
	<tr>
	<td colspan="6" class="forum-kategori-alt-baslik" align="center" valign="middle">
{UYE_MISAFIR}
	</td>
	</tr>

	<tr class="forum-kategori-baslik">
	<td align="center" width="30">Sıra</td>
	<td align="center" width="100">Üye Adı</td>
	<td align="center">Son Bulunduğu Sayfa</td>
	<td align="center" width="120">{KAYIT_IP}</td>
	<td align="center" width="120">Son Giriş Tarihi</td>
	</tr>

<!--__KOSUL_BASLAT-5__-->

	<tr>
	<td align="center" height="50" colspan="5" class="liste-etiket" bgcolor="#ffffff">
Bu ip adresini kullanan üye veya misafir yok.
	</td>
	</tr>
 
<!--__KOSUL_BITIR-5__-->


<!--__KOSUL_BASLAT-6__-->
<!--__TEKLI_BASLAT-2__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>{SIRA}</b></td>
	<td align="left" title="Kullanıcı profilini görüntüle">&nbsp;{UYE_ADI}</td>
	<td align="left">&nbsp;{HANGI_SAYFADA}</td>
	<td align="center">{KAYIT}</td>
	<td align="center">{SON_GIRIS}</td>
	</tr>

<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-6__-->

</table>
<br><br>






{SAYFA_ACIKLAMA3}
<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" bgcolor="#dddddd" style="border-bottom:3px solid #58ABD0;margin-bottom:20px;">
	<tr>
	<td colspan="6" class="forum-kategori-alt-baslik" align="center" valign="middle">
{KONULAR_CEVAPLAR}
	</td>
	</tr>

	<tr class="forum-kategori-baslik">
	<td align="center" width="35">Sıra</td>
	<td align="center">Başlık</td>
	<td align="center" width="110">Yazan</td>
	<td align="center" width="110">{IP_DEGISTIREN}</td>
	<td align="center" width="104">İşlem</td>
	<td align="center" width="114">Tarih</td>
	</tr>

<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td align="center" height="50" colspan="6" class="liste-etiket" bgcolor="#ffffff">
Yazılan veya değiştirilen konu veya cevap yok.
	</td>
	</tr>

<!--__KOSUL_BITIR-1__-->


<!--__KOSUL_BASLAT-2__-->
<!--__TEKLI_BASLAT-1__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>{SIRA}</b></td>
	<td align="left">&nbsp;{KONU_BASLIK}</td>
	<td align="center" title="Kullanıcı profilini görüntüle">{YAZAN}</td>
	<td align="center" title="Kullanıcı profilini görüntüle">{IP_DEGISTIREN2}</td>
	<td align="center">{ISLEM}</td>
	<td align="center">{TARIH}</td>
	</tr>

<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-2__-->



</table>
{SAYFALAMA}

</div>
</div>
</div>

<!--__KOSUL_BITIR-3__-->




<!--__KOSUL_BASLAT-4__-->

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">IP adresine veya üye adına göre arama</div>
<div class="kutu-icerik">


<table cellspacing="0" cellpadding="7" width="650" border="0" align="left" bgcolor="#d0d0d0">
	<tr>
	<td class="liste-veri" colspan="2" bgcolor="#ffffff" align="left">
{SAYFA_ACIKLAMA2}
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" width="40%" height="60" align="right" valign="middle">
<b>IP Sorgulama:</b>
	</td>

	<td class="liste-etiket" bgcolor="#ffffff" align="left" valign="middle">
<form action="ip_yonetimi.php" method="get" name="form_ip">
<input type="hidden" name="kip" value="1">
 &nbsp; <input class="formlar" name="ip" type="text" value="{IP_ADRESI}" maxlength="15"> &nbsp; 
<input class="dugme" type="submit" value="Bul">
</form>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" height="60" align="right" valign="middle">
<b>Üye Sorgulama:</b>
	</td>

	<td class="liste-etiket" bgcolor="#ffffff" align="left" valign="middle">
<form action="ip_yonetimi.php" method="get" name="form_ip">
<input type="hidden" name="kip" value="2">
 &nbsp; <input class="formlar" name="kim" type="text" value="{UYE_ADI}" maxlength="20"> &nbsp; 
<input class="dugme" type="submit" value="Bul">
</form>
	</td>
	</tr>
</table>

</div>
</div>
</div>

<!--__KOSUL_BITIR-4__-->
