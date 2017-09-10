<?php

//　

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/function.php';

define("LOCAL_PATH", dirname(__FILE__));
define("CLASS_DIR", LOCAL_PATH.'/'.HTML_DIR);
define("CLASS_FILE", CLASS_DIR.'/Ex_'.ucFirst(HTML_FILE));
define("TMP_PATH", LOCAL_PATH.'/template/'.HTML_DIR);
define("LAYOUT_PATH", LOCAL_PATH.'/layout/');

$file = explode('.', HTML_FILE);
array_pop($file);
$CLASS_NAME = 'Ex_'.ucFirst(join('.', $file));

?>
