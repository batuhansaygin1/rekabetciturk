<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!DOCTYPE html>
<html <?php echo $TEMA_HTML_DIL; ?>>
<head>
<title><?php echo $sayfa_baslik; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $TEMA_META_KARAKTER; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php echo $meta_etiketler; ?>
<link href="temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<?php echo $TEMA_CSS; ?>
<!--[if lt IE 8]>
<link href="temalar/varsayilan/css/sablon_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php echo $rss_satiri; ?>
</head>
<body>
<header class="clearfix">


<nav id="sabit-menu" class="sabit-menu"><!-- sabit menü baş -->
<div class="ic">
<ul class="sola-yasla" role="menu">

<li role="menuitem" class="klogo"><a href="<?php echo $dosya_index; ?>"></a></li>

<?php if (!$TEMA_UYE_BILGI): // üye girişi yapılmamışsa ?>

<li role="menuitem"><a href="<?php echo $dosya_giris; ?>"><?php echo $lmenu['giris']; ?></a></li>
<li role="menuitem"><a href="<?php echo $dosya_kayit; ?>"><?php echo $lmenu['kayit']; ?></a></li>

<?php else: // üye girişi yapılmışsa ?>

<li role="menuitem"><a href="<?php echo $dosya_profil; ?>"><?php echo $lmenu['profil']; ?></a>
<ul class="dropdown-menu" role="menu">
<li role="menuitem"><a href="<?php echo $dosya_profil_degistir; ?>"><?php echo $lmenu['duzenle']; ?></a></li>
<li role="menuitem"><a href="<?php echo $dosya_sifre_degistir; ?>"><?php echo $lmenu['sifre']; ?></a></li>
</ul>
</li>

<li role="menuitem"><a href="<?php echo $dosya_ozel_ileti; ?>"><?php echo $lmenu['ozel']; ?></a></li>


<?php if ($TEMA_UYE_BILGI['yetki'] == 1): // yönetici ise ?>

<li role="menuitem"><a href="yonetim/index.php"><?php echo $lmenu['yonetim']; ?></a>
<?php if (($portal_kullan == 1) OR ($cms_kullan == 1)): // portal-cms kullanılıyorsa ?>
<ul class="dropdown-menu">
<?php if ($portal_kullan == 1): // portal kullanılıyorsa ?>
<li><a href="portal/index.php"><?php echo $lmenu['portal']; ?></a></li>
<?php endif; // portal koşul sonu ?>
<?php if ($cms_kullan == 1): // cms kullanılıyorsa ?>
<li><a href="<?php echo $cms_dizin; ?>phpkf-yonetim/index.php"><?php echo $lmenu['cms']; ?></a></li>
<?php endif; // cms koşul sonu ?>
</ul>
<?php endif; // portal-cms koşul sonu ?>
</li>

<?php endif;// yönetici koşul sonu ?>

<li role="menuitem"><a href="<?php echo $dosya_cikis.'?o='.$o; ?>" onclick="return window.confirm('<?php echo $lmenu['cikis_uyari']; ?>')"><?php echo $lmenu['cikis']; ?></a></li>

<?php endif; // üye giriş koşul sonu ?>

</ul>


<a class="saga-yasla arama-button" onclick="aramaGoster('arama-alani');" href="javascript:void(0)">Ara</a>
<div class="arama-alani" id="arama-alani">
<form name="hizli_arama" action="<?php echo $dosya_arama; ?>" method="get" onsubmit="return denetle_arama()">
<input type="hidden" name="a" value="1" />
<input type="hidden" name="b" value="1" />
<input type="hidden" name="forum" value="tum" />
<input type="hidden" name="tarih" value="tum_zamanlar" />
<input type="text" name="sozcuk_herhangi" maxlength="100" class="input" value="" placeholder="<?php echo $lmenu['arama']; ?>..." required />
<button class="arama-dugme" type="submit">ara</button>
</form>
</div>

</div>
</nav><!-- sabit menü son -->



<div id="site-baslik" class="site-baslik"><!-- site başlık baş -->
<div class="genislik">
<a href="<?php echo $dosya_index; ?>" class="sola-yasla baslikyazi"><?php echo $TEMA_LOGO_UST; ?></a>
</div>
<div class="clear"></div>
<!-- İKİNCİ LOGO
<div class="reklam-logo" style="position:absolute;top:50px;right:20px">
<a href="index.php"><img src="temalar/varsayilan/resimler/phpkf-b.png" style="border:1px solid #cbcbcb" /></a>
</div>
-->
</div><!-- site başlık son -->



<nav id="genel-menu" class="genel-menu"><!-- genel menü baş -->
<div class="ic genislik">
<ul class="sola-yasla" role="menu">
<?php
// Menü linklerini tema.php tema dosyasındaki
// $tema_ozellik_genel_menu[] dizi değişkeninden değiştirebilirsiniz.
echo $TEMA_MENU;
?>
</ul>
</div>
</nav><!-- genel menü son -->


</header><!-- header bitiş -->


<div id="ana_govde" class="genislik">
<div class="menu-alt-bosluk"></div>

<!--__KOSUL_BASLAT-5__-->
<!--__TEKLI_BASLAT-1__-->
<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#d0d0d0" style="margin-bottom:20px">
	<tr>
	<td class="forum-kategori-baslik" align="left" valign="middle">
{DUYURU_BASLIK}
	</td>
	</tr>

	<tr>
	<td class="blok-icerigi" bgcolor="#ffffff" align="left">
{DUYURU_ICERIK}
	</td>
	</tr>
</table>
<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-5__-->

<?php echo $baslik_en_alt; ?>
