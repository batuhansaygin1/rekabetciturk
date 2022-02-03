<?php
$phpkf_ayarlar_kip = "WHERE kip='1' OR etiket='dugme_stil'";
include_once('../../../ayar.php');
header("Content-type: text/css; charset=utf-8");
echo $ayarlar['dugme_stil'];
?>