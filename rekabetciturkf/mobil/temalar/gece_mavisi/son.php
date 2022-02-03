<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="clear"></div>
</div>

<div align="center">
<div class="masaUstu"><a href="{FORUM_INDEX}">Tam Sürüme Geç &raquo;</a></div>
</div>
<div class="footer">
<div class="telif">
{{PHPKF}}
<?php
if ($TEMA_SITE_TABAN_YAZI != '')
echo '<div style="width:100%; height:5px"></div>'.$TEMA_SITE_TABAN_YAZI;
?>
<div class="clear"></div>
</div>
</div>


<div class="dikkat" id="dikkat">
<a target="_blank" href="https://play.google.com/store/apps/details?id=com.phpkf.mobil"><span class="dikkat_resim">&nbsp;</span>phpKF Mobil Android Uygulaması Kullanın</a>
<span class="dikkat_kapat" onclick="dikkatKapat()">[<b>X</b>]</span>
</div><div style="clear:both"></div>

<script type="text/javascript">var cdizin="; path=<?php echo $ayarlar['f_dizin']; ?>";</script>
<script type="text/javascript" src="<?php echo $dizin_bilgi; ?>mobil/mbetik.js"></script>

</body>
</html>