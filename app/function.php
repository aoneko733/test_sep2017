<?php


/**********************
* マジッククォート
* 強制処理
***********************/
if (get_magic_quotes_gpc()) {
  function strip_magic_quotes_slashes($arr)
  {
    return is_array($arr) ?
      array_map('strip_magic_quotes_slashes', $arr) :
      stripslashes($arr);
  }
  $_GET     = strip_magic_quotes_slashes($_GET);
  $_POST    = strip_magic_quotes_slashes($_POST);
  $_REQUEST = strip_magic_quotes_slashes($_REQUEST);
  $_COOKIE  = strip_magic_quotes_slashes($_COOKIE);
}


/**********************
* Nullバイト除去
* 強制処理
***********************/
function replaceNullbyte($arr){
   return is_array($arr) ? array_map('replaceNullbyte', $arr) : str_replace("\0", "", $arr);
}
$_GET     = replaceNullbyte($_GET);
$_POST    = replaceNullbyte($_POST);
$_REQUEST = replaceNullbyte($_REQUEST);
$_COOKIE  = replaceNullbyte($_COOKIE);


/****************************
*	出力用文字コード変換処理
*****************************/
function get_encoding($string) {
	if(is_array( $string )) {
		mb_convert_variables(ENCODE_CHARSET, INTER_CHARSET, $string );
	}else{
		$string = mb_convert_encoding($string, ENCODE_CHARSET, INTER_CHARSET );
	}
	return $string;
}


/****************************
* htmlエスケープ
* 出力コードで変換
*****************************/
function h($str) {
	if( is_array($str) ) {
		$str = strip_htmlspecialchars($str);
	}else{
		$str = htmlspecialchars($str, ENT_QUOTES, OUTPUT_CHARSET);
	}
	return $str;

}
function strip_htmlspecialchars($arr) {
	return is_array($arr) ? array_map('strip_htmlspecialchars', $arr) : htmlspecialchars($arr, ENT_QUOTES, OUTPUT_CHARSET);
}



/****************************
* htmlエスケープ
* 出力コードで変換
*****************************/
function body_encode($str) {
	$line = 0;
	$body = '';
	$bd = '';
	for ($i = 0; $i < mb_strlen($str, ENCODE_CHARSET); $i++) {
		$moji = mb_substr($str, $i, 1, ENCODE_CHARSET);
		$c = bin2hex($moji);
		if (strlen($c) == 2 ) {
			$line++;
			$body .= $moji;
			if( $line >= 76 ) {
				$body .= "\n";
				$line = 0;
			}
		} else {
			$line += 2;
			if( $line == 76 ) {
				$body .= $moji;
				$body .= "\n";
				$line = 0;
			}else if( $line > 76) {
				$body .= "\n";
				$body .= $moji;
				$line = 2;
			}else{
				$body .= $moji;
			}
		}
	}
	return $body;
}


?>
