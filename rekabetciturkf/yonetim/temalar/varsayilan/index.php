<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $sayfa_baslik; ?></div>
<div class="kutu-icerik">

<table cellspacing="0" cellpadding="0" border="0" align="center" width="96%" style="margin-bottom:20px">
	<tr>
	<td align="left">
<center>
<font size="2"><b><?php echo $ly['phpkf_hosgeldiniz']; ?></b></font>
</center>
<br />
<?php echo $ly['ana_sayfa_bilgi'][0].'<br />'.$ly['ana_sayfa_bilgi'][1]; ?>
	</td>
	</tr>
</table>


<table cellspacing="1" cellpadding="7" border="0" bgcolor="#d0d0d0" width="96%" align="center" style="margin-bottom:20px">
	<tr>
	<td align="left" bgcolor="#ffffff" width="200"><?php echo $ly['acilis_tarihi']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $acilis_tarihi; ?></td>
	</tr>

	<tr>
	<td align="left" valign="middle" bgcolor="#ffffff"><?php echo $ly['phpkf_forum_surumu']; ?>:</td>
	<td align="left" valign="bottom" height="25" bgcolor="#ffffff">
<div id="katman_surum2" style="float:left; width:130px; height:20px"><?php echo $phpkf_surum ?></div>
<div id="katman_surum3" style="float:left; height:20px"><?php echo $surum_denetle; ?></div>
	</td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff"><?php echo $ly['mysql_surumu']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $vt->get_server_info(); ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff"><?php echo $ly['php_surumu']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo @phpversion(); ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff"><?php echo $ly['zend_surumu']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo @zend_version(); ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff"><?php echo $ly['sunucu_os']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $sunucu_is; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff"><?php echo $ly['diger']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff" valign="middle"><?php echo $ly['gd_kutuphanesi']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $gd_bilgisi; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff" valign="middle"><?php echo $ly['sef_adres_destegi']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $htaccess; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff" valign="middle"><?php echo $ly['gzip_destegi']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $gzip; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff" valign="middle"><?php echo $ly['register_globals_ayari']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $register_globals; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff" valign="middle"><?php echo $ly['safe_mode_ayari']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $safe_mode; ?></td>
	</tr>

	<tr>
	<td align="left" bgcolor="#ffffff"><?php echo $ly['veritabani_boyutu']; ?>:</td>
	<td align="left" bgcolor="#ffffff"><?php echo $vt_boyutu; ?></td>
	</tr>
</table>


<table cellspacing="0" cellpadding="0" border="0" align="center" width="96%" style="margin-bottom:10px">
	<tr>
	<td align="left" style="line-height:22px">
<?php
echo $ly['vt_yonetim_tikla'].'
<br>'.$ly['mysql_tikla'].'
<br>'.$ly['sunucu_bilgi_tikla'].'
<br>'.$phpkf_duyuru.'
<img width="0" height="0" border="0" src="../dosyalar/yukleniyor.gif" alt="">'.$javascript_kodu;
?>
	</td>
	</tr>
</table>

</div>
</div>
</div>
