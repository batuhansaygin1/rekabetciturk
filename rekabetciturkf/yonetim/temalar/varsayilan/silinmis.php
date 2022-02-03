<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Silinen İletiler</div>
<div class="kutu-icerik">


<table cellspacing="1" cellpadding="3" width="100%" border="0" align="center" class="forum-kategori-taban">
	<tr>
	<td colspan="7" class="forum-kategori-alt-baslik" align="center" valign="middle">
Silinen Başlıklar
	</td>
	</tr>

	<tr class="forum-kategori-baslik" style="height:25px">
	<td align="center">Sıra</td>
	<td align="center">Başlık</td>
	<td align="center">Forum</td>
	<td align="center" width="100">Yazan</td>
	<td align="center" width="55">Cevap</td>
	<td align="center" width="70">Gösterim</td>
	<td align="center" width="150">Son ileti</td>
	</tr>

<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td align="center" height="50" colspan="7" class="liste-etiket" bgcolor="#ffffff">
Silinen başlık yok.
	</td>
	</tr>
 
<!--__KOSUL_BITIR-1__-->


<!--__KOSUL_BASLAT-2__-->
<!--__TEKLI_BASLAT-1__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>{SIRA}</b></td>
	<td align="left">&nbsp;{KONU_BASLIK}</td>
	<td align="left">&nbsp;{FORUM_BASLIK}</td>
	<td align="center" title="Kullanıcı profilini görüntüle">{KONU_ACAN}</td>
	<td align="center">{CEVAP_SAYI}</td>
	<td align="center">{GOSTERIM}</td>
	<td align="left"><b>Yazan: </b>{SON_YAZAN}<br><b>Tarih: </b>{TARIH}</td>
	</tr>

<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-2__-->


</table>
<br>
<br>



<table cellspacing="1" cellpadding="3" width="100%" border="0" align="center" class="forum-kategori-taban">
	<tr>
	<td colspan="7" class="forum-kategori-alt-baslik" align="center" valign="middle">
Silinen Cevaplar
	</td>
	</tr>

	<tr class="forum-kategori-baslik" style="height:25px">
	<td align="center">Sıra</td>
	<td align="center">Başlık</td>
	<td align="center">Forum</td>
	<td align="center" width="100">Cevap Yazan</td>
	<td align="center" width="55">Cevap</td>
	<td align="center" width="70">Gösterim</td>
	<td align="center" width="115">Tarih</td>
	</tr>


<!--__KOSUL_BASLAT-3__-->

	<tr>
	<td align="center" height="50" colspan="7" class="liste-etiket" bgcolor="#ffffff">
Silinen cevap yok.
	</td>
	</tr>

<!--__KOSUL_BITIR-3__-->


<!--__KOSUL_BASLAT-4__-->
<!--__TEKLI_BASLAT-2__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>{SIRA}</b></td>
	<td align="left">&nbsp;{CEVAP_BASLIK}</td>
	<td align="left">&nbsp;{FORUM_BASLIK}</td>
	<td align="center" title="Kullanıcı profilini görüntüle">{CEVAP_YAZAN}</td>
	<td align="center">{CEVAP_SAYI}</td>
	<td align="center">{GOSTERIM}</td>
	<td align="center">{TARIH}</td>
	</tr>

<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-4__-->


</table>
<br>
<br>




<table cellspacing="1" cellpadding="3" width="100%" border="0" align="center" class="forum-kategori-taban">
	<tr>
	<td colspan="7" class="forum-kategori-alt-baslik" align="center" valign="middle">
Silinen Profil Yorumları
	</td>
	</tr>

	<tr class="forum-kategori-baslik" style="height:25px">
	<td align="center">Sıra</td>
	<td align="center" width="90">Profil</td>
	<td align="center" width="90">Yazan</td>
	<td align="center" width="115">Tarih</td>
	<td align="center">Yorum</td>
	<td align="center">Geri</td>
	<td align="center">Sil</td>
	</tr>


<!--__KOSUL_BASLAT-5__-->

	<tr>
	<td align="center" height="50" colspan="7" class="liste-etiket" bgcolor="#ffffff">
Silinen profil yorumu yok.
	</td>
	</tr>

<!--__KOSUL_BITIR-5__-->


<!--__KOSUL_BASLAT-6__-->
<!--__TEKLI_BASLAT-3__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>{SIRA}</b></td>
	<td align="center" title="Yazılan üyenin profilini görüntüle">{YORUM_YAZILAN}</td>
	<td align="center" title="Yazan üyenin profilini görüntüle">{YORUM_YAZAN}</td>
	<td align="center">{YORUM_TARIHI}</td>
	<td align="left" valign="middle">{YORUM}</td>
	<td align="center" width="30" height="30"><b>{GERI}</b></td>
	<td align="center" width="30" height="30"><b>{SIL}</b></td>
	</tr>

<!--__TEKLI_BITIR-3__-->
<!--__KOSUL_BITIR-6__-->

</table>

</div>
</div>
</div>
