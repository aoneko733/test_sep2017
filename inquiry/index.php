<?php

// お問い合わせフォーム
ini_set( 'display_errors', 1 );

define("WWW_PATH", realpath(dirname(dirname(__FILE__))));

define("HTML_DIR", basename(dirname(__FILE__)));
define("HTML_FILE", basename(__FILE__));
define("HTML_TYPE", "jp");

require_once WWW_PATH .'/app/require.php';
require_once CLASS_FILE;

$objPage = new $CLASS_NAME();
$objPage->process();

?>
