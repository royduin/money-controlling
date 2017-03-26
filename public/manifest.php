<?php
header('Content-Type: text/cache-manifest');
ob_start();
include('index.php');
ob_end_clean();
$CI =& get_instance();
?>
CACHE MANIFEST

# <?=sha1(time())."\n"; ?>

CACHE:

	#CSS
	css/style.css?v=<?=$CI->config->item('version')."\n"; ?>
	css/bootstrap.min.css
	css/jquery-ui-1.8.24.custom.css
	css/bootstrap-responsive.min.css

	#JS
	js/plugins.js?v=<?=$CI->config->item('version')."\n"; ?>
	js/script.js?v=<?=$CI->config->item('version')."\n"; ?>
	js/libs/modernizr-2.5.3.min.js
	js/libs/jquery-ui-1.8.24.custom.min.js
	js/libs/bootstrap/bootstrap.min.js
	http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js

	#IMG
	img/header.png
	img/arrow.png
	img/header.png
	img/glyphicons-halflings-white.png

NETWORK:
	*