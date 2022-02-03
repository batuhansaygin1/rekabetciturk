<?php
if (!defined('PHPKF_ICINDEN')) exit();
define('DOSYA_YONETIM_DIL',true);


// Dil dosyası yükleniyor
if (@include_once($site_dili.'/index.php'));
else include_once('tr/index.php');

?>