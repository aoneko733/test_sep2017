<?php


/**********************
* �}�W�b�N�N�H�[�g
* ��������
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
* Null�o�C�g����
* ��������
***********************/
function replaceNullbyte($arr){
   return is_array($arr) ? array_map('replaceNullbyte', $arr) : str_replace("\0", "", $arr);
}
$_GET     = replaceNullbyte($_GET);
$_POST    = replaceNullbyte($_POST);
$_REQUEST = replaceNullbyte($_REQUEST);
$_COOKIE  = replaceNullbyte($_COOKIE);


/****************************
*	�o�͗p�����R�[�h�ϊ�����
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
* html�G�X�P�[�v
* �o�̓R�[�h�ŕϊ�
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
* html�G�X�P�[�v
* �o�̓R�[�h�ŕϊ�
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
