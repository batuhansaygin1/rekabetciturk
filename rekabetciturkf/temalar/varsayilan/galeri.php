<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<form name="galeri_formu" action="{HEDEF}" method="post">


<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" class="genel-tablo" style="width:100%">
    <tr>
    <td class="forum-kategori-alt-baslik" align="center" valign="middle">
Resim Galerisi
    </td>
    </tr>

    <tr>
    <td height="5"></td>
    </tr>

    <tr>
    <td align="center">
<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
    <tr>
    <td>


<table cellspacing="1" width="100%" cellpadding="10" border="0" align="center" class="tablo_border4">
    <tr>
    <td align="left" class="liste-veri" bgcolor="#ffffff">
&nbsp; {DIGER_DIZINLER}
    </td>
    </tr>

    <tr>
    <td align="left" class="liste-etiket galeri-tablo" bgcolor="#ffffff">
{GALERI_TABLO}
    </td>
    </tr>
</table>


<br>
<center>
<input class="dugme" name="secim_yap" type="submit" value="Resim Seç">
&nbsp; &nbsp; &nbsp;
<input class="dugme" type="submit" value="iptal">
</center>

</td></tr></table>
</td></tr></table>

</form>
