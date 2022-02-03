<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<table cellspacing="1" cellpadding="0" width="40%" border="0" align="center">

<table cellspacing="5" width="100%" cellpadding="0" border="0" align="center">

    <tr>
    <td height="10"></td>
    </tr>

    <tr>
    <td align="center">

<table width="40%" cellspacing="1" cellpadding="10" border="1" align="center">


    <tr align="center" class="forum_baslik">
	<td class="forum-kategori-alt-baslik" align="center" width="100%" >ARKADAŞLARIM ({ARKADAS_SAYI})</td>
</tr>

<!--__KOSUL_BASLAT-2__-->
<tr>
	<td class="liste-veri" align="left" bgcolor="#ececec" style="color:#000000; border:1px solid #ffffff">
<center>Arkadaş listenizde hiçkimse bulunmamaktadır</center>
</td>
</tr>
<!--__KOSUL_BITIR-2__-->
<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-1__-->
<tr>
	<td class="liste-veri" align="left" bgcolor="#ececec" style="color:#000000; border:1px solid #ffffff">
<div style="position:relative; float:left; text-align:left; width:50px">
<img src="{RESIM}" width="36" style="border:1px solid #999999" alt="Kullanıcı Resmi" title="Kullanıcı Resmi"></div>
<div style="position:relative; float:left; text-align:left;">
<div style="margin-top:4px;"><b><font size="2px"><a href="profil.php?kim={K_ADI}">{K_ADI}</a></font></b></div>
</div><div style="position:relative; float:right; text-align:right;">
<a href="javascript:void(0)" id="ark_liste_sil" name="{K_ADI}" onclick="ark_liste_sil('{K_ADI}')">
<img id="a_listesi" class="{K_ADI}" src="eklentiler/arkadaslik_sistemi/a_sil.png" title="Arkadaşlıktan Sil"></img>
</a>
</div>
	</td>	</tr>
	<!--__TEKLI_BITIR-1__-->
		{SAYFALAMA}<br>
<!--__KOSUL_BITIR-1__-->
</table>

</td></tr>
</table>
</table>
<script src="eklentiler/arkadaslik_sistemi/phpkf-ajax.js" type="text/javascript"></script>