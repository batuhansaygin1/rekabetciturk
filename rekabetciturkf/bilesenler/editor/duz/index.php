<?php
if (!defined('PHPKF_ICINDEN')) exit();

// ifade javascript kodları yükleniyor
if (!isset($duzenleyici_dizin)) $duzenleyici_dizin = '';
include $duzenleyici_dizin.'bilesenler/editor/ifadeler.php';

echo $duzenleyici_textarea;
?>
<div id="mesaj_icerik_div" style="display:none"></div>
<div style="clear:both"></div>

<script type="text/javascript">
<!-- //
function islem_ifade(deger1,deger2)
{
	deger2=" "+deger2+" ";
	document.getElementById("mesaj_icerik").value+=deger2;
	if(document.form1.ifade.checked==false)document.form1.ifade.checked=true;
	return false;
}
// -->
</script>

