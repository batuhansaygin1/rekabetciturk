<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">

<?php if(isset($sayfa_form_ac)) echo $sayfa_form_ac; ?>


<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik"><?php echo $tema_sayfa_icerik; ?></div>


<?php if(isset($sayfa_form_kapat)) echo $sayfa_form_kapat; ?>
</div>
</div>
<?php if(isset($TEMA_SAYFALAMA)) echo $TEMA_SAYFALAMA; ?>


<div style="clear:both;"></div>